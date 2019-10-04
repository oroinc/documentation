.. _dev-guide-system-message-queue-architecture-job:

Message Queue Jobs
==================

The bundle provides an entity and a web gui for :ref:`the jobs <op-structure--mq-component--jobs>`. So the jobs are created in the db and have a web gui where you can monitor the jobs' status and interrupt jobs.

.. _op-structure--mq-component--jobs:

Jobs
----

A message processor can be implemented with or without creating jobs.

There is no ideal criteria to help decide whether a job should be
created or not. A developer should decide each time which approach is
better in this case.

Here are a few recommendations:

Skip a job creation if:

-  There is an easy fast-executing action such as status changing etc.
-  The action looks like an event listener.

Always create jobs if:

-  The action is complicated and can be executed for a long time.
-  There is a need to monitor execution status.
-  There is a need to run an unique job i.e. do not allow running a job with the
   same name until the previous job has finished.
-  There is a need to run a step-by-step action i.e. the message flow has
   several steps (tasks) which run one after another.
-  There is a need to split a job for a set of sub-jobs to run in parallel and
   monitor the status of the whole task.

Jobs are usually run with JobRunner.

When to Create a Job
^^^^^^^^^^^^^^^^^^^^

A job is additional information about the message processing task added to the Oro application DB. It allows to view the information about the task (job) in the admin UI and to manage the job (view the status and cancel it) in the UI.


A :ref:`message processor <dev-guide-system-message-queue-architecture-processor>` can be implemented with or without creating jobs, which means that you need to consider what the best approach is in each specific situations. However, below are a few recommendations to help you:

**Do Not Create Jobs If:**

* There is an easy fast-executing action, such as status changing etc.
* The action looks like an event listener.

**Create jobs if:**

* The action is complicated and can be executed for a long time.
* You need to monitor execution status.
* You need to run an unique job, i.e. not to allow running a job with the same name until the previous job has finished.
* You need to run a step-by-step action, i.e. the message flow must have several steps (tasks) which run one after another.
* You need to split a job for a set of sub-jobs to run in parallel and monitor the status of the whole task.

Structure
---------

Jobs Structure
^^^^^^^^^^^^^^

A two-level job hierarchy is created for the process where:

* A root job can have a few child jobs.
* A child job can have one root job.
* A child job cannot have child jobs of its own.
* A root job cannot have a root job of its own.
* If we use just *runUnique*, then a parent and a child jobs with the same name are created.
* If we use *runUnique* and *createDelayed* inside it, then a parent and a child job for runUnique are created. Then each run of *createDelayed* adds another child for the *runUnique* parent.


Flow to Run Parallel Jobs via Creating a Root Job and Child Jobs Using runUnique/createDelayed/runDelayed
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This way of running parallel jobs is more appropriate than the previous
one, although it is slightly more complicated. It is, however, the
preferred way for the parallel processes implementation.

The task is the same as the previous one. We want to run two processes
in parallel. We are also creating processors A, B and C but they are
slightly different.

We inject JobRunner to *Processor A*. Inside the ``process`` method, it
runs ``runUnique`` method. In the closure of the ``runUnique``, it runs
``createDelayed`` method for *Processor B* and for *Processor C* passing
``jobId`` param to its closure. Inside the closures of
``createDelayed``, the messages for *Processor B* and *Processor C* are
created and sent. We should also add the ``jobId`` params to the message
bodies except for the required params.

Processors B and C are also slightly different. Their process methods
call ``runDelayed`` method passing the received ``jobId`` param.

The benefits are the following:

-  **Unique running**. As we use ``runUnique`` method in Processor A, a
   new instance of it cannot run until the previous instance completes
   all the jobs.
-  **Jobs are created in the db**. A root job is created for Processor A
   and child jobs are added to it for Processors B and C.
-  **Status monitoring**. We can see the statuses of all the child jobs:
   *new* for just created, *running* for the jobs that are currently
   running, *success* for the jobs that finished successfully and
   *failed* for the jobs that failed.
-  A root job status is *running* until all child jobs are finished.
-  **Interrupt**. We can interrupt a child job or a root job. If we
   interrupt a root job, all its running child jobs complete their work.
   Child jobs that have not started will not start.

.. figure:: /developer/img/backend/architecture/running_parallel_jobs.png
   :alt: Running Parallel Jobs

   Running Parallel Jobs - a Root Job with async Sub-jobs

Example of createDelayed and runDelayed Usage
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The processor subscribes to ``Topics::DO_BIG_JOB`` and runs a unique big
job (the name of the job is Topics::DO\_BIG\_JOB - the same as the topic
name so it will not be possible to run another big job at the same time)
The processor creates a set of delayed jobs, each of them sends
``Topics::DO_SMALL_JOB`` message.

.. code:: php

        /**
         * {@inheritdoc}
         */
        public function process(MessageInterface $message, SessionInterface $session)
        {
            $bigJobParts = JSON::decode($message->getBody());

            $result = $this->jobRunner->runUnique( //a root job is creating here
                $message->getMessageId(),
                Topics::DO_BIG_JOB,
                function (JobRunner $jobRunner) use ($bigJobParts) {

                    foreach ($bigJobParts as $smallJob) {
                        $jobRunner->createDelayed( // child jobs are creating here and get new status
                            sprintf('%s:%s', Topics::DO_SMALL_JOB, $smallJob),
                            function (JobRunner $jobRunner, Job $child) use ($smallJob) {
                                $this->producer->send(Topics::DO_SMALL_JOB, [ // messages for child jobs are sent here
                                    'smallJob' => $smallJob,
                                    'jobId' => $child->getId(), // the created child jobs ids are passing as message body params
                                ]);
                            }
                        );
                    }

                    return true;
                }
            );

            return $result ? self::ACK : self::REJECT;
        }

The processor subscribes to the ``Topics::DO_SMALL_JOB`` and runs the
created delayed job.

.. code:: php

        /**
         * {@inheritdoc}
         */
        public function process(MessageInterface $message, SessionInterface $session)
        {
            $payload = JSON::decode($message->getBody());

            $result = $this->jobRunner->runDelayed($payload['jobId'], function (JobRunner $jobRunner) use ($payload) {
                //the child job status with the id $payload['jobId'] is changed from new to running

                $smallJobData = $payload['smallJob'];

                if (! $this->checkDataValidity($smallJobData))) {
                    $this->logger->error(
                        sprintf('Invalid data received: "%s"', $smallJobData),
                        ['message' => $payload]
                    );

                    return false; //the child job status with the id $payload['jobId'] is changed from running to failed
                }

                return true; //the child job status with the id $payload['jobId'] is changed from running to success
            });

            return $result ? self::ACK : self::REJECT;
        }

A root job is created for the big job and a set of its child jobs is
created for the small jobs.

UI
--

You can view the statuses and statistics for the jobs by navigating to **System > Jobs** in the main menu in the back-office of all Oro applications.

.. image:: /user/img/system/jobs/jobs.png
   :alt: Scheduled Jobs in admin UI

Job Runner
----------

Jobs are usually created and run with *\\Oro\\Component\\MessageQueue\\Job\\JobRunner*, and one of the following methods is used:

* **runUnique**

  *public function runUnique($ownerId, $name, \\Closure $runCallback)*

  Runs the *$runCallback*. It does not allow another job with the same name to run simultaneously.

* **createDelayed**

  *public function createDelayed($name, \\Closure $startCallback)*

  A sub-job which runs asynchronously (sending its own message). It can only run inside another job.

  Ii is a common approach to create a **delayed job** simultaneously with a **queue message** that contains information about the job. In this case, after receiving the message, the subscribed message processor can run and perform a delayed job by running the *runDelayed* method with the job data.

* **runDelayed**

  *public function runDelayed($jobId, \\Closure $runCallback)*

  This method is used inside a processor for a message which was sent with **createDelayed**.

  The *$runCallback* closure usually returns true or false, the job status depends on the returned value. See the `Jobs Statuses`_ section for the details.

  To reuse the existing processor logic in the scope of job, it may be decorated with *DelayedJobRunnerDecoratingProcessor* which will execute runDelayed, pass the control to the given processor and then handle the result in the format applicable for runDelayed.


.. _dev-cookbook-system-mq-run-single-job:

Unique Job
----------

**Example**:

.. code-block:: php
    :linenos:

    class MessageProcessor implements MessageProcessorInterface
    {
        /**
         * @var JobRunner
         */
        private $jobRunner;

        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            $result = $this->jobRunner->runUnique(
                $message->getMessageId(),
                'oro:index:reindex',
                function (JobRunner $runner, Job $job) use ($data) {
                    // do your job

                    return true; // if you want to ACK message or false to REJECT
                }
            );

            return $result ? self::ACK : self::REJECT;
        }
    }

Dependent Job
-------------

Use a dependent job when your job flow has several steps but you want to send a new message when all steps are finished.

In the example below, a root job is created. As soon as its work is completed, it sends two messages with 'topic1' and 'topic2' to the queue.

.. code-block:: php
    :linenos:

    class MessageProcessor implements MessageProcessorInterface
    {
        /**
         * @var JobRunner
         */
        private $jobRunner;

        /**
         * @var DependentJobService
         */
        private $dependentJob;

        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            $result = $this->jobRunner->runUnique(
                $message->getMessageId(),
                'oro:index:reindex',
                function (JobRunner $runner, Job $job) use ($data) {
                    // register two dependent jobs
                    // next messages will be sent to queue when that job and all children are finished
                    $context = $this->dependentJob->createDependentJobContext($job->getRootJob());
                    $context->addDependentJob('topic1', 'message1');
                    $context->addDependentJob('topic2', 'message2', MessagePriority::VERY_HIGH);

                    $this->dependentJob->saveDependentJob($context);

                    // some work to do

                    return true; // if you want to ACK message or false to REJECT
                }
            );

            return $result ? self::ACK : self::REJECT;
        }
    }

Dependant jobs can only be added to root jobs (i.e., the jobs created with *runUnique*, not *runDelayed*).

.. _dev-cookbook-system-mq-run-two-steps-job:

Run a Job That Has Several Steps
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Example:

.. code-block:: php
    :linenos:

    class Step1MessageProcessor implements MessageProcessorInterface
    {
        /**
         * @var JobRunner
         */
        private $jobRunner;

        /**
         * @var MessageProducerInterface
         */
        private $producer;

        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            $result = $this->jobRunner->runUnique(
                $message->getMessageId(),
                'oro:index:reindex',
                function (JobRunner $runner, Job $job) use ($data) {
                    // for example first step generates tasks for step two

                    foreach ($entities as $entity) {
                        // every job name must be unique
                        $jobName = 'oro:index:index-single-entity:' . $entity->getId();
                        $runner->createDelayed(
                            $jobName,
                            function (JobRunner $runner, Job $childJob) use ($entity) {
                                $this->producer->send('oro:index:index-single-entity', [
                                    'entityId' => $entity->getId(),
                                    'jobId' => $childJob->getId(),
                                ])
                        });
                    }

                    return true; // if you want to ACK message or false to REJECT
                }
            );

            return $result ? self::ACK : self::REJECT;
        }
    }

.. code-block:: php
    :linenos:

    class Step2MessageProcessor implements MessageProcessorInterface
    {
        /**
         * @var JobRunner
         */
        private $jobRunner;

        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            $result = $this->jobRunner->runDelayed(
                $data['jobId'],
                function (JobRunner $runner, Job $job) use ($data) {
                    // do your job

                    return true; // if you want to ACK message or false to REJECT
                }
            );

            return $result ? self::ACK : self::REJECT;
        }
    }

Stale Jobs
----------

It is not possible to create two unique jobs with the same name. That is why, if one unique job is not able to finish its work, it can block another job. To handle such situation, use **stale jobs**.

By default, *JobProcessor* uses *NullJobConfigurationProvider*, so a unique job will never be "stale". If you want to change that behavior, create your own provider that implements *JobConfigurationProviderInterface*.

The *JobConfigurationProvider::getTimeBeforeStaleForJobName($jobName);* method should return the number of seconds after which a job is considered "stale". If you do not want job to be staled, return null or -1.

In the example below, all jobs are treated as "stale" after an hour.

.. code-block:: php
    :linenos:

    <?php

    use Oro\Component\MessageQueue\Provider\JobConfigurationProviderInterface;

    class JobConfigurationProvider implements JobConfigurationProviderInterface
    {
        /**
         * {@inheritdoc}
         */
        public function getTimeBeforeStaleForJobName($jobName)
        {
            return 3600;
        }
    }

    $jobProcessor = new JobProcessor(/* arguments */);
    $jobProcessor->setJobConfigurationProvider(new JobConfigurationProvider());

In this case, if the second unique job with the same name is created but the previous job has not been updated for more than one hour and has not started a child, it gets the **Job::STATUS_STALE** status, and a new job is created.

Additionally, if the processor tries to finish a "stale" job, it is removed.

Jobs Statuses
-------------

* **Single job**: When a message is being processed by a consumer and a JobRunner method runUnique is called without creating any child jobs:

    * The root job is created and the closure passed in params runs. The job gets **Job::STATUS_RUNNING** status, the job startedAt field is set to the current time.
    * If the closure returns true, the job status is changed to **Job::STATUS_SUCCESS**, the job stoppedAt field is changed to the current time.
    * If the closure returns false or throws an exception, the job status is changed to **Job::STATUS_FAILED**, the job stoppedAt field is changed to the current time.
    * If someone interrupts the job, it stops working and gets **Job::STATUS_CANCELLED** status, the job stoppedAt field is changed to the current time.
    * If new unique job is created, but the previous job has not finished, its execution time is checked. If the execution time is longer than the configured time_before_stale, (see Stale jobs) **Job::STATUS_STALE** status is set.

* **Child jobs**: When a message is being processed by a consumer, a JobRunner method runUnique is called which creates child jobs with createDelayed:

    * The root job is created and the closure passed in params runs. The job gets **Job::STATUS_RUNNING** status, the job startedAt field is set to the current time.
    * When the JobRunner method createDelayed is called, the child jobs are created and get the **Job::STATUS_NEWstatuses**. The messages for the jobs are sent to the message queue.
    * When a message for a child job is being processed by a consumer and a JobRunner method runDelayed is called, the closure runs and the child jobs get Job::STATUS_RUNNING status.
    * If the closure returns true, the child job status is changed to **Job::STATUS_SUCCESS**, the job stoppedAt field is changed to the current time.
    * If the closure returns false or throws an exception, the child job status is changed to **Job::STATUS_FAILED**, the job stoppedAt field is changed to the current time.
    * When all child jobs are stopped, the root job status is changed according to the child jobs statuses.
    * If someone interrupts a child job, it stops working and gets **Job::STATUS_CANCELLED** status, the job stoppedAt field is changed to the current time.
    * If someone interrupts the root job, the child jobs that are already running finish their work and get the statuses according to the work result (see the description above). The child jobs that are not run yet are cancelled and get **Job::STATUS_CANCELLED** statuses.
    * If the root job status changes to **Job::STATUS_STALE**, its children automatically get the same status. (see Stale Jobs)

* **Also**: If a jobs closure returns true, the process method which runs this job should return **self::ACK**. If a job closure returns false, the process method which runs this job should return **self::REJECT**.

Examples
--------

Run Only a Single Job (i.e. Job with One Step with runUnique)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: php

    class MessageProcessor implements MessageProcessorInterface
    {
        /**
         * @var JobRunner
         */
        private $jobRunner;

        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            $result = $this->jobRunner->runUnique(
                $message->getMessageId(),
                'oro:index:reindex',
                function (JobRunner $runner, Job $job) use ($data) {
                    // do your job

                    return true; // if you want to ACK message or false to REJECT
                }
            );

            return $result ? self::ACK : self::REJECT;
        }
    }

Job Flow Has Two or More Steps
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: php

    class Step1MessageProcessor implements MessageProcessorInterface
    {
        /**
         * @var JobRunner
         */
        private $jobRunner;

        /**
         * @var MessageProducerInterface
         */
        private $producer;

        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            $result = $this->jobRunner->runUnique(
                $message->getMessageId(),
                'oro:index:reindex',
                function (JobRunner $runner, Job $job) use ($data) {
                    // for example first step generates tasks for step two

                    foreach ($entities as $entity) {
                        // every job name must be unique
                        $jobName = 'oro:index:index-single-entity:' . $entity->getId();
                        $runner->createDelayed(
                            $jobName,
                            function (JobRunner $runner, Job $childJob) use ($entity) {
                                $this->producer->send('oro:index:index-single-entity', [
                                    'entityId' => $entity->getId(),
                                    'jobId' => $childJob->getId(),
                                ])
                        });
                    }

                    return true; // if you want to ACK message or false to REJECT
                }
            );

            return $result ? self::ACK : self::REJECT;
        }
    }

    class Step2MessageProcessor implements MessageProcessorInterface
    {
        /**
         * @var JobRunner
         */
        private $jobRunner;

        public function process(MessageInterface $message, SessionInterface $session)
        {
            $data = JSON::decode($message->getBody());

            $result = $this->jobRunner->runDelayed(
                $data['jobId'],
                function (JobRunner $runner, Job $job) use ($data) {
                    // do your job

                    return true; // if you want to ACK message or false to REJECT
                }
            );

            return $result ? self::ACK : self::REJECT;
        }
    }

.. include:: /include/include-links.rst
   :start-after: begin
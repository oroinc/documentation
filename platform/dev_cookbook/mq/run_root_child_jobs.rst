.. _dev-cookbook-system-mq-run-root-child-jobs:

Run Parallel Jobs via Creating a Root Job and Child Jobs
========================================================

This way of running parallel jobs is more appropriate than the :ref:`Run Several Message Processors in Parallel <dev-cookbook-system-mq-simple-run-parallel>`, although it is slightly more complicated. It is, however, the preferred way for the parallel processes implementation.

The task is the same as the :ref:`previous one <dev-cookbook-system-mq-simple-run-parallel>`. We want to run two processes in parallel. We are also creating processors A, B and C but they are slightly different.

We inject JobRunner to *Processor A*. Inside the `process` method, it runs the `runUnique` method. In the closure
of the `runUnique`, it runs `createDelayed` method for *Processor B* and for *Processor C* passing the `jobId` param to its closure.
Inside the closures of `createDelayed`, the messages for *Processor B* and *Processor C* are created and sent.
We should also add the `jobId` params to the message bodies except for the required params.

Processors B and C are also slightly different. Their process methods call the `runDelayed` method passing the received
`jobId` param.

The benefits are the following:

* **Unique running**. As we use the `runUnique` method in Processor A, a new instance of it cannot run until the previous instance completes all the jobs.
* **Jobs are created in the db**. A root job is created for Processor A and child jobs are added to it for Processors B and C.
* **Status monitoring**. We can see the statuses of all the child jobs: *new* for just created, *running* for the jobs that are currently running, *success* for the jobs that finished successfully and *failed* for the jobs that failed.
* A root job status is *running* until all child jobs are finished.
* **Interrupt**. We can interrupt a child job or a root job. If we interrupt a root job, all its running child jobs complete their work. Child jobs that have not started will not start.

.. image:: /dev_cookbook/mq/img/running_parallel_jobs.png

Example of Using createDelayed and runDelayed
---------------------------------------------

The processor subscribes to `Topics::DO_BIG_JOB` and runs a unique big job (the name of the job is Topics::DO_BIG_JOB, the same as the topic name so it  is not be possible to run another big job at the same time).

The processor creates a set of delayed jobs, each of them sends the `Topics::DO_SMALL_JOB` message.

.. code-block:: php
    :linenos:

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

The processor subscribes to the `Topics::DO_SMALL_JOB` and runs the created delayed job.

.. code-block:: php
    :linenos:

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

A root job is created for the big job and a set of its child jobs is created for the small jobs.

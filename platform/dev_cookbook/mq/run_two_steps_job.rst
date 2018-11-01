.. _dev-cookbook-system-mq-run-two-steps-job:

Run a Job That Has Several Steps
================================

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


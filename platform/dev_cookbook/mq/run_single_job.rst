.. _dev-cookbook-system-mq-run-single-job:

Run a Single Job in Message Processor
=====================================

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

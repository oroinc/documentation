.. _dev-guide-mq-stackdriver:

Writing Logs to Stackdriver
===========================

|Google Stackdriver| logging allows you to store, search, analyze, monitor, and alert on log data.

Logs can be streamed to the Stackdriver with |Logging Agent| or manually using |GCloud SDK|.

A simple example of how you can stream your message queue logs to the Stackdriver with custom |Monolog Handler| is described below.

Add Google Cloud SDK package:

.. code-block:: bash

   COMPOSER=dev.json composer require "google/cloud":"~0.70"

Create **StackdriverHandler** that uses GCloud SDK:

.. code-block:: php
   :caption: // src/Acme/Bundle/DemoBundle/Log/Handler/StackdriverHandler.php

    <?php

    namespace Acme\Bundle\DemoBundle\Log\Handler;

    use Google\Cloud\Logging\LoggingClient;
    use Monolog\Handler\PsrHandler;
    use Monolog\Logger;

    class StackdriverHandler extends PsrHandler
    {
        /**
         * StackdriverHandler constructor.
         */
        public function __construct()
        {
            $client = new LoggingClient([
                'projectId' => 'Your Project Id',
            ]);

            $logger = $client->psrLogger('oro_message_queue');

            // In current example logs with level Logger::NOTICE and higher will be streamed to the Stackdriver
            parent::__construct($logger, Logger::NOTICE);
        }

        /**
         * {@inheritDoc}
         */
        public function handle(array $record)
        {
            $record['context']['extra'] = $record['extra'];

            return parent::handle($record);
        }
    }

Define the service in the DI:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml

    services:
        acme_demo.log.handler.stackdriver:
            class: Acme\Bundle\DemoBundle\Log\Handler\StackdriverHandler


Configure Monolog handler to listen only to message queue logs:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml

    monolog:
        handlers:
            message_queue.consumer.stackdriver:
                type: service
                id: acme_demo.log.handler.stackdriver
                channels: ['!mq_job_transitive']


Check the *Google Cloud Platform > Stackdriver > Logging > Logs*, now you can configure filters and monitor all logs streamed to the Stackdriver.

.. image:: /img/backend/mq/stackdriver_filter.png
   :alt: Stackdriver Filter

Logs-Based Metrics
------------------

Logs-based metrics is a useful tool to check whats is going on with message consuming. More information is available in the |Overview of Logs-Based Metrics| topic.

Few examples of logs-based metrics are listed below:

1. The total number of statuses received.

   * Check |How to Create Counter Metric|.
   * In the viewer panel, create a filter ``jsonPayload.status=("REJECT" OR "REQUEUE" OR "ACK")``; it shows only the message processed log entries
   * In the **Metric Editor** panel, set the following fields:

   +----------------+---------------------------------------------------------------------------------------------------------------------------------------+
   |Field           | Value                                                                                                                                 |
   +----------------+---------------------------------------------------------------------------------------------------------------------------------------+
   |**Name**        | status_count                                                                                                                          |
   |**Add Label**   | **Name**: topic, **Label type**: String, **Field name**: `jsonPayload.extra.message_properties."oro.message_queue.client.topic_name"` |
   |**Add Label**   | **Name**: status, **Label type**: String, **Field name**: `jsonPayload.status`                                                        |
   |**Type**        | Counter                                                                                                                               |
   +----------------+---------------------------------------------------------------------------------------------------------------------------------------+

   The current metrics shows total number of all statuses grouped by **Topic Name** with **Status**.

   .. image:: /img/backend/mq/stackdriver_total_number.png
      :alt: Total number of statuses metric

2. Memory peak of received messages.

   * Check |How to Create Distribution Metric|.
   * In the viewer panel, create a filter ``jsonPayload.status=("REJECT" OR "REQUEUE" OR "ACK")`` it shows only the message processed log entries
   * In the **Metric Editor** panel, set the following fields:

   +---------------------------------+--------------------------------------------------------------------------------------------------------------------------------------+
   |   Field                         | Value                                                                                                                                |
   +---------------------------------+--------------------------------------------------------------------------------------------------------------------------------------+
   |**Name**                         | peak_memory                                                                                                                          |
   |**Add Label**                    | **Name**: topic, **Label type**: String, **Field name**: `jsonPayload.extra.message_properties."oro.message_queue.client.topic_name"`|
   |**Add Label**                    | **Name**: status, **Label type**: String, **Field name**: `jsonPayload.status`                                                       |
   |**Type**                         | Distribution                                                                                                                         |
   |**Field name**                   | jsonPayload.extra.peak_memory                                                                                                        |
   |**Extraction regular expression**| `([0-9.]+) MB`                                                                                                                       |
   |**Histogram buckets Type**       | Linear *(setup current and below values by yours preferences)*                                                                       |
   |**Start value**                  | 40                                                                                                                                   |
   |**Number of buckets**            | 200                                                                                                                                  |
   |**Bucket width**                 | 5                                                                                                                                    |
   +---------------------------------+--------------------------------------------------------------------------------------------------------------------------------------+

   The current metrics shows Peak of Memory for each message grouped by **Topic Name** with **Status**.

   .. image:: /img/backend/mq/stackdriver_memory_peak.png
      :alt: Peak of Memory metric

3. Time taken of received messages.

   * Check |How to Create Distribution Metric|.
   * In the viewer panel, create a filter ``jsonPayload.status=("REJECT" OR "REQUEUE" OR "ACK")`` it shows only the message processed log entries
   * In the **Metric Editor** panel, set the following fields:

   +------------------------------+--------------------------------------------------------------------------------------------------------------------------------------+
   |Field                         | Value                                                                                                                                |
   +------------------------------+--------------------------------------------------------------------------------------------------------------------------------------+
   |**Name**                      | time_taken                                                                                                                           |
   |**Add Label**                 | **Name**: topic, **Label type**: String, **Field name**: `jsonPayload.extra.message_properties."oro.message_queue.client.topic_name"`|
   |**Add Label**                 | **Name**: status, **Label type**: String, **Field name**: `jsonPayload.status`                                                       |
   |**Units**                     | ms                                                                                                                                   |
   |**Type**                      | Distribution                                                                                                                         |
   |**Field name**                | jsonPayload.time_taken                                                                                                               |
   |**Histogram buckets Type**    | Linear *(setup current and below values by yours preferences)*                                                                       |
   |**Start value**               | 5                                                                                                                                    |
   |**Number of buckets**         | 200                                                                                                                                  |
   |**Bucket width**              | 10                                                                                                                                   |
   +------------------------------+--------------------------------------------------------------------------------------------------------------------------------------+


   The current metrics shows total processing time for each message grouped by **Topic Name** with **Status**.

   .. image:: /img/backend/mq/stackdriver_time_taken.png
      :alt: Time taken metric

Message Queue Dashboard
-----------------------

Configure "Message Queue Dashboard", as described in |Creating and Managing Dashboard Widgets|, and |create charts and alerts|.
You can monitor and be notified if something is not going as expected.

.. image:: /img/backend/mq/stackdriver_dashboard.png
   :alt: Message Queue Dashboard

.. include:: /include/include-links-dev.rst
   :start-after: begin
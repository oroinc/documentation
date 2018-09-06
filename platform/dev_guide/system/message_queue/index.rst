.. _dev-guide-system-message-queue:

Message Queue
=============

Messaging is a method of communication between software components or applications: when a sender sends a message to a
message queue and the recipient  retrieves it.

The interaction between the system components with the help of a message queue enables distributed communication that is **loosely coupled**, meaning that the sender and the receiver of the message do not need to interact with the message queue at the same time. Messages are placed in the queue and stored until the recipient retrieves them. In fact, the sender does not need to know anything
about the receiver; nor does the receiver need to know anything about the sender. A message also does not have
information about the previous and following messages.

Message queuing is useful in many cases, especially in enterprise and high-load applications. In particular, a
message queue should be used if:

* A process can be executed asynchronously.
* A process does not affect user experience.
* Processes need to be executed in parallel for faster performance.
* You need a guarantee of processing.
* You need scalability.

By its enterprise nature, **Oro Applications** widely use messaging for communication between components and to schedule and process the heavy tasks in the background. For example, the Message Queue functionality is crucial for:

* Import/export
* Search content reindexation
* Price recalculation
* Image processing
* Tasks in OroCommerce and others Oro applications.

For more information about the Message Queues concept, see the following external resources:

* `What is Message Queue <http://www.ibm.com/support/knowledgecenter/SSFKSJ_9.0.0/com.ibm.mq.pro.doc/q002620_.htm>`_,
* `Message Queue Benefits <https://www.iron.io/top-10-uses-for-message-queue/>`_ (most of them are applicable to Oro Message Queue Component)
* `Rabbit MQ Introduction <https://www.rabbitmq.com/tutorials/tutorial-one-php.html>`_.

How It Works
------------

The basic Oro applications `Message Queue functionality` and `DBAL Message Queue broker` is implemented in `MessageQueue Component`_ and `OroMessageQueueBundle`_ of the `OroPlatform`_ package. The integration with `RabbitMQ`_ broker based on the `AMQP`_ message queuing protocol implemented in the *AmqpMessageQueue Component* and *OroAmqpMessageQueueBundle* of the *OroPlatform Enterprise* package.

See the following sections for detailed description of Message Queue Architecture in Oro applications:

.. toctree::
    :includehidden:
    :titlesonly:
    :maxdepth: 2

    architecture/index

Setup and Configuration
-----------------------

You have to perform several steps to prepare Oro application to work with message queue. Please see the sections below for details:

.. toctree::
    :includehidden:
    :titlesonly:
    :maxdepth: 2

    setup_and_configure/index

Getting Started
---------------

For illustration purposes, let us assume that:
 
* You use OroCRM and every month generate a complex report about your customers. This report usually contains complex event statistic and a lot of calculated data.

* You added a button to the management console to generate such a report and created a service class that contains all report generation logic and functionality.

* Unfortunately, report generation takes about an hour and you need to speed up this process. 

In this case, the Message Queue is the right solution. With it, you can delegate the generation task to the background process that will send you an email notification after the report is successfully generated.

**To implement it:** 

1. First, create the **controller action** that will be triggered when you click the **Generate Report** button in the management console UI.
  
   In this action, use the :ref:`message producer <dev-guide-system-message-queue-architecture-producer>` to send a
   :ref:`message <dev-guide-system-message-queue-architecture-message>` with the information about the further report
   generation task to the :ref:`message queue broker <dev-guide-system-message-queue-architecture-broker>`:
   
   .. code-block:: php
       :linenos:
   
       # src/Acme/Bundle/DemoBundle/Controller/GenerateController.php
       <?php
   
       namespace App\Acme\Bundle\DemoBundle\Controller;
   
       use Symfony\Bundle\FrameworkBundle\Controller\Controller;
       use App\Acme\Bundle\DemoBundle\Async\Topics;
       use Oro\Component\MessageQueue\Client\MessageProducer;
   
       class GenerateController extends Controller
       {
           // ...
   
           /**
            * @Route(
            *      "report/monthly/generate",
            *      name="acme_demo_report_monthly_generate"
            * )
            */
           public function generateMonthlyReportAction(Request $request)
           {
           $message = [‘recepient’ => $this->tokenAccessor->getUser()->getEmail()];
   
           /** @var Oro\Component\MessageQueue\Client\MessageProducer */
           $messageProducer = $this->get(‘oro_message_queue.client.message_producer’);
                   $messageProducer->send(Topics::GENERATE_MONTHLY_REPORT, $message);
           }
       }
   
   
   .. code-block:: php
       :linenos:
   
       # src/Acme/Bundle/DemoBundle/Async/Topics.php
       <?php
   
       namespace App\Acme\Bundle\DemoBundle\Async;
   
       class Topics
       {
           const GENERATE_MONTHLY_REPORT = ‘acme.demo.generate_monthly_report’;
       }
   
2. Create a :ref:`message processor <dev-guide-system-message-queue-architecture-processor>` to take care about the report generation task in the background.

   Keep in mind that your message processor has to implement `MessageProcessorInterface`_, `TopicSubscriberInterface`_ and has to be registered as DI service with the **oro_message_queue.client.message_processor** tag.

   .. code-block:: php
       :linenos:
   
       # src/Acme/Bundle/DemoBundle/Async/GenerateMonthlyReportProcessor.php
       <?php
   
       namespace App\Acme\Bundle\DemoBundle\Async;
   
       use Oro\Component\MessageQueue\Client\TopicSubscriberInterface;
       use Oro\Component\MessageQueue\Consumption\MessageProcessorInterface;
       use Oro\Component\MessageQueue\Transport\MessageInterface;
       use Oro\Component\MessageQueue\Transport\SessionInterface;
       use App\Acme\Bundle\DemoBundle\Generator\MonthlyReport as MonthlyReportGenerator;
       use App\Acme\Bundle\DemoBundle\Notification\EmailSender;
   
       class GenerateMonthlyReportProcessor implements MessageProcessorInterface, TopicSubscriberInterface
       {
          /** @var MonthlyReportGenerator */
          protected $monthlyReportGenerator;
   
          /** @var EmailSender */
          protected $emailSender;
   
          /**
           * @param MonthlyReportGenerator $monthlyReportGenerator
           * @param EmailSender $emailSender
           */
          public function __construct(MonthlyReportGenerator $monthlyReportGenerator, EmailSender $emailSender)
          {
              $this->monthlyReportGenerator = $monthlyReportGenerator;
              $this->emailSender = $emailSender;
          }
   
          /**
           * {@inheritdoc}
           */
          public function process(MessageInterface $message, SessionInterface $session)
          {
              $body = JSON::decode($message->getBody());
              $recipient = $body[‘recipient’];
              $generatedReportLink = $this->monthlyReportGenerator->generateReport();
   
              if (false == $generatedReportLink) {
                  return self::REJECT;
              }
   
              $this->emailSender->sendGeneratedReportLink($generatedReportLink, $recepient);
   
              return self::ACK;
          }
   
          /**
           * {@inheritdoc}
           */
          public static function getSubscribedTopics()
          {
              return [Topics::GENERATE_MONTHLY_REPORT];
          }
       }
   
   
   .. code-block:: yaml
       :linenos:
   
       # src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       services:
               acme.demo.generate.monthly_report_message_processor:
          class: 'App\Acme\Bundle\DemoBundle\Async\GenerateMonthlyReportProcessor'
          arguments:
              - '@acme.demo.generate.monthly_report_generator'
              - '@acme.demo.notification.email_sender'
          tags:
              - { name: 'oro_message_queue.client.message_processor' }
   
3. :ref:`Setup and run the consumer <dev-guide-system-message-queue-setup-configure-consumer>` if you have not done this after Oro application installation.

Now when you click the **Generate Report** button, a background process will start generating the report. You will receive an email notification when the report is successfully generated.

Related Cookbook Articles
-------------------------

* :ref:`Simple Way to Run Several Message Processors in Parallel <dev-cookbook-system-mq-simple-run-parallel>`
* :ref:`Flow to Run Parallel Jobs via Creating a Root Job and Child Jobs <dev-cookbook-system-mq-run-root-child-jobs>`
* :ref:`Run Only a Single Job in Message Processor <dev-cookbook-system-mq-run-single-job>`
* :ref:`Run the Job That Has Two or More Steps <dev-cookbook-system-mq-run-two-steps-job>`
* :ref:`Create and Run Unit and Functional Tests for Testing Message Queue Functionality <dev-cookbook-system-mq-testing>`
* :ref:`Resetting Container in Consumer <dev-cookbook-system-mq-reset-contaiter>`
* :ref:`Access the Security Context in Consumer <dev-cookbook-system-mq-access-security-context>`

.. _`MessageProcessorInterface`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/MessageQueue/Consumption/MessageProcessorInterface.php
.. _`TopicSubscriberInterface`: https://github.com/oroinc/platform/blob/master/src/Oro/Component/MessageQueue/Client/TopicSubscriberInterface.php
.. _`OroPlatform`: https://github.com/oroinc/platform/
.. _`RabbitMQ`: http://rabbitmq.com/
.. _`AMQP`: https://www.amqp.org/
.. _`MessageQueue Component`: https://github.com/oroinc/platform/tree/master/src/Oro/Component/MessageQueue
.. _`OroMessageQueueBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/MessageQueueBundle

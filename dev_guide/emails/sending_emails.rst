Sending E-Mails
===============

Creating an E-Mail
------------------

An e-mail that is created and sent by OroPlatform is centered around the
:class:`Oro\\Bundle\\EmailBundle\\Form\\Model\\Email` model class which reflects all the properties
of an e-mail.

There are two ways to create a new e-mail:

#. :ref:`Manually create an e-mail <book-sending-emails-manually>`.

#. :ref:`Use the e-mail builder class <book-sending-emails-builder>`.

.. _book-sending-emails-manually:

Manually Creating an E-Mail
~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can manually create an e-mail by creating a new instance of the ``Email`` model class and call
the setter methods for all the properties you want to be set:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Controller/EmailController.php
    namespace Acme\DemoBundle\Controller;

    use Oro\Bundle\EmailBundle\Form\Model\Email;
    use Oro\Bundle\EmailBundle\Form\Model\EmailAttachment;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class EmailController extends Controller
    {
        public function sendMailAction()
        {
            $email = new Email();

            // the sender
            $email->setFrom('chris@example.com');

            // recipient(s)
            $email->setTo(array('alice@example.com', 'bob@example.com'));

            // CC recipient(s)
            $email->setCc(array('dave@example.com', 'eric@example.com'));

            // BCC recipient(s)
            $email->setBcc(array('ryan@example.com', 'jonathan@example.com'));

            // the subject
            $email->setSubject(...);

            // a template to create the e-mail body, the passed template
            // must be an instance of Oro\Bundle\EmailBundle\Entity\EmailTemplate
            $email->setTemplate(...);

            // a context that will be passed to the template set with setTemplate()
            $email->setContexts(array(...));

            // the e-mail type (either html or text)
            $email->setType(...);

            // as an alternative to using a template (see above) you can also
            // directly set the e-mail body
            $email->setBody(...);

            // e-mail attachments (instances of  Oro\Bundle\EmailBundle\Form\Model\EmailAttachment
            $email->addAttachment($attachment);

            // ...
        }
    }

.. _book-sending-emails-builder:


The ``EmailModelBuilder`` Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

An alternative approach to manually creating ``Email`` models is to use the
:class:`Oro\\Bundle\\EmailBundle\\Builder\\EmailModelBuilder` helper class which offers several
methods to create new e-mails based on existing data:

:method:`Oro\\Bundle\\EmailBundle\\Builder\\EmailModelBuilder::createEmailModel`
    Create a new e-mail or add missing data to an existing e-mail.

:method:`Oro\\Bundle\\EmailBundle\\Builder\\EmailModelBuilder::createReplyEmailModel`
    Create an e-mail that is a response to an existing e-mail.

:method:`Oro\\Bundle\\EmailBundle\\Builder\\EmailModelBuilder::createReplyAllEmailModel`
    Create an e-mail that is a response to all recipients and the sender of an existing e-mail.

:method:`Oro\\Bundle\\EmailBundle\\Builder\\EmailModelBuilder::createForwardEmailModel`
    Create a new e-mail that forwards an existing e-mail.

After e-mails have been processed (see below), they will be persisted to the database. You can
create an e-mail model based on such a persisted entity, by using the useful
:class:`Oro\\Bundle\\EmailBundle\\Builder\\EmailModelBuilder` helper class:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Controller/EmailController.php
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class EmailController extends Controller
    {
        public function sendMailAction()
        {
            // ...
        }
    }

Sending the Mail
----------------

When you created your e-mail model, you can use the integrated mailer processor which is
responsible for sending the e-mail and persisting it to the database (which also creates the needed
contexts to customers, users, and so on):

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Controller/EmailController.php
    namespace Acme\DemoBundle\Controller;

    // ...

    class EmailController extends Controller
    {
        public function sendMailAction()
        {
            // ...
            $email = ...;

            $processor = $this->get('oro_email.mailer.processor');
            $processor->process($email);
        }
    }

When calling the :method:`Oro\\Bundle\\EmailBundle\\Mailer\\Processor::process` the mailer
processor performs the following steps:

#. It creates a new ``\Swift_Message`` instance and populate it with the data from your ``Email``
   object.

#. If you did not pass an ``EmailOrigin`` object which should be used to associate the mail in the
   user interface with, the processor will create on based on the sender address and the selected
   organization.

#. The e-mail will be sent based on your application's `SwiftMailer configuration`_ (if the current
   user configured a custom SMTP server in their settings, the configured server will be used
   instead).

#. The sent e-mail is persisted to the database storing all necessary information to be able to
   view it again in the future through the user interface.

#. All the persisted data is returned as an instance of the
   :class:`Oro\\EmailBundle\\Entity\\EmailUser`.

E-Mail Notifications
--------------------

Sometimes you want to receive e-mails when entities of a particular class are written to the
database. To achieve this OroPlatform comes with the NotificationBundle. This bundle registers
an event listener that is executed whenever a Doctrine entity is created, updated or removed.

To be notified by such an event, you have to create an
:class:`Oro\\Bundle\\NotificationBundle\\Entity\\EmailNotification` that contains all the necessary
information. The easiest way to register a new `EmailNotification` is to create data fixtures:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Migrations/Data/ORM/CreateCommentNotification.php
    namespace Acme\DemoBundle\Migrations\Data\ORM;

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;
    use Oro\Bundle\NotificationBundle\Entity\EmailNotification;
    use Oro\Bundle\NotificationBundle\Entity\RecipientList;

    class CreateCommentNotification extends AbstractFixture
    {
        public function load(ObjectManager $manager)
        {
            $notification = new EmailNotification();

            // the FQCN of the entity
            $notification->setEntityName('Acme\DemoBundle\Entity\Comment');

            // the event to be notified of, pre-defined event names are
            // oro.notification.event.entity_post_update, oro.notification.event.entity_post_remove
            // and oro.notification.event.entity_post_persist
            $eventRepository = $manager->getRepository('Oro\Bundle\NotificationBundle\Entity\Event');
            $event = $eventRepository->findOneByName('oro.notification.event.entity_post_persist');
            $notification->setEvent($event);

            // recipients must be an instance of Oro\Bundle\NotificationBundle\Entity\RecipientList
            // which represents a collection of recipients, each recipient can either be an e-mail
            // address, a User object, or a Group object
            $recipients = new RecipientList();
            $groupRepository = $manager->getRepository('Oro\Bundle\UserBundle\Entity\Group');
            $group = $groupRepository->findOneByName('Moderator');
            $recipients->addGroup($group);

            $notification->setRecipientList($recipients);

            // the EmailTemplate that is used to render the e-mail body
            $emailTemplateRepository = $manager->getRepository('Oro\Bundle\EmailBundle\Entity\EmailTemplate');
            $template = $emailTemplateRepository->findByName('comment_created_notification');
            $notification->setTemplate($template);

            $manager->persist($notification);
            $manager->flush();
        }
    }

.. _`SwiftMailer configuration`: http://symfony.com/doc/current/reference/configuration/swiftmailer.html

:title: Backend Emails Configuration in OroCommerce, OroCRM, OroPlatform

.. meta::
   :description: Emails and templates configuration manuals for the backend developers

.. _dev-emails:

Emails
======

.. index::
    single: E-Mails

Email Templates
---------------

Communicating with customers is an important part of every business. In OroPlatform, an email
address is represented by the :class:`Oro\\Bundle\\EmailBundle\\Entity\\EmailAddress` class.

When creating emails, your may reuse the text that is frequently sent for
a certain purpose. For this, they can create templates and reuse them as needed. Besides letting
the users create and manage templates through the UI, every bundle can provide their own email
templates.

Providing e-mail templates is nothing more than creating Twig templates for the desired format
(namely HTML or plaintext) in which you can use some pre-defined placeholders to define template
metadata. Then you create a data fixture that implements the ``AbstractEmailFixture`` class. This
class provides a ``getEmailsDir()`` method which should return the path of the directory that
contains your templates:

.. code-block:: php
    :linenos:

    // src/Acme/Bundle/DemoBundle/DataFixtures/ORM/EmailTemplatesFixture.php
    namespace Acme\Bundle\DemoBundle\DataFixtures\ORM;

    use Oro\Bundle\EmailBundle\Migrations\Data\ORM\AbstractEmailFixture;

    class EmailTemplatesFixture extends AbstractEmailFixture
    {
        public function getEmailsDir()
        {
            return $this->container
                ->get('kernel')
                ->locateResource('@AcmeDemoBundle/Resources/emails');
        }
    }

The format of the email template is determined based on the filename extension you use:

=========================  =============
Extension                  E-Mail Format
=========================  =============
``.html.twig``, ``.html``  HTML
``.txt.twig``, ``.txt``    Plaintext
=========================  =============

HTML is used as the default format if none could be derived from the filename extension.

Template Metadata
~~~~~~~~~~~~~~~~~

Additionally to the e-mail body, the template must contain some special parameters to add some
metadata to the template:

+-----------------+-----------+------------------------------------------------------------------------+
| Parameter       | Mandatory | Description                                                            |
+=================+===========+========================================================================+
| ``@entityName`` | yes       | The fully-qualified class name of the e-mail owner entity (for example |
|                 |           | ``Acme\Bundle\DemoBundle\Entity\Applicant``).                          |
+-----------------+-----------+------------------------------------------------------------------------+
| ``@subject``    | yes       | The e-mail subject.                                                    |
+-----------------+-----------+------------------------------------------------------------------------+
| ``@name``       | no        | The template name that is visible in the UI (the filename without the  |
|                 |           | extension is used when this parameter is not set).                     |
+-----------------+-----------+------------------------------------------------------------------------+
| ``@isSystem``   | no        | Set it to ``1`` to indicate that this is a system template.            |
+-----------------+-----------+------------------------------------------------------------------------+
| ``@isEditable`` | no        | If set to ``1`` and ``@isSystem`` is ``1`` too, the template can be    |
|                 |           | edited in the user interface.                                          |
+-----------------+-----------+------------------------------------------------------------------------+

.. note:: The details on template variables are described in details in the |relevant documentation|.

Sending Emails
--------------

Create an Email
~~~~~~~~~~~~~~~

An email that is created and sent by OroPlatform is centered around the
:class:`Oro\\Bundle\\EmailBundle\\Form\\Model\\Email` model class which reflects all the properties
of an email.

There are two ways to create a new email:

#. :ref:`Manually create an email <book-sending-emails-manually>`
#. :ref:`Use the email builder class <book-sending-emails-builder>`

.. _book-sending-emails-manually:

Create an Email Manually
^^^^^^^^^^^^^^^^^^^^^^^^

You can manually create an email by creating a new instance of the ``Email`` model class and call
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
            $email->setTo(['alice@example.com', 'bob@example.com']);

            // CC recipient(s)
            $email->setCc(['dave@example.com', 'eric@example.com']);

            // BCC recipient(s)
            $email->setBcc(['ryan@example.com', 'jonathan@example.com']);

            // the subject
            $email->setSubject(...);

            // a template to create the email body, the passed template
            // must be an instance of Oro\Bundle\EmailBundle\Entity\EmailTemplate
            $email->setTemplate(...);

            // a context that will be passed to the template set with setTemplate()
            $email->setContexts([...]);

            // the email type (either html or text)
            $email->setType(...);

            // as an alternative to using a template (see above) you can also
            // directly set the email body
            $email->setBody(...);

            // email attachments (instances of  Oro\Bundle\EmailBundle\Form\Model\EmailAttachment
            $email->addAttachment($attachment);

            // ...
        }
    }

.. _book-sending-emails-builder:


The ``EmailModelBuilder`` Class
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

An alternative approach to manually creating ``Email`` models is to use the
|EmailModelBuilder| helper class which offers several
methods to create new emails based on existing data:

|createEmailModel|
    Create a new email or add missing data to an existing email.

|createReplyEmailModel|
    Create an email that is a response to an existing email.

|createReplyAllEmailModel|
    Create an email that is a response to all recipients and the sender of an existing email.

|createForwardEmailModel|
    Create a new email that forwards an existing email.

After emails have been processed (see below), they will be persisted to the database. You can
create an email model based on such a persisted entity, by using the useful
|EmailModelBuilder| helper class:

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

Send the Email
~~~~~~~~~~~~~~

When you created your email model, you can use the integrated mailer processor which is
responsible for sending the email and persisting it to the database (which also creates the needed
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

#. The email will be sent based on your application's |SwiftMailer configuration| (if the current
   user configured a custom SMTP server in their settings, the configured server will be used
   instead).

#. The sent email is persisted to the database storing all necessary information to be able to
   view it again in the future through the user interface.

#. All the persisted data is returned as an instance of the `Oro\\EmailBundle\\Entity\\EmailUser`.

Receive Email Notifications
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Sometimes you want to receive emails when entities of a particular class are written to the
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
            // which represents a collection of recipients, each recipient can either be an email
            // address, a User object, or a Group object
            $recipients = new RecipientList();
            $groupRepository = $manager->getRepository('Oro\Bundle\UserBundle\Entity\Group');
            $group = $groupRepository->findOneByName('Moderator');
            $recipients->addGroup($group);

            $notification->setRecipientList($recipients);

            // the EmailTemplate that is used to render the email body
            $emailTemplateRepository = $manager->getRepository('Oro\Bundle\EmailBundle\Entity\EmailTemplate');
            $template = $emailTemplateRepository->findByName('comment_created_notification');
            $notification->setTemplate($template);

            $manager->persist($notification);
            $manager->flush();
        }
    }

Email Address Owners
--------------------

Each email address is owned by exactly one entity. In OroPlatform, ``User`` entities and
``Contact`` entities can be owners of an email address. Supposed you want to use the CRM to keep
track of all people that apply to your company. You will then probably create an ``Applicant``
entity and want to associate an email address to each of them. To let your own entities own an
email address, you have to follow a few steps:

#. :ref:`Create an entity that is responsible for storing the email address. <book-emails-emailinterface>`
#. :ref:`Create a new owner of an email address. <book-emails-owner>`
#. :ref:`Publish a provider <book-emails-owner-provider>` that makes it possible to search for the
   owner of a particular email address.
#. :ref:`Update the database schema and clear the cache <book-emails-schema-cache>`.

.. _book-emails-emailinterface:

Implement the Email Entity
~~~~~~~~~~~~~~~~~~~~~~~~~~

Each entity owning an email address must have its own email entity that implements the
:class:`Oro\\Bundle\\EmailBundle\\Entity\\EmailInterface`. This interface defines four methods:

``getEmailField()``
    Returns the name of the database table column that holds the actual email address.

``getId()``
    A unique identifier to find a particular email address entity in the database.

``getEmail()``
    This method returns the actual email address.

``getEmailOwner()``
    The entity that owns a certain email address.

Sample ``Email`` entity:

.. code-block:: php
    :linenos:

    // src/Acme/Bundle/DemoBundle/Entity/ApplicantEmail.php
    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EmailBundle\Entity\EmailInterface;

    /**
     * @ORM\Entity()
     */
    class ApplicantEmail implements EmailInterface
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer", name="id")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $email;

        /**
         * @ORM\ManyToOne(targetEntity="Applicant", inversedBy="emails")
         */
        private $applicant;

        public function getEmailField()
        {
            return 'email';
        }

        public function getId()
        {
            return $this->id;
        }

        public function getEmail()
        {
            return $this->email;
        }

        public function getEmailOwner()
        {
            return $this->applicant;
        }
    }

.. _book-emails-owner:

An Email Owner
~~~~~~~~~~~~~~

The entity that is the owner of the email address has to implement the
:class:`Oro\\Bundle\\EmailBundle\\Entity\\EmailOwnerInterface`:

``getClass()``
    The fully qualified class name of the entity.

``getEmailFields()``
    A list of properties of the entity that represent valid email addresses. You can specify more
    than one property here.

``getId()``
    A unique identifier to identify a particular owner entity.

``getFirstName()``
    The first name of the email address owner. It will be used to build proper recipient names
    when sending emails.

``getLastName()``
    The last name of the email address owner. It will be used to build proper recipient names
    when sending emails.

For ``Applicant`` entity, the implementation should be similar to the following:

.. code-block:: php
    :linenos:

    // src/Acme/Bundle/DemoBundle/Entity/Applicant.php
    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EmailBundle\Entity\EmailOwnerInterface;

    /**
     * @ORM\Entity()
     */
    class Applicant implements EmailOwnerInterface
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer", name="id")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        private $id;

        /**
         * @ORM\OneToMany(targetEntity="ApplicantEmail", mappedBy="applicant", orphanRemoval=true, cascade={"persist"})
         */
        private $emails;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $firstName;

        /**
         * @ORM\Column(type="string", length=255)
         */
        private $lastName;

        public function getClass()
        {
            return 'Acme\Bundle\DemoBundle\Entity\Applicant';
        }

        public function getEmailFields()
        {
            return ['email'];
        }

        public function getId()
        {
            return $this->id;
        }

        public function getEmails()
        {
            return $this->emails;
        }

        public function getFirstName()
        {
            return $this->firstName;
        }

        public function getLastName()
        {
            return $this->lastName;
        }
    }

.. _book-emails-owner-provider:

Implement ``EmailOwnerProviderInterface``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In order to make the application able to find the owner of a certain email address, you have to
create a provider that implements the
:class:`Oro\\Bundle\\EmailBundle\\Entity\\Provider\\EmailOwnerProviderInterface`. This interface
contains two methods:

``getEmailOwnerClass()``
    This is the class of the email owner entity (the class implementing the
    ``EmailOwnerInterface`` which is the ``Applicant`` class in the example above).

``findEmailOwner()``
    Returns an entity that is the owner of an email address or ``null`` if no such owner exists.
    The returned object must be an instance of the class specified by ``getEmailOwnerClass()``.

The provider class should then look like this:

.. code-block:: php
    :linenos:

    // src/Acme/Bundle/DemoBundle/Entity/Provider/EmailOwnerProvider.php
    namespace Acme\Bundle\DemoBundle\Entity\Provider;

    use Acme\Bundle\DemoBundle\Entity\ApplicantEmail;
    use Doctrine\ORM\EntityManager;
    use Oro\Bundle\EmailBundle\Entity\Provider\EmailOwnerProviderInterface;

    class EmailOwnerProvider implements EmailOwnerProviderInterface
    {
        public function getEmailOwnerClass()
        {
            return 'Acme\Bundle\DemoBundle\Entity\Applicant';
        }

        public function findEmailOwner(EntityManager $em, $email)
        {
            $applicantEmailRepo = $em->getRepository('AcmeDemoBundle:ApplicantEmail');
            /** @var ApplicantEmail $applicantEmail */
            $applicantEmail = $applicantEmailRepo->findOneBy(['email' => $email]);

            if (null !== $applicantEmail) {
                return $applicantEmail->getEmailOwner();
            }

            return null;
        }
    }

You then need to create a service for the new ``EmailOwnerProvider`` class and tag it with the
``oro_email.owner.provider`` tag to make the application aware of the new email provider:

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/config/services.yml
    services:
        acme_demo.provider.email_owner_provider:
            class: Acme\Bundle\DemoBundle\Entity\Provider\EmailOwnerProvider
            tags:
                - { name: oro_email.owner.provider, order: 3 }

.. _book-emails-schema-cache:

Refresh the Database Schema
~~~~~~~~~~~~~~~~~~~~~~~~~~~

Finally, you have to update the database schema and clear the application cache:

.. code-block:: bash

    # update the database schema
    $ php bin/console doctrine:schema:update --force

    # warm up the application cache
    $ php bin/console cache:warmup

.. include:: /include/include-links-dev.rst
   :start-after: begin
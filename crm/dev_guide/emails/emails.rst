.. index::
    single: E-Mails

Working with E-Mails
====================

Communicating with customers is an important part of every business. In OroPlatform, an e-mail
address is represented by the :class:`Oro\\Bundle\\EmailBundle\\Entity\\EmailAddress` class.

E-Mail Templates
----------------

When creating e-mails, your may reuse the text that is frequently sent for
a certain purpose. For this, they can create templates and reuse them as needed. Besides letting
the users create and manage templates through the UI, every bundle can provide their own e-mail
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

Template Variables
~~~~~~~~~~~~~~~~~~

E-Mail Address Owners
---------------------

Each e-mail address is owned by exactly one entity. In OroPlatform, ``User`` entities and
``Contact`` entities can be owners of an e-mail address. Supposed you want to use the CRM to keep
track of all people that apply to your company. You will then probably create an ``Applicant``
entity and want to associate an e-mail address to each of them. To let your own entities own an
e-mail address, you have to follow a few steps:

#. :ref:`Create an entity that is responsible for storing the e-mail address. <book-emails-emailinterface>`
#. :ref:`Create a new owner of an e-mail address. <book-emails-owner>`
#. :ref:`Publish a provider <book-emails-owner-provider>` that makes it possible to search for the
   owner of a particular e-mail address.
#. :ref:`Update the database schema and clear the cache <book-emails-schema-cache>`.

.. _book-emails-emailinterface:

Implementing the E-Mail Entity
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Each entity owning an e-mail address must have its own e-mail entity that implements the
:class:`Oro\\Bundle\\EmailBundle\\Entity\\EmailInterface`. This interface defines four methods:

``getEmailField()``
    Returns the name of the database table column that holds the actual e-mail address.

``getId()``
    A unique identifier to find a particular e-mail address entity in the database.

``getEmail()``
    This method returns the actual e-mail address.

``getEmailOwner()``
    The entity that owns a certain e-mail address.

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

The E-Mail Owner
~~~~~~~~~~~~~~~~

The entity that is the owner of the e-mail address has to implement the
:class:`Oro\\Bundle\\EmailBundle\\Entity\\EmailOwnerInterface`:

``getClass()``
    The fully qualified class name of the entity.

``getEmailFields()``
    A list of properties of the entity that represent valid e-mail addresses. You can specify more
    than one property here.

``getId()``
    A unique identifier to identify a particular owner entity.

``getFirstName()``
    The first name of the e-mail address owner. It will be used to build proper recipient names
    when sending e-mails.

``getLastName()``
    The last name of the e-mail address owner. It will be used to build proper recipient names
    when sending e-mails.

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
            return array('email');
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

Implementing the ``EmailOwnerProviderInterface``
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In order to make the application able to find the owner of a certain e-mail address, you have to
create a provider that implements the
:class:`Oro\\Bundle\\EmailBundle\\Entity\\Provider\\EmailOwnerProviderInterface`. This interface
contains two methods:

``getEmailOwnerClass()``
    This is the class of the e-mail owner entity (the class implementing the
    ``EmailOwnerInterface`` which is the ``Applicant`` class in the example above).

``findEmailOwner()``
    Returns an entity that is the owner of an e-mail address or ``null`` if no such owner exists.
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
            $applicantEmail = $applicantEmailRepo->findOneBy(array('email' => $email));

            if (null !== $applicantEmail) {
                return $applicantEmail->getEmailOwner();
            }

            return null;
        }
    }

You then need to create a service for the new ``EmailOwnerProvider`` class and tag it with the
``oro_email.owner.provider`` tag to make the application aware of the new e-mail provider:

.. code-block:: yaml
    :linenos:

    # src/Acme/Bundle/DemoBundle/Resources/config/services.yml
    services:
        acme_demo.provider.email_owner_provider:
            class: Acme\Bundle\DemoBundle\Entity\Provider\EmailOwnerProvider
            tags:
                - { name: oro_email.owner.provider, order: 3 }

.. _book-emails-schema-cache:

Refreshing the Database Schema
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Finally, you have to update the database schema and clear the application cache:

.. code-block:: bash

    # update the database schema
    $ php app/console doctrine:schema:update --force

    # warm up the application cache
    $ php app/console cache:warmup

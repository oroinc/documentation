.. _bundle-docs-platform-email-bundle-templates-attachments:

Email Templates Attachments
===========================

OroEmailBundle provides the ability to add *email template attachments* to an *email template*. *Email template attachment* is converted into an *email attachment* when an email is sent.

*Email template attachment* is represented by the ``\Oro\Bundle\EmailBundle\Entity\EmailTemplateAttachment`` entity. It is referenced via one-to-many *attachments* association by the ``\Oro\Bundle\EmailBundle\Entity\EmailTemplate`` and ``\Oro\Bundle\EmailBundle\Entity\EmailTemplateTranslation`` entities.

*Email template attachment* entity contains either of the following:

- an explicitly uploaded file in the *file* field;
- a file placeholder, i.e. an *entity variable* that references a file, image, multiFile, or a multiImage field. For example, ``{{ entity.avatar }}``.

.. note:: More about email template entity variables can be found in :ref:`Email Templates Rendering Sandbox <bundle-docs-platform-email-bundle-templates-rendering-sandbox>`.

Email Template Attachments Import
---------------------------------

When an email template is imported, either from data fixtures or from the command line via ``oro:email:template:import`` Symfony command, its attachments are imported as well. Attachments are defined in the *attachments* metadata parameter of an email template. See :ref:`Email Templates Migrations <bundle-docs-platform-email-bundle-templates-migrations>` for more details. For example:

.. code-block:: twig

    {# @name = hello_user #}
    {# @entityName = Oro\Bundle\UserBundle\Entity\User #}
    {# @subject = Hello {{ entity.username }} #}
    {# @attachments = ["{{ entity.avatar }}", "JVBERi0xLjQKJcfs..."] #}

Email template metadata parameter is always parsed as a scalar value by the ``\Oro\Bundle\EmailBundle\EmailTemplateHydrator\EmailTemplateRawDataParser``, so in order to convert attachment to an entity, the bundle declares the ``\Oro\Bundle\EmailBundle\EventListener\CreateEmailTemplateAttachmentFromRawDataListener`` that listens to the ``\Oro\Bundle\EmailBundle\Event\EmailTemplateFromArrayHydrateBeforeEvent`` event and creates an ``EmailTemplateAttachment`` entity for each item in the *attachments* metadata parameter.

.. hint:: You can create your own listener for ``\Oro\Bundle\EmailBundle\Event\EmailTemplateFromArrayHydrateBeforeEvent`` to preprocess the metadata parameters in your own way before they are set to an email template entity.

Available Email Template Attachments
------------------------------------

OroEmailBundle provides the ``\Oro\Bundle\EmailBundle\Twig\EmailTemplateAttachmentVariablesProvider`` that allows to get the list of *email template attachments* available in an *email template* for a given *entity class*. It iterates through all entity variables and filters only those that reference a file, image, multiFile or multiImage field.

.. note:: The default maximum depth for traversing entity variables is 1, which means that only direct entity fields are considered. You can change it via the ``setMaxDepth`` method of the provider.

.. hint:: If an entity does not have a regular field for email template attachment, you can define a virtual entity variable that references a file via ``\Oro\Bundle\EntityBundle\Twig\Sandbox\EntityVariablesProviderInterface`` and ``\Oro\Bundle\EntityBundle\Twig\Sandbox\VariableProcessorInterface``. See :ref:`Extending Available Data in Email Templates <bundle-docs-platform-email-bundle-templates-rendering-sandbox>` for more details.

Email Template Attachments Processing
-------------------------------------

*Email template attachment* isprocessed during the rendering of an *email template* by the ``\Oro\Bundle\EmailBundle\Provider\EmailRenderer``. Under-the-hood, it delegates the processing of each *email template attachment* to the ``\Oro\Bundle\EmailBundle\Twig\EmailTemplateAttachmentProcessor`` processor. The processor resolves a *file placeholder* to a file entity or uses the explicitly uploaded file (if any).

When an email is sent, each *email template attachment* is converted into an *email attachment* by the ``\Oro\Bundle\EmailBundle\Factory\EmailAttachmentModelFromEmailTemplateAttachmentFactory`` and ``\Oro\Bundle\EmailBundle\Factory\EmailAttachmentEntityFromEmailTemplateAttachmentFactory`` factories. The former creates a model that represents an email attachment in the *Send Email* form, the latter creates an entity that represents the sent email attachment in the database. Both are used by the ``\Oro\Bundle\EmailBundle\Factory\EmailModelFromEmailTemplateFactory`` class that is responsible for creating an email model from an email template. See :ref:`Sending an Email Created from an Email Template <bundle-docs-platform-email-bundle-templates-send>` for more details.


.. include:: /include/include-links-dev.rst
    :start-after: begin

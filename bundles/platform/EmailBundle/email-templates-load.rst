.. _bundle-docs-platform-email-bundle-templates-loading:

Loading an Email Template
=========================

OroEmailBundle has ``\Oro\Bundle\EmailBundle\Provider\EmailTemplateProvider`` as an entry point to email template loading. It expects an email template name or ``\Oro\Bundle\EmailBundle\Model\EmailTemplateCriteria`` DTO and `email template context`. Returns an instance of ``\Oro\Bundle\EmailBundle\Model\EmailTemplate`` ready to be rendered via ``\Oro\Bundle\EmailBundle\Provider\EmailRenderer``.

Implementation Overview
-----------------------

``\Oro\Bundle\EmailBundle\Provider\EmailTemplateProvider`` under the hood gets the list of email template candidates names ordered by priority and passes it to `email template loaders`.

Email Template Context
----------------------

In order to load the most relevant email template the application takes into account the following `email template context` parameters:

- `localization` - implemented in OroEmailBundle, determines the translation of an email template
- `website` - implemented in OroMultiWebsiteBundle, allows to load a website-specific email template

In most cases, an `email template context` should be collected by ``\Oro\Bundle\EmailBundle\Provider\EmailTemplateContextProvider`` before an email template is loaded and rendered. It dispatches the event ``\Oro\Bundle\EmailBundle\Event\EmailTemplateContextCollectEvent`` that contains the following data:

- ``\Oro\Bundle\EmailBundle\Model\From $from``: sender
- ``array<\Oro\Bundle\EmailBundle\Model\EmailHolderInterface> $recipients``: recipients
- ``\Oro\Bundle\EmailBundle\Model\EmailTemplateCriteria $emailTemplateCriteria``: name and entity class name of an email template
- ``array $templateParams``: template parameters (i.e., variables) which will be passed to the TWIG engine during rendering

Based on the data above, email template context listeners fill the event with context parameters via the `setTemplateContextParameter` method. Out-of-the-box,  listener ``\Oro\Bundle\EmailBundle\EventListener\EmailTemplateContextCollectLocalizationAwareEventListener`` detects the preferred localization in which a recipient should receive an email.

.. note:: If you cannot rely on an automatic collection of an `email template context`, provide it explicitly to ``\Oro\Bundle\EmailBundle\Provider\EmailTemplateProvider``.

Email Template Candidates
-------------------------

The ``\Oro\Bundle\EmailBundle\EmailTemplateCandidates\EmailTemplateCandidatesProvider`` provides the list of email template candidates' names wthat can be loaded by email template loaders. Internally, it calls the inner providers implementing the ``\Oro\Bundle\EmailBundle\EmailTemplateCandidates\EmailTemplateCandidatesProviderInterface``. These providers are collected through the service container tag `oro_email.email_template_candidates_provider`.

Out-of-the-box, ``\Oro\Bundle\EmailBundle\EmailTemplateCandidates\DatabaseEmailTemplateCandidatesProvider`` provides the candidates names with `@db` namespace, taking into account the entity name from the given email template criteria and all context parameters. Example:

.. code-block:: php


    use Oro\Bundle\EmailBundle\EmailTemplateCandidates\EmailTemplateCandidatesProvider;
    use Oro\Bundle\UserBundle\Entity\User;

    // ...

    $emailTemplateCriteria = new EmailTemplateCriteria('invite_user', User::class);
    $templateContext = [
        'localization' => $localization, // let's assume is is a Localization entity with id 42
    ];
    /* @var EmailTemplateCandidatesProvider $emailTemplateCandidatesProvider */
    $emailTemplateCandidates = $emailTemplateCandidatesProvider
        ->getCandidatesNames($emailTemplateCriteria, $templateContext);
    // Variable $emailTemplateCandidates would contain at least the following:
    // [
    //     '@db:entityName=Oro\Bundle\UserBundle\Entity\User&localization=42/invite_user',
    // ]

.. note:: More email template candidates providers are implemented in :ref:`OroFrontendBundle <bundle-docs-commerce-customer-portal-frontend-bundle-email-templates>` and :ref:`OroMultiWebsiteBundle <bundle-docs-platform-email-bundle-template>`.

Email Template Loaders
----------------------

Email template loaders are responsible for loading email templates from different sources, such as, a database (out-of-the-box) or a filesystem. Email template loaders implement ``\Oro\Bundle\EmailBundle\Twig\EmailTemplateLoader\EmailTemplateLoaderInterface`` which extends ``\Twig\Loader\LoaderInterface`` with the `getEmailTemplate` method.

The main email template loader is ``\Oro\Bundle\EmailBundle\Twig\EmailTemplateLoader\EmailTemplateChainLoader`` which calls inner loaders collected by the service container tag `oro_email.twig.email_template_loader`. Out-of-the-box, ``\Oro\Bundle\EmailBundle\Twig\EmailTemplateLoader\DatabaseEmailTemplateLoader`` loads the email templates  from the database with the `@db` namespace (i.e., provided by ``\Oro\Bundle\EmailBundle\EmailTemplateCandidates\DatabaseEmailTemplateCandidatesProvider``).

.. note:: More `email template loaders` are implemented in :ref:`OroFrontendBundle <bundle-docs-commerce-customer-portal-frontend-bundle-email-templates>` and :ref:`OroMultiWebsiteBundle <bundle-docs-commerce-multi-website-bundle-email-templates>`.

.. include:: /include/include-links-dev.rst
    :start-after: begin

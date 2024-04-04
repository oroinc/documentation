.. _bundle-docs-commerce-customer-portal-frontend-bundle-email-templates:

Email Templates
===============

OroFrontendBundle extends :ref:`Email Templates Inheritance feature <bundle-docs-platform-email-bundle-templates-inheritance>` with the ability to load email templates from the current layout theme.

Implementation Overview
-----------------------

OroFrontendBundle implements the email template candidates provider ``\Oro\Bundle\FrontendBundle\EmailTemplateCandidates\LayoutThemeAwareEmailTemplateCandidatesProvider`` that is added to the chain in ``\Oro\Bundle\EmailBundle\EmailTemplateCandidates\EmailTemplateCandidatesProvider``. It provides the email template candidate name with the `@theme` namespace and the current layout theme name in parameters, for example `@theme:name=default/order_confirmation_email`.

Email templates with the `@theme` namespace are handled by email template loader ``\Oro\Bundle\LayoutBundle\Twig\EmailTemplateLoader\LayoutThemeEmailTemplateLoader``.

Layout Theme Email Template Loader
----------------------------------

Email template loader ``\Oro\Bundle\LayoutBundle\Twig\EmailTemplateLoader\LayoutThemeEmailTemplateLoader`` extends ``\Twig\Loader\FilesystemLoader`` with the ability to handle `@theme` namespace and parse parameters from template name. Under the hood, it converts names like the following `@theme:name=default/order_confirmation_email` into `@default/order_confirmation_email.html.twig`, where `default` is a namespace named with a layout theme name and understandable by inner ``\Twig\Loader\FilesystemLoader``.

To make ``\Oro\Bundle\LayoutBundle\Twig\EmailTemplateLoader\LayoutThemeEmailTemplateLoader`` aware of available email templates, their paths are collected in ``\Oro\Bundle\LayoutBundle\DependencyInjection\OroLayoutExtension`` by the following patterns:

- `%twig.default_path%/layouts/%theme_name%/email-templates/`, where `%twig.default_path%` is a service container parameters that is by default equal to `%kernel.project_dir%/templates`
- `%bundle_dir%/Resources/views/layouts/%theme_name%/email-templates/`

Limitations
-----------

- Email templates loaded from a layout theme cannot be translated.
- Email template uniqueness cannot be guaranteed. The email template with the highest priority is the one found in the application templates directory or, if it does not exist, then the one found in a bundle.

.. include:: /include/include-links-dev.rst
    :start-after: begin

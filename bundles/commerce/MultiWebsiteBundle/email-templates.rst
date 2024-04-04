.. _bundle-docs-commerce-multi-website-bundle-email-templates:

Email Templates
===============

OroMultiWebsiteBundle extends the :ref:`Email Templates feature <bundle-docs-platform-email-bundle-template>` with the ability to differentiate email templates by a website.

Implementation Overview
-----------------------

OroMultiWebsiteBundle adds the `one-to-one` `website` field to ``\Oro\Bundle\EmailBundle\Entity\EmailTemplate`` entity class and updates its unique constraint to `name`, `entityName`, `website_id` columns. Field `website` is empty and disabled for system email templates to ensure there will always be an email template suitable for any website. A user can clone a system email template and specify a website to make a website-specific email template.

To prioritize website-specific email templates, use email template candidates provider ``\Oro\Bundle\MultiWebsiteBundle\EmailTemplateCandidates\LayoutThemeAwareEmailTemplateCandidatesProvider`` added to the chain in ``\Oro\Bundle\EmailBundle\EmailTemplateCandidates\EmailTemplateCandidatesProvider``. It provides the email template candidates' names with `@db` namespace and the current website ID in parameters, for example, `@db:website=101/order_confirmation_email` and `@db/order_confirmation_email.`

.. include:: /include/include-links-dev.rst
    :start-after: begin

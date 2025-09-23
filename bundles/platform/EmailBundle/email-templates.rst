.. _bundle-docs-platform-email-bundle-template:

Email Templates
===============

Email template is a predefined email content that can be used to send emails. They can contain variables (placeholders) that are replaced with actual values when the email is sent.

Email template can be created and managed in the following ways:

- in the UI via **System > Emails > Templates**,
- programmatically via data fixtures. See :ref:`Email Templates Migrations <bundle-docs-platform-email-bundle-templates-migrations>` ,
- from the command line via ``oro:email:template:import`` Symfony command. See :ref:`Commands <bundle-docs-platform-email-bundle-commands>`.

Before an email is sent, a corresponding email template is rendered using the |Twig Templating Engine| in a separate sandbox environment. See :ref:`Email Templates Rendering <bundle-docs-platform-email-bundle-templates-rendering>` and :ref:`Email Templates Rendering Sandbox <bundle-docs-platform-email-bundle-templates-rendering-sandbox>` for the internals.

Related Documentation
---------------------

.. toctree::
   :maxdepth: 1

   email-templates-load
   email-templates-rendering
   email-templates-rendering-sandbox
   email-templates-inheritance
   email-templates-send
   email-templates-migrations
   email-templates-attachments

.. include:: /include/include-links-dev.rst
    :start-after: begin

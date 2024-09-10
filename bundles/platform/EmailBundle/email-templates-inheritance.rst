.. _bundle-docs-platform-email-bundle-templates-inheritance:

Email Templates Inheritance
===========================

.. note:: Email Templates Inheritance feature is available as of OroCommerce version 6.0.3.

Email Templates Inheritance feature provides the ability to extend an email template from another email template. This feature enables you to have multiple email templates that share the same base email template, which includes common styles, header, footer, etc.

Implementation Overview
-----------------------

This feature includes the TWIG engine which is used to produce email templates. It allows the `extends` TWIG tag to be used in the content of an email template, making it possible to extend email templates located in a database (provided by default) or other sources supported by email template loaders.

OroEmailBundle provides a TWIG function `oro_get_email_template` to be used within the `extends` TWIG tag. Under the hood, this TWIG function automatically detects the current `email template context` and generates a list of email template candidates' names. The names of email template candidates' are ordered by priority, so the most relevant option is placed at the top of the list and will be used by the `extends` tag.

Usage example:

.. code-block:: twig


    {# @name = hello_user #}
    {# @entityName = Oro\Bundle\UserBundle\Entity\User #}
    {# @subject = Subject {{ entity.username }} #}

    {% extends oro_get_email_template('base') %}

    {# Block "content" must be defined in the parent template "base" #}
    {% block content %}
        <h1>Hello {{ entity.username }}</h1>
    {% endblock %}



Email template candidate names are provided by ``\Oro\Bundle\EmailBundle\EmailTemplateCandidates\EmailTemplateCandidatesProvider``. `Email template context` is automatically collected by ``\Oro\Bundle\EmailBundle\Provider\EmailTemplateContextProvider``. For more information, see :ref:`How an Email Template is Loaded <bundle-docs-platform-email-bundle-templates-loading>`.

If you cannot rely on the automatic detection of the current `email template context`, you could explicitly provide context parameters via 2nd argument: the `extends` tag.

.. code-block:: twig


    {% extends oro_get_email_template('base', { localization: 42 }) %}


**Related Topics**

* :ref:`Email Templates Bundle documentation <bundle-docs-commerce-customer-portal-frontend-bundle-email-templates>`.

* :ref:`Configure Email Templates in the Back-Office <user-guide-using-emails-create-template>`.

.. include:: /include/include-links-dev.rst
    :start-after: begin

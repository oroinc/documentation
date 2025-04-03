.. _organization-ai-settings:

Configure AI Content Generation Settings per Organization
=========================================================

.. note:: This feature is available as of OroCommerce version 5.1.8.

Oro offers integration with AI services such as OpenAI and Vertex AI to create content for product descriptions, landing pages, content blocks, master catalog categories, and emails.

Once the :ref:`integration with the chosen AI client <user-guide-ai-integrations>` is created and established, you can configure AI integration settings in the system configuration :ref:`globally <admin-configuration-ai-integration-settings>` and per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > Integrations > AI Content Generation** in the menu to the left.

.. image:: /user/img/system/user_management/org_configuration/ai/ai-org-setting.png
   :alt: AI configuration setting on the organization level

4. In the **AI Content Generation Settings** section, clear the **Use System** checkbox and select the AI client of choice from the dropdown next to **AI Generator**. The selected AI client will be used to generate content throughout the application. Please make sure you have enough credits in your AI Generator account to be able to use it.

   Be aware that data from your website will be used by a third party to generate content.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

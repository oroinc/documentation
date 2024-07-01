.. _admin-configuration-ai-integration-settings:

Configure Global AI Content Generation Settings
===============================================

.. note:: This feature is available as of OroCommerce version 6.0.2.

Oro offers integration with AI services such as OpenAI and Vertex AI to create content for product descriptions, landing pages, content blocks, master catalog categories, and emails.

Once the :ref:`integration with the chosen AI client <user-guide-ai-integrations>` is created and established, you can configure AI integration settings in the system configuration globally and :ref:`per organization <organization-ai-settings>`:

1. Navigate to **System > Configuration** in the main menu.
2. In the menu to the left, click **System Configuration > Integrations > AI Content Generation**.
3. In the **AI Content Generation Settings** section, clear the **Use Default** checkbox next to *Enable AI Content Generation* to enable the feature.

.. image:: /user/img/system/config_system/ai-global-settings.png
   :alt: Global AI configuration settings

4. Select the AI client of choice from the dropdown next to **AI Generator**. The selected AI client will be used to generate content throughout the application. Please make sure you have enough credits in your AI Generator account to be able to use it.

   Be aware that data from your website will be used by a third party to generate content.

5. Click **Save Settings**.
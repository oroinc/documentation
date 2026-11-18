.. _organization-smart-brief-settings:

Configure AI Smart Brief Settings per Organization
==================================================

.. note:: The AI Smart Brief feature will be available in the Enterprise edition as of OroCommerce version 7.0.6.

:ref:`AI Smart Brief <concept-guide--ai--smart-brief>` shows a short AI-written summary with a list of key facts at the top of the back-office customer and request for quote view pages. You can configure AI Smart Brief settings :ref:`globally <admin-configuration-smart-brief-settings>` and per organization. The organization-level settings take precedence over the global settings for the selected organization.

The cache settings, **Cache Lifetime (seconds)** and **Refresh on Data Change**, are available only at the :ref:`global level <admin-configuration-smart-brief-settings>`.

Create an :ref:`integration with OpenAI or Vertex AI <user-guide-ai-integrations>` under **System > Integrations > Manage Integrations** before you begin.

.. warning:: OroCommerce sends business facts about customers and requests for quote to the selected AI provider. Review the :ref:`data sent to the AI provider <concept-guide--ai--smart-brief--data>` before you enable the feature.

To configure AI Smart Brief per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > Integrations > AI Smart Brief** in the menu to the left.
4. In the **AI Smart Brief Settings** section, clear the **Use System** checkbox next to **Enable AI Smart Brief** and select or clear the **Enable AI Smart Brief** checkbox.
5. Click **Save Settings**.

The page reloads. While the feature is disabled, the other options of the section are hidden. They appear after you enable the feature and save the settings.

6. Configure the following options. To change an option, clear the **Use System** checkbox next to it first.

   * **AI Integration** --- Select the OpenAI or Vertex AI integration that writes the summaries for this organization. If no integration is selected, or if the selected integration is disabled, no summary is shown.
   * **Customer Summary** --- Select this checkbox to show the summary on customer view pages.
   * **Request For Quote Summary** --- Select this checkbox to show the summary on request for quote view pages.
   * **Show Regenerate Button** --- Select this checkbox to show the |IcRefresh| **Regenerate** button in the block. Each click sends a new request to the AI provider.
   * **Expand by Default** --- Select this checkbox to open the block expanded on record pages. Users can change this option for themselves in the **Display Settings** section of :ref:`My Configuration <doc-my-user-configuration-profile>`.

7. Click **Save Settings**.

**Related Articles**

* :ref:`AI Smart Brief Concept Guide <concept-guide--ai--smart-brief>`
* :ref:`AI and Automation Concept Guide <concept-guide--ai>`
* :ref:`Configure Global AI Smart Brief Settings <admin-configuration-smart-brief-settings>`
* :ref:`Configure AI Integrations in the Back-Office <user-guide-ai-integrations>`
* :ref:`OroSmartBriefBundle <bundle-docs-extensions-smart-brief>`


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

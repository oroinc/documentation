:title: Configure Global AI Smart Brief Settings in the OroCommerce Back-Office

.. meta::
   :description: Learn how to enable AI Smart Brief on customer and request for quote view pages, select the AI integration, and configure the summary cache in the OroCommerce back-office.

.. _admin-configuration-smart-brief-settings:

Configure Global AI Smart Brief Settings
========================================

.. note:: Please |contact our support team| to learn more about OroCommerce Enterprise AI features, discuss how they can meet your business needs, and get started with implementation.

:ref:`AI Smart Brief <concept-guide--ai--smart-brief>` is available for OroCommerce Enterprise and shows a short summary at the top of the back-office customer and request for quote view pages. The block shows a short AI-written paragraph with a list of key facts next to it. OroCommerce computes the facts from its own data. The AI integration only turns these facts into a short paragraph.

You can configure AI Smart Brief settings globally and :ref:`per organization <organization-smart-brief-settings>`. The cache settings are available only at the global level.

Create an :ref:`integration with OpenAI or Vertex AI <user-guide-ai-integrations>` under **System > Integrations > Manage Integrations** before you begin.

.. warning:: OroCommerce sends business facts about customers and requests for quote to the selected AI provider. Review the :ref:`data sent to the AI provider <concept-guide--ai--smart-brief--data>` before you enable the feature.

Enable AI Smart Brief
---------------------

To enable AI Smart Brief globally:

1. Navigate to **System > Configuration** in the main menu.
2. In the menu to the left, click **System Configuration > Integrations > AI Smart Brief**.
3. In the **AI Smart Brief Settings** section, clear the **Use Default** checkbox next to **Enable AI Smart Brief** and select the **Enable AI Smart Brief** checkbox.
4. Click **Save Settings**.

The page reloads. While the feature is disabled, the other options of the section are hidden. They appear after you enable the feature and save the settings.

.. image:: /user/img/concept-guides/ai/ai-smart-brief-settings-global.png
   :alt: The AI Smart Brief global settings

5. Configure the following options. To change an option, clear the **Use Default** checkbox next to it first.

* **AI Integration** --- Select the OpenAI or Vertex AI integration that writes the summaries. If no integration is selected, or if the selected integration is disabled, no summary is shown.
* **Customer Summary** --- Select this checkbox to show the summary on customer view pages. This option is disabled by default.
* **Request For Quote Summary** --- Select this checkbox to show the summary on request for quote view pages. This option is disabled by default.
* **Cache Lifetime (seconds)** --- Enter how long a generated summary is reused before it is written again. The value must be a positive whole number. The default value is 14400 seconds (4 hours).
* **Refresh on Data Change** --- Select this checkbox to write a summary again as soon as the facts it is based on change. This option is enabled by default. For details, see `Choose the Refresh Mode`_.
* **Show Regenerate Button** --- Select this checkbox to show the |IcRefresh| **Regenerate** button in the block. The button lets users request a new summary immediately. Each click sends a new request to the AI provider. This option is disabled by default.
* **Expand by Default** --- Select this checkbox to open the block expanded on record pages. When a user expands or collapses the block, it keeps that state for the record until the facts of the record change. Users can change this option for themselves in the **Display Settings** section of :ref:`My Configuration <doc-my-user-configuration-profile>`. This option is enabled by default.

6. Click **Save Settings**.

.. _admin-configuration-smart-brief-settings--refresh-mode:

Choose the Refresh Mode
-----------------------

The **Refresh on Data Change** option controls how fresh the summaries are and how much work each page view costs.

* **Refresh on Data Change** is enabled --- OroCommerce collects the facts on every page view. If the facts have changed since the summary was written, OroCommerce requests a new summary from the AI provider. As a result, the summary always matches the current data, but every page view runs the fact queries.
* **Refresh on Data Change** is disabled --- OroCommerce reuses a cached summary without collecting the facts again. As a result, OroCommerce shows a cached summary without fact queries or an AI call, but the summary text and the facts in the block can be up to one cache lifetime old. Each user has their own cached summary in this mode because the facts depend on the user's permissions.

In both modes, a new summary requires a call to the AI provider. A shorter cache lifetime makes summaries fresher but increases the number of AI calls and the related provider costs.

.. note:: When **Refresh on Data Change** is disabled, changes to user permissions take effect in the summaries only after the cached summaries expire. For more information, see :ref:`Summaries and Permissions <concept-guide--ai--smart-brief--permissions>`.

**Related Articles**

* :ref:`AI Smart Brief Concept Guide <concept-guide--ai--smart-brief>`
* :ref:`AI and Automation Concept Guide <concept-guide--ai>`
* :ref:`Configure AI Smart Brief Settings per Organization <organization-smart-brief-settings>`
* :ref:`Configure AI Integrations in the Back-Office <user-guide-ai-integrations>`
* :ref:`OroSmartBriefBundle <bundle-docs-extensions-smart-brief>`


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

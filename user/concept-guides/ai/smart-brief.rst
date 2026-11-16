:title: AI Smart Brief for Customers and RFQs | OroCommerce

.. meta::
   :description: Learn how AI Smart Brief summarizes customers and requests for quote in the OroCommerce back-office with an AI-written paragraph and a list of key facts, which data it sends to the AI provider, and how to edit its prompts.

.. _concept-guide--ai--smart-brief:

AI Smart Brief
==============

.. note:: Please |contact our support team| to learn more about OroCommerce Enterprise AI features, discuss how they can meet your business needs, and get started with implementation.

AI Smart Brief is a back-office OroCommerce Enterprise feature that shows a short summary at the top of the customer and request for quote (RFQ) view pages. The summary helps a sales representative see the state of a customer account or an RFQ without opening the related grids.

OroCommerce computes every fact in the summary from its own data, such as dates, totals, statuses, counts, and price differences. The block shows the following:

* **AI summary** --- The selected AI provider, OpenAI or Vertex AI, turns the facts into a short paragraph.
* **Key facts** --- The list of the facts next to the paragraph, so you can compare the paragraph with the values that it is based on.

.. image:: /user/img/concept-guides/ai/ai-smart-brief-customers-rfq.png
   :alt: The AI Smart Brief blocks on the Customer A and RFQ view pages

To enable AI Smart Brief:

1. :ref:`Create an integration with OpenAI or Vertex AI <user-guide-ai-integrations>` under **System > Integrations > Manage Integrations**.
2. :ref:`Configure AI Smart Brief Settings Globally <admin-configuration-smart-brief-settings>` under **System > Configuration> System Configuration > Integrations > AI Smart Brief**

or

3. :ref:`Configure AI Smart Brief Settings per Organization <organization-smart-brief-settings>` under **System > User Management > Organizations > System Configuration > Integrations > AI Smart Brief**.

What the Block Shows
--------------------

The **AI Smart Brief** block loads after the record page opens, so the page does not wait for the summary. While the summary is being written, the block shows the *Writing the summary…* message.

The block is expanded by default. The administrator can change this default. You can change it for yourself in the **Display Settings** section of :ref:`My Configuration <doc-my-user-configuration-profile>`. To expand or collapse the block, click the arrow button in the block header. The button tooltip is **Show AI Smart Brief** or **Hide AI Smart Brief**. Your browser keeps your choice for each record until the facts of the record change. After that, the block opens in its default state again. The collapsed block shows the first line of its content.

The expanded block contains the following:

* The summary written by the AI provider. The key values, such as amounts, counts, and dates, are shown in bold. The block header shows when the summary was written, for example, *Updated 5 min ago*.
* The **Key facts** list. Related facts share one line, for example, *Last order: Oct 1, 2026 (54 days ago), $1,200.00*. Dates in this list are also shown relative to today, for example, *54 days ago*.

A line of the **Key facts** list can end with a link icon that leads to the records behind it. Click the icon to see these records:

* On a customer view page, the links filter the **Sales Orders**, **Requests For Quote**, and **Quotes** grids of the page to the last order, the open RFQs, and the quotes that wait for the customer's reply. The last contact link opens the email, call, or conversation.
* On an RFQ view page, the links filter the **Quotes** grid of the page to the quote for this RFQ, and open the customer's page with the customer's active quotes or the orders with the requested products. When the customer has not bought any of the requested products before, the **Requested products** link scrolls to the line items of the RFQ.

The page scrolls to the filtered grid and highlights it. When there are more than 20 records behind a line, the link shows the whole grid. To see all records of a grid again, reset its filters.

On a customer view page, the summary covers the following:

* The customer's last order and its total
* Open RFQs that wait for a quote and the date of the oldest one
* Quotes that wait for the customer's reply
* The last email, call, or conversation with the customer

.. image:: /user/img/concept-guides/ai/ai-smart-brief-customers.png
   :alt: The expanded AI Smart Brief block with the summary and the key facts on a customer view page

On an RFQ view page, the summary covers the following:

* The customer's active quotes and the quote created for this RFQ
* The requested products that the customer bought before, and when they were bought last
* How the requested prices compare with the list prices and with the prices that the customer last paid. The summary shows these comparisons, but the **Key facts** list does not.

.. image:: /user/img/concept-guides/ai/ai-smart-brief-rfq.png
   :alt: The expanded AI Smart Brief block with the summary and the key facts on an RFQ view page

The summary is written in the language of your back-office localization.

The block shows the following messages instead of its content:

* *The AI summary is not available right now; see the key facts.* --- The AI provider did not respond in time, returned an error, or returned an unusable answer. The block shows the key facts instead of the summary. OroCommerce tries the AI provider again the next time you open the page.
* *There is no recent activity to summarize.* --- OroCommerce found nothing to summarize for the record, for example, a customer without orders, open RFQs, quotes that wait for a reply, or contact. The AI provider is not called.

.. image:: /user/img/concept-guides/ai/ai-smart-brief-no-activity.png
   :alt: The AI Smart Brief block shows the No Activity message when there is nothing to summarize for a specific record

The block is not shown in the following cases:

* AI Smart Brief or the summary for this record type is disabled.
* No AI integration is selected, the selected integration is disabled, or it belongs to another organization. The data of one organization is never sent through the AI integration of another organization.
* An unexpected error occurs while the summary is prepared. The record page works as usual.

Regenerate the Summary
----------------------

If the administrator enables the **Show Regenerate Button** option :ref:`in the system configuration <admin-configuration-smart-brief-settings>`, the block header contains the |IcRefresh| **Regenerate** button. Click it to request a new summary from the AI provider immediately, for example, after you change the record.

Each click sends a new request to the AI provider. For this reason, the option is disabled by default.

.. image:: /user/img/concept-guides/ai/ai-smart-brief-regenerate.png
   :alt: Enabling the Regenerate button from the system configuration

.. _concept-guide--ai--smart-brief--permissions:

Summaries and Permissions
-------------------------

Each user's summary reflects only the records that this user can view. For example, if you can view only your own orders, the last order in your summary is the latest order that you can view. If you cannot view a record type at all, such as quotes, your summary contains no facts about that record type.

The block appears only for users who can view the customer or the RFQ itself.

How fast permission changes take effect depends on the **Refresh on Data Change** option:

* When the option is enabled, permission changes take effect the next time a user opens the page.
* When the option is disabled, a user sees their saved summary until it expires. As a result, permission changes take effect in the summaries only after the cache lifetime expires.

Summary Caching and Refresh
---------------------------

OroCommerce saves each AI summary and reuses it for the period set in the **Cache Lifetime (seconds)** option. The default period is 4 hours.

When **Refresh on Data Change** is enabled, OroCommerce writes a new summary as soon as the facts of the record change. When the option is disabled, a summary and its facts can be up to one cache lifetime old. For the cost of each mode, see :ref:`Choose the Refresh Mode <admin-configuration-smart-brief-settings--refresh-mode>`.

Keep the following in mind:

* The list prices in the RFQ summary come from the price lists of the RFQ's customer and website. After a price list changes, the list prices in the summary change only when OroCommerce has finished recalculating the prices in the background.
* A change of the AI integration or of a prompt does not change the summaries that are already saved. These summaries are used until the cache lifetime expires.

.. _concept-guide--ai--smart-brief--data:

Data Sent to the AI Provider
----------------------------

AI Smart Brief sends business facts about customers and RFQs to the external AI provider that you select. Review this data with your data protection team before you enable the feature.

For each summary, OroCommerce sends only the following data to the AI provider:

* The instructions for the AI provider and the name of your language
* The facts of the summary with their labels

The customer summary sends the customer name, the date and total of the last order, the number of open RFQs and quotes that wait for a reply with their dates, and the date and type of the last contact.

The RFQ summary sends the customer name, the number of active quotes and the status of the quote for this RFQ, the purchase history of the requested products, and the lowest and the highest difference in percent between the requested prices and the list prices, and between the requested prices and the prices that the customer last paid.

Only the facts that the current user can view are sent. A fact without data is not sent.

.. _concept-guide--ai--smart-brief--prompts:

Edit the Prompts
----------------

The instructions that OroCommerce sends to the AI provider are called prompts. The prompts are translations, so you can edit them for each language under **System > Localization > Translations** in the main menu. For more information, see :ref:`Configure Translations in the Back-Office <localization--translations--config>`.

The following translation keys contain the prompts:

* ``oro_smart_brief.prompt.common`` --- The rules for all summaries, for example, to use only the given facts, to give no advice, and to reply in the user's language.
* ``oro_smart_brief.prompt.customer`` --- The task for customer summaries.
* ``oro_smart_brief.prompt.rfq`` --- The task for RFQ summaries.

When you edit a prompt, keep the ``%language%``, ``%facts_open%``, and ``%facts_close%`` placeholders unchanged. OroCommerce replaces them with your language and with the delimiters that mark the start and the end of the facts.

.. warning:: The default rules in ``oro_smart_brief.prompt.common`` make the AI provider use only the facts that OroCommerce computes. Do not remove the rule that everything between ``%facts_open%`` and ``%facts_close%`` is data, not instructions. Without this rule, text in a business record, such as a product name, can change what the AI provider writes.

The summaries that are already saved do not change after you edit a prompt. They are written again with the new prompt after the cache lifetime expires.

**Related Articles**

* :ref:`AI and Automation Concept Guide <concept-guide--ai>`
* :ref:`Configure Global AI Smart Brief Settings <admin-configuration-smart-brief-settings>`
* :ref:`Configure AI Smart Brief Settings per Organization <organization-smart-brief-settings>`
* :ref:`Configure AI Integrations in the Back-Office <user-guide-ai-integrations>`
* :ref:`OroSmartBriefBundle <bundle-docs-extensions-smart-brief>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

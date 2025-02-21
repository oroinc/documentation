.. _configuration--guide--commerce--configuration--search-history:
.. _configuration--guide--commerce--configuration--search-empty-search-results--global:

Configure Global Search Terms Settings
======================================

.. hint:: Read :ref:`Search Functions Concept Guide <user-guide-getting-started-search>` to get a general understanding of the search functionality in OroCommerce.

.. note:: You can configure search history globally, :ref:`per organization <organization-commerce--configuration--search-history>`, :ref:`website <configuration--website-commerce--search--history>`, :ref:`customer group <user-guide--customer-groups--configuration--settings--search>`, or :ref:`customer <user-guide--customers--search--settings>`, and empty search results page globally, :ref:`per organization <configuration--guide--commerce--configuration--search-empty-page-results-org>`, and :ref:`website <configuration--guide--commerce--configuration--search-empty-page-results-website>`.

To configure the search history settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Search > Search Terms** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/search/global-search-history-settings.png
   :alt: Global search history configuration options

3. In the **Search Term Management** section, clear the *Use Default* checkbox to enable the search term functionality.

   * **Enable Search Term Management** - this functionality enables you to respond to certain search phrases with tailored actions. When a designated search term is detected, you can choose a corresponding action from a range of pre-set responses, such as automatically direct users to a predetermined page, replace the default search results, and more. Enabling this option adds a Search Term menu item to **Marketing > Search** in the back-office. By default, this option is disabled.

4. In the **Search History** section, clear the *Use Default* checkbox to configure the following search history reporting options:

   * **Enable Search History Reporting** --- enables the :ref:`Search History feature <user-guide-search-search-history>` globally to track your customers’ search activity in the storefront. The option also enables the :ref:`a Search Terms report <user-guide-search-terms-report>` that collects statistics on how many times a particular search term was used, the number of times that search term returned products, and the number of times it returned an empty result. When Enable Search History Reporting is disabled, the feature is removed from the main menu and grids, along with the Search Terms report.

   * **Enable Search History Collection** --- depends on the Enable Search History Reporting option above. When Enable Search History Collection is enabled, all search queries are logged into the database. This option allows enabling/disabling certain groups of visitors. For example, you can choose not to log requests from anonymous users by turning off this option at customer group level for Anonymous customers. Exercise care when enabling this option on popular websites as it may result in a large number of records saved to the database.

5. In the **Special Pages** section, clear the *Use Default* checkbox to configure the empty search results page:

   * **Empty Search Result Page** --- You can configure an Empty Search Results Page, if the product search produced an empty result and there is no custom page configured for that specific combination of a :ref:`search term <user-guide-search-search-terms>` and additional search criteria. The web-node selected for this configuration option should be available for all users and cannot have restrictions.

   .. note:: This option is available starting from OroCommerce version 6.0.2.

6. Click **Save Settings**.


**Related Topics**

* :ref:`Manage Search History in the Back-Office <user-guide-search-search-history>`
* :ref:`Search (Terms) Report <user-guide-search-terms-report>`

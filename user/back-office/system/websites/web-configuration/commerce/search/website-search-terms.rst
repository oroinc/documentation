.. _configuration--website-commerce--search--history:
.. _configuration--guide--commerce--configuration--search-empty-page-results-website:

Configure Search Terms Settings per Website
===========================================

.. hint:: Read :ref:`Search Functions Concept Guide <user-guide-getting-started-search>` to get a general understanding of the search functionality in OroCommerce.


.. note:: You can configure search history :ref:`globally <configuration--guide--commerce--configuration--search-history>`, :ref:`per organization <organization-commerce--configuration--search-history>`, :ref:`customer group <user-guide--customer-groups--configuration--settings--search>`, or :ref:`customer <user-guide--customers--search--settings>`, and empty search results page :ref:`globally <configuration--guide--commerce--configuration--search-empty-search-results--global>`, :ref:`per organization <configuration--guide--commerce--configuration--search-empty-page-results-org>`, and website.

To configure the search history settings per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Search > Search Terms** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/websites/web_configuration/web-search-terms.png
   :alt: Search history configuration options per website

4. In the **Search History** section, clear the *Use Organization* check box to configure the following search history reporting options:

   * **Enable Search History Reporting** --- enables the :ref:`Search History feature <user-guide-search-search-history>` globally to track your customers’ search activity in the storefront. The option also enables the :ref:`a Search Terms report <user-guide-search-terms-report>` that collects statistics on how many times a particular search term was used, the number of times that search term returned products, and the number of times it returned an empty result. When Enable Search History Reporting is disabled, the feature is removed from the main menu and grids, along with the Search Terms report.

   * **Enable Search History Collection** --- depends on the Enable Search History Reporting option above. When Enable Search History Collection is enabled, all search queries are logged into the database. This option allows enabling/disabling certain groups of visitors. For example, you can choose not to log requests from anonymous users by turning off this option at customer group level for Anonymous customers. Exercise care when enabling this option on popular websites as it may result in a large number of records saved to the database.

5. In the **Special Pages** section, clear the *Use Organization* check box to configure the empty search results page:

   * **Empty Search Result Page** --- You can configure an Empty Search Results Page, if the product search produced an empty result and there is no custom page configured for that specific combination of a :ref:`search term <user-guide-search-search-terms>` and additional search criteria. The web-node selected for this configuration option should be available for all users and cannot have restrictions.

6. Click **Save Settings**.


**Related Topics**

* :ref:`Manage Search History in the Back-Office <user-guide-search-search-history>`
* :ref:`Search (Terms) Report <user-guide-search-terms-report>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
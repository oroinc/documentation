:oro_documentation_types: OroCommerce

.. _configuration--website-commerce--search--history:

Configure Search History Settings per Website
=============================================

.. note:: You can configure search history :ref:`globally <configuration--guide--commerce--configuration--search-history>`,:ref:`per organization <organization-commerce--configuration--search-history>`, :ref:`customer group <user-guide--customer-groups--configuration--settings--search>`, or :ref:`customer <user-guide--customers--search--settings>`.

To configure the search history settings per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Search > Search Terms** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. You can enable or disable the following options (clear the **Use Organization** checkbox to customize the settings):

   * **Enable Search History Feature** --- enables the :ref:`Search History feature <user-guide-search-search-history>`  that helps track your customers' searching activity, including the products users have searched for, the number of products found, etc. Additionally, the option enables :ref:`a Search Terms report <user-guide-search-terms-report>` that collects statistics on how many times a particular search term was used, the number of times that search term returned products, and the number of times it returned an empty result.

   * **Enable Global Search History** - enables the system to collect all statistics about the customers' search queries. Keep in mind that enabling this option may result in a large number of records being saved to the database on popular websites, so be careful when enabling this feature.

5. Click **Save Settings**.


**Related Topics**

* :ref:`Manage Search History in the Back-Office <user-guide-search-search-history>`
* :ref:`Search (Terms) Report <user-guide-search-terms-report>`

.. include:: /include/include-images.rst
   :start-after: begin
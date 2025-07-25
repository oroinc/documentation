.. _user-guide--customer-groups--configuration--settings--search:

Configure Search History Settings per Customer Group
====================================================

.. hint:: Read :ref:`Search Functions Concept Guide <user-guide-getting-started-search>` to get a general understanding of the search functionality in OroCommerce.

.. note:: You can configure search history :ref:`globally <configuration--guide--commerce--configuration--search-history>`, :ref:`per organization <organization-commerce--configuration--search-history>`, :ref:`website <configuration--website-commerce--search--history>`, customer group, or :ref:`customer <user-guide--customers--search--settings>`.

Search History enables users to view a history of all searches performed in the storefront.

To configure the search history settings per customer group:

1. Navigate to **Customers > Customer Groups** in the main menu.
2. For the necessary customer group, hover over the |IcMore| **More Options** menu to the right of the necessary group and click the |IcConfig| **Configuration** icon to start editing the configuration.

.. image:: /user/img/customers/customer_groups/configuration/customer-group-config-search.png
   :alt: Customer group search terms configuration settings

3. Select **Commerce > Search > Search Terms** in the menu to the left.
4. In the Search History section, clear the **Use Website** checkbox and configure the following option:

   * **Enable Search History Collection** - depends on the :ref:`Enable Search History Reporting option <configuration--guide--commerce--configuration--search-history>`. When Enable Search History Collection is enabled, all search queries are logged into the database. This option allows enabling/disabling certain groups of visitors. For example, you can choose not to log requests from anonymous users by turning off this option at customer group level for Anonymous customers. Exercise care when enabling this option on popular websites as it may result in a large number of records saved to the database.

5. Click **Save Settings**.

**Related Topics**

* :ref:`Manage Search History in the Back-Office <user-guide-search-search-history>`
* :ref:`Search (Terms) Report <user-guide-search-terms-report>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

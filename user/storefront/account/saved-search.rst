.. _my-account-saved-search:

Manage Saved Search in the Storefront
=====================================

.. hint:: The Saved Search feature is available starting from OroCommerce v4.2.4. To check which application version you are running, see the :ref:`system information <system-information>`.

Registered customer users can save their search queries with custom labels, as well as get notified when a new product falls under the search conditions and when products from the search query result are back in stock. All saved search results are reflected in the Saved Searches menu in the customer user accounts. Here, they can view the search results, rename them, as well as see whether new product and back in stock alerts are enabled for specific saves search results in the table.

Keep in mind that search result notifications have a :ref:`limit preconfigured in the back-office <configuration--guide--commerce--configuration--saved-search>`. This means that email notifications are not sent for the existing search queries that include more products than the set limit, and it is also not possible to enable email notifications for new search queries with more products than set by the pre-configured limit.

To save a search result:

1. Use the search bar to look for a product name, SKU, keyword, etc.
2. When the search results are displayed, click the **Save** icon on the top right. Make sure that the panel with filters is open.

   .. image:: /user/img/storefront/navigation/saved-search.png
      :alt: Saved search icon in the Filters panel

3. Select the check boxes for *New Product* and/or *Inventory Status* if you want to receive notifications.
4. Click **Add**. Your search query is now saved under **My Account > Saved Search**.

   .. image:: /user/img/storefront/navigation/saved-search-account-table.png
      :alt: Saved search in the customer user account


**Related Topics**

* :ref:`Configure Saved Search Globally <configuration--guide--commerce--configuration--saved-search>`
* :ref:`Configure Saved Search per Organization <organization-commerce--configuration--saved-search>`
* :ref:`Configure Saved Search per Website <configuration--website-commerce--search--saved-search>`
:oro_documentation_types: OroCommerce

.. _configuration--website-commerce--search--saved-search:

Configure Saved Search Settings per Website
===========================================

You can configure the ability for registered customer users to save search queries, return to these saved search queries later, receive notifications when a new product falls under the search conditions and when products from the search query result are back in stock. By default, saved search is enabled (if Elasticsearch is used as the search engine for the application).

.. note:: This option is also available on the :ref:`global <configuration--guide--commerce--configuration--saved-search>` and :ref:`organization <organization-commerce--configuration--saved-search>` levels.

.. image:: /user/img/system/websites/web_configuration/saved-search-website-config.png
   :alt: Saved search configuration on the website level

To configure saved search settings:

1. Navigate to  **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Search** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. You can enable or disable the following options (clear the **Use Organization** check box to customize the settings):

   * **Enable Saved Search Results** - When this option is enabled, customer users can save their search results to return to them later from the "Saved Searches" page in their account and to subscribe to periodic email notifications.

   .. image:: /user/img/system/config_commerce/search/saved-search-sf.png
      :alt: Saved search illustration in the storefront

   * **Newly Added Items Notifications** - If this option is, customer users can subscribe to email notifications about new products added to their saved search queries.
   * **Back in Stock Notifications** - If this option is enabled, customer users can subscribe to email notifications about the products in their saved searches returning back to stock (product inventory status changed to "In Stock").
   * **Search Result Notification Limit** - If the number of products included in the search query result exceeds the provided limit, no new product email notifications will be sent for such saved search query.

5. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin
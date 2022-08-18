:oro_documentation_types: OroCommerce

.. _configuration--website-commerce--search--saved-search:

Configure Saved Search Settings per Website
===========================================

.. include:: /user/back-office/system/configuration/commerce/search/saved-search.rst
   :start-after: begin_include
   :end-before: end_include


.. note:: Saved Search configuration options are also available on the :ref:`global <configuration--guide--commerce--configuration--saved-search>` and :ref:`organization <organization-commerce--configuration--saved-search>` levels.

.. image:: /user/img/system/websites/web_configuration/saved-search-website-config.png
   :alt: Saved search configuration on the website level

To configure saved search settings:

1. Navigate to  **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Search** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. You can enable or disable the following options (clear the **Use Organization** checkbox to customize the settings):

   * **Enable Saved Search Results** - When this option is enabled, customer users can save their search results to return to them later from the "Saved Searches" page in their account and to subscribe to periodic email notifications.

   .. image:: /user/img/system/config_commerce/search/saved-search-sf.png
      :alt: Saved search illustration in the storefront

   * **Newly Added Items Notifications** - If this option is enabled, customer users can subscribe to email notifications about new products added to their saved search queries.
   * **Back in Stock Notifications** - If this option is enabled, customer users can subscribe to email notifications about the products in their saved searches returning back to stock (product inventory status changed to "In Stock").
   * **Search Result Notification Limit** - If the number of products included in the search query result exceeds the provided limit, no new product email notifications will be sent for such saved search query.

     .. note:: A customer user receives an email notification for each saved search that got updates. Such email notification contains information about 8 products per each of the two types of notifications ("Newly Added Items" and "Back in Stock" notifications respectively). You can customize the email template to display up to 100 products in the email.

   * **Saved Searches Limit Per User** - Customers will not be able to save more searches than the specified limit and will need to delete some existing saved search queries to create a new one.

5. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
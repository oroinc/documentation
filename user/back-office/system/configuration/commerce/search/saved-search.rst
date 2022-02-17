:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--saved-search:

Configure Global Saved Search Settings
======================================

.. begin_include

.. note:: The feature is only available in the Enterprise edition applications.

You can configure the ability for registered customer users to save search queries, return to these saved search queries later, receive notifications when a new product falls under the search conditions and when products from the search query result are back in stock.

By default, saved search is enabled if Elasticsearch is used as the search engine for the application. Please be aware that additional configuration of Elasticsearch may be required as the saved search feature uses percolate queries.

.. note:: Percolate queries will not be executed by Elasticsearch if |search.allow_expensive_queries| configuration option is set to false. By default, this option is enabled but please be aware that if it is disabled, the saved search feature will not work.

In addition, this feature is highly demanding when it comes the server resources, therefore the following recommendations will help you to keep good performance:

* The more CPU cores, the better
* The more nodes, the better
* The more primary shards the better
* Put ``savedsearch_*`` indices onto a separate nodes.

You may need to manually toggle the notifications that are sent as part of this feature. For example, when you need to mute notifications before importing large amounts of data, use the ``oro:website-elasticsearch:saved-search:mute`` Symfony console command. To unmute them back, use ``oro:website-elasticsearch:saved-search:unmute`` Symfony console command. By default, all changed products are added to the stored saved search results as if the customers have already been notified about them so that no notifications are sent. Please keep in mind that by specifying the option ``*--reprocess-accumulated-changes'`` you have the ability to reprocess the changed products that have accumulated so far and notify customers about them.

.. note:: This option does not send notifications itself but initiates the processing of the accumulated changes. The notification sending is initiated by the cron command ``oro:website-elasticsearch:saved-search:consume-alerts``.

The cron command ``oro:cron:website-elasticsearch:saved-search:create-alerts`` runs at 00:00 UTC to process the modified products and prepare notifications. You can also start this process manually with the following command: ``oro:website-elasticsearch:saved-search:create-alerts``. The cron command ``oro:cron:website-elasticsearch:saved-search:consume-alerts`` runs at 04:00 UTC to initiate the sending of email notifications. You can also start this process manually with: ``oro:website-elasticsearch:saved-search:consume-alerts``.

.. end_include

.. note:: Saved Search configuration options are also available on the :ref:`organization <organization-commerce--configuration--saved-search>` and :ref:`website <configuration--website-commerce--search--saved-search>` levels.

.. image:: /user/img/system/config_commerce/search/saved-search-global-config.png
   :alt: Saved search configuration on global level

To configure saved search settings:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Search** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. You can enable or disable the following options (clear the **Use Default** check box to customize the settings):

   * **Enable Saved Search Results** - When this option is enabled, customer users can save their search results to return to them later from the "Saved Searches" page in their account and to subscribe to periodic email notifications.

   .. image:: /user/img/system/config_commerce/search/saved-search-sf.png
      :alt: Saved search illustration in the storefront

   * **Newly Added Items Notifications** - If this option is enabled, customer users can subscribe to email notifications about new products added to their saved search queries.
   * **Back in Stock Notifications** - If this option is enabled, customer users can subscribe to email notifications about the products in their saved searches returning back to stock (product inventory status changed to "In Stock").
   * **Search Result Notification Limit** - If the number of products included in the search query result exceeds the provided limit, no new product email notifications will be sent for such saved search query.

    .. note:: A customer user receives an email notification for each saved search that got updates. Such email notification contains information about 8 products per each of the two types of notifications ("Newly Added Items" and "Back in Stock" notifications respectively). You can customize the email template to display up to 100 products in the email.

   * **Saved Searches Limit Per User** - Customers will not be able to save more searches than the specified limit and will need to delete some existing saved search queries to create a new one.

4. Click **Save Settings**.

.. include:: /include/include-links-user.rst
   :start-after: begin


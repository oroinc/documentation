:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--product-collections:

Configure Global Settings for Product Collections
=================================================

You can control the frequency of the product collections indexation. By default, product collections are indexed every hour.

.. note::

   Indexing of simple filters that rely only on the product attributes happens via the message queue. Indexing task is queued immediately after the product collection node is saved. After the index task is processed, the product collection (or the part of product collection) is available in the storefront immediately.

   Indexing of more complex filters (e.g., those that involve relationships with other entities) is separated from the common reindexation process and happens on a dedicated schedule via cron.

To change the default product collections indexation frequency:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Product > Product Collections** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/product/product_collections_configuration.png
      :alt: Global product collection configuration settings

   Here, you can set the indexation cron schedule and the mass action limit.

3. To customize the Indexation Cron Schedule:

     a) Clear the **Use Default** box next to the option.
     b) Select the desired frequency from the list.

4. In the **Mass Action Limit** option, you can set the limited number of products that can be handled (added, deleted) using mass action. The option is only applicable to product collections (e.g., in web catalogs), and it does not refer to mass actions of other entities (e.g., products, customers, leads, etc). Keep in mind that this option is merely advisory, and it only notifies a user of the exceeded mass action limit. But you can force your action, going beyond the limit, if needed.

    .. image:: /user/img/system/config_commerce/product/mass_action_limit_confirmation.png
       :alt: Confirmation dialog that appears if a user exceeds the mass action limit

    To set the limit for mass actions:

       a) Clear the **Use Default** box next to the option.
       b) Specify the number of products in product collections that can be handled when using mass action.

5. To enable partial indexation only for products that were added to or removed from the collection.

    a) Clear the **Use Default** box next to the option.
    b) Select the **Enable Partial Indexation** option.

6. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin

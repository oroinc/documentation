:orphan:

.. _sys--commerce--catalog--relate-products:

Enable Related Products Globally
--------------------------------

.. begin_related_products_body

.. begin_related_products_definition

Related items listed for the product may include accessories, services, and otehr items that are likely to be purchased in the same order.  They help navigation through the product catalog in the management console.

.. TODO update when they get to the front store

In the system configuration, you can:

* Enable and disable related item management for the products.
* Control the type of the relationship (one-way or bidirectional).
* Limit the number of items displayed as related.

These settings may apply :ref:`globally <sys--commerce--catalog--relate-products>`, on the :ref:`organization level <sys--users--organization--commerce--catalog--related-products>`, and on the :ref:`website level <sys--websites--commerce--catalog--related-products>`.

.. finish_related_products_definition

To update the related products settings globally:

1. Navigate to the system configuration by clicking **System > Configuration** in the main menu.
2. Select **Commerce > Catalog > Related Items** in the menu to the left.

   The following page opens.

   .. image:: /user_guide/img/products/products/RelatedProductsGlobal.png
      :class: with-border

   .. begin_related_products_option_description

   The following options are available:

   * Enable Related Products --- Toggles managing related items on/off. Enabled by default.
   * Assign in Both Directions --- When enabled, the products become mutually related. For example, when you add a lightning bulb as a related product for a standing lamp, the relation works both ways and the lamp automatically becomes related item of the lightning bulb. This option is disabled by default.
   * Maximum Number Of Assigned Items --- A limit of related items that may be added to any product.

   .. finish_related_products_option_description

3. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Set or clear the option or type in the quantity.

4. Click **Save**.

.. finish_related_products_body

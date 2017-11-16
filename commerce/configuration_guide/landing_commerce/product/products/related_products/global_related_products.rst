:orphan:

.. _sys--commerce--catalog--relate-products:

Enable and Set Up Related Products Globally
-------------------------------------------

.. begin_related_products_body

.. begin_related_products_definition

Related products listed for the product may include accessories, services, and other items that are likely to be purchased in the same order. They facilitate navigation through the product catalog in the management console and help a buyer find the other products they may be interested in buying.

In the system configuration, you can:

* Enable and disable related product management for the products.
* Control the type of the relationship (one-way or bidirectional).
* Limit the number of items displayed as related.

These settings may apply :ref:`globally <sys--commerce--catalog--relate-products>`, on the :ref:`organization level <sys--users--organization--commerce--catalog--related-products>`, and on the :ref:`website level <sys--websites--commerce--catalog--related-products>`.

.. finish_related_products_definition

To update the related products settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Catalog > Related Items** in the menu to the left.

   The following page opens.

   .. image:: /user_guide/img/products/products/RelatedProductsGlobal.png
      :class: with-border

   .. begin_related_products_option_description

   In the **Related Products** section, the following options are available:

   * **Enable Related Products** --- Toggles managing related products on/off. Enabled by default.
   * **Assign in Both Directions** --- When enabled, the products become mutually related. For example, when you add a lightning bulb as a related product for a standing lamp, the relation works both ways and the lamp automatically becomes related item of the lightning bulb. This option is disabled by default.
   * **Maximum Number Of Assigned Items** --- A limit of related products that may be added to any product.
   * **Maximum Items** --- A limit of related products that are shown to a buyer.

     .. note:: Some related products may be hidden by the visibility settings. If the list of related products still exceeds the limit, only the specified number of items (top of the list) will be shown.

   * **Minimum Items** --- The minimum number of related products that may be shown to the buyer. If the actual number of products is less than this value, the related products section is hidden in the front store for the product.
   * **Show Add Button** --- Enables a buyer to order a related product from the related products section in the main product details. When the option is disabled, a buyer needs to open the related product details before they can add it to the shopping list.

     **Show Add Button is Enabled**

     .. image:: /user_guide/img/products/products/RelatedProductPreviewWithAdd.png
        :class: with-border

     **Show Add Button is Disabled**

     .. image:: /user_guide/img/products/products/RelatedProductPreview.png
        :class: with-border

   * **Use Slider On Mobile** --- When enabled, one related product is displayed below the main product information. Other related products are accessible using the horizontal slider. Click < and > to slide through the related products.

   .. finish_related_products_option_description

3. To customize any of these options:

     a) Clear the **Use Default** check box next to the option.
     b) Set or clear the option, or enter the quantity.

4. Click **Save**.

.. finish_related_products_body

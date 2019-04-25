:orphan:

.. not yet implemented, should remain orphan for now.

.. _sys--commerce--catalog--cross-sell-products:

Enable and Set Up Cross-Sell Products Globally
----------------------------------------------

.. begin_cross_sell_items_body

.. begin_cross_sell_items_definition

Cross-sell items listed for the product may include similar products or those that complement it, like the accessories.

.. TODO update when they get to the storefront

In the system configuration, you can:

* Enable and disable cross-sell item management for the products.
* Limit the number of items displayed as related.

These settings may apply :ref:`globally <sys--commerce--catalog--relate-products>`, on the :ref:`organization level <sys--users--organization--commerce--catalog--related-products>`, and on the :ref:`website level <sys--websites--commerce--catalog--related-products>`.

.. finish_cross_sell_items_definition

To update the cross-sell products settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Catalog > Related Items** in the menu to the left.

   The following page opens.

   .. image:: /user_guide/img/products/products/RelatedProductsGlobal.png
      :class: with-border

   .. begin_cross_sell_items_option_description

   In the **Cross-Sell Products**, the following options are available:

   * **Enable Cross-Sell Products** --- Toggles managing cross-sell items on/off. Enabled by default.
   * **Maximum Number Of Assigned Items** --- A limit of cross-sell items that may be added to any product.
   * **Maximum Items** --- A limit of cross-sell products that are shown to the buyer.

     .. note:: Some cross-sell items may be hidden by the visibility settings. If the list of cross-sell products still exceeds the limit, only the specified number of items (top of the list) will be shown.

   * **Minimum Items** --- The minimum number of cross-sell products that may be shown to the buyer. If the actual number of products is less than this value, the cross-sell products section is hidden in the storefront for the product.
   * **Show Add Button** --- Enables a buyer to order a cross-sell product from the cross-sell products section in the main product details. When the option is disabled, a buyer needs to open the cross-sell product details before they can add it to the shopping list.

     **Show Add Button is Enabled**

     .. image:: /user_guide/img/products/products/RelatedProductPreviewWithAdd.png
        :class: with-border

     **Show Add Button is Disabled**

     .. image:: /user_guide/img/products/products/RelatedProductPreview.png
        :class: with-border

   * **Use Slider On Mobile** --- When the option is enabled, one cross-sell product is displayed below the main product information. Other cross-sell products are accessible using the horizontal slider. Click < and > to slide through the cross-sell products.

   .. finish_cross_sell_items_option_description

3. To customize any of these options:

     a) Clear the **Use Default** check box next to the option.
     b) Set or clear the option, or enter the quantity.

4. Click **Save**.

.. finish_cross_sell_items_body

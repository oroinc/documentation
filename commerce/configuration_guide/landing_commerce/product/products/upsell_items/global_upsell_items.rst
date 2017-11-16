:orphan:

.. _sys--commerce--catalog--upsell-products:

Enable and Set Up Up-Sell Products Globally
-------------------------------------------

.. begin_upsell_items_body

.. begin_upsell_items_definition

Up-sell products listed for the product in the OroCommerce front store may advertise more expensive alternatives to the product, like a newer and more advanced model, upgrades and add-ons that may look tempting when bundled with the product, etc.

In the system configuration, you can:

* Enable and disable up-sell product management for the products.
* Limit the number of items displayed as up-sell.

These settings may apply :ref:`globally <sys--commerce--catalog--upsell-products>`, on the :ref:`organization level <sys--users--organization--commerce--catalog--upsell-products>`, and on the :ref:`website level <sys--websites--commerce--catalog--upsell-products>`.

.. finish_upsell_items_definition

To update the up-sell products settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Catalog > Related Items** in the menu to the left.

   The following page opens.

   .. image:: /user_guide/img/products/products/RelatedProductsGlobal.png
      :class: with-border

   .. begin_upsell_items_option_description

   In the **Up-Sell Products** section, the following options are available:

   * **Enable Up-Sell Products** --- Toggles managing up-sell products on/off. Enabled by default.
   * **Maximum Number Of Assigned Items** --- A limit of related items that may be added to any product.
   * **Maximum Items** --- A limit of up-sell products that are shown to the buyer.

     .. note:: Some related items may be hidden by the visibility settings. If the list of up-sell products still exceeds the limit, only the specified number of items (top of the list) will be shown.

   * **Minimum Items** --- The minimum number of up-sell products that may be shown to the buyer. If the actual number of products is less than this value, the up-sell products section is hidden in the front store for the product.
   * **Show Add Button** --- Enables a buyer to order the product from the up-sell products section in the main product details. When disabled, a buyer needs to open the up-sell product details before they can add it to the shopping list.

     **Show Add Button is Enabled**

     .. image:: /user_guide/img/products/products/RelatedProductPreviewWithAdd.png
        :class: with-border

     **Show Add Button is Disabled**

     .. image:: /user_guide/img/products/products/RelatedProductPreview.png
        :class: with-border

   * **Use Slider On Mobile** --- When the option is enabled, one up-sell product is displayed below the main product information. Other up-sell products are accessible using the horizontal slider. Click < and > to slide through the up-sell products.

   .. finish_upsell_items_option_description

3. To customize any of these options:

     a) Clear the **Use Default** check box next to the option.
     b) Set or clear the option, or enter the quantity.

4. Click **Save**.

.. finish_upsell_items_body

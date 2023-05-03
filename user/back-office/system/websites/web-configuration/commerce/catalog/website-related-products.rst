:oro_documentation_types: OroCommerce

.. _sys--websites--commerce--catalog--related-products:

Configure Related Product Settings per Website
==============================================

In the Related Items section, you can configure the settings for related, up-sell, and similar products for a particular website. These settings may apply :ref:`globally <sys--commerce--catalog--relate-products--main>`, per :ref:`organization <sys--users--organization--commerce--catalog--related-products>`, and per website.

.. note:: Before configuring the related items settings, add the required related and up-sell products to the desired products as described in the :ref:`Add Related Items <products--related-items>` topic. Similar products are displayed automatically following the similar product calculation algorithm.

To update the related product settings per website:

1. In the main menu, navigate to **System > Websites**.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click the |IcConfig| **Configuration** icon to start editing the configuration.
3. Select **Commerce > Catalog > Related Items** in the menu to the left.

   .. image:: /user/img/system/websites/web_configuration/RelatedProductsWebsite.png
      :class: with-border

4. Clear the **Use Organization** checkbox to customize the settings per selected website.

5. In the **Related Products** section, the following options are available:

   * **Enable Related Products** --- Toggles managing related products on/off. Enabled by default.
   * **Assign in Both Directions** --- When enabled, the products become mutually related. For example, when you add a lightning bulb as a related product for a standing lamp, the relation works both ways and the lamp automatically becomes related item of the lightning bulb. This option is disabled by default.
   * **Maximum Number Of Assigned Items** --- A limit of related products that may be added to any product.
   * **Maximum Items** --- A limit of related products that are shown to a buyer.

     .. note:: Some related products may be hidden by the visibility settings. If the list of related products still exceeds the limit, only the specified number of items (top of the list) will be shown.

   * **Minimum Items** --- The minimum number of related products that may be shown to the buyer. If the actual number of products is less than this value, the related products section is hidden in the storefront for the product.
   * **Show Add Button** --- Enables a buyer to order a related product from the related products section in the main product details. When the option is disabled, a buyer needs to open the related product details page before they can add it to the shopping list.

.. begin_upsell_items_body

.. _sys--websites--commerce--catalog--upsell-products:


6. In the **Up-Sell Products** section, the following options are available:

   * **Enable Up-Sell Products** --- Toggles managing up-sell products on/off. Enabled by default.
   * **Maximum Number Of Assigned Items** --- A limit of related items that may be added to any product.
   * **Maximum Items** --- A limit of up-sell products that are shown to the buyer.

     .. note:: Some related items may be hidden by the visibility settings. If the list of up-sell products still exceeds the limit, only the specified number of items (top of the list) will be shown.

   * **Minimum Items** --- The minimum number of up-sell products that may be shown to the buyer. If the actual number of products is less than this value, the up-sell products section is hidden in the storefront for the product.
   * **Show Add Button** --- Enables a buyer to order the product from the up-sell products section in the main product details. When disabled, a buyer needs to open the up-sell product details page before they can add it to the shopping list.
   * **Use Slider On Mobile** --- When the option is enabled, one up-sell product is displayed below the main product information. Other up-sell products are accessible using the horizontal slider. Click < and > to slide through the up-sell products.


.. _sys--websites--commerce--catalog--similar-products:

.. note:: **Similar Products** are available for the OroCommerce Enterprise edition if Elasticsearch is used as the search engine.

7. In the **Similar Products** section, the following options are available:

   * **Enable Similar Products** --- Toggles managing similar products on/off. Enabled by default.
   * **Maximum Items** --- A limit of similar products that are shown to a buyer.

     .. note:: Some similar products may be hidden by the visibility settings. If the list of similar products still exceeds the limit, only the specified number of items (top of the list) will be shown.

   * **Minimum Items** --- The minimum number of similar products that may be shown to the buyer. If the actual number of products is less than this value, the similar products section is hidden in the storefront for the product.
   * **Show Add Button** --- Enables a buyer to order a similar product from the similar products section in the main product details. When the option is disabled, a buyer needs to open the similar product details page before they can add it to the shopping list.
   * **Use Slider On Mobile** --- When enabled, one similar product is displayed below the main product information. Other similar products are accessible using the horizontal slider. Click < and > to slide through the similar products.
   * **Product Name Boost** --- A boost factor for the product name, the boost is applied for each matched word. Leave the field empty to disable the boost.
   * **Product Category Boost** --- A boost factor for the product category. Leave the field empty to disable the boost.
   * **Product Category Parent Boost** --- A boost factor for the parent of a product category. Leave the field empty to disable the boost.
   * **Product Category 2nd Level Parent Boost** --- A boost factor for the second level parent of a product category. Leave the field empty to disable the boost.


8. Click **Save**.

.. include:: /include/include-images.rst
   :start-after: begin

.. _doc--products:

Products
========

In this section you will learn how to add, configure and manage the product information, including product details structure and page design, product prices, and multiple options to simplify product search and navigation.

.. contents:: :local:

Before You Begin
----------------

.. begin_product_configuration

Ensure that you have configured:

* :ref:`Product units <sys--commerce--product--product-units>` --- to select the primary product unit and its precision.
* Product image watermarks (:ref:`globally <sys--commerce--product--product-images>` and :ref:`per website <sys--websites--commerce--product--product-images>`) --- to add a branded watermark to all the product images.
* Product image gallery (:ref:`globally <sys--commerce--product--product-images--gallery-slider-global>`, :ref:`per organization <sys--users--organization--commerce--products--gallery-slider>`, and :ref:`per website <sys--websites--commerce--product--gallery-slider>`) --- to use popup or inline view for the image gallery.
* Image preview on product listing page (:ref:`globally <sys--commerce--product--product-images--image-preview--global>`, :ref:`per organization <sys--commerce--product--product-images--image-preview--organization>`, and :ref:`per website <sys--commerce--product--product-images--image-preview--website>`) --- to see the product image gallery instead of the product page when clicking on the image in the product listing.
* :ref:`Product families <products--product-families>` and :ref:`product attributes <products--product-attributes>` --- to design a structure for product information.
* :ref:`Price attributes <user-guide--products--price-attributes>` --- to add custom parameters where you can store the price-related information (e.g. MRSP) that may be used in the rule-based price lists to calculate the price for the buyer.
* New arrivals flag (:ref:`globally <sys--commerce--product--new-arrivals>`, :ref:`per organization <sys--users--organization--commerce--products--new-arrivals>`, and :ref:`per website <sys--websites--commerce--products--new-arrivals>`) --- to highlight the new products in your web catalog.
* Featured products segment (:ref:`globally <sys--commerce--product--featured-products>`, :ref:`per organization <sys--users--organization--commerce--products--featured-products>`, and :ref:`per website <sys--websites--commerce--products--featured-products>`) -- to store the selected products that are displayed on the crowded paths of you website.
* Previously Purchased Products (:ref:`globally <sys--commerce--orders--previously-purchased--global>` and :ref:`per website <sys--commerce--orders--previously-purchased--website>`) --- to display products that customer users have bought recently.

* Related items configuration:

  * Related products (:ref:`globally <sys--commerce--catalog--relate-products>`, :ref:`per organization <sys--users--organization--commerce--catalog--related-products>`, and :ref:`per website <sys--websites--commerce--catalog--related-products>`) --- to bind similar products or those that complement each other, like the item and its accessories.

  * Up-sell products (:ref:`globally <sys--commerce--catalog--upsell-products>`, :ref:`per organization <sys--users--organization--commerce--catalog--upsell-products>`, and :ref:`per website <sys--websites--commerce--catalog--upsell-products>`) --- to bind products that should be promoted with the product being viewed, like more expensive alternatives of the model, upgrade options, additional parts.

.. uncomment in DOC-145: Cross-sell products (:ref:`globally <sys--commerce--catalog--cross-sell-products>`, :ref:`per organization <sys--users--organization--commerce--catalog--cross-sell-products>`, and :ref:`per website <sys--websites--commerce--catalog--cross-sell-products>`) --- to bind products that may replace each other, like other brands or similar models.

See the reference of :ref:`Product-Related Settings in System Configuration <configuration--products>`.

.. finish_product_configuration

Manage Products
---------------

To create a product, manage product information and visibility, please use the procedures described below.

* :ref:`Manage Product Information Structure <doc--product-information-structure>`

* :ref:`Create a Product <doc--products--actions--create>`

* :ref:`Manage Product Visibility <products--product-visibility>`

* :ref:`Manage Product Page Design with Page Templates <user-guide--page-templates>`

* :ref:`Review Product Prices <view-and-filter-product-prices>`

* :ref:`Manage Product Inventory Quantity <doc--products--actions--manage-inventory>`

* :ref:`Add Attachment to the Product <doc--products--actions--attachment>`

.. ref:`Product Taxation <user-guide--products--products--taxation>`

* :ref:`Add Note to a Product <doc--products--actions--note>`

Once you have created all the required products, you can:

* :ref:`View them all on the product list page <doc--products--actions--view-list>`

* :ref:`View information for an individual product <doc--products--actions--view>`

* :ref:`Edit a product <doc--products--actions--edit>`

* :ref:`Duplicate a product <doc--products--actions--duplicate>`

* :ref:`Delete a product <doc--products--actions--delete>`

* :ref:`Export existing products <export-products>`

* :ref:`Import Products <import-products>`

Simplify Purchase Choices and Increase Sales
--------------------------------------------

.. TODO intro

* :ref:`Manage Featured Products <products--featured-products>`

* :ref:`Highlight New Products <user-guide--new-products>`

* :ref:`Use Product Brands <user-guide--product-brands>`

.. TODO intro

* :ref:`Manage Related Products <products--related-products>`

* :ref:`Manage Up-Sell Products <products--upsell-items>`

* :ref:`Create All Products Page <sys--conf--commerce--catalog--special-pages>`

* :ref:`Enable Previously Purchased Products Page <sys--commerce--orders--previously-purchased--global>`

.. uncomment in DOC-145:

.. ref:`Manage Cross-Sell Products <products--cross-sell-items>`

.. **Related Topics**

.. toctree::
   :hidden:
   :maxdepth: 1

   configure_product_details

   product_brands

   products/index

.. actions/manage_product_taxation


.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin

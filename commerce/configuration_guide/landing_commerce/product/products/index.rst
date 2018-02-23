.. _configuration--products:

Configure Products in System Configuration
------------------------------------------

..  begin_configuration

OroCommerce groups product configuration options into the following categories:

* `Product Units`_

* Image Watermark:

  * `Global Product Image Watermark Configuration`_

  * `Product Image Watermark Configuration Per Website`_

* Image Gallery:

  * `Configure Image Gallery Globally`_

  * `Configure Image Gallery per Organization`_

  * `Configure Image Gallery per Website`_

* Image Preview:

  * `Configure Image Preview on Product Listing Page Globally`_

  * `Configure Image Preview on Product Listing Page per Organization`_

  * `Configure Image Preview on Product Listing Page per Website`_

* New Arrivals:

  * `Enable New Product Icons Globally`_

  * `Enable New Product Icons per Organization`_

  * `Enable New Product Icons per Website`_

* Featured Products:

  * `Select a Featured Products Segment to Use Globally`_

  * `Select a Featured Products Segment to Use Per Organization`_

  * `Select a Featured Products Segment to Use Per Website`_

* Previously Purchased Products:

  * `Enable and Set Up Previously Purchased Products Globally`_

  * `Enable and Set Up Previously Purchased Products per Website`_

* Configurable Products:

  * `Customize Configurable Products Globally`_

  * `Customize Configurable Products Settings per Organization`_

  * `Customize Configurable Products Settings per Website`_

* Related Items:

  * Related Products:

    * `Enable and Set Up Related Products Globally`_

    * `Enable and Set Up Related Products per Organization`_

    * `Enable and Set Up Related Products per Website`_

  * Up-Sell Products:

    * `Enable and Set Up Up-Sell Products Globally`_

    * `Enable and Set Up Up-Sell Products per Organization`_

    * `Enable and Set Up Up-Sell Products per Website`_

* :ref:`All Products Page <sys--conf--commerce--catalog--special-pages>`



.. uncomment for DOC-145:

..  To configure Cross-Sell Products:
    * `Enable and Set Up Cross-Sell Products Globally`_
    * `Enable and Set Up Cross-Sell Products per Organization`_
    * `Enable and Set Up Cross-Sell Products per Website`_

Product Units
^^^^^^^^^^^^^

.. include:: /configuration_guide/landing_commerce/product/products/units.rst
   :start-after: begin

Image Watermark
^^^^^^^^^^^^^^^

Global Product Image Watermark Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/global_images.rst
   :start-after: begin

Product Image Watermark Configuration Per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/website_images.rst
   :start-after: begin
   :end-before: finish

Image Gallery
^^^^^^^^^^^^^

Configure Image Gallery Globally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/global_gallery.rst
   :start-after: begin
   :end-before: finish

Configure Image Gallery Per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/organization_gallery.rst
   :start-after: begin
   :end-before: finish

Configure Image Gallery Per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/website_gallery.rst
   :start-after: begin
   :end-before: finish

Image Preview on Product Listing Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Configure Image Preview on Product Listing Page Globally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/global_image_preview.rst
   :start-after: begin
   :end-before: finish

Configure Image Preview on Product Listing Page per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/organization_image_preview.rst
   :start-after: begin
   :end-before: finish


Configure Image Preview on Product Listing Page per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/website_image_preview.rst
   :start-after: begin
   :end-before: finish

New Arrivals
^^^^^^^^^^^^

Enable New Product Icons Globally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/global_new_arrivals.rst
   :start-after: begin
   :end-before: finish

Enable New Product Icons per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/organization_new_arrivals.rst
   :start-after: begin
   :end-before: finish

Enable New Product Icons per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/website_new_arrivals.rst
   :start-after: begin
   :end-before: finish

Featured Products
^^^^^^^^^^^^^^^^^

Select a Featured Products Segment to Use Globally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/global_featured_products.rst
   :start-after: begin
   :end-before: finish

Select a Featured Products Segment to Use Per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/organization_featured_products.rst
   :start-after: begin
   :end-before: finish

Select a Featured Products Segment to Use Per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/website_featured_products.rst
   :start-after: begin
   :end-before: finish

Previously Purchased Products
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The previously purchased products page displays the products that were recently purchased by customer users. In the storefront, this page is nested under the **Previous Purchased** menu in **Account**.

.. image:: /configuration_guide/img/configuration/product/previously_purchased/PreviouslyPurchasedFrontStore.png


The previously purchased products page is disabled by default, but you can enable it on two levels -- globally and per website. Once enabled, you can also set the number of days that the purchase history should cover.

.. note:: Please keep in mind that :ref:`visibility restrictions <products--product-visibility>` may affect the visibility of products for the previously purchased products page. Consequently, if the product is hidden for a specific website, category, customer group, etc., it will not be available on the previously purchased list.


Enable and Set Up Previously Purchased Products Globally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/global_previously_purchased.rst
   :start-after: begin
   :end-before: finish

Enable and Set Up Previously Purchased Products per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/website_previously_purchased.rst
   :start-after: begin
   :end-before: finish


Configurable Products
^^^^^^^^^^^^^^^^^^^^^

Customize Configurable Products Globally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/configurable_product/global_configurable_products.rst
   :start-after: begin
   :end-before: finish


Customize Configurable Products Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/configurable_product/configurable_products_organization.rst
   :start-after: begin
   :end-before: finish

Customize Configurable Products Settings per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/landing_commerce/product/products/configurable_product/configurable_products_website.rst
   :start-after: begin
   :end-before: finish

Related Products
^^^^^^^^^^^^^^^^

.. include:: /configuration_guide/landing_commerce/product/products/related_products/index.rst
   :start-after: begin_related_products_configuration
   :end-before: finish_related_products_configuration

Upsell Items
^^^^^^^^^^^^

.. include:: /configuration_guide/landing_commerce/product/products/upsell_items/index.rst
   :start-after: begin_upsell_items_configuration
   :end-before: finish_upsell_items_configuration

.. uncomment for DOC-145

.. Cross-Sell Items^^^^^^^^^^^^^^^^
   include:: /user_guide/products/configuration/cross_sell_items/index.rst
   :start-after: begin_cross_sell_items_configuration
   :end-before: finish_cross_sell_items_configuration

All Products Page
^^^^^^^^^^^^^^^^^

All Products page displays all available products from the master catalog grouped by categories. See :ref:`All Products Page <sys--conf--commerce--catalog--special-pages>` topic for more information on how to enable All Products page and include it in the web catalog or frontend menu on the OroCommerce storefront.

.. finish_configuration

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:

   units

   global_images

   website_images

   global_gallery

   organization_gallery

   website_gallery

   global_image_preview

   organization_image_preview

   website_image_preview

   global_new_arrivals

   global_new_arrivals_block

   organization_new_arrivals

   organization_new_arrivals_block

   website_new_arrivals

   global_new_arrivals_block

   organization_new_arrivals_block

   website_new_arrivals_block

   global_featured_products

   organization_featured_products

   website_featured_products

   global_previously_purchased

   website_previously_purchased

   related_products/index

   upsell_items/index

   all_products

   configurable_product/index

.. uncomment for DOC-145

.. cross_sell_items/index

.. _products--featured-products:

Manage Featured Products
------------------------

.. begin_featured_products

You can mark some of the products as featured to display them in the Featured Products block on the main landing page (home page) in the front store.

.. image:: /user_guide/img/products/products/FeatruedProducts.png

Customize Featured Products Segment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can customize the way products are filtered for the featured products block by doing the following:

* Extend the number of products that are displayed in the Featured Products block,
* Provide additional filter on top of the default one (Product.IsFeatured is Yes).

Create Custom Featured Product Segment for Organization or Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable showing different products as featured on some websites, you may create
a new segments with custom filtering conditions and configure the organization
or website to use the customized version instead of the default one.

To create a new custom segment for featured products:

1. Navigate to **Reports & Segments > Manage Segments** in the main menu.

#. Click **Create Segment** on the top right of the page.

#. Configure a new segment to have a distinct name and the necessary filtering condition. For more detailed steps, please see :ref:`Create Segment <user-guide--business-intelligence--create-segments>` topic.

   **Sample Featured Products segment (default configuration)**

   .. image:: /user_guide/img/products/products/FeaturedProductSegment.png

#. Click **Save**.

Now you can enable this segment to be the source of featured products in the :ref:`website <sys--websites--commerce--products--featured-products>` or :ref:`organization <sys--users--organization--commerce--products--featured-products>` configuration.


Mark a Product as Featured
~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/products/products/actions_details/make_featured.rst
   :start-after: start_products_actions_featured_mark
   :end-before: stop_products_actions_featured_mark

Remove a Product from Featured Products
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /user_guide/products/products/actions_details/make_featured.rst
   :start-after: start_products_actions_featured_remove
   :end-before: stop_products_actions_featured_remove

Source Configuration for Featured Products Block
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Configuring the Feature Product segment can be done globally, per website and organization.

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

.. finish_featured_products

.. include:: /user_guide/include_images.rst
   :start-after: begin

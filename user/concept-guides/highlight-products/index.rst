.. _doc--products--manage-inventory-prices-look:

:oro_documentation_types: commerce

Products in the Storefront
==========================

When the required number of products has been created or imported, you can further improve on their visual representation on the storefront to simplify purchase choices for your buyers. Usually, these options are :ref:`configured per level <configuration--guide--config-levels>`:

.. note:: You can also view the complete reference of these :ref:`product-related settings in system configuration <configuration--products>`.

* Add product image watermarks (:ref:`globally <sys--commerce--product--product-images>` and :ref:`per website <sys--websites--commerce--product--product-images>`) --- to add a branded watermark to all the product images.

* Configure product image gallery (:ref:`globally <sys--commerce--product--product-images--gallery-slider-global>`, :ref:`per organization <sys--users--organization--commerce--products--gallery-slider>`, and :ref:`per website <sys--websites--commerce--product--gallery-slider>`) --- to use popup or inline view for the image gallery.

* Configure image preview on product listing page (:ref:`globally <sys--commerce--product--product-images--image-preview--global>`, :ref:`per organization <sys--commerce--product--product-images--image-preview--organization>`, and :ref:`per website <sys--commerce--product--product-images--image-preview--website>`) --- to see the product image gallery instead of the product page when clicking on the image in the product listing.

*  Add a new arrivals flag (:ref:`globally <sys--commerce--product--new-arrivals>`, :ref:`per organization <sys--users--organization--commerce--products--new-arrivals>`, and :ref:`per website <sys--websites--commerce--products--new-arrivals>`) --- to highlight the new products in your web catalog.

* Create a featured products segment (:ref:`globally <sys--commerce--product--featured-products>`, :ref:`per organization <sys--users--organization--commerce--products--featured-products>`, and :ref:`per website <sys--websites--commerce--products--featured-products>`) -- to store the selected products that are displayed on the crowded paths of you website.

* Configure previously purchased products (:ref:`globally <sys--commerce--orders--previously-purchased--global>` and :ref:`per website <sys--commerce--orders--previously-purchased--website>`) --- to display products that customer users have bought recently.

* Configure :ref:`related products <products--related-products>` (:ref:`globally <sys--commerce--catalog--relate-products>`, :ref:`per organization <sys--users--organization--commerce--catalog--related-products>`, and :ref:`per website <sys--websites--commerce--catalog--related-products>`) --- to bind similar products or those that complement each other, like the item and its accessories.

* Configure :ref:`up-sell products <products--upsell-items>` (:ref:`globally <sys--commerce--catalog--upsell-products>`, :ref:`per organization <sys--users--organization--commerce--catalog--upsell-products>`, and :ref:`per website <sys--websites--commerce--catalog--upsell-products>`) --- to bind products that should be promoted with the product being viewed, like more expensive alternatives of the model, upgrade options, additional parts.

* Configure the :ref:`All Products page <sys--conf--commerce--catalog--special-pages>` -- to display all available products from the master catalog grouped by categories.


.. note:: Remember you can :ref:`associate product with a specific brand <user-guide--product-brands>` for easier search in the storefront.

.. toctree::
   :titlesonly:

   featured
   new-arrivals
   related-products
   upsell-items
   all-products/index

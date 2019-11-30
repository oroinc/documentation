:oro_show_local_toc: false

Image Resizing and Watermarks
=============================

Images.yml provides configuration for image manipulations.

Specify image preset sizes and apply watermarks to images with **dimensions** configuration.

Enable users to upload different types of product images that will be displayed in different pages with **types** configuration.

.. note::
   From the back-office, a user can upload image types from all the themes available in the system.

Configuration
-------------

Images configuration file should be placed in the
``layout/{theme_name}/config`` folder and named ``images.yml``, for
example
``DemoBundle/Resources/views/layouts/first_theme/config/images.yml``

**Example:**

.. code:: yaml

    #DemoBundle/Resources/views/layouts/first_theme/config/images.yml
    dimensions:
        product_original:
            width: ~
            height: ~
            options:
                applyProductImageWatermark: true
        product_gallery_popup:
            width: 610
            height: 610
            options:
                applyProductImageWatermark: true
    types:
        main:
            label: oro.product.productimage.type.main.label
            dimensions:
                - product_original
            max_number: 1
        listing:
            label: oro.product.productimage.type.listing.label
            dimensions:
                - product_original
                - product_gallery_popup
            max_number: 1

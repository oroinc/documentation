.. _sys--commerce--product--product-images--image-preview--organization:
.. _sys--users--organization--commerce--products--gallery-slider:

Configure Settings for Product Images per Organization
======================================================

In the Product Images section of Commerce configuration settings, you can control the way images are previewed on product listing pages and configure whether to use popup or inline view for the image gallery per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| more actions menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Products > Product Images** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/products/ImagePreviewOrganization.png
      :class: with-border

4. Clear the **Use System** checkbox to change the system-wide setting.

5. In the **General** section, configure the following options:

   **Enable Original File Names** --- When enabled, the original image file name will be appended to the system-generated hash value. All non-alphanumeric characters (e.g., ":", ")", ",", "~") will be replaced with "-" (dash).

   For example, the name of the file is **coffee_maker/bosch_#RND123.jpg**, the system-generated hash value is "media/cache/attachment/product_gallery_main/5bae287538.jpg". If the option is enabled, the file name will be displayed in the storefront as follows "media/cache/attachment/product_gallery_main/5bae287538-coffee-maker-bosch-RND123.jpg"


6. In the **Image Gallery Options** section, enable or disable product preview on product listing pages in the storefront.

   .. image:: /user/img/system/config_commerce/product/ImagePreviewGlobal.png
      :alt: Global image gallery options configuration settings

   **Enable Image Preview on Product Listing** - Enable the option to add the |ZoomIc| icon to the product image on the product listing page in the storefront which will open a pop up image gallery once clicked.

    .. image:: /user/img/system/config_commerce/product/ImagePreviewStorefront.png
      :alt: Illustration of the Enable Image Preview on Product Listing option in the storefront being enabled and disabled

    .. note:: When **Use System** checkbox is enabled, system settings are applied.

7. Click **Save**.

.. finish

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

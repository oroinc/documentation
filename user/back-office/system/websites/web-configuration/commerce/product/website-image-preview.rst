:oro_documentation_types: OroCommerce

.. _sys--commerce--product--product-images--image-preview--website:
.. _sys--websites--commerce--product--gallery-slider:
.. _sys--commerce--product--product-images--main:
.. _sys--websites--commerce--product--product-images:

Configure Settings for Product Images per Website
=================================================

You can update the product watermark settings, enable image preview and configure whether to use popup or inline view for the image gallery per website:

1. Navigate to  **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Product > Product Images** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/websites/web_configuration/ProductImagesPerWebsiteOptions.png
   :class: with-border

4. Clear the **Use Organization** checkbox to change the organization-wide setting.

5. In the **General** section, configure the following options:

   **Enable Original File Names** --- When enabled, the original image file name will be appended to the system-generated hash value. All non-alphanumeric characters (e.g., ":", ")", ",", "~") will be replaced with "-" (dash).

   For example, the name of the file is **coffee_maker/bosch_#RND123.jpg**, the system-generated hash value is "media/cache/attachment/product_gallery_main/5bae287538.jpg". If the option is enabled, the file name will be displayed in the storefront as follows "media/cache/attachment/product_gallery_main/5bae287538-coffee-maker-bosch-RND123.jpg"

6. In the **Product Image Watermark** section, the following options are available:

   * **File** -- The image file with the watermark on a transparent background.
   * **Size** -- The size of the watermark in percentage compared to the whole image.
   * **Position** -- The watermark position on the image (e.g, top left, top, top right, left, right, center, bottom left, bottom, and bottom right).

7. In the **Image Gallery Options** section, the following options are available:

   * **Enable Image Preview on Product Listing** --- When this option is enabled, clicking on the product image on the product listing page in the storefront will open a pop up image gallery, rather than the product page.

     .. image:: /user/img/system/websites/web_configuration/ImagePreviewEnabledWebsite.png
        :class: with-border

     When the option is disabled, clicking on the product image on the product listing page in the storefront will open the product page.

     .. image:: /user/img/system/websites/web_configuration/ImagePreviewDisabledWebsite.png
        :class: with-border

8. When **Popup Gallery on Product View** is enabled, image gallery in the storefront takes the following form:

   .. image:: /user/img/system/websites/web_configuration/ImageGalleryWebsiteEnabled1.png
      :class: with-border

   By clicking on the image, the pop up gallery is displayed in the middle of the screen:

   .. image:: /user/img/system/websites/web_configuration/ImageGalleryWebsiteEnabled2.png
      :class: with-border

9. When **Popup Gallery on Product View** is disabled, the image gallery takes the form of an inline view:

   .. image::/img/system/websites/web_configuration/ImageGalleryWebsiteDisabled.png
      :class: with-border

   Flick through the pictures in the gallery by pressing < or > arrows without leaving the product page.


.. finish

.. include:: /include/include-images.rst
   :start-after: begin

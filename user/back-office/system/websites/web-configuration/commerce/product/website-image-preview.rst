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

.. note:: As of application version 4.2.11, the **Enable Original File Names** option is hidden. To configure the original image file names, navigate to :ref:`General Setup > Upload Settings <upload-settings--website>` in the system configuration.

4. Clear the **Use Organization** check box to change the organization-wide setting.

5. In the **Product Image Watermark** section, the following options are available:

   * **File** -- The image file with the watermark on a transparent background.
   * **Size** -- The size of the watermark in percentage compared to the whole image.
   * **Position** -- The watermark position on the image (e.g, top left, top, top right, left, right, center, bottom left, bottom, and bottom right).

6. In the **Image Gallery Options** section, the following options are available:

   * **Enable Image Preview on Product Listing** --- When this option is enabled, clicking on the product image on the product listing page in the storefront will open a pop up image gallery, rather than the product page.

     .. image:: /user/img/system/websites/web_configuration/ImagePreviewEnabledWebsite.png
        :class: with-border

     When the option is disabled, clicking on the product image on the product listing page in the storefront will open the product page.

     .. image:: /user/img/system/websites/web_configuration/ImagePreviewDisabledWebsite.png
        :class: with-border

7. When **Popup Gallery on Product View** is enabled, image gallery in the storefront takes the following form:

   .. image:: /user/img/system/websites/web_configuration/ImageGalleryWebsiteEnabled1.png
      :class: with-border

   By clicking on the image, the pop up gallery is displayed in the middle of the screen:

   .. image:: /user/img/system/websites/web_configuration/ImageGalleryWebsiteEnabled2.png
      :class: with-border

8. When **Popup Gallery on Product View** is disabled, the image gallery takes the form of an inline view:

   .. image::/img/system/websites/web_configuration/ImageGalleryWebsiteDisabled.png
      :class: with-border

   Flick through the pictures in the gallery by pressing < or > arrows without leaving the product page.


.. finish

.. include:: /include/include-images.rst
   :start-after: begin

.. _configuration--guide--commerce--configuration--product-images:

Configure Global Settings for Product Images
============================================

On the Product Images configuration page, you can control the way images are previewed on product listing pages and configure whether to use popup or inline view for the image gallery.

To configure the product image settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Product Images** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/product/ProductImages.png
      :alt: Global product image watermark configuration settings

3. To customize the option configuration, clear the **Use Default** checkbox next to the option and select the required value.

4. In the **General** section, configure the following options:

   **Enable Original File Names** --- When enabled, the original image file name will be appended to the system-generated hash value. All non-alphanumeric characters (e.g., ":", ")", ",", "~") will be replaced with "-" (dash).

   For example, the name of the file is **coffee_maker/bosch_#RND123.jpg**, the system-generated hash value is "media/cache/attachment/product_gallery_main/5bae287538.jpg". If the option is enabled, the file name will be displayed in the storefront as follows "media/cache/attachment/product_gallery_main/5bae287538-coffee-maker-bosch-RND123.jpg"


.. _sys--commerce--product--product-images:

5. In the **Product Image Watermark** section, you can control the watermark that will appear on top of every image uploaded as part of product details.

   * **File** — The image file with the watermark on a transparent background.
   * **Size** — The size of the watermark in percentage compared to the whole image.
   * **Position** — The watermark position on the image (e.g., top left, top, top right, left, right, center, bottom left, bottom, and bottom right).


.. _sys--commerce--product--product-images--image-preview--global:

6. In the **Image Gallery Options** section, enable or disable product previews on product listing pages by simplifying product selection for customer.

   .. image:: /user/img/system/config_commerce/product/ImagePreviewGlobal.png
      :alt: Global image gallery options configuration settings

   When **Enable Image Preview on Product Listing** is enabled, clicking on the product image on the product listing page in the storefront will open a pop up image gallery, rather than the product page.

   .. image:: /user/img/system/config_commerce/product/ImagePreviewEnabled.png
      :alt: Illustration of the Enable Image Preview on Product Listing option in the storefront

   When **Enable Image Preview on Product Listing** is disabled, clicking on the product image on the product listing page in the storefront will open the product page.

   .. image:: /user/img/system/config_commerce/product/ImagePreviewDisabled.png
      :alt: Illustration of the Enable Image Preview on Product Listing option disabled

.. _sys--commerce--product--product-images--gallery-slider-global:

7. In the **Image Gallery Options** section, choose whether to use popup or inline view for the image gallery in the storefront.

   .. image:: /user/img/system/config_commerce/product/ImageGallery.png

   When **Popup Gallery on Product View** is enabled, image gallery in the storefront will take the following form:

   .. image:: /user/img/system/config_commerce/product/ImageGalleryEnabled.png
      :alt: Illustration of the Popup Gallery on Product View option in the storefront

   By clicking on the image, the pop up gallery will be displayed in the middle of the screen:

   .. image:: /user/img/system/config_commerce/product/ImageGalleryEnabled2.png
      :class: with-border
      :alt: Displaying the popup gallery functionality

   When **Popup Gallery on Product View** is disabled, the image gallery will take the form of an inline view:

   .. image:: /user/img/system/config_commerce/product/ImageGalleryDisabled.png
      :class: with-border
      :alt: Displaying the popup gallery functionality if the feature is disabled

   Flick through the pictures in the gallery by pressing < or > arrows without leaving the product page.


8. Click **Save Settings**.





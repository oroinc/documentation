.. _configuration--guide--commerce--configuration--product-images:

Product Images
==============

On the Product Images configuration page, you can control the following settings:

* `Image Watermark`_
* `Image Preview on Product Listing Page`_
* `Image Gallery`_

.. _sys--commerce--product--product-images:

Image Watermark
---------------

You can control the watermark that will appear on top of every image uploaded as a part of product details on two levels, globally and :ref:`per website <sys--websites--commerce--product--product-images>`.

To update the product watermark settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Product Images** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user_doc/img/system/config_commerce/product/ProductImages.png

   The following options are available:

   * **File** — The image file with the watermark on a transparent background.
   * **Size** — The size of the watermark in percentage compared to the whole image.
   * **Position** — The watermark position on the image (e.g., top left, top, top right, left, right, center, bottom left, bottom, and bottom right).

3. To customize any of these options:

     a) Clear the **Use Default** check box next to the option.
     b) Enter the updated size or select the position from the list.

4. Click **Save**.

.. _sys--commerce--product--product-images--image-preview--global:

Image Preview on Product Listing Page
-------------------------------------

To simplify product selection for customer, you can enable product previews on product listing pages. This can be done on three levels, globally, :ref:`per organization <sys--commerce--product--product-images--image-preview--organization>` and :ref:`per website <sys--commerce--product--product-images--image-preview--website>`.

To enable image preview globally:

1. Navigate to the system configuration (click **System > Configuration** in the main menu).
2. Select **Commerce > Product > Product Images** in the menu to the left.

   .. note::
     For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user_doc/img/system/config_commerce/product/ImagePreviewGlobal.png
      :class: with-border

3. When **Enable Image Preview on Product Listing** is enabled, clicking on the product image on the product listing page in the storefront will open a pop up image gallery, rather than the product page.

   .. image:: /user_doc/img/system/config_commerce/product/ImagePreviewEnabled.png
      :class: with-border

4. When **Enable Image Preview on Product Listing** is disabled, clicking on the product image on the product listing page in the storefront will open the product page.

   .. image:: /user_doc/img/system/config_commerce/product/ImagePreviewDisabled.png
      :class: with-border

   .. note:: By default, **Enable Image Preview on Product Listing** is enabled.

5. Click **Save**.

.. _sys--commerce--product--product-images--gallery-slider-global:

Image Gallery
-------------

You can choose whether to use popup or inline view for the image gallery in the storefront.

.. hint:: This can be configured on three levels, globally, :ref:`per organization <sys--users--organization--commerce--products--gallery-slider>` and :ref:`per website <sys--websites--commerce--product--gallery-slider>`.

To configure image gallery options globally:

1. Navigate to the system configuration (click **System > Configuration** in the main menu).
2. Select **Commerce > Product > Product Images** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user_doc/img/system/config_commerce/product/ImageGallery.png
   :class: with-border

3. When **Popup Gallery on Product View** is enabled, image gallery in the storefront will take the following form:

   .. image:: /user_doc/img/system/config_commerce/product/ImageGalleryEnabled.png
      :class: with-border

   By clicking on the image, the pop up gallery will be displayed in the middle of the screen:

   .. image:: /user_doc/img/system/config_commerce/product/ImageGalleryEnabled2.png
      :class: with-border

4. When **Popup Gallery on Product View** is disabled, the image gallery will take the form of an inline view:

   .. image:: /user_doc/img/system/config_commerce/product/ImageGalleryDisabled.png
      :class: with-border

   Flick through the pictures in the gallery by pressing < or > arrows without leaving the product page.

   .. note:: By default, **Popup Gallery on Product View** is enabled.

5. Click **Save Settings**.





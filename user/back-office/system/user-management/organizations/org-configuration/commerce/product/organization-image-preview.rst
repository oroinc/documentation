:oro_documentation_types: OroCommerce

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

.. note:: As of application version 4.2.11, the **Enable Original File Names** option is hidden. To configure the original image file names, navigate to :ref:`General Setup > Upload Settings <configuration-guide--system-configuration--general-setup-sysconfig--upload-settings-organization>` in the system configuration.

4. Clear the **Use System** check box to change the system-wide setting.
5. In the **Image Gallery Options** section, enable or disable the required options.

**Enable Image Preview on Product Listing**:

   * When **Enable Image Preview on Product Listing** is enabled, clicking on the product image on the product listing page in the storefront will open a pop up image gallery, rather than the product page.

     .. image:: /user/img/system/user_management/org_configuration/products/ImagePreviewOrgEnabled.png
       :class: with-border

   * When **Enable Image Preview on Product Listing** is disabled, clicking on the product image on the product listing page in the storefront will open the product page.

    .. image:: /user/img/system/user_management/org_configuration/products/ImagePreviewOrgDisabled.png
       :class: with-border

    .. note:: When **Use System** checkbox is enabled, system settings are applied.

**Popup Gallery on Product View**

   * When **Popup Gallery on Product View** is enabled, image gallery in the storefront will take the following form:

     .. image::/img/system/user_management/org_configuration/products/ImageGalleryOrganizationEnabled.png
        :class: with-border

     By clicking on the image, the pop up gallery will be displayed in the middle of the screen:

     .. image:: /user/img/system/user_management/org_configuration/products/ImageGalleryOrganizationEnabled2.png
        :class: with-border

   * When **Popup Gallery on Product View** is disabled, the image gallery will take the form of an inline view:

     .. image:: /user/img/system/user_management/org_configuration/products/ImageGalleryOrganizationDisabled.png
        :class: with-border

     Flick through the pictures in the gallery by pressing < or > arrows without leaving the product page.

6. Click **Save**.

.. finish

.. include:: /include/include-images.rst
   :start-after: begin
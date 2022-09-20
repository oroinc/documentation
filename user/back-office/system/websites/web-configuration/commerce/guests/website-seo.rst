:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--guest-seo--website:

Configure SEO Settings per Website
==================================

.. hint:: The SEO configuration is available starting from v5.0.3. To check which application version you are running, see the :ref:`system information <system-information>`.

.. image:: /user/img/system/config_commerce/seo/website-seo-settings.png
   :alt: SEO settings configuration per website

Disable Product Microdata Without Prices
----------------------------------------

All products that do not have assigned prices contain Schema.org Microdata markup with a product schema without price information. Some search crawlers (e.g., Google) consider these products invalid and can exclude them from the search index.

To prevent products without prices from being blocked by search crawlers, it is recommended to disable Schema.org Microdata for such products. This can be done :ref:`globally <sys--conf--commerce--guest-seo--global>`, :ref:`per organization <sys--conf--commerce--guest-seo--org>`, and per website.

To configure the settings per website:

1. Navigate to **System > Websites**.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website, and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Guests > SEO** in the menu on the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Select the **Disable Product Microdata Without Prices** checkbox. The option is disabled by default.
5. Click **Save Settings**.

Enable Product Description
--------------------------

You can control which product field will be used for the Schema.org description property :ref:`globally <sys--conf--commerce--guest-seo--global>`, :ref:`per organization <sys--conf--commerce--guest-seo--org>`, and per website.

To configure the settings per website:

1. Navigate to **System > Configuration > Commerce > Guests > SEO**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

2. Select the **Include Product Description** checkbox to include product description into schema.org markup for products.
3. In the **Used Product Description Field**, select the description type from the dropdown. Available options are *Simplified [Long] Description*, *SEO Meta Description*, and *Simplified Short Description*.

.. note:: Option **Used Product Description Field** works only when **Include Product Description** is enabled.

4. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin
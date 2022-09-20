:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--guest-seo--website:

Configure SEO Settings per Website
==================================

All products that do not have assigned prices contain Schema.org Microdata markup with a product schema without price information. Some search crawlers (e.g., Google) consider these products invalid and can exclude them from the search index.

To prevent products without prices from being blocked by search crawlers, it is recommended to disable Schema.org Microdata for such products. This can be done :ref:`globally <sys--conf--commerce--guest-seo--global>`, :ref:`per organization <sys--conf--commerce--guest-seo--org>`, and per website.


To configure the settings per website:

1. Navigate to **System > Websites**.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website, and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Guests > SEO** in the menu on the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Select the **Disable Product Microdata Without Prices** checkbox. The option is enabled by default.
5. In the **Used Product Description Field**, select the type of the description field from the dropdown. Available options are *Simplified [Long] Description*, *SEO Meta Description*, and *Simplified Short Description*.
6. Click **Save Settings**.

.. image:: /user/img/system/config_commerce/seo/website-seo-settings.png
   :alt: SEO settings configuration per website

.. include:: /include/include-images.rst
   :start-after: begin
.. _sys--conf--commerce--guest-seo--org:

Configure SEO Settings per Organization
=======================================

To configure the SEO settings per organization:

1. Navigate to **System > User Management > Organizations**.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization, and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Guests > SEO** in the menu on the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/seo/org-seo-settings.png
   :alt: SEO settings configuration per organization

4. Clear the **Use System** checkbox to change the system-wide settings.

5. In the **Schema.org** section, configure the following options:

   * **Disable Product Microdata Without Price** --- Select the option to disable Schema.org Microdata for the products without prices. All products that do not have assigned prices contain the Schema.org Microdata markup with a product schema without price information. Some search crawlers (e.g., Google) consider these products invalid and can exclude them from the search index. To prevent products without prices from being blocked by search crawlers, it is recommended to disable the Schema.org Microdata, unless you have an alternative custom solution (e.g., reviews or aggregated ratings system) in place.

   * **Used Product Description Field** --- The setting enables you to control which product field to be used for the Schema.org description property. Select the required description type from the dropdown. Available options are *Simplified [Long] Description*, *SEO Meta Description*, and *Simplified Short Description*.

6. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin
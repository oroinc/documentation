:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--guest-seo--org:

Configure SEO Settings per Organization
=======================================

All products that do not have assigned prices contain Schema.org Microdata markup with a product schema without price information. Some search crawlers (e.g., Google) consider these products invalid and can exclude them from the search index.

To prevent products without prices from being blocked by search crawlers, it is recommended to disable Schema.org Microdata for such products. This can be done :ref:`globally <sys--conf--commerce--guest-seo--global>`, per organization, and :ref:`per website <sys--conf--commerce--guest-seo--website>`.


To configure the settings per organization:

1. Navigate to **System > User Management > Organizations**.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization, and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Guests > SEO** in the menu on the left.


.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Select the **Disable Product Microdata Without Prices** checkbox. The option is enabled by default.
5. Click **Save Settings**.

.. image:: /user/img/system/config_commerce/seo/org-seo-settings.png
   :alt: SEO settings configuration per organization

.. include:: /include/include-images.rst
   :start-after: begin
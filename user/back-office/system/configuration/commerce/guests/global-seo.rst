.. _sys--conf--commerce--guest-seo--global:

Configure Global SEO Settings
=============================

The SEO settings can be configured globally, :ref:`per organization <sys--conf--commerce--guest-seo--org>`, and :ref:`per website <sys--conf--commerce--guest-seo--website>`.

1. Navigate to **System > Configuration > Commerce > Guests > SEO**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/seo/global-seo-settings.png
   :alt: Global SEO settings configuration

2. Clear the **Use Default** checkbox to customize the default options.

3. In the **Schema.org** section, configure the following options:

   * **Disable Product Microdata Without Price** --- Select the option to disable Schema.org Microdata for the products without prices. All products that do not have assigned prices contain the Schema.org Microdata markup with a product schema without price information. Some search crawlers (e.g., Google) consider these products invalid and can exclude them from the search index. To prevent products without prices from being blocked by search crawlers, it is recommended to disable the Schema.org Microdata, unless you have an alternative custom solution (e.g., reviews or aggregated ratings system) in place.

  * **Used Product Description Field** --- The setting enables you to control which product field to be used for the Schema.org description property. Select the required description type from the dropdown. Available options are *Simplified [Long] Description*, *SEO Meta Description*, and *Simplified Short Description*.

4. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--guest-seo--global:

Configure Global SEO Settings
=============================

Disable Product Microdata Without Prices
----------------------------------------

.. hint:: This configuration is available starting from v5.0.3. To check which application version you are running, see the :ref:`system information <system-information>`.

All products that do not have assigned prices contain Schema.org Microdata markup with a product schema without price information. Some search crawlers (e.g., Google) consider these products invalid and can exclude them from the search index.

To prevent products without prices from being blocked by search crawlers, it is recommended to disable Schema.org Microdata for such products. This can be done globally, :ref:`per organization <sys--conf--commerce--guest-seo--org>`, and :ref:`per website <sys--conf--commerce--guest-seo--website>`.

To configure the settings globally:

1. Navigate to **System > Configuration > Commerce > Guests > SEO**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

2. Select the **Disable Product Microdata Without Prices** checkbox. The option is disabled by default.
3. Click **Save Settings**.

Enable Product Description
--------------------------

.. hint:: This configuration is available starting from v5.0.7. To check which application version you are running, see the :ref:`system information <system-information>`.

You can control which product field will be used for the Schema.org description property globally, :ref:`per organization <sys--conf--commerce--guest-seo--org>`, and :ref:`per website <sys--conf--commerce--guest-seo--website>`.

To configure the settings globally:

1. Navigate to **System > Configuration > Commerce > Guests > SEO**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

2. Select the **Include Product Description** checkbox to include product description into schema.org markup for products.
3. In the **Used Product Description Field**, select the description type from the dropdown. Available options are *Simplified [Long] Description*, *SEO Meta Description*, and *Simplified Short Description*.

.. note:: Option **Used Product Description Field** works only when **Include Product Description** is enabled.

4. Click **Save Settings**.

.. image:: /user/img/system/config_commerce/seo/global-seo-settings.png
   :alt: Global SEO settings configuration
   
.. include:: /include/include-images.rst
   :start-after: begin
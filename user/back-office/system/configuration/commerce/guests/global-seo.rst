:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--guest-seo--global:

Configure Global SEO Settings
=============================

The SEO-related settings can be configured globally, :ref:`per organization <sys--conf--commerce--guest-seo--org>`, and :ref:`per website <sys--conf--commerce--guest-seo--website>`.

To configure the settings globally:

1. Navigate to **System > Configuration > Commerce > Guests > SEO**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/seo/global-seo-settings.png
   :alt: Global SEO settings configuration


2. **Disable Product Microdata Without Prices** --- The setting disables Schema.org Microdata for products without prices. All products that do not have assigned prices contain Schema.org Microdata markup with a product schema without price information. Some search crawlers (e.g., Google) consider these products invalid and can exclude them from the search index. Select the checkbox to prevent products without prices from being blocked by search crawlers (available starting from v5.0.3. To check which application version you are running, see the :ref:`system information <system-information>`).

3. **Include Product Description** --- Select the checkbox to include product description into the Schema.org markup for products (available starting from v5.0.7. To check which application version you are running, see the :ref:`system information <system-information>`).

4. **Used Product Description Field** --- Select which product description field type will be used for the Schema.org description property from the dropdown. Available options are *Simplified [Long] Description*, *SEO Meta Description*, and *Simplified Short Description* (available starting from v5.0.7. To check which application version you are running, see the :ref:`system information <system-information>`).

5. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin
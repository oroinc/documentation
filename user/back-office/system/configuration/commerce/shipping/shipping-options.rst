:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--shipping--shipping-options:
.. _user-guide--shipping--product-shipping-info:

.. System > Configuration > Commerce > Shipping > Shipping Options

Configure Global Settings for Shipping Options
==============================================

Shipping Options
----------------

You can enable and disable the shipping units of length and weight (and the freight class) that are available in OroCommerce out of the box. The enabled options are used in the customer orders and product shipping details.

To change these shipping options:

1. Navigate to the system configuration (click **System > Configuration** in the main menu).
2. Select **Commerce > Shipping > Shipping Options** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/shipping/ShippingOptions.png
      :class: with-border
      :alt: Global shipping options configuration

   The following options are available on the page:

   * Allowed Units of Length:

     - inch
     - foot
     - centimeter
     - meter

   * Allowed Units of Weight:

     - pound
     - kilogram

   * Allowed Freight Classes:

     - parcel

3. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select/deselect the option by holding *Ctrl* and clicking on the value (e.g. pound).

4. Click **Save**.

Shipping Options per Product
----------------------------

To enable shipping cost estimation by an integrated system, like UPS, every product in an order or a quote should have the shipping information. This information combined with the shipping origin and destination address helps the integrated system calculate the shipping cost with acceptable accuracy.

Sample shipping information in the product details:

.. image::  /user/img/system/config_commerce/shipping/shipping_options_per_product_new.png
   :alt: Sample shipping options configuration for a medical tag product

It is recommended to add shipping information for every product unit.



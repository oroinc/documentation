:oro_documentation_types: OroCommerce

.. _user-guide--taxes--eu:

Configure Global Settings for EU VAT Tax (Digital Products)
===========================================================

.. important:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

The EU VAT tax is applied when the digital goods' buyer is located in EU. The tax is calculated based on the shipping destination, and the global system tax calculation rules are ignored.

.. note::  To ensure that the value added tax for digital products is included in your purchase quotes and orders from and to European Union, list all digital product tax codes in the EU VAT Tax configuration.

To configure the digital product codes that are taxable in EU:

1. Navigate to **System > Configuration > Commerce > Taxation > EU VAT Tax**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image::  /user/img/system/config_commerce/taxation/ConfigurationSystemTaxationEUVatTaxes.png
      :alt: Global EU VAT Tax configuration

2. Clear the **Use Default** check box and click **Choose the value**. To filter the list of product tax codes, start typing the code name. The list refreshes automatically to show the values matching the text you enter. Once the necessary product code is found, select it to add to the Digital Products Tax Codes list.

3. Click **Save**.
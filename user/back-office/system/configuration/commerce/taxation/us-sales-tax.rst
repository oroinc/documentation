:oro_documentation_types: OroCommerce

.. _user-guide--taxes--us:

Configure Global Settings for US Sales Tax (Digital Products)
=============================================================

.. hint:: This section is part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides a general understanding of the tax configuration and management in OroCommerce.

When the digital product is purchased from the shipping origin address in the state with zero tax rate for digital products, the tax is calculated based on the shipping destination, and the global system tax calculation rules are ignored.

.. note:: To ensure that the US sales tax for digital products is correctly calculated and included in your purchase quotes and orders when you sell to the US customers or from the US warehouse, label the necessary digital product tax codes in OroCommerce as taxable in the US.


.. image:: /user/img/system/config_commerce/taxation/us_sales_tax.png
   :alt: Global US sales tax configuration

To label digital product codes in OroCommerce as taxable in the US:

1. Navigate to **System > Configuration > Commerce > Taxation > US Sales Tax**.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

2. Clear the **Use Default** check box and click **Choose the value**. To filter the list of product tax codes, start typing the code name. The list refreshes automatically to show the values matching the text you enter. Once the necessary product code is found, select it to add to the Digital Products Tax Codes list.

3. Click **Save**.
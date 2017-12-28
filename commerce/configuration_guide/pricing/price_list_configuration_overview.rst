.. _understanding-price-list-configuration:

Understanding Price List Configuration
--------------------------------------

.. begin

In the website, customer group, and customer details, the **Price Lists** section contains a set of price lists used for price calculation on a website, for a customer group, or for a customer. Price list configuration may fall back to the system default price list configuration or to the default price list configuration for the website, customer group, and customer.

**Price Lists Fallback Options**

+-----------------------------------------------------------------------+-----------------------------------------------+
| Configuration Level                                                   | Fallback Configuration Options                |
+=======================================================================+===============================================+
| :ref:`System Configuration <sys--config--commerce--catalog--pricing>` | ---                                           |
+-----------------------------------------------------------------------+-----------------------------------------------+
| :ref:`Website <sys--website--edit--price-lists>`                      | * System Configuration (config)               |
|                                                                       | * Current website only                        |
+-----------------------------------------------------------------------+-----------------------------------------------+
| :ref:`Customer Group <customers--customer-groups--edit--price-lists>` | * Website                                     |
|                                                                       | * Current customer group only                 |
+-----------------------------------------------------------------------+-----------------------------------------------+
| :ref:`Customer <customers--customers--edit--price-lists>`             | * Customer Group                              |
|                                                                       | * Current customer only                       |
+-----------------------------------------------------------------------+-----------------------------------------------+

**Price Selection Strategy**

Depending on the price selection strategy that is selected :ref:`globally in the system configuration<sys--config--commerce--catalog--pricing>`, every price list might or might not have the **Merge Allowed** option.

When the *Minimal Price* is selected as the pricing strategy, OroCommerce looks up the minimal price for various tiers of amount and the product units, and the **Merge Allowed** option is ignored and hidden:

.. image:: /configuration_guide/img/configuration/catalog/pricing/pricing_pricelist.png

When the *Merge by priority* is selected as the pricing strategy, the OroCommerce considers the price list priority and *Merge Allowed* flags to look up all the available price per units and tiers of amount:

.. image:: /configuration_guide/img/configuration/catalog/pricing/pricing_pricelist2.png

.. note:: Price lists with higher priority are on top.

.. finish

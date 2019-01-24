.. _bundle-docs-commerce-inventory-bundle:

OroInventoryBundle
==================

OroInventoryBundle enables the OroCommerce management console users to specify and manage current inventory levels for every product and set up a threshold for the low inventory status.
The low inventory highlights functionality adds an inventory status message to products when their quantity drops below the value defined in Low Inventory Threshold. Reaching the defined Low Inventory Threshold level triggers a warning message to the buyer in the front store.

**Table of Contents**

* `Configuration <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#configuration>`__
* `Options <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#options>`__
* `Listeners <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#listeners>`__

  * `ProductDatagridListener <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#productdatagridlistener>`__
  * `LowInventoryCheckoutLineItemValidationListener <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#lowinventorycheckoutlineitemvalidationlistener>`__

* `Providers <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#providers>`__

  * `LowInventoryProvider <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#lowinventoryprovider>`__

* `Twig Extensions <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#twig-extensions>`__

  * `LowInventoryExtension <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#lowinventoryextension>`__

* `Validators <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#validators>`__

  * `LowInventoryCheckoutLineItemValidator <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/InventoryBundle/Resources/doc/low_inventory_highlights.md#lowinventorycheckoutlineitemvalidator>`__
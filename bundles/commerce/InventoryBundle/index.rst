.. _bundle-docs-commerce-inventory-bundle:

OroInventoryBundle
==================

OroInventoryBundle enables the OroCommerce back-office users to specify and manage current inventory levels for every product and set up a threshold for the low inventory status.
The low inventory highlights functionality adds an inventory status message to products when their quantity drops below the value defined in Low Inventory Threshold. Reaching the defined Low Inventory Threshold level triggers a warning message to the buyer in the storefront.

Configuration
-------------

.. code-block:: yaml
   :linenos:

    product_inventory_options:
        children:
            - oro_inventory.highlight_low_inventory
            - oro_inventory.low_inventory_threshold

The `oro_inventory.highlight_low_inventory` option is used to enable highlighting low inventory for products. Contains the ``true`` or ``false`` values.
When the quantity of the product is lower than or equals the value of the ``oro_inventory.low_inventory_threshold`` option, then the product gets highlighted as low inventory in the storefront.

Options
-------

Two new options are added for products and categories. These options are ``highlightLowInventory`` and ``lowInventoryThreshold``.
These options help configure options for each category or product individually. By default, these options use the value from the system configuration.
To check the currently configured fallback for product or category, use |OroBundleEntityBundleFallbackEntityFallbackResolver|.

Example:

.. code-block:: php
   :linenos:

    $lowInventoryThreshold = $this->entityFallbackResolver->getFallbackValue(
                $product,
                'lowInventoryThreshold'
            );

For more details, check the `LowInventoryProvider`_ section below.

Listeners
---------

ProductDatagridListener
^^^^^^^^^^^^^^^^^^^^^^^

This listener contains the method that adds information about low inventory to the product grid.

onPreBuild
~~~~~~~~~~

This method is called before the grid is built. It adds a new ``low_inventory`` property to the grid configuration that enables adding the low inventory information to the property and thus, displaying it in the layout when required.

onResultAfter
~~~~~~~~~~~~~

This method is called when we execute query and have data result.
This method uses the logic of `LowInventoryProvider`_ . It adds information about the low inventory option for each product in the collection. It also adds a boolean value to ``low_inventory`` which will then be used in the layout.
The following is an |example of using low_inventory| in the layout of the product grid:

.. code-block:: twig
   :linenos:

    {% block _product_datagrid_row__product_low_inventory_label_widget %}
        {% if (product.low_inventory) %}
            <div class="grid">
                <div class="grid__row">{{ "oro.inventory.low_inventory.label"|trans }}</div>
            </div>
        {% endif %}
    {% endblock %}


LowInventoryCheckoutLineItemValidationListener
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The |OroBundleInventoryBundleEventListenerLowInventoryCheckoutLineItemValidationListener| class.
This listener contains a method that checks low inventory for line item products and adds a warning message if a product has low quantity.

onLineItemValidate
~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

    public function onLineItemValidate(LineItemValidateEvent $event)

It validates the product from the line item and adds a warning message if this product has a low inventory level.

Providers
---------

LowInventoryProvider
^^^^^^^^^^^^^^^^^^^^

The |OroBundleInventoryBundleInventoryLowInventoryProvider| class.

This class contains a method that helps you quickly get information about low quantity for the current product or product collection.

isLowInventoryProduct
~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

    public function isLowInventoryProduct(Product $product, ProductUnit $productUnit = null)

This method returns information about the low inventory status of the current product.  It returns ``true`` if the quantity of the product is less than the  ``lowInventoryThreshold`` option.  It returns ``false`` if the quantity of the product is greater than the ``lowInventoryThreshold`` option, or if the ``highlightLowInventory`` is not checked.

isLowInventoryCollection
~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

    /**
      * Returns low inventory flags for product collection.
      * Will be useful for all product listing (Catalog, Checkout, Shopping list)
      *
      * @param array $data products collection with optional ProductUnit's
      * [
      *     [
      *         'product' => Product Entity,
      *         'product_unit' => ProductUnit entity (optional)
      *     ],
      *     ...
      * ]
      *
      * @return array
      * [
      *      'product id' => bool - has low inventory marker,
      *       ...
      *      'product id' => bool
      * ]
      */
     public function isLowInventoryCollection(array $data)


It works in the same way as the `isLowInventoryProduct`_ method, but has differences in taken up arguments and returned values.
This method takes an argument as an array of the |Product entity| and |ProductUnit entity| entities and returns an array of product ids with  a boolean result.
``True``  is returned if the quantity of the product is less than the ``lowInventoryThreshold`` option.  ``False`` is returned if the quantity of the product is greater than the ``lowInventoryThreshold`` option, or if ``highlightLowInventory`` is not checked.

Twig Extensions
---------------

LowInventoryExtension
^^^^^^^^^^^^^^^^^^^^^

The |OroBundleInventoryBundleTwigLowInventoryExtension| class.

This extension depends on `LowInventoryProvider`_ and provides the oro_is_low_inventory_product twig function which is used in twig templates to check low inventory for a specific product.
The following is an example of using this function in twig templates:

.. code-block:: twig
   :linenos:

    {% if (oro_is_low_inventory_product(mainProduct)) %}
            <div class="product-low-inventory">{{ "oro.inventory.low_inventory.label"|trans }}</div>
    {% endif %}


Validators
----------

LowInventoryCheckoutLineItemValidator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The |OroBundleInventoryBundleValidatorLowInventoryCheckoutLineItemValidator| class.
This class contains a method that returns a message if a product has low quantity.

getLowInventoryMessage
~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

    public function getLowInventoryMessage(LineItem $lineItem)

When a product is marked as low inventory, the method returns a string message. Otherwise, it will return ``false``.
This method uses the logic from `LowInventoryProvider`_.


.. include:: /include/include-links-dev.rst
   :start-after: begin
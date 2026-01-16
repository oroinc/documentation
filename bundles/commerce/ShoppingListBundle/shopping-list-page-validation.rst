.. _bundle-docs-commerce-shopping-list-bundle-shopping-list-page-validation:

Shopping List Page Validation
=============================

Enables validation of the shopping list before starting Checkout or Request for Quote (RFQ). Prevents customers from proceeding until all product-related issues - such as inventory status, quantity limits, configuration errors, and similar conditions - are resolved or moved to "Saved for Later".

Configuration
-------------

The ``saved_for_later`` feature toggle enables the ability to move invalid or unwanted shopping list items to a separate "Saved for Later" section instead of deleting them.

To enable it, go to **System > Configuration > Commerce > Sales > Shopping List** and enable:

- **Enable Save For Later**

The feature toggle key is ``saved_for_later`` and the system configuration option is ``oro_shopping_list.saved_for_later_enabled``.

Validation Architecture
-----------------------

The shopping list validation is based on a modular architecture that determines whether each line item can be used for Checkout or Request for Quote (RFQ).

The validation logic is encapsulated in the ``\Oro\Bundle\ShoppingListBundle\Provider\InvalidShoppingListLineItemsProvider`` class, which identifies invalid line items and determines their severity.

It provides three main public methods:
1. `getInvalidLineItemsIds` - returns a sorted array of line item IDs, with errors first, followed by warnings.
2. `getInvalidLineItemsIdsBySeverity` - returns line item IDs grouped by severity, e.g. ['errors' => [...], 'warnings' => [...]].
3. `getInvalidItemsViolations` - returns detailed validation results grouped by severity, including messages and sub-item data.

Two validation groups are used:
- **datagrid_line_items_data_for_checkout** - for checkout.
- **datagrid_line_items_data_for_rfq** - for RFQ.

The system evaluates every shopping list line item against both groups to determine its severity status:
1. **Error** - defines the contract for component processors.
2. **Warning** - only one validation group fails (the item is invalid for either Checkout or RFQ, but not both).
3. **Valid** - both groups pass successfully.

To improve user experience, all line items in the shopping list are sorted by validation severity:
1. Items with errors are shown first.
2. Then items with warnings.
3. Finally, fully valid items.

Validation Group Resolvers
--------------------------

The validation groups are determined dynamically through validation group resolvers that implement ``ShoppingListValidationGroupResolverInterface``:

- ``ShoppingListToCheckoutValidationGroupResolver`` - determines if checkout validation group is applicable
- ``ShoppingListToRequestQuoteValidationGroupResolver`` - determines if RFQ validation group is applicable

The ``ShoppingListValidationGroupsProvider`` aggregates all applicable validation groups from registered resolvers.

Each resolver implements three methods:

- ``getType()`` - returns a unique type identifier for the resolver
- ``isApplicable()`` - determines if the resolver should be used based on current context (ACL, feature toggles, etc.)
- ``getValidationGroupName()`` - returns the validation group name to use

Service Configuration
---------------------

Validation group resolvers are registered with priorities to control loading order:

.. code-block:: yaml

    services:
        oro_checkout.resolver.shopping_list_to_checkout_validation_group:
            class: Oro\Bundle\CheckoutBundle\Resolver\ShoppingListToCheckoutValidationGroupResolver
            arguments:
                - '@security.authorization_checker'
                - '@oro_checkout.condition.is_workflow_start_from_shopping_list_allowed'
            tags:
                - { name: oro_shopping_list.validation_group, priority: 10 }

        oro_rfp.resolver.shopping_list_to_request_quote_validation_group:
            class: Oro\Bundle\RFPBundle\Resolver\ShoppingListToRequestQuoteValidationGroupResolver
            arguments:
                - '@security.authorization_checker'
            tags:
                - { name: oro_shopping_list.validation_group, priority: 5 }
                - { name: oro_featuretogle.feature, feature: rfp_frontend }

Creating a Custom Validation Group Resolver
-------------------------------------------

To add a new validation group resolver:

1. Create a class implementing ``ShoppingListValidationGroupResolverInterface``:

2. Register the service with the ``oro_shopping_list.validation_group`` tag:

.. code-block:: yaml

    services:
        acme_demo.resolver.custom_validation_group:
            class: Acme\Bundle\DemoBundle\Resolver\CustomValidationGroupResolver
            tags:
                - { name: oro_shopping_list.validation_group, priority: 15 }

Handling Invalid Line Items
---------------------------

When invalid items are detected, users can choose one of two actions:

- **Save For Later & Proceed** - moves invalid items to "Saved for Later" section (requires ``saved_for_later`` feature toggle)
- **Delete All & Proceed** - permanently removes invalid items from the shopping list

The action is determined by the ``action`` parameter passed to ``AjaxShoppingListErrorsModalController``:

- ``save_for_later`` - saves items for later
- ``delete`` - deletes items

The controller automatically selects the appropriate action based on feature toggle availability.

Saved For Later Implementation
------------------------------

Entity Relationship
~~~~~~~~~~~~~~~~~~~

The ``LineItem`` entity has a ``savedForLaterList`` property that establishes a ManyToOne relationship with ``ShoppingList``:

.. code-block:: php

    #[ORM\ManyToOne(targetEntity: ShoppingList::class, inversedBy: 'savedForLaterLineItems')]
    #[ORM\JoinColumn(name: 'saved_for_later_list_id', referencedColumnName: 'id', nullable: true, onDelete: 'CASCADE')]
    protected ?ShoppingList $savedForLaterList = null;

A line item can belong to either:
- The main shopping list (``shoppingList`` property is set, ``savedForLaterList`` is null)
- The saved for later section (``savedForLaterList`` property is set, ``shoppingList`` is null)

The unique constraint on ``LineItem`` includes ``saved_for_later_list_id`` to allow the same product to exist in both the main list and saved for later.

Extending Shopping List Validation with a New Constraint
--------------------------------------------------------

To add a custom validation rule for shopping list line items:

1. Use an Existing Constraint or Create a Custom One (following Symfony’s standard validation approach).
2. Register the Constraint in validation.yml and assign validation Groups:

.. code-block:: yaml

    Oro\Bundle\ShoppingListBundle\Entity\LineItem:
        constraints:
            - Oro\Bundle\InventoryBundle\Validator\Constraints\HasEnoughInventoryLevel:
                groups:
                    - datagrid_line_items_data_for_checkout

.. note:: If your constraint represents a error (i.e., it should prevent both Checkout and RFQ), add both validation groups - **datagrid_line_items_data_for_checkout** and **datagrid_line_items_data_for_rfq**.

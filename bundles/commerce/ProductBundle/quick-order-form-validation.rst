.. _bundle-docs-commerce-product-bundle-quick-order-form-validation:

Quick Order Form Validation
===========================

The Quick Order Form validation system provides a flexible way to validate product data based on different component processors. The validation is component-specific, meaning different validation rules can be applied depending on which component is processing the quick order data.

Validation Architecture
-----------------------

The validation system is built around three main interfaces:

1. **ComponentProcessorInterface** - Defines the contract for component processors.
2. **ComponentProcessorRegistry** - Manages available component processors.
3. **QuickAddCollectionValidator** - Centralizes validation logic for quick add collections.

Component-Specific Validation Groups
------------------------------------

The system uses validation groups that correspond to the ``processor_name`` option from the service configuration tags:

- ``oro_shopping_list_to_checkout_quick_add_processor`` - processor_name for starting checkout
- ``oro_rfp_quick_add_processor`` - processor_name for starting RFQ

These names come from the ``processor_name`` option in the ``oro_product.quick_add_processor`` tag:

.. code-block:: yaml

    services:
        oro_shopping_list.quick_add_processor:
            tags:
                - { name: oro_product.quick_add_processor, processor_name: oro_shopping_list_to_checkout_quick_add_processor }
        
        oro_rfp.quick_add_processor:
            tags:
                - { name: oro_product.quick_add_processor, processor_name: oro_rfp_quick_add_processor }

Each component can have its own set of validation rules defined in the validation configuration files.

How to Apply a New Validation Rule
----------------------------------

To apply a new validation rule for a specific component:

1. **Create constraint and validator** (if needed).
2. **Add the constraint to validation.yml** with the processor_name group:

.. code-block:: yaml

    Oro\Bundle\ProductBundle\Model\QuickAddRow:
        properties:
            yourField:
                - Oro\Bundle\YourBundle\Validator\Constraints\YourCustomConstraint:
                    groups: [oro_shopping_list_to_checkout_quick_add_processor]

Excluding Components from Validation
------------------------------------

To exclude a component from validation, use the processor_name from the service tag:

1. **Use the setExcludedComponentsFromValidation method**:

.. code-block:: php

    $validator = new QuickAddCollectionValidator(
        $validatorInterface,
        $preloadingManager,
        $violationsMapper,
        $componentProcessorRegistry
    );
    
    // Exclude checkout component from validation
    // The processor_name comes from the service tag
    $validator->setExcludedComponentsFromValidation(['oro_shopping_list_to_checkout_quick_add_processor']);

2. **Or configure it in the service definition**:

.. code-block:: yaml

    services:
        oro_product.quick_add_collection_validator:
            class: Oro\Bundle\ProductBundle\QuickAdd\QuickAddCollectionValidator
            calls:
                - [setExcludedComponentsFromValidation, [['oro_shopping_list_to_checkout_quick_add_processor']]]

The processor_name used here must match exactly the ``processor_name`` option from the service tag configuration.

Adding New Component Processors
-------------------------------

To add a new component processor:

1. **Create class** implementing `ComponentProcessorInterface`
2. **Register service** with `oro_product.quick_add_processor` tag and `processor_name` option
3. **Add validation groups** using the same `processor_name` in validation.yml

How to Create Combined Validation Rules
---------------------------------------

Use the ``constraint_group_key`` payload to make validation rules work together and determine error severity:

.. code-block:: yaml

    Oro\Bundle\ProductBundle\Model\QuickAddRow:
        properties:
            product:
                - Oro\Bundle\OrderBundle\Validator\Constraints\HasSupportedInventoryStatus:
                    message: 'oro.shoppinglist.lineitem.inventory_status.checkout_not_supported'
                    configurationPath: 'oro_order.frontend_product_visibility'
                    groups: [oro_shopping_list_to_checkout_quick_add_processor]
                    payload:
                        constraint_group_key: HasSupportedInventoryStatus
                - Oro\Bundle\OrderBundle\Validator\Constraints\HasSupportedInventoryStatus:
                    message: 'oro.shoppinglist.lineitem.inventory_status.rfq_not_supported'
                    configurationPath: 'oro_rfp.frontend_product_visibility'
                    groups: [oro_rfp_quick_add_processor]
                    payload:
                        constraint_group_key: HasSupportedInventoryStatus

**Error vs Warning Logic:**

- **ALL constraints related to the same group key have been violated.** → ERROR
- **SOME (but not all) constraints related to the same group key have been violated** → WARNING

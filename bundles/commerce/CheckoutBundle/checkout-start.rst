Checkout Start
==============

There are several ways to initiate a checkout process in a storefront:

- From a shopping list view page - via the **start_from_shoppinglist** workflow transition
- From a quick order form - via the **start_quickorder_checkout** action group
- From a quote view page - via the **oro_sale_frontend_quote_accept_and_submit_to_order** action
- From an order view page - via the **oro_checkout_frontend_start_from_order** action

Each mentioned checkout method requires a different source entity to provide initial data and line items.

- When started from a shopping list or a quick order form - ``\Oro\Bundle\ShoppingListBundle\Entity\ShoppingList``
- When started from a quote - ``\Oro\Bundle\SaleBundle\Entity\QuoteDemand``
- When started from an order - ``\Oro\Bundle\OrderBundle\Entity\Order``

Checkout workflows fire the following events to check whether a checkout can be started:

- **extendable_condition.shopping_list_start** - to check if a checkout can be started from a shopping list
- **extendable_condition.start_checkout** - to check if a checkout can be started from another source

Out-of-the-box, ``\Oro\Bundle\CheckoutBundle\EventListener\ValidateCheckoutOnStartEventListener`` listens to both of these events and delegates validation to Symfony Validator with different validation group sequence that varies on the source entity used to start a checkout from:

- **Default** - the default validation group
- checkout_start%from_alias% - a variable validation group with placeholder `%from_alias%` that is automatically replaced by the entity alias of a source entity, i.e., `checkout_start_from_shoppinglist`, `checkout_start_from_quote` or `checkout_start_from_order`

.. note:: ``\Oro\Bundle\CheckoutBundle\EventListener\ValidateCheckoutOnStartEventListener`` has the `setValidationGroups` method that allows to customize the validation groups applied during validation

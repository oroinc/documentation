Checkout Finish
===============	

The application must verify a range of conditions before processing the final step of creating an order during checkout. These may include:	

- inventory levels
- quantity to order limits
- prices		

Checkout workflows fire the following events to give others the ability to check whether a checkout could be finished:
		
- **extendable_condition.pre_order_create** - Before submitting the checkout form on the final step, it may be necessary to verify if the user is authorized to complete the checkout process.
- **extendable_condition.before_order_create** - This function is used to verify if a user can proceed with checkout after submitting the checkout form on the final step. It applies additional checks based on the data provided in the last step, such as the Ship Until field.		

Out-of-the-box ``\Oro\Bundle\CheckoutBundle\EventListener\ValidateCheckoutPreOrderCreateEventListener`` listens to event `extendable_condition.pre_order_create` and validates checkout line items by using the Symfony Validator and applies a specific validation group sequence based on the source entity that initiated the checkout process.
		
- **Default** - the default validation group
- **checkout_pre_order_create%from_alias%** - a variable validation group with placeholder `%from_alias%` that is automatically replaced by the entity alias of a source entity, i.e., `checkout_pre_order_create_from_shoppinglist`, `checkout_pre_order_create_from_quote` or `checkout_pre_order_create_from_order`		

There is another event listener called ``\Oro\Bundle\CheckoutBundle\EventListener\ValidateCheckoutBeforeOrderCreateEventListener`` that listens to the `extendable_condition.before_order_create` event. This listener validates the entire checkout entity using the Symfony Validator with a different validation group sequence depending on the source entity used to initiate the checkout process.		

- **Default** - the default validation group
- **checkout_before_order_create%from_alias%** - a variable validation group with placeholder `%from_alias%` that is automatically replaced by the entity alias of a source entity, i.e., `checkout_before_order_create_from_shoppinglist`, `checkout_before_order_create_from_quote` or `checkout_before_order_create_from_order`
		
.. note:: ``\Oro\Bundle\CheckoutBundle\EventListener\ValidateCheckoutPreOrderCreateEventListener`` has the `setValidationGroups` method that allows to customize the validation groups applied during validation

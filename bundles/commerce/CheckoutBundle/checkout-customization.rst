.. _bundle-docs-commerce-checkout-bundle--checkout-customization:

Checkout Customization
======================

OroCommerce's checkout process is powered by the Oro Workflow component, which allows you to create complex workflows with multiple steps, transitions, and conditions. Each step of the checkout process is tied to a form that collects the necessary information from the customer. OroCommerce allows you to customize this process by modifying existing steps, adding new steps, and integrating with third-party systems.

To ensure that your checkout customizations are effective and maintainable, consider the following best practices when building checkout workflows:

 - The workflow engine is powerful, but it can get complex quickly. Keep your workflows modular, easy to manage, and extended with Transition Services. Checkout workflows provided by the OroCheckoutBundle are based on Transition Services, so these services may be reused or customized as any other Symfony service. For more details on Workflow Transition Services, refer to the :ref:`related documentation <backend--workflows--transition-services>`.
 - Avoid unnecessary steps and make sure the user interface is clean and intuitive
 - Cover individual Transition Services with unit/functional testing and create e2e Behat scenarios to test the entire checkout process
 - Create documentation to preserve information about checkout logic, which can become complex over time
 - Use workflow ``metadata`` to make additional information about the checkout workflow available to event listeners/extensions for easier customization
 - Use workflow events and Workflow Definition Builder extensions to modify the logic of existing checkout workflows without copying and pasting the entire workflow definition

In the event that additional intermediate steps are required for the existing checkout process, the ``import`` directive may be employed to import the base workflow definition. Thereafter, the requisite options, including attributes, steps, transitions, or the replacement of existing step and transition values, may be incorporated. To update the transition logic for a Transition Service-based checkout, one may extend the requisite services and modify their logic as needed. Subsequently, the ``transition_service`` option of the transition may be simply rewritten to a new service ID, thereby updating the logic of the existing transition without the necessity of maintaining all changes in YAML when transitions utilize the transition_definition to define their logic.

.. code-block:: yaml


    imports:
        -
            resource: '@OroCheckoutBundle/Resources/config/oro/workflows/b2b_flow_checkout.yml'
            workflow: b2b_flow_checkout
            as: b2b_flow_alternative_checkout
            replace: ['exclusive_active_groups', 'steps.order_review.allowed_transitions']

    workflows:
        b2b_flow_alternative_checkout:
            attributes:
                # Extends the list of attributes of the b2b_flow_checkout.attributes
                allowed:
                    type: bool

            steps:
                order_review:
                    # Overrides b2b_flow_checkout.steps.order_review.allowed_transitions
                    allowed_transitions:
                        - continue_to_request_approval
                        - place_order
                approve_request:
                    order: 90
                    allowed_transitions:
                        - place_order

            transitions:
                place_order:
                    # Overrides Overrides b2b_flow_checkout.transitions.place_order.transition_service
                    transition_service: 'oro_alternativecheckout.workflow.transition.place_order'

                continue_to_request_approval:
                    step_to: approve_request
                    transition_service: 'oro_alternativecheckout.workflow.transition.continue_to_request_approval'
                    is_unavailable_hidden: true
                    frontend_options:
                        is_checkout_continue: true


Use the extended approach to inherit the base workflow with additions. This will simplify upgrades and bring new checkout features and fixes to customization.
If the checkout workflow requires heavy modification, then copying and pasting the base workflow definition or writing it from scratch will be the better decision.

Since checkout workflows are standard Oro Workflow component workflows, all general workflow customization techniques apply equally to checkouts. For details, see :ref:`Workflow Configuration Reference <backend--workflows--config-reference>`, :ref:`Basic Workflow Configuration <backend--workflows--create>`, and :ref:`Workflow Events <backend--workflows--workflow-events>`.

Checkout Workflow Metadata
--------------------------

Checkout workflows provided by the OroCheckoutBundle are marked with the following metadata values:

.. code-block:: yaml


    workflows:
        b2b_flow_checkout:
            # ...
            metadata:
                is_checkout_workflow: true
                is_single_page_checkout: false

        b2b_flow_checkout_single_page:
            # ...
            metadata:
                is_checkout_workflow: true
                is_single_page_checkout: true


These options are checked in workflow event listeners to automate routine tasks common to checkouts. Use these options in your workflows to enable the same logic. The above configurations can be easily checked in event listeners using the ``Oro\Bundle\CheckoutBundle\Helper\CheckoutWorkflowHelper``, which contains useful static methods: ``isSinglePageCheckoutWorkflow``, ``isMultiStepCheckoutWorkflow`` and ``isCheckoutWorkflow`` to detect checkouts.

.. note:: For more details on Workflow Events, refer to the :ref:`related documentation <backend--workflows--workflow-events>`.

Checkout Workflow State Protection
----------------------------------

Checkout Workflow State protection is a powerful mechanism that allows to detect changes in checkout and notify users about them.
``checkout.workflow_state.mapper`` DIC tag allows to add new checkout state diff mapper. Diff mappers are used to track changes in checkout. Must implement ``\Oro\Bundle\CheckoutBundle\WorkflowState\Mapper\CheckoutStateDiffMapperInterface``.

Checkout workflow state protection can be implemented manually in the checkout workflow. This approach gives you full control over state management and verification, but adds complexity and requires a full understanding of the state protection logic. To achieve this, you'll need to:

 - manually add ``state_token`` to your checkout
 - implement state token updates with ``generate_uuid`` action
 - manage checkout state with ``generate_checkout_state_snapshot`` and ``save_checkout_state`` actions
 - implement invalidation with ``delete_checkout_state``
 - check state validity with ``is_checkout_state_valid``

Alternatively, checkout workflow state protection can be turned on via the workflow metadata options and is handled by the CheckoutConfigBuilderExtension, which adds the necessary attributes to workflow and transition forms, and the CheckoutStateListener, which handles all aspects of state processing.

.. code-block:: yaml

    workflows:
        b2b_flow_checkout:
            # ...
            metadata:
                # ...
                checkout_state_config:
                    enable_state_protection: true
                    additionally_update_state_after: ['paid_partially']

        b2b_flow_checkout_single_page:
            # ...

            metadata:
                # ...
                checkout_state_config:
                    enable_state_protection: true
                    additionally_update_state_after: ['save_state']
                    protect_transitions: ['create_order']


In the example above state protection is enabled for both *b2b_flow_checkout* and *b2b_flow_checkout_single_page* workflows.

 - ``additionally_update_state_after`` option is used to define a list of transitions after which checkout state should be force updated.
 - ``protect_transitions`` option is used to extend a list of state protected transitions. By default only transitions with ``is_checkout_continue`` frontend option are protected.

Checkout Events
---------------

The checkout process triggers events at key points in the workflow lifecycle, enabling custom logic to be executed without modifying the workflow definition or core services.

Since checkout workflows are standard Oro Workflow component workflows, the general :ref:`Workflow Events <backend--workflows--workflow-events>` are also applicable to checkouts and may be used alongside the checkout-specific events described in this section.


Checkout Lifecycle Events
^^^^^^^^^^^^^^^^^^^^^^^^^

These events are dispatched by ``Oro\Bundle\CheckoutBundle\Model\CheckoutBySourceCriteriaManipulator`` and ``Oro\Bundle\CheckoutBundle\Provider\PrepareCheckoutSettingsProvider`` during the creation, search, and actualization of a checkout entity.

- ``oro_checkout.create`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutCreateEvent``) — fired immediately after the new ``Checkout`` entity is constructed and its source is assigned, before checkout data is actualized. The event carries the checkout entity, the source criteria array, and the checkout data array. Listeners may replace the checkout entity by returning a modified instance.

- ``oro_checkout.find`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutFindEvent``) — fired after the repository search for an existing checkout by source criteria is complete. The event carries the found checkout entity (which may be ``null`` if none was found), the source criteria, the customer user, the currency, and the workflow name. Listeners may substitute an alternative checkout entity.

- ``oro_checkout.actualize`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutActualizeEvent``) — fired after the checkout line items, currency, shipping cost, and subtotals have been recalculated. The event carries the checkout entity, the source criteria, and the checkout data. Use this event to apply additional modifications after the standard actualization logic has run.

- ``oro_checkout.workflow.prepare_checkout_settings`` (``Oro\Bundle\CheckoutBundle\Event\PrepareCheckoutSettingsEvent``) — fired before the checkout start action applies settings (such as a pre-set shipping address) to the workflow item. The event carries the checkout entity and the settings array. Listeners may modify or extend the settings before they are persisted.

Checkout Request and Transition Events
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

These events are dispatched by the checkout controller and the POST request handler during storefront checkout page rendering and transition processing.

- ``oro_checkout.request`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutRequestEvent``) — fired at the beginning of the checkout controller action, before the current workflow step is resolved. The event carries the HTTP request and the checkout entity. Listeners may set the resolved ``WorkflowStep`` on the event to override the default step resolution.

- ``oro_checkout.transition_request.before`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutTransitionBeforeEvent``) — fired before a continue transition is executed in response to an HTTP POST request. The event carries the current ``WorkflowItem`` and the ``Transition`` about to be executed. Use this event to perform pre-transition checks or logging.

- ``oro_checkout.transition_request.after`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutTransitionAfterEvent``) — fired after a continue transition has been attempted. The event carries the ``WorkflowItem``, the ``Transition``, a boolean flag indicating whether the transition succeeded, and a collection of errors. Listeners may inspect the outcome or add additional error messages.

- ``oro_checkout.login_on_guest_checkout`` (``Oro\Bundle\CheckoutBundle\Event\LoginOnCheckoutEvent``) — fired when a registered customer user logs in during a guest checkout session. The event carries the checkout entity and its source. Use this event to transfer guest checkout data to the authenticated user session.

Source Entity Events
^^^^^^^^^^^^^^^^^^^^^

These events are dispatched when the checkout source entity (typically a shopping list) is cleared or removed at the end of the checkout process.

- ``oro_checkout.checkout_source_entity_clear`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutSourceEntityClearEvent``) — fired before the line items of the checkout source entity are removed from the database. The event carries the source entity. Use this event to react to or prevent the clearing of source entity line items.

- ``oro_checkout.checkout_source_entity_remove.before`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutSourceEntityRemoveEvent``) — fired before the checkout source entity itself is deleted. The event carries the source entity.

- ``oro_checkout.checkout_source_entity_remove.after`` (``Oro\Bundle\CheckoutBundle\Event\CheckoutSourceEntityRemoveEvent``) — fired after the checkout source entity has been deleted. The event carries the source entity reference. Use these events to synchronize external systems or clean up related data when a source entity is removed.

Extendable Action and Condition Events
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

These events are triggered via the ``extendable`` action and extendable condition mechanisms during workflow transition execution. They are available to any Symfony event listener subscribed to the corresponding event name.

**Extendable conditions** — evaluated during pre-condition checks; a listener may add errors to block the transition:

- ``extendable_condition.start_checkout`` — evaluated when determining whether a checkout start is permitted. Event data includes the ``checkout`` entity and a ``validateOnStartCheckout`` boolean flag. This event is evaluated by the ``StartCheckout`` action group and blocks the redirect to the checkout page if any listener adds errors.

- ``extendable_condition.shopping_list_start`` — evaluated when determining whether starting a checkout from a specific shopping list is permitted. Event data includes the ``checkout`` entity and the ``shoppingList`` entity. This event is evaluated once per workflow item and the result is cached for the duration of the request.

**Extendable actions** — executed during transition logic; listeners may perform side effects such as sending notifications, updating external systems, or modifying workflow data:

- ``extendable_action.checkout_payment_purchase_start`` — fired immediately before the payment purchase action is executed. Event data includes the ``checkout`` entity, the ``order`` entity, and the ``transactionOptions`` array. Use this event to inject additional transaction options or log the payment initiation.

- ``extendable_action.checkout_payment_purchase_complete`` — fired immediately after the payment purchase action returns. Event data includes the ``checkout`` entity, the ``order`` entity, the ``transactionOptions`` array, and the ``purchaseResult``. Use this event to handle post-payment logic such as fraud checks or third-party notifications.

- ``extendable_action.checkout_complete`` — fired after the checkout is marked as completed, the confirmation email is sent, and the completed data (item count, order reference, totals) is recorded on the checkout entity. Event data includes the ``checkout`` entity and the ``order`` entity. Use this event to trigger post-order integrations.

- ``extendable_action.finish_checkout`` — fired at the very end of the ``place_order`` transition (multi-step checkout) and the ``purchase`` transition (single-page checkout), after all completion steps are done. Event data includes the ``order`` entity, the ``checkout`` entity, the ``responseData`` array from the payment gateway, and the customer ``email`` string. Use this event for final post-checkout processing that must occur regardless of which checkout workflow variant is active.


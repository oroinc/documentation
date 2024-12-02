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

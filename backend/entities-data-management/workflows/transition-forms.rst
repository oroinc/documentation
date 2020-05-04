.. _backend--workflows--transition-forms:

Transition Forms
================

Configuration
-------------

Sometimes the data available in the system is not enough to progress the workflow automatically by clicking one button. Therefore, users have to provide additional data in UI forms to be able to proceed (from several fields to complex entities).

Workflow transitions can be configured to handle custom data provided by a user by displaying a form on the UI before a transition commit happens.
Examples below illustrate the common ways to configure transition forms.

Simple Example
^^^^^^^^^^^^^^

Suppose we have a workflow that handles only one required data input from a user.

.. code-block:: yaml
   :linenos:

    workflows:
        greeting_flow:
            entity: Oro\Bundle\UserBundle\Entity\User
            entity_attribute: user
            defaults: { active: true }
            attributes:
                the_message:
                    type: string
            steps:
                congratulated:
                    allowed_transitions: [ congratulate_with ]
            transitions:
                congratulate_with:
                    is_start: true
                    step_to: congratulated
                    form_options:
                        attribute_fields:
                            the_message:
                                options:
                                    constraints:
                                        - NotBlank: ~
                    destination_page: view
                    transition_definition: message_definition
            transition_definitions:
                message_definition:
                    actions:
                        - '@flash_message': {message: $.data.the_message, type: success}


Above is a simple working example of a cycled workflow with one step and one transition.
On transition `congratulate_with`, we should force the user to fill a text input in the `the_message` field that corresponds to our configured workflow `attribute`. The field is also required by `constraints` in form `attribute_fields` `options`. Then, we can submit it as a transition payload. Next, we should see a `@flash_message` with the text we prompt on the dialog (the default for transition `display_type`) that is flashed on the entity view page.

Extended Example
^^^^^^^^^^^^^^^^

**Custom types and form_init:**

.. code-block:: yaml
   :linenos:

    workflows:
        user_update_flow:
            entity: Oro\Bundle\UserBundle\Entity\User
            entity_attribute: user
            defaults: { active: true }
            attributes:
                my_message:
                    type: string
                my_dote:
                    type: object
                    options:
                        class: DateTime
            steps:
                congratulated:
                    allowed_transitions: [ congratulate_with ]
            transitions:
                congratulate_with:
                    is_start: true
                    step_to: congratulated
                    form_options:
                        form_init:
                            - '@create_object':
                                class: \DateTime
                                attribute: $.data.my_date
                                parameters: ['tomorrow']
                        attribute_fields:
                            my_message:
                                options:
                                    constraints:
                                        - NotBlank: ~
                            my_date:
                                form_type: my_date_picker #here your custom date picker
                    destination_page: view
                    transition_definition: message_definition
            transition_definitions:
                message_definition:
                    actions:
                        - '@flash_message': {message: $my_message, type: success}


If we need a more complex form to be filled by a user who is performing a transition, we need to specify fields for the data that we need. But before that, let us prepare the data that will be displayed to a user in `form_init`.

**form_init**

The `form_init` node is under `form_options`. It is an action that will be performed before form rendering (see |Action Component| for more details).
Here, you can prepare your data before form rendering. In the sample configuration we are creating, a new `\DateTime` object is pre-configured to *tomorrow*.
So that on our custom `"my_date_picker"` type we will see the day after today predefined on the form.

Custom Form Type Example
^^^^^^^^^^^^^^^^^^^^^^^^

You can also use your custom form type for the whole transition handling. Have a look at the example below:

.. code-block:: yaml
   :linenos:

    workflows:
        quote_update_circular:
            entity: Oro\Bundle\CustomerBundle\Entity\CustomerUser
            entity_attribute: customer_user
            defaults: {active: true}
            attributes:
               quote: #here we will store our form data result
                   type:  entity
                   options:
                       class: Oro\Bundle\SaleBundle\Entity\Quote
            steps:
                quote:
                    allowed_transitions:
                        - transit_quote
            transitions:
                transit_quote:
                    step_to: quote
                    is_start: true
                    transition_definition: quote_update_definition
                    display_type: dialog
                    form_type: 'Oro\Bundle\SaleBundle\Form\Type\QuoteType' #define a custom form type to use for transit
                    form_options:
                        configuration: #define configuration for the custom form type
                            handler: 'default' #which handler should process the from (custom form transition handler)
                            template: 'OroSaleBundle:Quote:update.html.twig' #our complex form page template
                            data_provider: 'quote_update' #template context data provider that will provide data for the template
                            data_attribute: 'quote' #attribute to store form data and get from
                        form_init: #here we will prepare our form
                            - '@tree':
                                conditions: #if no quote is defined in our worfklow data ... ->
                                    '@empty': [$quote]
                                actions:
                                    - '@create_object': #.. -> we will create it
                                        class: Oro\Bundle\SaleBundle\Entity\Quote
                                        attribute: $.data.quote # and set to our data_attribute defined in configuration
                                        parameters: ~
                            - '@assign_value': #add some more preparation of the form data object below by WF entity data
                                attribute: $.data.quote.customerUser
                                value: $customer_user
                            - '@assign_value':
                                attribute: $.data.quote.customer
                                value: $customer_user.customer
                        attribute_fields: ~ #attribute fields should be ommited as we use totally custom form type
            transition_definitions:
                quote_update_definition:
                    actions:
                        - '@flash_message':
                            message: 'Workflow transited. Entity updated!'
                            type: 'success'
                        - '@redirect': {route: 'oro_sale_quote_index'}

Here, the configured workflow creates a new Quote from the start on Customer User page and performs updates for the Quote circularly in each transition, because it brings us back to the same step.

Now, let's look at configuration specific moments.

To use your custom form type that replaces the default transition form, set the type in `form_type` option to your custom type.

.. note::
      FQCN should be used as the value for *form_type* when defining custom form type and this form must be resolvable by "Form Registry". Together with that, you must specify the correct `configuration` for the type customization (`handler`, `template`, `data_provider`, `data_attribute` options). Here, we have `Oro\\Bundle\\SaleBundle\\Form\\Type\\QuoteType` form type. But to handle this complex form type properly, specify additional options in the `form_options.configuration` node.

They are:

- `handler` - an alias of a registered service by tag `oro_form.registry.form_handler`. You can use the default one by passing `'default'`. See more about form update handler in |Update Handler|.

- `template` - the name of a template that should be used for the custom form, the default value is `OroWorkflowBundle:actions:update.html.twig`, and this template can be used as a starting point for customizations.

.. note::
   It should be extended from `OroUIBundle:actions:update.html.twig` for compatibility with transition form page (usually all Oro update templates do so).

- `data_provider` - an alias of a registered service by tag `oro_form.form_template_data_provider` that implements `Oro\\Bundle\\FormBundle\\Provider\\FormTemplateDataProviderInterface`. It should return all necessary data for specified template as controllers usually do.

- `data_attribute` - the name of data attribute where form data payload should be taken from by workflow engine to pass into form and put to as result of handling.

Form Reuse Recommendation
^^^^^^^^^^^^^^^^^^^^^^^^^

The best approach when creating a new entity management (entity controller) while developing is to use the `Oro\\Bundle\\FormBundle\\Model\\UpdateHandler::update` method functionality.
So that if you encapsulate your logic into proper parts of the form handling process, then you should easily be able to create a workflow with the custom form type. As custom form workflow transition handling is based on reusing those parts in transition configuration.

Transition Forms and Layouts
----------------------------

For layout based sites, use the :ref:`Layout Update <dev-doc-frontend-layouts-layout>` functionality to the UI customization capabilities of a transition form.

First, make sure you are familiar with the type of interface build, so that you could proceed with managing layout-based transition forms.

Layout Imports for New Controllers
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

There are several major imports that can handle the next types of transition forms:

- |oro_workflow_transition_form|
- |oro_workflow_start_transition_form|

Please consider adding them to your custom transition form controller.

Context Data
------------

The following layout context variables are available for the transition forms:

- `workflowName` - the name of a workflow
- `transitionName` - the name of a transition
- `transitionFormView` - the form view instance (used in rendering)
- `transition` - the instance of |Transition| class that current transit corresponds to
- `workflowItem` - the instance of |WorkflowItem| - current workflow record representation
- `formRouteName` - the route that should be populated by LayoutTransitionContext processor in |TransitionContext|

Limitations
^^^^^^^^^^^

A workflow transition form **does not have layout form provider**. So you cannot reuse it in other layouts.
It is a known drawback, but the transition process is quite complex, and transition form reusage could make data dependency management quite complicated.

.. include:: /include/include-links-dev.rst
   :start-after: begin

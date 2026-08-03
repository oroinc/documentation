.. _backend--workflows--transition-forms:

Workflow Transition Forms
=========================

Configuration
-------------

Sometimes the data in the system is not enough to progress a workflow automatically with a single button click. In such cases, users must provide additional data through UI forms --- from a few fields to complex entities --- before they can proceed.

You can configure a workflow transition to display a form in the UI before the transition commits, so it can handle custom data that a user provides.

The examples below illustrate common ways to configure transition forms.

Simple Example
^^^^^^^^^^^^^^

Suppose we have a workflow that handles only one required data input from a user.

.. code-block:: yaml


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


This is a simple working example of a cycled workflow with one step and one transition.

On transition `congratulate_with`, the user must fill a text input in the `the_message` field, which corresponds to our configured workflow `attribute`. The `constraints` in the form `attribute_fields` `options` make this field required.

The user then submits the value as the transition payload. A `@flash_message` with the prompted text is flashed on the entity view page (the dialog is the default transition `display_type`).

Extended Example
^^^^^^^^^^^^^^^^

**Custom types and form_init:**

.. code-block:: yaml


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


For a more complex form, specify the fields for the data you need. But first, prepare the data shown to the user in `form_init`.

**form_init**

The `form_init` node sits under `form_options`. It defines an action that runs before the form renders (see :ref:`Action Component <bundle-docs-platform-action-bundle>` for more details), letting you prepare your data first.

In this sample configuration, a new `\\DateTime` object is pre-configured to *tomorrow*, so our custom `"my_date_picker"` type shows the day after today predefined on the form.

Custom Form Type Example
^^^^^^^^^^^^^^^^^^^^^^^^

You can also use a custom form type for the whole transition handling. See the example below:

.. code-block:: yaml


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
                            template: '@OroSale/Quote/update.html.twig' #our complex form page template
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

Here, the workflow creates a new Quote at the start on the Customer User page, then updates the Quote on each transition. Because the transition returns to the same step, these updates run circularly.

Now let's look at some configuration specifics.

To replace the default transition form with your custom form type, set the `form_type` option to your custom type.

.. note::
      Use an FQCN as the value for *form_type*, and make sure this form is resolvable by the "Form Registry". You must also specify the correct `configuration` for the type customization (`handler`, `template`, `data_provider`, `data_attribute` options). Our example uses the `Oro\\Bundle\\SaleBundle\\Form\\Type\\QuoteType` form type. To handle this complex form type properly, specify additional options in the `form_options.configuration` node.

They are:

- `handler` --- an alias of a service registered with the tag `oro_form.registry.form_handler`. Pass `'default'` to use the default one. See more about the form update handler in :ref:`Update Handler <bundle-docs-platform-form-bundle-update-handler>`.

- `template` --- the name of the template to use for the custom form. The default value is `@OroWorkflow/actions/update.html.twig`, which you can use as a starting point for customizations.

.. note::
   It should be extended from `@OroUI/actions/update.html.twig` for compatibility with transition form page (usually all Oro update templates do so).

- `data_provider` --- an alias of a service registered with the tag `oro_form.form_template_data_provider` that implements `Oro\\Bundle\\FormBundle\\Provider\\FormTemplateDataProviderInterface`. It should return all data the specified template needs, as controllers usually do.

- `data_attribute` --- the name of the data attribute that the workflow engine reads the form data payload from, passes into the form, and writes the handling result back to.

Form Reuse Recommendation
^^^^^^^^^^^^^^^^^^^^^^^^^

When developing a new entity management (entity controller), the best approach is to use the `Oro\\Bundle\\FormBundle\\Model\\UpdateHandlerFacade::update` method.

If you encapsulate your logic into the proper parts of the form handling process, you can easily create a workflow with a custom form type. Custom form workflow transition handling is based on reusing those parts in the transition configuration.

Transition Forms and Layouts
----------------------------

For layout-based sites, use the :ref:`Layout Update <dev-doc-frontend-layouts-layout>` functionality to customize the UI of a transition form.

First, make sure you are familiar with this type of interface build before you manage layout-based transition forms.

Layout Imports for New Controllers
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Several major imports can handle the following types of transition forms:

- |oro_workflow_transition_form|
- |oro_workflow_start_transition_form|

Please consider adding them to your custom transition form controller.

Context Data
------------

The following layout context variables are available for the transition forms:

- `workflowName` --- the name of a workflow
- `transitionName` --- the name of a transition
- `transitionFormView` --- the form view instance (used in rendering)
- `transition` --- the instance of the |Transition| class that the current transit corresponds to
- `workflowItem` --- the instance of |WorkflowItem|, the current workflow record representation
- `formRouteName` --- the route that the LayoutTransitionContext processor populates in |TransitionContext|

Limitations
^^^^^^^^^^^

A workflow transition form **does not have layout form provider**, so you cannot reuse it in other layouts.

This is a known drawback. The transition process is complex, and reusing the transition form could make data dependency management complicated.

.. include:: /include/include-links-dev.rst
   :start-after: begin

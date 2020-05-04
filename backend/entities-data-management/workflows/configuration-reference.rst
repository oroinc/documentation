.. _backend--workflows--config-reference:

Configuration Reference
=======================

Configuration of Workflow declares all aspects related to a specific workflow:

* basic properties of a workflow, like name and entity
* steps and transitions
* attributes involved in the workflow
* entity related to the workflow

The structure of the configuration is declared in class `oro\\Bundle\\WorkflowBundle\\Configuration\\WorkflowConfiguration`.


Configuration File
------------------

Configuration must be placed into the Resources/config/oro/workflows.yml. file. For example, `src/Acme/DemoWorkflowBundle/Resources/config/oro/workflows.yml`.

The configuration file can be split into parts. All included parts must be placed under the imports section. Imports may be used
in any part of the workflow configuration.

**Example - workflows.yml**

.. code-block:: yaml
   :linenos:

    imports:
        - { resource: 'workflows/b2b_flow_lead.yml' }
        - { resource: 'workflows/b2b_flow_sales.yml' }
        - { resource: 'workflows/b2b_flow_sales_funnel.yml' }


**Example - b2b_flow_lead.yml**

.. code-block:: php
   :linenos:

    imports:
        - { resource: 'b2b_flow_lead/steps.yml' }
        - { resource: 'b2b_flow_lead/attributes.yml' }
        - { resource: 'b2b_flow_lead/transitions.yml' }
        - { resource: 'b2b_flow_lead/transition_definitions.yml' }

    workflows:
        b2b_flow_lead:
            entity: Oro\Bundle\SalesBundle\Entity\Lead
            entity_attribute: lead
            start_step: new

.. _configuration-reference-workflow-imports:

Workflow Imports
----------------

When you need to reuse an existing workflow configuration or its parts, use the `workflow` import directive.

**Import Example (with replace)**

.. code-block:: yaml
   :linenos:

    imports:
        - { workflow: flow_to_import, as: flow_to_recieve, replace: ['transitions.unneeded_transition_from_other_flow']}
    workflows:
        flow_to_recieve:
            #...

Options (* - required):

- `workflow` * (string) - a name of workflow to import
- `as` * (string) - a name of workflow that should accept imported workflow config
- `replace` * (list) - a list of node paths that should be replaced from imported workflow
- `resource` (string) - an optional direct file path to load workflow to import from

The example above shows the import of a different workflow configuration (`flow_to_import`) into the current one (`flow_to_recieve`).

The `flow_to_import` workflow configuration is found across all registered workflows and imported as is (raw configuration without normalization) under node
`workflows.flow_to_recieve` in the current configuration file. Then, it replaces all nodes defined in the `replace` option to clean all unnecessary segments.
After that, `flow_to_recieve` from the current config file is recursively merged on top of the imported one. The described operation is performed for each import directive.
The search for workflow configuration by default is performed across all registered bundles.

Resource Option with Workflow Import
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you need to load your part of the configuration directly from the file, use the `resource` option for load. This approach can be helpful in two situations:

1. **Resource: Split Parts Reuse**

   .. code-block:: yaml
      :linenos:

       imports:
           - { resource: 'b2b_flow_lead/steps.yml', worklow: b2b_flow_lead, as: new_workflow, replace: [] }
       workflows:
           new_workflow:
              transitions:
                   #...
              #other options except steps

   If you need to reuse part of the workflow with split config by files and don not want to perform all other unnecessary nodes to be specified in `replace` option.
   For example (as granted above), you are interested in steps only from a different workflow config, and those steps are placed under the `'b2b_flow_lead/steps.yml'` file.
   So, now you can load them directly by using the `resource` option together with the workflow import options (`workflow`, `as`).
   And you will have all steps from the `b2b_flow_lead` workflow loaded under your `new_workflow` configuration without any additions.

2. **Resource: Common Template Reuse**

   If you are defining several workflows that are similar to each other, but have different use cases (for example: entities to apply to), use the following approach:

   .. code-block:: yaml
      :linenos:

       imports:
           - { resource: 'common_flow.yml', workflow: common_flow, as: flow_for_user, replace: [] }
           - { resource: 'common_flow.yml', workflow: common_flow, as: flow_for_customer, replace: [] }
       workflows:
           flow_for_user:
               entity: User

           flow_for_customer:
               entity: Customer

   Then you can create a file with a workflow which will serve as a template for others (`'common_flow.yml'`).
   Then, by importing it, you can override its nodes for a particular case (different `entity` but shared remaining configuration).

Configuration Loading
---------------------

To load the configuration, execute the following command:

.. code-block:: php
   :linenos:

    php bin/console oro:workflow:definitions:load

The command has two options:

* *directories* allows to specify which directories will be used to find definitions
* *workflows* defines names of definitions required to load

.. note::
    Workflow configuration cannot be merged, it means that you cannot override workflow that is defined in a different bundle. If you declare a workflow and another bundle will declare its own workflow with the same name, the command will trigger exception and data will not be saved. If you want to reuse an already existent configuration, use the :ref:`import workflow feature <configuration-reference-workflow-imports>`.

Translations File
-----------------

Together with workflows configurations, for almost each section that specified below, there should be defined  translation text under corresponded key to display correct UI text. Configuration of translations is implemented in the same way as other translation resources (you might know them by files placed under `<YourBundle>/Resources/translation/messages.en.yml` or `<YourBundle>/Resources/translations/jsmessages.en.yml`.

Every workflow must have their own translations file, i.e. - `<YourBundle>Resources/translations/workflows.{lang_code}.yml`, - where `{lang_code}` is your preferred language code for the translations that are collected there. Each section that describe workflow configuration part must contain a note provided with a proper **Translatable** type for the translatable fields. These fields describe the value that can be defined only in the `workflows.{lang_code}.yml` file, but never in the configuration.

Defining a Workflow
-------------------

The root element of the configuration is *workflows*. Workflows can be defined under this element.

A single workflow configuration has the following properties:

* **name** - *string* - A workflow should have a unique name in the scope of all applications. As workflow configuration does not support merging two workflows with the same name, this will lead to throwing an exception during configuration loading.

* **label** (translation file field) - *Translatable*: `oro.workflow.{workflow_name}.label`. This value will be shown in the UI.

* **entity** - *string* - The class name of workflow a related entity.

   .. note:: An entity must either be extended or custom, or it must have fields to contain the workflow item and step.

* **entity_attribute** - *string* - The name of the attribute used to store a related entity.

* **is_system** - *boolean* - The flag that defines whether this definition is system. System definition cannot be edited or removed. All definitions loaded from the .yml files are automatically marked as system.

* **start_step** - *string* - The name of the start step. If a workflow has a start transition, then `start_step` is optional, otherwise, it is required.

* **steps_display_ordered** - *boolean* - If this flag is true, then the workflow step widget will show all steps according to their order (including not passed) on the entity view page, otherwise, the widget will show only the passed steps.

* **attributes** - Contains configuration for attributes.

* **steps** - Contains configuration for steps.

* **transitions** - Contains configuration for transitions.

* **transition_definitions** - Contains configuration for transition definitions.

* **priority** - an integer value of the current workflow dominance level in part of automatically performed tasks (ordering, exclusiveness). It is recommended to use high degree integer values to give a scope for 3rd party integrators.

* **exclusive_active_groups** - a list of group names for which the current workflow should be active exclusively.

* **exclusive_record_groups** - a list of group names for which the current workflow cannot be performed together with other workflows with one of specified groups. E.g., no concurrent transitions are possible among workflows in same `exclusive_record_group`.

* **entity_restrictions** - Contains configuration for workflow restrictions.

* **defaults** - node for default workflow configuration values that can be changed in UI later.

* **active** - determines if the workflow should be active right after the first load of configuration.

* **applications** - a list of web application names for which the workflow should be available (default: all applications match)

* **scopes** - a list of scopes configurations used for filtering workflow by scopes

* **datagrids** - a list of datagrid names on whose rows currently available transitions should be displayed as buttons.

* **disable_operations** - an array of operation names (as keys) and related entities for which the operation should be disabled. See |Work with Operations| for more details.

**Example**

.. code-block:: php
   :linenos:

    workflows:                                                    # Root elements
        b2b_flow_sales:                                           # A unique name of workflow
            defaults:
                active: true                                      # Active by default (when config is loaded)
            entity: Oro\Bundle\SalesBundle\Entity\Opportunity  # Workflow will be used for this entity
            datagrids:                                            # datagrid names on which rows available transitions from currently started workflow should be displayed
                - opportunity_grid
            entity_attribute: opportunity                         # Attribute name used to store root entity
            is_system: true                                       # Workflow is system, i.e. not editable and not deletable
            start_step: qualify                                   # Name of start step
            steps_display_ordered: true                           # Show all steps in step widget
            priority: 100                                         # Priority level
            exclusive_active_groups: [b2b_sales]                  # Only one active workflow from 'b2b_sales' group can be active
            exclusive_record_groups:
                - sales                                           # Only one workflow from group 'sales' can be started at time for the entity
            applications: [webshop]                               # list of application names to make the workflow available for
            scopes:
                -                                                 # Definition of configuration for one scope
                    scope_field: 42
            disable_operations:
                operation_for_simple_sale: ~                      # disables specified operation in system (can be empty array - [])
                operation_create_sale: [OrderBundle\Entity\Order] # disables operation for OrderBundle\Entity\Order entity
            attributes:                                           # configuration for Attributes
                                                                  # ...
            steps:                                                # configuration for Steps
                                                                  # ...
            transitions:                                          # configuration for Transitions
                                                                  # ...
            transition_definitions:                               # configuration for Transition Definitions
                                                                  # ...
            entity_restrictions:                                  # configuration for Restrictions
                                                                  # ...

Attributes Configuration
------------------------

Workflow defines the configuration of attributes. When a Workflow Item is created, it can manipulate its own data (Workflow Data) that is mapped by Attributes. Each attribute must have a type and can have options. When a Workflow Item is saved, its data is serialized according to the configuration of attributes. Saving data that is
not mapped by any attribute or mismatched with the attribute type is restricted.

A single attribute can be described with the following configuration:

* **unique name** - Workflow attributes should have a unique name in scope of Workflow that they belong to. Step configuration references attributes by this value.
* **type** - *string* - Type of an attribute. The following types are supported:

  * **boolean**
  * **bool** - *alias for boolean*
  * **integer**
  * **int** - *alias for integer*
  * **float**
  * **string**
  * **array** - elements of array should be scalars or objects that supports serialize/deserialize
  * **object** - object should support serialize/deserialize, option "class" is required for this type
  * **entity** - Doctrine entity, option "class" is required and it must be a Doctrine manageable class

* **label** (translation file field) - *translatable*: `oro.workflow.{workflow_name}.attribute.{attribute_name}.label` . Label can be shown in the UI
* **entity_acl** - Defines an ACL for the specific entity stored in this attribute.

  * **update** - *boolean* - Can entity be updated. Default value is true.
  * **delete** - *boolean* - Can entity be deleted. Default value is true.

* **property_path** - *string* - Used to work with attribute value by reference and specifies the path to data storage. If the property path is specified, then all other attribute properties except name are optional - they can be automatically guessed based on last element (field) of the property path.
* **options** - Options of an attribute. Currently, next options are supported

  * **class** - *string* - Fully qualified class name. Allowed only when type either entity or object.
  * **multiple** - *boolean* - Indicates whether several entities are supported. Allowed only when type is entity.
  * **virtual** - *boolean* - Such attribute will not be saved in the database and available only on current transition. Default value is false.

.. note:: Attribute configuration does not contain any information about how to render attribute on step forms, it's responsibility of "Steps configuration". This makes it possible to render one attribute in different ways on steps.

Browse class *Oro\\Bundle\\WorkflowBundle\\Model\\AttributeAssembler* for more details.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        b2b_flow_sales:
            # ...
            new_account:
                type: entity
                entity_acl:
                    delete: false
                options:
                    class: Oro\Bundle\AccountBundle\Entity\Account
            send_email:
                type: checkbox
                options:
                    virtual: true
            new_company_name:
                type: string
            opportunity:
                property_path: sales_funnel.opportunity
            opportunity_name:
                property_path: sales_funnel.opportunity.name


Enable Users to Modify Attributes
---------------------------------

You can enable a user to modify attributes of the record during transitions. To do this, list attributes that can be modified during any of the workflow's transitions under the ``attributes`` key:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

    workflows:
        phone_call:
            # ...
            attributes:
                    phone_call:                             # The workflow attribute.
                    type: entity
                    options:
                        class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneCall
                    call_timeout:                           # The workflow attribute.
                    type: integer
                    call_successful:                        # The workflow attribute.
                    type: boolean
                conversation_successful:
                    type: boolean
                conversation_comment:
                    type: string
                conversation_result:
                    type: string
                conversation:
                    type: entity
                    options:
                        class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneConversation

.. tip::

    By default, the attribute data is stored inside the ``WorkflowItem`` entity. Consequently, this data can only be accessed in the scope of the specific workflow for an entity.

    To automatically store and retrieve attributes data by a property path (i.e. such attributes can be considered as links to an entity's values), use the :ref:`property_path option <reference-format-workflow-attributes-property-path>` instead:

    .. code-block:: yaml
        :linenos:

        workflows:
            phone_call:
                # ...
                attributes:
                    timeout:
                        property_path: entity.call_timeout

    The ``entity`` part of the property path refers to the underlying entity. You can change the name using the :ref:`entity_attribute option <reference-format-workflow-entity-attribute>`.

**Translations**

For attributes, you need to add labels into two places: first, to the list of all attribute labels, second, to the list of labels for attributes of each transition that has them.

+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------+
| `oro.workflow.{workflow_name}.attribute.{attribute_name}.label`                              | A default label text for the attribute.                                |
+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------+
| `oro.workflow.{workflow_name}.transition.{transition_name}.attribute.{attribute_name}.label` | A label text for attribute of the corresponding particular transition. |
+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------+

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
            phone_call:
                attribute:
                        phone_call
                                    label: 'Phone Call'
                    call_timeout
                                label: 'Call Timeout'
                    call_successful
                        label: 'Call Successful'

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
                phone_call:
                    transition:
                        connected:
                            ...
                            attribute:
                                opportunity:
                                    label: 'Call Successful'


Variables Configuration
-----------------------

A workflow can define configuration for variables. Despite their name and unlike attributes, variables are required to have values set when defining them.
When a Workflow Item is created, it can manipulate its own data (Workflow Data) mapped by Variables. Each variable must have a type and a value. When Workflow Item is saved, its data is serialized according to the configuration of variables.

A single variable can be described with the following configuration:

* **unique name** - Workflow variables should have unique name in scope of Workflow that they belong to. Transition definitions reference variables by this value.
* **type** - *string* - Types of variables. The following types are supported:

  * **boolean**
  * **bool** - *alias for boolean*
  * **integer**
  * **int** -  *alias for integer*
  * **float**
  * **string**
  * **array** - elements of array should be scalars or objects that supports serialize/deserialize
  * **object** - object should support serialize/deserialize, option "class" is required for this type
  * **entity** - Doctrine entity, option "class" is required and it must be a Doctrine manageable class

* **entity_acl** - Defines an ACL for the specific entity stored in this attribute.

  * **update** - *boolean* - Can entity be updated. Default value is true.
  * **delete** - *boolean* - Can entity be deleted. Default value is true.

* **property_path** - *string* - Used to work with variable value by reference and specifies path to data storage. If property path is specified, then all other attribute properties except name are optional - they can be automatically guessed based on last element (field) of property path.
* **label** - *translatable*: `oro.workflow.{workflow_name}.variable.{variable_name}.label`. Label can be shown in the UI.
* **options** - Options of a variable. Currently the following options are supported:

  * **class** - *string* - Fully qualified class name. Allowed only when type is object.
  * **form_options** - *array* - Options defined here are passed to the `WorkflowVariablesType` form type. Browse class *Oro\\Bundle\\WorkflowBundle\\Form\\Type\\WorkflowVariablesType* for more details. Constraints may be set to workflow configuration form with the `constraints` option. All Symfony form constrains are supported.
  * **multiple** - *boolean* - Indicates whether several entities are supported. Allowed only when type is entity.
  * **identifier** - *string* - Applies to entities only. Class identifier specifies the identity field which will be used to query for the desired entity, in case a default entity needs to be loaded upon workflow assembling. Not specifying it will read the identifier field names from the entity's metadata. Please note that it is not necessary to use a primary key, any **unique** key is supporter, as long as it is not a composite key.

.. important::
        Unlike attributes, variable configuration does contain information about how to render variables in the configuration form, with the `form_options` node under `options`. Browse class *Oro\\Bundle\\WorkflowBundle\\Model\\VariableAssembler* for more details.

**Example**

Defining a variable:

.. code-block:: php
   :linenos:

    workflows:
        my_workflow:
            variable_definitions:
                variables:
                   admin_user:
                        type: 'entity'
                        value: 1 # id of the user to be loaded upon variable assembling
                        options:
                            class: Oro\Bundle\UserBundle\Entity\User
                            identifier: id
                            form_options:
                                tooltip: true
                                constraints:
                                    NotBlank: ~


Using a variable:

.. code-block:: php
   :linenos:

    ...
        preconditions:
            '@and':
                ...
                - '@not':
                    - '@some_condition': [$entity, $.data.admin_user]


Steps Configuration
-------------------

Steps are like nodes in the graph of Workflow Transitions. Step must have a unique name and can optionally contain form options, allowed transitions and other options. If Workflow has type wizard user will be able to see in what step Workflow instance is at the moment, possible transitions and form of current step (if it is configured
via form options). Step can be connected with attributes via form options. On different step it is possible to attach any attribute with any form options.

Summarizing all above, a step has the following configuration:

* **name** - *string* - A step must have unique name in scope of Workflow
* **label** (translation file field) - *Translatable*: `oro.workflow.{workflow_name}.step.{step_name}.label` . The label of step, can be shown in UI if Workflow has type wizard
* **order** - *integer* - This value is used in wizard page to sort steps in UI.
* **is_final** - *boolean* - If true, then step will be counted as the workflow final step.
* **entity_acl** - Defines an ACL for an entity related to the specified attribute when workflow is in this step.

    * **update** - *boolean* - Allows entity be updated. Default value is true.
    * **delete** - *boolean* - Allows entity be deleted. Default value is true.

* **allowed_transitions** - A optional list of allowed transitions. If no transitions are allowed, it is the same as `is_final option` set to `true`.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        phone_call:
            # ...
            steps:
                start_call:
                    allowed_transitions: # list of allowed transitions from this step
                        - connected
                        - not_answered
                    entity_acl:
                        owner:
                            update: false
                            delete: false
                start_conversation:
                    allowed_transitions:
                        - end_conversation
                end_call:
                    is_final: true


Transitions Configuration
-------------------------

Transitions change the current step of the Workflow Item when it is performed. It also uses Transition Definition to check if it is allowed and to perform Post Actions.

Transition configuration has the following options:

* **unique name** - *string* - A transition must have unique name in scope of Workflow. Step configuration references transitions by this value.
* **label** (translation file field) - *Translatable*: `oro.workflow.{workflow_name}.transition.{transition_name}.label`. Label of transition, will be shown in UI.
* **button_label** (translation file field) - *Translatable*: `oro.workflow.{workflow_name}.transition.{transition_name}.button_label`. Used to define the text of a transition button. A `label` will be used if not defined.
* **button_title** (translation file field) - *Translatable*: `oro.workflow.{workflow_name}.transition.{transition_name}.button_title`. Used to define the text of button hint (button hover). A `button_label` will be used if not defined.
* **step_to** - *string* - Next step name. This is a reference to step that will be set to Workflow Item after transition is performed.
* **transition_definition** - A reference to Transition Definition configuration.
* **is_start** - *boolean* - If true, then this transition can be used to start a new workflow. At least one start transition is required if workflow does not have `start_step` attribute.
* **is_hidden** - *boolean* - Indicates that this transition must be hidden at frontend.
* **is_unavailable_hidden** - *boolean* - Indicates that this transition must be hidden at frontend when the transition is not allowed.
* **acl_resource** - *string* - ACL resource name that will be checked while checking that transition execution is allowed.
* **acl_message** - *string* - Message that will be sown in case `acl_resource` is not granted.
* **message** (translation file field) - *Translatable*: `oro.workflow.{workflow_name}.transition.{transition_name}.warning_message`. Notification message that will be shown at frontend before transition execution. This field can be filled only in the translation file.
* **message_parameters** - *array* - List of parameters for translating value from option `message`.
* **init_routes** - *array* - List of routes where the transition button will be  displayed. It is required to start workflow from entities that are not directly related to that workflow.
* **init_entities** - *array* - List of entities where the transition button will be displayed . It is required to start workflow from entities that are not directly related to that workflow.
* **init_datagrids** - *array* - List of datagrid names for whose rows transition button should be displayed. It is required to start workflow from entities that are not directly related to that workflow.
* **init_context_attribute** - *string* - Name of the attribute which contains init context: routeName, entityId, entityClass, referrer, group. Default value - `init_context`
* **display_type** - *string* - Frontend transition form display type. Possible options are: dialog, page. Display type "page" require "form_options" to be set.
* **destination_page** - *string* - (optional) Parameter used only when `display_type` equals `page`. Specified value will be converted to url by entity configuration (see action `@resolve_destination_page`). In case when `@redirect` action used in `actions` of transition definition, effect from that option will be ignored. Allowed values: `name` or `index` (`index`  will be converted to `name`) , `view` or `~`. Default value `~`.
* **page_template** - *string* - Custom transition template for transition pages. Should be extended from OroWorkflowBundle:Workflow:transitionForm.html.twig.
* **dialog_template** - *string* - Custom transition template for transition dialogs. Should be extended from OroWorkflowBundle:Widget:widget/transitionForm.html.twig.
* **frontend_options** - Can have such frontend options as **class** (a CSS class applied to transition button), **icon** (CSS class of icon of transition button).
* **form_options** - These options will be passed to form type of transition, they can contain options for form types of attributes that will be shown when user clicks transition button. See more at :ref:`Transition Forms <backend--workflows--transition-forms>`.
* **transition_definition** - *string* - Name of associated transition definition.
* **triggers** - Contains configuration for Workflow Transition Triggers.

To configure transitions, define the following:

- Which transitions are available (place transition name keys under the ``transitions`` key).
- To which steps they bring an entity record (the ``step_to`` key under the transition name key).
- Which conditions must be satisfied for the transition to be available and what actions must be taken before and after the transition.
- Which automatic triggers apply if any.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        phone_call:
            # ...
            transitions:
                start_process:
                    is_start: true                              # Start new workflow
                    step_to: start_conversation                 # The name of next step that will be set to Workflow Item
                    init_context_attribute: my_init_context     # Name of attribute which contains init context
                    init_entities:                              # List of entities where will be displayed transition button "start_process"
                        - 'Oro\Bundle\TaskBundle\Entity\Task'
                    init_routes:                                # List of routes where will be displayed transition button "start_process"
                        - 'oro_task_view'
                    transition_definition: start
                connected:                                      # Unique name of transition
                    step_to: start_conversation                 # The name of next step that will be set to Workflow Item
                                                                # when transition will be performed

                    transition_definition: connected_definition # A reference to Transition Definition configuration
                    frontend_options:
                        icon: 'fa-check'                         # add icon to transition button with class "fa-check"
                        class: 'btn-primary'                    # add css class "btn-primary" to transition button
                    form_options:
                        attribute_fields:                       # fields of form that will be shown when transition button is clicked
                            call_timeout:
                                form_type: Symfony\Component\Form\Extension\Core\Type\IntegerType
                                options:
                                    required: false
                    display_type: page
                    destination_page: index
                not_answered:
                    step_to: end_call
                    transition_definition: not_answered_definition
                end_conversation:
                    step_to: end_call
                    transition_definition: end_conversation_definition
                    triggers:
                        -
                            cron: '* * * * *'
                            filter: "e.someStatus = 'OPEN'"

.. note::
    Attribute `label` option for `attribute_fields` in `form_options` of transition are deprecated now. It was moved to workflows.{lang_code}.yml file as translatable field and has following key to define its text value: `oro.workflow.{workflow_name}.transition.{transition_name}.attribute.{attribute_name}.label`

**Translations**

Define how the workflow transition name will appear on the user interface and the warning message:

+----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+
| Field                                                                                        | Description                                                                                                     |
+==============================================================================================+=================================================================================================================+
| `oro.workflow.{workflow_name}.transition.{transition_name}.label`                            | The transition name.                                                                                            |
+----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+
| `oro.workflow.{workflow_name}.transition.{transition_name}.warning_message`                  | A notification message text shown before the transition is executed.                                            |
+----------------------------------------------------------------------------------------------+-----------------------------------------------------------------------------------------------------------------+

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
                phone_call:
                    transition:
                        connected:
                                    label: 'Connected'
                                warning_message: 'Connection performed!'
                    not_answered
                                label: 'Not Answered'
                    end_conversation
                                label: 'End Conversation'



Transition Definition Configuration
-----------------------------------

Transition Definition is used by Transition to check Pre Conditions and Conditions, to perform Init Action and Post Actions.

Transition definition configuration has the following options.

* **preactions** - Configuration of Pre Actions that must be performed before Pre Conditions check.
* **preconditions** - Configuration of Pre Conditions that must satisfy to allow displaying transition.
* **conditions** - Configuration of Conditions that must satisfy to allow transition.
* **actions** - Configuration of Post Actions that must be performed after transit to next step will be performed.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        phone_call:
            # ...
            transition_definitions:
                connected_definition: # Try to make call connected
                    # Set timeout value
                    preactions:
                        - '@assign_value': [$call_timeout, 120]
                        - '@increment_value': [$call_attempt]
                    # Check that timeout is set
                    conditions:
                        @not_blank: [$call_timeout]
                    # Set call_successfull = true
                    actions:
                        - '@assign_value': [$call_successfull, true]
                not_answered_definition: # Callee did not answer
                    # Set timeout value
                    preactions:
                        - '@assign_value': [$call_timeout, 30]
                    # Make sure that caller waited at least 60 seconds
                    conditions: # call_timeout not empty and >= 60
                        @and:
                            - '@not_blank': [$call_timeout]
                            - '@ge': [$call_timeout, 60]
                    # Set call_successfull = false
                    actions:
                        - '@assign_value': [$call_successfull, false]
                end_conversation_definition:
                    conditions:
                        # Check required properties are set
                        @and:
                            - '@not_blank': [$conversation_result]
                            - '@not_blank': [$conversation_comment]
                            - '@not_blank': [$conversation_successful]
                    # Create PhoneConversation and set it's properties
                    # Pass data from workflow to conversation
                    actions:
                        - '@create_entity': # create PhoneConversation
                            class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneConversation
                            attribute: $conversation
                            data:
                                result: $conversation_result
                                comment: $conversation_comment
                                successful: $conversation_successful
                                call: $phone_call

.. _book-workflow-transitions:

Transition Triggers Configuration
---------------------------------

Transition Triggers are used to perform Transition by Event or by cron-definition. Please note that transition can be performed by trigger even if Workflow not started for the entity yet. There are two types of triggers:

Event Trigger
^^^^^^^^^^^^^

Event trigger configuration has the next options.

* **entity_class** - Class of entity that can trigger transition.
* **event** - Type of the event, can have the following values: `create`, `update`, `delete`.
* **field** - Only for `update` event - field name that should be updated to handle trigger.
* **queued** - [boolean, default = true] Handle trigger in queue (if `true`), or in realtime (if `false`)
* **require** - String of Symfony Language Expression that should much to handle the trigger. Following aliases in context are available:

  * `entity` - Entity object that dispatches an event
  * `prevEntity` - `entity` copy with fields state before update (like the 'old' in lifecycle `changeset`)
  * `mainEntity` - Entity object of the workflow
  * `wd` - Workflow Definition object
  * `wi` - Workflow Item object

* **relation** - Property path to `mainEntity` relative to `entity` if they are different.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        phone_call:
            # ...
            transitions:
                connected:
                    ...
                    triggers:
                        -
                            entity_class: Oro\Bundle\SaleBundle\Entity\Quote    # entity class
                            event: update                                       # event type
                            field: status                                       # updated field
                            queued: false                                       # handle trigger not in queue
                            relation: call                                      # relation to Workflow entity
                            require: "entity.status = 'pending'"                # expression language condition


Cron Trigger
^^^^^^^^^^^^

Cron trigger configuration has the following options.

* **cron** - Cron definition.
* **queue** - [boolean, default = true] Handle trigger in queue (if `true`), or in realtime (if `false`)
* **filter** - String of Symfony Language Expression that should much to handle the trigger. Following aliases are available:

  * `e` - Entity
  * `wd` - Workflow Definition
  * `wi` - Workflow Item
  * `ws` - Current Workflow Step

**Example**

.. code-block:: php
   :linenos:

    workflows:
        phone_call:
            # ...
            transitions:
                connected:
                    ...
                    triggers:
                        -
                            cron: '* * * * *'                                   # cron definition
                            filter: "e.someStatus = 'OPEN'"                     # dql-filter



Conditions Configuration
------------------------

Conditions configuration is a part of Transition Definition Configuration. It declares a tree structure of conditions
that are applied on the Workflow Item to check if the Transition could be performed. Single condition configuration
contains alias - a unique name of condition and options.

Optionally each condition can have a constraint message. All messages of not passed conditions will be shown to user
when transition could not be performed.

There are two types of conditions - preconditions and actual transit conditions. Preconditions are used to check
whether the transition should be allowed to start, and actual conditions are used to check whether the transition can be done.
A good example of usage is transition forms: preconditions are restrictions to show a button that opens the transition
form the dialog, and actual transitions are used to validate the form content after submitting.

Alias of condition starts from the "@" symbol and must refer to a registered condition. For example, "@or" refers to the logical
OR condition.

Options can refer to values of Workflow Data using the `$` prefix. For example, `$call_timeout` refers to value of the `call_timeout` attribute of Workflow Item that is processed in condition.

Also it is possible to refer to any property of Workflow Item using "$." prefix. For example, to refer to the date/time when the Workflow Item was created, string `$.created` can be used.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        phone_call:
            # ...
            transition_definitions:
                # some transition definition
                qualify_call:
                    preconditions:
                        @equal: [$status, "in_progress"]
                    conditions:
                        # empty($call_timeout) || (($call_timeout >= 60 && $call_timeout < 100) || ($call_timeout > 0 && $call_timeout <= 30))
                        @or:
                            - '@blank': [$call_timeout]
                            - '@or':
                                - '@and':
                                    message: Call timeout must be between 60 and 100
                                    parameters:
                                        - '@greater_or_equal': [$call_timeout, 60]
                                        - '@less': [$call_timeout, 100]
                                - '@and':
                                    message: Call timeout must be between 0 and 30
                                    parameters:
                                        - '@less_or_equal': [$call_timeout, 30]
                                        - '@greater': [$call_timeout, 0]


Pre, Post and Init Actions
--------------------------

Pre Action, Post Actions, and Init Action configuration complements Transition Definition configuration. Pre Actions are performed BEFORE the Pre Conditions are qualified.

Post Actions are performed during transition AFTER conditions are qualified, and the current Step of Workflow Item is changed to the corresponding one (step_to option) in the Transition.

Init Actions can be performed before the transition. One of the possible init actions usage scenario is to fill Workflow Item with default values, which will be used by Transition form if it exists.

Action configuration consists of alias of Action (which is a unique name of Action) and options (if such are required).

Similarly to Conditions, alias of Action starts from "@" symbol and must refer to registered Action. For example, "@create_entity" refers to the Action that creates entity.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        phone_call:
            # ...
            transition_definitions:
                # some transition definition
                    preactions:
                        - '@assign_value': [$call_attempt, 1]
                    actions:
                        - '@create_entity': # create an entity PhoneConversation
                            class: Acme\Bundle\DemoWorkflowBundle\Entity\PhoneConversation
                            attribute: $conversation
                            data: # Fill values of freshly created PhoneConversation with data from current WorkflowItem
                                result: $conversation_result
                                comment: $conversation_comment
                                successful: $conversation_successful
                                call: $phone_call


Entity Restrictions Configuration
---------------------------------

Entity Restrictions add validation rules for configured attributes fields. They do not permit to edit these fields on the attributes' edit or create form,
on the attributes' grids via inline editing,  via API or performing an import.

Single entity restriction can be described with the following configuration:

* **unique name** - *string* - A restriction must have unique name in scope of Workflow.
* **attribute** - *string* - This is reference to workflow attribute (attribute must be of type 'entity').
* **field** - *string* - Field name of attribute class for which restriction will be applied.
* **mode** - *enum* - Restriction mode. Allowed values for this option are 'full', 'disallow', 'allow'. Default value is 'full'

  - 'full' mode means that field will be completely disabled for editing. This is default value for this option.
  - 'disallow' mode does not permit to fill field with values listed in 'values' option.
  - 'allow' mode does not permit to fill field with values except listed in 'values' option.

* **values** - *array* - Optional list of field values which will be used for restriction with 'allow' and 'disallow' modes.
* **step** - *string* - This is reference to workflow step. Restriction will be applied only when workflow is in this step. If no step is provided, restriction will be applied for attribute creation.

**Example**

.. code-block:: php
   :linenos:

    workflows:
        opportunity_flow:
            # ...
            entity_restrictions:
                opportunity_status_creation:           # unique restriction name in scope of this Workflow
                    attribute: opportunity             # attribute's reference links to attribute(attribute must be of type 'entity')
                    field: status                      # field name of attribute class
                    mode: disallow                     # restriction mode (default is 'full')
                    values:                            # disallowed values for this field
                        - 'won'
                        - 'lost'
                opportunity_close_reason_creation:
                    attribute: opportunity
                    field: closeReason
                opportunity_status_open:
                    attribute: opportunity
                    field: status
                    step: open                        # restriction will be applied only When workflow is in this step.
                    mode: disallow
                    values:
                        - 'won'
                        - 'lost'
                opportunity_close_reason_open:
                    attribute: opportunity
                    field: closeReason
                    step: open


.. include:: /include/include-links-dev.rst
   :start-after: begin

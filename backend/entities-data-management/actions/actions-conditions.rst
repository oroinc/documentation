.. _bundle-docs-platform-action-bundle-action-component:

Actions and Conditions in Operations
====================================

ActionBundle provides several actions and conditions besides those in the Action Component.

Actions
-------

Run Action Group `@run_action_group`.

**Class:** Oro\\Bundle\\ActionBundle\\Action\\RunActionGroup

**Alias:** run_action_group

**Description:** Runs named [action group](./action-groups.md) with passed parameters.

**Options:**

- result - (optional) property path where the action group execution context value is allocated
- results - (optional) property path where the results from action-group-context are mapped to current context keys
- action_group - action group name
- parameters_mapping - map of parameters passed to the action_group context from the current one

**Configuration Example**

.. code-block:: none

    - '@run_action_group':
        result: $.result
        results:
            result_entity_id: $.demo_new_attribute
        action_group: acme_demo_action_group
        parameters_mapping:
            entity_class: Acme\Bundle\DemoBundle\Entity\User
            entity_id: $.user.id


This configuration executes the **action group** named `acme_demo_action_group` with the parameters listed under the `parameters_mapping` section.

After the **action group** runs, it returns the processed ActionData (e.g., context), which is assigned to the `$.result` attribute of the caller context. `$.result_entity_id` then takes the value of `$.demo_new_attribute` from the Action Group's context.

All parameters must pass validation and be accessible under the root node of ActionData in the action_group execution body---for example, `$.entity_class` and `$.entity_id`, matching their names. See the :ref:`Action Groups <bundle-docs-platform-action-bundle-action-groups>` documentation for more details.

Format Name
^^^^^^^^^^^

**Class:** Oro\\Bundle\\ActionBundle\\Action\FormatName

**Alias:** format_name

**Description:** Format entity name based on locale settings.

**Parameters:**

- attribute - target path where the action results are saved;
- object - entity;

**Configuration Example**

.. code-block:: none

    - '@format_name':
        attribute: $.result.formattedCustomerName
        object: $cart.customer

Create Date
^^^^^^^^^^^

**Class:** Oro\\Bundle\\ActionBundle\\Action\\CreateDate

**Alias:** create_date

**Description:** Create DateTime object based on date string

**Parameters:**

- date - (optional) date as a string. The current date by default;
- attribute - target path where the action results are saved.

**Configuration Example**

.. code-block:: none

    - '@create_date':
        attribute: $action_start_date

OR

.. code-block:: none

    - '@create_date':
        conditions:
                # optional condition configuration
        parameters:
            attribute: $action_start_date
            date: '2014-04-01' # must use quotes because the date parameter requires a string value

Copy Values
^^^^^^^^^^^

**Class:** Oro\\Component\\Action\\Action\\CopyValues

**Alias:** copy_values

**Description:**  Copies the values from a context or an object to the provided attribute and behaves like the `array_merge` PHP function.

.. code-block:: none

   - '@copy_values': [$.to, $.from1, $.from2, {key: 'value'}]

Resolve Destination Page
^^^^^^^^^^^^^^^^^^^^^^^^

**Class:** Oro\\Bundle\\ActionBundle\\Action\\ResolveDestinationPage

**Alias:** resolve_destination_page

**Description:** Resolves the URL redirection activity by a route name from the entity configuration using the `routeName` or `routeView` parameters.

**Options:**

- destination / 0 - the route name specified in the `@Config` annotation of an entity
- entity / 1 - (optional) property path of the original entity (by default, equals to `entity`)
- attribute / 2 - (optional) target property path where the action results are saved (by default, equals to `redirectUrl`)

**Configuration Example**

.. code-block:: none

    - '@resolve_destination_page': view

   OR



   - '@resolve_destination_page': ['view', $.entity, $.attribute]

   OR



    - '@resolve_destination_page':
        name: index
        entity: $.data.entity

   OR



    - '@resolve_destination_page':
        name: index
        entity: $.entity
        attribute: $.attribute

Allowed values for the `destination` parameter:

- for the index page (`routeName`) value can be `name`.
- for the view page (`routeView`) value can be `view`.

Duplicate
^^^^^^^^^

**Class:** Oro\\Bundle\\ActionBundle\\Action\\DuplicateEntity

**Alias:** duplicate, duplicate_entity

**Description:** Duplicate entity object

**Options:**

- entity - (optional) a property path of the original entity (by default, the `getEntity()` method is used from context)
- target - (optional) a property path of the original entity, alias for `entity`
- settings - (optional) a list of filters and matchers to be applied
- attribute - a target property path where the action results are saved

**Filters and Matchers:**

Available filters: `setNull`, `keep`, `collection`, `emptyCollection`, `replaceValue`, and `shallowCopy`.
Available matchers: `property`, `propertyName`, and `propertyType`.

For more information, please refer to the |DeepCopy| documentation.

**Configuration Example**

.. code-block:: none

    - '@duplicate':
        target: $.entity
        attribute: $.entityCopy
        settings:
          - [[setNull], [propertyName, [id]]]
          - [[collection], [propertyName, [items]]]
          - [[replaceValue, $.currentUser], [propertyName, [user]]]
          - [[keep], [propertyName, [owner]]]
          - [[shallowCopy], [propertyType, ['\DateTime']]]
          - [[keep], [propertyType, ['%oro_user.entity.user%']]]

.. _bundle-docs-platform-action-bundle-conditions:

Conditions
----------

Add Custom Condition
^^^^^^^^^^^^^^^^^^^^

The conditions are based on the |ConfigExpression| component.

To add a custom condition, add a service to DIC with the "oro_action.condition" tag, for example:

.. code-block:: none

    services:
        Oro\Bundle\ActionBundle\ConfigExpression\Blank:
            tags:
                - { name: oro_action.condition, alias: blank|empty }

Use the "|" symbol in the alias to specify several aliases. The service class must implement Oro\\Component\\ConfigExpression\\ExpressionInterface.

Configurable Condition
^^^^^^^^^^^^^^^^^^^^^^

**Alias:** --- the option is configurable.

**Description:** --- uses Condition Assembler to assemble conditions from the passed configuration.
This condition is NOT intended for use in the configuration of Action, but you can use it to create a condition based on the configuration at runtime.

**Options:** --- valid configuration of conditions.

**Code Example**

Code Example is a value of the "call_timeout" attribute. It is not blank, and it equals to 20.

.. code-block:: php

    $configuration = [
        '@and' => [
            '@not_blank' => ['$call_timeout'],
            '@equal' => ['$call_timeout', 20]
        ]
    ];
    /** @var \Oro\Bundle\ActionBundle\Model\Condition\ConditionFactory $conditionFactory */
    $condition = $conditionFactory->create(Configurable::ALIAS, $configuration);

    /** @var object $data */
    $data->call_timeout = 20;

    var_dump($condition->evaluate($data)); // will output TRUE

.. include:: /include/include-links-dev.rst
   :start-after: begin
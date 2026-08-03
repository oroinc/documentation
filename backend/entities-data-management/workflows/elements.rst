.. _backend--workflows--managing-elements:

Managing Workflow Elements
==========================

.. _backend--workflows--transition-conditions:

Transition Conditions
---------------------

Add a Custom Condition
^^^^^^^^^^^^^^^^^^^^^^

Conditions are based on the |ConfigExpression| component.

To add a custom condition, add a service to DIC with tag `oro_action.condition`, as illustrated below:

.. code-block:: php


    services:
        Oro\Bundle\WorkflowBundle\ConfigExpression\Blank:
            tags:
                - { name: oro_action.condition, alias: blank|empty }


Use the "|" symbol in the alias to define several aliases. The service class must implement `Oro\\Component\\ConfigExpression\\ExpressionInterface`.

Configurable Condition
^^^^^^^^^^^^^^^^^^^^^^

* **Alias:** configurable
* **Description:** Uses Condition Assembler to assemble conditions from the passed configuration. Do NOT use this condition in workflow configuration; instead, use it to create a condition from configuration at runtime.
* **Options:**

  * Valid configuration of conditions.

**Code Example**

If value of attribute "call_timeout" is not blank AND equals 20.

.. code-block:: php


    $configuration = [
        '@and' => [
            '@not_blank' => ['$call_timeout'],
            '@equal' => ['$call_timeout', 20]
        ]
    ];
    /** @var \Oro\Bundle\WorkflowBundle\Model\Condition\ConditionFactory $conditionFactory */
    $condition = $conditionFactory->create(Configurable::ALIAS, $configuration);

    /** @var object $data */
    $data->call_timeout = 20;

    var_dump($condition->evaluate($data)); // will output TRUE

.. _backend--workflows--transition-actions:

Transition Actions
------------------

Add a Custom Action
^^^^^^^^^^^^^^^^^^^

To add a custom action, add a service to DIC with tag `oro_action.action`, as illustrated below:

.. code-block:: php


    services:
        Oro\Component\Action\Action\CloseWorkflow:
            tags:
                - { name: oro_action.action, alias: close_workflow }


Use the "|" symbol in the alias to define several aliases. The service class must implement `Oro\\Component\\Action\Action\\ActionInterface`.

Configuration Syntax
^^^^^^^^^^^^^^^^^^^^

You can optionally configure each action with a condition to implement more sufficient logic in transition definitions. If the condition is not satisfied, the action does not execute.

If the `break_on_failure` flag is specified, the action throws an exception on error; otherwise it logs the error using a standard logger.

The following are syntax examples:

**Full Configuration Example**

.. code-block:: php


    - '@alias_of_action':
        conditions:
            # optional condition configuration
        parameters:
            - some_parameters: some_value
            # other parameters of action
        break_on_failure: boolean # by default false


**Short Configuration Example**

.. code-block:: php


    - '@alias_of_action':
        - some_parameters: some_value
        # other parameters of action


.. include:: /include/include-links-dev.rst
   :start-after: begin

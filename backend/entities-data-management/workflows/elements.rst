.. _backend--workflows--managing-elements:

Managing Elements
=================

.. _backend--workflows--transition-conditions:

Transition Conditions
---------------------

Add a Custom Condition
^^^^^^^^^^^^^^^^^^^^^^

Conditions are based on the |ConfigExpression| component.

To add a custom condition, add a service to DIC with tag `oro_action.condition`, as illustrated below:

.. code-block:: php
   :linenos:

    services:
        Oro\Bundle\WorkflowBundle\ConfigExpression\Blank:
            tags:
                - { name: oro_action.condition, alias: blank|empty }


Symbol "|" in alias can be used to have several aliases. Please keep in mind that service class must implement `Oro\Component\ConfigExpression\ExpressionInterface`.

Configurable Condition
^^^^^^^^^^^^^^^^^^^^^^

* **Alias:** configurable
* **Description:** Uses Condition Assembler to assemble conditions from passed configuration. This condition is NOT intended to be used in the configuration of Workflow but it can be used to create a condition based on the configuration in runtime.
* **Options:**

  * Valid configuration of conditions.

**Code Example**

If value of attribute "call_timeout" is not blank AND equals 20.

.. code-block:: php
   :linenos:

    $configuration = array(
        '@and' => array(
            '@not_blank' => array('$call_timeout'),
            '@equal' => array('$call_timeout', 20)
        )
    );
    /** @var $conditionFactory \Oro\Bundle\WorkflowBundle\Model\Condition\ConditionFactory */
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
   :linenos:

    services:
        Oro\Component\Action\Action\CloseWorkflow:
            tags:
                - { name: oro_action.action, alias: close_workflow }


Symbol "|" in alias can be used to have several aliases. Please keep in mind that the service class must implement `Oro\Component\Action\Action\ActionInterface`.

Configuration Syntax
^^^^^^^^^^^^^^^^^^^^

Each action can be optionally configured with a condition. It allows to implement more sufficient logic in the definitions of transitions. If a condition is not satisfied, the action will not be executed.

If flag `break_on_failure` is specified, the action throws an exception on error; otherwise it logs error using a standard logger.

Syntax examples are provided below:

**Full Configuration Example**

.. code-block:: php
   :linenos:

    - @alias_of_action:
        conditions:
            # optional condition configuration
        parameters:
            - some_parameters: some_value
            # other parameters of action
        break_on_failure: boolean # by default false


**Short Configuration Example**

.. code-block:: php
   :linenos:

    - @alias_of_action:
        - some_parameters: some_value
        # other parameters of action


.. include:: /include/include-links-dev.rst
   :start-after: begin
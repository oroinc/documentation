.. _bundle-docs-platform-action-bundle-action-groups:

Action Groups
=============

Action Group is a named block of execution logic grouped under its own `actions` configuration node. You can call *action groups* with the `@run_action_group` action in any application configuration node that Action Component supports.

The *Action group* declaration also has an important `parameters` section that describes all the data it expects from the caller (with a type, requirement, default value, and validation message).

Parameters are accessible in actions as the root node of contextual data (e.g., `$.parameterName`). Along with `parameters` and `actions`, you can optionally declare a special `acl_resource` criteria and a custom `conditions` node, where you define special instructions to check before execution.

Action Group Configuration
--------------------------

.. oro_integrity_check:: c99c6e9f1a933e282f068ef1fcf559e3a7113ee0

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/actions.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/actions.yml
        :language: yaml
        :lines: 1-24

Next, run this action_group as follows:

.. code-block:: none

    @run_action_group:
        action_group: demo_flash_greetings_to
        parameters_mapping:
            who: $.myInstanceWithVariousType

Here, we skip the `what` parameter, which has the `default` value.

To see the `@run_action_group` syntax, refer to :ref:`the actions section <bundle-docs-platform-action-bundle-action-component>`.

Data Isolation
--------------

An **Action group** runs with empty context data. For example, if a caller context is mapped with `parameters_mapping` to a new context (under `@run_action_group`), the **action group** executes with that context. In this case, only the data supported by the **action group** parameters declaration is available. This is why **action groups** can be called from different places and under various circumstances.

Call from PHP
-------------

All named action groups are gathered internally in the `oro_action.action_group_registry` registry service, an instance of the Oro\\Bundle\\ActionBundle\\Model\\ActionGroupRegistry class. Its simple API lets you `get` a configured |action group| instance and execute it via the `\\Oro\\Bundle\\ActionBundle\\Model\\ActionGroup::execute` method with the proper parameters.

Recommendations
---------------

**User Interface**

In the `actions` block above, we used the `@flash_message` action as an example. Usually, you do not perform any user interface-related actions in the **action group** `actions` set, because action groups run only in contexts where no user interface is available at runtime.

Using Results of Action Group
-----------------------------

|ActionInterface| implements most actions and stores their results in an execution context object --- usually one of the |AbstractStorage| child instances. So you access all the action group results from the context data passed to its `execute(...)` method.

The `@run_action_group` action has two configuration options for this: `results` (transfers data from the action group context to the caller context separately) and `result` (allocates all context of the executed action group under a desired node of the caller context).

.. hint::
    See :ref:`Actions <bundle-docs-platform-action-bundle-action-component>` for more information about `@run_action_group` options.

Action Group Diagram
--------------------

The following diagram shows the logic of the action group process:

.. image:: /img/bundles/ActionBundle/action_group.png
   :alt: Action Group Diagram

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _bundle-docs-platform-action-bundle-action-groups:

Action Groups
=============

Action Group is a named block of execution logic grouped under its own `actions` configuration node.
*Action groups* can be called along with the `@run_action_group` action in any application configuration node that Action Component supports.
The *Action group* declaration also has an important configuration section - `parameters` that describes all the data expected to obtain from the caller (with a type, requirement, default value, and validation message).

Parameters are accessible in actions as the root node of contextual data (e.g., `$.parameterName`). Along with `parameters` and `actions`, you can also optionally declare a special `acl_resource` criteria and a custom `conditions` node where you can define special instructions to check against before the bunch execution process.

Action Group Configuration
--------------------------

File `<bundleResourceRoot>/config/oro/actions.yml`

.. code-block:: none

    action_groups:                                      # root node for action groups
        demo_flash_greetings_to:                        # name of action group
            replace:                                    # (optional) the list of nodes that should be replaced during the overriding
                - actions                               # node name
            parameters:                                 # parameters declaration node
                what:                                   # name of the parameter
                    type: AcmeDemoBundle/String/Phrase  # (optional, default = any) type validation of parameter (available types: integer, string, boolean, array, double, object, PHP class)
                    message: "Bad type"                 # (optional) message to be prompted if parameter validation failure met
                    default: "Hello"                    # (optional) default value for optional parameter, if not set then parameter `what` is required
                who: ~                                  # set all defaults to parameter options (type: any)
            conditions:                                 # Condition expression
                @not_empty: [$.who]
            actions:                                    # list of actions that should be executed
                - '@call_service_method':
                    service: type_guesser
                    method: guess
                    method_parameters: [$.who]          # as you can see, parameters are accessible from root $.<parameterName>
                    attribute: $.typeOfWho
                - '@flash_message':
                    message: "%param1%, %param2%!"
                    type: 'info'
                    message_parameters:
                        param1: $.what
                        param2: $.typeOfWho


Next, run this action_group as follows:

.. code-block:: none

    @run_action_group:
        action_group: demo_flash_greetings_to
        parameters_mapping:
            who: $.myInstanceWithVariousType

Here, we skip the `what` parameter, which has the `default` value.

To see the `@run_action_group`syntax, please refer to :ref:`the actions section <bundle-docs-platform-action-bundle-action-component>`.

Data Isolation
--------------

Note that **Action group** runs with empty context data. For example, if a caller context is mapped with `parameters_mapping` to a new context (under `@run_action_group`), **action group** is executed along with it. In this case, there will only be the data supported by the **action group** parameters declaration. This is why **action groups** can be called from different places and under various circumstances.

Call from PHP
-------------

All named action groups are internally gathered under the `oro_action.action_group_registry` registry service which is the instance of the Oro\\Bundle\\ActionBundle\\Model\\ActionGroupRegistry class. It has simple api to `get` the |action group| configured instance and perform its execution by applying the `\\Oro\\Bundle\\ActionBundle\\Model\\ActionGroup::execute` method with proper parameters.

Recommendations
---------------

**User Interface**

In the above-mentioned `actions` block, we have used the action called `@flash_message` for example purposes. Usually, you do not perform any user interface-related actions in the **action group** `actions` set, as they are called or used only in the scope of the actions with no user interface environment available in runtime.

Using Results of Action Group
-----------------------------

|ActionInterface| implements most actions and stores the results of these actions under their execution context object. Usually, it is one of the |AbstractStorage| child instances. So all the results of the action group are accessed from the context data passed to its `execute(...)` method.

Here, there are two `@run_action_group` configuration options: `results` (transfers data from the action group context to the caller context separately) and `result` (allocates all context of the executed action group under a desired node of the caller context).

.. hint::
    See :ref:`Actions <bundle-docs-platform-action-bundle-action-component>` for more information about `@run_action_group` options.

Action Group Diagram
--------------------

The following diagram shows the logic of the action group process in graphical representation:

.. image:: /img/bundles/ActionBundle/action_group.png
   :alt: Action Group Diagram

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _bundle-docs-platform-action-bundle-glossary:

Operations (Actions) Glossary
=============================

* :ref:`Buttons <bundle-docs-platform-action-bundle-buttons>` are a user interface component that helps deliver custom actions for user interaction. They provide a way to demonstrate any kind of actions (operations, for example) to UI for a proper context through specific |ButtonsProviderExtension| together with |Buttons| matched by a context.

* :ref:`Operation <bundle-docs-platform-action-bundle-operations>` are configured user interaction elements (buttons, links or even further: forms, pages) with customized execution logic. One of the main components in ActionBundle that handles information about a specific operation logic, how and when a UI element is displayed, the reaction it provides, and how to aggregate the data retrieved from a user (usually through a form) into execution unit values and launch configured *Actions* afterwards.

The operation definition contains the most important information, such as operation related entity classes ('Acme\Bundle\DemoBundle\Entity\MyEntity'), or routes ('acme_demo_myentity_view'), or datagrids ('acme-demo-grid').

The operation can be enabled or disabled. Other fields of the operation contain information about its name, extended options, an order of displayed buttons. For more options please refer to :ref:`Operation Configuration <bundle-docs-platform-action-bundle-operations>`.

* :ref:`Action Group <bundle-docs-platform-action-bundle-action-groups>` is complex business logic sets of backend actions grouped together under the named configuration nodes. It is another key component in ActionBundle. A named group of actions with entry `parameters` (required or optional, typed or not) and conditions.

  *Action groups* can be used not only from an operation but within the workflow processes and in any part of the OroPlatform configuration nodes that understand :ref:`Actions <bundle-docs-platform-action-bundle-action-component>`.

A special `@run_action_group` action is designed to run a group of actions as a single one. (For more information please refer to :ref:`*ActionGroup* configuration <bundle-docs-platform-action-bundle-action-groups>` and `@run_action_group` action.

* :ref:`Condition <bundle-docs-platform-action-bundle-conditions>` - defines whether *Operation* or *ActionGroup* is allowed. Conditions use |ConfigExpression| syntax and can be nested within each other.

* :ref:`Actions <bundle-docs-platform-action-bundle-action-component>`- simple functional blocks (that are described in Action Component). They can be used in *ActionGroups* or *Operations* to implement the preparation logic before *conditions*, to retrieve rendering data, to initialize and execute the logic afterwards.

  * *Operations* contain the following *actions*: **Preactions** (`preactions`), the **Form Init** actions (`form_init`), and **Actions** themselves with the functions of Action Component. The difference between them is that `preactions` are executed before the operation button rendering, though the `form_init` actions are executed before form display. Actions can be used to perform any operations with data in their context (called Action Data) or other entities.

  * **Definition** - a part of *Operation* or *ActionGroup* that contains the configuration of the component itself and describes its behavior.

* **Attribute** - an entity that represents a value (mostly in *Operation*) and is used to render a field value in a step of a form. The attribute knows about its type (string, object, entity etc.) and additional options. The attribute contains a name and label as additional parameters.

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _bundle-docs-platform-action-bundle-glossary:

Operations (Actions) Glossary
=============================

* :ref:`Buttons <bundle-docs-platform-action-bundle-buttons>` are a user interface component that delivers custom actions for user interaction. Through a specific |ButtonsProviderExtension| together with |Buttons| matched by a context, they surface these actions (operations, for example) to the UI in the proper context.

* :ref:`Operation <bundle-docs-platform-action-bundle-operations>` are configured user interaction elements (buttons, links or even further: forms, pages) with customized execution logic. One of the main components is ActionBundle. It handles the specific operation logic, how and when a UI element is displayed, the reaction it provides, and how to aggregate the data retrieved from a user (usually through a form) into execution unit values before launching the configured *Actions*.

The operation definition contains the most important information, such as operation related entity classes ('Acme\Bundle\DemoBundle\Entity\MyEntity'), or routes ('acme_demo_myentity_view'), or datagrids ('acme-demo-grid').

The operation can be enabled or disabled. Its other fields hold its name, extended options, and order of displayed buttons. For more options, refer to :ref:`Operation Configuration <bundle-docs-platform-action-bundle-operations>`.

* :ref:`Action Group <bundle-docs-platform-action-bundle-action-groups>` is a set of backend actions that implement complex business logic, grouped together under named configuration nodes. It is another key component in ActionBundle: a named group of actions with entry `parameters` (required or optional, typed or not) and conditions.

  You can use *Action groups* not only from an operation but also within workflow processes and in any part of the OroPlatform configuration nodes that understand :ref:`Actions <bundle-docs-platform-action-bundle-action-component>`.

A special `@run_action_group` action runs a group of actions as a single one. (For more information, refer to :ref:`*ActionGroup* configuration <bundle-docs-platform-action-bundle-action-groups>` and the `@run_action_group` action.)

* :ref:`Condition <bundle-docs-platform-action-bundle-conditions>` - defines whether *Operation* or *ActionGroup* is allowed. Conditions use |ConfigExpression| syntax and can be nested within each other.

* :ref:`Actions <bundle-docs-platform-action-bundle-action-component>` - simple functional blocks (described in Action Component). You can use them in *ActionGroups* or *Operations* to implement the preparation logic before *conditions*, to retrieve rendering data, and to initialize and execute the logic afterward.

  * *Operations* contain the following *actions*: **Preactions** (`preactions`), the **Form Init** actions (`form_init`), and **Actions** themselves with the functions of Action Component. The difference is that `preactions` run before the operation button renders, while the `form_init` actions run before the form displays. Actions can perform any operations with data in their context (called Action Data) or other entities.

  * **Definition** --- part of *Operation* or *ActionGroup* that contains the configuration of the component itself and describes its behavior.

* **Attribute** --- an entity that represents a value (mostly in *Operation*) and renders a field value in a step of a form. The attribute knows about its type (string, object, entity, etc.) and additional options. It also contains a name and label as additional parameters.

.. include:: /include/include-links-dev.rst
   :start-after: begin

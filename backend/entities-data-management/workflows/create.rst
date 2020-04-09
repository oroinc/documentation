.. _backend--workflows--create:

Basic Workflow Configuration
============================

To configure a custom workflow, create the ``workflows.yml`` file with the configuration and save it into the ``/Resources/config/oro`` directory of your bundle.

.. hint:: You can simplify workflow creation by cloning the existing workflow. See :ref:`Clone a workflow <workflows--actions--clone>`.

For each entity, you can configure as many workflows as required.

.. note:: Pay attention to the business logic. When you create workflows that can be mutually exclusive, make sure that there is no possibility that they may be activated simultaneously.

**Translations**

To correctly display the user interface text concerning workflow process (button labels, page names, etc.), you need to specify `translations` for it.

Create translation files as:

`<YourBundle>/Resources/translations/workflows.{lang_code}.yml`,

where `{lang_code}` is a two-letter language code, e.g., `workflows.en.yml`.

You need to create such file for each language that you will use.

.. tip::

   To simplify creation of the translation file, you can first create a workflow configuration, and then dump all related translation keys to the `workflows.{lang_code}.yml`. For example, if you create workflow 'my_workflow':

   `bin/console oro:workflow:translations:dump my_workflow --locale=en > <YourBundle>/Resources/translations/workflows.en.yml`

For more information, see :ref:`Workflow Translation Wizard <backend--workflows--translation-wizard>`.

Add a Workflow
--------------

In the ``workflows.yml``, use the ``workflows`` key to specify that you are going to add workflows.

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

The value of the ``workflows`` key is the array of workflows.

To define a new workflow, add its name to the array.

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

    workflows:
        phone_call:   # This is the workflow name.

For each workflow key, the corresponding value is the array of the workflow settings. The basic settings include the definitions of:

- An entity that the workflow is applicable to.
- The initial step that is attained upon initializing the workflow.

In the following example, you can find the configuration of the **Phone Call** workflow. This workflow defines the process of making a call to a customer:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/workflows.yml

    workflows:
        phone_call:
            entity: Acme\Bundle\DemoBundle\Entity\PhoneCall    # This is the entity that the workflow is applicable to.
            start_step: start_call                             # This is the initial step that is attained upon initializing of the workflow.
            defaults:
                active: true
            priority: 10

**Translations**

Define the the user-interface workflow name:

+----------------------------------------+---------------------+
| Translation Key                        | Description         |
+========================================+=====================+
| `oro.workflows.{workflow_name}.label`  | The workflow name.  |
+----------------------------------------+---------------------+

.. code-block:: yaml
    :linenos:

        # src/Acme/DemoBundle/Resources/translations/workflows.en.yml

        oro:
            workflow:
                phone_call:
                    label: 'Phone Call'                      # The workflow name as it appears on the user interface.


.. _workflows--actions--clone:

Clone a Workflow
----------------

It is not recommended to modify a system workflow but you can clone it and modify the clone. To clone the workflow, create a dump of its configuration and translation files, adjust them, and load into the system:

1. Dump the workflow configuration.

   For example, you want to dump a configuration of the Alternative Checkout workflow to your CustomBundle:

   .. code-block:: bash
      :linenos:

       php bin/console oro:debug:workflow:definitions b2b_flow_alternative_checkout > /home/oro/commerce-application/src/<Acme>/Bundle/<CustomBundle>/Resources/config/oro/workflows.yml

   where /<Acme>/Bundle/<CustomBundle> is a path to the bundle you want to create a workflow for.

   The copy of the initial file will be created in the destination directory.

2. Dump the workflow translations. Translation contain labels for workflow steps, transitions, etc., thus it is necessary to clone them too.

   .. code-block:: bash
      :linenos:

      php bin/console oro:workflow:translations:dump b2b_flow_alternative_checkout --locale=en > /home/oro/commerce-application/src/<Acme>/Bundle/<CustomBundle>/Resources/translations/workflows.en.yml

   The copy of the initial file will be created in the destination directory.

3. Open copied files with workflow configuration and translations. Change the workflow name in both files. If required, adjust other settings.

   .. important:: You need to change the workflow name to avoid conflicts with the existing workflow: workflows must have unique names in the system.

   .. image:: /img/backend/workflows/workflow_config_change_name.png

   .. image:: /img/backend/workflows/workflow_transl_change_name.png

4. Remove section ``init_routes`` from the cloned workflow configuration:

   .. image:: /img/backend/workflows/workflow_config_remove_init.png

5. Load your cloned and adjusted workflow translations:

   .. code-block:: bash
      :linenos:

      php bin/console oro:translation:load

6. Load your cloned and adjusted workflow configuration:

   .. code-block:: bash
      :linenos:

      php bin/console oro:workflow:definitions:load

Toggle Workflow Enable/Disable
------------------------------

By default, all new workflows are created in inactive state. It means that there are no steps and transitions on an entity view page. Multiple workflows for each entity can be active at the same time. Activation of a workflow can be performed in several ways.

**User Interface**

User can activate workflow through UI in the workflow datagrid which is available in the back-office main menu under "System > Workflows".
Here, each workflow can be activated either using row actions "Activate" and "Deactivate", or from the workflow view page using appropriate buttons.

**Configuration**

Developer can add workflow configuration into a corresponding workflow YAML config in sub-node `active` of node `defaults`.
This approach can be used if there is a need to automatically activate workflow on application installation.
Here is example of such configuration:

.. code-block:: yaml
   :linenos:

    workflows:
        b2b_flow_sales:
            defaults:
                active: true #workflow will be automatically activated during installation
            entity: Oro\Bundle\SalesBundle\Entity\Opportunity
            entity_attribute: opportunity

**Manipulation with workflow entity**

*REST API*

WorkflowBundle provides REST API that allows to activate or deactivate a workflow.

Activation URL attributes:

* **route:** oro_api_workflow_activate
* **parameter:** workflowDefinition - the name of the appropriate workflow

Deactivation URL attributes:

* **route:** oro_api_workflow_deactivate
* **parameter:** workflowDefinition - the name of the appropriate workflow

*Workflow Manager*

WorkflowBundle has WorkflowManager service (oro_workflow.manager) that provides methods to activate and deactivate workflows:

* **activateWorkflow(workflowIdentifier)** - activate workflow by workflow name, Workflow instance, WorkflowItem instance or WorkflowDefinition instance;
* **deactivateWorkflow(workflowIdentifier)** - deactivate workflow by workflow name, Workflow instance (same as above).

Mutually Exclusive Workflows
----------------------------

In some cases, an application can be configured with several workflows that are mutually exclusive on different levels.
For example, with default package, we have the standard workflow that somehow does not cover business logic that client might need.
So we can implement another workflow for the same related entity and that two workflows are conflicting with each other by data or logic operations.
For that cases, we bring new approach for developers to configure their workflows on mutually exclusive manner.
There are two levels of exclusiveness at this moment: *activation level* and *record level*.

**Activation level exclusiveness - exclusive_active_groups**

If your custom workflow represents a replacement flow for some already existent workflows, you can provide a possibility
to secure your customization by ensuring that only one of them can be activated in the system at a time.

This can be performed by defining *common exclusive activation group* for both workflows.
That can be done in workflow configuration node called `exclusive_active_groups`.

Let's use `basic_sales_flow` and `my_shop_sales_flow` workflows as an example, assuming that they both use the same related entity (e.g., Order) and `my_shop_sales_flow` is a complete replacement for another one. In this scenario, our task is to prevent administrators from enabling both of them at the same time. To do this, we can provide a common group in workflows
configurations under the `exclusive_active_groups` node and call it 'sales'. Now, when an administrator attempts to activate one of these two groups, there will be an additional check for group
conflicts and a warning if the other workflow in the group 'sales' is already active. This ensures that two workflows are never active simultaneously.

**Record level exclusiveness - exclusive_record_groups**

Another level of exclusiveness is a record level. It provides a possibility to have several active workflows at the same time with one limitation - only one workflow can be started for a related entity within the same *exclusive record group*. So that if you have workflows that can bring different ways to reach the goal of common business process around same entity (*but* not both at once), you may configure that workflow with the same group in `exclusive_record_groups` in their configurations.

So, when **no** workflows are performed for an entity in the same exclusive record group, there is a possibility to launch starting transitions from any of them.
But, when one of that workflows has started, you cannot perform any actions from the other workflow (and start it, either).
That is a ramification of a business process that can be reached by the `exclusive_record_group` in workflows configuration.


**Priority Case**

Let's say, you have two exclusive workflows at the level of a single record and both of them have automated start transitions (e.g., automatically perform start transition when a new instance of their common related entity is created). In this case, you can configure the `priority` flag in the workflow configurations. So when a new record of the related entity is created,
workflows are processed by that priority flag and the second one from same exclusive record group does not perform its start transition, if another workflow record from the same exclusive group is already present. For example, `first_workflow` and `second_workflow`. When we need to process `second_workflow` workflow before `first_workflow`, we can determine its priority level higher than of the other one. Then, when new `SomeEntity` entity is persisted, the system will perform `second_workflow` workflow start transition first. Additionally, if the start transition of the dominant workflow did not meet its conditions to start, then the second workflow has a chance to start its flow as well.

Initial Transitions
-------------------

To provide the ability to start a workflow from an *unrelated entity*, use **initial transitions**. It is a special type of transition configuration that allows us to use transition as an initiative (as it comes from the name) for new workflow instance (workflow item) creation. The main difference from the *start transitions* is that *init transition* can be invoked from almost any part of an application with indirect relation to the main workflow entity or without it (if we can fill all the necessary data of the main entity).

Distinctive configuration features of *init transitions* are special nodes `init_entities`, `init_routes`, `init_datagrids` in transition configuration together with `is_start: true`.

For more details see :ref:`configuration reference <backend--workflows--config-reference>` section.

Disable Operations
------------------

Some workflows can be used to expand an existing configuration and replace the old (primitive) behavior. Usually a simple custom behavior in Oro-based applications is managed through operations, and when you create a more advanced way to manage the business logic trough a specific workflow configuration, you might need to disable those operations. It can be done trough the `disable_operations` configuration node:

.. code-block:: yaml
   :linenos:

        disable_operations:
            operation_one:      #disable operation for custom entities (match by context)
                - EntityClass1
                - EntityClass2
                - EntityClass3
            operation_two: ~    #disable operation for any occurrences

.. note::
      See |Work with Operations| for more details.

Filter by Scopes
----------------

If a :ref:`scope configuration <dev-scopes>` is provided for a workflow, the Oro application uses only the workflows selected by filtering all available workflows using scopes defined for `worflow_definition` scope type.

Example of scope configuration:

.. code-block:: yaml
   :linenos:

        scopes:
            -
                scopeField1: 2
            -
                scopeField1: 42
                scopeField2: 3
                scopeField3: 77

.. note::
   The `scopeField1`, `scopeField2`, and `scopeField3` are scope criteria that are delivered by scope providers. Scope provider should be registered in the Oro application for the `workflow_definition` scope type.


.. include:: /include/include-links-dev.rst
   :start-after: begin
.. _bundle-docs-platform-action-bundle-operations:

Operations (Actions)
====================

*Operations* provide the possibility to assign any interaction with a user by specifying:

 - Entity classes
 - Routes
 - Datagrids

Every active *operation* shows a button or a link on the corresponding page. The button is displayed only if all the described preconditions are met. For the *operation* button or link to be displayed, the `preconditions` section should evaluate to `true`. After a user clicks on the button or link, the *operation* will be performed only if the `conditions` section evaluates to `true`. Also, if the operation has a form dialog configuration, then a modal dialog with fields appears when clicking the button.

Each *operation* relates to an entity type (consists of a full class name) or\\and a route of the page where the operations should be displayed or\\and a datagrid. Before the page loading, ActionBundle chooses *operations* with a corresponding page entity|route. Then these *operations* are checked against the preconditions. If all the preconditions are met - the operation's button is displayed.
After clicking the button, all the performed operations (and underlined actions) are executed, provided that all the preconditions of *operation* and conditions of *actions* are met.

Operation Configuration
-----------------------

All operations can be described in the ``actions.yml`` configuration file under the corresponding bundle in the `config/oro` resource directory.
Below is an example of a simple operation configuration that performs an execution logic with the MyEntity entity.

.. oro_integrity_check:: 44fe2d774e42390c62957717d5d5addf8f342d06

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/actions.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/actions.yml
        :language: yaml
        :lines: 26, 40-125

This configuration describes the operation that relates to the ``Question`` entity. The button with the "adme.demo.myentity.operations.myentity_operation" label is displayed on the view page (acme_demo_myentity_view) of this entity (in case the 'updatedAt' field > new DateTime('now')). If the `expired` property of the entity = false, then clicking the button triggers the "assign_value" action that sets the 'expired' field to `true`. If `form_options` are specified, then the form dialog with attributes fields is displayed when clicking the button. The actions run only on the submit form.

Configuration Validation
------------------------

Execute a command to validate all operations configurations:

.. code-block:: php

    php bin/console oro:action:configuration:validate

.. note:: All configurations apply automatically after their changes are made in the developer environment.

.. _bundle-docs-platform-action-bundle-default-operations:

Default Operations
------------------

**Oro Action Bundle** defines several system-wide default operations for a common purpose. Those are basic CRUD-called operations for entities:

- `UPDATE` - operation for an entity editing that uses a route from the `routeUpdate` option of the entity configuration.
- `DELETE` - operation for an entity deletion that uses a route from the `routeName` option of the entity configuration.

  If the default operations are used in the non-default applications (like in `commerce`), the routes are retrieved from the `routeCommerceUpdate` and `routeCommerceDelete` options.

  Configurations for the default operations are allocated in the `Resources/config/oro/actions.yml` file under the **Oro Action Bundle** directory.

Questions and Answers
^^^^^^^^^^^^^^^^^^^^^

How to disable a CRUD default operation for my Bundle?
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Supposing you need to disable the default `DELETE` operation for your new `MyEntity` entity. Here is the case which describes the solution. You can do this in `actions.yml` under your bundle configuration resources directory:

.. code-block:: php

    operations:
        DELETE:
            exclude_entities: ['MyEntity']

The operation merges a special additional condition to the default operation during the configuration compilation so that the default `DELETE` operation doesn't match your entity and is not displayed as well.

Can I disable default operation for my datagrid?
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Yes. There are two ways to do that:

1. Disable the operation by updating your datagrid configuration in its `action_configuration` section. Define a key corresponding to the operation name with the `false` value.

`datagrids.yml`:

.. code-block:: none

    datagrids:
        your_datagrid_name:
            #... datagrid config sections
            action_configuration:
                some_default_common_operation: false

`some_default_common_operation` is not displayed at `your_datagrid_name` grid anymore. However, action_configuration can accept callable as a value, so sometimes the options are occupied by service callback. If it is so, we can use a different approach.

2. Disable the operation for custom datagrid using the `exclude_datagrids` option in the operation definition. So you can specify the name of the datagrid that should be excluded from the *operation* matching. If another bundle defines your operation, you can use the *merge* behavior of operation configuration and add an additional property value under your bundle configuration. For example, the operation that should not be displayed for the `product_view` datagrid is the default `DELETE` operation from `OroActionBundle`. You can exclude your grid from matching with the next addition to `<YourBundle>/Resources/config/oro/actions.yml`

.. code-block:: none

    operations:
        DELETE:
            exclude_datagrids:
                - product_view

You can always use other ways to define, reuse, or customize the operation definition. Along with basic merge, the `replace`, `extend`, and `substitute_operation` options become helpful in different cases.

How can I modify CRUD default operation for my Bundle?
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you need to customize a default or any other operation, you should change its `label` as follows:

.. code-block:: none

    operations:
        my_special_entity_custom_edit:
            extends: UPDATE                         # this is for keeping all other properties same as in default
            label: 'Modify me'                      # custom label
            substitute_operation: UPDATE            # replace UPDATE operation with current one
            entities: ['MyEntity']                  # replacement will occur only if this operation will be matched by entity
            for_all_entities: false                 # overriding extended property for `entities` field matching only

Here is a custom modification made through a substitution mechanism when the operation mentioned in the `substitute_operation` field is replaced by the current one.
Additionally, you can limit the application of the modification only to the entities mentioned in the `entities` field. If you need to replace the operation fully instead of copying the extended version, the `extends` field can be omitted, and the custom body should be defined.

See the :ref:`substitution <bundle-docs-platform-action-bundle-operation-substitution>` section in the :ref:`configuration documentation <bundle-docs-platform-action-bundle-configuration-reference>` for more details.

Operation Diagram
-----------------

The following diagram shows operation processes logic in graphical representation:

.. image:: /img/bundles/ActionBundle/operation.png
   :alt: Operation Diagram

.. toctree::
   :hidden:

   Glossary <glossary>
   buttons
   action-groups
   configuration-reference
   Actions and Conditions <actions-conditions>
   Console Commands <commands>

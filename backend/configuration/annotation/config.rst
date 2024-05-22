.. _attribute-config:

#[Config]
=========

This attribute is used to configure default values for configurable entity classes.

Arguments
---------

``defaultValues``
^^^^^^^^^^^^^^^^^

Configures default values for particular config options on a per property basis:

.. code-block:: php

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[Config(
        defaultValues: [
            "dataaudit" => ["auditable" => true]
        ]
    )]
    class User
    {
        // ...
    }

This example sets the ``auditable`` option from the ``dataaudit`` scope to ``true`` for the ``User`` class.

You can use``immutable`` on any settings. This attribute can be used to prohibit changing the association state.

``activity``
~~~~~~~~~~~~

This parameter sets default settings for OroActivityBundle. This bundle helps classify certain entity types as activities and enables a special relation type between an entity and activities. For more information, see :ref:`OroActivityBundle <bundle-docs-platform-activity-bundle>`.

* **show_on_page** *integer* - is used to change a page, which will display the "activity list" and activity buttons. Can be used as bitmask. Possible values are in ``\Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope::VIEW_PAGE``.

* **route** *string* - is the route name for the controller that can be used to render the list of this type of activities. This controller must have $entityClass and $entityId. Parameters to pass the target entity. This attribute must be defined for each activity entity (an entity included in the 'activity' group, see 'grouping' scope).

* **acl** *string* - is used to check whether this type of activity is available in the current security context.

* **action_button_widget** *string* - is the widget name of the activity action used to render a button. This widget should be defined in placeholders.yml. This attribute can be defined for the activity entity. Please note that an activity should provide both action_link_widget and action_link_widget, because actions can be rendered both as a button as a dropdown menu.

* **action_link_widget** *string* - is the widget name of the activity action used to render a link in the dropdown menu. This widget should be defined in placeholders.yml. This attribute can be defined for the activity entity. Please note that an activity should provide both action_link_widget and action_link_widget, because actions can be rendered as a button as a dropdown menu.

* **activities** *string[]* - is the list of activities' class names that can be assigned to the entity.

* **inheritance_targets** *string[]* - are target entity classes whose activities will be shown in the current entity. If entity 1 has relation with entity 2 and activity is enabled for both of them, we can configure entity 1 using this option to show activities from related entity 2. In the example of the configuration for unidirectional relations below, we are going to join the "user" relation to the "Test" entity through the "Example" entity relation:

.. code-block:: none

    [
       [target] => Oro\Bundle\ExampleBundle\Entity\Test
       [path] => [
           [0] => [
                  [join] => Oro\Bundle\ExampleBundle\Entity\Example
                  [conditionType] => WITH
                  [field] => test_id
          ],
          [1] => user
       ]
    ]


* **priority** *integer* - can be used to change the order of this type of activity on the UI.

* **immutable** *boolean or array* - is used to prohibit changing the activity state (regardless of whether it is enabled or not) for the entity. If TRUE, then activity state cannot be changed. It can also be an array with the list of class names of activities whose state cannot be changed.

``attachment``
~~~~~~~~~~~~~~

You can configure this attribute when you use |AttachmentProvider|.

* **enabled** *boolean* - indicates whether attachments can be added to the entity or not.

* **maxsize** *integer* - is the max size of the uploaded file in megabytes.

* **mimetypes** *string* - is the list of all allowed MIME types for attachments. MIME types are delimited by linefeed (\n) symbol. Example of values: 'image/jpeg', 'image/gif', 'application/pdf'.

* **auto_link_attachments** *boolean* - if TRUE, then Email Attachments are saved to the Attachment Entity.

* **immutable** *boolean* - can be used to prohibit changing the attachment association state (regardless of whether it is enabled or not) for the entity. If TRUE than the current state cannot be changed.

``attribute``
~~~~~~~~~~~~~

Attributes enable you to create additional entity fields dynamically. Read more about this functionality in the :ref:`Attributes Configuration <dev-entities-attributes>` topic.

* **has_attributes** *boolean* - is used to enable the "attribute" functionality.

``comment``
~~~~~~~~~~~

* **enabled** *boolean* - indicates whether the entity can have comments.

* **immutable** *boolean* - is used to prohibit changing the comment association state (regardless of whether it is enabled or not) for the entity. If TRUE, then the current state cannot be changed.

``customer``
~~~~~~~~~~~~

Provides customer configuration, such as registered customer classes, entity label, icon, route, etc.

* **enabled** *boolean* - is used to enable the "customer" functionality.

* **associated_opportunity_block_priority** *integer* - is the priority of associated opportunity grid block on the associated customer entity.

``dataaudit``
~~~~~~~~~~~~~

The parameter use OroDataAuditBundle to provide changelogs for your entities. Read more about :ref:`Data Audit <entities-data-management-data-audit>` bundle.

* **auditable** *boolean* - enables dataaudit for this entity. If it is not specified or set to false, you can enable audit in the UI.

* **immutable** *boolean* - this attribute can be used to prohibit changing the auditable state (no matter whether it is enabled or not) for the entity. If TRUE than the current state cannot be changed.

``dictionary``
~~~~~~~~~~~~~~

Dictionary entities are responsible for storing a predefined set of values of a certain type and their translations. They values within a dictionary can have a priority or some other data. More information is available in the :ref:`Dictionaries <dev-entities-dictionaries>` topic.

* **virtual_fields** *string[]* - specifies the list of fields for which the virtual fields can be created. If it is not specified, the virtual fields are created for all fields, except for the identifier ones.

* **search_fields** *string[]* - specifies the list of fields used for searching in the reports filter.

* **representation_field** *string* - specifies the representation field used to render titles for search items in the reports filter.

* **activity_support** *boolean* - enables the "activity_support" functionality.

``draft``
~~~~~~~~~

OroDraftBundle enables you to edit and publish a version of the Draftable entity record that will need more work in order to be finished. For more information, see the :ref:`How to Use Drafts <draft-bundle--use-draft>` topic.

* **draftable** *boolean* - enables the "draft" functionality.

``entity``
~~~~~~~~~~

This attribute configures UI params of the entity.

* **icon** *string* - sets the icon in the admin area. For more information, see |Font Awesome| documentation .

* **entity_alias** *string* - stores an alias generated for an entity and helps to resolve duplicate aliases.

* **entity_plural_alias** *string* - stores a plural alias generated for an entity and helps to resolve duplicate aliases.

* **contact_information** *array* - enables you to change contact information (phone or email) for the entity.

* **label** *string* - changes label of the entity.

* **plural_label** *string* - changes plural label of the entity.

* **description** *string* - changes description of the entity.

* **grid_all_view_label** *string* - changes all view label of the entity.

* **frontend_grid_all_view_label** *string* - changes all view label of the entity for frontend.

``enum``
~~~~~~~~

This attribute is only used for `Enum parameters`. For more information, see :ref:`Option Set Fields <book-entities-extended-entities-enums>` .

* **code** *string* - a unique identifier of this enum.

* **public** *boolean* - indicates whether this enum is public. Public enums can be used in any extendable entity, which means that you can create a field of this enum type in any entity. Private enums cannot be reused.

* **multiple** *boolean* - Indicates whether several options can be selected for this enum or it supports only one selected option.

* **immutable** *boolean or array* - is used to prohibit changing the list of enum values and a public flag. This means that values cannot be added or deleted, but it is still possible to update the names of existing values, reorder them and change the default values. Below are examples of possible values:

   - false or empty array - no any restrictions
   - true - means that all constraints are applied, so it will not be allowed to add/delete options and change 'public' flag
   - 'add', 'delete', 'public' - the same as true; it will not be allowed to add/delete options and change 'public' flag
   - 'delete' - it is not allowed to delete options, but new options can be added and 'public' can be changed

* **immutable_codes** *string[]* - is an array of undeletable enum options. These options cannot be deleted but can still be edited.

``extend``
~~~~~~~~~~

This attribute sets default settings for :ref:`Extend Entities <book-entities-extended-entities>`.

* **owner** *string* - can have the following values:

   - ``ExtendScope::OWNER_CUSTOM`` - The property is user-defined, and the core system should handle how the property appears in grids, forms, etc. (if not configured otherwise).
   - ``ExtendScope::OWNER_SYSTEM`` - Nothing is rendered automatically, and you must explicitly specify how to show the property in different parts of the system (grids, forms, views, etc.).

* **table** *string* - is the table name for a custom entity. This is optional attribute. If it is not specified, the table name is generated automatically.

* **inherit** *string* - is the parent class name. You are not usually requires to specify this attribute as it is calculated automatically for regular extend and custom entities. An example of an entity where this attribute is used is EnumValue.

* **pending_changes** - when a user changes something that requires schema update, this change is not applied to the configuration, but is stored into "pending_changes" as changeset. The format of changeset is ['scope' => ['field' => ['oldValue', 'newValue'], ...], ...].

    Let's assume that a user has an active activity email and changes it to a task. In this case, the value of pending changes would be the following:

    .. code-block:: none

        'activity' => [
            'activities' => [
                ['Oro\Bundle\EmailBundle\Entity\Email'],
                ['Oro\Bundle\TaskBundle\Entity\Task'],
            ],
        ]

* **is_serialized** *boolean* - if TRUE then field data will be saved in serialized_data column without doctrine schema update.

* **state** *string* - the state of the extend config field. See available states in |ExtendScope.php|.

* **is_extend** *boolean* - if true, the config entity is able to extend.

* **is_deleted** *boolean* - if true, the config entity is able to delete.

* **upgradeable** *boolean* - if true, the extend config entity is able to update.

* **pk_columns** *string[]* - a list of Primary Keys column name.

* **index** *string[]* - a list of index fields of the entity. See available index states in |IndexScope.php|

* **schema** *array* - contains information about the structure and entity class of the extend.

* **relation** *array* - contains information about the relation of the entity.

* **extend_class** *string* - extends class name.

``form``
~~~~~~~~

This attribute configures :ref:`Custom Form Type for Fields <book-entities-extended-entities-custom-form-type-for-fields>` .

* **form_type** *string* - form type for a specific entity.

* **form_options** *array* - form options for a specific entity.

* **grid_name** *string* - name of grid of the entity. Examples: 'users-select-grid', 'contacts-select-grid', 'customer-customers-select-grid'.

``grid``
~~~~~~~~

With this parameter, you can set the :ref:`Datagrid <data-grids>`.

* **context** *string* - a grid name that used for rendering entity context.

* **default** *string* - the default grid name for the entity.

``grouping``
~~~~~~~~~~~~

* **groups** *string[]* - allows to group entities. An entity can be included in several groups.

``merge``
~~~~~~~~~

The attribute enables you to merge the scope of an entity.

* **enable** *boolean* - enables merge for this entity.

* **cast_method** *string* - options for rendering entity as string in the UI. Method of entity to cast object to string. If these options are empty __toString will be used (if available).

* **template** *string* - a twig template to render object as string.

* **max_entities_count** *integer* - the max count of entities to merge.

``organization``
~~~~~~~~~~~~~~~~

* **applicable** *array* - is used to specify which organizations custom entity will be visible to. On the entity edit page, it is represented with form type ``oro_type_choice_organization_type``, which provides a selector for organizations (regardless of whether it is activated or not) defined in the application so that user can select a specific organization(s) or "ALL" organizations.

Example:

.. code-block:: none

    'all' => true
    'selective' => []

``ownership``
~~~~~~~~~~~~~

The attribute set owner of the entity. For more information, see :ref:`Access Levels and Ownership <backend-security-bundle-example>` and :ref:`Configuring Permissions for Entities <backend-security-bundle-configure-entities>`.

* **owner_type** *string* - can have the following status:

   - ``ORGANIZATION`` needs to set **owner_field_name** and **owner_column_name**
   - ``BUSINESS_UNIT`` needs to set **owner_field_name**, **owner_column_name**, **organization_field_name** and **organization_column_name**
   - ``USER`` needs to set **owner_field_name**, **owner_column_name**, **organization_field_name** and **organization_column_name**

* **frontend_owner_type** *string* - can have the following status:

   - ``FRONTEND_USER``
   - ``FRONTEND_CUSTOMER``

* **owner_field_name** *string* - the name of the owner field; if `owner_type` is ORGANIZATION, then this parameter equals `organization_field_name`.

* **owner_column_name** *string* - the name of the owner column; if `owner_type` is ORGANIZATION, then this parameter equals `organization_column_name`.

* **organization_field_name** *string* - the name of the organization field; if `owner_type` is ORGANIZATION, then this parameter equals `owner_field_name`.

* **organization_column_name** *string* - the name of the organization column; if `owner_type` is ORGANIZATION, then this parameter equals `owner_column_name`.

Attributes for frontend owners: **frontend_owner_field_name**, **frontend_owner_column_name**,
**frontend_customer_field_name**, **frontend_customer_column_name**.

* **global_view** *boolean* - allows to show entities from an organization with system access to another organization. For more information, see the :ref:`Global View Entities <backend-security-bundle-global-view-entities>` topic.

``reminder``
~~~~~~~~~~~~

A notification about the upcoming event.

* **reminder_template_name** *string* - reminder email template name

* **reminder_flash_template_identifier** *string* - reminder WebSocket message template name

``security``
~~~~~~~~~~~~

For more information, see the :ref:`Configuring Permissions for Entities <backend-security-bundle-configure-entities>` topic.

* **type** *string* - is a type of security. In most cases "ACL".

* **permissions** *string* - is used to specify the access list for the entity. Example: VIEW;CREATE;EDIT;DELETE.

* **group_name** *string* - is used to group entities by applications.

*  **category** *string* - is used to categorize an entity.

* **field_acl_supported** *boolean* - enable this attribute to prepare the system to check access to the entity fields. For more information, see :ref:`Enable Support of Field ACL for an Entity <backend-security-bundle-field-acl-enable-support>`.

* **share_scopes** *string[]* - determines within which group an object can be shared (available for the Enterprise edition only). For example, if share_scope=[organization], then a user can share the object only to organizations. Role permission "Share" says who can share, "Share Scope" says how an object can be shared.

Other possible attributes for security: **group**, **share_grid**, **field_acl_enabled**, **show_restricted_fields**.

``sharding``
~~~~~~~~~~~~

Data sharding allows to improve OroCommerce operation and accelerate database performance when handling big volumes of data. For more information, see :ref:`Configure Price List Sharding <admin-price-list-sharding>`.

* **discrimination_field** *string* - is the name of the sharding field. Example:  "priceList".

``search``
~~~~~~~~~~~~~

* **searchable** *boolean* - indicates what custom entity can be searchable.

``slug``
~~~~~~~~

This attribute is set for |SluggableInterface|.

* **source** *string* - slug source field name.

``tag``
~~~~~~~~

This attribute is set up for the tag entity.

* **enabled** *boolean* - indicates whether the entity can have tags. By default ``false``.

* **immutable** *boolean* - can be used to prohibit changing the tag state (regardless of whether it is enabled or not). If TRUE, then the current state cannot be changed. By default ``false``.

* **enableGridColumn** *boolean* - indicates whether column with tags should appear by default on the grid. If FALSE, it does not appear on the grid, and can be enabled from the grid settings. By default ``true``.

* **enableGridFilter** *boolean* - indicates whether tags filter should appear by default on the grid. If FALSE, it does not appear on the grid, and can be enabled from the filter manager. By default ``true``.

* **enableDefaultRendering** *boolean* - indicates whether to use default rendering of tags in entity view pages. If FALSE tags will not be rendered automatically and allows to use custom rendering logic. By default ``true``.

``entity_management``
~~~~~~~~~~~~~~~~~~~~~

This attribute is used to enable or disable the ability to edit an entity and its fields in the Entity Management menu in the back-office. When disabled, the buttons for managing the entity and its fields are hidden, leaving only the ability to view its structure.

* **enabled** *boolean* - indicates whether an entity can be managed in the back-office. By default, it is set to ``true``.

Example:

.. oro_integrity_check:: 3655407d4ccf9a06b86b2728b7438ad8d3419e03

   .. literalinclude:: /code_examples/commerce/demo/Entity/NotManageableEntity.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/NotManageableEntity.php
       :language: php
       :lines: 3-4, 6-9, 10-13, 15-17, 22-27, 56-57

``territory``
~~~~~~~~~~~~~

* **associations** *string[]* - an array of territory association classes.

``workflow``
~~~~~~~~~~~~~

* **show_step_in_grid** *boolean* - if TRUE, then a workflow step is displayed in the grid.


``routeName``
^^^^^^^^^^^^^

The route name of the view that shows the datagrid of available records:

.. code-block:: php

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[Config(
        routeName: "oro_user_index"
    )]
    class User
    {
        // ...
    }


``routeView``
^^^^^^^^^^^^^

The route name of a controller that shows a particular object:

.. code-block:: php

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[Config(
        routeView: "oro_user_view"
    )]
    class User
    {
        // ...
    }

``routeCreate``
^^^^^^^^^^^^^^^

The route name of a controller that creates an object:

.. code-block:: php

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[Config(
        routeCreate: "oro_user_create"
    )]
    class User
    {
        // ...
    }


``routeUpdate``
^^^^^^^^^^^^^^^

The route name of controller action that updates an object:

.. code-block:: php

    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[Config(
        routeUpdate: "oro_user_update"
    )]
    class User
    {
        // ...
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin

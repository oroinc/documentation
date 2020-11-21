.. _web-api--configuration:

Configuration Reference
=======================

The configuration declares all aspects related to a specific entity. The configuration should be placed in ``Resources/config/oro/api.yml`` to be automatically loaded.

All entities, except custom entities, dictionaries, and enumerations are inaccessible via the API. To make an entity available via the data, enable it directly. For example, to make the ``Acme\Bundle\ProductBundle\Product`` entity available via the API, use the following configuration:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\ProductBundle\Product: ~

If an auto-generated alias for your entity does not look good enough for you, change it in ``Resources/config/oro/entity.yml``. For more details, see the :ref:`entity aliases documentation <entity-aliases>`.

.. important:: Run the ``oro:api:cache:clear`` CLI command to immediately make an entity accessible via the API. If you use the API sandbox, run the ``oro:api:doc:cache:clear`` CLI command to apply the changes for it.

For additional information, see :ref:`CLI commands <web-api--commands>`.

Configuration Structure
-----------------------

To get the overall configuration structure, execute the following command:

.. code-block:: bash

    php bin/console oro:api:config:dump-reference

By default this command shows configuration of nesting entities. To simplify the output you can use the ``--max-nesting-level`` option, e.g.

.. code-block:: bash

    php bin/console oro:api:config:dump-reference --max-nesting-level=0

The default nesting level is ``3`` . It is specified in the configuration of ApiBundle via the ``config_max_nesting_level`` parameter. If needed, change this value:

.. code-block:: yaml

    # config/config.yml

    oro_api:
        config_max_nesting_level: 3

The first level sections of configuration are:

-  `entity_aliases <#entity-aliases-configuration-section>`__ - allows overriding entity aliases.
-  `entities <#entities-configuration-section>`__ - describes the configuration of entities.

The top level configuration example:

.. code-block:: yaml

    api:
        entity_aliases:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                ...

        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                exclude:
                ...
                fields:
                    ...
                filters:
                    fields:
                        ...
                sorters:
                    fields:
                        ...
                actions:
                    ...
                subresources:
                    ...
            ...


.. _web-api--exclude-option:

`exclude` Option
----------------

The ``exclude`` configuration option describes whether an entity or its fields should be excluded from the API.

Example:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity1:
                exclude: true # exclude the entity from the API
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity2:
                fields:
                    field1:
                        exclude: true # exclude the field from the API

Additionally, use the ``exclude`` option to indicate whether to disable filtering or sorting for certain fields. Please note that for fields excluded as described above, filtering and sorting are disabled automatically.

Example:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity1:
                sorters:
                    fields:
                        field1:
                            exclude: true
                filters:
                    fields:
                        field1:
                            exclude: true

Please note that the ``exclude`` option is applicable only for the API. To exclude an entity or its fields globally, use ``Resources/config/oro/entity.yml``:

.. code-block:: yaml

    oro_entity:
        exclusions:
            # whole entity exclusion
            - { entity: Acme\Bundle\AcmeBundle\Entity\AcmeEntity1 }
            # exclude field1 of Acme\Bundle\AcmeBundle\Entity\Entity2 entity
            - { entity: Acme\Bundle\AcmeBundle\Entity\AcmeEntity2, field: field1 }

.. _web-api--entity-aliases-config:

`entity\_aliases` Configuration Section
---------------------------------------

The ``entity_aliases`` section can be used to:

* Override the existing system-wide entity aliases
* Add aliases for models to be used only in the API
* Completely replace an ORM entity with a model

Use it when you need to provide entity aliases for the API, but it is not possible to share them system-wide. For example, because of the backward compatibility promise or because your models were created for use only in the API.

Please see the :ref:`Entity aliases documentation <entity-aliases>` for more details about entity aliases.

**Example:**

.. code-block:: yaml

    api:
        entity_aliases:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                alias: acmeentity
                plural_alias: acmeentities

To completely replace an ORM entity with a model in the API, use the ``override_class`` option. As a result, instead of the overridden ORM entity, the model will be used in the primary API resource, sub-resources, and relationships. This is helpful when creating and using a model can significantly simplify implementation of the API, for example, when the schema of the API resource is very different from the schema of the ORM entity.

**Example:**

.. code-block:: yaml

    api:
        entity_aliases:
            Acme\Bundle\AcmeBundle\Api\Model\AcmeModel:
                alias: acmeentity
                plural_alias: acmeentities
                override_class: Acme\Bundle\AcmeBundle\Entity\AcmeEntity

.. note:: The model class must be a subclass of the overridden entity class.

.. note:: When ``override_class`` option is used, some entity specific configuration, like :ref:`Extended Associations <extended-many-to-many-association>`, need to be done for an overridden ORM entity, not for a model.

**Example of correct configuration:**

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Api\Model\AcmeModel: ~

            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                fields:
                    target:
                        data_type: association:manyToOne

**Example of incorrect configuration:**

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Api\Model\AcmeModel: ~
                fields:
                    target:
                        data_type: association:manyToOne

.. _web-api--entities-config:

`entities` Configuration Section
--------------------------------

The ``entities`` section describes the configuration of entities.

*  **documentation\_resource** *string* - May contain the link to the |markdown| file that contains detailed documentation for a single or multiple API resources. For more details, see :ref:`Documenting API Resources <web-api--doc>`.

    Please note that the same entity can be configured in different ``Resources/config/oro/api.yml`` files, e.g. when some bundle needs to add a field to an entity declared in another bundle. In this case, all configuration files for this entity can have **documentation\_resource** option and all documentation files declared there are merged. Pay attention that if the same field is documented in several documentation files, they are merged and only a documentation from one file is used.

*  **exclude** *boolean* - Indicates whether the entity should be excluded from the API. By default ``false``.

*  **inherit** *boolean* - Indicates whether the configuration for certain entity should be merged with the configuration of a parent entity. By default, it is set to ``true``. Set to ``false`` if a derived entity should have completely different configuration to the parent entity and merging with the parent configuration is not needed.

*  **exclusion\_policy** *string* - Indicates the exclusion strategy to use for the entity. Possible values: ``all``, ``custom_fields`` or ``none``. By default, it is set to ``none``.

   * ``none`` - exclude fields marked with the exclude flag.
   * ``all`` - exclude all fields that are not configured explicitly.
   * ``custom_fields`` - exclude all custom fields (fields with ``is_extend = true`` and ``owner = Custom`` in extend scope in entity configuration) that are not configured explicitly.

*  **max\_results** *integer* - The maximum number of entities in the result. Set ``-1`` (it means unlimited), zero or positive number to set the limit. Use to set the limit for both the parent and related entities.

*  **order\_by** *array* - The property can be used to configure default ordering of the result. The item key is the name of a field. The value can be ``ASC`` or ``DESC``. By default the result is ordered by an identifier field.

*  **disable\_inclusion** *boolean* - Indicates whether an inclusion of related entities is disabled. In JSON:API the |**include** request parameter| can be used to customize which related entities should be returned. By default ``false``.

*  **disable\_fieldset** *boolean* - Indicates whether one can request a restricted set of fields. In JSON:API, the |**fields** request parameter|  is used to customize which fields to return. By default ``false``.

*  **disable\_meta\_properties** *boolean* - The flag indicates whether a requesting of additional meta properties is disabled. By default ``false``.

*  **disable\_partial\_load** *boolean* - The flag indicates whether using of |Doctrine partial objects| is disabled. By default ``false``. When using of the partial objects is allowed the ``HINT_FORCE_PARTIAL_LOAD`` query hint is used together with them to avoid loading unneeded foreign keys.

*  **hints** *array* - The |Doctrine query hints|. Each item can be a string or an array with ``name`` and ``value`` keys. The string value is a short form of ``[name: hint name]``.

*  **inner\_join\_associations** *array* - A list of entity associations for which INNER JOIN should be used instead of LEFT JOIN. Use the ``dot`` notation to specify a path to a nested association, e.g., ``user.organization``. Each element in the path must be equal to the name of existing property of an entity. This option can be used to optimize SQL query that is used to load data if some associations are mandatory and cannot be empty.

*  **identifier\_field\_names** *string[]* - The names of identifier fields of the entity. Use this option to override names set in a configuration file (for the API resource that are not based on ORM entity) or retrieved from an entity metadata (for ORM entities). This option is helpful when you do not want to use the primary key as an entity identifier in the API.

*  **form\_type** *string* - The form type to use for the entity in the :ref:`create <create-action>` and :ref:`update <update-action>` actions. By default the ``Symfony\Component\Form\Extension\Core\Type\FormType`` form type is used.

*  **form\_options** *array* - The form options to use for the entity in the :ref:`create <create-action>` and :ref:`update <update-action>` actions.

*  **form\_event\_subscriber** - The form event subscriber(s) to use for the entity in the :ref:`create <create-action>` and :ref:`update <update-action>` actions. When the form_type option is not specified,, this event subscriber is also used for the :ref:`update_relationship <update-relationship-action>`, :ref:`add_relationship <add-relationship-action>` and :ref:`delete_relationship <delete-relationship-action>` actions. For custom ``form_type`` this event subscriber is not used. It can be specified as a service name or an array of service names. An event subscriber service should implement the ``Symfony\Component\EventDispatcher\EventSubscriberInterface`` interface.

By default, the following form options are set:

+--------------------------+--------------------------------------------------------------------+
| Option Name              | Option Value                                                       |
+==========================+====================================================================+
| data\_class              | The class name of the entity                                       |
+--------------------------+--------------------------------------------------------------------+
| validation\_groups       | Possible values: ['Default', 'api'], and/or a custom group.        |
+--------------------------+--------------------------------------------------------------------+
| extra\_fields\_message   | This form should not contain extra fields: {{ extra\_fields }}.    |
+--------------------------+--------------------------------------------------------------------+

**Example:**

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                documentation_resource: '@AcmeAcmeBundle/Resources/doc/api/acme_entity.md'
                inherit: false
                exclusion_policy: all
                max_results: 25
                order_by:
                    field1: DESC
                    field2: ASC
                hints:
                    - HINT_TRANSLATABLE
                    - { name: HINT_FILTER_BY_CURRENT_USER }
                    - { name: HINT_FORCE_PARTIAL_LOAD, value: false }
                    - { name: HINT_CUSTOM_OUTPUT_WALKER, value: 'Acme\Bundle\AcmeBundle\AST_Walker_Class'}
                excluded: false
                form_type: Acme\Bundle\AcmeBundle\Api\Form\Type\AcmeEntityType
                form_options:
                    validation_groups: ['Default', 'api', 'my_group']
                form_event_subscriber: acme.api.form_listener.test_entity

.. _web-api--fields-config:

`fields` Configuration Section
------------------------------

This section describes configuration of entity fields.

*  **exclude** *boolean* - Indicates whether the field should be excluded. This property is described above in the `"exclude" option <#exclude-option>`__ section.

*  **description** *string* - A human-readable description of the field or a link to the :ref:`documentation resource <web-api--doc>`. Used in auto-generated documentation only.

*  **property\_path** *string* - The property path to reach the fields' value. Can be used to rename the field or to access a field of the related entity. Use the ``dot`` notation to separate property names in the path, e.g. ``user.firstName``. Each property name must be equal to the name of existing property of an entity. The ``_`` value can be used if a field value is not mapped to any property of an entity, e.g. for computed fields.

*  **collapse** *boolean* - Indicates whether to collapse the entity. It is applicable for associations only. When ``true``, the target entity is returned as a value instead of an array of entity fields values.

*  **form\_type** *string* - The form type to use for the field in the :ref:`create <create-action>` and :ref:`update <update-action>` actions.

*  **form\_options** *array* - The form options to use for the field in the :ref:`create <create-action>` and :ref:`update <update-action>` actions.

*  **data\_type** *string* - The data type of the field value. Can be ``boolean``, ``integer``, ``string``, etc. If a field represents an association the data type should be a type of an identity field of the target entity.

*  **meta\_property** *boolean* - A flag indicates whether the field represents a meta information. For JSON:API, such fields are returned in the |meta| section. By default, ``false``.

*  **target\_class** *string* - The class name of a target entity if a field represents an association. If the API resource is based on the non ORM entity, set the target class in a configuration file.

*  **target\_type** *string* - The type of a target association. Can be **to-one** or **to-many**. Also **collection** can be used as an alias for **to-many**. **to-one** can be omitted as it is used by default. If the API resource is based on the non ORM entity, set the target type in a configuration file.

*  **depends\_on** *string[]* - A list of entity properties that the field depends on. Use the ``dot`` notation to specify a path to a nested property, e.g., ``user.firstName``. Each element in the path must be equal to the name of existing property of an entity. This option is helpful for computed fields: the specified fields will be loaded from the database even if they are excluded.

**Examples:**

.. code-block:: yaml

   api:
    entities:
        Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
            fields:
                # Exclude a field
                field1:
                    exclude: true

                # Rename the "firstName" field to the "name" field
                name:
                    description: Some Field
                    property_path: firstName

                # The "addressName" field will contain the value of the "name" field of the "address" related entity
                addressName:
                    property_path: address.name

                # A full syntax for the "collapse" property
                field4:
                    collapse:         true
                    exclusion_policy: all
                    fields:
                        targetField1: null

                # A short syntax for the "collapse" property
                field5:
                    fields: targetField1

                # A form type and form options for a field
                field6:
                    form_type: Symfony\Component\Form\Extension\Core\Type\TextType
                    form_options:
                        trim: false
                        constraints:
                            # add Symfony\Component\Validator\Constraints\NotBlank validation constraint
                            - NotBlank: ~

                # A to-one association
                field7:
                    data_type: integer # the data type of an identifier field of the target
                    target_class: Acme\Bundle\AcmeBundle\Api\Model\AcmeTargetEntity

                # A to-many association
                field8:
                    data_type: integer # the data type of an identifier field of the target
                    target_class: Acme\Bundle\AcmeBundle\Api\Model\AcmeTargetEntity
                    target_type: collection

                # A computed field
                field9:
                    data_type: string
                    property_path: _
                    depends_on: [property1, association1.property11]

.. _fields-special-data-types:

Special Data Types
^^^^^^^^^^^^^^^^^^

The **data\_type** attribute can be used to specify a data type of a field. However, it can also help configure special types of fields. The following table contains details of such types:


.. csv-table::
   :header: "Data Type","Description"
   :widths: 15, 30

   "scalar","Represents a field of a to-one association as a field of parent entity. In JSON:API it means that the association's field should be in ``attributes`` section instead of ``relationships``."
   "object","Represents to-one association as a field, an associative array or an object. In JSON:API it means that the association should be in ``attributes`` section instead of ``relationships`` section."
   "array","Represents a field contains an array data or a field of a to-many association as a field of parent entity. In JSON:API it means that the association should be in ``attributes`` section instead of ``relationships`` section."
   "objects","Represents to-many association as a field. In JSON:API it means that the association should be in ``attributes`` section instead of ``relationships`` section. This data type is an alias for the `object[]` data type."
   "strings","Represents a string field of a to-many association as a field. In JSON:API it means that the association should be in ``attributes`` section instead of ``relationships`` section. This data type is an alias for the `string[]` data type."
   "data-type[]","Represents a field of a to-many association as a field. In JSON:API it means that the association should be in ``attributes`` section instead of ``relationships`` section. The `data-type` can be any data type, for example `scalar[]`, `string[]`, `integer[]`, etc."
   "nestedObject","Helps configure nested objects. For details see :ref:`Configure a Nested Object <configure-nested-object>`."
   "nestedAssociation","Helps configure nested associations. For details see :ref:`Configure a Nested Association <configure-nested-association>`."
   "association:relationType[:associationKind]","Helps configure extended associations. For details, see :ref:`Configure an Extended Many-To-One Association <extended-many-to-one-association>`, :ref:`Configure an Extended Many-To-Many Association <extended-many-to-many-association>` and :ref:`Configure an Extended Multiple Many-To-One Association <extended-multiple-many-to-one-association>`."
   "unidirectionalAssociation:targetAssociationName","Helps configure unidirectional associations. For details, see :ref:`Configure an Unidirectional Association <configure-unidirectional-association>`."

.. note:: The `scalar`, `object`, `array`, `objects`, `strings` and `data-type[]` data types are interchangeable in case they are used to represent an association as a field. They were introduced to increase readability of configs and automatically generated documentation, e.g. for API Sandbox. The `scalar` is usually used if a value of the field contains a scalar value. The `array`, `strings` and `data-type[]` are usually used if a value of the field contains a list of scalar values. The `object` is usually used if a value of the field contains several properties. The `objects` is usually used if a value of the field contains a list of items that have several properties.

.. note:: To add a new special type of a field that requires an additional configuration of a field or an entity, create a class that implements |CustomDataTypeCompleterInterface| and register this class in the dependency injection container with ``oro.api.custom_data_type_completer`` tag. The requestType tag attribute can be used to register a converter only for specific request types.

.. _filters-config:

`filters` Configuration Section
-------------------------------

This section describes fields by which the result data can be filtered. It contains two properties: ``exclusion_policy`` and ``fields``.

-  **exclusion\_policy** *string*.

   Can be ``all`` or ``none``. By default ``none``. Indicates which exclusion strategy to use. Possible values: ``all`` or ``none``. ``none`` - Exclude fields marked with the exclude flag. ``all`` - Exclude both marked and not marked fields.

-  **fields** This section describes a configuration of each field that can be used to filter the result data. Each filter can have the following properties:

   -  **exclude** *boolean* - Indicates whether filtering by this field should be disabled. By default ``false``.
   -  **description** *string* - A human-readable description of the filter or a link to the :ref:`documentation resource <web-api--doc>`. Used in auto-generated documentation only.
   -  **property\_path** *string* - The property path to reach the fields' value. The same way as above in `fields <#fields-configuration-section>`__ configuration section.
   -  **data\_type** *string* - The data type of the filter value. Can be ``boolean``, ``integer``, ``string``, etc.
   -  **allow\_array** *boolean* - Indicates whether the filter can contains several values. By default, ``false`` for ``string``, ``boolean``, ``datetime``, ``date``, ``time`` fields, and ``true`` for other fields.
   -  **allow\_range** *boolean* - Indicates whether the filter can contains a pair of ``from`` and ``to`` values. By default, ``false`` for ``string``, ``boolean``, ``guid``, ``currency`` fields, and ``true`` for other fields.
   -  **collection** (boolean) - Indicates whether the filter represents a collection valued association. By default, ``false`` for filters by fields and *to-one* associations, and ``true`` for filters by *to-many* associations.
   -  **type** *string* - The filter type. By default the filter type is equal to the **data\_type** property value.
   -  **options** *array* - The filter options.
   -  **operators** *array* - A list of operators supported by the filter. By default the list of operators depends on the filter type. For example a string filter supports **=** and **!=** operators, a number filter supports **=**, **!=**, **<**, **<=**, **>** and **>=** operators, etc. Use this parameter when you need to limit a list of supported operators.

**Example:**

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                filters:
                    exclusion_policy: all
                    fields:
                        field1:
                            data_type: integer
                            exclude: true
                        field2:
                            data_type: string
                            property_path: firstName
                            description: 'My filter description'
                        field3:
                            data_type: date
                            allow_array: true
                            allow_range: true
                        field4:
                            data_type: string
                            type: myFilter
                            options:
                                my_option: value
                        field5:
                            operators: ['=']

.. note:: Please note that filters for fields that have a database index are enabled automatically. Filters by all other fields should be enabled explicitly, if necessary.

See :ref:`Filters <api-filters>` for more information on the existing filter types and instructions on how to create custom filters.

.. _sorters-config:

`sorters` configuration section
-------------------------------

This section describes fields by which the result data can be sorted. It contains two properties: ``exclusion_policy`` and ``fields``.

-  **exclusion\_policy** *string*.

   Can be ``all`` or ``none``. By default ``none``. Indicates the exclusion strategy that should be used. ``all`` means that all fields are not configured explicitly will be excluded. ``none`` means that only fields marked with ``exclude`` flag are excluded.

-  **fields**

   This section describes a configuration of each field that can be used to sort the result data. Each sorter can have the following properties:

   -  **exclude** *boolean* - Indicates whether sorting by this field should be disabled. By default ``false``.
   -  **property\_path** *string* - The property path to reach the fields' value. See the description of the property in the `fields <#fields-configuration-section>`__ configuration section.

**Example:**

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                sorters:
                    fields:
                        field1:
                            property_path: firstName
                        field2:
                            exclude: true

.. _actions-config:

`actions` Configuration Section
-------------------------------

The ``actions`` configuration section allows to specify action-specific options. The options from this section will be added to the entity configuration. If an option exists in both entity and action configurations the action option wins. The exception is the ``exclude`` option. This option is used to disable an action for a specific entity and it is not copied to the entity configuration.

*  **exclude** *boolean* - Indicates whether the action is disabled for an entity. By default ``false``.

*  **description** *string* - A short human-readable description of an API resource. Used in auto-generated documentation only.

*  **documentation** *string* - Detailed documentation of an API resource or a link to the :ref:`documentation resource <web-api--doc>`. Used in auto-generated documentation only.

*  **acl\_resource** *string* - The name of an ACL resource used to protect an entity in scope of this action. Set to ``null`` to disable access checks.

*  **max\_results** *integer* - The maximum number of entities in the result. Set ``-1`` (it means unlimited), zero or positive number to set the limit. Can be used to set the limit for both root and related entities.

*  **order\_by** *array* - The property can be used to configure default ordering of the result. The item key is the name of a field. The value can be ``ASC`` or ``DESC``. By default the result is ordered by identifier field.

*  **page\_size** *integer* - The default page size. Set to ``-1`` to disable pagination, or to a positive number. By default, ``10``.

*  **disable\_sorting** *boolean* - Indicates whether to disable the sorting. By default, false.

*  **disable\_inclusion** *boolean* - The flag indicates whether an inclusion of related entities is disabled. In JSON:API an |**include** request parameter| can be used to customize which related entities should be returned. By default ``false``.

*  **disable\_fieldset** *boolean* - The flag indicates whether a requesting of a restricted set of fields is disabled. In JSON:API an |**fields** request parameter| can be used to customize which fields should be returned. By default ``false``.

*  **disable\_meta\_properties** *boolean* - The flag indicates whether a requesting of additional meta properties is disabled. By default ``false``.

*  **form\_type** *string* - The form type that should be used for the entity.

*  **form\_options** *array* - The form options to use for the entity. If ``form_type`` is not specified, the form options specified here are merged with form options defined at the entity level. If ``form_type`` is specified in an action configuration, the action form options completely replace the form options defined at the entity level.

*  **form\_event\_subscriber** - The form event subscribers to use for the entity. Can be specified as a service name or array of service names. An event subscriber service should implement the ``Symfony\Component\EventDispatcher\EventSubscriberInterface`` interface. If ``form_type`` is not specified, the event subscribers specified here are merged with the event subscribers defined at the entity level. If ``form_type`` is specified in an action configuration, the action event subscribers completely replace the event subscribers defined at the entity level.

*  **status\_codes** *array* - The possible response status codes for the action.

   *  **exclude** *boolean* - Indicates whether the status code should be excluded for a particular action. This property is described above in `"exclude" option <#exclude-option>`__ section.
   *  **description** *string* - A human-readable description of the status code. Used in auto-generated documentation only.

*  **fields** - This section describes entity fields' configuration specific for a particular action.

   *  **exclude** *boolean* - Indicates whether the field should be excluded for a particular action. This property is described above in `"exclude" option <#exclude-option>`__ section.
   *  **property\_path** *string* - The property path to reach the fields' value. Can be used to rename the field or to access a field of the related entity. Use the ``dot`` notation to separate property names in the path, e.g. ``user.firstName``. Each property name must be equal to the name of existing property of an entity. The ``_`` value can be used if a field value is not mapped to any property of an entity, e.g. for computed fields.
   *  **direction** *string* - Indicates whether the field is input-only, output-only or bidirectional. The input-only means that the request data can contain this field, but the response data cannot. The output-only means that the response data can contain this field, but the request data cannot. The bidirectional is the default behaviour and means that both the request data and the response data can contain this field.
   *  **form\_type** *string* - The form type that should be used for the field.
   *  **form\_options** *array* - The form options that should be used for the field.

By default, the following permissions are used to restrict access to an entity in a scope of a specific action:

+----------------+-------------------+
| Action         | Permission        |
+================+===================+
| get            | VIEW              |
+----------------+-------------------+
| get\_list      | VIEW              |
+----------------+-------------------+
| create         | CREATE and VIEW   |
+----------------+-------------------+
| update         | EDIT and VIEW     |
+----------------+-------------------+
| delete         | DELETE            |
+----------------+-------------------+
| delete\_list   | DELETE            |
+----------------+-------------------+

The following are examples of the ``actions`` section configuration.

Disable all action for an entity:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                # this entity does not have own API resource
                actions: false

Disable the ``delete`` action for an entity:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    delete:
                        exclude: true

You can use a short syntax:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    delete: false

Set a custom ACL resource for the ``get_list`` action:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    get_list:
                        acl_resource: acme_view_resource

Turn off the access checks for the ``get`` action:

.. code-block:: yaml

    api:
        entities:
           Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    get:
                        acl_resource: ~

Add an additional status code for the ``delete`` action:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    delete:
                        status_codes:
                            '417': 'Returned when expectations failed'

or

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    delete:
                        status_codes:
                            '417':
                                description: 'Returned when expectations failed'

Remove existing status code for the ``delete`` action:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    delete:
                        status_codes:
                            '417': false

or

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    delete:
                        status_codes:
                            '417':
                                exclude: true

Exclude a field for the ``update`` action:

.. code-block:: yaml

    api:
        entities:
            Acme\Bundle\AcmeBundle\Entity\AcmeEntity:
                actions:
                    update:
                        fields:
                            field1:
                                exclude: true

.. _subresources-config:

`subresources` Configuration Section
------------------------------------

The ``subresources`` configuration section enables you to provide options for sub-resources.

-  **exclude** *boolean* - Indicates whether the sub-resource is disabled for entity. By default ``false``.

-  **target\_class** *string* - The class name of a target entity.

-  **target\_type** *string* - The type of a target association. Can be **to-one** or **to-many**. Also **collection** can be used as an alias for **to-many**. **to-one** can be omitted as it is used by default.

-  **actions** *array* - The actions supported by the sub-resource. This section has the same options as :ref:`actions <actions-config>` configuration section. If an option exists in both entity actions section and sub-resource **actions** section the sub-resource option wins.

-  **filters** - The filters supported by the sub-resource. This section has the same options as  :ref:`filters <filters-config>` configuration section. If an option exists in both `entity "filters" section <#filters-configuration-section>`__ and sub-resource **filters** section the sub-resource option wins.

- **sorters** - The sorters supported by the sub-resource. This section has the same options as the entity sorters section. If an option exists in both entity sorters section and sub-resource sorters section, the sub-resource option wins.

.. note:: A subresource is accessible via API only if its target entity is also accessible via API. However, there are several exceptions from this rule:

           * if a target entity does not have an identifier
           * if a target entity is EntityIdentifier and at least one entity from a list of acceptable target classes is accessible via API
           * if a target entity is a base class for Doctrine's inheritance mapping and at least one concrete entity for this mapping is accessible via API

**Example:**

.. code-block:: yaml

    api:
        entities:
            Oro\Bundle\EmailBundle\Entity\Email:
                subresources:
                    suggestions:
                        target_class: Oro\Bundle\ApiBundle\Model\EntityIdentifier
                        target_type: collection
                        actions:
                            get_subresource:
                                description: Get entities that might be associated with the email
                            get_relationship: false
                            update_relationship: false
                            add_relationship: false
                            delete_relationship: false
                        filters:
                            fields:
                                exclude-current-user:
                                    description: Indicates whether the current user should be excluded from the result.
                                    data_type: boolean



.. include:: /include/include-links-dev.rst
   :start-after: begin



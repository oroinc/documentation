.. _annotation-config-field:

.. _backend-configuration-annotation-config-field:

@ConfigField
============

This annotation is used to configure default values for properties of configurable entity classes.

Options
-------

.. _annotation-config-field-default-values:

``defaultValues``
^^^^^^^^^^^^^^^^^

Configures default values for particular config options on a per property basis:

.. code-block:: php


    // ...
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    class User
    {
        /**
         * @ConfigField(
         *      defaultValues={
         *          "dataaudit"={
         *              "auditable"=true
         *          }
         *      }
         * )
         */
        private $username;
    }

This example sets the ``auditable`` option from the ``dataaudit`` scope to ``true`` for the
``username`` property in the ``User`` class.

.. _annotation-config-field-attachment:

``attachment``
~~~~~~~~~~~~~~

*  **acl_protected** *boolean* - indicates whether acl check should be applied when loading or displaying attachments. Each ACL-protected entity must have an ownership type. Various entities can act as one, such as a user, a business unit, an organization. By default ``false``.

*  **file_applications** - the list of all allowed file applications. Possible values are: 'file', 'image', 'wysiwyg', 'wysiwyg_styles', 'multiFile', 'multiImage','default'. By default ``default``.

*  **use_dam** *boolean* - indicates whether to use DAM (Digital Asset Management) to upload a file. OroDigitalAssetBundle bundle provides the Digital Asset Management (DAM) functionality and CRUD for digital assets. It can be enabled for fields of type File and Image  in the back-office UI both via the entity management and field configuration.

*  **maxsize** *integer* - sets the max size of an uploaded file in megabytes.

*  **width** *integer* - sets width for a picture thumbnail in pixels.

*  **height** *integer* - sets height for a picture thumbnail in pixels.

*  **mimetypes** *string* - the list of all allowed MIME types. MIME types are delimited by linefeed (\n) symbol. Example of values: 'image/jpeg', 'image/gif', 'application/pdf'.

*  **max_number_of_files** *integer* - sets the max number of files.

.. _annotation-config-field-attribute:

``attribute``
~~~~~~~~~~~~~

Attribute fields have a dedicated CRUD and field types, similarly to the extend fields.

*  **is_attribute** *boolean* - must be set to 'true' to enable the 'attribute' functionality.

*  **is_system** *boolean* - if set to true, the field is treated as a built-in, which means that it cannot be modified or removed via the UI.

*  **searchable** *boolean* - controls whether attribute content can be searched for in the storefront.

*  **filterable** *boolean* - controls whether the attribute can be filtered.

*  **filter_by** *string* - defines the type of filtering to be applied to the attribute. It is applied only to those fields that have string representation in the search index. This parameter can have the following values: 'exact_value', 'fulltext_search'.

*  **sortable** *boolean* - controls if the attribute can be sorted.

*  **is_global** *boolean* - defines whether the attribute was created in the global organization.

*  **field_name** *string* - defines an attribute field name.

*  **organization_id** *integer* - defines the id of a specific organization.

*  **search_boost** *integer* -  enables you to influence the relevancy ranking of the search results by the value of the attributes.

.. _annotation-config-field-dataaudit:

``dataaudit``
~~~~~~~~~~~~~

Add a property of an entity to the changelog.

*  **auditable** *boolean* - if set to true, any changes to this field become traceable.

*  **propagate** *boolean* - use the option to enable reverse side audit for the relations.

*  **immutable** *boolean* - this attribute can be used to prohibit changing the auditable state (regardless of whether it is enabled or not) for the entity field. If TRUE, then the current state cannot be changed.

.. _annotation-config-field-datagrid:

``datagrid``
~~~~~~~~~~~~

Contain some settings for the datagrid screen.

*  **is_visible** *boolean* - if set to true, the field is displayed as the datagrid column.

*  **show_filter** *boolean* - if set to true, the field is displayed in the datagrid filter.

*  **order** *integer* - enables you to change datagrid column position.

.. _annotation-config-field-draft:

``draft``
~~~~~~~~~

:ref:`OroDraftBundle <draft-bundle--use-draft>` enables you too edit and publish a version of a draftable entity record that requires more work to be finished.

*  **draftable** *boolean* - defines whether field can involved in the draft operation.

.. _annotation-config-field-email:

``email``
~~~~~~~~~

Sets default settings for :ref:`OroEmailBundle <bundle-docs-platform-email-bundle>`.

*  **available_in_template** *boolean* - if set to true, the field can be used in email templates.

.. _annotation-config-field-entity:

``entity``
~~~~~~~~~~

Contain settings for the entity UI.

*  **label** *string* - enables you to change the label of the field.

*  **description** *string* - enables you to change the description of the field.

*  **contact_information** *string* - enables you to change contact information (phone or email) for the entity. Each contact_information type requires its own template. E.g. phone => "@OroMarketingList/MarketingList/ExtendField/phone.html.twig".

*  **actualize_owning_side_on_change** *boolean* - if set to true, the "Updated At" and "Updated By" fields of the owning entity will be updated on collection item updates. Applicable for ref-many and oneToMany relations only.

.. _annotation-config-field-enum:

``enum``
~~~~~~~~

The enum functionality is described in :ref:`Option Set Fields <book-entities-extended-entities-enums>` documentation.

* **enum_code** *string* - sets the code name of the options list to the field.

* **enum_locale** *string* - the locale name in which an enum name and options labels are entered. This is a temporary attribute used to allow creating an enum on a field edit page. As part of the schema update procedure, the value of this attribute is removed.

* **enum_name** *string* - the name of an enum linked to a field. This is a temporary attribute used to allow creating an enum on a field edit page. The value of this attribute is used as a label for an entity that is used to store enum values, and then as part of the field reference update procedure, it is removed.

* **enum_public** *boolean* - indicates whether an enum is public or not. This temporary attribute is used to create/edit an enum on a field edit page. As part of the schema update procedure, the value of this attribute is moved to the entity.enum.public attribute. This flag cannot be changed for system enums (owner='system').

* **enum_options** *array* - the list of enum values. This temporary attribute is used to create/edit an enum on a field edit page. As part of the schema update procedure, the value of this attribute is moved to a table that is used to store enum values.

.. _annotation-config-field-extend:

``extend``
~~~~~~~~~~

This attribute sets default settings for :ref:`Extend Entities <book-entities-extended-entities>`.

* **is_extend** *boolean* - switches to the 'extend' functionality.

* **is_serialized** *boolean* - if set to true, the field data is saved in  the serialized_data column without doctrine schema update.

* **without_default** *boolean* - indicates whether a relation has default value or not. Applicable only to many-to-many or one-to-many relations. If not specified or FALSE, the relation has the default value.

* **cascade** - The names of persistence operations to cascade on the relation. Possible values are: 'persist', 'remove', 'detach', 'merge', 'refresh', 'all'. Note that the 'detach' operation for many-to-one and one-to-many relations is applied by default and this cannot be changed through the configuration. This attribute is applicable to any type of relations. See Doctrine's documentation for more details.

* **bidirectional** *boolean* - a relation feature parameter, check Doctrine's documentation for more details.

* **on_delete** *string* - defines what happens with related rows 'on delete'. Possible value are: 'CASCADE', 'SET NULL', 'RESTRICT'.

* **orphanRemoval** *boolean* - There is concept of cascading that is relevant only when removing entities from collections. If an Entity of type A contains references to a privately owned Entity B, and if the reference from A to B is removed, then entity B should also be removed as it is no longer used. OrphanRemoval works with one-to-one, one-to-many and many-to-many associations. See Doctrine's documentation for more details.

* **target_entity** *string* - the target entity class name.

* **target_title** *string[]* - the list of field names in the target entity used to show the title of a related entity. This attribute is applicable to many-to-many and one-to-many relations.

* **target_detailed** *string[]* - the list of field names in the target entity used to show detailed information about a related entity. This attribute is applicable to many-to-many and one-to-many relations.

* **target_grid** *string[]* - the list of field names in the target entity used to show a related entity in the grid. This attribute is applicable to many-to-many and one-to-many relations.

* **relation_key** *string* - can be built by the ExtendHelper::buildRelationKey method. The attribute is in the following format: 'relation_type', 'owning_entity', 'target_entity','field_name_in_owning_entity'.

* **target_field** *string* - the field name in the target entity used to show a related entity. This attribute is applicable to many-to-one relations.

* **fetch** *string* - the type of fetch mode for the relation. Possible values are 'lazy', 'extra_lazy', and 'eager'.

It also can have the following parameters: **owner**, **state**, **is_deleted**, **nullable**, **default**, **length**, **precision**, **scale**.

.. _annotation-config-field-fallback:

``fallback``
~~~~~~~~~~~~

You can set up an entity field to fall back to a different entity’s field value. More information is available in the :ref:`Entity Fallback Values <dev-entities-fallback>` topic.

* **fallbackList** *array* - contains a list of possible fallback entities.

* **fallbackType** *string* - specifies the type of the field value.

.. _annotation-config-field-form:

``form``
~~~~~~~~

The attribute specifies a custom form type for the field.

* **is_enabled** *boolean* - enables the 'form' functionality.

* **form_type** or **type** *string* - form type for a specific field. Example: ``Oro\Bundle\FormBundle\Form\Type\OroPercentType``.

* **form_options** *boolean* - form options for a specific field. For more information, see |Symfony Form Type Options| .

.. _annotation-config-field-frontend:

``frontend``
~~~~~~~~~~~~

Set default parameters for the storefront view pages.

* **is_displayable** *boolean* - defines if the field is visible or hidden.

* **is_editable** *boolean* - defines if the field is enabled in the storefront forms.

.. _annotation-config-field-importexport:

``importexport``
~~~~~~~~~~~~~~~~

:ref:`OroImportExportBundle <bundle-docs-platform-import-export-bundle>` helps developers enable the UI for the application users to export entity records to files, import them back to the application, and configure the import/export options for entity fields in the entity management UI.

* **identity** *boolean* - fields with this option are used to identify (search) the entity. You can use multiple identity fields for one entity.

* **excluded** *boolean* - fields with this option cannot be exported.

* **order** *integer* - used to configure a custom column order.

* **full** *boolean* - all related entity fields' are exported. Fields with the excluded option are skipped. If the option is set to false (the default value), only fields with an identity are exported.

* **process_as_scalar** *boolean* - defines whether a relation field is processed as scalar value when exporting data.

* **header** *string* - sets a custom field header. By default, field label is used.

Possible attributes are: ``fallback_field``, ``short``, ``immutable`` .

.. _annotation-config-field-merge:

``merge``
~~~~~~~~~

Settings of :ref:`entity merge <dev-entities-merge>`.

* **label** *string* - the field label that should be displayed for this field in merge UI, value can be translated.

* **display** *boolean* - a display merge form for this field.

* **readonly** *boolean* - turn the field into read-only during merge.

* **merge_modes** - Mode of merge with values replace and unite, which can be an array or a single mode:

  * replace - replaces one value with a selected value;
  * unite - merges all values into one (applicable to collections and lists).

* **is_collection** *boolean* - a flag for a collection of fields. This fields supports unite mode by default.

* **cast_method** - options for rendering field value in the UI. Method is used to cast value to a string (applicable only to values that are objects).

* **template** *string* - a template can be used to render the value of a field.

* **setter** - a method for setting a value to an entity.

* **getter** - a method for getting a value to an entity.

* **inverse_display** - can be used to see merge form for this field for an entity on the other side of relation. Let's consider an example where the Call entity with a field referenced to Account uses ManyToOne unidirectional relation. As Account does not have access to a collection of calls the only possible place to configure calls merging for account is this field in the Call entity.

* **inverse_merge_modes** - the same as merge_mode but is used for the relation entity.

* **inverse_label** *string* - the same as label but used for the relation entity.

* **inverse_cast_method** - the same as cast_method but used for the relation entity.

* **render_number_style** *string* - a localization number type. Default localisation handler support: decimal, currency, percent, default_style, scientific, ordinal, duration, spellout.

* **render_date_type** *string* - a type of date formatting, one of the format type constants. Possible values: NONE, FULL, LONG, MEDIUM, SHORT.

* **render_time_type** *string* - a type of time formatting, one of the format type constants. Possible values: NONE, FULL, LONG, MEDIUM, SHORT.

* **render_datetime_pattern** *string* - a date/time pattern. Example: 'm/d/Y'.

* **autoescape** - controls escaping of the value when rendered in the Merge table. Use 'false' to disable escaping for the field (i.e., RichText) or set the Twig 'escape' method to enable: 'html' (or true), 'html_attr', 'css', 'js', 'url'.

``multicurrency``
~~~~~~~~~~~~~~~~~

As currency functionality is represented by three fields (from entity side) we have to hide such fields from permissions configuration page and add only one that will affect all of them. Adds virtual field into permissions list, the name of such field will be taken from `target` property. Walks through fields with defined `target` in `multicurrency` scope and makes changes in FieldSecurityMetadata sets `alias` to `target` and `isHidden` to TRUE. The field with defined `virtual_field` in `multicurrency` scope is used to retrieve the label to be used for virtual field mentioned above.

* **target** *string* - The name of virtual field.

* **virtual_field** *string* - This attribute is used to retrieve the label to be used for virtual field `target`.

``organization``
~~~~~~~~~~~~~~~~

* **applicable** -  is used to specify for which organizations custom field will be visible. On the field edit page, it is represented with form type ``oro_type_choice_organization_type``, which provides a selector for organizations (regardless of whether it is activated or not) defined in the application so that a user can select a specific organization(s) or "ALL" organizations.

``search``
~~~~~~~~~~

Attributes that using to set up :ref:`search <user-guide-getting-started-search>` functionality.

* **searchable** *boolean* - Indicates what custom field could be searchable.

* **title_field** - Indicates what custom text field is part of search result title.

``security``
~~~~~~~~~~~~

Attributes that using to set up :ref:`security <backend-security-bundle-intro>` functionality.

* **permissions** *string* - The following permissions are supported for fields: VIEW, EDIT.

``view``
~~~~~~~~

Attributes that using to set up Entity View Page`.

* **is_displayable** *boolean* - Show on view.

* **priority** *integer* - Priority of field.

* **type** *string* - Type of view. Example: 'html'.


.. include:: /include/include-links-dev.rst
   :start-after: begin

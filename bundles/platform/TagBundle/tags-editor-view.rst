TagsEditorView ⇐ AbstractRelationEditorView
===========================================

Tags-select content editor. Please note that it requires column data format
corresponding to :ref:`tags-view <bundle-docs-platform-tag-bundle-tag-view>`.

Column configuration samples:

.. code-block:: yaml

    datagrids:
      {grid-uid}:
        inline_editing:
          enable: true
        # <grid configuration> goes here
        columns:
          # Sample 1. Sample configuration
          {column-name-1}:
            frontend_type: tags
            inline_editing:
              editor:
                # view: orotag/js/app/views/editor/tags-editor-view
                view_options:
                  permissions:
                    oro_tag_create: true
              save_api_accessor:
                # usual save api configuration
                route: 'oro_api_post_taggable'
                http_method: 'POST'
                default_route_parameters:
                  entity: <entity-url-safe-class-name>
                route_parameters_rename_map:
                  id: entityId
              autocomplete_api_accessor:
                # usual configuration for tags view
                class: 'oroui/js/tools/search-api-accessor'
                search_handler_name: 'tags'
                label_field_name: 'name'
              validation_rules:
                NotBlank: true

Options in YML
--------------

.. csv-table::
   :header: "Column Option Name","Description"

   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "inline_editing.editor.view_options.permissions","Permissions"
   "inline_editing.editor.view_options.permissions.oro_tag_create","Allows user to create new tag"
   "inline_editing.autocomplete_api_accessor","Required. Specifies available choices"
   "inline_editing.autocomplete_api_accessor.class","One of the :ref:`list of search APIs <bundle-docs-platform-form-bundle-search-apis>`"
   "inline_editing.save_api_accessor","Optional. Sets accessor module, route, parameters etc."

Constructor Parameters

**Extends:** :ref:`AbstractRelationEditorView <bundle-docs-platform-form-bundle-abstract-relation-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`","Current row model"
   "options.fieldName","`string`","Field name to edit in model"
   "options.permissions","`string`","Permissions object"
   "options.validationRules","`Object`","Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>`"
   "options.autocomplete_api_accessor","`Object`","Autocomplete :ref:`API specification <bundle-docs-platform-form-bundle-search-apis>`"


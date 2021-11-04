.. _bundle-docs-platform-form-bundle-related-id-relation-editor-view:

RelatedIdRelationEditorView ⇐ AbstractRelationEditorView
=========================================================

Select-like cell content editor. This view is applicable when the cell value contains label (not the value).
The editor will use `autocomplete_api_accessor` and `value_field_name`. The server will be updated with the value only.

Column configuration sample:

Please pay attention to the registration of the `value_field_name` in `query` and `properties` sections of the
sample yml configuration below

.. code-block:: yaml

    datagrids:
      {grid-uid}:
        inline_editing:
          enable: true
        # <grid configuration> goes here
        source:
          query:
            select:
              # please note that both fields(value and label) are required for valid work
              - {entity}.id as {column-name-value}
              - {entity}.name as {column-name-label}
              # query continues here
        columns:
          {column-name-label}:
            inline_editing:
              editor:
                view: oroform/js/app/views/editor/related-id-select-editor-view
                view_options:
                  placeholder: '<placeholder>'
                  css_class_name: '<class-name>'
                  value_field_name: {column-name-value}
              validation_rules:
                NotBlank: ~
              autocomplete_api_accessor:
                # class: oroentity/js/tools/entity-select-search-api-accessor
                # entity_select is default search api
                # following options are specific only for entity-select-search-api-accessor
                # please place here an options corresponding to specified class
                entity_name: {corresponding-entity}
                field_name: {corresponding-entity-field-name}
              save_api_accessor:
                  route: '<route>'
                  query_parameter_names:
                     - '<parameter1>'
                     - '<parameter2>'
        properties:
          # this line is required to add {column-name-value} to data sent to client
          {column-name-value}: ~


Options in YML
--------------

.. csv-table::
   :header: "Column Option Name","Description"

   "inline_editing.editor.view_options.value_field_name","Related value field name."
   "inline_editing.editor.view_options.placeholder","Optional. Placeholder translation key for an empty element"
   "inline_editing.editor.view_options.placeholder_raw","Optional. Raw placeholder value"
   "inline_editing.editor.view_options.css_class_name","Optional. Additional css class name for editor view DOM element"
   "inline_editing.editor.view_options.input_delay","Delay before user finished input and request sent to server"
   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "inline_editing.autocomplete_api_accessor","Required. Specifies available choices"
   "inline_editing.autocomplete_api_accessor.class","One of the :ref:`list of search APIs <bundle-docs-platform-form-bundle-search-apis>`"
   "inline_editing.save_api_accessor","Optional. Sets accessor module, route, parameters etc."

Constructor Parameters
----------------------

**Extends:** :ref:`AbstractRelationEditorView <bundle-docs-platform-form-bundle-abstract-relation-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`","Current row model"
   "options.input_delay","`Object`","Delay before user finished input and request sent to server"
   "options.fieldName","`string`","Field name to edit in model"
   "options.className","`string`","CSS class name for editor element"
   "options.placeholder","`string`","Placeholder translation key for an empty element"
   "options.placeholder_raw","`string`","Raw placeholder value. It overrides placeholder translation key"
   "options.validationRules","`Object`","Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>`"
   "options.value_field_name","`Object`","Related value field name"
   "options.autocomplete_api_accessor","`Object`","Autocomplete :ref:`API specification <bundle-docs-platform-form-bundle-search-apis>`"


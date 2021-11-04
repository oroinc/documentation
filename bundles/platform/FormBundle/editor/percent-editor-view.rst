PercentEditorView ⇐ NumberEditorView
====================================

Percent cell content editor.

Column configuration examples:

.. code-block:: yaml

    datagrids:
      {grid-uid}:
        inline_editing:
          enable: true
        # <grid configuration> goes here
        columns:
          # Sample 1. Mapped by number frontend type
          {column-name-1}:
            frontend_type: percent
          # Sample 2. Full configuration
          {column-name-2}:
            inline_editing:
              editor:
                view: oroform/js/app/views/editor/percent-editor-view
                view_options:
                  placeholder: '<placeholder>'
                  css_class_name: '<class-name>'
              validation_rules:
                NotBlank: ~
              save_api_accessor:
                  route: '<route>'
                  query_parameter_names:
                     - '<parameter1>'
                     - '<parameter2>'


Options in YML
--------------

.. csv-table::
   :header: "Column Option Name","Description"

   "inline_editing.editor.view_options.placeholder","Optional. Placeholder translation key for an empty element"
   "inline_editing.editor.view_options.placeholder_raw","Optional. Raw placeholder value"
   "inline_editing.editor.view_options.css_class_name","Optional. Additional css class name for editor view DOM element"
   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "inline_editing.save_api_accessor","Optional. Sets accessor module, route, parameters etc."

Constructor Parameters
----------------------

**Extends:** :ref:`NumberEditorView <bundle-docs-platform-form-bundle-number-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`","Current row model"
   "options.className","`string`","CSS class name for editor element"
   "options.fieldName","`string`","Field name to edit in model"
   "options.placeholder","`string`","Placeholder translation key for an empty element"
   "options.placeholder_raw","`string`","Raw placeholder value. It overrides placeholder translation key"
   "options.validationRules","`Object`","Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>`"
   "options.value","`string`","initial value of edited field"


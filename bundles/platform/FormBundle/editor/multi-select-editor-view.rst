MultiSelectEditorView ⇐ SelectEditorView
========================================

<a name="module_MultiSelectEditorView"></a>
Multi-select content editor. Please note that it requires column data format
corresponding to multi-select-cell.

Column configuration examples:

.. code-block:: yaml

    datagrids:
      {grid-uid}:
        inline_editing:
          enable: true
        # <grid configuration> goes here
        columns:
          # Sample 1. Full configuration
          {column-name-1}:
            inline_editing:
              editor:
                view: oroform/js/app/views/editor/multi-select-editor-view
                view_options:
                  placeholder: '<placeholder>'
                  css_class_name: '<class-name>'
                  maximumSelectionLength: 3
              validation_rules:
                NotBlank: true
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
   "inline_editing.editor.view_options.placeholder_raw"," Optional. Raw placeholder value"
   "inline_editing.editor.view_options.css_class_name","Optional. Additional css class name for editor view DOM element"
   "inline_editing.editor.view_options.maximumSelectionLength","Optional. Maximum selection length"
   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "inline_editing.save_api_accessor ","Optional. Sets accessor module, route, parameters etc."

Constructor Parameters
----------------------

**Extends:** :ref:`SelectEditorView <bundle-docs-platform-form-bundle-edit-select-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`","Current row model"
   "options.placeholder","`string`","Placeholder translation key for an empty element"
   "options.placeholder_raw","`string`","Raw placeholder value. It overrides placeholder translation key"
   "options.maximumSelectionLength","`string`","Maximum selection length"
   "options.validationRules","`Object`","See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "options.value","`string`","Initial value of edited field"


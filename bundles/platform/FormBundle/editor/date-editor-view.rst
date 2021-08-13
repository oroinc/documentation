.. _bundle-docs-platform-form-bundle-edit-date-editor-view:

DateEditorView ⇐ TextEditorView
===============================

Date cell content editor.

Column configuration examples:

.. code-block:: yaml

    datagrids:
      {grid-uid}:
        inline_editing:
          enable: true
        # <grid configuration> goes here
        columns:
          # Sample 1. Mapped by frontend type
          {column-name-1}:
            frontend_type: date
          # Sample 2. Full configuration
          {column-name-2}:
            inline_editing:
              editor:
                view: oroform/js/app/views/editor/date-editor-view
                view_options:
                  css_class_name: '<class-name>'
                  datePickerOptions:
                    altFormat: 'yy-mm-dd'
                    changeMonth: true
                    changeYear: true
                    yearRange: '-80:+1'
                    showButtonPanel: true
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

   "inline_editing.editor.view_options.css_class_name", "Optional. Additional css class name for editor view DOM element"
   "inline_editing.editor.view_options.dateInputAttrs","Optional. Attributes for the date HTML input element"
   "inline_editing.editor.view_options.datePickerOptions", "Optional. See |datepicker documentation|"
   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "inline_editing.save_api_accessor","Optional. Sets accessor module, route, parameters etc."

Constructor Parameters
----------------------

**Extends:** :ref:`TextEditorView <bundle-docs-platform-form-bundle-edit-text-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`", "Current row model"
   "options.fieldName","`string`","Field name to edit in model"
   "options.validationRules","`Object`","Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "options.dateInputAttrs","`Object`","Attributes for date HTML input element"
   "options.datePickerOptions","`Object`","See |datepicker documentation|"
   "options.value","`string`","initial value of edited field"

dateEditorView.getViewOptions() ⇒ `Object`
------------------------------------------

Prepares and returns editor sub-view options

**Kind**: instance method of DateEditorView

.. include:: /include/include-links-dev.rst
   :start-after: begin

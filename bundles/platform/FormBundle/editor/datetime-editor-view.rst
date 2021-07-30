.. _bundle-docs-platform-form-bundle-edit-date-time-editor-view:

DatetimeEditorView ⇐ DateEditorView
===================================

Datetime cell content editor

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
            frontend_type: datetime
          # Sample 2. Full configuration
          {column-name-2}:
            inline_editing:
              editor:
                view: oroform/js/app/views/editor/datetime-editor-view
                view_options:
                  css_class_name: '<class-name>'
                  datePickerOptions:
                    # See http://api.jqueryui.com/datepicker/
                    altFormat: 'yy-mm-dd'
                    changeMonth: true
                    changeYear: true
                    yearRange: '-80:+1'
                    showButtonPanel: true
                  timePickerOptions:
                    # See https://github.com/jonthornton/jquery-timepicker#options
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

   "inline_editing.editor.view_options.css_class_name","Optional. Additional css class name for editor view DOM element"
   "inline_editing.editor.view_options.dateInputAttrs","Optional. Attributes for the date HTML input element"
   "inline_editing.editor.view_options.datePickerOptions","Optional. See |datepicker documentation|"
   "inline_editing.editor.view_options.timeInputAttrs","Optional. Attributes for the time HTML input element"
   "inline_editing.editor.view_options.timePickerOptions","Optional. See |jQuery Timepicker documentation|"
   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "inline_editing.save_api_accessor","Optional. Sets accessor module, route, parameters etc."

Constructor Parameters
----------------------

**Extends:** :ref:`DateEditorView <bundle-docs-platform-form-bundle-edit-date-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`","Current row model"
   "options.fieldName","`string` ","Field name to edit in model"
   "options.validationRules","`Object`","Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>`."
   "options.dateInputAttrs","`Object`","Attributes for date HTML input element"
   "options.datePickerOptions","`Object`","See |datepicker documentation|"
   "options.timeInputAttrs","`Object`","Attributes for time HTML input element"
   "options.timePickerOptions","`Object`","See |jQuery Timepicker documentation|"
   "options.value","`string`","initial value of edited field"

.. include:: /include/include-links-dev.rst
   :start-after: begin


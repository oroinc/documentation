.. _bundle-docs-platform-form-bundle-abstract-relation-editor-view:

AbstractRelationEditorView ⇐ SelectEditorView
=============================================

Options in YML
--------------

.. csv-table::
   :header: "Column Option Name","Description"

    "inline_editing.editor.view_options.placeholder","Optional. Placeholder for an empty element"
    "inline_editing.editor.view_options.css_class_name ","Optional. Additional css class name for editor view DOM element"
    "inline_editing.editor.view_options.input_delay","Delay before user finished input and request sent to server"
    "inline_editing.autocomplete_api_accessor","Required. Specifies available choices"
    "inline_editing.autocomplete_api_accessor.class","One of the :ref:`list of search APIs <bundle-docs-platform-form-bundle-search-apis>`"

Constructor Parameters
----------------------

**Extends:** :ref:`SelectEditorView <bundle-docs-platform-form-bundle-edit-select-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`","Current row model"
   "options.input_delay","`Object`","Delay before user finished input and request sent to server"
   "options.fieldName","`string`","Field name to edit in model"
   "options.placeholder","`string`","Placeholder for an empty element"
   "options.validationRules","`Object`","Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "options.autocomplete_api_accessor","`Object`","Autocomplete :ref:`API specification <bundle-docs-platform-form-bundle-search-apis>`."




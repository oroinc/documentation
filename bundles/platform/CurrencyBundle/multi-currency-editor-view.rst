Multi Currency Cell Content Editor
==================================

Column configuration samples:

.. code-block:: yaml

    datagrids:
      {grid-uid}:
        inline_editing:
          enable: true
        # <grid configuration> goes here
        columns:
          # Sample 1. Mapped by number frontend type
          {column-name-1}:
            frontend_type: <multi-currency>
          # Sample 2. Full configuration
          {column-name-2}:
            inline_editing:
              editor:
                view: orocurrency/js/app/views/editor/multi-currency-editor-view
                view_options:
                  placeholder: '<placeholder>'
                  css_class_name: '<class-name>'
              validation_rules:
                NotBlank: ~
            multicurrency_config:
              original_field: '<original_field>'
              value_field: '<value_field>'
              currency_field: '<currency_field>'

Options in YML
--------------

.. csv-table::
   :header: "Column Option Name","Description"

   "inline_editing.editor.view_options.placeholder","Optional. Placeholder translation key for an empty element"
   "inline_editing.editor.view_options.placeholder_raw","Optional. Raw placeholder value"
   "inline_editing.editor.view_options.css_class_name","Optional. Additional css class name for editor view DOM element"
   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "multicurrency_config.original_field","Field that contains combined currency value, like EUR100.0000"
   "multicurrency_config.value_field","Field that contains amount of currency value"
   "multicurrency_config.currency_field","Field that contains code of currency (e.g., EUR)"


Constructor Parameters
----------------------

**Extends:** :ref:`TextEditorView <bundle-docs-platform-form-bundle-edit-text-editor-view>`

.. csv-table::
   :header: "Param","Type","Description"

   "options","`Object`","Options container"
   "options.model","`Object`","Current row model"
   "options.fieldName","`string`","Field name to edit in model"
   "options.placeholder","`string`","Placeholder translation key for an empty element"
   "options.placeholder_raw","`string`","Raw placeholder value. It overrides placeholder translation key"
   "options.validationRules","`Object`","Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>` topic for more information"
   "options.choices","`Object`","Array of codes of available currencies"


* MultiCurrencyEditorView ⇐ TextEditorView

  * .MINIMUM_RESULTS_FOR_SEARCH
  * .parseRawValue(value) ⇒ `Object`
  * .getValue()] ⇒ `String`
  * .getCurrencyData()](#module_MultiCurrencyEditorView#getCurrencyData) ⇒ `Array`

multiCurrencyEditorView.MINIMUM_RESULTS_FOR_SEARCH
--------------------------------------------------

Option for select2 widget to show or hide search input for list of currencies

**Kind**: instance property of MultiCurrencyEditorView
**Access:** protected  

multiCurrencyEditorView.parseRawValue(value) ⇒ `Object`
-------------------------------------------------------

Convert string presentation of value to object with 'currency' and 'amount' fields

**Kind**: instance method of MultiCurrencyEditorView

.. csv-table::
   :header: "Param","Type","Description"

   "value","`String`","in format `currency_code+amount`"

multiCurrencyEditorView.getValue() ⇒ `String`
---------------------------------------------

Collects values from DOM elements and converts them to string format like EUR100.0000

**Kind**: instance method of MultiCurrencyEditorView

multiCurrencyEditorView.getCurrencyData() ⇒ `Array`
---------------------------------------------------

Prepares array of objects that presents select options in dropdown

**Kind**: instance method of MultiCurrencyEditorView

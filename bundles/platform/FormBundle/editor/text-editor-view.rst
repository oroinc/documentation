:oro_show_local_toc: false

.. _bundle-docs-platform-form-bundle-edit-text-editor-view:

TextEditorView ⇐ `BaseView`
===========================

Text cell content editor. This view is used by default (if no frontend type has been specified).

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
            frontend_type: string
          # Sample 2. Mapped by frontend type and placeholder specified
          {column-name-2}:
            frontend_type: string
            inline_editing:
              editor:
                view_options:
                  placeholder: '<placeholder>'
          # Sample 3. Full configuration
          {column-name-3}:
            inline_editing:
              editor:
                view: oroform/js/app/views/editor/text-editor-view
                view_options:
                  placeholder: '<placeholder>'
                  css_class_name: '<class-name>'
              validation_rules:
                NotBlank: ~
                Length:
                  min: 3
                  max: 255
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
   "inline_editing.validation_rules","Optional. Validation rules. See :ref:`JS Validation <bundle-docs-platform-form-bundle-js-validation-server-side-validation>`"
   "inline_editing.save_api_accessor","Optional. Sets accessor module, route, parameters etc."

Constructor Parameters

**Extends:** `BaseView`  

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


* TextEditorView ⇐ `BaseView`

  * .ARROW_LEFT_KEY_CODE
  * ._isFocused
  * .getPlaceholder() ⇒ `string`
  * .showBackendErrors(backendErrors
  * .getFormState() ⇒ `Object`
  * .setFormState(value)
  * .focus(atEnd)
  * .onFocusin(e)
  * .onFocusout(e)
  * .onMousedown(e)
  * .blur()
  * .getValidationRules()](#module_TextEditorView#getValidationRules) ⇒ `Object`
  * .getRawModelValue()](#module_TextEditorView#getRawModelValue) ⇒ `*`
  * .formatRawValue(value)](#module_TextEditorView#formatRawValue) ⇒ `string`
  * .parseRawValue(value)](#module_TextEditorView#parseRawValue) ⇒ `*`
  * .getModelValue()](#module_TextEditorView#getModelValue) ⇒ `string`
  * .getValue()](#module_TextEditorView#getValue) ⇒ `string`
  * .rethrowAction() ⇒ `string`
  * .rethrowEvent()
  * .isChanged() ⇒ `boolean`
  * .isValid() ⇒ `boolean`
  * .updateSubmitButtonState()
  * .onGenericKeydown(e)
  * .onGenericEnterKeydown(e)
  * .onGenericTabKeydown(e)
  * .onGenericEscapeKeydown(e)
  * .onGenericArrowKeydown(e)
  * .getServerUpdateData() ⇒ `Object`
  * .getModelUpdateData() ⇒ `Object`

textEditorView.ARROW_LEFT_KEY_CODE
----------------------------------

Arrow codes

**Kind**: instance property of TextEditorView

textEditorView._isFocused
-------------------------

Internal focus tracking variable

**Kind**: instance property of TextEditorView
**Access:** protected  

textEditorView.getPlaceholder() ⇒ `string`
------------------------------------------

Returns placeholder

**Kind**: instance method of TextEditorView

textEditorView.showBackendErrors(backendErrors)
-----------------------------------------------

Shows backend validation errors

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type","Description"

   'backendErrors","`Object`","Map of field name to its error"

textEditorView.getFormState() ⇒ `Object`
----------------------------------------

Reads state of form (map of element name to its value)

**Kind**: instance method of TextEditorView

textEditorView.setFormState(value)
----------------------------------

Set values to form elements

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type","Description"

   "value","`Object`","Map of element name to its value"

textEditorView.focus(atEnd)
---------------------------

Places focus on the editor

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type","Description"

   "atEnd","`boolean`","Useful for multi input editors. Specifies which input should be focused: first or last"

### textEditorView.onFocusin(e)
-------------------------------

Handles focusin event

**Kind**: instance method of [TextEditorView](#module_TextEditorView)  

.. csv-table::
   :header: "Param","Type"

   "e","`jQuery.Event`"


textEditorView.onFocusout(e)
----------------------------

Handles focusout event

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type"

   "e","`jQuery.Event`"

textEditorView.onMousedown(e)
-----------------------------

Handles mousedown event

**Kind**: instance method of [TextEditorView](#module_TextEditorView)  

.. csv-table::
   :header: "Param","Type"

   "e","`jQuery.Event`"

textEditorView.blur()
---------------------

Turn view into blur

**Kind**: instance method of TextEditorView

textEditorView.getValidationRules() ⇒ `Object`
----------------------------------------------

Prepares validation rules for usage

**Kind**: instance method of TextEditorView

textEditorView.getRawModelValue() ⇒ `*`
---------------------------------------

Reads proper model's field value

**Kind**: instance method of TextEditorView

textEditorView.formatRawValue(value) ⇒ `string`
-----------------------------------------------

Converts model value to the format that can be passed to a template as field value

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type"

   "value","`*`"

textEditorView.parseRawValue(value) ⇒ `*`
-----------------------------------------

Parses value that is stored in model

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type"

   "value","`*`"

textEditorView.getModelValue() ⇒ `string`
-----------------------------------------

Returns the raw model value

**Kind**: instance method of TextEditorView

textEditorView.getValue() ⇒ `string`
------------------------------------

Returns the current value after user edit

**Kind**: instance method of TextEditorView

textEditorView.rethrowAction() ⇒ `string`
-----------------------------------------

Generic handler for buttons which allows to notify overlaying component about some user action.
Any button with 'data-action' attribute will rethrow the action to the inline editing plugin.

Available actions:

- save
- cancel
- saveAndEditNext
- saveAndEditPrev
- cancelAndEditNext
- cancelAndEditPrev

Sample usage:

.. code-block:: html

   <button data-action="cancelAndEditNext">Skip and Go Next</button>

**Kind**: instance method of TextEditorView

textEditorView.rethrowEvent()
-----------------------------

Generic handler for DOM events. Used on form to allow processing that events outside view.

**Kind**: instance method of TextEditorView

textEditorView.isChanged() ⇒ `boolean`
--------------------------------------

Returns true if the user has changed the value

**Kind**: instance method of TextEditorView

textEditorView.isValid() ⇒ `boolean`
-------------------------------------

Returns true if the user entered valid data

**Kind**: instance method of TextEditorView

textEditorView.updateSubmitButtonState()
----------------------------------------

Set a submit button disabled state relevant input value

**Kind**: instance method of TextEditorView

#textEditorView.onGenericKeydown(e)
-----------------------------------

Refers keydown action to proper action handler

**Kind**: instance method of [TextEditorView](#module_TextEditorView)  

.. csv-table::
   :header: "Param"

   "e"

textEditorView.onGenericEnterKeydown(e)
---------------------------------------

Generic keydown handler, which handles ENTER

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type"

   "e","`$.Event`"

textEditorView.onGenericTabKeydown(e)
-------------------------------------

Generic keydown handler, which handles TAB

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type"

   "e","`$.Event`"

textEditorView.onGenericEscapeKeydown(e)
----------------------------------------

Generic keydown handler, which handles ESCAPE

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type"

   "e","`$.Event`"

textEditorView.onGenericArrowKeydown(e)
---------------------------------------

Generic keydown handler, which handles ARROWS

**Kind**: instance method of TextEditorView

.. csv-table::
   :header: "Param","Type"

   "e","`$.Event`"

textEditorView.getServerUpdateData() ⇒ `Object`
-----------------------------------------------

Returns data which should be sent to the server

**Kind**: instance method of TextEditorView

textEditorView.getModelUpdateData() ⇒ `Object`
----------------------------------------------

Returns data for the model update

**Kind**: instance method of TextEditorView

.. include:: /include/include-links-dev.rst
   :start-after: begin

Expression Editor
=================

ExpressionEditorUtil
--------------------

Source: |oroform/js/expression-editor-util|.

Implements core autocomplete and validate functionality for expressions.

You can configure allowed expression syntax by options.

Contains the following public functions:

- `validate` - Validates expression syntax
- `getAutocompleteData` - Builds autocomplete data by expression and cursor position
- `updateAutocompleteItem` - Inserts a new item into autocomplete data
- `updateDataSourceValue` - Sets a new data source value into autocomplete data

ExpressionEditorView
--------------------

Source: |oroform/js/app/views/expression-editor-view|.

Used `ExpressionEditorUtil` and `typeahead` widget to provide autocomplete and validate the UI for text fields.

How to Use
----------

Use `ExpressionEditorView` for text fields:

.. code-block:: bash

    {{ form_widget(form.expression, {'attr': {
        'data-page-component-module': 'oroui/js/app/components/view-component',
        'data-page-component-options': initializeOptions|merge({
            view: 'oroform/js/app/views/expression-editor-view',
        })
    }}) }}

Use `ExpressionEditorUtil` for form validation:  

.. code-block:: bash

    var ExpressionEditorUtil = require('oroform/js/expression-editor-util');
    var expressionEditorUtil = new ExpressionEditorUtil(initializeOptions);
    expressionEditorUtil.validate();

Validation
----------

For validation, we transform expression into safe native JS code and execute it. 

For transformation, we use `ExpressionEditorUtil.itemToNativeJS` property and a list of allowed and not allowed words/symbols, see `ExpressionEditorUtil.regex.nativeReplaceAllowedBeforeTest` and `ExpressionEditorUtil.regex.nativeFindNotAllowed`.

Options
-------

Both util and view expect same initialize options. The most important of them are:

- Operations groups, a list of all supported operations. Default value:

  .. code-block:: bash

        operations: {
            math: ['+', '-', '%', '*', '/'],
            bool: ['and', 'or'],
            equality: ['==', '!='],
            compare: ['>', '<', '<=', '>='],
            inclusion: ['in', 'not in'],
            like: ['matches']
        }

- Allowed operations groups. Default value:

  .. code-block:: bash

     allowedOperations: ['math', 'bool', 'equality', 'compare', 'inclusion', 'like']

- Entities and fields that you can use. Does not have a default value, you should specify it for each view or util. Format:

  .. code-block:: bash

        entities: {
            root_entities: {
                "Oro\\Bundle\\ProductBundle\\Entity\\Product": "product",
                "Oro\\Bundle\\PricingBundle\\Entity\\PriceList": "pricelist"
            },
            fields_data: {
                "Oro\\Bundle\\ProductBundle\\Entity\\Product": {
                    id: {
                        label: "Id",
                        type: "integer"
                    },
                    category: {
                        label: "Category",
                        type: "relation",
                        relation_alias: "Oro\\Bundle\\CatalogBundle\\Entity\\Category"
                    },
                    ...
                },
                "Oro\\Bundle\\CatalogBundle\\Entity\\Category": {
                    id: {
                        label: "Id",
                        type: "integer"
                    },
                    ...
                }
                "Oro\\Bundle\\PricingBundle\\Entity\\PriceList": {...}
            }
        }

- Limit of nested entities level. For example, if you set this option to 1, `category` will be excluded from the allowed items list. Default value:

  .. code-block:: bash

        itemLevelLimit: 3
        
- Widgets to choose specific entities. This widget will be rendered when you type `pricelist`. Format:

  .. code-block:: bash

        dataSource: {
            pricelist: "<select><option value='1'>Option 1</option><option value='2'>Option 2</option><option value='3'>Option 3</option></select>"
        }

.. include:: /include/include-links-dev.rst
   :start-after: begin
.. _bundle-docs-platform-query-designer-bundle-condition-builder-component:

Condition Builder Component
===========================

This topic describes the ConditionBuilderView UI component, its usage examples, and configuration options.

Responsibility
--------------

`ConditionBuilderView` is responsible for rendering UI control which allows building a structure with nested conditions such as:

.. code-block:: javascript

    [
        { /* ... */ },
        "AND",
        [
            { /* ... */ },
            "OR",
            { /* ... */ }
        ]
    ]

Where:

- `array` is a **Conditions Group**;
- `object` is a **Condition Item**;
- `string` is an **Operator**.

Usage Example
-------------

`ConditionBuilderView` requires a certain predefined HTML structure:

.. code-block:: html

    <div class="condition-builder">
        <ul class="criteria-list">
            <li class="option" data-criteria="condition-item"
                data-module="somebundle/js/app/views/some-condition-view"
                data-options="{}">
                Condition Item
            </li>
            <li class="option" data-criteria="conditions-group">
                Conditions Group
            </li>
        </ul>
        <div class="condition-container" data-ignore-form-state-change></div>
    </div>

The example above contains a list of available condition criteria and a container for the building process. Each criterion of the list should have a `data criteria` attribute which allows to distinguish them.

There are two preset kinds of conditions:

- `conditions-group`, new sub-group (`ConditionBuilderView` already has a root group by itself);
- `condition-item`, another condition (useful if there are no other conditions).

Condition Item criteria element should have two `data` attributes to `ConditionBuilderView` could initialize a `ConditionView`, which is responsible for that condition-item. Attributes are:

- `data-module` — name of AMD module which contains a `ConditionView` definition;
- `data-options` — JSON-string with options for a `ConditionView`.

Condition Item with Custom Criteria
-----------------------------------

To define custom criteria, set the `data-criteria` attribute with your own criterion name. For example:

.. code-block:: html

    <div class="condition-builder">
        <ul class="criteria-list" id="criteria-list">
            <li class="option" data-criteria="matrix-condition"
                data-module="somebundle/js/app/views/matrix-condition-view"
                data-options="{}">
                Matrix Condition
            </li>
            <li class="option" data-criteria="condition-item"
                data-module="somebundle/js/app/views/some-condition-view"
                data-options="{}">
                Condition Item
            </li>
            <li class="option" data-criteria="conditions-group">
                Conditions Group
            </li>
        </ul>
    </div>

The condition's value object will be extended with extra property `criteria`:

.. code-block:: javascript

    [
        {/* ... */, "criteria": "matrix-condition"},
        "AND",
        [
            {/* ... */}, // usual condition-item
            "OR",
            {/* ... */, "criteria": "matrix-condition"}
        ]
    ]

Options for ConditionBuilderView
--------------------------------

- `value` — initial value, an array of conditions
- `sortable` — common options for both sortable containers **conditions group** and **criteria list**, see options for |jQuery-UI sortable|;
- `conditionsGroup` — specific options for the sortable widget of **conditions group**;
- `criteriaList` — specific options for the sortable widget of **criteria list**;
- `operations` — an array with allowed operations (default `['AND', 'OR']`);
- `criteriaListSelector` — jQuery selector for criterion **criteria list** (default `'.criteria-list'`);
- `conditionContainerSelector` — jQuery selector for criterion **condition container** (default `'.condition-container'`);
- `helperClass` — CSS class for a grabbing element (default `'ui-grabbing'`);
- `validation` — an object with validation rules. Where a key — criteria name, value — is an object with validation rules. See validation in :ref:`OroFormBundle <bundle-docs-platform-form-bundle>`.

Methods
-------

`ConditionBuilderView` has two public methods:

- `getValue()` — returns the current value (an array of conditions)
- `setValue(value)` — sets a new value (the existing structure will be removed and the new one will be restored from the value)

Example:

.. code-block:: javascript

    var conditionBuilderView = new ConditionBuilderView({
        autoRender: true,
        value: [{/*...*/, 'OR', /*...*/}]
    });

    conditionBuilderView.getValue(); // returns current value

    conditionBuilderView.setValue([ // allows to change value
        [{/* ... */}, 'AND', {/* ... */}],
        'OR',
        {/* ... */}
    ]);

.. include:: /include/include-links-dev.rst
   :start-after: begin

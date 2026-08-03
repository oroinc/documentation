.. _customize-datagrid-extensions-toolbar:

Toolbar Extension
=================

Toolbar options:


.. code-block:: none


    [
        'hide'       => false,
        'pageSize'   => [
            'hide'  => false,
            'items' => [10, 25, 50, 100],
            'default_per_page' => 25,
        ],
        'pagination' => [
            'hide' => false,
        ]
    ];


- `hide` --- hides the toolbar. Accepts `true` or `false`.
- `pageSize` --- an array that can include:

  - `hide` --- shows or hides the items-per-page selector
  - `items` --- items per page
  - `default_per_page` --- default items per page

- `pagination` --- shows or hides the pagination block and turns off the paginator extension.

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

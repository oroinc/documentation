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


- `hide` - will hide toolbar. Can take values true or false.
- `pageSize` - array, next parameters could be included:

  - `hide` - hide or show the number of items per page selector
  - `items` - items per page
  - `default_per_page` - item per page by default

- `pagination` - show or hide the pagination block and turn off the paginator extension.

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

:oro_show_local_toc: false

.. _customize-datagrid-extensions-pager:

Pager Extension
===============

This extension provides pagination and passes the "pager" settings to the view layer.
Paging is currently implemented only for the ORM datasource, where it is always enabled.

One Page Pagination
-------------------

This feature renders all grid content on a single page (up to 1000 rows).

To activate it, use the "onePage" option:

.. code-block:: none

    account-account-user-grid:
        options:
            toolbarOptions:
                pagination:
                    onePage: true
        ...

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

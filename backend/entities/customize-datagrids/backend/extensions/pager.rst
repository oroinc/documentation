:oro_show_local_toc: false

.. _customize-datagrid-extensions-pager:

Pager Extension
===============

This extension provides pagination, it is also responsible for passing the "pager" settings to the view layer.
Only paging for ORM datasource is currently implements. It is always enabled for ORM datasource.

One Page Pagination
-------------------

This feature allows to render all grid content in one page (up to 1000 rows).

To activate this feature, use option "onePage":

.. code-block:: none

    account-account-user-grid:
        options:
            toolbarOptions:
                pagination:
                    onePage: true
        ...


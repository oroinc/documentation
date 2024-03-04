.. _customize-datagrids-extensions-organization-column:

Organization Column Extension
=============================

.. warning::  This extension available for Enterprise Edition only.

The organization column extension adds the Organization column and filter to the datagrid if a user works in the Global Organization.

By default, this column and filter will be added to all grids with an ACL-protected entity as the root entity in the ORM source of the datagrid declaration.

To disable this column and filter, use the ``hide_organization_column`` parameter in ``options`` section in a datagrid declaration:

.. code-block:: yaml

    datagrids:
        some-datagrid:
            ...
            options:
                hide_organization_column: true

When a grid is used on create or edit pages, the column and filter are not added by default. To add them, use the "show_organization_column_on_edit" parameter in the "options" section of the datagrid declaration.

.. code-block:: yaml

    datagrids:
        some-datagrid:
            ...
            options:
                show_organization_column_on_edit: true

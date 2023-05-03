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

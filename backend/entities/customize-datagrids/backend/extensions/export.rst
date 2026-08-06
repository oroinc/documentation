:oro_show_local_toc: false

.. _customize-datagrids-extensions-export:

Export Extension
================

This extension exports grid rows from all pages. The exported data matches the grid, including filters and sorting.

Configuration
-------------

To enable export functionality, add the `export` option to the configuration of your grid. For example:

.. code-block:: yaml

    datagrids:
        accounts-grid:
            ...
            options:
                export: true

The `Export` button appears in the top-left corner of the grid. To export data, click this button and select the format (currently, only CSV is implemented).

To allow export in other formats, configure your grid accordingly. For example, to allow export in CSV and PDF, use the following configuration:

.. code-block:: yaml

    datagrids:
        my-grid:
            ...
            options:
                export:
                    csv: { label: oro.grid.export.csv }
                    pdf: { label: acme.grid.export.pdf }

Implement and register a writer for the new export format. When registering a writer in the dependency container, follow this naming convention: ``oro_importexport.writer.echo.[format]``. For example, register a PDF writer as ``oro_importexport.writer.echo.pdf``.

You can use |existing CSV writer| as an example for your writer.

You can also tune performance by changing the grid export page size. This adjusts the number of database queries, but keep in mind that increasing the batch size increases memory consumption.

.. code-block:: yaml

    datagrids:
        my-grid:
            ...
            options:
                export:
                    csv:
                        label: oro.grid.export.csv
                        page_size: 500

**Related Articles**

* :ref:`Datagrids <data-grids>`
* :ref:`Datagrid Configuration Reference <reference-format-datagrids>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

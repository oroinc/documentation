:oro_show_local_toc: false

.. _customize-datagrid-extensions-totals:

Totals Extension
================

This extension provides the totals aggregation, which are displayed in grid's footer (tfoot).

Settings
--------

The totals setting should be placed under the `totals` tree node.

.. code-block:: yaml
   :linenos:

    datagrids:
      demo:
        source:
           [...]
        totals:
          page_total:
              extends: grand_total
              per_page: true
              hide_if_one_page: true
              columns:
                name:
                    label: 'page total'
          grand_total:
              columns:
                name:
                    label: 'grand total'
                contactName:
                    expr: 'COUNT(o.name)'
                    formatter: integer
                closeDate:
                    label: 'Oldest'
                    expr: 'MIN(o.closeDate)'
                    formatter: date
                probability:
                    label: 'Summary'
                    expr: 'SUM(o.probability)'
                    formatter: percent
                budget:
                    label: 'Budget Amount'
                    expr: 'SUM(o.budget)'
                    formatter: currency
                    divisor: 100
                statusLabel:
                    label: oro.sales.opportunity.status.label


.. note::

    - Column name should be equal to the name of the corresponding column.
    - **label** can be a text or a translation placeholder (**not required**)
    - **expr** data aggregation SQL expression (**not required**)
    - **formatter** backend formatter that processes the column value
    - available values: date, datetime, decimal, integer, percent
    - if you add "label" and "query" config but the query aggregation returns nothing -> the total's cell will be empty
    - generally they are be shown as "`<label>: <query result>`"
    - the total config can be taken from another total row with the **extends** parameter.
    - **per_page** parameter switches data calculation only for the current page data
    - if **hide_if_one_page** is true, then this total row is hidden on full data set.
    - **divisor** if you need to divide the value by a number before rendering it to the user (**not required**)

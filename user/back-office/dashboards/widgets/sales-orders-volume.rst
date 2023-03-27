.. _user-guide--widgets--sales-orders-volume:

:oro_documentation_types: OroCRM
:oro_show_local_toc: false

Sales Orders Volume
-------------------

This widget displays a configurable line chart based on the total sales order amount for the selected period of time to easily assess the sales order volume over a period of time, and to compare sales order volume over multiple periods of time if needed.

.. image:: /user/img/dashboards/sales-order-volume-widget.png
   :alt: A sample of the sales order volume widget

.. note:: For how to add widgets to the dashboard and manage them, see the relevant topics:

      * :ref:`Add Widgets to the Dashboard <user-guide--business-intelligence--widgets--add>`
      * :ref:`Manage Widgets on the Dashboard <user-guide--business-intelligence--widgets--manage>`


Sales Orders Volume Widget Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can adjust the following settings for the widget:

.. image:: /user/img/dashboards/sales-order-volume-config.png
   :alt: Configuring the sales order volume widget

* **Widget title** --- the name displayed on the dashboard. To change the name, clear the **Use Default** checkbox and provide a new name.
* **Date Range 1** --- the time period for the widget details to be displayed. You can set the period per today, month-to-date, quarter-to-date, year-to-date, or all time up to the current day. You can also customize the time period as required. The widget's scale type is selected based on the configured period length. For the *today* period, the scale type is Hours; if the period is less (or equal) than 31 days - Days; if less (or equal) than 53 weeks - Weeks; for longer time periods - Months. This period is represented on the x-axis and is used as a basis for Date Range 2 and 3, if configured.
* **Date Range 2** --- the second time period that displays the sales order volume over the selected period. To choose the date range, select the **Starting At** option in the dropdown and set the date to start the range. The chart uses the x-axis of Date Range 1 to illustrate its own period. Remember, that you specify only their starting date, while their end date is determined automatically by the duration of Date Range 1.

  For example, Date Range 1 is set to *Month-To-Date*, *Starting At* date of Date Range 2 is set to February 1.
  If today is March 9, then Date Range 1 is rendered from March 1 to March 9 (i.e., nine days), and Date Range 2 - from February 1 to February 9 (nine days).
  If today is March 22, and Date Range 2 starts on February 25, then Date Range 1 is represented from March 1 to March 22, and Date Range 2 - from February 25 to March 18 (22 days).

  To see the order volume details, hover over the required data point on the chart.

  .. image:: /user/img/dashboards/sales-order-volume-range2.png
     :alt: Illustrating the two date ranges on one line chart

* **Date Range 3** --- the third time period that displays the sales order volume over the selected period. To choose the date range, select the **Starting At** option in the dropdown and set the date to start the range. The chart uses the x-axis of Date Range 1 to illustrate its own period. Remember, that you specify only their starting date, while their end date is determined automatically by the duration of Date Range 1. To see the order volume details, hover over the required data point on the chart.
* **Included Order Statuses** --- select all order statuses to be considered when calculating sales order volume.
* **Include Sub-Orders** --- select whether to include sub-orders to the widget information.
* **Order Total** -- select which order total to be considered when calculating sales order volume: *Subtotal with applied discounts*, *Subtotal*, *Order Total*. Keep in mind that *Subtotal with applied discounts* is subtotal with applied discounts, excluding shipping discounts.
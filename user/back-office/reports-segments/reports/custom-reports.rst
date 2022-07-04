:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide--business-intelligence--reports--use-custom-reports:

Use Custom Reports
==================

Create a Custom Report
----------------------

To create a custom report:

1. Navigate to **Reports and Segments > Manage Custom Reports** in the main menu.
2. Click **Create Report** at the top right of the page.
3. On the **Create Report** page, define the report's properties, as described in the sections below.

General
^^^^^^^

.. image:: /user/img/reports/custom_reports_1.png
   :alt: View the Create Report page

The following fields are mandatory, and **must** be defined for a report:

.. csv-table::
  :header: "Field","Description"
  :widths: 10, 30

  "**Name**","A name that is used to refer to the report on the interface.

  It is recommended to create a name that indicates the information the report presents."
  "**Entity**","A target :term:`entity <Entity>` of the report. Its data will be used to generate the report.

  Select one of the entities from the list. (You can also start typing the entity name in the text field to narrow down your entity choices)."
  "**Report Type**","Select *Table* from the list. The report will present the data in the form of a table. Currently, this is the only available type."
  "**Owner**","Select the user who can manage this report and be responsible for it."

The only optional system field is **Description**. It can be used to save additional information about the report.

Designer
^^^^^^^^

In the **Designer** section, you can define the structure of your report.

.. image:: /user/img/reports/custom_reports_2.png
   :alt: View the settings under the Designer section

Four main subsections help you build your report:

- **Columns**—Define which columns your report will contain.
- **Grouping**—Define how the information in your report will be aggregated.
- **Grouping by Date**—Enable period filters.
- **Filters**—Apply filters to your report's data to select only the necessary information.

Columns
~~~~~~~

.. _user-guide--business-intelligence--reports--add-a-column:

Add a Column
""""""""""""

To add a column:

1. Specify the required data:

.. csv-table::
  :header: "Field","Description"
  :widths: 10, 30

  "**Column**","Select the field that contains the required values. The column must be related to the information specified in the **Entity** field of the **General** section.

  You can see the available fields in the list, where fields are grouped by entities."
  "**Label**","If required, you can rename the label of the selected field. This custom name will be applicable only to the current report.

  By default, the field label is used."
  "**Function**","Select a function that you want to apply to the field values. The function processes a set of values and displays the requested information.

  For example, you want a report showing the number of opportunities with each status of **Open**, **Closed Won**, and **Closed Lost**. Then, you can create a report with the target entity **Opportunity**. Add **Status** and **Id**for the opportunity's columns. For the **Id** field, specify the **Count** function.

  .. image:: /user/img/reports/custom_reports_3.png
     :alt: Create a report for the opportunity entity with the status and ID columns

  As a result, the system takes the first of the statuses and counts how many Ids are listed under it, and the same for other statuses.

  .. image:: /user/img/reports/custom_reports_4.png
     :alt: The opportunity report output provided that the Count function was selected for the ID column

  Some field-specific functions (e.g., **Won Count** that shows the number of won opportunities) for the opportunity's **Status** field. The most common functions are the following:

  - **None**—The data is not aggregated, you will see field values as they are.

  - **Count**—The column displays the number of values in the set.

  - **Sum**—The column displays the sum of all values in the set.

  - **Average**—The column displays the arithmetical mean of the values in the set.

  - **Min**—The column displays the smallest value in the set.

  - **Max**—The column displays the largest value in the set.

  .. note:: You can see only the functions available for the selected field. For example, **Sum** is applicable only to numeric fields.

  .. important:: When you specify a function for any column, all other columns must be added to the **Grouping** section of your report."
  "**Sorting**","Select the sorting order for the field.

  - **None**—The data in the field are not sorted.
  - **Asc**—The data are sorted in the ascending order (e.g., from the smallest to the largest number, or from A to Z).
  - **Desc**—The data are sorted in descending order (e.g., from the largest to the smallest number, or from Z to A).

  .. important:: If sorting is defined for several columns, the report is sorted according to the order specified for the first column, and then, if multiple values of other columns correspond to any value of a first column, they will be sorted according to the order defined for the following columns.

    Let us display the following table.

    Unsorted:

    +---+---+
    | A | 1 |
    +---+---+
    | C | 1 |
    +---+---+
    | B | 3 |
    +---+---+
    | A | 3 |
    +---+---+
    | B | 2 |
    +---+---+
    | B | 1 |
    +---+---+
    | C | 3 |
    +---+---+

    For example, the **Asc** sorting is defined for the first column and **Desc**—for the second:

    Sorted:

    +---+---+
    | A | 3 |
    +---+---+
    | A | 1 |
    +---+---+
    | B | 3 |
    +---+---+
    | B | 2 |
    +---+---+
    | B | 1 |
    +---+---+
    | C | 3 |
    +---+---+
    | C | 1 |
    +---+---+

  After the report has been generated, it can be sorted by any of its columns."

2. Click **Add**.

The field you have defined will appear in the **COLUMN** table.

Edit a Column
"""""""""""""

To edit a column:

1. Click the |IcEdit| **Edit** icon to the right of the corresponding row.
2. Perform the required changes as described in the `Add a Column`_ section description.
3. Click **Save**.

Delete a Column
"""""""""""""""

To delete a column:

1. Click the |IcDelete| **Delete** icon to the right of the corresponding row.
2. In the **Delete Confirmation** dialog box, click **Yes, Delete**.

Rearrange Report Columns
""""""""""""""""""""""""

To move a column, click the |IcArrowsV| **Move** icon to the right of the corresponding row, hold the mouse button, and drag the column up (to make it appear earlier in the report) or down (to make it appear later).

Grouping
~~~~~~~~

When you specify a function for some of the fields, you must add all other fields (that do not have any function specified for them) to the **Grouping** section.

Add a Field to Grouping
"""""""""""""""""""""""

To add a field to the **Grouping** section, select it from the **Grouping Columns** field, and click **Add**. For example, you can see a total, average, maximum, and minimum budget amount for each opportunity with the same status.

.. warning:: Do not add fields that are not present in the **Columns** section.

Remove a Field from Grouping
""""""""""""""""""""""""""""

To remove a field from the **Grouping** section:

1. Click the |IcDelete| **Delete** icon to the right of the corresponding row.
2. In the **Delete Confirmation** dialog box, click **Yes, Delete**.

Grouping by Date
~~~~~~~~~~~~~~~~

In this section, you can define whether to show additional period filters for this report on the report view page.

.. image:: /user/img/reports/custom_reports_6.png
   :alt: The report output with the enabled grouping by day filter

With these filters, you can define the date range to filter the report data and group the data in this range by periods (days, months, quarters, years).
You can also decide whether to show or not the periods that do not contain any data.

.. image:: /user/img/reports/custom_reports_7.png
   :alt: The report settings that define whether to show or hide the periods that do not contain any data

.. csv-table::
  :header: "Field","Description"
  :widths: 10, 30

      "Enable Grouping by Date","Select this check box to enable additional date filters."
      "Date Field","Select the date field which will be used for grouping. Only the date fields related to the selected entity are available."
      "Allow to Skip Empty Time Periods","Select/deselect this check box to show/hide the periods that do not contain any data."

Filters
~~~~~~~

You can define the conditions used to select specific records. Only the data of the records that meet all the conditions defined in the **Filters** section will be used for the report.

For more details, see the :ref:`Filters <user-guide--business-intelligence--filters-management>` guide.

Chart Designer
^^^^^^^^^^^^^^

.. image:: /user/img/reports/custom_reports_8.png
   :alt: The settings of the Chart Designer section

Chart
~~~~~

OroCommerce supports line charts. To create a line chart for the report, define the following fields (all the fields are mandatory) in the **Chart** section.

.. csv-table::
   :header: "Field","Description"
   :widths: 10, 30

   "**Chart Type**","Currently only the **Line Chart** option is available"
   "**Category (X Axis)**","Select the fields with the values which will form the X Axis of the report chart."
   "**Value (Y Axis)**","Choose the fields with the values which will form the Y Axis of the report chart."

For more details, see the :ref:`chart example <user-guide--business-intelligence--reports--chart-examples>`.

View a Custom Report
--------------------

From the Custom Reports List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In the main menu, navigate to **Reports & Segments > Manage Reports**, and in the custom reports list, click the required report.

Alternatively, hover over the |IcEllipsisH| **More Options** menu and click the |IcView| **View** icon.

.. image:: /user/img/reports/custom_reports_9.png
   :alt: The actions you can perform with reports

From the Custom Report View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In the main menu, navigate to **Reports & Segments**. Custom reports are gathered in sections by the name of the field they are related to. Select the required section, navigate to the desired report, and click it.

.. image:: /user/img/reports/custom_reports_10.png
   :alt: Navigating to the custom report from the main menu

Export a Report
---------------

.. note:: Please be aware the Export Grid button may not be available for some reports if the grid you want to export contains grouping by a related entity.

1. Open the report that you want to export:

   * To export a custom report, navigate to **Reports & Segments > Manage Reports** in the main menu and click the required report.

   * To export a system report, navigate to **Reports & Segments > Reports** in the main menu and further to the required report (e.g. **Reports & Segments > Reports > Accounts > Life Time**).

2. On the report page, click the **Export Grid** button in the upper-left corner and then click **CSV** or **XLSX** to export the report to the file of the corresponding format.

   .. image:: /user/img/reports/custom_reports_11.png
      :alt: Highlight the Export Grid button on the custom report's details page

Edit a Custom Report
--------------------

From the Custom Reports Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Reports & Segments > Manage Reports**.

2. On the **All Reports** page, hover over the |IcEllipsisH| **More Options** menu, and then click the |IcEdit| **Edit** icon.

   .. image:: /user/img/reports/custom_reports_12.png
      :alt: Click the edit icon from the More Options menu of a selected report

3. Update the report details as required. For the description of the fields, see `Create a Custom Report`_.

4. Click **Save**.

From the Custom Report View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Reports & Segments > Manage Reports**.

2. On the **All Reports** page, click the required report.

   Alternatively, hover over the |IcEllipsisH| **More Options** menu, and then click the |IcView| **View** icon.

3. On the report page, click **Edit** in the upper-right corner.

4. Update the report details as required. For the description of the fields, see `Create a Custom Report`_.

5. Click **Save**.

Delete a Custom Report
----------------------

From the Custom Reports Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Reports & Segments > Manage Reports**.

2. On the custom reports page, select the report to delete, hover over the |IcEllipsisH| **More Options** menu, and then click |IcDelete| **Delete**.

3. In the **Deletion Confirmation** dialog box, click **Yes, Delete**.

From the Custom Report View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Alternatively, you can delete a custom report from the reports view page by clicking **Delete** in the upper-right corner.

.. image:: /user/img/reports/custom_reports_15.png
   :alt: Highlight the Delete button on the custom report view page

Delete Multiple Custom Reports
------------------------------

You can delete multiple custom reports at a time.

1. In the main menu, navigate to **Reports & Segments > Manage Reports**.

2. Select multiple custom reports by clicking |Bdropdown| in the left corner of the list header.

3. Hover over the |IcMore| **More Options** menu at the end of the list header and click |IcDelete| to delete multiple reports simultaneously.

   .. image:: /user/img/reports/custom_reports_16.png
      :alt: Using the bulk delete function to delete multiple custom reports

4. In the **Delete Confirmation** dialog box, click **Yes, Delete**.

**Related Topics**

* :ref:`Use System Reports <user-guide--business-intelligence--reports--use-system-reports>`
* :ref:`Reports Examples <user-guide--business-intelligence--reports--reports-examples>`


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
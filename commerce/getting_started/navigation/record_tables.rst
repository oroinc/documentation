.. _doc-grids:
.. _doc-grids-open-grid:
.. _doc-grids-grid-page:
.. _user-guide-ui-components-view-pages:
.. _user-guide-ui-components-create-pages:

Record Tables (Grids)
=====================

In Oro, the list of all available records of one type is aggregated on one page within a table (also called *a grid*). The data in the record tables can be filtered and saved as a new page, and the columns in the table can be customized to display only the required information. The page with all single-type records has a number of actions available as buttons on its top right. In addition, each item on the list has a number of actions available in the ellipsis (or the more options) menu at the end of its row. Actions at the top of the page and those within the ellipsis menu are all subject to the type of the records they are meant to apply to.

.. image:: /user_guide/img/getting_started/records/grids/grids_grid.png
  :alt: Record tables/grids

You can reach record tables the following ways:

1. Via the :ref:`main menu <user-guide-navigation-menu>` (e.g. Marketing > Marketing Lists).
2. Via the :ref:`shortcuts menu <user-guide-getting-started-shortcuts>`.
3. By clicking the grid link on the page of a record (see the screenshot below).

   .. image:: /user_guide/img/getting_started/data_management/grid/grid_from_view.png
      :width: 40%
      :alt: Click the grid link on the page of a record

Follow the links below to learn more about the actions you can perform within record tables:

.. contents:: :local:
    :depth: 2

.. _doc-grids-actions-pager:
.. _doc-grids-actions-set-items-per-page:

Navigate Between Table Pages
----------------------------

If you have a lot of records, they may not all fit in one data page. In this case, use the pager block that you can see in the center above the table. In the pager block, you can see the page that you are currently on, the total number of pages, and the total number of records in the table.

.. image:: /user_guide/img/getting_started/records/grids/grids_pager.png
   :alt: Pager block on the page

You can navigate between pages using the **<** (previous page) and **>** (next page) buttons. To open a particular page, type its number in the field that displays the current page, and press **Enter**.

To change the number of records displayed per page, click the **View Per Page** drop-down list on the top right of the table, and select the required number of items per page.

.. image:: /user_guide/img/getting_started/records/grids/grids_viewperpage.png
   :alt: Changing the number of records displayed

.. _doc-grids-actions-refresh:
.. _doc-grids-actions-export:
.. _doc-grids-actions-adjust:
.. _doc-grids-actions-change-table:
.. _doc-grids-actions-change-column-order:
.. _doc-grids-actions-sort-data:
.. _doc-grids-actions-reset:
.. _doc-grids-actions-grid-views-share:

Manage Data in Tables
---------------------

The tables not only display record data but also contain links to the pages of these records. In addition, the tables configurable, so you can adjust the appearance and contents of these tables to your taste and needs using the action buttons:

1. **Export Data** --- Use to export the data in the table to a file either in .csv or .xlxs format (available formats may vary). Import results are sent to your email.

   .. image:: /user_guide/img/getting_started/data_management/grid/export_grid.png
      :alt: Export data in the table

#. **Sort Data** --- By default, data in tables is sorted in ascending order by the first column. To sort a field, click the column header. When sorting is ascending, an upward arrow appears next to the column name. When sorting is descending, a downward arrow appears.

   .. image:: /user_guide/img/getting_started/records/grids/grids_sorted.png
      :width: 40%
      :alt: Sort data in tables

#. |IcRedo| **Refresh** --- Use to refresh the data displayed in the table and retrieve the latest details

   .. image:: /user_guide/img/getting_started/records/grids/grids_refresh.png
      :alt: Refreshing data in the table

#. |IcReset| **Reset** --- Use to clear the table customization and return to default settings. Reset applies to all filters, records per page and sorting changes you have made.

   .. image:: /user_guide/img/getting_started/records/grids/grids_reset.png
      :alt: Resetting data in the tables

#. |IcSettings| **Grid Settings** --- Use to define which columns to show in the table.

   .. image:: /user_guide/img/getting_started/records/grids/grids_configure.png
      :alt: Grid settings

   * You can manually select the columns by clicking on the check box next to the required field.
   * To show all columns in the table, click **Select All**.
   * To change the order of the columns, click on the arrow icon next to the name of the column you wish to move, hold the mouse button, and drag the column to the required position.

     .. image:: /user_guide/img/getting_started/data_management/grid/grid_table_settings.png
       :width: 20%
       :alt: Table settings

   * Use the quick search field to quickly find the required item.


   .. important:: Some fields that an entity has may be unavailable as columns in the table. The list of available fields is defined by the system administrator. If you are the system administrator, see the description for the **Show on Grid** field in the :ref:`Advanced Entity Field Properties <admin-guide-create-entity-fields-advanced>` topic.

#. |IcFilter| **Filters** --- Use to show/hide filters to select specific items to be displayed in the table. More information on filters is provided in the Filters section below.

.. note:: The default settings define whether to paginate data in tables, how many items to show per page, and what maximum number of pages can be shown. They also define whether to the top of the table is locked so you can see the page name, data headers, etc. when you scroll. Usually, these settings are defined by the system administrator for the whole OroCRM/OroCommerce application.

.. _doc-grids-actions-filters:
.. _doc-grids-actions-filters-showhide:
.. _doc-grids-actions-filters-select-to-display:
.. _doc-grids-actions-filters-apply:

Filter Data in Tables
---------------------

Filters are used when you need to quickly pick out the records you need from the entire data pool.

The following actions are available for filters:

1. To show/hide filters, click |IcFilter|

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters.png
      :alt: Show/hide filters by clicking the funnel

   By default, filters are hidden. When filters are hidden and some of them are currently applied to the data in the table, you will see the short summary of the applied filters on the top of the table. Click the summary to show filters.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_applied-hidden.png
      :alt: Show filters by clicking the summary

2. To apply a filter, click on its button in the bar, and specify your query in the control that appears. Note that filter controls might look different depending on the type of data you are going to filter — whether it is textual, numeric, date or option set. After the filter is applied, its query will appear in the control, so you can easily recall how you have filtered the data.

   .. image:: /user_guide/img/getting_started/records/filters.png
       :alt: Apply a filter by clicking on its button in the bar

3. To remove a filter, click on a cross **x** after the query.
4. To select which filters from the available set to display, click **Manage Filters**. Select check boxes in front of the filters you want to display. You can use a search field at the top of the list to quickly find the required filter.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filterstodisplay.png
      :alt: Select filters from the available set to display by clicking the manage filter

Types of Filters
^^^^^^^^^^^^^^^^

The controls available for fields depend on the field type.

1. **Text fields that can take any value**

   For text fields that can take any value, you can enter search words (or part of the word) and select from the list in front of it whether values that you select must contain these search phrase at any position or does not contain it at all, must start with it, end with it, etc.

   .. image:: /user_guide/img/getting_started/data_management/grid/grid_filters_define.png
      :width: 40%
      :alt: Text fields that can take any value

   For conditions like 'Is Any Of' and 'Is Not Any Of,' enter search words separated by the comma.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply1-2.png
      :alt: Enter search words separated by the comma for conditions like ‘is any of’ and ‘is not any of’

2. **Fields that can take limited values**

   Start typing the required value into the text filed. When you this value appears in the drop-down list, click it to select. You can click the empty text field to see the list of all available values.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply3.png
      :width: 30%
      :alt: Fields that can take limited values

3. **Dates and time**

   Click the date fields to select the date via the calendar menu. Click the time fields to select a time from the list.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply2.png
     :width: 40%
     :alt: Dates and time ay the calendar menu

   In addition to selecting a strict calendar date, you can use variables that enable you to specify relative values, such as 'today,' 'start of the month,' etc.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply2-2.png
      :width: 40%
      :alt: Variables that enable to specify relative values such as ‘today,’ ‘start of the month,’ etc

   Also specify the condition of how to form your desired time range, whether it starts from the day and time that you specified, lays between set dates, etc.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply2-3.png
      :width: 40%
      :alt: Specify the condition of desired time range

.. important::  If more than one filter is active, only the records that meet requirements of *all* selected filters are displayed.

     .. image:: /user_guide/img/getting_started/data_management/grid/grid_02.png
        :alt: All selected filters are displayed

.. _doc-grids-grid-views:
.. _doc-grids-actions-grid-views-create:
.. _doc-grids-actions-grid-views-set-default:
.. _doc-grids-actions-grid-views-rename:

Create Saved Table Views (Grid Views)
-------------------------------------

A saved view is a table with applied filters or custom orders. The default table view is what you see when you open a page with all single-type records. It shows unfiltered data.

.. note:: For some entities, additional default table views exist (e.g. **Open Leads** for leads, **Duplicated Accounts** for accounts).

If there is a frequent set of filters and/or ordering that you need to use, save them as a custom table view.

To save a table as a new one:

1. Click **Options** next to the table name.
2. Click **Save as**.

   .. image:: /user_guide/img/getting_started/records/grids/grids_gridviewsaveas.png
      :width: 30%
      :alt: Saving a table view

3. In the dialog, provide the following information:

   * **Name** --- Define a name of the new table view.
   * **Set as default** --- Select this check box to make the new grid view a default one.

   .. image:: /user_guide/img/getting_started/records/grids/grids_gridviewdialog.png
      :alt: Providing a name for a new table view

4. Click **Save**.

   The new view is now available in the menu next to the table name.

   .. image:: /user_guide/img/getting_started/records/grids/grids_gridviewsave.png
      :width: 30%
      :alt: The new view is now available in the menu after clicking save

5. To open a particular table view, click the arrow next to the current view name, and then click the name of the view you want to open.

   .. image:: /user_guide/img/getting_started/records/grids/grids_gridviewopen.png
      :width: 30%
      :alt: Open a particular table view by clicking the arrow next to the current view name

To manage saved views, click **Options** next to the view name. The following is the list of options available:

1. Rename
2. Share with Others/Unshare
3. Delete (custom views)
4. Set as Default

.. image:: /user_guide/img/getting_started/records/Table_Options.png
   :alt: Manage saved views by clicking options next to the view name

.. include:: /img/buttons/include_images.rst
   :start-after: begin

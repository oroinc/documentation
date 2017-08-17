.. _doc-grids:
    
Grids
=====

.. contents:: :local:
    :depth: 3


A ``grid`` is an aggregated view of all the entity records. Each row of a grid is one record, and columns represent record fields.



.. image:: /user_guide/img/getting_started/records/grids/grids_grid.png



.. _doc-grids-open-grid:

Open a Grid Page
----------------

There are several ways to get to a grid.

- Via the :ref:`main menu <user-guide-navigation-menu>`.

  For instance:

  - In the main menu, navigate **Customers>Contacts**. This will bring to to the **Contacts** grid.

  - In the main menu, navigate **Customers>Manage Custom Reports**. This will bring to to the **Reports** grid.
 
  
- Via the :ref:`shortcuts menu <user-guide-getting-started-shortcuts>`.

- Click the grid link on the entity record :ref:`view page <user-guide-ui-components-view-pages>`
  or :ref:`create / edit page <user-guide-ui-components-create-pages>`.

 .. image:: /user_guide/img/getting_started/data_management/grid/grid_from_view.png

.. hint::

    If you have reached a view page or create / edit page from a grid, and now click link to get back to the grid, it
    will look identical to when you left it (the same filters and order will still be applied).


.. _doc-grids-grid-page:

Grid Page
---------


.. image:: /user_guide/img/getting_started/records/grids/grids_grid.png



At the upper-left of the grid page you can see where this page is located in the menu. In the next row you can see a name of the selected grid view. You can open another grid view from the drop-down menu next to the grid view. You rename, delete, etc. the current grid view. For more information about grid views and how to manage them, see :ref:`Manage Grid Views <doc-grids-grid-views>`).

At the upper-right of the grid page, you can see records action buttons. Via them you can perform certain actions with records. The set of these buttons varies depending on which entity grid is opened.

Then follows a filters block. If this block is hidden, but some filters are applied, you will see the filters summary. For more information about filters see :ref:`Apply a Filter <doc-grids-actions-filters>`.

In the next row there are grid action buttons that enable you export grid, modify its settings, and, between them, a pager that enables you navigate between data pages.


.. _doc-grids-actions-pager:

Navigate Between Data Pages
^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you have a lot of records, they may not all fit in one data page. In this case, use the pager block that you can see in the center above the grid.

In the pager block, you can see the page that you are currently on, the total number of data pages, and the total number of records in the grid.


.. image:: /user_guide/img/getting_started/records/grids/grids_pager.png


You can navigate between pages using the :guilabel:`<` **Previous Page** and :guilabel:`>` **Next Page** buttons.

To open a particular page, type its number in the field that displays the current page and press **Enter**.


.. _doc-grids-actions-refresh:

Refresh the Grid
^^^^^^^^^^^^^^^^^

To refresh the grid and get the newest details on the displayed records, click |BRefresh| **Refresh** on the top right of the grid.



.. image:: /user_guide/img/getting_started/records/grids/grids_refresh.png




.. _doc-grids-actions-export:

Export a Grid
^^^^^^^^^^^^^^

To export a grid, click the :guilabel:`Export Grid` button in the upper-left corner of the grid, and then click **CSV** or **XLXS** to export the grid to the file of the corresponding format (available formats may vary).


.. image:: /user_guide/img/getting_started/data_management/grid/export_grid.png


.. _doc-grids-actions-adjust:

Adjust a Grid
-------------

.. note::

    The default data grid settings define whether to paginate data in grids, how many items to show per page, and what maximum number of pages can be shown.
    They also define whether to the top of the grid page will be locked so that you will be able to see the page name, data headers, etc. at any moment when you scroll.

    Usually these settings are defined by a system administrator for the whole OroCRM/OroCommerce application. Check whether you have access to the personal configuration: in the user menu, look for the **My Configuration** item. If the access is granted to you, see the **Data Grid Settings** for how to configure basic data grid settings.

.. TODO: Add link to My Configuration


.. _doc-grids-actions-set-items-per-page:

Set Number of Items Per Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can change the amount of items displayed per page. To do this, click the **View Per Page** drop-down list on the top right of the grid, and select the required number of items per page.


.. image:: /user_guide/img/getting_started/records/grids/grids_viewperpage.png


.. _doc-grids-actions-change-table:

Select Columns to Display
^^^^^^^^^^^^^^^^^^^^^^^^^

You can define which columns to show in the grid.

To do this:

1. Click the |IcSettings| **Grid Settings** icon on the top right of the grid.

   .. image:: /user_guide/img/getting_started/records/grids/grids_configure.png


2. To show / hide a column in the grid, in the **Grid Settings** menu, select / clear the corresponding check box in the **Show** column.


   .. hint:: You can use a search field to quickly find the required item.

   .. image:: /user_guide/img/getting_started/records/grids/grids_gridsettingsmenu.png

.. important::
    Some fields that an entity has may be unavailable as columns of the grid. The list of available fields is defined by the system administrator. If you are a system administrator, see the **Show on Grid** field of the :ref:`Other Entity Field Properties <doc-entity-fields-properties-other>`.


.. _doc-grids-actions-change-column-order:

Change Columns Order
^^^^^^^^^^^^^^^^^^^^

You can define the order of columns in the grid.

To do this:

1. Click the |IcSettings| **Grid Settings** icon on the top right of the grid.

2. In the **Grid Settings** menu, click on the **Sort** icon next to name of the column that you want to move, hold the mouse button, and drag the column to the new place.

   .. hint:: You can use a search field to quickly find the required item.


.. image:: /user_guide/img/getting_started/data_management/grid/grid_table_settings.png



.. _doc-grids-actions-sort-data:

Sort Data
^^^^^^^^^

By default, data in grid is sorted in ascending order by the first column. You can sort them by any field and in any order.

To sort a field, click the column header. When sorting is ascending, an upward arrow appears next to the column name. When sorting is descending, a downward arrow appears.


.. image:: /user_guide/img/getting_started/records/grids/grids_sorted.png



.. _doc-grids-actions-filters:


Apply Filters
^^^^^^^^^^^^^

You can apply filters to choose specific items to be shown in the grid. 

For example, if there are a lot of contacts, they will not all fit on one page. In order to find the required contact in the
grid, use the grid filters.


.. _doc-grids-actions-filters-showhide:

Show / Hide Filters
~~~~~~~~~~~~~~~~~~~

To show / hide filters, click the |icFilters| **Filters** icon on the top right of the grid. The filters section will appear.


.. image:: /user_guide/img/getting_started/records/grids/grids_filters.png


By default, filters are usually hidden. When filters are hidden and some of them are currently applied to the data in grid, you will see the short summary of the applied filters on the top of the grid page.


.. image:: /user_guide/img/getting_started/records/grids/grids_filters_applied-hidden.png


Click the summary to show filters.


.. _doc-grids-actions-filters-select-to-display:

Select Filters to Display
~~~~~~~~~~~~~~~~~~~~~~~~~

1. Click the |icFilters| **Filters** icon on the top right of the grid to show the filters block.

2. On the left side of the filters block, click the **Manage Filters** link.

3. In the list, select check boxes in front of the filters you want to display. You can use a search field at the top of the list to quickly find the required filter.


.. image:: /user_guide/img/getting_started/records/grids/grids_filterstodisplay.png



.. important::
     Records may have more fields than you can use to filter data by. The list of fields by which you can filter data is defined by the system administrator. If you are a system administrator, see the **Show Grid Filter** field of the :ref:`Other Entity Field Properties <doc-entity-fields-properties-other>`.


.. _doc-grids-actions-filters-apply:

Apply a Filter
^^^^^^^^^^^^^^

1. Click the |icFilters| **Filters** icon on the top right of the grid to show the filters block.

2. Choose a filter you want to apply and click it. You will see controls that enable you to select desired values.

3. Enter a filter conditions.

   Available controls depend on the field type.

   **Text fields that can take any value**

   For text fields that can take any value, you can enter search words (or part of the word) and select from the list in front of it whether values that you select must contain these search phrase at any position or does not contain it at all, must start with it, end with it, etc.

   .. image:: /user_guide/img/getting_started/data_management/grid/grid_filters_define.png

   For conditions like 'Is Any Of' and 'Is Not Any Of,' enter search words separated by comma.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply1-2.png


   **Fields that can take limited values**

   Start typing the required value into the text filed. When you this value appears in the drop-down list, click it to select.

   You can click the empty text field to see the list of all available values.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply3.png

   **Dates and time**

   Click the date fields to select the date via the calendar menu. Click the time fields to select a time from the list.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply2.png

   In addition to selecting a strict calendar date, you can use variables that enable you to specify relative values, such as 'today,' 'start of the month,' etc.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply2-2.png


   Also specify the condition of how to form your desired time range, whether it starts from the day and time that you specified, lays between set dates, etc.

   .. image:: /user_guide/img/getting_started/records/grids/grids_filters_apply2-3.png

4. Click :guilabel:`Update`.

.. important::
     If more than one filter are active, only the records that meet requirements of *all* selected filters are displayed.

     .. image:: /user_guide/img/getting_started/data_management/grid/grid_02.png

.. _doc-grids-actions-reset:

Reset a Grid
^^^^^^^^^^^^

To reset the grid (i.e., clear all the filters applied to the grid), click |BReset| **Reset** on the top right of the grid.


.. image:: /user_guide/img/getting_started/records/grids/grids_reset.png



.. _doc-grids-grid-views:

Manage Grid Views
-----------------

A ``grid view`` is a a grid with applied filters or custom ordering. By default, each grid has a grid view called **All <Record Name>** (e.g. **All Accounts** or **All Calls**). This grid view shows unfiltered data. For some entities, additional default grid views exist (e.g. **Open Leads** for leads, **Duplicated Accounts** for accounts).

If there is a frequent set of filters and / or ordering that you need to use, save them as a custom grid view. You can have any number of additional grid views. This is very convenient when you are working with customers from different stores, contacts from different states, and so on.


.. _doc-grids-actions-grid-views-create:

Create a Grid View
^^^^^^^^^^^^^^^^^^

1. Adjust the grid. See the :ref:`Adjust a Grid <doc-grids-actions-adjust>` section for how to do it.

2. Click the **Options** link next to the grid view name, an then click **Save As**.

   .. image:: /user_guide/img/getting_started/records/grids/grids_gridviewsaveas.png

3. In the **Grid view** dialog box, provide the following information:

   **Name**—Define a name of the new grid view.

   .. hint:: Give your views meaningful names so that you can easily find the required view later.

   **Set as default**—Select this check box to make the new grid view a default one. (The default grid view is what you see when you open a grid page.)

   .. image:: /user_guide/img/getting_started/records/grids/grids_gridviewdialog.png

4. Click the :guilabel:`Save` button.

The view will now be available in the drop-down menu next to the grid name.


.. image:: /user_guide/img/getting_started/records/grids/grids_gridviewsave.png



.. _doc-grids-actions-grid-views-open:

Open a Grid View
~~~~~~~~~~~~~~~~

To open a particular grid view, click the arrow next to the current grid view name, and then click the name of the grid view you want to open.


.. image:: /user_guide/img/getting_started/records/grids/grids_gridviewopen.png



.. _doc-grids-actions-grid-views-set-default:

Set a Default Grid View
~~~~~~~~~~~~~~~~~~~~~~~

The default grid view is what you see when you open a grid page.

1. Open a grid view.
2. Click the **Options** link next to the grid view name, and then click **Set As Default**.


.. image:: /user_guide/img/getting_started/records/grids/grids_gridviewsaveasdefault.png


Alternatively, you can set a grid view as default during its creation (see step 3 of the :ref:`Create a Grid View <doc-grids-actions-grid-views-create>` action description) or renaming (see step 3 of the :ref:`Rename a Grid View <doc-grids-actions-grid-views-rename>` action description).


.. _doc-grids-actions-grid-views-rename:

Rename a Grid View
~~~~~~~~~~~~~~~~~~

To rename a grid view:

1. Open a grid view.
2. Click the **Options** link next to the grid view name, and then click **Rename**.


.. image:: /user_guide/img/getting_started/records/grids/grids_gridviewrename.png


3. In the **Grid view** dialog box, provide the following information:

   **Name**—Define a new name name for the new grid view.

   **Set as default**—Select this check box to make the new grid view a default one. (The default grid view is what you see when you open a grid page.)

4. Click the :guilabel:`Save` button.


.. _doc-grids-actions-grid-views-share:

Share a Grid View
~~~~~~~~~~~~~~~~~

To share a grid view with other users:

1. Open a grid view.
2. Click the **Options** link next to the grid view name, and then click **Share with Others**.


.. image:: /user_guide/img/getting_started/records/grids/grids_gridviewshare.png


Other users will see your customized grid view in their grid view selector.


.. _doc-grids-actions-grid-views-unshare:

Unshare a Grid View
~~~~~~~~~~~~~~~~~~~

To unshare a grid view:

1. Open a grid view.
2. Click the **Options** link next to the grid view name, and then click **UnShare**.


.. _doc-grids-actions-grid-views-delete:

Delete a Grid View
~~~~~~~~~~~~~~~~~~

.. warning:: You can delete only custom grid views.

To delete a grid view:

1. Open a grid view.
2. Click the **Options** link next to the grid view name, and then click **Delete**.


.. image:: /user_guide/img/getting_started/records/grids/grids_gridviewdelete.png



3. In the **Delete Confirmation** dialog box, click :guilabel:`Yes, Delete`.




.. _doc-grids-records:

Manage Records
--------------

.. important::
    The actions that you can perform with records from the grid varies depending on the entity, also your permissions may affect it too.

    This section describes the most common actions.


.. _doc-grids-actions-records-create:

Create a New Records
^^^^^^^^^^^^^^^^^^^^

The most common way of creating a new entity record is to do it directly from the grid.

To create a new record, click **Create <Entity Name>** action button on the top right of the grid page.


.. image:: /user_guide/img/getting_started/records/grids/grids_createnewrecord.png


.. _doc-grids-actions-records-view:

View a Record
^^^^^^^^^^^^^

To view a record, find it in the grid, click the ellipsis menu at the right end of the corresponding row, and the click the |IcView| **View** icon. The record view page will open.



.. image:: /user_guide/img/getting_started/records/grids/grids_viewrecord.png


.. note::
   Sometimes, instead of the ellipsis menu, you will see only the action icons at the end of the record row. This happens when you are enabled to perform only one or two actions with a record, and hiding the corresponding icons under the ellipsis menu will not simplify the interface.

Alternatively, you can click the corresponding row itself (but make sure you do not click the |IcEditInline| **Edit Inline** icon).




.. _doc-grids-actions-records-edit:

Edit a Record
^^^^^^^^^^^^^


.. _doc-grids-actions-records-edit-inline:

Inline Editing
~~~~~~~~~~~~~~

.. important:: Inline editing—ability to edit record field values directly from the grid—is available only for the limited set of fields. This set differs for different entities and is not configurable.

1. Point to the value in the grid that you want to edit. If the |IcEditInline| **Edit Inline** icon appears next to it, you can edit this values in this column from the grid.
2. Click the |IcEditInline| **Edit Inline** icon.

   Alternatively, click the value itself twice.

   .. image:: /user_guide/img/getting_started/records/grids/grids_inlineedit.png

3. Modify the value as required.

   Inline editors can be of different types. The simplest inline editor is a plain text field, where you can type the required value.

   .. image:: /user_guide/img/getting_started/records/grids/grids_inlineeditor.png

   If a field can take just certain values, the inline editor will show you a list values to select from.

   .. image:: /user_guide/img/getting_started/records/grids/grids_inlineeditor2.png

4. Click the |IcSaveChanges| **Save Changes** icon to save a new value.

   Or click the |IcDiscardChanges| **Discard Changes** icon to return to the old value.


.. _doc-grids-actions-records-edit-editpage:

Open the Edit Page
~~~~~~~~~~~~~~~~~~

To open a record edit page, find the record in the grid, click the ellipsis menu at the right end of the corresponding row, and the click the |IcEdit| **Edit** icon.



.. image:: /user_guide/img/getting_started/records/grids/grids_editrecord.png



.. _doc-grids-actions-records-delete:

Delete a Record
^^^^^^^^^^^^^^^


.. _doc-grids-actions-records-delete-single:

Delete a Single Record
~~~~~~~~~~~~~~~~~~~~~~

To delete a record, find the record in the grid, click the ellipsis menu at the right end of the corresponding row, and the click the |IcDelete| **Delete** icon.


.. image:: /user_guide/img/getting_started/records/grids/grids_deleterecord.png



.. _doc-grids-actions-records-delete-multiple:

Delete Multiple Records
~~~~~~~~~~~~~~~~~~~~~~~

To delete several records:

1. In the grid, select the check boxes in front of the records you want to delete.

2. Click the ellipsis menu at the right end of the grid header row, and the click the |IcDelete| **Delete** icon.


.. image:: /user_guide/img/getting_started/records/grids/grids_delete_bulk.png



.. _doc-grids-actions-records-merge:

Merge Records
^^^^^^^^^^^^^

.. important:: Currently, merge can only be done for accounts.

To merge records:

1. In the grid, select the check boxes in front of the records you want to merge.

2. Click the ellipsis menu at the right end of the grid header row, and the click the |IcMerge| **Merge** icon.


.. image:: /user_guide/img/getting_started/records/grids/grids_merge.png


.. include:: /user_guide/include_images.rst
   :start-after: begin
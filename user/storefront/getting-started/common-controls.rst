Common Controls
---------------

.. _frontstore-guide--navigation-tables:

Tables
^^^^^^

Views in the form of tables can be considered the most commonly used UI elements in Oro applications. They are interactive, as they not only display data about specific store records but contain links to these records’ pages. Views are also configurable – so you can adjust the appearance and contents of the tables to your taste and needs.

Such tables represent aggregated views of data and store records, making it easy to locate and manage records, with every grid page functionally tailored to the type of information it represents.

.. image:: /user/img/storefront/navigation/GridSample.png

.. _frontstore-guide--navigation-location-trail:

Location Trail
^^^^^^^^^^^^^^

In the top left corner of the view page, you can see where the current page is located in the menu. The name of the selected view table is usually located in the row below.

.. image:: /user/img/storefront/navigation/GridLocationName.png

.. _frontstore-guide--navigation-display-options:

Display Options
^^^^^^^^^^^^^^^

.. image:: /user/img/storefront/navigation/GridPages.png

**Sorting**

Sorting options are located on the left of the view page under the view table name below the :ref:`filter <frontstore-guide--navigation-filters>`. They allow sorting records alphabetically, by price, relevance, or other attributes related to the products displayed on the page you are viewing.

.. image:: /user/img/storefront/navigation/DispayOptionsSorting.png

**Layout**

Layout options are located on the far right under the view table name.

.. image:: /user/img/storefront/navigation/DispayLayoutOptions.png

The following layout options are available:

* Tiles: |IcTiles|
* Details: |IcDetails|
* Compact Details: |IcCompactDetails|

**Page Navigation**

If you have a lot of records, they all may not fit on one data page. In this case, use the pager block in the center above the view table.

In the pager block, you can see the page that you are currently on, the total number of data pages and the total number of records in the view table.

.. image:: /user/img/storefront/navigation/DisplayOptionsPages.png

You can navigate between pages using the **< Prev** and **> Next** page buttons.
To open a particular page, type its number in the field that displays the current page and press **Enter**.

.. _frontstore-guide--navigation-saved-views:

Saved Views
^^^^^^^^^^^

A saved view is a table with applied filters or custom orders.

The **default table view** is what you see when you open a view page, it shows unfiltered data.

Tables can be viewed, saved as new ones, shared, renamed, set as default and deleted:

1. To view the list of available tables: click on the |IcChevronDown| arrow next to the table name.

  .. image:: /user/img/storefront/navigation/SavedView.png

2. To save a table as a new one: click **Save as New**.

    * **Enter New List Name**: Define a name of the new view table.
    * **Set as Default**: Select this check box to set the new table as the default one.
    * **Add**: Click **Add** to add a new saved view table.
    * **Cancel**: Click **Cancel** to exit.

    .. image:: /user/img/storefront/navigation/SaveViewAsDefault.png

3. To share the selected saved view: click |IcShareWithOthers|
4. To unshare the selected saved view: click |IcUnshare|
5. To set the selected saved view as default: click |IcTiles|
6. To rename the selected saved view: click |IcPencil|
7. To delete the selected saved view: click |IcDelete|

.. _frontstore-guide--navigation-action-buttons:

Action Buttons
^^^^^^^^^^^^^^

Action buttons are on the right of the view page. They enable you to perform a number of actions with records. The set of such buttons varies depending on the type of the view opened.

.. image:: /user/img/storefront/navigation/GridActionButtons.png

The following action buttons can be available:

1. Refresh the view table: click |IcUndo| to update the view table.
2. Reset the view table: click |IcReset| to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.
3. Table settings: click |IcSettings| to define which columns to show in the table:

   .. image:: /user/img/storefront/navigation/TableSettings.png

   * You can manually select the columns by clicking on the check box next to the required field.
   * To show/hide all columns in the table, click **Select All**/**Deselect All**.
   * To clear customization, click |IcReset| **Reset**.
   * To change the order of the columns, click on the ellipsis icon next to the name of the column you wish to move, hold the mouse button, and drag the column to the required position.

4. Filters: click |IcFilter| to show/hide filters to select specific items to be shown in the table. More information on filters is provided in the Filters section below.

.. _frontstore-guide--navigation-filters:

Filters
^^^^^^^

Filters are used when you need to quickly pick out the records you need from the entire data pool.

The following actions are available for filters:

1. To show/hide filters, click |IcFilter|

   .. image:: /user/img/storefront/navigation/Filters.png

   .. note:: Note that not all filters may be visible by default.

2. To add, remove, search or reset filters, click |Bplus| and perform the required action.

   .. image:: /user/img/storefront/navigation/FiltersAdd.png

3. To apply a filter, click on its button in the bar and select the required option from the dropdown list.

   .. image:: /user/img/storefront/navigation/FiltersSelect.png

   .. note:: The dropdown list displays all the attributes available for the products on the page you are currently viewing. If there no products related to the searching attributes, the attributes may be hidden from the dropdown list

      .. image:: /user/img/storefront/navigation/FiltersSelectOneAttribute.png

      or remain visible but disabled :ref:`depending on the website configuration <configuration--guide--commerce--configuration--catalog--filters-sorters>` when no items matching selected attributes in filters were found.

      .. image:: /user/img/storefront/navigation/dont_change_initial_filter_state.png

4. Another way to apply a filter is to click on its button and specify your query in the control that appears. Note that filter controls might look different depending on the type of data you are going to filter — whether it is textual, numeric, date or option set.

   .. image:: /user/img/storefront/navigation/FilterExample.png

   After the filter is applied, its query will appear in the control, so you can easily recall how you have filtered the data.

   .. image:: /user/img/storefront/navigation/FiltersApplied.png

Filter controls may be hidden at all if there are no related products on the displayed page.

   .. image:: /user/img/storefront/navigation/FiltersDisabled.png

5. To remove a filter, click on a cross **x** after the query.

   If you wish to reset all applied filters, click **x Clear All Filters**.

The following example is an illustration of filters in action:

   .. image:: /user/img/storefront/navigation/Filters.gif

.. _frontstore-guide--navigation-table-options:

Grid Options
^^^^^^^^^^^^

View tables usually contain one or more options applied to specific records within them. These options take the form of individual icons or icons within the ellipsis menu that can be collapsed.

 .. image:: /user/img/storefront/navigation/TableOptions.png
 .. image:: /user/img/storefront/navigation/TableOptions2.png

.. note:: The types of options available are subject to the type of data contained in the table and to the system configuration.

.. _frontstore-guide--mass-actions--front-store:

.. begin

Mass Delete in Tables
^^^^^^^^^^^^^^^^^^^^^

With mass actions, you can apply one action to multiple items at the same time, which can simplify and speed up the process of selecting the required items.

In the storefront, mass delete action is available in the **Address book** and **Users** sections only for the registered users.

.. image:: /user/img/storefront/mass_actions/mass_actions_1.png

To use mass delete action in the storefront, you need to :ref:`sign into the account <frontstore-guide--getting-started-overview-sign-in>` and proceed with the next steps:

1. Navigate to the account page by clicking **Account** at the top.

.. image:: /user/img/storefront/mass_actions/mass_actions_3.png

2. Click the **Address book** section.

   The following page with the list of customer addresses displays:

   .. image:: /user/img/storefront/mass_actions/mass_actions_4.png

3. To select multiple customer addresses, click |Bdropdown| in the left corner of the list header.

   * The **All** option enables to select all the addresses available under this section.
   * The **All visible** option enables to select only the addresses visible on the page you are currently viewing.
   * The **None** option enables to deselect all the addresses which were selected previously.

   .. image:: /user/img/storefront/mass_actions/mass_actions_5.png

4. Hover over the |IcMore| **More Options** menu at the end of the list header and click |IcDelete| **Delete** to delete multiple addresses at a time.

   .. image:: /user/img/storefront/mass_actions/mass_actions_6.png

.. _frontstore-guide--navigation-search:

Search
^^^^^^

Search is the fastest way to find a specific product:

1. Click the |IcSearch| search icon at the top of the screen.
2. Type in the search key into the text field.
3. Click **Enter**.

.. image:: /user/img/storefront/navigation/Search.png

.. include:: /include/include-images.rst
   :start-after: begin

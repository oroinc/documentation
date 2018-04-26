.. _configuration--general-setup--display-settings:


Display Settings
================

In this section you can define a number of display-related options to be applied to the Oro application:

.. image:: /admin_guide/img/configuration/display_settings.png
   :width: 500


To open display settings:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > General Setup > Display Settings** in the menu to the left.


.. note:: See a short demo on how to set display settings in your Oro application, or continue reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/B2DqoTVQCao" frameborder="0" allowfullscreen></iframe>

.. contents::
   :local:


User Bar
--------

Enable or disable showing recent emails. The functionality is enabled by default.


.. image:: /admin_guide/img/configuration/user_bar.png

Navigation Bar
--------------

Define the **Navigation bar** position. Choose a value from the drop-down menu: top or left. The default value is "Top".

.. image:: /admin_guide/img/configuration/navigation_bar.png

.. _doc-configuration-display-settings:

Data Grid Settings
------------------

Data grid settings define different options used to display all the record lists (grids) in the management console.

.. image:: /admin_guide/img/configuration/data_grid_settings.png

The following options are available:

.. csv-table::
    :header: "Option", "Description", "Default"
    :widths: 10, 30, 10

    "**Items Per Page By Default**","Defines the number of items displayed on one page of the grid by default (every time you open the grid). You can change the number each time.","25"
    "**Lock Headers In Grids**","Defines whether grid headers will be locked on a page during scrolling.","Enabled"
    "**Record Pagination**","If enabled, you can navigate to previous or next grid record from  a view page","Enabled"
    "**Record Pagination Limit**","Defines a maximum number of records available for the record pagination*. (If there are more records, the pagination will be disabled for the grid to avoid performance deterioration) ","1000"


Activity Lists
--------------

The activity list setting defines different options to be applied to display :ref:`activities <user-guide-activities>`.


.. image:: /admin_guide/img/configuration/activity_lists.png


The following options are available:

.. csv-table::
    :header: "Option", "Description", "Default"
    :widths: 10, 30, 10

    "**Sort By Field** and **Sort Direction**","Defines the field and direction used to sort activities in the grid by default (every time you open a page with the grid). You can changed the sorting of the grid each time.","By default the activities updated last will be shown at the top."
    "**Items Per Page By Default**","Defines the number of activities displayed on one page of the grid by default (every time you open the grid). You can changed the number each time.","10"

WYSIWYG Settings
----------------

Define whether text formatting tools must be available for emails, notes, and comments.

The value is enabled by default.

.. note::

    The formatting tools can also be enabled for other text fields in the course of integration.

.. image:: /admin_guide/img/configuration/wysiwyg_settings.png


Sidebar Settings
----------------

By adjusting the sidebar settings you can enable or disable the left and/or right sidebar to keep your sticky notes
and task lists.
By default only the right sidebar is enabled.

.. image:: /admin_guide/img/configuration/sidebar_settings.png


Tag Settings
------------

Tag settings specify the taxonomy colors available in the system.



.. image:: /admin_guide/img/configuration/tag_settings.png


Calendar Settings
-----------------


.. image:: /admin_guide/img/configuration/calendar_settings.png


Calendar settings specify the colors available to manage calendars:

.. csv-table::
    :header: "Option", "Description"
    :widths: 10, 30

    "**Calendar Colors**","A set of colors available for different users' calendars."
    "**Event Colors**","A set of colors available for different events in the user's calendar."

.. _display-settings--map-settings:

Map Settings
------------

.. csv-table::
    :header: "Option", "Description"
    :widths: 10, 30

    "**Enable Map Preview**","Whether to show the location on a map when a customer views an address in the front
    store."

.. image:: /admin_guide/img/configuration/map_settings_map.png

.. important:: This option does not affect maps in the management console.

Reports Settings
----------------

.. image:: /admin_guide/img/configuration/reports_settings.png

If this function is enabled, users can see the SQL request sent to the system for a report.


.. image:: /admin_guide/img/configuration/sql_show.png

This way, users can check if a report has been developed correctly.

.. hint::

    This link will only be available if the View SQL query of a report/segment capability has been enabled for the role.
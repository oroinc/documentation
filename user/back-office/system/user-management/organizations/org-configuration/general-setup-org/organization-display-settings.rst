:oro_documentation_types: OroCRM, OroCommerce

.. _configuration--general-setup--display-settings--organization:

Configure Display Settings per Organization
===========================================

In this section, you can specify the display settings for the organization.

.. note:: The organization-level configuration has higher priority and overrides the system settings.

1. Navigate to **System > User Management > Organization** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > General Setup > Display Settings** in the menu to the left.

   .. image:: /user/img/system/user_management/org_configuration/general/organization_display_settings.png
      :width: 500
      :alt: Settings menu configuration for organization

4. Clear the **Use System** checkbox to change the system-wide setting.

5. In the **Map Settings** section, configure the map preview settings:

    * **Enable Map Preview** --- Select whether to show the location on a map when a customer views an address in the storefront. This option does not affect maps in the back-office.

6. In the **Navigation bar** section, configure the setting:

   * **Position** --- Select whether the OroCommerce main menu will be positioned at the top of the page or on its left.

7. In the **WYSIWYG Settings** section, enable the :ref:`WYSIWYG Editor <getting-started-wysiwyg-editor-field>` setting:

   * **Enable WYSIWYG Editor** --- Select this checkbox to enable text formatting tools for emails, notes and comments.

   .. image:: /user/img/system/user_management/org_configuration/general/user_configuration_wysiwyg.png
      :alt: A formatting tool bar that enables editing a text for emails, notes, and comments

8. In the **Activity Lists** section, configure the options to display :ref:`activities <user-guide-activities>`.

   * **Sort By Field** --- Select whether to sort activity records by the date when they were created or by the date when they were updated for the last time.
   * **Sort Direction** --- Select whether to sort records in the ascending or descending direction.
   * **Items Per Page By Default** --- Select how many records will appear on one page of the activity grids.

9. In the **Data Grid Settings** section, configure the options to display all the record lists (grids) in the back-office:

   * **Items Per Page By Default** --- Defines the number of items displayed on one page of the grid by default (every time you open the grid).
   * **Record Pagination** --- Enables the user navigation to the previous or next grid record from a record view page.
   * **Record Pagination Limit** --- Type the maximum number of records that the user can navigate from a record view page.

   .. image:: /user/img/system/config_system/user_configuration_pagination.png
      :alt: A record pagination sample

10. In the **Calendar Settings** section, specify the colors available to manage calendars:

    * **Calendar Colors** --- A set of colors available for color coding different organization calendars.
    * **Event Colors** --- A set of colors available for color coding different organization events.

    To change any color in the set:

    1. Click it. The color picker opens.
    2. Drag and drop a dot on the color picker wheel to select a new color.
    3. Adjust the color brightness by dragging the level on the shades bar.

11. In the **Sidebar Settings** section, enable or disable the left and/or right sidebar to keep your sticky notes
and task lists:

    * **Enable Left Sidebar** --- Select **Yes** to enable the user to see and utilize the left sidebar.
    * **Enable Right Sidebar** --- Select **Yes** to enable the user to see and utilize the right sidebar.

12. In the **Reports Settings** section, configure the following settings:

    * **Display SQL In Reports And Segments** --- Select this checkbox to enable the user to review the SQL request sent to the system for a report or a segment. This way, users can check if a report has been developed correctly.

    .. image:: /user/img/system/config_system/user_configuration_showsql.png
       :alt: A sample of the enabled display sql field

.. include:: /include/include-images.rst
   :start-after: begin
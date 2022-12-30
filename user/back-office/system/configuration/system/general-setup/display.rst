:oro_documentation_types: OroCRM, OroCommerce

.. _configuration--general-setup--display-settings:

Configure Global Display Settings
=================================

In this section, you can define a number of display-related options to be applied to the Oro application.

.. hint::
    The settings are available on four levels: globally, :ref:`per organization <configuration--general-setup--display-settings--organization>`, :ref:`per website <display-settings--website>`, and :ref:`per user <doc-my-user-configuration-display>`.

.. note:: See a short demo on how to set display settings in your Oro application, or continue reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/B2DqoTVQCao" frameborder="0" allowfullscreen></iframe>

To open display settings:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > General Setup > Display Settings** in the menu to the left.

.. image:: /user/img/system/config_system/display_settings.png
   :alt: Global display settings configuration
   :align: center

3. In the **User Bar** section, configure the setting:

   * **Show Recent Emails** --- Enable the checkbox to display the recent emails on the user bar. They will appear next to the user name.

   .. image:: /user/img/system/config_system/user_configuration_showemailsuserbar.png
      :alt: A recent emails icon displayed on the user bar

4. In the **Navigation bar** section, configure the setting:

   * **Position** --- Select whether the OroCommerce main menu will be positioned at the top of the page or on its left.

.. _doc-configuration-display-settings:

5. In the **Data Grid Settings** section, configure the options to display all the record lists (grids) in the back-office:

   * **Items Per Page By Default** --- Defines the number of items displayed on one page of the grid by default (every time you open the grid).
   * **Lock Headers In Grids** --- Ensures that grid headers stay visible while you scroll.
   * **Row Link Navigation** --- Enables the ability for the row in the grid to behave like a native link. By right-clicking on the item in the grid, you can open it in a new tab/window.
   * **Record Pagination** --- Enables the user navigation to the previous or next grid record from a record view page.

     .. image:: /user/img/system/config_system/user_configuration_pagination.png
        :alt: A record pagination sample

   * **Record Pagination Limit** --- Defines a maximum number of records available for the record pagination.


6. In the **Activity Lists** section, configure the options to display :ref:`activities <user-guide-activities>`.

   * **Sort By Field** --- Select whether to sort activity records by the date when they were created or by the date when they were updated for the last time.
   * **Sort Direction** --- Select whether to sort records in the ascending or descending direction.
   * **Items Per Page By Default** --- Select how many records will appear on one page of the activity grids.


7. In the **WYSIWYG Settings** section, enable the :ref:`WYSIWYG Editor <getting-started-wysiwyg-editor-field>` setting:

   * **Enable WYSIWYG Editor** --- Select this checkbox to enable text formatting tools for emails, notes and comments.

   .. image:: /user/img/system/config_system/user_configuration_wysiwyg.png
      :alt: A formatting tool bar that enables editing a text for emails, notes, and comments

8. In the **Sidebar Settings** section, enable or disable the left and/or right sidebar to keep your sticky notes
and task lists:

   * **Enable Left Sidebar** --- Select **Yes** to enable the user to see and utilize the left sidebar.
   * **Enable Right Sidebar** --- Select **Yes** to enable the user to see and utilize the right sidebar.

9. In the **Tag Settings** section, specify the taxonomy colors available in the system.

   .. image:: /user/img/system/config_system/tag_settings.png
      :alt: Global tag settings

10. In the **Calendar Settings** section, specify the colors available to manage calendars:

    * **Calendar Colors** --- A set of colors available for color coding different organization calendars.
    * **Event Colors** --- A set of colors available for color coding different organization events.


    To change any color in the set:

    1. Click it. The color picker opens.
    2. Drag and drop a dot on the color picker wheel to select a new color.
    3. Adjust the color brightness by dragging the level on the shades bar.

    .. image:: /user/img/system/config_system/calendar_settings.png
       :alt: Global calendar settings

11. In the **Map Settings** section, configure the map preview settings:

    * **Enable Map Preview** --- Select whether to show the location on a map when a customer views an address in the storefront. This option does not affect maps in the back-office.

    .. image:: /user/img/system/config_system/map_settings_map.png
       :alt: Preview the map in a customer account address book menu in th storefront

.. _doc-configuration-display-settings-report:

12. In the **Reports Settings** section, configure the following settings:

    * **Group Same-Entity Conditions Within Condition Groups** --- Select this checkbox to enable report generation for an entity only if the values match all the field conditions queries within a :ref:`conditions group <user-guide--business-intelligence--filters-condition-groups>`. This means that if two conditions (A and B) are applied in a condition group, the report will be generated only when both of them are satisfied. Disable the checkbox to receive the report that would include the values which satisfy the A condition, the B condition, and both.

   * **Display SQL In Reports And Segments** --- Select this checkbox to enable the user to review the SQL request sent to the system for a report or a segment. This way, users can check if a report has been developed correctly.

   .. image:: /user/img/system/config_system/user_configuration_showsql.png
      :alt: A sample of the enabled display SQL field

   This link will only be available if the View SQL query of a report/segment capability has been enabled for the role.


.. include:: /include/include-images.rst
   :start-after: begin
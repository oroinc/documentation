:oro_documentation_types: OroCRM, OroCommerce

.. _doc-my-user-configuration-display:

Configure Display Settings per User
===================================

In the Display section, you can configure the following display options for a particular user:

1. Navigate to **System > User Management > Users** in the main menu.

2. For the necessary user, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.

3. Select **System Configuration > General Setup > Display Settings** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/my_user_config_display.png
      :alt: Settings menu options available on the user level

4. Clear the **Use Organization** checkbox to change the organization-wide setting for the following options:

5. In the **User Bar** section, configure the setting:

   * **Show Recent Emails** --- Enable the checkbox to display the recent emails on the user bar. They will appear next to the user name.

   .. image:: /user/img/system/user_management/user_configuration_showemailsuserbar.png
      :alt: A recent emails icon displayed on the user bar

6. In the **Navigation bar** section, configure the setting:

   * **Position** --- Select whether the OroCommerce main menu will be positioned at the top of the page or on its left.

7. In the **Data Grid Settings** section, configure the options to display all the record lists (grids) in the back-office:

   * **Items Per Page By Default** --- Defines the number of items displayed on one page of the grid by default (every time you open the grid).
   * **Lock Headers In Grids** --- Ensures that grid headers stay visible while you scroll.
   * **Row Link Navigation** --- Enables the ability for the row in the grid to behave like a native link. By right-clicking on the item in the grid, you can open it in a new tab/window.
   * **Record Pagination** --- Enables the user navigation to the previous or next grid record from a record view page.
   * **Record Pagination Limit** --- Type the maximum number of records that the user can navigate from a record view page.

   .. image:: /user/img/system/config_system/user_configuration_pagination.png
      :alt: A record pagination sample

8. In the **Activity Lists** section, configure the options to display :ref:`activities <user-guide-activities>`.

   * **Sort By Field** --- Select whether to sort activity records by the date when they were created or by the date when they were updated for the last time.
   * **Sort Direction** --- Select whether to sort records in the ascending or descending direction.
   * **Items Per Page By Default** --- Select how many records will appear on one page of the activity grids.


9. In the **WYSIWYG Settings** section, enable the :ref:`WYSIWYG Editor <getting-started-wysiwyg-editor-field>` setting:

   * **Enable WYSIWYG Editor** --- Select this checkbox to enable text formatting tools for emails, notes and comments.

   .. image:: /user/img/system/config_system/user_configuration_wysiwyg.png
      :alt: A formatting tool bar that enables editing a text for emails, notes, and comments

10. In the **Sidebar Settings** section, enable or disable the left and/or right sidebar to keep your sticky notes and task lists:

   * **Enable Left Sidebar** --- Select **Yes** to enable the user to see and utilize the left sidebar.
   * **Enable Right Sidebar** --- Select **Yes** to enable the user to see and utilize the right sidebar.

11. In the **Reports Settings** section, configure the following settings:

    * **Display SQL In Reports And Segments** --- Select this checkbox to enable the user to review the SQL request sent to the system for a report or a segment. This way, users can check if a report has been developed correctly.


   .. image:: /user/img/system/config_system/user_configuration_showsql.png
      :alt: A sample of the enabled display SQL field


.. hint:: The Quick Action Buttons feature is available starting from OroCommerce v5.0.8. To check which application version you are running, see the :ref:`system information <system-information>`.

12. In the **Upcoming Changes** section, configure the following setting:

   * **Enable Quick Creation Buttons** --- Select the option to add quick action buttons to the customer, customer user, and customer group view pages.

   .. image:: /user/img/system/config_system/quick-creation-buttons.png
      :alt: Displaying quick action buttons on the customer view page

13. In the **Window Settings** section, configure the following setting:

   * **Quick Create Actions** --- Select the preferred way to display the quick creation buttons form. The buttons with quick actions appear on the customer, customer user, and customer group view pages. When clicked, the form can be displayed in a new browser tab, a popup dialog window, or replace the current page.


.. include:: /include/include-images.rst
   :start-after: begin
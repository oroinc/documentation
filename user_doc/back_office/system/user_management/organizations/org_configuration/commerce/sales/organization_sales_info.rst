.. _sys--conf--commerce--sales--contacts-organization:

Sales Rep Information per Organization
--------------------------------------

.. begin 

To enable or disable the display of sales representative information in the storefront :ref:`footer links <frontstore-guide--navigation-footer>` per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Contacts** in the menu to the left.

   .. note::  For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. In the **Display** list, select one of the options that will determine what and whose information to show on the website.

   * **Don't Display Contact Info** - no sales rep information is displayed. This option is the default one.
   * **Customer User Owner** - allow customer user owner information to be displayed.
   * **Customer Owner** - allow customer owner information to be displayed.

     .. note:: User settings override all other settings if **Customer Owner** or **Customer User Owner** are selected as a display option.

   * **Pre-configured** - in the *Contact Details* text field, specify custom contact details you wish to be displayed.

   Such organization settings override settings set on the :ref:`system level <sys--conf--commerce--sales--contacts-global>` unless **Use System** check box is enabled.

5. Options selected as **Available User Options** determine what options the user will see in the **Customer Visible Contact Info** list in their user configuration settings (in **My User > My Configuration > Commerce > Sales > Contacts > Customer Visible Contact Info**).

   The options are the following:

   * **Don't Display Contact Info** -- allow setting the option of no sales rep information to be displayed.
   * **Use User Profile Data** -- allow setting the option of user profile details to be displayed.
   * **Enter Manually** -- allow to set the option of manually entered text in the *Enter Contact Info* field.

   Such organization settings override settings set at the :ref:`system level <sys--conf--commerce--sales--contacts-global>` unless **Use System** check box is enabled.

6. In the **Guest Contact** text box, you may enter contact information that will be shown to non-authenticated visitors. Click **Use System** to use the text configured at the system level.
7. Click **Save Settings**.

.. finish

.. include:: /include/include_images.rst
   :start-after: begin


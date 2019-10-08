:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--sales--contacts:
.. _user-guide--system-configuration--display-sales-rep-info--display-options:
.. _sys--conf--commerce--sales--contacts-global:

Contacts (Sales Rep Information)
================================

To provide customers with the contact information of their primary assigned sales representative, enable the display of the sales rep contact information in the Oro application storefront :ref:`footer links <frontstore-guide--navigation-footer>`.

.. hint:: Contact information can be configured on four levels: globally, :ref:`per organization <sys--conf--commerce--sales--contacts-organization>`, :ref:`per website <sys--conf--commerce--sales--contacts-website>`, :ref:`per user <sys--conf--commerce--sales--contacts-user>`. Website settings override organization, organization settings override system and user settings may (sometimes) override all other settings, depending on configuration. In these cases, either customer owner or customer user owner may be used as a :ref:`user settings <sys--conf--commerce--sales--contacts-user>` source.

Enabling sales representative information globally sets system settings as default ones.

To enable or disable the display of sales representative information in the storefront :ref:`footer links <frontstore-guide--navigation-footer>` globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Contacts** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/sales/SalesInfoGlobal.png

3. In the **Display** list, select one of the options that will determine what and whose information to show on the website:

   * **Don't Display Contact Info** - no sales rep information is displayed. This option is the default one.
   * **Customer User Owner** - allow customer user owner information to be displayed.
   * **Customer Owner** - allow customer owner information to be displayed.

     .. note:: User settings override all other settings if **Customer Owner** or **Customer User Owner** are selected as a display option.

   * **Pre-configured** - in the *Contact Details* text field, specify custom contact details you wish to be displayed.

   .. image:: /user/img/system/config_commerce/sales/SalesInfoGlobalPreConfigured.png

4. Options selected as **Available User Options** determine what options the user will see in the **Customer Visible Contact Info** list in their user configuration settings (in **My User > My Configuration > Commerce > Sales > Contacts > Customer Visible Contact Info**).

   The options are the following:

   * **Don't Display Contact Info** -- allow setting the option of no sales rep information to be displayed.

     If the admin enables the **Available User Options** check box and sets the *Don't Display Contact Info* option, then the user will see *Don't Display Contact Info* in their configuration settings.

     .. note:: The user who will be able to see these settings is the one selected in the **Display** list. User settings apply when either customer user owner or customer owner is selected.

     If:

     .. image:: /user/img/system/config_commerce/sales/DontDisplayInfoAdmin.png

     Then:

     .. image:: /user/img/system/config_commerce/sales/DontDisplayInfoSalesRep.png

   * **Use User Profile Data** -- allow setting the option of user profile details to be displayed.

     If the admin enables the **Available User Options** check box and sets the *Use User Profile Data* option, then the user will see *Use My Profile Data* in their configuration settings.

     If:

     .. image:: /user/img/system/config_commerce/sales/UseUserProfileDataAdmin.png

     Then:

     .. image:: /user/img/system/config_commerce/sales/UseUserProfileDataSalesRep.png

   * **Enter Manually** -- allow to set the option of manually entered text in the *Enter Contact Info* field.

     If the admin enables the **Available User Options** check box and sets the *Enter manually* option, then the user will see *Enter Manually* in their configuration settings.

     If:

     .. image:: /user/img/system/config_commerce/sales/EnterManuallyAdmin.png

     Then:

     .. image:: /user/img/system/config_commerce/sales/EnterManuallySalesRep.png

     .. note:: You can choose to use multiple options by holding Ctrl when selecting the option. When all options are selected in **Available User Options**, the user will see them all in their configuration settings as well.

       If:

       .. image:: /user/img/system/config_commerce/sales/SelectMultipleOptions.png

       Then:

       .. image:: /user/img/system/config_commerce/sales/AllOptionsSalesRep.png

   .. warning:: Please note that Allow User Configuration options define *user* level settings only.

5. In the **Guest Contact** text box, you may enter contact information that will be shown to non-authenticated visitors.

   .. image:: /user/img/system/config_commerce/sales/GuestContact.png

6. Click **Save Settings**.

.. _sys--conf--commerce--sales--contacts--sample:

Customer Visible Contact Info Configuration Example
---------------------------------------------------

The following configuration example is provided for illustration.

As an administrator, you were asked to set up the ability for a customer sales representative John Doe to provide contact information for non-authenticated and logged in customer users. 

To set up information for non-authenticated visitors:

1. Navigate to **System > Configuration > Commerce > Sales > Contacts**.
2. In the Display list, select **Customer User Owner**.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. Enable **Allow User Configuration** check box, and select all three available user options from the list.

4. In **Guest Contact** text field, provide text for non-authenticated users, e.g.:
   
   *Please login to get your sales rep
   information, or contact sales@acme.com*

   .. image:: /user/img/system/config_commerce/sales/UseCase1.png

5. Save the settings.

   This information should become available on the website for non-authenticated users.

   .. image:: /user/img/system/config_commerce/sales/FrontSalesRepInfoNonAuth.png

To set information for logged in users, you need to make sure that in the system configuration, the settings allow John Doe as a customer user owner to enter his contact information manually in his user configuration.
   
This would allow John Doe to:

1. Navigate to **My User > My Configuration > Commerce > Sales > Contacts**. 
2. Select **Enter Manually** in the **Customer Visible Contact Info** field.
3. Provide contact details in **Enter Contact Info**, e.g.
   
   *John Doe, ACME 
   (800) 555-0100
   (800) 555-0199
   john.doe@example.com*

   .. image:: /user/img/system/config_commerce/sales/UseCase2.png

4. Click **Save Settings**. The information should become available on the website.

   .. image:: /user/img/system/config_commerce/sales/FrontSalesRepInfoLoggedIn.png

.. include:: /include/include-images.rst
   :start-after: begin

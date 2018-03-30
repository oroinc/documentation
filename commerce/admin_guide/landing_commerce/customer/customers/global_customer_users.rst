.. _sys-config--configuration--commerce--customers--customer-users:

Global Configuration of Customer Users
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

You can enable or disable customer user registration, requesting confirmation after registration and the way OroCommerce treats password security for all websites in OroCommerce.

To change the default settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Customer Users** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

   .. image:: /admin_guide/img/configuration/customer/customer_users/CustomerUsers.png
      :class: with-border

   The following table describes the options available on the page:

   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Name                                       | Description                                                                                                                                                                                               |
   +============================================+===========================================================================================================================================================================================================+
   | Default Customer Owner                     | Service information that governs which user has full access to managing and viewing the customer information. Usually, this is a default customer administrator or administrator assigned to the customer.|
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Registration Allowed                       | Enables/disables new customers registration from the Storefront login screen.                                                                                                                             |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Show Registration Link                     | Shows/hides the registration link from the Storefront login screen. The link is next to the Sign In link in the top bar.                                                                                  |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Confirmation Required                      | Enables/disables email confirmation step after the user registration.                                                                                                                                     |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Require Company Name                       | Shows/hides the company name field in the registration form in the Storefront. Required for the individual customers who do not belong to any company.                                                    |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Send Plain Text Password In Welcome Emails | Please, disable this option in a production environment.                                                                                                                                                  |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Show Registration Instructions             | Enables/disables registration instructions on the storefront login page. This option is disabled by default.                                                                                              |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Registration Instructions text             | If *Show Registration Instructions* is enabled, the text provided in the fields will be displayed on the storefront login page.                                                                           |
   |                                            |                                                                                                                                                                                                           |
   |                                            | .. image:: /admin_guide/img/configuration/customer/customer_users/CustomerUsersRegistrationFrontStore.png                                                                                                 |
   |                                            |                                                                                                                                                                                                           |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

3. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select the new option.

4. Click **Save Settings**.


.. finish 


.. include:: /img/buttons/include_images.rst
   :start-after: begin

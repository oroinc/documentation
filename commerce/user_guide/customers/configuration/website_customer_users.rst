.. _system--website--configuration--commerce--customers--customer-users:

Configuration of Customer Users Per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

You can enable or disable customer user registration, requesting confirmation after registration and the way OroCommerce treats password security for a specific website in OroCommerce.

To change the default settings for a website:

1. Navigate to the system configuration (click **System > Websites** in the main menu).
2. For the necessary website, hover over the |IcMore| *more actions* menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Customer Users** in the menu on the left.

   The following page opens.

   .. image:: /user_guide/img/system/configuration/customer/customer_users/CustomerUsersPerWebsite.png
      :class: with-border

   The following table describes the options available on the page:

   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Name                                       | Description                                                                                                                                                                                               |
   +============================================+===========================================================================================================================================================================================================+
   | Default Customer Owner                     | Service information that governs which user has full access to managing and viewing the customer information. Usually, this is a default customer administrator or administrator assigned to the customer.|
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Registration Allowed                       | Enables/disables new customers registration from the Store Frontend login screen.                                                                                                                         |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Confirmation Required                      | Enables/disables email confirmation step after the user registration.                                                                                                                                     |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Send Plain Text Password In Welcome Emails | Please, disable this option in a production environment. This option is disabled by default.                                                                                                              |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Show Registration Instructions             | Enables/disables registration instructions on the front store login page. This option is disabled by default.                                                                                             |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   | Registration Instructions text             | If *Show Registration Instructions* is enabled, the text provided in the fields will be displayed on the front store login page.                                                                          |
   +--------------------------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
   
3. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select the new option.

4. Click **Save**.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin


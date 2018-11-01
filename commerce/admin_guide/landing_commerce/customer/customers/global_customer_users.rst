.. _sys-config--configuration--commerce--customers--customer-users:

Configure Customer User Options Globally
----------------------------------------

.. begin

To change the default customer user configuration settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Customer Users** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   The following page opens:

   .. image:: /admin_guide/img/configuration/customer/customer_users/CustomerUsers.png
      :class: with-border
3. The following configuration options are available:

   * **Default Customer Owner** --- Service information that determines which user has full access to managing and viewing customer information. Usually, this is the default customer administrator or the administrator assigned to the customer. Applies to the customers created in the management console as well as to those who register on the OroCommerce website.
   * **Registration Allowed** --- Enables/disables registration of new customers from the storefront login screen.
   * **Confirmation Required** --- Enables/disables the email confirmation step following user registration.
   * **Show Registration Link** --- Shows/hides the registration link from the storefront login screen. The link is next to the Sign In link in the top bar.
   * **Auto Login** ---Enables/disables customer users to login after registration or email confirmation. Disabled by default.
   * **Required Company Name** --- Shows/hides the company name field in the registration form in the storefront. Required for individual customers who do not belong to any company.
   * **Show Registration Instructions** --- Enables/disables registration instructions on the storefront login page. This option is disabled by default.                                                                                              
   * **Registration Instructions Text** --- If *Show Registration Instructions* is enabled, the text provided in the field is displayed on the storefront login page.                                                                           
                                                                                                                                 
     .. image:: /admin_guide/img/configuration/customer/customer_users/CustomerUsersRegistrationFrontStore.png  

   * **Case-Insensitive Email Addresses** --- If this option is enabled, the letter case is ignored when comparing email addresses. For example, john.doe@example.com and John.Doe@example.com are treated equally. By default, the option is disabled.
   * **Customer Visitor Cookie Lifetime (Days)** --- Once the provided period expires, active customer visitor (anonymous user) sessions will be reset.
   * **Enable API Key Generation** --- Enable/disable automatic generation of API access keys for new customer users.

4. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select the new option.

5. Click **Save Settings**.


.. finish 


.. include:: /img/buttons/include_images.rst
   :start-after: begin

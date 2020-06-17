:oro_documentation_types: OroCommerce

.. _sys-config--configuration--commerce--customers--customer-users:

Configure Global Customer User Settings
=======================================

To change the default customer user configuration settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Customer Users** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. The following configuration options are available:

   * **Default Customer Owner** --- Service information that determines which user has full access to managing and viewing customer information. Usually, this is the default customer administrator or the administrator assigned to the customer. Applies to the customers created in the back-office as well as to those who register on the OroCommerce website.
   * **Registration Allowed** --- Enables/disables registration of new customers from the storefront login screen.
   * **Confirmation Required** --- Enables/disables the email confirmation step following user registration.
   * **Show Registration Link** --- Shows/hides the registration link from the storefront login screen. The link is next to the Sign In link in the top bar.
   * **Auto Login** ---Enables/disables customer users to login after registration or email confirmation. Disabled by default.
   * **Required Company Name** --- Shows/hides the company name field in the registration form in the storefront. Required for individual customers who do not belong to any company.
   * **Show Registration Instructions** --- Enables/disables registration instructions on the storefront login page. This option is disabled by default.                                                                                              
   * **Registration Instructions Text** --- If *Show Registration Instructions* is enabled, the text provided in the field is displayed on the storefront login page.

     .. image:: /user/img/system/config_commerce/customer/CustomerUsersRegistrationFrontStore.png
        :alt: Display the registration instruction text on the storefront login page

   * **Case-Insensitive Email Addresses** --- If this option is enabled, the letter case is ignored when comparing email addresses. For example, john.doe@example.com and John.Doe@example.com are treated equally. By default, the option is disabled. The identical option for back-office users is managed :ref:`here <admin-configuration-user-settings>`.
   * **Customer Visitor Cookie Lifetime (Days)** --- Once the provided period expires, active customer visitor (anonymous user) sessions will be reset.
   * **Enable API Key Generation** --- Enable/disable automatic generation of API access keys for new customer users.

4. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select the new option.

.. _system-configuration-user-impersonation:

Configure User Impersonation
----------------------------

.. note:: This feature is only available in the Enterprise edition.

.. csv-table::
  :widths: 10, 30

  "**Login as Customer User**","This option enables back-office users with the **Impersonate User** :ref:`role capability <admin-capabilities>` assigned to them to temporarily sign into the OroCommerce storefront as a specific customer user. This option is disabled by default. User impersonation is also available at :ref:`organization level <organization-user-impersonation>`.

                                    .. image:: /user/img/system/config_commerce/customer/user_impersonation.png
                                       :alt: User impersonation config option"


5. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin

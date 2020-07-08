:oro_documentation_types: OroCommerce

.. _system--user-mngm--organization--configuration--commerce--customers--customer-users:

Configure Customer User Settings per Organization
=================================================

To change the default customer user configuration settings for an organization:

1. Navigate to **System > User Management > Organization** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Customer > Customer Users** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/customers/CustomerUsersPerOrganization.png
      :class: with-border

4. The following configuration options are available:

   * **Default Customer Owner** --- Service information that determines which user has full access to managing and viewing customer information. Usually, this is the default customer administrator or the administrator assigned to the customer. Applies to the customers created in the back-office as well as to those who register on the OroCommerce website.
   * **Registration Allowed** --- Enables/disables registration of new customers from the storefront login screen.
   * **Confirmation Required** --- Enables/disables the email confirmation step following user registration.
   * **Show Registration Link** --- Shows/hides the registration link from the storefront login screen. The link is next to the Sign In link in the top bar.
   * **Require Company Name** --- Shows/hides the company name field in the registration form in the storefront. Required for individual customers who do not belong to any company.
   * **Show Registration Instructions** --- Enables/disables registration instructions on the storefront login page. This option is disabled by default.
   * **Registration Instructions Text** --- If *Show Registration Instructions* is enabled, the text provided in the field is displayed on the storefront login page.
   * **Customer Visitor Cookie Lifetime (Days)** --- Once the provided period expires, active customer visitor (anonymous user) sessions will be reset.

.. _organization-user-impersonation:

.. hint:: This feature is available in the Enterprise edition since OroCommerce v4.1.0. To check which application version you are running, see the :ref:`system Information <system-information>`.

5. In the **Login as Customer User** section, you can enable user impersonation for a specific organization. User impersonation allows back-office users with the **Impersonate User** :ref:`role capability <admin-capabilities>` to access and operate the OroCommerce storefront as if they were logged in as a specific customer user.

6. To customize any of these options:

     a) Clear the **Use System** box next to the option.
     b) Select the new option.

7. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin


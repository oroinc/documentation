.. _sys-config--configuration--commerce--customers--customer-users:

Configure Global Customer User Settings
=======================================

Customer User settings can be configured globally, :ref:`per organization <system--user-mngm--organization--configuration--commerce--customers--customer-users>`, and :ref:`per website <system--website--configuration--commerce--customers--customer-users>`.

To change the default customer user configuration settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Customer Users** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/customer/global-customer-user-settings.png
      :alt: Display the global customer user settings configuration

3. To customize any of the options for customer users:

     a) Clear the **Use Default** box next to the option.
     b) Select the new option.

4. In the **Customer Users Registration** section, configure the following options:

   * **Default Customer Owner** --- Service information that determines which user has full access to managing and viewing customer information. Usually, this is the default customer administrator or the administrator assigned to the customer. Applies to the customers created in the back-office as well as to those who register on the OroCommerce website.
   * **Registration Allowed** --- Enables/disables registration of new customers from the storefront login screen.
   * **Confirmation Required** --- Enables/disables the email confirmation step following user registration.
   * **Show Registration Link** --- Shows/hides the registration link from the storefront login screen. The link is next to the Sign In link in the top bar.
   * **Auto Login** ---Enables/disables customer users to login after registration or email confirmation. Disabled by default.
   * **Required Company Name** --- Shows/hides the company name field in the registration form in the storefront. Required for individual customers who do not belong to any company.
   * **Show Registration Instructions** --- Enables/disables registration instructions in the storefront login page. This option is disabled by default.
   * **Registration Instructions Text** --- If *Show Registration Instructions* is enabled, the text provided in the field is displayed in the storefront login page.

     .. image:: /user/img/system/config_commerce/customer/CustomerUsersRegistrationFrontStore.png
        :alt: Display the registration instruction text in the storefront login page

   * **Case-Insensitive Email Addresses** --- If this option is enabled, the letter case is ignored when comparing email addresses. For example, john.doe@example.com and John.Doe@example.com are treated equally. By default, the option is disabled. The identical option for back-office users is managed :ref:`here <admin-configuration-user-settings>`. Keep in mind that the uniqueness of email addresses and personal data is checked only for the registered users. It means that no two users can have identical personal information unless they are customer visitors (guest users). Multiple guest customers are allowed to have exactly the same data, including email addresses.

   * **Customer User Email Enumeration Protection** --- Typically, when a user attempts to register an account with an email that already exists in the system, an email address uniqueness validation message is displayed indicating that the email is already in use. With this option enabled, the validation message will no longer appear for duplicate emails. Instead, an email notification will be sent to the existing customer user, informing them of the registration attempt using their email. Enabling the feature helps enhance security and prevent fraudulent activities with known emails.

5. In the **Customer Visitor** section, configure the options for the anonymous users:

   .. image:: /user/img/system/config_commerce/customer/global-customer-user-settings2.png
      :alt: Display the global customer user settings configuration. Part 2

   * **Customer Visitor Cookie Lifetime (Days)** --- Once the provided period expires, active customer visitor (anonymous user) sessions will be reset. Keep in mind that the uniqueness of email addresses and personal data is checked only for the registered users. It means that no two users can have identical personal information unless they are customer visitors (guest users). Multiple guest customers are allowed to have exactly the same data, including email addresses.

.. _system-configuration-user-impersonation:

6. In the **Login as Customer User** section, configure the option for customer users. Keep in mind that this feature is available in the Enterprise edition.

   * **Enable Login As Customer User** --- The option enables back-office users with the **Login as Customer User** :ref:`role capability <admin-capabilities>` assigned to them to temporarily sign into the OroCommerce storefront and operate it as a specific customer user (i.e., impersonate a customer user). This option is disabled by default. User impersonation is also available at the :ref:`organization level <organization-user-impersonation>`.

7. In the **Login Attempts** section, configure the following options:

   * **Enable Failed Logins Limit** --- Defines whether a user can be locked out when the max number of login attempts is reached. By default, the option is enabled.
   * **Max Login Attempts** --- The number of attempts within the login failure lockout interval that a user has to authenticate before they are locked out. By default, the number is set to 10.
   * **Login Failure Lockout Interval** --- The time in minutes in which failed login attempts are counted. If one failed login attempt is followed by the second failed attempt within this lockout interval, the failed login count starts. The user will be locked out if they reach the maximum number of failed login attempts. Set zero (0) to count failed login attempts globally. By default, it is set to 60 minutes.
   * **Account Lockout Time** --- The time in minutes that indicates how long the user has before they are locked out of the system if they reach the maximum number of failed login attempts. Set zero (0) to disable automatic unlock. By default, it is set to 60 minutes.

8. In the **REST API** section, configure the following options:

   * **Enable API Key Generation** --- Enable/disable automatic generation of API access keys for new customer users.


.. _configuration--guide--commerce--configuration--cookie-consents:

9. In the **Cookies Banner** section, you can enable a cookie consent banner. A cookie consent banner is the cookie warning that pops up on websites when a user visits the site for the first time. This banner lets visitors know that their data is being collected and get their consent to use the data. The :ref:`CookieConsentBannerBundle <bundle-docs-commerce-cookie-consent-bundle>` allows to show such warning to the user.

If the application was installed without demo data, the banner is disabled. Configure the following options to enable cookie consent banner on the global level:

   * **Show Banner** --- Select the checkbox to display the cookie consent banner to the website's visitor.

     .. image:: /user/img/system/config_commerce/cookie_banner/banner-settings.png
        :alt: Cookie consent banner config

   * **Cookies Banner Text** --- Provide the message of the cookie banner. To edit the text for a specific language, click the language button and edit the text for the needed language.

     .. image:: /user/img/system/config_commerce/cookie_banner/text-language-button.png
        :alt: Text language button

   * **Landing Page** - Select the landing page with cookie policy of the application, if any. This landing page will be highlighted as a link on the banner. To translate the landing page title to the specific language, click the language button and edit the title as required.

     .. image:: /user/img/system/config_commerce/cookie_banner/cookie-banner-landing-page.png
        :alt: Text language button

10. Click **Save Settings**.

.. _user-guide--customers--customer-user-password-change-policy:

Password Change Policy
----------------------

.. note:: This is a Commerce Enterprise feature.

You can enforce a password change policy to increase your application's security and request that your customer users change their passwords after a certain period.

To enable the feature per customer user:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer Users** in the menu to the left.
3. Select the **Enable Password Change Policy** checkbox to enable the feature.
4. By default, the password is changed every 30 days. You can change the default number of days by toggling the option **Maximum Password Age (Days)**.

.. image:: /user/img/customers/customer_users/customer_user_password_change_policy.png

Once the feature is enabled, customer users will receive email notifications 7, 3, and 1 days before the password expires with a link to change their password.

Seven days before the password expires, the customer user will start getting flash notifications on each login, prompting them to change their password.

.. image:: /user/img/customers/customer_users/customer_user_expire_notification.png

As soon as the password expires, the customer user will receive an email with the link to change the password. From that moment, they will only be able to log in if they have updated their password. In this case, the status of the customer user password in the back-office changes to **Expired**. It will return to **Active** once the customer user changes the password.

You can change the contents of email notifications by updating the **customer_user_expired_password** and **customer_user_mandatory_password_change**
:ref:`email template <user-guide-using-emails-create-template>` of the Customer User entity.

.. _configuration--guide--commerce--configuration--customer-user-password-change-policy:

Password History Policy
-----------------------

.. note:: This is a Commerce Enterprise feature.

You can enable the Password history policy to prevent customer users from reusing the password they have already used previously.

To enable the feature:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer Users** in the menu to the left.
3. Select the **Enable Password History Policy** checkbox to enable the feature.
4. By default, the system collects the last 12 previously used passwords, but you can change this number by toggling the option **Enforce Password History Policy**.

.. image:: /user/img/customers/customer_users/customer_user_password_history_policy.png

Once the feature is enabled, customer users will no longer be able to reuse their older passwords. If they try to, they will get the following message:

.. image:: /user/img/customers/customer_users/customer_user_password_history_used_password.png

.. include:: /include/include-links-dev.rst
   :start-after: begin


.. include:: /include/include-images.rst
   :start-after: begin

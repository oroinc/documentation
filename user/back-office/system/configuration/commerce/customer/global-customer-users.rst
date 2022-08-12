:oro_documentation_types: OroCommerce

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

5. In the **Customer Visitor** section, configure the options for the anonymous users:

   .. image:: /user/img/system/config_commerce/customer/global-customer-user-settings2.png
      :alt: Display the global customer user settings configuration. Part 2

   * **Customer Visitor Cookie Lifetime (Days)** --- Once the provided period expires, active customer visitor (anonymous user) sessions will be reset. Keep in mind that the uniqueness of email addresses and personal data is checked only for the registered users. It means that no two users can have identical personal information unless they are customer visitors (guest users). Multiple guest customers are allowed to have exactly the same data, including email addresses.

6. In the **Login Attempts** section, configure the following options:

   .. hint:: This feature is available starting from OroCommerce v4.2.8. To check which application version you are running, see the :ref:`system information <system-information>`.

   * **Enable Failed Logins Limit** --- Defines whether a user can be locked out when the max number of login attempts is reached. By default, the option is disabled.
   * **Max Login Attempts** --- The number of attempts within the login failure lockout interval that a user has to authenticate before they are locked out. By default, the number is set to 10.
   * **Login Failure Lockout Interval** --- The time in minutes in which failed login attempts are counted. If one failed login attempt is followed by the second failed attempt within this lockout interval, the failed login count starts. The user will be locked out if they reach the maximum number of failed login attempts. Set zero (0) to count failed login attempts globally. By default, it is set to 60 minutes.
   * **Account Lockout Time** --- The time in minutes that indicates how long the user has before they are locked out of the system if they reach the maximum number of failed login attempts. Set zero (0) to disable automatic unlock. By default, it is set to 60 minutes.

7. In the **REST API** section, configure the following options:

   * **Enable API Key Generation** --- Enable/disable automatic generation of API access keys for new customer users.


.. _system-configuration-user-impersonation:

Configure User Impersonation
----------------------------

.. hint:: This feature is available in the Enterprise edition starting from OroCommerce v4.1.0. To check which application version you are running, see the :ref:`system information <system-information>`.

.. csv-table::
  :widths: 10, 30

  "**Login as Customer User**","This option enables back-office users with the **Impersonate User** :ref:`role capability <admin-capabilities>` assigned to them to temporarily sign into the OroCommerce storefront as a specific customer user. This option is disabled by default. User impersonation is also available at :ref:`organization level <organization-user-impersonation>`.

                                    .. image:: /user/img/system/config_commerce/customer/user_impersonation.png
                                       :alt: User impersonation config option"



.. _configuration--guide--commerce--configuration--cookie-consents:

Configure Cookie Consent Banner Settings
----------------------------------------

In the **Cookies Banner** section, you can enable a cookie consent banner. A cookie consent banner is the cookie warning that pops up on websites when a user visits the site for the first time. This banner lets visitors know that their data is being collected and get their consent to use the data.

The :ref:`CookieConsentBannerBundle <bundle-docs-commerce-cookie-consent-bundle>` allows to show such warning to the user.

If the application was installed without demo data, the banner is disabled. To configure cookie consent banner on the global level, take the following steps:

1. **Show Banner** --- Select the check box to display the cookie consent banner to the website's visitor.

   .. image:: /user/img/system/config_commerce/cookie_banner/banner-settings.png
      :alt: Cookie consent banner config

2. **Cookies Banner Text** --- Provide the message of the cookie banner. To edit the text for a specific language, click the language button and edit the text for the needed language.

   .. image:: /user/img/system/config_commerce/cookie_banner/text-language-button.png
      :alt: Text language button

3. **Landing Page** - Select the landing page with cookie policy of the application, if any. This landing page will be highlighted as a link on the banner. To translate the landing page title to the specific language, click the language button and edit the title as required.

   .. image:: /user/img/system/config_commerce/cookie_banner/cookie-banner-landing-page.png
      :alt: Text language button

4. Click **Save Settings**.


.. include:: /include/include-links-dev.rst
   :start-after: begin


.. include:: /include/include-images.rst
   :start-after: begin

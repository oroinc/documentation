.. _system--website--configuration--commerce--customers--customer-users:

Configure Customer User Settings per Website
============================================

To change the default customer user configuration settings for a website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Customer > Customer Users** in the menu on the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/website-config-customer-user.png
      :alt: Customer User settings on website level

4. To customize any of the options, clear the **Use Organization** box and select a new option.

5. In the **Customer Users Registration** section, configure the following options:

   * **Default Customer Owner** --- Service information that determines which user has full access to managing and viewing customer information. Usually, this is the default customer administrator or the administrator assigned to the customer. Applies to the customers created in the back-office as well as to those who register on the OroCommerce website.
   * **Registration Allowed** --- Enables/disables registration of new customers from the storefront login screen.
   * **Confirmation Required** --- Enables/disables the email confirmation step following user registration.
   * **Show Registration Link** --- Shows/hides the registration link from the storefront login screen. The link is next to the Sign In link in the top bar.
   * **Required Company Name** --- Shows/hides the company name field in the registration form in the storefront. Required for individual customers who do not belong to any company.
   * **Show Registration Instructions** --- Enables/disables registration instructions in the storefront login page. This option is disabled by default.
   * **Registration Instructions Text** --- If *Show Registration Instructions* is enabled, the text provided in the field is displayed in the storefront login page.

6. In the **Login Redirect** section, configure the following options:

   * **Redirect After Login** --- Allows specifying a different target page for a successful login, instead of redirecting the user back to the original page where the login process began. However, if the login is initiated while accessing a protected resource, the user will always be redirected to the originally requested resource upon successful authentication. Available options from the drop-down are: none, content node, category, system page, URI.
   * **Do Not Leave Checkout** --- Enable this option to redirect the user back to the checkout page after a successful login, overriding the *Redirect After Login* setting that may specify a different target page.

7. In the **Cookies Banner** section, enable a cookie consent banner. A cookie consent banner is the cookie warning that pops up on websites when a user visits the site for the first time.

   To configure cookie consent banner on the organization level, take the following steps:

   * **Show Banner** --- Select the checkbox to display the cookie consent banner to the website's visitor.

   * **Cookies Banner Text** --- Provide the message of the cookie banner. To edit the text for a specific language, click the language button and edit the text for the needed language.

   * **Landing Page** - Select the landing page with cookie policy of the application, if any. This landing page will be highlighted as a link on the banner. To translate the landing page title to the specific language, click the language button and edit the title as required.

8. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin


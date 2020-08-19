:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--cookie-consents:

Configure Cookie Consent Banner Settings
========================================

A cookie consent banner is the cookie warning that pops up on websites when a user visits the site for the first time.

This banner lets visitors know that their data is being collected and to get their consent to use the data.

The :ref:`CookieConsentBannerBundle <bundle-docs-commerce-cookie-consent-bundle>` allows to show such warning to the user.

Enable Cookie Consent Banner
----------------------------

If the application was installed without demo data, the banner is disabled.

Cookie consent banner can be enabled on the global configuration and website levels.

To enable cookie consent banner on the global configuration level:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Customer Users** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. Scroll the page to the **Cookies Banner** section.
4. Next to the **Show Banner** field, clear the **Use Default** check box.
5. Select the **Show Banner** check box.

   .. image:: /user/img/system/config_commerce/cookie_banner/banner-settings.png
      :class: with-border
      :alt: Cookie consent banner config

6. Click **Save Settings**.

To enable or disable the banner on website configuration level:

1. Navigate to **System > Websites** in the main menu.
2. Hover over the **More Options** menu to the right of the necessary website and click **Config** to reach the configuration page.
3. Select **Commerce > Customer > Customer Users** in the menu to the left.
4. Scroll the page to the **Cookies Banner** section.
5. Next to the **Show Banner** field, clear the **Use Organization** check box.
6. Select the **Show Banner** check box.
7. Click **Save Settings**.

Change Cookies Banner Text
--------------------------

The banner text displayed in the banner can be edited for each enabled language installed at the application.

To change the cookie consent banner text on the global configuration level:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Customer Users** in the menu to the left.
3. Scroll the page to the **Cookies Banner** section.
4. Next to the **Cookies Banner Text** field, clear the **Use Default** check box.
5. Edit the text.
6. To edit the text for specific language, click the language button and edit the the text for the needed language

   .. image:: /user/img/system/config_commerce/cookie_banner/text-language-button.png
      :class: with-border
      :alt: Text language button

7. Click **Save Settings**.

Change The Landing Page For Banner
----------------------------------

The banner can have the button with the link to landing page with cookie policy of the application.

The same as the banner text, the landing page can be configured for each enabled language installed at the application.

To change the landing page on the global configuration level:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Customer Users** in the menu to the left.
3. Scroll the page to the **Cookies Banner** section.
4. Next to the **Landing Page** field, clear the **Use Default** check box.
5. Select the landing page that should be used at the banner button.
6. To edit the text for specific language, click the language button and select the landing page for the needed language.
7. Click **Save Settings**.

.. include:: /include/include-links-dev.rst
   :start-after: begin

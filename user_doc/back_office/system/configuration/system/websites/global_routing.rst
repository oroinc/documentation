.. _sys--config--sysconfig--websites--routing:
.. _user-guide--marketing--web-catalog--enable-globally:

Routing
=======

Global routing configuration includes the following information:

* Global website URL when reached using secure (https) and insecure (http) connection
* Options that impact the way metadata for the search engine is generated
* Pretty URL support (e.g. `/product/view/4` vs `/500-watt-work-light`)

.. note:: The :ref:`website level configuration <sys--websites--sysconfig--websites--routing>` has higher priority and overrides this configuration settings.

To change the default global routing settings:

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > Websites > Routing** in the menu to the left.

   The Routing configuration page opens with the following options:

   .. image:: /user_doc/img/system/config_system/routing_general.png
      :class: with-border

   * **URL** - Internal links and canonical URLs (meta keywords) on the OroCommerce storefront pages may contain this value as the website base URL. This option value is used in internal links when a customer uses insecure (HTTP) connection. In the canonical links, it is used when the **Canonical URL Security Type** is set to *Secure*.

   * **Secure URL** - Internal links and canonical URLs (meta keywords) on the OroCommerce storefront pages may contain this value as the website base URL. This option value is used in internal links when a customer uses secure (HTTPS) connection. In the canonical links, it is used when the **Canonical URL Security Type** is set to *Insecure*.

   * **Canonical URL Type** - this option defines whether the *System URL* or *Direct URL* should be used as a canonical link in the meta keywords in the page source code.

     .. note:: |Canonical link| is used to help search engines identify the unique content that should be indexed.

     When *System URL* is selected, the page URL is built using the system path to the item and its ID (e.g. `/product/view/4`).

     When *Direct URL* is selected, the page URL is built using the page title (e.g. `/500-watt-work-light`).

   * **Canonical URL Security Type** - this option defines which value should be used as a website base URL in the canonical link in the page meta keywords. Supported options: *Insecure* and *Secure*.

     When *Insecure* is selected, the website base URL in the canonical link matches the **URL** value.

     When *Secure* is selected, the **Secure URL** value is used instead.

   * **Create Redirects** - this option defines a strategy for creating redirects when the URL building rules change. Supported options: *Ask*, *Never*, *Always*.

     When *Ask* is selected, OroCommerce prompts to confirm redirect creation on every change.

     When *Never* is selected, OroCommerce does not create any redirects.

     When *Always* is selected, the redirects are created by default.

   * **Web Catalog** - when a Web Catalog is selected, it populates the main menu and sub-menus on the OroCommerce Storefront. If there is no Web Catalog in OroCommerce, the Master Catalog structure is mimicked.

   .. image:: /user_doc/img/system/config_system/routing_website_matchers.png
      :class: with-border

   .. note:: The Website Matchers feature is only available in the Enterprise edition.

   * **Website Matchers** - with this option, you can define the way OroCommerce will identify the website customer uses. It is recommended to select at least one option. Supported options: *ENV Variable Based*, *Cookie Based*, *URL Based*. When more than one option is selected, set the method priority in the **sort order** column to define the most reliable and trusted one.

   * **Enable Redirect** - indicates whether the customer should be automatically redirected to the website that was identified using one of the  website matching methods (e.g. user navigated to the *us-store.com* but their cookies indicate that they are visiting the *uk-store.com*).

   * **Cookie Name** - the name of the cookie that stores information about the current website in the customer's browser.


   .. image:: /user_doc/img/system/config_system/routing_direct_url.png
      :class: with-border

   * **Enable Direct URLs** - when enabled, the page URL is built using the page title (e.g. `/500-watt-work-light`). When disabled, the system path to the item and its ID is used (e.g. `/product/view/4`).

   * **Product URL Prefix** - the prefix that is appended to the product slug in the URL.

   * **Category URL Prefix** - the prefix that is appended to the category slug in the URL.

   * **Landing Page URL Prefix** - The prefix that is appended to the landing page slug in the URL.

3. To customize any of these options:

     a) Clear the **Use Default** box next to the option.
     b) Select the new option.

4. Click **Save**.

.. include:: /include/include_links.rst
   :start-after: begin


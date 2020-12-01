:oro_documentation_types: OroCommerce

.. _sys--websites--sysconfig--websites--routing:
.. _user-guide--marketing--web-catalog--enable-per-website:

Configure Routing Settings per Website
======================================

To control the way OroCommerce routes HTTP requests to the components when a customer uses particular website, you may provide the following website-specific information:

* Global website URL when reached using secure (https) and insecure (http) connection

* Options that impact the way metadata for the search engine is generated

* Information for the website identification (cookie value and/or environment variable).

.. note:: The website level configuration overrides :ref:`organization routing <sys--config--sysconfig--websites--routing>` configuration, when **Use Organization** box is cleared.

To change the default routing settings for the website:

1. Navigate to **System > Websites** in the main menu.

2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.

3. Select **System Configuration > Websites > Routing** in the menu to the left.

   .. image:: /user/img/system/websites/web_configuration/website_routing.png
      :class: with-border

4. In the **General** section, define the following options:

   * **URL** - Internal links and canonical URLs (meta keywords) on the OroCommerce storefront pages may contain this value as the website base URL. This option value is used in internal links when a customer uses insecure (HTTP) connection. In the canonical links, it is used when the **Canonical URL Security Type** is set to *Secure*.

   * **Secure URL** - Internal links and canonical URLs (meta keywords) on the OroCommerce storefront pages may contain this value as the website base URL. This option value is used in internal links when a customer uses secure (HTTPS) connection. In the canonical links, it is used when the **Canonical URL Security Type** is set to *Insecure*.

   * **Canonical URL Type** - this option defines whether the *System URL* or *Direct URL* should be used as a canonical link in the meta keywords in the page source code.

     When *System URL* is selected, the page URL is built using the system path to the item and its ID (e.g. `/product/view/4`).

     When *Direct URL* is selected, the page URL is built using the page title (e.g. `/500-watt-work-light`).

     .. note:: |Canonical link| is used to help search engines identify the unique content that should be indexed.

   * **Prefer Self-Contained Web Catalog Canonical URLs** - When this option is disabled, the canonical URLs point to the direct URLs of the underlying content types, if they are available. This option is disabled by default.

   * **Canonical URL Security Type** - this option defines which value should be used as a website base URL in the canonical link in the page meta keywords. Supported options: *Insecure* and *Secure*.

     When *Insecure* is selected, the website base URL in the canonical link matches the **URL** value.

     When *Secure* is selected, the **Secure URL** value is used instead.

   * **Web Catalog** - when a Web Catalog is selected, it populates the main menu and sub-menus on the OroCommerce Storefront. If there is no Web Catalog in OroCommerce, the Master Catalog structure is mimicked.

   Once you decide on the Web Catalog, click **Save Settings**, and the detailed content tree of the selected web catalog appears under the **Navigation Root** field.

   * **Navigation Root** - select the root content node to be displayed in the OroCommerce storefront. Keep in mind that only the sub-menu nodes that belong to the selected parent node will be visible in the storefront.

   .. image:: /user/img/system/websites/web_configuration/visible_content_node_website.png
      :alt: The selected sub-menu nodes that will be visible in the storefront.

5. In **Website Matchers**, configure the following values to identify the visitors of your website through various tracking options:

   .. image:: /user/img/system/config_system/website_matchers.png

   * **Cookie Value** - a unique website ID that is saved in the cookies and is later used by a website matcher to identify the website customer is on. The cookie name that is configured on the :ref:`system level <routing-website-matchers-global>` combined with the cookie value creates the unique parameter that will identify the required website.

   * **ENV Variable Name** - an environment variable that is used to store the unique website ID that is later used by a website matcher to identify the website customer is on.

   * **ENV Variable Value** - a unique website ID that is saved to the environment variable with the name defined in the option above.

6. To customize any of these options:

   a) Clear the **Use Organization** box next to the option.
   b) Select the new option.

7. Click **Save**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
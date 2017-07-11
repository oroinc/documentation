:orphan:

.. _sys--websites--sysconfig--websites--routing:

Routing Configuration Per Website
---------------------------------

.. begin

To control the way OroCommerce routes HTTP requests to the components when a customer uses particular website, you may provide the following website-specific information:

* Global website URL when reached using secure (https) and insecure (http) connection

* Options that impact the way metadata for the search engine is generated

* Information for the website identification (cookie value and/or environment variable).

.. note:: The website level configuration overrides :ref:`global routing <sys--config--sysconfig--websites--routing>` configuration, when **Use System** box is cleared.

To change the default routing settings for the website:

1. Navigate to **System > Websites** in the main menu.

2. For the necessary website, hover over the |IcMore| *more actions* menu to the right of the necessary website and click |IcConfig| to start editing the configuration.

3. Select **System Configuration > Websites > Routing** in the menu to the left.

   The following page opens.

   .. image:: /user_guide/img/system/configuration/websites/website_routing.png
      :class: with-border

   * **URL** - Internal links and canonical URLs (meta keywords) on the OroCommerce Front Store pages may contain this value as the website base URL. This option value is used in internal links when a customer uses insecure (HTTP) connection. In the canonical links, it is used when the **Canonical URL Security Type** is set to *Insecure*.

   * **Secure URL** - Internal links and canonical URLs (meta keywords) on the OroCommerce Front Store pages may contain this value as the website base URL. This option value is used in internal links when a customer uses secure (HTTPS) connection. In the canonical links, it is used when the **Canonical URL Security Type** is set to *Secure*.

   * **Canonical URL Type** - this option defines whether the *System URL* or *Direct URL* should be used as a canonical link in the meta keywords in the page source code.

     .. note:: Canonical link is used to help search engines identify the unique content that should be indexed.

     When *System URL* is selected, the page URL is built using the system path to the item and its ID (e.g. `/product/view/4`).

     When *Direct URL* is selected, the page URL is built using the page title (e.g. `/500-watt-work-light`).

   * **Canonical URL Security Type** - this option defines which value should be used as a website base URL in the canonical link in the page meta keywords. Supported options: *Insecure* and *Secure*.

     When *Insecure* is selected, the website base URL in the canonical link matches the **URL** value.

     When *Secure* is selected, the **Secure URL** value is used instead.

   * **Web Catalog** - when a Web Catalog is selected, it populates the main menu and sub-menus on the OroCommerce Front Store. If there is no Web Catalog in OroCommerce, the Master Catalog structure is mimicked.

   * **Cookie Value** - a unique website ID that is saved in the cookies and is later used by a website matcher to identify the website customer is on. The cookie name is configured on the :ref:`system level <sys--config--sysconfig--websites--routing>`.

   * **ENV Variable Name** - an environment variable that is used to store the unique website ID that is later used by a website matcher to identify the website customer is on.

   * **ENV Variable Value** - a unique website ID that is saved to the environment variable with the name defined in the option above.

4. To customize any of these options:

     a) Clear the **Use System** box next to the option.
     b) Select the new option.

5. Click **Save**.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin

:oro_documentation_types: OroCommerce

.. _doc-website-configuration:
.. _user-guide--system-websites--configure-website:

System Configuration for Website
================================

You can configure available system settings on four :ref:`configuration levels <configuration--guide--config-levels>`: system, organization, website, and user.

.. begin

On the website level, there are a number of options that you can configure specifically for the particular OroCommerce website, but which will not affect system-wide or organization-wide configuration.

.. important:: Website-level configuration settings can fall back to organization settings. For this, select the **Use Organization** check box next to the selected option. To go back to the default website-level settings, click **Reset** on the top right.

Two categories of settings are available for configuration at the website level:

* System Configuration (General Setup, Integrations)
* Commerce (Sales) 

More information about the options available for each of the two categories is available below.

* **System Configuration**

  * Integrations

    * :ref:`Google Settings <website-google-settings>`

  * General Setup

    * :ref:`Website Localization <sys--websites--sysconfig--general-setup--localization>`
    * :ref:`Email Configuration for the Website <admin-configuration-system-mailboxes-website>`
    * :ref:`Display Settings for the Website <display-settings--website>`

  * Integrations

    * :ref:`Google Setting per Website <website-google-settings>`

  * Website

    * :ref:`Routing <sys--websites--sysconfig--websites--routing>`
    * :ref:`Sitemap <sys--websites--sysconfig--websites--sitemap>`

* **Commerce Configuration**

  * Customer

    * :ref:`Contact Requests <sys--conf--commerce--customer--contact-request-website>`
    * :ref:`Customer Users <system--website--configuration--commerce--customers--customer-users>`
    * :ref:`Consents <admin--guide--commerce--configuration--customers--consents--enable--website>`

  * :ref:`Guests <sys--conf--commerce--guest>`

   * :ref:`Website Access <sys--conf--commerce--guest-access--website>`

  * Design

    * :ref:`Theme <configuration--commerce--design--theme--theme-settings--website>`

  * :ref:`Product <doc--products--before-you-begin>`

    * :ref:`Product Images <sys--websites--commerce--product--product-images>`
    * :ref:`Featured Products <sys--websites--commerce--products--featured-products>`
    * :ref:`Promotions <sys--websites--commerce--products--new-arrivals>`
    * :ref:`Configurable Products <config-guide--landing-commerce--products--configurable-products--website>`

  * :ref:`Inventory <user-guide--inventory>`

    * :ref:`Warehouse <warehouses-website>`
    * :ref:`Product Options <sys--conf--commerce--inventory--product-options--website>`
    * :ref:`Limitations <inventory-limitations-website>`
    * :ref:`Allowed Statuses <allowed-statuses-website>`

  * Sales

    * :ref:`Request For Quote <user-guide--system-configuration--commerce-sales--rfq--website>`
    * :ref:`Quick Order Form <user-guide--system-configuration--commerce-sales--quick-order-form--website>`
    * :ref:`Shopping Lists <user-guide--system-configuration--commerce-sales-shopping-list-per-website>`
    * :ref:`Contacts <sys--conf--commerce--sales--contacts-website>`
    * :ref:`Checkout <user-guide--system-configuration--commerce-sales-checkout-website>`

  * Catalog

    * :ref:`Pricing <pricing-currency-website>`
    * :ref:`Filters and Sorters <configuration--guide--commerce--configuration--catalog--filters-sorters--website>`
    * :ref:`Related Products <sys--websites--commerce--catalog--related-products>`
    * :ref:`Special Pages ( All Products Page) <sys--conf--commerce--catalog--special-pages--website>`

  * Orders

    * :ref:`Order Creation <configuration--commerce--orders--order-creation--website>`
    * :ref:`Purchase History <sys--commerce--orders--previously-purchased--website>`

.. toctree::
   :maxdepth: 1
   :hidden:

   commerce/index
   general-sys-config/index


:oro_documentation_types: OroCommerce

.. _doc-website-configuration:
.. _user-guide--system-websites--configure-website:

Configure Website System Settings
=================================

.. hint:: This section is a part of the :ref:`Multi-Website Configuration <website-management-concept-guide>` concept guide topic that provides the general understanding of multiple website configuration concept in Oro applications.

.. important:: Multi-website management is only available in the Enterprise edition.

You can configure available system settings on four :ref:`configuration levels <configuration--guide--config-levels>`: system, organization, website, and user.

On the website level, there are a number of options that you can configure specifically for the particular OroCommerce website, but which will not affect system-wide or organization-wide configuration.

.. important:: Website-level configuration settings can fall back to organization settings. For this, select the **Use Organization** check box next to the selected option. To go back to the default website-level settings, click **Reset** on the top right.

Two categories of settings are available for configuration at the website level:

* System Configuration (General Setup, Integrations)
* Commerce (Sales) 

More information about the options available for each of the two categories is available below.

* **System Configuration**

  * Integrations

    * :ref:`Google Settings for the Website <website-google-settings>`

  * Website

    * :ref:`Routing <sys--websites--sysconfig--websites--routing>`
    * :ref:`Sitemap <sys--websites--sysconfig--websites--sitemap>`

  * General Setup

    * :ref:`Application Settings for the Website <admin-configuration-application-website>`
    * :ref:`Website Localization <sys--websites--sysconfig--general-setup--localization>`
    * :ref:`Email Configuration for the Website <admin-configuration-system-mailboxes-website>`
    * :ref:`Display Settings for the Website <display-settings--website>`


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
    * :ref:`Orders History <website-commerce--configuration--sales-order-history>`
    * :ref:`Quotes <sys--websites-quotes>`

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

   System Configuration <general-sys-config/index>
   Commerce Configuration <commerce/index>



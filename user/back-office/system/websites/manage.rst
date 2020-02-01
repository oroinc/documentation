:oro_documentation_types: OroCommerce

.. _user-guide--system-websites--manage-websites:

Manage a Website
================

With OroCommerce, you can determine the way a particular website is operated by customizing it according to your business requirements.

Once a website is created and properly configured, you can now:

* set the website as default
* configure the website settings for the B2C market sector
* customize the website storefront navigation and menus
* add variable web catalog pages for different websites
* limit price lists and content blocks to particular websites
* customize product inventory, create and manage multiple warehouses on different websites
* manage product visibility on the website
* enable certain shipping and payment methods on the website
* limit a promotion campaign to a website
* set up and use website tracking with your OroCommerce website

Set a Website as Default
------------------------

OroCommerce redirects anonymous users to the default website. Logged in customers users may also be redirected in case their current website is not identified.

To set a website as default:

1. Navigate to **System > Websites** using the main menu.

2. Click on the website you would like to use as default (e.g., Australia).

   .. image:: /user/img/system/websites/view_website_australia.png
      :alt: View the details of Australia website

3. On the website details page, click |IcFlag| **Set Default**.

Now the website is marked as default and will be used for the anonymous access.

.. image:: /user/img/system/websites/default_australia_website.png
   :alt: Mark Australia website as the default one

Configure a Website for B2C
---------------------------

OroCommerce enables you to customize the application for the B2C business type, modifying the default configuration to match the typical B2C setup. You can then change these settings manually in the system configuration, if necessary.

A B2C website can be configured in two ways, either :ref:`during creation <system-websites-create>` or from the website's view page.

1. Navigate to **System > Websites** using the main menu.
2. Click the website you would like to configure for B2C (e.g., Australia).

   .. image:: /user/img/system/websites/view_website_australia_B2C.png
      :alt: View the details of Australia website

3. On the website details page, click |IcB2C| **Configure for B2C**.

4. The popup confirmation dialog displays the list of options that will be modified by this configuration.

   .. image:: /user/img/system/websites/B2C_settings2.png
      :alt: The list of options that are modified for the B2C website

5. Click **Yes** to confirm.

6. The changes apply automatically. You can view them in the system configuration and update if required.


Edit a Storefront Menu
----------------------

OroCommerce storefront has a number of menus that may be rearranged and customized. You can enable or disable menu items for a particular customer, website, or a mobile device by setting related conditions.

To customize a storefront menu for the website:

1. Navigate to **System > Websites** using the main menu.

2. Click the website you would like to edit a menu for (e.g., Australia).

   .. image:: /user/img/system/websites/view_website_australia1.png
      :alt: View the details of Australia website

3. On the website details page, click |IcConfig| **Edit Frontend Menu**.

   Now you are redirected to the list of OroCommerce storefront menus:

   .. image:: /user/img/system/websites/front_menu.png
      :alt: The list of OroCommerce storefront menus

4. Click on the menu to start customizing it:

   .. image:: /user/img/system/websites/edit_menu.png
      :alt: Click on the menu to start customizing it

   * Drag-and-drop menu items to rearrange them.

   * Create new items and dividers if necessary by clicking **Create Menu Item** or **Create Divider** (in the button group on the top right of the page).

   * Click on the menu item to edit its details.

Find more information on how to edit and customize the storefront menu in the :ref:`Menu Management <doc-config-menus-menuspage>` section.

5. Once you are happy with the menu contents, click **Save**.

Customize Web Catalogs per Website
----------------------------------

OroCommerce enables you to create a web catalog with different product collections and customize it for a certain website in a way you prefer to make shopping easy and efficient. You can also organize a specific content tree by building additional content nodes and customizing menu items per each website individually.

To create a new web catalog, personalize the catalog content for a specific website, set up particular visibility restrictions to a website, localization, or a customer, and enable the web catalog for the selected website, refer to the following sections:

* :ref:`Create a Web Catalog <user-guide--web-catalog-create>`
* :ref:`Configure Content Variants for the Content Node <user-guide--marketing--web-catalog--content-variant>`
* :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--node--visibility>`
* :ref:`Enable a Web Catalog for a Website <user-guide--marketing--web-catalog--enable-per-website>`

Customize Price Lists per Website
---------------------------------

With OroCommerce you can create and set up flexible product prices for different websites, link the price lists to a particular website, a customer, or a customer group, and schedule price changes.

For more details on how to create a price list and enable it for a particular website, refer to the following sections:

* :ref:`Currency Configuration per Website <sys--websites--sysconfig--currency>`
* :ref:`Price Lists Management <user-guide--pricing--pricelist--management>`
* :ref:`Price List Configuration per Website <sys--website--edit--price-lists>`
* :ref:`Price List Configuration per Customer <customers--customers--edit--price-lists>`
* :ref:`Price List Configuration per Customer Group <customers--customer-groups--edit--price-lists>`

Customize Product Inventory per Website
---------------------------------------

You can also create and manage multiple warehouses, track your inventory status and the availability of your products, as well as their quantities, in each warehouse assigned to a particular website.

The :ref:`Warehouses and Inventory <user-guide--inventory>` section covers the details on how to configure inventory-related settings globally and per a website.

Customize Product Visibility per Website
----------------------------------------

Additionally to configuration set for product categories and price lists, you can determine which customers, customer groups, or websites are to view specific products by customizing a related product visibility per each product individually.

Follow the :ref:`Manage Product Visibility <products--product-visibility>` section for the details on how to set certain visibility restrictions for selected products.

Customize Promotion Visibility per Website
------------------------------------------

Similarly to a visibility restriction procedure set to a product, promotion visibility can also be limited to a particular website, a customer. or a customer group.

Follow the :ref:`Promotions <user-guide--marketing--promotions>` section for the details on how to create and manage promotions.

Customize a Payment Method per Website
--------------------------------------

OroCommerce provides sellers with effective payment solutions that help enhance customers' buying experience. Integration with the most popular payment services as :ref:`PayPal <user-guide--payment--payment-providers-overview--paypal>`, :ref:`Authorize.Net <user-guide--payment--payment-providers-overview--authorizenet>`,  :ref:`Wirecard <doc--payment--payment-providers-overview--wirecard>`, :ref:`InfinitePay <user-guide--payment--payment-providers-overview--infinitepay>`, and :ref:`Apruve  <user-guide--payment--payment-providers-overview--apruve>` into OroCommerce enables various payment transactions to be made in a particular localization and on a certain website.

Learn more about how to assign a payment method to the required website in the :ref:`Payment Rules Configuration <sys--payment-rules>` section.

Also refer to the :ref:`payment configuration <user-guide--payment-configuration>` for the detailed instruction on how to set a merchant location and configure integration with third-party payment providers.

Customize a Shipping Method per Website
---------------------------------------

Similarly to configuring payment methods in OroCommerce, you can create an integration with a shipping provider, such as :ref:`UPS <doc--integrations--ups>`, :ref:`FedEx <doc--integrations--fedex>`, and :ref:`Flat Rate <doc--integrations--flat-rate>` and customize its settings per a particular website by adding a :ref:`shipping rule <sys--integrations--manage-integrations--ups--flat-rate>`.

Also, refer to the :ref:`shipping configuration on the system level <user-guide--shipping--configuration>` to set the default shipping address, enable or disable shipping units of length and weight, and specify the tax code to be applied to the shipping cost.

Customize Content Blocks per Website
------------------------------------

When you prepare :ref:`web catalogs <user-guide--web-catalog>` for you storefront, you can :ref:`create <user-guide--web-catalog-create>` and :ref:`enable a custom web catalog for the website <user-guide--marketing--web-catalog--enable-per-website>` or :ref:`set up a custom node content for the website <user-guide--marketing--web-catalog--customize>` in the default web catalog.

**Related Topics**

* :ref:`Website Management <user-guide--system-websites>`

.. include:: /include/include-images.rst
   :start-after: begin

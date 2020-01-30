.. _sys--conf--commerce--guest:

:oro_documentation_types: OroCommerce

Guest Functions
===============

Traditionally, B2B vendors work with verified buyers and many B2C web stores have guest shopping and guest checkout featured disabled. OroCommerce, however, keeps pace with the changing trends and caters to the needs of all customers, both registered and not. Such a strategy helps attract new visitors, facilitate their interaction within your website, and increase the conversion rates as a result. OroCommerce enables you to adapt to the individual preferences of each customer and allows buyers to browse the website both as logged-in or guest users without affecting their shopping experience.

You can enable and disable guest functions in the system configuration. This enables unauthenticated users to have full or partial access to the following website features without registration:

* Browsing the website content (you can apply visibility restrictions to specific pages)
* Viewing products, categories, nodes
* Checking product pricing
* Creating a shopping list
* Placing an order from a shopping list or a quick order form
* Requesting a quote
* Proceeding through checkout as a guest and register afterward

.. image:: /user/img/concept-guides/guests/total_access.png
   :alt: A website view when all features are available to a guest user

You can also completely restrict guest user access to the website.

.. image:: /user/img/concept-guides/guests/no_permissions.png
   :alt: A website view when no features are available to a guest user

OroCommerce introduces the guest access management functionality with multiple guest features that provides B2B vendors with deeper control over guest user activity.

Below is the list of activities and functions that you can customize for your guest visitors, depending on your business requirements.

Guest Permissions
-----------------

Before enabling or disabling a particular guest function, you first need to define the :ref:`permissions and access levels <user-guide--customers--customer-user-roles>` for non-authenticated users. This way, you can control what guest customers can and cannot do on your website, providing that the related guest function is enabled.

For example, you can activate the guest shopping list option but restrict the ability to delete it, or activate the guest checkout but disable coupon usage unless a guest user registers. You can add the necessary workflow to cover the needs of guest customers, such as an *alternative* or a *single page checkout* by assigning the required permissions. These and other access options are available for any customization depending on your business needs under **Customers > Customer User Roles** in the system configuration.

.. image:: /user/img/concept-guides/guests/customer-user-roles-guests.png
   :alt: Customize permissions and access levels for guest customers

Guest Website Access
--------------------

Flexible website access management gives you the possibility to customize every aspect of your website storefront to support guest visitors' activity, from browsing the website and adding the selected products to a shopping list to completing their order.

You can toggle the following features in the system configuration to control the storefront guest users activity:

1. Enable :ref:`website access for guests <sys--conf--commerce--guest-access--global>` to allow guest customers interact with your website. When this option is disabled, the only page that unregistered users can access is the login page.

2. Enable or disable additional features that expand the capabilities of your guest visitors:

   * :ref:`Quick order form <user-guide--system-configuration--commerce-sales--quick-order-form>` --- promotes fast purchases through the quick access menu.

   * :ref:`Shopping lists <configuration-shopping-list>` --- gives a guest user the possibility to purchase a product by adding it to the shopping list. Keep in mind that only 1 shopping list is available for a guest customer, and it can be stored for up to 30 days in a single browser.

   * :ref:`Request for quote <user-guide--system-configuration--commerce-sales--rfq>` --- enables anonymous users to request a quote on the product items they are interested in from the shopping list page. For the option to work correctly, make sure you enable the *guest shopping list* feature mentioned before.

   * :ref:`Quotes <sys--conf--commerce--guest--enable--guest_quotes>` --- generates unique links that are used for sending quotes to guest users providing that a *website access for guests* and *guest checkout* are enabled for the guests to view and accept the quotes.

   * :ref:`Checkout <user-guide--system-configuration--commerce-sales-checkout>` --- supports anonymous checkouts that do not interrupt the purchase forcing to register an account. However, the guest users are still able to sign up for an account, if they wish, after completing the checkout. The checkout process for guest users is identical to the one for the registered users.

   * :ref:`Contacts <sys--conf--commerce--sales--contacts-global>` - enables to enter the necessary contact information that will be shown to unregistered visitors. Instead of providing your company's contacts to all anonymous customers, you may use this field to ask for registration and display the contact of your sales representatives who can handle any guest customers' issues.

.. image:: /user/img/concept-guides/guests/guest_functions.png
   :alt: All guest-related features that can be customized in the system configuration

Guest Product Visibility
------------------------

You can regulate which products, categories, nodes, or landing pages to display to your guest customers in the storefront by setting the necessary visibility restrictions (display or hide) to the **Non-Authenticated Visitors** customer group. This group represents all guest customers who visit your web store.

You can manage this behavior in several ways:

* :ref:`From the page of a required product <products--product-visibility>`. This way, you can selectively display the necessary product to guest customers, or hide it completely. It is useful when you sell a product to your partners only, and you do not want other retail customers to view it.

  .. image:: /user/img/concept-guides/guests/product_visibility.png
     :alt: Configure product visibility for guest customers

* :ref:`From the master catalog page <master-catalog-visibility>`. Here, you can combine the specific products which visibility you want to manage into one category (for example, *Guest Products*) and set the necessary restrictions to the whole category. This way, you are free to customize the way your categories are displayed in the storefront. For instance, you can hide the *Guest Products* category from your registered customers and only enable the *Non-Authenticated Visitors* segment to view the products from this category.

  .. image:: /user/img/concept-guides/guests/master_catalog_category_visibility.png
     :alt: Configure master catalog category visibility for guest customers

* :ref:`From a web catalog page <user-guide--marketing--web-catalog--customize>`. This setting follows the same configuration logic as for the master catalog. However, along with the visibility restrictions set to a web catalog node, you can also customize the visibility settings for a landing page and other content variants added to your web catalog.

  .. image:: /user/img/concept-guides/guests/web_catalog_visibility_restrictions.png
     :alt: Configure web catalog node visibility for guest customers

.. note:: Keep in mind that when setting the restrictions to the **Non-Authenticated Visitors** customer group, you disable other customer groups from viewing this node. It means that the *Guest Product* node is displayed exclusively to guest users, and once they register an account, they are no longer able to view this page. You can always add another condition to target the audience you need.

.. hint::
    If you experience issues with visibility configuration, make sure you read the following **visibility rules** and check if your settings are not overridden by other configuration with a higher priority:

         * The website visibility may be configured individually for each website. The visibility configured for a particular website has priority over the default website visibility.
         * The product visibility has priority over the category visibility. If the product is visible, but the category is hidden, the product is still visible.
         * The category visibility has a higher priority than the parent category.
         * The customer group visibility overrides visibility for a customer within the same website.

Guest Pricing
-------------

OroCommerce supports :ref:`pricing management <user-guide--pricing>` for retailers enabling you to create custom price lists for anonymous visitors of your website.

The prices for products aggregate the prices taken from the price lists enabled on the system, website, customer group, and customer levels based on the price selection strategy (*minimal price vs priority-based*).

For the non-registered users to view your custom prices in the storefront, you need to implement the following key steps:

1. Create a price list (e.g., *Retailers Price List*)
2. Assign retail prices to selected products.
3. Add a guest price list to the *Non-Authenticated Visitors* customer group to enable guests (and other visitors who belong to this group) to view custom product prices. You can also delete the assigned price list from the guest customer group to remove prices from the storefront.

   .. image:: /user/img/concept-guides/guests/retailers_price_list.png
      :alt: Add the retailers price list to the Non-Authenticated Visitors customer group

4. Consider the possible fallback configuration, if enabled, and :ref:`price selection strategy <sys--config--commerce--catalog--pricing>` that may override your current settings:

   With the *minimal price* strategy, the application founds the minimal price per tier from the list of available price lists to display it to guest users in the storefront.

   With the *merge by priority* strategy, OroCommerce selects the first price per tier from the list of available price lists based on the fallback configuration.

.. hint::
    * The fallback configuration logic for unregistered users is: **Non-Authenticated Visitors Customer Group Price List > Current Website PLs > Global PLs**. It means that if no matching price is found in the price list created for the guest customer group, the application goes further to the price lists configured on the website and system levels to fill in the missing product price.

    * For the registered users, the fallback chain is : **Current Customer PLs > Current Customer Group PLs > Current Website PLs > Global PLs**.


.. include:: /include/include-images.rst
   :start-after: begin




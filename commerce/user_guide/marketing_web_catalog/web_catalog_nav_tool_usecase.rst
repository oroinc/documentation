.. _user-guide--web-catalog-navigation-tool:

Use Web Catalog Nodes as Root Nodes (Example)
=============================================

.. contents:: :local:
   :depth: 1

You can select any content node as a root node for the OroCommerce storefront menu. This allows to display only the necessary sub-menu nodes in the storefront menu.

As an illustration, we are going to create a category and add it as a separate block on the storefront homepage as part of the featured menu. The block will lead to a product listing page with a number of discounted items. The product listing page will not be part of the main menu and will only be available via a link from the new featured menu block on the homepage (e.g., Special Offers).

To configure such behavior, follow the steps outlined in the sections below.

.. note:: The following illustration involves configuration options that may only be modified by an administrator or a person with the permissions to access system configuration settings.

Step 1: Configure the Navigation Root
-------------------------------------

Define the navigation root for the the main menu so that the only relevant categories are displayed in the storefront instead of the whole web catalog tree:

1. Navigate to **System > Websites > Routing** in the main menu.
#. In the :ref:`Navigation Root <sys--config--sysconfig--websites--routing>` field, select a content node as the root for building the navigation tree in the storefront.

   .. image:: /user_guide/img/marketing/web_catalogs/navigation_root/navigation_root_config.png
      :alt: Navigation root system configuration

#. Click **Save Settings** .

Once the navigation root scope is defined, the main menu in the storefront should display the sub-menus only from the selected navigation root range.

.. note:: Keep in mind that the *Navigation Root* option appears inn the routing configuration settings when you clear the **Use Default** check box next to the *Web Catalog* field, select the necessary web catalog from the list (if you have more than one), and click **Save Settings**.

Step 2: Add a Content Node
--------------------------

Create a new content node and add all the items eligible for your special offers:

1. Navigate to **Marketing > Web Catalogs** in the main menu.
#. Click **Create Content Node** outside of the *Navigation Root* range and provide it with a name (e.g. Special Offers). The URL slug is automatically generated but you can modify it, if necessary.

   .. image:: /user_guide/img/marketing/web_catalogs/navigation_root/content_node_outside_nav_root.png
      :alt: Creating a content node outside of the navigation root

#. In the **Content Variants** section, add *Product Collection* as a :ref:`content variant <user-guide--marketing--web-catalog--content-variant>` for the node you are creating, and populate it with the items for sale. In the example below, we have applied an existing `segment <https://oroinc.com/b2b-ecommerce/media-library/create-segments>`__ (New Arrivals/Lightning Products) to the product collection that we are adding as a content variant.

   .. note:: See the :ref:`Add a Product Collection (Web Catalog Content) <user-guide--marketing--web-catalog--content-variant-product-collection>` topic for more details.

   .. image:: /user_guide/img/marketing/web_catalogs/navigation_root/product_collection_segment.png
      :alt: Product collection content node

#. Click **Save**.

Step 3: Add a Frontend Menu Item
--------------------------------

Add a new menu item to the existing featured menu block in the storefront:

1. Navigate to **System > Frontend Menus** in the main menu.
#. Click once on the *featured_menu* item to open its page.
#. Click **Create Menu Item**.

   .. note:: See the :ref:`Edit a Frontend Menu <user-guide--system--menu--menu-frontend>` topic for more information on frontend menu configuration.

#. Name the menu item, and paste the URL slug of the content node you created in step 2 (e.g. /special-offers). Once you append the URL, clicking on this block on the homepage will lead to the collection of products on offer.

#. Add an icon or an image to the menu item (optional).

   .. image:: /user_guide/img/marketing/web_catalogs/navigation_root/new_frontend_menu_item_console.png
      :alt: A new frontend menu item added to the featured menu in the management console

#. Click **Save**.

   The block should now be displayed on the storefront homepage.

   .. image:: /user_guide/img/marketing/web_catalogs/navigation_root/featured_menu_block_storefront.png
      :alt: A new frontend menu item added to the featured menu in the storefront

   Clicking on the *Special Offers* block will redirect you to a dedicated page excluded from the main menu with a the collection of items selected for the sale.

   .. image:: /user_guide/img/marketing/web_catalogs/navigation_root/storefront_product_collection.png
      :alt: Special offers page in the storefront


**More on Web Catalogs**

* :ref:`Build a Custom Web Catalog From Scratch (Example) <user-guide--marketing--web-catalog--sample>`
* `Fundamental OroCommerce Training: Organize Products in a Web Catalog <https://oroinc.com/b2b-ecommerce/course/fundamental-orocommerce>`__
* `OroCommerce's Video Tutorial: How to Create a web Catalog <https://www.youtube.com/watch?v=SlW73esqBpk>`__
* `OroCommerce Blog: Customizable Web Catalogs in OroCommerce <https://oroinc.com/b2b-ecommerce/blog/training-thursday-customizable-web-catalogs-orocommerce>`__

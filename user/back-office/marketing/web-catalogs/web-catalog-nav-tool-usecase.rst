.. _user-guide--web-catalog-navigation-tool:

Use Web Catalog Nodes as Root Nodes (Example)
=============================================

You can select any content node as a root node for the OroCommerce storefront menu. This enables you to display only the necessary sub-menu nodes in the storefront menu.

As an illustration, we will create a new category (*New Arrivals*) and add it to the quick links menu in the storefront. The block will lead to a product collection page with new arrivals. The product listing page will not be part of the main menu and will only be available via a link from the quick links menu on the homepage.

.. note:: The following illustration involves configuration options that may only be modified by an administrator or a person with permission to access system configuration settings.

Step 1: Configure the Navigation Root
-------------------------------------

Define the navigation root for the main menu so that the only relevant categories are displayed in the storefront instead of the whole web catalog tree:

1. Navigate to **System > Websites > Routing** in the main menu.
2. In the :ref:`Navigation Root <sys--config--sysconfig--websites--routing>` field, select a content node as the root for building the navigation tree in the storefront.

   .. note:: The *Navigation Root* option appears in the routing configuration settings when you clear the **Use Default** checkbox next to the *Web Catalog* field, select the necessary web catalog from the list (if you have more than one), and click **Save Settings**.

3. Click **Save Settings**.

.. image:: /user/img/marketing/web_catalogs/navigation_root/navigation_root_config.png
   :alt: Navigation root system configuration

Once the navigation root scope is defined, the main menu in the storefront should display the sub-menus only from the selected navigation root range.

.. image:: /user/img/marketing/web_catalogs/navigation_root/navigation_root_config-storefront.png
   :alt: Navigation root in the storefront



Step 2: Add a Content Node
--------------------------

Create a new content node and add all the items eligible for your special offers:

1. Navigate to **Marketing > Web Catalogs** in the main menu.
#. Click **Create Content Node** outside of the *Navigation Root* range and provide it with a name (e.g., New Arrivals). The URL slug is automatically generated, but you can modify it if necessary.

   .. image:: /user/img/marketing/web_catalogs/navigation_root/content_node_outside_nav_root.png
      :alt: Creating a content node outside of the navigation root

#. In the **Content Variants** section, add *Product Collection* as a :ref:`content variant <user-guide--marketing--web-catalog--content-variant>` for the node you are creating, and populate it with the items for sale. In the example below, we have applied an existing |segment| (New Arrivals) to the product collection we are adding as a content variant.

   .. note:: See the :ref:`Add a Product Collection (Web Catalog Content) <user-guide--marketing--web-catalog--content-variant-product-collection>` topic for more details.

   .. image:: /user/img/marketing/web_catalogs/navigation_root/content-node-segment.png
      :alt: Product collection content node

#. Click **Save**.

Step 3: Add a Storefront Menu Item
----------------------------------

We are now going to add the newly created content node with New Arrivals to the quick access menu, next to the Quick Order Button. You can, of course, add it to any other relevant menu of the storefront theme.

1. Navigate to **System > Storefront Menus** in the main menu.

#. Click once on the *commerce_quick_access_refreshing_teal* item to open its page.

#. Click **Create Menu Item**.

   .. note:: See the :ref:`Edit a Storefront Menu <user-guide--system--menu--menu-frontend>` topic for more information on storefront menu configuration.

#. Name the menu item, set the Target Type to **Content Node**, and click on the new node (New Arrivals) in the tree to select it.
#. Click **Save**.


.. image:: /user/img/marketing/web_catalogs/navigation_root/add-node-to-menu-item.png

Step 4: Add Menu Item to Selected Storefront Theme
--------------------------------------------------

We can now connect the *commerce_quick_access_refreshing_teal* to a storefront menu.

1. Navigate to **System > Theme Configuration**.
2. For the **Quick Links Menu** option, select *commerce_quick_access_refreshing_teal* from the dropdown.
3. Click **Save and Close**.

The New Arrivals menu item should now be available in the storefront and contain the product collection from the New Arrivals segment.

.. image:: /user/img/marketing/web_catalogs/navigation_root/content-node-storefront.png
   :alt: Product collection content node in the quick access menu in the storefront

**More on Web Catalogs**

* :ref:`Build a Custom Web Catalog From Scratch (Example) <user-guide--marketing--web-catalog--sample>`
* |Fundamental OroCommerce Online Course|
* |Content Management Online Course|
* |OroCommerce's Video Tutorial: How to Create a web Catalog|
* |OroCommerce Blog: Customizable Web Catalogs in OroCommerce|


.. include:: /include/include-links-user.rst
   :start-after: begin
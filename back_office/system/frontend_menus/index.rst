.. _backend-frontend-menus:

Frontend Menus
==============

In this section, you will learn the menu types available for the OroCommerce storefront and how to configure them.

.. contents:: :local:
    :depth: 3

Frontend Menus Overview
-----------------------

All the OroCommerce storefront menus are located in the main menu under **System > Frontend Menus**.

.. image:: /img/system/frontend_menu/all_frontend_menus.png

Frontend_menu
^^^^^^^^^^^^^

A **frontend_menu** is a main menu on the customer/partner portal.

.. image:: /img/system/frontend_menu/FrontendMenu.png

Commerce_top_nav
^^^^^^^^^^^^^^^^

A **commerce_top_nav** menu defines the links that appear at the top right of the page.

.. image:: /img/system/frontend_menu/FrontendTopNavMenu.png

Commerce_quick_access
^^^^^^^^^^^^^^^^^^^^^

A **commerce_quick_access** menu provides quick access to the most frequent or important actions.

.. image:: /img/system/frontend_menu/FrontendQuickAccessMenu.png

Commerce_main_menu
^^^^^^^^^^^^^^^^^^

A **commerce_main_menu** defines the static content of the OroCommerce storefront main menu. The leading part of the menu is generated based on the structure of the website web catalog or master catalog. The trailing part is composed of the **commerce_main_menu** items.

.. image:: /img/system/frontend_menu/FrontendMainMenu.png

Commerce_footer_links
^^^^^^^^^^^^^^^^^^^^^

A **commerce_footer_links** defines the structure of the links in the OroCommerce website page footer.

.. image:: /img/system/frontend_menu/FrontendFooterMenu.png

Featured_menu
^^^^^^^^^^^^^

A **featured_menu** is a storefront menu that enables the administrator to configure the featured menu items on the homepage.

.. image:: /img/system/frontend_menu/featured_menu.png

Customer_usermenu
^^^^^^^^^^^^^^^^^

A **customer_usermenu** is a storefront user menu that defines what a customer will see within it. The menu is customizable via the **customer_usermenu** and **oro_customer_menu**, and the way it is displayed can be configured globally, on organization, and website levels.

.. note:: * When *Show all items at once* is selected, the user menu has the following look in the storefront:

             .. image:: /img/system/frontend_menu/ShowAllItemsAtOnce.png

          * When *Show subitems in a popup* is selected, the user menu has the following look in the storefront:

             .. image:: /img/system/frontend_menu/ShowSubitemsInPopup.png

To configure user menu globally:

1. Navigate to **System > Configuration** in the main menu.
2. Click **Commerce > Design > Theme** in the panel on the left.
3. In the **Menu Templates** section, select to *Show all items at once* (the default template) or *Show subitems in a popup*.

To configure user menu on the organization level:

1. Navigate to the system configuration (click **System > User Management > Organization** in the main menu).
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Design > Theme** in the menu to the left.
4. In the **Menu Templates** section, select the appropriate look of the customer usermenu.

To configure user menu on the website level:

1. Navigate to the system configuration (click **System > Websites** in the main menu).
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Design > Theme** in the menu on the left.
4. In the **Menu Templates** section, select the appropriate look of the customer usermenu.

Oro_customer_menu
^^^^^^^^^^^^^^^^^

An **oro_customer_menu** is a storefront menu that defines what options the Account section of the user menu is populated with.

.. image:: /img/system/frontend_menu/AccMenu.png


Permissions Required to Customize Frontend Menus
------------------------------------------------

The ability to configure menus globally, per organization, and for personal use is controlled by the two capabilities: **Manage Menus** and **Access system configuration**.

By default, only users with Admin role have these capabilities enabled and may customize menus on all configuration levels.

To enable a user to personalise menus for themselves and configure menus for each organization individually, include the **Manage Menus** capability into the user role.

To enable a user to configure menus globally, for all organizations, websites, and users whose configuration fall back to the global settings, both **Manage Menus** and **Access system configuration** capabilities should be enabled for the user role.


.. _doc--system--menu--config-levels--frontend-menus:

Frontend Menus Configuration
----------------------------

In the Oro applications, you can customize the storefront menus look, and the elements they contain globally, per organization, per website, per customer, and per customer group.

.. note::
    See a short demo on `how to customize storefront menus in OroCommerce <https://www.oroinc.com/orocommerce/media-library/customize-front-end-menus>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/nNPLsSOUc1c" frameborder="0" allowfullscreen></iframe>

Customize Frontend Menus Globally
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To customize one of the default storefront menus (e.g., commerce_main_menu) or customer/partner portal menus (e.g., customer_usermenu):

1. Navigate to **System > Frontend Menus** in the main menu.
2. Click on the menu you would like to edit.
3. Update the menu contents following the guidelines provided in the :ref:`Edit a Frontend Menu <user-guide--system--menu--menu-frontend>` section.
   The changes apply automatically.

Customize Frontend Menus per Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. note:: This option is available in the Enterprise edition only.

To customize one of the storefront menus (e.g., commerce_main_menu) or customer/partner portal menus (e.g., customer_usermenu) for a particular organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. Click on the organization you would like to edit the menu for.
3. Click |IcConfig| **Edit Frontend Menu**.
4. Update the menu contents following the guidelines provided in the :ref:`Edit a Frontend Menu <user-guide--system--menu--menu-frontend>` section.
   The changes apply automatically.

Customize Frontend Menus per Website
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. note:: This option is available in the Enterprise edition only.

To customize one of the storefront menus (e.g., commerce_main_menu) or customer/partner portal menus (e.g., customer_usermenu) for a particular website:

1. Navigate to **System > Websites** in the main menu.
2. Click on the website you would like to edit the menu for.
3. Click |IcConfig| **Edit Frontend Menu**.
4. Update the menu contents following the guidelines provided in the :ref:`Edit a Frontend Menu <user-guide--system--menu--menu-frontend>` section.
   The changes apply automatically.

Customize Frontend Menus per Customer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To customize one of the storefront menus (e.g., commerce_main_menu) or customer/partner portal menus (e.g., customer_usermenu) for a particular customer:

1. Navigate to **Customers > Customers** in the main menu.
2. Click on the customer you would like to edit the menu for.
3. Click |IcConfig| **Edit Frontend Menu**.
4. Update the menu contents following the guidelines provided in the :ref:`Edit a Frontend Menu <user-guide--system--menu--menu-frontend>` section.
   The changes apply automatically.

Customize Frontend Menus per Customer Group
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To customize one of the storefront menus (e.g., commerce_main_menu) or customer/partner portal menus (e.g., customer_usermenu) for the customers that belong to a particular customer group:

1. Navigate to **Customers > Customer Groups** in the main menu.
2. Click on the customer group you would like to edit the menu for.
3. Click |IcConfig| **Edit Frontend Menu**.
4. Update the menu contents following the guidelines provided in the :ref:`Edit a Frontend Menu <user-guide--system--menu--menu-frontend>` section.
   The changes apply automatically.

.. _user-guide--system--menu--menu-frontend:

Frontend Menus Management
-------------------------

A frontend menu may be multi-level like, and the child menu items are nested under parent menu items (e.g., **About**, **Customer Service**, **Privacy Policy**, and others are nested under **Information**).

.. image:: /img/system/frontend_menu/frontend_menu_2.png

Menu items on the same level of hierarchy may be visually separated by a divider that looks like a horizontal line and helps you logically organize menu items. However, some menus do not support displaying dividers (on a particular level in the tree, or in general).

.. image:: /img/system/menus/user_menu.png


Edit a Frontend Menu
^^^^^^^^^^^^^^^^^^^^

.. include:: menu_frontend.rst
   :start-after: start
   :end-before: finish

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   menu_frontend
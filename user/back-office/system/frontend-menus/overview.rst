:oro_documentation_types: commerce

.. _frontend-menus-overview:

Frontend Menus Overview
-----------------------

All the OroCommerce storefront menus are located in the main menu under **System > Frontend Menus**.

.. image:: /user/img/system/frontend_menu/all_frontend_menus.png

frontend_menu
^^^^^^^^^^^^^

A **frontend_menu** is a main menu on the customer/partner portal.

.. image:: /user/img/system/frontend_menu/FrontendMenu.png

commerce_top_nav
^^^^^^^^^^^^^^^^

A **commerce_top_nav** menu defines the links that appear at the top right of the page.

.. image:: /user/img/system/frontend_menu/FrontendTopNavMenu.png

commerce_quick_access
^^^^^^^^^^^^^^^^^^^^^

A **commerce_quick_access** menu provides quick access to the most frequent or important actions.

.. image:: /user/img/system/frontend_menu/FrontendQuickAccessMenu.png

commerce_main_menu
^^^^^^^^^^^^^^^^^^

A **commerce_main_menu** defines the static content of the OroCommerce storefront main menu. The leading part of the menu is generated based on the structure of the website web catalog or master catalog. The trailing part is composed of the **commerce_main_menu** items.

.. image:: /user/img/system/frontend_menu/FrontendMainMenu.png

commerce_footer_links
^^^^^^^^^^^^^^^^^^^^^

A **commerce_footer_links** defines the structure of the links in the OroCommerce website page footer.

.. image:: /user/img/system/frontend_menu/FrontendFooterMenu.png

featured_menu
^^^^^^^^^^^^^

A **featured_menu** is a storefront menu that enables the administrator to configure the featured menu items on the homepage.

.. image:: /user/img/system/frontend_menu/featured_menu.png

customer_usermenu
^^^^^^^^^^^^^^^^^

A **customer_usermenu** is a storefront user menu that defines what a customer will see within it. The menu is customizable via the **customer_usermenu** and **oro_customer_menu**, and the way it is displayed can be configured globally, on organization, and website levels.

.. note:: * When *Show all items at once* is selected, the user menu has the following look in the storefront:

             .. image:: /user/img/system/frontend_menu/ShowAllItemsAtOnce.png

          * When *Show subitems in a popup* is selected, the user menu has the following look in the storefront:

             .. image:: /user/img/system/frontend_menu/ShowSubitemsInPopup.png

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

oro_customer_menu
^^^^^^^^^^^^^^^^^

An **oro_customer_menu** is a storefront menu that defines what options the Account section of the user menu is populated with.

.. image:: /user/img/system/frontend_menu/AccMenu.png

.. include:: /include/include-images.rst
   :start-after: begin

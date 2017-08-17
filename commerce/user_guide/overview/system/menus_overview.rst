Overview
========

.. begin

OroCRM and OroCommerce Management Console Menus
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
.. contents:: :local:
   :depth: 1

Navigation Bar
""""""""""""""

The **application_menu** is the main menu of the Management Console in Oro application. It resides on the top of every application page and you can use it to navigate through Oro application. Subject to configuration, it may be displayed horizontally or vertically. To toggle the way it is displayed, navigate to the **System > Configuration** section using the main menu, and open **System configuration > General Setup > Display Settings** in the panel to the left. In the **Navigation Bar** section, unselect the **Use Default** option and select the *Top* or *Left* position.

In the latter case, the menu items are displayed as icons. For more information, see :ref:`Main Menu <user-guide-navigation-menu>`.

In a top position, Application Menu (Navigation Bar) looks like a top menu with a drop-down sub-menus that expand once you hover over the parent item:

.. image:: /user_guide/img/system/menus/ApplicationMenu.png

In a left position, Application Menu (Navigation Bar) may be collapsed into the icon bar:

.. image:: /user_guide/img/system/menus/ApplicationMenuVertical.png

or expanded for visible labels and sub-menu items:

.. image:: /user_guide/img/system/menus/ApplicationMenuVerticalExpanded.png

Shortcuts
"""""""""

You can find **shortcuts** menu in the top panel of the application, next to the organization name.

.. image:: /user_guide/img/system/menus/shortcut_full.png

It helps you pin the frequently used actions and have them handy. You can launch an action by clicking it in the dynamically generated **Most Used Actions** list. This list is updated as you are using the system, and will initially contain the actions that you use the most.

To access other shortcuts, click **See the full list** to see complete list of shortcut items or use search: start typing the name of a related entity or an action to choose from a list of matching items.

.. image:: /user_guide/img/system/menus/shortcut_full.png

User Menu
"""""""""

In Management Console, user can access their profile configuration, emails, tasks and events via a **usermenu** (by clicking on your name on the top right of the application).

.. image:: /user_guide/img/system/menus/user_menu.png

Calendar Menu
"""""""""""""

A **calendar_menu** is a service menu that is used on the **My Calendar** page and helps to change the displayed calendar color, hide or remove a calendar.

.. image:: /user_guide/img/system/menus/menus_calendar_menu.png

OroCommerce Front Store Menus
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. contents:: :local:
   :depth: 1

Top Links
"""""""""

A **commerce_top_nav** menu defines the links that appear at the top right of the page.

.. image:: /user_guide/img/system/frontend_menu/FrontendTopNavMenu.png

Quick Access
""""""""""""

A **commerce_quick_access** menu provides quick access to the most frequent or important actions.

.. image:: /user_guide/img/system/frontend_menu/FrontendQuickAccessMenu.png

Navigation Bar
""""""""""""""

A **commerce_main_menu** defines the static content of the OroCommerce Front Store main menu. The leading part of the menu is generated based on the structure of the website web catalog or master catalog. The trailing part is composed of the **commerce_main_menu** items.

.. image:: /user_guide/img/system/frontend_menu/FrontendMainMenu.png

Footer Links
""""""""""""

A **commerce_footer_links** defines the structure of the links in the OroCommerce website page footer.

.. image:: /user_guide/img/system/frontend_menu/FrontendFooterMenu.png

User and Account Menu Look and Feel
"""""""""""""""""""""""""""""""""""

Front store user menu is customizable via the `Customer User Menu`_ and `Account Menu`_, and the way it is displayed can be configured globally, on organization, and website levels.

.. image:: /user_guide/img/system/frontend_menu/ShowAllItemsAtOnce.png

To configure user menu globally:

1. Navigate to **System > Configuration** in the main menu.
2. Click **Commerce > Design > Theme** in the panel on the left.
3. In the **Menu Templates** section you have the following templates for user menu - *Show all items at once* (the default template) and *Show subitems in a popup*.

To configure user menu on the organization level:

1. Navigate to the system configuration (click **System > User Management > Organization** in the main menu).
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Design > Theme** in the menu to the left.
4. In the **Menu Templates** section you have the following templates for user menu - *Show all items at once* (the default template) and *Show subitems in a popup*.


To configure user menu on the website level:

1. Navigate to the system configuration (click **System > Websites** in the main menu).
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Design > Theme** in the menu on the left.
4. In the **Menu Templates** section you have the following templates for user menu - *Show all items at once* (the default template) and *Show subitems in a popup*.

.. note:: * When *Show all items at once* is selected, the user menu has the following look in the front store:

             .. image:: /user_guide/img/system/frontend_menu/ShowAllItemsAtOnce.png

          * When *Show subitems in a popup* is selected, the user menu has the following look in the font store:

             .. image:: /user_guide/img/system/frontend_menu/ShowSubitemsInPopup.png

Customer User Menu
""""""""""""""""""

A **customer_usermenu** is a front store user menu that defines what a customer will see within it.

.. note:: It is only active when user menu template is set to *Show subitems in a popup* in system, organization, or website configuration.

         .. image:: /user_guide/img/system/frontend_menu/UserMenu2.png

Account Menu
""""""""""""

An **oro_customer_menu** is a front store menu that defines what options the Account section of the user menu is populated with.

.. image:: /user_guide/img/system/frontend_menu/AccMenu.png

.. OroCRM Customer/Partner Portal Menus
   ^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
   .. contents:: :local:
      :depth: 1
      Main Menu
      """""""""
      A **frontend menu** is a main menu on the customer/partner portal.
      .. image:: /user_guide/img/system/frontend_menu/FrontendMenu.png
      User Menu
      """""""""
      A **customer_usermenu** is a user menu on the customer/partner portal.
      .. image:: /user_guide/img/system/frontend_menu/FrontendCustomerMenu.png

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin


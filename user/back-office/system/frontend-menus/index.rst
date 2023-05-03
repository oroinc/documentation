:oro_documentation_types: OroCommerce

.. _backend-frontend-menus:
.. _frontend-menus-overview:
.. _doc--system--menu--config-levels--frontend-menus:
.. _frontend-menu-globally:

Configure Storefront Menus in the Back-Office
=============================================

.. hint:: This section is part of the :ref:`Storefront and Back-Office Menu Management Concept Guide <menu-management-concept-guide>` topic that provides a general understanding of the available storefront and back-office menu types and their management in Oro applications.

Storefront menu in OroCommerce allows users to navigate your website and easily access product collections, their account, shopping cart, and other essential information. There are several types of menus available for the storefront, described in the :ref:`Storefront Menu Components section <menu-management-concept-guide>`.

.. image:: /user/img/system/frontend_menu/frontend_menu_1.png
   :alt: A list of all storefront menu items

You can customize the way your storefront menus look globally (see below), per organization, per website, per customer, and per customer group.

To configure a default storefront menu globally:

1. Navigate to **System > Frontend Menus** in the main menu.
2. Click on the menu you would like to edit.
3. Update the menu contents following the guidelines provided in the :ref:`Edit a Storefront Menu <user-guide--system--menu--menu-frontend>` section.
   The changes apply automatically.

To learn how to configure them on other levels, follow the links below:

* :ref:`Customize Storefront Menus per Organization <frontend-menu-organization>`
* :ref:`Customize Storefront Menus per Website <frontend-menus-website>`
* :ref:`Customize Storefront Menus per Customer <frontend-menus-customer>`
* :ref:`Customize Storefront Menus per Customer Group <frontend-menus-customer-group>`

Configure Permissions to Customize Storefront Menus
---------------------------------------------------

The ability to configure menus globally, per organization, and for personal use is controlled by the two capabilities: **Manage Menus** and **Access system configuration**.

By default, only users with the Admin role have these capabilities enabled and may customize menus on all configuration levels.

To enable a user to personalise menus for themselves and configure menus for each organization individually, include the **Manage Menus** capability into the user role.

To enable a user to configure menus globally, for all organizations, websites, and users whose configuration fall back to the global settings, both **Manage Menus** and **Access system configuration** capabilities should be enabled for the user role.

.. image:: /user/img/concept-guides/menus/menus_capabilities.png
   :alt: Capabilities that must be enabled for the role to be allowed to manage storefront menus

Change a Storefront Menu
------------------------

To learn how to manage a storefront menu and create new menu items, see :ref:`Change a Storefront Menu <user-guide--system--menu--menu-frontend>`.

Add All Products Page to Menus Globally
---------------------------------------

To learn how to add  All Products Page  to a storefront menu globally after enabling it in, see :ref:`Add All Products Page to Storefront Menus <sys--conf--frontend-menus--all-products--global>`

.. toctree::
   :maxdepth: 2
   :hidden:

   edit-frontend-menu
   global-all-products-menus


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
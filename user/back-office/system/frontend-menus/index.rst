:oro_documentation_types: OroCommerce

.. _backend-frontend-menus:
.. _frontend-menus-overview:

Configure Storefront Menus in the Back-Office
=============================================

.. hint:: This section is a part of the :ref:`Storefront and Back-Office Menu Management Concept Guide <menu-management-concept-guide>` topic that provides the general understanding of the available storefront and back-office menu types and their management in Oro applications.

In this section, you will learn how to edit and configure the storefront menu components in OroCommerce.

All the OroCommerce storefront menus are located in the main menu under **System > Frontend Menus**.

.. image:: /user/img/system/frontend_menu/frontend_menu_1.png
   :alt: A list of all storefront menu items

Each menu type has a different purpose that is described in detail in the :ref:`Storefront and Back-Office Menu Management Concept Guide <menu-management-concept-guide>`.

Permissions Required to Customize Storefront Menus
--------------------------------------------------

The ability to configure menus globally, per organization, and for personal use is controlled by the two capabilities: **Manage Menus** and **Access system configuration**.

By default, only users with Admin role have these capabilities enabled and may customize menus on all configuration levels.

To enable a user to personalise menus for themselves and configure menus for each organization individually, include the **Manage Menus** capability into the user role.

To enable a user to configure menus globally, for all organizations, websites, and users whose configuration fall back to the global settings, both **Manage Menus** and **Access system configuration** capabilities should be enabled for the user role.

.. image:: /user/img/concept-guides/menus/menus_capabilities.png
   :alt: Capabilities that must be enabled for the role to be allowed to manage storefront menus

.. _doc--system--menu--config-levels--frontend-menus:
.. _frontend-menu-globally:

Storefront Menus Configuration
------------------------------

In the Oro applications, you can customize the storefront menus look, and the elements they contain globally (see below), per organization, per website, per customer, and per customer group.

.. note::
    See a short demo on |how to customize storefront menus in OroCommerce| or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/nNPLsSOUc1c" frameborder="0" allowfullscreen></iframe>

To configure a default storefront menu globally:

1. Navigate to **System > Frontend Menus** in the main menu.
2. Click on the menu you would like to edit.
3. Update the menu contents following the guidelines provided in the :ref:`Edit a Storefront Menu <user-guide--system--menu--menu-frontend>` section.
   The changes apply automatically.


* :ref:`Customize Storefront Menus per Organization <frontend-menu-organization>`
* :ref:`Customize Storefront Menus per Website <frontend-menus-website>`
* :ref:`Customize Storefront Menus per Customer <frontend-menus-customer>`
* :ref:`Customize Storefront Menus per Customer Group <frontend-menus-customer-group>`


Storefront Menu Management
--------------------------

.. include:: /user/back-office/system/frontend-menus/edit-frontend-menu.rst
   :start-after: begin_include
   :end-before: finish_include

Add All Products Page to Storefront Menus Globally
--------------------------------------------------

.. include:: /user/back-office/system/frontend-menus/global-all-products-menus.rst
   :start-after: begin_include
   :end-before: finish_include



.. toctree::
   :maxdepth: 2
   :hidden:

   edit-frontend-menu
   global-all-products-menus

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
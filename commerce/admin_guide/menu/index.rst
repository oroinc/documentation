.. _doc-config-menus:

.. similar to CRM  > Admin Guide > App Look and Feel > Menu Config

Menus Configuration
-------------------

In this section you will learn how to configure the menus globally, per organization/website, or for your own use only. You also will learn the various kinds of menus in OroCommerce and OroCRM management console and OroCommerce storefront.

.. contents:: :local:
    :depth: 1

Menu Types Overview
^^^^^^^^^^^^^^^^^^^

.. contents:: :local:
    :depth: 1

.. include:: /admin_guide/menu/menus_overview.rst
   :start-after: begin
   :end-before: finish

Permissions Required to Customize Menus
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The ability to configure menus globally, per organization, and for personal use is controlled by the two capabilities: **Manage Menus** and **Access system configuration**.

By default, only users with Admin role have these capabilities enabled and may customize menus on all configuration levels.

To enable a user to personalise menus for themselves and configure menus for each organization individually, include the **Manage Menus** capability into the user role.

To enable a user to configure menus globally, for all organizations, websites, and users whose configuration fall back to the global settings, both **Manage Menus** and **Access system configuration** capabilities should be enabled for the user role.

Menu Configuration Levels
^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: menu_config_levels.rst
   :start-after: start_1
   :end-before: stop_1

.. include:: menu_config_levels.rst
   :start-after: start_2
   :end-before: stop_2

.. _doc-config-menus-menuspage:

Menu Management
^^^^^^^^^^^^^^^

On various :ref:`configuration levels <doc--menu-config-levels>`, the menu and frontend menu list looks the same and the flow for customizing any menu is similar.

On the menu list you can see the menus available for review or customization.

.. image:: /admin_guide/img/menus/Menus.png

.. contents:: :local:
    :depth: 1

.. _doc-config-menus-actions-expandorcollapse:
.. _doc-config-menus-actions-addmenuitem:
.. _doc-config-menus-actions-adddivider:
.. _doc-config-menus-actions-delete:
.. _doc-config-menus-actions-reset:
.. _doc-config-menus-actions-search:
.. _doc-config-menus-actions-show:
.. _doc-config-menus-actions-hide:
.. _doc-config-menus-actions-viewandedit:
.. _doc-config-menus-actions-hideorshowpanel:
.. _doc--menus--config:
.. _doc-config-menus-actions-draganddrop:

.. include:: menu_config.rst
   :start-after: begin_1
   :end-before: finish_1

.. include:: menu_config.rst
   :start-after: begin_2
   :end-before: finish_2

Related Topics
^^^^^^^^^^^^^^

* :ref:`Customize a Menu <doc-managing-app-menu>` in the Developer Guide

* :ref:`How to Create and Customize the Application Menu <doc-create-and-customize-app-menu>`

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   menu_config
   menu_config_levels
   menu_frontend
   menus_overview

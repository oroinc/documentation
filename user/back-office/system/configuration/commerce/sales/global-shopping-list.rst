:oro_documentation_types: OroCommerce
:oro_show_local_toc: false

.. _user-guide--system-configuration--commerce-sales-shopping-list--mass-action:
.. _user-guide--system-configuration--commerce-sales-shopping-list-global:
.. _configuration-shopping-list:
.. _user-guide--system-configuration--commerce-sales-shopping-list:

Configure Global Shopping List Settings
=======================================

Guest Shopping Lists
--------------------

You control whether to let unregistered customers purchase goods in the store by enabling or disabling :ref:`shopping lists <frontstore-guide--shopping-lists>`. This can be configured on three levels -- globally, :ref:`per organization <user-guide--system-configuration--commerce-sales-shopping-list-per-organization>` and :ref:`website <user-guide--system-configuration--commerce-sales-shopping-list-per-website>`.

By default, guest shopping lists are disabled. In addition, only 1 shopping list is available for guest customers.

.. note:: Please note that website settings override organization, organization settings override system settings.

.. begin

To enable guest shopping lists globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Sales > Shopping List** in the menu to the left.

   .. note::
     For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/sales/ShopListGlobal.png
      :alt: Global shopping list configuration settings

3. In the **Shopping List Limit** section, set the number of shopping lists allowed per customer. The default value is zero. This means that no limit of shopping lists is applied.
4. In the **Guest Shopping List** section, define the following options:

   .. note:: To update any of the options, clear *Use Default* check box first.

   * **Create Guest Shopping List** --- Set whether guests are allowed to create and manage shopping lists. By default, guest shopping lists are disabled.

   * **Create Guest Shopping Lists Immediately** --- Enable this option to automatically create shopping lists for all guest users once they access the storefront. By default, this option is disabled and shopping lists are created only when guest users add at least one item to their shopping list.

5. In the **Guest Shopping List Owner Settings** section, select the user who will be the default owner of all guest shopping lists. Depending on the roles and permissions of the owner, guest shopping lists may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest shopping lists, adjust permissions for the shopping list entity in their roles accordingly.

6. Click **Save Settings**.

.. finish

.. _user-guide--system-configuration--commerce-sales-shopping-list--mass-action--global:

Mass Product Actions
--------------------

In OroCommerce, you can control whether customer and guest users can select and add multiple products to a shopping list in the storefront. This can be enabled on three levels -- globally, :ref:`per organization <user-guide--system-configuration--commerce-sales-shopping-list--mass-action--organization>` and :ref:`per website <user-guide--system-configuration--commerce-sales-shopping-list--mass-action--website>`.

To enable mass product actions globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Shopping List** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/sales/MassProductActionsSListGlobal.png
      :alt: Global mass product actions configuration

3. In the **Shopping List Options** section, set whether customer users are allowed to mass select and add items to the shopping list.

   By default, mass product actions are enabled.

   To disable them, clear the *Use Default* and the *Enable Mass Adding on Product Listing* check boxes.

4. Click **Save Settings**.

.. finish_body

.. include:: /include/include-images.rst
   :start-after: begin
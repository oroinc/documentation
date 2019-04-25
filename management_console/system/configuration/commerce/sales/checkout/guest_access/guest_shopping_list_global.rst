.. _user-guide--system-configuration--commerce-sales-shopping-list-global:

Configure Guest Shopping Lists Globally
---------------------------------------

.. begin

To enable guest shopping lists globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Sales > Shopping List** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.


.. image:: /admin_guide/img/configuration/sales/shopping_list/ShopListGlobal.png

3. In the **Shopping List Limit** section, set the number of shopping lists allowed per customer. The default value is zero. This means that no limit of shopping lists is applied.
4. In the **Guest Shopping List** section, define the following options:
 
   .. note:: To update any of the options, clear *Use Default* check box first.

   * **Create Guest Shopping List** --- Set whether guests are allowed to create and manage shopping lists. By default, guest shopping lists are disabled. 

   * **Create Guest Shopping Lists Immediately** --- Enable this option to automatically create shopping lists for all guest users once they access the storefront. By default, this option is disabled and shopping lists are created only when guest users add at least one item to their shopping list.
   
5. In the **Guest Shopping List Owner Settings** section, select the user who will be the default owner of all guest shopping lists. Depending on the roles and permissions of the owner, guest shopping lists may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest shopping lists, adjust permissions for the shopping list entity in their roles accordingly.

6. Click **Save Settings**.

.. finish

:orphan:

.. _user-guide--system-configuration--commerce-sales-shopping-list-per-organization:

Configure Guest Shopping Lists per Organization
-----------------------------------------------

.. begin


To enable guest shopping lists per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Shopping List** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /user_guide/img/system/configuration/sales/shopping_list/ShopListOrg.png

4. In the **Shopping List Limit** section, set the number of shopping lists allowed per customer. The default value is zero. This means that no limit of shopping lists is applied.
5. In the **Guest Shopping List** section, set whether guests are allowed to create and manage shopping lists.

   By default, guest shopping lists are disabled.

   To enable guest shopping lists, clear *Use System* and select the *Enable Guest Shopping List* check box.

6. In the **Guest Shopping List Owner Settings** section, select the user who will be the default owner of all guest shopping lists. Depending on the roles and permissions of the owner, guest shopping lists may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest shopping lists, adjust permissions for the shopping list entity in their roles accordingly.

7. Click **Save Settings**.

.. note:: When **Use System** check box is enabled, :ref:`system settings <user-guide--system-configuration--commerce-sales-shopping-list-global>` are applied.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin


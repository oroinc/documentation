:oro_documentation_types: OroCommerce

.. _user-guide--system-configuration--commerce-sales-shopping-list-per-organization:
.. _user-guide--system-configuration--commerce-sales-shopping-list--mass-action--organization:

Configure Shopping List Settings per Organization
=================================================

In the Shopping List section of Commerce configuration settings, you to set various options for a shopping list, control whether to let unregistered customers purchase goods in the store, set the number of shopping lists allowed per customer, enable a shopping list section under the My Account menu, and more.

This can be configured on three levels -- :ref:`globally <user-guide--system-configuration--commerce-sales-shopping-list--mass-action>`, per organization, and :ref:`website <user-guide--system-configuration--commerce-sales-shopping-list-per-website>`.

To configure the shopping lists per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Shopping List** in the menu to the left.

   .. note::
        For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/sales/shopping_list_org_config.png
      :alt: Shopping list configuration per organization

4. Clear the **Use System** check box to change the global setting.

5. In the **Shopping List Limit** section, set the number of shopping lists allowed per customer. The default value is zero. This means that no limit of shopping lists is applied.
6. In the **Guest Shopping List** section, define the following options:

   * **Enable Guest Shopping List** --- Set whether guests are allowed to create and manage shopping lists. By default, guest shopping lists are disabled. In addition, only 1 shopping list is available for guest customers.

   * **Create Guest Shopping Lists Immediately** --- Enable this option to automatically create shopping lists for all guest users once they access the storefront. By default, this option is disabled and shopping lists are created only when guest users add at least one item to their shopping list.

7. In the **Guest Shopping List Owner Settings** section, select the user who will be the default owner of all guest shopping lists. Depending on the roles and permissions of the owner, guest shopping lists may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest shopping lists, adjust permissions for the shopping list entity in their roles accordingly.

8. In the **Shopping List Options** section, set the following options:

   * **Enable Mass Adding On Product Listing** --- The options controls whether customer and guest users are allowed to mass select and add items to the shopping list in the storefront.

|

   .. hint:: The features below are available since OroCommerce v4.1.10. To check which application version you are running, see the :ref:`system information <system-information>`.

   * **Enable "Shopping Lists" Page In "My Account"** --- The option enables the Shopping List section under the My Account menu with a new design for the shopping list page. The section stores all the information about current shopping lists that the customer user has access to. By default, the page is preconfigured to display only the shopping lists that the user owns, but you can always reset the filter and select the required conditions. The user can view and update the shopping lists, provided that they have the :ref:`appropriate permissions <frontstore-guide-roles>` enabled.

    .. image:: /user/img/system/config_commerce/sales/new_shopping_list_section.png
       :alt: A new shopping list section under the My Account menu in the storefront

   * **Use New Layout For Shopping List View And Edit Pages** --- With this option enabled, a new design is used for the shopping list view and edit pages by default. For the option to work, make sure to enable the previous option (*"Shopping Lists" page in "My Account"*).

   * **Maximum Line Items Per Page** --- The maximum shopping list line items that can be displayed per page in the new shopping list layout. If the number of shopping list line items exceeds this value, then the "All" value, in the list of pagination dropdown values, is changed to the one specified in the option.

   * **Show All Lists In Shopping List Widget** --- The option defines which shopping lists a customer user can view in the widget. If this option is enabled, the user can view all the shopping lists that they are allowed to access, besides their own. For instance, a user can own one shopping list, which is reflected in the Shopping List section under My Account, while the widget will display four shopping lists assigned to other users but available to view and edit by the selected user.

    .. image:: /user/img/system/config_commerce/sales/show_all_lists_in_widget.png
       :alt: Illustration of the mentioned sample

9. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin


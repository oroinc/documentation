:oro_documentation_types: OroCommerce

.. _user-guide--system-configuration--commerce-sales--quick-order-form--organization:

Configure Quick Order Form Settings per Organization
====================================================

Registered and unregistered customers can use a quick order form for fast purchases in the Oro storefront. By default, quick order form is enabled, while optimized quick order and guest quick order form are disabled. You can configure the quick form functionality on three levels – :ref:`globally <user-guide--system-configuration--commerce-sales--quick-order-form--global>`, per organization, and :ref:`per website <user-guide--system-configuration--commerce-sales--quick-order-form--website>`.

.. note:: Please note that website settings override organization, organization settings override system settings.

To configure the quick order form for registered and unregistered users per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Quick Order Form** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/user_management/org_configuration/sales/org_quick_order_form.png
   :alt: Configure quick order form per organization

4. Clear the **Use System** checkbox to override the system-wide configuration options.

5. In the **Quick Order Form** section:

   * **Enable Quick Order Form** --- enable or disable the quick order form functionality for the registered users. By default the quick order form is enabled.
   * **Enable Optimized Quick Order Form** --- enable optimized quick order form when you upload over 1000 products per order. By default, the optimized order form is disabled. The feature is available starting from OroCommerce Enterprise v5.0.8. To check which application version you are running, see the :ref:`system information <system-information>`.

6. In the **Guest Quick Order Form** section, set whether guests are allowed to create a quick order form. By default, the guest quick order form is disabled.

7. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

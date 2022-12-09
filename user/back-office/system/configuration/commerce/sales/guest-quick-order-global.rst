:oro_documentation_types: OroCommerce

.. _user-guide--system-configuration--commerce-sales--quick-order-form--global:
.. _user-guide--system-configuration--commerce-sales--quick-order-form:


Configure Global Quick Order Form Settings
==========================================

Registered and unregistered customers can use a quick order form for fast purchases in the Oro storefront. By default, quick order form is enabled, while optimized quick order and guest quick order form are disabled. You can configure the quick form functionality and its options on three levels – globally, :ref:`per organization <user-guide--system-configuration--commerce-sales--quick-order-form--organization>` and :ref:`per website <user-guide--system-configuration--commerce-sales--quick-order-form--website>`.

.. note:: Please note that website settings override organization, organization settings override system settings.

.. begin_quick_order_form

To configure the quick order form globally for registered and unregistered users:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Quick Order Form** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/sales/QOFGlobal.png
   :alt: Global quick order form configuration

3. Clear the **Use Default** checkbox to override the default configuration options.

4. In the **Quick Order Form** section:

   * **Enable Quick Order Form** --- enable or disable the quick order form functionality for the registered users. By default the quick order form is enabled.
   * **Enable Optimized Quick Order Form** --- enable optimized quick order form when you upload over 1000 products per order. By default, the optimized order form is disabled.

6. In the **Guest Quick Order Form** section, set whether guests are allowed to create a quick order form. By default, the guest quick order form is disabled.

7. Click **Save Settings**.

.. finish_quick_order_form
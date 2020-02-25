:oro_documentation_types: OroCommerce

.. _user-guide--system-configuration--commerce-sales--quick-order-form--global:
.. _user-guide--system-configuration--commerce-sales--quick-order-form:


Quick Order Form
================

Registered and unregistered customers can use a quick order form for fast purchases in the Oro storefront. By default, quick order form is enabled, while guest quick order form is disabled. You can enable the latter on three levels – globally, :ref:`per organization <user-guide--system-configuration--commerce-sales--quick-order-form--organization>` and :ref:`per website <user-guide--system-configuration--commerce-sales--quick-order-form--website>`.

.. note:: Please note that website settings override organization, organization settings override system settings.

.. begin_quick_order_form

To enable the quick order form globally for registered and unregistered users:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Quick Order Form** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/sales/QOFGlobal.png

3. In the **Quick Order Form** section, enable or disable the quick order form:

   * By default, the guest quick order is enabled.
   * To disable it, clear the *Use Default* first and *Enable Quick Order Form* next.

3. In the **Guest Quick Order Form** section, set whether guests are allowed to create a quick order form.

   * By default, the guest quick order form is disabled.
   * To enable it, clear the *Use Default* and select the *Enable Guest Quick Order Form* check box.

4. Click **Save Settings**.

.. finish_quick_order_form
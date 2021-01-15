:oro_documentation_types: OroCommerce
:oro_show_local_toc: false

.. _admin-guide--system-configuration--commerce-sales--checkout--single-page-checkout:
.. _user-guide--system-configuration--commerce-sales-checkout-global:
.. _user-guide--system-configuration--commerce-sales-checkout:

Configure Global Checkout Settings
==================================

.. hint:: This section is a part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides the general understanding of single-page and multi-page checkout concepts.

.. begin

To enable guest checkout globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Checkout** in the menu to the left.

.. note::
    For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.


.. image:: /user/img/system/config_commerce/sales/single_page_checkout_general.png
   :alt: Global checkout configuration settings

3. In the **Customer Users Registration** section, configure checkout options for the registered users:

   a) **Allow Registration** ---  when the option is enabled, registration is allowed for customers on the checkout page.
   b) **Allow Checkout without Email Confirmation** --- when the option is enabled, customers proceed to the checkout immediately once registration details are provided. When this option is disabled, the checkout does not start until the user confirms their email address.

   .. note:: By default, both options are *enabled*. However, they are only relevant when :ref:`guest checkout <user-guide--system-configuration--commerce-sales-checkout>` is enabled.

   To disable the options:

   a) Clear the **Use Default** check box.
   b) Clear the **Allow Registration** and **Allow Checkout without Email Confirmation** check boxes.

#. In the **Guest Checkout** section, set whether guest checkout should be enabled or disabled.

Guest checkout allows unregistered customers proceed through the steps of the checkout similarly to registered customers, with the exception of needing to enter their data manually as there is no pre-filled information available in the checkout forms. They are also limited to 1 shopping list.

When proceeding through the checkout, unauthenticated customers can choose whether the wish to register, login or continue as guests.

.. important:: As creating a shopping list is the key component of the :ref:`checkout process <frontstore-guide--orders-checkout>`, guest checkout can only operate properly when :ref:`shopping lists are enabled <user-guide--system-configuration--commerce-sales-shopping-list-global>` in the system.

The following is the list of actions that unregistered customers can and cannot perform when guest checkout is enabled in your Oro application:

.. csv-table::
   :header: "GUEST CUSTOMERS CAN", "GUEST CUSTOMERS CANNOT"
   :widths: 20, 20

   "1. Proceed to the checkout.","1. View their placed orders."
   "2. Create one shopping list and add items to it.","2. Save their details for future use on the website."
   "3. Use the quick order form.","3. View created quotes."
   "4. Submit a request for quote.","4. Communicate with the manager through the website."

For complete guest checkout experience, it is recommended to enable guest shopping lists, guest quick order form and guest requests for quotes.

.. hint:: Guest checkout can be configured on three levels -- globally, :ref:`per organization <user-guide--system-configuration--commerce-sales-organization>` and :ref:`website <user-guide--system-configuration--commerce-sales-checkout-website>`.

By default, guest checkout is disabled.

To enable it, clear *Use Default* and select the *Enable Guest Checkout* check box.

When the guest checkout is enabled, click **Save Settings** to display the additional **Guest Checkout Owner Settings** section.

#. In the **Guest Checkout Owner Settings** section, select the default owner of the guest checkout. Depending on the roles and permissions of the owner, guest data (e.g., shopping lists) may or may not be viewed and managed by the users who are subordinated to the owner.

.. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest checkout data, adjust permissions for the checkout entity in their roles accordingly.

#. By selecting the **Use New Layout for Checkout Page** checkbox, you will enable the new checkout design.
#. In the **Maximum Line Items per Page** section, provide the maximum number of line items that can be displayed per page in the new checkout layout.

   .. image:: /user/img/system/config_commerce/sales/new-checkout.png
      :scale: 40%
      :align: center
      :alt: Old vs new checkout page

#. Click **Save Settings** once you are done.

.. finish



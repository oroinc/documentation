:oro_show_local_toc: false

.. _admin-guide--system-configuration--commerce-sales--checkout--single-page-checkout:
.. _user-guide--system-configuration--commerce-sales-checkout-global:
.. _user-guide--system-configuration--commerce-sales-checkout:

Configure Global Checkout Settings
==================================

.. hint:: This section is part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides a general understanding of single-page and multi-page checkout concepts.

Checkout settings can be configured on three levels -- globally, :ref:`per organization <user-guide--system-configuration--commerce-sales-organization>` and :ref:`website <user-guide--system-configuration--commerce-sales-checkout-website>`.

.. begin

To configure checkout options globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Checkout** in the menu to the left.

   .. note::
     For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/sales/single_page_checkout_general.png
      :alt: Global checkout configuration settings

3. In the **Checkout Options** section, set the following option:

   * **Maximum Line Items per Page** --- Set the number of line items to display on the checkout page. The provided value will be used as the implied maximum number of checkout line items to display at once. If the number of checkout line items exceeds this value, the "Show All Items" will no longer be available and this number will be shown as the maximum pager value.

   * **Apple Pay Domain Verification** --- Apple Pay is offered as part of the integration with :ref:`Stripe <user-guide--payment--payment-providers-stripe--overview>`. Domain verification is one of the required prerequisites for Apple Pay to work. Whether Apple Pay will be offered as a payment option during checkout depends on what payment integrations are allowed on a specific website by the :ref:`payment rules <sys--payment-rules>`.

4. In the **Customer Users Registration** section, configure checkout options for the registered users:

   * **Allow Registration** ---  when the option is enabled, registration is allowed for customers on the checkout page.
   * **Allow Checkout without Email Confirmation** --- when the option is enabled, customers proceed to the checkout immediately once registration details are provided. When this option is disabled, the checkout does not start until the user confirms their email address.

5. In the **Guest Checkout** section, set whether guest checkout should be enabled or disabled.

   Guest checkout allows unregistered customers proceed through the steps of the checkout similarly to registered customers, with the exception of needing to enter their data manually as there is no pre-filled information available in the checkout forms. They are also limited to 1 shopping list.

   When proceeding through the checkout, unauthenticated customers can choose whether they wish to register, log in, or continue as guests.

   .. important:: As creating a shopping list is the key component of the :ref:`checkout process <frontstore-guide--orders-checkout>`, guest checkout can only operate properly when :ref:`shopping lists are enabled <user-guide--system-configuration--commerce-sales-shopping-list-global>` in the system.

                  The following is the list of actions that unregistered customers can and cannot perform when guest checkout is enabled in your Oro application:

                  .. csv-table::
                     :header: "GUEST CUSTOMERS CAN", "GUEST CUSTOMERS CANNOT"
                     :widths: 20, 20

                     "1. Proceed to the checkout.","1. View their placed orders."
                     "2. Create one shopping list and add items to it.","2. Save their details for future use on the website."
                     "3. Use the quick order form.","3. View created quotes."
                     "4. Submit a request for quote.","4. Communicate with the manager through the website."

   For complete guest checkout experience, it is recommended to enable guest shopping lists, guest quick order form, and guest requests for quotes.

6. In the **Guest Checkout Owner Settings** section, select the default owner of the guest checkout. Depending on the roles and permissions of the owner, guest data (e.g., shopping lists) may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest checkout data, adjust permissions for the checkout entity in their roles accordingly.

7. In the **Order Limits** section, enter the following values:

   * **Minimum Order Amount** --- Specify the minimum subtotal required to start the checkout process (available as of OroCommerce version 6.0.6.). If the shopping list subtotal is less than the specified value, the **Checkout** button will be disabled, and customers will see an error notification, prompting them to add more products to proceed. Once the subtotal meets or exceeds the minimum amount, the error message disappears, and the **Checkout** button is enabled. If :ref:`multiple currencies <sys--config--sysconfig--general-setup--currency>` are enabled in the storefront, they are rendered as separate inputs for each currency. Validation in the storefront uses the value configured for the current currency. No automatic currency conversions are applied.

    .. image:: /user/img/system/config_commerce/sales/order-limits-config.png
       :alt: Global order limits configuration settings

    .. image:: /user/img/system/config_commerce/sales/minimum-order-storefront.png
       :alt: Shopping list view page with the amount less than the specified minimum order amount

   * **Maximum Order Amount** --- Specify the maximum subtotal required to start the checkout (available as of OroCommerce version 6.0.6.). If the shopping list subtotal exceeds the specified value, the **Checkout** button will be disabled, and customers will see an error notification, prompting them to remove some products to proceed. Once the subtotal is within the allowed limit, the error message disappears, and the **Checkout** button is enabled. If :ref:`multiple currencies <sys--config--sysconfig--general-setup--currency>` are enabled in the storefront, they are rendered as separate inputs for each currency. Validation in the storefront uses the value configured for the current currency. No automatic currency conversions are applied.

   .. image:: /user/img/system/config_commerce/sales/maximum-order-storefront.png
      :alt: Shopping list view page with the amount more than the specified maximum order amount

8. Click **Save Settings**.

.. finish


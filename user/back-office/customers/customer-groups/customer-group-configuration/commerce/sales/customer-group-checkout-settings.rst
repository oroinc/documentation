.. _user-guide--customer-group---checkout--settings:

Configure Checkout (Order Limits) Settings per Customer Group
=============================================================

.. note:: You can configure checkout settings :ref:`globally <user-guide--system-configuration--commerce-sales-checkout>`, :ref:`per organization <user-guide--system-configuration--commerce-sales-organization>`, :ref:`website <user-guide--system-configuration--commerce-sales-checkout-website>`, customer group, or :ref:`customer <user-guide--customers--checkout--settings>`.


The Checkout Order Limits functionality allows merchants to set Minimum Order Values for specific customers. This feature helps prevent small and unprofitable orders from being processed. If a customer’s shopping list subtotal is below the set minimum, they will see a notification indicating the required amount to check out. Once the subtotal exceeds the minimum, the notification will disappear, and the "Create Order" button will become enabled.

To configure the checkout order limits per customer group:

1. Navigate to **Customers > Customer Groups** in the main menu.
2. For the necessary customer group, hover over the |IcMore| **More Options** menu to the right of the necessary customer group and click the |IcConfig| **Configuration** icon to start editing the configuration.

.. image:: /user/img/customers/customer_groups/configuration/customer-group-order-limits-settings.png
   :alt: Checkout order limits customer group configuration settings

3. Select **Commerce > Sales > Checkout** in the menu to the left.
4. In the Checkout section, clear the **Website** checkbox and configure the following options:

   * **Minimum Order Amount** --- Specify the minimum subtotal required to start the checkout process. If the shopping list subtotal is less than the specified value, the **Checkout** button will be disabled, and customers will see an error notification, prompting them to add more products to proceed. Once the subtotal meets or exceeds the minimum amount, the error message disappears, and the **Checkout** button is enabled. If :ref:`multiple currencies <admin-configuration-currency-org>` are enabled in the storefront, they are rendered as separate inputs for each currency. Validation in the storefront uses the value configured for the current currency. No automatic currency conversions are applied.

   * **Maximum Order Amount** --- Specify the maximum subtotal required to start the checkout. If the shopping list subtotal exceeds the specified value, the **Checkout** button will be disabled, and customers will see an error notification, prompting them to remove some products to proceed. Once the subtotal is within the allowed limit, the error message disappears, and the **Checkout** button is enabled. If :ref:`multiple currencies <admin-configuration-currency-org>` are enabled in the storefront, they are rendered as separate inputs for each currency. Validation in the storefront uses the value configured for the current currency. No automatic currency conversions are applied.

5. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

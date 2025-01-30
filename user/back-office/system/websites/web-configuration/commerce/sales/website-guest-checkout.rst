.. _user-guide--system-configuration--commerce-sales-checkout-website:
.. _user-guide--system-configuration--commerce-sales-checkout-registration--web:

Configure Checkout Settings per Website
=======================================

.. hint:: This section is part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides a general understanding of single-page and multi-page checkout concepts.

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Checkout** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/CheckoutWeb.png

4. Clear the **Use Organization** checkbox to change the organization-wide setting.

5. In the **Customer Users Registration** section, you can:

   * **Allow Registration** ---  when the option is enabled, registration is allowed for customers on the checkout page.
   * **Allow Checkout without Email Confirmation** --- when the option is enabled, customers proceed to the checkout immediately once registration details are provided. When this option is disabled, the checkout does not start until the user confirms their email address.

   .. note:: By default, both options are *enabled*. However, they are only relevant when :ref:`guest checkout <user-guide--system-configuration--commerce-sales-checkout>` is enabled.

6. In the **Guest Checkout** section, set whether guest checkout should be enabled or disabled.

   By default, guest checkout is disabled.

7. In the **Guest Checkout Owner Settings** section, select the default owner of the guest checkout. Depending on the roles and permissions of the owner, guest data (e.g. shopping lists) may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest checkout data, adjust permissions for the checkout entity in their roles accordingly.

8. In the **Checkout Options** section, set the following option:

   * **Maximum Line Items per Page** --- Set the number of line items to display on the checkout page. The provided value will be used as the implied maximum number of checkout line items to display at once. If the number of checkout line items exceeds this value, the "Show All Items" will no longer be available and this number will be shown as the maximum pager value.

   * **Apple Pay Domain Verification** --- Apple Pay is offered as part of the integration with :ref:`Stripe <user-guide--payment--payment-providers-stripe--overview>`. Domain verification is one of the required prerequisites for Apple Pay to work. Whether Apple Pay will be offered as a payment option during checkout depends on what payment integrations are allowed on a specific website by the :ref:`payment rules <sys--payment-rules>`.

9. In the **Order Limits** section, enter the following values:

   * **Minimum Order Amount** --- Specify the minimum subtotal required to start the checkout process. If the shopping list subtotal is less than the specified value, the **Checkout** button will be disabled, and customers will see an error notification, prompting them to add more products to proceed. Once the subtotal meets or exceeds the minimum amount, the error message disappears, and the **Checkout** button is enabled. If :ref:`multiple currencies <admin-configuration-currency-org>` are enabled on the storefront, they are rendered as separate inputs for each currency. Validation on the storefront uses the value configured for the current currency. No automatic currency conversions are applied.

    .. image:: /user/img/system/websites/web_configuration/order-limits-config-website.png
       :alt: Order limits configuration settings per website

    .. image:: /user/img/system/config_commerce/sales/minimum-order-storefront.png
       :alt: Shopping list view page with the amount less than the specified minimum order amount

   * **Maximum Order Amount** --- Specify the maximum subtotal required to start the checkout. If the shopping list subtotal exceeds the specified value, the **Checkout** button will be disabled, and customers will see an error notification, prompting them to remove some products to proceed. Once the subtotal is within the allowed limit, the error message disappears, and the **Checkout** button is enabled. If :ref:`multiple currencies <admin-configuration-currency-org>` are enabled on the storefront, they are rendered as separate inputs for each currency. Validation on the storefront uses the value configured for the current currency. No automatic currency conversions are applied.

   .. image:: /user/img/system/config_commerce/sales/maximum-order-storefront.png
      :alt: Shopping list view page with the amount more than the specified maximum order amount

10. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

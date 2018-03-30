.. _user-guide--system-configuration--commerce-sales-checkout-registration--org:

Configure Guest Checkout with Registration Options per Organization
-------------------------------------------------------------------

.. begin

To configure guest checkout with an option to register per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Checkout** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /admin_guide/img/configuration/sales/checkout/GuestCheckoutRegistrationOrg.png

4. In the **Customer Users Registration** section, you can:

   a) **Allow Registration** ---  when the option is enabled, registration is allowed for customers on the checkout page.
   b) **Allow Checkout without Email Confirmation** --- when the option is enabled, customers proceed to the checkout immediately once registration details are provided. When this option is disabled, the checkout does not start until the user confirms their email address.

   .. note:: By default, both options are *enabled*. However, they are only relevant when :ref:`guest checkout <user-guide--system-configuration--commerce-sales-checkout>` is enabled.

   To disable the options:

   a) Clear the **Use System** check box.
   b) Clear the **Allow Registration** and **Allow Checkout without Email Confirmation** check boxes.

5. Click **Save Settings**

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin

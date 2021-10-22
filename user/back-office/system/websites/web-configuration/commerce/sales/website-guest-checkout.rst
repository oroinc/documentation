:oro_documentation_types: OroCommerce

.. _user-guide--system-configuration--commerce-sales-checkout-website:
.. _user-guide--system-configuration--commerce-sales-checkout-registration--web:

Configure Checkout Settings per Website
=======================================

.. hint:: This section is part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides the general understanding of single-page and multi-page checkout concepts.

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Checkout** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/CheckoutWeb.png

4. Clear the **Use Organization** check box to change the organization-wide setting.

5. In the **Customer Users Registration** section, you can:

   a) **Allow Registration** ---  when the option is enabled, registration is allowed for customers on the checkout page.
   b) **Allow Checkout without Email Confirmation** --- when the option is enabled, customers proceed to the checkout immediately once registration details are provided. When this option is disabled, the checkout does not start until the user confirms their email address.

   .. note:: By default, both options are *enabled*. However, they are only relevant when :ref:`guest checkout <user-guide--system-configuration--commerce-sales-checkout>` is enabled.

6. In the **Guest Checkout** section, set whether guest checkout should be enabled or disabled.

   By default, guest checkout is disabled.

7. In the **Guest Checkout Owner Settings** section, select the default owner of the guest checkout. Depending on the roles and permissions of the owner, guest data (e.g. shopping lists) may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest checkout data, adjust permissions for the checkout entity in their roles accordingly.

8. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

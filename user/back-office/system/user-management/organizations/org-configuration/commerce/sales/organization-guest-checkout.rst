:oro_documentation_types: commerce

.. _user-guide--system-configuration--commerce-sales-organization:

Guest Checkout per Organization
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin

To enable guest checkout per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Checkout** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/sales/CheckoutOrg.png

4. Clear the **Use System** check box to change the system-wide setting.

5. In the **Customer Users Registration** section, you can:

   a) **Allow Registration** ---  when the option is enabled, registration is allowed for customers on the checkout page.
   b) **Allow Checkout without Email Confirmation** --- when the option is enabled, customers proceed to the checkout immediately once registration details are provided. When this option is disabled, the checkout does not start until the user confirms their email address.

   .. note:: By default, both options are *enabled*. However, they are only relevant when :ref:`guest checkout <user-guide--system-configuration--commerce-sales-checkout>` is enabled.

6. In the **Guest Checkout** section, set whether guest checkout should be enabled or disabled.

   By default, guest checkout is disabled.

   When the guest checkout is enabled, click **Save Settings** to display the additional **Guest Checkout Owner Settings** section.

7. In the **Guest Checkout Owner Settings** section, select the default owner of the guest checkout. Depending on the roles and permissions of the owner, guest data (e.g. shopping lists) may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest checkout data, adjust permissions for the checkout entity in their roles accordingly.

8. Click **Save Settings**.

.. finish


.. include:: /include/include-images.rst
   :start-after: begin




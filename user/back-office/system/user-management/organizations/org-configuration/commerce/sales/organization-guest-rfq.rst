:oro_documentation_types: OroCommerce

.. _user-guide--system-configuration--commerce-sales--rfq--organization:

Configure Request for Quote Settings per Organization
=====================================================

.. hint:: This section is a part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides the general understanding of the RFQ and quote concepts in OroCommerce.

On the RFQ configuration page, you can enable RFQ feature for the back-office and storefront, control RFQ Notification options and Guest RFQs.

To configure the request for quote settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Request for Quote** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/user_management/org_configuration/sales/org_rfq_config.png
   :alt: Rfq configuration options per organization

4. Clear the **Use System** check box to override the global configuration options.

5. In the **General** section, customize the following options:

   **Enable RFQ** --- the option enables the OroCommerce-driven RFQ functionality for the back-office. The back-office users will be able to work with the submitted RFQs, process them, and convert to quotes if accepted.

   **Enable RFQ (Store Front)** --- the option enables the OroCommerce-driven RFQ functionality for the storefront. Your customers will be able to submit RFQs from the storefront.

6. In the **Notifications** section, configure notifications for all the parties concerned, namely:

   * an assigned sales representatives of the customer
   * the owner of the customer user
   * the owner of the customer

   For the aforementioned parties the options are the following:

   * Select **Always** to notify the related entity each time an RFQ is submitted.
   * Select **If user has no sales reps assigned** to notify the related entity only in case they do not have any assigned sales representatives.

7. In the **Guest RFQ** section, set whether guests are allowed to submit a request for quote. By default, guest request for quote submission is disabled. To enable it, clear *Use System* and select the *Enable Guest RFQ* check box. When the guest RFQ is enabled, click **Save Settings** to display the additional **Guest RFQ Owner Settings** section.

  .. hint:: Make sure you enable :ref:`Guest Shopping Lists <user-guide--system-configuration--commerce-sales-shopping-list-per-organization>` in the back-office to let guest customers create RFQs from the shopping lists in their storefront.

8. In the **Guest RFQ Owner Settings** section, select the user who will be the default owner of all guest RFQs.  Depending on the roles and permissions of the owner, guest RFQs may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest RFQs, adjust permissions for the Request for Quote entity in their roles accordingly.

9. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

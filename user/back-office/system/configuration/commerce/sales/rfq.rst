:oro_documentation_types: OroCommerce

.. _configuration--guide--commerce--configuration--sales-rfq:
.. _user-guide--system-configuration--commerce-sales--rfq:
.. _sys--conf--commerce--sales--rfq-notifications--general:
.. _user-guide--system-configuration--commerce-sales--rfq--global:


Configure Global Request for Quote Settings
===========================================

.. hint:: This section is a part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides the general understanding of the RFQ and quote concepts in OroCommerce.

On the RFQ configuration page, you can enable RFQ feature for the back-office and storefront, control RFQ Notification options and Guest RFQs.

The rfq settings can be configured on three levels -- globally, :ref:`per organization <user-guide--system-configuration--commerce-sales--rfq--organization>`, and :ref:`per website <sys--conf--commerce--sales--rfq-notifications--website>`. Please note that website settings override organization, organization settings override system settings.

To configure the request for quote settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Request for Quote** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.


.. image:: /user/img/system/config_commerce/sales/global_rfq_options.png
   :class: with-border
   :alt: Global rfq configuration

3. Clear the **Use Default** check box to override the default configuration options.

4. In the **General** section, customize the following options:

   **Enable RFQ** --- the option enables the OroCommerce-driven RFQ functionality for the back-office. The back-office users will be able to work with the submitted RFQs, process them, and convert to quotes if accepted.

   **Enable RFQ (Store Front)** --- the option enables the OroCommerce-driven RFQ functionality for the storefront. Your customers will be able to submit RFQs from the storefront.

5. In the **Notifications** section, configure notifications for all the parties concerned, namely:

   * an assigned sales representatives of the customer
   * the owner of the customer user
   * the owner of the customer

   For the aforementioned parties the options are the following:

   * Select **Always** to notify the related entity each time an RFQ is submitted.
   * Select **If user has no sales reps assigned** to notify the related entity only in case they do not have any assigned sales representatives.


6. In the **Guest RFQ** section, set whether guests are allowed to request quotes on the items they are interested in. This will also allow sales reps collect information on potential sales in the back-office.

  .. hint:: Make sure you enable :ref:`Guest Shopping Lists <user-guide--system-configuration--commerce-sales-shopping-list>` in the back-office to let guest customers create RFQs from the shopping lists in their storefront.

  By default, guest request for quote submission is disabled. To enable it, clear *Use Default* and select the *Enable Guest RFQ* check box. When the guest RFQ is enabled, click **Save Settings** to display the additional **Guest RFQ Owner Settings** section.

7. In the **Guest RFQ Owner Settings** section, select the user who will be the default owner of all guest RFQs.  Depending on the roles and permissions of the owner, guest RFQs may or may not be viewed and managed by the users who are subordinated to the owner.


.. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest RFQs, adjust permissions for the Request for Quote entity in their roles accordingly.

8. Click **Save Settings**.

.. finish_rfq

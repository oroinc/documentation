.. _configuration--guide--commerce--configuration--sales-rfq:

Request for Quote
=================

On the RFQ configuration page, you can control RFQ Notification options and Guest RFQs.

In your Oro management console, you can control the way notifications are sent both to customers and sales representatives upon submitting a new request for quote. This can be done on two levels -- globally and :ref:`per website <>`.

You can also enable Guest RFQ Forms in your Oro application to let unregistered customers request quotes on the items they are interested in.  This will also allow sales reps collect information on potential sales in the management console. This can be configured on three levels -- globally, :ref:`per organization <>` and :ref:`website <>`.

.. hint:: Make sure you enable :ref:`Guest Shopping Lists <user-guide--system-configuration--commerce-sales-shopping-list>` in the management console to let guest customers create RFQs from the shopping lists in their storefront.

.. note:: Please note that website settings override organization, organization settings override system settings.

.. _sys--conf--commerce--sales--rfq-notifications--general:

RFQ Notifications
-----------------

To change the default notification settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Request for Quote** in the menu to the left.

   .. image:: /user_guide/img/sales/requests_for_quote/rfq_config_1.png
      :class: with-border

The notifications options can be configured for all the parties concerned, namely:

* an assigned sales representatives of the customer
* the owner of the customer user
* the owner of the customer

To customize any of these options:

1. Clear the **Use Default** check box next to the option.
2. Select the corresponding option from the list.

   For the aforementioned parties the options are the following:

   * Select **Always** to notify the related entity each time an RFQ is submitted.
   * Select **If user has no sales reps assigned** to notify the related entity only in case they do not have any assigned sales representatives.

  .. image:: /user_guide/img/sales/requests_for_quote/rfq_config_2.png
     :class: with-border

3. Click **Save Settings**.

.. _user-guide--system-configuration--commerce-sales--rfq--global:

Guest RFQ
---------

.. begin_rfq

To enable guest request for quote submission globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Sales > Request for Quote** in the menu to the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /img/system/config_system/sales/rfq/RFQGlobal.png

3. In the **Guest RFQ** section, set whether guests are allowed to submit a request for quote.

   By default, guest request for quote submission is disabled.

   To enable it, clear *Use Default* and select the *Enable Guest RFQ* check box.

   When the guest RFQ is enabled, click **Save Settings** to display the additional **Guest RFQ Owner Settings** section.

4. In the **Guest RFQ Owner Settings** section, select the user who will be the default owner of all guest RFQs.  Depending on the roles and permissions of the owner, guest RFQs may or may not be viewed and managed by the users who are subordinated to the owner.

   .. note::  To enable users from the same business unit or organization (that the owner belongs to) to view and manage guest RFQs, adjust permissions for the Request for Quote entity in their roles accordingly.

5. Click **Save Settings**.

.. finish_rfq

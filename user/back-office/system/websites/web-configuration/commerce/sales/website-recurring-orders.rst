.. _user-guide--website-configuration--commerce-sales-recurring-orders:

Configure Recurring Orders Settings per Website
===============================================

.. note:: This is an OroCommerce Enterprise feature, introduced in version 6.1.7.

Recurring Orders enable customers to automatically place repeat orders based on previously submitted orders. Customers can define a schedule with configurable frequency, start date, and optional end date, and manage recurring orders by pausing, resuming, or canceling them as needed. On each scheduled date, the system generates a new order and sends notifications according to the configured settings. Recurring order functionality and related notifications can be configured at the :ref:`global level <user-guide--system-configuration--commerce-sales-recurring-orders>` and per :ref:`organization <user-guide--organization-configuration--commerce-sales-recurring-orders>`, website, :ref:`customer group <user-guide--customer-group---sales-recurring-orders>`, and :ref:`customer <user-guide--customers--sales--recurring-orders>`.

To configure recurring orders per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Recurring Orders** in the menu to the left.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

#. By default, the Recurring Orders functionality is disabled. To update any of the options, clear the **Use Organization** checkbox first.
#. In the **Recurring Orders** Section, configure the following options:

   * **Enable Recurring Orders** -- Enable the functionality in the back-office.
   * **Enable Recurring Order on Storefront** -- Enable the functionality in the OroCommerce storefront and allow customer to view them in their storefront account.
   * **Recurring Order Number Prefix** -- Add a prefix you want to use for numbering recurring orders. By default, the prefix is set to *RO-*.

#. In the **Advance Notification** section, configure the following options:

   * **Upcoming Occurrence Notification Lead Time (days)** -- Specifies how many days before the scheduled date the upcoming order notification should be sent. Please note that if the recurring interval is shorter than the lead time, the notification will not be sent until the date of the previous order, regardless of this setting.
   * **Upcoming Occurrence Customer Notification Template** -- Email template used to notify customers in advance of an upcoming scheduled recurring order.

#. In the **Order Creation** section, configure the following options:

   * **Order Creation Lead Time (days)** -- Specifies how many days before the scheduled date a recurring order is created. This allows customers time to review, pay, or cancel the order before it is due. Please note that if the recurring interval is shorter than the lead time, the order will not be created until the date of the previous order, regardless of this setting.
   * **Advance Order Status** -- Defines the initial status assigned to a scheduled order if it is created before the scheduled date.
   * **Scheduled Date Order Status** -- Defines the status assigned to a recurring order if it is created on the scheduled date. If the order was created in advance, and it is still in the advance order status, then its status will be updated to this value on the scheduled date.
   * **Use Original Pricing for Scheduled Orders** -- When enabled, scheduled orders will use the original product prices from when the recurring order was created. When disabled, they will use the current prices at the time the order is generated.
   * **Scheduled Order Created Customer Notification Template** -- Email template used to notify the customer when a scheduled order for their recurring order is created.
   * **Scheduled Order Failed Customer Notification Template** -- Email template used to notify the customer when a scheduled order for their recurring order fails to be created.

#. In the **Customer Notifications** section, configure the following options:

   * **Recurring Order Created Customer Notification Template** -- Email template used to notify the customer when their recurring order is created.
   * **Recurring Order Paused Customer Notification Template** -- Email template used to notify the customer when their recurring order is paused.
   * **Recurring Order Resumed Customer Notification Template** -- Email template used to notify the customer when their recurring order is resumed.
   * **Recurring Order Completed Customer Notification Template** -- Email template used to notify the customer when their recurring order has completed.
   * **Recurring Order Canceled Customer Notification Template** -- Email template used to notify the customer when their recurring order is canceled.
   * **Recurring Order Suspended Customer Notification Template** -- Email template used to notify the customer when their recurring order is suspended.
   * **Skipped Occurrence Customer Notification Template** -- Email template used to notify the customer when a scheduled occurrence for their recurring order is skipped.

#. In the **Back-Office Users to Notify** section, configure the following options:

   * **Notify Customer User Owner** -- Enables email notifications to the owner of the customer user associated with the recurring order.
   * **Notify Customer Owner** -- Enables email notifications to the owner of the customer associated with the recurring order.
   * **Notify Customer User Sales Representatives** -- Enables email notifications to sales representatives assigned to the customer user associated with the recurring order.
   * **Notify Customer Sales Representatives** -- Enables email notifications to sales representatives assigned to the customer associated with the recurring order.

#. In the **Back-Office Notifications** section, configure the following options:

   * **Recurring Order Created Backoffice Notification Template** -- Email template used to notify the back-office when a recurring order is created.
   * **Recurring Order Paused Backoffice Notification Template** -- Email template used to notify the back-office when a recurring order is paused by the customer.
   * **Recurring Order Resumed Backoffice Notification Template** -- Email template used to notify the back-office when a recurring order is resumed by the customer.
   * **Recurring Order Completed Backoffice Notification Template** -- Email template used to notify the back-office when a recurring order is completed.
   * **Recurring Order Canceled Backoffice Notification Template** -- Email template used to notify the back-office when a recurring order is canceled by the customer.
   * **Recurring Order Suspended Backoffice Notification Template** -- Email template used to notify the back-office when a recurring order is suspended.
   * **Skipped Occurrence Backoffice Notification Template** -- Email template used to notify the back-office when a scheduled recurring order occurrence is skipped.
   * **Upcoming Occurrence Backoffice Notification Template** -- Email template used to notify the back-office of an upcoming scheduled recurring order occurrence.
   * **Scheduled Order Created Backoffice Notification Template** -- Email template used to notify the back-office when a scheduled order is created from a recurring order.
   * **Scheduled Order Failed Backoffice Notification Template** -- Email template used to notify the back-office when the creation of a scheduled order from a recurring order fails.

#. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin





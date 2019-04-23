.. _simple-quote-management-steps:

Simple Quote Management: Steps and Transitions
==============================================

.. note:: Available options depend on the current status of the quote and your permissions.

When Quote Management (without approvals) is enabled, the quote status may be one of the following:

* Draft --- the quote is being prepared.

* Sent to Customer --- the quote is sent to the customer.

* Closed --- the quote is closed and no further actions with the quote are possible unless it is reopened.

* Deleted --- the quote has been removed.

The following table describes which options are available for each of the statuses and how the corresponding transitions change the quote status.

.. note::

   Some transitions are available only for a reviewer (Reviewer) and some only for a user without reviewing permissions (Sales). The availability is indicated in the corresponding columns.

   A buyer can see only quotes that have been sent to the customer.

+------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Current Quote Status   | Transitions from Step                                                                                                                             | Reviewer | Sales | New Status            |
+========================+===================================================================================================================================================+==========+=======+=======================+
| Draft                  | Click **Edit** to make changes to the quote draft.                                                                                                | *        | *     | Draft                 |
|                        +---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Clone** to create a copy of the quote.                                                                                                    | *        | *     | Draft                 |
|                        +---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Delete** to remove the quote draft.                                                                                                       | *        | *     | Deleted               |
|                        +---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Send to Customer** to send this quote to the customer. *If the quote has been modified, this option becomes unavailable for Sales.*       | *        | *     | Sent to Customer      |
+------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Sent to Customer       | Click **Cancel** to call off the quote.                                                                                                           | *        | *     | Closed                |
|                        +---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Expire** to indicate that the quote's validity period is over.                                                                            | *        | *     | Closed                |
|                        |                                                                                                                                                   |          |       |                       |
|                        | In the confirmation dialog, click **Mark As Expired**.                                                                                            |          |       |                       |
|                        +---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Delete** to remove the quota.                                                                                                             | *        | *     | Deleted               |
|                        +---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Create New Quote** to create a copy of the quote.                                                                                         | *        | *     | Sent to Customer      |
|                        |                                                                                                                                                   |          |       |                       |
|                        | In the **Create New Quote** dialog, select whether to copy notes made on the quote and when the current quote is to expire, and click **Submit**. |          |       |                       |
|                        +---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Declined by Customer** to indicate that the customer did not agree to the terms of the quote.                                             | *        | *     | Closed                |
+------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Closed                 | Click **Reopen** to actualize the quote again. A new quote with the same data will appear. The current quote remains closed.                      | *        | *     | Closed                |
+------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Deleted                | Click **Undelete** to restore the quote.                                                                                                          | *        | *     | Draft                 |
+------------------------+---------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+


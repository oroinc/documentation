.. _quote-management-with-approvals-steps:

Quote Management with Approvals: Steps and Transitions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. note:: Available options depend on the current status of the quote and your permissions.

When Quote Management with Approvals is enabled, the quote status may be one of the following:

* Draft --- the quote is being prepared.

* Submitted for Review --- the quote has been sent to an authorized person for review.

* Under Review --- the quote is being reviewed by an authorized person.

* Approved --- the quote has been approved by an authorized person.

* Not Approved -- the authorized person declined the quote.

* Sent to Customer --- the quote is sent to the customer.

* Closed --- the quote is closed and no further actions with the quote are possible unless it is reopened.

* Deleted --- the quote has been removed.

The following table describes which options are available for each of the statuses and how the corresponding transitions change the quote status.

.. note::

   Some transitions are available only for a reviewer (Reviewer) and some only for a user without reviewing permissions (Sales). The availability is indicated in the corresponding columns.

   A buyer can see only quotes that have been sent to the customer.

.. or for a buyer (B)

+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Current Quote Status   | Transitions from Step                                                                                                                                                                   | Reviewer | Sales | New Status            |
+========================+=========================================================================================================================================================================================+==========+=======+=======================+
| Draft                  | Click **Edit** to make changes to the quote draft.                                                                                                                                      | *        | *     | Draft                 |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Clone** to create a copy of the quote.                                                                                                                                          | *        | *     | Draft                 |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Delete** to remove the quote draft.                                                                                                                                             | *        | *     | Deleted               |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Send to Customer** to send this quote to the customer. *If the quote has been modified, this option becomes unavailable for Sales.*                                             | *        | *     | Sent to Customer      |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Submit for Review** to send the quote to the authorized person for review.                                                                                                      |          | *     | Submitted for Review  |
|                        |                                                                                                                                                                                         |          |       |                       |
|                        | In the **Submit for Review** dialog, enter any information that you consider useful and click **Submit**.                                                                               |          |       |                       |
|                        | The message will appear as a note in the **Activity** section of the quote view page.                                                                                                   |          |       |                       |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Submitted for Review   | Click **Review** to start reviewing the quote.                                                                                                                                          | *        |       | Under Review          |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Under Review           | Click **Return** to return the quote for refinement.                                                                                                                                    | *        |       | Open                  |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Approve and Send to Customer** to indicate that you would like to approve the quote and send it to the customer.                                                                | *        |       | Draft                 |
|                        |                                                                                                                                                                                         |          |       |                       |
|                        | In the **Approve and Send to Customer** dialog, check who will receive the notification about the quote and the notification text, and click **Send**.                                  |          |       |                       |
|                        | The quote will appear in the customer profile in the front store and the buyer will receive a notification about it.                                                                    |          |       |                       |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Approve** to grant your approval on the quote.                                                                                                                                  | *        |       | Approved              |
|                        |                                                                                                                                                                                         |          |       |                       |
|                        | In the **Approve** dialog, enter any information that you consider useful and click **Submit**. Your message will appear as a note in the **Activity** section of the quote view page.  |          |       |                       |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Decline** to reject the quote.                                                                                                                                                  | *        |       | Closed                |
|                        |                                                                                                                                                                                         |          |       |                       |
|                        | In the **Decline** dialog, enter the reason for rejecting the quote and click **Submit**. Your message will appear as a note in the **Activity** section of the quote view page.        |          |       |                       |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Approved               | Click **Send to Customer** to directly send this quote to the customer.                                                                                                                 | *        | *     | Sent to Customer      |
|                        |                                                                                                                                                                                         |          |       |                       |
|                        | In the **Send to Customer** dialog, check who will receive the notification about the quote and the notification text, and click **Send**.                                              |          |       |                       |
|                        | The quote will appear in the customer profile in the front store and the buyer will receive a notification about it.                                                                    |          |       |                       |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Not Approved           |                                                                                                                                                                                         |          |       | Open                  |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Sent to Customer       | Click **Cancel** to call of the quote.                                                                                                                                                  | *        | *     | Closed                |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Expire** to indicate that the quote's validity period is over.                                                                                                                  | *        | *     | Closed                |
|                        |                                                                                                                                                                                         |          |       |                       |
|                        | In the confirmation dialog, click **Mark As Expired**.                                                                                                                                  |          |       |                       |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Delete** to remove the quota.                                                                                                                                                   | *        | *     | Deleted               |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Create New Quote** to create a copy of the quote.                                                                                                                               | *        | *     | Sent to Customer      |
|                        |                                                                                                                                                                                         |          |       |                       |
|                        | In the **Create New Quote** dialog, select whether to copy notes made on the quote and when the current quote is to expire, and click **Submit**.                                       |          |       |                       |
|                        +-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                        | Click **Declined by Customer** to indicate that the customer did not agree to the terms of the quote.                                                                                   | *        | *     | Closed                |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Closed                 | Click **Reopen** to actualize the quote again. A new quote with the same data will appear. The current quote remains closed.                                                            | *        | *     | Closed                |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Deleted                | Click **Undelete** to restore the quote.                                                                                                                                                | *        | *     | Draft                 |
+------------------------+-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+

.. note:: The **Accept** and **Decline** transitions (from the **Sent to Customer** step) are reserved for future use.

.. Future options for Sent to Customer step:

.. |                                                                | Click **Accept** to accept the quote. *(B, in the front store)*                                                                                                                                 |          |       | *     | Closed                |
   |                                                                +-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-------+-----------------------+
   |                                                                | Click **Decline** to decline the quote. *(B, in he front store)*                                                                                                                                |          |       | *     | Closed                |
   |                                                                +-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-------+-----------------------+

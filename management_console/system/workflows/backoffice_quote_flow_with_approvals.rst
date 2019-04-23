.. _doc--workflows--backoffice-quote-flow-with-approvals:

Backoffice Quote Flow with Approvals
====================================

.. contents:: :local:
   :depth: 1

.. start_bo_quote_approvals

Overview
^^^^^^^^

Backoffice Quote Flow with Approvals (BQFA) is a :ref:`system <user-guide--system--workflow-management-system-custom>` workflow that defines a sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a quote can go through as a deal progresses, including the steps where a sales person might have to get approval from the authorized person (e.g. their manager) before sending the quote with updated prices to the buyer.

.. note::  The difference between the simple quote workflow and the one with approval is covered in the :ref:`Understanding Quote Workflows <system--workflows--quote--understanding>` section.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **Quote Backoffice Flow with Approvals** to open the flow. The following page opens:

.. image:: /img/system/workflows/backoffice_quote_with_approval.png

.. note:: Since BQFA is a system workflow, it cannot be edited, modified, or deleted.

On the **Backoffice Quote Flow with Approvals** page, you can perform the following actions:

* Deactivate the workflow - click **Deactivate** to deactivate the workflow.
* Update configuration settings - click **Configuration**, modify the settigns, and click **Save And Close**.

.. _doc--workflows--backoffice-quote-flow-with-approvals--workflows-overview:

In Use: Summary
~~~~~~~~~~~~~~~

When the **BQFA** is activated instead of the simple quote management workflow, and the **Price Override Requires Approval** option is enabled, the following process is enforced for the quotes where sales person has modified prices:

#. A sales representative creates a quote for a buyer and sends it to an authorized person (e.g., a sales manager) for review.

#. Upon the review, a sales manager may do one of the following:

   * Approve a quote, and, sometimes, immediately send it to a buyer.

   * Decline a quote.

   * Return a quote to a sales representative for refinement.

   .. note:: The review step is required only after a sales representative has modified prices in the quote.

#. Once the quote is approved, the sales representative can send it to a buyer.

.. _doc--workflows--backoffice-quote-flow-with-approvals--prerequisites:


.. What You Will Learn^^^^^^^^^^^^^^^^^^^
   In this topic, you will learn:
   * The :ref:`prerequisites <doc--workflows--backoffice-quote-flow-with-approvals--prerequisites>` for the approval process.
   * How to ensure the :ref:`approval is enabled <doc--workflows--backoffice-quote-flow-with-approvals--configure>`.
   * How the Backoffice Quote Flow with Approvals (BQFA) :ref:`changes the quote processing flow <doc--workflows--backoffice-quote-flow-with-approvals--steps>`.
   Also, you will get an :ref:`example <doc--workflows--backoffice-quote-flow-with-approvals--follow>` of the sales - buyer communication that requires approval.


Prerequisites
^^^^^^^^^^^^^

To enable approvals for your quote management:

* In workflow configuration, ensure that :ref:`approvals are enabled <doc--workflows--backoffice-quote-flow-with-approvals--configure>` for the quotes with overridden price (as described n the section below).
* :ref:`Activate <doc--system--workflow-management--activate>` the **Backoffice Quote Flow with Approvals** workflow (as described in the topic on workflow management).
* Decide which users (e.g., sales people or their manager) should be reviewing and approving quotes.
* Authorize these users to review and approve quotes by enabling the **Review and approve quotes** capability for their role (as described in the section below).

Configure User Role to Authorize Quote Approval
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable quote approval for users with the particular role (e.g., for all sales managers, to enable peer approval), do the following:

1. Navigate to **System > User Management > Roles** in the main menu.

2. Click the necessary role (e.g., *Sales Manager*) to open it.

2. Start editing the role by clicking **Edit** on the top right.

3. Click **Quotes** to get to the permissions and capabilities related to quotes management.

4. In the capabilities list, select the **Review and approve quotes** check box.

5. Click **Save And Close** on the top right.

.. important:: Note that users with the permission to review and approve a quote do not need to (and thus cannot) perform the **Send for Review** workflow transition. They can send any quote (either created by them or by someone else) directly to the customer.

.. _doc--workflows--backoffice-quote-flow-with-approvals--configure:

Enable Approval for the Overridden Price in Workflow Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Depending on the **Price Override Requires Approval** setting in the workflow configuration, **BQFA** may use the following strategies:

- Enabled --- *Default.* Approval is required only after a sales representative (or any other user who is responsible for creating and managing the quote) has modified prices in a quote.
- Disabled --- No approval is required to send any quote to the customer. In this case, **BQFA** mimics the behavior of the simple quote management flow.

If the option is disabled, do the following to enable it:

1. In the main menu, navigate to **System > Workflows**.

2. Click **Backoffice Quote Flow with Approvals** in the workflow list.

   The workflow details are shown.

3. Click **Configuration** on the top right.

4. Select the **Price Override Requires Approval** check box.

5. Click **Save And Close** on the top right.

.. _doc--workflows--backoffice-quote-flow-with-approvals--steps:

Steps and Transitions
^^^^^^^^^^^^^^^^^^^^^

Available options depend on the current status of the quote and your permissions.

.. This is how the workflow scheme looks like:

.. .. image:: /img/system/workflows/backoffice_quote_with_approval_scheme.png

Quote status may be one of the following:

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

+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Current Quote Status | Transitions from Step                                                                                                             | Reviewer | Sales | New Status            |
+======================+===================================================================================================================================+==========+=======+=======================+
| Draft                | Edit --- make changes to the quote draft.                                                                                         | *        | *     | Draft                 |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Clone --- create a copy of the quote.                                                                                             | *        | *     | Draft                 |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Delete --- remove the quote draft.                                                                                                | *        | *     | Deleted               |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Send to Customer --- send this quote to the customer. *If the quote has been modified, this option becomes unavailable for Sales* | *        | *     | Sent to Customer      |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Submit for Review --- send the quote to the authorized person for review.                                                         |          | *     | Submitted for Review  |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Submitted for Review | Review --- start reviewing the quote.                                                                                             | *        |       | Under Review          |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Under Review         | Return --- return the quote for refinement.                                                                                       | *        |       | Open                  |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Approve and Send to Customer --- indicate that you would like to approve the quote and send it to the customer.                   | *        |       | Draft                 |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Approve --- grant your approval on the quote.                                                                                     | *        |       | Approved              |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Decline --- reject the quote.                                                                                                     | *        |       | Closed                |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Approved             | Send to Customer --- directly send this quote to the customer.                                                                    | *        | *     | Sent to Customer      |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Not Approved         |                                                                                                                                   |          |       | Open                  |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Sent to Customer     | Cancel --- call of the quote.                                                                                                     | *        | *     | Closed                |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Expire --- indicate that the quote's validity period is over.                                                                     | *        | *     | Closed                |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Delete --- remove the quota.                                                                                                      | *        | *     | Deleted               |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Create New Quote --- create a copy of the quote.                                                                                  | *        | *     | Sent to Customer      |
|                      +-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
|                      | Declined by Customer --- indicate that the customer did not agree to the terms of the quote.                                      | *        | *     | Closed                |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Closed               | Reopen --- actualize the quote again. A new quote with the same data will appear. The current quote remains closed.               | *        | *     | Closed                |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+
| Deleted              | Undelete --- restore the quote.                                                                                                   | *        | *     | Draft                 |
+----------------------+-----------------------------------------------------------------------------------------------------------------------------------+----------+-------+-----------------------+

.. note:: The **Accept** and **Decline** transitions (from the **Sent to Customer** step) are reserved for future use.


.. Future options for Sent to Customer step:

.. |                                                                | Accept --- accept the quote. *(B, in the storefront)*                                                                                                                                 |          |       | *     | Closed                |
   |                                                                +-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-------+-----------------------+
   |                                                                | Decline --- decline the quote. *(B, in he storefront)*                                                                                                                                |          |       | *     | Closed                |
   |                                                                +-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+----------+-------+-------+-----------------------+


.. _doc--workflows--backoffice-quote-flow-with-approvals--follow:


Sample Flow
^^^^^^^^^^^

.. quote_in_use

In the following example, a sales rep Jin Thompson creates a quote and modifies prices for the line items.

As the BQFA is active and the price override requires approval, the sales manager Damara Lira reviews the quote and approves it before Jim sends it to the customer.

Let us go through every step of this process:

1. Jin creates a quote.

   .. note:: The BQFA workflow starts when Jin saves a quote created from scratch, or from a request for quote received from a buyer. For more information on creating quotes, see :ref:`Quotes <user-guide--sales--quotes>`.

   A newly created quote is in the **Draft** status. The line item price is not yet modified, and the quote does not require approval. Jin can send it to the customer.

   .. image:: /img/system/workflows/workflow_bqfa_quote_created.png

#. As a customer has a positive record and frequently buys headlamps in bulk, they have negotiated a personal discount of 1$ on every headlamp. The new price for the headlamp is 4$ (an MSRP, the best deal Jin could offer).

   To reflect the negotiated price in the quote, Jin clicks **Edit** and updates the headlamp price:

   .. image:: /img/system/workflows/workflow_bqfa_quote_edited1.png

   When Jin saves the changes, the **Send To Customer** option becomes hidden, as he cannot send the quote without approval. To get it, Jin has to send the quote for review:

  .. image:: /img/system/workflows/workflow_bqfa_quote_edited2.png

#. Jin clicks **Submit for Review**, enters a message that justifies the price update and sends the quote for review.

   .. image:: /img/system/workflows/workflow_bqfa_quote_sendforreview1.png

   Once submitted, the quote gets into the *Submitted for Review* status, which is indicated above the quote details. Jin cannot change the quote or call the submission back until the review is complete.

   .. image:: /img/system/workflows/workflow_bqfa_quote_sendforreview2.png

   If email notifications were configured, Damara (as the authorized approver) might get an email about the review request.

   Sample email text:

   .. image:: /img/system/workflows/workflow_bqfa_quote_sendforreview_notification.png

#. Damara opens the quote submitted for review either via the link in the email or by looking it up in the quotes list using the filter by internal status (is any of "Submitted for Review").

   The following page opens:

   .. image:: /img/system/workflows/workflow_bqfa_quote_review1.png

#. Damara clicks **Review** to move the quote to the *Under Review* status and communicate to Jin that his request is being processed.

   .. image:: /img/system/workflows/workflow_bqfa_quote_review2.png

   The comment that Jin entered when submitting the quote for review is available in the quote's activities section:

   .. image:: /img/system/workflows/workflow_bqfa_quote_review4.png

   .. note:: Once the quote is under review, Jin can see the updated status. However, transitions to further steps are disabled until the approval is gained.

      .. image:: /img/system/workflows/workflow_bqfa_quote_review3.png

#. As the modified price fits the current aggressive headlamp sale strategy, Damara approves the quote by clicking **Approve** and leaving a short message for Jim.

   .. note:: Damara may use **Approve And Send To Customer** action if she is sure the quote is finalized.

   .. image:: /img/system/workflows/workflow_bqfa_quote_approve1.png

   This changes the quote status to *Approved*.

   .. image:: /img/system/workflows/workflow_bqfa_quote_approve2.png

   If the email notifications were configured, Jin (as the one who requested approval) might get an email about the review outcome.

   Sample email text:

   .. image:: /img/system/workflows/workflow_bqfa_quote_approved_notification.png

#. Jin opens the approved quote either via the link in the email or by looking it up in the quotes list using the filter by internal status (is any of "Reviewed").

   The following page opens:

   .. image:: /img/system/workflows/workflow_bqfa_quote_approve3.png

6. Jin clicks **Send To Customer** and reviews the email draft. Additional recipients may be added to the To, CC, or BCC fields. The email body may be adjusted to be more personalized.

   .. image:: /img/system/workflows/workflow_bqfa_quote_sendtocustomer1.png

   When Jim is happy with the draft, he clicks **Send**.

   After the quote is sent, Jin or the authorized approver (Damara) can perform the following actions with the quote:

   * Cancel
   * Expire
   * Capture that the customer has declined

   .. image:: /img/system/workflows/workflow_bqfa_quote_sendtocustomer2.png

   In the storefront, the quote becomes available to the customer user it was created for:

   .. image:: /img/system/workflows/workflow_bqfa_quote_sendtocustomer3.png

.. finish_bo_quote_approvals

.. TODO  Coming in the future (BB-5618) A customer user can accept or decline the quote. After the customer user makes a decision, the quote is considered closed.

**Related Topics**


.. include:: /img/buttons/include_images.rst
   :start-after: begin

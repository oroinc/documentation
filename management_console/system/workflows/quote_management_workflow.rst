.. _system--workflows:
.. _system--workflows--quote-backoffice-workflow:

Quote Management Flow
=====================

.. contents:: :local:
   :depth: 1

.. start_quote_management_flow

Overview
^^^^^^^^

Quote Management Flow (QBW) is a :ref:`system <user-guide--system--workflow-management-system-custom>` workflow that defines a sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a quote can go through as a deal progresses.

.. note::  The difference between the simple Quote Management Flow and the one with approval is covered in the :ref:`Understanding Quote Workflows <system--workflows--quote--understanding>` section.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **Quote Management Flow** to open the flow. The following page opens:
   
.. image:: /img/system/workflows/QuoteBackofficeFlow.png
   
.. note:: Since Quote Management Flow is a system workflow, it cannot be edited or deleted.

On the Quote Management Flow page, you can perform the following actions:

.. Clone the workflow - click |IcClone| to clone the workflow.

* Deactivate the workflow - click **Deactivate** to deactivate the workflow.

Statuses
^^^^^^^^

When the QMF is active, the following statuses are available:

1. Internal Statuses are the statuses displayed in OroCommerce to the sales personnel:

   a) Draft
   b) Sent to Customer
   c) Expired
   d) Accepted
   e) Declined
   f) Deleted
   g) Cancelled

.. future statuses (backoffice approval workflow?):
  Template
  Open
  Submitted for Review
  Under Review
  Reviewed
  Not Approved

.. image:: /img/system/workflows/InternalStatusesGrid.png

2. Customer Statuses are the statuses displayed to customers in the storefront:

   a) Open
   b) Expired
   c) Accepted
   d) Declined

.. future statuses (backoffice approval workflow?):
  Pending Approval
  Approved
  Not Approved

.. note:: These statuses cannot be edited or deleted.


Steps and Transitions
^^^^^^^^^^^^^^^^^^^^^

The QMF consists of the following steps and transitions:

1. Steps:
   
   a) Draft
   b) Sent to Customer
   c) Closed
   d) Deleted
      
2. Transitions:
   
   a) For **Draft**: Edit, Clone, Delete, Send to Customer
   b) For **Sent to Customer**: Cancel, Expire, Delete, Create New Quote, Accept, Decline, Declined by Customer
   c) For **Closed**: Reopen
   d) For **Deleted**: Undelete

.. image:: /img/system/workflows/QBW_steps_transitions_table.png

.. note:: Please note that Accepted and Declined transitions for the Sent to Customer step are automatically triggered by the changes of customer statuses and they do not, therefore, take the form of buttons in the interface.

Sample Flow
^^^^^^^^^^^

As an illustration, let us go through a sample flow to see the QMF in action:

.. quote_in_use

1. Once a quote is created, it is automatically moved to the **Draft** step with the possibility to edit, clone, delete and send the quote to a customer.
   
   .. image:: /img/system/workflows/Illustration_1.png
    
2. The quote with an offer valid until 19 April is sent to a customer.
   
   .. image:: /img/system/workflows/Illustration_2.png

  The quote transitions from **Draft** state into **Sent to Customer**. Now it is possible to cancel, expire, delete, create a quote, or mark it as declined by customer.


  .. image:: /img/system/workflows/Illustration_3.png

  .. note:: If a customer generates an order based on the quote, you can leave the quote in the **Sent to Customer** state so that customer user could reuse it for future orders, or expire it to disable orders based on this quote.


3. The customer provided no feedback on the quote before 19 April, and the quote is expired by the sales personnel, leaving it in the **Closed** step.

  .. image:: /img/system/workflows/Illustration_4.png

4. The offer has been reconsidered and validation date was extended until 21 April. The quote is reopened. It is moved back to the draft step with the possibility to edit, clone, delete and send the quote to a customer. The quote number is changed (in our case, from 22 to 23).
   
  .. image:: /img/system/workflows/Illustration_5.png

.. finish_quote_management_flow

.. include:: /img/buttons/include_images.rst
   :start-after: begin



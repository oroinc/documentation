:oro_documentation_types: OroCRM, OroCommerce

.. _system--workflows--rfq-frontoffice-workflow:
.. _system--workflows--rfq-frontoffice-workflow-rfq-illustration:
.. _system--workflows--rfq-frontoffice-workflow-rfq-customer-statuses:

RFQ Submission Flow Workflow
----------------------------

.. start_front_flow

Overview
^^^^^^^^

RFQ (Request For Quote) Submission Flow Workflow is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that an RFQ can go through in the storefront and the back-office.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **RFQ Submission Flow** to open the flow.

On the RFQ Submission Flow page, you can disable the workflow by clicking |IcDeactivate| **Deactivate** the workflow.
  
.. image:: /user/img/system/workflows/rfq/frontoffice/rfq_submission_flow_1.png

Within the Workflows list, you can perform the following actions for the RFQ Submission Flow workflow:

* View the workflow: |IcView|
* Deactivate the workflow: |IcDeactivate|

.. image:: /user/img/system/workflows/rfq/frontoffice/rfq_submission_flow_2.png

RFQ Customer Statuses
^^^^^^^^^^^^^^^^^^^^^

:ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>` and Submission Flow workflows are interconnected. When both workflows are active, the following statuses are available:

.. start_customer_statuses

#. Customer Statuses (correspond to RFQ Submission Flow on the RFQ page) are the statuses displayed to customers in the storefront. In the back-office, they are visible on the RFQ page:

	a) Submitted
	b) Pending Approval
	c) Requires Attention
	d) Cancelled

.. stop_customer_statuses

.. image:: /user/img/system/workflows/rfq/frontoffice/rfq_submission_flow_3.png

2. Internal Statuses (correspond to RFQ Management Flow) are described in :ref:`RFQ Management Flow workflow <system--workflows--rfq-backoffice-workflow>`.

.. note:: Neither customer nor internal statuses can be edited or deleted.

Statuses are also displayed in the RFQ list:

.. image:: /user/img/system/workflows/rfq/frontoffice/rfq_submission_flow_4.png

The following table describes which options are available for each of the statuses, and how the corresponding transitions change them.

.. csv-table::
   :header: "Step", "Current Internal Status", "Current Customer Status"
   :widths: 30, 20, 20

       "An RFQ is submitted by a customer", "Open", "Submitted"
       "The RFQ is marked as processed by sales representative. The customer is not authorized to view this status", "Processed", "Submitted"
       "Sales representative requests more information from the customer", "More Information Requested", "Requires Attention"
       "The customer responds to the request and provides the additional information", "Open", "Submitted"
       "The RFQ is declined", "Declined", "Cancelled"
       "The RFQ is deleted and no further actions are possible unless it is reopened", "Deleted", "The RFQ is removed from the customer user’s page"

.. note:: You can add and remove columns in the workflows list by clicking |IcConfig| on the far right of the list.

          .. image:: /user/img/system/workflows/rfq/frontoffice/GridSettings.png

Steps and Transitions
^^^^^^^^^^^^^^^^^^^^^

The RFQ Submission Flow consists of the following steps and transitions:

1. Steps:
   
   a) Submitted
   b) Requires Attention
   c) Cancelled
   
2. Transitions:
   
   a) For **Submitted**: Cancel, Decline, Request More Information
   b) For **Requires Attention**: Cancel, Decline, Provide More Information
   c) For **Cancelled**: Resubmit, Reopen

.. image:: /user/img/system/workflows/rfq/frontoffice/RFQFrontOfficeTable.png

.. note:: Please note that the Request For Information, Reopen and Decline transitions are visible only in the back-office for the sales personnel.

.. image:: /user/img/system/workflows/rfq/frontoffice/RFQFrontofficeGrid_2.png

Sample Flow
^^^^^^^^^^^

As an illustration, let us go through a sample flow to see RFQ Submission Flow in action:

1. A customer user creates an RFQ in the storefront. Once the RFQ is sent, its customer status is marked as Submitted.

   .. image:: /user/img/system/workflows/rfq/frontoffice/rfq_submission_flow_3.png

2. In the back-office, a sales representative sees the RFQ and requests more information. The RFQ is now in the Requires Attention customer status.

   .. image:: /user/img/system/workflows/rfq/frontoffice/rfq_submission_flow_6.png
   
3. The customer user receives the request in the storefront, clicks Provide Information in the right corner of the page and replies to the message. The customer status is now Submitted.
   
   .. image:: /user/img/system/workflows/rfq/frontoffice/RFQProvideInfo.png
   .. image:: /user/img/system/workflows/rfq/frontoffice/RFQInformationProvided.png

4. The sales representative reads the reply in the Notes section of the RFQ page, marks the RFQ processed and creates a quote from the same page. The RFQ is now in the Processed customer status.

.. finish_front_flow

   .. check this flow!

 .. image:: /user/img/system/workflows/rfq/frontoffice/RFQNotes.png
 .. image:: /user/img/system/workflows/rfq/frontoffice/RFQCreateQuote.png

.. include:: /include/include-images.rst
   :start-after: begin

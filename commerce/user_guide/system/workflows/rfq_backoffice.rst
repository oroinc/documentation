.. _system--workflows--rfq-backoffice-workflow:

RFQ Management Flow Workflow
============================

.. contents:: :local:
   :depth: 1

Overview
--------

RFQ (Request For Quote) Management Flow workflow is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that an RFQ can go through in the management console.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **RFQ Management Flow** to open the flow.
   
On the RFQ Management Flow page, you can disable the workflow by clicking |IcDeactivate| **Deactivate** the workflow.

.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_management_flow_1.png

Within the Workflows list, you can perform the following actions for the RFQ Management Flow workflow:

* View the workflow: |IcView|
* Deactivate the workflow: |IcDeactivate|

.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_management_flow_2.png

RFQ Internal Statuses
---------------------

RFQ Management Flow and :ref:`Submission Flow <system--workflows--rfq-frontoffice-workflow>` workflows are interconnected. When both workflows are active, the following statuses are available:

1. Customer Statuses (correspond to RFQ Submission Flow on the RFQ page) are described in :ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>`.

.. start_internal_statuses

2. Internal Statuses (correspond to RFQ Management Flow on the RFQ page) are the statuses displayed in OroCommerce to the sales personnel:

	a) Open
	b) Processed
	c) More Information Requested
	d) Declined
	e) Cancelled 
	f) Deleted

.. note:: RFQs with internal status Deleted are not visible in the front store.

.. stop_internal_statuses

.. note:: Neither customer nor internal statuses can be edited or deleted.

.. start_csv_table_statuses

.. image:: /user_guide/img/system/workflows/rfq/backoffice/Statuses.png

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

.. stop_csv_table_statuses

.. note:: You can add and remove columns in the list by clicking |IcConfig| on the far right.

          .. image:: /user_guide/img/system/workflows/rfq/frontoffice/GridSettings.png

Steps and Transitions
---------------------

RFQ Management Flow consists of the following steps and transitions:

1. Steps:

	a) Open
	b) More Information Requested
	c) Processed
	d) Declined
	e) Cancelled
	f) Deleted
   
2. Transitions:
   
	a) For **Open**: Mark as Processed, Request More Information, Decline, Cancel, Delete.
	b) For **More Information Requested**: Cancel, Delete, Info Provided.
	c) For **Processed**: Delete.
	d) For **Declined**: Cancel, Delete, Reprocess.
	e) For **Cancelled**: Delete, Reprocess.
	f) For **Deleted**: Undelete.
	
.. note:: Please note that the Info Provided transition for the More Information Requested step is automatically triggered and it does not, therefore, take the form of a button in the interface.

.. image:: /user_guide/img/system/workflows/rfq/backoffice/RQF_steps_transitions_table.png

.. note:: Steps that follow the **Undelete** transition depend on the internal and/or customer statuses prior to deletion:
	
   -  If the previous internal status is Cancelled By Customer (step Cancelled), the internal status becomes Cancelled By Customer.
   -  If the current customer status is Submitted or Cancelled and the previous internal status is not Cancelled By Customer (step Open), the internal status becomes Open and the customer status becomes Submitted.
   -  If the current customer status is Requires Attention and the previous internal status is not Cancelled By Customer (step More Info Requested), the internal status becomes More Info Requested.

.. _system--workflows--rfq-backoffice-workflow-illustration:

As an illustration, let us go through a sample flow to see RFQ Management Flow in action:

1. Once an RFQ is received, it is automatically moved to the Open step with a possibility to mark this request processed, request more information, decline or delete it.
   
.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_management_flow_3.png

2. More information has been requested, the RFQ is now in the More Information requested step with Requires Attention customer status. The only transition available in this step is Delete.

.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_management_flow_4.png

.. note:: It is possible to create a quote or an order straight from the RFQ page by clicking on the corresponding buttons in the top right corner of the page.

3. More information has been provided, the sales person marks the RFQ processed and creates a quote straight from the RFQ view page.
   
   .. check if this workflow is correct!
   
.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_management_flow_5.png
   
.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_back_9.png




.. include:: /user_guide/include_images.rst
   :start-after: begin


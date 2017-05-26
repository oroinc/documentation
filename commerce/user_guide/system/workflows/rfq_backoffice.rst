.. _system--workflows--rfq-backoffice-workflow:

RFQ Backoffice Workflow 
=======================

Overview
--------

RFQ (Request For Quote) Backoffice Workflow is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that an RFQ can go through in the management console.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **RFQ Backoffice** to open the flow.
   
On the RFQ Backoffice page, you can perform the following actions:

* Clone the workflow - click |IcClone| **Clone** to clone the workflow.
* Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.

.. image:: /user_guide/img/system/workflows/rfq/backoffice/QuoteBackofficeFlow.png

Within the Workflows grid, you can perform the following actions for the RFQ Backoffice workflow:

* Clone the workflow: |IcClone|
* View the workflow: |IcView|
* Deactivate the workflow: |IcDeactivate|

.. image:: /user_guide/img/system/workflows/rfq/backoffice/RFQBackofficeGrid.png


RFQ Statuses
------------

RFQ Backoffice and :ref:`Frontoffice <system--workflows--rfq-frontoffice-workflow>` workflows are interconnected. When the RFQ Backoffice and Frontoffice workflows are active, the following statuses are available:

1. Internal Statuses (Marked RFQ Backoffice on the RFQ page) are the statuses displayed in OroCommerce to the sales personnel:

	a) Open
	b) Processed
	c) More Information Requested
	d) Declined
	e) Cancelled 
	f) Deleted

.. note:: RFQs with internal status Deleted are not visible in the front store.

2. :ref:`Customer Statuses <system--workflows--rfq-frontoffice-workflow>` (Marked RFQ Frontoffice on the RFQ page) are the statuses displayed to customers in the front store. In the management console, they are visible on the view page and in the grid:

	a) Submitted
	b) Pending Approval
	c) Requires Attention
	d) Cancelled


.. note:: These statuses cannot be edited or deleted.

.. image:: /user_guide/img/system/workflows/rfq/backoffice/Statuses.png

.. note:: You can add and remove columns in the grid by clicking |IcConfig| on the far right of the grid.

          .. image:: /user_guide/img/system/workflows/rfq/frontoffice/GridSettings.png


Steps and Transitions
---------------------

The RFQ Backoffice consists of the following steps and transitions:

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
   -  If the current customer status is Submitted or Cancelled and the previous internal status is not Cancelled By Customer (step Open), the internal status becomes Open and the customer status becomes 	Submitted.
   -  If the current customer status is Requires Attention and the previous internal status is not Cancelled By Customer (step More Info Requested), the internal status becomes More Info Requested.
	

As an illustration, let us go through a sample flow to see RFQ Backoffice in action:

1. Once an RFQ is received, it is automatically moved to the Open step with a possibility to mark this request processed, request more information, decline or delete it.
   

.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_back_3.png

.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_back_4.png


2. More information has been requested, the RFQ is now in the More Information requested step with Requires Attention customer status. The only transition available in this step is Delete.

.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_back_5.png

.. note:: It is possible to create a quote or an order straight from the RFQ page by clicking on the corresponding buttons in the top right corner of the page.

3. More information has been provided, the sales person marks the RFQ processed and creates a quote straight from the RFQ view page.
   
   .. check if this workflow is correct!
   
.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_back_8.1.png   

.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_back_8.png
   
.. image:: /user_guide/img/system/workflows/rfq/backoffice/rfq_back_9.png




.. include:: /user_guide/include_images.rst
   :start-after: begin


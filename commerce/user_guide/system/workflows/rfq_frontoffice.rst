.. _system--workflows--rfq-frontoffice-workflow:

RFQ Frontoffice Workflow 
========================

Overview
--------

RFQ (Request For Quote) Frontoffice Workflow is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that an RFQ can go through in the front store and the management console.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **RFQ Frontoffice** to open the flow.
   
  
On the RFQ Frontoffice page, you can perform the following actions:

* Clone the workflow - click |IcClone| **Clone** to clone the workflow.
* Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.
  
.. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQFrontOfficeView.png

Within the Workflows grid, you can perform the following actions for the RFQ Frontoffice workflow:

* Clone the workflow: |IcClone|
* View the workflow: |IcView|
* Deactivate the workflow: |IcDeactivate|

.. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQFrontOfficeGrid.png

RFQ Statuses
------------

:ref:`RFQ Backoffice <system--workflows--rfq-backoffice-workflow>` and Frontoffice workflows are interconnected. When the RFQ Backoffice and Frontoffice workflows are active, the following statuses are available:

1. :ref:`Internal Statuses <system--workflows--rfq-backoffice-workflow>` (Marked RFQ Backoffice on the RFQ page) are the statuses displayed in OroCommerce to the sales personnel:

	a) Open
	b) Processed
	c) More Information Requested
	d) Declined
	e) Cancelled 
	f) Deleted

.. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQsStepsView2.png

.. note:: RFQs with internal status Deleted are not visible in the front store.

2. Customer Statuses (Marked RFQ Frontoffice on the RFQ page) are the statuses displayed to customers in the front store. In the management console, they are visible on the view page and in the grid:

	a) Submitted
	b) Pending Approval
	c) Requires Attention
	d) Cancelled

.. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQsStatusView.png

|

.. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQsStepsView.png


.. note:: Neither internal nor customer statuses can be edited or deleted.

Statuses are also displayed in the grid:

.. image:: /user_guide/img/system/workflows/rfq/backoffice/Statuses.png

.. note:: You can add and remove columns in the grid by clicking |IcConfig| on the far right of the grid.

          .. image:: /user_guide/img/system/workflows/rfq/frontoffice/GridSettings.png

Steps and Transitions
---------------------

The RFQ Frontoffice consists of the following steps and transitions:

1. Steps:
   
   a) Submitted
   b) Requires Attention
   c) Cancelled
   
2. Transitions:
   
   a) For **Submitted**: Cancel, Decline, Request More Information
   b) For **Requires Attention**: Cancel, Decline, Provide More Information
   c) For **Cancelled**: Resubmit, Reopen

.. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQFrontOfficeTable.png

.. note:: Please note that the Request For Information, Reopen and Decline transitions are visible only in the management console for the sales personnel.

.. image:: /user_guide/img/system/workflows/rfq/backoffice/RFQFrontofficeGrid_2.png


As an illustration, let us go through a sample flow to see RFQ Frontoffice in action:

1. A customer user creates an RFQ in the front store. Once the RFQ is sent, its customer status is marked as Submitted.
   
   .. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQButton.png

   |

   .. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQCreate.png

2. In the management console, a sales representative sees the RFQ and requests more information. The RQF is now in the Requires Attention customer status.

   .. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQInformationRequested.png
   
3. The customer user receives the request in the front store, clicks Provide Information in the right corner of the page and replies to the message. The customer status is now Submitted.
   
   .. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQProvideInfo.png
   .. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQInformationProvided.png

4. The sales representative reads the reply in the Notes section of the RFQ page, marks the RFQ processed and creates a quote from the same page. The RFQ is now in the Processed customer status.

   .. check this flow!

 .. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQNotes.png
 .. image:: /user_guide/img/system/workflows/rfq/frontoffice/RFQCreateQuote.png

.. include:: /user_guide/include_images.rst
   :start-after: begin

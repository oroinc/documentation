.. _system--workflows:
.. _doc--workflows--actions--system:

System Workflows
----------------

Since system workflows are pre-implemented in the system, their management from the user interface is limited.

Navigate to **System > Workflows** in the main menu to reach the page with all system workflows.

From the grid, you can perform the following actions for system workflows:

- **View**: |IcView| (Go to the view page of the workflow).
- **Activate/Deactivate**: |IcCheck| / |IcTimes| (activate/deactivate the workflow).
- **Configure**: |IcSettings|

.. image:: /img/system/workflows/27_manage_wf_2.png

.. hint:: In case you need to alter a system workflow, clone it via the command line console under the different name and make the required changes.

.. For more information on how to clone a workflow, see :ref:`How to Clone a Workflow <workflows--actions--clone>`.

Available System Workflows
--------------------------

The following system workflows are provided out-of-the-box in the Oro application:

* :ref:`Checkout <system--workflows--checkout-workflow>`

* :ref:`Checkout with Consents <system--workflows--checkout-with-consents-workflow>`

* :ref:`Alternative Checkout <system--workflows--alternative-checkout-workflow>`

* :ref:`Single Page Checkout <system--workflows--single-page-checkout>`

* :ref:`Quote Backoffice <system--workflows--quote-backoffice-workflow>`

* :ref:`Backoffice Quote Flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>`

* :ref:`RFQ Backoffice <system--workflows--rfq-backoffice-workflow>`

* :ref:`RFQ Frontoffice <system--workflows--rfq-frontoffice-workflow>`

* :ref:`Task Flow <doc--workflows--task-flow>`

* :ref:`Unqualified Sales Lead Workflow <system--workflows--unqualified-sales-lead-workflow>`

.. toctree::
   :maxdepth: 1

   checkout
   consents_flow
   alternative_checkout
   single_page_checkout_workflow
   quote_flows_overview
   rfq_backoffice
   rfq_frontoffice
   task_flow
   unqualified_lead

.. include:: /img/buttons/include_images.rst
   :start-after: begin
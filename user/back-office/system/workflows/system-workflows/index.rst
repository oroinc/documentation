:oro_documentation_types: OroCRM, OroCommerce
:oro_show_local_toc: false

.. _system--workflows:
.. _doc--workflows--actions--system:

Manage System Workflows in the Back-Office
==========================================

Since system workflows are pre-implemented in the system, their management from the user interface is limited.

Navigate to **System > Workflows** in the main menu to reach the page with all system workflows.

From the grid, you can perform the following actions for system workflows:

- **View**: |IcView| (Go to the view page of the workflow).
- **Activate/Deactivate**: |IcCheck| / |IcTimes| (activate/deactivate the workflow).
- **Configure**: |IcSettings|

.. image:: /user/img/system/workflows/27_manage_wf_2.png

.. hint:: In case you need to alter a system workflow, clone it via the command line console under the different name and make the required changes.

.. For more information on how to clone a workflow, see :ref:`How to Clone a Workflow <workflows--actions--clone>`.

Available System Workflows
--------------------------

The following system workflows are provided out-of-the-box in the Oro application:

* :ref:`Checkout <system--workflows--checkout-workflow>`

* :ref:`Alternative Checkout <system--workflows--alternative-checkout-workflow>`

* :ref:`Single Page Checkout <system--workflows--single-page-checkout>`

* :ref:`Quote Workflows <system--workflows--quote--understanding>`

  * :ref:`Quote Management Flow <system--workflows-quote>`

  * :ref:`Backoffice Quote Flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>`

* :ref:`RFQ Management Flow <system--workflows--rfq-backoffice-workflow>`

* :ref:`RFQ Submission Flow <system--workflows--rfq-frontoffice-workflow>`

* :ref:`Task Flow <doc--workflows--task-flow>`

* :ref:`Unqualified Sales Lead Workflow <system--workflows--unqualified-sales-lead-workflow>`

* :ref:`Contact Request Workflow <admin-guide--workflows--contact-request-wf>`

.. toctree::
   :maxdepth: 1
   :hidden:

   Checkout Workflow <checkout>
   Alternative Checkout Workflow <alternative-checkout>
   Single Page Checkout Workflow <single-page-checkout-workflow>
   Quote Workflows <quote-flows-overview>
   RFQ Management Flow Workflow <rfq-backoffice>
   RFQ Submission Flow Workflow <rfq-frontoffice>
   Task Flow <task-flow>
   Unqualified Sales Lead Workflow <unqualified-lead>
   Contact Request Workflow <contact-request-wf>

.. include:: /include/include-images.rst
   :start-after: begin
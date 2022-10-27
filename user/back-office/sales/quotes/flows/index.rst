:oro_documentation_types: OroCommerce

.. _mc-sales-quotes-wf:

Use Quotes Workflows
====================

The quote management procedure depends on the active quote-related workflow. Out of the box, the Oro application supports Simple Quote Management and Quote Management with Approvals.

.. _simple-quote-management:

Simple Quote Management
-----------------------

.. note:: This flow is used when the :ref:`Quote Management Flow <system--workflows--quote-backoffice-workflow>` is active.

.. As an illustration, let us see the quote in action and walk through the steps a buyer and a sales manager may follow to communicate or negotiate for the sale:

.. include:: /user/back-office/system/workflows/system-workflows/quote-management-workflow.rst
   :start-after: start_quote_management_flow
   :end-before: finish_quote_management_flow

.. note:: See more information about the :ref:`simple quote management <system--workflows--quote-backoffice-workflow>` via the **Quote Management Flow**. You will learn additional details on the steps and actions available at every step.

.. _quote-management-with-approvals:

Quote Management with Approvals
-------------------------------

.. note:: This flows activates when the :ref:`Backoffice Quote Flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>` is enabled.

Read more in :ref:`Quote Management with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>` via the **Backoffice Quote Flow with Approvals**. You will learn additional details on the steps and actions available at every step.

Workflow-Specific Statuses and Steps
------------------------------------

The quote statuses and management steps may differ depending on the active workflow.

Follow the links below for more information on available steps and transitions.

* :ref:`Simple quote management (workflow-based) <simple-quote-management-steps>`
* :ref:`Quote management with approvals (workflow-based) <quote-management-with-approvals-steps>`
* :ref:`Basic quote lifecycle management actions <quotes--basic-lifecycle-management>` are used when quote-related workflows are disabled.

.. toctree::
   :hidden:

   steps-in-simple-quote-management
   steps-in-quote-management-with-approvals
   steps-in-quote-management-no-workflow
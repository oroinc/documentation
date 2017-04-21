.. _user-guide--sales--quotes:

Quotes
======

This topic contains the following sections:

.. contents:: :local:
   :depth: 2

Overview
--------

.. include:: /user_guide/overview/sales/quotes_overview.rst
   :start-after: begin

Configuration
-------------

Quote management and their use in many ways depend on the following:

* :ref:`Shipping Configuration <user-guide--shipping>`:

  - Create one or more shipping methods by configuring :ref:`integrations with the shipping providers <sys--integrations--manage-integrations--ups--flat-rate>`.

  - Set up :ref:`shipping rules <sys--shipping-rules>` that enable shipping methods for quotes/orders created with the specific destination areas and/or limit shipping availability via custom conditions.

  - Other. See the :ref:`Shipping Configuration <user-guide--shipping>` guide for more detailed information.

* :ref:`Payment Configuration <user-guide--payment>`:

  - Create one or more payment methods by configuring :ref:`integrations with the payment providers <sys--integrations--manage-integrations--payment-methods>`.

  - Set up :ref:`payment rules <sys--payment-rules>` that enable payment methods for orders created with the specific destination areas and/or limit payment availability via custom conditions.

  - Other. See the :ref:`Payment Configuration <user-guide--payment>` guide for more detailed information.

* :ref:`Quote Workflow <system--workflows--quote-backoffice-workflow>` - the flow of possible sequential actions that lead to quote state transitions. The workflow defines the way a sales manager can handle a quote in a particular state.

.. TODO replace the link to the workflow management with the link to the Quote backend workflow descriptions (when ready)

.. include:: create.rst
   :start-after: begin
   :end-before: finish

.. .. include:: viewlist.rst
   :end-before: finish

.. .. include:: view.rst
   :end-before: finish

.. include:: edit.rst
   :end-before: finish

Quote in Use
------------

As an illustration, let us see the quote in action and walk through the steps buyer and sales manager may follow to communicate or negotiate for the sale:

.. include:: /user_guide/system/workflows/quote_management_workflow.rst
   :start-after: quote_in_use
   :end-before: finish

See more information about the :ref:`Quote Workflow <system--workflows--quote-backoffice-workflow>` for details on the steps and actions available at every step.

.. toctree::
   :hidden:

   create

   edit

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. TODO add quote management by sales (workflow) and quote management by customer.
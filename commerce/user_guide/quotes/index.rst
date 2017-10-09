.. _user-guide--sales--quotes:

Quotes
======

This topic contains the following sections:

.. contents:: :local:
   :depth: 3

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

* Quote Management Process Configuration (Workflows):

  - For wider possibilities, ensure that one of the quote management workflows is activated:

    * :ref:`Quote Management Flow <system--workflows--quote-backoffice-workflow>` --- A simple quote management flow, where a sales person is not bound by any limitations and can handle the sale without supervision.
    * :ref:`Backoffice Quote flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>` (QBFA)--- A flow, where a sales person might have to get approval from the authorized person (e.g. their manager) before sending the quote with updated prices to the buyer.

    .. For more information, see the :ref:`Understanding Quote Workflows <system--workflows--quote--understanding>` topic.

  - For the QBFA workflow, ensure the :ref:`prerequisites <doc--workflows--backoffice-quote-flow-with-approvals--prerequisites>` are met and the system is properly configured for the approval process.

.. TODO replace the link to the workflow management with the link to the Quote backend workflow descriptions (when ready)

Managing Quotes
---------------

.. include:: create/index.rst
   :start-after: begin_create_quote
   :end-before: finish_create_quote

Also you can:

* :ref:`Edit a quote <quotes--actions--edit>`

* :ref:`Delete a quote <quotes--actions--delete>`

* Engage in activities:

  * :ref:`attach files to a quote <user-guide-activities-attachments>`
  * :ref:`make notes <user-guide-add-note>` on the quote
  * :ref:`create calendar events <doc-activities-events>` linked to the quote
  * :ref:`send emails <user-guide-using-emails>` related to the quote

.. .. include:: viewlist.rst
   :end-before: finish

Quote Stages and Transitions
----------------------------

.. include:: quote_states_by_flow/index.rst
   :start-after: begin_quote_states_by_flow
   :end-before: finish_quote_states_by_flow

.. .. include:: view.rst
   :end-before: finish

.. include:: flows/index.rst
   :end-before: finish_quotes_in_use


.. toctree::
   :hidden:

   create/index

   edit

   delete

   quote_states_by_flow/index

   flows/index

.. include:: /user_guide/include_images.rst
   :start-after: begin

.. TODO add quote management by sales (workflow) and quote management by customer.

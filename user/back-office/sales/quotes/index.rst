:oro_documentation_types: OroCommerce

.. _user-guide--sales--quotes:

Manage Quotes in the Back-Office
================================

.. hint:: This section is part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides a general understanding of the RFQ and quote concepts in OroCommerce.

A :term:`quote <Quote>` is used to negotiate with the customer (e.g., offer a better price, more convenient quantities, and additional services). A quote can be created in response to a customer's request for a quote or as a result of direct communication with the customer. Once the customer is happy with the offer in the quote and is ready to proceed with their order, they accept the quote.

Quote management and its use in many ways depends on the following:

* :ref:`Shipping Configuration <user-guide--shipping>`:

  - Create one or more shipping methods by configuring :ref:`integrations with the shipping providers <sys--integrations--manage-integrations--ups--flat-rate>`.
  - Set up :ref:`shipping rules <sys--shipping-rules>` that enable shipping methods for quotes/orders created with the specific destination areas and/or limit shipping availability via custom conditions.
  - Other. See the :ref:`Shipping Configuration <user-guide--shipping>` guide for more detailed information.

* :ref:`Payment Configuration <user-guide--payment>`:

  - Create one or more payment methods by configuring :ref:`integrations with the payment providers <sys--integrations--manage-integrations--payment-methods>`.
  - Set up :ref:`payment rules <sys--payment-rules>` that enable payment methods for orders created with the specific destination areas and/or limit payment availability via custom conditions.
  - Other. See the :ref:`Payment Configuration <user-guide--payment>` guide for more detailed information.

* Quote Management Process Configuration (Workflows):

  - For broader possibilities, ensure that one of the quote management workflows is activated:

    * :ref:`Quote Management Flow <system--workflows--quote-backoffice-workflow>` --- A simple quote management flow where a salesperson is not bound by any limitations and can handle the sale without supervision.
    * :ref:`Backoffice Quote flow with Approvals <doc--workflows--backoffice-quote-flow-with-approvals>` (QBFA)--- A flow where a salesperson might have to get approval from the authorized person (e.g., their manager) before sending the quote with updated prices to the buyer.

  - For the QBFA workflow, ensure the :ref:`prerequisites <doc--workflows--backoffice-quote-flow-with-approvals--prerequisites>` are met, and the system is properly configured for the approval process.

To learn more on how to create and use quotes and their workflows, check out the topics below:

.. toctree::
   :maxdepth: 1

   create/index
   manage
   guest-quote
   flows/index
   shipping-method-for-quotes

.. include:: /include/include-images.rst
   :start-after: begin
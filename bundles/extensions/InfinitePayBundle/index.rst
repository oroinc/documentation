.. _bundle-docs-extensions-infinitepay:

OroInfinitePayBundle
====================

|OroInfinitePayBundle| adds |Infinite Pay| |integration| into Oro applications.

The bundle helps admin users to enable and configure Infinite Pay |payment method| for customer orders, and therefore allows customers to pay for orders with Invoices attested by Infinite Pay service.

For prerequisites and steps on configuring the integration, please see :ref:`user configuration documentation <user-guide--payment--payment-providers-overview--infinitepay>`.

**Checkout**

For a successful payment request to InfinitePay the customer must also provide additional information on the payment step.
The following fields will be shown on the payment step if InfinitePay was selected as payment provider:

- company
- email address
- legal form (i.e., Freelancer, GbR)

**Payment Finalization**

To set an invoice as paid, there are two approaches. The first one is auto-detection by InfinitePay. This requires the shop owner to book this option with InfinitePay and making the company bank account accessible to InfinityPay. The second option is to inform InfinitePay when the money for an order (respective invoice) was received. This is done by triggering **Apply Transaction** to InfinityPay referencing the order id.

.. admonition:: Business Tip

   Considering |business to business eCommerce| for your company? Our comprehensive guide packed with relevant stats and examples will help you decide.

**Related Documentation**

* :ref:`Prerequisites for InfinitePay Integration <user-guide--payment--prerequisites--infinitepay>`
* :ref:`InfinitePay Integration <sys--integrations--manage-integrations--infinitepay>`
* :ref:`Payment Configuration Concept Guide <user-guide--payment>`
* :ref:`Payments at Checkout (Illustration) <doc--payment--checkout>`
* :ref:`System Payment Configuration <configuration--guide--commerce--configuration--payment>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
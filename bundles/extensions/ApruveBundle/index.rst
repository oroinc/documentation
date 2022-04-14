.. _bundle-docs-extensions-apruve:

OroApruveBundle
===============

|OroApruveBundle| adds |integration| with |Apruve| B2B Credit Management and Automation Platform in Oro applications.

The bundle allows admin users to enable and configure the |Apruve payment method| available |at the checkout| process and enables customers to pay for orders by credit obligations attested by Apruve.

Technical Components
--------------------

1. Integration type:

   - ``Oro\Bundle\ApruveBundle\Integration\ApruveChannelType``
   - ``Oro\Bundle\ApruveBundle\Integration\ApruveTransport``

2. Payment method:

   - ``Oro\Bundle\ApruveBundle\Method\ApruvePaymentMethod``
   - see namespace ``Oro\Bundle\ApruveBundle\Method\PaymentAction`` for concrete payment method actions implementations

3. Apruve-specific models and builders for them:

   - see namespaces ``Oro\Bundle\ApruveBundle\Apruve\Model`` and ``Oro\Bundle\ApruveBundle\Apruve\Builder``

4. Apruve Rest client:

   - ``Oro\Bundle\ApruveBundle\Client\ApruveRestClient`` - works with ``RestClientFactoryInterface`` under the hood
   - ``Oro\Bundle\ApruveBundle\Client\Request\ApruveRequest`` - requests DTO

5. Apruve webhooks:

   - ``Oro\Bundle\ApruveBundle\Controller\WebhookController`` - entry point of webhooks processing
   - ``Oro\Bundle\ApruveBundle\EventListener\Callback\PaymentCallbackListener`` - handles "return" payment event, which is triggered when a user authorizes a payment. Delegates further processing to ``Oro\Bundle\ApruveBundle\Method\PaymentAction\AuthorizePaymentAction``

PaymentTransactions Lifecycle
-----------------------------

1. PaymentTransaction 1 is created in ``Oro\Bundle\ApruveBundle\Method\PaymentAction\PurchasePaymentAction`` when a customer clicks Submit at the last step of the checkout process.

2. If a customer authorizes payment in the Apruve lightbox, PaymentTransaction 1 is updated with Apruve Order Id and is marked as successful in ``Oro\Bundle\ApruveBundle\Method\PaymentAction\AuthorizePaymentAction``. Otherwise, nothing is changed.

3. Once payment is authorized, it can be invoiced using the "Send Invoice" button in the admin area on the Order view page in the "Payment History" section. When you click "Send Invoice", PaymentTransaction 2 is created along with Apruve Invoice in ``Oro\Bundle\ApruveBundle\Method\PaymentAction\InvoicePaymentAction``. As soon as the Apruve Invoice is created successfully, PaymentTransaction 3 is created along with the Apruve Shipment entity in ``Oro\Bundle\ApruveBundle\Method\PaymentAction\ShipmentPaymentAction``.

4. When a customer fulfills an invoice, Apruve notifies about it via webhook `invoice.closed`, which is processed starting from in ``Oro\Bundle\ApruveBundle\Controller\WebhookController``. In case of success, PaymentTransaction 4 is created and marked as successful. If a customer does not pay for the Apruve Invoice in time, it is marked as overdue and silently canceled on the Apruve side.


Things to Consider:

1. Apruve does not properly respect the `price_total_cents` property of Apruve LineItem. It is not taken into account when a secure hash is generated from Apruve Order on the Apruve side, although Apruve takes `amount_cents`. That is why, `amount_cents` property is used in the Apruve LineItem entity. See ``Oro\Bundle\ApruveBundle\Apruve\Builder\LineItem\ApruveLineItemBuilder`` and ``Oro\Bundle\ApruveBundle\Apruve\Generator\OrderSecureHashGenerator`` for details. On the other hand, `price_total_cents` is required for the line items which reside in the Apruve Invoice, therefore, both of these properties are present in the Apruve LineItem entity.

2. Apruve wants to be notified about shipments from merchants who sell physical goods but does not need this for other merchant types. Therefore, it does not fulfill invoices when it is not notified of shipment (when the Shipment entity is not created via API) for physical goods merchants. To unify the behavior of all merchant types, Apruve is always notified about shipment regardless of the type of the goods sold. Shipment entity is created in Apruve and Invoice entity when the "Send Invoice" button is clicked on the Order view page in the "Payment History" section.

FAQs
----

1. *Is the customer forwarded to the Apruve-hosted payment page during checkout?*

   No, customers do not leave the commerce application during the checkout process. The user has to authorize payment in the Apruve popup (lightbox) at the last step of the checkout.

2. *How can I log in/register in the Apruve sandbox?*

   You have to ask Apruve Support (``support@apruve.com``) for a test merchant and buyer account.

3. *I have a corporate Apruve account, but it is not accepted during the checkout process*.

   Corporate accounts differ. You should have a corporate account associated precisely with the merchant account you are dealing with.

.. include:: /include/include-links-dev.rst
   :start-after: begin

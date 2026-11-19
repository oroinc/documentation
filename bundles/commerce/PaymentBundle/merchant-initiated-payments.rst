:title: Merchant-Initiated Payments in OroCommerce

.. meta::
   :description: Learn how OroPaymentBundle stores payment credentials in a merchant-initiated payment contract during a checkout and charges them later without the customer.

.. _bundle-docs--commerce--payment-bundle--merchant-initiated-payments:

Merchant-Initiated Payments
===========================

A merchant-initiated payment (MIP) is a payment that the merchant runs on stored credentials while the customer is not present. OroPaymentBundle provides the framework for merchant-initiated payments. A payment integration adds the gateway calls.

The framework has two kinds of transactions:

* A customer-initiated transaction (CIT) is the payment that the customer makes in the checkout. During this payment, the payment method stores the credentials of the customer in a merchant-initiated payment contract.
* A merchant-initiated transaction (MIT) is a later payment that the merchant runs on the credentials of the contract, for example a charge after the shipment.

The contract has one of the following types. The ``\Oro\Bundle\PaymentBundle\Method\MerchantInitiatedPaymentTypeInterface`` interface defines them as constants:

* ``recurring`` --- Charges at regular intervals until the customer cancels, for example a subscription.
* ``installment`` --- A fixed number of charges on scheduled dates that split one purchase.
* ``unscheduled`` --- Charges with no fixed schedule that an event triggers, for example a delayed charge after the shipment.

OroPaymentBundle provides the contract entity and the services that manage and find contracts. It also provides the actions that charge and revoke a contract, the events, the checkout flow that collects the consents, and the back-office operations. A payment integration implements the payment method interfaces described below. For a step-by-step example, see :ref:`Add Merchant-Initiated Payments to a Payment Method <dev-extend-commerce-payment-merchant-initiated-payments>`.

Payment Method Contracts
------------------------

A payment method that supports merchant-initiated payments implements ``\Oro\Bundle\PaymentBundle\Method\MerchantInitiatedPaymentMethodInterface``. The interface extends ``\Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface`` with the following methods:

* ``isMerchantInitiatedPaymentEnabled()`` --- Returns ``true`` when the merchant turned merchant-initiated payments on in the integration settings.
* ``getSupportedMerchantInitiatedPaymentTypes()`` --- Returns the types that the method supports, as values of ``MerchantInitiatedPaymentTypeInterface``.
* ``getMerchantInitiatedPaymentConsents(PaymentContextInterface $paymentContext)`` --- Returns the ``\Oro\Bundle\ConsentBundle\Entity\Consent`` entities that the customer must accept in the checkout. An empty array means that no consent is required.
* ``isMerchantInitiatedPaymentSetupApplicable(PaymentContextInterface $paymentContext)`` --- Returns ``true`` when the method can set up a contract for the payment context.
* ``isMerchantInitiatedPaymentApplicable(PaymentContextInterface $paymentContext, MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract)`` --- Returns ``true`` when the method can run a merchant-initiated transaction on the credentials of the contract.
* ``revokeMerchantInitiatedPaymentContract(MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract)`` --- Cancels the credentials at the gateway when the gateway supports it. It returns the response of the gateway in the same format as ``execute()``.

The integration settings and the payment method configuration implement two more interfaces:

* ``\Oro\Bundle\PaymentBundle\Entity\MerchantInitiatedPaymentSettingsInterface`` --- The transport entity of the integration. It has the switch ``isMerchantInitiatedPaymentEnabled()`` with its setter, and the collection ``getMerchantInitiatedPaymentConsents()`` with an adder and a remover.
* ``\Oro\Bundle\PaymentBundle\Method\Config\MerchantInitiatedPaymentConfigInterface`` --- The payment method configuration. It extends ``\Oro\Bundle\PaymentBundle\Method\Config\PaymentConfigInterface`` with ``isMerchantInitiatedPaymentEnabled()`` and ``getMerchantInitiatedPaymentConsents()``.

The ``\Oro\Bundle\PaymentBundle\Method\MerchantInitiatedPaymentOptionsInterface`` interface defines the keys of the transaction options of a merchant-initiated transaction:

* ``customerActionRequired`` --- The payment method sets it to ``true`` on a soft decline, when the customer must pay in the storefront.
* ``reason`` --- The reason of the merchant for the transaction, as entered in the back-office.

OroPaymentBundle provides two form types for the integration settings form:

* ``\Oro\Bundle\PaymentBundle\Form\Type\MerchantInitiatedPaymentEnabledType`` --- The **Merchant-Initiated Payments** checkbox.
* ``\Oro\Bundle\PaymentBundle\Form\Type\MerchantInitiatedPaymentConsentType`` --- The **Consents** multiple select. It uses the ``oro_consent_list`` autocomplete. Add this field only when the ``consents`` feature is enabled.

.. _bundle-docs--commerce--payment-bundle--merchant-initiated-payment-contract:

Merchant-Initiated Payment Contract
-----------------------------------

The ``\Oro\Bundle\PaymentBundle\Entity\MerchantInitiatedPaymentContract`` entity is the agreement of a customer to merchant-initiated payments. It stores the credentials that the payment method keeps on file. The contract has the following fields:

* ``type`` --- One of the ``MerchantInitiatedPaymentTypeInterface`` values.
* ``paymentMethod`` --- The identifier of the payment method that set up the contract.
* ``active`` --- ``true`` while the contract can be charged.
* ``revokedAt`` --- The date of the revocation. The ``isRevoked()`` method returns ``true`` when the date is set.
* ``credentialsOnFile`` --- An array that the payment method defines, for example a gateway token. The ``secure_array`` column type encrypts it in the database. The field is hidden in the user interface and excluded from the audit.
* ``customerInitiatedTransaction`` --- The payment transaction of the checkout that set up the contract.
* ``acceptedConsents`` --- The ``\Oro\Bundle\ConsentBundle\Entity\ConsentAcceptance`` entities that the customer accepted for this contract. The contract owns them. When the contract removes an acceptance, the acceptance is deleted.
* ``customerUser`` --- The customer user who owns the contract. The contract has the frontend owner type ``FRONTEND_USER`` and belongs to the ``orders`` ACL category.
* ``customer`` --- The ``\Oro\Bundle\CustomerBundle\Entity\Customer`` entity that the contract belongs to. It is the customer field of the frontend ownership and the ownership fallback of the contract. When the customer user is removed, the contract keeps its customer.
* ``organization`` --- The organization of the contract.

A bundle that targets contracts at its entity adds an extend many-to-one relation to the contract. The relation name is ``target`` followed by the short class name of the entity. OroOrderBundle adds the ``targetOrder`` relation that points to the order of the checkout.

Contract States
^^^^^^^^^^^^^^^

A contract has the following states:

* New --- The checkout created the contract. The contract is not active and not revoked, and it has no credentials.
* Active --- The payment method activated the contract with the credentials. The contract can be charged.
* Inactive --- The contract was deactivated and keeps its credentials. A new activation makes it active again.
* Revoked --- The contract is revoked and its credentials are cleared. The state is final. A revoked contract cannot be activated again.

Payment Transaction Fields
^^^^^^^^^^^^^^^^^^^^^^^^^^

The ``\Oro\Bundle\PaymentBundle\Entity\PaymentTransaction`` entity has two fields for merchant-initiated payments:

* ``merchantInitiatedPaymentContract`` --- The contract that a customer-initiated transaction sets up, or that a merchant-initiated transaction charges. The ``payment_purchase`` action sets it on a customer-initiated transaction when it receives the ``merchantInitiatedPaymentContract`` option. The purchase action of a merchant-initiated transaction sets it on the new transaction.
* ``merchantInitiatedTransaction`` --- ``true`` when the merchant runs the transaction without the customer. A payment method reads this flag to tell a merchant-initiated transaction from a customer-initiated one.

The ``\Oro\Bundle\CheckoutBundle\Entity\Checkout`` entity has the one-to-one relation ``merchantInitiatedPaymentContract``. The checkout persists the contract together with its own changes.

Contract Manager
----------------

The ``oro_payment.merchant_initiated_payment.contract_manager`` service (``\Oro\Bundle\PaymentBundle\MerchantInitiatedPayment\MerchantInitiatedPaymentContractManager``) changes the state of a contract:

* ``activateContract(MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract, array $credentialsOnFile)`` --- Stores the credentials and makes the contract active. It dispatches the activated event when the contract was not active before. It throws a ``\LogicException`` when the contract is revoked.
* ``deactivateContract(MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract)`` --- Makes the contract inactive and keeps the credentials. It dispatches the deactivated event. It does nothing when the contract is not active.
* ``revokeContract(MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract)`` --- Calls ``revokeMerchantInitiatedPaymentContract()`` of the payment method, then sets the revocation date, makes the contract inactive, and clears the credentials. It dispatches the revoked event and returns the response of the payment method. It does nothing and returns an empty array when the contract is already revoked. The manager does not catch the exceptions of the payment method. When ``revokeMerchantInitiatedPaymentContract()`` throws an exception, the exception goes to the caller. The contract stays unchanged. It is not revoked, it keeps its active state, and it keeps its credentials.

The manager does not flush the entity manager. The caller flushes the changes.

Contract Provider
-----------------

The ``oro_payment.merchant_initiated_payment.contract_provider`` service (``\Oro\Bundle\PaymentBundle\MerchantInitiatedPayment\MerchantInitiatedPaymentContractProvider``) finds contracts without a logged-in customer user:

* ``getActiveContracts(CustomerUser $customerUser, ?string $paymentMethodIdentifier = null, ?string $merchantInitiatedPaymentType = null)`` --- Returns the active contracts of the customer user.
* ``getActiveContractsByEntity(object $entity, ?string $paymentMethodIdentifier = null, ?string $merchantInitiatedPaymentType = null)`` --- Returns the active contracts that target the entity, for example an order.
* ``hasContractsByEntity(object $entity)`` --- Returns ``true`` when at least one contract in any state targets the entity.

A contract is active when its ``active`` field is ``true`` and its ``revokedAt`` field is empty. The provider returns the newest contract first. The two entity methods use the target relation of the entity class, so the entity class must have the relation described above.

The ``oro_payment.merchant_initiated_payment.contract_target_entity_provider`` service (``\Oro\Bundle\PaymentBundle\MerchantInitiatedPayment\MerchantInitiatedPaymentContractTargetEntityProvider``) works in the other direction. Its ``getTargetEntity()`` method returns the entity that a contract targets. The service is public, so an operation can call it with the ``@call_service_method`` action.

Actions
-------

OroPaymentBundle provides two actions for the :ref:`actions and operations <bundle-docs-platform-action-bundle-operations>` of OroActionBundle.

merchant_initiated_payment_purchase
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The ``@merchant_initiated_payment_purchase`` action (``\Oro\Bundle\PaymentBundle\Action\MerchantInitiatedPaymentPurchaseAction``) charges the credentials of a contract without the customer. The action creates a merchant-initiated payment transaction, runs it through the payment method of the contract, and saves it. The following options are required:

* ``object`` --- The entity that the transaction pays, for example the order.
* ``amount`` --- The amount to charge.
* ``currency`` --- The currency of the amount.
* ``contract`` --- The contract to charge.

The following options are optional:

* ``paymentAction`` --- The payment action of the transaction. The default is ``purchase``.
* ``transactionOptions`` --- The transaction options of the transaction, for example the ``reason`` key.
* ``attribute`` --- The property path that receives the result.

The result is an array with the following keys:

* ``successful`` --- ``true`` when the transaction is successful.
* ``customerActionRequired`` --- ``true`` when the payment method set the ``customerActionRequired`` transaction option.
* ``merchantInitiatedTransaction`` --- The payment transaction, or ``null`` when no transaction was created.
* ``paymentMethodResponse`` --- The response of the payment method.

The action ignores the state of the contract. The caller makes sure that the contract is active, that merchant-initiated payments are enabled, and that the payment method accepts the contract. For an example, see the ``oro_payment_merchant_initiated_payment_contract_charge`` operation below. The action creates no transaction when the payment method of the contract does not exist or does not implement ``MerchantInitiatedPaymentMethodInterface``. It also creates no transaction when a listener cancels the payment.

To charge an order with the action, add it to an operation or a workflow:

.. code-block:: yaml

    - '@merchant_initiated_payment_purchase':
        object: $.order
        amount: $.order.total
        currency: $.order.currency
        contract: $.merchantInitiatedPaymentContract
        transactionOptions:
            reason: 'Charge after shipment'
        attribute: $.result

merchant_initiated_payment_revoke
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The ``@merchant_initiated_payment_revoke`` action (``\Oro\Bundle\PaymentBundle\Action\MerchantInitiatedPaymentRevokeAction``) revokes a contract through the contract manager and flushes the changes. The ``contract`` option is required. The ``attribute`` option is optional and receives an array with the following keys:

* ``successful`` --- ``true`` when the contract is revoked.
* ``merchantInitiatedPaymentContract`` --- The contract.
* ``paymentMethodResponse`` --- The response of the payment method.

When ``revokeContract()`` throws an exception, the action logs the error and the contract state to the ``oro_payment`` channel. If the contract is revoked anyway, because a listener of the revoked event failed, the action flushes the changes, and ``successful`` is ``true``. Otherwise, the contract stays unchanged, and ``successful`` is ``false``.

Events
------

OroPaymentBundle dispatches the following events. The events have no string name. A listener subscribes to the event class:

* ``\Oro\Bundle\PaymentBundle\Event\BeforeMerchantInitiatedPaymentEvent`` --- Dispatched before a merchant-initiated transaction goes to the payment method. The event carries the transaction. A listener calls ``cancelMerchantInitiatedPayment()`` to cancel the payment. The action then creates no transaction.
* ``\Oro\Bundle\PaymentBundle\Event\AfterMerchantInitiatedPaymentEvent`` --- Dispatched after a merchant-initiated transaction is executed and saved. The event carries the transaction and the response of the payment method.
* ``\Oro\Bundle\PaymentBundle\Event\MerchantInitiatedPaymentContractActivatedEvent`` --- Dispatched when a contract becomes active. The event carries the contract.
* ``\Oro\Bundle\PaymentBundle\Event\MerchantInitiatedPaymentContractDeactivatedEvent`` --- Dispatched when a contract becomes inactive and keeps its credentials. The event carries the contract.
* ``\Oro\Bundle\PaymentBundle\Event\MerchantInitiatedPaymentContractRevokedEvent`` --- Dispatched when a contract is revoked and its credentials are cleared. The event carries the contract.
* ``\Oro\Bundle\PaymentBundle\Event\ApplicablePaymentMethodsEvent`` --- Dispatched by ``\Oro\Bundle\PaymentBundle\Method\Provider\ApplicablePaymentMethodsProvider`` with the payment methods that apply to a payment context. A listener calls ``removePaymentMethod()`` to remove a method that its rule refuses.

To react to a new active contract, register a listener for the event class:

.. code-block:: yaml

    services:
        acme_payment.event_listener.merchant_initiated_payment_contract_activated:
            class: Acme\Bundle\PaymentBundle\EventListener\MerchantInitiatedPaymentContractActivatedListener
            tags:
                - { name: kernel.event_listener, event: Oro\Bundle\PaymentBundle\Event\MerchantInitiatedPaymentContractActivatedEvent, method: onContractActivated }

Sequences
---------

The following sequences show how the parts work together.

Set Up a Contract in the Checkout
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. A listener of the ``oro_checkout.actualize`` event creates a contract with a type and sets it on the checkout.
2. The payment step shows only the payment methods that can set up a contract of this type. The customer selects a payment method and accepts its consents.
3. The checkout stores the payment method, the accepted consents, the order, and the customer user on the contract.
4. The ``payment_purchase`` action receives the contract in the ``merchantInitiatedPaymentContract`` option and links the customer-initiated transaction and the contract to each other.
5. The payment method finds the contract on the transaction, stores the credentials, and calls ``activateContract()`` of the contract manager.

Run a Merchant-Initiated Transaction
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. The caller finds an active contract with the contract provider, for example the contract of an order.
2. The caller makes sure that ``isMerchantInitiatedPaymentEnabled()`` and ``isMerchantInitiatedPaymentApplicable()`` of the payment method return ``true``.
3. The caller runs the ``@merchant_initiated_payment_purchase`` action with the contract.
4. The action creates a transaction with the ``merchantInitiatedTransaction`` flag and the contract, and dispatches the before event.
5. The payment method runs the transaction on the credentials of the contract. The action saves the transaction and dispatches the after event.

Revoke a Contract
^^^^^^^^^^^^^^^^^

1. An operation, a listener, or custom code calls ``revokeContract()`` of the contract manager, or runs the ``@merchant_initiated_payment_revoke`` action.
2. The manager calls ``revokeMerchantInitiatedPaymentContract()`` of the payment method, which cancels the credentials at the gateway.
3. The manager sets the revocation date, makes the contract inactive, and clears the credentials.
4. The manager dispatches the revoked event.

When the payment method throws an exception in step 2, the manager skips steps 3 and 4, and the exception goes to the caller. The contract stays unchanged. The ``@merchant_initiated_payment_revoke`` action catches the exception and returns ``successful`` as ``false``.

Checkout Integration
--------------------

OroCheckoutBundle sets up the contract during the checkout.

The payment context of a checkout carries the type of the contract. The ``getMerchantInitiatedPaymentType()`` method of ``\Oro\Bundle\PaymentBundle\Context\PaymentContextInterface`` returns the type of the contract of the checkout, or ``null`` when the checkout has no contract. ``\Oro\Bundle\CheckoutBundle\Factory\CheckoutPaymentContextFactory`` sets it with ``setMerchantInitiatedPaymentType()`` of the context builder.

The core does not create a contract on its own. A solution creates it in a listener of the ``oro_checkout.actualize`` event. The listener calls ``createContractForCheckout()`` of the ``oro_checkout.factory.merchant_initiated_payment_contract`` service (``\Oro\Bundle\CheckoutBundle\Factory\MerchantInitiatedPaymentContractFactory``) with the checkout and the type, and sets the contract on the checkout. The factory sets the type, the customer user, the customer, and the organization of the checkout on the contract:

.. code-block:: php

    public function onActualize(CheckoutActualizeEvent $event): void
    {
        $checkout = $event->getCheckout();
        if (null !== $checkout->getMerchantInitiatedPaymentContract()) {
            return;
        }

        $contract = $this->merchantInitiatedPaymentContractFactory->createContractForCheckout(
            $checkout,
            MerchantInitiatedPaymentTypeInterface::UNSCHEDULED
        );
        $checkout->setMerchantInitiatedPaymentContract($contract);
    }

When the payment context has a type, the ``\Oro\Bundle\PaymentBundle\EventListener\MerchantInitiatedPayment\FilterMerchantInitiatedPaymentApplicablePaymentMethodsListener`` listener of the ``ApplicablePaymentMethodsEvent`` event keeps only the payment methods that implement ``MerchantInitiatedPaymentMethodInterface`` and return ``true`` from ``isMerchantInitiatedPaymentSetupApplicable()``.

The payment step renders the consents of each payment method under the method. The ``payment_methods`` block type has the ``merchantInitiatedPaymentConsentViews`` option. The checkout layouts fill it from the ``oro_payment_merchant_initiated_payment_consent`` layout data provider (``\Oro\Bundle\PaymentBundle\Layout\DataProvider\MerchantInitiatedPaymentConsentViewProvider``). The provider returns the consents of each applicable payment method by payment method identifier. The ``oropayment/js/app/views/merchant-initiated-payment-consent-item-view`` view renders a consent checkbox and writes the acceptance into a hidden field.

The hidden field is the ``merchant_initiated_payment_consents`` workflow attribute. Its property path is ``checkout.merchantInitiatedPaymentContract``. The ``continue_to_order_review`` transition of the multi-step checkout and the ``save_state`` and ``create_order`` transitions of the single page checkout render it with the ``\Oro\Bundle\PaymentBundle\Form\Type\MerchantInitiatedPaymentConsentAcceptancesType`` form type. The form type takes the contract in the ``merchant_initiated_payment_contract`` option and merges the submitted acceptances into the contract on submit.

The ``\Oro\Bundle\CheckoutBundle\Validator\Constraints\MerchantInitiatedPaymentConsentsAccepted`` constraint on the checkout entity makes sure that the customer accepted every consent of the selected payment method. It belongs to the ``checkout_payment_checks`` validation group, which the ``continue_to_order_review`` and ``create_order`` transitions use. It also belongs to the ``checkout_purchase_pre_checks`` group, which the ``place_order`` and ``purchase`` transitions and the storefront checkout API use. The ``oro_checkout.provider.merchant_initiated_payment_required_consents`` service returns the consents that the payment method of a checkout requires.

The ``oro_checkout.action_group.merchant_initiated_payment_contract_actions`` service (``\Oro\Bundle\CheckoutBundle\Workflow\ActionGroup\MerchantInitiatedPaymentContractActions``) has the ``updateContract()`` method. It sets the payment method of the checkout on the contract and removes the acceptances of consents that the method does not require. When the checkout has an order, it also sets the order, its customer user, and its customer on the contract. The ``continue_to_order_review`` and ``place_order`` transitions of the multi-step checkout and the ``create_order`` and ``purchase`` transitions of the single page checkout call it.

The transitions that return to an earlier step clear the payment method of the contract and remove its acceptances. The ``payment_error`` transition removes the unpaid order and clears the order and the customer-initiated transaction of the contract. The contract stays on the checkout, so the customer can try again.

Back-Office Operations
----------------------

The order view page in the back-office shows the **Payment Contracts** section when the order has contracts. The section renders the ``order-merchant-initiated-payment-contracts-grid`` datagrid of OroOrderBundle. The grid extends the ``merchant-initiated-payment-contracts-grid`` datagrid of OroPaymentBundle and filters the contracts by the ``targetOrder`` relation.

OroPaymentBundle provides two base operations that are not bound to a datagrid:

* ``oro_payment_merchant_initiated_payment_contract_charge`` --- Opens a dialog with the **Amount** and **Reason** fields, then runs the ``@merchant_initiated_payment_purchase`` action on the target entity of the contract. The reason goes into the ``reason`` transaction option. The operation is available when the user has the ``CHARGE_AUTHORIZED_PAYMENTS`` permission on the target entity and the contract is active and not revoked. Merchant-initiated payments must be enabled, and the payment method must accept the contract. The operation builds the payment context of the target entity with the public ``oro_payment.context.factory.entity_payment_context`` service.
* ``oro_payment_merchant_initiated_payment_contract_revoke`` --- Asks for a confirmation, then runs the ``@merchant_initiated_payment_revoke`` action. The operation shows a success flash message when the ``successful`` result is ``true``, and an error flash message when it is ``false``. The operation is available when the user has the ``EDIT`` permission on the contract and the contract is not revoked.

OroOrderBundle binds the operations to its grid. The ``oro_order_merchant_initiated_payment_charge`` and ``oro_order_merchant_initiated_payment_contract_revoke`` operations extend the base operations and add only the ``datagrids`` option.

To add contracts to another entity, do the following:

1. Add the ``target<ShortClassName>`` extend relation from the contract to the entity in a migration, as the ``\Oro\Bundle\OrderBundle\Migrations\Schema\v7_1_0_4\AddTargetOrderToMerchantInitiatedPaymentContract`` migration does for the order.
2. Register a payment context factory for the entity with the ``oro_payment.supports_entity_payment_context_factory`` tag, so that the charge operation gets a payment context.
3. Add a datagrid that extends ``merchant-initiated-payment-contracts-grid`` and filters by the new relation.
4. Add two operations that extend the base operations and name the datagrid in the ``datagrids`` option:

.. code-block:: yaml

    operations:
        acme_invoice_merchant_initiated_payment_charge:
            extends: oro_payment_merchant_initiated_payment_contract_charge
            datagrids:
                - invoice-merchant-initiated-payment-contracts-grid

        acme_invoice_merchant_initiated_payment_contract_revoke:
            extends: oro_payment_merchant_initiated_payment_contract_revoke
            datagrids:
                - invoice-merchant-initiated-payment-contracts-grid

Customer User Removal
---------------------

When a customer user is deleted, the ``\Oro\Bundle\PaymentBundle\EventListener\MerchantInitiatedPayment\RevokeMerchantInitiatedPaymentContractOnCustomerUserRemovalListener`` listener revokes the contracts of that user after the deletion. For each contract, the listener clears the customer user and calls ``revokeContract()`` of the contract manager. The contract keeps its customer. The payment method cancels the credentials at the gateway, and the manager dispatches the revoked event.

When ``revokeContract()`` throws an exception for a contract, the listener logs the error and the contract state to the ``oro_payment`` channel, and continues with the other contracts. A contract that the payment method fails to revoke stays unchanged, except for the cleared customer user. Then the listener flushes the changes.

.. include:: /include/include-links-dev.rst
   :start-after: begin

:title: Add Merchant-Initiated Payments to a Payment Method in OroCommerce

.. meta::
   :description: Learn how a payment method integration stores the credentials of a customer in a merchant-initiated payment contract and charges them later, with the Payment Term method as the example.

.. _dev-extend-commerce-payment-merchant-initiated-payments:

Add Merchant-Initiated Payments to a Payment Method
===================================================

This topic shows how a payment method integration adds support for merchant-initiated payments (MIP). A merchant-initiated payment is a payment that the merchant runs on stored credentials while the customer is not present. For the concepts, the contract entity, the actions, and the events, see :ref:`Merchant-Initiated Payments <bundle-docs--commerce--payment-bundle--merchant-initiated-payments>`.

The example is the Payment Term method of OroPaymentTermBundle. The method has no gateway, so its credential is the identifier of the payment term of the customer. The steps apply to any payment method that is built as described in :ref:`Create Payment Method Integrations <dev-extend-commerce-payment-create-payment-method>`. Replace the Payment Term classes with the classes of your integration.

The steps are the following:

1. Add the settings to the transport entity.
2. Add the fields to the settings form.
3. Add the settings to the payment method configuration.
4. Implement the payment method interface.
5. Activate the contract in the customer-initiated transaction.
6. Charge the contract in a merchant-initiated transaction.
7. Pass the contract manager to the method factory.
8. Test the integration.

Add the Settings to the Transport Entity
----------------------------------------

The transport entity stores the **Merchant-Initiated Payments** switch and the consents that the customer accepts in the checkout. Make the entity implement ``\Oro\Bundle\PaymentBundle\Entity\MerchantInitiatedPaymentSettingsInterface``. Add a nullable boolean column for the switch and a many-to-many relation to ``\Oro\Bundle\ConsentBundle\Entity\Consent`` for the consents. The column is nullable because all transports share one table:

.. code-block:: php

    namespace Oro\Bundle\PaymentTermBundle\Entity;

    use Doctrine\Common\Collections\ArrayCollection;
    use Doctrine\Common\Collections\Collection;
    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\ConsentBundle\Entity\Consent;
    use Oro\Bundle\IntegrationBundle\Entity\Transport;
    use Oro\Bundle\PaymentBundle\Entity\MerchantInitiatedPaymentSettingsInterface;

    #[ORM\Entity]
    class PaymentTermSettings extends Transport implements MerchantInitiatedPaymentSettingsInterface
    {
        public const SETTINGS_FIELD_MERCHANT_INITIATED_PAYMENT_ENABLED = 'merchant_initiated_payment_enabled';
        public const SETTINGS_FIELD_MERCHANT_INITIATED_PAYMENT_CONSENTS = 'merchant_initiated_payment_consents';

        #[ORM\Column(name: 'payment_term_mip_enabled', type: 'boolean', nullable: true, options: ['default' => false])]
        private ?bool $merchantInitiatedPaymentEnabled = false;

        /**
         * @var Collection<int, Consent>
         */
        #[ORM\ManyToMany(targetEntity: Consent::class)]
        #[ORM\JoinTable(name: 'oro_payment_term_mip_consent')]
        #[ORM\JoinColumn(name: 'transport_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
        #[ORM\InverseJoinColumn(name: 'consent_id', referencedColumnName: 'id', onDelete: 'CASCADE')]
        private ?Collection $merchantInitiatedPaymentConsents = null;

        public function __construct()
        {
            // ...
            $this->merchantInitiatedPaymentConsents = new ArrayCollection();
        }

        #[\Override]
        public function isMerchantInitiatedPaymentEnabled(): bool
        {
            return (bool)$this->merchantInitiatedPaymentEnabled;
        }

        #[\Override]
        public function setMerchantInitiatedPaymentEnabled(bool $merchantInitiatedPaymentEnabled): self
        {
            $this->merchantInitiatedPaymentEnabled = $merchantInitiatedPaymentEnabled;

            return $this;
        }

        #[\Override]
        public function getMerchantInitiatedPaymentConsents(): Collection
        {
            return $this->merchantInitiatedPaymentConsents;
        }

        #[\Override]
        public function addMerchantInitiatedPaymentConsent(Consent $merchantInitiatedPaymentConsent): self
        {
            if (!$this->merchantInitiatedPaymentConsents->contains($merchantInitiatedPaymentConsent)) {
                $this->merchantInitiatedPaymentConsents->add($merchantInitiatedPaymentConsent);
            }

            return $this;
        }

        #[\Override]
        public function removeMerchantInitiatedPaymentConsent(Consent $merchantInitiatedPaymentConsent): self
        {
            $this->merchantInitiatedPaymentConsents->removeElement($merchantInitiatedPaymentConsent);

            return $this;
        }
    }

Add the two values to the settings bag that the configuration factory reads:

.. code-block:: php

    #[\Override]
    public function getSettingsBag()
    {
        if (null === $this->settings) {
            $this->settings = new ParameterBag([
                self::SETTINGS_FIELD_LABELS => $this->getLabels()->toArray(),
                self::SETTINGS_FIELD_SHORT_LABELS => $this->getShortLabels()->toArray(),
                self::SETTINGS_FIELD_MERCHANT_INITIATED_PAYMENT_ENABLED => $this->isMerchantInitiatedPaymentEnabled(),
                self::SETTINGS_FIELD_MERCHANT_INITIATED_PAYMENT_CONSENTS =>
                    $this->getMerchantInitiatedPaymentConsents()->toArray(),
            ]);
        }

        return $this->settings;
    }

Add the column and the join table in a migration. Guard each change, so that the migration runs on an installation that already has the schema. The join table refers to the ``oro_consent`` table, so the bundle of the migration must load after OroConsentBundle.

.. code-block:: php

    namespace Oro\Bundle\PaymentTermBundle\Migrations\Schema\v7_0_6_0;

    use Doctrine\DBAL\Schema\Schema;
    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    class AddMerchantInitiatedPaymentSettingsToTransport implements Migration
    {
        #[\Override]
        public function up(Schema $schema, QueryBag $queries): void
        {
            $table = $schema->getTable('oro_integration_transport');
            if (!$table->hasColumn('payment_term_mip_enabled')) {
                $table->addColumn('payment_term_mip_enabled', 'boolean', ['notnull' => false, 'default' => false]);
            }

            if (!$schema->hasTable('oro_payment_term_mip_consent')) {
                $this->createOroPaymentTermMipConsentTable($schema);
            }
        }

        private function createOroPaymentTermMipConsentTable(Schema $schema): void
        {
            $table = $schema->createTable('oro_payment_term_mip_consent');
            $table->addColumn('transport_id', 'integer');
            $table->addColumn('consent_id', 'integer');
            $table->setPrimaryKey(['transport_id', 'consent_id']);
            $table->addIndex(['transport_id'], 'oro_payment_term_mip_consent_transport_id');
            $table->addIndex(['consent_id'], 'oro_payment_term_mip_consent_consent_id');
            $table->addForeignKeyConstraint(
                $schema->getTable('oro_integration_transport'),
                ['transport_id'],
                ['id'],
                ['onDelete' => 'CASCADE', 'onUpdate' => null]
            );
            // OroConsentBundle adds the foreign key to the oro_consent table.
        }
    }

Add the same schema to the installer of the bundle and increase its migration version.

Add the Fields to the Settings Form
-----------------------------------

OroPaymentBundle provides the form types of the two fields. The ``\Oro\Bundle\PaymentBundle\Form\Type\MerchantInitiatedPaymentEnabledType`` type is the **Merchant-Initiated Payments** checkbox. The ``\Oro\Bundle\PaymentBundle\Form\Type\MerchantInitiatedPaymentConsentType`` type is the **Consents** multiple select. Both types have their labels and tooltips.

The consents select needs the ``consents`` feature of OroConsentBundle. Make the form type implement ``\Oro\Bundle\FeatureToggleBundle\Checker\FeatureToggleableInterface`` and add the select only when the feature is enabled. The select hides while the checkbox is off. The ``oroform/js/app/components/dependent-field-component`` component does this.

.. code-block:: php

    namespace Oro\Bundle\PaymentTermBundle\Form\Type;

    use Oro\Bundle\FeatureToggleBundle\Checker\FeatureCheckerHolderTrait;
    use Oro\Bundle\FeatureToggleBundle\Checker\FeatureToggleableInterface;
    use Oro\Bundle\PaymentBundle\Form\Type\MerchantInitiatedPaymentConsentType;
    use Oro\Bundle\PaymentBundle\Form\Type\MerchantInitiatedPaymentEnabledType;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\FormBuilderInterface;

    class PaymentTermSettingsType extends AbstractType implements FeatureToggleableInterface
    {
        use FeatureCheckerHolderTrait;

        #[\Override]
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder
                // ...
                ->add('merchantInitiatedPaymentEnabled', MerchantInitiatedPaymentEnabledType::class, [
                    'attr' => ['data-dependee-id' => 'payment_term_mip_enabled'],
                ]);

            if ($this->isFeaturesEnabled()) {
                $builder->add('merchantInitiatedPaymentConsents', MerchantInitiatedPaymentConsentType::class, [
                    'row_attr' => [
                        'data-page-component-module' => 'oroform/js/app/components/dependent-field-component',
                        'data-page-component-options' => json_encode(['selectors' => ['rowContainer' => 'div']]),
                        'data-depend-on' => 'payment_term_mip_enabled',
                        'data-show-if' => 'checked',
                    ],
                ]);
            }
        }
    }

Register the form type with the ``consents`` feature in the ``form_types.yml`` file of the bundle:

.. code-block:: yaml

    services:
        oro_payment_term.form.type.settings:
            class: Oro\Bundle\PaymentTermBundle\Form\Type\PaymentTermSettingsType
            tags:
                - { name: form.type }
                - { name: oro_featuretogle.feature, feature: consents }

Add the Settings to the Payment Method Configuration
----------------------------------------------------

The payment method reads the switch and the consents from its configuration. Make the configuration class implement ``\Oro\Bundle\PaymentBundle\Method\Config\MerchantInitiatedPaymentConfigInterface``.

``\Oro\Bundle\PaymentTermBundle\Method\Config\PaymentTermConfigInterface`` does not extend ``MerchantInitiatedPaymentConfigInterface``. For this reason, the parameter bag configuration implements both interfaces:

.. code-block:: php

    namespace Oro\Bundle\PaymentTermBundle\Method\Config\ParameterBag;

    use Oro\Bundle\PaymentBundle\Method\Config\MerchantInitiatedPaymentConfigInterface;
    use Oro\Bundle\PaymentBundle\Method\Config\ParameterBag\AbstractParameterBagPaymentConfig;
    use Oro\Bundle\PaymentTermBundle\Method\Config\PaymentTermConfigInterface;

    class ParameterBagPaymentTermConfig extends AbstractParameterBagPaymentConfig implements
        PaymentTermConfigInterface,
        MerchantInitiatedPaymentConfigInterface
    {
        public const string FIELD_MERCHANT_INITIATED_PAYMENT_ENABLED = 'merchant_initiated_payment_enabled';
        public const string FIELD_MERCHANT_INITIATED_PAYMENT_CONSENTS = 'merchant_initiated_payment_consents';

        #[\Override]
        public function isMerchantInitiatedPaymentEnabled(): bool
        {
            return (bool)$this->get(self::FIELD_MERCHANT_INITIATED_PAYMENT_ENABLED, false);
        }

        #[\Override]
        public function getMerchantInitiatedPaymentConsents(): array
        {
            return (array)$this->get(self::FIELD_MERCHANT_INITIATED_PAYMENT_CONSENTS, []);
        }
    }

Fill the two values from the transport entity in the configuration factory:

.. code-block:: php

    $params = new ParameterBagPaymentTermConfig([
        // ...
        ParameterBagPaymentTermConfig::FIELD_MERCHANT_INITIATED_PAYMENT_ENABLED =>
            $paymentTermSettings->isMerchantInitiatedPaymentEnabled(),
        ParameterBagPaymentTermConfig::FIELD_MERCHANT_INITIATED_PAYMENT_CONSENTS =>
            $paymentTermSettings->getMerchantInitiatedPaymentConsents()->toArray(),
    ]);

Implement the Payment Method Interface
--------------------------------------

Make the payment method implement ``\Oro\Bundle\PaymentBundle\Method\MerchantInitiatedPaymentMethodInterface``. The method needs the ``oro_payment.merchant_initiated_payment.contract_manager`` service (``\Oro\Bundle\PaymentBundle\MerchantInitiatedPayment\MerchantInitiatedPaymentContractManager``) to activate a contract.

The Payment Term method implements the interface as follows:

* The switch comes from the configuration. When the configuration does not implement ``MerchantInitiatedPaymentConfigInterface``, the switch is off.
* The method supports all three types.
* The consents come from the configuration, whatever the payment context is. When the configuration does not implement ``MerchantInitiatedPaymentConfigInterface``, the method requires no consents.
* A setup is applicable when the switch is on, the payment context has a customer user, and the method applies to the context.
* A merchant-initiated transaction is applicable while the customer of the contract owner still has the payment term that the contract stores.
* A revocation has nothing to cancel, because the method has no gateway. It returns a successful response.

.. code-block:: php

    namespace Oro\Bundle\PaymentTermBundle\Method;

    use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
    use Oro\Bundle\PaymentBundle\Entity\MerchantInitiatedPaymentContract;
    use Oro\Bundle\PaymentBundle\MerchantInitiatedPayment\MerchantInitiatedPaymentContractManager;
    use Oro\Bundle\PaymentBundle\Method\Config\MerchantInitiatedPaymentConfigInterface;
    use Oro\Bundle\PaymentBundle\Method\MerchantInitiatedPaymentMethodInterface;
    use Oro\Bundle\PaymentBundle\Method\MerchantInitiatedPaymentTypeInterface;
    use Oro\Bundle\PaymentBundle\Method\PaymentMethodWithPostponedCaptureInterface;

    class PaymentTerm implements PaymentMethodWithPostponedCaptureInterface, MerchantInitiatedPaymentMethodInterface
    {
        protected ?MerchantInitiatedPaymentContractManager $merchantInitiatedPaymentContractManager = null;

        public function __construct(
            PaymentTermProviderInterface $paymentTermProvider,
            PaymentTermAssociationProvider $paymentTermAssociationProvider,
            DoctrineHelper $doctrineHelper,
            PaymentTermConfigInterface $config
        ) {
            // ...
        }

        public function setMerchantInitiatedPaymentContractManager(
            MerchantInitiatedPaymentContractManager $merchantInitiatedPaymentContractManager
        ): void {
            $this->merchantInitiatedPaymentContractManager = $merchantInitiatedPaymentContractManager;
        }

        #[\Override]
        public function isMerchantInitiatedPaymentEnabled(): bool
        {
            if (!$this->config instanceof MerchantInitiatedPaymentConfigInterface) {
                return false;
            }

            return $this->config->isMerchantInitiatedPaymentEnabled();
        }

        #[\Override]
        public function getSupportedMerchantInitiatedPaymentTypes(): array
        {
            return [
                MerchantInitiatedPaymentTypeInterface::RECURRING,
                MerchantInitiatedPaymentTypeInterface::INSTALLMENT,
                MerchantInitiatedPaymentTypeInterface::UNSCHEDULED,
            ];
        }

        #[\Override]
        public function getMerchantInitiatedPaymentConsents(PaymentContextInterface $paymentContext): array
        {
            if (!$this->config instanceof MerchantInitiatedPaymentConfigInterface) {
                return [];
            }

            return $this->config->getMerchantInitiatedPaymentConsents();
        }

        #[\Override]
        public function isMerchantInitiatedPaymentSetupApplicable(PaymentContextInterface $paymentContext): bool
        {
            return $this->isMerchantInitiatedPaymentEnabled()
                && null !== $paymentContext->getCustomerUser()
                && $this->isApplicable($paymentContext);
        }

        #[\Override]
        public function isMerchantInitiatedPaymentApplicable(
            PaymentContextInterface $paymentContext,
            MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract
        ): bool {
            return null !== $this->getContractPaymentTerm($merchantInitiatedPaymentContract);
        }

        #[\Override]
        public function revokeMerchantInitiatedPaymentContract(
            MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract
        ): array {
            return ['successful' => true];
        }

        protected function getContractPaymentTerm(
            MerchantInitiatedPaymentContract $merchantInitiatedPaymentContract
        ): ?PaymentTermEntity {
            $paymentTerm = $this->getCustomerPaymentTerm($merchantInitiatedPaymentContract->getCustomerUser());
            $credentialsOnFile = $merchantInitiatedPaymentContract->getCredentialsOnFile();
            if (!$paymentTerm || $paymentTerm->getId() !== ($credentialsOnFile['paymentTermId'] ?? null)) {
                return null;
            }

            return $paymentTerm;
        }

        private function getCustomerPaymentTerm(?CustomerUser $customerUser): ?PaymentTermEntity
        {
            $customer = $customerUser?->getCustomer();
            if (!$customer) {
                return null;
            }

            return $this->paymentTermProvider->getPaymentTerm($customer);
        }
    }

A method with a gateway returns from ``getSupportedMerchantInitiatedPaymentTypes()`` only the types that the gateway account supports. Its ``revokeMerchantInitiatedPaymentContract()`` method cancels the stored token at the gateway and returns the gateway response. The contract manager revokes the contract locally in every case, even when this method throws an exception.

Activate the Contract in the Customer-Initiated Transaction
-----------------------------------------------------------

During the checkout, the ``payment_purchase`` action links the contract and the customer-initiated transaction before it calls ``execute()``. The ``payment_validate`` action does the same with the validate transaction of a method that supports the ``validate`` action. The payment method finds the contract on the transaction, stores its credentials, and activates it with the contract manager. The method activates a contract only on a customer-initiated transaction with a contract that is not revoked. The method also needs the contract manager. Without it, the method does not activate the contract. A merchant-initiated transaction also points at its contract, but it charges the contract and does not set it up:

.. code-block:: php

    #[\Override]
    public function purchase(PaymentTransaction $paymentTransaction): array
    {
        $assigned = $this->assignPaymentTerm($paymentTransaction);

        $paymentTransaction
            ->setAction($this->getSourceAction())
            ->setSuccessful($assigned)
            ->setActive($assigned);

        if ($assigned && $this->isMerchantInitiatedPaymentContractSetupRequested($paymentTransaction)) {
            $this->activateMerchantInitiatedPaymentContract($paymentTransaction);
        }

        return ['successful' => $assigned];
    }

    protected function isMerchantInitiatedPaymentContractSetupRequested(PaymentTransaction $paymentTransaction): bool
    {
        $merchantInitiatedPaymentContract = $paymentTransaction->getMerchantInitiatedPaymentContract();

        return null !== $merchantInitiatedPaymentContract
            && !$merchantInitiatedPaymentContract->isRevoked()
            && !$paymentTransaction->isMerchantInitiatedTransaction();
    }

    protected function activateMerchantInitiatedPaymentContract(PaymentTransaction $paymentTransaction): bool
    {
        if (null === $this->merchantInitiatedPaymentContractManager) {
            return false;
        }

        $paymentTerm = $this->getCustomerPaymentTerm($paymentTransaction->getFrontendOwner());
        if (!$paymentTerm) {
            return false;
        }

        $this->merchantInitiatedPaymentContractManager->activateContract(
            $paymentTransaction->getMerchantInitiatedPaymentContract(),
            ['paymentTermId' => $paymentTerm->getId()]
        );

        return true;
    }

The credentials array belongs to the payment method. The Payment Term method stores the identifier of the payment term. A method with a gateway stores the token of the gateway. The ``credentialsOnFile`` field encrypts the array in the database. The contract manager does not flush, and the checkout flushes the contract together with the transaction.

Charge the Contract in a Merchant-Initiated Transaction
-------------------------------------------------------

The ``@merchant_initiated_payment_purchase`` action creates a transaction with the ``merchantInitiatedTransaction`` flag and the contract, and passes it to ``execute()``. No customer user is logged in during this transaction. The payment method reads the flag and takes the credentials from the contract instead of the session. The Payment Term method resolves the payment term of the transaction as follows:

.. code-block:: php

    protected function resolvePaymentTerm(PaymentTransaction $paymentTransaction): ?PaymentTermEntity
    {
        if (!$paymentTransaction->isMerchantInitiatedTransaction()) {
            return $this->paymentTermProvider->getCurrentPaymentTerm();
        }

        $merchantInitiatedPaymentContract = $paymentTransaction->getMerchantInitiatedPaymentContract();
        if (!$merchantInitiatedPaymentContract) {
            return null;
        }

        return $this->getContractPaymentTerm($merchantInitiatedPaymentContract);
    }

The ``assignPaymentTerm()`` method calls ``resolvePaymentTerm()`` instead of the current payment term of the session. When the resolved term is empty, the transaction fails. A method with a gateway sends the stored token to the gateway in the same place. When the gateway reports a soft decline, set the ``customerActionRequired`` transaction option to ``true``. The key is defined in ``\Oro\Bundle\PaymentBundle\Method\MerchantInitiatedPaymentOptionsInterface``.

Pass the Contract Manager to the Method Factory
-----------------------------------------------

The method factory creates the payment method, so it receives the contract manager and passes it on:

.. code-block:: php

    private ?MerchantInitiatedPaymentContractManager $merchantInitiatedPaymentContractManager = null;

    public function __construct(
        PaymentTermProviderInterface $paymentTermProvider,
        PaymentTermAssociationProvider $paymentTermAssociationProvider,
        DoctrineHelper $doctrineHelper,
        LoggerInterface $logger
    ) {
        // ...
    }

    public function setMerchantInitiatedPaymentContractManager(
        MerchantInitiatedPaymentContractManager $merchantInitiatedPaymentContractManager
    ): void {
        $this->merchantInitiatedPaymentContractManager = $merchantInitiatedPaymentContractManager;
    }

    #[\Override]
    public function create(PaymentTermConfigInterface $config)
    {
        $paymentMethod = new PaymentTerm(
            $this->paymentTermProvider,
            $this->paymentTermAssociationProvider,
            $this->doctrineHelper,
            $config
        );
        $paymentMethod->setLogger($this->logger);
        if (null !== $this->merchantInitiatedPaymentContractManager) {
            $paymentMethod->setMerchantInitiatedPaymentContractManager($this->merchantInitiatedPaymentContractManager);
        }

        return $paymentMethod;
    }

Add the service to the factory definition in the ``payment.yml`` file of the bundle:

.. code-block:: yaml

    services:
        oro_payment_term.method.factory.payment_term:
            class: 'Oro\Bundle\PaymentTermBundle\Method\Factory\PaymentTermPaymentMethodFactory'
            arguments:
                - '@oro_payment_term.provider.payment_term'
                - '@oro_payment_term.provider.payment_term_association'
                - '@oro_entity.doctrine_helper'
                - '@logger'
            calls:
                - ['setMerchantInitiatedPaymentContractManager', ['@oro_payment.merchant_initiated_payment.contract_manager']]

Test the Integration
--------------------

Load the migration and clear the application cache. From the application root, run:

.. code-block:: bash

    php bin/console oro:migration:load --force
    php bin/console cache:clear

Then do the following:

1. In the back-office, open the Payment Term integration under **System > Integrations > Manage Integrations**. Select the **Merchant-Initiated Payments** checkbox, select one or more consents in the **Consents** select, and save the integration.
2. Make sure that a listener creates a contract on the checkout. The core does not create one on its own. The Checkout Integration section of :ref:`Merchant-Initiated Payments <bundle-docs--commerce--payment-bundle--merchant-initiated-payments>` shows the listener.
3. In the storefront, start a checkout as a customer user with a payment term. The payment step shows the consents under the Payment Term method. Accept them and submit the order.
4. In the back-office, open the order. The **Payment Contracts** section lists an active contract. Click **Charge** in the row, enter an amount and a reason, and confirm. The order gets a new pending payment transaction.
5. Click **Revoke** in the row and confirm. The contract becomes inactive and the **Charge** button disappears.

.. include:: /include/include-links-dev.rst
   :start-after: begin

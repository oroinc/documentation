Add a New Payment Method
========================

This topic describes how to add a custom payment method for your OroCommerce-based store.

It is recommended to manage payment methods through integrations. Therefore, to create a new payment method:

- Implement an integration for a payment method
- Implement a payment method itself

As an example, let us implement a collect on delivery (cash on delivery, COD) payment option. This is a simple method that does not utilize external services (like credit card payment interfaces) and requires just the minimum set of options to operate. Thus, at the end of the topic, you will have the understanding of what steps are necessary to add a workable payment method and the basic template that you can further extend when the need arises.

.. contents::
   :local:

Create a Bundle
---------------

First, create and enable the CollectOnDeliveryBundle bundle for your payment method as described in the :ref:`How to create a new bundle <how-to-create-new-bundle>` topic:

1. In the /src/ACME/Bundle/CollectOnDeliveryBundle/ directory of your application, create class CollectOnDeliveryBundle.php:

.. code-block:: php
   :linenos:

    <?php

    namespace ACME\Bundle\CollectOnDeliveryBundle;

    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class CollectOnDeliveryBundle extends Bundle
    {
    }

2. To enable the bundle, create Resources/config/oro/bundles.yml in the same directory, with the following content:

   .. code-block:: yaml
       :linenos:

       # src/ACME/Bundle/CollectOnDeliveryBundle/Resources/config/oro/bundles.yml
       bundles:
           - ACME\Bundle\CollectOnDeliveryBundle\CollectOnDeliveryBundle

   .. hint:: To fully enable a bundle, you need to regenerate the application cache. However, to save time, you can do it after creation of the payment integration.


.. tip::
   All the files and subdirectories mentioned in the following sections of this topic are to be added to the /src/ACME/Bundle/CollectOnDeliveryBundle/ directory of your application (referred to as **<bundle_root>**).

Create a Payment Integration
----------------------------

Create an Entity to Store the Payment Method Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Define an entity to store the configuration settings of the payment method in the database. To do this, create <bundle_root>/Entity/CollectOnDeliverySettings.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Entity;

   use Doctrine\ORM\Mapping as ORM;
   use Doctrine\Common\Collections\ArrayCollection;
   use Doctrine\Common\Collections\Collection;
   use Oro\Bundle\IntegrationBundle\Entity\Transport;
   use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
   use Symfony\Component\HttpFoundation\ParameterBag;

   /**
    * @ORM\Entity(
    *     repositoryClass="ACME\Bundle\CollectOnDeliveryBundle\Entity\Repository\CollectOnDeliverySettingsRepository"
    * )
    */
   class CollectOnDeliverySettings extends Transport
   {
       /**
        * @var Collection|LocalizedFallbackValue[]
        *
        * @ORM\ManyToMany(
        *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
        *      cascade={"ALL"},
        *      orphanRemoval=true
        * )
        * @ORM\JoinTable(
        *      name="acme_coll_on_deliv_trans_label",
        *      joinColumns={
        *          @ORM\JoinColumn(name="transport_id", referencedColumnName="id", onDelete="CASCADE")
        *      },
        *      inverseJoinColumns={
        *          @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true)
        *      }
        * )
        */
       private $labels;

       /**
        * @var Collection|LocalizedFallbackValue[]
        *
        * @ORM\ManyToMany(
        *      targetEntity="Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue",
        *      cascade={"ALL"},
        *      orphanRemoval=true
        * )
        * @ORM\JoinTable(
        *      name="acme_coll_on_deliv_short_label",
        *      joinColumns={
        *          @ORM\JoinColumn(name="transport_id", referencedColumnName="id", onDelete="CASCADE")
        *      },
        *      inverseJoinColumns={
        *          @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true)
        *      }
        * )
        */
       private $shortLabels;

       /**
        * @var ParameterBag
        */
       private $settings;

       public function __construct()
       {
           $this->labels = new ArrayCollection();
           $this->shortLabels = new ArrayCollection();
       }

       /**
        * @return Collection|LocalizedFallbackValue[]
        */
       public function getLabels()
       {
           return $this->labels;
       }

       /**
        * @param LocalizedFallbackValue $label
        *
        * @return $this
        */
       public function addLabel(LocalizedFallbackValue $label)
       {
           if (!$this->labels->contains($label)) {
               $this->labels->add($label);
           }

           return $this;
       }

       /**
        * @param LocalizedFallbackValue $label
        *
        * @return $this
        */
       public function removeLabel(LocalizedFallbackValue $label)
       {
           if ($this->labels->contains($label)) {
               $this->labels->removeElement($label);
           }

           return $this;
       }

       /**
        * @return Collection|LocalizedFallbackValue[]
        */
       public function getShortLabels()
       {
           return $this->shortLabels;
       }

       /**
        * @param LocalizedFallbackValue $label
        *
        * @return $this
        */
       public function addShortLabel(LocalizedFallbackValue $label)
       {
           if (!$this->shortLabels->contains($label)) {
               $this->shortLabels->add($label);
           }

           return $this;
       }

       /**
        * @param LocalizedFallbackValue $label
        *
        * @return $this
        */
       public function removeShortLabel(LocalizedFallbackValue $label)
       {
           if ($this->shortLabels->contains($label)) {
               $this->shortLabels->removeElement($label);
           }

           return $this;
       }

       /**
        * @return ParameterBag
        */
       public function getSettingsBag()
       {
           if (null === $this->settings) {
               $this->settings = new ParameterBag(
                   [
                       'labels' => $this->getLabels(),
                       'short_labels' => $this->getShortLabels(),
                   ]
               );
           }

           return $this->settings;
       }
   }

As you can see from the code above, the only two necessary parameters are defined for our collect on delivery payment method: ``labels`` and ``shortLabels``.

.. important::
   When naming DB columns, make sure that the name does not exceed 31 symbols. Pay attention to the acme_coll_on_deliv_short_label name in the following extract:

   .. code-block:: php
      :linenos:

        * @ORM\JoinTable(
        *      name="acme_coll_on_deliv_short_label",
        *      joinColumns={
        *          @ORM\JoinColumn(name="transport_id", referencedColumnName="id", onDelete="CASCADE")
        *      },
        *      ...
        * )


Create a Repository That Returns the Payment Method Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The repository returns on request the configuration settings stored by the entity that you created in the previous step. To add the repository, create <bundle_root>/Entity/Repository/CollectOnDeliverySettingsRepository.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Entity\Repository;

   use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
   use Doctrine\ORM\EntityRepository;

   class CollectOnDeliverySettingsRepository extends EntityRepository
   {
       /**
        * @return CollectOnDeliverySettings[]
        */
       public function getEnabledSettings()
       {
           return $this->createQueryBuilder('settings')
               ->innerJoin('settings.channel', 'channel')
               ->andWhere('channel.enabled = true')
               ->getQuery()
               ->getResult();
       }
   }

Create a User Interface Form for the Payment Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you add an integration via the user interface of the management console, a form that contains the integration settings appears. In this step, implement the form. To do this, create <bundle_root>/Form/Type/CollectOnDeliverySettingsType.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Form\Type;

   use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
   use Oro\Bundle\LocaleBundle\Form\Type\LocalizedFallbackValueCollectionType;
   use Symfony\Component\Form\AbstractType;
   use Symfony\Component\Form\FormBuilderInterface;
   use Symfony\Component\OptionsResolver\OptionsResolver;
   use Symfony\Component\Validator\Constraints\NotBlank;

   class CollectOnDeliverySettingsType extends AbstractType
   {
       const BLOCK_PREFIX = 'acme_collect_on_delivery_setting_type';

       /**
        * {@inheritDoc}
        */
       public function buildForm(FormBuilderInterface $builder, array $options)
       {
           $builder
               ->add(
                   'labels',
                   LocalizedFallbackValueCollectionType::NAME,
                   [
                       'label' => 'acme.collect_on_delivery.settings.labels.label',
                       'required' => true,
                       'options' => ['constraints' => [new NotBlank()]],
                   ]
               )
               ->add(
                   'shortLabels',
                   LocalizedFallbackValueCollectionType::NAME,
                   [
                       'label' => 'acme.collect_on_delivery.settings.short_labels.label',
                       'required' => true,
                       'options' => ['constraints' => [new NotBlank()]],
                   ]
               );
       }

       /**
        * {@inheritDoc}
        */
       public function configureOptions(OptionsResolver $resolver)
       {
           $resolver->setDefaults(
               [
                   'data_class' => CollectOnDeliverySettings::class,
               ]
           );
       }

       /**
        * {@inheritDoc}
        */
       public function getBlockPrefix()
       {
           return self::BLOCK_PREFIX;
       }

   }

Create a Configuration File for the Service Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start using a service container for your bundle, first create the configuration file <bundle_root>/Resources/config/services.yml.

Add the User Interface Form to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Add the following lines to the services.yml:

.. code-block:: yaml
   :linenos:

     acme_collect_on_delivery.form.type.settings:
         class: 'ACME\Bundle\CollectOnDeliveryBundle\Form\Type\CollectOnDeliverySettingsType'
         tags:
             - { name: form.type }


Set up Services with DependencyInjection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set up services, load your configuration file (services.yml) using the DependencyInjection component. For this, create <bundle_root>/DependencyInjection/CollectOnDeliveryExtension.php with the following content:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\DependencyInjection;

   use Symfony\Component\Config\FileLocator;
   use Symfony\Component\DependencyInjection\ContainerBuilder;
   use Symfony\Component\DependencyInjection\Loader;
   use Symfony\Component\HttpKernel\DependencyInjection\Extension;

   class CollectOnDeliveryExtension extends Extension
   {
       /** @internal */
       const ALIAS = 'collect_on_delivery';

       /**
        * @param array            $configs
        * @param ContainerBuilder $container
        *
        * @throws \Exception
        */
       public function load(array $configs, ContainerBuilder $container)
       {
           $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
           $loader->load('services.yml');
       }

       /**
        * @return string
        */
       public function getAlias()
       {
           return static::ALIAS;
       }
   }



Add Translations for the Form Texts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To present the information on the user interface in the user-friendly way, add translations for the payment method settings' names. To do this, create <bundle_root>/Resources/translations/messages.en.yml:

.. code-block:: yaml
   :linenos:

   acme:
    collect_on_delivery:
        settings:
            labels.label: 'Label'
            short_labels.label: 'Short Label'


Create the Integration Channel Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you select the type of the integration on the user interface, you will see the name and the icon that you define in this step. To implement a channel type, create <bundle_root>/Integration/CollectOnDeliveryChannelType.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Integration;

   use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
   use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

   class CollectOnDeliveryChannelType implements ChannelInterface, IconAwareIntegrationInterface
   {

       /**
        * {@inheritDoc}
        */
       public function getLabel()
       {
           return 'acme.collect_on_delivery.channel_type.label';
       }

       /**
        * {@inheritDoc}
        */
       public function getIcon()
       {
           return 'bundles/acmecollectondelivery/img/collect-on-delivery-icon.png';
       }
   }

Add an Icon for the Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an icon:

1. Save the file to the <bundle_root>/Resources/public/img directory.
2. Install assets:

   .. code-block:: bash
       :linenos:

       app/console oro:assets:install

To make sure that the icon is accessible for the web interface, check if it appears (as a copy or a symlink depending on the settings selected during the application installation) in the /web/bundles/collect_on_delivery/img directory of your application.

Create the Integration Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A transport is generally responsible for how the data is obtained from the external system. While the Collect On Delivery method does not interact with external systems, you still need to define a transport and implement all methods of the TransportInterface for the integration to work properly. To add a transport, create <bundle_root>/Integration/CollectOnDeliveryTransport.php:

.. code-block:: php
   :linenos:


   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Integration;

   use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
   use ACME\Bundle\CollectOnDeliveryBundle\Form\Type\CollectOnDeliverySettingsType;
   use Oro\Bundle\IntegrationBundle\Entity\Transport;
   use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;

   class CollectOnDeliveryTransport implements TransportInterface
   {
       /**
        * {@inheritDoc}
        */
       public function init(Transport $transportEntity)
       {
       }

       /**
        * {@inheritDoc}
        */
       public function getLabel()
       {
           return 'acme.collect_on_delivery.settings.transport.label';
       }

       /**
        * {@inheritDoc}
        */
       public function getSettingsFormType()
       {
           return CollectOnDeliverySettingsType::class;
       }

       /**
        * {@inheritDoc}
        */
       public function getSettingsEntityFQCN()
       {
           return CollectOnDeliverySettings::class;
       }
   }


Add the Channel Type and Transport to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the channel type and transport, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. code-block:: none
   :linenos:

   parameters:
       acme_collect_on_delivery.integration.type: 'collect_on_delivery'

   services:
       acme_collect_on_delivery.integration.channel:
           class: 'ACME\Bundle\CollectOnDeliveryBundle\Integration\CollectOnDeliveryChannelType'
           public: true
           tags:
               - { name: oro_integration.channel, type: %acme_collect_on_delivery.integration.type% }
               
       acme_collect_on_delivery.integration.transport:
           class: 'ACME\Bundle\CollectOnDeliveryBundle\Integration\CollectOnDeliveryTransport'
           public: false
           tags:
               - { name: oro_integration.transport, type: %acme_collect_on_delivery.integration.type%, channel_type: %acme_collect_on_delivery.integration.type% }


Add Translations for the Channel Type and Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The channel type and, in general, transport labels also appear on the user interface (you will not see the the transport label for Collect On Delivery). Provide translations for them by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. code-block:: yaml
   :linenos:

   acme:
       collect_on_delivery:
           settings:
               labels.label: 'Labels'
               short_labels.label: 'Short Labels'
               transport.label: 'Collect on delivery'

           channel_type.label: 'Collect on delivery'


Add an Installer
^^^^^^^^^^^^^^^^

An installer ensures that upon the application installation, the database will contain the entity that you defined within your bundle.

Follow the instructions provided in the :ref:`How to generate an installer <installer_generate>` topic. After you complete it, you will have the class <bundle_root>/Migrations/Schema/FastShippingBundleInstaller.php with the following content:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Migrations\Schema;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\MigrationBundle\Migration\Installation;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   /**
    * @SuppressWarnings(PHPMD.TooManyMethods)
    * @SuppressWarnings(PHPMD.ExcessiveClassLength)
    */
   class CollectOnDeliveryBundleInstaller implements Installation
   {
       /**
        * {@inheritDoc}
        */
       public function getMigrationVersion()
       {
           return 'v1_0';
       }

       /**
        * {@inheritDoc}
        */
       public function up(Schema $schema, QueryBag $queries)
       {
           /** Tables generation **/
           $this->createAcmeCollOnDelivTransLabelTable($schema);
           $this->createAcmeCollOnDelivShortLabelTable($schema);

           /** Foreign keys generation **/
           $this->addAcmeCollOnDelivTransLabelForeignKeys($schema);
           $this->addAcmeCollOnDelivShortLabelForeignKeys($schema);
       }

       /**
        * Create acme_coll_on_deliv_trans_label table
        *
        * @param Schema $schema
        */
       protected function createAcmeCollOnDelivTransLabelTable(Schema $schema)
       {
           $table = $schema->createTable('acme_coll_on_deliv_trans_label');
           $table->addColumn('transport_id', 'integer', []);
           $table->addColumn('localized_value_id', 'integer', []);
           $table->setPrimaryKey(['transport_id', 'localized_value_id']);
           $table->addIndex(['transport_id'], 'idx_13476d069909c13f', []);
           $table->addUniqueIndex(['localized_value_id'], 'uniq_13476d06eb576e89');
       }

       /**
        * Create acme_coll_on_deliv_short_label table
        *
        * @param Schema $schema
        */
       protected function createAcmeCollOnDelivShortLabelTable(Schema $schema)
       {
           $table = $schema->createTable('acme_coll_on_deliv_short_label');
           $table->addColumn('transport_id', 'integer', []);
           $table->addColumn('localized_value_id', 'integer', []);
           $table->addUniqueIndex(['localized_value_id'], 'uniq_2c81a8dceb576e89');
           $table->addIndex(['transport_id'], 'idx_2c81a8dc9909c13f', []);
           $table->setPrimaryKey(['transport_id', 'localized_value_id']);
       }

       /**
        * Add acme_coll_on_deliv_trans_label foreign keys.
        *
        * @param Schema $schema
        */
       protected function addAcmeCollOnDelivTransLabelForeignKeys(Schema $schema)
       {
           $table = $schema->getTable('acme_coll_on_deliv_trans_label');
           $table->addForeignKeyConstraint(
               $schema->getTable('oro_fallback_localization_val'),
               ['localized_value_id'],
               ['id'],
               ['onUpdate' => null, 'onDelete' => 'CASCADE']
           );
           $table->addForeignKeyConstraint(
               $schema->getTable('oro_integration_transport'),
               ['transport_id'],
               ['id'],
               ['onUpdate' => null, 'onDelete' => 'CASCADE']
           );
       }

       /**
        * Add acme_coll_on_deliv_short_label foreign keys.
        *
        * @param Schema $schema
        */
       protected function addAcmeCollOnDelivShortLabelForeignKeys(Schema $schema)
       {
           $table = $schema->getTable('acme_coll_on_deliv_short_label');
           $table->addForeignKeyConstraint(
               $schema->getTable('oro_fallback_localization_val'),
               ['localized_value_id'],
               ['id'],
               ['onUpdate' => null, 'onDelete' => 'CASCADE']
           );
           $table->addForeignKeyConstraint(
               $schema->getTable('oro_integration_transport'),
               ['transport_id'],
               ['id'],
               ['onUpdate' => null, 'onDelete' => 'CASCADE']
           );
       }
   }


Check That the Integration is Created Successfully
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clear the application cache:

   .. code-block:: bash
       :linenos:

       app/console cache:clear

   .. note::

      If you are working in production environment, you have to use the ``--env=prod`` parameter  with the command.

2. Open the user interface and check that the changes have applied and you can add an integration of the Collect On Delivery type.


Implement a Payment Method
--------------------------

Now implement the payment method itself.


Create a Factory for the Payment Method Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A configuration factory generates an individual configuration set for each instance of the integration of the Collect On Delivery type.


To add a payment method configuration factory, in the directory <bundle_root>/Method/Config/Factory/ create interface CollectOnDeliveryConfigFactoryInterface.php and the class CollectOnDeliveryConfigFactory.php that implements this interface:


Configuration Factory Interface
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory;

   use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
   use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

   interface CollectOnDeliveryConfigFactoryInterface
   {
       /**
        * @param CollectOnDeliverySettings $settings
        * @return CollectOnDeliveryConfigInterface
        */
       public function create(CollectOnDeliverySettings $settings);
   }

Configuration Factory Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~


.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory;

   use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
   use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfig;
   use Doctrine\Common\Collections\Collection;
   use Oro\Bundle\IntegrationBundle\Generator\IntegrationIdentifierGeneratorInterface;
   use Oro\Bundle\LocaleBundle\Helper\LocalizationHelper;

   class CollectOnDeliveryConfigFactory implements CollectOnDeliveryConfigFactoryInterface
   {
       /**
        * @var LocalizationHelper
        */
       private $localizationHelper;

       /**
        * @var IntegrationIdentifierGeneratorInterface
        */
       private $identifierGenerator;

       /**
        * @param LocalizationHelper $localizationHelper
        * @param IntegrationIdentifierGeneratorInterface $identifierGenerator
        */
       public function __construct(
           LocalizationHelper $localizationHelper,
           IntegrationIdentifierGeneratorInterface $identifierGenerator
       ) {
           $this->localizationHelper = $localizationHelper;
           $this->identifierGenerator = $identifierGenerator;
       }

       /**
        * {@inheritDoc}
        */
       public function create(CollectOnDeliverySettings $settings)
       {
           $params = [];
           $channel = $settings->getChannel();

           $params[CollectOnDeliveryConfig::LABEL_KEY] = $this->getLocalizedValue($settings->getLabels());
           $params[CollectOnDeliveryConfig::SHORT_LABEL_KEY] = $this->getLocalizedValue($settings->getShortLabels());
           $params[CollectOnDeliveryConfig::ADMIN_LABEL_KEY] = $channel->getName();
           $params[CollectOnDeliveryConfig::PAYMENT_METHOD_IDENTIFIER_KEY] =
               $this->identifierGenerator->generateIdentifier($channel);

           return new CollectOnDeliveryConfig($params);
       }

       /**
        * @param Collection $values
        *
        * @return string
        */
       private function getLocalizedValue(Collection $values)
       {
           return (string)$this->localizationHelper->getLocalizedValue($values);
       }
   }

Create a Provider for the Payment Method Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A configuration provider accepts and integration id and returns settings based on it.


To add a payment method configuration provider, in the directory <bundle_root>/Method/Config/Provider/ create interface CollectOnDeliveryConfigProviderInterface.php and the class CollectOnDeliveryConfigProvider.php that implements this interface:


Configuration Provider Interface
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider;

   use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;

   interface CollectOnDeliveryConfigProviderInterface
   {
       /**
        * @return CollectOnDeliveryConfigInterface[]
        */
       public function getPaymentConfigs();

       /**
        * @param string $identifier
        * @return CollectOnDeliveryConfigInterface|null
        */
       public function getPaymentConfig($identifier);

       /**
        * @param string $identifier
        * @return bool
        */
       public function hasPaymentConfig($identifier);
   }


Configuration Provider Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Provider;

   use ACME\Bundle\CollectOnDeliveryBundle\Entity\CollectOnDeliverySettings;
   use ACME\Bundle\CollectOnDeliveryBundle\Entity\Repository\CollectOnDeliverySettingsRepository;
   use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\CollectOnDeliveryConfigInterface;
   use ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config\Factory\CollectOnDeliveryConfigFactoryInterface;
   use Doctrine\Common\Persistence\ManagerRegistry;
   use Psr\Log\LoggerInterface;

   class CollectOnDeliveryConfigProvider implements CollectOnDeliveryConfigProviderInterface
   {
       /**
        * @var ManagerRegistry
        */
       protected $doctrine;

       /**
        * @var CollectOnDeliveryConfigFactoryInterface
        */
       protected $configFactory;

       /**
        * @var CollectOnDeliveryConfigInterface[]
        */
       protected $configs;

       /**
        * @var LoggerInterface
        */
       protected $logger;

       /**
        * @param ManagerRegistry $doctrine
        * @param LoggerInterface $logger
        * @param CollectOnDeliveryConfigFactoryInterface $configFactory
        */
       public function __construct(
           ManagerRegistry $doctrine,
           LoggerInterface $logger,
           CollectOnDeliveryConfigFactoryInterface $configFactory
       ) {
           $this->doctrine = $doctrine;
           $this->logger = $logger;
           $this->configFactory = $configFactory;
       }

       /**
        * {@inheritDoc}
        */
       public function getPaymentConfigs()
       {
           $configs = [];

           $settings = $this->getEnabledIntegrationSettings();

           foreach ($settings as $setting) {
               $config = $this->configFactory->create($setting);

               $configs[$config->getPaymentMethodIdentifier()] = $config;
           }

           return $configs;
       }

       /**
        * {@inheritDoc}
        */
       public function getPaymentConfig($identifier)
       {
           $paymentConfigs = $this->getPaymentConfigs();

           if ([] === $paymentConfigs || false === array_key_exists($identifier, $paymentConfigs)) {
               return null;
           }

           return $paymentConfigs[$identifier];
       }

       /**
        * {@inheritDoc}
        */
       public function hasPaymentConfig($identifier)
       {
           return null !== $this->getPaymentConfig($identifier);
       }

       /**
        * @return CollectOnDeliverySettings[]
        */
       protected function getEnabledIntegrationSettings()
       {
           try {
               /** @var CollectOnDeliverySettingsRepository $repository */
               $repository = $this->doctrine
                   ->getManagerForClass(CollectOnDeliverySettings::class)
                   ->getRepository(CollectOnDeliverySettings::class);

               return $repository->getEnabledSettings();
           } catch (\UnexpectedValueException $e) {
               $this->logger->critical($e->getMessage());

               return [];
           }
       }
   }


Implement Payment Method Configuration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

In the <bundle_root>/Method/Config directory, create the CollectOnDeliveryConfigInterface.php interface and the CollectOnDeliveryConfig.php class that implements this interface:


Configuration Interface
~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config;

   use Oro\Bundle\PaymentBundle\Method\Config\PaymentConfigInterface;

   interface CollectOnDeliveryConfigInterface extends PaymentConfigInterface
   {
   }

Configuration Class
~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\PaymentMethod\Config;

   use Symfony\Component\HttpFoundation\ParameterBag;

   class CollectOnDeliveryConfig extends ParameterBag implements CollectOnDeliveryConfigInterface
   {
       const LABEL_KEY = 'label';
       const SHORT_LABEL_KEY = 'short_label';
       const ADMIN_LABEL_KEY = 'admin_label';
       const PAYMENT_METHOD_IDENTIFIER_KEY = 'payment_method_identifier';

       /**
        * {@inheritDoc}
        */
       public function __construct(array $parameters)
       {
           parent::__construct($parameters);
       }

       /**
        * {@inheritDoc}
        */
       public function getLabel()
       {
           return (string)$this->get(self::LABEL_KEY);
       }

       /**
        * {@inheritDoc}
        */
       public function getShortLabel()
       {
           return (string)$this->get(self::SHORT_LABEL_KEY);
       }

       /**
        * {@inheritDoc}
        */
       public function getAdminLabel()
       {
           return (string)$this->get(self::ADMIN_LABEL_KEY);
       }

       /**
        * {@inheritDoc}
        */
       public function getPaymentMethodIdentifier()
       {
           return (string)$this->get(self::PAYMENT_METHOD_IDENTIFIER_KEY);
       }
   }


Add the Payment Method Configuration Factory and Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the payment method configuration factory and provider, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. code-block:: yaml
   :linenos:

    acme_collect_on_delivery.factory.collect_on_delivery_config:
        class: ACME\Bundle\CollectOnDeliveryBundle\Method\Config\Factory\CollectOnDeliveryConfigFactory
        public: false
        arguments:
            - '@oro_locale.helper.localization'
            - '@acme_collect_on_delivery.generator.collect_on_delivery_config_identifier'

    acme_collect_on_delivery.payment_method.config.provider:
        class: ACME\Bundle\CollectOnDeliveryBundle\Method\Config\Provider\CollectOnDeliveryConfigProvider
        arguments:
            - '@doctrine'
            - '@logger'
            - '@acme_collect_on_delivery.factory.collect_on_delivery_config'


Create a Factory for the Payment Method View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Views provide the set of options for the payment method blocks that users see when they select the Collect on Delivery payment method and review the orders during the checkout.

To add a payment method view factory, in the directory <bundle_root>/Method/View/Factory/ create interface CollectOnDeliveryViewFactoryInterface.php and the class CollectOnDeliveryViewFactory.php that implements this interface:

Payment Method View Factory Interface
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method\View\Factory;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface;

   interface CollectOnDeliveryViewFactoryInterface
   {
       /**
        * @param CollectOnDeliveryConfigInterface $config
        * @return PaymentMethodViewInterface
        */
       public function create(CollectOnDeliveryConfigInterface $config);
   }

Payment Method View Factory Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method\View\Factory;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use ACME\Bundle\CollectOnDeliveryBundle\Method\View\CollectOnDeliveryView;

   class CollectOnDeliveryViewFactory implements CollectOnDeliveryViewFactoryInterface
   {
       /**
        * {@inheritDoc}
        */
       public function create(CollectOnDeliveryConfigInterface $config)
       {
           return new CollectOnDeliveryView($config);
       }
   }

Create Provider for the Payment Method View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a payment method view provider, create <bundle_root>/Method/View/Provider/CollectOnDeliveryViewProvider.php:


Payment Method View Provider Class
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method\View\Provider;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\Provider\CollectOnDeliveryConfigProviderInterface;
   use ACME\Bundle\CollectOnDeliveryBundle\Method\View\Factory\CollectOnDeliveryViewFactoryInterface;
   use Oro\Bundle\PaymentBundle\Method\View\AbstractPaymentMethodViewProvider;

   class CollectOnDeliveryViewProvider extends AbstractPaymentMethodViewProvider
   {
       /** @var CollectOnDeliveryViewFactoryInterface */
       private $factory;

       /** @var CollectOnDeliveryConfigProviderInterface */
       private $configProvider;

       /**
        * @param CollectOnDeliveryConfigProviderInterface $configProvider
        * @param CollectOnDeliveryViewFactoryInterface $factory
        */
       public function __construct(
           CollectOnDeliveryConfigProviderInterface $configProvider,
           CollectOnDeliveryViewFactoryInterface $factory
       ) {
           $this->factory = $factory;
           $this->configProvider = $configProvider;

           parent::__construct();
       }

       /**
        * {@inheritDoc}
        */
       protected function buildViews()
       {
           $configs = $this->configProvider->getPaymentConfigs();
           foreach ($configs as $config) {
               $this->addCollectOnDeliveryView($config);
           }
       }

       /**
        * @param CollectOnDeliveryConfigInterface $config
        */
       protected function addCollectOnDeliveryView(CollectOnDeliveryConfigInterface $config)
       {
           $this->addView(
               $config->getPaymentMethodIdentifier(),
               $this->factory->create($config)
           );
       }
   }


Implement the Payment Method View
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Finally, to implement the payment method view, create <bundle_root>/Method/ViewCollectOnDeliveryView.php:


Payment Method View Class
~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method\View;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
   use Oro\Bundle\PaymentBundle\Method\View\PaymentMethodViewInterface;

   class CollectOnDeliveryView implements PaymentMethodViewInterface
   {
       /**
        * @var CollectOnDeliveryConfigInterface
        */
       protected $config;

       /**
        * @param CollectOnDeliveryConfigInterface $config
        */
       public function __construct(CollectOnDeliveryConfigInterface $config)
       {
           $this->config = $config;
       }

       /**
        * {@inheritDoc}
        */
       public function getOptions(PaymentContextInterface $context)
       {
           return [];
       }

       /**
        * {@inheritDoc}
        */
       public function getBlock()
       {
           return '_payment_methods_collect_on_delivery_widget';
       }

       /**
        * {@inheritDoc}
        */
       public function getLabel()
       {
           return $this->config->getLabel();
       }

       /**
        * {@inheritDoc}
        */
       public function getShortLabel()
       {
           return $this->config->getShortLabel();
       }

       /**
        * {@inheritDoc}
        */
       public function getAdminLabel()
       {
           return $this->config->getAdminLabel();
       }

       /** {@inheritDoc} */
       public function getPaymentMethodIdentifier()
       {
           return $this->config->getPaymentMethodIdentifier();
       }
   }



Add the Payment Method View Factory and Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the payment method view factory and provider, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. code-block:: yaml
   :linenos:

    acme_collect_on_delivery.factory.method_view.collect_on_delivery:
        class: ACME\Bundle\CollectOnDeliveryBundle\Method\View\Factory\CollectOnDeliveryViewFactory
        public: false

    acme_collect_on_delivery.payment_method_view_provider.collect_on_delivery:
        class: ACME\Bundle\CollectOnDeliveryBundle\Method\View\Provider\CollectOnDeliveryViewProvider
        public: false
        arguments:
            - '@acme_collect_on_delivery.payment_method.config.provider'
            - '@acme_collect_on_delivery.factory.method_view.collect_on_delivery'
        tags:
            - { name: oro_payment.payment_method_view_provider }

Create a Factory for the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a payment method factory, in the directory <bundle_root>/Method/Factory/ create interface CollectOnDeliveryFactoryInterface.php and the class CollectOnDeliveryFactory.php that implements this interface:

Factory Interface
~~~~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method\Factory;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;

   interface CollectOnDeliveryMethodFactoryInterface
   {
       /**
        * @param CollectOnDeliveryConfigInterface $config
        * @return PaymentMethodInterface
        */
       public function create(CollectOnDeliveryConfigInterface $config);
   }


Factory Class
~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method\Factory;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use ACME\Bundle\CollectOnDeliveryBundle\PMethod\CollectOnDelivery;

   class CollectOnDeliveryMethodFactory implements CollectOnDeliveryMethodFactoryInterface
   {
       /**
        * {@inheritDoc}
        */
       public function create(CollectOnDeliveryConfigInterface $config)
       {
           return new CollectOnDelivery($config);
       }
   }

Create Provider for the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a payment method provider, create <bundle_root>/Method/Provider/CollectOnDeliveryProvider.php:


Provider Class
~~~~~~~~~~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method\Provider;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\Provider\CollectOnDeliveryConfigProviderInterface;
   use ACME\Bundle\CollectOnDeliveryBundle\Method\Factory\CollectOnDeliveryMethodFactoryInterface;
   use Oro\Bundle\PaymentBundle\Method\Provider\AbstractPaymentMethodProvider;

   class CollectOnDeliveryMethodProvider extends AbstractPaymentMethodProvider
   {
       /**
        * @var CollectOnDeliveryMethodFactoryInterface
        */
       protected $factory;

       /**
        * @var CollectOnDeliveryConfigProviderInterface
        */
       private $configProvider;

       /**
        * @param CollectOnDeliveryConfigProviderInterface $configProvider
        * @param CollectOnDeliveryMethodFactoryInterface $factory
        */
       public function __construct(
           CollectOnDeliveryConfigProviderInterface $configProvider,
           CollectOnDeliveryMethodFactoryInterface $factory
       ) {
           parent::__construct();

           $this->configProvider = $configProvider;
           $this->factory = $factory;
       }

       /**
        * {@inheritDoc}
        */
       protected function collectMethods()
       {
           $configs = $this->configProvider->getPaymentConfigs();
           foreach ($configs as $config) {
               $this->addCollectOnDeliveryMethod($config);
           }
       }

       /**
        * @param CollectOnDeliveryConfigInterface $config
        */
       protected function addCollectOnDeliveryMethod(CollectOnDeliveryConfigInterface $config)
       {
           $this->addMethod(
               $config->getPaymentMethodIdentifier(),
               $this->factory->create($config)
           );
       }
   }


Implement the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^

Now, implement the main method. To do this, create the <bundle_root>/Method/CollectOnDelivery.php class:


Class
~~~~~

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\CollectOnDeliveryBundle\Method;

   use ACME\Bundle\CollectOnDeliveryBundle\Method\Config\CollectOnDeliveryConfigInterface;
   use Oro\Bundle\PaymentBundle\Context\PaymentContextInterface;
   use Oro\Bundle\PaymentBundle\Entity\PaymentTransaction;
   use Oro\Bundle\PaymentBundle\Method\PaymentMethodInterface;

   class CollectOnDelivery implements PaymentMethodInterface
   {
       /**
        * @var CollectOnDeliveryConfigInterface
        */
       protected $config;

       /**
        * @param CollectOnDeliveryConfigInterface $config
        */
       public function __construct(CollectOnDeliveryConfigInterface $config)
       {
           $this->config = $config;
       }

       /**
        * {@inheritDoc}
        */
       public function execute($action, PaymentTransaction $paymentTransaction)
       {
           $paymentTransaction->setAction(PaymentMethodInterface::PURCHASE);
           $paymentTransaction->setActive(true);
           $paymentTransaction->setSuccessful(true);

           return [];
       }

       /**
        * {@inheritDoc}
        */
       public function getIdentifier()
       {
           return $this->config->getPaymentMethodIdentifier();
       }

       /**
        * {@inheritDoc}
        */
       public function isApplicable(PaymentContextInterface $context)
       {
           return true;
       }

       /**
        * {@inheritDoc}
        */
       public function supports($actionName)
       {
           return $actionName === self::PURCHASE;
       }
   }

.. hint::
   Pay attention to the lines:

   .. code-block:: yaml
      :linenos:

          $paymentTransaction->setAction(PaymentMethodInterface::PURCHASE);

      ...

      /**
      * {@inheritDoc}
      */
       public function supports($actionName)
       {
           return $actionName === self::PURCHASE;
       }

   This is where you define which transaction types are associated with the payment method. To keep it simple, for Collect On Delivery a single transaction is defined. Thus, it will work the following way: when a user submits an order, the "purchase" transaction takes place, and the order status becomes "purchased".

    Check `PaymentMethodInterface <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/PaymentBundle/Method/PaymentMethodInterface.php>`_ for more information on other predefined transactions.

Add the Payment Method View Factory and Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the payment method main factory and provider, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. code-block:: yaml
   :linenos:

    acme_collect_on_delivery.factory.method.collect_on_delivery:
        class: ACME\Bundle\CollectOnDeliveryBundle\Method\Factory\CollectOnDeliveryMethodFactory
        public: false

    acme_collect_on_delivery.payment_method_provider.collect_on_delivery:
        class: ACME\Bundle\CollectOnDeliveryBundle\Method\Provider\CollectOnDeliveryMethodProvider
        public: false
        arguments:
            - '@acme_collect_on_delivery.payment_method.config.provider'
            - '@acme_collect_on_delivery.factory.method.collect_on_delivery'
        tags:
            - { name: oro_payment.payment_method_provider }


Define the Payment Method's Layouts for the Front Store
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Layouts provide the html template for the payment method blocks that users see when doing the checkout in the front store. There are two different blocks: one that users see during selection of the payment method, and the other that they see when reviewing the order. You need to define templates for each of these blocks.

For this, in the directory <bundle_root>//Resources/views/layouts/default/imports/, create templates for the payment method selection checkout step:

- oro_payment_method_options/layout.html.twig
- oro_payment_method_options/layout.html

 and for the order review:

- oro_payment_method_order_submit/layout.html.twig
- oro_payment_method_order_submit/layout.html

layout.html.twig for the Payment Method Selection
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: html
   :linenos:

   {% block _payment_methods_collect_on_delivery_widget %}
       <div class="{{ class_prefix }}-form__payment-methods">
           <table class="grid">
               <tr>
                   <td>{{ 'acme.collect_on_delivery.payment_method_message'|trans }}</td>
               </tr>
           </table>
       </div>
   {% endblock %}

Note that the custom message to appear in the block is defined. Do not forget to add translations in the messages.en.yml for any custom text that you add.

layout.html for the Payment Method Selection
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: html
   :linenos:

   layout:
       actions:
           - '@setBlockTheme':
               themes:
                   - 'layout.html.twig'

layout.html.twig for the Order Review
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: html
   :linenos:

   {% block _order_review_payment_methods_collect_on_delivery_widget -%}
       {% if options.payment_method is defined %}
           <div class="hidden"
                data-page-component-module="oropayment/js/app/components/payment-method-component"
                data-page-component-options="{{ {paymentMethod: options.payment_method}|json_encode }}">
           </div>
       {% endif %}
   {%- endblock %}

layout.html for the Order Review
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code-block:: html
   :linenos:

   layout:
       actions:
           - '@setBlockTheme':
               themes:
                   - 'layout.html.twig'

Define a Translation for the Custom Message
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
In step, you have added a custom message to the payment method block. Define a translation for it in the messages.en.yml which now should look like the following:

.. code-block:: yaml
   :linenos:
   :emphasize-lines: 9

   acme:
    collect_on_delivery:
        settings:
            labels.label: 'Labels'
            short_labels.label: 'Short Labels'
            transport.label: 'Collect on delivery'

        channel_type.label: 'Collect on delivery'
        payment_method_message: 'Pay on delivery'

Check That Payment Method is Added
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Now, the Collect On Delivery payment method is fully implemented.

Clear the application cache, open the user interface and try to submit an order.


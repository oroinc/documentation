Add a New Shipping Method
=========================

This topic describes how to add a custom shipping method for your OroCommerce-based store.

It is recommended to manage shipping methods through integrations. Therefore, to create a new shipping method:

- Implement an integration for the shipping method
- Implement the shipping method itself


Usually, a shipping method has several services to provide a flexible choice of price and delivery time. As an example, we will implement the "Fast Shipping" method --- a simple method that requires just the minimum set of options to operate. It will have two services (types): "With present" and "Without present". Thus, at the end of the topic, you will have the understanding of what steps are necessary to add a workable shipment method and the basic template that you can further extend when the need arises.

.. contents::
   :local:

Create a Bundle
---------------

First, create and enable the FastShippingBundle bundle for your shipping method as described in the :ref:`How to create a new bundle <how-to-create-new-bundle>` topic:

1. In the /src/ACME/Bundle/FastShippingBundle/ directory of your application, create class ACMEFastShippingBundle.php:

.. code-block:: php
   :linenos:

    <?php

    namespace ACME\Bundle\FastShippingBundle;

    use ACME\Bundle\FastShippingBundle\DependencyInjection\FastShippingExtension;
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class ACMEFastShippingBundle extends Bundle
    {
       /**
        * {@inheritDoc}
        */
       public function getContainerExtension()
       {
           if (!$this->extension) {
               $this->extension = new FastShippingExtension();
           }

           return $this->extension;
       }
    }

.. tip:: The body of your class can be empty if you use regular case in the name of your organization (i.e. Acme or ACME in our example). ``getExtension()`` is necessary when you use uppercase, as Symfony treats uppercase letters in the organization prefix as separate words when creating aliases.

2. To enable the bundle, create Resources/config/oro/bundles.yml in the same directory, with the following content:

   .. code-block:: yaml
       :linenos:

       # src/ACME/Bundle/FastShippingBundle/Resources/config/oro/bundles.yml
       bundles:
          # Set a priority higher than the priority of the ShippingBundle (i.e. 200) to ensure that all dependees from the ShippingBundle are loaded before the dependent methods of your bundle.
          - { name: ACME\Bundle\FastShippingBundle\ACMEFastShippingBundle, priority: 210 }

   .. hint:: To fully enable a bundle, you need to regenerate the application cache. However, to save time, you can do it after creation of the shipping integration.

.. tip::
   All the files and subdirectories mentioned in the following sections are to be added to the /src/ACME/Bundle/FastShippingBundle/ directory of your application (referred to as **<bundle_root>**).

Create a Shipping Integration
-----------------------------

Create an Entity to Store the Shipping Method Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Define an entity that to store the configuration settings of the shipping method in the database. To do this, create <bundle_root>/Entity/FastShippingSettings.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\Entity;

   use Doctrine\Common\Collections\ArrayCollection;
   use Doctrine\Common\Collections\Collection;
   use Doctrine\ORM\Mapping as ORM;
   use Oro\Bundle\IntegrationBundle\Entity\Transport;
   use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;
   use Symfony\Component\HttpFoundation\ParameterBag;

   /**
    * @ORM\Entity
    */
   class FastShippingSettings extends Transport
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
        *      name="acme_fast_ship_transport_label",
        *      joinColumns={
        *          @ORM\JoinColumn(name="transport_id", referencedColumnName="id", onDelete="CASCADE")
        *      },
        *      inverseJoinColumns={
        *          @ORM\JoinColumn(name="localized_value_id", referencedColumnName="id", onDelete="CASCADE", unique=true)
        *      }
        * )
        */
       private $labels;

       /** @var ParameterBag */
       private $settings;

       public function __construct()
       {
           $this->labels = new ArrayCollection();
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
        * @return FastShippingSettings
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
        * @return FastShippingSettings
        */
       public function removeLabel(LocalizedFallbackValue $label)
       {
           if ($this->labels->contains($label)) {
               $this->labels->removeElement($label);
           }

           return $this;
       }

       /**
        * @return ParameterBag
        */
       public function getSettingsBag()
       {
           if (null === $this->settings) {
               $this->settings = new ParameterBag([]);
           }

           return $this->settings;
       }
   }

As you can see from the code above, the only necessary parameter defined for the FastShipping shipping method is the ``label`` parameter.

.. important::
   When naming DB columns, make sure that the name does not exceed 31 symbols. Pay attention to the ``acme_fast_ship_transport_label`` name in the following extract:

   .. code-block:: php
      :linenos:

        * @ORM\JoinTable(
        *      name="acme_fast_ship_transport_label",
        *      joinColumns={
        *          @ORM\JoinColumn(name="transport_id", referencedColumnName="id", onDelete="CASCADE")
        *      },
        *      ...
        * )

Create a User Interface Form for the Shipping Method Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you add an integration via the user interface of the management console, a form that contains the integration settings appears. In this step, implement the form. To do this, create <bundle_root>/Form/Type/FastShippingTransportSettingsType.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\Form\Type;

   use ACME\Bundle\FastShippingBundle\Entity\FastShippingSettings;
   use Oro\Bundle\LocaleBundle\Form\Type\LocalizedFallbackValueCollectionType;
   use Symfony\Component\Form\AbstractType;
   use Symfony\Component\Form\FormBuilderInterface;
   use Symfony\Component\OptionsResolver\OptionsResolver;
   use Symfony\Component\Validator\Constraints\NotBlank;

   class FastShippingTransportSettingsType extends AbstractType
   {
       const BLOCK_PREFIX = 'acme_fast_shipping_settings';

       /**
        * {@inheritDoc}
        */
       public function buildForm(FormBuilderInterface $builder, array $options)
       {
           $builder
               ->add(
                   'labels',
                   LocalizedFallbackValueCollectionType::class,
                   [
                       'label'    => 'acme.fast_shipping.settings.labels.label',
                       'required' => true,
                       'options'  => ['constraints' => [new NotBlank()]],
                   ]
               );
       }

       /**
        * {@inheritDoc}
        */
       public function configureOptions(OptionsResolver $resolver)
       {
           $resolver->setDefaults([
               'data_class' => FastShippingSettings::class
           ]);
       }

       /**
        * {@inheritDoc}
        */
       public function getBlockPrefix()
       {
           return self::BLOCK_PREFIX;
       }
   }


Add Translations for the Form Texts
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To present the information on the user interface in a user-friendly way, add translations for the shipping method settings' names. To do this, create <bundle_root>/Resources/translations/messages.en.yml:

.. code-block:: yaml
   :linenos:

   acme:
       fast_shipping:
           settings:
               labels:
                   label: 'Label'

This defines the name of the field that contains the label.


Create the Integration Channel Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When you select the type of the integration on the user interface, you will see the integration name and the icon that you define in this step.

To implement a channel type, create <bundle_root>/Integration/FastShippingChannelType.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\Integration;

   use Oro\Bundle\IntegrationBundle\Provider\ChannelInterface;
   use Oro\Bundle\IntegrationBundle\Provider\IconAwareIntegrationInterface;

   class FastShippingChannelType implements ChannelInterface, IconAwareIntegrationInterface
   {
       /**
        * {@inheritDoc}
        */
       public function getLabel()
       {
           return 'acme.fast_shipping.channel_type.label';
       }

       /**
        * {@inheritDoc}
        */
       public function getIcon()
       {
           return 'bundles/acmefastshipping/img/fast-shipping-logo.png';
       }
   }

Add an Icon for the Integration
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an icon:

1. Save the file to the <bundle_root>/Resources/public/img directory.
2. Install assets:

   .. code-block:: bash
       :linenos:

       bin/console oro:assets:install

To make sure that the icon is accessible for the web interface, check if it appears (as a copy or a symlink depending on the settings selected during the application installation) in the /public/bundles/acmefastshipping/img directory of your application.

Create the Integration Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Transport is generally responsible for how the data is obtained from the external system. While the Fast Shipping method does not interact with external systems, you still need to define transport and implement all methods of the TransportInterface for the integration to work properly. To add transport, create <bundle_root>/Integration/FastShippingTransport.php:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\Integration;

   use ACME\Bundle\FastShippingBundle\Entity\FastShippingSettings;
   use ACME\Bundle\FastShippingBundle\Form\Type\FastShippingTransportSettingsType;
   use Oro\Bundle\IntegrationBundle\Entity\Transport;
   use Oro\Bundle\IntegrationBundle\Provider\TransportInterface;
   use Symfony\Component\HttpFoundation\ParameterBag;

   class FastShippingTransport implements TransportInterface
   {
       /** @var ParameterBag */
       protected $settings;

       /**
        * @param Transport $transportEntity
        */
       public function init(Transport $transportEntity)
       {
           $this->settings = $transportEntity->getSettingsBag();
       }

       /**
        * {@inheritDoc}
        */
       public function getSettingsFormType()
       {
           return FastShippingTransportSettingsType::class;
       }

       /**
        * {@inheritDoc}
        */
       public function getSettingsEntityFQCN()
       {
           return FastShippingSettings::class;
       }

       /**
        * {@inheritDoc}
        */
       public function getLabel()
       {
           return 'acme.fast_shipping.transport.label';
       }
   }


Create a Configuration File for the Service Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start using a service container for your bundle, first create the bundle configuration file <bundle_root>/Resources/config/services.yml.

Add the Channel Type and Transport to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
To register the channel type and transport, append the following key-values to <bundle_root>/Resources/config/services.yml:

.. code-block:: yaml
   :linenos:

   parameters:
    acme_fast_shipping.integration.type: 'fast_shipping'

   services:
    acme_fast_shipping.integration.channel:
        class: 'ACME\Bundle\FastShippingBundle\Integration\FastShippingChannelType'
        public: false
        tags:
            - { name: oro_integration.channel, type: '%acme_fast_shipping.integration.type%' }

    acme_fast_shipping.integration.transport:
        class: 'ACME\Bundle\FastShippingBundle\Integration\FastShippingTransport'
        public: false
        tags:
            - { name: oro_integration.transport, type: '%acme_fast_shipping.integration.type%', channel_type: '%acme_fast_shipping.integration.type%' }


Set up Services with DependencyInjection
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set up services, load your configuration file (services.yml) using the DependencyInjection component. For this, create <bundle_root>/DependencyInjection/FastShippingExtension.php with the following content:

.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\DependencyInjection;

   use Symfony\Component\Config\FileLocator;
   use Symfony\Component\DependencyInjection\ContainerBuilder;
   use Symfony\Component\DependencyInjection\Loader;
   use Symfony\Component\HttpKernel\DependencyInjection\Extension;

   class FastShippingExtension extends Extension
   {
       /** @internal */
       const ALIAS = 'acme_fast_shipping';

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


Add Translations for the Channel Type and Transport
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
The channel type and, in general, transport labels also appear on the user interface (you will not see the transport label for Fast Shipping). Provide translations for them by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. code-block:: yaml
   :linenos:

   acme:
       fast_shipping:
           settings:
               labels:
                  label: 'Label'
           transport:
               label: 'Fast Shipping'
           channel_type:
               label: 'Fast Shipping'

Add an Installer
^^^^^^^^^^^^^^^^

An installer ensures that upon the application installation, the database will contain the entity that you defined within your bundle.

Follow the instructions provided in the :ref:`How to generate an installer <installer_generate>` topic. After you complete it, you will have the class <bundle_root>/Migrations/Schema/FastShippingBundleInstaller.php with the following content:


.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\Migrations\Schema;

   use Doctrine\DBAL\Schema\Schema;
   use Oro\Bundle\MigrationBundle\Migration\Installation;
   use Oro\Bundle\MigrationBundle\Migration\QueryBag;

   /**
    * @SuppressWarnings(PHPMD.TooManyMethods)
    * @SuppressWarnings(PHPMD.ExcessiveClassLength)
    */
   class FastShippingBundleInstaller implements Installation
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
           $this->createAcmeFastShipTransportLabelTable($schema);

           /** Foreign keys generation **/
           $this->addAcmeFastShipTransportLabelForeignKeys($schema);

       }

       /**
        * Create acme_fast_ship_transport_label table
        *
        * @param Schema $schema
        */
       protected function createAcmeFastShipTransportLabelTable(Schema $schema)
       {
           $table = $schema->createTable('acme_fast_ship_transport_label');
           $table->addColumn('transport_id', 'integer', []);
           $table->addColumn('localized_value_id', 'integer', []);
           $table->setPrimaryKey(['transport_id', 'localized_value_id']);
           $table->addUniqueIndex(['localized_value_id'], 'UNIQ_15E6E6F3EB576E89');
           $table->addIndex(['transport_id'], 'IDX_15E6E6F39909C13F', []);
       }

       /**
        * Add acme_fast_ship_transport_label foreign keys.
        *
        * @param Schema $schema
        */
       protected function addAcmeFastShipTransportLabelForeignKeys(Schema $schema)
       {
           $table = $schema->getTable('acme_fast_ship_transport_label');
           $table->addForeignKeyConstraint(
               $schema->getTable('oro_integration_transport'),
               ['transport_id'],
               ['id'],
               ['onDelete' => 'CASCADE', 'onUpdate' => null]
           );
           $table->addForeignKeyConstraint(
               $schema->getTable('oro_fallback_localization_val'),
               ['localized_value_id'],
               ['id'],
               ['onDelete' => 'CASCADE', 'onUpdate' => null]
           );
       }

   }


Check That the Integration is Created Successfully
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. Clear the application cache:

   .. code-block:: bash
      :linenos:

      bin/console cache:clear

   .. note::

      If you are working in a production environment, you have to use the ``--env=prod`` parameter with the command.

2. Open the user interface and check that the changes have applied and you can add an integration of the Fast Shipping type. Note that at this point you are not yet able to add this shipping method to a shipping rule.

   .. image:: /dev_guide/img/shipping_method_add/shipping_method_create2.png
      :alt: View the Fast Shipping integration details.

Implement a Shipping Method
---------------------------

Now implement the shipping method itself using the following steps:

.. contents:: :local:

Implement the Main Method
^^^^^^^^^^^^^^^^^^^^^^^^^

To implement the main method, create the <bundle_root>/Method/FastShipping.php class that implements two standard interfaces \Oro\Bundle\ShippingBundle\Method\ShippingMethodInterface and \Oro\Bundle\ShippingBundle\Method\ShippingMethodIconAwareInterface:


.. code-block:: php
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\Method;

   use Oro\Bundle\ShippingBundle\Method\ShippingMethodIconAwareInterface;
   use Oro\Bundle\ShippingBundle\Method\ShippingMethodInterface;
   use Symfony\Component\Form\Extension\Core\Type\HiddenType;

   class FastShippingMethod implements ShippingMethodInterface, ShippingMethodIconAwareInterface
   {
       /**
        * @var array
        */
       private $types;

       /**
        * @var string
        */
       private $label;

       /**
        * @var string|null
        */
       private $icon;

       /**
        * @var string
        */
       private $identifier;

       /**
        * @var bool
        */
       private $enabled;

       /**
        * @param string      $identifier
        * @param string      $label
        * @param string|null $icon
        * @param bool        $enabled
        */
       public function __construct($identifier, $label, $icon, $enabled, array $types)
       {
           $this->identifier = $identifier;
           $this->label = $label;
           $this->icon = $icon;
           $this->types = $types;
           $this->enabled = $enabled;
       }

       /**
        * {@inheritDoc}
        */
       public function getIdentifier()
       {
           return $this->identifier;
       }

       /**
        * {@inheritDoc}
        */
       public function isGrouped()
       {
           return true;
       }

       /**
        * {@inheritDoc}
        */
       public function isEnabled()
       {
           return $this->enabled;
       }

       /**
        * {@inheritDoc}
        */
       public function getLabel()
       {
           return $this->label;
       }

       /**
        * {@inheritDoc}
        */
       public function getIcon()
       {
           return $this->icon;
       }

       /**
        * {@inheritDoc}
        */
       public function getTypes()
       {
           return $this->types;
       }

       /**
        * {@inheritDoc}
        */
       public function getType($type)
       {
           if (array_key_exists($type, $this->types)) {
               return $this->types[$type];
           }

           return null;
       }

       /**
        * {@inheritDoc}
        */
       public function getOptionsConfigurationFormType()
       {
           return HiddenType::class;
       }

       /**
        * {@inheritDoc}
        */
       public function getSortOrder()
       {
           return 150;
       }
   }


The methods are the following:

* ``getIdentifier`` --- Provides a unique identifier of the shipping method in the scope of the Oro application.
* ``getLabel`` --- Returns the shipping method's label that appears on the shipping rule edit page. It can also be a Symfony translated message.
* ``getIcon`` --- Returns the icon that appears on the shipping rule edit page.
* ``isEnabled`` --- Defines, whether the integration of the shipping method is enabled by default.
* ``isGrouped`` --- Defines how shipping method's types appear in the shipping method configuration on the user interface. If set to ``true``, the types appear in the table where each line contains the **Active** check box that enables users to enable individual shipping method types for a particular shipping method configuration.

..  .. image:: /dev_guide/img/shipping_method_add/shipping_methods_grouped.png
    :alt: Shipping methods display when the isGrouped option is set to "true".

* ``getSortOrder`` ---  Defines the order in which shipping methods appear on the user interface. For example, in the following screenshot, the Flat rate sort order is lower than the UPS sort order:

  .. image:: /dev_guide/img/shipping_method_add/shipping_methods_frontend.png

* ``getType`` --- Returns the selected shipping method type based on the type identifier.
* ``getTypes`` --- Returns a set of the shipping method types.
* ``getOptionsConfigurationFormType`` --- Returns the user interface form with the configuration options. The form appears on the shipping rule edit page. If the method returns ``HiddenType::class``, the form does not appear.

Add the Shipping Method Identifier Generator to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml:

.. code-block:: yaml
   :linenos:

   services:
       acme_fast_shipping.method.identifier_generator.method:
           parent: oro_integration.generator.prefixed_identifier_generator
           arguments:
               - '%acme_fast_shipping.integration.type%'

Create a Factory for the Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This factory generates an individual configuration set for each instance of the integration of the Fast Shipping type. In our case, it also contains the method createTypes() that generates the services (types) of the fast shipping type and assigns them labels.

Create the <bundle_root>/Factory/FastShippingMethodFromChannelFactory.php class with the following content:

.. code-block:: php
   :linenos:

    <?php

    namespace ACME\Bundle\FastShippingBundle\Factory;

    use ACME\Bundle\FastShippingBundle\Entity\FastShippingSettings;
    use ACME\Bundle\FastShippingBundle\Method\FastShippingMethod;
    use ACME\Bundle\FastShippingBundle\Method\FastShippingMethodType;
    use Oro\Bundle\IntegrationBundle\Entity\Channel;
    use Oro\Bundle\IntegrationBundle\Generator\IntegrationIdentifierGeneratorInterface;
    use Oro\Bundle\IntegrationBundle\Provider\IntegrationIconProviderInterface;
    use Oro\Bundle\LocaleBundle\Helper\LocalizationHelper;
    use Oro\Bundle\ShippingBundle\Method\Factory\IntegrationShippingMethodFactoryInterface;
    use Symfony\Component\Translation\TranslatorInterface;

    class FastShippingMethodFromChannelFactory implements IntegrationShippingMethodFactoryInterface
    {
        /**
         * @var IntegrationIdentifierGeneratorInterface
         */
        private $identifierGenerator;

        /**
         * @var LocalizationHelper
         */
        private $localizationHelper;

        /**
         * @var TranslatorInterface
         */
        private $translator;

        /**
         * @var IntegrationIconProviderInterface
         */
        private $integrationIconProvider;

        /**
         * FastShippingMethodFromChannelFactory constructor.
         * @param IntegrationIdentifierGeneratorInterface $identifierGenerator
         * @param LocalizationHelper $localizationHelper
         * @param TranslatorInterface $translator
         * @param IntegrationIconProviderInterface $integrationIconProvider
         */
        public function __construct(
            IntegrationIdentifierGeneratorInterface $identifierGenerator,
            LocalizationHelper $localizationHelper,
            TranslatorInterface $translator,
            IntegrationIconProviderInterface $integrationIconProvider
        ) {
            $this->identifierGenerator = $identifierGenerator;
            $this->localizationHelper = $localizationHelper;
            $this->translator = $translator;
            $this->integrationIconProvider = $integrationIconProvider;
        }

        /**
         * @param Channel $channel
         *
         * @return FastShippingMethod
         */
        public function create(Channel $channel)
        {
            $id = $this->identifierGenerator->generateIdentifier($channel);
            $label = $this->getChannelLabel($channel);
            $icon = $this->getIcon($channel);
            $types = $this->createTypes();

            return new FastShippingMethod($id, $label, $icon, $channel->isEnabled(), $types);
        }

        /**
         * @param Channel $channel
         *
         * @return string
         */
        private function getChannelLabel(Channel $channel)
        {
            /** @var FastShippingSettings $transport */
            $transport = $channel->getTransport();

            return (string) $this->localizationHelper->getLocalizedValue($transport->getLabels());
        }

        /**
         * @param Channel $channel
         *
         * @return string|null
         */
        private function getIcon(Channel $channel)
        {
            return $this->integrationIconProvider->getIcon($channel);
        }

        /**
         * @return array
         */
        private function createTypes()
        {
            $withoutPresentLabel = $this->translator
                ->trans('acme.fast_shipping.method.processing_type.without_present.label');
            $withPresentLabel = $this->translator
                ->trans('acme.fast_shipping.method.processing_type.with_present.label');

            $withoutPresent = new FastShippingMethodType($withoutPresentLabel, false);
            $withPresent = new FastShippingMethodType($withoutPresentLabel, true);

            return [
                $withoutPresent->getIdentifier() => $withoutPresent,
                $withPresent->getIdentifier() => $withPresent,
            ];
        }
    }

Add the Shipping Method Factory to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To register the shipping method factory, append the following key-values to <bundle_root>/Resources/config/services.yml under the services section:

.. code-block:: yaml
   :linenos:

   services:
       acme_fast_shipping.factory.method:
           class: 'ACME\Bundle\FastShippingBundle\Factory\FastShippingMethodFromChannelFactory'
           public: false
           arguments:
               - '@acme_fast_shipping.method.identifier_generator.method'
               - '@oro_locale.helper.localization'
               - '@translator'
               - '@oro_integration.provider.integration_icon'

Create a Shipping Method Provider
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

For this, add the <bundle_root>/Method/FastShippingMethodProvider.php class with the following content:

.. code-block:: yaml
   :linenos:

   <?php

   namespace ACME\Bundle\FastShippingBundle\Method;

   use Oro\Bundle\EntityBundle\ORM\DoctrineHelper;
   use Oro\Bundle\ShippingBundle\Method\Factory\IntegrationShippingMethodFactoryInterface;
   use Oro\Bundle\ShippingBundle\Method\Provider\Integration\ChannelShippingMethodProvider;

   class FastShippingMethodProvider extends ChannelShippingMethodProvider
   {
       /**
        * {@inheritDoc}
        */
       public function __construct(
           $channelType,
           DoctrineHelper $doctrineHelper,
           IntegrationShippingMethodFactoryInterface $methodFactory
       ) {
           parent::__construct($channelType, $doctrineHelper, $methodFactory);
       }
   }

.. TODO: Add Information about the Doctrine
.. In the shipping method provider, the Doctrine ensures that whenever methods are updated,

Add the Shipping Method Provider to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the services section:

.. code-block:: yaml
   :linenos:

   services:
       acme_fast_shipping.method.provider:
           class: 'ACME\Bundle\FastShippingBundle\Method\FastShippingMethodProvider'
           arguments:
               - '%acme_fast_shipping.integration.type%'
               - '@oro_entity.doctrine_helper'
               - '@acme_fast_shipping.factory.method'
           tags:
               - { name: oro_shipping_method_provider }
               - { name: doctrine.orm.entity_listener, entity: 'Oro\Bundle\IntegrationBundle\Entity\Channel', event: postLoad }



Create a Shipping Method Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Shipping method types define different specifics of the same shipping services. For example, for Flat Rate, the type defines whether to calculate shipping price per order or per item. The Fast Shipping will have two types: "With Present" and "Without Present".

To create a shipping method type, add the <bundle_root>/Method/FastShippingMethodType.php class with the following content:

.. code-block:: php
   :linenos:

    <?php

    namespace ACME\Bundle\FastShippingBundle\Method;

    use Oro\Bundle\CurrencyBundle\Entity\Price;
    use ACME\Bundle\FastShippingBundle\Form\Type\FastShippingMethodOptionsType;
    use Oro\Bundle\ShippingBundle\Context\ShippingContextInterface;
    use Oro\Bundle\ShippingBundle\Method\ShippingMethodTypeInterface;

    class FastShippingMethodType implements ShippingMethodTypeInterface
    {
        const PRICE_OPTION = 'price';

        /**
         * @internal
         */
        const WITHOUT_PRESENT_TYPE = 'without_present';

        /**
         * @internal
         */
        const WITH_PRESENT_TYPE = 'with_present';

        /**
         * @var string
         */
        private $label;

        /**
         * @var bool
         */
        private $isWithPresent;

        /**
         * @param string $label
         * @param bool $isWithPresent
         */
        public function __construct($label, $isWithPresent)
        {
            $this->label = $label;
            $this->isWithPresent = $isWithPresent;
        }

        /**
         * {@inheritDoc}
         */
        public function getIdentifier()
        {
            if ($this->isWithPresent) {
                return self::WITH_PRESENT_TYPE;
            }

            return self::WITHOUT_PRESENT_TYPE;
        }

        /**
         * {@inheritDoc}
         */
        public function getLabel()
        {
            return $this->label;
        }

        /**
         * {@inheritDoc}
         */
        public function getSortOrder()
        {
            return 0;
        }

        /**
         * {@inheritDoc}
         */
        public function getOptionsConfigurationFormType()
        {
            return FastShippingMethodOptionsType::class;
        }

        /**
         * {@inheritDoc}
         */

        public function calculatePrice(ShippingContextInterface $context, array $methodOptions, array $typeOptions)
        {
            $price = $typeOptions[static::PRICE_OPTION];

            // Provide additional price calculation logic here if required.

            return Price::create((float)$price, $context->getCurrency());
        }
    }

* ``getIdentifier`` --- Returns a unique identifier of a shipping method type in the scope of the shipping method.
* ``getLabel`` --- Returns the label of the shipping method type. The label appears on the shipping rule edit page in the management console and on the storefront.
* ``getSortOrder`` ---  Defines the order in which shipping method types appear on the user interface. For example, see the UPS shipping types below. The number that defines the sort order of the UPS Ground is lower than that of the UPS 2nd Day Air (i.e. the lower the number, the higher up the list the method type appears):

  .. image:: /dev_guide/img/shipping_method_add/shipping_methods_frontend.png

* ``getOptionsConfigurationFormType`` --- Returns the user interface form with the configuration options. The form appears on the shipping rule edit page. If the method returns ``HiddenType::class``, the form does not appear.

.. TODO Add a screenshot

* ``calculatePrice``-- Contains the main logic and returns the shipping price for the given ``$context``.

.. note:: If you implement a more complicated shipping method, see Oro\Bundle\ShippingBundle\Context\ShippingContextInterface for attributes that can affect a shipping price (e.g. shipping address information or line items).

Define Translation for the Shipping Method Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Provide translations by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. code-block:: yaml
   :linenos:

   acme:
       fast_shipping:
           settings:
               labels:
                  label: 'Label'
           transport:
               label: 'Fast Shipping'
           channel_type:
               label: 'Fast Shipping'
           method:
               price.label: 'Price'
               processing_type:
                   without_present.label: 'Fast Shipping Rate Without Present'
                   with_present.label: 'Fast Shipping Rate With Present'



Create a Shipping Method Options Form
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This form with options for a shipping method appears on the user interface of the management console when you add the shipping method to a shipping rule. Add FastShippingMethodOptionsType.php to the <bundle_root>/Form/Type/ directory:

.. code-block:: php
   :linenos:

    <?php

    namespace ACME\Bundle\FastShippingBundle\Form\Type;

    use ACME\Bundle\FastShippingBundle\Method\FastShippingMethodType;
    use Oro\Bundle\CurrencyBundle\Rounding\RoundingServiceInterface;
    use Symfony\Component\Form\AbstractType;
    use Symfony\Component\Form\Extension\Core\Type\NumberType;
    use Symfony\Component\Form\FormBuilderInterface;
    use Symfony\Component\OptionsResolver\Exception\AccessException;
    use Symfony\Component\OptionsResolver\OptionsResolver;
    use Symfony\Component\Validator\Constraints\NotBlank;
    use Symfony\Component\Validator\Constraints\Type;

    class FastShippingMethodOptionsType extends AbstractType
    {
        const BLOCK_PREFIX = 'acme_fast_shipping_options_type';

        /**
         * @var RoundingServiceInterface
         */
        protected $roundingService;

        /**
         * @param RoundingServiceInterface $roundingService
         */
        public function __construct(RoundingServiceInterface $roundingService)
        {
            $this->roundingService = $roundingService;
        }

        /**
         * {@inheritDoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $priceOptions = [
                'scale' => $this->roundingService->getPrecision(),
                'rounding_mode' => $this->roundingService->getRoundType(),
                'attr' => ['data-scale' => $this->roundingService->getPrecision()],
            ];

            $builder
                ->add(FastShippingMethodType::PRICE_OPTION, NumberType::class, array_merge([
                    'label' => 'acme.fast_shipping.method.price.label',
                    'constraints' => [new NotBlank(), new Type(['type' => 'numeric'])]
                ], $priceOptions));
        }

        /**
         * @param OptionsResolver $resolver
         *
         * @throws AccessException
         */
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'label' => 'acme.fast_shipping.form.acme_fast_shipping_options_type.label',
            ]);
        }

        /**
         * {@inheritDoc}
         */
        public function getBlockPrefix()
        {
            return self::BLOCK_PREFIX;
        }
    }

Add the Shipping Method Options Form to the Services Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the services section:

.. code-block:: yaml
   :linenos:

   services:
       acme_fast_shipping.form.type.fast_shipping_options:
           class: 'ACME\Bundle\FastShippingBundle\Form\Type\FastShippingMethodOptionsType'
           arguments:
               - '@oro_currency.rounding.price_rounding_service'
           tags:
               - { name: form.type }

Define Translation for the Shipping Method Form Options
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Provide translations by appending the <bundle_root>/Resources/translations/messages.en.yml. Now, the messages.en.yml content must look as follows:

.. code-block:: yaml
   :linenos:

   acme:
       fast_shipping:
           settings:
               labels:
                  label: 'Label'
           transport:
               label: 'Fast Shipping'
           channel_type:
               label: 'Fast Shipping'
           method:
               price.label: 'Price'
               processing_type:
                   without_present.label: 'Fast Shipping Rate Without Present'
                   with_present.label: 'Fast Shipping Rate With Present'
           form:
               acme_fast_shipping_options_type.label: 'Fast Shipping Rate'


Add a Template
^^^^^^^^^^^^^^
In the shipping rules, this template is used to display the configured settings of the Fast Shipping integration.

.. .. image:: /dev_guide/img/shipping_method_add/display_configured_settings.png
   :alt: How the configured integration settings are displayed.

Create the /Resources/views/method/fastShippingMethodWithOptions.html.twig file with the following content:

.. code-block:: html
   :linenos:

   {% import 'OroShippingBundle:ShippingMethodsConfigsRule:macros.html.twig' as ShipRuleMacro %}

   {% spaceless %}
       {% set methodLabel = get_shipping_method_label(methodData.identifier)|trans %}
       {% if methodLabel|length > 0 %}
       <li>{{ methodLabel }}
           <ul>
       {% endif %}
           {% for type in methodData.types %}
           {%- if type.enabled -%}
               <li>{{ get_shipping_method_type_label(methodData.identifier, type.identifier)|trans }} ({{ 'acme.fast_shipping.method.price.label'|trans }}: {{ type.options['price']|oro_format_currency({'currency': currency}) }}
                   {%- if type.options['handling_fee'] is defined and type.options['handling_fee'] is not empty -%}
                       , {{ 'acme.fast_shipping.method.handling_fee.label'|trans}}: {{ type.options['handling_fee']|oro_format_currency({'currency': currency})}}
                   {%- endif -%}
                   ) {{ ShipRuleMacro.renderShippingMethodDisabledFlag(methodData.identifier) }}</li>
           {%- endif -%}
           {% endfor %}
       {% if methodLabel|length > 0 %}
           </ul>
       </li>
       {% endif %}
   {% endspaceless %}

Add a Check for When Users Disable Used Shipping Method Types
-------------------------------------------------------------

To show a notification when a user disables or removes the integration currently used in shipping rules, use the event listeners to catch the corresponding event and the event handlers.

Add Event Listeners to the System Container
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Append the following lines to <bundle_root>/Resources/config/services.yml under the parameters and services sections:

.. code-block:: yaml
   :linenos:

   parameters:
       acme_fast_shipping.admin_view.method_template: 'ACMEFastShippingShippingBundle::method/fastShippingMethodWithOptions.html.twig'

   services:
       acme_fast_shipping.event_listener.shipping_method_config_data:
           parent: oro_shipping.admin_view.method_template.listener
           arguments:
               - '%acme_fast_shipping.admin_view.method_template%'
               - '@acme_fast_shipping.method.provider'
           tags:
               - { name: kernel.event_listener, event: oro_shipping_method.config_data, method: onGetConfigData }

       acme_fast_shipping.remove_integration_listener:
           parent: oro_shipping.remove_integration_listener
           arguments:
               - '%acme_fast_shipping.integration.type%'
               - '@acme_fast_shipping.method.identifier_generator.method'
               - '@oro_shipping.method.event.dispatcher.method_removal'
           tags:
               - { name: kernel.event_listener, event: oro_integration.channel_delete, method: onRemove }

       acme_fast_shipping.disable_integration_listener:
            parent: oro_shipping.disable_integration_listener
            arguments:
                - '%acme_fast_shipping.integration.type%'
                - '@acme_fast_shipping.method.identifier_generator.method'
                - '@oro_shipping.method_disable_handler.decorator'
            tags:
                - { name: kernel.event_listener, event: oro_integration.channel_disable, method: onIntegrationDisable }


Add Actions
^^^^^^^^^^^

Create actions.yml in the <bundle_root>/Resources/config/oro/ directory:

.. code-block:: yaml
   :linenos:

   parameters:
       acme_fast_shipping.integration.type: 'fast_shipping'

   operations:
       # Disable the default deactivate method for the Fast Shipping integration.
       oro_integration_deactivate:
           preconditions:
               '@and':
                   - '@not_equal': [$type, '%acme_fast_shipping.integration.type%']

       # Disable the default delete method for the Fast Shipping integration.
       oro_integration_delete:
           preconditions:
               '@and':
                   - '@not_equal': [$type, '%acme_fast_shipping.integration.type%']

       # Use the deactivate method that:
       #    a. first checks whether there are shipping rules that use the Fast Shipping method, and
       #    b. if yes, displays to a user the confirmation dialog with the notification message and the link to the list of the corresponding rules.
       acme_fast_shipping_integration_deactivate:
           extends: oro_integration_deactivate
           for_all_entities: false
           for_all_datagrids: false
           replace:
               - preactions
               - preconditions
               - frontend_options

           # Filter the grid with the active shipping rules that use the Fast Shipping method and generate the link to it.
           preactions:
               - '@call_service_method':
                   attribute: $.actionAllowed
                   service: oro_integration.utils.edit_mode
                   method: isSwitchEnableAllowed
                   method_parameters: [$.data.editMode]
               - '@call_service_method':
                   attribute: $.methodIdentifier
                   service: acme_fast_shipping.method.identifier_generator.method
                   method: generateIdentifier
                   method_parameters: [$.data]
               - '@call_service_method':
                   attribute: $.linkGrid
                   service: oro_shipping.helper.filtered_datagrid_route
                   method: generate
                   method_parameters:  [{'methodConfigs': $.methodIdentifier}]

           # Check that the method is used in the shipping rules.
           preconditions:
               '@and':
                   - '@shipping_method_has_enabled_shipping_rules':
                       parameters:
                           method_identifier: $.methodIdentifier
                   - '@equal': [$type, '%acme_fast_shipping.integration.type%']
                   - '@equal': [$.actionAllowed, true]
                   - '@equal': [$.data.enabled, true]

           # Show the confirmation dialog with the notification message.
           frontend_options:
               confirmation:
                   title: oro.shipping.integration.deactivate.title
                   okText: oro.shipping.integration.deactivate.button.okText
                   message: oro.shipping.integration.deactivate.message
                   message_parameters:
                       linkGrid: $.linkGrid
                   component: oroui/js/standart-confirmation


       # If there are no shipping rules that use this method, deactivate without displaying to a user the confirmation dialog.
       acme_fast_shipping_integration_deactivate_without_rules:
           extends: acme_fast_shipping_integration_deactivate
           for_all_entities: false
           for_all_datagrids: false
           replace:
               - preconditions
               - frontend_options
           preconditions:
               '@and':
                   - '@not':
                       - '@shipping_method_has_enabled_shipping_rules':
                           parameters:
                               method_identifier: $.methodIdentifier
                   - '@equal': [$type, '%acme_fast_shipping.integration.type%']
                   - '@equal': [$.actionAllowed, true]
                   - '@equal': [$.data.enabled, true]
           frontend_options: ~

       # Use the delete method that:
       #    a. first checks whether there are shipping rules that use the Fast Shipping method, and
       #    b. if yes, displays to a user the confirmation dialog with the notification message and the link to the list of the corresponding rules.
       acme_fast_shipping_integration_delete:
           extends: oro_integration_delete
           for_all_entities: false
           for_all_datagrids: false
           replace:
               - preactions
               - preconditions
               - frontend_options
           preactions:
               - '@call_service_method':
                   service: oro_integration.utils.edit_mode
                   method: isEditAllowed
                   method_parameters: [$.data.editMode]
                   attribute: $.actionAllowed
               - '@call_service_method':
                   attribute: $.methodIdentifier
                   service: acme_fast_shipping.method.identifier_generator.method
                   method: generateIdentifier
                   method_parameters: [$.data]
               - '@call_service_method':
                   attribute: $.linkGrid
                   service: oro_shipping.helper.filtered_datagrid_route
                   method: generate
                   method_parameters:  [{'methodConfigs': $.methodIdentifier}]
           preconditions:
               '@and':
                   - '@shipping_method_has_shipping_rules':
                       parameters:
                           method_identifier: $.methodIdentifier
                   - '@equal': [$type, '%acme_fast_shipping.integration.type%']
                   - '@equal': [$.actionAllowed, true]
           frontend_options:
               confirmation:
                   title: oro.shipping.integration.delete.title
                   okText: oro.shipping.integration.delete.button.okText
                   message: oro.shipping.integration.delete.message
                   message_parameters:
                       linkGrid: $.linkGrid
                   component: oroui/js/standart-confirmation

       acme_fast_shipping_integration_delete_without_rules:
           extends: acme_fast_shipping_integration_delete
           for_all_entities: false
           for_all_datagrids: false
           replace:
               - preconditions
               - frontend_options
           preconditions:
               '@and':
                   - '@not':
                       - '@shipping_method_has_shipping_rules':
                           parameters:
                               method_identifier: $.methodIdentifier
                   - '@equal': [$type, '%acme_fast_shipping.integration.type%']
                   - '@equal': [$.actionAllowed, true]
           frontend_options:
               title: oro.action.delete_entity
               confirmation:
                   title: oro.action.delete_entity
                   message: oro.action.delete_confirm
                   message_parameters:
                       entityLabel: $name
                   component: oroui/js/delete-confirmation

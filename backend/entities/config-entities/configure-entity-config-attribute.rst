.. _book-entities-entity-configuration-configure-entity-config-attribute:

Define a New Object Configuration Attribute
===========================================

You can use configuration to define a new entity config attribute:

1. Create a configuration file that implements ``EntityConfigInterface`` or ``FieldConfigInterface``. For entity config, use ``EntityConfigInterface`` and the class that ends with EntityConfiguration. For field config, use ``FieldConfigInterface`` and the class that ends with FieldConfiguration.

Example:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/EntityConfig/AcmeDemoAttrEntityConfiguration.php

   namespace Acme\Bundle\DemoBundle\EntityConfig;

   use Oro\Bundle\EntityConfigBundle\EntityConfig\EntityConfigInterface;
   use Symfony\Component\Config\Definition\Builder\NodeBuilder;

   class AcmeDemoAttrEntityConfiguration implements EntityConfigInterface
   {

       /**
        * @inheritDoc
        */
       public function getSectionName(): string
       {
           return 'acme';
       }

       /**
        * @inheritDoc
        */
       public function configure(NodeBuilder $nodeBuilder): void
       {
           $nodeBuilder
               ->scalarNode('demo_attr')
               ->info('`string` demo attribute description.')
               ->defaultNull()
               ->end()
           ;
       }
   }

2. Add this class to ``services.yml`` with tag ``oro_entity_config.validation.entity_config``.

Example:

.. code-block:: yaml

     Acme\Bundle\DemoBundle\EntityConfig\AcmeDemoAttrEntityConfiguration:
       tags:
         - oro_entity_config.validation.entity_config

Add Settings to entity_config.yml
---------------------------------

To illustrate how metadata can be added to an entity, add the following YAML file (this file must be located in ``[BundleName]/Resources/config/oro/entity_config.yml``):

.. code-block:: yaml

    entity_config:
        acme:                                      # a configuration scope name
            entity:                                # a section describes an entity
                items:                             # starts a description of entity attributes
                    demo_attr:                     # adds an attribute named 'demo_attr'
                        options:
                            priority: 100
                            indexed:  true

This configuration adds the 'demo_attr' attribute with the 'Demo' value to all configurable entities. The configurable entity is an entity marked with the `@Config` annotation. This code also automatically adds a service named **oro_entity_config.provider.acme** into the DI container. You can use this service to get a value of the 'demo_attr' attribute for a particular entity.

To apply this change, execute the **oro:entity-config:update** command that updates configuration data for entities:

.. code-block:: bash

   php bin/console oro:entity-config:update

An example how to get a value of a configuration attribute:

.. code-block:: php

         /** @var Symfony\Component\DependencyInjection\ContainerInterface $container */
         $container = ...;

        /** @var Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider $acmeConfigProvider */
        $acmeConfigProvider = $container->get('oro_entity_config.provider.acme');

        // retrieve a value of 'demo_attr' attribute for 'Acme\Bundle\DemoBundle\Entity\Document' entity
        // the value of $demoAttr variable will be 'Demo'
        $demoAttr = $acmeConfigProvider->getConfig('Acme\Bundle\DemoBundle\Entity\Document')->get('demo_attr');

If you want to set a value different than the default one for some entity, write it in the `@Config` annotation for this entity. For example:

.. code-block:: php

    /**
     * @ORM\Entity
     * @Config(
     *  defaultValues={
     *      "acme"={
     *          "demo_attr"="MyValue"
     *      }
     *  }
     * )
     */
    class MyEntity
    {
        ...
    }


The result is demonstrated in the following code:

.. code-block:: php

         /** @var Symfony\Component\DependencyInjection\ContainerInterface $container */
         $container = ...;

        /** @var Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider $acmeConfigProvider */
        $acmeConfigProvider = $container->get('oro_entity_config.provider.acme');

        // retrieve a value of 'demo_attr' attribute for 'Acme\Bundle\DemoBundle\Entity\Document' entity
        // the value of $demoAttr1 variable will be 'Demo'
        $demoAttr1 = $acmeConfigProvider->getConfig('Acme\Bundle\DemoBundle\Entity\Document')->get('demo_attr');

        // retrieve a value of 'demo_attr' attribute for 'Acme\Bundle\DemoBundle\Entity\MyEntity' entity
        // the value of $demoAttr2 variable will be 'MyValue'
        $demoAttr2 = $acmeConfigProvider->getConfig('Acme\Bundle\DemoBundle\Entity\MyEntity')->get('demo_attr');

Essentially, it is all you need to add metadata to any entity. But in most cases you want to allow an administrator to manage your attribute in UI. To accomplish this, let's change the YAML file the following way:

.. code-block:: yaml

    entity_config:
        acme:                                           # a configuration scope name
            entity:                                     # a section describes an entity
                items:                                  # starts a description of entity attributes
                    demo_attr:                          # adds an attribute named 'demo_attr'
                        options:
                            default_value: 'Demo'       # sets the default value for 'demo_attr' attribute
                            translatable:  true         # means that value of this attribute is translation key
                                                        # and actual value should be taken from translation table
                                                        # or in twig via "|trans" filter
                            indexed:       true         # TRUE if an attribute should be filterable or sortable in a data grid
                        grid:                           # configure a data grid to display 'demo_attr' attribute
                            type:          string       # sets the attribute type
                            label:         'Demo Attr'  # sets the data grid column name
                            show_filter:   true         # the next three lines configure a filter for 'Demo Attr' column
                            filterable:    true
                            filter_type:   string
                            sortable:      true         # allows an administrator to sort rows clicks on 'Demo Attr' column
                        form:
                            type:          text         # sets the attribute type
                            options:
                                block:     entity       # specifies in which block on the form this attribute should be displayed
                                label:     'Demo Attr'  # sets the label name

Now you can go to System > Entities in the back-office. The 'Demo Attr' column should be displayed in the grid. Click Edit on any entity to open the edit entity form. 'Demo Attr' field should be displayed there.

.. hint:: Check out the :ref:`example of YAML config <yaml-format-config-entity>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin

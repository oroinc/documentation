.. _book-entities-entity-configuration-configure-entity-config-attribute:

Define a New Object Configuration Attribute
===========================================

You can use configuration to define a new entity config attribute:

1. Create a configuration file that implements ``EntityConfigInterface`` or ``FieldConfigInterface``. For entity config, use ``EntityConfigInterface`` and the class that ends with EntityConfiguration. For field config, use ``FieldConfigInterface`` and the class that ends with FieldConfiguration.

Example:

.. oro_integrity_check:: bfe144b9354c836439419947d40e44853c63f00c

   .. literalinclude:: /code_examples/commerce/demo/EntityConfig/AcmeEntityConfiguration.php
       :caption: src/Acme/Bundle/DemoBundle/EntityConfig/AcmeEntityConfiguration.php
       :language: php


2. Add this class to ``services.yml`` with tag ``oro_entity_config.validation.entity_config``.

Example:

.. oro_integrity_check:: 0e49f1f3a5f2286cbbc9e1105636ceb92f85e217

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       :language: yaml
       :lines: 2, 29-31

Add Settings to entity_config.yml
---------------------------------

To illustrate how you can add metadata to an entity, add the following YAML file (this file must be located in ``[BundleName]/Resources/config/oro/entity_config.yml``):

.. oro_integrity_check:: 44a787d6e0ceff70c64a1deced1f0da9a1260e42

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/entity_config.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/entity_config.yml
       :language: yaml
       :lines: 1-6, 11-12

This configuration adds the 'demo_attr' attribute with the 'Demo' value to all configurable entities. The configurable entity is an entity marked with the `@Config` annotation. This code also automatically adds a service named **oro_entity_config.provider.acme** into the DI container. You can use this service to get the value of a particular entity's 'demo_attr' attribute.

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

.. oro_integrity_check:: 0124d3ee31817b8ca7e23280f550875ec2b5df9b

   .. literalinclude:: /code_examples/commerce/demo/Entity/Document.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php
       :language: php
       :lines: 3-5, 8, 16-18, 23-26, 31, 58-60, 64-66

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

Essentially, it is all you need to add metadata to any entity. But in most cases, you want to allow an administrator to manage your attribute in UI. To accomplish this, let's change the YAML file the following way:

.. oro_integrity_check:: bf81121d34a84c2158c6f10b27f89d0f48eeb0c4

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/entity_config.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/entity_config.yml
       :language: yaml
       :lines: 1-23

Now you can go to System > Entities in the back-office. The 'Demo Attr' column should be displayed in the grid. Click Edit on any entity to open the edit entity form. The 'Demo Attr' field should be displayed there.

.. hint:: Check out the :ref:`example of YAML config <yaml-format-config-entity>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin

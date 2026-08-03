.. _book-entities-entity-configuration-implementation:

Implementation
==============

ConfigId
--------

ConfigID identifies each configurable object. The EntityConfigId class represents the entity id, and the FieldConfigId class represents the field id.

Config
------

This class stores configuration data for each configurable object.

ConfigProvider
--------------

The configuration provider manages configuration data within a particular configuration scope. Each configuration provider is a service called **oro_entity_config.provider.{scope}**, where **{scope}** is the name of the configuration scope the provider works with.

For example, the following code gets the configuration provider for the 'extend' scope.

.. code-block:: php

    /** @var Symfony\Component\DependencyInjection\ContainerInterface $container */
    $container = ...;

    /** @var Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider $acmeConfigProvider */
    $acmeConfigProvider = $container->get('oro_entity_config.provider.extend');

ConfigManager
-------------

This class is the central access point to the entity configuration functionality. It loads and saves configuration data from and into a database, manages configuration data and cache, retrieves the configuration provider for a particular scope, and more.

Events
------

- Events::CREATE_ENTITY - This event occurs when a new configurable entity is found, and its configuration attributes are loaded before they are stored in a database.
- Events::UPDATE_ENTITY - This event occurs when default values of configuration attributes of an existing entity are merged with existing configuration data, but before they are stored in a database.
- Events::CREATE_FIELD - This event occurs when a new configurable field is found, and its configuration attributes are loaded before they are stored in a database.
- Events::UPDATE_FIELD - This event occurs when default values of configuration attributes of the existing field are merged with existing configuration data before they are stored in a database.
- Events::RENAME_FIELD - This event occurs when the name of the existing field is being changed.
- Events::PRE_FLUSH - This event occurs before changes in configuration data are flushed into a database.
- Events::POST_FLUSH - This event occurs after all configuration data changes are flushed into a database.


.. include:: /include/include-links-dev.rst
   :start-after: begin

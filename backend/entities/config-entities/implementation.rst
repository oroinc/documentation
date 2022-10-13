.. _book-entities-entity-configuration-implementation:

Implementation
==============

ConfigId
--------

ConfigID allows to identify each configurable object. The entity id is represented by the EntityConfigId class. The field id is represented by the FieldConfigId class.

Config
------

The aim of this class is to store configuration data for each configurable object.

ConfigProvider
--------------

The configuration provider can be used to manage the configuration data inside particular configuration scope. Each configuration provider is a service called **oro_entity_config.provider.{scope}**, where **{scope}** is the name of the configuration scope with which the provider works.

For example, the following code gets the configuration provider for the 'extend' scope.

.. code-block:: php

    /** @var Symfony\Component\DependencyInjection\ContainerInterface $container */
    $container = ...;

    /** @var Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider $acmeConfigProvider */
    $acmeConfigProvider = $container->get('oro_entity_config.provider.extend');

ConfigManager
-------------

This class is the central access point to the entity configuration functionality. It allows loading/saving configuration data from/into a database, managing configuration data and cache, retrieving the configuration provider for a particular scope, etc.

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

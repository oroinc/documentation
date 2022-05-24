.. _book-entities-entity-configuration-implementation:

Implementation
==============

ConfigId
--------

Allows to identify each configurable object. The entity id is represented by the EntityConfigId class. The field id is represented by the FieldConfigId class.

Config
------

The aim of this class is to store configuration data for each configurable object.

ConfigProvider
--------------

The configuration provider can be used to manage the configuration data inside particular configuration scope. Each configuration provider is a service called **oro_entity_config.provider.{scope}**, where **{scope}** is the name of the configuration scope the provider works with.

For example, the following code gets the configuration provider for the 'extend' scope.

.. code-block:: php

    /** @var Symfony\Component\DependencyInjection\ContainerInterface $container */
    $container = ...;

    /** @var Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider $acmeConfigProvider */
    $acmeConfigProvider = $container->get('oro_entity_config.provider.extend');

ConfigManager
-------------

This class is the central access point to the entity configuration functionality. It allows to load/save configuration data from/into a database, manage configuration data, manage configuration data cache, retrieve the configuration provider for particular scope, etc.

Events
------

- Events::CREATE_ENTITY       - This event occurs when a new configurable entity is found and its configuration attributes are loaded, but before they are stored in a database.
- Events::UPDATE_ENTITY       - This event occurs when default values of configuration attributes of existing entity are merged with existing configuration data, but before they are stored in a database.
- Events::CREATE_FIELD        - This event occurs when a new configurable field is found and its configuration attributes are loaded, but before they are stored in a database.
- Events::UPDATE_FIELD        - This event occurs when default values of configuration attributes of existing field are merged with existing configuration data, but before they are stored in a database.
- Events::RENAME_FIELD        - This event occurs when the name of existing field is being changed.
- Events::PRE_FLUSH           - This event occurs before changes of configuration data is flushed into a database.
- Events::POST_FLUSH          - This event occurs after all changes of configuration data is flushed into a database.


.. include:: /include/include-links-dev.rst
   :start-after: begin

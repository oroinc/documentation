.. _book-entities-entity-configuration:

Configure Entities
==================

So far, Doctrine offers a wide range of functionality to map your entities to the database, save your data, and retrieve it. However, in an application based on the OroPlatform, you usually want to control how entities are presented to the user.

OroPlatform includes |EntityConfigBundle|, which lets you configure additional metadata for your entities and their fields. For example, you can configure the icons and labels shown for an entity in the UI, or set up access levels that control how entities are viewed and modified.

Configure Entities and Their Fields
-----------------------------------

Entities are not configurable by default. Tag them as configurable so the system can apply entity config options:

* The #[Config] attribute enables entity-level configuration.
* Use the #[ConfigField] attribute to enable config options for selected fields.

.. tip::

    The bundles from OroPlatform offer a large set of predefined options that you can use in your entities to configure them and control their behavior. Take a look at the ``entity_config.yml`` files that can be found in many bundles and read their dedicated documentation.

The ``#[Config]`` Attribute
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To make the ``Document`` entity from the first part of the chapter configurable, import the ``Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config`` attribute and use it:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;

    #[ORM\Entity]
    #[ORM\Table(name: 'acme_demo_document')]
    #[Config]
    class Document
    {
        // ...
    }

You can also change the default value of each configurable option using the ``defaultValues`` argument:

.. oro_integrity_check:: ee936d777bc00e1b5f1efa84f3dfa80fa0cfb3e3

   .. literalinclude:: /code_examples/commerce/demo/Entity/Document.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php
       :language: php
       :lines: 3-5, 8, 16-19, 21-22, 27, 45, 48-49

The ``#[ConfigField]`` Attribute
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Similar to the ``#[Config]`` attribute for entities, you can use the ``Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField`` attribute to make properties of an entity configurable. You can change default values the same way as at the entity level:

.. oro_integrity_check:: 87d66dfb91dac696f1cfc3dd66a43f1980641633

   .. literalinclude:: /code_examples/commerce/demo/Entity/Document.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php
       :language: php
       :lines: 60, 66-68, 60

Console Commands
----------------

Update Configuration Data
^^^^^^^^^^^^^^^^^^^^^^^^^

To update configurable entities, use the following:

.. code-block:: bash

   php bin/console oro:entity-config:update

Run this command only in 'dev' mode, when a new configuration attribute or the whole configuration scope is added.

Clearing Up Cache
^^^^^^^^^^^^^^^^^

To remove all data related to configurable entities from the application cache, use:

.. code-block:: none

   php bin/console oro:entity-config:cache:clear

To skip warming up the cache after cleaning, use the ``--no-warmup`` command:

.. code-block:: none

   php bin/console oro:entity-config:cache:clear --no-warmup

Warming Up the Cache
^^^^^^^^^^^^^^^^^^^^

To warm up the entity config cache, use the ``oro:entity-config:cache:warmup`` command:

.. code-block:: none

   php bin/console oro:entity-config:cache:warmup

Debugging Configuration Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Use the ``oro:entity-config:debug`` command to get different types of configuration data and to add, remove, or update entity configuration. To see all available options, run it with the ``--help`` option.

The example shows all configuration data for the User entity:

.. code-block:: none

   php bin/console oro:entity-config:debug "Acme\Bundle\DemoBundle\Entity\Document"

.. note:: Check out the Attributes topic to learn how to assign functionality to an entity to :ref:`create and manipulate attributes <dev-entities-attributes>`.

.. toctree::
   :titlesonly:
   :maxdepth: 2

   configure-entity-config-attribute
   implementation
   add-configuration-options
   access-entities-configuration

.. include:: /include/include-links-dev.rst
   :start-after: begin

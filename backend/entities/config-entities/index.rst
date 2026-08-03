.. _book-entities-entity-configuration:

Configure Entities
==================

So far, Doctrine offers a wide range of functionality to map your entities to the database, save your data, and retrieve it. However, in an application based on the OroPlatform, you usually want to control how entities are presented to the user.

OroPlatform includes |EntityConfigBundle|, which lets you configure additional metadata for your entities and their fields. For example, you can configure the icons and labels shown for an entity in the UI, or set up access levels that control how entities are viewed and modified.

Configure Entities and Their Fields
-----------------------------------

Entities are not configurable by default. Tag them as configurable so the system can apply entity config options:

* The @Config annotation enables entity-level configuration.
* Use the @ConfigField annotation to enable config options for selected fields.

.. tip::

    The bundles from OroPlatform offer a large set of predefined options that you can use in your entities to configure them and control their behavior. Take a look at the ``entity_config.yml`` files that can be found in many bundles and read their dedicated documentation.

The ``@Config`` Annotation
^^^^^^^^^^^^^^^^^^^^^^^^^^

To make the ``Document`` entity from the first part of the chapter configurable, import the ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config`` annotation and use it in the class docblock:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_demo_document")
     * @Config
     */
    class Document
    {
        // ...
    }

You can also change the default value of each configurable option using the ``defaultValues`` argument:

.. oro_integrity_check:: 215815e4064b0d0bb7e631051670aa47ed1c5280

   .. literalinclude:: /code_examples/commerce/demo/Entity/Document.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php
       :language: php
       :lines: 3-5, 8, 16-19, 23-26, 31, 55-57, 64-66

The ``@ConfigField`` Annotation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Similar to the ``@Config`` annotation for entities, you can use the ``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField`` annotation to make properties of an entity configurable. You can change default values the same way as at the entity level:

.. oro_integrity_check:: a83cb02ddc60cfa23be7f9c166484d8987bfb87d

   .. literalinclude:: /code_examples/commerce/demo/Entity/Document.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php
       :language: php
       :lines: 78, 87-98, 103-105, 78

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

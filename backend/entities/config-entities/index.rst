.. _book-entities-entity-configuration:

Configure Entities
==================

So far, Doctrine offers a wide range of functionality to map your entities to the database, to
save your data and to retrieve them from the database. However, in an application based on the Oro
Platform, you usually want to control how entities are presented to the user. OroPlatform
includes the |EntityConfigBundle| that makes it easy to configure additional metadata of your
entities as well as the fields of your entities. For example, you can now configure icons and
labels used when showing an entity in the UI, or you can set up access levels to control how
entities can be viewed and modified.

Configure Entities and Their Fields
-----------------------------------

Entities will not be configurable by default. They must be tagged as configurable entities to let
the system apply entity config options to them:

* The @Config annotation is used to enable entity level configuration for an entity.
* Use the @ConfigField annotation to enable config options for selected fields.

.. tip::

    The bundles from OroPlatform offer a large set of predefined options that you can use in
    your entities to configure them and control their behavior. Take a look at the
    ``entity_config.yml`` files that can be found in many bundles and read their dedicated
    documentation.

The ``@Config`` Annotation
^^^^^^^^^^^^^^^^^^^^^^^^^^

To make the ``Document`` entity from the first part of the chapter configurable, simply import the
``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config`` annotation and
use it in the class docblock:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_document")
     * @Config
     */
    class Document
    {
        // ...
    }


You can also change the default value of each configurable option using the ``defaultValues``
argument:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_document")
     * @Config(
     *     defaultValues={
     *         "acme_demo"={
     *             "comment"="Our documents"
     *         }
     *     }
     * )
     */
    class Document
    {
        // ...
    }

The ``@ConfigField`` Annotation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Similar to the ``@Config`` annotation for entities, you can use the
``Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField``
annotation to make properties of an entity configurable:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_document")
     */
    class Document
    {
        // ...

        /**
        * @ORM\Column(type="string", length=255)
        * @ConfigField
        */
        protected $subject;

        // ...
    }

Default values can be changed the same way as for the entity level:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php

    namespace Acme\Bundle\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_document")
     */
    class Document
    {
        // ...

        /**
        * @ORM\Column(type="string", length=255)
        * @ConfigField(
        *     "defaultValues"={
        *         "acme_demo"={
        *             "auditable"=true
        *         }
        *     }
        * )
        */
        private $subject;

        // ...
    }

Console Commands
----------------

Update Configuration Data
^^^^^^^^^^^^^^^^^^^^^^^^^

To update configurable entities, use:

.. code-block:: bash

   php bin/console oro:entity-config:update

Execute this command only in the 'dev' mode when a new configuration attribute or the whole configuration scope is added.

Clearing Up Cache
^^^^^^^^^^^^^^^^^

To remove all data related to configurable entities from the application cache, use:

.. code-block:: none

   php bin/console oro:entity-config:cache:clear

To skip warming up cache after cleaning, use the ``--no-warmup`` command:

.. code-block:: none

   php bin/console oro:entity-config:cache:clear --no-warmup

Warmimg Up the Cache
^^^^^^^^^^^^^^^^^^^^

To warm up entity config cache, use the ``oro:entity-config:cache:warmup`` command:

.. code-block:: none

   php bin/console oro:entity-config:cache:warmup

Debugging Configuration Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To get a different type of configuration data, add/remove/update configuration of entities, use the ``oro:entity-config:debug`` command. To see all available options, run this command with the ``--help`` option.

 The example shows all configuration data for the User entity:

.. code-block:: none

   php bin/console oro:entity-config:debug "Acme\Bundle\DemoBundle\Entity\Document"

.. note:: Checkout the Attributes topic to learn how to assign functionality to an entity to :ref:`create and manipulate attributes <dev-entities-attributes>`.

.. toctree::
   :titlesonly:
   :maxdepth: 2

   configure-entity-config-attribute
   implementation
   add-configuration-options
   access-entities-configuration

.. include:: /include/include-links-dev.rst
   :start-after: begin

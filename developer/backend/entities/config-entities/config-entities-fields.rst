.. _book-entities-config-annotation:
.. _book-entities-config-field-annotation:

Configure Entities and Their Fields
-----------------------------------

.. begin_body

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

To make the ``Hotel`` entity from the first part of the chapter configurable, simply import the
:class:`@Config <Oro\\Bundle\\EntityConfigBundle\\Metadata\\Annotation\\Config>` annotation and
use it in the class docblock:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     * @Config
     */
    class Hotel
    {
        // ...
    }

You can also change the default value of each configurable option using the ``defaultValues``
argument:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     * @Config(
     *     defaultValues={
     *         "acme_demo"={
     *             "comment"="Our hotels"
     *         }
     *     }
     * )
     */
    class Hotel
    {
        // ...
    }

The ``@ConfigField`` Annotation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Similar to the ``@Config`` annotation for entities, you can use the
:class:`@ConfigField <Oro\\Bundle\\EntityConfigBundle\\Metadata\\Annotation\\ConfigField>`
annotation to make properties of an entity configurable:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     */
    class Hotel
    {
        // ...

        /**
        * @ORM\Column(type="string", length=255)
        * @ConfigField
        */
        private $name;

        // ...
    }

Default values can be changed in the same way as it can be done on the entity level:

.. code-block:: php
    :linenos:

    // src/Acme/DemoBundle/Entity/Hotel.php
    namespace Acme\DemoBundle\Entity;

    use Doctrine\ORM\Mapping as ORM;
    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;

    /**
     * @ORM\Entity
     * @ORM\Table(name="acme_hotel")
     */
    class Hotel
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
        private $name;

        // ...
    }


.. finish_body

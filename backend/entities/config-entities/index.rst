.. _book-entities-entity-configuration:

Configure Entities
==================

So far, Doctrine offers a wide range of functionality to map your entities to the database, to
save your data and to retrieve them from the database. However, in an application based on the Oro
Platform, you usually want to control how entities are presented to the user. OroPlatform
includes the |EntityConfigBundle| that makes it easy to configure additional metadata of your
entities as well as the fields of your entities. For example, you can now configure icons and
labels used when showing an entity in the UI or you can set up access levels to control how
entities can be viewed and modified.

Getting Started
---------------

To illustrate how metadata can be added to an entity, lets add the following YAML file (this file must be located in ``[BundleName]/Resources/config/oro/entity_config.yml``):

.. code-block:: yaml

    entity_config:
        acme:                                      # a configuration scope name
            entity:                                # a section describes an entity
                items:                             # starts a description of entity attributes
                    demo_attr:                     # adds an attribute named 'demo_attr'
                        options:
                            default_value: 'Demo'  # sets the default value for 'demo_attr' attribute

This configuration adds the 'demo_attr' attribute with the 'Demo' value to all configurable entities. The configurable entity is an entity marked with the `@Config` annotation. This code also automatically adds a service named **oro_entity_config.provider.acme** into the DI container. You can use this service to get a value of the 'demo_attr' attribute for a particular entity.

To apply this change, execute the **oro:entity-config:update** command:

.. code-block:: bash

   php bin/console oro:entity-config:update

An example how to get a value of a configuration attribute:

.. code-block:: php

    <?php
        /** @var ConfigProvider $acmeConfigProvider */
        $acmeConfigProvider = $this->get('oro_entity_config.provider.acme');

        // retrieve a value of 'demo_attr' attribute for 'AcmeBundle\Entity\SomeEntity' entity
        // the value of $demoAttr variable will be 'Demo'
        $demoAttr = $acmeConfigProvider->getConfig('AcmeBundle\Entity\SomeEntity')->get('demo_attr');

If you want to set a value different than the default one for some entity, write it in the `@Config` annotation for this entity. For example:

.. code-block:: php

    <?php
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

    <?php
        /** @var ConfigProvider $acmeConfigProvider */
        $acmeConfigProvider = $this->get('oro_entity_config.provider.acme');

        // retrieve a value of 'demo_attr' attribute for 'AcmeBundle\Entity\SomeEntity' entity
        // the value of $demoAttr1 variable will be 'Demo'
        $demoAttr1 = $acmeConfigProvider->getConfig('AcmeBundle\Entity\SomeEntity')->get('demo_attr');

        // retrieve a value of 'demo_attr' attribute for 'AcmeBundle\Entity\MyEntity' entity
        // the value of $demoAttr2 variable will be 'MyValue'
        $demoAttr2 = $acmeConfigProvider->getConfig('AcmeBundle\Entity\MyEntity')->get('demo_attr');

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

Implementation
--------------

ConfigId
^^^^^^^^

Allows to identify each configurable object. The entity id is represented by the EntityConfigId class. The field id is represented by the FieldConfigId class.

Config
^^^^^^

The aim of this class is to store configuration data for each configurable object.

ConfigProvider
^^^^^^^^^^^^^^

The configuration provider can be used to manage thea  configuration data inside particular configuration scope. Each configuration provider is a service called **oro_entity_config.provider.{scope}**, where **{scope}** is the name of the configuration scope the provider works with.

For example, the following code gets the configuration provider for the 'extend' scope.

.. code-block:: php

    <?php

    /** @var ConfigProvider $configProvider */
    $configProvider = $this->get('oro_entity_config.provider.extend');

ConfigManager
^^^^^^^^^^^^^

This class is the central access point to the entity configuration functionality. It allows to load/save configuration data from/into a database, manage configuration data, manage configuration data cache, retrieve the configuration provider for particular scope, and other.

Events
^^^^^^

- Events::CREATE_ENTITY       - This event occurs when a new configurable entity is found and its configuration attributes are loaded, but before they are stored in a database.
- Events::UPDATE_ENTITY       - This event occurs when default values of configuration attributes of existing entity are merged with existing configuration data, but before they are stored in a database.
- Events::CREATE_FIELD        - This event occurs when a new configurable field is found and its configuration attributes are loaded, but before they are stored in a database.
- Events::UPDATE_FIELD        - This event occurs when default values of configuration attributes of existing field are merged with existing configuration data, but before they are stored in a database.
- Events::RENAME_FIELD        - This event occurs when the name of existing field is being changed.
- Events::PRE_FLUSH           - This event occurs before changes of configuration data is flushed into a database.
- Events::POST_FLUSH          - This event occurs after all changes of configuration data is flushed into a database.

Update Configuration Data
-------------------------

The following command can be used to update configurable entities:

.. code-block:: bash

   php bin/console oro:entity-config:update

Usually you need to execute this command only in the 'dev' mode when a new configuration attribute or the whole configuration scope is added.

Clearing Up the Cache
---------------------

The following command removes all data related to configurable entities from the application cache:

.. code-block:: bash

   php bin/console oro:entity-config:cache:clear --no-warmup

Debugging Configuration Data

You can use ``oro:entity-config:debug`` command to get a different kind of configuration data as well as add/remove/update configuration of entities. To see all available options run this command with ``--help`` option. As an example the following command shows all configuration data for User entity:

.. code-block:: bash

   php bin/console oro:entity-config:debug "Oro\Bundle\UserBundle\Entity\User"

.. note:: Checkout the Attributes topic to learn how to assign functionality for entity to :ref:`create and manipulate attributes <dev-entities-attributes>`.

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

Add Configuration Options
-------------------------

In the first step, you need to define the options that should be configurable. New options can be
created per bundle which means that a bundle can extend the set of available options. To add new
options, you create a ``entity_config.yml`` file in your bundle which can look like this:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/oro/entity_config.yml
    entity_config:
        acme_demo:
            entity:
                items:
                    comment:
                        options:
                            default_value: ""
                            translatable:  true
                            indexed:       true
                        grid:
                            type:        string
                            label:       Comment
                            show_filter: true
                            filterable:  true
                            filter_type: string
                            sortable:    true
                        form:
                            type: text
                            options:
                                block: entity
                                label: Comment
            field:
                items:
                    auditable:
                        options:
                            indexed:  true
                            priority: 60
                        grid:
                            type:        boolean
                            label:       'Auditable'
                            show_filter: false
                            filterable:  true
                            filter_type: boolean
                            sortable:    true
                            required:    true
                        form:
                            type: choice
                            options:
                                block:       entity
                                label:       'Auditable'
                                choices:     ['No', 'Yes']
                                empty_value: false

The key used in the first level of the entity configuration is a custom identifier used to create
a kind of namespace for the additional options. For each scope, a different service is created (its
name follows the schema ``oro_entity_config.provider.<scope>``). For example, the service name for
the options configured in the example above is ``oro_entity_config.provider.acme_demo``. It is an
instance of the :class:`Oro\\Bundle\\EntityConfigBundle\\Provider\\ConfigProvider` class.

Options can be configured on two levels: on the entity level or per field. The example above adds a new ``comment`` property that allows the users to
add custom comments per configurable entity. It also adds the ``auditable`` option on the field
level. This means that the user can decide for every field on an entity whether or not it should
be audited.

The configured values are stored in different tables:

* Values for options on the entity level are stored in the ``oro_entity_config`` table.
* The ``oro_entity_config_field`` table is used to store configured values for the field level.

Below the configuration level, each option's configuration is divided into three sections:

.. _book-entities-configuration-options:

``options``
    These values are used to configure additional behavior for the config field:

    +-------------------+-------------------------------------------------------------------------+
    | Option            | Description                                                             |
    +===================+=========================================================================+
    | ``default_value`` | The value that is used by default when no custom value was added.       |
    +-------------------+-------------------------------------------------------------------------+
    | ``translatable``  | If ``true``, the value entered by the user is treated as a key which is |
    |                   | then used to look up the actual value using the Symfony translation     |
    |                   | procedure.                                                              |
    +-------------------+-------------------------------------------------------------------------+
    | ``indexed``       | Set this to ``true`` when the attribute needs to be accessed in SQL     |
    |                   | queries (see :ref:`book-entities-indexed-attributes`).                  |
    +-------------------+-------------------------------------------------------------------------+
    | ``priority``      | Defines the order in which options will be shown in grid views and      |
    |                   | forms (options with a higher priority will be displayed before options  |
    |                   | with a lower priority).                                                 |
    +-------------------+-------------------------------------------------------------------------+

``grid``
    Configures the way the field is presented in a datagrid:

    +-------------------+-------------------------------------------------------------------------+
    | Option            | Description                                                             |
    +===================+=========================================================================+
    | ``type``          | The attribute type                                                      |
    +-------------------+-------------------------------------------------------------------------+
    | ``label``         | The grid column headline                                                |
    +-------------------+-------------------------------------------------------------------------+
    | * ``show_filter`` | These options control whether the view can be filtered by the attribute |
    | * ``filterable``  | value and how the filter options look like.                             |
    | * ``filter_type`` |                                                                         |
    +-------------------+-------------------------------------------------------------------------+
    | ``sortable``      | When enabled, the user can sort the table by clicking on the attribute  |
    |                   | column's title.                                                         |
    +-------------------+-------------------------------------------------------------------------+

    .. note::

        In order to use the attribute in a grid view, it
        :ref:`needs to be indexed <book-entities-indexed-attributes>`.

``form``
    You use these options to control how the actual value can be configured by the user:

    +-------------------+-------------------------------------------------------------------------+
    | Option            | Description                                                             |
    +===================+=========================================================================+
    | ``type``          | The form type                                                           |
    +-------------------+-------------------------------------------------------------------------+
    | ``options``       | Additional options controlling the form layout:                         |
    +-------------------+-------------------------------------------------------------------------+
    | * ``block``       | The block of the form in which the attribute will be displayed          |
    +-------------------+-------------------------------------------------------------------------+
    | * ``label``       | The field label                                                         |
    +-------------------+-------------------------------------------------------------------------+
    | * ``choices``     | Possible values from which the user can choose one (this option is only |
    |                   | available when the form type is ``choice``)                             |
    +-------------------+-------------------------------------------------------------------------+
    | * ``empty_value`` | The value that is taken when the user makes no choice (this option is   |
    |                   | only available when the form type is ``choice``)                        |
    +-------------------+-------------------------------------------------------------------------+

Secondly, you need to update all configurable entities after configuration parameters have been
modified or added using the ``oro:entity-config:update`` command:

.. code-block:: bash

    $ php bin/console oro:entity-config:update --force

When the ``oro:entity-config:update`` command is executed without using the ``--force`` option,
only new values will be added, but no existing parameters will be updated.

.. _book-entities-indexed-attributes:

Indexed Attributes
^^^^^^^^^^^^^^^^^^

.. _book-entities-entity-extension:

By default, the values the user enters when editing additional entity attributes are stored as
serialized arrays in the database. However, when the application needs to use attributes in an SQL
query, it needs to get the *raw* data. To achieve this, you have to enable the index using the
:ref:`indexed key <book-entities-configuration-options>` in the ``options`` section. When this
option is enabled, the system will store a copy of the attributes value and keep it in sync when it
gets updated (the indexed value is stored in the ``oro_entity_config_index_value`` table).

For example, it is required for fields to be visible in grids in System > Entities section and have a filter or allow sorting in this grid. In this case you can mark a field as indexed. For example:

.. code-block:: yaml

    entity_config:
        acme:
            entity:
                items:
                    demo_attr:
                        options:
                            indexed: true

When you do this, a copy of this attribute will be stored (and will be kept synchronized if a value is changed) in `oro_entity_config_index_value` table. As a result you can write SQL query like this:

.. code-block:: sql

    select *
    from oro_entity_config c
        inner join oro_entity_config_index_value v on v.entity_id = c.id
    where v.scope = 'entity' and v.code = 'label' and v.value like '%test%'

.. _book-entities-config-annotation:
.. _book-entities-config-field-annotation:

Access Entities Configuration
-----------------------------

Now that you know how you define additional configuration options and how to use them in your own
entities, you will usually want to access the configured values. The main entry point to access the
configuration is the provider service for the particular scope which has to be retrieved from the
service container. For example, if you want to work with your newly created ``auditable`` option,
you will have to use the ``oro_entity_config.provider.acme_demo`` service (the ``auditable`` option
was defined in the ``acme_demo`` scope):

.. code-block:: php
    :linenos:

    // $container is an instance of Symfony\Component\DependencyInjection\ContainerInterface
    $container = ...;
    $acmeDemoProvider = $container->get('oro_entity_config.provider.acme_demo');

Then you need to fetch the configuration in this scope for a particular entity or entity field
using the :method:`Oro\\Bundle\\EntityConfigBundle\\Provider\\ConfigProvider::getConfig` method. The
configuration for such a configurable object (an entity or a field) is represented by an instance
of the :class:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface`:

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::get`
    Returns the actually configured value for an option.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::set`
    Changes the value of an option to a new value.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::remove`
    Removes the particular option.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::has`
    Checks whether or not an option with the given name exists.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::is`
    Checks if the value of an option equals the given value.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::in`
    Checks if the value of an option is one of the given values.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::all`
    Returns all parameters for the configurable object.

:method:`Oro\\Bundle\\EntityConfigBundle\\Config\\ConfigInterface::setValues`
    Replaces values for the given options with some given values.

Please note that it is not enough to modify configuration values in the provider. You also need to
persist your changes by calling the :method:`Oro\\Bundle\\EntityConfigBundle\\Provider\\ConfigProvider::flush`
method afterwards:

.. code-block:: php
    :linenos:

    // ...
    $acmeDemoProvider = $container->get('oro_entity_config.provider.acme_demo');
    $acmeConfig = $acmeDemoProvider->getConfig('Acme\Bundle\AcmeBundle\Entity\Hotel');
    $acmeConfig->set('comment', 'Updated comment');
    $acmeDemoProvider->getConfigManager()->flush();

.. tip::

    Use the ``oro:entity-config:debug`` command to access or modify configuration values from the
    command line.

.. include:: /include/include-links-dev.rst
   :start-after: begin

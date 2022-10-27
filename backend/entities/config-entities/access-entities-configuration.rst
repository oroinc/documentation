.. _book-entities-config-annotation:
.. _book-entities-config-field-annotation:

Access Entities Configuration
=============================

Now that you know how to define additional configuration options and use them in your own
entities, you will usually want to access the configured values. The main entry point to access the
configuration is the provider service for the particular scope, which has to be retrieved from the
service container. For example, if you want to work with your newly created ``auditable`` option,
you will have to use the ``oro_entity_config.provider.acme_demo`` service (the ``auditable`` option
was defined in the ``acme_demo`` scope):

.. code-block:: php


    /** @var Symfony\Component\DependencyInjection\ContainerInterface $container */
    $container = ...;
    $acmeDemoProvider = $container->get('oro_entity_config.provider.acme_demo');

Then you need to fetch the configuration in this scope for a particular entity or entity field
using the ``Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider::getConfig`` method. The
configuration for such a configurable object (an entity or a field) is represented by an instance
of the ``Oro\Bundle\EntityConfigBundle\Config\ConfigInterface``:

``get()``
    Returns the actually configured value for an option.

``set()``
    Changes the value of an option to a new value.

``remove()``
    Removes the particular option.

``has()``
    Checks whether or not an option with the given name exists.

``is()``
    Checks if the value of an option equals the given value.

``in()``
    Checks if the value of an option is one of the given values.

``all()``
    Returns all parameters for the configurable object.

``setValues()``
    Replaces values for the given options with some given values.

Please note that it is not enough to modify configuration values in the provider. You also need to
force your changes by calling the ``Oro\Bundle\EntityConfigBundle\Provider\ConfigProvider::flush``
method afterwards:

.. code-block:: php


    // ...
    $acmeDemoProvider = $container->get('oro_entity_config.provider.acme_demo');
    $acmeConfig = $acmeDemoProvider->getConfig('Acme\Bundle\DemoBundle\Entity\Document');
    $acmeConfig->set('comment', 'Updated comment');
    $acmeDemoProvider->getConfigManager()->flush();

.. tip::

    Use the ``oro:entity-config:debug`` command to display entity configuration and access or modify configuration values from the command line.

.. include:: /include/include-links-dev.rst
   :start-after: begin

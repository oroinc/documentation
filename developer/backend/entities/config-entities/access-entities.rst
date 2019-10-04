Configure Access to Entities
----------------------------

.. begin_body

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

.. finish
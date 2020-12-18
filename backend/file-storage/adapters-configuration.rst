.. _backend-file-storage--adapters-configuration:

Adapters Configuration
======================

.. _backend-file-storage-reconfigure-file-system-adapters:

Reconfigure File System Adapters
--------------------------------

By default, public and private file system type |Gaufrette| adapters are configured to use the local file system adapter.
However, you can reconfigure them to use another storage adapter.

Oro applications support the local file system adapter and |GridFS| by :ref:`GridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>`.

There are two ways to change the configuration of adapters:

1. The usual way that requires the configuration of |KnpGaufretteBundle|.

2. A simplified way, where you can reconfigure the already configured adapters with the ``config/parameters.yml`` file.

.. _backend-file-storage-adapters-configuration-with-knpgaufrettebundle:

Adapters Configuration with KnpGaufretteBundle
----------------------------------------------

As storage types are the |KnpGaufretteBundle| adapters, you can configure them with manual configuration of KnpGaufrette bundle.

For example, to use the Oro GridFS Gaufrette adapter, use the ``oro_gridfs`` adapter type. To configure a new or reconfigure an
existing adapter, add the |KnpGaufretteBundle| configuration in the ``Resources/config/oro/app.yml`` file of any bundle
or the ``config/config.yml`` file of your application:

.. code-block:: yaml
   :linenos:

    knp_gaufrette:
        adapters:
            public: # the adapter name
                oro_gridfs:
                    mongodb_gridfs_dsn: 'mongodb://127.0.0.1:27017/media'

More info about configuration of the ``oro_gridfs`` adapter type is available in the :ref:`OroGridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>` documentation.

.. _backend-file-storage-adapters-configuration-with-parameters.yml:

Adapters Configuration with parameters.yml
------------------------------------------

To simplify the configuration of the already existing Gaufrette adapters or filesystems,
use the ``config/parameters.yml`` file of your application.

To reconfigure an adapter, add the parameter with the ``gaufrette_adapter.[adapter_name]`` name,
where ``adapter_name`` is the name of an existing adapter.

The value of the parameter is the configuration string of the adapter type.

The following example shows the reconfiguration of the ``public`` adapter to use ``oro_gridfs``` adapter:

.. code:: yaml

   gaufrette_adapter.public: 'gridfs:mongodb://user:password@host:27017/media'

To get the list of existing Gaufrette adapters, use the following command:

.. code:: bash

   bin/console debug:config knp_gaufrette adapters

To reconfigure a filesystem, add the parameter with the name ``gaufrette_filesystem.[filesystem_name]``,
where ``filesystem_name`` is the name of an existing filesystem.

As for the adapter configuration, the parameter's value is the configuration string of the adapter type.

The following example shows the reconfiguration of the ``attachments`` filesystem to use ``oro_gridfs`` adapter:

.. code:: yaml

   gaufrette_filesystem.attachments: 'gridfs:mongodb://user:password@host:27017/attachments'

To get the list of existing Gaufrette filesystems, use the following command:

.. code:: bash

   bin/console debug:config knp_gaufrette filesystems

More info about configuration of the ``oro_gridfs`` adapter type is available in the :ref:`OroGridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>` documentation.

.. _backend-file-storage-add-ability-to-configure-adapter-with-parameters.yml:

Add Ability To Configure Adapter with parameters.yml
----------------------------------------------------

Additional Gaufrette adapter types can also be enabled to support configuration via parameters.yml file.

To do this, the Configuration class that implements ConfigurationFactoryInterface should be implemented and registered
as the configuration factory of oro_gaufrette package in your bundle class:

The following example shows how to do this for an AdapterConfigurationFactory class:

.. code-block:: php
    :linenos:

    <?php

    namespace Acme\Bundle\YourBundle;

    use Acme\Bundle\YourBundle\DependencyInjection\Factory\AdapterConfigurationFactory;
    use Oro\Bundle\GaufretteBundle\DependencyInjection\OroGaufretteExtension;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    /**
     * The YourBundle bundle class.
     */
    class AcmeYourBundle extends Bundle
    {
        /**
         * {@inheritDoc}
         */
        public function build(ContainerBuilder $container)
        {
            parent::build($container);

            /** @var OroGaufretteExtension $gaufretteExtension */
            $gaufretteExtension = $container->getExtension('oro_gaufrette');
            $gaufretteExtension->addConfigurationFactory(new AdapterConfigurationFactory());
        }
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin
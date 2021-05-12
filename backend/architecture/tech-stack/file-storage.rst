.. _backend-file-storage:

File Storage
============

This section describes the filesystem abstraction layer used in the Oro application to access data files.

The file storage abstraction is based on |KnpGaufretteBundle| with :ref:`GaufretteBundle <bundle-docs-platform-gaufrette-bundle>`
that enables a filesystem abstraction layer in the Oro applications and provides a simplified file manager service for media files.

The file storage can be configured to use different types of filesystem adapters to store the data,
for example, your local filesystem, GridFS storage, etc. For more details, see
`File System Adapters Configuration <#file-system-adapters-configuration>`__.

.. _backend-file-storage-types-of-storage:

Types of Storage
----------------

By default, the file storage component provides two types of storage with |Gaufrette| adapters:

- private
- public

The **private** file storage adapter is implemented to store data that should not be available via a direct link.
Examples of such data types are attachments' data, import and export files, protected media cache files, etc.
If the local filesystem adapter is used by default, then data will be stored in the ``/var/data`` directory of the application.

The **public** file storage adapter is implemented to store data that can be available via a direct link without access checks.
Examples of such data are resized product images, sitemap files, etc. If the local filesystem adapter is used by default,
data will be stored in the ``public/media`` directory of the application.

.. _backend-file-storage--adapters-configuration:

File System Adapters Configuration
----------------------------------

By default, the **public** and **private** Gaufrette adapters are configured to use the local filesystem adapter.
However, you can reconfigure them to use another storage adapter.

Oro applications support the local filesystem adapter and |GridFS| by :ref:`GridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>`.

There are two ways to change the configuration of adapters:

1. The usual way that requires the configuration of |KnpGaufretteBundle|.

2. A simplified way, where you can reconfigure the already configured adapters with the `config/parameters.yml` file.

.. note::

    Please take into account that old data that was uploaded to the local storage will not be migrated to a new storage.

.. _backend-file-storage-adapters-configuration-with-knpgaufrettebundle:

File System Adapters Configuration with KnpGaufretteBundle
----------------------------------------------------------

As storage types are the |KnpGaufretteBundle| adapters, you can configure them with manual configuration of this bundle.

For example, to use the Oro GridFS Gaufrette adapter, use the ``oro_gridfs`` adapter type. To configure a new or reconfigure an
existing adapter, add the |KnpGaufretteBundle| configuration in the `Resources/config/oro/app.yml` file of any bundle
or the `config/config.yml` file of your application:

.. code-block:: yaml

    knp_gaufrette:
        adapters:
            public: # the adapter name
                oro_gridfs:
                    mongodb_gridfs_dsn: 'mongodb://127.0.0.1:27017/media'

As you can see from the example, the configuration of ``oro_gridfs`` adapter has the ``mongodb_gridfs_dsn`` parameter
with the configuration of MongoDB DSN string. The format of this string is the following:
``[protocol]://[username]:[password]@[host]:[port]/[database]``, where:

- **protocol** is `mongodb`
- **username** is username that has an access to the MongoDB database
- **password** is the user's password
- **host** is the hostname or IP address of the MongoDB server
- **database** is the MongoDB database name should be used as GridGS storage

.. _backend-file-storage-adapters-configuration-with-parameters.yml:

File System Adapters Configuration with parameters.yml
------------------------------------------------------

To simplify the configuration of the already existing Gaufrette adapters or filesystems,
the `config/parameters.yml` file of your application can be used.

To reconfigure an adapter, add the parameter with the ``gaufrette_adapter.[adapter_name]`` name,
where ``adapter_name`` is the name of an existing adapter.

The value of the parameter is the MongoDB DSN string described in the previous chapter starts with the ``gridfs:`` prefix.

The following example shows the reconfiguration of the **public** adapter:

.. code:: yaml

   gaufrette_adapter.public: 'gridfs:mongodb://user:password@host:27017/media'

To get the list of existing Gaufrette adapters, use the following command:

.. code:: bash

   bin/console debug:config knp_gaufrette adapters

To reconfigure a filesystem, add the parameter with the name ``gaufrette_filesystem.[filesystem_name]``,
where ``filesystem_name`` is the name of an existing filesystem.

As for the adapter configuration, the parameter's value is the MongoDB DSN string starts with the ``gridfs:`` prefix.

The following example shows the reconfiguration of the ``attachments`` filesystem:

.. code:: yaml

   gaufrette_filesystem.attachments: 'gridfs:mongodb://user:password@host:27017/attachments'

To get the list of existing Gaufrette filesystems, use the following command:

.. code:: bash

   bin/console debug:config knp_gaufrette filesystems

.. _backend-file-storage-configuration-for-cluster-mongodb-gridfs-setup:

Configuration for Cluster MongoDB GridFS Setup
----------------------------------------------

If you have installed MongoDB cluster, it can be used as the GridFS storage as well.

In this case, the MongoDB DSN string has the following format:
``[protocol]://[user]:[password]@[host1]:[port],[host2]:[port]/[database]``

Example:

.. code-block:: yaml

   gaufrette_adapter.public: 'gridfs:mongodb://user:password@host1:27017,host2:27017/media'

.. _backend-file-storage-add-ability-to-configure-adapter-with-parameters.yml:

Add Ability To Configure File System Adapter with parameters.yml
----------------------------------------------------------------

Additional Gaufrette adapter types can also be enabled to support configuration via `config/parameters.yml` file.

To do this, create a configuration factory class that implements |ConfigurationFactoryInterface| and register it
as the configuration factory for the `oro_gaufrette` bundle in your bundle class:

.. code-block:: php

    <?php

    namespace Acme\Bundle\AppBundle\DependencyInjection\Factory;

    use Oro\Bundle\GaufretteBundle\DependencyInjection\Factory\ConfigurationFactoryInterface;

    class SomeAdapterConfigurationFactory implements ConfigurationFactoryInterface
    {
        public function getAdapterConfiguration(string $configString): array
        {
        }

        public function getKey(): string
        {
        }

        public function getHint(): string
        {
        }
    }

.. code-block:: php

    <?php

    namespace Acme\Bundle\AppBundle;

    use Acme\Bundle\AppBundle\DependencyInjection\Factory\SomeAdapterConfigurationFactory;
    use Oro\Bundle\GaufretteBundle\DependencyInjection\OroGaufretteExtension;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\HttpKernel\Bundle\Bundle;

    class AcmeAppBundle extends Bundle
    {
        /**
         * {@inheritDoc}
         */
        public function build(ContainerBuilder $container)
        {
            parent::build($container);

            /** @var OroGaufretteExtension $gaufretteExtension */
            $gaufretteExtension = $container->getExtension('oro_gaufrette');
            $gaufretteExtension->addConfigurationFactory(new SomeAdapterConfigurationFactory());
        }
    }

.. _backend-access-the-data-in-storage:

Access to Data in Storage
-------------------------

The main access point to the files in storage is the |FileManager| service.

To implement the access point to your type of data in the storage:

- Add new Gaufrette filesystem configuration into the `Resources/config/oro/app.yml` file of your bundle and set **private** or **public** as the filesystem adapter:

.. code-block:: yaml

    knp_gaufrette:
        filesystems:
            some_storage:
                adapter: private # the type of storage (public or private)
                alias: some_storage_filesystem

- Register the |FileManager| service as the child of the ``oro_gaufrette.file_manager`` service:

.. code-block:: yaml

    acme.file_manager:
        parent: oro_gaufrette.file_manager
        arguments:
            - 'some_storage' # the name of Gaufrette filesystem should be used as the storage.

As a result, the **acme.file_manager** service will be the entry point of your new private file storage.

By default, if the Gaufrette local filesystem adapter is used to store files for a filesystem, the data will be saved to the
sub-directory with the name of the Gaufrette filesystem used for this file storage.

For the previous example, this default path is the ``var/data/some_storage`` directory of the application.

For the public filesystem, it is ``public/media/your_filesystem_name``.

You can change this sub-directory name by setting them as the second parameter of the file manager service declaration:

.. code-block:: yaml

    acme.file_manager:
        parent: oro_gaufrette.file_manager
        arguments:
            - 'some_storage' # the name of the Gaufrette filesystem should be used as the storage.
            - 'another_sub_directory' # data will save to another_sub_directory subdirectory.

.. _backend-simple-access-to-the-public-storage-files:

Simple Access to Public Storage Files
-------------------------------------

If the Gaufrette local filesystem adapter is used to store files for the public filesystem, all the files
stored in this filesystem will be available via direct URI ``http://your_domain/media/sub_directory/filename``.

But if the storage uses another adapter type, for example, the |GridFS| storage type
by :ref:`GridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>`, this URIs will not work
and you will have to implement access points to the files manually.

To simplify this case, configure the file manager service with the ``oro_gaufrette.public_filesystem_manager`` tag.
In this case, the files of such storage will be available via the ``http://your_domain/media/sub_directory/filename``
path, regardless of the adapter configuration used for the public type file storage.

For example, is you have configured ``my_public`` Gaufrette filesystem that uses the **public** adapter, the
configuration of the file manager service can be the following:

.. code-block:: yaml

    acme.public_file_manager:
        parent: oro_gaufrette.file_manager
        arguments:
            - 'my_public'
        tags:
            - { name: oro_gaufrette.public_filesystem_manager }

In this example, the files are available via the ``http://your_domain/media/my_public/filename`` URIs.

Access to Data via Stream Wrappers
----------------------------------

Files in the filesystem can be accessed via stream wrappers, as well as with the help of the |FileManager| service.

The application has two stream wrappers configured to be used with Gaufrette filesystems:

- Common wrapper by the |KnpGaufretteBundle|;
- Read-only wrapper by the :ref:`OroGaufretteBundle <bundle-docs-platform-gaufrette-bundle>`.

The common stream wrapper allows to get full access to the files stored in the filesystem. By default, the wrapper is configured
to use the ``gaufrette`` protocol. To get the full URL of a file use `getFilePath()` method of the |FileManager| service.

The read-only stream wrapper can be used if you need to read data but do not know if the data to be written is available.
For example, this case can be figured if the local adapter was used and the files were uploaded by someone other than the user that runs
the application. By default, the wrapper is configured to use the ``gaufrette-readonly`` protocol.
To get the full URL of a file use `getReadonlyFilePath()` method of the |FileManager| service.

Migrate Data Command
--------------------

During the upgrade from a local filesystem storage to another storage type or location, you need to migrate
data from the previous location. The command can also be used to upload some data to the file storage.

To migrate the data, you can use console command ``oro:gaufrette:migrate-filestorages``.

The command can work in 2 modes: Automatic and Manual.

In the **Automatic** mode, the data is migrated to the current structure by a predefined list of paths that have been used in the application
before v.4.2.

In the **Manual** mode, a user is asked for a path to be migrated, as well as the Gaufrette file system name
where the data should migrate to.

The command has a list of pre-configured default paths from which the data is moved in the automatic mode, and a list
of |FileManager| services where data can be uploaded to.

To add an additional path from which the data is going to be moved or to add an additional |FileManager|, add a new CompilerPass
in your bundle and add it into the Bundle class:

.. code-block:: php

    <?php
    namespace Acme\Bundle\SomeBundle\DependencyInjection\Compiler;
    use Oro\Bundle\GaufretteBundle\Command\MigrateFileStorageCommand;
    use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
    use Symfony\Component\DependencyInjection\ContainerBuilder;
    use Symfony\Component\DependencyInjection\Reference;
    /**
     * Adds file storage config to the oro:gaufrette:migrate-filestorages migration command.
     */
    class MigrateFileStorageCommandCompilerPass implements CompilerPassInterface
    {
        /**
         * {@inheritDoc}
         */
        public function process(ContainerBuilder $container): void
        {
            $container->getDefinition(MigrateFileStorageCommand::class)
                // adds the mapping to migrate path /path/to/application/var/some_path
                // to the filesystem with name 'some_filesystem'
                ->addMethodCall(
                    'addMapping',
                    ['/var/some_path', 'some_filesystem']
                )
                // adds the filemanager service as 'some_filesystem' filesystem
                ->addMethodCall(
                    'addFileManager',
                    ['some_filesystem', new Reference('acme_your_bundle.file_manager')]
                );
        }
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin

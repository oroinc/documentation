.. _bundle-docs-platform-gridfs-config-bundle:

OroGridFSConfigBundle
=====================

OroGridFSConfigBundle provides configuration enhancements for Oro applications to enable usage of
|GridFS| as the filesystem for the :ref:`File Storage <backend-file-storage>`.

The bundle enables developers to set MongoDB GridFS parameters in the application configuration YAML files 
which automatically enables and configures GridFS filesystem as storage as |Gaufrette| adapter.

.. _gridfs-config-bundle-install-orogridfsconfigbundle:

Install OroGridFSConfigBundle
-----------------------------

To install OroGridFSConfigBundle:

1. Make sure your php instance have |MongoDB PHP Library| installed.

2. Install MongoDB in any preferred way.

3. Require the package via composer.

   .. code-block:: bash

      composer require oro/gridfs-config

.. note::

    Enterprise Edition (EE) applications already have the package installed.

4. Configure bundle.

5. Clear cache.

.. note::

    Please take into account that old data that was uploaded to the local storage will not be migrated to GridFS storage.

.. _gridfs-config-bundle-gridfs-gaufrette-adapter-configuration:

GridFS Gaufrette Adapter Configuration
--------------------------------------

The bundle supports two ways to configure |Gaufrette| adapters:

1. The usual way that requires the configuration of |KnpGaufretteBundle|.

2. A simplified way where you can reconfigure already configured adapters to GridFS with the `config/parameters.yml` file.

.. _gridfs-config-bundle-adapters-configuration-with-knpgaufrettebundle:

Adapters Configuration with KnpGaufretteBundle
----------------------------------------------

To use the Oro GridFS Gaufrette adapter, use the ``oro_gridfs`` adapter type. To configure a new or reconfigure an
existing adapter, add the |KnpGaufretteBundle| configuration in the `Resources/config/oro/app.yml` in any bundle
or `config/config.yml` of your application:

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

.. _gridfs-config-bundle-adapters-configuration-with-parameters.yml:

Adapters Configuration with parameters.yml
------------------------------------------

To simplify the configuration of the already existing Gaufrette adapters or filesystems,
the `config/parameters.yml` file of your application can be used.

To reconfigure an adapter, add the parameter with the name ``gaufrette_adapter.[adapter_name]``,
where the ``adapter_name`` is the name of an existing adapter.
The value of the parameter is the MongoDB DSN string described in the previous chapter started with ``gridfs:``.

The following example shows the reconfiguration of the ``public`` adapter:

.. code-block:: yaml

   gaufrette_adapter.public: 'gridfs:mongodb://user:password@host:27017/media'

To get the list of existing Gaufrette adapters, use the following command:

.. code-block:: bash

   bin/console debug:config knp_gaufrette adapters

To reconfigure a filesystem, add the parameter with the name ``gaufrette_filesystem.[filesystem_name]``,
where the ``filesystem_name`` is the name of an existing filesystem.
As for the adapter configuration the value of the parameter is the MongoDB DSN string.

The following example shows the reconfiguration of the ``attachments`` filesystem:

.. code:: yaml

   gaufrette_filesystem.attachments: 'gridfs:mongodb://user:password@host:27017/attachments'

To get the list of existing Gaufrette filesystems, use the following command:

.. code:: bash

   bin/console debug:config knp_gaufrette filesystems

.. _gridfs-config-bundle-configuration-for-cluster-mongodb-gridfs-setup:

Configuration for Cluster MongoDB GridFS Setup
----------------------------------------------

If you have installed MongoDB cluster, it can be used as the GridFS storage as well.

In this case, the dsn configuratoin string has the following format:
`[protocol]://[user]:[password]@[host1]:[port],[host2]:[port]/[database]`

Example:

.. code-block:: yaml

   gaufrette_adapter.public: 'mongodb://user:password@host1:27017,host2:27017/media'

.. _gridfs-config-bundle-related-links:

Related Links
-------------

* |GridFS|
* |MongoDB PHP Library|
* |KnpGaufretteBundle|

.. include:: /include/include-links-dev.rst
   :start-after: begin

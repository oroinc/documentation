:oro_show_local_toc: false

.. _bundle-docs-platform-gridfs-config-bundle:

OroGridFSConfigBundle
=====================

OroGridFsConfigBundle provides configuration enhancements for Oro applications to enable usage of
|GridFS| as the filesystem.

The bundle enables developers to set MongoDB GridFS parameters in the application configuration YAML files 
which automatically enables and configures GridFS filesystem as storage for Gaufrette storages.

Install OroGridFsConfigBundle
-----------------------------

To install OroGridFsConfigBundle:

1. Install mongodb in any preferred way.

2. Require the package via composer.

   .. code-block:: bash

      composer require oro/gridfs-config

GridFS Gaufrette Adapter Configuration
--------------------------------------

The bundle supports two ways to configure gaufrette adapers:

1. The usual way that requires the configuration of KnpGaufretteBundle.
2. A simplified way where you can reconfigure the already configured adapter to GridFS with the parameters.yml file.

Adapters Configuration With KnpGaufretteBundle
----------------------------------------------

To use the Oro GridFS gaufrette adapter, use the ``oro_gridfs`` adapter type. To configure a new or reconfigure the
existing adapter, add the configuration in the app.yml file of a bundle or in the common config.yml file that will add
configuration to the |KnpGaufretteBundle| configuration:

.. code-block:: yaml

    knp_gaufrette:
        adapters:
            attachments: #the adapter name
                oro_gridfs:
                    mongodb_gridfs_dsn: 'mongodb://127.0.0.1:27017/attachment'

As you can see from the example, the configuration of ``oro_gridfs`` adapter has the ``mongodb_gridfs_dsn`` parameter with the
configuration of Mongo db dsn string. The format of this string the following:
`[protocol]://[username]:[password]@[host]:[port]/[database]`, where:

- **protocol** is mongodb
- **username** username that has an access to the MongoDB database
- **password** is the user's password
- **host** is the hostname or IP address of the MongoDB server
- **database** is the MongoDB database name should be used as GridGS storage

Adapters Configuration With Parameters.yml
------------------------------------------

To simplify the configuration of the already existing Gaugrette adapters, the ``parameters.yml`` file can be used.

To reconfigure an adapter, add the parameter with the name `mongodb_gridfs_dsn_[adapter_name]`, where ``adapter_name`` is the
name of an existing adapter and the Mongo db dsn string is the value of the parameter:

The following example shows the reconfiguration of the attachment adapter:

.. code-block:: yaml

   mongodb_gridfs_dsn_attachment: 'mongodb://user:password@host:27017/attachment'

To get the list of configured Gaufrette adapters, use the `debug:config` command:

.. code-block:: bash

   bin/console debug:config knp_gaufrette adapters

Configuration For Cluster Mongodb Gridfs Setup
----------------------------------------------

If you have installed MongoDB cluster, it can be used as the GridFS frorage as well.

In this case, the dsn configuratoin string has the following format:
`[protocol]://[user]:[password]@[host1]:[port],[host2]:[port]/[database]`

Example:

.. code-block:: yaml

   mongodb_gridfs_dsn_attachment: 'mongodb://user:password@host1:27017,host2:27017/attachment'

Related links
-------------

* |GridFS|
* |MongoDB PHP Library|
* |KnpGaufretteBundle|

.. include:: /include/include-links-dev.rst
   :start-after: begin

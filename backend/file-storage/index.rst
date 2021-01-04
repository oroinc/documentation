.. _backend-file-storage:

File Storage
============

This section describes the filesystem abstraction layer used in the Oro application to access data files.

The file storage abstraction is based on |KnpGaufretteBundle| with :ref:`GaufretteBundle <bundle-docs-platform-gaufrette-bundle>`
that enables a filesystem abstraction layer in the Oro applications and provides a simplified file manager service for media files.

File storage can be configured to use different types of filesystem adapters to store the data,
for example, your local filesystem, GridFS storage, etc.

.. _backend-file-storage-types-of-storage:

Types of Storage
----------------

By default, the file storage component provides two types of storage with Gaufrette adapters:

- private
- public

The **private** file storage adapter is implemented to store data that should not be available via a direct link.
Examples of such data types are attachments' data, import and export files, protected media cache files, etc.
If the local filesystem adapter is used by default, then data will be stored in the ``/var/data`` directory of the application.

The **public** file storage adapter is implemented to store data that can be available via a direct link without access checks.
Examples of such data are resized product images, sitemap files, etc. If the local filesystem adapter is used by default,
data will be stored in the ``public/media`` directory of the application.

.. _backend-access-the-data-in-storage:

Access to Data in Storage
-------------------------

The main access point to the files in storage is the |FileManager| class.

Each type of storage can store different types of data.
For example, private storage stores the attachment data and import/export data files.

To implement the access point to your type of data in the storage:

- Add new Gaufrette filesystem configuration into the ``Resources/config/oro/app.yml`` file of your bundle and set ``private`` or ``public`` as the filesystem adapter:

.. code-block:: yaml

    knp_gaufrette:
        filesystems:
            some_storage:
                adapter: private # the type of storage (public or private)
                alias: some_storage_filesystem

- Register the |FileManager| service as the child of the ``oro_gaufrette.file_manager`` service:

.. code-block:: yaml
   :linenos:

    acme.file_manager:
        parent: oro_gaufrette.file_manager
        arguments:
            - 'some_storage' # the name of Gaufrette filesystem should be used as the storage.

As a result, the **acme.file_manager** service will be the entry point of your new private file storage.

By default, if the Gaufrette local filesystem adapter is used to store files for a file system, the data will be saved to the
sub-directory with the name of the Gaufrette filesystem used for this file storage.

For the previous example, this default path is the ``var/data/some_storage`` directory of the application.

For the public file system, it is ``public/media/your_filesystem_name``.

You can change this sub-directory name by setting them as the second parameter of the file manager service declaration:

.. code-block:: yaml
   :linenos:

    acme.file_manager:
        parent: oro_gaufrette.file_manager
        arguments:
            - 'some_storage' # the name of the Gaufrette filesystem should be used as the storage.
            - 'another_sub_directory' # data will save to another_sub_directory subdirectory.

.. _backend-simple-access-to-the-public-storage-files:

Simple Access to Public Storage Files
-------------------------------------

If the Gaufrette local filesystem adapter is used to store files for the public file system, all the files
stored in this file system will be available via direct URI ``http://your_domain/media/sub_directory/filename``.

But if the storage uses another adapter type, for example, the |GridFS| storage type
by :ref:`GridFSConfigBundle <bundle-docs-platform-gridfs-config-bundle>`, this URIs will not work
and you will have to implement access points to the files manually.

To simplify this case, configure the file manager service with the ``oro_gaufrette.public_filesystem_manager`` tag.
In this case, the files of such storage will be available via the ``http://your_domain/media/sub_directory/filename`` path,
regardless of the adapter configuration used for the public type file storage.

For example, is you have configured ``my_public`` Gaufrette filesystem that uses the ``public`` adapter, the configuration of the
file manager service can be the following:

.. code-block:: yaml
   :linenos:

    acme.public_file_manager:
        parent: oro_gaufrette.file_manager
        arguments:
            - 'my_public'
        tags:
            - { name: oro_gaufrette.public_filesystem_manager }

In this example, the files are available via the ``http://your_domain/media/my_public/filename`` URIs.

.. toctree::
   :titlesonly:

   adapters-configuration

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _dev-guide-system-file-storage:

File Storage
============

Every Oro application has a **filesystem abstraction layer** which allows developers to manage files in a storage (store,
retrieve, rename, etc.) and change the storage quickly. You neither need to know where the files are physically located, nor refactor any application code to change the storage.

For instance, if you store media files locally in your application at initial stages of development but you know that you will move
the file storage to Amazon S3 in the next development iteration, you can continue to work safely on the
application code and change the file storage adapter using the application configuration when you are finally ready to change
the storage physically.

Alternatively, you can split the file storage in your Oro application depending on the file types. Small images can be stored in your local filesystem while large media library files can be moved to a CDN cloud service or Amazon S3. In
Oro applications, you can declare and use different file managers to achieve this.

How It Works
------------

The *filesystem abstraction layer* in Oro applications is implemented in `OroGaufretteBundle`_ which is based on the
`KnpGaufretteBundle`_ and `Gaufrette`_ library.

These components define the architecture that consists of three entities:

1. `Adapter <https://github.com/KnpLabs/Gaufrette/blob/master/src/Gaufrette/Adapter.php>`_ that encapsulates a unique file manipulation API of each particular file storage.

2. `Filesystem <https://github.com/KnpLabs/Gaufrette/blob/master/src/Gaufrette/Filesystem.php>`_ object that provides a unified set of file management actions and should be created for every particular class that implements the **Adapter** interface.

3. `File Manager <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/GaufretteBundle/FileManager.php>`_ that uses yjr  **filesystem** and contains an extensive collection of the file management actions for developers.

Setup and Configuration
-----------------------

To set up and configure the *filesystem abstraction layer* in Oro applications:

1. In the application configuration, configure all existing **file storage adapters** that you are going to use in your custom application.
2. in the application configuration, configure **filesystems** for these adapters.
3. Declare the **file manager** service for every filesystem.

1. Configure File Storage Adapters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please see the `Configuring the Adapters`_ section of **KnpGaufretteBundle** documentation.

2. Configure FileSystems
^^^^^^^^^^^^^^^^^^^^^^^^

See the `Configuring the Filesystems`_ section of **KnpGaufretteBundle** documentation.

3. Configure File Managers
^^^^^^^^^^^^^^^^^^^^^^^^^^

To declare the manager service for your file system use **oro_gaufrette.file_manager** abstract service. E.g.:

.. code-block:: yaml
   :linenos:

   oro_acme.file_manager:
        public: false
        parent: oro_gaufrette.file_manager
        arguments:
            - 'acme' # The declared file system name

Getting Started
---------------

For example, let us consider the case when you periodically need to store large CSV files with important business
reports on your FTP server.

To store and retrieve the files, create a file manager for FTP storage in three steps:

1. Configure FTP file storage adapter.

   .. code-block:: yaml
       :linenos:

        # config/config.yml
        knp_gaufrette:
            adapters:
                acme_ftp_server:
                    ftp:
                        host: example.com
                        username: user
                        password: pass
                        directory: /example/ftp
                        create: true
                        mode: FTP_BINARY

2. Declare a filesystem for FTP file storage.

   .. code-block:: yaml
       :linenos:

        # config/config.yml
        knp_gaufrette:
            adapters:
                acme_ftp_server:
                    ftp:
                        # ...
            filesystems:
                acme_ftp:
                    adapter:    acme_ftp_server
                    alias:      ftp_filesystem

3. Create a file manager service for FTP file storage.

   .. code-block:: yaml
       :linenos:

       acme.ftp.file_manager:
           public: false
           parent: oro_gaufrette.file_manager
           arguments:
               - acme_ftp # The file system name

You can then use any methods of the `\\Oro\\Bundle\\GaufretteBundle\\FileManager <https://github.com/oroinc/platform/blob/master/src/Oro/Bundle/GaufretteBundle/FileManager.php>`_
class to manage your files on the FTP server, e.g:

.. code-block:: php
   :linenos:

    <?php
    $fileManager = $this->get('acme.ftp.file_manager');
    $content = 'Test data';
    $fileName = 'test2.txt';
    $fileManager->writeToStorage($content, $fileName);

Further Reading
---------------

* `Implementing New File Storage Adapter <https://knplabs.github.io/Gaufrette/implementing-new-adapter.html>`_
* `List of Implemented File Storage Adapters <https://github.com/KnpLabs/KnpGaufretteBundle#configuring-the-adapters>`_

.. _`OroGaufretteBundle`: https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/GaufretteBundle
.. _`KnpGaufretteBundle`: https://github.com/KnpLabs/KnpGaufretteBundle
.. _`Gaufrette`: https://github.com/KnpLabs/Gaufrette
.. _`Configuring the Adapters`: https://github.com/KnpLabs/KnpGaufretteBundle#configuring-the-adapters
.. _`Configuring the Filesystems`: https://github.com/KnpLabs/KnpGaufretteBundle#configuring-the-filesystems

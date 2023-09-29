:title: Oro Application Installation

.. _installation:
.. _install-for-dev:

Installation
============

The topic provides the details on how to install Oro applications via the command-line interface provided that the necessary environment is already installed.

.. note:: For environment installation guidelines, see :ref:`Development Environment <doc--dev-env-best-practices>`.

.. _installation--orocommerce-ce--part-3:

Get Application Source Code
---------------------------

There are eight base applications to choose from.

Create your new Oro application project with the composer by running one of the commands below, depending on the base application you want to install:

.. code-block:: none

   # OroCommerce Community Edition
   composer create-project oro/commerce-crm-application my_project_name 5.1.0 -n
   # OroCommerce Enterprise Edition
   composer create-project oro/commerce-crm-enterprise-application my_project_name 5.1.0 --repository=https://satis.oroinc.com -n
   # OroCommerce Platform Application
   composer create-project oro/orocommerce-platform-application my_project_name 5.1.0 --repository=https://satis.oroinc.com -n
   # OroCRM Community Edition
   composer create-project oro/crm-application my_project_name 5.1.0 -n
   # OroCRM Enterprise Edition
   composer create-project oro/crm-enterprise-application my_project_name 5.1.0 --repository=https://satis.oroinc.com -n
   # OroPlatform Community Edition
   composer create-project oro/platform-application my_project_name 5.1.0 -n
   # OroCommerce Community Edition for Germany
   composer create-project oro/commerce-crm-application-de oroapp my_project_name 5.1.0 -n
   # OroCommerce Enterprise Edition for Germany
   composer create-project oro/commerce-crm-enterprise-application-de my_project_name 5.1.0 --repository=https://satis.oroinc.com -n
   # OroCommerce Enterprise Edition (without CRM)
   composer create-project oro/commerce-enterprise-application my_project_name 5.1.0 --repository=https://satis.oroinc.com -n

* Replace the ``5.1.0`` with the version to download.

* This command creates a new directory called `my_project_name/` that contains an empty project. An absolute path to the directory will be used in the following steps and will be referred to as **<application-root-folder>** further in this topic.

.. note::
        Alternatively, you can download and unpack the archive with the application source code or use git instead of the composer. Please, refer to the dedicated article :ref:`Get the Oro Application Source Code <installation--get-files>` for more details.

Configure WebSocket Parameters
------------------------------

If you use HTTP mode for your Oro application website, keep the default values for the WebSocket-related parameters.

If you use HTTPS mode, set the WebSocket-related environment variables to match the following values:

.. code-block:: none

   ORO_WEBSOCKET_SERVER_DSN=//0.0.0.0:8080
   ORO_WEBSOCKET_FRONTEND_DSN=//*:443/ws
   ORO_WEBSOCKET_BACKEND_DSN=tcp://127.0.0.1:8080

For more information on these parameters, see |OroSyncBundle documentation|.

Configure File Storages
-----------------------

By default, an application will be installed with local file systems as :ref:`File Storages <backend-file-storage>` with predefined system paths.

To change this configuration, please follow the :ref:`Adapters Configuration <backend-file-storage--adapters-configuration>` to learn how you can change this configuration.

Configure Application For Media Storage as a Sub-Folder
-------------------------------------------------------

The application's default `public/media` folder can have many files.

To make better use of the disk space, you can move files to an external storage or use another volume or directory as file storage. See :ref:`File Storages <backend-file-storage>` and :ref:`Adapters Configuration <backend-file-storage--adapters-configuration>` topics to learn how to switch to the external storage.

If the customizer decides to use another volume or directory as file storage, they can do it in two ways:

- with a symlink
- by binding one directory path (the folder outside your web root) to another

If you use a symlink, add an additional configuration of the `data_root` parameter of the LiipImagine bundle. For example, if you want files to be located in the `/home/public/media` directory, add the following configuration:

.. code-block:: yaml

    liip_imagine:
        loaders:
            default:
                filesystem:
                    data_root: "/home/public"

You can find more info about the `data_root` parameter configuration in |LiipImagineBundle Data Roots Parameter| documentation.


Install Oro Application
-----------------------

To start the installation of your Oro application, run the following command:

.. code-block:: none

   php bin/console oro:install --env=prod --timeout=2000

Follow the on-screen instructions in the console.

.. note:: You will be prompted to choose the installation with or without demo data. If you discard demo data during installation, you can install it later by running the following command:

   .. code-block:: none

      php bin/console oro:migration:data:load --fixtures-type=demo --env=prod

Set Up File Permissions
-----------------------

Below application directories must be writable both by the web server and the command line user:

* var/sessions
* var/cache
* var/data
* var/logs
* public/media
* public/js

If your operating system supports the ``setfacl`` utility, use the following script to determine your web server user and grant the needed permissions:

.. code-block:: none

   HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)

   sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var/{sessions,cache,data,logs}
   sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var/{sessions,cache,data,logs}

   sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX public/{media,js}
   sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX public/{media,js}

.. note:: The first setfacl command sets permissions for future files and folders, while the second sets permissions for the existing files and folders. Both commands assign permissions for the system user and the Apache user. Be aware that ``setfacl`` is not available on NFS mount points. However, storing cache and logs over NFS is strongly discouraged for performance reasons.

Schedule Periodical Command Execution
-------------------------------------

To schedule the execution of the *oro:cron* command every minute, add the following line to the crontab file:

.. code-block:: none

   */1 * * * * php <application-root-folder>/bin/console oro:cron --env=prod > /dev/null

Replace **<application-root-folder>** with an absolute path to the installed Oro application.

Configure and Run Required Background Processes
-----------------------------------------------

The required background processes are the following:

* **message queue consumer** --- Performs resource-consuming tasks in the background.
* **web socket server** --- Manages real-time messages between the application server and the user's browser.

It is crucial to keep these two background processes running. To maintain their constant availability, using |Supervisord| or another supervising tool is recommended.

To configure Supervisord, use your root privileges.

Configure the Supervisor
~~~~~~~~~~~~~~~~~~~~~~~~

Add the following configuration sections to the */etc/supervisord.conf* config file:

.. code-block:: none

   [program:oro_web_socket]
   command=php ./bin/console gos:websocket:server --env=prod
   numprocs=1
   autostart=true
   autorestart=true
   directory=<application-root-folder>
   user=<web-server-user>
   redirect_stderr=true

   [program:oro_message_consumer]
   command=php ./bin/console oro:message-queue:consume --env=prod
   process_name=%(program_name)s_%(process_num)02d
   numprocs=5
   autostart=true
   autorestart=true
   directory=<application-root-folder>
   user=<web-server-user>
   redirect_stderr=true

* replace **<application-root-folder>** with the absolute path where you are going to install the Oro application
* replace **<web-server-user>** with a user used by the web server (ex. nginx or www-data).

.. begin_common_ce_part_6

Restart Supervisord
^^^^^^^^^^^^^^^^^^^

To restart the supervisor, run:

.. code-block:: none

   systemctl restart supervisord

Check the Status of the Background Processes (Optional)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To check the status of the background processes, run:

.. code-block:: none

   supervisorctl status

You should see information similar to what is illustrated below:

.. code-block:: none

   oro_message_consumer:oro_message_consumer_00   RUNNING   pid 4847, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_01   RUNNING   pid 4846, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_02   RUNNING   pid 4845, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_03   RUNNING   pid 4844, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_04   RUNNING   pid 4843, uptime 0:05:36
   oro_web_socket                                 RUNNING   pid 5163, uptime 0:00:05

Configure OAuth Bundle
~~~~~~~~~~~~~~~~~~~~~~

If you use an OAuth Bundle to authenticate with OAuth2 protocol to API resources, please follow the :ref:`OroOAuth2ServerBundle documentation <bundle-docs-platform-oauth2-server-bundle--configuration>` to learn how to configure the bundle and generate the encryption, private, and public keys.

Congratulations! You've Successfully Installed Your Oro Application
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You should now be able to open the homepage *http(s)://<your-domain-name>/* and use the application.


.. admonition:: Business Tip

    Do you wish to take advantage of the new digital commerce trend? Explore our |B2B marketplace| guide.


What's Next
-----------

Optimization, Scalability, and Configuration Recommendations
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

If you need to customize the described installation scenario, refer to the following topics:

* :ref:`Get the Oro Application Source Code <installation--get-files>`
* :ref:`Customizing the Installation Process <customize-install>`
* :ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>`
* :ref:`Web Server Configuration <installation--web-server-configuration>`
* :ref:`Performance Optimization of the Oro Application Environment <installation--optimize-runtime-performance>`
* :ref:`Silent Installation <silent-installation>`

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin

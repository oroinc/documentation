:title: OroCommerce, OroCRM, OroPlatform Installation

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

Create your new Oro application project with composer by running one of commands below, depending on the base application you want to install:

.. code-block:: bash

   # OroCommerce Community Edition
   composer create-project oro/commerce-crm-application my_project_name --repository=https://satis.oroinc.com
   # OroCommerce Enterprise Edition
   composer create-project oro/commerce-crm-enterprise-application my_project_name --repository=https://satis.oroinc.com
   # OroCRM Community Edition
   composer create-project oro/commerce-crm-application my_project_name --repository=https://satis.oroinc.com
   # OroCRM Enterprise Edition
   composer create-project oro/crm-enterprise-application my_project_name --repository=https://satis.oroinc.com
   # OroPlatform Community Edition
   composer create-project oro/platform-application my_project_name --repository=https://satis.oroinc.com
   # OroCommerce Community Edition for Germany
   composer create-project oro/commerce-crm-application-de my_project_name --repository=https://satis.oroinc.com
   # OroCommerce Enterprise Edition for Germany
   composer create-project oro/commerce-crm-enterprise-application-de my_project_name --repository=https://satis.oroinc.com
   # OroCommerce Enterprise Edition (without CRM)
   composer create-project oro/commerce-enterprise-application my_project_name --repository=https://satis.oroinc.com



This command creates a new directory called `my_project_name/` that contains an empty project of the most recent stable version.
An absolute path to the directory will be used in the following steps and will be referred to as **<application-root-folder>** further in this topic.



.. note::
        Alternatively, you can download and unpack the archive with the application source code or use git instead of using composer. Please, refer to the dedicated article :ref:`Get the Oro Application Source Code <installation--get-files>` for more details.

Note that you are prompted to enter the infrastructure-related application parameters (database name, user, etc.) that
are saved into the ``config/parameters.yml`` file. You can find the description for every parameter in the
:ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>` article.

Configure WebSocket Parameters
------------------------------

If you use HTTP mode for your Oro application website, keep the default values for the WebSocket-related parameters in the ``config/parameters.yml`` file.

If you use HTTPS mode, open the ``config/parameters.yml`` file and change the WebSocket-related parameters to match the following values:

.. code-block:: none

   websocket_bind_address:  0.0.0.0
   websocket_bind_port:     8080
   websocket_frontend_host: "*"
   websocket_frontend_port: 443
   websocket_frontend_path: "ws"
   websocket_backend_host:  "*"
   websocket_backend_port:  8080
   websocket_backend_path:  ""

For more information on these parameters, see |OroSyncBundle documentation|.

Install Oro Application
-----------------------

To start the installation of your Oro application, run the following command:

.. code-block:: bash

   php bin/console oro:install --env=prod --timeout=2000

Follow the on-screen instructions in the console.

.. note:: You will be prompted to choose the installation with or without demo data. If you discard demo data during installation,
   you can install it later by running the following command:

   .. code-block:: bash

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

If your operation system supports ``setfacl`` utility, use the following script to determine your web server user and grant the needed permissions:

.. code-block:: bash

   HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)

   sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var/{sessions,cache,data,logs}
   sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var/{sessions,cache,data,logs}

   sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX public/{media,js}
   sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX public/{media,js}

.. note:: The first setfacl command sets permissions for future files and folders, while the second one sets permissions on the existing files and folders. Both of these commands assign permissions for the system user and the Apache user.
   ``setfacl`` isn't available on NFS mount points. However, storing cache and logs over NFS is strongly discouraged for performance reasons.

Schedule Periodical Command Execution
-------------------------------------

To schedule execution of the *oro:cron* command every-minute, add the following line to crontab file:

.. code-block:: none

   */1 * * * * php <application-root-folder>/bin/console oro:cron --env=prod > /dev/null

Replace **<application-root-folder>** with an absolute path to the installed Oro application.

Configure and Run Required Background Processes
-----------------------------------------------

The required background processes are the following:

* **message queue consumer** --- Performs resource-consuming tasks in the background.
* **web socket server** --- Manages real-time messages between the application server and user's browser.

It is crucial to keep these two background processes running. To maintain their constant availability, it is recommended to use |Supervisord| or another supervising tool.

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

To restart supervisor, run:

.. code-block:: bash

   systemctl restart supervisord

Check the Status of the Background Processes (Optional)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To check the status of the background processes, run:

.. code-block:: bash

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

If you use an OAuth Bundle to authenticate with OAuth2 protocol to API resources, please follow
the :ref:`OroOAuth2ServerBundle documentation <bundle-docs-platform-oauth2-server-bundle--configuration>`
to lean how to configure the bundle, generate the encryption key and private and public keys.

Congratulations! You've Successfully Installed Your Oro Application
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You should now be able to open the homepage *http(s)://<your-domain-name>/* and use the application.

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


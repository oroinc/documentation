:orphan:

.. Reused in quick start for developers. Not in the toctree and should remain so.

Step 3: |oro_app_name| Application Installation (Part 2)
--------------------------------------------------------

.. begin_body

.. note:: See detailed guidance on how to :ref:`Get the Oro application Source Code <platform--installation--source-files>` to install custom versions or the code from custom repositories.

Install Oro Application Dependencies
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Run the Composer Install
~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   scl enable oro-php71 bash
   composer install --prefer-dist
   exit

The `composer install` downloads the latest version of the external packages into the |oro_app_name| application `vendors` directory to prepare for |oro_app_name| installation.

Note that you are prompted to enter the installation environment configuration and
integration parameters (database name, user, etc.) that are saved into the *config/parameters.yml* file.

.. warning:: Ensure you provide the configuration values specific for your environment. If you do not set these parameters during the `composer install` execution, you still can modify the *config/parameters.yml* file after the dependencies installation is complete. Any changes should precede the `Install Oro application`_ step described further.

Configure Application Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the options listed below, update the *config/parameters.yml* file with recommended values.

Database Parameters
~~~~~~~~~~~~~~~~~~~

.. code::

   database_driver: pdo_pgsql
   database_name: oro
   database_user: postgres
   database_password: <new_postgres_user_password>

Replace <new_postgres_user_password> with the *postgres* user password set during the previous steps.

WebSockets Parameters
~~~~~~~~~~~~~~~~~~~~~

If you use HTTP for |oro_app_name| website, keep the default values for the WebSocket-related parameters in the *config/parameters.yml* file.

If you use HTTPS, open the *config/parameters.yml* file and change the WebSocket-related parameters to match the following values:

.. code::

   websocket_bind_address:  0.0.0.0
   websocket_bind_port:     8080
   websocket_frontend_host: "*"
   websocket_frontend_port: 443
   websocket_frontend_path: "ws"
   websocket_backend_host:  "*"
   websocket_backend_port:  8080
   websocket_backend_path:  ""

For more information on these parameters, see `OroSyncBundle documentation <https://github.com/oroinc/platform/tree/master/src/Oro/Bundle/SyncBundle>`_.

ElasticSearch Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable ElasticSearch as the search engine, update `search_engine_name`:

.. code::

   search_engine_name: elastic_search

Redis Cache Storage Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable Redis cache storage configuration, ensure the following lines are added to the *config/parameters.yml* file:

.. code::

   session_handler: 'snc_redis.session.handler'
   redis_dsn_session:  'redis://127.0.0.1:6379/0'
   redis_dsn_cache:    'redis://127.0.0.1:6379/1'
   redis_dsn_doctrine: 'redis://127.0.0.1:6379/2'
   redis_setup: 'standalone'

.. warning:: The *redis_dsn_session*, *redis_dsn_cache*, *redis_dsn_doctrine*, *redis_setup* parameters are mot included into the *config/parameters.yml* by default.

.. note::

   To improve application performance, you can configure two Redis instances to store separately the sessions and the
   doctrine application cache as described in the `OroRedisConfigBundle documentation <https://github.com/oroinc/redis-config>`_.

Enterprise Application Licence
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To enable the enterprise capabilities of your |oro_app_name|, provide the `License Key` as the *enterprise_license* value:

.. code::

   enterprise_licence: <your_licence_key_here>

RabbitMQ Configuration
~~~~~~~~~~~~~~~~~~~~~~

.. code::

   message_queue_transport: amqp
   message_queue_transport_config: { host: 'localhost', port: '5672', user: '<new_rabbitmq_user>', password: '<new_rabbitmq_user_password>', vhost: '/' }

Replace *<new_rabbitmq_user>* and *<new_rabbitmq_user_password>* with the username and password that your have set for RabbitMQ in previous steps.

Install Oro Application
^^^^^^^^^^^^^^^^^^^^^^^

To start the |oro_app_name| installation, run the following command:

.. code:: bash

   scl enable oro-php71 bash
   php ./bin/console oro:install --env=prod --timeout=900
   exit

Follow the on-screen instructions in the console.

.. note::

    Alternatively, use the web installer as described in the `Installation via UI`_ topic. Before you launch the installation
    via UI, make the application files and folders writable for the *nginx*
    user. When the installation is complete, revert the file permission to restore the original ones.

You will be prompted to choose the installation with- or without- demo data. If you discard demo data during installation,
you can install it later by running the following command:

.. code:: bash

   scl enable oro-php71 bash
   sudo -u nginx php ./bin/console oro:migration:data:load --fixtures-type=demo --env=prod
   exit

**For developers only**: To customize the installation process and modify the database structure and/or data that are loaded in the OroCommerce after installation, you can:

* :ref:`Execute custom migrations <execute-custom-migrations>`, and

* :ref:`Load custom data fixtures <load-custom-data-fixtures>`

Add Required Permissions for the *nginx* User
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As *nginx* user should be able to create folders, run the following commands to set necessary files and folders permissions:

.. code:: bash

   setfacl -b -R ./
   find . -type f -exec chmod 0644 {} \;
   find . -type d -exec chmod 0755 {} \;
   chown -R nginx:nginx ./var/{sessions,attachment,cache,import_export,logs}
   chown -R nginx:nginx ./public/{media,uploads,js}

Step 4: Post-installation Environment Configuration
---------------------------------------------------

Schedule Periodical Command Execution
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Open the crontab file in *vi* editor on behalf of the *nginx* user:

.. code:: bash

   sudo -u nginx crontab -e

To schedule execution of the *oro:cron* command every-minute, add the following line:

.. code:: bash

   */1 * * * * scl enable oro-php71 'php /usr/share/nginx/html/oroapp/bin/console oro:cron --env=prod > /dev/null'

Save the updated file.

Configure and Run Required Background Processes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-2.rst
   :start-after: begin_common_ce_part_5
   :end-before: finish_common_ce_part_5

.. code::

   [program:oro_web_socket]
   command=scl enable oro-php71 'php ./bin/console clank:server --env=prod'
   numprocs=1
   autostart=true
   autorestart=true
   directory=/usr/share/nginx/html/oroapp
   user=nginx
   redirect_stderr=true

   [program:oro_message_consumer]
   command=scl enable oro-php71 'php ./bin/console oro:message-queue:consume --env=prod'
   process_name=%(program_name)s_%(process_num)02d
   numprocs=5
   autostart=true
   autorestart=true
   directory=/usr/share/nginx/html/oroapp
   user=nginx
   redirect_stderr=true

.. include:: /install_upgrade/installation_quick_start_dev/common-ce-2.rst
   :start-after: begin_common_ce_part_6
   :end-before: finish_common_ce_part_6

.. finish_body

.. |oro_app_name| replace:: Oro application

.. _Installation via UI: https://oroinc.com/b2b-ecommerce/doc/current/install-upgrade/installation/installation-via-UI

* :ref:`User Guide: Getting Started <user-guide--getting-started>`
* :ref:`User Guide: Commerce <user-guide>`
* :ref:`User Guide: Marketing <user-guide-marketing>`
* :ref:`User Guide: Business Intelligence <user-guide--business-intelligence>`
* :ref:`Storefront Guide <frontstore-guide>`
* :ref:`Developer Guide <dev-guide>`
* :ref:`Administration Guide <configuration--guide--landing--page>`

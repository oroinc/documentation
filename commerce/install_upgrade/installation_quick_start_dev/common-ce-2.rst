:orphan:

.. Reused in quick start for developers. Not in the toctree and should remain so.

Step 3: |oro_app_name| Application Installation (Part 2)
--------------------------------------------------------

.. begin_body

Install Oro Application Dependencies
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Run the Composer Install
~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   composer install --prefer-dist

The `composer install` downloads the latest version of the external packages into the |oro_app_name| application `vendors` directory to prepare for |oro_app_name| installation.

Note that you are prompted to enter the installation environment configuration and
integration parameters (database name, user, etc.) that are saved into the *app/config/parameters.yml* file.

.. warning:: Ensure you provide the configuration values specific for your environment.

Configure WebSocket Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you use HTTP for |oro_app_name| website, keep the default values for the WebSocket-related parameters in the *app/config/parameters.yml* file.

If you use HTTPS, open the *app/config/parameters.yml* file and change the WebSocket-related parameters to match the following values:

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

Install Oro Application
^^^^^^^^^^^^^^^^^^^^^^^

To start the |oro_app_name| installation, run the following command:

.. code:: bash

   php ./app/console oro:install --env=prod --timeout=900

Follow the on-screen instructions in the console.

Alternatively, use the web installer as described in the `Installation via UI`_ topic.

Before you launch the installation via UI, make the application files and folders writable for the *nginx*
user. When the installation is complete, revert the file permission to restore the original ones.

To install the application with demo data, use the `--sample-data` option. To add demo data on to of the installed application, run the following command:

.. code:: bash

   sudo -u nginx php ./app/console oro:migration:data:load --fixtures-type=demo --env=prod

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
   chown -R nginx:nginx ./app/{attachment,cache,import_export,logs}
   chown -R nginx:nginx ./web/{media,uploads,js}

Step 4: Post-installation Environment Configuration
---------------------------------------------------

Schedule Periodical Command Execution
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Open the crontab file in *vi* editor on behalf of the *nginx* user:

.. code:: bash

   sudo -u nginx crontab -e

To schedule execution of the *oro:cron* command every-minute, add the following line:

.. code::

   */1 * * * * php /usr/share/nginx/html/oroapp/app/console oro:cron --env=prod > /dev/null

Save the updated file.

Configure and Run Required Background Processes
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_common_ce_part_5

The required background processes are the following:

* **message queue consumer** --- Performs resource-consuming tasks in the background.
* **web socket server** --- Manages real-time messages between the application server and user's browser.

It is crucial to keep these two background processes running. To maintain their constant availability, it is recommended to use `Supervisord <http://supervisord.org/>`_ or another supervising tool.

To configure Supervisord, use your root privileges.

Configure the supervisor
~~~~~~~~~~~~~~~~~~~~~~~~

Add the following configuration sections to the */etc/supervisord.conf* Supervisord config file:

.. code::

   [program:oro_web_socket]
   command=php ./app/console clank:server --env=prod
   numprocs=1
   autostart=true
   autorestart=true
   directory=/usr/share/nginx/html/oroapp
   user=nginx
   redirect_stderr=true

   [program:oro_message_consumer]
   command=php ./app/console oro:message-queue:consume --env=prod
   process_name=%(program_name)s_%(process_num)02d
   numprocs=5
   autostart=true
   autorestart=true
   directory=/usr/share/nginx/html/oroapp
   user=nginx
   redirect_stderr=true

Restart Supervisord
~~~~~~~~~~~~~~~~~~~

To restart supervisor, run:

.. code:: bash

   systemctl restart supervisord

Check the Status of the Background Processes (Optional)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To check the status of the background processes, run:

.. code:: bash

   supervisorctl status

You should see information similar to the following one:

.. code::

   oro_message_consumer:oro_message_consumer_00   RUNNING   pid 4847, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_01   RUNNING   pid 4846, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_02   RUNNING   pid 4845, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_03   RUNNING   pid 4844, uptime 0:05:36
   oro_message_consumer:oro_message_consumer_04   RUNNING   pid 4843, uptime 0:05:36
   oro_web_socket                                 RUNNING   pid 5163, uptime 0:00:05

Congratulations! You've Successfully Installed |oro_app_name| Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You should now be able to open the homepage *http(s)://<your_domain_name>/* and use the application.

What's Next
-----------

To become familiar with |oro_app_name| functional as user or developer, please, read the following guides:

.. finish_common_ce_part_5

.. finish_body

.. |oro_app_name| replace:: Oro application

.. _Installation via UI: https://oroinc.com/b2b-ecommerce/doc/current/install-upgrade/installation/installation-via-UI

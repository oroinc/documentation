:orphan:

.. Reused in quick start for developers. Not in the toctree and should remain so.

Step 3: |oro_app_name| Application Installation (Part 2)
--------------------------------------------------------

.. begin_body

.. note::

    Alternatively, you can download and unpack the archive with |oro_app_name| source code instead of using Git repository.
    Please, refer to the dedicated article :ref:`Get the Oro Application Source Code <installation--get-files>`
    for more details.

Install Application Dependencies
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Run the Composer Install
~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   composer install --prefer-dist

The `composer install` downloads the latest version of the external packages into the |oro_app_name| application `vendors` directory to prepare for |oro_app_name| installation.

Note that you are prompted to enter the infrastructure-related application parameters (database name, user, etc.) that
are saved into the *app/config/parameters.yml* file. A description for every parameter you can find in the
:ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>` article.

Configure WebSocket Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you use HTTP mode for |oro_app_name| website, keep the default values for the WebSocket-related parameters in the *app/config/parameters.yml* file.

If you use HTTPS mode, open the *app/config/parameters.yml* file and change the WebSocket-related parameters to match the following values:

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

Install |oro_app_name| Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To start the |oro_app_name| installation, run the following command:

.. code:: bash

   php ./app/console oro:install --env=prod --timeout=900

Follow the on-screen instructions in the console.

.. note::

    Alternatively, use the web installer as described in the `Installation via UI`_ topic. Before you launch the installation
    via UI, make the application files and folders writable for the *nginx*
    user. When the installation is complete, revert the file permission to restore the original ones.

You will be prompted to choose the installation with- or without- demo data. If you discard demo data during installation,
you can install it later by running the following command:

.. code:: bash

   sudo -u nginx php ./app/console oro:migration:data:load --fixtures-type=demo --env=prod

**For developers only**: To customize the installation process and modify the database structure and/or data that are loaded in the OroCrm after installation, you can:

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

.. finish_common_ce_part_5

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

.. begin_common_ce_part_6

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

Optimization, Scalability, and Configuration Recommendations
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

If you're interested in customization of described installation scenario, please, refer to the following topics:

* :ref:`Get the Oro Application Source Code <installation--get-files>`
* :ref:`Customizing the Installation Process <customize_install>`
* :ref:`Infrastructure-related Oro Application Configuration <installation--parameters-yml-description>`
* :ref:`Web Server Configuration <installation--web-server-configuration>`
* :ref:`Performance Optimization of the Oro Application Environment <installation--optimize-runtime-performance>`
* :ref:`Silent Installation <silent-installation>`
* :ref:`Installation Via UI Wizard <book-installation-wizard>`

User Guides
^^^^^^^^^^^

To become familiar with |oro_app_name| functional as user or developer, please, read the following guides:

.. finish_common_ce_part_6

.. finish_body

.. |oro_app_name| replace:: Oro application

.. _Installation via UI: https://oroinc.com/orocrm/doc/current/install-upgrade/installation/installation-via-UI

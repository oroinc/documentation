:orphan:

Installation Hints
==================

.. begin_body

-  Make sure that you have `NodeJS <https://github.com/joyent/node/wiki/Installing-Node.js-via-package-manager>`__ installed.

-  |main_app| uses `Composer <http://getcomposer.org/>`__ to manage its dependencies. If you do not have Composer yet, download it and follow the steps provided in the `installation
   documentation <https://getcomposer.org/download/>`__ or simply run the following command:

   .. code:: bash

      curl -s https://getcomposer.org/installer | php

-  Install project dependencies with Composer. If the installation is going too slow, you can use the `--prefer-dist` option. Run composer installation:

   .. code:: bash

      composer install --prefer-dist --no-dev

   .. note:: For Enterprise Editions, it is strongly recommended to use ElasticSearch as a search engine and RabbitMQ as a message queue broker in production.

-  Create the database with the name specified in the previous step (default name is |db_name|).

-  On some systems it might be necessary to temporarily increase **memory_limit** setting to *1 GB* in *php.ini* configuration file for the duration of the installation process:

   .. code:: ini

      memory_limit=1024M

   .. note:: After the installation is finished the memory_limit configuration can be changed back to the recommended value (512 MB or more).

-  Install the application and create the admin user with the web installation wizard by opening install.php in the browser or running the following CLI command:

   .. code:: bash

      php app/console oro:install --env=prod

   .. note:: If the installation process times out, add the `--timeout=0` argument to the `oro:install` command.

-  Configure the Web Socket server process and the Message Queue consumer process in `Supervisor <http://supervisord.org/>`__:

   .. code:: ini


       [program:<oro_application>_web_socket]
       command=/path/to/app/console clank:server --env=prod
       numprocs=1
       autostart=true
       startsecs=0
       user=www-data
       redirect_stderr=true

       [program:<oro_application>_message_consumer]
       command=/path/to/app/console oro:message-queue:consume --env=prod
       process_name=%(program_name)s_%(process_num)02d
       numprocs=5
       autostart=true
       autorestart=true
       startsecs=0
       user=www-data
       redirect_stderr=true

   .. note:: Replace *<oro_application>* with orocrm, orocommerce, or platform.

   or run them manually:

   .. code:: bash

      php /path/to/app/console clank:server --env=prod
      php /path/to/app/console oro:message-queue:consume --env=prod

   .. note:: The port used by Web Socket must be open in the firewall for outgoing/incoming connections.

-  Configure crontab:

   .. code:: bash

      */1 * * * * /path/to/app/console oro:cron --env=prod

   or scheduled tasks execution to run the command below every minute:

   .. code:: bash

      php /path/to/app/console oro:cron --env=prod

   .. note:: ``app/console`` is a path from the project root folder. Please make sure you are using the full path for crontab configuration if you are running console command from a different location.

.. finish_body

.. |db_name| replace:: *oro_crm*

.. |main_app| replace:: OroCRM
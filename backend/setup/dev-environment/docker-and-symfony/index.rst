.. _setup-dev-env-docker-symfony:

Set up Environment for OroPlatform Based Application with Docker and Symfony Server
===================================================================================

During development, you can use Docker to run various application
services (MySQL, Postgres, ElasticSearch, RabbitMQ, Redis and MailCatcher), but for
simplicity, performance and reliability have PHP and NodeJS installed
locally on a host machine.

Set Up the Environment
----------------------

.. hint::

   There are quick guides to setup Docker and Symfony Server development stack:

   - :ref:`Setup on Mac OS X <setup-dev-env-docker-symfony_mac>`
   - :ref:`Setup on Ubuntu 20.04 LTS <setup-dev-env-docker-symfony_ubuntu>`
   - :ref:`Setup on Windows Subsystem for Linux (WSL) 2 <setup-dev-env-docker-symfony_windows>`

**Development Stack**

-  PHP, Composer, Node.js, and NPM should be installed locally for a better development experience.
-  |Symfony Local Web Server| is used to make you more productive while
   developing applications. This server is not intended for production
   use. It supports HTTP/2, TLS/SSL, automatic generation of security
   certificates, local domains, and many other features.
-  |Docker| is used to run application services.
-  |Docker Compose| is used to manage them all with a single command.


.. note::
     PHP and NodeJS should meet the :ref:`System Requirements <system-requirements>`.

.. _setup-dev-env-docker-symfony-recommendations:

**Recommendations**

To avoid reaching composer API rate limit and to work with enterprise applications, configure |GitHub OAuth token|:

   .. code-block:: none

      composer config -g github-oauth.github.com <oauthtoken>

.. _setup-dev-env-docker-symfony-install-application:

Install the Application
-----------------------

1. :ref:`Get the Oro application source code <installation--get-files>` and go to the application folder.

2. Run application services

   .. code-block:: none

      docker-compose up -d

   .. note::
        On Linux, it may not work if you use Docker as a root user. In this case, consider adding your user to the “docker” group with:

      .. code-block:: none

         sudo usermod -aG docker your-user

3. Install application dependencies

   .. code-block:: none

      composer install -n


4. If you are using an Enterprise edition application, update the parameters.yml file.

   .. code-block:: none

      composer set-parameters database_driver=pdo_pgsql search_engine_name=elastic_search message_queue_transport=amqp message_queue_transport_config="{host: '%env(ORO_MQ_HOST)%', port: '%env(ORO_MQ_PORT)%', user: '%env(ORO_MQ_USER)%', password: '%env(ORO_MQ_PASSWORD)%', vhost: '/'}" redis_dsn_cache='%env(ORO_REDIS_URL)%/1' redis_dsn_doctrine='%env(ORO_REDIS_URL)%/2'

5. Install Oro application

   .. code-block:: none

      symfony console oro:install -vvv --sample-data=y --application-url=https://127.0.0.1:8000 --user-name=admin --user-email=admin@example.com --user-firstname=John --user-lastname=Doe --user-password=admin --organization-name=Oro --timeout=0 --symlink --env=prod -n

.. _setup-dev-env-docker-symfony-services:

Use a Symfony Server
--------------------

To automatically apply environment variables exposed by Symfony Server
from Docker Compose and to use the proper PHP version, you should run
all the symfony application commands using ``symfony console`` instead
of ``php bin/console``. Use ``symfony php`` to run php binaries
using proper PHP version and expose environment variables from the application services defined with Docker Compose.

.. note::
     On Windows with WSL2 the website is accessible using ``https://localhost:8000``, instead of ``https://127.0.0.1:8000``.

Run Symfony Server in a ``Dev`` Environment
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   symfony server:start -d

Run Symfony Server in a ``Prod`` Environment
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   symfony server:start -d --passthru=index.php

Open the Application in a Browser
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   symfony open:local

Check Application Logs
^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   symfony server:log

Switch PHP version
^^^^^^^^^^^^^^^^^^

You can have multiple versions of PHP versions locally. To use a
specific PHP version for the project, go to the project root folder and run:

.. code-block:: none

   echo 7.4 > .php-version

This will switch the php version to 7.4 for Symfony Server and all the
console commands wrapped with ``symfony``.

Run Message Consumer in the Background
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   symfony run -d php bin/console oro:message-queue:consume -vv

You can also ask symfony to restart the message consumer when changes happen in ``src/`` folder:

.. code-block:: none

   symfony run -d --watch=src php bin/console oro:message-queue:consume -vv

Check Symfony Server status
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   symfony server:status

For more details, see: |Symfony Local Web Server|.

.. _3-optional-local-domain-names:

Enable Local Domain Names
^^^^^^^^^^^^^^^^^^^^^^^^^

By default, projects are accessible at a random port of the 127.0.0.1
local IP.

You can enable local domains by |setting up the Local Proxy|.

.. include:: /include/include-links-dev.rst
   :start-after: begin

Manage Application Services
---------------------------

All application services are defined in the ``docker-compose.yml`` file.
By default, the ``docker-compose.yml`` file shipped with an application has a
set of recommended services for each application:

* For community edition applications: **MySQL** and **MailCatcher**.
* For enterprise edition applications: **Postgres**, **ElasticSearch**, **RabbitMQ**, **Redis** and **MailCatcher**.

Override Docker Compose Configuration Locally
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can use ``docker-compose.override.yml`` file to override Docker
Compose configuration locally. By default, the file is in ``.gitignore``.

.. note:: For an enterprise application, you first have to update the parameters.yml file to start working with the application services.

Run Application Services
^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   docker-compose up -d

Check Services Logs
^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   docker-compose logs -f

Check Application Services Status
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   docker-compose ps

Stop Application Services (No Data Loss)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   docker-compose stop

Destroy Application Services with all Volumes (Data Loss)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code-block:: none

   docker-compose down -v

For more details, see |Overview of Docker Compose|.

Store Sessions in Redis
-----------------------

It is not recommended to store sessions on the same redis server as the
cache, but for testing purpose, you can enable it with the following
command:

.. code-block:: none

   composer set-parameters session_handler="snc_redis.session.handler" redis_dsn_session="%env(ORO_REDIS_URL)%/0"

Troubleshooting
---------------

**Environment variable not found: "ORO_REDIS_URL"**

This error appears when the Symfony server does not pass environment variables from the Docker Compose to the application.

Make sure that all the application services are up and healthy with ``docker-compose ps``. There should be a ``redis`` service in the list.

If the list is empty, run ``docker-compose up -d`` to start all the services.

**An exception occured while establishing a connection to figure out your platform version**

Make sure all the application services are up and healthy with ``docker-compose ps``. There should be ``pgsql`` or ``mysql`` service in the list.

If the list is empty, run ``docker-compose up -d`` to start all the services.

.. toctree::
   :titlesonly:
   :hidden:
   :maxdepth: 1

   Setup on Ubuntu <ubuntu>
   Setup on macOS <mac>
   Setup on Windows <windows>

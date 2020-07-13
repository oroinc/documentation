.. _setup-dev-env-docker-symfony:

Docker and Symfony Server
=========================

.. hint:: This feature is available since OroCommerce v4.1.7. To check which application version you are running, see the :ref:`system Information <system-information>`.

During development, you can use Docker to run various application
services (MySQL, Postgres, ElasticSearch, RabbitMQ and Redis), but for
simplicity, performance and reliability have PHP and NodeJS installed
locally on a host machine.

**Development Stack**

-  |Symfony Local Web Server| - used to make you more productive while
   developing applications. This server is not intended for production
   use. It supports HTTP/2, TLS/SSL, automatic generation of security
   certificates, local domains, and many other features.
-  |Docker| - used to run application services.
-  |Docker Compose| - used to manage them all with a single command.

Set Up the Environment
----------------------

.. hint::

   There are quick guides for setup Docker and Symfony Server stack on :ref:`Mac OS X <setup-dev-env-docker-symfony_mac>` and :ref:`Ubuntu 20.04 LTS <setup-dev-env-docker-symfony_ubuntu>`.

**Requirements**

To start working with this development stack, you need to install locally:

-  |Download PHP|
-  |Download Node.js & NPM|
-  |Download Composer|
-  |Symfony binary|
-  |Download Docker|
-  |Install Docker Compose|


.. note::
     PHP and NodeJS should meet the :ref:`System Requirements <system-requirements>`.

.. _setup-dev-env-docker-symfony-recommendations:

**Recommendations**

1. For better performance, it is also recommended to install a symfony
   flex composer plugin globally:

   .. code:: bash

      composer global require symfony/flex

2. To work with enterprise applications and not reach composer API rate limit, configure |GitHub OAuth token|:

   .. code:: bash

      composer config -g github-oauth.github.com <oauthtoken>

.. _setup-dev-env-docker-symfony-install-application:

Install the Application
-----------------------

1. :ref:`Get the Oro application source code <installation--get-files>` and go to the application folder.

2. Run application services

   .. code:: bash

      docker-compose up -d

   .. note::
        On Linux, it may not work if you use Docker as a root user. In this case, consider adding your user to the “docker” group with:

      .. code:: bash

         sudo usermod -aG docker your-user

3. Install application dependencies

   .. code:: bash

      symfony composer install -n


4. If you are using an Enterprise edition application, :ref:`update the parameters.yml file <for-using-enterprise-services-update-parameters-yml-file>`.

   .. code:: bash

      composer set-parameters database_driver=pdo_pgsql search_engine_name=elastic_search message_queue_transport=amqp message_queue_transport_config="{host: '%env(ORO_MQ_HOST)%', port: '%env(ORO_MQ_PORT)%', user: '%env(ORO_MQ_USER)%', password: '%env(ORO_MQ_PASSWORD)%', vhost: '/'}" redis_dsn_cache='%env(ORO_REDIS_URL)%/1' redis_dsn_doctrine='%env(ORO_REDIS_URL)%/2'

5. Install Oro application

   .. code:: bash

      symfony console oro:install -vvv --sample-data=y --application-url=https://127.0.0.1:8000 --user-name=admin --user-email=admin@example.com --user-firstname=John --user-lastname=Doe --user-password=admin --organization-name=Oro --timeout=0 --symlink --env=prod -n

.. _setup-dev-env-docker-symfony-services:

.. _for-using-enterprise-services-update-parameters-yml-file:

Use Enterprise Services
-----------------------

For the Enterprise edition of Oro applications, it is recommended to use
Postgres, ElasticSearch, RabbitMQ, and Redis services.

To enable them, you first have to update configuration in
``config/parameters.yml``:

.. code:: yaml

   parameters:
       database_driver: pdo_pgsql
       search_engine_name: elastic_search
       message_queue_transport: amqp
       message_queue_transport_config:
           host: '%env(ORO_MQ_HOST)%'
           port: '%env(ORO_MQ_PORT)%'
           user: '%env(ORO_MQ_USER)%'
           password: '%env(ORO_MQ_PASSWORD)%'
           vhost: /
       redis_dsn_cache: '%env(ORO_REDIS_URL)%/1'
       redis_dsn_doctrine: '%env(ORO_REDIS_URL)%/2'

To automatically update ``parameters.yml`` file from CLI, you can also
use the ``composer set-parameters`` command:

.. code:: bash

   composer set-parameters database_driver=pdo_pgsql search_engine_name=elastic_search message_queue_transport=amqp message_queue_transport_config="{host: '%env(ORO_MQ_HOST)%', port: '%env(ORO_MQ_PORT)%', user: '%env(ORO_MQ_USER)%', password: '%env(ORO_MQ_PASSWORD)%', vhost: '/'}" redis_dsn_cache='%env(ORO_REDIS_URL)%/1' redis_dsn_doctrine='%env(ORO_REDIS_URL)%/2'

.. note:: Run ``composer set-parameters`` without arguments to see the full command reference.

Store Sessions in Redis
-----------------------

It is not recommended to store sessions on the same redis server as the
cache, but for testing purpose, you can enable it with the following
configuration in ``config/parameters.yml``:

.. code:: yaml

   parameters:
       session_handler:   'snc_redis.session.handler'
       redis_dsn_session: '%env(ORO_REDIS_URL)%/0'


Manage Application Services
---------------------------

All the application services are defined in ``docker-compose.yml`` file.
By default, ``docker-compose.yml`` file shipped with an application has a
set of recommended services for each application:

* For community edition applications, it is **MySQL**.
* For enterprise edition applications, they are: **Postgres**, **ElasticSearch**, **RabbitMQ** and **Redis**.

Override Docker Compose Configuration Locally
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can use ``docker-compose.override.yml`` file to override Docker
Compose configuration locally. By default, the file is in ``.gitignore``.

.. note:: For an enterprise application, to start working with application services, you first have to :ref:`update the parameters.yml file <for-using-enterprise-services-update-parameters-yml-file>`.

Run Application Services
^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   docker-compose up -d

Check Services Logs
^^^^^^^^^^^^^^^^^^^

.. code:: bash

   docker-compose logs -f

CheckApplication Services Status
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   docker-compose ps

Stop Application Services (No Data Loss)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   docker-compose stop

Destroy Application Services with all Volumes (Data Loss)
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   docker-compose down -v

For more details, see |Overview of Docker Compose|.

.. _setup-dev-env-docker-symfony-using-symfony-server:

Use a Symfony Server
--------------------

To automatically apply environment variables exposed by Symfony Server
from Docker Compose and to use the proper PHP version, you should run
all the symfony application commands using ``symfony console`` instead
of ``bin/console``. Use ``symfony composer`` and ``symfony php`` to run composer and php binaries
using proper PHP version and expose environment variables from the application services defined with Docker Compose.

Start the Symfony Server
^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   symfony server:start -d

Open the Application in a Browser
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   symfony open:local

Check Application Logs
^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   symfony server:log

Switch PHP version
^^^^^^^^^^^^^^^^^^

You can have multiple versions of PHP versions locally. To use a
specific PHP version for the project, go to the project root folder and run:

.. code:: bash

   echo 7.3 > .php-version

This will switch the php version to 7.3 for Symfony Server and all the
console commands wrapped with ``symfony``.

Run Message Consumer in the Background
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   symfony run -d php bin/console oro:message-queue:consume -vv

You can also ask symfony to restart the message consumer when changes happen in ``src/`` folder:

.. code:: bash

   symfony run -d --watch=src php bin/console oro:message-queue:consume -vv

Run Symfony Server in a ``Prod`` Environment
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   symfony server:start -d --passthru=index.php

Check Symfony Server status
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. code:: bash

   symfony server:status

For more details, see: |Symfony Local Web Server|.

.. _3-optional-local-domain-names:

Enable Local Domain Names
-------------------------

By default, projects are accessible at a random port of the 127.0.0.1
local IP.

You can enable local domains by |setting up the Local Proxy|.

.. include:: /include/include-links-dev.rst
   :start-after: begin

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

   mac
   ubuntu

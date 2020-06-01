.. _dev-guide-development-practice-setup-dev-env-docker-symfony:

Docker and Symfony Server
=========================

Overview
--------

During development, you can use Docker to run various application
services (MySQL, Postgres, ElasticSearch, RabbitMQ and Redis), but for
simplicity, performance and reliability have PHP and NodeJS installed
locally on a host machine.

Development Stack
~~~~~~~~~~~~~~~~~

-  |Symfony Local Web Server| - used to make you more productive while
   developing applications. This server is not intended for production
   use. It supports HTTP/2, TLS/SSL, automatic generation of security
   certificates, local domains, and many other features.
-  |Docker| - used to run application services.
-  |Docker Compose| - used to manage them all with a single command.

Setup Environment
-----------------

Requirements
~~~~~~~~~~~~

To start working with this development stack, you need to install
locally:

-  |Download PHP|
-  |Download NodeJS & NPM|
-  |Download Composer|
-  |Symfony binary|
-  |Download Docker|
-  |Install Docker Compose|

.. note:: PHP and NodeJS should meet the :ref:`System Requirements <system-requirements>`.

Recommendations
~~~~~~~~~~~~~~~

1. For better performance, it's also recommended installing a symfony
   flex composer plugin globally:

   .. code:: bash

      composer global require symfony/flex

2. To not reach composer API rate limit and to work with enterprise
   applications configure |GitHub OAuth token|:

   .. code:: bash

      composer config -g github-oauth.github.com <oauthtoken>

.. _dev-guide-development-practice-setup-dev-env-docker-symfony-install-application:

Install an Application
----------------------

1. Run application services

   .. code:: bash

      docker-compose up -d

2. Install application dependencies

   .. code:: bash

      symfony composer install -n


3. In case, you are using an Enterprise edition application, :ref:`update parameters.yml file <for-using-enterprise-services-update-parameters-yml-file>`.

   .. code:: bash

      composer set-parameters database_driver=pdo_pgsql search_engine_name=elastic_search message_queue_transport=amqp message_queue_transport_config="{host: '%env(ORO_MQ_HOST)%', port: '%env(ORO_MQ_PORT)%', user: '%env(ORO_MQ_USER)%', password: '%env(ORO_MQ_PASSWORD)%', vhost: '/'}" redis_dsn_cache='%env(ORO_REDIS_URL)%/1' redis_dsn_doctrine='%env(ORO_REDIS_URL)%/2'

4. Install Oro application

   .. code:: bash

      symfony console oro:install -vvv --sample-data=y --application-url=https://127.0.0.1:8000 --user-name=admin --user-email=admin@example.com --user-firstname=John --user-lastname=Doe --user-password=admin --organization-name=Oro --timeout=0 --symlink --env=prod -n

.. _dev-guide-development-practice-setup-dev-env-docker-symfony-services:

.. _for-using-enterprise-services-update-parameters-yml-file:

Using Enterprise Services
-------------------------

For the Enterprise edition of Oro applications, it is recommended to use
Postgres, ElasticSearch, RabbitMQ, and Redis services.

To enable them, first, you have to update configuration in
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

To automatically update ``parameters.yml`` file from CLI you can also
use ``composer set-parameters`` command:

.. code:: bash

   composer set-parameters database_driver=pdo_pgsql search_engine_name=elastic_search message_queue_transport=amqp message_queue_transport_config="{host: '%env(ORO_MQ_HOST)%', port: '%env(ORO_MQ_PORT)%', user: '%env(ORO_MQ_USER)%', password: '%env(ORO_MQ_PASSWORD)%', vhost: '/'}" redis_dsn_cache='%env(ORO_REDIS_URL)%/1' redis_dsn_doctrine='%env(ORO_REDIS_URL)%/2'

.. note:: Run ``composer set-parameters`` without arguments to see the full command reference.

Store Sessions in Redis
-----------------------

It is not recommended to store sessions in the same redis server as the
cache, but for testing purpose, you can enable it with the following
configuration in ``config/parameters.yml``:

.. code:: yaml

   parameters:
       session_handler:   'snc_redis.session.handler'
       redis_dsn_session: '%env(ORO_REDIS_URL)%/0'


Managing an Application Services
--------------------------------

All the application services are defined in ``docker-compose.yml`` file.
By default ``docker-compose.yml`` file shipped with an application has a
set of recommended services for each application:

For community edition applications its **MySQL**.

For enterprise edition applications there are: **Postgres**, **ElasticSearch**, **RabbitMQ** and **Redis**.

Override Docker Compose configuration locally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can use ``docker-compose.override.yml`` file to override Docker
Compose configuration locally. By default, the file is in
``.gitignore``.

.. note:: For an enterprise application, to start working with application services, first you have to :ref:`update parameters.yml file <for-using-enterprise-services-update-parameters-yml-file>`.

Run application services
~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   docker-compose up -d

Check services logs
~~~~~~~~~~~~~~~~~~~

.. code:: bash

   docker-compose logs -f

Check application services status
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   docker-compose ps

Stop application services (data will not be lost)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   docker-compose stop

Destroy application services with all the volumes (data will be lost)
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   docker-compose down -v

For more details, see |Overview of Docker Compose|.

.. _dev-guide-development-practice-setup-dev-env-docker-symfony-using-symfony-server:

Using a Symfony Server
----------------------

To automatically apply environment variables exposed by Symfony Server
from Docker Compose and to use the proper PHP version, you should run
all the symfony application commands using ``symfony console`` instead
of ``bin/console``. There are also ``symfony composer`` and ``symfony php`` to run composer and php binaries
using proper PHP version and expose environment variables from application services defined with Docker Compose.

Start the Symfony Server
~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   symfony server:start -d

Open the application in a web browser
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   symfony open:local

Check application logs
~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   symfony server:log

Switch PHP version
~~~~~~~~~~~~~~~~~~
You can have multiple versions of PHP versions locally. To use a
specific PHP version for the project, go to the project root folder and
run:

.. code:: bash

   echo 7.3 > .php-version

This will switch the php version to 7.3 for Symfony Server and all the
console commands wrapped with ``symfony``.

Run message consumer in a background
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   symfony run -d php bin/console oro:message-queue:consume -vv

You can also ask symfony to restart the message consumer when some
change happens in ``src/`` folder:

.. code:: bash

   symfony run -d --watch=src php bin/console oro:message-queue:consume -vv

Run Symfony Server in a ``prod`` environment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   symfony server:start -d --passthru=index.php

Check Symfony Server status
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. code:: bash

   symfony server:status

For more details see: |Symfony Local Web Server|.

.. _3-optional-local-domain-names:

Local Domain Names
------------------

By default, projects are accessible at some random port of the 127.0.0.1
local IP.

You can enable local domains by |setting up the Local Proxy|.

.. include:: /include/include-links-dev.rst
   :start-after: begin

Troubleshooting
---------------

Environment variable not found: "ORO_REDIS_URL"
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Appears when the Symfony server doesn't pass environment variables from the Docker Compose to an application.

Make sure all the application services are up and healthy with ``docker-compose ps``. There should be a redis service in the list.
If it shows the empty list, run ``docker-compose up -d`` to start all the services.

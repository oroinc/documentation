.. _installation--parameters-yml-description:

Infrastructure-Related Configuration Parameters
===============================================

Infrastructure-related environment variable defaults are stored in the *.env-app* file and grouped in the following way:

* The ``ORO_DB_DSN`` environment variable used to connect to the database.
* The ``ORO_MAILER_DSN`` environment variable define settings used to deliver emails sent by the application. See |Sending Emails with Mailer| for more information.
* The ``ORO_WEBSOCKET_`` environment variables define settings for the web UI.
* The ``ORO_SEARCH_ENGINE_DSN`` environment variable is used to connect to the search engine.
* The ``ORO_WEBSITE_SEARCH_ENGINE_DSN`` environment variable is used to connect to the website search engine.
* The ``ORO_SESSION_DSN`` value specifies the PHP |session handler| to be used.
* The ``ORO_MQ_DSN`` environment variable is used to connect to the message queue transport.
* The ``ORO_SECRET`` value is used to generate |CSRF tokens|.
* The ``ORO_ENTERPRISE_LICENCE`` value defines the project enterprise licence.
* The ``ORO_JPEGOPTIM_BINARY`` path to the |JpegOptimPostProcessor| library.
* The ``ORO_PNGQUANT_BINARY`` path to the |PngquantPostProcessor| library.

.. _book-installation-github-clone-configuration-params--default:

Default Configuration Values
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Default configuration options for the Oro application are defined in the ``config/config.yml`` file. Some options have inline values, and others refer to environment variables, therefore they can be set and changed in runtime without application cache rebuild. Default values for environment variables are provided at the end of the ``config/config.yml`` files, with the parameter names in the format ``env(ENVIRONMENT_VARIABLE_NAME)``.

.. code-block:: yaml

   parameters:
       # Some parameter values are not set from environment variables because Symfony service container build
       # depends on them. These parameter values cannot be changed in runtime without the application cache rebuild.
       web_backend_prefix: '/admin'
       database_server_version: '13.7'
       database_dsn: '%env(ORO_DB_DSN)%'
       mailer_dsn: '%env(ORO_MAILER_DSN)%'
       websocket_server_dsn: '%env(ORO_WEBSOCKET_SERVER_DSN)%' # The websocket server will listen on this address and port.
       websocket_frontend_dsn: '%env(ORO_WEBSOCKET_FRONTEND_DSN)%' # The host, port and path for the browser to connect to.
       websocket_backend_dsn: '%env(ORO_WEBSOCKET_BACKEND_DSN)%' # The host, port and path for the server-side code to connect to.
       search_engine_dsn: '%env(ORO_SEARCH_ENGINE_DSN)%'
       website_search_engine_dsn: '%env(ORO_WEBSITE_SEARCH_ENGINE_DSN)%'
       session_handler_dsn: '%env(ORO_SESSION_DSN)%'
       message_queue_transport_dsn: '%env(ORO_MQ_DSN)%'
       liip_imagine.jpegoptim.binary: '%env(ORO_JPEGOPTIM_BINARY)%'
       liip_imagine.pngquant.binary: '%env(ORO_PNGQUANT_BINARY)%'
       tracking_data_folder: '%env(ORO_TRACKING_DATA_FOLDER)%'

       env(ORO_SECRET): ThisTokenIsNotSoSecretChangeIt
       env(ORO_DB_URL): 'postgresql://root@127.0.0.1/b2b_dev'
       env(ORO_DB_DSN): '%env(ORO_DB_URL)%'
       env(ORO_MAILER_DSN): 'native://default'
       env(ORO_SEARCH_URL): 'orm:'
       env(ORO_SEARCH_ENGINE_DSN): '%env(ORO_SEARCH_URL)%?prefix=oro_search'
       env(ORO_WEBSITE_SEARCH_ENGINE_DSN): '%env(ORO_SEARCH_URL)%?prefix=oro_website_search'
       env(ORO_SESSION_DSN): 'native:'
       env(ORO_WEBSOCKET_SERVER_DSN): '//0.0.0.0:8080'
       env(ORO_WEBSOCKET_FRONTEND_DSN): '//*:8080/ws'
       env(ORO_WEBSOCKET_BACKEND_DSN): 'tcp://127.0.0.1:8080'
       env(ORO_MQ_DSN): 'dbal:'
       env(ORO_JPEGOPTIM_BINARY): ''
       env(ORO_PNGQUANT_BINARY): ''
       env(ORO_REDIS_URL): 'redis://127.0.0.1:6379'
       env(ORO_REDIS_SESSION_DSN): '%env(ORO_REDIS_URL)%/0'
       env(ORO_REDIS_CACHE_DSN): '%env(ORO_REDIS_URL)%/1'
       env(ORO_REDIS_DOCTRINE_DSN): '%env(ORO_REDIS_URL)%/2'
       env(ORO_REDIS_LAYOUT_DSN): '%env(ORO_REDIS_URL)%/3'
       env(ORO_TRACKING_DATA_FOLDER): null

Sample Configuration Parameters
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The sample contents of the **<installation directory>/config/parameters.yml** file for OroCommerce:

.. code-block:: yaml

   parameters:
       secret: '%env(ORO_SECRET)%'

       # Enable GridFS support
       #gaufrette_adapter.public: 'gridfs:%env(ORO_MONGODB_DSN_PUBLIC)%'
       #gaufrette_adapter.private: 'gridfs:%env(ORO_MONGODB_DSN_PRIVATE)%'

       # Enable Redis support
       #redis_dsn_cache: '%env(ORO_REDIS_CACHE_DSN)%'
       #redis_dsn_doctrine: '%env(ORO_REDIS_DOCTRINE_DSN)%'
       #redis_dsn_layout: '%env(ORO_REDIS_LAYOUT_DSN)%'

Environment Variables
^^^^^^^^^^^^^^^^^^^^^

An environment variable is a variable with a value outside the application, typically through a functionality built into the operating system. You can find the list of all the infrastructure-related environment variables available in the application in the config/config.yml file.

In the above parameters.yml file example, the ``web_backend_prefix`` parameter value is provided directly in the YAML file and cannot be changed in runtime without the application cache rebuild, while the ``database_dsn`` environment variable can be set in runtime by the environment variable named ``ORO_DB_DSN``.

The default value for the ORO_DB_DSN environment variable is provided at the end of the file and is set to ``postgresql://root@127.0.0.1/b2b_crm_ee_dev``. It is used when the environment variable ``ORO_DB_DSN`` is not provided.

.. warning:: Environment variables are always string and are not cast automatically to integer, null, or other types. You should never pass an empty environment variable, like 'ORO_DB_DSN=' or 'ORO_DB_DSN=NULL'. Instead, it should never be available (never be set).


.. include:: /include/include-links-dev.rst
   :start-after: begin

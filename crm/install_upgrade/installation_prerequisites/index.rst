:orphan:

.. _installation--prepare:

Prepare Installation Environment
================================

.. TODO add hardware requirements

.. begin_prepare_for_installation

Before you can start |main_app_in_this_topic|, prepare the physical or virtual environment that will host your |main_app_in_this_topic| deployment.

.. note:: It is recommended to host application server and database server on separate servers.

Prepare the Application Server
------------------------------

#. Allocate physical or virtual machine and the necessary network resources.
#. Install one of the :ref:`supported <system-requirements>` operation systems.
#. :ref:`Install and Configure a Web Application Server(s) <platform--installation--web-server-configuration>` (Apache or nginx).
#. Install the :ref:`recommended <system-requirements>` version of PHP, :ref:`configure PHP runtime environment <installation--configure-php-runtime-environment>` and take into account hints on :ref:`performance optimization <installation--optimize-runtime-performance>`.
#. |main_app_in_this_topic| uses `Composer`_ to manage package dependencies. Install it globally to simplify running the commands. Symfony documentation provides detailed `instructions on installing Composer globally`_.

   .. hint:: If Composer has been installed globally, it is enough to type *composer* in the console, in order to execute it.

#. *Optional:* To efficiently use the assets shipped with the |main_app_in_this_topic|, it is recommended to install node.js. Detailed installation instructions are available in the `node.js installation document`_.

.. important:: Please ensure that all the :ref:`system requirements <system-requirements>` are met by the installation environment.

Prepare Other Servers and Systems
---------------------------------

Install and configure the following, if necessary:

* Mail server

* Message Queue (Rabbit MQ)

* Cache (Redis, APCu, or memcached)

* Search Engine (Elastic Search)

.. note:: Consider using :ref:`scalability recommendations <installation--scalable-configuration>` for |main_app_in_this_topic| deployment if you plan heavy load on the storage due to the large amount of data or on the servers due to the extremely frequent requests.

Prepare the Database Server
---------------------------

#. Allocate physical or virtual machine and the necessary network resources.
#. Install the operation system and :ref:`recommended <system-requirements>` version of the database management software (PostgreSQL or MySQL).
#. :ref:`Create the database <platform--installation--create-database>` that will be used to store Oro application data.

Configure Network
-----------------

* Add a record to your DNS Server to map Oro application hostname (e.g., oro.example.com) with the IP address it runs on.

  .. note:: For local deployment, update the *hosts* file (e.g., 127.0.0.1 oro.example.com).

Once you have prepared the environment, you may proceed with :ref:`downloading <installation--get-files>` |main_app_in_this_topic| files and required packages.

.. finish_prepare_for_installation

.. include:: /install_upgrade/installation/vars.rst
   :start-after: begin_vars

**Related Topics**

.. toctree::
   :maxdepth: 1

   web_server_configuration

   runtime_configuration

   optimize_performance

   scalability

   create_database


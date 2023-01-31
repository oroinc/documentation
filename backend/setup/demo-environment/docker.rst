.. _demo-environment-docker:

Docker
======

Prerequisite
------------

|Install Docker| with |Docker Compose: Install|.

.. note:: The application uses 80 and 8025 ports, so make sure that other services do not use them.

Run Application
---------------

1. Download the repository with a docker-compose configuration file.

   .. code-block:: none

        git clone https://github.com/oroinc/docker-demo.git
        cd docker-demo

   or download the archive file and extract it

   .. code-block:: none

      wget https://github.com/oroinc/docker-demo/archive/master.tar.gz -O - | tar -xzf -
      cd docker-demo

2. Run application containers

   The configuration is entirely predefined, and you can only change the name of the domain where the application will be located.
   By default, it is `oro.demo`. If you need to change the domain, create an `.env` file with content `ORO_APP_DOMAIN=my-custom-domain.demo`.

   Run containers:

   .. code-block:: none

        docker-compose up -d

   The docker-compose will download the required images, create networks and run containers. Application `commerce-crm-application` is used by default.
   You can run other community applications, such as `crm-application`, `platform-application` or `commerce-crm-application-de`.
   To select another application, set a different image in `.env` file, for example:

   .. code-block:: none

      ORO_IMAGE=docker.io/oroinc/crm-application

   Alternatively, you can set a variable before the docker-compose command without creating the `.env` file:

   .. code-block:: none

      ORO_IMAGE=docker.io/oroinc/crm-application docker-compose up -d

   You can also select a different tag (version). For example, set the variable `ORO_APP_VERSION=5.0` in `.env` or the command line.

   To track the logs from the php-fpm container, run `docker-compose logs -f php-fpm`. To get the list of containers, run: `docker-compose ps`.

3. Add a record to file `/etc/hosts`

   .. code-block:: none

        127.0.0.1 oro.demo

4. Open the application in a browser: ``http://oro.demo``.

Access the Mail Catcher
-----------------------

|Smtp service| is additionally launched so you can send emails from the application. It receives all mail and has a web interface that enables you to view it and perform the required actions. The web interface for the mail catcher is available on port `8025`. You can open it by URL ``http://localhost:8025``.

Stop the Application
--------------------

- To stop and remove all containers, use the following command: `docker-compose down`.

- To stop and remove all containers with the data saved in volumes, use the following command: `docker-compose down -v`.

Troubleshooting
---------------

If you deployed the application before, pull up fresh images with `docker-compose pull`.

About this Project
------------------

This repository provides a Docker Compose configuration file (docker-compose.yaml) and demonstrates how you can run different applications and required services in containers. We provide images with the Community Edition of Oro applications in the public Docker Hub.

.. important:: This deployment is NOT intended for a production environment.

**Docker images with different applications:**

* OroCommerce Community Edition: |docker.io/oroinc/commerce-crm-application|
* OroCRM Community Edition: |docker.io/oroinc/crm-application|
* OroPlatform Community Edition: |docker.io/oroinc/platform-application|
* OroCommerce Community Edition for Germany: |docker.io/oroinc/commerce-crm-application-de|

One image is used to run containers in several roles: web server, php-fpm, consumer, WebSocket server, and cron service.
All these services must be running, and the PostgreSQL database must be prepared for a full-fledged application.


.. admonition:: Business Tip

   Technologies are at the forefront of digital change in important sectors like manufacturing. Discover the benefits of |digital transformation for manufacturing companies|.


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin
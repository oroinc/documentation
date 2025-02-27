.. _orocloud-services:

.. important:: You are viewing the upcoming documentation for OroCloud, scheduled for release later in 2025. For accurate and up-to-date information, please refer only to the documentation of |the latest LTS version|.

How to Work with Services
=========================

Service commands allow to manipulate with application services.

Status
------

To check consumers, cron, or websocket status, use the `service:status` command.

Websocket Status
^^^^^^^^^^^^^^^^

To check websocket status, use the `service:status:websocket` command.

Cron Status
^^^^^^^^^^^

To check cron status, use the `service:status:cron` command.

Consumers Status
^^^^^^^^^^^^^^^^

To check consumers status, use the `service:status:consumer [queue]` command.

.. code-block:: none

    service:status:consumer
    service:status:consumer oro.default

Stop
----

To stop consumers, cron, websocket, use the `service:stop` command.

Stop Websocket
^^^^^^^^^^^^^^

To stop websocket, use the `service:stop:websocket` command.

Stop Cron
^^^^^^^^^

To stop cron, use the `service:stop:cron` command.

Stop Consumers
^^^^^^^^^^^^^^

To stop consumers, use the `service:stop:consumer [queue]` command.

Start
-----

To start consumers, cron, websocket, use the `service:start` command.

Start Websocket
^^^^^^^^^^^^^^^

To start websocket, use the `service:start:websocket` command.

Start Cron
^^^^^^^^^^

To start cron, use the `service:start:cron` command.

Start Consumers
^^^^^^^^^^^^^^^

To start consumers, use the `service:start:consumer [queue]` command.

.. code-block:: none

    service:start:consumer
    service:start:consumer oro.default

Restart
-------

To restart consumers, cron, websocket, use the `service:restart` command.

Restart Websocket
^^^^^^^^^^^^^^^^^

To restart websocket, use the `service:restart:websocket` command.

Restart Cron
^^^^^^^^^^^^

To restart cron, use the `service:restart:cron` command.

Restart Consumers
^^^^^^^^^^^^^^^^^

To restart consumers, use the `service:restart:consumer [queue]` command.

.. code-block:: none

    service:restart:consumer
    service:restart:consumer oro.default

.. note:: Restart do not affect stopped services, use start to run them instead.

.. include:: /include/include-links-cloud.rst
   :start-after: begin

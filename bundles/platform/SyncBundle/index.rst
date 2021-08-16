:oro_show_local_toc: false

.. _bundle-docs-platform-sync-bundle:

OroSyncBundle
=============

OroSyncBundle uses GosWebSocketBundle to enable real-time websocket notifications between an Oro application server and users' browsers.

Out-of-the-box, OroSyncBundle triggers flash notifications about the outdated content if several users try to edit the same entity record simultaneously. It also sends flash notifications to all application site visitors once a developer turns on the system maintenance mode by a console's CLI tool.

You should be able to run this from the root of your symfony installation:

.. code-block:: none

   php bin/console gos:websocket:server


If everything is successful, you will see no output in prod mode, and something similar to the following in dev mode:

.. code-block:: none

    INFO      [websocket] Starting web socket
    INFO      [websocket] Launching Ratchet on 127.0.0.1:8080 PID: 4675

The websocket server should now be up and running.

Logging Levels
--------------

Logging levels are different in dev and prod modes by default.

Prod mode:

* Normal: WARNING and higher
* Verbose (-v): NOTICE and higher
* Very verbose (-vv): INFO and higher
* Debug (-vvv): DEBUG and higher

Dev mode:

* Normal: INFO and higher
* Verbose (-v): DEBUG and higher

.. toctree::
   :maxdepth: 1
   :hidden:  

   configuration
   client
   topics-handlers
   authentication
   content-outdating
   origin-checking
   mediator-handlers

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _dev-cookbook-system-websockets-maintenance-mode:

Use Maintenance Mode Notifications in Oro Applications
======================================================

Maintenance notifications are another type of notifications in the Oro application that uses WebSockets functionality to deliver messages to users quickly.

System administrator or developers can set the Oro application to maintenance mode to perform maintenance tasks.

To do this, execute the following command in the console:

.. code-block:: none

    oro:maintenance:lock --env=prod

This prompts the site to switch to the maintenance mode. All new visitors will see a message informing that the website is in the maintenance mode. All users who had their pages open when the site switched to the maintenance mode will get a WebSocket message informing that the maintenance mode is on. The website will show a flash message and disable all UI elements on the opened page.

To turn off the maintenance mode, run the following command:

.. code-block:: none

   php bin/console oro:maintenance:unlock --env=prod


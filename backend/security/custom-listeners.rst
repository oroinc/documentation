.. _backend-security-bundle-listeners:

Custom listeners
================

SecurityBundle provides several custom event listeners that can alter system behavior.

Console security context listener
---------------------------------

**Class**: Oro\\Bundle\\SecurityBundle\\EventListener\\ConsoleContextListener

This listener passes the current user and organization to a console command so that command services can read them from the security context.

By default, the console security context token is empty. To store the user and organization, the listener creates a ConsoleToken instance and sets it in the security context.

The listener uses the following options:

- *--current-user* - ID, username, or email of the user that should be used as a current user;
- *--current-organization* - ID or name of the organization that should be used as a current organization.

Example:

.. code-block:: bash

   php bin/console oro:import:file ~/Contact_10k.csv --email=test@test.com --current-user=admin --current-organization=1


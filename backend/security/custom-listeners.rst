.. _backend-security-bundle-listeners:

Custom listeners
================

SecurityBundle provides several custom event listeners that can alter system behavior.

Console security context listener
---------------------------------

**Class**: Oro\\Bundle\\SecurityBundle\\EventListener\\ConsoleContextListener

This listener allows to pass current user and organization to the console command, so command services can get this user and organization from security context. By default security context token in console is empty - so, to save user and organization listener creates instance of ConsoleToken and sets it to security context.

Listener uses following options:

- *--current-user* - ID, username or email of the user that should be used as current user;
- *--current-organization* - ID or name of the organization that should be used as current organization.

Example:

.. code-block:: bash

   php bin/console oro:import:csv ~/Contact_10k.csv --current-user=admin --current-organization=1


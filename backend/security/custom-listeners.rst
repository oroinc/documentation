.. _backend-security-bundle-listeners:

Custom listeners
================

SecurityBundle provides several custom event listeners that can alter system behavior.

Console security context listener
---------------------------------

**Class**: Oro\\Bundle\\SecurityBundle\\EventListener\\ConsoleContextListener

This listener allows passing the current user and organization to the console command so that command services can get this user and organization from a security context. By default, the security context token in the console is empty - so, to save the user and organization listener, it creates an instance of ConsoleToken and sets it to the security context.

The listener uses the following options:

- *--current-user* - ID, username, or email of the user that should be used as a current user;
- *--current-organization* - ID or name of the organization that should be used as a current organization.

Example:

.. code-block:: bash

   php bin/console oro:import:file ~/Contact_10k.csv --email=test@test.com --current-user=admin --current-organization=1


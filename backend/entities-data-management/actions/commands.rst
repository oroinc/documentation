.. _bundle-docs-platform-action-bundle-commands:

Operations (Actions) Console Commands
=====================================

oro:debug:action
^^^^^^^^^^^^^^^^

This command displays current actions for an application.

.. code::

   oro:debug:action [<name>]
   oro:debug:action

   Arguments:
      name (optional): An action name

Usage
~~~~~

- Displays a list of current actions `php bin/console oro:debug:action`;
- Shows a full description `php bin/console oro:debug:action [<name>]`.

oro:debug:condition
^^^^^^^^^^^^^^^^^^^

This command displays current conditions for an application.

.. code::

   oro:debug:condition [<name>]

   Arguments:
      name (optional): A condition name

Usage
~~~~~

- Displays list of all conditions `php bin/console oro:debug:condition`;
- Shows a full description `php bin/console oro:debug:condition [<name>]`.

.. include:: /include/include-links-dev.rst
   :start-after: begin

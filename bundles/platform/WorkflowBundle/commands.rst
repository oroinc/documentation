.. _bundle-docs-platform-workflow-bundle-commands:

CLI Commands (WorkflowBundle)
=============================

oro:debug:workflow:definitions
------------------------------

To see current workflow definitions registered in the application, use the following command:

.. code-block:: none

    php bin/console oro:debug:workflow:definitions

Use ``--workflow-name`` option to display the definition of a specific workflow:

.. code-block:: none

    php bin/console oro:debug:workflow:definitions --workflow-name=<workflow-name>

oro:workflow:definitions:load
-----------------------------

The ``oro:workflow:definitions:load`` command loads workflow definitions from configuration files to the database.

.. code-block:: none

    php bin/console oro:workflow:definitions:load

The ``--directories`` option can be used to specify custom location(s) of the workflow configuration files:

.. code-block:: none

    php bin/console oro:workflow:definitions:load --directories=<path1> --directories=<path2>

The ``--workflows`` option can be used to load only the specified workflows:

.. code-block:: none

    php bin/console oro:workflow:definitions:load --workflows=<workflow1> --workflows=<workflow2>

oro:workflow:handle-transition-cron-trigger
-------------------------------------------

To triggers a workflow transition cron trigger, use the following command:

.. code-block:: none

   php bin/console oro:workflow:handle-transition-cron-trigger

oro:workflow:transit
--------------------

To transitions a workflow item, use the following command:

.. code-block:: none

   php bin/console oro:workflow:transit

oro:workflow:translations:dump
------------------------------

The ``oro:workflow:translations:dump`` command dumps (prints) workflow translations (workflow label, step labels, attribute labels, transition labels, button labels, button title and warning messages) of a specified workflow.

.. code-block:: none

    php bin/console oro:workflow:translations:dump <workflow>

The -``-locale`` option can be used to specify a different target locale.

.. code-block:: none

    php bin/console oro:workflow:translations:dump --locale=<locale> <workflow>
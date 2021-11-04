CLI Commands (ImportExportBundle)
=================================

oro:import:file
---------------

The ``oro:import:file`` command imports data from a CSV file.

This command only schedules the job by adding a message to the message queue, so ensure that the message consumer processes (oro:message-queue:consume) are running for data to be imported.

.. code-block:: none

   php bin/console oro:import:file --email=<email> <file>

The ``--email`` option should be the email address of the owner of the new records (unless a different owner is specified in the data file). This user will also receive the import log after the import is finished.

The ``--jobName`` and ``--processor`` options should be used in non-interactive mode to provide names of the job and import processor that can handle data import:

.. code-block:: none

   php bin/console oro:import:file --email=<email> --jobName=<job> --processor=<processor> <file>

In interactive mode the job and import processor can be selected from a list.

The ``--validation`` option can be used to validate the data instead of importing it:

.. code-block:: none

   php bin/console oro:import:file --validate --email=<email> --jobName=<job> --processor=<processor> <file>
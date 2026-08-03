.. index::
    single: Import/Export; Performance
    single: Import/Export; Acceleration


Accelerate Import
=================

This article offers several recommendations for accelerating the import process.

Make Sure Xdebug is Disabled
----------------------------

Xdebug is a useful PHP debug tool, but it adds a lot of overhead, especially for heavy, long-running
operations. Check its status with the ``php -m`` command:

.. code-block:: none


    # xdebug is enabled
    $ php -m | grep xdebug
    xdebug

    # xdebug is disabled (no result)
    $ php -m | grep xdebug

To disable it, remove or comment out the Xdebug library inclusion (usually in php.ini).


Run Import Operation from the Command Line
------------------------------------------

Import from the UI works well for a relatively small amount of data (up to 1000 entities). To import thousands
or millions of entities, use the command line instead. OroPlatform provides the ``oro:import:file`` CLI command,
which imports records from a specified CSV file.

.. code-block:: none


    $ php bin/console oro:import:file --help
    Usage:
        oro:import:file [options] [--] <file>
        oro:import:file --email=<email> --jobName=<job> --processor=<processor> <file>
        oro:import:file --validation --email=<email> --jobName=<job> --processor=<processor> <file>

    Arguments:
        file                   CSV file name

    Options:
        --jobName=JOBNAME      Import job name
        --processor=PROCESSOR  Import processor name
        --validation           Only validate data instead of import
        --email=EMAIL          Email to send the import log to

Here is a small example of its usage:

.. code-block:: none


    $ php bin/console oro:import:file --email=test@test.com ~/Contact_2000.csv
    Choose Processor:
      [0] oro_contact.add_or_replace
      [1] oro_contact.add
    > 0
    Choose Job:
      [0] entity_import_from_csv
      [1] category_import_from_csv
    > 0
    Scheduled successfully. The result will be sent to the email


Perform Import in the Prod Environment
--------------------------------------

The default CLI environment is dev, which stores lots of data not required for real-life usage.
Run the import in the prod environment instead, so it finishes much faster. To do so, add
the ``--env=prod`` option to your import command:

.. code-block:: none


    $ php bin/console oro:import:file --email=test@test.com ~/Contact_2000.csv --env=prod


Skip Import File Validation
~~~~~~~~~~~~~~~~~~~~~~~~~~~

A regular import validates data twice: first during validation itself, then
before saving imported entities (invalid entities are not saved to the DB). You can skip the initial validation and
import without it. To do so, run the import command in no-interaction mode with the ``--no-interaction`` option:

.. code-block:: none


    $ php bin/console oro:import:file ~/Contact_2000.csv --email=test@test.com --processor=oro_contact.add --jobName=entity_import_from_csv --no-interaction
    Scheduled successfully. The result will be sent to the email

.. hint::

    This trick can be very useful if you need to perform import on regular basis (e.g. by cron using external source).


Disable Optional Listeners
--------------------------

OroPlatform lets you disable some event listeners during command execution. The ``oro:platform:optional-listeners``
command lists all such listeners:

.. code-block:: none


    $ bin/console oro:platform:optional-listeners
    List of optional doctrine listeners:
      > oro_dataaudit.listener.send_changed_entities_to_message_queue
      > oro_notification.docrine.event.listener
      > oro_search.index_listener
      > oro_workflow.listener.event_trigger_collector

To disable these listeners, use the ``--disabled-listeners`` option. Pass the value "all" to disable all optional
listeners. Here is an example:

.. code-block:: none


    $ bin/console oro:import:file ~/Contact_2000.csv --email=test@test.com --disabled-listeners=all

.. caution::

    Disabling a listener disables part of the backend functionality, so make sure that part is not required
    before you use it. For example, if you disable the ``oro_search.index_listener`` listener, the search engine
    will not find imported entities. You can fix this with a manual reindex using the ``oro:search:reindex``
    command, which rebuilds the search index.


Write Custom Import Strategy
----------------------------

OroPlatform provides ``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy``
as the default strategy. It automatically handles field types, relations, and so on.
However, this functionality significantly slows down the import and may perform
operations and requests that some specific cases do not require.

To solve this, implement a custom strategy that performs only the required actions.
The following example shows the services to create for a new import strategy:

.. code-block:: none


    # Custom strategy
    orocrm_contact.importexport.strategy.contact.add:
        class: Oro\Bundle\ContactBundle\ImportExport\Strategy\ContactAddOrUpadteOrDeleteStrategy
        parent: oro_importexport.strategy.add

    # Processor for custom strategy
    orocrm_contact.importexport.processor.import.add:
        parent: oro_importexport.processor.import_abstract
        calls:
            - [setStrategy, ['@orocrm_contact.importexport.strategy.contact.add']]
        tags:
            - { name: oro_importexport.processor, type: import, entity: 'Oro\Bundle\ContactBundle\Entity\Contact', alias: orocrm_contact.add }
            - { name: oro_importexport.processor, type: import_validation, entity: 'Oro\Bundle\ContactBundle\Entity\Contact', alias: orocrm_contact.add }


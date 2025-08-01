.. index::
    single: Import/Export; Performance
    single: Import/Export; Acceleration


Accelerate Import
=================

This article contains several recommendation about import process acceleration, explained below.

Make Sure Xdebug is Disabled
----------------------------

Xdebug is a very useful debug tool for PHP, but at the same time it adds lots of overhead, especially for heavy and long
operations. Xdebug status can be checked with ``php -m`` command:

.. code-block:: none


    # xdebug is enabled
    $ php -m | grep xdebug
    xdebug

    # xdebug is disabled (no result)
    $ php -m | grep xdebug

To disable it, a developer has to remove or comment inclusion of Xdebug library (usually this should be done in
php.ini).


Run Import Operation from the Command Line
------------------------------------------

Import from the UI is good for relatively small amount of data (up to 1000 entities), but if you need to import thousands
or millions of entities the command line is your best choice. OroPlatform provides the CLI command ``oro:import:file``
that allows to import records from the specified file.

.. code-block:: none


    $ php bin/console oro:import:file --help
    Usage:
        oro:import:file [options] [--] <file>
        oro:import:file --email=<email> --jobName=<job> --processor=<processor> <file>
        oro:import:file --validation --email=<email> --jobName=<job> --processor=<processor> <file>

    Arguments:
        file                   File name

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

The default environment for CLI is dev. In dev environment the application stores lots of data generally not required for real-life usage.
Therefore, it is recommended to run import in prod environment so it would finish much faster. To do so you should add
the ``--env=prod`` option to your import command:

.. code-block:: none


    $ php bin/console oro:import:file --email=test@test.com ~/Contact_2000.csv --env=prod


Skip Import File Validation
~~~~~~~~~~~~~~~~~~~~~~~~~~~

During regular import operation, the validation process is performed twice: first, during the validation itself and then
before saving imported entities (invalid entities will not be saved to the DB). Initial validation can be skipped and
import can be performed without it. To do so, start the import command in no interaction mode with the ``--no-interaction`` option:

.. code-block:: none


    $ php bin/console oro:import:file ~/Contact_2000.csv --email=test@test.com --processor=oro_contact.add --jobName=entity_import_from_csv --no-interaction
    Scheduled successfully. The result will be sent to the email

.. hint::

    This trick can be very useful if you need to perform import on regular basis (e.g. by cron using external source).


Disable Optional Listeners
--------------------------

With OroPlatform you can disable some event listeners for the command execution. The ``oro:platform:optional-listeners``
command shows the list of all such listeners:

.. code-block:: none


    $ bin/console oro:platform:optional-listeners
    List of optional doctrine listeners:
      > oro_dataaudit.listener.send_changed_entities_to_message_queue
      > oro_notification.docrine.event.listener
      > oro_search.index_listener
      > oro_workflow.listener.event_trigger_collector

To disable these listeners the ``--disabled-listeners`` option can be used. Also this option can receive value "all" -
it will disable all optional listeners. Here is an example:

.. code-block:: none


    $ bin/console oro:import:file ~/Contact_2000.csv --email=test@test.com --disabled-listeners=all

.. caution::

    Remember that disabling listeners actually disables part of the backend functionality, so before using it
    make sure this part is not required. E.g., if the ``oro_search.index_listener`` listener is disabled, then
    imported entities will not be found by the search engine (however, this may be fixed by manual search reindex
    using the ``oro:search:reindex`` command, which rebuilds the search index).


Write Custom Import Strategy
----------------------------

OroPlatform provides ``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy``
to be used as the default one. This strategy automatically handles field types, relations etc.
However, all this functionality significantly slows down the import process and might perform
operations and requests that are not required for some specific cases.

To solve this issue, a developer can implement a custom strategy to perform required actions only.
The following example shows services that should be created to add a new import strategy:

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


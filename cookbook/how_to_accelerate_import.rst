.. index::
    single: Import/Export; Performance
    single: Import/Export; Acceleration


How to Accelerate Import
========================

This article contains several recommendation about import process acceleration.


Make Sure xdebug is Disabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

xDebug is a very useful debug tool for PHP, but at the same time it adds lots of overhead, especially for heavy and long
operations. xDebug status can be checked with ``php -m`` command:

.. code-block:: bash

    # xdebug is enabled
    $ php -m | grep xdebug
    xdebug

    # xdebug is disabled (no result)
    $ php -m | grep xdebug

To disable it, a developer has to remove or comment inclusion of xDebug library (usually this should be done in
php.ini).


Run import Operation from the Command Line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Import from UI is good for relatively small amount of data (up to 1000 entities), but if you need to import thousands
or millions of entities, a command line is your best choice. OroPlatform provides a CLI command "oro:import:csv"
that allows import from specified CSV file.

.. code-block:: bash

    $ php app/console oro:import:csv --help
    Usage:
     oro:import:csv [--validation-processor="..."] [--processor="..."] file

    Arguments:
     file                    File name, to import CSV data from

    Options:
     --validation-processor  Name of the processor for the entity data validation contained in the CSV
     --processor             Name of the processor for the entity data contained in the CSV

Here is a small example of its usage:

.. code-block:: bash

    $ php app/console oro:import:csv ~/Contact_2000.csv
    Choose Processor:
      [0] orocrm_contact.add_or_replace
      [1] orocrm_contact.add
      [2] orocrm_account.add_or_replace
      [3] oro_tracking.processor.data
      [4] orocrm_sales_lead.add_or_replace
      [5] orocrm_sales_opportunity.add_or_replace
      [6] orocrm_magento.add_or_update_customer
      [7] orocrm_magento.add_or_update_region
      [8] orocrm_magento.add_or_update_cart
      [9] orocrm_magento.add_or_update_order
    > 1
    Choose Validation Processor:
      [0] orocrm_contact.add_or_replace
      [1] orocrm_contact.add
      [2] orocrm_account.add_or_replace
      [3] orocrm_sales_lead.add_or_replace
      [4] orocrm_sales_opportunity.add_or_replace
    > 1
    +---------------+-------+
    | Results       | Count |
    +---------------+-------+
    | errors        | 0     |
    | process       | 2000  |
    | read          | 2000  |
    | add           | 2000  |
    | replace       | 0     |
    | update        | 0     |
    | delete        | 0     |
    | error_entries | 0     |
    +---------------+-------+
    Do you want to proceed [yes]?
    File was successfully imported.


Perform Import in the prod Environment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Default environment for CLI is dev, so application stores lots of data generally not required for real-life usage. Thus,
import in prod environment can be performed better and faster with ``--env=prod`` option added.

.. code-block:: bash

    $ php app/console oro:import:csv ~/Contact_2000.csv --env=prod


Skip Import File Validation
~~~~~~~~~~~~~~~~~~~~~~~~~~~

During regular import operation, validation process is performed twice: first, during the validation itself and then
before saving imported entities (invalid entities will not be saved to the DB). Initial validation can be skipped and
import can be performed without it. To do so, start import command in no interaction mode with option
``--no-interaction``:

.. code-block:: bash

    $ php app/console oro:import:csv ~/Contact_2000.csv --processor=orocrm_contact.add --no-interaction --env=prod
    +---------------+-------+
    | Results       | Count |
    +---------------+-------+
    | errors        | 0     |
    | process       | 2000  |
    | read          | 2000  |
    | add           | 2000  |
    | replace       | 0     |
    | update        | 0     |
    | delete        | 0     |
    | error_entries | 0     |
    +---------------+-------+
    File was successfully imported.

.. hint::

    This trick can be very useful if you need to perform import on regular basis (e.g. by cron using external source).


Disable Optional Listeners
~~~~~~~~~~~~~~~~~~~~~~~~~~

With OroPlatform you can disable some event listeners for the command execution. Command
``oro:platform:optional-listeners`` shows the list of all such listeners:

.. code-block:: bash

    $ app/console oro:platform:optional-listeners
    List of optional doctrine listeners:
      > oro_dataaudit.listener.entity_listener
      > oro_notification.docrine.event.listener
      > oro_search.index_listener
      > oro_workflow.listener.process_collector
      > orocrm_magento.listener.customer_listener

To disable these listeners, multiple option ``--disabled-listeners`` can be used. Also option can receive value "all" -
it will disable all optional listeners. Here is an example:

.. code-block:: bash

    $ app/console oro:import:csv ~/Contact_2000.csv --processor orocrm_contact.add --disabled-listeners all --no-interaction --env prod

.. caution::

    Remember that disabling listeners actually disables a part of backend functionality, so before using it
    make sure the part is not required. E.g. if listener ``oro_search.index_listener`` is disabled then
    imported entities will not be found by search (however, this may be worked around with manual search reindexation
    using ``oro:search:reindex`` command).


Write Custom Import Strategy
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

OroPlatform provides a default configurable strategy
``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy`` that automatically handles
field types, relations etc. However, all this functionality really slows down import process and might perform
operations and requests meaningless for some specific cases.

To solve this issue, a developer can implement a custom strategy to perform required actions only.
The following example shows services that should be created to add a new import strategy:

.. code-block:: yaml

    # Custom strategy
    orocrm_contact.importexport.strategy.contact.add:
        class: %orocrm_contact.importexport.strategy.contact.add.class%
        parent: oro_importexport.strategy.add

    # Processor for custom strategy
    orocrm_contact.importexport.processor.import.add:
        parent: oro_importexport.processor.import_abstract
        calls:
            - [setStrategy, [@orocrm_contact.importexport.strategy.contact.add]]
        tags:
            - { name: oro_importexport.processor, type: import, entity: %orocrm_contact.entity.class%, alias: orocrm_contact.add }
            - { name: oro_importexport.processor, type: import_validation, entity: %orocrm_contact.entity.class%, alias: orocrm_contact.add }

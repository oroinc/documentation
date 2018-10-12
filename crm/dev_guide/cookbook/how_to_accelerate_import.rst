.. index::
    single: Import/Export; Performance
    single: Import/Export; Acceleration


How to Accelerate Import
========================

This article contains several recommendation about import process acceleration.


Make Sure Xdebug is Disabled
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Xdebug is a very useful debug tool for PHP, but at the same time it adds lots of overhead, especially for heavy and long
operations. Xdebug status can be checked with ``php -m`` command:

.. code-block:: bash

    # xdebug is enabled
    $ php -m | grep xdebug
    xdebug

    # xdebug is disabled (no result)
    $ php -m | grep xdebug

To disable it, a developer has to remove or comment inclusion of Xdebug library (usually this should be done in
php.ini).


Run import Operation from the Command Line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Import from the UI is good for relatively small amount of data (up to 1000 entities), but if you need to import thousands
or millions of entities the command line is your best choice. The OroPlatform provides the CLI command ``oro:import:csv``
that allows to import records from the specified CSV file.

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
      [0 ] orocrm_contact.add_or_replace
      [1 ] orocrm_contact.add
      [2 ] orocrm_account.add_or_replace
      [3 ] oro_tracking.processor.data
      [4 ] orocrm_sales_lead.add_or_replace
      [5 ] orocrm_sales_opportunity.add_or_replace
      [6 ] orocrm_sales_b2bcustomer
      [7 ] orocrm_magento.add_or_update_newsletter_subscriber
      [8 ] orocrm_magento.add_or_update_customer
      [9 ] orocrm_magento.import_guest_customer
      [10] orocrm_magento.add_or_update_customer_address
      [11] orocrm_magento.add_or_update_region
      [12] orocrm_magento.add_or_update_cart
      [13] orocrm_magento.add_or_update_order
      [14] orocrm_magento.store
      [15] orocrm_magento.website
      [16] orocrm_magento.customer_group
    > 1
    Choose Validation Processor:
      [0] orocrm_contact.add_or_replace
      [1] orocrm_contact.add
      [2] orocrm_account.add_or_replace
      [3] orocrm_sales_lead.add_or_replace
      [4] orocrm_sales_opportunity.add_or_replace
      [5] orocrm_sales_b2bcustomer
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

The default environment for CLI is dev. In dev environment the application stores lots of data generally not required for real-life usage.
Therefore, it is recommended to run import in prod environment so it would finish much faster. To do so you should add
the ``--env=prod`` option to your import command:

.. code-block:: bash

    $ php app/console oro:import:csv ~/Contact_2000.csv --env=prod


Skip Import File Validation
~~~~~~~~~~~~~~~~~~~~~~~~~~~

During regular import operation, the validation process is performed twice: first, during the validation itself and then
before saving imported entities (invalid entities will not be saved to the DB). Initial validation can be skipped and
import can be performed without it. To do so, start the import command in no interaction mode with the ``--no-interaction`` option:

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

With the OroPlatform you can disable some event listeners for the command execution. The ``oro:platform:optional-listeners``
command shows the list of all such listeners:

.. code-block:: bash

    $ app/console oro:platform:optional-listeners
    List of optional doctrine listeners:
      > oro_dataaudit.listener.send_changed_entities_to_message_queue
      > oro_notification.docrine.event.listener
      > oro_search.index_listener
      > oro_workflow.listener.event_trigger_collector

To disable these listeners the ``--disabled-listeners`` option can be used. Also this option can receive value "all" -
it will disable all optional listeners. Here is an example:

.. code-block:: bash

    $ app/console oro:import:csv ~/Contact_2000.csv --processor=orocrm_contact.add --disabled-listeners=all --no-interaction --env=prod

.. caution::

    Remember that disabling listeners actually disables a part of backend functionality, so before using it
    make sure this part is not required. E.g. if the ``oro_search.index_listener`` listener is disabled then
    imported entities will not be found by the search engine (however, this may be fixed by manual search reindex
    using the ``oro:search:reindex`` command).


Write Custom Import Strategy
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The OroPlatform provides :class:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy`
to be used as the default one. This strategy automatically handles field types, relations etc.
However, all this functionality significantly slows down the import process and might perform
operations and requests that are not required for some specific cases.

To solve this issue, a developer can implement a custom strategy to perform required actions only.
The following example shows services that should be created to add a new import strategy:

.. code-block:: none
    :linenos:

    # Custom strategy
    orocrm_contact.importexport.strategy.contact.add:
        class: "%orocrm_contact.importexport.strategy.contact.add.class%"
        parent: oro_importexport.strategy.add

    # Processor for custom strategy
    orocrm_contact.importexport.processor.import.add:
        parent: oro_importexport.processor.import_abstract
        calls:
            - [setStrategy, [@orocrm_contact.importexport.strategy.contact.add]]
        tags:
            - { name: oro_importexport.processor, type: import, entity: "%orocrm_contact.entity.class%", alias: orocrm_contact.add }
            - { name: oro_importexport.processor, type: import_validation, entity: "%orocrm_contact.entity.class%", alias: orocrm_contact.add }

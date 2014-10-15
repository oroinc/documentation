.. index::
    single: Import/Export; Performance
    single: Import/Export; Acceleration


How to accelerate import
========================

This article contains several recommendation about import process acceleration.


Make sure xDebug is disabled
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


Run import operation from command line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Import from UI is good for relatively small amount of data (up to 1000 entities), but if you need to import thousands
or millions of entities, a command line is your best choice. OroPlatform provides a CLI command "oro:import:csv"
that allows import from specified CSV file.

.. code-block:: bash

    $ php app/console oro:import:csv --help
    Usage:
     oro:import:csv [--validation-processor="..."] [--processor="..."] file

    Arguments:
     file                    File name from which to import the CSV data

    Options:
     --validation-processor  Name of the processor for the entity data validation contained in the CSV
     --processor             Name of the processor for the entity data contained in the CSV

Here is small example of it's usage.

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


Perform import in prod environment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Default environment for CLI is dev, so application stores lots of data that usually unnecessary for real usage - so,
it will be better and faster to perform import in prod environment by adding ``--env=prod`` option.

.. code-block:: bash

    $ php app/console oro:import:csv ~/Contact_2000.csv --env=prod


Skip import file validation
~~~~~~~~~~~~~~~~~~~~~~~~~~~

During regular import operation validation process performs two times - first during validation itself, and second
before saving of imported entities (invalid entities will not be save to DB). Initial validation can be skipped and
import will be performed without it. To do that import command should be started in no interaction mode using
option ``--no-interaction``:

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

    This trick can be very useful if you need to perform import on regular basis (f.e. by cron using external source).


Disable optional listeners
~~~~~~~~~~~~~~~~~~~~~~~~~~

OroPlatform provides ability to disable some event listeners during command execution. Command
``oro:platform:optional-listeners`` shows list of all such listeners:

.. code-block:: bash

    $ app/console oro:platform:optional-listeners
    List of optional doctrine listeners:
      > oro_dataaudit.listener.entity_listener
      > oro_notification.docrine.event.listener
      > oro_search.index_listener
      > oro_workflow.listener.process_collector
      > orocrm_magento.listener.customer_listener

To disable these listeners multiple option ``--disabled-listeners`` can be used. Also option can receive value "all" -
it will disable all optional listeners. Here is example:

.. code-block:: bash

    $ app/console oro:import:csv ~/Contact_2000.csv --processor orocrm_contact.add --disabled-listeners all --no-interaction --env prod

.. caution::

    Remember that disabling of listeners in fact disables some part of backend functionality, so before using
    ensure that it will not break anything. F.e. if listener ``oro_search.index_listener`` will be disabled then
    imported entities will not be found through search (but it can be fixed with manual search reindexation using
    ``oro:search:reindex`` command).


Write custom import strategy
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

OroPlatform provider default configurable strategy
``Oro\Bundle\ImportExportBundle\Strategy\Import\ConfigurableAddOrReplaceStrategy`` that automatically handles
field types, relations etc. However, all this functionality really slows down import process and might perform
operations and request that useless in some specific case.

To solve this issue developer can implement custom strategy that will do only required actions and nothing more.
Following example shows services that should be created to add new strategy to import:

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

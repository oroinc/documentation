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
   :linenos:

    # xdebug is enabled
    $ php -m | grep xdebug
    xdebug

    # xdebug is disabled (no result)
    $ php -m | grep xdebug

To disable it, a developer has to remove or comment inclusion of Xdebug library (usually this should be done in
php.ini).


Run Import Operation from the Command Line
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Import from the UI is good for relatively small amount of data (up to 1000 entities), but if you need to import thousands
or millions of entities the command line is your best choice. OroPlatform provides the CLI command ``oro:import:file``
that allows to import records from the specified  file.

.. code-block:: bash
   :linenos:

    $ php bin/console oro:import:file --help
    Usage:
     oro:import:file [options] [--] <file>

    Arguments:
     file                                             File name, to import CSV data from

    Options:
      --jobName=JOBNAME                            Name of Import Job.
      --validation                                 If adding this option then validation will be performed instead of import
      --processor=PROCESSOR                        Name of the import processor.
      --email=EMAIL                                Email to send the log after the import is completed
    -h, --help                                       Display this help message
    -q, --quiet                                      Do not output any message
    -V, --version                                    Display this application version
        --ansi                                       Force ANSI output
        --no-ansi                                    Disable ANSI output
    -n, --no-interaction                             Do not ask any interactive question
    -e, --env=ENV                                    The Environment name. [default: "dev"]
        --no-debug                                   Switches off debug mode.
        --disabled-listeners=DISABLED-LISTENERS      Disable optional listeners, "all" to disable all listeners, command "oro:platform:optional-listeners" shows all listeners (multiple values allowed)
        --current-user=CURRENT-USER                  ID, username or email of the user that should be used as current user
        --current-organization=CURRENT-ORGANIZATION  ID or name of the organization that should be used as current organization
    -v|vv|vvv, --verbose                             Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug

Help:
 Import data from specified file for specified entity. The import log is sent to the provided email.

Here is a small example of its usage:

.. code-block:: bash
   :linenos:

    $ php bin/console oro:import:file ~/Contact_2000.csv
    Choose Processor:
         [0 ] oro_translation_translation.add_or_replace
         [1 ] oro_translation_translation.reset
         [2 ] oro_entity_config_entity_field.add_or_replace
         [3 ] oro_contact.add_or_replace
         [4 ] oro_contact.add
         [5 ] oro_product_product.add_or_replace
         [6 ] oro_product_image.add_or_replace
         [7 ] oro_customer_customer
         [8 ] oro_customer_customer_user
         [9 ] oro_tracking.processor.data
         [10] oro_account.add_or_replace
         [11] oro_pricing_product_price.add_or_replace
         [12] oro_pricing_product_price.reset
         [13] oro_pricing_product_price_attribute_price.add_or_replace
         [14] oro_pricing_product_price_attribute_price.reset
         [15] oro_sales_lead.add_or_replace
         [16] oro_sales_opportunity.add_or_replace
         [17] oro_sales_b2bcustomer
         [18] oro_magento.add_or_update_newsletter_subscriber
         [19] oro_magento.add_or_update_customer
         [20] oro_magento.import_guest_customer
         [21] oro_magento.add_or_update_customer_address
         [22] oro_magento.add_or_update_region
         [23] oro_magento.add_or_update_cart
         [24] oro_magento.add_or_update_order
         [25] oro_magento.order_context
         [26] oro_magento.credit_memo_context
         [27] oro_magento.store
         [28] oro_magento.website
         [29] oro_magento.customer_group
         [30] oro_magento.add_or_update_credit_memo
         [31] oro_magento.add_or_update_credit_memo_with_existing_order
         [32] oro_tax_tax_rule
         [33] oro_tax_tax
         [34] oro_inventory.inventory_level
         [35] oro_promotion_coupon_import
         [36] oro_ldap_user_import
          3
    Choose Job:
         [0 ] language_translations_import_from_csv
         [1 ] entity_fields_import_from_csv
         [2 ] attribute_import_from_csv
         [3 ] entity_import_from_csv
         [4 ] import_log_to_database
         [5 ] import_request_to_database
         [6 ] price_list_product_prices_entity_import_from_csv
         [7 ] price_attribute_product_price_import_from_csv
         [8 ] mage_customer_import
         [9 ] mage_customer_load_customer_info
         [10] mage_region_import
         [11] mage_order_import
         [12] mage_order_import_post_process_customers_and_info
         [13] mage_credit_memo_import
         [14] mage_credit_memo_post_process_orders_and_info
         [15] mage_cart_import
         [16] mage_cart_import_post_process_customers
         [17] mage_newsletter_subscriber_import
         [18] mage_newsletter_subscriber_import_initial
         [19] mage_newsletter_subscriber_post_process_customers
         [20] mage_store_import
         [21] mage_store_rest_import
         [22] mage_website_import
         [23] mage_website_rest_import
         [24] mage_customer_group_import
         [25] zendesk_user_import
         [26] zendesk_ticket_import
         [27] zendesk_ticket_comment_import
         [28] dotmailer_address_book_import
         [29] dotmailer_campaign_import
         [30] dotmailer_unsubscribed_contact_import
         [31] dotmailer_new_contacts
         [32] dotmailer_activity_contact_import
         [33] dotmailer_campaign_click_import
         [34] dotmailer_campaign_open_import
         [35] dotmailer_campaign_summary_import
         [36] dotmailer_import_not_exported_contact
         [37] dotmailer_contact_export
         [38] dotmailer_datafield_import
         [39] ldap_import_users
          3
     Scheduled successfully.


Perform Import in the Prod Environment
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The default environment for CLI is dev. In dev environment the application stores lots of data generally not required for real-life usage.
Therefore, it is recommended to run import in prod environment so it would finish much faster. To do so you should add
the ``--env=prod`` option to your import command:

.. code-block:: bash
   :linenos:

    $ php bin/console oro:import:file ~/Contact_2000.csv --env=prod


Skip Import File Validation
~~~~~~~~~~~~~~~~~~~~~~~~~~~

During regular import operation, the validation process is performed twice: first, during the validation itself and then
before saving imported entities (invalid entities will not be saved to the DB). Initial validation can be skipped and
import can be performed without it. To do so, start the import command in no interaction mode with the ``--no-interaction`` option:

.. code-block:: bash
   :linenos:

    $ php bin/console oro:import:file ~/Contact_2000.csv --processor=oro_contact.add_or_replace --jobName=entity_import_from_csv --no-interaction --env=prod

    Scheduled successfully.

.. hint::

    This trick can be very useful if you need to perform import on regular basis (e.g. by cron using external source).


Disable Optional Listeners
~~~~~~~~~~~~~~~~~~~~~~~~~~

With OroPlatform you can disable some event listeners for the command execution. The ``oro:platform:optional-listeners``
command shows the list of all such listeners:

.. code-block:: bash
   :linenos:

    $ bin/console oro:platform:optional-listeners
    List of optional listeners:
     > oro_website_search.reindex_request.listener
     > oro_website.indexation_request_listener
     > oro_product.event_listener.product_image_resize_listener
     > oro_pricing.entity_listener.product_price_cpl
     > oro_pricing.entity_listener.price_list_to_product
     > oro_magento.event_listener.delayed_search_reindex
     > oro_workflow.event_listener.send_workflow_step_changes_to_audit
     > oro_workflow.listener.workflow_transition_record
     > oro_visibility.entity.entity_listener.customer_listener
     > oro_pricing.entity_listener.price_list_currency
     > oro_email.listener.entity_listener
     > oro_entity.event_listener.entity_modify_created_updated_properties_listener
     > oro_notification.doctrine.event.listener
     > oro_dataaudit.listener.send_changed_entities_to_message_queue
     > oro_search.index_listener
     > oro_workflow.listener.event_trigger_collector
     > oro_calendar.listener.calendar_event_attendees
     > oro_commerce_entity.event_listener.doctrine_post_flush_listener
     > oro_redirect.event_listener.slug_prototype_change
     > oro_redirect.event_listener.slug_change
     > oro_marketing_list.event_listener.on_entity_change
     > oro_sales.customers.customer_association_listener
     > oro_dotmailer.listener.mapping_update
     > oro_dotmailer.listener.entity_update

To disable these listeners the ``--disabled-listeners`` option can be used. Also this option can receive value "all" -
it will disable all optional listeners. Here is an example:

.. code-block:: bash
   :linenos:

    $ bin/console oro:import:file ~/Contact_2000.csv --processor=oro_contact.add_or_replace --jobName=entity_import_from_csv --disabled-listeners=all --no-interaction --env=prod

    Scheduled successfully.

.. caution::

    Remember that disabling listeners actually disables a part of backend functionality, so before using it
    make sure this part is not required. E.g. if the ``oro_search.index_listener`` listener is disabled then
    imported entities will not be found by the search engine (however, this may be fixed by manual search reindex
    using the ``oro:search:reindex`` command).


Write Custom Import Strategy
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

OroPlatform provides :class:`Oro\\Bundle\\ImportExportBundle\\Strategy\\Import\\ConfigurableAddOrReplaceStrategy`
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


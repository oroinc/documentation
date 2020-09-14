.. _cloud-maintenance-mq:

MessageQueue Configuration in OroCloud
======================================

Message queues enable asynchronous processing of Oro application data. This means that the application is able to process data in the background without affecting user experience. Here are some examples of the message queue processing used in OroCommerce:

* import/export operations
* data audit
* integration with external systems (e.g., ERP)
* image resize

Your customized application can use message processing for many other reasons, and exact details depend on the implementation.

Message processing operates with the following entities:

* **Message** -- the minimal piece of data processed by a consumer. Consists of the topic and the body. Message topic is used by the message processor to decide how to process a message and the message body consists of data that must be processed.

* **Message Queue** -- the queue that holds messages until they are processed. Oro uses FIFO queue which means that the oldest messages are processed first while the newest must wait until older messages are processed and leave the queue.

* **Consumer** -- a component which takes messages from the queue and process it one by one. Consumer processes one message at a time. It creates a specific processing job depending on the message topic.

OroCommerce uses RabbitMQ as a message broker which is a server responsible for managing message queues and transferring messages to the consumers. In OroCloud, consumers are hosted at the dedicated job servers and each message queue is processed by 4 consumers at each job server in order to provide high availability.

Default Configuration and Optimization
--------------------------------------

While it is possible to use many Oro application is configured to run 4 default message queues:

* ``oro.index``
* ``oro.integration``
* ``oro.system``
* ``oro.default``

The production configuration may require more than 4 queues and the exact solution depends on the nature of your messages and details of implementation.

As it was mentioned above, message queue processes messages one at a time so some messages can require longer processing which means that other messages could stay in the queue for too long. Long processing time can be caused by:

* reindexing operations caused by mass import
* image resizing
* slow response from the external systems like ERP, email servers, etc.
* data audit requests can take considerable time to complete

Adding extra queues can help fix issues caused by slow message processing. Messages can be sorted to the different queues using their topic string. A single queue can contain messages with topics matching one or more routing keys.

There are 2 main strategies when adding extra queues to the Oro application:

A. Move slow messages to the dedicated queue so these messages do not interfere with others.
B. Move high priority messages to the dedicated queue so these messages do not wait for other messages with lower priority to be processed.

The exact configuration of the queues depends on the nature and the number of messages processed by the application. The number of queues is limited by the capacity of job servers since addition of one queue causes the addition of four consumers and increases the CPU and RAM utilization.

MQ Configuration Update
-----------------------

RabbitMQ is configured by OroCloud support which means that queue reconfiguration is done by submitting a ticket to the OroCloud Service Desk Portal. This ticket must provide clear information about the requested reconfiguration:

1. The routing key strings.
2. The target queue name for each routing key.
3. Whether this is a new or an existing queue.

Please take into account that queue reconfiguration needs message queue restart, which means that all existing messages in the queues will be lost the moment the queue is restarted. In addition, the new queue configuration can affect the overall system performance. That is why Oro recommends testing the new configuration at the stage environment, and performs production reconfiguration after the customer approval and outside of the business time of the application.

Default Topic Mapping
---------------------

Below is the topic mapping for default queues configuration.

* ``oro.index`` queue manages topics:

  * oro.data_audit.entities_changed
  * oro.data_audit.entities_relations_changed
  * oro.data_audit.entities_inversed_relations_changed
  * oro.search.index_entity
  * oro.search.index_entities
  * oro.search.index_entity_type
  * oro.search.index_entity_by_range
  * oro.search.reindex
  * oro_territory.update.territory_definition
  * oro_territory.update.entity_territory
  * oro_territory.update.top_territory
  * oro.website.search.indexer.save
  * oro.website.search.indexer.delete
  * oro.website.search.indexer.reset_index
  * oro.website.search.indexer.reindex
  * oro.website.search.indexer.reindex_granulized
  * oro.redirect.generate_direct_url.entity
  * oro.redirect.job.generate_direct_url.entity
  * oro.redirect.regenerate_direct_url.entity_type
  * oro.redirect.generate_slug_redirects
  * oro.redirect.remove_direct_url.entity_type
  * oro.redirect.calculate_cache.mass
  * oro.redirect.calculate_cache
  * oro.redirect.calculate_cache.process_job
  * oro.web_catalog.calculate_cache
  * oro.web_catalog.calculate_cache.content_node
  * oro.web_catalog.calculate_cache.content_node_tree
  * oro_web_catalog.resolve_node_slugs
  * imageResize
  * oro_product.reindex_product_collection_by_segment
  * oro_product.reindex_products_by_attribute
  * oro_multiwebsite.visibility.build_website_cache
  * oro_marketing_list.message_queue.job.update_marketing_list
  * oro_visibility.visibility.resolve_product_visibility
  * oro_visibility.visibility.change_category_visibility
  * oro_visibility.visibility.change_product_category
  * oro_visibility.visibility.category_remove
  * oro_visibility.visibility.category_position_change
  * oro_visibility.visibility.change_customer
  * oro.channel.aggregate_lifetime_average
  * oro.analytics.calculate_channel_analytics
  * oro.analytics.calculate_all_channels_analytics
  * oro_pricing.price_rule.build
  * oro_pricing.price_lists.resolve_assigned_products
  * oro_pricing.price_lists.cpl.rebuild
  * oro_pricing.price_lists.cpl.resolve_currencies
  * oro_pricing.price_lists.cpl.resolve_prices
  * oro.seo.generate_sitemap
  * oro.seo.generate_sitemap_index_by_website
  * oro.seo.generate_sitemap_by_website_and_type

* ``oro.integration`` queue manages topics:

  * oro_email.migrate_email_body
  * oro.datagrid.pre_export
  * oro.datagrid.export
  * oro.integration.sync_integration
  * oro.integration.revers_sync_integration
  * oro.importexport.pre_export
  * oro.importexport.export
  * oro.importexport.post_export
  * oro.importexport.pre_import
  * oro.importexport.pre_http_import
  * oro.importexport.import
  * oro.importexport.http_import
  * oro.importexport.send_import_notification
  * oro.importexport.save_import_export_result
  * oro.imap.clear_inactive_mailbox
  * oro.imap.sync_email
  * oro.imap.sync_emails
  * oro.workflow.execute_process_job
  * oro.channel.channel_status_changed

* ``oro.system`` queue manages topics:

  * oro.message_queue.job.calculate_root_job_status
  * oro.message_queue.job.root_job_stopped
  * oro_message_queue.route_message
  * oro.cron.run_command
  * oro.cron.run_command.delayed
  * oro.translation.dump_js_translations
  * oro_entity_config.attribute_was_removed_from_family
  * oro_message_queue.transition_trigger_event_message
  * oro_message_queue.transition_trigger_cron_message

* ``oro.default`` manages all other topics.







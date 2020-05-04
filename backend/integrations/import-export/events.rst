.. _dev-integrations-import-export-events:

Events
======

All events are available in the Oro\Bundle\ImportExportBundle\Event\Events class.

`AFTER_ENTITY_PAGE_LOADED`

This event occurs after the entity page is loaded in the iterator. It is used to modify rows.

`BEFORE_NORMALIZE_ENTITY`

This event occurs before the entity is normalized. It is used to change the entity data or prefill the normalized data before normalization.

`AFTER_NORMALIZE_ENTITY`

This event occurs after the entity is normalized. It is used to change the normalized data.

`BEFORE_DENORMALIZE_ENTITY`

This event occurs before the entity is denormalized. It is used to prefill the denormalized data.

`AFTER_DENORMALIZE_ENTITY`

This event occurs after the entity is denormalized. It is used to change the denormalized data.

`AFTER_LOAD_ENTITY_RULES_AND_BACKEND_HEADERS`

This event occurs after the rules and backend headers are loaded. It is used to modify the rules and headers, and add new ones.

`AFTER_LOAD_TEMPLATE_FIXTURES`

This event occurs after the template fixtures are loaded. It is used to modify the fixtures.

`BEFORE_EXPORT_FORMAT_CONVERSION`

This event occurs before the data is converted into the export format. It is used to modify the record before the conversion begins.

`AFTER_EXPORT_FORMAT_CONVERSION`

This event occurs after the data is converted into the export format. It is used to modify the result after the conversion ends.

`BEFORE_IMPORT_FORMAT_CONVERSION`

This event occurs before the data is converted into the import format. It is used to modify the record before the conversion begins.

`AFTER_IMPORT_FORMAT_CONVERSION`

This event occurs after the data is converted into the export format. It is used to modify the result after the conversion ends.

`AFTER_JOB_EXECUTION`

This event occurs after a job is processed. It is used to perform some actions after the job is processed. For example, clean cache.

Strategy Events
---------------

All strategy events are available in the Oro\Bundle\ImportExportBundle\Event\StrategyEvent class.

**Usage Example:**

.. code-block:: php
   :linenos:

    use Symfony\Component\EventDispatcher\EventSubscriberInterface;
    use Oro\Bundle\ImportExportBundle\Event\StrategyEvent;

    class CustomImportExportSubscriber implements EventSubscriberInterface {
        public static function getSubscribedEvents()
        {
            return [
                StrategyEvent::PROCESS_BEFORE => 'beforeImportStrategy',
                StrategyEvent::PROCESS_AFTER => 'afterImportStrategy',
            ];
        }

        public function beforeImportStrategy(StrategyEvent $event)
        {
            //YOUR IMPLEMENTATION
        }

        public function afterImportStrategy(StrategyEvent $event)
        {
            //YOUR IMPLEMENTATION
        }
    }


`PROCESS_BEFORE`

This event occurs just before the entity strategy is run. It is used to prepare the entity before it is processed by the strategy.

`PROCESS_AFTER`

This event occurs after the job of the entity strategy is finished. It is used to provide additional validation of the entity.

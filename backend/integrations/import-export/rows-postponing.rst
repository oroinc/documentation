.. _dev-integrations-import-export-postponing-rows:

Postponing Rows
===============

When the data from one row in the import file depends on the data in another row (for example, a subsidiary Customer that has another headquarters Customer as a parent), it is critical to process the parent row first and proceed with importing the dependent row afterward. You can analyze the import file and track this kind of dependencies. You can postpone processing the row that precedes the data it depends on by adding the following logics in the Strategy or Strategy Event.

Class ``Oro\Bundle\ImportExportBundle\Handler\PostponedRowsHandler`` writes all postponed entries to a file and creates a retry job for processing. Postponed rows are automatically re-routed to the ``ImportMessageProcessor``. The number of retries is limited to 30 by default. Postponed rows are processed with a delay of 5 seconds, this number can be changed by setting ``postponedDelay``  in the job context.

Postponing in Strategy
----------------------

Example of usage:

.. code-block:: php


    class CustomAddOrReplaceStrategy extends ConfigurableAddOrReplaceStrategy
    {
            #[\Override]
            protected function beforeProcessEntity($entity)
            {
                $entity = parent::beforeProcessEntity($entity);

                if ($this->shouldBePostponed($entity)) {
                    $this->context->addPostponedRow($this->context->getValue('rawItemData'));

                    return null;
                }

                return $entity;
            }

            // Rest of your code here
            // ...
    }

Postponing in Strategy Event
----------------------------

Example of usage:

.. code-block:: php


    class CustomerTaxCodeImportExportSubscriber implements EventSubscriberInterface
    {
        #[\Override]
        public static function getSubscribedEvents()
        {
            return [
                StrategyEvent::PROCESS_AFTER => ['afterImportStrategy', -255],
            ];
        }

        public function afterImportStrategy(StrategyEvent $event)
        {
            $event->getContext()->addPostponedRow(
                $event->getContext()->getValue('rawItemData')
            );
        }
    }


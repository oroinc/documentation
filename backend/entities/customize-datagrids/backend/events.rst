.. _customize-datagrids-events:

Events
======

Events List
-----------

Datagrids in Oro applications are highly customizable. For example, you can modify an existing grid to fetch more data than its configuration initially defines.
The ``build`` and ``result`` events provide these extendability points.

Build Events
------------

The ``Builder`` class dispatches build events right before and immediately after it processes the configuration and builds the datasource. Use them to modify the datagrid or a query configuration.

Four events are dispatched during the build process:

* Class ``BuildBefore``, event name: ``oro_datagrid.datagrid.build.before``
* Class ``BuildBefore``, event name: ``oro_datagrid.datagrid.build.before.DATAGRID_NAME``
* Class ``BuildAfter``, event name: ``oro_datagrid.datagrid.build.after``
* Class ``BuildAfter``, event name: ``oro_datagrid.datagrid.build.after.DATAGRID_NAME``

BuildBefore Events
^^^^^^^^^^^^^^^^^^

In your event listener, add new elements to the grid configuration or modify the existing configuration.
Use the generic ``build.before`` event to listen to all datagrids, or ``build.before.DATAGRID_NAME`` to listen to a specific one.

The ``BuildBefore`` event class has access to the |DatagridConfiguration| instance.

.. hint::
        Please note that at this point datasource has not been initialized yet, therefore calling ``$event->getDatagrid()->getDatasource()`` returns ``null``.

For example, to add one more column to a specific datagrid, create an event listener and modify the existing configuration:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\EventListener\Datagrid;

    use Oro\Bundle\DataGridBundle\Event\BuildBefore;

    class AdditionalColumnDatagridListener
    {
        /**
         * @param BuildBefore $event
         * @return void
         */
        public function onBuildBefore(BuildBefore $event): void
        {
            $config = $event->getConfig();
            $config->offsetSetByPath('[columns][myCustomColumn]', ['label' => 'acme.demo.my_custom_column.label']);
            $config->offsetAddToArrayByPath('[source][query][select]', ['123 as myCustomColumn']);
        }
    }


Once the listener is created, register it in ``services.yml``:

.. code-block:: yaml


    acme_demo.event_listener.datagrid.additional_column:
        class: Acme\Bundle\DemoBundle\EventListener\Datagrid\AdditionalColumnDatagridListener
        tags:
            - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.before.DATAGRID_NAME, method: onBuildBefore }

**Use Cases**

* Add additional columns and update query configuration for the translation datagrid: ``Oro\Bundle\TranslationBundle\EventListener\Datagrid\LanguageListener``
* Remove ``public`` column from the system calendar datagrid: ``Oro\Bundle\CalendarBundle\EventListener\Datagrid\SystemCalendarGridListener``
* (OroCommerce) Bind user's currency parameter to the checkout grid: ``Oro\Bundle\CheckoutBundle\Datagrid\CheckoutGridListener``

BuildAfter Events
^^^^^^^^^^^^^^^^^

These events let you modify the datasource or even the whole datagrid instance. Most commonly, you use them to modify the query (add joins, selects, the ``where`` conditions, and so on).

Use the generic ``build.after`` event to listen to all datagrids, or ``build.after.DATAGRID_NAME`` to listen to a specific one.

The ``BuildAfter`` event class has access to |Datagrid| instance.

For example, to filter the datagrid by a particular value from the request params, create an event listener and modify the query builder:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\EventListener\Datagrid;

    use Oro\Bundle\DataGridBundle\Datasource\Orm\OrmDatasource;
    use Oro\Bundle\DataGridBundle\Event\BuildAfter;
    use Symfony\Component\HttpFoundation\RequestStack;

    class FilterByRequestParamListener
    {
        protected RequestStack $requestStack;

        /**
         * @param RequestStack $requestStack
         */
        public function __construct(RequestStack $requestStack) {
            $this->requestStack = $requestStack;
        }

        /**
         * @param BuildAfter $event
         * @return void
         */
        public function onBuildAfter(BuildAfter $event): void
        {
            $datasource = $event->getDatagrid()->getDatasource();
            if (!$datasource instanceof OrmDatasource) {
                return;
            }

            $customFilter = $this->requestStack->getCurrentRequest()->get('custom_filter');

            $queryBuilder = $datasource->getQueryBuilder();
            $queryBuilder->andWhere($queryBuilder->expr()->eq('some_column', ':custom_filter'));
            $queryBuilder->setParameter('custom_filter', $customFilter);
        }
    }


Please note that this example works only for ORM datasources.

Once the listener is created, register it in ``services.yml``:

.. code-block:: yaml

    acme_demo.event_listener.datagrid.filter_by_request_param:
    class: Acme\Bundle\DemoBundle\EventListener\Datagrid\FilterByRequestParamListener
    arguments:
        - '@request_stack'
    tags:
        - { name: kernel.event_listener, event: oro_datagrid.datagrid.build.after.DATAGRID_NAME, method: onBuildAfter }


**Use Cases**

* Apply additional filtering to the activity email grid: ``Oro\Bundle\EmailBundle\EventListener\Datagrid\ActivityGridListener``
* (OroCommerce) Add additional properties to the storefront product grid: ``Oro\Bundle\CatalogBundle\EventListener\SearchCategoryFilteringEventListener``

Result Events
-------------

Result events are type-specific, so the ``datasource`` dispatches them.
Listen to these events when you need to access a query (e.g., ORM, search) or modify the results.

For example, the |OrmDatasource| dispatches 4 main and 2 additional events in its ``getResult()`` method:

* Additional - Class ``OrmResultBeforeQuery``, event name: ``oro_datagrid.orm_datasource.result.before_query``
* Additional - Class ``OrmResultBeforeQuery``, event name: ``oro_datagrid.orm_datasource.result.before_query.DATAGRID_NAME``
* Main - Class ``OrmResultBefore``, event name: ``oro_datagrid.orm_datasource.result.before``
* Main - Class ``OrmResultBefore``, event name: ``oro_datagrid.orm_datasource.result.before.DATAGRID_NAME``
* Main - Class ``OrmResultAfter``, event name: ``oro_datagrid.orm_datasource.result.after``
* Main - Class ``OrmResultAfter``, event name: ``oro_datagrid.orm_datasource.result.after.DATAGRID_NAME``

The first four events mostly access a query at different stages, while the last two modify the results.

Remember to dispatch result events when creating your own :ref:`custom datasource type <customize--datagrids-datasource-custom-types>`.

ResultBefore Events
^^^^^^^^^^^^^^^^^^^

These events access the datagrid or a query instance before the datasource starts building the results.
Use the generic ``result.before`` event to listen to all datagrids, or ``result.before.DATAGRID_NAME`` to listen to a specific one.

**Use Cases**

* Apply ACL to a datagrid datasource: ``Oro\Bundle\DataGridBundle\EventListener\OrmDatasourceAclListener``

ResultAfter Events
^^^^^^^^^^^^^^^^^^

These events modify data after the rows are fetched from the ``datasource``.
Use the generic ``result.after`` event to listen to all datagrids, or ``result.after.DATAGRID_NAME`` to listen to a specific one.

For example, if you have complex data that is hard to process with the standard datagrid configuration in YML files,
create an event listener and fetch the data once the rows are fetched from the ``datasource``.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\EventListener\Datagrid;

    use Oro\Bundle\DataGridBundle\Datasource\ResultRecord;
    use Oro\Bundle\DataGridBundle\Event\OrmResultAfter;

    class ComplexDataDatagridListener
    {
        /**
         * @param OrmResultAfter $event
         * @return void
         */
        public function onResultAfter(OrmResultAfter $event): void
        {
            /** @var ResultRecord[] $records */
            $records = $event->getRecords();

            $complexData = $this->complexService->getComplexDataForRecords($records);

            foreach ($records as $record) {
                $recordId = $record->getValue('id');
                $record->addData(['complexData' => $complexData[$recordId]]);
            }
        }
    }


Once the event listener is created, register it in ``services.yml``:

.. code-block:: yaml

    acme_demo.event_listener.datagrid.complex_data:
        class: Acme\Bundle\DemoBundle\EventListener\Datagrid\ComplexDataDatagridListener
        tags:
            - { name: kernel.event_listener, event: oro_datagrid.orm_datasource.result.after.DATAGRID_NAME, method: onResultAfter }


**Use Cases**

* Translate workflow fields in the email notification grid: ``Oro\Bundle\WorkflowBundle\Datagrid\EmailNotificationDatagridListener``
* (OroCommerce) Add payment methods to the order grid: ``Oro\Bundle\OrderBundle\EventListener\OrderDatagridListener``

.. include:: /include/include-links-dev.rst
   :start-after: begin
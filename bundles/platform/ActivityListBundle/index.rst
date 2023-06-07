.. _bundle-docs-platform-activity-list-bundle:

OroActivityListBundle
=====================

|OroActivityListBundle| adds a widget to the entity view page. The widget displays a list of activities related to the entity record in chronological order. It also enables widget configuration in the system configuration section.

You can add the following activities to other entities:

- Call
- Task
- Email
- Calendar event
- Notes

Visualization of the Activity list is defined as a widget block. It shows activities related to the entity record currently being viewed in a single list, with the ability to filter it by activity type (*multiselect*) and date (*daterange* filter).

Each activity row shows basic information: the activity type, who and when created, and updated it. You can also access the full activity record with the help of the "expand" action. By default, it displays 10 records, sorted by the Update date in descending order. You can change limitation and sorting in the UI :ref:`via system configuration <bundle-docs-platform-activity-list-bundle-configuration>`.

The widget is currently displayed in the *Activities* placeholder block on the view page of an entity.

The following screenshot is an example of a widget on a contact page:

.. image:: /img/bundles/ActivityListBundle/activities-widget-example.png
   :alt: An example of a widget

Add Widget to a Page
--------------------

A widget is usually rendered in the *view_content_data_activities* placeholder. However, if you need to extend it or use a view template different from ``@OroUI/actions/view.html.twig``, you have to define a placeholder in it. For example:

.. code-block:: none

      {%- set activitiesData -%}
        {% placeholder view_content_data_activities with {entity: entity} %}
      {%- endset -%}
      {% set dataBlocks = dataBlocks|merge([{
        'title': 'Title',
        'subblocks': [{
            'spanClass': 'empty',
            'data': [activitiesData]
        }]
      }]) %}

Show Widget and its Button on a Specific Page
---------------------------------------------

Set entity annotation to show a widget and its button on specific pages.

The widget can be displayed on `view` and/or `update` pages. The list of allowed values is available in ``\Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope``, for example:

.. code-block:: none

    /**
    ...
     * @Config(
     *      defaultValues={
     *          ...
     *          "activity"={
     *              "show_on_page"="\Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope::UPDATE_PAGE"
     *          }
     *          ...
     *      }
     * )
     */
    class CustomerUserRole extends AbstractRole { ... }

Register a New Entity
---------------------

To add a new entity to be displayed within a widget, register a service that implements **ActivityListProviderInterface** and tag it as **oro_activity_list.provider**. A working example of this is available in EmailBundle or CalendarBundle, for example:

.. code-block:: none

    oro_calendar.activity_list.provider:
        class: Oro\Bundle\CalendarBundle\Provider\CalendarEventActivityListProvider
        arguments:
           - '@oro_entity.doctrine_helper'
           - '@doctrine'
        tags:
           - { name: oro_activity_list.provider, class: Oro\Bundle\CalendarBundle\Entity\CalendarEvent, priority: 50 }

This will add your provider class into providers (**ActivityListChainProvider**) that will be invoked to fetch data ordering by priority (added in service definition). Priority is helpful for future implementations or when you override existing providers in third-party bundles.

Each activity entity has its own row template for the UI component. Although you can place it anywhere you want, make sure its path is returned in the Provider via the getTemplate() method. For instance:

.. code-block:: none

    class CalendarEventActivityListProvider implements ActivityListProviderInterface
    {
    ...
    /**
    * {@inheritdoc}
    */
    public function getTemplate()
    {
       return '@OroCalendar/CalendarEvent/js/activityItemTemplate.html.twig';
    }
    ...

.. _bundle-docs-platform-activity-list-bundle-configuration:

Change Sorting and Limitation in Configuration
----------------------------------------------

You can change sorting and limitation in the UI under **System > Configuration > Display Settings > Activity Lists**.

+---------------------------+--------------------------------------------------------------------------------------------------------------------+
| Option                    | Description                                                                                                        |
+===========================+====================================================================================================================+
| Sort By Field             | Sorts activity records by the date when they were created or by the date when they were updated for the last time. |
+---------------------------+--------------------------------------------------------------------------------------------------------------------+
| Sort Direction            | Sorts records in the ascending or descending direction.                                                            |
+---------------------------+--------------------------------------------------------------------------------------------------------------------+
| Items Per Page By Default | Sets how many records appear on one page of the Activity section grids.                                            |
+---------------------------+--------------------------------------------------------------------------------------------------------------------+

.. image:: /img/bundles/ActivityListBundle/activity-lists-configuration.png
   :alt: Activity list global configuration

Configure Permissions
---------------------

Each activity entity must contain a provider (for example, *EmailActivityListProvider*) with the implemented *ActivityListProviderInterface* interface. The *ActivityList::getActivityOwners* method returns one or many ActivityOwner entities, which are connected to their activity list entity.

Filter Activities in Segments
-----------------------------

ActivityListBundle extends OroSegmentBundle  with the Activity filter type.

This filter can be used to filter records if they:

* have an activity with a value in the field (e.g., a Contact who has an activity "Email" where the subject of the email contains text "Re:")
* do not have an activity with a value in the field (e.g., Contact who does not have activity "Email" where the subject of the email contains text "Meeting")

If you select only one activity type in the filter, you can filter based on any field of the activity.

If you select more than one activity type in the filter, you can filter based on fields "updatedAt", "createdAt" of the selected activities.

.. image:: /img/bundles/ActivityListBundle/activity-in-segment-filters.png
   :alt: Activity widget in segment's filters

.. _bundle-docs-platform-activity-list-bundle-inheritance:

Add Inheritance of Activity Lists to the Target Entity
------------------------------------------------------

You can add inheritance of activity lists to the target entity from some related inheritance target entities.

It means that in target entities, you can see all activity list from the general entity and related entities.

To enable this option, configure the target entity to identify all inheritance target entities: use migration extension to add all necessary configurations to the entity config.

The following is an example of the migration to enable the display of contact activity lists in the appropriate account:

.. code-block:: none

    class InheritanceActivityTargets implements Migration, ActivityListExtensionAwareInterface
    {
        /** @var ActivityListExtension */
        protected $activityListExtension;

        /** {@inheritdoc} */
        public function setActivityListExtension(ActivityListExtension $activityListExtension)
        {
            $this->activityListExtension = $activityListExtension;
        }

        /** {@inheritdoc} */
        public function up(Schema $schema, QueryBag $queries)
        {
            $activityListExtension->addInheritanceTargets($schema, 'orocrm_account', 'orocrm_contact', ['accounts']);
        }
    }

Method parameters:

* addInheritanceTargets(Schema $schema, $targetTableName, $inheritanceTableName, $path)
* string $targetTableName - Target entity table name
* string $inheritanceTableName - Inheritance entity table name
* string[] $path - Path of relations to target entity


.. include:: /include/include-links-dev.rst
   :start-after: begin
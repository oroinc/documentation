.. _bundle-docs-crm-activity-contact-bundle:

OroActivityContactBundle
========================

|OroActivityContactBundle| enables tracking of attempts to contact customers in OroCRM applications.

The bundle allows developers to register activity as contact activity. These logged activities are used during the contact attempts calculation and allow admin users to see contact attempts statistics for entities where contact activities are enabled.

Out-of-the-box, the bundle registers calls and emails as contact activities.

General
-------

The bundle introduces a `contacting activity`. This can be a call or an email from a client or a sales manager. When a client sends an email or calls a manager, this is an incoming activity. When a manager sends an email or calls a client, the activity is outgoing.

Bundle Responsibility
---------------------

- Gather statistics of contacting activities
- Determine the activity direction
- Detect the last date/time of the incoming/outgoing activities
- Show calculated data in the `Record Activities` block
- Recalculate activities

Relate Activity Entity to the Contacting Activities Type
--------------------------------------------------------

Create a provider that implements |DirectionProviderInterface| and make it a tagged service, for example:

.. code-block:: none

    tags:
        - { name: oro_activity_direction.provider, class: Acme\Bundle\DemoBundle\Entity\MyActivity }

Install and Update Features
---------------------------

On application install or during the update from the previous version:

- via |ActivityContactMigrationQuery| required fields (for statistics storage) will be added for entities with enabled "Call" & "Email" activities
- job will be added to execute |oro:activity-contact:recalculate| command. Recalculation of existing activities.

Please note:

- if cron is not configured, manually run job daemon via the UI or execute the command from the console.
- The command's responsibility is to check entities for which contacting activities (Call & Email) are enabled and recalculate contacting activities per each record of entities.

Entity Management
-----------------

On enabling any contacting activity for an entity via entity management, during the "Schema Update" procedure, they will be added automatically if the entity does not have a statistics field.

Please note:

- those fields are regular custom fields but with READ_ONLY mode
- they can NOT be deleted via the UI by any user
- even on disabling all contacting activities, the fields remain
- by default, fields are disabled on view, edit, and grid pages, but they can be enabled via the UI (exercise caution)

Reports and Segments
--------------------

Because statistics fields are regular custom fields, customers can build any report/segment with such fields without any restrictions or unpredictable cases.

- Even after disabling activity features for an entity, all reports/segments based on such entity will work the same way.

.. include:: /include/include-links-dev.rst
   :start-after: begin

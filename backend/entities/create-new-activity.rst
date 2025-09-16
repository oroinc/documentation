.. _backend-make-entity-activities:

Turn an Entity into an Activity
===============================

To create an activity from your new entity, make the entity extended and include it in the `activity` group.

To make the entity extended, implement the ExtendEntityInterface using the ExtendEntityTrait. The class must also implement |ActivityInterface|.

Here is an example:

.. oro_integrity_check:: 4f0d2da7fe29e5d24cd7022f64f0465542b984be

   .. literalinclude:: /code_examples/commerce/demo/Entity/Sms.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Sms.php
       :language: php
       :lines: 6-7, 12-13, 16, 47, 50-52, 55-57, 115

Use this class as the superclass for your entity. To include the entity in the `activity` group, use the ORO entity configuration, for example:

.. oro_integrity_check:: 91efeee6669cc3888532f27da461c91762424547

   .. literalinclude:: /code_examples/commerce/demo/Entity/Sms.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Sms.php
       :language: php
       :lines: 22, 27, 38, 45-46, 47, 50-52, 57, 115

Your entity is now recognized as the activity entity. To make sure that the activity is displayed correctly, you need to configure its UI.

.. _backend-make-entity-activities-working-with-activity-associations:

Working with Activity Associations
----------------------------------

Activity associations are represented by :ref:`multiple many-to-many <book-entities-extended-entities-multi-target-associations-types>` associations.
It is quite a complex type of associations, and to help work with activities, use the |ActivityManager| class.

This class provides the following functionality:

* Check whether a specific type of entity has any activity associations.
* Check whether a specific type of entity can be associated with a specific activity.
* Get a list of entity types of all activity entities.
* Get the list of fields responsible for storing activity associations for a specific type of activity entity.
* Get a query builder that can be used for fetching a list of entities associated with a specific activity.
* Get a list of fields responsible for storing activity associations for a specific type of entity.
* Get a query builder that can be used to fetch a list of activity entities associated with a specific entity.
* Get an array that contains info about all activity associations for a specific type of entity.
* Get an array that contains info about all activity actions for a specific type of entity.
* Add a filter by a specific entity to a query builder that is used to get a list of activities.
* Associate an entity with an activity entity.
* Remove an association between an entity and an activity entity.

.. _backend-entity-activities-configure-ui:

Configure UI for the Activity Entity
------------------------------------

Before using the new activity entity within OroPlatform, you need to:

* `Configure UI for Activity List Section`_
* `Configure UI for an Activity Button`_

Take a look at |all configuration options| for the activity scope before reading further.

Configure UI for Activity List Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

First, create a new action in your controller and a TWIG template responsible for rendering the list of your activities.

Keep in mind that:

- The controller action must accept two parameters: `$entityClass` and `$entityId`.
- The entity class name can be encoded to avoid routing collisions. That is why you need to use the `oro_entity.routing_helper` service to get the entity by its class name and id.
- In the following example, the `activity-sms-grid` datagrid is used to render the list of activities. This grid is defined in the *datagrids.yml* file:

.. oro_integrity_check:: 2c8a62091565caa15dfcd2b5c5d7ec5f90b5877d

   .. literalinclude:: /code_examples/commerce/demo/Controller/SmsController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/SmsController.php
       :language: php
       :lines: 25-43


.. oro_integrity_check:: 2010a0bebda816961f23a8676dbd73b7a0303cd8

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Sms/activity.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Sms/activity.html.twig
       :language: html
       :lines: 1-8

.. oro_integrity_check:: 8590a84f0853be3e476f500ae8fd35dc6cadcb3c

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 567-568


Now, you need to bind the controller to your activity entity. Use ORO entity configuration, for example:

.. oro_integrity_check:: e807ff993f400108b2d9396f3db268e559de07eb

   .. literalinclude:: /code_examples/commerce/demo/Entity/Sms.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Sms.php
       :language: php
       :lines: 22, 27, 38-41, 44-47, 50-52, 57, 115


Please note that the example above contains the `route` attribute to specify the controller path and the `acl` attribute to set ACL restrictions.

Configure UI for an Activity Button
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an activity button to the view page of the entity with the assigned activity:

1. Create two TWIG templates responsible for rendering the button and the link in the dropdown menu. Please note that you should provide both templates because an action can be rendered either as a button or a link depending on the number of actions, UI theme, device (desktop/mobile), etc.

Here is an example of TWIG templates:

.. oro_integrity_check:: c99ce84b51fe328237771f2cb00ac39da9d6aa68

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Sms/activityButton.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Sms/activityButton.html.twig
       :language: html
       :lines: 1-30


.. oro_integrity_check:: cec7625ae67f48588d3e6916f9f70f02a45beea7

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Sms/activityLink.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Sms/activityLink.html.twig
       :language: html
       :lines: 1-30

2. Register these templates in *placeholders.yml*, for example:

.. oro_integrity_check:: 41153b3cb16a74698e17ff695131cf94967d01ee

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/placeholders.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/placeholders.yml
       :language: yaml
       :lines: 1-9

3. Bind the items declared in *placeholders.yml* to the activity entity using the `action_button_widget` and `action_link_widget` attributes, for example:

.. oro_integrity_check:: 4df292b91b0f5f7cec6211948b1027c5862330c0

   .. literalinclude:: /code_examples/commerce/demo/Entity/Sms.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Sms.php
       :language: php
       :lines: 22, 27, 38-47, 50-52, 57, 115

The following screenshot is an example of new activity from the view page:

.. image:: /img/bundles/ActivityListBundle/activities-create-new-activity.png
   :alt: Make an entity an activity


.. _backend-entity-activities-configure-custom-grid:

Configure Custom Grid for Activity Context Dialog
-------------------------------------------------

If you want to define a context grid for an entity (e.g., Document) in the activity context dialog, add the `context` option in the entity class `#[Config]` attribute, for example:

.. oro_integrity_check:: 2a2ff5e5ea4095e9701c6947f332cf1e710c78a7

   .. literalinclude:: /code_examples/commerce/demo/Entity/Document.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Document.php
       :language: php
       :lines: 22, 27, 32-35, 48-49

This option is used to recognize the grid for the entity with a higher priority than the `default` option.
If these options (`context` or `default`) are not defined for an entity, the grid does not appear in the context dialog.

Example configure custom grid for activity context dialog:

.. image:: /img/bundles/ActivityListBundle/activities-activity-list-add-context.png
   :alt: Configure custom grid for activity context dialog

.. _backend-entity-activities-enable-context-column:

Enable Contexts Column in Activity Entity Grids
-----------------------------------------------

You can add a column for any activity entity grid that includes all context entities.

Have a look at the following example of sms configuration in *datagrids.yml*:

.. oro_integrity_check:: 59aea41852814f6f51a467499ba36fc04dfd2e49

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 512, 515, 517-520


This configuration creates a column named `contexts` and tries to detect the activity class name automatically. If, for some reason, it fails, you can specify an FQCN in the `entity_name` option.

If you wish to configure the column, add a section with the name specified in the `column_name` option:

.. oro_integrity_check:: c89679c2e34d00c999347b1e41c97f0ec1829a84

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
       :language: yaml
       :lines: 1, 512, 538, 545-547


.. image:: /img/bundles/ActivityListBundle/activities-enable-context-column.png
   :alt: Enable contexts column in activity entity grids

The column type is `twig` (unchangeable), so you can also specify `template`.

The default one is |@OroActivity/Grid/Column/contexts.html.twig|.

.. code-block:: twig

    {% for item in value %}
        {% apply spaceless %}
            <span class="cell-context-item">
                <span class="context-icon {{ item.icon }}" aria-hidden="true"></span>
                {% if item.link %}
                    <a href="{{ item.link }}" class="context-label" title="{{ item.title }}">{{ item.title }}</a>
                {% else %}
                    <span class="context-label" title="{{ item.title }}">{{ item.title }}</span>
                {% endif %}
            </span>
        {% endapply %}
    {% endfor %}

.. _backend-create-new-activity-displayed-widget:

Add a New Entity to be Displayed within a Widget
------------------------------------------------

To add a new entity to be displayed within a widget, register a service that implements **ActivityListProviderInterface** and tag it as **oro_activity_list.provider**. A working example of this is available in EmailBundle or CalendarBundle, for example:

.. oro_integrity_check:: 89f10126d8ea65ae88002818ee0c7264f514f143

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
       :language: yaml
       :lines: 2, 80-88

This will add your provider class into providers (**ActivityListChainProvider**) that will be invoked to fetch data ordering by priority (added in service definition). Priority is helpful for future implementations or overriding existing providers in third-party bundles.

Each activity entity has its own row template for the UI component. Although you can place it anywhere, make sure its path is returned in the Provider via the getTemplate() method. For instance:

.. oro_integrity_check:: 9c58b781a610c60650325bf42a8155f37ab6db9d

   .. literalinclude:: /code_examples/commerce/demo/Provider/SmsActivityListProvider.php
       :caption: src/Acme/Bundle/DemoBundle/Provider/SmsActivityListProvider.php
       :language: php
       :lines: 3-197

Here is an example of TWIG templates:

.. oro_integrity_check:: 69cf8a4dcc5f1d665ff0a11df597d80b615b8c98

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Sms/js/activityItemTemplate.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Sms/js/activityItemTemplate.html.twig
       :language: none
       :lines: 1-65

Method getRoutes() returns an array of route names. You need to implement a functionality to display information on the specified routers.

.. image:: /img/bundles/ActivityListBundle/activities-activity-list.png
   :alt: New entity to be displayed within a widget

View an Activity in the Activity list
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create a view action in your controller and a TWIG template.

.. oro_integrity_check:: d6fb5992e7196d711edcbc9dead88605df5923e4

   .. literalinclude:: /code_examples/commerce/demo/Controller/SmsController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/SmsController.php
       :language: php
       :lines: 45-82

.. oro_integrity_check:: 55962f6c4d5a758a5a71678f08661ddbad4f86fc

   .. literalinclude:: /code_examples/commerce/demo/Resources/views/Sms/widget/info.html.twig
       :caption: src/Acme/Bundle/DemoBundle/Resources/views/Sms/widget/info.html.twig
       :language: html
       :lines: 1-23

Edit an Activity in the Activity List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Define the update action in your controller.

.. oro_integrity_check:: 0b3f382e655fc790b33f3b406dd0df9d7f8d8318

   .. literalinclude:: /code_examples/commerce/demo/Controller/SmsController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/SmsController.php
       :language: php
       :lines: 104-122

Delete an Activity in the Activity List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Example of implementing the deletion of an activity from an activity list on a page.

Create a controller. Here is an example of the controller:

.. oro_integrity_check:: 455ed06c4afdd60b65adc3289c9d4843e7c775a5

   .. literalinclude:: /code_examples/commerce/demo/Controller/Api/Rest/SmsController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/Api/Rest/SmsController.php
       :language: php
       :lines: 3-52

Register the created controller.

.. oro_integrity_check:: cb7f9cb729223514015d0b3ce5c82b28090cfb4d

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/routing.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/routing.yml
       :language: yaml
       :lines: 6-18

.. oro_integrity_check:: a26ef5ba95f77905a0773c00c28a2669bca19c5b

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/controllers_api.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/controllers_api.yml
       :language: yaml
       :lines: 1-9

.. oro_integrity_check:: 5f5bc858524ca8c673f78f337c533d4abb542e58

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/old_rest_api.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/old_rest_api.yml
       :language: yaml
       :lines: 1-18

This API handler is the implementation of REST API.

.. oro_integrity_check:: 4eca5d6516e7719bea432f00d6bde68c90fd2f0d

   .. literalinclude:: /code_examples/commerce/demo/Form/Handler/SmsApiHandler.php
       :caption: src/Acme/Bundle/DemoBundle/Form/Handler/SmsApiHandler.php
       :language: php
       :lines: 3-81

Create a form type to add the createdAt field.

.. oro_integrity_check:: 01f78905f786e4bbf0dd71d495ec2a8c9803b9e0

   .. literalinclude:: /code_examples/commerce/demo/Form/Type/SmsApiType.php
       :caption: src/Acme/Bundle/DemoBundle/Form/Type/SmsApiType.php
       :language: php
       :lines: 3-53


.. include:: /include/include-links-dev.rst
   :start-after: begin

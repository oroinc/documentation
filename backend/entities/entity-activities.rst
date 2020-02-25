.. _backend-entity-activities:

Entity Activities
=================

Enable Activity Association Using Migrations
--------------------------------------------

Usually, an administrator provides a predefined set of associations between the activity entity and other entities. You can also create this association type using migrations, if necessary.

The following example illustrates how to do it:

.. code-block:: php
    :linenos:

    <?php

    namespace Oro\Bundle\UserBundle\Migrations\Schema\v1_3;

    use Doctrine\DBAL\Schema\Schema;

    use Oro\Bundle\MigrationBundle\Migration\Migration;
    use Oro\Bundle\MigrationBundle\Migration\QueryBag;

    use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtension;
    use Oro\Bundle\ActivityBundle\Migration\Extension\ActivityExtensionAwareInterface;

    class OroUserBundle implements Migration, ActivityExtensionAwareInterface
    {
        /** @var ActivityExtension */
        protected $activityExtension;

        /**
         * {@inheritdoc}
         */
        public function setActivityExtension(ActivityExtension $activityExtension)
        {
            $this->activityExtension = $activityExtension;
        }

        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            self::addActivityAssociations($schema, $this->activityExtension);
        }

        /**
         * Enables Email activity for User entity
         *
         * @param Schema            $schema
         * @param ActivityExtension $activityExtension
         */
        public static function addActivityAssociations(Schema $schema, ActivityExtension $activityExtension)
        {
            $activityExtension->addActivityAssociation($schema, 'oro_email', 'oro_user', true);
        }
    }

.. _backend-make-entity-activities:

Make an Entity an Activity
--------------------------

To create an activity from your new entity, you need to make the entity extended and include in the `activity` group.

To make the entity extended, create a base abstract class. The name of this class should start with the `Extend` word, and implement |ActivityInterface|.

Here is an example:

.. code-block:: php
    :linenos:

    <?php

    namespace Oro\Bundle\EmailBundle\Model;

    use Oro\Bundle\ActivityBundle\Model\ActivityInterface;
    use Oro\Bundle\ActivityBundle\Model\ExtendActivity;

    class ExtendEmail implements ActivityInterface
    {
        use ExtendActivity;

        /**
         * Constructor
         *
         * The real implementation of this method is auto generated.
         *
         * IMPORTANT: If the derived class has own constructor it must call parent constructor.
         */
        public function __construct()
        {
        }
    }


Use this class as the superclass for your entity. To include the entity in the `activity` group, use the ORO entity configuration, for example:

.. code-block:: php
    :linenos:

    /**
     *  @Config(
     *  defaultValues={
     *      "grouping"={"groups"={"activity"}}
     *  }
     * )
     */
    class Email extends ExtendEmail


Your entity is now recognized as the activity entity. To make sure that the activity is displayed correctly, you need to configure its UI.

.. _backend-entity-activities-configure-ui:

Configure UI for the Activity Entity
------------------------------------

Before using the new activity entity within OroPlatform, you need to do the following:

* `Configure UI for Activity List Section`_
* `Configure UI for an Activity Button`_

Take a look at |all configuration options| for the activity scope before reading further.

Configure UI for Activity List Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

First, create a new action in your controller and a TWIG template responsible for rendering the list of your activities.

Keep in mind that:

 - The controller action must accept two parameters: `$entityClass` and `$entityId`.
 - The entity class name can be encoded to avoid routing collisions. That is why you need to use the `oro_entity.routing_helper` service to get the entity by its class name and id.
 - In the following example, the `activity-email-grid` datagrid is used to render the list of activities. This grid is defined in the *datagrids.yml* file:

.. code-block:: php
    :linenos:

    /**
     * This action is used to render the list of emails associated with the given entity
     * on the view page of this entity
     *
     * @Route(
     *      "/activity/view/{entityClass}/{entityId}",
     *      name="oro_email_activity_view"
     * )
     *
     * @AclAncestor("oro_email_email_view")
     * @Template
     */
    public function activityAction($entityClass, $entityId)
    {
        return array(
            'entity' => $this->get('oro_entity.routing_helper')->getEntity($entityClass, $entityId)
        );
    }


.. code-block:: twig
    :linenos:

    {% import 'OroDataGridBundle::macros.html.twig' as dataGrid %}

    <div class="widget-content">
        {{ dataGrid.renderGrid('activity-email-grid', {
            entityClass: oro_class_name(entity, true),
            entityId: entity.id
        }) }}
    </div>


Now, you need to bind the controller to your activity entity. It can be done using the ORO entity configuration, for example:

.. code-block:: php
    :linenos:

    /**
     *  @Config(
     *  defaultValues={
     *      "grouping"={"groups"={"activity"}},
     *      "activity"={
     *          "route"="oro_email_activity_view",
     *          "acl"="oro_email_email_view"
     *      }
     *  }
     * )
     */
    class Email extends ExtendEmail


Please note that in the above example, we use the `route` attribute to specify the controller path and the `acl` attribute to set ACL restrictions.

Configure UI for an Activity Button
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add an activity button to the view page of the entity with the assigned activity, you need to do the following:

1. Create two TWIG templates responsible for rendering the button and the link in the dropdown menu. Please note that you should provide both templates, because an action can be rendered either as a button or a link depending on a number of actions, UI theme, device (desktop/mobile), etc.

Here is an example of TWIG templates:

activityButton.html.twig

.. code-block:: none
    :linenos:

    {{ UI.clientButton({
        'dataUrl': path(
            'oro_email_email_create', {
                to: oro_get_email(entity),
                entityClass: oro_class_name(entity, true),
                entityId: entity.id
        }) ,
        'aCss': 'no-hash',
        'iCss': 'fa-envelope',
        'dataId': entity.id,
        'label' : 'oro.email.send_email'|trans,
        'widget' : {
            'type' : 'dialog',
            'multiple' : true,
            'reload-grid-name' : 'activity-email-grid',
            'options' : {
                'alias': 'email-dialog',
                'method': 'POST',
                'dialogOptions' : {
                    'title' : 'oro.email.send_email'|trans,
                    'allowMaximize': true,
                    'allowMinimize': true,
                    'dblclick': 'maximize',
                    'maximizedHeightDecreaseBy': 'minimize-bar',
                    'width': 1000
                }
            }
        }
    }) }}


activityLink.html.twig

.. code-block:: none
    :linenos:

    {{ UI.clientLink({
        'dataUrl': path(
            'oro_email_email_create', {
                to: oro_get_email(entity),
                entityClass: oro_class_name(entity, true),
                entityId: entity.id
        }),
        'aCss': 'no-hash',
        'iCss': 'fa-envelope',
        'dataId': entity.id,
        'label' : 'oro.email.send_email'|trans,
        'widget' : {
            'type' : 'dialog',
            'multiple' : true,
            'reload-grid-name' : 'activity-email-grid',
            'options' : {
                'alias': 'email-dialog',
                'method': 'POST',
                'dialogOptions' : {
                    'title' : 'oro.email.send_email'|trans,
                    'allowMaximize': true,
                    'allowMinimize': true,
                    'dblclick': 'maximize',
                    'maximizedHeightDecreaseBy': 'minimize-bar',
                    'width': 1000
                }
            }
        }
    }) }}


2. Register these templates in *placeholders.yml*, for example:

.. code-block:: yaml
    :linenos:

    placeholders:
    items:
        oro_send_email_button:
            template: OroEmailBundle:Email:activityButton.html.twig
            acl: oro_email_email_create
        oro_send_email_link:
            template: OroEmailBundle:Email:activityLink.html.twig
            acl: oro_email_email_create


3. Bind the items declared in *placeholders.yml* to the activity entity using the `action_button_widget` and `action_link_widget` attributes.

 For example:

.. code-block:: php
    :linenos:

    /**
     *  @Config(
     *  defaultValues={
     *      "grouping"={"groups"={"activity"}},
     *      "activity"={
     *          "route"="oro_email_activity_view",
     *          "acl"="oro_email_email_view",
     *          "action_button_widget"="oro_send_email_button"
     *          "action_link_widget"="oro_send_email_link"
     *      }
     *  }
     * )
     */
    class Email extends ExtendEmail

.. _backend-entity-activities-configure-custom-grid:

Configure Custom Grid for Activity Context Dialog
-------------------------------------------------

If you want to define a context grid for an entity (e.g., User) in the activity context dialog, add the `context` option in the entity class `@Config` annotation, e.g:

.. code-block:: php
    :linenos:

    /**
     * @Config(
     *      defaultValues={
     *          "grid"={
     *              "default"="default-grid",
     *              "context"="default-context-grid"
     *          }
     *     }
     * )
     */
    class User extends ExtendUser


This option is used to recognize the grid for the entity with a higher priority than the `default` option.
If these options (`context` or `default`) are not defined for an entity, the grid does not appear in the context dialog.

.. _backend-entity-activities-enable-context-column:

Enable Contexts Column in Activity Entity Grids
-----------------------------------------------

For any activity entity grid, you can add a column that includes all context entities.

Have a look at the following example of tasks configuration in *datagrids.yml*:

.. code-block:: yaml
    :linenos:


    datagrids:
        tasks-grid:
            # extension configuration
            options:
                contexts:
                    enabled: true          # default `false`
                    column_name: contexts  # optional, column identifier, default is `contexts`
                    entity_name: ~         # optional, set the FQCN of the grid base entity if auto detection fails


This configuration creates a column named `contexts` and tries to detect the activity class name automatically. If, for some reason, it fails, you can specify an FQCN in the `entity_name` option.

If you wish to configure the column, add a section with the name specified in the `column_name` option:

.. code-block:: yaml
    :linenos:

    datagrids:
        tasks-grid:
            # column configuration
            columns:
                 contexts:                      # the column name defined in options
                    label: oro.contexts.label   # optional, default `oro.activity.contexts.column.label`
                    renderable: true            # optional, default `true`
                    ...


The column type is `twig` (unchangeable), so you can also specify `template`.

The default one is |OroActivityBundle:Grid:Column/contexts.html.twig|.

.. code-block:: twig
    :linenos:

    {% for item in value %}
        {% spaceless %}
            <span class="context-item">
                <span class="{{ item.icon }}"></span>
                {% if item.link %}
                    <a href="{{ item.link }}" class="context-label">{{ item.title|trim }}</a>
                {% else %}
                    <span class="context-label">{{ item.title|trim }}</span>
                {% endif %}
            </span>
        {% endspaceless %}
        {{- not loop.last ? ', ' }}
    {% endfor %}



.. include:: /include/include-links-dev.rst
   :start-after: begin
How to Protect Entities Using ACLs
==================================

Using ACLs you can granularly grant access to your entities. Doing so requires three steps:

#. :ref:`Activate ACL checks for your entities <coobook-entities-acl-enable>`.

#. :ref:`Create access control lists for all available actions <coobook-entities-acl-create>`.

#. :ref:`Add access checks<coobook-entities-acl-check>` to where your entities are displayed or
   manipulated.

.. _coobook-entities-acl-enable:

Activating ACL Checks on your Entities
--------------------------------------

In order to have your entity available in the admin UI to be able to assign permissions to your
users you have to enable ACLs for these entities using the ``@Config`` annotation:

.. code-block:: php
    :linenos:

    // src/AppBundle/Entity/Task.php
    namespace AppBundle\Entitiy;

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @Config(
     *     defaultValues={
     *         "security"={
     *             "type"="acl",
     *             "group_name"=""
     *         }
     *     }
     * )
     */
    class Task
    {
        // ...
    }

After you have done this and have cleared the cache you can toggle all kinds of permission checks
(``CREATE``, ``EDIT``, ``DELETE``, ``VIEW``, and ``ASSIGN`` in the user role management interface.

.. tip::

    You can use the optional ``group_name`` attribute to group entities by application. The value
    of this attribute is used to split the configured access control list into application scopes.

.. _coobook-entities-acl-create:

Creating Access Control Lists
-----------------------------

You have two options to define your custom access control lists:

.. _cookbook-entity-acl-controller:

#. In your controller class, you can use the ``@Acl`` annotation:

   .. code-block:: php
       :linenos:

       // src/AppBunde/Controller/TaskController.php
       namespace AppBundle\Controller;

       use AppBunde\Entity\Task;
       use Oro\Bundle\SecurityBundle\Annotation\Acl;
       use Symfony\Bundle\FrameworkBundle\Controller\Controller;
       use Symfony\Component\HttpFoundation\Request;

       class TaskController extends Controller
       {
           /**
            * @Acl(
            *   id="app_task_view",
            *   type="entity",
            *   class="AppBundle:Task",
            *   permission="VIEW"
            * )
            */
           public function indexAction()
           {
               // ...
           }

           /**
            * @Acl(
            *   id="app_task_create",
            *   type="entity",
            *   class="AppBundle:Task",
            *   permission="CREATE"
            * )
            */
           public function createAction(Request $request)
           {
               // ...
           }

           /**
            * @Acl(
            *   id="app_task_edit",
            *   type="entity",
            *   class="AppBundle:Task",
            *   permission="EDIT"
            * )
            */
           public function editAction(Task $task, Request $request)
           {
               // ...
           }
       }

   Using the ``@Acl`` annotation does not only create new access control lists to which you can
   refer in other parts of your code it will also trigger the access decision manager when your
   actions are accessed by users and thus protect them from being accessed without the needed
   permissions.

#. If you do not want to protect any controller methods or if you prefer to keep the definition of
   your ACLs separated from the application code, you can define them using some YAML config in a
   file named ``acl.yml``:

   .. code-block:: yaml
       :linenos:

       # src/AppBunde/Resources/config/acl.yml
       app_task_create:
           type: entity
           class: AppBunde\Entity\Task
           permission: CREATE

       app_task_delete:
           type: entity
           class: AppBunde\Entity\Task
           permission: DELETE

       app_task_edit:
           type: entity
           class: AppBunde\Entity\Task
           permission: EDIT

       app_task_view:
           type: entity
           class: AppBunde\Entity\Task
           permission: VIEW

.. sidebar:: Security Actions that Are not Related to an Entity

    You can also create access control lists that are only used to protect certain actions that are
    not related to an entity. To do that just set the type of the ACL to ``action`` instead of
    ``entity``:

    .. code-block:: php
        :linenos:

        // src/AppBunde/Controller/PageController.php
        namespace AppBunde\Controller;

        use Oro\Bundle\SecurityBundle\Annotation\Acl;
        use Symfony\Bundle\FrameworkBundle\Controller\Controller;

        class PageController extends Controller
        {
            /**
             * @Acl(
             *     id="app_static_pages",
             *     type="action"
             * )
             */
            public function showAction()
            {
                // ...
            }

            // ...
        }

    When configuring the ACL using the YAML config format, you also have to set the controller to
    bind the ACL to using the ``bindings`` option:

    .. code-block:: yaml
        :linenos:

        # src/AppBunde/Resources/config/acl.yml
        app_static_pages:
            type: action
            bindings:
                class: AppBunde\Controller\PageController
                method: showAction

    .. seealso::

        All configuration options are explained in full details in the :doc:`/reference/annotation/acl`,
        :doc:`/reference/annotation/acl_ancestor`, and :doc:`ACL YAML format </reference/format/acl>`
        reference.

.. _coobook-entities-acl-check:

Perform Access Checks
---------------------

Once you have configured the ACLs you can protect all parts of your application. Anywhere in your
PHP code you can use the ``isGranted()`` method of the ``oro_security.security_facade`` service
(which is an instance of the :class:`Oro\\Bundle\\SecurityBundle\\SecurityFacade` class):

.. code-block:: php
    :linenos:

    $securityFacade = $this->container->get('oro_security.security_facade');

    if ($securityFacade->isGranted('app_task_create')) {
        // do something when the user is granted permissions for the app_static_pages ACL
    }

However, there are ways to configure these access checks in your YAML config files or via
annotations in several places which make their usage a lot easier:

Hiding Menu Items
~~~~~~~~~~~~~~~~~

Use the ``aclResourceId`` option to hide navigation items from users who are not granted to access
the action being linked. The value of this option is the name of the ACL to check for:

.. code-block:: yaml
    :linenos:

    # src/AppBunde/Resources/config/navigation.yml
    oro_menu_config:
        items:
            task_list:
                label: Tasks
                route: app_task_index
                aclResourceId: app_task_view

Protecting Controllers Refering to Existing ACLs
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

As :ref:`shown above <cookbook-entity-acl-controller>` you can define new ACLs and protect your
controllers with them in a single step using the ``@Acl`` annotation. However, you can also refer
to an existing access control list using the ``@AclAncestor`` annotation:

.. code-block:: php
    :linenos:

    // src/AppBunde/Controller/TaskController.php
    namespace AppBundle\Controller;

    use AppBunde\Entity\Task;
    use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class TaskController extends Controller
    {
        /**
         * @AclAncestor("app_task_view")
         */
        public function viewAction(Task $task)
        {
            // ...
        }

        // ...
    }

Show Parts of Templates Based on Permissions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Inside your templates you can use the ``resource_granted()`` Twig function to check for certain
permissions to hide parts of your views for users who do not have the required permissions:

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/index.html.twig #}
    {% extends 'OroUIBundle:actions:index.html.twig' %}

    {% set gridName = 'app-tasks-grid' %}
    {% set pageTitle = 'Task' %}

    {% block navButtons %}
        {% if resource_granted('app_task_create') %}
            <div class="btn-group">
                {{ UI.addButton({
                    'path': path('app_task_create'),
                    'entity_label': 'Create a task',
                }) }}
            </div>
        {% endif %}
    {% endblock %}

Restrict Access to Data Grid Results
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In a data grid you can protect the entire result set (to not show results if the user is not
granted access and the action embedding the grid accidentally was not protected):

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            source:
                acl_resource: app_task_view

        # ...

Hide Unaccessible Grid Actions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Also use the ``acl_resource`` option to hide actions in a data grid the user does not have access
to:

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/datagrid.yml
    datagrid:
        app-tasks-grid:
            # ...
            actions:
                # ...
                edit:
                    type: navigate
                    label: Edit
                    link: update_link
                    icon: edit
                    acl_resource: app_task_edit
                delete:
                    type: delete
                    label: Delete
                    link: delete_link
                    icon: trash
                    acl_resource: app_task_delete

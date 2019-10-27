Protect Entities Using ACLs
===========================

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
    namespace AppBundle\Entity;

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @Config(
     *     defaultValues={
     *         "security"={
     *             "type"="ACL",
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
(``CREATE``, ``EDIT``, ``DELETE``, ``VIEW``, and ``ASSIGN``) in the user role management interface.

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
   file named ``acls.yml``:

   .. code-block:: yaml
       :linenos:

       # src/AppBunde/Resources/config/oro/acls.yml
       acls:
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

        # src/AppBunde/Resources/config/oro/acls.yml
        acls:
            app_static_pages:
                type: action
                bindings:
                    class: AppBunde\Controller\PageController
                    method: showAction

    .. seealso::

        All configuration options are explained in full details in the :ref:`@Acl <acl>`,
        :ref:`@AclAncestor <acl-ancestor>`, and :ref:`ACL YAML format <access-control-lists>`
        reference.

.. _coobook-entities-acl-check:

Performing Access Checks
------------------------

Once you have configured the ACLs you can protect all parts of your application. Anywhere in your
PHP code you can use the ``isGranted()`` method of the ``security.authorization_checker`` service
(which is an instance of the |SymfonyComponentSecurityCoreAuthorizationAuthorizationCheckerInterface| class):

.. code-block:: php
    :linenos:

    $authorizationChecker = $this->get('security.authorization_checker');

    if ($authorizationChecker->isGranted('app_task_create')) {
        // do something when the user is granted permissions for the app_static_pages ACL
    }

You can set the second parameter to check access on Object level (with Access Level check):

.. code-block:: php
    :linenos:

    $taskEntity = $this->getTask();

    $authorizationChecker = $this->get('security.authorization_checker');

    if ($authorizationChecker->isGranted('app_task_update', $taskEntity)) {
        // do something when the user is granted permissions for the app_static_pages ACL
    }

In case if you does not have proper ACL annotation, you can set the first parameter as the
permission name you want to check:

.. code-block:: php
    :linenos:

    $taskEntity = $this->getTask();

    $authorizationChecker = $this->get('security.authorization_checker');

    if ($authorizationChecker->isGranted('EDIT', $taskEntity)) {
        // do something when the user is granted permissions for the app_static_pages ACL
    }

This example will work the same as before. It will check an EDIT permission for the Task instance object.

However, there are ways to make this checks in different parts of your application:

Hiding Menu Items
~~~~~~~~~~~~~~~~~

Use the ``aclResourceId`` option to hide navigation items from users who are not granted to access
the action being linked. The value of this option is the name of the ACL to check for:

.. code-block:: yaml
    :linenos:

    # src/AppBunde/Resources/config/oro/navigation.yml
    menu_config:
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

Inside your templates you can use the ``is_granted()`` Twig function to check for certain
permissions to hide parts of your views for users who do not have the required permissions:

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/update.html.twig #}
    {% block someBlock %}
        {% if is_granted('app_task_edit') %}
            Some info if access is granted
        {% endif %}
    {% endblock %}

In this example we check access by ACL annotation info without Object to test. So, ``is_granted`` will return
true as result if user have any access level to EDIT permission to Task entity.

In case if you want to check access more deeply, you can set the entity instance as the second parameter of
``is_granted()`` function:

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/update.html.twig #}
    {% block someBlock %}
        {# an `entity` variable contains an Test entity instance #}
        {% if is_granted('app_task_edit', entity) %}
            Some info if access is granted
        {% endif %}
    {% endblock %}

At this example, will be checked access level for the given object instance.

In case if you have no an ACL annotation, you can set the permission name directly as the first parameter:

.. code-block:: html+jinja
    :linenos:

    {# src/AppBundle/Resources/views/Task/update.html.twig #}
    {% block someBlock %}
        {# an `entity` variable contains an Test entity instance #}
        {% if is_granted('EDIT', entity) %}
            Some info if access is granted
        {% endif %}
    {% endblock %}


Restrict Access to Data Grid Results
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In a data grid you can protect the entire result set (to not show results if the user is not
granted access and the action embedding the grid accidentally was not protected):

.. code-block:: yaml
    :linenos:

    # src/AppBundle/Resources/config/oro/datagrids.yml
    datagrids:
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

    # src/AppBundle/Resources/config/oro/datagrids.yml
    datagrids:
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

Check Access on ORM Queries
~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can protect your Doctrine ORM query with ``apply`` method of ``oro_security.acl_helper`` service.

.. code-block:: php
    :linenos:

    use Doctrine\ORM\Query;
    use Doctrine\ORM\QueryBuilder;

    use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;

    class TaskController extends Controller
    {
        public function viewAction(Task $task)
        {
            /** @var QueryBuilder $qb */
            $qb = $this->getSomeQuery();

            /** @var Query $query */
            $query = $this->getContainer()->get('oro_security.acl_helper')->apply($qb);

            $result = $query->getResult();

            // ...
        }

        // ...
    }

As result, the query will be modified and the result data set will contain only the records user can see.

By default, VIEW permission used as the second parameter. If you want to check another permission, you can
set it as the second parameter of ``apply`` method.


.. include:: /include/include-links.rst
   :start-after: begin
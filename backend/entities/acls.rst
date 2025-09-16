Protect Entities Using ACLs
===========================

Using ACLs you can granularly grant access to your entities. Doing so requires three steps:

#. :ref:`Activate ACL checks for your entities <coobook-entities-acl-enable>`.

#. :ref:`Create access control lists for all available actions <coobook-entities-acl-create>`.

#. :ref:`Add access checks<coobook-entities-acl-check>` to where your entities are displayed or manipulated.

.. _coobook-entities-acl-enable:

Activating ACL Checks on your Entities
--------------------------------------

To have your entity available in the admin UI to be able to assign permissions to your users, you have to enable ACLs for these entities using the ``#[Config]`` attribute:

.. oro_integrity_check:: 3720c1dd7b67c0568edbd4ad8e6229b593e7effc

   .. literalinclude:: /code_examples/commerce/demo/Entity/Favorite.php
       :caption: src/Acme/Bundle/DemoBundle/Entity/Favorite.php
       :language: php
       :lines: 3-5, 8, 14-17, 19-33

After you have done this and have cleared the cache, you can toggle all kinds of permission checks (``CREATE``, ``EDIT``, ``DELETE``, ``VIEW``, and ``ASSIGN``) in the user role management interface.

.. tip::

    You can use the optional ``group_name`` attribute to group entities by application. The value of this attribute is used to split the configured access control list into application scopes.

.. _coobook-entities-acl-create:

Creating Access Control Lists
-----------------------------

You have two options to define your custom access control lists:

.. _cookbook-entity-acl-controller:

#. In your controller class, you can use the ``#[Acl]`` attribute:

.. oro_integrity_check:: 53f090514e4cabdfbc88df23122b98d973556680

   .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
       :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
       :language: php
       :lines: 3-5, 7, 9, 11, 13, 16-22, 31-43, 93

   Using the ``#[Acl]`` attribute does not only create new access control lists to which you can refer in other parts of your code, it also triggers the access decision manager when your actions are accessed by users and thus protect them from being accessed without the needed permissions.

#. If you do not want to protect any controller methods or if you prefer to keep the definition of your ACLs separated from the application code, you can define them using some YAML config in a file named ``acls.yml``:

.. oro_integrity_check:: 11dd922ddd03e38486a01f9339578373c3b7bc0f

   .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/acls.yml
       :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/acls.yml
       :language: yaml
       :lines: 1-5

.. sidebar:: Security Actions that Are not Related to an Entity

    You can also create access control lists that are only used to protect specific actions unrelated to an entity. To do that, set the type of the ACL to ``action`` instead of ``entity``:

    .. oro_integrity_check:: 57319d4594ee22fc135ad553f20584353f2146bc

        .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
            :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
            :language: php
            :lines: 3-5, 7, 9, 11, 13, 16-22, 63-83, 93

    When configuring the ACL using the YAML config format, you also have to set the controller to use the ``bindings`` option to bind the ACL:


    .. oro_integrity_check:: 1bd0fdc96c7d20caadec64d7fe339712b294333d

        .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/acls.yml
            :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/acls.yml
            :language: yaml
            :lines: 1-8

    .. seealso::

        All configuration options are explained in full details in the :ref:`#[Acl] <acl>`,
        :ref:`#[AclAncestor] <acl-ancestor>`, and :ref:`ACL YAML format <access-control-lists>`
        reference.

.. _coobook-entities-acl-check:

Performing Access Checks
------------------------

Once you have configured the ACLs, you can protect all application parts. You can use the ``isGranted()`` method of the ``security.authorization_checker`` service (which is an instance of the |Symfony AuthorizationCheckerInterface|) anywhere in your PHP code:

.. code-block:: php

    $authorizationChecker = $this->get('security.authorization_checker');

    if ($authorizationChecker->isGranted('acme_static_pages')) {
        // do something when the user is granted permissions for the acme_static_pages ACL
    }

You can set the second parameter to check access on Object level (with Access Level check):

.. code-block:: php

    $taskEntity = $this->getTask();

    $authorizationChecker = $this->get('security.authorization_checker');

    if ($authorizationChecker->isGranted('acme_task_edit', $taskEntity)) {
         // do something when the user is granted permissions for the acme_task_edit ACL of the entity in $taskEntity
    }

When you do not have proper ACL annotation, you can set the first parameter as the permission name you want to check:

.. code-block:: php

    $taskEntity = $this->getTask();

    $authorizationChecker = $this->get('security.authorization_checker');

    if ($authorizationChecker->isGranted('EDIT', $taskEntity)) {
        // do something when the user is granted EDIT permission for the $taskEntity
    }

This example will work the same as before. It will check EDIT permission for the Task instance object.

However, there are ways to perform these checks in different parts of your application:

Hiding Menu Items
~~~~~~~~~~~~~~~~~

Use the ``acl_resource_id`` option to hide navigation items from users who are not granted access to the linked action. The value of this option is the name of the ACL to check for:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/navigation.yml

    menu_config:
        items:
            task_list:
                label: Tasks
                route: acme_task_index
                acl_resource_id: acme_task_view

Protecting Controllers Referring to Existing ACLs
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can define new ACLs as :ref:`shown above <cookbook-entity-acl-controller>` and protect your controllers with them in a single step using the ``#[Acl]`` attribute. However, you can also refer to an existing access control list using the ``#[AclAncestor]`` attribute:

.. code-block:: php
   :caption: src/Acme/Bundle/DemoBundle/Controller/TaskController.php

    namespace Acme\Bundle\DemoBundle\Controller;

    use Acme\Bundle\DemoBundle\Entity\Task;
    use Oro\Bundle\SecurityBundle\Attribute\AclAncestor;
    use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

    class TaskController extends AbstractController
    {
        #[AclAncestor('acme_task_view')]
        public function viewAction(Task $task)
        {
            // ...
        }
    }

Show Parts of Templates Based on Permissions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Inside your templates, you can use the ``is_granted()`` Twig function to check for certain permissions to hide parts of your views for users who do not have the required permissions:

.. code-block:: html+jinja
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/Task/update.html.twig

    {% block someBlock %}
        {% if is_granted('acme_task_edit') %}
            Some info if access is granted
        {% endif %}
    {% endblock %}

In this example, we check access by ACL annotation info without an Object to test. So, ``is_granted`` will return true if the user has any access level to EDIT permission to the Task entity.

If you want to perform a deeper access check, you can set the entity instance as the second parameter of the ``is_granted()`` function:

.. code-block:: html+jinja
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/Task/update.html.twig

    {% block someBlock %}
        {# an `entity` variable contains a Test entity instance #}
        {% if is_granted('acme_task_edit', entity) %}
            Some info if access is granted
        {% endif %}
    {% endblock %}

This example illustrates the check of the access level for the given object instance.

If you have no ACL annotation, you can set the permission name directly as the first parameter:

.. code-block:: html+jinja
   :caption: src/Acme/Bundle/DemoBundle/Resources/views/Task/update.html.twig

    {% block someBlock %}
        {# an `entity` variable contains a Test entity instance #}
        {% if is_granted('EDIT', entity) %}
            Some info if access is granted
        {% endif %}
    {% endblock %}

Restrict Access to Data Grid Results
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

In a data grid, you can protect the entire result set (not to show results if the user is not granted access and the action embedding the grid was not protected by accident):

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-tasks-grid:
            source:
                acl_resource: acme_task_view

        # ...

Hide Unaccessible Grid Actions
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can also use the ``acl_resource`` option to hide actions in a data grid the user does not have access to:

.. code-block:: yaml
   :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml

    datagrids:
        acme-tasks-grid:
            # ...
            actions:
                # ...
                edit:
                    type: navigate
                    label: Edit
                    link: update_link
                    icon: edit
                    acl_resource: acme_task_edit
                delete:
                    type: delete
                    label: Delete
                    link: delete_link
                    icon: trash
                    acl_resource: acme_task_delete

Check Access on ORM Queries
~~~~~~~~~~~~~~~~~~~~~~~~~~~

You can protect your Doctrine ORM query with the ``apply`` method of the ``oro_security.acl_helper`` service.

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\Controller;

    use Acme\Bundle\DemoBundle\Entity\Task;
    use Doctrine\ORM\Query;
    use Doctrine\ORM\QueryBuilder;
    use Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper;

    class TaskController extends Controller
    {
        /**
         * @param Task $task
         * @return array
         */
        public function viewAction(Task $task)
        {
            /** @var QueryBuilder $qb */
            $qb = $this->getSomeQuery();

            /** @var Query $query */
            $query = $this->getContainer()->get('oro_security.acl_helper')->apply($qb);

            $result = $query->getResult();

            // ...
        }
    }

As a result, the query will be modified, and the result data set will contain only the records the user can see.

By default, VIEW permission is used as the second parameter. If you want to check another permission, you can set it as the second parameter of the ``apply`` method.

.. include:: /include/include-links-dev.rst
   :start-after: begin

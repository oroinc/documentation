@Acl
====

The ``@Acl`` annotation is used to create a new access control list and to protect the controller
that is annotation with this ACL accordingly:

.. code-block:: php
    :linenos:

    // ...
    use Oro\Bundle\SecurityBundle\Annotation\Acl;

    /**
     * @Acl(
     *     id="user_user_view",
     *     type="entity",
     *     class="OroUserBundle:User",
     *     permission="VIEW"
     * )
     */
    public function demoAction()
    {
        // ...
    }

Options
-------

``class``
~~~~~~~~~

**type**: ``string``

When the `type`_ option is set to ``entity``, the fully qualified class name configured with the
``class`` option is used to decide whether or not the ACL has to be evaluated when checking if a
user has access to a certain class. If the given action is annotated with the `ParamConverter`_
parameter, and the class of this parameter is the same as the class parameter from the ACL
annotation, the check will be done on the object level (check if the user has access to the given
object).

``group``
~~~~~~~~~

**type**: ``string``

ACLs can optionally be grouped. A group is identified by its name.

``id``
~~~~~~

A unique identifier that is used, for example, to reference an access control list with the
:doc:`@AclAncestor annotation </reference/annotation/acl_ancestor>`.

``label``
~~~~~~~~~

**type**: ``string``

A human-readable label that can be presented to the users.

``permission``
~~~~~~~~~~~~~~

**type**: ``string``

When the `type`_ is set to ``entity``, access can be granted based on the action that should be
performed with a domain object. There are four types of permission which can be granted to a user:

``ASSIGN``

    By default, when a user creates a new entity, they will be the owner of the newly created
    object. But if they are granted the ``ASSIGN`` permission to other users, organizations, or
    business units, they can transfer ownership to users for which they have this permission.

    .. note::

        This permission is not meant to be used in an ACL.

``CREATE``

    The user can create new objects of this entity. Using this permission limit the list of
    available owners for an entity.

``DELETE``

    The object can be deleted by the user.

``EDIT``

    The user can modify a particular entity.

``SHARE``

    .. versionadded:: 1.9
        Support for the ``SHARE`` permission will be introduced in OroPlatform release 1.9.

    If a user is granted the ``SHARE`` permission on other users, organizations, or business units,
    they can share an entity with those users which means that those users can then view the entity
    too.

``VIEW``

    The user is able to see the data of an object.

``type``
~~~~~~~~

**type**: ``string``

The type of resource that should be protected. Possible values are:

``action``

    A certain action in the user interface that is not bound to a particular domain object or a the
    type (class) of a domain object.

    .. tip::

        When using the ``action`` type, it is only possible to grant or deny access to a user for a
        given action. If you want to grant them access for a certain action only for a subset of
        the data, you can configure ACLs for each object indivually by setting the ``action``
        option to ``entity`` and then control the allowed action with the `permission`_ option.

``entity``

    When ``type`` is set to entity, each domain object can be protected indivually which means that
    access can be granted based on a particular domain object.

.. _`ParamConverter`: http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html

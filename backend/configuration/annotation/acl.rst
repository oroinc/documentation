.. _acl:

@Acl
====

Use the ``@Acl`` annotation to create a new access control list and protect the controller it is
attached to:

.. code-block:: php


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

When the `type`_ option is set to ``entity``, the fully qualified class name in the ``class`` option
determines whether to evaluate the ACL when checking a user's access to a class. If the given action is annotated with the |ParamConverter|
parameter, and the class of this parameter is the same as the class parameter from the ACL
annotation, the check will be done on the object level (check if the user has access to the given
object).

``group``
~~~~~~~~~

**type**: ``string``

ACLs can optionally be grouped. A group is identified by its name.

``id``
~~~~~~

A unique identifier, used for example to reference an access control list with the :ref:`@AclAncestor annotation <acl-ancestor>`.

``label``
~~~~~~~~~

**type**: ``string``

A human-readable label to present to users.

``permission``
~~~~~~~~~~~~~~

**type**: ``string``

When the `type`_ is set to ``entity``, you can grant access based on the action to perform on a
domain object. You can grant a user four types of permission:

``ASSIGN``

    By default, a user who creates a new entity becomes the owner of that object. With the
    ``ASSIGN`` permission on other users, organizations, or business units, they can transfer
    ownership to users for which they have this permission.

    .. note::

        This permission is not meant to be used in an ACL.

``CREATE``

    The user can create new objects of this entity. This permission limits the list of available
    owners for an entity.

``DELETE``

    The user can delete the object.

``EDIT``

    The user can modify a particular entity.

``SHARE``

    .. versionadded:: 1.9
        Support for the ``SHARE`` permission will be introduced in OroPlatform release 1.9.

    With the ``SHARE`` permission on other users, organizations, or business units, a user can share
    an entity with those users so that they can view it too.

``VIEW``

    The user can see the data of an object.

``type``
~~~~~~~~

**type**: ``string``

The type of resource to protect. Possible values are:

``action``

    An action in the user interface that is not bound to a particular domain object or to the
    type (class) of a domain object.

    .. tip::

        With the ``action`` type, you can only grant or deny a user access to a given action. To
        grant access to an action for just a subset of the data, configure ACLs for each object
        individually by setting the ``action`` option to ``entity``, then control the allowed action
        with the `permission`_ option.

``entity``

    When ``type`` is set to entity, each domain object can be protected individually, so you can
    grant access based on a particular domain object.


.. include:: /include/include-links-dev.rst
   :start-after: begin

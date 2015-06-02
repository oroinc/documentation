Access Control Lists
====================

+-----------+-----------------+
| Filename  | ``acl.yml``     |
+-----------+-----------------+
| Root Node | none            |
+-----------+-----------------+
| Options   | * `bindings`_   |
|           | * `class`_      |
|           | * `label`_      |
|           | * `permission`_ |
|           | * `type`_       |
+-----------+-----------------+

The ``acl.yml`` file of a bundle can contain a map with access control lists. Each key of the map
is the unique name of an ACL while the values for each ACL is a map of options:

.. code-block:: yaml
    :linenos:

    # src/Acme/DemoBundle/Resources/config/acl.rst

    # an ACL used to protect an action
    password_management:
        label: Password Management
        type: action
        group_name: ""

    # an ACL used to grant removal permissions to users
    user_delete:
        label: Delete Users
        type: entity
        class: Acme\DemoBundle\Entity\User
        permission: DELETE

``bindings``
------------

**type**: ``map``

When a controller action should be protected by an ACL, its method must be bound to the ACL. The
``bindings`` option expects a map with two keys that refer to the controller to be protected:

``class``

    The fully qualified class name of the controller class.

``method``

    The name of the controller action method.

``class``
---------

**type**: ``string``

When the `type`_ option is set to ``entity``, the ``class`` option is used to decide whether or not
the ACL has to be evaluated when checking if a user has access to a certain object. Each object ACL
is only responsible for protecting access to a certain kind of objects.

``label``
---------

**type**: ``string``

A human-readable label that can be presented to the users. For example, this label is shown in the
role management section of the OroPlatform.

``permission``
--------------

**type**: ``string``

Access can be granted based on the action that should be performed with a domain object. There are
four types of permission which can be granted to a user:

``ASSIGN``

    By default, when a user creates a new entity, they will be the owner of the newly created
    object. But if they are granted the ``ASSIGN`` permission to other users, organizations, or
    business units, they can transfer ownership to users for which they have this permission.

    .. note::

        This permission is not meant to be used in an ACL.

``CREATE``

    The user can create new objects of this entity.

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
--------

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

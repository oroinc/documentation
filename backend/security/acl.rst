.. _backend-security-bundle-introduction:

Introduction to Security in Oro Applications
============================================

The :ref:`OroSecurityBundle <bundle-docs-platform-security-bundle>` sits on top of the Symfony security layer to protect your resources.
Each application user is granted access to a particular subset of your company's resources. Coincidentally, they have to be prevented from accessing resources when access was not granted to them.

.. _backend-security-bundle-access-control-list:

Access Control Lists
^^^^^^^^^^^^^^^^^^^^

Access Control Lists are an essential part of the |Symfony Security Components|. The OroSecurityBundle leverages them to fulfill the requirements of companies in the business context.

.. hint:: You can find detailed information about Symfony ACL-based security model in the Symfony documentation:

           * |https://github.com/symfony/acl-bundle/blob/main/src/Resources/doc/index.rst|

Access Levels
~~~~~~~~~~~~~

Access can be granted to a user for a particular resource on several levels. The lowest level is the *User* level. Being on this level means that users can only access resources assigned to them. At the other end of the hierarchy is the *Global* level. Users at this level can access all records within the system without exception. The security bundle
comes with the following five levels (ordered up from the bottom of the hierarchy):

+-----------------+------------------+-----------------------------------------------------------+
| Level           | Constant         | Description                                               |
+=================+==================+===========================================================+
| *User*          | ``BASIC_LEVEL``  | The user is granted access to their own records.          |
+-----------------+------------------+-----------------------------------------------------------+
| *Business Unit* | ``LOCAL_LEVEL``  | The user is given access to the records in all            |
|                 |                  | business units they are assigned to.                      |
+-----------------+------------------+-----------------------------------------------------------+
| *Division*      | ``DEEP_LEVEL``   | This is the same as the *Business Unit* level except that |
|                 |                  | the user can also access all resources that are owned by  |
|                 |                  | subordinate units of the business units they are assigned |
|                 |                  | to.                                                       |
+-----------------+------------------+-----------------------------------------------------------+
| *Organization*  | ``GLOBAL_LEVEL`` | The user is given access to all records within the        |
|                 |                  | organization, regardless of the business unit the object  |
|                 |                  | belongs to or the user is assigned to.                    |
+-----------------+------------------+-----------------------------------------------------------+
| *Global*        | ``SYSTEM_LEVEL`` | The user can access all objects within the system.        |
|                 |                  |                                                           |
|                 |                  | .. note:: This level is available only in Enterprise      |
|                 |                  |           editions. Global access level makes sense if    |
|                 |                  |           the user works in the scope of a global         |
|                 |                  |           organization. If the user works in the scope    |
|                 |                  |           of an ordinary organization, global level       |
|                 |                  |           equals organization.                            |
+-----------------+------------------+-----------------------------------------------------------+

Each record is associated with an owning organization. When a user logs into the system, they work in the scope of one of their organizations.

.. note::

    For all access levels, a class constant is defined in the `Oro\\Bundle\\SecurityBundle\\Acl\\AccessLevel` class. Its value is shown in the *Constant* column.

    There are two special constants ``AccessLevel::UNKNOWN`` (unknown access level, should not be
    assigned to a user) and ``AccessLevel::NONE_LEVEL`` (globally deny access for the user).

.. _permissions:

Permissions
~~~~~~~~~~~

A user can be assigned different modes to a resource. These modes describe what they are allowed to
do with the resource. Namely, the following permissions are supported for **entities**:

+------------+---------------------------------------------------------------------------+
| Permission |                                                                           |
+============+===========================================================================+
| ``VIEW``   | Whether or not a user is allowed to view a record.                        |
+------------+---------------------------------------------------------------------------+
| ``CREATE`` | Whether or not a user is allowed to create a record. The access level set |
|            | for this permission limits the number of owners that can be assigned to   |
|            | a created record.                                                         |
+------------+---------------------------------------------------------------------------+
| ``EDIT``   | Whether or not a user is allowed to modify a record.                      |
+------------+---------------------------------------------------------------------------+
| ``DELETE`` | Whether or not a user is allowed to delete a record.                      |
+------------+---------------------------------------------------------------------------+
| ``ASSIGN`` | Whether or not a user is allowed to assign a record to another user. This |
|            | permission is only evaluated when an entity is edited.                    |
+------------+---------------------------------------------------------------------------+
| ``SHARE``  | Whether or not a user is allowed to assign a record to another user.      |
|            | Only works on entities' view pages.                                       |
|            |                                                                           |
|            | .. note:: This permission is available only in Enterprise editions.       |
|            |                                                                           |
+------------+---------------------------------------------------------------------------+

.. seealso::

    Read the official documentation for a first insight into the |usage of ACLs| examples.

The following permissions are supported for **fields**:

+------------+---------------------------------------------------------------------------+
| Permission |                                                                           |
+============+===========================================================================+
| ``VIEW``   | Whether or not a user is allowed to view a field.                         |
+------------+---------------------------------------------------------------------------+
| ``EDIT``   | Whether or not a user is allowed to modify a field.                       |
+------------+---------------------------------------------------------------------------+

Ownership Type
--------------

Each ACL-protected entity must have an ownership type. Various entities can act as one, such as user business unit, organization.
If the type of owner is not specified, but the entity is ACL-protected, this type is called **None**.
The set of access levels available for permissions of this entity changes depending on the ownership type.

The following table shows what access levels can be assigned depending on the entity's ownership type:

+----------------+---------------------------------------------------------------+
| Ownership type | Possible access levels for an entity with this ownership type |
+================+===============================================================+
| User           | None, User, Business Unit, Division, Organization, Global     |
+----------------+---------------------------------------------------------------+
| Business Unit  | None, Business Unit, Division, Organization, Global           |
+----------------+---------------------------------------------------------------+
| Organization   | None, Organization, Global                                    |
+----------------+---------------------------------------------------------------+
| None           | None, Global                                                  |
+----------------+---------------------------------------------------------------+

Although ownership types uses the same concepts as an access level, their impact is different. For example:

* The **None** ownership type gives the broadest access to entity records. It means this record does not belong to any particular organization, business unit, or user. Therefore, all users can access it, or no one at all.'
* The **None** access level completely restricts access to entity records, so no one can perform this action on the entity.

Every record of a security-protected entity with ownership type User, Business Unit, and Organization has an organization.

Remember that once the entity is created, you can no longer change its ownership type. Consequently, you cannot change the predefined ownership types of system entities (such as an account or a business unit).

.. _backend-security-bundle-configure-entities:

Configuring Permissions for Entities
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To be able to protect access to your entities, you first have to configure which permissions can be granted to a user to them. Use the ``security`` scope in the ``defaultValues`` section of the ``@Config`` annotation:

.. oro_integrity_check:: fb8474e8e60746445c47ecffa50c805c058e1d7f

    .. literalinclude:: /code_examples/commerce/demo/Entity/Favorite.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Favorite.php
        :language: php
        :lines: 24-25, 36-41, 45-46

.. note:: After changing ACL in the Config annotation, run the `oro:entity-config:update` command in the console to apply changes.

The **permissions** parameter is used to specify the access list for the entity. This parameter is optional.
If it is not specified, or is ``All``, it is considered that the entity access to all available security permissions.

You can create your list of accesses. For example, string ``VIEW;EDIT`` will set viewing and editing permissions parameters for the entity.

The **group_name** parameter is used to group entities by applications. It is used to split security into application scopes.

The **category** parameter is used to categorize an entity. It is used to split entities by section on the role privileges edit page.

By default (or when using the special ``ALL`` value for the ``permissions`` property as in the example above), any :ref:`available permission <permissions>` can be granted to a user on an entity. If you want to restrict the available permissions for an entity, you can list them separated. For example, you limit it to the ``VIEW`` and ``EDIT`` permissions:

.. code-block:: php-annotations

    /**
     * ...
     *     "security"={
     *       "type"="ACL",
     *       "permissions"="VIEW;EDIT",
     *       "group_name"="DemoGroup"
     *     }
     * ...
     */

Once an entity is marked as ACL-protected, you need to specify its ownership type. It is done with the help of the ``ownership`` scope in the ``defaultValues`` section.

In this config, you should specify the ownership type that will be used for the entity, as well as the names of the columns in the database and fields that will be used to store the link to the owner of the record and the organization where this record was created.

For example, the config will be the following for the USER owner type:

.. oro_integrity_check:: 6d0716a66ff510f2803640d56c0b6fe84320a637

    .. literalinclude:: /code_examples/commerce/demo/Entity/Favorite.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Favorite.php
        :language: php
        :lines: 24-32, 45-46

For the business unit owner type:

.. code-block:: php-annotations

    /**
     * @Config(
     *   defaultValues={
     *     ...
     *     "ownership"={
     *       "owner_type"="BUSINESS_UNIT",
     *       "owner_field_name"="owner",
     *       "owner_column_name"="owner_id",
     *       "organization_field_name"="organization",
     *       "organization_column_name"="organization_id"
     *   }
     * )

For an Organization owner type, you can specify only the ``owner_field_name`` and ``owner_column_name``:

.. code-block:: php-annotations

    /**
     * @Config(
     *   defaultValues={
     *     ...
     *     "ownership"={
     *       "owner_type"="ORGANIZATION",
     *       "owner_field_name"="owner",
     *       "owner_column_name"="owner_id"
     *   }
     * )

.. important:: For the User and Business Unit ownership types, organization fields are **mandatory**.

.. _backend-security-bundle-protect-resources:

Protecting Resources
^^^^^^^^^^^^^^^^^^^^

After configuring which permissions a user can be granted to a particular entity, you have to ensure that the permissions are considered when checking if a user has access to a resource. Such checks must be placed in the right places in the code.

Restricting Access to Controller Methods
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Suppose you have configured an entity to be protectable via ACLs. You have granted some of its objects to a set of users. Now you can control who can enter specific resources through the controller method. Restricting access can be done in two different ways:

#. Use the ``@Acl`` annotation on a controller method, providing the entity class name and the permission to check for:

.. oro_integrity_check:: 7f774b6fa27aa54fa168f5bf99b0a124ed1830f0

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-31, 101

#. When you need to perform a particular check repeatedly, write ``@Acl`` repeatedly. This, however, is tedious, especially when your requirements change and you have to change a lot of ACLs.

   The ACL configuration from the example above looks like this:

.. oro_integrity_check:: 0dbbb1351e3031ef6794ab99daeef705351547f2

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/acls.yml
        :caption: src/Acme/Bundle/DemoBundle/config/oro/acls.yml
        :language: yaml
        :lines: 1-5

  Annotation @AclAncestor enables you to reuse ACL resources defined with the ACL annotation or described in the acls.yml file. The name of the ACL resource is used as the parameter of this annotation:

.. oro_integrity_check:: 4c7b1f9014fb80cdf7ddc6af988c478970a5f4f4

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-22, 50-67, 101

  Sometimes you want to protect a controller method from code you do not control. Therefore, you cannot add the ``@AclAncestor`` annotation to it. Use the bindings key in the YAML configuration of your ACL to define which method(s) should be protected:

.. oro_integrity_check:: 2851bb1508ab6f4f85833d9387df75d4da10c6bc

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/acls.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/acls.yml
        :language: yaml
        :lines: 1-8


  You can read detailed explanations for all available YAML configuration options :ref:`in the reference section <access-control-lists>`.

**Using Param Converters**

* If the parameters of the method have an entity that is also used in the parameters of the ACL annotation, then access is checked directly on this object.

* If the parameters of the method have no type that is used in the annotation, then a check is performed at the class level when it is checked whether the user has access to this *type* of an entity, rather than to a specific instance of an entity.

.. seealso::

    It is also possible :ref:`to protect Doctrine queries <backend-security-protecting-dql-queries>`.

Data Grids
~~~~~~~~~~

You can protect a datasource with ACL by adding the acl_resource parameter under the source node in the datagrid configuration:

.. oro_integrity_check:: aac7e16f63996a378daa40d47479f61342631085

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/datagrids.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/datagrids.yml
        :language: yaml
        :lines: 1, 201-203

.. _backend-security-protecting-dql-queries:

Protecting Custom DQL Queries
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

When building custom DQL queries, reduce the result set being returned to the set of domain objects to which the user is granted access. To achieve this, use the ACL helper provided by the OroSecurityBundle:

.. oro_integrity_check:: 9271edfa10d820ab24244b3a54b55e4d312626cc

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-22, 69-92, 101


In this example, a query is built that selects all products from the database that cost more than ``19.99``. Then, the query builder is passed to the ``apply()`` method of the ``oro_security.acl_helper`` service. This service, an instance of the ``Oro\Bundle\SecurityBundle\ORM\Walker\AclHelper`` class modifies the query only to the return entities to which the user has access.

Manual Access Checks
~~~~~~~~~~~~~~~~~~~~

Sometimes it is impossible to do an ACL check in the controller using annotations due to additional conditions.

In this case, you can use the ``isGranted`` function:

.. oro_integrity_check:: 7d5e1f8e3b984fd99cb137c63c34b5b1f397b0e7

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 1-22, 49-64, 101

If you need to carry out an ACL check on an object not in the controller, use the ``isGranted`` method of the `security.authorization_checker` service.

The `security.authorization_checker` service is a public service used to check whether access to a resource is granted or denied. This service represents the |Authorization Checker|. The implementation of the Platform specific attributes and objects is in |AuthorizationChecker class|.

The main entry point is the `isGranted` method:

.. code-block:: php

   isGranted($attribute, $subject = null)

**$attribute** can be a role name, permission name, an ACL annotation id, a string in format ``permission;descriptor`` (e.g., ``VIEW;entity:Acme\DemoBundle\Entity\AcmeEntity`` or ``EXECUTE;action:acme_action``) or some other identifiers depending on registered security voters.

**$object** can be an entity type descriptor (e.g., ``entity:Acme/Bundle/DemoBundle/Entity/AcmeEntity`` or ``action:some_action``), an entity object, instance of `ObjectIdentity`, `DomainObjectReference` or `DomainObjectWrapper`

**Examples**

Checking access to some ACL annotation resource

.. code-block:: php

    $this->authorizationChecker->isGranted('some_resource_id')

Checking VIEW access to the entity by class name

.. code-block:: php

    $this->authorizationChecker->isGranted('VIEW', 'entity:' . MyEntity::class);


Checking VIEW access to the entity's field

.. code-block:: php

    $this->authorizationChecker->isGranted('VIEW', new FieldVote($entity, $fieldName));


Checking ASSIGN access to the entity object

.. code-block:: php

    $this->authorizationChecker->isGranted('ASSIGN', $myEntity);


Checking access is performed in the following way: **Object-Scope**->**Class-Scope**->**Default Permissions**.

For example, we are checking View permission to $myEntity object of MyEntity class. When we call

.. code-block:: php

    $this->authorizationChecker->isGranted('VIEW', $myEntity);

The first ACL for `$myEntity` object is checked; if nothing is found, it checks the ACL for the `MyEntity` class. It checks the Default(root) permissions if no records are found.

Two additional authorization checkers can also be helpful:

* |ClassAuthorizationChecker|
* |RequestAuthorizationChecker|

Restricting Access to Non-Entity Resources
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Sometimes, you only want to allow or deny access to a specific part of your application without protecting an entity. To achieve this, use a particular ``action`` type for an ACL:

.. oro_integrity_check:: b82716928f5c34e750dd8d4f72d504bee3f42eb4

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 69-92

.. oro_integrity_check:: 396975d9c16edb0077204098f734423658f5ea0c

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/acls.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/acls.yml
        :language: yaml
        :lines: 1, 9-10

Manual Access Check on an Object Field
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

The developer can check access to the given entity field by passing the instance `FieldVote` class to the `isGranted` method of the |Authorization Checker|:

.. oro_integrity_check:: 4be27a5276684111e8b742407a6fd637d2ed27de

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 49-67


Check ACL for Search Queries
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

When collecting entities to search, information about the owner and the organization is automatically added to the search index.

Every search query is ACL protected with Search ACL helper. This helper limits data with the current access levels for entities used in the query.

Organization Context
^^^^^^^^^^^^^^^^^^^^

As mentioned previously, each record is associated with an owning organization. When a user logs into the system,
they work in the scope of one of their organizations.

In Enterprise editions, a user can be assigned to multiple organizations.

During the login, if the security token supports organizations, then the current organization in the token is replaced with the preferred one. The first available organization is used if a user logs into the system for the first time.

After the login, the user can switch their current organization.

For the security token to ignore the preferable organization, for example, an API token, add its class name to the  `ignore_preferred_organization_tokens` parameter of the `OrganizationPro` bundle in the app.yml file of your bundle:

.. oro_integrity_check:: af4d28ce059352f6de82cfd41083531a58009e3a

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: yaml
        :lines: 96-98

.. admonition:: Business Tip

   Discover how |digital transformation in manufacturing| improves operations, customer experiences, and sales by reading our guide.


.. include:: /include/include-links-dev.rst
    :start-after: begin

.. include:: /include/include-links-seo.rst
    :start-after: begin

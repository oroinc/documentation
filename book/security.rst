.. index::
    single: Security

Security
========

Introduction
------------

The `OroSecurityBundle`_ sits on top of the Symfony security layer to reach protect your resources.
This means that each user of your application is granted access to a particular subset of your
company's resources. Coincidentally, they have to be prevented from accessing resources, access was
not granted on to them.

Access Control Lists
--------------------

Access Control Lists are an essential part of the `Symfony Security component`_. They are leveraged
by the OroSecurityBundle to fulfill the requirements of companies in the business context.

Access Levels
~~~~~~~~~~~~~

Access can be granted to a user for a certain resource on the several levels. The lowest level is
the *User* level. Being at this level means that a user can only access resources that have been
assigned to them. At the other end of the hierarchy is the *System* level. Users at this level have
the permission to access all records within the whole system without exception. The security bundle
comes with the following five levels (ordered up from the bottom of the hierarchy):

+-----------------+------------------+-----------------------------------------------------------+
| Level           | Constant         | Description                                               |
+=================+==================+===========================================================+
| *User*          | ``BASIC_LEVEL``  | The user is granted access to their own records.          |
+-----------------+------------------+-----------------------------------------------------------+
| *Business Unit* | ``LOCAL_LEVEL``  | The user is given access to the records in records in all |
|                 |                  | business units they are assign to.                        |
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
| *System*        | ``SYSTEM_LEVEL`` | The user can access all objects within the system.        |
+-----------------+------------------+-----------------------------------------------------------+

Each record is associated an owning organization. When a user logs into the system, they work in
the scope of one of their organizations. If a user is member in several organizations, they can
switch the organization scope that is used to perform access checks.

.. note::

    For all access levels, there is a class constant defined in the
    :class:`Oro\\Bundle\\SecurityBundle\\Acl\\AccessLevel` class. Its value is shown in the
    *Constant* column.

    There are two special constants ``AccessLevel::UNKNOWN`` (unknown acccess level, should not be
    assign to a user) and ``AccessLevel::NONE_LEVEL`` (globally deny access for the user).

.. _permissions:

Permissions
~~~~~~~~~~~

A user can be assigned different modes to a resource. These modes describe what they are allowed to
do with the resource. Namely, these permissions are:

+------------+---------------------------------------------------------------------------+
| Permission |                                                                           |
+============+===========================================================================+
| ``VIEW``   | Whether or not a user is allowed to view a record.                        |
+------------+---------------------------------------------------------------------------+
| ``CREATE`` | Whether or not a user is allowed to create a record.                      |
+------------+---------------------------------------------------------------------------+
| ``EDIT``   | Whether or not a user is allowed to modify a record.                      |
+------------+---------------------------------------------------------------------------+
| ``DELETE`` | Whether or not a user is allowed to delete a record.                      |
+------------+---------------------------------------------------------------------------+
| ``ASSIGN`` | Whether or not a user is allowed to assign a record to another user. This |
|            | permission is only evaluated when an entity is edited.                    |
+------------+---------------------------------------------------------------------------+

.. seealso::

    Read the official documentation for a first insight in the `usage of ACLs`_ and more
    `complex Access Control List`_ examples.

Configuring Entities
--------------------

To be able to protect the access to your entities, you first have to configure which permissions
can be granted for a user to them. Use the ``security`` scope in the ``defaultValues`` section of
the ``@Config`` annotation:

.. code-block:: php-annotations
    :linenos:

    // src/Acme/DemoBundle/Entity/Product.php
    namespace Acme\DemoBundle\Entity;

    use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;

    /**
     * @Config(
     *   defaultValues={
     *     ...
     *     "security"={
     *       "type"="ACL",
     *       "permissions"="All",
     *       "group_name="DemoGroup"
     *   }
     * )
     */
    class Product
    {
        // ...
    }

By default (or when using the special ``ALL`` value for the ``permissions`` property as in the
example above), any :ref:`available permission <permissions>` can be granted to a user on an
entity. If you want to restrict the available permissions for an entity, you can list them
separated explicitly. For example, you limit it to the ``VIEW`` and ``EDIT`` permissions:

.. code-block:: php-annotations
    :linenos:

    /**
     * ...
     *     "security"={
     *       "type"="ACL",
     *       "permissions"="VIEW;EDIT",
     *       "group_name"="DemoGroup"
     *     }
     * ...
     */

Protecting Resources
--------------------

After having configured which permissions a user can be granted on a particular entity, you have to
make sure that the permissions are taken into account when checking if a user has access to a
resource. Depending on the resource, this check can be performed automatically by the
OroSecurityBundle or requires some additional configuration by you.

Restricting Access to Controller Methods
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Supposed that you have configured an entity to be protectable via ACLs and that you have granted to
some of its objects to a set of users, you can now control who can enter certain resources through
a controller method. Restricting access can be done in two different ways:

#. Use the ``@Acl`` annotation on a controller method, providing the entity class name and the
   permission to check for:

   .. code-block:: php-annotations
       :linenos:

       // src/Acme/DemoBundle/Controller/ProductController.php
       namespace Acme\DemoBundle\Controller;

       use Oro\Bundle\SecurityBundle\Annotation\Acl;
       use Symfony\Bundle\FrameworkBundle\Controller\Controller;

       class ProductController extends Controller
       {
           /**
            * @Acl(
            *   id="product_edit",
            *   type="entity",
            *   class="AcmeDemoBundle:Product",
            *   permission="EDIT"
            * )
            */
           public function editAction()
           {
               // ...
           }
       }

#. When you are in the need to perform a particular check repeatedly, writing the ``@Acl`` over and
   over again becomes a tedious task. This becomes even more a serious issue when your requirements
   change and you have to change a lot of ACLs. Luckily, you can configure an ACL globally in your
   bundle configuration and refer to using the ACL id using the ``@AclAncestor`` annotation.

   The ACL configuration from the example above looks like this:

   .. code-block:: yaml
       :linenos:

       # src/Acme/DemoBundle/Resources/config/oro/acl.yml
       product_edit:
           type: entity
           class: AcmeDemoBundle:Product
           permission: EDIT

   The annotation of your controller method becomes a lot smaller then:

   .. code-block:: php-annotations
      :linenos:

       // src/Acme/DemoBundle/Controller/ProductController.php
       namespace Acme\DemoBundle\Controller;

       use Oro\Bundle\SecurityBundle\Annotation\AclAncestor;
       use Symfony\Bundle\FrameworkBundle\Controller\Controller;

       class ProductController extends Controller
       {
           /**
            * @AclAncestor("product_edit")
            */
           public function editAction()
           {
               // ...
           }
       }

   Sometimes you want to protect a controller method coming from code that you do not control.
   Therefore, you cannot add the ``@AclAncestor`` annotation to it. Use the ``bindings`` key in the
   YAML configuration of your ACL to define which method(s) should be protected:

   .. code-block:: yaml
       :linenos:

       # src/Acme/DemoBundle/Resources/config/oro/acl.yml
       product_edit:
           type: entity
           class: AcmeDemoBundle:Product
           permission: EDIT
           bindings:
               - class: Acme\DemoBundle\Controller\ProductController
                 method: editAction

.. seealso::

    You can read detailed explanations for all available YAML configuration options
    :doc:`in the reference section </reference/format/acl>`.

Using Param Converters
~~~~~~~~~~~~~~~~~~~~~~

When the ``@Acl`` annotation is used without a param converter, the user's permission is checked
on the class level. This means that the user is granted access as long as their access level is
not ``NONE``.

When using the `@ParamConverter annotation`_ from the SensioFrameworkExtraBundle together with the
``@Acl`` annotation, the routing parameters are first converted into the corresponding Doctrine
entity object. Then, access will be checked based on the queried object.

.. seealso::

    It is also possible :ref:`to protect Doctrine queries <book-security-protecting-dql-queries>`.

Data Grids
~~~~~~~~~~

Records that are part of a data grid are automatically protected by the OroSecurityBundle. View
permissions are attached to each record of a data grid.

.. _book-security-protecting-dql-queries:

Protecting Custom DQL Queries
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

When building custom Doctrine DQL queries, you may want to reduce the result set being returned to
the set of domain objects the user is granted access to. To achieve this, use the ACL helper
provided by the OroSecurityBundle::

    // src/Acme/DemoBundle/Controller/DemoController.php
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;

    class DemoController extends Controller
    {
        public function protectedAction()
        {
            $repository = $this->getDoctrine()->getRepository('AcmeDemoBundle:Product');
            $queryBuilder = $repository
                ->createQueryBuilder('p');
                ->where('p.price > :price')
                ->orderBy('p.price', 'ASC')
                ->setParameter('price', 19.99);
            $aclHelper = $this->get('oro_security.acl_helper');
            $query = $aclHelper->apply($queryBuilder, 'VIEW');

            // ...
        }
    }

In this example, first a query is built which selects all products from the database which are more
expensive than ``19.99`` order by their price. Then, the query builder is passed to the ``apply()``
method of the ``oro_security.acl_helper`` service. This service, an instance of the
:class:`Oro\\Bundle\\SecurityBundle\\ORM\\Walker\\AclHelper` class, modifies the query to only
return entities the user has access to.

Manual Access Checks
~~~~~~~~~~~~~~~~~~~~

If you need to manually check the access of the current user to a certain object, you can use the
``isGranted()`` method from the ``oro_security.security_facade`` service for this::

    // src/Acme/DemoBundle/Controller/DemoController.php
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;

    class DemoController extends Controller
    {
        public function protectedAction()
        {
            $entity = ...;
            $securityFacade = $this->get('oro_security.security_facade');

            if (!$securityFacade->isGranted('VIEW', $entity)) {
                throw new AccessDeniedException();
            }

            // ...
        }
    }

.. sidebar:: Restricting Access to "Non-Entity" Resources

    Sometimes you don't want to protect an entity but just want to allow or deny access to a
    certain part of your application. To achieve this, use the special ``action`` type for an ACL:

    .. configuration-block::

        .. code-block:: php-annotations
            :linenos:

            // ...

            /**
             * @Acl(
             *   id="protected_action",
             *   type="action"
             * )
             */
            public function protectedAction()
            {
                // ...
            }

        .. code-block:: yaml
            :linenos:

            # src/Acme/DemoBundle/Resources/config/oro/acl.yml
            protected_action:
                type: action

Examples
--------

The following sections provide some insight on how the ACL checks work. It is assumed that there
are two organizations, *Main Organization* and *Second Organization*. The *Main Organization*
contains the *Main Business Unit*, *Second Organization* contains *Second Business Unit*.
*Child Business Unit* is a subordinate of *Second Business Unit*. Additionally, the following users
have been created:

+--------+-------------------------+--------------------------+------------------------+
| User   | Created in Organization | Created in Business Unit | Assigned to            |
+========+=========================+==========================+========================+
| John   | Main Organization       | Main Business Unit       | - Main Business Unit   |
|        |                         |                          | - Child Business Unit  |
+--------+-------------------------+--------------------------+------------------------+
| Mary   | Main Organization       | Main Business Unit       | - Main Business Unit   |
|        |                         |                          | - Second Business Unit |
+--------+-------------------------+--------------------------+------------------------+
| Mike   | Second Organization     | Child Business Unit      | - Child Business Unit  |
+--------+-------------------------+--------------------------+------------------------+
| Robert | Second Organization     | Second Business Unit     | - Main Business Unit   |
|        |                         |                          | - Second Business Unit |
+--------+-------------------------+--------------------------+------------------------+
| Mark   | Second Organization     | Second Business Unit     |                        |
+--------+-------------------------+--------------------------+------------------------+

User Ownership
~~~~~~~~~~~~~~

Imagine that each user created two accounts (one in *Main Organization* and one in *Second
Organization*):

==========  =================  ===================
Created by  Main Organization  Second Organization
==========  =================  ===================
John        Account A          Account E
Mary        Account B          Account F
Mike        Account G          Account C
Robert      Account H          Account D
Mark        Account I          Account J
==========  =================  ===================

.. image:: /book/img/security/user-ownership.png

The users can now access the accounts depending on the organization context they login into as
described below:

John
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| User          | - Account A       | - Account E         |
+---------------+-------------------+---------------------+
| Business Unit | - Account A       | - Account E         |
|               | - Account B       | - Account C         |
|               | - Account H       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account E         |
|               | - Account B       | - Account C         |
|               | - Account H       |                     |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account E         |
|               | - Account B       | - Account C         |
|               | - Account H       | - Account D         |
|               | - Account G       | - Account F         |
|               | - Account I       | - Account J         |
+---------------+-------------------+---------------------+

Mary
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| User          | - Account B       | - Account F         |
+---------------+-------------------+---------------------+
| Business Unit | - Account B       | - Account F         |
|               | - Account A       | - Account D         |
|               | - Account H       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account B       | - Account F         |
|               | - Account A       | - Account D         |
|               | - Account H       | - Account C         |
|               |                   | - Account E         |
+---------------+-------------------+---------------------+
| Organization  | - Account B       | - Account F         |
|               | - Account A       | - Account D         |
|               | - Account H       | - Account C         |
|               | - Account G       | - Account E         |
|               | - Account I       | - Account J         |
+---------------+-------------------+---------------------+

Mike
....

The user Mike cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account C         |
+---------------+---------------------+
| Business Unit | - Account C         |
|               | - Account E         |
+---------------+---------------------+
| Division      | - Account C         |
|               | - Account E         |
+---------------+---------------------+
| Organization  | - Account C         |
|               | - Account E         |
|               | - Account D         |
|               | - Account F         |
|               | - Account J         |
+---------------+---------------------+

Robert
......

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| User          | - Account H       | - Account D         |
+---------------+-------------------+---------------------+
| Business Unit | - Account H       | - Account D         |
|               | - Account A       | - Account F         |
|               | - Account B       | - Account E         |
+---------------+-------------------+---------------------+
| Division      | - Account H       | - Account D         |
|               | - Account A       | - Account F         |
|               | - Account B       | - Account E         |
|               |                   | - Account C         |
+---------------+-------------------+---------------------+
| Organization  | - Account H       | - Account D         |
|               | - Account A       | - Account F         |
|               | - Account B       | - Account E         |
|               | - Account G       | - Account C         |
|               | - Account I       | - Account J         |
+---------------+-------------------+---------------------+

Mark
....

The user Mark cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account J         |
+---------------+---------------------+
| Business Unit | - Account J         |
+---------------+---------------------+
| Division      | - Account J         |
+---------------+---------------------+
| Organization  | - Account J         |
|               | - Account F         |
|               | - Account E         |
|               | - Account C         |
|               | - Account D         |
+---------------+---------------------+

Business Unit Ownership
~~~~~~~~~~~~~~~~~~~~~~~

When the ownership type is *"Business Unit"*, access cannot be granted on the user level. The
minimum acccess level is the Business Unit level.

Imagine that the following data has been created:

=========  ===================  ===============
Account    Organization         Business Unit
=========  ===================  ===============
Account A  Main Organization    Business Unit A
Account B  Main Organization    Business Unit A
Account C  Second Organization  Business Unit C
Account D  Second Organization  Business Unit B
Account E  Second Organization  Business Unit B
=========  ===================  ===============

.. image:: /book/img/security/business-unit-ownership.png

The users can now access the accounts as described below:

John
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| Business Unit | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account C         |
|               | - Account B       | - Account D         |
|               |                   | - Account E         |
+---------------+-------------------+---------------------+

Mary
....

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| Business Unit | - Account A       | - Account D         |
|               | - Account B       | - Account E         |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account D         |
|               | - Account B       | - Account E         |
|               |                   | - Account C         |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account D         |
|               | - Account B       | - Account E         |
|               |                   | - Account C         |
+---------------+-------------------+---------------------+

Mike
....

The user Mark cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account J         |
+---------------+---------------------+
| Business Unit | - Account J         |
+---------------+---------------------+
| Division      | - Account J         |
+---------------+---------------------+
| Organization  | - Account J         |
|               | - Account F         |
|               | - Account E         |
|               | - Account C         |
|               | - Account D         |
+---------------+---------------------+

Robert
......

+---------------+-------------------+---------------------+
| Access Level  | Main Organization | Second Organization |
+===============+===================+=====================+
| Business Unit | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Division      | - Account A       | - Account C         |
|               | - Account B       |                     |
+---------------+-------------------+---------------------+
| Organization  | - Account A       | - Account C         |
|               | - Account B       | - Account D         |
|               |                   | - Account E         |
+---------------+-------------------+---------------------+

Mark
....

The user Mark cannot login into the *Main Organization*.

+---------------+---------------------+
| Access Level  | Second Organization |
+===============+=====================+
| User          | - Account J         |
+---------------+---------------------+
| Business Unit | - Account J         |
+---------------+---------------------+
| Division      | - Account J         |
+---------------+---------------------+
| Organization  | - Account J         |
|               | - Account F         |
|               | - Account E         |
|               | - Account C         |
|               | - Account D         |
+---------------+---------------------+

Organization Ownership
~~~~~~~~~~~~~~~~~~~~~~

When the ownership type is *"Organization"*, access cannot be granted on the user level, the
business level or the division level. The minimum acccess level is the Organization level.

Imagine that the following data has been created:

=========  ===================
Account    Organization
=========  ===================
Account A  Main Organization
Account B  Main Organization
Account C  Second Organization
Account D  Second Organization
Account E  Second Organization
=========  ===================

.. image:: /book/img/security/organization-ownership.png

The users can now access the accounts as described below:

John, Mary, Robert
..................

+--------------+-------------------+---------------------+
| Access Level | Main Organization | Second Organization |
+==============+===================+=====================+
| Organization | - Account A       | - Account C         |
|              | - Account B       | - Account D         |
|              |                   | - Account E         |
+--------------+-------------------+---------------------+

Mike, Mark
..........

The users cannot login into the *Main Organization*.

+--------------+---------------------+
| Access Level | Second Organization |
+==============+=====================+
| Organization | - Account C         |
|              | - Account D         |
|              | - Account E         |
+--------------+---------------------+

.. _`OroSecurityBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/SecurityBundle
.. _`Symfony Security component`: http://symfony.com/doc/current/components/security/introduction.html
.. _`usage of ACLs`: http://symfony.com/doc/current/cookbook/security/acl.html
.. _`complex Access Control List`: http://symfony.com/doc/current/cookbook/security/acl_advanced.html
.. _`@ParamConverter annotation`: http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html

.. _bundle-docs-platform-security-bundle-intro:

Introduction to Security in Oro Applications
============================================

.. contents:: :local:
   :depth: 3

The `OroSecurityBundle`_ sits on top of the Symfony security layer to reach protect your resources.
This means that each user of your application is granted access to a particular subset of your
company's resources. Coincidentally, they have to be prevented from accessing resources, access was
not granted to them.

.. _bundle-docs-platform-security-bundle-access-control-list:

Access Control Lists
^^^^^^^^^^^^^^^^^^^^

Access Control Lists are an essential part of the `Symfony Security component`_. They are leveraged
by the OroSecurityBundle to fulfill the requirements of companies in the business context.

.. hint:: You can find detailed information about Symfony ACL based security model in the Symfony documentation:

           * http://symfony.com/doc/current/cookbook/security/acl.html
           * http://symfony.com/doc/current/cookbook/security/acl_advanced.html

Access Levels
~~~~~~~~~~~~~

Access can be granted to a user for a certain resource on several levels. The lowest level is
the *User* level. Being on this level means that users can only access resources that have been
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
| *Global*        | ``SYSTEM_LEVEL`` | The user can access all objects within the system.        |
|                 |                  |                                                           |
|                 |                  | .. note:: This level is available only in Enterprise      |
|                 |                  |           editions. Global access level makes sense if    |
|                 |                  |           the user works in the scope of a global         |
|                 |                  |           organization. If the user works in the scope    |
|                 |                  |           of an ordinary organization, global level       |
|                 |                  |           equals organization.                            |
+-----------------+------------------+-----------------------------------------------------------+

Each record is associated with an owning organization. When a user logs into the system, they work in
the scope of one of their organizations. If a user is a member in several organizations, they can
switch the organization scope that is used to perform access checks.

Every record of a security protected entity with ownership type User, Business unit and Organization has an organization.

.. note::

    For all access levels, there is a class constant defined in the `Oro\\Bundle\\SecurityBundle\\Acl\\AccessLevel` class. Its value is shown in the *Constant* column.

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
| ``SHARE``  | **Enterprise Edition**                                                    |
|            | Whether or not a user is allowed to assign a record to another user.      |
|            | Only works on entities' view pages.                                       |
+------------+---------------------------------------------------------------------------+

.. seealso::

    Read the official documentation for a first insight in the `usage of ACLs`_ and more
    `complex Access Control List`_ examples.

The following permissions are supported for **fields**:

+------------+---------------------------------------------------------------------------+
| Permission |                                                                           |
+============+===========================================================================+
| ``VIEW``   | Whether or not a user is allowed to view a field.                         |
+------------+---------------------------------------------------------------------------+
| ``EDIT``   | Whether or not a user is allowed to modify a field.                       |
+------------+---------------------------------------------------------------------------+

.. _bundle-docs-platform-security-bundle-configure-entities:

Configuring Permissions for Entities
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To be able to protect access to your entities, you first have to configure which permissions
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
     *       "group_name"="DemoGroup"
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

.. _bundle-docs-platform-security-bundle-protect-resources:

Protecting Resources
^^^^^^^^^^^^^^^^^^^^

After having configured which permissions a user can be granted to a particular entity, you have to
make sure that the permissions are taken into account when checking if a user has access to a
resource. Depending on the resource, this check can be performed automatically by the
OroSecurityBundle or require some additional configuration made by you.

Restricting Access to Controller Methods
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

Let us assume that you have configured an entity to be protectable via ACLs. You have granted
some of its objects to a set of users. Now you can control who can enter certain resources through
the controller method. Restricting access can be done in two different ways:

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

#. When you need to perform a particular check repeatedly, writing ``@Acl`` over and
   over again becomes a tedious task. This becomes even a more serious issue when your requirements
   change and you have to change a lot of ACLs. Luckily, you can configure an ACL globally in your
   bundle configuration and refer to using the ACL id using the ``@AclAncestor`` annotation.

   The ACL configuration from the example above looks like this:

   .. code-block:: yaml
       :linenos:

       # src/Acme/DemoBundle/Resources/config/oro/acls.yml
       acls:
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

       # src/Acme/DemoBundle/Resources/config/oro/acls.yml
       acls:
           product_edit:
               type: entity
               class: AcmeDemoBundle:Product
               permission: EDIT
               bindings:
                   - class: Acme\DemoBundle\Controller\ProductController
                     method: editAction

.. seealso::

    You can read detailed explanations for all available YAML configuration options
    `in the reference section <https://oroinc.com/orocrm/doc/current/reference/format/acls>`__.

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
permissions are attached to each record of the data grid.

.. _book-security-protecting-dql-queries:

Protecting Custom DQL Queries
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

When building custom DQL queries, you may want to reduce the result set being returned to
the set of domain objects the user is granted access to. To achieve this, use the ACL helper
provided by the OroSecurityBundle:

.. code-block:: php
   :linenos:

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

In this example, first, a query is built that selects all products from the database which are more
expensive than ``19.99`` order by their price. Then, the query builder is passed to the ``apply()``
method of the ``oro_security.acl_helper`` service. This service, an instance of the
:class:`Oro\\Bundle\\SecurityBundle\\ORM\\Walker\\AclHelper` class, modifies the query only to the
return entities the user has access to.

Manual Access Checks
~~~~~~~~~~~~~~~~~~~~

If you need to manually check the access of the current user to a certain object, you can use the
``isGranted()`` method from the ``security.authorization_checker`` service for this:

.. code-block:: php
   :linenos:

    // src/Acme/DemoBundle/Controller/DemoController.php
    namespace Acme\DemoBundle\Controller;

    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    use Symfony\Component\Security\Core\Exception\AccessDeniedException;

    class DemoController extends Controller
    {
        public function protectedAction()
        {
            $entity = ...;

            if (!$this->isGranted('VIEW', $entity)) {
                throw new AccessDeniedException();
            }

            // ...
        }
    }

.. sidebar:: Restricting Access to "Non-Entity" Resources

    Sometimes you do not want to protect an entity but just want to allow or deny access to a
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

            # src/Acme/DemoBundle/Resources/config/oro/acls.yml
            acls:
                protected_action:
                    type: action



.. _`OroSecurityBundle`: https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/SecurityBundle
.. _`Symfony Security component`: http://symfony.com/doc/current/components/security/introduction.html
.. _`usage of ACLs`: http://symfony.com/doc/current/cookbook/security/acl.html
.. _`complex Access Control List`: http://symfony.com/doc/current/cookbook/security/acl_advanced.html
.. _`@ParamConverter annotation`: http://symfony.com/doc/current/bundles/SensioFrameworkExtraBundle/annotations/converters.html
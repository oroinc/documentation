.. _backend-security-bundle-field-acl:

Field ACL
=========

Field ACL allows checking access to an entity field and supports the following permissions: **VIEW, CREATE, EDIT**.

Prepare the System for Field ACL
--------------------------------

By default, entity fields are not protected by ACL. The templates, datagrids, and other parts of the system that use the entity that should be Field ACL protected do not have such checks.

Before enabling the support of the Field ACL for an entity, prepare the system parts that use the entity to use Field ACL.

Check Field ACL in PHP Code
---------------------------

In PHP code, access to the field is provided by the `isGranted` method of the `security.authorization_checker` service.

The second parameter of this method should be an instance of |FieldVote|:

.. oro_integrity_check:: 0c7bc2a11bf80cc0cd62ca4bf0b27c9dfbd1905b

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 45-61

As a result, the $isGranted variable contains the *true* value if access is granted and the *false* value if it does not.

The $entity parameter should contain an instance of the entity you want to check.

If you have no entity instance, but you know a class name, the ID of the record, the owner, and the organization IDs of this record, the |DomainObjectReference|] can be used as the domain object:

.. code-block:: php

    // ....
    use Oro\Bundle\SecurityBundle\Acl\Domain\DomainObjectReference;
    use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
    use Symfony\Component\Security\Acl\Voter\FieldVote;
    // ...

    $entityReference = new DomainObjectReference($entityClassName, $entityId, $ownerId, $organizationId);
    $isGranted = $this->authorizationChecker->isGranted('VIEW', new FieldVote($entityReference, 'fieldName'));


Check Field ACL in TWIG Templates
---------------------------------

Use the `is_granted` twig function to check grants in twig templates. To check the field, use the field name as the third parameter of the function:

.. code-block:: php

    {% if is_granted('VIEW', entity, 'fieldName') %}
        {# do some job #}
    {% endif %}

.. _backend-security-bundle-field-acl-enable-support:

Enable Support of Field ACL for an Entity
-----------------------------------------

To manage field ACL, add the `field_acl_supported` attribute to the 'security' scope of the entity config.

Enabling this attribute means the system is prepared to check access to the entity fields.

You can achieve this with the Config annotation if you have access to both the entity and the process `oro:platform:update` command.

The following example is an illustration of the entity configuration:

.. oro_integrity_check:: 0ee51ea5be63aa10f1909fd2181c3d1c9292d29c

    .. literalinclude:: /code_examples/commerce/demo/Entity/Favorite.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Favorite.php
        :language: php
        :lines: 1-38, 93

If you have no access to the entity to modify the Config annotation, set the `field_acl_supported` parameter with the migration:

.. oro_integrity_check:: a1a6ff26bc1cd03c3c169f035fd6061ba57daf75

    .. literalinclude:: /code_examples/commerce/demo/Migrations/Schema/v1_8/TurnFieldAclSupportForFavorites.php
        :caption: src/Acme/Bundle/DemoBundle/Migrations/Schema/v1_8/TurnFieldAclSupportForFavorites.php
        :language: php
        :lines: 1-27

Enable Field ACL
----------------

Once the configuration is changed, the entity config page has two additional parameters: Field Level ACL and Show Restricted.

.. note::
    Please do not enable these parameters from the code without enabling the `field_acl_supported` attribute for the entity.

With the `Field Level ACL` parameter, the system manager can enable or disable Field ACL for the entity.

When both the *Show Restricted* and *Field ACL* options are enabled, but a user does not have access to the field, this field is displayed in a read-only format on the create and edit pages.

Limit Permissions List
----------------------

A developer can limit the list of available permissions for the field with the `permissions` parameter in the Security scope.

The permissions should be listed as the string with the `;` delimiter.

For example:

.. oro_integrity_check:: 04c0180ebee59a0192cefde3c44b9ca9e765af90

    .. literalinclude:: /code_examples/commerce/demo/Entity/Favorite.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Favorite.php
        :language: php
        :lines: 1-38, 54-56, 93


.. include:: /include/include-links-dev.rst
   :start-after: begin

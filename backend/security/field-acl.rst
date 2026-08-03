.. _backend-security-bundle-field-acl:

Field ACL
=========

Field ACL allows checking access to an entity field and supports the following permissions: **VIEW, CREATE, EDIT**.

Prepare the System for Field ACL
--------------------------------

By default, entity fields are not protected by ACL. The templates, datagrids, and other parts of the system that use the entity do not perform such checks.

Before you enable Field ACL for an entity, prepare the system parts that use the entity to check it.

Check Field ACL in PHP Code
---------------------------

In PHP code, the `isGranted` method of the `security.authorization_checker` service checks access to the field.

The second parameter of this method should be an instance of |FieldVote|:

.. oro_integrity_check:: 0c7bc2a11bf80cc0cd62ca4bf0b27c9dfbd1905b

    .. literalinclude:: /code_examples/commerce/demo/Controller/FavoriteController.php
        :caption: src/Acme/Bundle/DemoBundle/Controller/FavoriteController.php
        :language: php
        :lines: 45-61

As a result, the $isGranted variable is *true* if access is granted and *false* otherwise.

The $entity parameter should contain an instance of the entity you want to check.

If you have no entity instance but know the class name, the record ID, the owner ID, and the organization ID of this record, you can use the |DomainObjectReference| as the domain object:

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

This attribute tells the system it is prepared to check access to the entity fields.

You can achieve this with the Config annotation if you have access to both the entity and the process `oro:platform:update` command.

The following example illustrates the entity configuration:

.. oro_integrity_check:: 40c6278664e7bc22c3c94c76a2624e7c5e7d0b9b

    .. literalinclude:: /code_examples/commerce/demo/Entity/Favorite.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Favorite.php
        :language: php
        :lines: 1-38, 93

If you cannot modify the Config annotation on the entity, set the `field_acl_supported` parameter with a migration:

.. oro_integrity_check:: 751dd18f13a127dd9b15bf133176078b5d314d80

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

When both the *Show Restricted* and *Field ACL* options are enabled but a user lacks access to the field, the field appears in read-only format on the create and edit pages.

Limit Permissions List
----------------------

A developer can limit the available permissions for the field with the `permissions` parameter in the Security scope.

List the permissions as a string with the `;` delimiter.

For example:

.. oro_integrity_check:: 209af7c4b4dd1f646fbb784d91b657f27b6d5438

    .. literalinclude:: /code_examples/commerce/demo/Entity/Favorite.php
        :caption: src/Acme/Bundle/DemoBundle/Entity/Favorite.php
        :language: php
        :lines: 1-38, 54-56, 93


.. include:: /include/include-links-dev.rst
   :start-after: begin

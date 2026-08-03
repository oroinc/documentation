.. _backend-security-bundle-acl-manager:

ACL Manager
===========

The ACL manager (`oro_security.acl.manager` service) handles internal ACL operations. Use it when you need custom ACL operations.

To check whether the ACL system is enabled in the current application, use the **isAclEnabled** function. It returns true or false.

**EXAMPLES OF ACL MANAGER USAGE**

Setting VIEW and EDIT class-based permissions to the `MyBundle:MyEntity` class for the Manager Role:

.. oro_integrity_check:: 77979bbdd628c16007699e2fde71e1c1a542d8f1

    .. literalinclude:: /code_examples/commerce/demo/Helper/AcmeAclManagerHelper.php
        :caption: src/Acme/Bundle/DemoBundle/Helper/AcmeAclManagerHelper.php
        :language: php
        :lines: 14-35


Granting `some_action_id` capability for the Manager Role:

.. oro_integrity_check:: 0452eed4d4b4e6fa5df642e4c5ad3da0e69324a5

    .. literalinclude:: /code_examples/commerce/demo/Helper/AcmeAclManagerHelper.php
        :caption: src/Acme/Bundle/DemoBundle/Helper/AcmeAclManagerHelper.php
        :language: php
        :lines: 14-18, 37-52

The **getSid function** returns the security identity for the given parameter. Parameters of the function can be:

 - **string**. In this case, security identity is taken from the role with the name set as a parameter;
 - **RoleInterface**. Returns SID for the current role object
 - **UserInterface**. Creates a user security identity from a UserInterface
 - **UserInterface**. Creates a user security identity from a TokenInterface

The **getOid** function constructs an ObjectIdentity for the given domain object or based on the given descriptor.

The descriptor is a string in the following format: "ExtensionKey:Class"

Examples:

 - getOid($object);
 - getOid('entity:AcmeDemoBundle\SomeClass')
 - getOid('entity:AcmeDemoBundle:SomeEntity')
 - getOid('action:some_action')

The **getMaskBuilder** function gets the new instance of the mask builder, which can be used to build a permission bitmask for an object with the given object identity.

An ACL extension can support several masks, so provide any permission supported by the expected mask builder instance. Each mask is stored in its own ACE.

The 'Entity' extension is an example of an ACL extension that supports several masks (see EntityAclExtension class).

You can also omit the $permission argument. In this case, the default mask builder is returned.

For example, the following calls return the same mask builder:

.. code-block:: php

    $manager->getMaskBuilder($manager->getOid('entity: AcmeDemoBundle:SomeEntity'))
    $manager->getMaskBuilder($manager->getOid('entity: AcmeDemoBundle:SomeEntity'), 'VIEW')
    $manager->getMaskBuilder($manager->getOid('entity: AcmeDemoBundle:SomeEntity'), 'DELETE')


This is because the VIEW, CREATE, EDIT, DELETE and ASSIGN permissions are supported by the EntityMaskBuilder class, and it is the default mask builder for the 'Entity' extension.

If you are sure that an ACL extension supports only one mask, you can also omit the $permission argument.

For example, the following calls are identical:

.. code-block:: php

    $manager->getMaskBuilder($manager->getOid('action:acme_action'))
    $manager->getMaskBuilder($manager->getOid('action:acme_action'), 'EXECUTE')


The **setPermission** function updates or creates an object-based or class-based ACE with the given attributes.

* If the given object identity represents a domain object, the object-based ACE is set, otherwise, a class-based ACE is set.
* If the given object identity represents a "root" ACL, an object-based ACE is set.

.. code-block:: php

    $manager->setPermission(
        $sid,
        $oid,
        $mask
    );

The **setFieldPermission** function updates or creates an object-field-based or class-field-based ACE with the given attributes.

If the given object identity represents a domain object, an object-field-based ACE is set. Otherwise, a class-field-based ACE is set.

The **deletePermission** function deletes an object-based or class-based ACE, and the **deleteFieldPermission** function deletes an object-field-based or class-field-based ACE, both with the given attributes.

The **deleteAllPermissions** function deletes all object-based or class-based ACEs, and the **deleteAllFieldPermissions** function deletes all object-field-based or class-field-based ACEs, for the given security identity.

To get all ACL extensions registered in the system (currently, the entity and action extensions), use the **getAllExtensions** function.

After setting new ACL permissions to an object, save the changes using the **flush** function.

If an object has no access rights of its own, the access check uses the root object. To get the ObjectIdentity used for granting the default permissions, use the **getRootOid** function with the ACL extension key as a parameter.

To get the ACLs that belong to the given object identities, use the **findAcls** function. The **deleteAcl** function deletes an ACL for the given ObjectIdentity.

.. _backend-security-bundle-acl-manager:

ACL Manager
===========

ACL manager (`oro_security.acl.manager` service) is responsible for internal ACL operations and should be used when custom ACL operations are required.

To check if ACL system is enabled in the current application, use the **isAclEnabled** function that returns a true or false result.

**EXAMPLES OF ACL MANAGER USAGE**

Setting VIEW and EDIT class-based permissions to `MyBundle:MyEntity` class for the Manager Role:

.. code-block:: php
   :linenos:

    use Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager;
    ...
    public function setAclManager(AclManager $manager)
    {
        //Injecting Acl Manager
        $this->manager = $manager;
    }
    ...
    public function setViewEditPermissions()
    {
        $sid = $manager->getSid('ROLE_MANAGER');
        $oid = $manager->getOid('Entity:MyBundle:MyEntity');
        $builder = $manager->getMaskBuilder($oid);
        //building necessary permissions mask, see Acl/Extension/EntityMaskBuilder class for a list of permission constants
        $mask = $builder->add('VIEW_SYSTEM')->add('EDIT_SYSTEM')->get();

        $manager->setPermission(
            $sid,
            $oid,
            $mask
        );
        //saving permissions
        $manager->flush();
    }
    ...


Granting `some_action_id` capability for the Manager Role:

.. code-block:: php
   :linenos:

    use Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager;
    ...
    public function setAclManager(AclManager $manager)
    {
        //Injecting Acl Manager
        $this->manager = $manager;
    }
    ...
    public function setExecutePermissions()
    {
        $sid = $manager->getSid('ROLE_MANAGER');
        $oid = $manager->getOid('Action:some_action_id');
        $builder = $manager->getMaskBuilder($oid);
        //building necessary permissions mask, for actions only EXECUTE mask is currently available
        $mask = $builder->add('EXECUTE')->get();

        $manager->setPermission(
            $sid,
            $oid,
            $mask
        );
        //saving permissions
        $manager->flush();
    }
    ...

The **getSid function** returns the security identity for the given parameter. Parameters of the function can be:

 - **string**. In this case security identity is taken form the role with the name set as a parameter;
 - **RoleInterface**. Returns SID for the current role object
 - **UserInterface**.  Creates a user security identity from a UserInterface
 - **UserInterface**. Creates a user security identity from a TokenInterface

The **getOid** function constructs an ObjectIdentity for the given domain object or based on the given descriptor.

The descriptor is a string in the following format: "ExtensionKey:Class"

Examples:

 - getOid($object);
 - getOid('Entity:AcmeBundle\SomeClass')
 - getOid('Entity:AcmeBundle:SomeEntity')
 - getOid('Action:Some Action')

The **getMaskBuilder** function gets the new instance of the mask builder which can be used to build a permission bitmask for an object with the given object identity.

As one ACL extension can support several masks (each mask is stored in its own ACE; an example of ACL extension which supports several masks is the 'Entity' extension (see EntityAclExtension class) you need to provide any permission supported by the expected mask builder instance.

You can also omit the $permission argument. In this case, the default mask builder is returned.

For example, the following calls return the same mask builder:

.. code-block:: php
   :linenos:

   $manager->getMaskBuilder($manager->getOid('entity: AcmeBundle:AcmeEntity'))
   $manager->getMaskBuilder($manager->getOid('entity: AcmeBundle:AcmeEntity'), 'VIEW')
   $manager->getMaskBuilder($manager->getOid('entity: AcmeBundle:AcmeEntity'), 'DELETE')


because VIEW, CREATE, EDIT, DELETE and ASSIGN permissions are supported by the EntityMaskBuilder class and it is the default mask builder for the 'Entity' extension.

If you are sure that an ACL extension supports only one mask, you can omit the $permission argument as well.

For example, the following calls are identical:

.. code-block:: php
   :linenos:

   $manager->getMaskBuilder($manager->getOid('action: Acme Action'))
   $manager->getMaskBuilder($manager->getOid('entity: Acme Action'), 'EXECUTE')


The **setPermission**  function updates or creates object-based or class-based ACE with the given attributes.

* If the given object identity represents a domain object the object-based ACE is set, otherwise, a class-based ACE is set.
* If the given object identity represents a "root" ACL, an object-based ACE is set.

.. code-block:: php
   :linenos:

   $manager->setPermission(
       $sid,
       $oid,
       $mask
   );

The **setFieldPermission** function enables you to update or create an object-field-based or class-field-based ACE with the given attributes.

If the given object identity represents a domain object an object-field-based ACE is set. Otherwise, a class-field-based ACE is set.

The **deletePermission** and **deleteFieldPermission** functions allow to delete object-based or class-based (deletePermission) and object-field-based or class-field-based (deleteFieldPermission) ACE with the given attributes.

The **deleteAllPermissions** and **deleteAllFieldPermissions** functions deletes all object-based or class-based and object-field-based or class-field-based ACEs for the given security identity

To get all the registered ACL extensions registered in system (now it is an entity and action extension), use the **getAllExtensions** function.

After setting new ACL permissions to an object, save the changes using the **flush** function.

If an object does not get its own access rights, then the access check is on the root object. To get an ObjectIdentity used for granting the default permissions, use the **getRootOid** function with the ACL extension key as a parameter.

To get the ACLs that belong to the given object identities, use the **findAcls** function. The **deleteAcl** function deletes an ACL for the given ObjectIdentity.

<?php

namespace Acme\Bundle\DemoBundle\Helper;

use Oro\Bundle\SecurityBundle\Acl\Persistence\AclManager;

/**
 * Acl manager helper.
 */
class AcmeAclManagerHelper
{
    protected ?AclManager $manager;

    public function setAclManager(AclManager $manager): void
    {
        //Injecting Acl Manager
        $this->manager = $manager;
    }

    public function setViewEditPermissions(): void
    {
        $sid = $this->manager->getSid('ROLE_MANAGER');
        $oid = $this->manager->getOid('entity:MyBundle:MyEntity');
        $builder = $this->manager->getMaskBuilder($oid);
        //building necessary permissions mask, see Acl/Extension/EntityMaskBuilder class for a list of permission constants
        $mask = $builder->add('VIEW_SYSTEM')->add('EDIT_SYSTEM')->get();

        $this->manager->setPermission(
            $sid,
            $oid,
            $mask
        );
        //saving permissions
        $this->manager->flush();
    }

    public function setExecutePermissions(): void
    {
        $sid = $this->manager->getSid('ROLE_MANAGER');
        $oid = $this->manager->getOid('action:some_action_id');
        $builder = $this->manager->getMaskBuilder($oid);
        //building necessary permissions mask, for actions only EXECUTE mask is currently available
        $mask = $builder->add('EXECUTE')->get();

        $this->manager->setPermission(
            $sid,
            $oid,
            $mask
        );
        //saving permissions
        $this->manager->flush();
    }
}

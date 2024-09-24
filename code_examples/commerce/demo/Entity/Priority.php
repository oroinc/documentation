<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationAwareInterface;
use Oro\Bundle\UserBundle\Entity\Ownership\AuditableUserAwareTrait;

/**
 * ORM Entity Priority.
 */
#[ORM\Entity(repositoryClass: 'Acme\Bundle\DemoBundle\Entity\Repository\PriorityRepository')]
#[ORM\Table(name: 'acme_demo_priority')]
#[ORM\Index(name: 'uidx_label_doc', columns: ['label'])]
#[Config(
    routeName: 'acme_demo_priority_index',
    routeView: 'acme_demo_priority_view',
    routeCreate: 'acme_demo_priority_create',
    routeUpdate: 'acme_demo_priority_update',
    defaultValues: [
        'form' => [
            'form_type' => 'Acme\Bundle\DemoBundle\Form\Type\PriorityCreateOrSelectType',
            'grid_name' => 'acme-demo-priority-grid-select'
        ],
        'grid' => ['default' => 'acme-demo-priority-grid-select'],
        'entity' => ['icon' => 'fa-question'],
        'ownership' => [
            'owner_type' => 'USER',
            'owner_field_name' => 'owner',
            'owner_column_name' => 'user_owner_id',
            'organization_field_name' => 'organization',
            'organization_column_name' => 'organization_id'
        ],
        'security' => ['type' => 'ACL', 'group_name' => '', 'category' => ''],
        'dataaudit' => ['auditable' => true],
        'activity' => ['show_on_page' => \Oro\Bundle\ActivityBundle\EntityConfig\ActivityScope::UPDATE_PAGE]
    ]
)]
class Priority implements
    DatesAwareInterface,
    OrganizationAwareInterface,
    ExtendEntityInterface
{
    use DatesAwareTrait;
    use AuditableUserAwareTrait;
    use ExtendEntityTrait;
    //    ...
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(name: 'label', type: 'string', length: 255, nullable: false)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true], 'importexport' => ['identity' => true]])]
    private $label;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }
}

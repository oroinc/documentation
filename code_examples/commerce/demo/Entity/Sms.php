<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\ActivityBundle\Model\ActivityInterface;
use Oro\Bundle\ActivityBundle\Model\ExtendActivity;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationAwareInterface;
use Oro\Bundle\UserBundle\Entity\Ownership\AuditableUserAwareTrait;

/**
 * ORM Entity Sms.
 */
#[ORM\Entity(repositoryClass: 'Acme\Bundle\DemoBundle\Entity\Repository\SmsRepository')]
#[ORM\Table(name: 'acme_demo_sms')]
#[Config(
    routeName: 'acme_demo_sms_index',
    routeView: 'acme_demo_sms_view',
    routeCreate: 'acme_demo_sms_create',
    routeUpdate: 'acme_demo_sms_update',
    defaultValues: [
        'grid' => ['default' => 'acme-demo-sms-grid-base'],
        'entity' => ['icon' => 'fa-question'],
        'ownership' => [
            'owner_type' => 'USER',
            'owner_field_name' => 'owner',
            'owner_column_name' => 'user_owner_id',
            'organization_field_name' => 'organization',
            'organization_column_name' => 'organization_id'
        ],
        'security' => ['type' => 'ACL', 'group_name' => '', 'category' => ''],
        'grouping' => ['groups' => ['activity']],
        'activity' => [
            'route' => 'acme_demo_sms_activity_view',
            'acl' => 'acme_demo_sms_view',
            'action_button_widget' => 'acme_demo_add_sms_button',
            'action_link_widget' => 'acme_demo_add_sms_link'
        ]
    ]
)]
class Sms implements
    DatesAwareInterface,
    OrganizationAwareInterface,
    ActivityInterface,
    ExtendEntityInterface
{
    use DatesAwareTrait;
    use AuditableUserAwareTrait;
    use ExtendActivity;
    use ExtendEntityTrait;
    // ...
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(name: 'from_contact', type: 'string', length: 255, nullable: true)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true], 'importexport' => ['identity' => true]])]
    private $fromContact;

    #[ORM\Column(name: 'to_contact', type: 'string', length: 255, nullable: true)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true]])]
    private $toContact;

    #[ORM\Column(name: 'message', type: 'text', nullable: true)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true]])]
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFromContact(): ?string
    {
        return $this->fromContact;
    }

    public function setFromContact(?string $fromContact): self
    {
        $this->fromContact = $fromContact;

        return $this;
    }

    public function getToContact(): ?string
    {
        return $this->toContact;
    }

    public function setToContact(?string $toContact): self
    {
        $this->toContact = $toContact;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}

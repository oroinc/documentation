<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\DataAuditBundle\Entity\AuditAdditionalFieldsInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationAwareInterface;
use Oro\Bundle\UserBundle\Entity\Ownership\AuditableUserAwareTrait;

/**
 * ORM Entity Question.
 */
#[ORM\Entity(repositoryClass: 'Acme\Bundle\DemoBundle\Entity\Repository\QuestionRepository')]
#[ORM\Table(name: 'acme_demo_question')]
#[Config(
    routeName: 'acme_demo_question_index',
    routeView: 'acme_demo_question_view',
    routeCreate: 'acme_demo_question_create',
    routeUpdate: 'acme_demo_question_update',
    defaultValues: [
        'form' => [
            'form_type' => 'Acme\Bundle\DemoBundle\Form\Type\QuestionCreateOrSelectType',
            'grid_name' => 'acme-demo-question-grid-select'
        ],
        'grid' => ['default' => 'acme-demo-question-grid-select'],
        'entity' => ['icon' => 'fa-question'],
        'ownership' => [
            'owner_type' => 'USER',
            'owner_field_name' => 'owner',
            'owner_column_name' => 'user_owner_id',
            'organization_field_name' => 'organization',
            'organization_column_name' => 'organization_id'
        ],
        'security' => ['type' => 'ACL', 'group_name' => '', 'category' => ''],
        'dataaudit' => ['auditable' => true]
    ]
)]
class Question implements
    DatesAwareInterface,
    OrganizationAwareInterface,
    AuditAdditionalFieldsInterface,
    ExtendEntityInterface
{
    use DatesAwareTrait;
    use AuditableUserAwareTrait;
    use ExtendEntityTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(name: 'subject', type: 'string', length: 255, nullable: false)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true], 'importexport' => ['identity' => true]])]
    private $subject;

    #[ORM\Column(name: 'description', type: 'string', length: 255, nullable: false)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true]])]
    private $description;

    #[ORM\Column(name: 'due_date', type: 'datetime', nullable: true)]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true]])]
    private $dueDate;

    #[ORM\ManyToOne(targetEntity: 'Acme\Bundle\DemoBundle\Entity\Priority')]
    #[ORM\JoinColumn(name: 'priority_id', nullable: true, onDelete: 'SET NULL')]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => true]])]
    private $priority;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDueDate(): ?\DateTimeInterface
    {
        return $this->dueDate;
    }

    public function setDueDate(?\DateTimeInterface $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getPriority(): ?Priority
    {
        return $this->priority;
    }

    public function setPriority(?Priority $priority): self
    {
        $this->priority = $priority;

        return $this;
    }

    #[\Override]
    public function getAdditionalFields(): array
    {
        return ['subject' => $this->getSubject()];
    }
}

<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Attribute\Entity\AttributeFamily;
use Oro\Bundle\EntityConfigBundle\Attribute\Entity\AttributeFamilyAwareInterface;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationAwareInterface;
use Oro\Bundle\UserBundle\Entity\Ownership\AuditableUserAwareTrait;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;

/**
 * ORM Entity Document.
 */
#[ORM\Entity(repositoryClass: 'Acme\Bundle\DemoBundle\Entity\Repository\DocumentRepository')]
#[ORM\Table(name: 'acme_demo_document')]
#[Config(
    routeName: 'acme_demo_document_index',
    routeView: 'acme_demo_document_view',
    routeCreate: 'acme_demo_document_create',
    routeUpdate: 'acme_demo_document_update',
    defaultValues: [
        'form' => [
            'form_type' => 'Acme\Bundle\DemoBundle\Form\Type\DocumentCreateOrSelectType',
            'grid_name' => 'acme-demo-document-grid-select'
        ],
        'grid' => [
            'default' => 'acme-demo-document-grid-select',
            'context' => 'document-for-context-grid'
        ],
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
        'acme' => ['demo_attr' => 'MyValue'],
        'attribute' => ['has_attributes' => true]
    ]
)]
class Document implements
    AttributeFamilyAwareInterface,
    DatesAwareInterface,
    OrganizationAwareInterface,
    ExtendEntityInterface
{
    use DatesAwareTrait;
    use AuditableUserAwareTrait;
    use ExtendEntityTrait;

    // ...
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

    /**
     * @var AttributeFamily
     */
    #[ORM\ManyToOne(targetEntity: 'Oro\Bundle\EntityConfigBundle\Attribute\Entity\AttributeFamily')]
    #[ORM\JoinColumn(name: 'attribute_family_id', referencedColumnName: 'id', onDelete: 'RESTRICT')]
    #[ConfigField(defaultValues: ['dataaudit' => ['auditable' => false], 'importexport' => ['order' => 10]])]
    protected $attributeFamily;

    /**
     * @param AttributeFamily $attributeFamily
     */
    public function setAttributeFamily(AttributeFamily $attributeFamily): self
    {
        $this->attributeFamily = $attributeFamily;

        return $this;
    }

    public function getAttributeFamily(): ?AttributeFamily
    {
        return $this->attributeFamily;
    }
}

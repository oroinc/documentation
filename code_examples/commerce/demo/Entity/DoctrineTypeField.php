<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationAwareInterface;
use Oro\Bundle\UserBundle\Entity\Ownership\AuditableUserAwareTrait;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;

/**
 * ORM Entity DoctrineTypeField.
 *
 * @ORM\Entity(
 *     repositoryClass="Acme\Bundle\DemoBundle\Entity\Repository\DoctrineTypeFieldRepository"
 * )
 * @ORM\Table(
 *     name="acme_demo_doctrine_type_field"
 * )
 * @Config(
 *     routeName="acme_demo_doctrine_type_field_index",
 *     routeView="acme_demo_doctrine_type_field_view",
 *     routeCreate="acme_demo_doctrine_type_field_create",
 *     routeUpdate="acme_demo_doctrine_type_field_update",
 *     defaultValues={
 *         "form"={
 *             "form_type"="Acme\Bundle\DemoBundle\Form\Type\DoctrineTypeFieldCreateOrSelectType",
 *             "grid_name"="acme-demo-doctrine-type-field-grid-select"
 *         },
 *         "grid"={
 *             "default"="acme-demo-doctrine-type-field-grid-select"
 *         },
 *         "entity"={
 *             "icon"="fa-question"
 *         },
 *         "ownership"={
 *             "owner_type"="USER",
 *             "owner_field_name"="owner",
 *             "owner_column_name"="user_owner_id",
 *             "organization_field_name"="organization",
 *             "organization_column_name"="organization_id"
 *         },
 *         "security"={
 *             "type"="ACL",
 *             "group_name"="",
 *             "category"=""
 *         },
 *         "dataaudit"={
 *             "auditable"=true
 *         }
 *     }
 * )
 */
class DoctrineTypeField implements
    DatesAwareInterface,
    OrganizationAwareInterface,
    ExtendEntityInterface
{
    use DatesAwareTrait;
    use AuditableUserAwareTrait;
    use ExtendEntityTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(
     *     name="percent_field",
     *     type="float",
     *     nullable=true
     * )
     * @ConfigField(
     *     defaultValues={
     *         "dataaudit"={
     *             "auditable"=true
     *         }
     *     }
     * )
     */
    private $percentField;

    /**
     * @var float
     *
     * @ORM\Column(name="money_field", type="money", nullable=true)
     */
    protected $moneyField;

    /**
     * @var int
     *
     * @ORM\Column(name="duration_field", type="duration", nullable=true)
     */
    protected $durationField;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPercentField(): ?float
    {
        return $this->percentField;
    }

    public function setPercentField(?float $percentField): self
    {
        $this->percentField = $percentField;

        return $this;
    }

    public function setMoneyField(?float $moneyField): self
    {
        $this->moneyField = $moneyField;

        return $this;
    }

    public function getMoneyField(): ?float
    {
        return $this->moneyField;
    }

    public function setDurationField(?int $durationField): self
    {
        $this->durationField = $durationField;

        return $this;
    }

    public function getDurationField(): ?int
    {
        return $this->durationField;
    }
}

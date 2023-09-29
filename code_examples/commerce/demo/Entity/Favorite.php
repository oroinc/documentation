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
 * ORM Entity Favorite.
 *
 * @ORM\Entity(
 *     repositoryClass="Acme\Bundle\DemoBundle\Entity\Repository\FavoriteRepository"
 * )
 * @ORM\Table(
 *     name="acme_demo_favorite"
 * )
 * @Config(
 *     defaultValues={
 *         "ownership"={
 *             "owner_type"="USER",
 *             "owner_field_name"="owner",
 *             "owner_column_name"="user_owner_id",
 *             "organization_field_name"="organization",
 *             "organization_column_name"="organization_id"
 *         },
 *          "grid"={
 *             "default"="acme-demo-favorite-grid"
 *         },
 *         "security"={
 *             "type"="ACL",
 *             "permissions"="All",
 *             "group_name"="",
 *             "category"="",
 *         },
 *         "dataaudit"={
 *             "auditable"=true
 *         },
 *     }
 * )
 */
class Favorite implements
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
     *     name="name",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    private $name;

    /**
     * @ORM\Column(
     *     name="value",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    private $value;

    /**
     * @ORM\Column(
     *     name="viewCount",
     *     type="integer",
     *     nullable=true
     * )
     * @ConfigField(
     *      defaultValues={
     *          "security"={
     *              "permissions"="VIEW;CREATE",
     *          },
     *      }
     * )
     */
    private $viewCount;

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getValue(): ?string
    {
        return $this->value;
    }

    public function setValue(string $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function setViewCount(int $viewCount): self
    {
        $this->viewCount = $viewCount;

        return $this;
    }

    public function getViewCount(): int
    {
        return (int)$this->viewCount;
    }
}

<?php

namespace Acme\Bundle\DemoBundle\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;

/**
 * ORM Entity NotManageableEntity.
 *
 * @ORM\Entity()
 * @ORM\Table(
 *     name="acme_demo_not_manageable_entity"
 * )
 * @Config(
 *     defaultValues={
 *         "entity"={
 *             "icon"="fa-question"
 *         },
 *         "comment"={
 *             "immutable"=true
 *         },
 *         "activity"={
 *             "immutable"=true
 *          },
 *         "attachment"={
 *             "immutable"=true
 *         },
 *         "entity_management"={
 *             "enabled"=false
 *         },
 *     }
 * )
 */
class NotManageableEntity implements ExtendEntityInterface
{
    use ExtendEntityTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected ?int $id = null;

    /**
     * @ORM\Column(
     *     name="name",
     *     type="string",
     *     length=255,
     *     nullable=false
     * )
     */
    protected ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}

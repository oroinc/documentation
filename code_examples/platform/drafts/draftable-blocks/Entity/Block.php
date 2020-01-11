<?php

namespace ACME\Bundle\CMSBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\DraftBundle\Entity\DraftableInterface;
use Oro\Bundle\DraftBundle\Entity\DraftableTrait;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Oro\Bundle\UserBundle\Entity\Ownership\UserAwareTrait;

/**
 * Represents ACME Block
 *
 * @ORM\Table(name="acme_cms_block")
 * @ORM\Entity()
 * @Config(
 *      routeName="acme_cms_block_index",
 *      routeView="acme_cms_block_view",
 *      routeUpdate="acme_cms_block_update",
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-book"
 *          },
 *          "ownership"={
 *              "owner_type"="USER",
 *              "owner_field_name"="owner",
 *              "owner_column_name"="user_owner_id",
 *              "organization_field_name"="organization",
 *              "organization_column_name"="organization_id"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "group_name"=""
 *          }
 *      }
 * )
 */
class Block implements DraftableInterface, DatesAwareInterface
{
    use DraftableTrait;
    use UserAwareTrait;
    use DatesAwareTrait;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false, length=255, unique=true)
     * @ConfigField(
     *      defaultValues={
     *          "draft"={
     *              "draftable"=true
     *          }
     *      }
     * )
     */
    protected $title;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     * @ConfigField(
     *      defaultValues={
     *          "draft"={
     *              "draftable"=true
     *          }
     *      }
     * )
     */
    protected $content;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Block
     */
    public function setTitle(string $title): Block
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     *
     * @return $this
     */
    public function setContent(?string $content): Block
    {
        $this->content = $content;

        return $this;
    }
}

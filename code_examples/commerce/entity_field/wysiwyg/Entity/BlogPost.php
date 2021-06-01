<?php

namespace ACME\Bundle\WysiwygBundle\Entity;

use ACME\Bundle\WysiwygBundle\Model\ExtendBlogPost;
use Doctrine\ORM\Mapping as ORM;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Annotation\ConfigField;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationInterface;

/**
 * BlogPost entity class.
 *
 * @ORM\Entity
 * @ORM\Table(name="acme_blog_post")
 * @Config(
 *      routeName="acme_wysiwyg_blog_post_index",
 *      routeView="acme_wysiwyg_blog_post_view",
 *      defaultValues={
 *          "entity"={
 *              "icon"="fa-rss"
 *          },
 *          "ownership"={
 *              "owner_type"="ORGANIZATION",
 *              "owner_field_name"="organization",
 *              "owner_column_name"="organization_id"
 *          },
 *          "security"={
 *              "type"="ACL",
 *              "category"="marketing"
 *          }
 *      }
 * )
 */
class BlogPost extends ExtendBlogPost implements DatesAwareInterface
{
    use DatesAwareTrait;

    /**
     * @var null|int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var null|string
     *
     * @ORM\Column(type="wysiwyg", nullable=true)
     * @ConfigField(
     *      defaultValues={
     *          "attachment"={
     *              "acl_protected"=false
     *          }
     *      }
     * )
     */
    protected $content;

    /**
     * @var null|OrganizationInterface
     *
     * @ORM\ManyToOne(targetEntity="Oro\Bundle\OrganizationBundle\Entity\Organization")
     * @ORM\JoinColumn(name="organization_id", referencedColumnName="id", onDelete="SET NULL")
     */
    protected $organization;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getOrganization(): ?OrganizationInterface
    {
        return $this->organization;
    }

    public function setOrganization(?OrganizationInterface $organization): self
    {
        $this->organization = $organization;

        return $this;
    }
}

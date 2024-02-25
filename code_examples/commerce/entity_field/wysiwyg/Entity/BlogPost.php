<?php

namespace Acme\Bundle\WysiwygBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Extend\Entity\Autocomplete\ACMEWysiwygBundle_Entity_BlogPost;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareInterface;
use Oro\Bundle\EntityBundle\EntityProperty\DatesAwareTrait;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\Config;
use Oro\Bundle\EntityConfigBundle\Metadata\Attribute\ConfigField;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityInterface;
use Oro\Bundle\EntityExtendBundle\Entity\ExtendEntityTrait;
use Oro\Bundle\OrganizationBundle\Entity\OrganizationInterface;

/**
 * BlogPost entity class.
 *
 * @mixin ACMEWysiwygBundle_Entity_BlogPost
 */
#[ORM\Entity]
#[ORM\Table(name: 'acme_blog_post')]
#[Config(
    routeName: 'acme_wysiwyg_blog_post_index',
    routeView: 'acme_wysiwyg_blog_post_view',
    defaultValues: [
        'entity' => ['icon' => 'fa-rss'],
        'ownership' => [
            'owner_type' => 'ORGANIZATION',
            'owner_field_name' => 'organization',
            'owner_column_name' => 'organization_id'
        ],
        'security' => ['type' => 'ACL', 'category' => 'marketing']
    ]
)]
class BlogPost implements DatesAwareInterface, ExtendEntityInterface
{
    use DatesAwareTrait;
    use ExtendEntityTrait;

    /**
     * @var null|int
     */
    #[ORM\Column(name: 'id', type: 'integer')]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: 'AUTO')]
    protected $id;

    /**
     * @var null|string
     */
    #[ORM\Column(type: 'wysiwyg', nullable: true)]
    #[ConfigField(defaultValues: ['attachment' => ['acl_protected' => false]])]
    protected $content;

    /**
     * @var null|string
     */
    #[ORM\Column(name: 'extra_content', type: 'wysiwyg', nullable: true)]
    #[ConfigField(defaultValues: ['attachment' => ['acl_protected' => false]])]
    protected $extraContent;

    /**
     * @var null|string
     */
    #[ORM\Column(name: 'extra_content_style', type: 'wysiwyg_style', nullable: true)]
    #[ConfigField(defaultValues: ['attachment' => ['acl_protected' => false]])]
    protected $extraContentStyle;

    /**
     * @var null|array
     */
    #[ORM\Column(name: 'extra_content_properties', type: 'wysiwyg_properties', nullable: true)]
    protected $extraContentProperties;

    /**
     * @var null|OrganizationInterface
     */
    #[ORM\ManyToOne(targetEntity: 'Oro\Bundle\OrganizationBundle\Entity\Organization')]
    #[ORM\JoinColumn(name: 'organization_id', referencedColumnName: 'id', onDelete: 'SET NULL')]
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

    public function getExtraContent(): ?string
    {
        return $this->extraContent;
    }

    public function setExtraContent(?string $extraContent): self
    {
        $this->extraContent = $extraContent;

        return $this;
    }

    public function getExtraContentStyle(): ?string
    {
        return $this->extraContentStyle;
    }

    public function setExtraContentStyle(?string $extraContentStyle): self
    {
        $this->extraContentStyle = $extraContentStyle;

        return $this;
    }

    public function getExtraContentProperties(): ?array
    {
        return $this->extraContentProperties;
    }

    public function setExtraContentProperties(?array $extraContentProperties): self
    {
        $this->extraContentProperties = $extraContentProperties;

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

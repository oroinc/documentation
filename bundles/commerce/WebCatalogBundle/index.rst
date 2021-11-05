:oro_show_local_toc: false

.. _bundle-docs-commerce-webcatalog-bundle:

OroWebCatalogBundle
===================

OroWebCatalogBundle enables the OroCommerce back-office administrators to set a different structure and content of the storefront for individual customers, customer groups, or all visitors of the website by combining product pages, category pages, system pages, and product collections into custom catalogs for these audiences.

Create a Content Variant
------------------------

There are 5 content variant types registered out-of-the-box:

- System page
- Landing page
- Category
- Product page
- Product Collection page

The main entity responsible for content variants is `ContentVariant`.
Entity `ContentVariant` is extendable. If you want to add another entity to a content variant, you should extend it.

To create your own content variant, create a relation between the content variant and your entity.

For example,  to create a `Blog Post` Content Variant, proceed through the steps below.

**1. Create migration**

You should create migration which adds relation between the content variant entity and your entity.
In our example it is relation between the ContentVariant and BlogPost entities.
This migration should implement `ExtendExtensionAwareInterface`.

.. code-block:: php
   :linenos:

    class OroWebCatalogBundle implements Migration, ExtendExtensionAwareInterface
    {
        /**
         * {@inheritdoc}
         */
        public function up(Schema $schema, QueryBag $queries)
        {
            $this->createRelationToBlogPostFromContentVariant($schema);
            ...
        }

        /**
         * @param Schema $schema
         */
        private function createRelationToBlogPostFromContentVariant(Schema $schema)
        {
            if ($schema->hasTable('oro_web_catalog_variant')) {
                $table = $schema->getTable('oro_web_catalog_variant');
                $this->extendExtension->addManyToOneRelation(
                    $schema,
                    $table,
                    'content_variant_blog_post', // Relation field name
                    'blog_post', // Your entity table name
                    'id',
                    [
                        'entity' => ['label' => 'blog_post.entity_label'], // Your entity label translation key
                        'extend' => [
                            'is_extend' => true,
                            'owner' => ExtendScope::OWNER_CUSTOM,
                            'cascade' => ['persist', 'remove'],
                            'on_delete' => 'CASCADE',
                        ],
                        'datagrid' => ['is_visible' => false],
                        'form' => ['is_enabled' => false],
                        'view' => ['is_displayable' => false],
                        'merge' => ['display' => false],
                    ]
                );
            }
        }
        ...
    }

**2. Add form type**

Add form type for your entity content variant.

This form type is used on the Create Content Node page to add and edit you content variant.

.. code-block:: php
   :linenos:

    use Symfony\Component\Form\AbstractType;

    class BlogPostPageVariantType extends AbstractType
    {
        ...
    }

**3. Create content variant type**

Next, create a service which should implement `ContentVariantTypeInterface` and be tagged with `oro_web_catalog.content_variant_type` tag.
In this service, provide individual type name, title, created before form the type which is used to create and update the content variant.
The `getRouteData` method should return the route data to render your content variant on the frontend application side.
In our case it can be `new RouteData('frontend_blog_post_view', ['id' => $post->getId()]);`

.. code-block:: php
   :linenos:

    use Oro\Component\WebCatalog\ContentVariantTypeInterface;

    class ProductPageContentVariantType implements ContentVariantTypeInterface
    {
        const TYPE = 'blog_post_page';

        ...

        /**
         * {@inheritdoc}
         */
        public function getName()
        {
            return self::TYPE;
        }

        /**
         * {@inheritdoc}
         */
        public function getTitle()
        {
            return 'blog_post_page.label';
        }

        /**
         * {@inheritdoc}
         */
        public function getFormType()
        {
            return BlogPostPageVariantType::class;
        }

        /**
         * {@inheritdoc}
         */
        public function getRouteData(ContentVariantInterface $contentVariant)
        {
            /** @var BlogPost $post */
            $post = $this->propertyAccessor->getValue($contentVariant, 'contentVariantBlogPost');

            return new RouteData('frontend_blog_post_view', ['id' => $post->getId()]);
        }

        /**
         * {@inheritdoc}
         */
        public function getApiResourceClassName()
        {
            return BlogPost::class;
        }

        /**
         * {@inheritdoc}
         */
        public function getApiResourceIdentifierDqlExpression($alias)
        {
            return sprintf('IDENTITY(%s.content_variant_blog_post)', $alias);
        }
    }

`ContentVariantTypeContentVariantTypeRegistry` is used to collect all content variant types.
To render `Add Content Variant` dropdown button with all available content variants, `WebCatalogExtension` twig extension is used.

**4. Create Storefront API**

If your content variant is represented by an ORM entity (like the blog post described in this example),
enable the storefront API for it using the `Resources/config/oro/api_frontend.yml` configuration file.
For more details, see |Storefront REST API|.

If your content variant is represented by a non-ORM entity, enabling storefront API may be more time-consuming. As an example you can investigate how it is done for the system page content variant:

- |SystemPage Model|
- |SystemPage declaration in Resources/config/oro/api_frontend.yml|
- |SystemPageRepository class|
- |LoadSystemPage API processor|
- |ExpandSystemPageContentVariant API processor|
- |LoadSystemPageContentVariantSubresource API processor|

**Adding scope selectors for content variants is automatic**

`PageVariantTypeExtension` form type extension adds scope type with appropriate selectors for each content variant type.
`ContentVariant` can has only one scope, any `Scope` can be applied for different Content Variants.

As a result, you will have possibility to add a content node variant for your entity and render this content variant in the storefront according selected scopes.

Default Content Variant
^^^^^^^^^^^^^^^^^^^^^^^

Each content variant of content node can be selected as default using the `ContentVariant` `is_default` flag.
It means that if Content Node has scopes not assigned to any Content Variant of this node, that scopes will be assigned to the content variant that is marked as default.

Sitemap
^^^^^^^

To add the created content variant to Sitemap, create an appropriate provider. Please see :ref:`Sitemap documentation <bundle-docs-commerce-seo-bundle-sitemap>`.

.. include:: /include/include-links-dev.rst
   :start-after: begin
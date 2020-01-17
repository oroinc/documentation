.. _bundle-docs-commerce-cms-bundle-content-blocks:

Content Blocks
==============

An administrator can modify a predefined marketing content in the frontend by editing the defined content blocks.

The `ContentBlock` entity fields consist of:

.. csv-table::

   "`alias`","A unique identifier that can be used in the layout to :ref:`render a block <bundle-docs-commerce-cms-bundle-render-content-blocks>`."
   "`scopes`","A collection of scopes that defines the conditions for the content block to be displayed. For more information, refer to the |ScopeBundle| documentation."
   "`titles`","A localized block title that can be rendered along with the scope."
   "`contentVariants`","A collection of the `TextContentVariant` entities. Each content variant has a scope that defines when it should be rendered. Only one content variant with the most suitable scope is rendered at a time. If there is no suitable content variant, the default one is rendered instead."

Manage Content Blocks
---------------------

An administrator can edit the defined content blocks in the **Marketing > Content Blocks** menu.

Create a Content Block
----------------------

You can create content blocks with a collection of predefined content variants using data migrations:

.. code-block:: php
   :linenos:

    use Doctrine\Common\DataFixtures\AbstractFixture;
    use Doctrine\Common\Persistence\ObjectManager;

    use Oro\Bundle\CMSBundle\Entity\ContentBlock;
    use Oro\Bundle\CMSBundle\Entity\TextContentVariant;
    use Oro\Bundle\LocaleBundle\Entity\LocalizedFallbackValue;

    class LoadHomePageSlider extends AbstractFixture
    {
        /**
         * @param ObjectManager $manager
         */
        public function load(ObjectManager $manager)
        {
            $slider = new ContentBlock();
            $slider->setAlias('marketing-block');

            $title = new LocalizedFallbackValue();
            $title->setString('Block title');
            $slider->addTitle($title);

            $variant = new TextContentVariant();
            $variant->setDefault(true);
            $variant->setContent('<p>Block content</p>');
            $slider->addContentVariant($variant);

            $manager->persist($slider);
            $manager->flush($slider);
        }
    }

.. _bundle-docs-commerce-cms-bundle-render-content-blocks:

Render a Content Block in the Layout
------------------------------------

Content blocks can be rendered by unique `aliases` using the `content_block` block type:
 
.. code-block:: yaml
   :linenos:

    layout:
        actions:
            - '@add':
                id: marketing_block # unique layout block id
                parentId: page_content
                blockType: content_block
                options:
                    alias: marketing-block # unique content block id

**Note**

An administrator can rename or delete defined content blocks. So if there is no content block with a defined alias, this may be caused by a typo in a block name or non-existence of the block itself, nothing is rendered, and no errors are displayed. A `notice` message is written to log.

If you have rendered a content block to the layout but nothing is displayed, check whether:

- The content block is enabled
- The content block has at least one suitable scope or has no scope at all, which means the block is rendered without any restriction.

.. include:: /include/include-links-dev.rst
   :start-after: begin

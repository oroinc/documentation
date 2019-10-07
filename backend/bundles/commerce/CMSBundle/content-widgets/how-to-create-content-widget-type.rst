.. _how-to_create-content-widget-type:

Create a Content Widget Type
============================

We are going to illustrate how to create a content widget type to render the copyright. It should have an option to control the display format (short or long).

You can create a content widget type in four steps:

.. contents:: :local:
   :depth: 1

1. Extend *AbstractContentWidgetType*
-------------------------------------

To implement a new content widget, create a class that stores content widget type configuration and renders the content widget. The class should extend *AbstractContentWidgetType*.

.. code-block:: php
    :linenos:

    <?php

    namespace ACME\Bundle\CopyrightBundle\ContentWidget;

    use Oro\Bundle\CMSBundle\ContentWidget\AbstractContentWidgetType;
    use Oro\Bundle\CMSBundle\Entity\ContentWidget;
    use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
    use Symfony\Component\Form\Extension\Core\Type\FormType;
    use Symfony\Component\Form\FormFactoryInterface;
    use Symfony\Component\Form\FormInterface;

    class CopyrightContentWidgetType extends AbstractContentWidgetType
    {
        public static function getName(): string
        {
            return 'copyright';
        }

        public function getLabel(): string
        {
            return 'acme.copyright.content_widget.copyright.label';
        }

        public function getSettingsForm(ContentWidget $contentWidget, FormFactoryInterface $formFactory): ?FormInterface
        {
            return $formFactory->createBuilder(FormType::class, $contentWidget)
                ->add('isShort', CheckboxType::class, ['label' => 'acme.copyright.settings.is_short.label', 'required' => false])
                ->getForm();
        }
    }

.. note:: When you want to use an existing form type in you content widget type:

   .. oro_integrity_check:: f8b5e788dcb40ea48af1d44baf17be18d06db87f

       .. literalinclude:: /code_examples/commerce/content_widget/copyright/ContentWidget/CopyrightContentWidgetType.php
           :language: php
           :lines: 47-50
           :linenos:

   Form type has the following code:

   .. oro_integrity_check:: d9257e8f8d3ebfe55c8d026867750288807d5e98

       .. literalinclude:: /code_examples/commerce/content_widget/copyright/Form/Type/CopyrightContentWidgetType.php
           :language: php
           :linenos:

It should be registered in a service container with the *oro_cms.content_widget.type* tag.

.. code-block:: yaml
    :linenos:

    services:
        ACME\Bundle\CopyrightBundle\ContentWidget\CopyrightContentWidgetType:
            tags:
                - {name: 'oro_cms.content_widget.type'}

.. note:: When `autoconfiguration <https://symfony.com/doc/current/service_container.html#the-autoconfigure-option>`__ is enabled, tagging the service manually is unnecessary.

   .. oro_integrity_check:: c5e6c446b6f4fe694b278a9ff2fd7ef75c2fefd2

       .. literalinclude:: /code_examples/commerce/content_widget/copyright/Resources/config/services.yml
           :language: yaml
           :linenos:

Add translations to strings in a template.

.. oro_integrity_check:: a28267b3be8ca9c503147948c9794ec0907dcb4c

    .. literalinclude:: /code_examples/commerce/content_widget/copyright/Resources/translations/messages.en.yml
        :language: yaml
        :lines: 1,2-7
        :linenos:

2. Create a Template to Render the Widget in the Storefront
-----------------------------------------------------------

Create a template to render the content widget on the storefront.

.. oro_integrity_check:: 7bf823f11fef37626aa540d8d323756473e1144b

    .. literalinclude:: /code_examples/commerce/content_widget/copyright/Resources/views/CopyrightContentWidget/widget.html.twig
        :language: twig
        :linenos:

Add translations to strings in the template.

.. oro_integrity_check:: ff1f8f42a1b4fef7055a70a5df3624f05f6aff34

    .. literalinclude:: /code_examples/commerce/content_widget/copyright/Resources/translations/messages.en.yml
        :language: yaml
        :lines: 1,9-11
        :linenos:

3. (Optionally) Render the Widget Info in the Back-Office
---------------------------------------------------------

3.1 Create a Template
^^^^^^^^^^^^^^^^^^^^^

.. oro_integrity_check:: 5f62f7ba528d09c17765967bf5e2cc68fb6a2978

    .. literalinclude:: /code_examples/commerce/content_widget/copyright/Resources/views/CopyrightContentWidget/view.html.twig
        :language: html
        :linenos:

3.2 Implement *getAdditionalInformationBlock* Method in the Content Widget Type
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

   .. oro_integrity_check:: 9f6a119139eda728feea25e073048c52a631e5ca

       .. literalinclude:: /code_examples/commerce/content_widget/copyright/ContentWidget/CopyrightContentWidgetType.php
           :language: php
           :lines: 36-42
           :linenos:

.. note:: To pass additional data to the template, you can override *getBackOfficeViewSubBlocks* method. The example below illustrates how add two blocks with two subblocks in each block.

    .. code-block:: php
        :linenos:

        <?php

        namespace ACME\Bundle\CopyrightBundle\ContentWidget;

        use Oro\Bundle\CMSBundle\ContentWidget\AbstractContentWidgetType;
        use Oro\Bundle\CMSBundle\Entity\ContentWidget;
        use Twig\Environment;

        /**
         * Type for the copyright widgets.
         */
        class CopyrightContentWidgetType extends AbstractContentWidgetType
        {
            public function getBackOfficeViewSubBlocks(ContentWidget $contentWidget, Environment $twig): array
            {
                return [
                    [
                        'title' => 'oro.cms.contentwidget.sections.additional_information_block1.label',
                        'subblocks' => [
                            [
                                'data' => [
                                    $twig->render(
                                        '@ACMECopyright/CopyrightContentWidget/acme_template1.html.twig',
                                        ['settings' => $contentWidget->getSettings()]
                                    ),
                                ]
                            ],
                            [
                                'data' => [
                                    $twig->render(
                                        '@ACMECopyright/CopyrightContentWidget/acme_template2.html.twig',
                                        ['settings' => $contentWidget->getSettings()]
                                    ),
                                ]
                            ],
                        ]
                    ],
                    [
                        'title' => 'oro.cms.contentwidget.sections.additional_information_block2.label',
                        'subblocks' => [
                            [
                                'data' => [
                                    $twig->render(
                                        '@ACMECopyright/CopyrightContentWidget/acme_template3.html.twig',
                                        ['settings' => $contentWidget->getSettings()]
                                    ),
                                ]
                            ],
                            [
                                'data' => [
                                    $twig->render(
                                        '@ACMECopyright/CopyrightContentWidget/acme_template4.html.twig',
                                        ['settings' => $contentWidget->getSettings()]
                                    ),
                                ]
                            ],
                        ]
                    ],
                ];
            }
        }

4. (Optionally) Pass Custom Data to the Template when Rendering Widget in the Storefront
----------------------------------------------------------------------------------------

Override *getWidgetData* method in the Content Widget Type.

.. code-block:: php
    :linenos:

    <?php

    namespace ACME\Bundle\CopyrightBundle\ContentWidget;

    use Oro\Bundle\CMSBundle\ContentWidget\AbstractContentWidgetType;
    use Oro\Bundle\CMSBundle\Entity\ContentWidget;
    use Oro\Bundle\ProductBundle\Entity\Product;

    /**
     * Type for the copyright widgets.
     */
    class CopyrightContentWidgetType extends AbstractContentWidgetType
    {
        ...

        public function getWidgetData(ContentWidget $contentWidget): array
        {
            // For example, fetch the product from entity manager to pass it to the template
            $product = $this->doctrine->getManagerForClass(Product::class)
                  ->find(Product::class, $contentWidget->getSettings()['productId']);

            return ['contentWidget' => $contentWidget, 'product' => $product];
        }
    }

What's next
-----------

Now an administrator can create content widgets of new type from the UI by following steps outlined in the :ref:`Content Widgets User Guide <content-widgets-user-guide>` user documentation.


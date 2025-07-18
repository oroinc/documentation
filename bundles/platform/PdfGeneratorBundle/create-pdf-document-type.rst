.. _bundle-docs-platform-pdf-generator-bundle-create-pdf-document-type:

Create a PDF Document Type
==========================

``PDF document type`` is a string that represents the type of the ``PDF document``, e.g., ``us_standard_invoice``, ``eu_standard_invoice``, etc. It allows to generate different PDF document using different ``PDF document generator`` that encloses specific logic for generating a PDF file for a specific ``PDF document type``.

There are two ways to create a new ``PDF document type``:

* Re-use the generic ``PDF document generator`` that is applicable for all types and allows to use different Twig templates for different ``PDF document types`` via ``PDF document template provider``
* Create a new ``PDF document generator`` by creating a new class that implements the ``\Oro\Bundle\PdfGeneratorBundle\PdfDocument\Generator\PdfDocumentGeneratorInterface`` and registering it as a service with the tag ``oro_pdf_generator.pdf_document.generator``.


Re-use the PDF Document Generator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can re-use the existing ``\Oro\Bundle\PdfGeneratorBundle\PdfDocument\Generator\GenericPdfDocumentGenerator`` if having separate Twig templates is enough for your use case.

For this, declare a service for the ``GenericPdfDocumentTemplateProvider`` that will provide the Twig template for your ``PDF document type``. Example:

.. code-block:: yaml
   :caption: config/services.yaml

    services:
        acme.demo.pdf_document.pdf_template.provider.my_custom_document_type:
            class: \Oro\Bundle\PdfGeneratorBundle\PdfDocument\PdfTemplate\GenericPdfDocumentTemplateProvider
            arguments:
                - 'my_custom_document_type'
                - '@AcmeDemo/PdfDocument/content.html.twig'
            tags:
                - { name: 'oro_pdf_generator.pdf_document.pdf_template.provider' }

You can also configure ``PDF document templates`` via layout theme configuration to have different Twig templates for different layout themes. The syntax is as follows:

.. code-block:: yaml
   :caption: Resources/views/layouts/my_custom_theme/theme.yml

    config:
        pdf_document:
            my_custom_document_type:
                content_template: '@AcmeDemo/layouts/my_custom_theme/twig/pdf_document/content.html.twig'


Create a New PDF Document Generator
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Create a new class that implements the ``\Oro\Bundle\PdfGeneratorBundle\PdfDocument\Generator\PdfDocumentGeneratorInterface``.

Example:

.. code-block:: php
   :caption: src/Acme/DemoBundle/PdfDocument/Generator/MyCustomPdfDocumentGenerator.php

    namespace Acme\DemoBundle\PdfDocument\Generator;

    use Acme\DemoBundle\Entity\MyCustomEntity;
    use Doctrine\Persistence\ManagerRegistry;
    use Oro\Bundle\PdfGeneratorBundle\Layout\Extension\PdfDocumentTemplatesThemeConfigurationExtension;
    use Oro\Bundle\PdfGeneratorBundle\PdfBuilder\PdfBuilderFactoryInterface;
    use Oro\Bundle\PdfGeneratorBundle\PdfDocument\AbstractPdfDocument;
    use Oro\Bundle\PdfGeneratorBundle\PdfDocument\Provider\PdfDocumentTemplateProviderInterface;
    use Oro\Bundle\PdfGeneratorBundle\PdfFile\PdfFileInterface;
    use Oro\Bundle\PdfGeneratorBundle\PdfTemplate\Factory\PdfTemplateFactoryInterface;
    use Oro\Bundle\PdfGeneratorBundle\PdfTemplate\PdfTemplateInterface;

    class MyCustomPdfDocumentGenerator implements PdfDocumentGeneratorInterface
    {
            public function __construct(
                private readonly ManagerRegistry $doctrine,
                private readonly PdfBuilderFactoryInterface $pdfBuilderFactory,
                private readonly PdfDocumentTemplateProviderInterface $pdfDocumentTemplateProvider,
                private readonly PdfTemplateFactoryInterface $pdfTemplateFactory
            ) {
            }

            #[\Override]
            public function isApplicable(AbstractPdfDocument $pdfDocument): bool
            {
                return
                    $pdfDocument->getSourceEntityClass() === MyCustomEntity::class &&
                    $pdfDocument->getPdfDocumentType() === 'my_custom_pdf_document_type';
            }

            #[\Override]
            public function generatePdfFile(AbstractPdfDocument $pdfDocument): PdfFileInterface
            {
                $pdfDocumentPayload = $this->getDocumentPayload($pdfDocument);
                $twigTemplate = $this->templateProvider->getPdfDocumentTemplate(
                    $pdfDocument->getPdfDocumentType(),
                    PdfDocumentTemplatesThemeConfigurationExtension::CONTENT_TEMPLATE
                );
                $pdfTemplate = $this->pdfTemplateFactory->createPdfTemplate($template, $pdfDocumentPayload);

                return $pdfBuilder
                    ->content($pdfTemplate, $pdfDocumentPayload))
                    ->createPdfFile();
            }

            private function getDocumentPayload(AbstractPdfDocument $pdfDocument): array
            {
                $sourceEntity = $this->doctrine
                    ->getRepository($pdfDocument->getSourceEntityClass())
                    ->find($pdfDocument->getSourceEntityId());

                return ['entity' => $sourceEntity, ...$pdfDocument->getPdfDocumentPayload()];
            }

            private function createPdfTemplate(string $template, array $pdfDocumentPayload): PdfTemplateInterface
            {
                return $this->pdfTemplateFactory->createPdfTemplate($template, $pdfDocumentPayload);
            }
    }


Next, register it as a service with the tag ``oro_pdf_generator.pdf_document.generator``:

.. code-block:: yaml
   :caption: config/services.yaml

    services:
        acme.demo.pdf_document.generator.my_custom_pdf_document_generator:
            class: Acme\DemoBundle\PdfDocument\Generator\MyCustomPdfDocumentGenerator
            arguments:
                - '@doctrine'
                - '@oro_pdf_generator.pdf_builder.factory'
                - '@oro_pdf_generator.pdf_document.pdf_template.provider'
                - '@oro_pdf_generator.pdf_template.factory'
            tags:
                - { name: oro_pdf_generator.pdf_document.generator }


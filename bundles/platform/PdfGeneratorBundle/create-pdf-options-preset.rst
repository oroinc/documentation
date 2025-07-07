.. _bundle-docs-platform-pdf-generator-bundle-create-pdf-options-preset:

:oro_show_local_toc: false


Create PDF Options Preset
=========================

``PDF options preset`` is a string that denotes a set of options to be stored in the ``PDF options`` DTO. The list of presets available out-of-the-box is defined in the ``\Oro\Bundle\PdfGeneratorBundle\PdfOptionsPreset\PdfOptionsPreset`` class. Currently, the only available preset is **default**. For more details, see the :ref:`Architecture Details <bundle-docs-platform-pdf-generator-bundle-architecture>` section of the documentation.

``PDF options`` is a DTO that contains options for generating a PDF file, which will be passed to the PDF engine. It is implemented by the ``\Oro\Bundle\PdfGeneratorBundle\PdfOptions\PdfOptions`` class out-of-the-box. The ``PDF options`` may include parameters, such as page size, margins, engine-specific settings like API URL, binary path, etc.

``PDF options`` DTO is configured by the ``PDF options configurator`` that uses ``\Symfony\Component\OptionsResolver\OptionsResolver``. These options are resolved in the ``PDF builder`` before being passed to the configured ``PDF engine``.

In order to create a custom ``PDF options preset``, you need to create a class that implements the ``\Oro\Bundle\PdfGeneratorBundle\PdfOptionsPreset\PdfOptionsPresetConfiguratorInterface`` and register it as a service with the tag ``oro_pdf_generator.pdf_options_preset_configurator``. Example:

.. code-block:: php

    namespace Acme\Bundle\DemoBundle\PdfOptionsPreset;

    use Oro\Bundle\PdfGeneratorBundle\PdfOptionsPreset\PdfOptionsPresetConfiguratorInterface;
    use Oro\Bundle\PdfGeneratorBundle\PdfOptions\PdfOptions;
    use Symfony\Component\OptionsResolver\OptionsResolver;

    /**
     * Custom PDF options preset configurator.
     * Decorates the default configurator to add page size options for A4 format and the custom option.
     */
    class CustomPdfOptionsPresetConfigurator implements PdfOptionsPresetConfiguratorInterface
    {
        public const string NAME = 'custom';

        public function __construct(
            private readonly PdfOptionsPresetConfiguratorInterface $defaultPdfOptionsPresetConfigurator
        ) {
        }

        #[\Override]
        public function configureOptions(OptionsResolver $resolver): void
        {
            $this->defaultPdfOptionsPresetConfigurator->configureOptions($resolver);

            $resolver->setDefaults([
                'page_width' => '8.27in', // A4 width
                'page_height' => '11.7in', // A4 height
                // Add other default options as needed.
            ]);

            $resolver
                ->define('custom_option')
                ->default('default_value')
                ->allowedTypes('string');
        }

        public function isApplicable(string $pdfEngineName, string $pdfOptionsPreset = PdfOptionsPreset::DEFAULT): bool
        {
            // Return true if this configurator is applicable for the given preset.
            return $pdfOptionsPreset === 'custom';
        }
    }


Then register it in your service configuration:

.. code-block:: yaml

    services:
        acme.demo.pdf_options_preset.custom:
            class: Acme\Bundle\DemoBundle\PdfOptionsPreset\CustomPdfOptionsPresetConfigurator:
            arguments:
                - '@oro_pdf_generator.pdf_options_preset.default_configurator'
            tags:
                - { name: oro_pdf_generator.pdf_options_preset_configurator }


Next, use this preset to create a ``PDF file``:

.. code-block:: php

    $pdfBuilder = $this->pdfBuilderFactory->createPdfBuilder(CustomPdfOptionsPresetConfigurator::NAME);
    $pdfTemplate = $this->pdfTemplateFactory->createPdfTemplate(
        '@AcmeDemo/PdfDocument/template.html.twig',
        ['param1' => 'value1', 'param2' => 'value2']
    );
    $pdfBuilder->content($pdfTemplate);
    /* @var $pdfFile \Oro\Bundle\PdfGeneratorBundle\Model\PdfFileInterface */
    $pdfFile = $pdfBuilder->createPdfFile();


Or to create a ``PDF document``:

.. code-block:: php

    $pdfDocumentDemand = new GenericPdfDocumentDemand(
        sourceEntity: $order,
        pdfDocumentName: 'order-0101',
        pdfDocumentType: 'us_standard_invoice',
        pdfOptionsPreset: CustomPdfOptionsPresetConfigurator::NAME,
        pdfDocumentPayload: ['customer_notes' => 'Some notes']
    );

    /* @var $pdfDocument \Oro\Bundle\PdfGeneratorBundle\Entity\PdfDocument */
    $pdfDocument = $this->pdfDocumentOperatorRegistry
        ->getOperator(Order::class, PdfDocumentGenerationMode::INSTANT)
        ->createPdfDocument($pdfDocumentDemand);

    /* @var $pdfDocumentFile \Oro\Bundle\AttachmentBundle\Entity\File */
    $pdfDocumentFile = $pdfDocument->getPdfDocumentFile();

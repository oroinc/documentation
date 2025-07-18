.. _bundle-docs-platform-pdf-generator-bundle-create-pdf-document:

:oro_show_local_toc: false


Create a PDF Document
=====================

The overall chain of generating a ``PDF document`` is as follows:

.. code-block:: none

    ``Start`` -> ``PDF document operator registry`` -> Get operator -> Create PDF document demand -> ``PDF document operator`` -> Create PDF document -> ``PDF document factory`` -> ``PDF document`` -> ``PDF document resolver`` -> Resolve ``PDF document`` -> ``PDF document generator`` -> Generate ``PDF file`` -> ``PDF builder factory`` -> Create ``PDF builder`` -> ``PDF builder`` -> Create ``PDF file`` -> ``PDF engine`` -> Create ``PDF file`` -> ``PDF file`` -> Update ``PDF document`` with ``PDF file`` -> ``End``

Example of ``PDF document`` generation of the **us_standard_invoice** ``PDF document type`` in the **instant** ``PDF document generation mode``:

.. code-block:: php

    $pdfDocumentDemand = new GenericPdfDocumentDemand(
        sourceEntity: $order,
        pdfDocumentName: 'order-0101',
        pdfDocumentType: 'us_standard_invoice',
        pdfOptionsPreset: PdfOptionsPreset::DEFAULT_PRESET,
        pdfDocumentPayload: ['customer_notes' => 'Some notes']
    );

    /* @var $pdfDocument \Oro\Bundle\PdfGeneratorBundle\Entity\PdfDocument */
    $pdfDocument = $this->pdfDocumentOperatorRegistry
        ->getOperator(Order::class, PdfDocumentGenerationMode::INSTANT)
        ->createPdfDocument($pdfDocumentDemand);

    /* @var $pdfDocumentFile \Oro\Bundle\AttachmentBundle\Entity\File */
    $pdfDocumentFile = $pdfDocument->getPdfDocumentFile();


Example of ``PDF document`` generation of the **us_standard_invoice** ``PDF document type`` in the **deferred** ``PDF document generation mode``:

.. code-block:: php

    $pdfDocumentDemand = new GenericPdfDocumentDemand(
        sourceEntity: $order,
        pdfDocumentName: 'order-0101',
        pdfDocumentType: 'us_standard_invoice',
        pdfOptionsPreset: PdfOptionsPreset::DEFAULT_PRESET,
        pdfDocumentPayload: ['customer_notes' => 'Some notes']
    );

    /* @var $pdfDocument \Oro\Bundle\PdfGeneratorBundle\Entity\PdfDocument */
    $pdfDocument = $this->pdfDocumentOperatorRegistry
        ->getOperator(Order::class, PdfDocumentGenerationMode::DEFERRED)
        ->createPdfDocument($pdfDocumentDemand);

    // The PDF document will be generated once URL is accessed.
    $pdfDocumentUrl = $this->pdfDocumentUrlGenerator->generateUrl(
        $pdfDocument,
        FileUrlProviderInterface::FILE_ACTION_DOWNLOAD,
        UrlGeneratorInterface::ABSOLUTE_PATH
    );

For information on how to generate a download URL for a ``PDF document``, see the :ref:`How to Download a PDF Document <bundle-docs-platform-pdf-generator-bundle-download-pdf-document>` section of the documentation.

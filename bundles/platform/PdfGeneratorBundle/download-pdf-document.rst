.. _bundle-docs-platform-pdf-generator-bundle-download-pdf-document:

:oro_show_local_toc: false


Download a PDF Document
=======================

The OroPdfGeneratorBundle offers a centralized method for downloading PDF documents through the `\Oro\Bundle\PdfGeneratorBundle\Controller\PdfDocumentFileController`. This controller is used for downloading PDF documents both in the back-office and the storefront. It locates the corresponding PDF document using the provided UUID, determines the state of the PDF document if it has not been resolved yet, and then initiates the download of the PDF file associated with that document.

The bundle also provides a centralized way to generate a URL for the PDF document download, via ``\Oro\Bundle\PdfGeneratorBundle\PdfDocument\UrlGenerator\PdfDocumentUrlGenerator``. It is used to generate a download URL for a ``PDF document`` in the back-office.

Usage example:

.. code-block:: php

    $pdfDocument = $this->pdfDocumentOperatorRegistry
        ->getOperator(Order::class, PdfDocumentGenerationMode::INSTANT)
        ->retrievePdfDocument($order, 'us_standard_order');

    $pdfDocumentUrl = $this->pdfDocumentUrlGenerator->generateUrl(
        $pdfDocument,
        FileUrlProviderInterface::FILE_ACTION_DOWNLOAD,
        UrlGeneratorInterface::ABSOLUTE_PATH
    );

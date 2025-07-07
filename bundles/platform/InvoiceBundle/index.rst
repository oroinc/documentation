.. _bundle-docs-platform-invoice-bundle:

InvoiceBundle
=============

.. note:: This bundle is only available in the Enterprise edition.

OroInvoiceBundle enables invoice management in a standalone application, relying exclusively on OroPlatform as a dependency.

The bundle introduces ``\Oro\Bundle\InvoiceBundle\Entity\Invoice`` that represents an invoice and includes the generic invoice fields such as invoice number, invoice date, total amount, etc.


Configuration
-------------

.. note:: This package is designed to operate independently of OroCommerce and should not include any commerce-related functionalities. All OroCommerce-specific features must be included in the :ref:`OroCommerceInvoiceBundle <bundle-docs-commerce-invoice-bundle>`.

The bundle introduces the ``invoice`` feature, enabling the invoice management functionality, including:

* Invoices section in the application menu in the back-office
* Invoice index and view pages in the back-office
* Invoice PDF generation in the back-office


Invoice PDF Generation
----------------------

The bundle makes use of the :ref:`OroPdfGeneratorBundle <bundle-docs-platform-pdf-generator-bundle>` to generate PDF documents for invoices. It extends the ``PDF document`` generation functionality with ``Invoice PDF document manager`` that encloses the invoice-specific logic to simplify the PDF generation process for invoices.

``Invoice PDF document manager`` is the main entry point for invoice PDF document management. It provides methods to check, retrieve, create, update, and delete PDF documents for invoices. This manager abstracts the complexity of handling different PDF document types and provides a unified interface for invoice PDF document operations. It is implemented by ``\Oro\Bundle\InvoiceBundle\PdfDocument\Manager\InvoicePdfDocumentManager`` class, which provides the following methods:

* ``hasPdfDocument(Invoice $invoice, string $pdfDocumentType): bool`` - checks if the invoice has a ``PDF document`` of the specified ``PDF document type``.
* ``retrievePdfDocument(Invoice $invoice, string $pdfDocumentType): ?AbstractPdfDocument`` - retrieves the ``PDF document`` of the specified ``PDF document type`` for the invoice if it exists, or returns ``null`` if it does not.
* ``createPdfDocument(AbstractInvoicePdfDocumentDemand $invoicePdfDocumentDemand): AbstractPdfDocument`` - creates a new ``PDF document`` for the invoice based on the provided ``Invoice PDF document demand``.
* ``updatePdfDocument(Invoice $invoice, string $pdfDocumentType): ?AbstractPdfDocument`` - updates the existing ``PDF document`` of the specified ``PDF document type`` for the invoice and returns it. If the invoice does not have such ``PDF document``, it returns ``null``.
* ``deletePdfDocument(Invoice $invoice, string $pdfDocumentType): ?AbstractPdfDocument`` - deletes the existing ``PDF document`` of the specified ``PDF document type`` for the invoice and returns it. If the invoice does not have such ``PDF document``, it returns ``null``.

``PDF document types`` available out-of-the-box are listed in the ``\Oro\Bundle\InvoiceBundle\PdfDocument\InvoicePdfDocumentType`` class. The only available type is **invoice_default** for now. For information on how to create your own ``PDF document type``, see the :ref:`How to Create a PDF Document Type <bundle-docs-platform-pdf-generator-bundle-create-pdf-document-type>` section of the documentation.

The Twig templates for **invoice_default** ``PDF document type`` are located in the ``Resources/views/PdfDocument/InvoiceDefault/`` directory of the bundle. They are designed to be easily extended from another template, allowing you to customize as many blocks as possible without duplicating the entire template. For example, you can create a custom template for the invoice PDF document by extending the default template:

.. code-block:: twig
    :caption: templates/bundles/PdfDocument/InvoiceDefault/content.html.twig

    {% extends '@!OroInvoice/PdfDocument/InvoiceDefault/content.html.twig' %}

    {% block invoice_header_logo %}
        {# Custom header logo #}
    {% endblock %}


Invoice PDF URL
---------------

The bundle makes use and extends the :ref:`PDF document URL generator <bundle-docs-platform-pdf-generator-bundle-download-pdf-document>` to generate a URL for the invoice PDF document. It introduces the ``invoice PDF document URL generator`` that is implemented by ``\Oro\Bundle\InvoiceBundle\PdfDocument\UrlGenerator\InvoicePdfDocumentUrlGenerator`` class. It simplifies the process of generating a URL specifically for invoices.

Usage example:

.. code-block:: php

    $invoice = ...; // Retrieve the invoice entity
    $pdfDocumentType = InvoicePdfDocumentType::DEFAULT; // Specify the PDF document type

    $invoicePdfDocumentUrl = $this->invoicePdfDocumentUrlGenerator->generateUrl($invoice, $pdfDocumentType);


You can also generate a URL for the invoice PDF document in Twig templates using the ``oro_invoice_pdf_document_download_url`` Twig function:

.. code-block:: twig

    <a href="{{ oro_invoice_pdf_document_download_url(invoice, 'invoice_default') }}">Download PDF</a>


Or using the predefined Twig function ``oro_invoice_pdf_document_default_download_url`` - for **invoice_default** ``PDF document type``:

.. code-block:: twig

    <a href="{{ oro_invoice_pdf_document_default_download_url(invoice) }}">Download PDF</a>


    :start-after: begin


.. toctree::
   :hidden:
   :maxdepth: 1

   invoice-number-generation
   configuration


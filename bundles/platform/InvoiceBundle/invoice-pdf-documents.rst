.. _bundle-docs-platform-invoice-pdf-documents:

Invoice PDF Documents
=====================

The bundle makes use of the :ref:`OroPdfGeneratorBundle <bundle-docs-platform-pdf-generator-bundle>` to generate PDF documents for invoices. It extends the ``PDF document`` generation functionality with ``Invoice PDF document manager`` that encloses the invoice-specific logic to simplify the PDF generation process for invoices.

``Invoice PDF document manager`` is the main entry point for invoice PDF document management. It provides methods to check, retrieve, create, update, and delete PDF documents for invoices. This manager abstracts the complexity of handling different PDF document types and provides a unified interface for invoice PDF document operations. It is implemented by ``\Oro\Bundle\InvoiceBundle\PdfDocument\Manager\InvoicePdfDocumentManager`` class, which provides the following methods:

* ``hasPdfDocument(Invoice $invoice, string $pdfDocumentType): bool`` - checks if the invoice has a ``PDF document`` of the specified ``PDF document type``.
* ``retrievePdfDocument(Invoice $invoice, string $pdfDocumentType): ?AbstractPdfDocument`` - retrieves the ``PDF document`` of the specified ``PDF document type`` for the invoice if it exists, or returns ``null`` if it does not.
* ``createPdfDocument(AbstractInvoicePdfDocumentDemand $invoicePdfDocumentDemand): AbstractPdfDocument`` - creates a new ``PDF document`` for the invoice based on the provided ``Invoice PDF document demand``.
* ``updatePdfDocument(Invoice $invoice, string $pdfDocumentType): ?AbstractPdfDocument`` - updates the existing ``PDF document`` of the specified ``PDF document type`` for the invoice and returns it. If the invoice does not have such ``PDF document``, it returns ``null``.
* ``deletePdfDocument(Invoice $invoice, string $pdfDocumentType): ?AbstractPdfDocument`` - deletes the existing ``PDF document`` of the specified ``PDF document type`` for the invoice and returns it. If the invoice does not have such ``PDF document``, it returns ``null``.

``PDF document types`` available out-of-the-box are listed in the ``\Oro\Bundle\InvoiceBundle\PdfDocument\InvoicePdfDocumentType`` class. The only currently available type is **invoice_default**. For information on how to create your own ``PDF document type``, see the :ref:`How to Create a PDF Document Type <bundle-docs-platform-pdf-generator-bundle-create-pdf-document-type>` section of the documentation.

Invoice PDF Document Template
-----------------------------

The Twig templates for **invoice_default** ``PDF document type`` are located in the ``Resources/views/PdfDocument/InvoiceDefault/`` directory of the bundle. They are designed to be easily extended from another template, allowing you to customize as many blocks as possible without duplicating the entire template. For example, you can create a custom template for the invoice PDF document by extending the default template:

.. code-block:: twig
    :caption: templates/bundles/PdfDocument/InvoiceDefault/content.html.twig

    {% extends '@!OroInvoice/PdfDocument/InvoiceDefault/content.html.twig' %}

    {% block invoice_header_logo %}
        {# Custom header logo #}
    {% endblock %}

Invoice PDF Document Generation
-------------------------------

By default a PDF document of ``invoice_default`` type is created when an invoice transitions to the **posted** internal status. The class responsible for this behavior is ``\Oro\Bundle\InvoiceBundle\EventListener\PdfDocument\InvoicePdfDocumentGenerateWhenInvoiceBecomesPostedListener``.

.. hint:: You can re-use this class to create a PDF document of a different type and preset when an invoice becomes **posted** as it exposes the corresponding arguments in its constructor.

This behavior is controlled by the ``oro_invoice.generate_pdf_when_posted`` system config setting. You can disable it if you want to manage the invoice PDF documents manually, e.g., upload PDF document files via the back-office API.

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


Or using the predefined Twig function ``oro_invoice_pdf_document_default_download_url`` for the **invoice_default** ``PDF document type``:

.. code-block:: twig

    <a href="{{ oro_invoice_pdf_document_default_download_url(invoice) }}">Download PDF</a>


Invoice PDF Email Attachment
----------------------------

OroInvoiceBundle declares the virtual entity variable ``invoiceDefaultPdfFile`` that references the **invoice_default** ``PDF document`` of the invoice. The virtual field is implemented by the following classes:

- ``\Oro\Bundle\InvoiceBundle\Provider\EmailTemplate\InvoicePdfFileVariableProvider``
- ``\Oro\Bundle\InvoiceBundle\Provider\EmailTemplate\InvoicePdfFileVariableProcessor``

You can re-use these classes to declare your own virtual entity variable that references a different type ``PDF document`` of an invoice. For example:

.. code-block:: yaml
    :caption: services.yml

    services:
        oro_invoice.provider.email_template.invoice_us_standard_pdf_file_variable_provider:
            class: 'Oro\Bundle\InvoiceBundle\Provider\EmailTemplate\InvoicePdfFileVariableProvider'
            arguments:
                $translator: '@translator'
                $pdfFileVariableName: 'invoiceUsStandardPdfFile'
            tags:
                - { name: 'oro_email.emailtemplate.variable_provider', scope: 'entity' }

        oro_invoice.provider.email_template.invoice_us_standard_pdf_file_variable_processor:
            class: 'Oro\Bundle\InvoiceBundle\Provider\EmailTemplate\InvoicePdfFileVariableProcessor'
            arguments:
                $invoicePdfDocumentManager: '@oro_invoice.pdf_document.manager.instant'
                $doctrine: '@doctrine'
                $pdfDocumentType: 'invoice_us_standard'
            tags:
                - { name: 'oro_email.emailtemplate.variable_processor', alias: 'invoice_us_standard_pdf_file' }

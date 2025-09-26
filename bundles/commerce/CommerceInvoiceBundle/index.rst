.. _bundle-docs-commerce-invoice-bundle:

CommerceInvoiceBundle
=====================

.. note:: This bundle is only available in the Enterprise edition.

OroCommerceInvoiceBundle extends invoice management functionality with OroCommerce features. It provides a way to view invoices in the storefront, allowing customers to access their invoices directly from their accounts. It extends the Invoice entity with additional fields:

* ``customer`` - a reference to ``Customer`` entity
* ``customerUser`` - a reference to ``CustomerUser`` entity
* ``website`` - a reference to ``Website`` entity

It also configures the ``FRONTEND_USER`` frontend ownership to enables ACL functionality in the storefront.


Configuration
-------------

The bundle introduces the ``commerce_invoice`` feature, enabling the commerce-related functionality for invoices, including:

* Customer Name, Customer User and Website columns on the invoices index page in the back-office
* Customer Name, Customer User and Website fields on the invoice view page in the back-office
* Invoices section in the customer user menu in the storefront
* Invoice index and view pages in the storefront
* Invoice PDF generation in the storefront

.. note:: The feature depends on the ``invoice`` feature declared by :ref:`OroInvoiceBundle <bundle-docs-platform-invoice-bundle>`. Disabling the ``invoice`` feature automatically disables the ``commerce_invoice`` feature.


Invoice PDF Generation
----------------------

OroCommerceInvoiceBundle extends the ``invoice PDF generation`` functionality introduced in :ref:`OroInvoiceBundle <bundle-docs-platform-invoice-bundle>` to enable the ability to download invoices PDF documents in the storefront. It overrides the invoice PDF templates with storefront-specific templates. The PDF templates are configured in the **default** layout theme as follows:

.. code-block:: yaml
    :caption: Resources/views/layouts/default/theme.yml

    config:
        pdf_document:
            invoice_default:
                content_template: '@OroCommerceInvoice/layouts/default/twig/pdf_document/invoice_default/content.html.twig'
                header_template: '@OroCommerceInvoice/layouts/default/twig/pdf_document/invoice_default/header.html.twig'
                footer_template: '@OroCommerceInvoice/layouts/default/twig/pdf_document/invoice_default/footer.html.twig'


Invoice PDF URL
---------------

The bundle declares a storefront-specific invoice PDF document URL generator ``oro_commerce_invoice.pdf_document.url_generator`` that re-uses the original ``\Oro\Bundle\InvoiceBundle\PdfDocument\UrlGenerator\InvoicePdfDocumentUrlGenerator`` with storefront-specific ``PDF document URL generator`` service ``oro_frontend_pdf_generator.pdf_document.url_generator``.

Usage example:

.. code-block:: php

    $invoice = ...; // Retrieve the invoice entity
    $pdfDocumentType = InvoicePdfDocumentType::DEFAULT; // Specify the PDF document type

    $invoicePdfDocumentUrl = $this->invoicePdfDocumentUrlGenerator->generateUrl($invoice, $pdfDocumentType);


You can also generate a storefront URL for the invoice PDF document in Twig templates using the ``oro_commerce_invoice_pdf_document_download_url`` Twig function:

.. code-block:: twig

    <a href="{{ oro_commerce_invoice_pdf_document_download_url(invoice, 'invoice_default') }}">Download PDF</a>


You can also use the predefined Twig function ``oro_commerce_invoice_pdf_document_default_download_url`` for ``invoice_default`` **PDF document type**:

.. code-block:: twig

    <a href="{{ oro_commerce_invoice_pdf_document_default_download_url(invoice) }}">Download PDF</a>

Invoice PDF Download in the Storefront
--------------------------------------

OroCommerceInvoiceBundle allows customers to download an invoice PDF document directly from the invoice storefront view page via the **Download** button. This button is displayed by default but can be hidden via the ``oro_commerce_invoice.pdf_download_enabled`` system configuration setting.

The bundle also provides the layout data provider that allows to check if the invoice has a PDF document of the specified type before rendering the **Download** button. The layout data provider is implemented by ``\Oro\Bundle\CommerceInvoiceBundle\Layout\DataProvider\InvoicePdfDocumentChecker`` class and registered in the DI container with the ``oro_invoice_pdf_document_checker`` name. Usage example:

.. code-block:: yaml
    :caption: Resources/views/layouts/default/layout.yml

    layout:
        actions:
            -   '@add':
                    id: invoice_generate_pdf_button
                    blockType: block
                    parentId: invoice_view_page_top_bar_actions_list
                    options:
                        vars:
                            invoice: '=data["invoice"]'
                        visible: '=data["oro_invoice_pdf_document_checker"].hasInvoiceDefaultPdfDocument(data["invoice"])'

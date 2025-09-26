.. _bundle-docs-commerce-order-pdf-documents:

Order PDF Documents
===================

The bundle makes use of the :ref:`OroPdfGeneratorBundle <bundle-docs-platform-pdf-generator-bundle>` to generate PDF documents for orders. It extends the ``PDF document`` generation functionality with ``Order PDF document manager`` that encloses the order-specific logic to simplify the PDF generation process for orders.

``Order PDF document manager`` is the main entry point for order PDF document management. It provides methods to check, retrieve, create, update, and delete PDF documents for orders. This manager abstracts the complexity of handling different PDF document types and provides a unified interface for order PDF document operations. It is implemented by ``\Oro\Bundle\OrderBundle\PdfDocument\Manager\OrderPdfDocumentManager`` class, which provides the following methods:

* ``hasPdfDocument(Order $order, string $pdfDocumentType): bool`` - checks if the order has a ``PDF document`` of the specified ``PDF document type``.
* ``retrievePdfDocument(Order $order, string $pdfDocumentType): ?AbstractPdfDocument`` - retrieves the ``PDF document`` of the specified ``PDF document type`` for the order if it exists, or returns ``null`` if it does not.
* ``createPdfDocument(AbstractOrderPdfDocumentDemand $orderPdfDocumentDemand): AbstractPdfDocument`` - creates a new ``PDF document`` for the order based on the provided ``Order PDF document demand``.
* ``updatePdfDocument(Order $order, string $pdfDocumentType): ?AbstractPdfDocument`` - updates the existing ``PDF document`` of the specified ``PDF document type`` for the order and returns it. If the order does not have such ``PDF document``, it returns ``null``.
* ``deletePdfDocument(Order $order, string $pdfDocumentType): ?AbstractPdfDocument`` - deletes the existing ``PDF document`` of the specified ``PDF document type`` for the order and returns it. If the order does not have such ``PDF document``, it returns ``null``.

``PDF document types`` available out-of-the-box are listed in the ``\Oro\Bundle\OrderBundle\PdfDocument\OrderPdfDocumentType`` class. Currently, the only available type is **order_default**. For information on how to create your own ``PDF document type``, see the :ref:`How to Create a PDF Document Type <bundle-docs-platform-pdf-generator-bundle-create-pdf-document-type>` section of the documentation.

The Twig templates for **order_default** ``PDF document type`` are located in the ``Resources/views/PdfDocument/OrderDefault/`` directory of the bundle. They are designed to be easily extended from another template, allowing you to customize as many blocks as possible without duplicating the entire template. For example, you can create a custom template for the order PDF document by extending the default template:

.. code-block:: twig
    :caption: templates/bundles/PdfDocument/OrderDefault/content.html.twig

    {% extends '@!OroOrder/layouts/default/twig/pdf_document/order_default/content.html.twig' %}

    {% block order_header_logo %}
        {# Custom header logo #}
    {% endblock %}

Order PDF Document Generation
-----------------------------

Order PDF document is automatically created in the following cases:

- When an order is created after the checkout process is completed in the storefront, via ``\Oro\Bundle\OrderBundle\EventListener\PdfDocument\CreatePdfDocumentOnCheckoutFinishListener``. By default, this functionality is disabled.
- When the PDF document is requested via the Download button in the back-office order view page, via ``\Oro\Bundle\OrderBundle\Controller\OrderPdfDocumentDownloadController``.
- When the PDF document is requested via the Download button on the storefront order view page, via ``\Oro\Bundle\OrderBundle\Controller\Frontend\FrontendOrderPdfDocumentDownloadController``.

.. note:: By default, the **Order PDF document functionality in the storefront** is disabled.

Order PDF URL
-------------

The bundle makes use and extends the :ref:`PDF document URL generator <bundle-docs-platform-pdf-generator-bundle-download-pdf-document>` to generate a URL for the order PDF document. It introduces the ``order PDF document URL generator`` that is implemented by ``\Oro\Bundle\OrderBundle\PdfDocument\UrlGenerator\OrderPdfDocumentUrlGenerator`` class. It simplifies the process of generating a URL specifically for orders.

Usage example:

.. code-block:: php

    $order = ...; // Retrieve the order entity
    $pdfDocumentType = OrderPdfDocumentType::DEFAULT; // Specify the PDF document type

    $orderPdfDocumentUrl = $this->orderPdfDocumentUrlGenerator->generateUrl($order, $pdfDocumentType);

You can also generate a URL for the order PDF document in Twig templates using Twig functions:

- ``oro_order_pdf_document_back_office_url`` - generates a URL for downloading the order PDF document in the back-office.
- ``oro_order_pdf_document_storefront_url`` - generates a URL for downloading the order PDF document in the storefront.
- ``oro_order_pdf_document_order_default_back_office_url`` - generates a URL for downloading the order PDF document of ``order_default`` **PDF document type** in the back-office.
- ``oro_order_pdf_document_order_default_storefront_url`` - generates a URL for downloading the order PDF document of ``order_default`` **PDF document type** in the storefront.

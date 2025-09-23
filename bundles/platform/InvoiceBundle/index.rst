.. _bundle-docs-platform-invoice-bundle:

InvoiceBundle
=============

.. note:: This bundle is only available in the Enterprise edition.

OroInvoiceBundle enables invoice management in a standalone application, relying exclusively on OroPlatform as a dependency.

The bundle introduces the following entities:

- ``\Oro\Bundle\InvoiceBundle\Entity\Invoice`` - represents an invoice and includes the generic invoice fields such as invoice number, invoice date, total amount, etc.
- ``\Oro\Bundle\InvoiceBundle\Entity\InvoiceLineItem`` - represents an individual line item within an invoice and includes fields such as description, unit, quantity, price, etc.

.. note:: This package is designed to operate independently of OroCommerce and should not include any commerce-related functionalities. All OroCommerce-specific features must be included in the :ref:`OroCommerceInvoiceBundle <bundle-docs-commerce-invoice-bundle>`.

The bundle introduces the ``invoice`` feature, enabling the invoice management functionality, including:

* Invoices section in the application menu in the back-office
* Invoice index and view pages in the back-office
* Invoice PDF generation in the back-office

Each invoice gets a unique invoice number generated automatically when an invoice is created. For more information, see :ref:`Invoice Number Generation <bundle-docs-platform-invoice-number-generation>`.

Invoice Internal Status
-----------------------

Invoice entity has the ``internalStatus`` enum field that represents the internal status of the invoice. The statuses available out-of-the-box are listed in the ``\Oro\Bundle\InvoiceBundle\Entity\Invoice`` class. You can manage the invoice internal status using ``\Oro\Bundle\InvoiceBundle\Manager\InvoiceInternalStatusManager`` manager.

Sending an Invoice to a Customer
--------------------------------

OroInvoiceBundle provides the ability to send an invoice to a customer via email. It leverages the :ref:`OroEmailBundle <bundle-docs-platform-email-bundle>` to facilitate this functionality. The main entry points are ``\Oro\Bundle\CommerceInvoiceBundle\Email\InvoiceEmailModelBuilder`` to build an email model and ``\Oro\Bundle\InvoiceBundle\Email\InvoiceEmailModelSender`` to send it.

The bundle declares the ``oro_invoice_send_invoice_to_customer`` operation backed by the ``\Oro\Bundle\InvoiceBundle\Operation\SendInvoiceToCustomer`` class to expose this functionality in the UI as the **Send to Customer** button on the invoice view back-office page. It opens the *Send Email* dialog pre-filled with the compiled email model, including its email attachments (if any).

.. note:: If the invoice is not yet in the **posted** status, it is transitioned to this status before the dialog opens.

The email template used to compile the email is ``invoice_notification_template`` that contains general information about an invoice and a PDF attachment of the invoice. For more information about invoice PDF documents see :ref:`Invoice PDF Documents <bundle-docs-platform-invoice-pdf-documents>`.

.. hint:: Learn more about how email template attachments work in :ref:`Email Template Attachments <bundle-docs-platform-email-bundle-templates-attachments>`.


.. toctree::
   :titlesonly:
   :maxdepth: 1

   invoice-number-generation
   invoice-pdf-documents
   configuration


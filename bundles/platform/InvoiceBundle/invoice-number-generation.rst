.. _bundle-docs-platform-invoice-number-generation:

Invoice Number Generation
=========================

An invoice is a financial document that requires, among other attributes, to have a unique identifier or invoice number. While certain types of invoices (e.g., *proforma invoices*) may not require a unique number, most invoices must include one.

OroCommerce includes a few invoice number generators out-of-the-box:

* Sequential monthly invoice number generator (default)

* ID-based invoice number generator

How Invoice Number Generation Works
-----------------------------------

Invoice numbers are generated automatically using a Doctrine event listener that is triggered after an invoice is saved to the database. The generation process follows these steps:

1. **Trigger**: When a new invoice is created and persisted, the ``InvoiceNumberListener`` checks if the invoice already has a number.
2. **Generation**: If no number exists, the configured generator creates a unique number.
3. **Assignment**: The generated number is assigned to the invoice and saved.
4. **Uniqueness**: The ``NumberSequenceManager`` ensures that the sequential generated numbers are unique and not duplicated (see :ref:`Number Sequence Management <bundle-docs-platform-platform-bundle-number-sequence-management>`).

The diagram below illustrates the flow of invoice number generation:

::

    [Invoice persisted] 
           ↓
    [InvoiceNumberListener] 
           ↓
    [InvoiceNumberGeneratorInterface implementation] 
           ↓
    [Invoice number is set on the invoice]

.. note:: 
   If you manually set an invoice number before persisting the entity, the automatic generation will be skipped.


Sequential Monthly Invoice Number Generator
-------------------------------------------

The sequential monthly invoice number generator produces invoice numbers in the format: ``INV-YYYY-MM-NNNNN``. For example: ``INV-2025-03-00123``. It uses ``NumberSequenceManager`` to ensure unique, sequential numbers (see :ref:`Number Sequence Management <bundle-docs-platform-platform-bundle-number-sequence-management>`).

.. warning:: 
   Sequential numbering limitations:
   
   * With '%05d' format: maximum 99,999 invoices per month
   * With '%06d' format: maximum 999,999 invoices per month
   * Exceeding the limit will break number formatting (e.g., INV-2025-03-100000 instead of INV-2025-03-00000)
   * Ensure to monitor monthly invoice volumes to avoid reaching limits

This generator is configured in the following way:

* Overall invoice number format - ``oro_invoice.invoice_number_format: '#invoice_prefix##date_period##number#'``

* Date period format (see |date_format php documentation| for the supported formats) - ``oro_invoice.invoice_date_period_format: 'Y-m-'``

* Number format for the sequential part of the invoice number (see |sprintf php documentation| for the supported formats) - ``oro_invoice.invoice_sequential_number_format: '%05d'``

And lastly, the invoice prefix that is set in the system configuration under **System Configuration > Commerce > Sales > Invoices > General > Invoice Prefix** (``oro_invoice.invoice_prefix``): ``INV-``.

With the configuration values set as shown above, the generated invoice number will look like this - ``INV-2025-03-00123``.

ID Based Invoice Number Generator
---------------------------------

This generator uses the invoice entity's database ID (primary key) directly. The value is formatted using the configured pattern and prefixed with the value from the system configuration.

This generator can be configured in the following way:

* Number format for the sequential part of the invoice number (see |sprintf php documentation| for the supported formats) - ``oro_invoice.invoice_sequential_number_format: '%05d'``

* The  invoice prefix that is set in the system configuration under **System Configuration > Commerce > Sales > Invoices > General > Invoice Prefix** (``oro_invoice.invoice_prefix``): ``INV-``.

With the configuration values set as shown above, the generated invoice number will look like this - ``INV-00123``.

Available Invoice Number Generators
-----------------------------------

The `oro_invoice.number_generator` parameter supports the following values:

* ``sequential_monthly`` – Default generator. Uses date + sequential number per period.
* ``id_based`` – Simple sequence counter (not tied to invoice entity ID).

Configuring Invoice Number Generation
--------------------------------------

To configure which invoice number generator to use, as well as the configuration parameters for the selected generator, you can add the following configuration to your application's ``config.yml`` file:

.. code-block:: yaml

    oro_invoice:
        number_generator: sequential_monthly
        invoice_number_format: '#invoice_prefix##date_period##number#'
        invoice_date_period_format: 'Y-m-'
        invoice_sequential_number_format: '%05d'

.. code-block:: yaml

    oro_invoice:
        number_generator: id_based
        invoice_sequential_number_format: '%05d'

For both generators, the invoice prefix is set by the application administrators in the system configuration under **System Configuration > Commerce > Sales > Invoices > General > Invoice Prefix**.

Create a Custom Invoice Number Generator
----------------------------------------

If the available invoice number generators do not meet your needs, you can create a custom invoice number generator.

To create a custom invoice number generator, you need to create a class that implements ``Oro\Bundle\InvoiceBundle\Generator\InvoiceNumberGeneratorInterface``.

Its ``generate()`` method should return a unique invoice number. It accepts the ``$invoice`` argument, which you can use if the invoice entity is already created at that point.

.. oro_integrity_check:: 8c3f2f819814aff70ddb895fb5a72dc3d97b749e

    .. literalinclude:: /code_examples/commerce/demo/Generator/CustomInvoiceNumberGenerator.php
        :caption: src/Acme/Bundle/DemoBundle/Generator/CustomInvoiceNumberGenerator.php
        :language: php
        :lines: 4-

.. oro_integrity_check:: 3036ea332a5a50b2da361acbf29f2b3e057733b1

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/services.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/services.yml
        :language: yaml
        :lines: 2, 134-138

.. oro_integrity_check:: 8f869012bf43a50bcb985b72297404a231dc3c53

    .. literalinclude:: /code_examples/commerce/demo/Resources/config/oro/app.yml
        :caption: src/Acme/Bundle/DemoBundle/Resources/config/oro/app.yml
        :language: yaml
        :lines: 110-111

Your custom invoice number generator will now be used to generate invoice numbers automatically for all new invoices (see ``Oro\Bundle\InvoiceBundle\EventListener\Doctrine\InvoiceNumberListener``).

.. note:: If you are creating invoices programmatically and wish to assign a custom invoice number without using the invoice number generator, you can do so by setting the invoiceNumber property before persisting the new invoice entity to the database.

Usage in Invoice Number Generation
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**Example**:

.. code-block:: php

    use Oro\Bundle\InvoiceBundle\Generator\InvoiceOrganizationPeriodicNumberSequenceManagerFactory;
    // Generate invoice number like INV-2025-03-00124
    $factory = new InvoiceOrganizationPeriodicNumberSequenceManagerFactory($doctrine);
    $sequenceManager = $factory->createSequenceManager($invoice);
    $number = $sequenceManager->nextNumber(); // e.g., 124
    $invoiceNumber = sprintf('INV-2025-03-%05d', $number); // INV-2025-03-00124

.. include:: /include/include-links-dev.rst
   :start-after: begin

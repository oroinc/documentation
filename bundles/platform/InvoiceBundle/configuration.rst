:oro_show_local_toc: false

.. _bundle-docs-extensions-invoice-bundle-configuration:

Configuration
=============

The default configuration of |OroInvoiceBundle| is illustrated below:

.. code-block:: yaml

    oro_invoice:
        # Invoice prefix for generated invoice numbers
        invoice_prefix: 'INV-'
        
        # The invoice number generator type. Must match the "alias" attribute of 
        # the "oro_invoice.number_generator" tag of one of the tagged services
        number_generator: sequential_monthly
        
        # Invoice number configuration
        invoice_number:
            # Configuration for ID-based generator
            id_based:
                # The invoice sequential number format
                # @link https://www.php.net/manual/en/function.sprintf.php
                invoice_sequential_number_format_based: '%05d'
                
            # Configuration for sequential monthly generator  
            sequential_monthly:
                # The invoice number format, defining the order of concatenation of the
                # invoice prefix, date period and sequential number
                invoice_number_format: '#invoice_prefix##date_period##number#'
                
                # The invoice date period format
                # @link https://www.php.net/manual/en/datetime.format.php
                invoice_date_format: 'Y-m-'
                
                # The invoice sequential number format. The "sequential_monthly" invoice 
                # number generator will work only with zero padded sequential numbers that 
                # do not exceed a certain number of digits. For example, "%05d" will work 
                # fine only until exceeding 99,999 invoices in a month
                # @link https://www.php.net/manual/en/function.sprintf.php
                invoice_sequential_number_format: '%05d'
        
        # Invoice number sequence configuration
        invoice_number_sequence:
            # The date format used for discriminating invoice number sequences
            # @link https://www.php.net/manual/en/datetime.format.php  
            discriminator_date_format: 'Y-m'


You can also get bundle configuration by running the following command:

   .. code-block:: bash

        php bin/console config:dump-reference OroInvoiceBundle


.. include:: /include/include-links-dev.rst
   :start-after: begin

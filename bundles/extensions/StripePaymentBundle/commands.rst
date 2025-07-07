:oro_show_local_toc: false

.. _bundle-docs-extensions-stripe-payment-bundle-commands:

CLI Commands (OroStripePaymentBundle)
=====================================

oro:cron:stripe-payment:re-authorize
-------------------------------------

The ``oro:cron:stripe-payment:re-authorize`` initiates renewal of payment authorization for uncaptured payments that are about to expire.

Uncaptured payments automatically expire a set number of days after creation (7 days by default).
Once expired, they are marked as refunded, and any attempt to capture them will fail.

The command is run automatically by the cron job every hour, but you can also run it manually:

.. code-block:: none

    php bin/console oro:cron:stripe-payment:re-authorize


.. include:: /include/include-links-dev.rst
   :start-after: begin

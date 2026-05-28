.. _bundle-docs-commerce-order-bundle-commands:

CLI Commands (OrderBundle)
==========================

oro:cron:draft-session:cleanup:order
-------------------------------------

The ``oro:cron:draft-session:cleanup:order`` command initiates the cleanup of outdated draft orders
and order line items via the message queue. It is scheduled to run automatically at midnight every
day. Deletions are performed asynchronously, so make sure that the message consumer processes
(``oro:message-queue:consume``) are running for the scheduled deletions to be executed.

Run with the default lifetime of 7 days:

.. code-block:: none

   php bin/console oro:cron:draft-session:cleanup:order

Use the ``--draft-lifetime`` option to change the threshold (in days). Draft orders and line items
whose ``updatedAt`` timestamp is older than this value will be scheduled for deletion:

.. code-block:: none

   php bin/console oro:cron:draft-session:cleanup:order --draft-lifetime=30

.. include:: /include/include-links-dev.rst
   :start-after: begin

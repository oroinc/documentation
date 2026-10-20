.. _bundle-docs-commerce-customer-part-number-bundle-commands:

CLI Commands (CustomerPartNumberBundle)
=======================================

Both commands below are feature-gated by the ``oro_customer_part_number`` feature. For a step-by-step guide on
using them together to move off the legacy OroLab implementation, see :ref:`Migrating from the Legacy OroLab
Bundle <bundle-docs-commerce-customer-part-number-bundle-migrating-from-orolab>`.

.. _customer-part-number-migrate-from-orolab-command:

oro:customer-part-number:migrate-from-orolab
--------------------------------------------

The ``oro:customer-part-number:migrate-from-orolab`` command copies customer part numbers from the legacy
``orolab_customer_part_number`` table into the new ``oro_customer_part_number`` table.

.. note:: ``Migrations\Schema\OroCustomerPartNumberInstaller`` runs this migration automatically the first time
   this bundle's schema is installed - on a brand-new application install, or when this bundle is newly added to
   an already-installed application and ``oro:platform:update`` is run - provided the legacy
   ``orolab_customer_part_number`` table already exists at that point. Run this command manually only if the
   legacy table did not exist yet at that time, or to re-run the migration (e.g., with ``--dry-run``).

.. code-block:: none

   php bin/console oro:customer-part-number:migrate-from-orolab

Options:

* ``--dry-run`` - report what would be migrated without writing anything to the database.

  .. code-block:: none

     php bin/console oro:customer-part-number:migrate-from-orolab --dry-run

* ``--batch-size`` - number of source rows read per batch (default ``1000``).

  .. code-block:: none

     php bin/console oro:customer-part-number:migrate-from-orolab --batch-size=500

.. _customer-part-number-cleanup-orolab-command:

oro:customer-part-number:cleanup-orolab
---------------------------------------

The ``oro:customer-part-number:cleanup-orolab`` command removes the legacy OroLab ``CustomerPartNumber`` entity
configuration.

* Also removes the extended ``customer`` relation and its inverse ``partNumbers`` relation on ``Customer``.
* Asks for confirmation by default, since it removes entity configuration and extended relations.

.. code-block:: none

   php bin/console oro:customer-part-number:cleanup-orolab

Options:

* ``--force`` - skip the confirmation prompt, for use in a non-interactive environment.

  .. code-block:: none

     php bin/console oro:customer-part-number:cleanup-orolab --force

.. note:: The legacy table ``orolab_customer_part_number`` and its columns are intentionally NOT dropped by this
   command, so the data is retained and can be removed manually later. The command is idempotent and safe to
   run multiple times.

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _bundle-docs-commerce-customer-part-number-bundle-migrating-from-orolab:

Migrating from the Legacy OroLab Bundle
=======================================

This bundle supersedes the legacy ``orolab/customer-part-number`` extension. Follow these steps to move existing data to the new entity. For command options, see :ref:`CLI Commands <bundle-docs-commerce-customer-part-number-bundle-commands>`.

.. note:: ``Migrations\Schema\OroCustomerPartNumberInstaller`` runs the first time this bundle's schema is
   installed - on a brand-new application install, or when this bundle is newly added to an already-installed
   application and ``oro:platform:update`` is run. If the legacy ``orolab_customer_part_number`` table already
   exists at that point, the installer automatically enqueues the same migration query, so step 1 below is not
   required. Steps 1 through 6 are needed only if the legacy table did not exist yet when this bundle was
   installed or updated (e.g., the legacy extension is added later), or to re-run the migration manually.

1. Preview the migration with ``--dry-run``, then run it for real:

   .. code-block:: none

      php bin/console oro:customer-part-number:migrate-from-orolab --dry-run
      php bin/console oro:customer-part-number:migrate-from-orolab

   This copies the existing rows from the legacy ``orolab_customer_part_number`` table into the new
   ``oro_customer_part_number`` table, skipping any that already exist there.

2. Run the website search reindex, so migrated customer part numbers appear in the storefront search:

   .. code-block:: none

      php bin/console oro:website-search:reindex --scheduled

3. Verify the migrated customer part numbers in the storefront (search results, product view, listing pages,
   etc.).

4. Remove the old OroLab customer part number extension (the legacy package/bundle) from the application.

5. Remove the legacy entity configuration:

   .. code-block:: none

      php bin/console oro:customer-part-number:cleanup-orolab

   The legacy ``orolab_customer_part_number`` table is intentionally kept and must be dropped manually if it is
   no longer needed.

6. Clear the application cache:

   .. code-block:: none

      php bin/console cache:clear

.. include:: /include/include-links-dev.rst
   :start-after: begin

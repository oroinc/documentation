.. _bundle-docs-platform-query-designer-bundle-commands:

CLI Commands (QueryDesignerBundle)
==================================

oro:query-designer:definition:security-check
--------------------------------------------

To check the query definitions stored in the database, e.g. in segments and reports, use the following command:

.. code-block:: bash

   php bin/console oro:query-designer:definition:security-check

The command lists the query definitions that use an entity or a field that the query designer does not allow, or a column name that contains a join type or a join condition. Such a query definition cannot be saved, and a query built from it fails. Fix the listed segments and reports in the query designer UI.

To check the query definitions of entities of a specific class, pass the class name as an argument:

.. code-block:: bash

   php bin/console oro:query-designer:definition:security-check 'Oro\Bundle\SegmentBundle\Entity\Segment'

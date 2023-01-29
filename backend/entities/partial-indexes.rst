.. _dev-entities-partial-indexes:

Partial Indexes
===============

To use a partial index for the entity field, add the following condition as an additional option to the index definition:

.. code-block:: none

   $table->addIndex(['is_featured'], 'idx_oro_product_featured', [], ['where' => '(is_featured = true)']);

.. _dev-entities-partial-indexes:

Partial Indexes
===============

To use a partial index for the entity field, add the following condition as additional option to the index definition:

.. code-block:: none

   $table->addIndex(['is_featured'], 'idx_oro_product_featured', [], ['where' => '(is_featured = true)']);
    
.. note:: PostgreSQL supports partial indexes, however MySQL does not. For MySQL the additional option causes the database schema diversion.

To eliminate the negative impact for the MySQL-based instances and automatically adjust their database schema, declare the following service:

.. code-block:: none

    oro_product.event_listener.orm.featured_index_listener:
        class: Oro\Bundle\EntityBundle\EventListener\ORM\PartialIndexListener
        public: false
        arguments:
            - 'oro_product'
            - 'idx_oro_product_featured'
        tags:
            - { name: doctrine.event_listener, event: loadClassMetadata, connection: default }

The service removes the options that are not supported in MySQL from the index definition.

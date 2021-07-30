.. _admin-price-list-sharding:

Configure Price List Sharding
=============================

Data sharding allows to improve OroCommerce operation and accelerate database performance when handling big volumes of data.

In terms of price lists, data sharding is used to split one big table of price lists into smaller tables, i.e., one table per price list.

By default, price list sharding is disabled. 

However, it is recommended to enable price list sharding if you are experiencing product performance degradation, or for high load deployments with a large number of price lists and products within them. 

.. note:: 
  For PostgreSQL, make sure you have :ref:`PostgreSQL <sys-requirements-postgre-config>` uuid-ossp extension loaded.

.. note:: Combined prices cannot be sharded at the moment.

Configure Price List Sharding
-----------------------------

1. To enable price list sharding, set the following parameter in app/config/parameters.yml:

   ``enable_price_sharding: true``
     
2. To reorganize storage and shard the price table, run the following command:
   
   ``oro:price-lists:pl-storage-reorganize prices --strategy=sharding``

Disable Price Sharding
----------------------

To restore the default price storage structure:

1. To disable price list sharding, change app/config/parameters.yml to set ``enable_price_sharding: false``.

2. To reorganize storage and join sharded price tables into one, run the following command:
         
   ``oro:price-lists:pl-storage-reorganize prices --strategy=base``

Add Queries
-----------

In Oro applications (e.g., in PriceManager), sharding is handled via ShardManager, since Doctrine cannot work with dynamic tables for one entity. All operations with the price data, such as persist and remove, should be done via PriceManager which uses ShardManager.

To make you query `sharding-aware` (and use a proper table), add the following hints:

* `$query->setHint('priceList', $priceList->getId());`
  This hint is necessary to use correct query cache. If this hint is absent, the query cache should be disabled.

* `$query->setHint(PriceShardWalker::ORO_PRICING_SHARD_MANAGER, $shardManager);`
  This hint is used by PriceShardWalker to define the current table.

* `$query->setHint(Query::HINT_CUSTOM_OUTPUT_WALKER, PriceShardWalker::class);`
  This hint is used to update the final SQL.

.. note::

    * Tables are divided by Price Lists, so one table contains prices only from one Price List. When prices from a different Price List are needed, we should use JOIN for each Price List.
    * `HINT_CUSTOM_OUTPUT_WALKER` does not apply to delete queries. Delete queries must be executed via SQL, not DQL. You should manually manually replace the table names before running this query.

Insert Into Select Query
^^^^^^^^^^^^^^^^^^^^^^^^

To create a correct insert-into-select query, please use `InsertFromSelectShardQueryExecutor` that defines the table and executes insert into it.

PriceShardWalker
^^^^^^^^^^^^^^^^

PriceShardWalker analyzes a query and tries to detect a proper table to use based on the query parameters.

Grids
^^^^^

To apply PriceShardWalker to grids, use the `HINT_PRICE_SHARD` hint. Oro `QueryHintResolver` applies the required hints automatically.

.. code-block:: none

    source:
        hints:
            - HINT_PRICE_SHARD
        count_hints:
            - HINT_PRICE_SHARD

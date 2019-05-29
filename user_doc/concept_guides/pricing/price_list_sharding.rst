.. _admin-price-list-sharding:

Configure Price List Sharding
-----------------------------

.. contents:: :local:
   :depth: 1

Overview
^^^^^^^^

Data sharding allows to improve OroCommerce operation and accelerate database performance when handling big volumes of data.

In terms of price lists, data sharding is used to split one big table of price lists into smaller tables, i.e., one table per price list.

By default, price list sharding is disabled. 

However, it is recommended to enable price list sharding if you are experiencing product performance degradation, or for high load deployments with a large number of price lists and products within them. 

.. note:: 
  For PostgreSQL, make sure you have :ref:`PostgreSQL <sys-requirements-postgre-config>` uuid-ossp extension loaded.

.. note:: Combined prices cannot be sharded at the moment.

Configure Price List Sharding
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. To enable price list sharding, set the following parameter in app/config/parameters.yml:

	``enable_price_sharding: true``
     
2. To reorganize storage and shard the price table, run the following command:
   
	``oro:price-lists:pl-storage-reorganize prices --strategy=sharding``

Disable Price Sharding
^^^^^^^^^^^^^^^^^^^^^^

To restore the default price storage structure:

1. To disable price list sharding, change app/config/parameters.yml to set ``enable_price_sharding: false``.

2. To reorganize storage and join sharded price tables into one, run the following command:
         
	``oro:price-lists:pl-storage-reorganize prices --strategy=base``


**Related Articles**

* :ref:`Optimize Website Indexation and Price Recalculation <admin-website-index-and-price-calc>`

* :ref:`Pricing Configuration <pricing-configuration>`
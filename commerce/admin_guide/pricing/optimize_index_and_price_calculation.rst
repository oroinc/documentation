.. _admin-website-index-and-price-calc:

Optimize Website Indexation and Price Recalculation
---------------------------------------------------

While website indexation and price recalculation background processes are vital
for OroCommerce store, they may be time- and resource- consuming.

This topic summarizes best practices and advice that helps you maximize the
efficiency of these processes by tuning your software and hardware.

.. note:: Price recalculation is required before the indexation.

Price Recalculation
^^^^^^^^^^^^^^^^^^^

The price list data may contain quite complex dependencies and
formula. When price recalculation happens, all of the price list data is
analyzed, recalculated if necessary, and saved to the simplified combine tables.
This cache-like approach enables quicker data retrieval and increases the
OroCommerce storefront responsiveness.

To launch the price recalculation process, run the following console command:

``bin/console oro:price-lists:recalculate --all``

Execution time may vary from seconds on bare factory data to multiple hours for
several hundred thousand product prices.

To optimize the price recalculation, use the ``--disable-triggers`` parameter in
the command above to disable the triggers and speed up the SQL insert execution.

Indexation
^^^^^^^^^^

For faster search and access, the business data in the database should be
indexed via an internal search engine. After indexation, the user gets prompt
search and auto-complete results even for the extremely large amount of raw data.
The engine indexes the information (prices, product descriptions, SEO, attributes
etc.) and guarantees quick data retrieval leaving the original data untouched.

OroCommerce search index may be persisted in the database layer (using ORM) or
on the file system using the ElasticSearch (the latter is available in the
Enterprise edition only).

To launch the indexation process, use the following console command:

``bin/console oro:website:reindex``

Execution time may range from few minutes to several hours, depending on the
hardware and software configuration and the volume of data that is indexed.

To speed up the indexation, you can:

* Use parallel (multi-thread) indexation. As a prerequisite, ensure that several MessageQueue consumers are running. Next, run the command above with the ``--scheduled`` parameter. Depending on the number of CPU cores and consumers running, this can drastically cut the indexation time.

* Use the ``--scheduled`` (multithreaded) indexation to control the amount of entities, indexed per message. This will control indexation load distribution among several consumers and allow scaling. Use an example value of ``*/1000`` to generate messages with 1000 products each.


**Related Articles**

* :ref:`Configure Price List Sharding <admin-price-list-sharding>`

* :ref:`Pricing Configuration <pricing-configuration>`
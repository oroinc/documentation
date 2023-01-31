CLI Commands (PricingBundle)
============================

oro:price-lists:pl-storage-reorganize
-------------------------------------

The ``oro:price-lists:pl-storage-reorganize`` command reorganizes price list database tables to use or forgo sharding. After running this command, make sure to modify the *enable_price_sharding* parameter in config/config.yml to a matching value.

Use ``--strategy=sharding`` to reorganize database tables using sharding for prices:

.. code-block:: none

    php bin/console oro:price-lists:pl-storage-reorganize --strategy=sharding prices

Use ``--strategy=base`` to reorganize database tables without sharding for prices:

.. code-block:: none

    php bin/console oro:price-lists:pl-storage-reorganize --strategy=base prices

Run the command without arguments to see the list of all supported entities:

.. code-block:: none

    php bin/console oro:price-lists:pl-storage-reorganize

oro:price-lists:schedule-recalculate
------------------------------------

The ``oro:price-lists:schedule-recalculate`` command schedules recalculation of combined price lists and product prices.

.. code-block:: none

    php bin/console oro:price-lists:schedule-recalculate

Use the ``--customer``, ``--customer-group`` or ``--website`` options to recalculate only the prices related to the specified customers, customer groups or websites:

.. code-block:: none

    php bin/console oro:price-lists:schedule-recalculate --customer=<ID1> --customer=<ID2> --customer=<IDN>

.. code-block:: none

    php bin/console oro:price-lists:schedule-recalculate --customer-group=<ID1> --customer-group=<ID2> --customer-group=<IDN>

.. code-block:: none

    php bin/console oro:price-lists:schedule-recalculate --website=<ID1> --website=<ID2> --website=<IDN>

The ``--price-list`` option can limit the scope of the recalculations to the combined price lists that are derived from the specified price lists:

.. code-block:: none

    php bin/console oro:price-lists:schedule-recalculate --price-list=<ID1> --price-list=<ID2> --price-list=<IDN>

If the price calculation rules refer to other price lists, the --include-dependent option can be used to propagate the changes to all affected price lists:

.. code-block:: none

    php bin/console oro:price-lists:schedule-recalculate --include-dependent --price-list=<ID1> --price-list=<ID2> --price-list=<IDN>

This command can also be used with the ``--all`` option to recalculate all combined price lists in the system:

.. code-block:: none

    php bin/console oro:price-lists:schedule-recalculate --all

oro:price-lists:switch-pricing-storage
--------------------------------------

The ``oro:price-lists:switch-pricing-storage`` command switches pricing store type. Supported values: flat, combined.

.. code-block:: none

    php bin/console oro:price-lists:switch-pricing-storage <storage>

The flat price list storage allows no more than one price list association per record (website, customer group, customer) but it consumes less space and computational resources when you do not need the full power of price hierarchies and calculation formulas provided by the calculated price lists.

oro:import:price-list:file
--------------------------

The ``oro:import:price-list:file`` command imports prices from a CSV file to a specified price list. Upon import completion the import log is sent to the user whose email address is provided in the ``--email`` option.

.. code-block:: none

   php bin/console oro:import:price-list:file --priceListId=<ID> --email=<email> <file>

The ``--validation`` option can be used to perform data validation instead of actual import:

.. code-block:: none

   php bin/console oro:import:price-list:file --priceListId=<ID> --email=<email> --validation <file>
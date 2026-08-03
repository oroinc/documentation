.. _dev-guide-setup-flat-pricing:

Enable Flat Pricing
===================

Out of the box, OroCommerce uses :ref:`Combined Price List (CPL) <user-guide--pricing>` pricing, built for large, complex B2B businesses with multiple price lists, pricing strategies, price fallbacks, and price merges.

If you operate a small-scale business, or use a separate third-party system such as an ERP to generate and manage prices outside of OroCommerce, you can switch from the default CPL pricing to simpler flat pricing. A system administrator usually does this as part of post-install configuration.

With flat pricing enabled for the whole application, prices are fetched directly from the price lists, without complex pricing strategies or merges. You can configure CPL on the global and website levels; flat pricing adds the organization level as well.

Switch from Combined Pricing Storage to Flat
--------------------------------------------

To switch from the default CPL pricing to simple flat pricing, run the following command:

.. code-block:: php

   php "bin/console" oro:price-lists:switch-pricing-storage flat --env=prod

Set up flat pricing after installation and before populating the application with data. You can also switch from CPL to flat pricing in the production environment, but in that case **you will lose data**, so keep this in mind before you switch.

Flat price list storage also allows no more than one price list association per record. It keeps only the first price list associated with a record; all other associations to websites, customer groups, and customers are removed. For example, if a record had ten associations, nine would be removed.

After you switch from combined to flat pricing storage, update the website search index with the new prices:

.. code-block:: php

   bin/console oro:website-search:reindex --env=prod --scheduled

Switch from Flat Pricing Storage to Combined
--------------------------------------------

To switch from flat pricing back to CPL, use the following command:

.. code-block:: php

   php "bin/console" oro:price-lists:switch-pricing-storage combined

You will be prompted to run reindexation, which will recalculate combined price lists and product prices:

.. code-block:: php

   bin/console oro:price-lists:recalculate --env=prod --all

**Related Topics**

* :ref:`Pricing Concept Guide <user-guide--pricing>`
* :ref:`Price Management in Back-Office <user-guide--pricing--import--export>`

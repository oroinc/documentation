.. _dev-guide-setup-flat-pricing:

Enable Flat Pricing
===================

Out-of-the-box, OroCommerce comes with a :ref:`Combined Price List (CPL) <user-guide--pricing>` functionality developed to fit the needs of large complex B2B businesses, equipped with multiple price lists, pricing strategies, price fallbacks, and price merges. However, if your operate small-scale business, or use a separate third-party system, such as an ERP, to generate and manage prices outside of OroCommerce, you can switch from the default CPL pricing to a simpler flat pricing. This is usually done as part of application post-install configuration activities by a system administrator.

If flat pricing is configured for the whole application, prices are fetched directly from the price lists without complex pricing strategies and merges. Unlike CPL configuration, which is available on global and website levels, flat pricing configuration is available on global, organization and website levels.

Switch from Combined Pricing Storage to Flat
--------------------------------------------

To switch from the default CPL pricing to simple flat pricing, run the following command:

.. code-block:: php

   php "bin/console" oro:price-lists:switch-pricing-storage flat --env=prod

Although it is recommended to set up flat pricing following application installation and before populating the application with data, it is also possible to switch from the native CPL to flat pricing in the production environment. However, in this case **you will lose data**, so please keep this in mind when performing the switch.

Also, be aware that flat price list storage allows no more than one price list association per record. All other price list associations to websites, customer groups and customers except for the very first price list associated with a record will be removed. So if you had ten association with the record, nine will be removed.

As soon as you switch from combined to flat pricing storage, make sure you update website search index with the new prices:

.. code-block:: php

   bin/console oro:website-search:reindex --env=prod --scheduled

Switch from Flat Pricing Storage to Combined
--------------------------------------------

To switch from flat pricing back to CPL, use the following command:

.. code-block:: php

   php "bin/console" oro:price-lists:switch-pricing-storage combined

You will be prompted to run reindexation:

.. code-block:: php

   bin/console oro:price-lists:recalculate --env=prod --all

**Related Topics**

* :ref:`Pricing Concept Guide <user-guide--pricing>`
* :ref:`Price Management in Back-Office <user-guide--pricing--import--export>`
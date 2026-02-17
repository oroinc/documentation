Upgrade Website Index to Elasticsearch >=9.2, <10.0
===================================================

You have only one option to perform the upgrade: via full reindexation.

Keep in mind that the previous OroCommerce versions (5.0 and below) have different structure for
flat object fields, so full indexation is required in order to fill the data in the correct format.

Full Reindexation
-----------------

This option is suitable for upgrades from all previous versions.

Search index upgrade is part of the :ref:`application upgrade <upgrade-application>`.
So, once you have turned on maintenance mode through ``app/console lexik:maintenance:lock --env=prod``, you need to perform the following actions:

1. |Stop old Elasticsearch|
2. Modify credentials for search engine configuration in the corresponding environment variables
3. |Start the Elasticsearch| 9.\* service.

Proceed with the :ref:`standard upgrade procedure <upgrade-application>`.

Note
^^^^

If you are skipping search indexation during the upgrade or keeping all the indices during the Elasticsearch upgrade
then you have to recreate indices and trigger full indexation manually:

.. code-block:: bash

    php bin/console oro:website-elasticsearch:create-website-indexes --env=prod
    php bin/console oro:website-search:reindex --env=prod --scheduled

.. hint:: See the :ref:`Indexation process <search_index_overview--indexation-process>` documentation for more details on synchronous and asynchronous (scheduled) indexation.

.. include:: /include/include-links-dev.rst
   :start-after: begin

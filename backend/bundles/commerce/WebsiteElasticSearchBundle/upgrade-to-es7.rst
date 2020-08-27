Upgrade Website Index to Elasticsearch 7.\*
===========================================

You have two options to perform the upgrade: either via full reindexation or via search index dump.

Keep in mind that Elasticsearch 7.\* can be used with version 3.1 as well, but in this case application uses old index structure (with mapping types). If you need to upgrade to the current version from a such application then you should change index prefix in `config/parameters.yml` file during the upgrade and allow application to create new indices with a new structure (without mapping types). Both upgrade options can be used to do that.

Indices with old structure (with old prefix) should be removed after the upgrade.

Full Reindexation
-----------------

This option is suitable for upgrades from version lower than 1.6, or if you have a small number of entities (fewer than a hundred thousand).

Search index upgrade is a part of the :ref:`application upgrade <upgrade-application>`.
So, once you've turned on maintenance mode through ``app/console lexik:maintenance:lock --env=prod``, you need to perform the following actions:

1. |Stop old Elasticsearch|
2. Modify credentials  for search engine configuration in the `config/parameters.yml` file
3. |Start the Elasticsearch| 7.\* service.

Proceed with the :ref:`standard upgrade procedure <upgrade-application>`.

Search Index Dump
-----------------

Search index dump is suitable only if you perform upgrade from versions 1.6 to 3.1, and you have a large number of entities.
The biggest advantage of this approach is that you do not need to schedule reindexation and wait until it is finished.

Generating the search index dump is also a part of standard procedure of application upgrade.
But you should note that the elastic index dump must be created from the old version of the code (1.6 to 3.1). So follow next step of upgrade procedure:

1. Turn on maintenance mode to switch the application to the maintenance mode through
 
   * 1.6 version:

     .. code-block:: none

        app/console lexik:maintenance:lock --env=prod

   * 3.1 version:

     .. code-block:: none

        bin/console lexik:maintenance:lock --env=prod


2. Create Elastic search index dump. Consider you must do this **before** updating code to new version.

   * 1.6 version:

     .. code-block:: none

        app/console oro:website-elasticsearch:dump-website-index elasticsearch7 website-index-es7.dump --env=prod

   * 3.1 version:

     .. code-block:: none

        bin/console oro:website-elasticsearch:dump-website-index elasticsearch7 website-index-es7.dump --env=prod

   It creates the `website-index-es7.dump` file with |search index dump in the Elasticsearch bulk API| format which is applicable for Elasticsearch version 7.\*.

   Here is an example:

   .. code-block:: none

        {"index":{"_index":"oro_search_oro_organization","_id":1}}
        {"all_text":"Oro","oro_organization_owner":0,"organization":0,"name":"Oro"}

3. |Stop old Elasticsearch service|.

4. Proceed with :ref:`standard upgrade procedure <upgrade-application>` which includes creating needed backups and updating code to new version, updating composer dependencies (all actions needed before running update command).

5. Then modify credentials for search engine configuration in the `config/parameters.yml` file. You should do this **after** updating code to new version.

6. |Start the Elasticsearch| 7.\* service.

7. Execute update command from standard upgrade procedure but **pay attention** to `skip-search-reindexation` (it will prevent full reindexation start):

   .. code-block:: none

      bin/console oro:platform:update --skip-search-reindexation --env=prod

8. Now you need to execute command which will create an empty indexes (without any data) with correct elastic search mappings:

   .. code-block:: none

      bin/console oro:website-elasticsearch:create-website-indexes --env=prod


9. Upload the dump data to the Elasticsearch 7.\* index, the Elasticsearch 7.\* bulk API, and the dump file created previously using a standard curl CLI command:

   .. code-block:: none

      curl -XPOST http://localhost:9200/_bulk -H 'Content-Type: application/json' --data-binary @website-index-es7.dump > /dev/null

   To speed up this process you may split the dump file into smaller chunks and upload them in parallel. In this case, each chunk has to contain an even number of lines because each document is represented by two lines in the dump file.

10. Proceed with the :ref:`standard upgrade procedure <upgrade-application>`.

You may adjust this procedure according to your needs, but keep in mind that you need to:

* create index dump **before** upgrading to 4.+ and ensure that old Elasticsearch service is running at this time;
* create and upload index dump during maintenance mode to avoid data loss.

.. note::
    Remember to :ref:`create a dump of Standard Search Index <standard-elasticsearch-dump>`

.. include:: /include/include-links-dev.rst
   :start-after: begin


Troubleshooting
---------------

Search Index Shows Outdated Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A changed entity might not be indexed yet if its reindexation request message is still waiting in the message queue. Ensure the consumer is running, wait for all messages to be processed, and try again.

New Entity Does Not Appear in the Search Results
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**First possible reason:** The new entity might not be indexed yet if its reindexation request message is still waiting in the message queue. Ensure the consumer is running, wait for all messages to be processed, and try again.

**Second possible reason:** The current user is not allowed to see the new entity:

* Standard search index type --- The current user does not have permission to see the entity. Check the entity's ownership and organization, and confirm the current user has access to it.
* Website search index type --- The entity is invisible to the current user. Check the parameters that might affect its visibility to the current user (statuses, visibility restrictions, system configuration, etc.).

Cannot Connect to Elasticsearch
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Verify the credentials specified in the ``ORO_SEARCH_DSN`` environment variable --- host, port, index name, and authentication options. To confirm you have access, connect to the Elasticsearch server manually with the CLI curl command:

.. code-block:: yaml

   $ curl -I http://localhost:9200
   HTTP/1.1 200 OK
   Content-Type: text/plain; charset=UTF-8
   Content-Length: 0

   $ curl -I http://localhost:9200/index_name
   HTTP/1.1 200 OK
   Content-Type: text/plain; charset=UTF-8
   Content-Length: 0

Different Search Engines Return Different Results
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Full-text search implementation depends on the storage type, so different engines might return slightly different results. This is valid behavior. Oro applications can use two full-text search algorithms: PostgreSQL DBMS full-text search or Elasticsearch full-text search.

Need to Reindex Entities
^^^^^^^^^^^^^^^^^^^^^^^^

To rebuild a completely broken index from scratch, or to refresh only a specific scope of entities, use the reindexation command.

Standard search index provides the following CLI commands (:ref:`here are examples of work with these commands <search_index_db_from_md--console-commands>`):

* *oro:search:reindex* - rebuilds the search index and allows reindexing all entities or only entities of a specific entity class; indexation can be synchronous (default behavior) or asynchronous;
* *oro:search:index* - allows updating the search index for specific entities by their entity class and identifiers; indexation is asynchronous.

Website search index provides the following command (:ref:`here are examples of working with this command <website-search-bundle-console-commands>`):

* **oro:website-search:reindex** --- rebuilds the storefront search index and allows reindexing all entities, or only entities of a specific entity class, or entities for a specific website, or specific entities by their identifiers; indexation can be synchronous (default behavior) or asynchronous.

.. include:: /include/include-links-dev.rst
   :start-after: begin

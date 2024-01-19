Troubleshooting
---------------

Search Index Shows Outdated Data
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

An entity that was changed might not be indexed yet, and the reindexation request message is still waiting in the message queue. Please ensure the consumer is running, all messages are processed and then try again.

New Entity Does Not Appear in the Search Results
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

**First possible reason:** New entity might not be indexed yet, and the reindexation request message is still waiting in the message queue. Please ensure the consumer is running, all messages are processed and then try again.
**Second possible reason:** Current user is not allowed to see a new entity.
Standard search index type: The current user does not have permission to see the entity. Look at the entity's ownership and organization and check if the current user has access to it.
Website search index type: The entity is invisible to a current user. Please, check parameters that might affect the visibility of the entity to a current user (statuses, visibility restrictions, system configuration, etc.).

Cannot Connect to Elasticsearch
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please, verify the credentials specified in the ``ORO_SEARCH_DSN`` environment variable - host, port, index name, and authentication options. You can try to manually connect to the Elasticsearch server via the CLI curl command to make sure that you have access to it:

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

Implementation of the full-text search depends on a storage type, so different engines might return slightly different results, which is valid behavior. Oro applications may use two different full-text search algorithms - PostgreSQL DBMS full-text search, or Elasticsearch full-text search.

Need to Reindex Entities
^^^^^^^^^^^^^^^^^^^^^^^^

If your index is totally broken and you need to create it from scratch, or you need to refresh only specific scope of entities, then you should use the reindexation command.

Standard search index provides the following CLI commands (:ref:`here are examples of work with these commands <search_index_db_from_md--console-commands>`):

* *oro:search:reindex* - rebuilds the search index and allows reindexing all entities or only entities of a specific entity class; indexation can be synchronous (default behavior) or asynchronous;
* *oro:search:index* - allows updating the search index for specific entities by their entity class and identifiers; indexation is asynchronous.

Website search index provides the following command (:ref:`here are examples of working with this command <website-search-bundle-console-commands>`):

* **oro:website-search:reindex** - rebuilds the storefront search index and allows reindexing all entities, or only entities of a specific entity class, or entities for a specific website, or specific entities by their identifiers; indexation can be synchronous (default behavior) or asynchronous.

.. include:: /include/include-links-dev.rst
   :start-after: begin

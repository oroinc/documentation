Troubleshooting
---------------

**Search Index Shows Outdated Data**

Entity that was changed might be not indexed yet and reindexation request message is still waiting in message queue. Please, make sure that consumer is running, all messages are processed and then try again.

**New Entity Does Not Appear in the Search Results**

**First possible reason:** New entity might be not indexed yet and reindexation request message is still waiting in message queue. Please, make sure that consumer is running, all messages are processed and then try again.
**Second possible reason:** Current user is  not allowed to see new entity.
Standard search index type: Current user doesn't have permissions to see the entity. Please, have a look at ownership and organization of the entity and check if current user have an access to it.
Website search index type: The entity is invisible to a current user. Please, check parameters that might affect visibility of the entity to a current user (statuses, visibility restrictions, system configuration etc).

**Cannot Connect to Elasticsearch**

Please, verify credentials specified at the confing/parameters.yml file - host, port, index name, authentication options. You can try to manually connect to Elasticsearch server via CLI curl command to make sure that you have an access to it:

.. code:: yaml

   $ curl -I http://localhost:9200
   HTTP/1.1 200 OK
   Content-Type: text/plain; charset=UTF-8
   Content-Length: 0

   $ curl -I http://localhost:9200/index_name
   HTTP/1.1 200 OK
   Content-Type: text/plain; charset=UTF-8
   Content-Length: 0

**Different Search Engines Return Different Results**

Implementation of full-text search depends on a storage type, so different engines might return slightly different results and this is valid behaviour. Oro applications may use three different full-text search algorithms - Mysql DBMS full-text search, PostgreSQL DBMS full-text search or Elasticsearch full-text search.

**Need to Reindex Entities**

If your index is totally broken and you need to create it from scratch, or you need to refresh only specific scope of entities then you should use reindexation command.

Standard search index provides following CLI commands (|here are examples of work with these commands|):

* *oro:search:reindex* - allows to reindex all entities or only of a specific entity class; indexation can be synchronous (default behaviour) or asynchronous;
* *oro:search:index* - allows to reindex specific entities by their entity class and identifiers; indexation is asynchronous.

Website search index provides following command (|here are examples of work with this command|):

* **oro:website-search:reindex** - allows to reindex all entities, or only of a specific entity class, or entities for a specific website, or specific entities by their identifiers; indexation can be synchronous (default behaviour) or asynchronous.

.. include:: /include/include-links.rst
   :start-after: begin
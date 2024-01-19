.. _search--best-practices:

Best Practices
==============

Use Data Denormalization
------------------------

The search index is document-based storage that does not support relations. Instead, you can denormalize them and store related information at the main entity level. This way, you can increase search speed.

For example, if the Product entity is related to the Brand entity, then the Product document in the search index can store some brand information (ID, label, etc.), which might require an effective and fast search.

Isolate Search Index Interaction Inside Search Repositories
-----------------------------------------------------------

Every time you want to request custom information from the search index, make sure you get it via the search repository. The search repository provides a storage abstraction layer (similar to the Doctrine entity repositories), so the business logic is aware of the repository but not the search index structure.

If you want to create a repository, create a new class extended from the appropriate search repository class (``Oro\Bundle\SearchBundle\Query\SearchRepository`` for standard index type or ``Oro\Bundle\WebsiteSearchBundle\Query\WebsiteSearchRepository`` for website index type). Next, declare it as a service, add custom methods, and inject it into the required business logic service. Search repositories work with high-level search query object representations. You can optionally pass an entity name, as well. In this case, queries will be, by default, executed only for a specific entity.

Here is an example of the search repository for the standard index type and its definition:

.. code-block:: php

   namespace Oro\Bundle\UserBundle\Search;

   use Oro\Bundle\SearchBundle\Query\Criteria\Criteria;
   use Oro\Bundle\SearchBundle\Query\Query;
   use Oro\Bundle\SearchBundle\Query\SearchRepository;

   /**
    * Search repository used to extract user data from standard search index
    */
   class UserRepository extends SearchRepository
   {
       /**
        * @param string $domain
        * @return array
        */
       public function getUserIdsByEmailDomain($domain)
       {
           $elements = $this->createQuery()
               ->addWhere(Criteria::expr()->like('email', $domain))
               ->setMaxResults(Query::INFINITY)
               ->getResult()
               ->getElements();

           $userIds = [];
           foreach ($elements as $element) {
               $userIds[] = $element->getRecordId();
           }

           return $userIds;
       }
   }

.. code-block:: yaml

   services:
       oro_user.search.repository.user:
           class: Oro\Bundle\UserBundle\Search\UserRepository
           arguments:
               - '@oro_search.query_factory'
               - '@oro_search.provider.search_mapping'
           calls:
               - [setEntityName, ['Oro\Bundle\UserBundle\Entity\User']]

And here is an example of the search repository for the website index type and its definition:

.. code-block:: php

   namespace Oro\Bundle\ProductBundle\Search;

   use Oro\Bundle\SearchBundle\Query\Criteria\Criteria;
   use Oro\Bundle\SearchBundle\Query\SearchQueryInterface;
   use Oro\Bundle\WebsiteSearchBundle\Query\WebsiteSearchRepository;

   class ProductRepository extends WebsiteSearchRepository
   {
       /**
        * @param array $skus
        * @return SearchQueryInterface
        */
       public function getFilterSkuQuery($skus)
       {
           $searchQuery = $this->createQuery();

           // Convert to uppercase for insensitive search
           $upperCaseSkus = array_map("strtoupper", $skus);

           $searchQuery
               ->addSelect('sku')
               ->addSelect('names_LOCALIZATION_ID as name')
               ->addWhere(Criteria::expr()->in('sku_uppercase', $upperCaseSkus));

           return $searchQuery;
       }
   }

.. code-block:: yaml

   oro_product.website_search.repository.product:
       parent: oro_website_search.repository.abstract
       class: Oro\Bundle\ProductBundle\Search\ProductRepository
       calls:
           - [setEntityName, ['Oro\Bundle\ProductBundle\Entity\Product']]

Avoid Working Directly with the Search Engine and Search Indexer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Do not use the production code's search engine and indexer directly.

If you need to perform a search request, encapsulate it in the repository.

If you need to trigger reindexation, remember that most of the data is reindexed automatically; if you need to do manual reindexation, you can usually do it on a higher level, e.g., trigger an event at the website index type.

If, for some reason, you still have to work directly with the search engine or search indexer - please, encapsulate all your logic inside the intermediate storage layer service (similar to the search repository) and use it at the business logic layer. This way, the business logic will be aware of storage but not the search index's structure.

Debugging
---------

If you need to debug some search requests/indexations, but do not know an entry point, then you can set a breakpoint in the appropriate engine/indexer (or all engines/indexers). This way, after you catch the breakpoint, you will be able to track the whole stack trace. The most commonly used method for a search engine is **search**; the most commonly used methods for a search indexer are **save and delete**.

Most of the indexations happen asynchronously. To debug real indexation, set the breakpoint at the appropriate indexer, run the message queue consumer in debug mode to catch the breakpoint, and then trigger asynchronous indexation.

If you need to debug a remote server and do not have access to it, configure logging there and see results in logs.

Testing
-------

Like any storage interaction, search index interaction must be covered with functional tests. In functional tests, you can work directly with the search repository, search engine, or search indexer. You can (and should) also cover search index interaction with behat tests.

Useful Elasticsearch Plugins
----------------------------

|Elastic HQ| provides the UI to manage the Elasticsearch cluster (indexes, mappings, queries, etc.) instead of the plain CLI. This plugin is recommended only for the development environment because of the possible security issues in the production environment.

Search Index Optimization
-------------------------

There are several ways to optimize the search index and speed up the search and indexation speed.

* **Change the search engine**. If you use the ORM search engine, you can switch to the Elasticsearch engine and do full reindexation (which might take some time). ORM search engine uses the EAV model to store documents in relational storage, which is not an efficient or fast approach. However, Elasticsearch is originally document-based, so it works faster and shows much better performance.

* **Storage optimization**. You can improve the hardware used for search index storage - more RAM, processing cores, faster disk (SSD), etc. If you use the ORM search engine, you can check the performance of standard search queries: get queries, do EXPLAIN, and see how you can optimize DBMS.

* **Index data optimization**. You can check what entity data is not required (or not used) in the search index, remove it from mapping and/or indexed data, and trigger full reindexation (it might take some time). Next, each search document should become smaller, and the whole index should take up less space on your disk.

* **Index structure optimization**. If you use Elasticsearch, you can change how the full-text index is built: change default index analyzers, index tokenizers, and index token filters to the fastest ones.

* **Accessibility optimization**. You can measure the delay required to connect to the search index storage and try to decrease this value. For example, move it to a server with a smaller network delay and connection time. Using Elasticsearch cluster, you can also check where shards and replicas are placed and optimize this infrastructure.

How to Work with Big Data
-------------------------

Below are recommendations for working with the search index with large amounts of data (1 million entities and more).

* **Run indexation in parallel** - split the scope of the indexed entities into small chunks (1000-10000 entities) and ensure enough consumers to process them in parallel.
* **Use Elasticsearch engine** - it is faster and performs much better than the ORM search engine in case of considerable data.
* **Use language optimization** - if you know what languages are used in your application, then you can optimize the index structure and data according to these languages; see the list of Elasticsearch language analyzers.
* **Keep the search index on a separate server** - this way, it will not be affected by the main relational DB load.
* **Use Elasticseach cluster if needed** - if your index is too big to keep on one server and/or you want to balance the search index load between several servers, then you can use Elasticseach cluster.
* **Increase RAM** - the recommended amount of RAM for the search index is half the index size or more, i.e., if you have 50GB of index data, it is recommended to have 25GB+ of RAM.
* **Use SSD** - this type of disk provides faster read/write access than HDD and allows faster processing of parts of the search index data.

.. include:: /include/include-links-dev.rst
   :start-after: begin
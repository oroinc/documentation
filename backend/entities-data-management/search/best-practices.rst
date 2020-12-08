.. _search--best-practices:

Best Practices
==============

Use Data Denormalization
------------------------

The search index is a document-based storage, and it does not support relations. Instead, you can denormalize them and store related information at the main entity level. This way, you can increase search speed.

For example, if the Product entity has a relation to the Brand entity, then the Product document in the search index can store some brand information (ID, label, etc.), which might require an effective and fast search.

Isolate Search Index Interaction Inside Search Repositories
-----------------------------------------------------------

Every time you want to request custom information from the search index, make sure you get it via the search repository. The search repository provides a storage abstraction layer (similar to the Doctrine entity repositories), so the business logic is aware of the repository but not of the search index structure.

If you want to create a repository, then you should create a new class extended from the appropriate search repository class (``Oro\Bundle\SearchBundle\Query\SearchRepository`` for standard index type or ``Oro\Bundle\WebsiteSearchBundle\Query\WebsiteSearchRepository`` for website index type), declare it as a service, add custom methods, and inject it into required business logic service. Search repositories work with the high-level search query object representations. You can optionally pass entity name, as well. In this case, queries will be by default executed only for a specific entity.

Here is example of the search repository for the standard index type and its definition:

.. code-block:: php
   :linenos:

   <?php

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
   :linenos:

   services:
       oro_user.search.repository.user:
           class: Oro\Bundle\UserBundle\Search\UserRepository
           arguments:
               - '@oro_search.query_factory'
               - '@oro_search.provider.search_mapping'
           calls:
               - [setEntityName, ['Oro\Bundle\UserBundle\Entity\User']]

And here is example of the search repository for the website index type and its definition:

.. code-block:: php
   :linenos:

   <?php

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
   :linenos:

   oro_product.website_search.repository.product:
       parent: oro_website_search.repository.abstract
       class: Oro\Bundle\ProductBundle\Search\ProductRepository
       calls:
           - [setEntityName, ['Oro\Bundle\ProductBundle\Entity\Product']]

Avoid Working Directly with the Search Engine and Search Indexer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Do not use the search engine and search indexer directly in the production code.

If you need to perform a search request, encapsulate it inside the search repository.

If you need to trigger reindexation, then remember that most of the data is reindexed automatically; if you need to do manual reindexation you can usually do it on a higher level, e.g. trigger an event at website index type.

If for some reason you still have to work directly with the search engine or search indexer - please, encapsulate all your logic inside the intermediate storage layer service (similar to the search repository) and use it at the business logic layer. This way, the business logic will be aware about a storage, but not about the structure of the search index itself.

Debugging
---------

If you need to debug some search requests/indexations, but do not know an entry point to it, then you can set a breakpoint in the appropriate engine/indexer (or all engines/indexers). This way, after you catch the breakpoint you will be able to track whole stack trace. The most commonly used method for a search engine is **search**; the most commonly used methods for a search indexers are **save and delete**.

Please, remember, that most of the indexations happen asynchronously. So, if you want to debug real indexation, set the breakpoint at the appropriate indexer, run message queue consumer in debug mode to be able to catch breakpoint, and then trigger asynchronous indexation.

If you need to debug a remote server and you do not have access to it, then configure logging there and see results in logs.

Testing
-------

Search index interaction, like any storage interaction, has to be covered with functional tests. In functional tests you can work directly with the search repository, search engine or search indexer. You can (and you should) also cover search index interaction with behat tests as well.

Useful Elasticsearch Plugins
----------------------------

|Elastic HQ| provides the UI to manage the Elasticsearch cluster (indexes, mappings, queries etc) instead of the plain CLI. This plugin is recommended for use only in the development environment because of the possible security issues in the production environment.

Search Index Optimization
-------------------------

There are several ways to optimize the search index and speed up the search and indexation speed.

* **Change the search engine**. If you are using ORM search engine, you can switch to the Elasticsearch engine and do full reindexation (which might take some time). ORM search engine uses EAV model to store documents in the relational storage, which is not an efficient or fast approach. However, Elasticsearch is originally document-based, so it works faster and shows much better performance.

* **Storage optimization**. You can improve the hardware used for a search index storage - more RAM, more processing cores, faster disk (SSD) etc. If you are using the ORM search engine, then you can check performance of standard search queries: get queries, do EXPLAIN, and see how you can optimize DBMS.

* **Index data optimization**. You can check what entity data is not required (or not used) in the search index, remove it from mapping and/or indexed data, and trigger full reindexation (it might take some time). After that, each search document should become smaller and the whole index should take less space on your disk.

* **Index structure optimization**. If you are using Elasticsearch, you can change the way full-text index is built: change default index analyzers, index tokenizers and index token filters to the the fastest ones.

* **Accessibility optimization**. You can measure the delay required to connect to the search index storage and try to decrease this value. For example, move it to a server with a smaller network delay and connection time. If you are using Elasticsearch cluster, then you can check where shards and replicas are placed and optimize this infrastructure, as well.

How to Work with Big Data
-------------------------

Here are a couple of recommendations on how to work properly with the search index with big amounts of data (1 million of entities and more).

* **Run indexation in parallel** - split scope of the indexed entities into small chunks (1000-10000 entities) and make sure that there are enough consumers to process them in parallel.
* **Use Elasticsearch engine** - it is faster and performs much better than the ORM search engine in case of big amount of data.
* **Use language optimization** - if you know what languages are used in your application, then you can optimize the index structure and data according to these languages; see the list of Elasticsearch language analyzers.
* **Keep search index at the separate server** - this way it will not be affected by the main relational DB load.
* **Use Elasticseach cluster if needed** - if your index is too big to keep it on one server and/or you want to balance the search index load between several servers, then you can use Elasticseach cluster.
* **Increase RAM** - the recommended amount of RAM for the search index is half of the index size or more, i.e. if you have 50GB of index data, it is recommended to have 25GB+ of RAM.
* **Use SSD** - this type of disk provides faster read/write access than HDD and allows to request parts of the search index data faster.

.. include:: /include/include-links-dev.rst
   :start-after: begin

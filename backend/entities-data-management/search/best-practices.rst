.. _search--best-practices:

Best Practices
--------------

Use Data Denormalization
^^^^^^^^^^^^^^^^^^^^^^^^

Search index is a document based storage and it does not support relations. Instead you can denormalize them and store related information at the main entity level - this way you can increase search speed.
For example, if Product entity has a relation to Brand entity then Product document at the search index may store some brand information (ID, label etc) which might be required to do effective and fast search.

Isolate Search Index Interaction Inside Search Repositories
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Every time you want to request some custom information from the search index you should get it via the search repository. Search repository provides a storage abstraction layer (similar to Doctrine entity repositories), so business logic will be aware about the repository, but not about the search index structure.
If you want to create a repository then you should create new class extended from the appropriate search repository class (``Oro\Bundle\SearchBundle\Query\SearchRepository`` for standard index type or ``Oro\Bundle\WebsiteSearchBundle\Query\WebsiteSearchRepository`` for website index type), declare it as a service, add custom methods and inject it into required business logic service. Search repositories work with the high-level search query object representations. You can optinally pass entity name as well - in this case queries will be by default executed only for the specific entity.
Here is example of search repository for standard index type and its definition:

.. code:: php

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

.. code:: yaml

   services:
       oro_user.search.repository.user:
           class: 'Oro\Bundle\UserBundle\Search\UserRepository'
           arguments:
               - '@oro_search.query_factory'
               - '@oro_search.provider.search_mapping'
           calls:
               - [setEntityName, ['Oro\Bundle\UserBundle\Entity\User']]

And here is example of search repository for website index type and its definition:

.. code:: php

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

.. code:: yaml

   oro_product.website_search.repository.product:
       parent: oro_website_search.repository.abstract
       class: 'Oro\Bundle\ProductBundle\Search\ProductRepository'
       calls:
           - [setEntityName, ['Oro\Bundle\ProductBundle\Entity\Product']]

Avoid Working Directly with the Search Engine and Search Indexer
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Please, don't use search engine and search indexer at the production code directly.
If you need to perform search request it's better to encapsulate it inside search repository.
If you need to trigger reindexation then you should remember, that most of the data is reindexed automatically; if you need to do manual reindexation you can usually do it on a higher level - e.g. you can trigger an event at website index type.
If for some reason you still have to work directly with search engine or search indexer - please, encapsulate all your logic inside the intermediate storage layer service (similar to search repository) and use it at the business logic layer. This way business logic will be aware about a storage, but not about the structure of the search index itself.

Debugging
^^^^^^^^^

If you need to debug some search requests/indexations, but don't know an entry point to it, then you can set a breakpoint in the appropriate engine/indexer (or all engines/indexers) - this way after you catch the breakpoint you'll be able to track whole stack trace. The most commonly used method for a search engine is search; the most commonly used methods for a search indexers are save and delete.
Please, remember, that most of the indexations are happended asynchronously - so, if you want to debug real indexation you should set breakpoint at the appropriate indexer, run message queue consumer in debug mode to be able to catch breakpoint and then trigger asynchronous indexation.
If you need to debug remote server and you don't have an access to it then you should configure logging there and see results in logs.

Testing
^^^^^^^

Search index interaction like any storage interaction have to be covered with functional tests. In functional tests you can work directly with the search repository, search engine or search indexer.
You can and you should also cover search index interaction with behat tests as well.

Useful Elasticsearch Plugins
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

|Elastic HQ| is a very useful plugin for developers because it provides UI to manage Elasticsearch cluster (indexes, mappings, queries etc) instead of the plain CLI. This plugin is recommended to use only at the development environment because of the possible security issues at production environment.

Search Index Optimization
^^^^^^^^^^^^^^^^^^^^^^^^^

There are several ways how you can optimize search index and speed up search and indexation speed.

* Change search engine. If you're using ORM search engine then you can switch to Elasticsearch engine and do full reindexation (might take some time). ORM search engine uses EAV model to store documents at the relational storage, which is not very efficient and fast approach. However, Elasticsearch engine is document based originally, so it works faster and shows much better performance.
* Storage optimization. You can improve hardware used for a search index storage - more RAM, more processing cores, faster disk (SSD) etc. If you're using ORM search engine then you can check performance of a standard search queries - just get queries, do EXPLAIN and see how you can optimize DBMS.
* Index data optimization. You can check what entity data is not required (or not used) at a search index, remove it from mapping and/or indexed data and trigger full reindexation (might take some time). After that each search document should become smaller and whole index should take less space on a disk.
* Index structure optimization. If you're using Elasticsearch you may change the way full-text index is built - you can change default index analyzers, index tokenizers and index token filters to the faster ones.
* Accessibility optimization. You can measure delay required to connect to a search index storage and try to decrease this value - e.g. move it to a server with smaller network delay and connection time. If you're using Elasticsearch cluster then you can check where shards and replicas are placed and optimize this infrastructure as well.

How to Work with Big Data
^^^^^^^^^^^^^^^^^^^^^^^^^

Here are couple of recommendations how to work properly with search index with a big amount of data - 1 million of entities and more.

* **Run indexation in parallel** - split scope of indexed entities on a small chunks (1000-10000 entities) and make sure that there are enough consumers to process them in parallel.
* **Use Elasticsearch engine** - it's faster and performs much better than ORM search engine in case of big amout of data.
* **Use language optimization** - if you know what languages are used at your application then you can optimize index structure and data according to these languages; see list of Elasticsearch language analyzers.
* **Keep search index at the separate server** - this way it will not be affected by main relational DB load.
* **Use Elasticseach cluster if needed** - if your index is too big to keep it on one server and/or you want to balance search index load between several servers then you might use Elasticseach cluster.
* **Increase RAM** - the recommended amount of RAM for search index is a half of index size or more, i.e. if you have 50GB of index data, it is recommended to have 25GB+ of RAM.
* **Use SSD** - this type of disk provides faster read/write access than HDD and allows to request parts of search index data faster.

.. include:: /include/include-links.rst
   :start-after: begin
.. _bundle-docs-commerce-website-elasticsearch-bundle-es:

Website ElasticSearch Search Engine
===================================

Data Storage
------------

The Elasticsearch search engine uses multiple indexes (one per each website and entity) prefixed with parameter from *parameters.yml* file.
The Elasticsearch indexes structure is defined in the |index mapping|. The mapping contains list of indexes, types (one per index), fields, their declarations and additional index settings. The index contains custom settings, including analyzer and tokenizer, and mapping settings for all entities.

The WebsiteElasticSearchBundle reads mapping configuration, defining the search index configuration, from `website_search.yml` files.

Example configuration:

.. code-block:: yaml
   :linenos:

    Oro\Bundle\ProductBundle\Entity\Product:
        alias: oro_product_WEBSITE_ID
        fields:
            -
                name: sku
                type: text
            -
                name: names_LOCALIZATION_ID
                type: text
            -
                name: all_text_LOCALIZATION_ID
                type: text
                store: false
            -
                name: all_text
                type: text
                default_search_field: true
                store: false


If your deployment hosts two websites with IDs `1` and `2`, the following search index mappings are built automatically, based on the above configuration:

.. code-block:: javascript
   :linenos:

    {
      "oro_website_search_oro_product_1" : {
        "settings" : {
          "index" : {
            "mapping" : {
              "total_fields" : {
                "limit" : "10000000"
              }
            },
            "query" : {
              "default_field" : "all_text"
            },
            "max_result_window" : "10000000",
            "analysis" : {
              "filter" : {
                "substring" : {
                  "type" : "nGram",
                  "min_gram" : "1",
                  "max_gram" : "100"
                }
              },
              "analyzer" : {
                "fulltext_search_analyzer" : {
                  "filter" : [
                    "lowercase",
                    "unique"
                  ],
                  "tokenizer" : "whitespace"
                },
                "fulltext_index_analyzer" : {
                  "filter" : [
                    "lowercase",
                    "substring",
                    "unique"
                  ],
                  "char_filter" : [
                    "html_strip"
                  ],
                  "tokenizer" : "whitespace"
                }
              }
            }
          }
        },
        "mappings" : {
          "oro_product_1" : {
            "_all" : {
              "enabled" : false
            },
            "dynamic_templates" : [
              {
                "all_text_LOCALIZATION_ID" : {
                  "match" : "^all_text_[^_]+$",
                  "match_mapping_type" : "string",
                  "match_pattern" : "regex",
                  "mapping" : {
                    "fields" : {
                      "analyzed" : {
                        "type" : "text",
                        "search_analyzer" : "fulltext_search_analyzer",
                        "analyzer" : "fulltext_index_analyzer"
                      }
                    },
                    "store" : false,
                    "type" : "keyword"
                  }
                }
              },
              {
                "names_LOCALIZATION_ID" : {
                  "match" : "^names_[^_]+$",
                  "match_mapping_type" : "string",
                  "match_pattern" : "regex",
                  "mapping" : {
                    "fields" : {
                      "analyzed" : {
                        "type" : "text",
                        "search_analyzer" : "fulltext_search_analyzer",
                        "analyzer" : "fulltext_index_analyzer"
                      }
                    },
                    "store" : true,
                    "type" : "keyword"
                  }
                }
              }
            ],
            "properties" : {
              "all_text" : {
                "type" : "keyword",
                "fields" : {
                  "analyzed" : {
                    "type" : "text",
                    "analyzer" : "fulltext_index_analyzer",
                    "search_analyzer" : "fulltext_search_analyzer"
                  }
                }
              },
              "sku" : {
                "type" : "keyword",
                "store" : true,
                "fields" : {
                  "analyzed" : {
                    "type" : "text",
                    "analyzer" : "fulltext_index_analyzer",
                    "search_analyzer" : "fulltext_search_analyzer"
                  }
                }
              }
            }
          }
        }
      },
      "oro_website_search_oro_product_2" : {
        "settings" : {
            ...
        }
        "mappings" : {
          "oro_product_2" : {
            "_all" : {
              "enabled" : false
            },
            "dynamic_templates" : [
                ...
            ],
            "properties" : {
                ...
            }
          }
        }
      }
    }


Two product indexes (`oro_website_search_oro_product_1` and `oro_website_search_oro_product_2`) with one type in each (`oro_product_1` and `oro_product_2`) contain product information for the appropriate website (with WEBSITE_ID `1` and `2` respectively). Names of these product indexes and types are built automatically based on the `oro_product_WEBSITE_ID`
placeholder. Product information contains the following:

* The dynamic fields mapping with `names_LOCALIZATION_ID`, `descriptions_LOCALIZATION_ID` and `all_text_LOCALIZATION_ID` placeholders in these types are used to automatically set mapping for the fields that match provided patterns.

* The plain mapping is defined for `sku`, `all_text` and `tmp_alias` fields.  A `tmp_alias` is a special field used during the indexation.

* The default configuration for analyzer and tokenizer.

* By default, all fields are stored, but you may configure some to be not. Storing fields means that, apart from being queried, it is possible to read and return them from the server. Disabling storing of some fields (like the `all_text`) can save some storage space.

* The default field for querying is specified via the `default_field`.


Search
------

The Elasticsearch provides high quality search capabilities with relevant search results and speedy response.
Elasticsearch is a document-based storage that is fast and easy to scale, but does not support execution of the relation-based queries.

The WebsiteElasticSearchBundle reuses functionality from ElasticSearchBundle and thus uses the same approach to build request: it converts the `Oro\\Bundle\\SearchBundle\\Query\\Query` object to the request data using request builders. Each of the builders implements `Oro\\Bundle\\ElasticSearchBundle\\RequestBuilder\\RequestBuilderInterface` and converts some part of the object to an appropriate part of the Elasticsearch query.

Let's assume that you need to execute following query:

.. code-block:: none
   :linenos:

    SELECT
        text.sku,
        text.names_LOCALIZATION_ID,
        text.shortDescriptions_LOCALIZATION_ID
    FROM
        oro_product_WEBSITE_ID
    WHERE
        text.all_text_LOCALIZATION_ID ~ "light"
    LIMIT 25


Elasticsearch engine converts it to the request similar to the following one:

.. code-block:: none
   :linenos:

    curl -XGET '181.1.24.34:9200/oro_website_search_oro_product_1/oro_product_1/_search?_source=sku,names_2,shortDescriptions_2' -H 'Content-Type: application/json' -d '
    {
        "query":{
            "match":{
                "all_text_2.analyzed":"light"
            }
        },
        "from":0,
        "size":25
    }'


where the Elasticsearch engine is running on the `181.1.24.34` host via the `9200` port.

Aggregations
------------

Another example: we need to calculate count of products per SKU.
Lets update previous query to have calculated count of products.
For that we will execute previous query and should have next configuration for aggregations:

.. code-block:: none

   AGGREGATE text.sku COUNT AS skuCounts

Elasticsearch engine converts it to the request similar to the following one:

.. code-block:: none
   :linenos:

    curl -XGET '181.1.24.34:9200/oro_website_search_oro_product_1/oro_product_1/_search?_source=sku,names_2,shortDescriptions_2' -H 'Content-Type: application/json' -d '
    {
        "query":{
            "match":{
                "all_text_2.analyzed":"light"
            }
        },
        "from":0,
        "size":25,
        "aggregations":{
            "skuCounts":{
                "terms":{
                    "field":"sku",
                    "size":100000000
                }
            }
        }
    }'


As you see in request we have |size parameter| with big value. It is added manually, because Elasticsearch by default will return only `10` record.
With these value we will have all records even if there are more than `10` of them.

Indexation
----------

Indexation in the |Elasticsearch| is pretty simple. The data is collected using the standard :ref:`WebsiteSearchBundle <bundle-docs-commerce-website-search-bundle>` functionality and data is saved to the index according to the specified mappings.

The only interesting part in this engine is how unused entities are removed from index. To do that during the indexation, each entity has one more service field `tmp_alias` which is used to store name of the temporary alias of an entity assigned to it during the indexation. After indexation is finished engine simply removes all entities with alias not equal to an alias of the current indexation (which are outdated entities that must not be present in search index any longer).

.. include:: /include/include-links-dev.rst
   :start-after: begin
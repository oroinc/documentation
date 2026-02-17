.. _bundle-docs-platform-elastic-search-bundle:
.. _elastic-search:

OroElasticSearchBundle
======================

.. hint:: See the :ref:`Search Index <search_index_overview>` documentation to get a more high-level understanding of the search index concept in the Oro application.

.. note:: This bundle is only available in the Enterprise edition.

OroElasticSearchBundle enables |Elasticsearch| as a :ref:`search engine <search_index_overview>` for Oro applications and allows developers to configure Elasticsearch client settings and the search index using application parameters in YAML configuration files.

.. note:: This bundle supports Elasticsearch engine version >=9.2, <10.0. You can manually specify the minimum allowed version and upper bound version in the application configuration.

.. toctree::
   :maxdepth: 1
   :titlesonly:

   agent-and-engine
   backup
   configuration
   request-builders
   troubleshooting
   upgrade-to-es9

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _bundle-docs-commerce-website-search-bundle:

OroWebsiteSearchBundle
======================

OroWebsiteSearchBundle extends OroSearchBundle capabilities to provide search functionality for the OroCommerce storefront, and creates an additional search index for this purpose based on the scopes.

It also enables developers to configure this search index in the YAML configuration files in the individual bundles.

**Table of Contents**

* `What is website search and how it is different from regular search <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/what_is_website_search.md>`__

  * `General Information <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/what_is_website_search.md#general-information>`__
  * `WebsiteSearchBundle VS SearchBundle <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/what_is_website_search.md#websitesearchbundle-vs-searchbundle>`__

* `Website search configuration <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/configuration.md>`__

  * `Bundle Configuration <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/configuration.md#bundle-configuration>`__
  * `Mapping Configuration <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/configuration.md#mapping-configuration>`__
  * `Engine configuration <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/configuration.md#engine-configuration>`__

* `Search index structure <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/index_structure.md>`__

  * `Indexed data <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/index_structure.md#indexed-data>`__
  * `Plain data structure <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/index_structure.md#plain-data-structure>`__
  * `Website scope <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/index_structure.md#website-scope>`__
  * `Localized Data <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/index_structure.md#localized-data>`__
  * `Examples <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/index_structure.md#examples>`__

* `How to perform search <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/search.md>`__

  * `Search engine <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/search.md#search-engine>`__
  * `Search Query <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/search.md#search-query>`__
  * `Search Repository <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/search.md#search-repository>`__

* `Indexation Process <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/indexation.md>`__

  * `How to trigger reindexation <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/indexation.md#how-to-trigger-reindexation>`__
  * `Search indexer <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/indexation.md#search-indexer>`__
  * `Search indexer events <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/indexation.md#search-indexer-events>`__
  * `Asynchronous search indexer <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/indexation.md#asynchronous-search-indexer>`__

* `Reindexation during platform update <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/platform_update.md>`__
* `ORM search engine <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/orm_engine.md>`__

  * `ORM data storage <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/orm_engine.md#orm-data-storage>`__
  * `ORM search <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/orm_engine.md#orm-search>`__
  * `ORM indexation <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/orm_engine.md#orm-indexation>`__

* `Search Relevance Weight <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/relevance_weight.md>`__

  * `What Search Relevance Weight Is <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/relevance_weight.md#what-search-relevance-weight-is>`__
  * `Relevance Weight Customization <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/relevance_weight.md#relevance-weight-customization>`__

* `WebsiteSearchExtensionTrait <https://github.com/oroinc/orocommerce/blob/master/src/Oro/Bundle/WebsiteSearchBundle/Resources/doc/testing.md>`__

.. _bundle-docs-commerce-website-elastic-search-bundle-attributes-boost:

Attributes Boost
================

.. note:: This feature is only available in the Enterprise edition and if Elasticsearch is used as the search engine.

Attribute boosting enables you to influence the relevancy ranking of the search results by the value of the attributes.

For example, if one product has a word 'ball' in its name and another word has the same word in the description,
the first product will have a higher relevancy ranking if a user searches by the 'ball' query.

By default, the product name and product SKU attributes are boosted.

The boost value for the attribute can be changed on an attribute's edit page for a custom attribute
or on the field configuration page of the Product entity for the system attributes.

The value of the boost parameter is decimal value greater than zero. Empty value means no boosting.

.. _elasticsearch-fuzzy-search:

Fuzzy Search
============

This feature adds the possibility to use error-tolerant (fuzzy) search in search index requests to Elasticsearch.
It works only with Elasticsearch search engine.

It is assumed that the first character of every word in a request is correct. So, the application does not try to change
the first character to fix an error.

Exact match has higher relevancy comparing to results with errors. It means that results that exactly match the request
are at the top of the result set. Results with errors are at the bottom of the result set.

Error-tolerant search is applied only to *contains* and *not contains* operators.

.. _elasticsearch-fuzzy-search-configuration:

Configuration
-------------

Fuzzy search is available in the Management Console and in the Storefront. Both areas have identical configuration.
Management console fuzzy search can be configured under
*System Configuration > General Setup > Search > Fuzzy Search in Management Console* only on the global level.
Storefront fuzzy search can be configured under
*Commerce > Search > Fuzzy Search > Fuzzy Search in Storefront* globally and per website.

There are four configuration options that can be set there.

**Enable Fuzzy Search** enables fuzzy search in the appropriate area. This options has to be checked to display the
following options.

**Error Tolerance** sets how many errors in each word application may ignore. The default value is *One*,
which means that one error per word can be tolerated.

**Tolerance Starts From** sets a threshold for error-tolerant search usage. The default value is *4*
which means that application will use exact match search for words that have 1-3 characters,
and error-tolerant search for words that have 4+ characters.

**Tolerance Exclusions** allows setting regular expression for words that must not use error-tolerant search, exact match
search is used instead. This option is beneficial for SKUs, manufacturer IDs, and other identifiers that may have
similar values and lead to false-positive results when the error-tolerant search is used.

.. _elasticsearch-fuzzy-search-important-notes:

Important Notes
---------------

Error-tolerant search is not an automatic correction. It just tries to find similar results for the passed request
phrase word by word. It is important to remember that the error-tolerant search may lead to
lots of false-positive results.

Error-tolerant search changes only the way the request is built, but not the index mapping, structure, or content.
Search is performed against the tokens that are stored in Elasticsearch index. So, it behaves differently
for default configuration, language-optimized configuration, and custom index configuration.

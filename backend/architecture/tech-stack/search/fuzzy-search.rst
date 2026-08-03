.. _elasticsearch-fuzzy-search:

Fuzzy Search
============

.. important:: The feature is available for the Enterprise edition only.

This feature enables error-tolerant (fuzzy) search in search index requests. It works only with the Elasticsearch search engine.

The application assumes that the first character of every word in a request is correct, so it does not try to change the first character to fix an error.

Exact matches have higher relevancy than results with errors. Results that match the request word by word appear at the top of the result set, while those with errors appear at the bottom.

The error-tolerant search is applied only to the *contains* and *not contains* operators.

.. _elasticsearch-fuzzy-search-configuration:

Configuration
-------------

The fuzzy search options can be configured both for the back-office and storefront. The options are identical.

The back-office settings are configured under **System Configuration > General Setup > Search > Fuzzy Search** on the :ref:`global level <configuration--system-configuration--general-setup-sysconfig--search-global>` only.

The storefront settings are configured under **System Configuration > Commerce > Search > Fuzzy Search > Fuzzy Search in Storefront** on the :ref:`global <configuration--guide--commerce--configuration--fuzzy-search>` and :ref:`website <configuration--website-commerce--search--fuzzy-search>` levels.

The fuzzy search options are the following:

* **Enable Fuzzy Search** enables fuzzy search in the appropriate area.

* **Error Tolerance** sets the number of errors in each word the application can ignore. The default value is *One*, meaning that one error per word can be tolerated.

* **Tolerance Starts From** sets a threshold for the error-tolerant search usage. The default value is *4*, meaning that the application uses the exact match search for small words with 1-3 characters and the error-tolerant search for words with 4+ characters.

* **Tolerance Exclusions** enables setting a regular expression for words that must not use the error-tolerant search; exact match search is used instead. This option is beneficial for SKUs, manufacturer IDs, and other identifiers that may have similar values and lead to false-positive results when the error-tolerant search is used.

.. _elasticsearch-fuzzy-search-important-notes:

Important Notes
---------------

The error-tolerant search is not an automatic correction. It tries to find similar results for the passed request phrase word by word.

.. note:: The error-tolerant search can lead to several false-positive results.

The error-tolerant search changes only how the request is built, not the index mapping, structure, or content. It runs against the tokens stored in the Elasticsearch index, so it behaves differently for the default, language-optimized, and custom index configurations.
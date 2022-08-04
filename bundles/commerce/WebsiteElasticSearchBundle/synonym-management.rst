.. _bundle-docs-commerce-website-elasticsearch-bundle-synonyms:

Synonym Management
==================

.. hint:: The feature is available since OroCommerce Enterprise v5.0.6. To check which application version you are running, see the :ref:`system information <system-information>`.

This feature allows setting search synonyms to be applied during the full-text search in the storefront.
Full-text search is used in many places, for example, during the global search.

This feature works only together with the Elasticsearch search engine.

Configuration
-------------

Synonyms are enabled via the configuration menu under **System Configuration > Commerce > Search > Synonyms** by selecting the **Enable Synonyms** checkbox. This configuration option also adds a submenu Synonyms under the Marketing main and refreshes synonym configuration in indices.

How It Works
------------

You can add synonyms via Marketing > Synonyms manually or via the import. In both cases, you need to set the following fields for each Synonym entity:

* **Owner** --- a standard Oro owner on the Business Unit level;

* **Websites**  --- the websites where you want to use the synonym;

* **Entities** --- the entities you want to use the synonym. This field is hidden out-of-the-box because there is only one available entity (Product);

* **Synonyms**  ---  the actual synonym words.

The **Synonyms** field uses the Solr format and supports several notations:

* **Comma-separated values** to define equivalent synonyms, e.g., *good, excellent, amazing*. In this case, all the words are considered equal to each other.

* **Arrow notation** to define unidirectional synonyms, e.g., *excellent => good*. In this case, users can find a document with the word **good** by searching *excellent* (but not vice versa).

See |official Elasticsearch documentation on search synonyms| for more examples.

.. include:: /include/include-links-dev.rst
   :start-after: begin



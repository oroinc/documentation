.. _configuration--guide--commerce--configuration--fuzzy-search:

Configure Global Storefront Fuzzy Search Settings
=================================================

.. important:: The feature is available for the Enterprise edition only.

.. hint:: Read :ref:`Search Functions Concept Guide <user-guide-getting-started-search>` to get a general understanding of the search functionality in OroCommerce.

You can set up storefront error-tolerant (fuzzy) search in website search index requests to Elasticsearch. When enabled, it finds similar results for the passed request phrase word by word. Please be aware that this feature is not supported by the ORM search engine. For configuration options to set up fuzzy search in the back-office, see the :ref:`General Setup Configuration topic <configuration--system-configuration--general-setup-sysconfig--search-global>`.

.. note:: You can also configure storefront fuzzy search :ref:`on the website configuration level <configuration--website-commerce--search--fuzzy-search>`.

To configure storefront fuzzy search settings:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Search > Fuzzy Search** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_commerce/search/fuzzy-search-global.png
   :alt: Global fuzzy search configuration options for the storefront

3. Configure the following options:

   * **Enable Fuzzy Search** --- enables fuzzy search in the appropriate area. This option is disabled by default.

   * **Error Tolerance** --- sets how many errors in each word the application ignores. Possible values are:

     * One Error (default) -- one error per word is tolerated
     * Two errors -- two errors per word are tolerated
     * Request based -- tolerance depends on the length of the word. One error for short words (up to 5 characters) and two errors for long words (6+ characters).

   * **Tolerance Starts From** --- sets a threshold for error-tolerant search usage. The default value is *4*, which means that the application uses the exact match search for words with 1-3 characters and an error-tolerant search for words with 4+ characters.
   * **Tolerance Exclusions** --- allows setting regular expression for words that must not use error-tolerant search; the exact match search is used instead. This option is beneficial for SKUs, manufacturer IDs, and other identifiers that may have similar values and lead to false-positive results when the error-tolerant search is used.
   * **Prefix Length** --- defines how many initial characters of the search term must be exactly matched before the fuzzy matching is allowed to take place on the remainder of the term. This is critical for ensuring that the matches are relevant while still accounting for possible errors in the remaining characters of the term.

.. image:: /user/img/concept-guides/search/fuzzy-search-storefront.png
   :alt: Fuzzy search with 2 errors illustration

4. Click **Save settings**.
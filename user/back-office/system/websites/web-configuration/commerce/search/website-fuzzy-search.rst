:oro_documentation_types: OroCommerce

.. _configuration--website-commerce--search--fuzzy-search:

Configure Storefront Fuzzy Search Settings per Website
======================================================

.. important:: The feature is available for the Enterprise edition only.

.. hint:: Fuzzy search is available since v5.0.1. To check which application version you are running, see the :ref:`system information <system-information>`.

You can set up storefront error-tolerant (fuzzy) search in website search index requests to Elasticsearch. When enabled, it finds similar results for the passed request phrase word by word. Please be aware that this feature is not supported by the ORM search engine. For configuration options to set up fuzzy search in the back-office, see the :ref:`General Setup Configuration topic <configuration--system-configuration--general-setup-sysconfig--search-global>`.

.. note::
    Storefront fuzzy search configuration options are also available on the :ref:`global <configuration--guide--commerce--configuration--fuzzy-search>` level.

To configure storefront fuzzy search settings:

1. Navigate to  **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Search** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/websites/web_configuration/website-fuzzy-search.png
   :alt: Storefront fuzzy search configuration options on the website level

4. You can enable or disable the following options (clear the **Use Organization** check box to customize the settings):

   * **Enable Fuzzy Search** --- enables fuzzy search in the appropriate area. This option is disabled by default.
   * **Error Tolerance** --- sets how many errors in each word the application ignores. Possible values are:

     * One Error (default) -- one error per word is tolerated
     * Two errors -- two errors per word are tolerated
     * Request based -- tolerance depends on the length of the word. One error for short words (up to 5 characters) and two errors for long words (6+ characters).

   * **Tolerance Starts From** --- sets a threshold for error-tolerant search usage. The default value is *4*, which means that the application uses the exact match search for words with 1-3 characters and an error-tolerant search for words with 4+ characters.
   * **Tolerance Exclusions** --- allows setting regular expression for words that must not use error-tolerant search; the exact match search is used instead. This option is beneficial for SKUs, manufacturer IDs, and other identifiers that may have similar values and lead to false-positive results when the error-tolerant search is used.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
.. _user-guide-getting-started-search:

Search Functions
================

A search function on your website provides a seamless experience for your visitors. Giving customers the ability to find the information they are looking for quickly is a key ingredient for creating a user-friendly website.

Your website may have a vast database with numerous pages and information, making it harder for users to locate the required information. With this in mind, Oro has developed a helpful search utility to help customers query that database and find the material quickly.

You can find the search bar:

* in the header and menu of the storefront

.. image:: /user/img/concept-guides/search/search-bar-storefront.png
   :alt: Search bar in the storefront

* in the header of the back-office and in its system configuration menu

.. image:: /user/img/concept-guides/search/search-bar-back-office.png
   :alt: Search bar in the back-office

To find a record through the search bar, start typing the search key into the text field and select the most relevant suggestion from the dropdown list.
		
Several out-of-the-box functions enhance the effectiveness and speed of the search functionality. 

**Storefront-specific**

* :ref:`Global Search Boost <products--product-attributes--create-frontend-options>` - The feature works with the searchable product attributes only. It is available in the OroCommerce Enterprise edition. It influences the relevancy ranking of your search results in the storefront and helps pull the necessary attribute to the top of the search result list. By default, the boost for SKU is set to 5, for names to 3, meaning that the searchable word is first searched among SKUs, then names, etc. The bigger the number, the higher the relevancy. With Search Boost, you can configure any search behavior required for your business, which allows you to have better control over search results.

.. image:: /user/img/concept-guides/search/global-search-boost.png
   :alt: Global search boost in action

* :ref:`Search Autocomplete <configuration--guide--commerce--configuration--product-search>` - The intuitive feature generates predictions based on searches that you start to type. It shows up-to-date product information, such as SKU, name, price, and inventory status. You can set the number of products to be displayed in the storefront search result dropdown on the global, :ref:`organization <sys--users--organization--commerce--products--search>`, and :ref:`website <sys--websites--commerce--products--search>` levels.

.. image:: /user/img/concept-guides/search/storefront-autocomplete.png
   :alt: Search autocomplete illustration

* :ref:`Saved Search <my-account-saved-search>` - The feature is available in the OroCommerce Enterprise edition. It enables customer users to save their search queries, view these saved search queries under the Saved Searches menu in the customer user account. You can also configure the registered customers to receive notifications when a new product falls under the search conditions and when products from the search query result are back in stock. The configuration is available on the :ref:`global <configuration--guide--commerce--configuration--saved-search>`, :ref:`organization <organization-commerce--configuration--saved-search>`, and :ref:`website <configuration--website-commerce--search--saved-search>` levels.

.. image:: /user/img/concept-guides/search/saved-search.png
   :alt: Saved search illustration

* :ref:`Fuzzy Search in the Storefront <configuration--guide--commerce--configuration--fuzzy-search>` - The feature is available in the OroCommerce Enterprise edition. Fuzzy searches help you find relevant results even when the search terms are misspelled. When enabled, it searches for the text that matches the term closely instead of exactly. You can set the number of errors in each word the application can ignore or set a threshold for the error-tolerant search usage. The configuration is available on the global and :ref:`website <configuration--website-commerce--search--fuzzy-search>` levels.

.. image:: /user/img/concept-guides/search/fuzzy-search-storefront.png
   :alt: Fuzzy search with 2 errors illustration

* :ref:`Search History <configuration--guide--commerce--configuration--search-history>` - If the feature is enabled, you can view a history of all searches performed by a customer user in the storefront under **Marketing > Search > Search History**. The grid includes information on all keywords entered by a user, the search result type (product autocomplete, product search, or empty), the number of products found (if applicable), the date and time of the search, the website where the search was performed, the localization used when the search was performed, and the name of the customer and customer user who performed the search (if applicable).

  The option also enables a :ref:`Search Terms report <user-guide-search-terms-report>` that shows how frequently a specific search phrase was used, and whether the search query returned an empty result.

  The feature can be configured on all levels: globally, :ref:`per organization <organization-commerce--configuration--search-history>`, :ref:`website <configuration--website-commerce--search--history>`, :ref:`customer group <user-guide--customer-groups--configuration--settings--search>`, and :ref:`customer <user-guide--customers--search--settings>`.


.. image:: /user/img/marketing/search/search-items-grid.png
   :alt: Search history grid in the back-office



**Back-office-specific**


* **Search by an entity in the back-office** - When searching for a term in the back-office, the feature enables you to select the entity that most likely contains the searching record. The search result will then display the records that belong to this entity first.

.. image:: /user/img/concept-guides/search/search-by-entity.png
   :alt: Difference between the regular search and search by entity

.. _user-guide-getting-started-search-tag:

* **Search by tag in the back-office** - The feature enables you to view all the records with a specific tag anywhere in the system. Select the *Tag* entity when searching for a term and click the tag when found. You will be presented with a page that looks similar to the search results and contains all the records with this tag.

.. image:: /user/img/concept-guides/search/search-by-tag.png
   :alt: Difference between the regular search and search by entity

* :ref:`Quick Search <user-guide--system-configuration--quick-search>` - The intelligent search feature is located in the configuration panel on the left (on all configuration levels). It helps you locate the specific configuration option instantly by keywords. It narrows down the query when you start typing the key letters and displays real-time search results.

.. image:: /user/img/concept-guides/search/quick-search.png
   :alt: Difference between the regular search and search by entity

* :ref:`Fuzzy Search in the Back-Office <configuration--system-configuration--general-setup-sysconfig--search-global>` - The feature is available in the OroCommerce Enterprise edition. It works similarly to the storefront fuzzy search functionality but searches for the misspelled terms in the back-office. The configuration is only available globally.
.. _bundle-docs-commerce-website-search-suggestions-bundle:

WebsiteSearchSuggestionBundle
=============================

.. hint:: |WebsiteSearchSuggestionBundle| is available starting from OroCommerce v5.1.7. To check which application version you are running, see the :ref:`system information <system-information>`.

|WebsiteSearchSuggestionBundle| implements an autocomplete search feature that displays suggestions related to the search string during a product search.

Entities
--------

This bundle contains the following new entities:

- **WebsiteSearchSuggestionBundle:Suggestion** -- represents a suggestion phrase for the product autocomplete functionality. When creating or updating a product, autocomplete can suggest products based on their sku or name fields.
- **WebsiteSearchSuggestionBundle:ProductSuggestion** -- represents a relation between a product and a suggestion phrase. Many products can reference the same suggestion.

**Repositories**

- **SuggestionRepository** - this repository is responsible for inserting suggestions into the database while avoiding duplicates
- **ProductSuggestionRepository** - this repository handles the insertion of relations between a suggestion and a product into the database. 

Configuration
-------------
The bundle adds a new feature oro_website_search_suggestion that allows to enable or disable displaying suggestions in the storefront for users.
The bundle also adds a new configuration option **Number Of Automatically Suggested Phrases In Search Autocomplete** under **System Configuration > Commerce > Product  > Product Search > Automatic Phrase Suggestions** in the back-office. This setting controls the maximum number of product search autocomplete suggestions displayed in the storefront. If set to zero, the suggestions will not appear.

Implementation Details
----------------------

Migration ORM
^^^^^^^^^^^^^

**PrepareProductSuggestionData** triggers the generation of suggestions after the upgrade on an already installed application.

Website Search Index
^^^^^^^^^^^^^^^^^^^^

This index is based on the entity **Suggestion**, and used for search suggestion autocomplete query.

**oro_suggestion_WEBSITE_ID**

- `phrase` - contains suggestion phrase. Type - `text`.
- `words_count` - contains the count of words in a suggestion. Required for sorting suggestions in the search response. Type - `integer`.
- `localization_id` - contains the id of localization. Required for searching suggestions by localization. Type - `integer`.

Website Search
^^^^^^^^^^^^^^

During a product search autocomplete, one additional suggestion search query is executed and tries to find related suggestions to the search string.

**Listeners**

- **ProductSuggestionIndexerListener** - adds suggestions data to the website search index by localization.
- **AddSuggestToProductAutocompleteListener** - listens to the ProcessAutocompleteDataEvent event and is responsible for suggestion autocomplete search query.
- **ProductSuggestionRestrictIndexListener** - adds limits to the search index for product suggestions by an organization and localizations in which they are located.
- **SuggestionIndexationListener** - reacts to suggestion deletion and generation to provide suggestion ids for search engine indexation

**RequestBuilder**

- **ProductsSuggestsRequestBuilder** - adds two boosts for prefix query and words_count phrases for suggestion autocomplete requests.
  * prefix query means that phrase that starts from the search string should be higher.
  * words_count means that phrases with fewer words should be higher.

**Repository**

- **ProductSuggestionRepository** - contains the autocomplete suggestions search query.

Suggestions Generation
^^^^^^^^^^^^^^^^^^^^^^

**Listeners**

- **CreateProductSuggestionListener** - responsible for collecting product ids on onFlush event for `Product`
  and `ProductName` entities and sending them to the message queue.
- **WebsiteSearchSuggestionFeatureToggleListener** - is responsible for sending messages to MQ to generate suggestions the moment the feature is enabled in the configuration.

**Commands**

Command **oro:website-search-suggestions:generate** initiates the suggestion generation in the message queue.

**Async Processors**

- **GenerateSuggestionsProcessor** - is responsible for collecting product IDs from organizations, which are then sent to **GenerateSuggestionPhrasesProcessor**
- **GenerateSuggestionsProcessor** - is responsible for generating phrases for the provided products  which are then sent to processor **PersistSuggestionPhrasesProcessor**
- **PersistSuggestionPhrasesProcessor** - is responsible for persisting phrases to the database, and then sending suggestion IDs with products to **PersistSuggestionProductRelationProcessor**
- **PersistSuggestionProductRelationProcessor** - is responsible for persisting the relation between a product and  a suggestion to the database

**Persisters**

- **SuggestionPersister** - is responsible for persisting suggestions to the database
- **ProductSuggestionPersister** - is responsible for persisting the relation between a suggestion and a product to the database

**Providers**

- **ProductsProvider** - provides a method for getting available product ids, SKUs, names.
- **SuggestionProvider** - provides a method for getting suggestion phrases for each localization from sku and product names for the provided product ids.
- **PhraseSplitter** - is responsible for splitting SKU and names of a product into suggestion phrases. It cleans phrases from garbage symbols. The suggestion cannot have more than 4 words in a phrase.

  For example, below are results for the phrase "Client, Credit Card":

  1. client
  2. credit
  3. card
  4. client credit
  5. client credit card
  6. credit card

**Events**

- **SuggestionPersistEvent** - gives the ability to modify persisted suggestions
- **ProductSuggestionPersistEvent** - gives the ability to modify persisted product suggestions

Suggestions Removal
^^^^^^^^^^^^^^^^^^^

**Commands**

Command **oro:cron:website-search-suggestions:clean-up** finds and initiates the removal of outdated suggestions in the message queue. Executed via cron once per day at midnight.

.. note:: An outdated suggestion is one that does not have any related product.

**Async Processors**

- **DeleteOrphanSuggestionsProcessor** - is responsible for finding suggestion ids without products and sending these ids to processor **DeleteOrphanSuggestionsChunkProcessor**
- **DeleteOrphanSuggestionsChunkProcessor** - is responsible for removing suggestions by the provided ids

**Events**

- **SuggestionDeleteEvent** - gives the ability to react to deleted suggestions


.. include:: /include/include-links-dev.rst
   :start-after: begin

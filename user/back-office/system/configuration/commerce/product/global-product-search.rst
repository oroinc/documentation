.. _configuration--guide--commerce--configuration--product-search:

Configure Global Settings for Product Search
============================================

.. note:: The Product Search feature can be configured on the global, :ref:`organization <sys--users--organization--commerce--products--search>`, and :ref:`website <sys--websites--commerce--products--search>` levels.

To configure the product search settings globally:

1. In the main menu, navigate to **System > Configuration**.
2. Select **Commerce > Product > Product Search** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/product/product-search-config.png
      :alt: Product search configuration options on global level

3. Customize any of the options by proceeding through the following steps:

   a) Clear the **Use Default** checkbox next to the option.
   b) Enable the required checkbox or enter the necessary file size and type information.

4. In the **Product Fulltext Search** section, configure the following options:

   * **Number of Products in Search Autocomplete** --- Maximum number of products shown in the storefront autocomplete dropdown.

   * **Number of Categories in Search Autocomplete** --- Maximum number of categories shown in the storefront autocomplete dropdown.

     .. image:: /user/img/concept-guides/search/storefront-autocomplete.png
        :alt: Illustration of 4 products and 2 categories in the autocomplete search field

   * **Allow Partial Product Search** --- When enabled, the customer can find a product in the global search and on quick order form using a substring inside a word. This means that even if users do not have the exact product name or spelling memorized, they can still find what they need. Enabling this option may have a performance impact on search behaviour. This is due to the system's need to process and match substrings within product names or descriptions, potentially requiring additional computational resources.

     .. image:: /user/img/concept-guides/search/partial-product-search.png
        :alt: Partial Product Search illustration

5. In the **Automatic Phrase Suggestions** section, configure the following options:

   * **Enable Automatic Phrase Suggestions in Search Autocomplete** --- Select the checkbox to enable displaying suggestions in the storefront.
   * **Number Of Automatically Suggested Phrases In Search Autocomplete** --- The maximum number of suggestions displayed in the storefront autocomplete dropdown.

   .. image:: /user/img/concept-guides/search/phrase-suggestions.png
      :alt: Automatic Phrase Suggestions illustration

6. Click **Save Settings**.

**Related Topics**

* :ref:`Search Functions Concept Guide <user-guide-getting-started-search>`.

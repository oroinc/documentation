.. _sys--websites--commerce--products--search:

Configure Product Search Settings per Website
=============================================

.. note:: The Product Search feature can be configured on the :ref:`global <configuration--guide--commerce--configuration--product-search>`, :ref:`organization <sys--users--organization--commerce--products--search>`, and website levels.

To configure the product search settings per website:

1. Navigate to  **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Product > Product Search** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/websites/web_configuration/config-product-search.png
      :alt: Product search configuration options on website level

4. Customize any of the options by proceeding through the following steps:

   a) Clear the **Use Organization** checkbox next to the option.
   b) Enable the required checkbox or enter the necessary file size and type information.

5. In the **Product Fulltext Search** section, configure the following options:

   * **Number of Products in Search Autocomplete** --- Maximum number of products shown in the storefront autocomplete dropdown.
   * **Number of Categories in Search Autocomplete** --- Maximum number of categories shown in the storefront autocomplete dropdown.
   * **Allow Partial Product Search** --- When enabled, the customer can find a product in the global search and on quick order form using a substring inside a word. Enabling this option may have a performance impact on search behaviour.

6. In the **Automatic Phrase Suggestions** section (available starting from OroCommerce v6.0.1), configure the following options:

   * **Number Of Automatically Suggested Phrases In Search Autocomplete** --- The maximum number of suggestions displayed in the storefront autocomplete dropdown.

7. Click **Save Settings**.


**Related Topics**

* :ref:`Search Functions Concept Guide <user-guide-getting-started-search>`.


.. include:: /include/include-images.rst
   :start-after: begin

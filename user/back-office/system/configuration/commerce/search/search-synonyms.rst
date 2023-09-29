.. _configuration--guide--commerce--search--synonyms:

Configure Global Synonym Search Settings
========================================

In OroCommerce Enterprise Edition, you can :ref:`create a synonym group <user-guide-search-synonyms>` where a search for one word from this group in the OroCommerce storefront would return results for all the synonyms in this group. Synonym management is enabled globally and :ref:`per website <configuration--website-commerce--search--synonyms>` in the system configuration, and subsequently managed through **Marketing > Search > Search Synonyms** in the main menu.

To enable synonyms globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Search > Search Synonyms** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. Сlear the **Use Default** checkbox.
4. Select the **Enable Search Synonyms** checkbox to add the ability to search for synonyms during the full-text search in the storefront.
5. Click **Save Settings**.

.. image:: /user/img/system/config_commerce/search/search-synonyms-config.png
   :alt: Search synonyms global configuration option

Once search synonyms configuration option has been enabled, the feature is added to the main menu under **Marketing > Search > Search Synonyms**.

.. image:: /user/img/system/config_commerce/search/search-synonyms-config-enables-menu.png
   :alt: Illustration of how enabling the search synonym configuration option triggers the creation of the Search Synonyms menu under Marketing.

**Related Content**

* :ref:`Create Storefront Search Synonyms <user-guide-search-synonyms>`
* :ref:`Synonym Management (Dev Guide) <bundle-docs-commerce-website-elasticsearch-bundle-synonyms>`
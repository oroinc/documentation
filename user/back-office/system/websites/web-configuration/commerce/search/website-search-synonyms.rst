:oro_documentation_types: OroCommerce

.. _configuration--website-commerce--search--synonyms:

Configure Synonym Search Settings per Website
=============================================

In OroCommerce Enterprise Edition, you can :ref:`create a synonym group <user-guide-search-synonyms>` where a search for one word from this group in the OroCommerce storefront would return results for all the synonyms in this group. Synonym management is enabled :ref:`globally <configuration--guide--commerce--search--synonyms>` and per website in the system configuration, and subsequently managed through **Marketing > Search > Search Synonyms** in the main menu.

.. image:: /user/img/system/websites/web_configuration/synonyms-website-config.png
   :alt: Configuration option on the website level to enable the use of synonyms in the storefront search

To enable synonyms per website:

1. Navigate to  **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Search > Search Synonyms** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Clear the **Use Organization** checkbox.
5. Select the **Enable Search Synonyms** checkbox to add the ability to search for synonyms during the full-text search in the storefront.
6. Click **Save Settings**.

.. Enabling synonyms in the application triggers the creation of the *Search Synonyms** menu under **Marketing > Search**.

**Related Content**

* :ref:`Create Storefront Search Synonyms <user-guide-search-synonyms>`
* :ref:`Synonym Management (Dev Guide) <bundle-docs-commerce-website-elasticsearch-bundle-synonyms>`

.. include:: /include/include-images.rst
   :start-after: begin
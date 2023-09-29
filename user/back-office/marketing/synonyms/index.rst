.. _user-guide-search-synonyms:

Create Storefront Search Synonyms
=================================

In OroCommerce Enterprise Edition, you can create a synonym group where a search for one word from this group in the OroCommerce storefront would return results for all the synonyms in this group. Synonym management is enabled :ref:`globally <configuration--guide--commerce--search--synonyms>` and :ref:`per website <configuration--website-commerce--search--synonyms>` in the system configuration, and subsequently managed through **Marketing > Search > Search Synonyms** in the main menu.

To create a new synonym group:

1. Navigate to **Marketing > Search > Search Synonyms** in the main menu.
2. Click **Create Search Synonym**.
3. Fill in the following details:

   * Owner --- the owner of the synonym being created. This field is only displayed in the global organization.
   * Websites --- a list of websites where the synonym is to be used. Hold ctrl to select more than one website.
   * Synonyms --- a list of comma-separated synonyms, for example, good, excellent. Arrow notation can be used to define unidirectional synonyms: excellent => good.

4. Click **Save**.

.. image:: /user/img/marketing/search/synonym-search-back-office-storefront-example.png
   :scale: 50%
   :alt: Illustration of how search synonyms configured in the back-office work in the storefront

**Related Content**:

* :ref:`Enable Search Synonyms Globally <configuration--guide--commerce--search--synonyms>`
* :ref:`Enable Search Synonyms per Website <configuration--website-commerce--search--synonyms>`
* :ref:`Synonym Management (Dev Guide) <bundle-docs-commerce-website-elasticsearch-bundle-synonyms>`
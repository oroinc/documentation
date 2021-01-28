SEO Meta Fields
===============

The OroSEOBundle adds functionality both on the management console and in the storefront. This is done through the extension of existing entities from the platform by adding a new SEO section on the view/edit pages from admin side and adding meta tags in the html code of the configured pages.

The following entities and their corresponding storefront pages have been extended with this the SEO functionality:

- Product (OroProductBundle) with admin view and edit
- Category (OroCatalogBundle) with admin edit
- LandingPage (OroCMSBundle) with admin view and edit
- ContentNode (OroWebCatalogBundle) with admin view and edit

In the management console, for extended entity (e.g., Product, Category, LandingPage, or ContentNode) view and edit pages, the new SEO section with the SEO fields title, description and keywords was added. These SEO options apply to the currently viewed entity and may be modified for all locales.

On the storefront, the SEO fields with their values in the HTML of website pages for the search engines to pick them up.

The Product, Category, LandingPage and ContentNode entities are extended form extensions with three new fields that are stored as collections of LocalizedFallbackValue.
Therefore these new fields added through extend extension are many-to-many relations between the specified entities and LocalizedFallbackValue entity.

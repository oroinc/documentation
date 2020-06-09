:oro_documentation_types: OroCommerce

.. _concept-guide-web-catalog:

Web Catalog Management Concept Guide
====================================

Web catalogs are a powerful content management tool that enables sellers to create unlimited customizable and personalized versions of their OroCommerce storefronts to provide an engaging and personalized experience for B2B customers.

Visually, a web catalog represents the main navigation bar of the storefront website. It enables buyers to browse the product catalog, click on products to view details, and add them to shopping lists before ultimately buying them. Under the hood, OroCommerce sellers can not only build new catalogs from scratch but also modify default catalogs, customizing and enriching them with new menu items for various localizations, customers, or customer groups.

Sellers can add new pages to existing catalogs or create all new catalogs. They may want to change out catalogs seasonally or create a catalog for a VIP promotion or sale and redirect particular customers to the promotional page. With restrictions, it is easy to ensure that only specific customers can access these personalized pages.

Web Catalog Elements
--------------------

In the back-office, a web catalog consists of the **content tree** (the catalog structure), populated with **content nodes** (catalog categories). Building a catalog tree structures the product collection and defines the storefront menu look and feel.

A good first step when it comes to building a web catalog is creating the root content node, followed by adding the **first level menu items** that represent menu headers, for example:

* Outdoor & Garden
* Building & Hardware
* Lighting & Electrical

.. image:: /user/img/concept-guides/web-catalog/bo-sf-nodes.png
   :alt: First level menu items in back-office vs storefront

and then populating them with child (content) nodes:

* Outdoor & Garden: *Garden Furniture, Garden Tools, Fencing*
* Building & Hardware: *Building Supplies, Doors & Windows, Timber & Sheet Materials*
* Lighting & Electrical: *Lightning, Home Electrical, Smart Home*

.. image:: /user/img/concept-guides/web-catalog/bo-sf-child-nodes.png
   :scale: 60%
   :align: center
   :alt: Child menu items in back-office vs storefront

Each of these nodes can have more child categories:

* Fencing: *Fence panels, Garden Gates, Gravel Boards*
* Timber & Sheet Materials: *Timber Cladding, Skirting Boards, Decorative Mouldings*
* Smart Home: *Voice Assistants, Cameras, Heating, Doorbells*

.. image:: /user/img/concept-guides/web-catalog/bo-sf-further-child-nodes.png
   :scale: 60%
   :align: center
   :alt: Deeper child menu items in back-office vs storefront

.. hint:: In addition to the catalog items, the main storefront menu can also contain static custom menu items, such as Contact Us or About. These custom menu items are not part of either master catalog or web catalog and can be moved to a different section of your storefront. Please see the :ref:`documentation on frontend menu items <backend-frontend-menus>` to learn more.

        .. image:: /user/img/concept-guides/web-catalog/catalog-vs-custom-menu.png
           :alt: Catalog-based VS custom menu in the storefront

Every child node must be populated with :ref:`content variants <user-guide--marketing--web-catalog--content-variant>`. **Content variants** are the types of pages that you add to the content node. These pages can be of the following types:

* :ref:`System page <user-guide--marketing--web-catalog--content-variant-system-page>` --  one of many standard pre-designed pages for the OroCommerce storefront(Sign In page, Open Orders page, Request a Quote page, etc.)
* :ref:`Product page <user-guide--marketing--web-catalog--content-variant-product-page>` -- a direct link to product details
* :ref:`All Products page <user-guide--marketing--web-catalog>` -- a collection of all products usually added for smaller catalogs with no more than a few hundred products
* :ref:`Category page <user-guide--marketing--web-catalog--content-variant-category>` -- a direct link to products from a master catalog category
* :ref:`Product Collection page <user-guide--marketing--web-catalog--content-variant-product-collection>` -- a dynamic collection of products that you filtered/selected manually or in bulk to be displayed for this page
* :ref:`Landing page <user-guide--marketing--web-catalog--content-variant-landing page>` -- a direct link to a custom content page
* **Resource Library** -- if you download a |Resource Library Extension|, you can add media content, such as news, banners, product review videos, safety specifications, etc.

.. hint:: It is possible to add a custom content page and link it as a content variant, but this requires some customization effort.

.. image:: /user/img/concept-guides/web-catalog/content-variants.png
   :alt: Content variants in the back-office

You can configure more than one content variant per node, in case you want to display different variations of a page to different customers. By default, the web catalog with all its nodes has no **visibility restrictions** and may be displayed for any localization, on any website, and for any customer. However, depending on your business processes, you can adjust web catalog nodes to be displayed in a particular **localization** (e.g., Germany, UK, France, etc.), on a specific **website** (e.g., B2B, B2C, Europe, Australia), and/or for the selected **customer(s)** or **customer group** (e.g., Non-Authenticated Visitors, Wholesalers, Partners, etc.), while keeping the same URL.

.. image:: /user/img/concept-guides/web-catalog/restrictions.png
   :alt: Visibility restrictions for content variant

You can also control which section of the web catalog to display on your website. By configuring a **navigation root**, you select relevant categories that you want to be included, instead of the whole web catalog content tree. For example, build the main menu starting from the *Smart Home*  content node and its child nodes.

.. image:: /user/img/concept-guides/web-catalog/nav-root.png
   :alt: Configuring a navigation root to display a segment of a web catalog

You can use the nodes excluded from the main menu. For example, create a category and add it as a separate block on the storefront homepage as part of the :ref:`featured menu <frontend-menus-overview>`. This block can lead to a product listing page with a number of discounted items with the product listing page not be part of the main menu and will only be available via a link from the new featured menu block on the homepage (e.g., Special Offers).

.. image:: /user/img/concept-guides/web-catalog/featured-menu-nav-root.png
   :alt: A segment of web catalog added to featured menu in the storefront

Web Catalogs in a Multi-Org Application
---------------------------------------

.. note:: The multi-org functionality is only available in the Enterprise edition.

Each :ref:`organization <user-management-organizations>` in a multi-org Oro application is a clean slate with a separate inventory, catalogs, products, and the organization configuration options that may or may not fall back to the :ref:`system configuration <mc-system-configuration>`.

When you create a new organization, you also need to build a new web catalog as web catalogs and products are not replicated from one organization into another.

The only organization that can display web catalogs and products from different organizations is called **global**. Users in the global organization, given they have  Global access levels in their role, can access and control all system data in all organizations within one instance of the application.

Web Catalogs and Websites
-------------------------

.. note:: The multi-website functionality is only available in the Enterprise edition.

You can build as many catalogs as you need in each organization within one Oro application, but you can assign only one web catalog per website (via the website configuration). That said, there is no limit to how many times you can reuse the same web catalog for other websites.

.. image:: /user/img/concept-guides/web-catalog/web-cat-config-website.png
   :alt: Add a web catalog to a website

.. hint:: Web catalogs can only be assigned to websites, not customers or customer groups.

Web Catalogs and GDPR Consents
------------------------------

One of the GDPR obligations is to give customers greater access to their personal information and let them have more control over it. OroCommerce allows you to :ref:`create and manage customer consents <system-consent-management>` while enabling buyers to view, manage, and revoke these in your storefront.

To be able to display the text of the consent to customers in the storefront, you need to create a :ref:`consent landing page <user-guide--landing-pages>` with the corresponding description and :ref:`add it as a content variant <user-guide--marketing--web-catalog--content-variant-landing page>` for a specific node in a web catalog.

As contents in OroCommerce can be either **mandatory** or **optional**, you may or may not require to add a landing page with a consent description to your catalog. The rule of thumb is that if your consent does not require any descriptive text, or if your consent is optional, you do not have to add it to the web catalog node as a landing page. However, if you need to comply with the GDPR, make sure that the mandatory consent has a detailed description of the terms that the buyer should agree to, in which case you should add this consent as a landing page to the selected web catalog node.

.. image:: /user/img/concept-guides/web-catalog/consents.png
   :align: center
   :alt: Web catalogs in consents

Web Catalog and Master Catalog
------------------------------

An OroCommerce application does not have to have a web catalog to display your product collection, as you can use the :ref:`master catalog <user-guide--master-catalog>`. The structure of the master catalog is always displayed in the storefront when you have no web catalog, or it is not connected to the website (in the system configuration :ref:`globally <user-guide--marketing--web-catalog--enable-globally>` or :ref:`per website <sys--websites--sysconfig--websites--routing>`).

However, using a web catalog over a master catalog has its perks, as it offers more flexibility to create different versions of one OroCommerce application, catering for different needs of different B2B buyers.

The following table summarizes the difference between a master catalog and a web catalog:

.. csv-table:: URL Structure
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

   "store.com/ [categories]","store.com/ [nodes]","A link to the same product can have two different URL addresses, depending on whether a master catalog (store.com/category/subсategory...) or a web catalog category (store.com/2nd-level-node/3rd-level-node) has been connected to a storefront page."

.. csv-table:: Personalization
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

   "Visibility Settings","Variants","To hide a product/category in the master catalog, you need to change  its visibility settings. To hide a product/category in a web catalog, you need to toggle content node restrictions."

.. csv-table:: Display Type
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

   "Product Collection","System Page, Product, Page, Product Collection, Category, Landing Page","When the master catalog is used to display products in the storefront, the complete product collection is used where one product cannot be reused for the second time in a different category. Web catalog, on the other hand, enables you to set up different types of pages and reuse the same product in various categories for marketing purposes."

.. csv-table:: Attribute-based product assignment
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

   "No","Yes","Unlike the master catalog, a web catalog enables you to add a :ref:`filter-based segment <user-guide--marketing--web-catalog--content-variant-product-collection>` to select and display a dynamic set of products in the storefront. For instance, you can create a product collection segment for a special promotion using a variety of filters and conditions, such as putting on sale all products that are in stock but with inventory lower than 500 items."

.. image:: /user/img/concept-guides/web-catalog/AdvancedFilter.png
   :align: center
   :alt: Filtering products for a product Collection in a web catalog

.. csv-table:: Multiple Instances
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

   "No","Yes","There is always only one master catalog per organization but multiple web catalogs."

.. csv-table:: Product Association
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

   "Single","Multiple","The master and web catalogs share the same product collection but unlike the former, a web catalog can have the same product in multiple categories."

.. csv-table:: Visibility Restrictions
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

    "May affect product","Do not affect products","The :ref:`visibility of a product <products--product-visibility>` is determined based on the master catalog category, not a web catalog node. This is because one product can relate to many web catalog nodes (e.g., one web catalog category may be hidden, the other one visible), which would make it difficult to determine the product's actual visibility. You can also determine product visibility on the :ref:`product level <products--product-visibility>`. *By default, product visibility depends on the master catalog category visibility* (i.e., if you hide a master catalog category, you hide all products of this category in the web catalog). You can change this visibility behavior per product, if necessary, in addition to changing product visibility per website. However, keep in mind that product visibility has priority over the category visibility. If the product is visible, but the category is hidden, the product is still visible."

.. csv-table:: Value Fallback
   :header: "Master Catalog","Web Catalog","Notes"
   :widths: 5, 5, 30

   "Yes","No","Product-related values fall back to the master catalog settings. Let's take inventory as an example. In the *Inventory* section on a product edit page, you can either provide a custom value to most inventory options, choose to fall back to category defaults, or follow the configuration determined on the website level. If in the master catalog, *Paper and Mailing* has **Is Upcoming** set to *Yes*, then *PPR1 - Copier Paper White A4 500 Sheets* that belongs to *Paper and Mailing* will have the option *Is Upcoming* set to *Yes* whenever the product falls back to *Category Defaults* (i.e. falls back to the value set for *Is Upcoming* on category level in the master catalog)."

.. image:: /user/img/products/master_catalog/value_fallback.png
   :alt: Value Fallback illustration

Use Cases
---------

Using Master and Web Catalogs Together
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As no business is alike, OroCommerce can be easily adapted to your business processes. Some sellers may be comfortable enough to use the master catalog to display all their product collection, and some may have more complicated processes, where interchanging web catalogs is their key marketing strategy.

One of the common ways approach catalogs is to section the main menu into Products and Brands, where both of these items are built through the web catalog. Products in this case fully mirror the structure of the master catalog, while Brands categorize and filter all product collection based on the brand names.

.. image:: /user/img/concept-guides/web-catalog/products-brands.png
   :align: center
   :alt: Products and brands in the main menu of the storefront

Keeping the structure of the master catalog in Products helps adhere to a unified organization strategy, but using a web catalog as the tool for publication helps reuse existing products for Brands. This would not be possible via standard master catalog publication, as in the master catalog products can only be used once.


**Related Topics**

* :ref:`Master Catalog User Guide <user-guide--master-catalog>`
* :ref:`Master Catalog Concept Guide <concept-guide-master-catalog>`
* :ref:`Manage Product Visibility <products--product-visibility>`
* :ref:`Web Catalogs User Guide <user-guide--web-catalog>`
* :ref:`Build a Custom Web Catalog From Scratch <user-guide--marketing--web-catalog--sample>`
* :ref:`Use Web Catalog Nodes as Root Nodes <user-guide--web-catalog-navigation-tool>`

**Further Practice**

* `Fundamental OroCommerce Online Course <https://oroinc.com/b2b-ecommerce/course/fundamental-orocommerce>`__


.. include:: /include/include-links-user.rst
   :start-after: begin


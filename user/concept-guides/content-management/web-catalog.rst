.. _concept-guide-web-catalog:

Web Catalog Management Concept Guide
====================================

Web catalogs are a powerful content management tool that enables sellers to create unlimited customizable and personalized versions of their OroCommerce storefronts to provide an engaging and personalized experience for B2B customers.

Visually, a web catalog represents the main navigation bar of the storefront website. It enables buyers to browse the product catalog, click on products to view details, and add them to shopping lists before ultimately buying them. Under the hood, OroCommerce sellers can not only build new catalogs from scratch but also modify default catalogs, customizing and enriching them with new menu items for various localizations, customers, or customer groups.

Sellers can add new pages to existing catalogs or create all new catalogs. They may want to change out catalogs seasonally or create a catalog for a VIP promotion or sale and redirect particular customers to the promotional page. With restrictions, it is easy to ensure that only specific customers can access these personalized pages.


.. admonition:: Business Tip

    Are you looking for the |best eCommerce platform for B2B| organizations? Evaluate your options with our platform comparison chart.


Web Catalog Elements
--------------------

In the back-office, a web catalog consists of the **content tree** (the catalog structure), populated with **content nodes** (catalog categories). Building a catalog tree structures the product collection and defines the storefront menu look and feel.

A good first step when it comes to building a web catalog is creating the root content node, followed by adding the **first level menu items** that represent menu headers, for example:

* Building & Hardware
* Outdoor & Garden
* Lighting & Electrical

.. image:: /user/img/concept-guides/web-catalog/bo-sf-nodes.png
   :alt: First level menu items in back-office vs storefront

and then populating them with child (content) nodes:

* Building & Hardware: *Building Supplies, Doors & Windows, Timber & Sheet Materials*
* Outdoor & Garden: *Garden Furniture, Garden Tools, Fencing*
* Lighting & Electrical: *Lightning, Home Electrical, Smart Home*

.. image:: /user/img/concept-guides/web-catalog/bo-sf-child-nodes.png
   :alt: Child menu items in back-office vs storefront

Each of these nodes can have more child categories:

* Timber & Sheet Materials: *Timber Cladding, Skirting Boards, Decorative Mouldings*
* Fencing: *Fence panels, Garden Gates, Gravel Boards*
* Smart Home: *Voice Assistants, Cameras, Heating, Doorbells*

.. image:: /user/img/concept-guides/web-catalog/bo-sf-further-child-nodes.png
   :alt: Deeper child menu items in back-office vs storefront

.. hint:: In addition to the catalog items, the main storefront menu can also contain static custom menu items, such as Contact Us or About. These custom menu items are part of *commerce_main_menu* and can be moved to a different section of your storefront. Please see the :ref:`documentation on storefront menu items <backend-frontend-menus>` to learn more.

        .. image:: /user/img/concept-guides/web-catalog/commerce-main-menu-sf.png
           :alt: Commerce-main-menu in the storefront

Every child node must be populated with :ref:`content variants <user-guide--marketing--web-catalog--content-variant>`. **Content variants** are the types of pages that you add to the content node. These pages can be of the following types:

* :ref:`System page <user-guide--marketing--web-catalog--content-variant-system-page>` --  one of many standard pre-designed pages for the OroCommerce storefront(Sign In page, Open Orders page, Request a Quote page, etc.)
* :ref:`Product page <user-guide--marketing--web-catalog--content-variant-product-page>` -- a direct link to product details
* :ref:`All Products page <user-guide--marketing--web-catalog>` -- a collection of all products usually added for smaller catalogs with no more than a few hundred products
* :ref:`Category page <user-guide--marketing--web-catalog--content-variant-category>` -- a direct link to products from a master catalog category
* :ref:`Product Collection page <user-guide--marketing--web-catalog--content-variant-product-collection>` -- a dynamic collection of products that you filtered/selected manually or in bulk to be displayed for this page
* :ref:`Landing page <user-guide--marketing--web-catalog--content-variant-landing page>` -- a direct link to a custom content page
* **Resource Library** -- if you download a |Resource Library Extension|, you can add media content, such as news, banners, product review videos, safety specifications, etc.

.. hint:: It is possible to add a custom content page and link it as a content variant, but this requires some customization effort.

.. image:: /user/img/concept-guides/web-catalog/content_variants.png
   :alt: Content variants in the back-office

You can configure more than one content variant per node, in case you want to display different variations of a page to different customers. By default, the web catalog with all its nodes has no **visibility restrictions** and may be displayed for any localization, on any website, and for any customer. However, depending on your business processes, you can adjust web catalog nodes to be displayed in a particular **localization** (e.g., Germany, UK, France, etc.), on a specific **website** (e.g., B2B, B2C, Europe, Australia), and/or for the selected **customer(s)** or **customer group** (e.g., Non-Authenticated Visitors, Wholesalers, Partners, etc.), while keeping the same URL.

.. image:: /user/img/concept-guides/web-catalog/restrictions.png
   :alt: Visibility restrictions for content variant

You can also control which section of the web catalog to display on your website. By configuring a **navigation root**, you select relevant categories that you want to be included, rather than displaying the entire content tree of the web catalog. For example, build the main menu starting from the *Building & Hardware* content node and its child nodes. More in the storefront menu configuration are described in the `Changing Storefront's Product Menu`_ section below.

.. image:: /user/img/concept-guides/web-catalog/nav-root-system-config.png
   :alt: Illustrating that storefront menu is built based on the navigation root settings configured from the system configuration


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

Web Catalogs and Consents
-------------------------

Customers want and deserve to feel their data is safe when shopping online, that is why online businesses must comply with data protection regulations, such as |CCPA| or |GDPR|. One of the data protection obligations is to give customers greater access to their personal information and let them have more control over it. OroCommerce allows you to :ref:`create and manage customer consents <system-consent-management>` while enabling buyers to view, manage, and revoke these in your storefront.

.. note:: See :ref:`Consent Management Concept Guide <user-guide--consents>` for more information on data protection.

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

   "store.com/ [categories]","store.com/ [nodes]","A link to the same product can have two different URL addresses, depending on whether a master catalog (store.com/category/subcategory...) or a web catalog category (store.com/2nd-level-node/3rd-level-node) has been connected to a storefront page."

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

.. _concept-guide-web-catalog-change-storefront-menu:

Changing Storefront's Product Menu
----------------------------------

Whether you use the master catalog or a web catalog to display your product collection on the website, you can further modify how your storefront menu looks by using the storefront menu.

There are several :ref:`storefront menus <frontend-menus-overview>` that make up the navigation of the website storefront. The one that allows you to customize the main navigation menu in your storefront is called **commerce_main_menu**. It reflects the existing structure of your master catalog or :ref:`selected web catalog <user-guide--system--menu--menu-frontend>` and presents you with options to customize the name and position of its categories in the storefront without affecting the original master or web catalogs.

Commerce_main_menu is located under **System > Storefront Menus**.

.. image:: /user/img/concept-guides/web-catalog/commerce-main-menu.png
   :alt: Location of the menu associated with the main product menu in the storefront

Here, categories in the tree to your left constitute the main menu your customers see on the website.

When no :ref:`web catalog is connected <sys--config--sysconfig--websites--routing>`, **commerce_main_menu** is populated with the structure of the master catalog, and the target type of the system items is set to Category. When you connect a web catalog and define the navigation root, system menu items in the menu is set to Content Node.

.. image:: /user/img/concept-guides/web-catalog/master-vs-webcatalog-frontend-menu.png
   :alt: The difference between the way commerce_main_menu looks when either the master or web catalog is connected

You can modify *system* items (which are reflection of the items from web/master catalog), or :ref:`add new custom items altogether <user-guide--system--menu--menu-frontend--add-item>`. After you add a new item to a particular parent category, you can drag and drop it outside its parent up or down the tree.

.. note:: Keep in mind that, initially, the system takes the default values from the :ref:`routing settings <sys--config--sysconfig--websites--routing>` in the system configuration. However, once a user adjusts the values in the **commerce_main_menu**, the system starts adhering to these modified values, subsequently updating the storefront menu accordingly. This way, the menu configured to start from the *Building & Hardware* content node set in the system configuration will be overridden with the *Smart Home* content node set in the **commerce_main_menu**.

  .. image:: /user/img/concept-guides/web-catalog/nav-root-options.png
     :alt: Illustrating that the navigation root configured from the Storefront menu supersedes the one set under system configuration.


You can also add promo images to the menu and add links to them. In the screenshot below, the image is created as a new menu item with target type URI and placed 2 levels deep in the tree.

.. image:: /user/img/concept-guides/web-catalog/promo-image.png
   :alt: Promo image at the bottom of the mega menu

However, if you place such an image higher or lower than level 2, it will be displayed as a menu item, which means that you will only see the title of the menu item but not the image. This is the default behavior, and :ref:`customization is required <bundle-docs-commerce-commerce-menu-bundle-menu-templates>` if it needs changing for your business needs.

.. image:: /user/img/concept-guides/web-catalog/promo-image-no-preview.png
   :alt: Promo image as a link without preview

You can use the nodes excluded from the main menu. For example, create a category or content node (e.g., Promotions) with a number of discounted items and with the product listing page not be part of the main menu. Then add it to the :ref:`featured menu <menu-management-concept-guide>` block and place it anywhere in the storefront header under the :ref:`theme configuration <back-office-theme-configuration>`.

.. image:: /user/img/concept-guides/web-catalog/featured-menu-nav-root.png
   :alt: A segment of web catalog added to featured menu in the storefront

Synchronization with Original Web Catalog
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The tree displayed on the left-hand side of the main menu represents the structure of the navigation root of the content node from your selected web catalog (or the categories of the master catalog if a web catalog is not connected). The information copied from the web catalog is considered system information and can be modified only partially. For example, you can change the category title, but the target type, content node, and web catalog options will be disabled from editing. If you are :ref:`creating a new menu item <user-guide--system--menu--menu-frontend--add-item>` or updating an item you created previously, you can update any information without exception.

Every item in the tree is synchronized with the web catalog until you manually update the item in the commerce_main_menu, in which case your changes have priority. The system will not overwrite them if the original menu item is updated in the web catalog.

In the example below, we have changed the title of category *Building Supplies* to *Construction Materials* via commerce_main_menu. As you can see in the screenshot below, the category's name in the original web catalog is unchanged, and the storefront uses the title from the storefront menu.

.. image:: /user/img/concept-guides/web-catalog/sync-illustration.png
   :alt: Illustration of the storefront menu when one of the titles is updated in commerce_main_menu

Like with the change in the title, you can change the order of the menu items by dragging and dropping them under the required parent item without affecting the original web catalog. When you change the order of the items, your changes will have priority over any potential future changes in the web catalog order.


Use Cases
---------

Using Master and Web Catalogs Together
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As no business is alike, OroCommerce can be easily adapted to your business processes. Some sellers may be comfortable enough to use the master catalog to display all their product collection, and some may have more complicated processes, where interchanging web catalogs is their key marketing strategy.

One of the common ways approach catalogs is to section the main menu into Products and Brands, where both of these items are built through the web catalog. Products in this case fully mirror the structure of the master catalog, while Brands categorize and filter all product collection based on the brand names.

.. image:: /user/img/concept-guides/web-catalog/products-brands.png
   :alt: Products and brands in the main menu of the storefront

Keeping the structure of the master catalog in Products helps adhere to a unified organization strategy, but using a web catalog as the tool for publication helps reuse existing products for Brands. This would not be possible via standard master catalog publication, as in the master catalog products can only be used once.


**Related Topics**

* :ref:`Master Catalog User Guide <user-guide--master-catalog>`
* :ref:`Master Catalog Concept Guide <concept-guide-master-catalog>`
* :ref:`Manage Product Visibility <products--product-visibility>`
* :ref:`Web Catalogs User Guide <user-guide--web-catalog>`
* :ref:`Build a Custom Web Catalog From Scratch <user-guide--marketing--web-catalog--sample>`
* :ref:`Add new menu items via Storefront Menus <user-guide--system--menu--menu-frontend--add-item>`
* :ref:`Use Web Catalog Nodes as Root Nodes <user-guide--web-catalog-navigation-tool>`

**Further Practice**

* |Fundamental OroCommerce Online Course|
* |Content Management Online Course|

.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-links-dev.rst
   :start-after: begin

.. include:: /include/include-links-seo.rst
   :start-after: begin

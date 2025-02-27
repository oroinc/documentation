.. _solution-architect-guide--concepts:

OroCommerce Concepts
====================

This section provides an overview of the platform's key features, distinguishing between back-office and storefront functionalities, covering access control, product catalog management, pricing, inventory, customer handling, sales flow, multi-website support, hierarchical configuration, and the approach to versioning and upgrades.

Back-Office vs Storefront
-------------------------

The OroCommerce application provides two distinct scopes of access: :ref:`back-office <user-guide--back-office>` and :ref:`storefront <user-guide-storefront>`.

The back-office is designed for organizational users, including administrators, sales representatives, marketers, and content managers, responsible for managing the application's configurations and data.

In contrast, the storefront is tailored for buyers, allowing them to browse the product catalog, access pertinent content and account information, request quotes, and submit orders.

The following table outlines the key differences between the back-office and the storefront:

.. csv-table::
   :header: "","Back-Office","Storefront"
   :widths: 20, 15, 15

   "Primary role(s)","Application Administrator, Seller, Sales Representative, Marketing Manager","Buyer"
   "The entity that represents a role","Role","Customer User Role"
   "The entity that represents a user","User","Customer User"
   "The entity that represents a company/division","Business Unit","Customer"
   "The entity that represents an organization","Organization","Website"
   "API","Yes","Yes"
   "Templating engine","Twig templates","Layout engine + Twig templates"
   "Theme","Basic styling customization","Full styling customization"

Key Features
------------

Access Control
^^^^^^^^^^^^^^

The following table shows security measures available at the application level.

.. csv-table::
   :header: "Measure","Description"
   :widths: 10, 30

   "User management","* Separate back-office and storefront users
   * All passwords are hashed with salt
   * Two-factor authentication (optional)"
   "ACL","* Role-based ACL
   * Separate back-office and storefront roles"
   "Back-office organization structure","* Based on hierarchy levels: user > business units (tree) > organization > global
   * Permissions could be set per entity+action+level, action, and workflow transition+level"
   "Storefront customers hierarchy","* Based on hierarchy levels: customer user > customers (tree)
   * Permissions could be set per entity+action+level, action, and workflow transition+level"
   "Multi-tenant / marketplace","The data is completely separated between the tenants represented by the organizations"

The back-office user :ref:`organization <user-management-organizations>` structure consists of :ref:`three entities <user-guide-user-management>`: user, business unit, and organization. Users may belong to multiple business units, business units have a hierarchy, and business units belong to one organization.

.. image:: /img/solution-architect/1-permision-levels.png

Every back-office user has one or multiple :ref:`roles <user-guide-user-management-permissions>` that define a permission level for every combination of entity and action. If the user has more than one role, all permissions are merged. The following table shows an example of permissions set for three entities in the scope of one role.

.. csv-table:: Role: Product Manager
   :header: "Action","View", "Create", "Update", "Delete", "Assign"
   :widths: 10, 10, 10, 10, 10, 10

   "Product","Organization","Business Unit","Business Unit","Business Unit","Business Unit"
   "Shopping List","Organization","User","User","User","None"
   "Order","Organization","User","User","User","None"

A simplified structure and approach are used for customer users, also known as storefront users. Each customer user is assigned a :ref:`customer user role <concept-guide-customers-permissions>` and belongs to a specific customer, with :ref:`customers organized in a hierarchy <concept-guide-customers>`.

.. image:: /img/solution-architect/2-customer-hierarchy.png

Product Catalog
^^^^^^^^^^^^^^^

The product catalog is the primary functionality of any e-commerce application. OroCommerce includes :ref:`product management <concept-guides--product-management>`, as well as the :ref:`master catalog <concept-guide-master-catalog>` and :ref:`web catalog <concept-guide-web-catalog>`. The following table describes all primary entities and concepts.

.. csv-table::
   :header: "Entity","Description"
   :widths: 10, 30

   "Product","The product represents the item a customer wants to buy. A product defines an SKU, name, URL slug, short and long descriptions, multiple product units, multiple images, multiple prices, inventory levels and parameters, SEO parameters, visibility restrictions, and custom product attributes. A product belongs to the product family, which defines a list of available product attributes grouped into attribute groups."
   "Master Catalog","Master Catalog represents a tree of categories. A category defines the title, URL slug, small and big images, short and long descriptions, inventory parameters, visibility restrictions, SEO parameters, and custom attributes. Each product may belong to only one category in the master catalog. By default, product inventory parameters and visibility restrictions fall back to the appropriate values of the master catalog to which it belongs."
   "Web Catalog","Web Catalog is a marketing concept that allows to organize various types of content in a catalog form. A web catalog is a tree of content nodes, each node could represent different content. The content node defines a title, URL slug, SEO parameters, multiple content variants, and custom attributes. Out-of-the-box content variants may refer to a system page, landing page, product page (PDP), master catalog page (PLP), or custom product collection (PLP). New content variant types can be added as a customization."

The following diagram describes the relation between all primary product catalog entities.

.. image:: /img/solution-architect/3-product-catalog-diagram.png

Pricing
^^^^^^^

OroCommerce :ref:`pricing engine <user-guide--pricing>` is represented by product prices grouped into price lists, and price attributes. Prices could also be affected by :ref:`promotions <concept-guides--promotion-management>` and :ref:`taxes <concept-guide--taxes>`. The following table outlines all primary entities and concepts.

.. csv-table::
   :header: "Entity","Description"
   :widths: 10, 30

   "Price List","The price list is a primary concept of OroCommerce pricing. It includes a list of product prices that can be used globally, per website, per customer group, or per customer. The Price list could be either manual when all prices are added or imported manually, or generated when the prices are generated based on the product assignment and price calculation rules. Price lists also have a list of supported currencies and schedules."
   "Product Price","Product price represents a price for the specific product stored in the specific price list. Product price consists of price list relation, product relation, quantity, product unit, actual price value, and currency. Different quantities can be used to implement price tiers. The combination of price list, product, quantity, product unit, and currency must be unique."
   "Price Attribute","Price attributes are custom parameters, price-like values that represent price values specified per unit of quantity and can be set in different currencies. The structure of price attribute and price attribute values is similar to the price list and product price. The price attribute defines the name and supported currencies. Price attribute value consists of price attribute relation, product relation, product unit, actual price value, and currency. Price attributes are used to store some financial values that are not prices as such but could be used in various pricing-related use cases. For example, a price attribute MSRP could be used as a base value in the price list rules."
   "Promotion","Promotions are used to decrease product prices under specific circumstances. There are several types of promotions supported out of the box: order total, order line item, buy X get Y, and shipping promotion. New types can be added as a customization. Promotions could be triggered either automatically or by coupons. Promotion applications can be restricted by a list of products, schedules, customers, customer groups, websites, and custom expressions."
   "Tax","Taxes are applied on the top of product prices based on the various parameters. By default, taxes are applied based on customer tax codes, product tax codes, and tax jurisdictions (origin/billing/shipping addresses). All combinations of customer tax codes, product tax codes, tax jurisdictions, and actual tax percentages are defined as tax rules. Custom tax logic can be implemented as a customization."

The following diagram shows the general structure of all mentioned entities and their parameters and traits.

.. image:: /img/solution-architect/4-pricing-diagram.png

Inventory
^^^^^^^^^

:ref:`Inventory <concept-guide--inventory>` data in OroCommerce is represented by warehouses, inventory levels, inventory status, and multiple inventory options. The following table describes all primary entities and concepts.

.. csv-table::
   :header: "Entity","Description"
   :widths: 10, 30

   "Warehouse","A warehouse is a place where all the products are stored. Warehouses can represent both real places and virtual storage, such as the storage needed to reserve a specific amount of products. Each warehouse has only a name and an address."
   "Inventory Level","Inventory level is an intersection entity between the product, product unit, and warehouse. Each inventory level defines how many specific products in the specific product unit are stored at the specific warehouse."
   "Inventory Status","Inventory status is a product attribute that may have different values depending on the requirements. Out of the box are available statuses are in stock, out of stock, and discontinued; an administrator can add more statuses if needed. Inventory statuses can be used to restrict visibility or operations with specific entities on the storefront. For example, out-of-stock products can be visible at the storefront, but can not be added to the order. By default, inventory status is not synced with the inventory levels"
   "Inventory Options","Inventory options are additional product parameters that can be defined globally at the system configuration, per master catalog category, or per product. These options are:

    * Manage inventory
    * Inventory threshold
    * Low inventory threshold
    * Highlight low inventory
    * Backorders
    * Decrement inventory
    * Is upcoming
    * Availability date
    * Minimum quantity to order
    * Maximum quantity to order"

The following diagram shows the relation between all inventory-related entities.

.. image:: /img/solution-architect/5-inventory-diagram.png

Customers
^^^^^^^^^

:ref:`Customer structure <concept-guide-customers>` in OroCommerce is represented by customers, customer users, customer user roles, customer groups, and customer visitors. The following table describes all primary entities and concepts.

.. csv-table::
   :header: "Entity","Description"
   :widths: 10, 30

   "Customer","Customers represent a company that is purchasing something via OroCommerce. Customers have a hierarchy, so a main customer may represent the company in general, while child customers represent divisions or departments. A customer defines the name, customer group, assigned sales representatives, customer tax code, billing/shipping addresses, assigned price lists, payment terms, and custom parameters."
   "Customer User","Customer users represent real people who work in a company and purchase products. Each customer user belongs to only one customer. A customer user defines the name, email address (unique by default), assigned sales representatives, website, localization, billing/shipping addresses, customer user roles, and custom attributes."
   "Customer User Role","Customer user roles represent permissions for customer users, i.e. what they can or can not do at the storefront. Each customer user has to have at least one role assigned, but he/she may have multiple roles as well. Customer user roles define name, entity permissions (combinations of entity+action+level), action permissions, and workflow permissions. New permissions can be added as customization."
   "Customer Group","Customer groups represent groups of customers based on some business logic. For example, customer groups can be used as customer tiers with custom pricing for each tier, or as marketing segments to show custom content on the storefront. A customer can belong to only one customer group. A customer group defines a name, customer tax code, assigned price lists, payment terms, and custom parameters."
   "Customer Visitor","A customer visitor is a unique hidden entity representing a storefront user interacting with the storefront without logging in (guest user). For example, guest shopping lists are assigned to the customer visitor, and if they decide to register, this shopping list will be re-assigned to a new customer user. The customer visitor stores the session ID and all parameters needed for guest-related features."

The following diagram shows the bird’s-eye view of the customer entities.

.. image:: /img/solution-architect/6-customers-diagram.png

Sales Flow
^^^^^^^^^^

Five primary entities represent the :ref:`sales flow in OroCommerce <concept-guide--customers-sales>`: shopping list, :ref:`request for quote (RFQ), quote <concept-guide-rfq-quotes>`, :ref:`checkout <checkout-management-concept-guide>`, and :ref:`order <concept-guide-orders>`.  These entities can be converted into others using various transitions at the storefront and the back office. The following table describes all primary entities and concepts.

.. csv-table::
   :header: "Entity","Description"
   :widths: 10, 30

    "Shopping List","Shopping lists are used to collect a list of products a person may want to buy. OroCommerce supports multiple shopping lists for the same person. Shopping lists are also often used to emulate other types of product containers like wishlists, favorite lists, etc. Shopping lists have a name, a note, and a list of line items. Shopping list line items represent the relation between the shopping list, product, and product unit, and also have quantity and optional notes. Price is not stored in the shopping list line item and is automatically updated on the fly. A user can easily add items to shopping lists, move them to another shopping list, or remove them completely. A shopping list can be used to initiate the checkout process."
    "Request for Quote","Requests for quote (RFQ) represent a request from the buyer to the seller. A buyer may negotiate prices, quantity, shipping, and other parameters. Request for quote contains user's first and last names, email, phone, company name, user’s role, notes, PO number, last shipping date, optional list of assigned customer users, and line items. Line items also store the relation between RFQ, product, and product unit, and have quantity and optional notes; but now they also store target prices that can be entered manually by the buyer. Buyer and seller can have a conversation around the RFQ products that should lead to accepting or rejecting the RFQ."
    "Quote","Quotes represent offers from the seller to the buyer, they could be either converted from RFQ or created from scratch. A quote may have a valid-until-date, PO number, last shipping date, shipping cost estimate, an optional list of assigned customer users, and line items. Line items store the relation between RFQ, product, and product unit. A product could be an existing product or a free-form product with a custom SKU and name. As for the price, quote line items may have multiple offers each with its own quantity and custom price. Again, the buyer and seller can initiate a conversation about it if needed. A quote can be used to initiate the checkout process."
    "Checkout","Checkout is an entity that represents a purchasing process where the customer selects billing and shipping addresses, payment gateways, shipping services, and some additional parameters. Checkouts can also be called open orders, as these orders have not been submitted yet. A checkout entity is created every time a buyer starts a checkout workflow (single-step or multi-step) and automatically updated on the fly. Checkout itself has the PO number, notes, last shipping dates, and line items. Line items represent a relation between checkout, product, and product unit, and have fixed quantity and price."
    "Order","Order is the final step in the sales flow, it represents the submitted order with all parameters set. An order may have a PO number, notes, and last shipping date, and always has line items. Line items store relation between order, product, product unit, and warehouse. A product could be an existing product or a free-form product with a custom SKU and name. Lite items also have fixed quantity, price, ship-by date, and optional notes. An order also has all the parameters that the customer has specified during the checkout process. An order has two statuses: internal one which describes the position in the order flow, and payment status which describes if the customer has paid for the order. It is also possible to re-order an existing order which immediately starts a new checkout with all products from the order, the prices are taken from the storefront."

Below is the diagram that shows all possible ways to create or convert sales flow entities into each other. BO stands for back-office operation, and SF means operations that can be done in the storefront.

.. image:: /img/solution-architect/7-sales-flow-diagram.png

Here is another diagram that shows the parameters and relations of all sales entities and their line items. Arrows represent typical sales flow transitions.

.. image:: /img/solution-architect/8-sales-flow-table.png

Multiple Websites
-----------------

Many applications may require multiple storefronts, referred to as :ref:`websites <website-management-concept-guide>` in OroCommerce. Each website has its own set of configuration options and enabled features. The application needs to identify the current website correctly, and there are three built-in approaches (matchers) for doing so: by domain, by cookie value, and by an environment variable. Additionally, it is possible to implement a custom approach if necessary.

Websites have distinct names, assigned price lists, guest and self-registration roles, and various configurations. These configurations enable and customize most of the available features for each website.

Every website must belong to one organization. If you want to use the same data set across multiple websites, you should unite them under the same organization. This shared data set may include a master catalog, web catalog, products, pricing, inventory, customers, and more. Alternatively, if you wish to separate all data between different websites, you must place them under different organizations. The following schema illustrates an example of this separation.

.. image:: /img/solution-architect/9-multi-website-diagram.png

Here is the list of primary features that can be configured per website.

.. csv-table::
   :header: "Group","Features"
   :widths: 10, 30

   "Routing","Domain name, Canonical URLs, Web Catalog, Navigation menu, Guest access"
   "Localization","Default Localization, Enabled Localizations"
   "Design","Theme, Page template, Menu template"
   "Customer","Customer user registration options (enabled, confirmation, etc), Consents"
   "Product","Image watermark, Image gallery options, Product autocomplete, Configurable product options"
   "Product Catalog","Default currency, Enabled currencies, Promotions, Filter and sorter options, Related items options (related, up-sells, similar)"
   "Search","Search terms, Saved search, Fuzzy search, Search synonyms, Stopwords, Customer recommendations"
   "Inventory","Warehouse priority, Product inventory options, Allowed statuses for storefront"
   "Sales Flow","Shopping list options, Guest shopping list, RFQ options, Guest RFQ, Quotes, Guest quote, Quick order form (QOF), Guest QOF, Checkout options, Guest checkout, Order history, Multi-shipping options, Payment rules, Shipping rules"

Multi Level Configuration
-------------------------

OroCommerce allows setting values for system configuration options on :ref:`multiple levels <user-guide-system-setting>`. The following diagram shows the configuration level fallback for the storefront.

.. image:: /img/solution-architect/10-multi-level-config.png

Each lower level covers multiple entities from the highest levels. For example, each customer group may contain multiple customers and can be used to set general customer-related configuration values. Each higher level may override values from the lower level. For example, a website-level configuration overrides the same values from the organization or global levels.

The following table covers typical customizations that can be done in the system configuration.

.. csv-table::
   :header: "Customization","Descriptions"
   :widths: 10, 30

   "Expose an option to a higher level","If some level does not contain a required configuration option but it exists at the lower level you can expose it to a higher level with a simple configuration on the code level. For example, if you need to limit the maximum number of shopping lists per customer, you can expose this option as it is available at the website level."
   "Add a new configuration option","You can add new configuration values at any level you want as a part of customization. You should think about how granular this option should be, i.e. which levels have to contain it, and expose it on the appropriate levels. The best practice is to start from the global level and expose it to the lowest possible level. For example, if you want to configure a website logo, it makes sense to expose this option only up to the website level as all customer groups and customers on the same website must see the same logo."
   "Add another configuration level","To introduce an additional level to this structure, you can customize it as needed. For instance, you might want to set specific values for each country and position this new level between the website and customer group levels. As a result, you will have the ability to override values set at the website level specifically for customers from a particular country."

Versioning and Upgrades
-----------------------

OroCommerce uses MAJOR.MINOR.PATCH version numbering scheme that is similar to the |semantic versioning|. Developer preview versions may have additional suffixes to denote the expected amount of upcoming changes on the code interfaces level (e.g., Beta and RC preview releases).

.. csv-table::
   :widths: 10, 30

   "MAJOR","These releases are reserved for significant backward-incompatible architecture and technology changes, such as switching to a new version of the Symfony framework, PostgreSQL, Elasticsearch, RabbitMQ, or Redis."
   "MINOR","These releases introduce new features and provide a clear migration path in case of relatively small backward incompatible architectural and technology changes."
   "PATCH","These releases usually do not contain any backward incompatible changes, unless noted otherwise in the release notes."

These versions can represent one of the following release types.

.. csv-table::
   :widths: 10, 30

   "Long-term support (LTS)","These versions are released once a year. They contain all features introduced in preview and patch releases since the previous LTS version and are recommended for general use."
   "Preview","These versions are released a few months before the planned LTS release. They contain new features, capabilities, and technology updates that might not be complete yet, but can be used for early compatibility testing by extension developers and system integrators in anticipation of the upcoming LTS version release. Preview versions are not maintained, there are no patch releases for preview versions, and any completed fixes are accumulated until the publication of the next preview or LTS release."
   "Patch","These version releases are mainly used for bug fixes, security patches, and minor improvements. They may be released as often as every few weeks for all currently maintained/supported LTS versions of OroCommerce Enterprise Edition."

For long-term stability, we recommend upgrading from an LTS version to the next LTS version so you can take the time to adopt new features. Apply patch releases that become available for your LTS version to stay current and receive continued support without needing to upgrade frequently.

Upgrade to the newest preview version once it is available only if you are an enterprise partner or an extension developer and want to ensure that your extensions and customizations are tested in combination with the new features before the next LTS release.

.. note:: Check the :ref:`release process documentation <doc--community--release>` for more details.


.. include:: /include/include-links-user.rst
   :start-after: begin

.. include:: /include/include-links-dev.rst
   :start-after: begin




:oro_documentation_types: OroMarketplace

.. _concept-guide-oro-marketplace:

OroMarketplace Concept Guide
============================

OroMarketplace is a powerful open-source digital B2B marketplace solution for businesses that want to build a marketplace for their own industry and expand by adding additional sellers or suppliers. Unlike most marketplace platforms, it is specifically designed for the B2B sector, enabling distributors, retailers, brands, or manufacturers to sell physical goods and services to other businesses. OroMarketplace is based on OroCommerce Enterprise, which allows for handling all storefront and back-office components and automating B2B processes using various workflows.

Organizations
-------------

In OroMarketplace, :ref:`organizations <user-management-organizations>` represent different vendors. You can create as many vendors as necessary via back-office, assigning them an organization type. It defines what features are available for a particular organization. By default, there are two organization types, General and Marketplace Seller, however, organization types are configurable on the developer level, where any set of features or restrictions can be added to match any business criteria and any seller. The general ownership type allows access to all application functionality without any restrictions, while Marketplace Seller type has limitations and offers only essential functionality that vendors might need, such as access to their orders and inventory, restricting them from viewing irrelevant or sensitive data.

.. image:: /user/img/concept-guides/marketplace/general-vs-marketplace-seller-org-type.png
   :alt: Illustration of how marketplace seller ownership type restricts features and menus for vendors

Marketplace owner organization must have a **global** access level to create a seller organization and view records of other sellers. It must also be of the *General* type to access all application functionality without restrictions.

.. image:: /user/img/concept-guides/marketplace/global-access-marketplace-owner.png
   :alt: Marketplace owner has global access level and is of General type

Seller Registration
-------------------

There are three ways to create a marketplace seller in the application:

* Via the marketplace storefront by filling in a seller registration form (using :ref:`Seller Registration Workflow <system--workflows--seller-registration-flow>`)
* Via the back-office by manually creating a new seller registration request
* Via the back-office by creating a new organization for the marketplace seller

In scenario one, the system creates a Marketplace seller admin, inventory and warehouse, and one default seller price list. A price list is also set up when a new marketplace seller organization is created as :ref:`a new organization <user-management-organization-create>`. :ref:`Creating seller products <configuration--commerce--marketplace--seller-organization>` is allowed by default for all seller organizations. Other configurations and scenarios involve manually creating the features listed above in the marketplace owner organization.

Registering via Storefront
^^^^^^^^^^^^^^^^^^^^^^^^^^

Prospective vendors looking to sell via the marketplace can submit a registration form online on the marketplace website.

.. image:: /user/img/concept-guides/marketplace/seller-registration-storefront.png
   :alt: Seller registration button in the storefront

The details provided in the registration form are immediately displayed in the OroMarketplace back-office under **Sales > Seller Registration Requests**, where you can view every such request and transition it through the corresponding workflow.

.. image:: /user/img/concept-guides/marketplace/seller-registration-request-wf.png
   :alt: Seller registration workflow

A person responsible for registration in the marketplace owner organization can then :ref:`start processing the request <user-guide--sales--seller-registration-requests>`, accept it immediately, or decline it using the back-office :ref:`Seller Registration Request workflow <system--workflows--seller-registration-flow>`. Once accepted, the vendor will be assigned a username and receive access to their own newly created seller organization in OroMarketplace. At each step of registration, :ref:`an email <user-guide-email-template>` is sent to the seller informing them about the progress of his application.

.. image:: /user/img/concept-guides/marketplace/email-templates.png
   :alt: Email templates for the seller registration process

When a prospective seller creates a registration request from the website and has their request accepted, they automatically have a seller organization created for them by the marketplace owner, including a user record, a default price list, inventory and a warehouse.

Creating a Registration Request via the Back-Office
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

A seller registration request can also be :ref:`created via the back-office <user-guide--sales--seller-registration-requests>` under  **Sales > Seller Registration Requests** in the marketplace owner organization, provided that the person managing such requests has the details of the prospective seller. They can also create :ref:`a seller organization <user-management-organization-create>` via the back-office straight away. In both cases, the process is manual and a designated person from the marketplace owner organization must :ref:`create a user <user-management-users>` for the new seller organization so they could log in to their back-office, in addition to setting up :ref:`inventory and warehouse <user-guide--inventory>`, and one :ref:`default price list <user-guide--pricing--create-pricelist>`.

Seller Dashboard
----------------

Dashboards are typically the first thing merchants see when they log in to the back-office. In addition to out-of-the-box :ref:`widget dashboards <user-guide-dashboards>` that provide significant business KPIs, OroMarketplace offers an additional dashboard for sellers demonstrating e-commerce statistics for orders revenue and count, product statistics, and top-selling items. It is an interactive dashboard that also breaks this information down over a period of time, allowing sellers to analyze nearly any aspect of their business. There is no limit to how many dashboards of this type a seller can create in their organization.

.. image:: /user/img/concept-guides/marketplace/seller-dashboard.png
   :alt: Seller dashboard

Products and Brands
-------------------

:ref:`Master Catalog <concept-guide-master-catalog>` is a tree structure that helps organize products into categories. Administrators of the marketplace owner organization manage a single global master catalog, the structure of which is subsequently shared with all sellers. This way, the products that vendors add from their organization are classified based on existing categories. Sellers cannot affect the structure of the global master catalog. Should they need to place products in a category that does not yet exist, they can always reach out to the manager of the global catalog for assistance. Similarly, if the marketplace owner uses a :ref:`web catalog <concept-guide-web-catalog>` to organize products in the storefront, sellers from other organizations cannot affect its structure. It is possible to display products in the storefront by the seller via the web catalog feature. For this, add a condition to a web catalog content variant to filter products by organization attributes of your choice (e.g., name).

.. image:: /user/img/concept-guides/marketplace/sort-by-seller.png
   :alt: Configuring a product collection to display items from specific sellers

By default, all sellers can create new products in their organization. This capability can be :ref:`toggled in the configuration settings of each organization <configuration--commerce--marketplace--seller-organization>`, if necessary.

.. image:: /user/img/concept-guides/marketplace/product-creation-option.png
   :alt: Product Creation option in the organization configuration settings

Sellers manage their own inventory, warehouses, and products, but the global marketplace organization stores all products from all sellers, which makes it possible to browse all existing products on the global storefront website. All products in the storefront display the name of the seller in product listings, product details, shopping lists, and on order pages. This is a feature that a marketplace owner can toggle :ref:`in the global system configuration <configuration--commerce--marketplace--seller-global>` and :ref:`per organization <configuration--commerce--marketplace--seller-organization>`.

.. image:: /user/img/concept-guides/marketplace/seller-name.png
   :alt: Seller's name enabled and displayed in the storefront

You can associate each product with a specific :ref:`product brand <user-guide--product-brands>`. Brands can be managed by the marketplace owner, a seller, or both. Depending on the requirements, permissions to view, create, and edit brands are :ref:`toggled per role <user-guide-user-management-permissions-roles--field-level-acl>`. However, sellers cannot edit or delete brands created in the :ref:`global marketplace organization <user-management-organizations>` from within their respective organizations. Sellers can only see brands created in their organization and the global marketplace organization and cannot view or in any way affect the brands of other sellers. There is no limit to the number of brands that can be created in any given organization.

.. image:: /user/img/concept-guides/marketplace/brands-global-vs-seller.png
   :alt: Brands displayed in the global organization vs seller organization

Pricing Management
------------------

As OroMarketplace has integrated OroCommerce, it has the advantage of using its dynamic pricing engine that automates price configuration and calculation. OroMarketplace pricing functionality enables vendors to quickly set up and customize different price lists for specific customers, customer groups, and websites and build aggregated price lists with any amount of price attributes, tiers, or currencies. Vendors can use the price attribute as a base value for manually or automatically generated price lists.

In OroMarketplace, price lists are managed per organization so that vendors can diversify price offerings by personalizing prices according to specific strategies, customer accounts, order quantities, or other factors.

Orders and Shipping
-------------------

Marketplace owners can configure shipping integrations and shipping rules for all sellers and per seller so proper :ref:`shipping fees are calculated <user-guide--system-configuration--commerce-sales-multi-shipping>` based on seller needs and warehouse data. The default shipping methods are *Fixed Product Shipping Cost* and *Flat Rate Shipping* with 0 value, which are created automatically after seller's registration. Sellers can then adjust the amount as needed.

When a buyer submits an order with items sold by different vendors with different shipping options, their order is split into one parent order and sub-orders in the back-office. Each respective seller receives their portion of the order and is responsible for shipping the items sold to the buyer. The marketplace owner organization has the record of the source parent order containing information about its suborders per seller, line items, payment details, etc.

.. image:: /user/img/concept-guides/marketplace/orders-split-by-sellers.png
   :alt: Orders split by seller in the back-office

For the orders to be split by seller (i.e., organization), a person responsible for permissions from the global marketplace organization's owner must :ref:`enable this capability in the global organization's configuration settings <user-guide--system-configuration--commerce-sales-multi-shipping-org>`.

.. image:: /user/img/concept-guides/marketplace/split-by-seller-config-in-global-org.png
   :alt: Organization Settings of the Global Marketplace Organization

If a seller decides against using multi-shipping and the multi shipping feature is disabled for a seller organization, the marketplace owner must add the seller's warehouse to the list of enabled warehouses in the system configuration, so buyers could proceed through the checkout and place their orders online.

**Related Articles**

* :ref:`Seller Registration Requests <user-guide--sales--seller-registration-requests>`
* :ref:`Seller Registration Workflow <system--workflows--seller-registration-flow>`
* :ref:`Configure Global Seller Name and Registration Settings <configuration--commerce--marketplace--seller-global>`
* :ref:`Configure Seller Name and Registration Settings per Organization <configuration--commerce--marketplace--seller-organization>`
* :ref:`Configure Settings for Product Creation per Organization <configuration--commerce--marketplace--seller-organization>`
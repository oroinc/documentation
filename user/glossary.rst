.. _glossary:

Glossary
========

.. glossary::
   :sorted:
    
   Entity
      A grouping of things with common rules that represent objects of similar nature. For example, orders, customers, addresses, etc.

   Record
      One item of each `entity <Entity>`, such as an address record, a contact record, etc.

   Website
      A website is OroCommerce customer-facing interface (web store).
      OroCommerce Enterprise supports multiple websites (web stores) that are attached to the same store administration and configuration interface (back-office).
      Every website may have unique product lines, localization settings, prices, etc.

   Channel
      A channel represents a source of customers and customer data, for example a specific shop, an outlet, a web-store, etc.

   Account
      An account represents a person, a company or a group of people you do business activities with.
      An account aggregates details of all the customer identities assigned to it, providing for a 360-degree view of the customer activity.

   OroCommerce
      An open-source B2B Commerce solution with built in sales interaction tools for a commerce business.

   OroCRM
      An open-source CRM with built in marketing automation tools for a commerce business.
   
   Customer 
      A system :term:`entity <Entity>`. Customers represent businesses, companies or divisions who buy products using the storefront.

   Customer User
      Customer users are actual people who act on behalf of companies (i.e. customers) and have a limited set of permissions which depend on their role and function in the customer organization.

   Workflow
      A sequence of industrial, administrative of other processes applied to a piece of work  from initiation to
      completion and a system :term:`entity <Entity>` with :term:`records <Record>` that represent such a sequence.
      
   Attribute
      A characteristic of an entity. For example, a zip-code and a street name are attributes of an address.

   Field
      Fields are used to store details of entity records. For example, a *street name*, a *zip code*, and a *building number* may be fields of an *address*. You can add new fields to any :term:`custom entity <Custom Entity>` or an extendable :term:`system entity <System Entity>`.

   Contact
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent actual people contacted in the course of
      sales activities. 

   Tag
      A non-hierarchical keyword assigned to a record. Can be used for filtering.
    
   Custom Entity
      An :term:`entity <Entity>` added to the system by a user from the UI.

   System Entity
      An :term:`entity <Entity>` available in the system out of the box.

   Custom Field
      An :term:`field <Field>` added to an entity by a user from the UI.

   Order
      An order contains information about a buyer's shopping list submitted for purchase and the
      collected information about billing and shipping address, payment method, etc.

   Organization
      A system :term:`entity <Entity>`. The highest level of the system permissions grouping.  Its :term:`records <Record>` represent a group of :term:`users <User>` that belong to the same enterprise, business, commerce or another organization. Different roles and permission settings can be defined for different organization records.

   System Organization
      An :term:`organization <Organization>`, from which a user can (subject to the permissions and access settings) see and process details of records in each and any organization within an Oro application instance.

   User
      User :term:`records <Record>` represent a person, a group of people or a third-party system using the Oro application.
      User's credentials (login and password) identify a unique user and define what part of the system, which
      features and actions will available for them in the system.

   Business Unit
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent group of :term:`users <User>` with
      similar business or administrative tasks/roles.

   Owner
      An :term:`organization <Organization>` or :term:`business unit <Business Unit>`, members whereof can view/process
      the entity records, or a :term:`user <User>`, who can view/process the entity records, subject to the
      access and permission settings.

   Context
      A set of :term:`records <Record>` related to a certain email.

   Lead
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent commercial activity with
      people or businesses that have authority, budget and interest to purchase goods and/or services from you, such
      that probability of the actual sales is not yet high or impossible to define.

   Opportunity
      A system :term:`entity <Entity>`. Its :term:`records <Record>` represent highly probable potential or actual sales to a new or established customer.

   Lifetime Sales Value
      A metric that helps understand the :term:`Customer`. It predicts the potential benefit that the selling organization
       can obtain from a relationship with the customer in the long-term perspective. Lifetime sales value measures the total
       amount of money received from the customer based on orders placed and registered in OroCRM. When calculating a lifetime sales
       value, OroCommerce takes into account an average order amount, purchase frequency, and an average retention period.

   Payment Term
      A Payment Term describes the conditions under which a seller will complete a sale (e.g. the period allowed to a buyer to pay off the amount due).

   Stock keeping unit (SKU)
      An SKU is a machine readable identifier of a product or service that helps inventory an item.

   Grid (Record Table)
      A grid is an aggregated view of all the records within an entity. Each row of a grid is one record and each column is one of the grid properties.

   Dashboard
      Dashboard is a default page you see after you log in. It is an adjustable view that may contain many types of information blocks (widgets), such as today’s calendar, recent calls and emails, quick launchpad, etc. You can have several dashboards that serve different purposes and switch between them.

   Request for Quote
      RFQs are used by sales representatives to assist customers and meet their needs through negotiations on a better price, more convenient quantities of products, or additional services. Once a customer submits a request for quotes in the Oro storefront, it immediately becomes available in the Oro back-office.

   Quote
      A quote is used to negotiate with the customer (e.g. offer better price, more convenient quantities and additional services). A quote may be created in response to a customer request for quote, or as a result of the direct communication with the customer. Once the customer is happy with the offer in the quote and is ready to proceed with their order, they accept the quote.

   Shopping List
      Shopping lists are similar to shopping carts in most online stores. However, shopping lists have additional features. These include the ability to manage multiple shopping lists simultaneously, request quotes from a shopping list, submit orders from a shopping list, create as many shopping lists as needed, via the back-office, you can access any shopping list created in the Oro storefront.

   Sales Territories
      A sales territory is the customer group or geographical area for which an individual sales person or a sales team holds responsibility. Territories can be based on various factors such as geography, industry, product line, the expected revenue, etc.

   Master Catalog
      Master catalog is a tree structure that organizes all the products of your store under corresponding categories. A category combines the products of the same type into groups and helps enforce the unified selling strategy by configuring a special set of product options, visibility, and SEO settings that best fit the resulting product family.

   Simple Product
      Simple products are physical items that exist in a basic, single variation. Their qualifiers, such as color or size, cannot be modified meaning customers cannot select the same product with slightly different characteristics. Simple products have a unique SKU and serve as ‘building blocks’ for configurable products. You can manage the inventory information and the price for a simple product.

   Configurable Product
      A configurable product is an item available in multiple variations. Customers ‘configure’ the product in terms of its color, size or any other applicable parameters according to buying needs. Buyers in the storefront choose from the options provided to ‘configure’ a product according to their needs.

   Product Unit
      Product units represent a measurement system of products or their combinations. All products in OroCommerce must have a product unit assigned to them for the customer users to be able to add items to the shopping list and determine their quantity in the OroCommerce storefront. Product units are also used throughout the system for inventory and pricing control. Each product in OroCommerce can be assigned multiple units with custom pricing added to each particular product unit.

   Product Family
      A product family is a set of the product attributes that are enough to store complete information about the products of a similar type (e.g., TV attributes vs T-shirts attributes). In the product family, attributes are organized into attribute groups that are displayed as titled sections on the OroCommerce storefront.

   Product Attribute
      A product attribute is a special type of custom field in the product details. For product attributes, OroCommerce enables you to manage and group attributes that are unique to a special product family. By adding the product attributes only to the product families they fit, you can limit the product data to the necessary characteristics.

   Price Attribute
      Price attributes are custom parameters, like manufacturer’s suggested retail price (MSRP) or minimum advertised price (MAP), that may be needed as input information for your retail price listed on the website. Price attributes help you extend the product options with any custom value related to the price formation.

   Marketing Lists
      Marketing lists are lists of contacts segmented according to conditions which are defined for the purpose of bulk emailing or telephone outreach.

   Promotion
      Promotions provide discounts for :term:`customer users <Customer User>` in the storefront, enable sellers to apply various discounts to their orders, generate personalized discount coupons, and build a strategic schedule for promotions.

   Landing Page
      Landing page is a marketing tool that generates interest and leads for your sales pipeline and has a distinct call to action with a single focused objective.

   Web Catalog
      Web catalog is a content management tool that helps build personalized custom versions of websites by mixing in category pages, product pages, landing pages and pre-existing system pages in different variations based on the customer account information, their customer group or language preference.

   Product Tax Code
      Product Tax Code is a label that is assigned to a product or product group and indicates the tax obligations and exemptions customers have when they purchase this product. These tax obligations are taken into account when a :term:`customer (user) <Customer User>` submits an order.

   Tax Jurisdiction
      Tax Jurisdiction is a geographical address of the area that is governed by the same tax laws and regulations, and that requires a dedicated set of tax calculation rules in OroCommerce: the tax rates for taxable/tax-exempt types of customers and products.

   Consent
      In compliance with the `GDPR <https://eugdpr.org/>`__ in the EU, OroCommerce provides flexible mechanisms for :ref:`collecting and managing customer consents <user-guide--consents>`. Mandatory consents restrict buyers in the storefront from proceeding to the checkout or creating RFQs, unless they accept these consents. Optional consents do not restrict buyers from working with the application and are usually used to retrieve permissions to send them email newsletters, inform about upcoming sales or seasonal discounts, etc.

   Localization
      Localization is the process of :ref:`translating and adapting a product <doc-user-management-users-configuration-localization>` for a specific country or region. Oro application allows a user to customize the format of date and time, numeric, percent, and monetary values as well as the format of names and addresses.

   Shipping Rule
      Shipping rules enable shipping methods for the provided destinations and set the customized shipping service price by adding a surcharge per service option or globally for all options of the service provider.


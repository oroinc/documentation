User Guide
==========

.. _user-guide--products--master-catalog:
.. .. _config-guide--translations:
.. _user-guide--products--products:
.. _user-guide--sales--requests-for-quote:
.. _user-guide-marketing-lists:
.. _user-guide-reports:

OroCommerce as a B2B eCommerce platform provides a number of self-serve capabilities, mature buyer-seller interaction processes (e.g. for placing orders, sharing pricing information, requesting quotes, and submitting proposals), and may be easily used as a B2B Marketplace that connects a wide range of suppliers with multiple buyers. Buyers may get multiple offers and bids across various goods and services.

OroCommerce provides corporate accounts, multiple organizations, websites and stores, high-performance content management system (CMS) with product, :ref:`inventory <user-guide--inventory>` and :ref:`warehouse <user-guide--inventory--warehouses--view>` management, personalized :ref:`web catalog management <user-guide--web-catalog>`.

.. `product <./products/products>`_
.. , multiple and customized `price lists <./sales/price-lists>`_ for your sales organization and multiple `shopping lists <./sales/shopping-lists>`_ for your buyer's organization.

.. contents:: :local:

Core Features
-------------

* `Corporate Accounts <./customers>`_: Manage complex, hierarchical corporate account structures via the seller admin console. Buyers can also configure their own corporate account structure, add authorized users, and create purchasing rules regardless of whether your account structure has multiple businesses, teams, departments, offices, or branches.
* **Access Controls, Roles & Permissions**: Providing the correct user the right access to the right information is a crucial capability. Both sellers and authorized buyers can manage access levels to information, like specific price lists and product catalogs, for both user groups or individual users.

.. * `Access Controls <./../admin-guide/access_management>`_, `Roles & Permissions <./../admin-guide/user_management/roles>`_: Providing the correct user the right access to the right information is a crucial capability. Both sellers and authorized buyers can manage access levels to information, like specific price lists and product catalogs, for both user groups or individual users.

.. `Websites <./system/websites>`_ &

* Multiple `Organizations <./customers>`_, Websites and :ref:`Stores <user-guide--web-catalog>`: Many businesses manage multinational brands that operate across various countries, currencies, and tax regulations. OroCommerce Enterprise Edition comes out-of-the-box with flexible and robust multi-website management capabilities which allows organizations to easily orchestrate multiple businesses from one central admin console.
* :ref:`Content Management System <user-guide--web-catalog>`: Native CMS capabilities allow marketers and merchandise managers to manage robust digital media-enabled catalogs and rich product information pages providing buyers with the information they need to make purchasing decisions. In addition, OroCommerce’s theme is designed with an intuitive, user-friendly front-end which allows buyers to easily find the information and products they need.

* :ref:`Personalized Catalog Management <user-guide--web-catalog>`: Versatile catalog management capabilities allow B2B sellers to customize product catalogs to specific corporations, divisions, business units, and even individual buyers or customers. Each group has access to its own catalog where purchasing managers are able to view its content and purchase products.
* **Multiple & Customized Price Lists**: Create and manage multiple customized price lists for each customer, company, or business unit based on the negotiated contracts. Each price list can contain an unlimited number of price points, various tiers, and different currencies.

.. * `Multiple & Customized Price Lists <./sales/price-lists/index>`_: Create and manage multiple customized price lists for each customer, company, or business unit based on the negotiated contracts. Each price list can contain an unlimited number of price points, various tiers, and different currencies.

* **Multiple Shopping Lists**: Corporate buyers working on multiple projects, such as trade show displays, printed materials, or product/equipment for different business units, can manage and save multiple shopping lists in OroCommerce. This allows buyers to save shopping lists for future use and quickly purchase previously saved shopping lists.

.. * `Multiple Shopping Lists <./sales/shopping-lists>`_: Corporate buyers working on multiple projects, such as trade show displays, printed materials, or product/equipment for different business units, can manage and save multiple shopping lists in OroCommerce. This allows buyers to save shopping lists for future use and quickly purchase previously saved shopping lists.

* **Streamline Buyer-Seller Interaction**: OroCommerce improves buyer-seller interactions by providing buyers an easy way to create and submit order forms, purchase orders, RFQs, and more. Sellers are then able to easily respond to orders & quote requests on the same platform thus facilitating an efficient negotiation process between the buyer and the seller.

.. * `Streamline Buyer-Seller Interaction <./sales>`_: OroCommerce improves buyer-seller interactions by providing buyers an easy way to create and submit order forms, purchase orders, RFQs, and more. Sellers are then able to easily respond to orders & quote requests on the same platform thus facilitating an efficient negotiation process between the buyer and the seller.

.. * `Segmentation & Custom Reports <./reports-and-segments>`_: The robust dashboard and reporting engine along with advanced segmentation capabilities allow sellers to gain actionable insight to their data. Leverage OroCommerce’s segmentation and reporting engine to track key business KPIs, understand customer’s purchasing patterns, and send timely, targeted marketing campaigns.

* **Segmentation & Custom Reports**: The robust dashboard and reporting engine along with advanced segmentation capabilities allow sellers to gain actionable insight to their data. Leverage OroCommerce’s segmentation and reporting engine to track key business KPIs, understand customer’s purchasing patterns, and send timely, targeted marketing campaigns.


* **Flexible Workflow Engine**: Create an unlimited number of custom eCommerce workflows to support both buyer and seller-related processes. The flexible workflow engine allows sellers to customize workflows like the checkout experience or order submission process. Automatic alerts can also be set to trigger when orders reach a certain value but haven’t been purchased.

Community Edition vs Enterprise Edition
---------------------------------------

The key differences between CE and EE is the application’s enhanced performance scalability, extended functional capabilities and customer support.

On top of the features available in OroCommerce CE, OroCommerce EE provides:

* Big data processing with PostgreSQL database.
* Big data search with ElasticSearch.
* Integration with RabbitMQ to handle large amounts of job queues.
* Multiple organizations support.
* Multiple websites support.
* Multiple currencies support.
* Support for inventory management across multiple warehouses.
* OroCRM capabilities integrated into OroCommerce interface.

Orientation in the OroCommerce User Guide
-----------------------------------------

For detailed information on using OroCommerce CE and EE, please see the following topics:

* :ref:`Navigation and using OroCommerce UI <user-guide--getting-started>`

.. * Managing master catalog, `product details <./products>`_, and price attributes <./products-misc/price-attributes>`_

.. `master catalog <./products-master-catalog>`_
.. * `Managing master catalog, product details, and price attributes <./products>`_

* :ref:`Managing inventory and product availability in the warehouses <user-guide--inventory>`

.. * `Managing product prices <./sales/price-lists>`_

* `Managing customers, their subsidiaries and users <./customers>`_

.. * `Handling customer quotes <./sales/quotes>`_, `customer requests for quote <./sales/requests-for-quote>`_

.. * Configuring `payment <./sales/payment>`_ and `shipping <./sales/shipping>`_ options available to the csutomer users during checkout.

* Using marketing tools: :ref:`custom web catalog <user-guide--web-catalog>` and :ref:`landing pages <user-guide--landing-pages>`.

.. , and `customer login pages <./marketing-customer-login-pages>`_

* `Controlling tax rates that are included in the customer order <./taxes>`_

.. note:: Depending on your role in OroCommerce and custom system permissions, the available information and actions may vary.

OroCommerce Sandbox
-------------------

You can use the `OroCommerce Online Demo <https://www.orocommerce.com/demo>`_ to try out the interactions described in this guide.

Table of Contents
-----------------

.. toctree::
   :titlesonly:
   :maxdepth: 1

   getting_started/index

   inventory/index

   customers/index

   quotes/index

   orders/index

   payment/index

   shipping/index

   marketing_web_catalog/index

   marketing_landing_pages/index

   taxes/index

   segments/index

   system/index

..   install/index


.. comment
   # Quick Start
   # -----------
   # 
   # * You are :ref:`starting a new B2B Commerce project <   # orocommerce-user-guide-starting>`, and plan to sell products and    # services to multiple business customers.
   # 
   # For the role-based information, please see the following sections on    # using OroCommerce as a...:
   # 
   # * `Business owner </guides-by-role/business-owner-guide>`_
   # * `Buyer </guides-by-role/buyer-guide>`_
   # * `Sales person </guides-by-role/sales-guide>`_
   # * `Organization administrator </guides-by-role/org-admin-guide>`_
   # * `Catalog manager </guides-by-role/catalog-manager-guide>`_
   # * `System administrator </admin-guide>`_
   # * `System comfiguration manager </guides-by-role/config-guide>`_

.. comment
   #Starting a new B2B commerce project
   #-----------------------------------
   #
   #**WORK IN PROGRESS**
   #
   #You need a complete transparency of your services for your customers, easily controlled sales and marketing process for your employees, and access to statistics and retrospective data for leadership and management team. You might start with the following:
   #
   #* Request a demo (more info)
   #* Get a demo instance in Oro Cloud to try using OroCommerce without a hassle of complete configuration and setup. On your request, the demo instance may be installed with the demo data that reveals most of the functionality and provides the best learning experience for the new users.
   #* Make your mind about having an on-premise deployment vs OroCommerce in a Cloud. 
   #* Review a getting started section that explains basic configuration and data you'll need to start your B2B sells online.
   #* Plan your B2B Commerce rollover. Get more information about :ref:`using OroCommerce for Enterprize sales processes <orocommerce-user-guide-as-an-enterprise>` or about :ref:`using OroCommerce as a small and middle-size business owner <orocommerce-user-guide-as-a-business-owner>`).
   #
   #.. _orocommerce-user-guide-as-an-enterprise:
   #
   #Using OroCommerce for Enterprise sales processes
   #------------------------------------------------
   #
   #**WORK IN PROGRESS**
   #
   #* It should scale
   #* More distributed decisions, approval processes, more granular set up (more websites, locales, etc.).


.. COMMENT -------------------------------------- This text is in the User Guide body
    * Installation
      * On Premise deployment
        * Obtain the application
        * System requirements
        * Installation wizard
      * OroCloud
        * Installation wizard / Initial configuration
          
    * Getting started
        * Navigation
        * Roles and permissions
        * Initial configuration
        * Quick start for...
            * Sales manager
            * Commerce manager
            * Oro Commerce administrator
              
    * Manage your product catalog
      * Product information management
      * Product media (images)
      * Product attributes
        * Attribute Sets
        * Price attributes
      * Units of quantity
      * Master catalog
      * Export/import product data
      * Product variants
      * Custom personalized catalogs
      * Web categories
      * Landing pages & embedding product info & add to card
      * Product visibility
        
    * Inventory                              DONE =============
      * Overview                             DONE =============
      * Configuration options                DONE =============
      * Product-level configuration          DONE =============
      * Working with multiple warehouses     DONE =============
      * Export/import inventory              DONE =============
        
    * Pricing
      * Overview
      * Configure prices for a website, customer group, customer
      * Scheduling
      * Export/import
      * Price attributes
      * Rule-based configuration
      * Assignment rules
      * Calculation rules
      * Working with multiple currencies
      * Price list ownership
      * Internal price lists
        
    * Customers                              DONE =============
      * Customer accounts                    DONE =============
      * Managing users                       DONE =============
      * Roles and permissions                DONE =============
      * Account hierarchy                    DONE =============
      * Customer groups                      DONE =============
      * Delegate account management to customers   DONE =============
        
    * Quotes & Proposals
      * RFQs
        * RFQs in general + notifications
        * Default RFQ workflows (management console + store frontend)
        * Customize RFQ submission form
        * Processing RFQs, creating quotes (proposals)
          * Working with line items, etc.
        * Quote shipping
        * Quote payment term
        * Quote discounts
          
    * Order Management
      * Editing an order
      * Default order workflow (management console)
      * Default order workflow (store frontend)
      * Create an order
      * Customizing the checkout experience
        * Address books and permissions
        * Checkout workflow
        * Payment “tricks”
        * Shipping “tricks”
      * Export orders
      * Shipping tracking
        
    * Payment
      * Enabling payment methods
      * Configure payment rules
      * Payment terms
      * Payment methods:
        * Payment terms
        * PayPal Payments Pro
        * PayPal PayFlow Gateway
        * Check/Money Order
        * COD
        * Bank wire transfer
          
    * Shipping
      * Enabling shipping methods
      * Configure shipping rules
      * Product shipping attributes
      * Shipping methods:
        * Flat Rate
        * Table Rates
        * UPS
        * FedEx
        * USPS
        * ...
          
    * Marketing
      * Landing pages
      * Content blocks
      * Banners
      * Homepage
      * Promotions
        
    * Taxes                               DONE =============
      * USA
      * Canada
      * European Union
      * Great Britain
      * Australia
      * Other counties (“get in touch with us” or refer to the partner listing page)
        
    * Support
      * Online documentation, feature videos
      * On-demand training
      * How to contact us
      * Refer to partners page
      * OroCloud customers ------------------------------------- End of User Guide body

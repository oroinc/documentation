User Guide: Commerce
====================

.. _user-guide:
.. _user-guide--products--master-catalog:
.. config-guide--translations
.. _user-guide--products--products:
.. _user-guide-marketing-lists:

OroCommerce as a B2B eCommerce platform provides a number of self-serve capabilities, mature buyer-seller interaction processes (e.g. for placing orders, sharing pricing information, requesting quotes, and submitting proposals), and may be easily used as a B2B Marketplace that connects a wide range of suppliers with multiple buyers. Buyers may get multiple offers and bids across various goods and services.

OroCommerce provides corporate accounts, multiple organizations, websites and stores, high-performance content management system (CMS) with product, :ref:`inventory <user-guide--inventory>` and :ref:`warehouse <user-guide--inventory--warehouses--view>` management, personalized :ref:`web catalog management <user-guide--web-catalog>`.

.. multiple and customized `price lists <./sales/price-lists>`_ for your sales organization and multiple `shopping lists <./sales/shopping-lists>`_ for your buyer's organization.

.. contents:: :local:

.. include:: /getting_started/core_features.rst
   :start-after: begin_core_features
   :end-before: finish_core_features

Community Edition vs Enterprise Edition
---------------------------------------

.. include:: /getting_started/community_vs_enterprise.rst
   :start-after: begin_editions
   :end-before: finish_editions

Orientation in the OroCommerce User Guide
-----------------------------------------

For detailed information on using OroCommerce CE and EE, please see the following topics:

* :ref:`Navigation and using OroCommerce UI <user-guide--getting-started>`

.. Managing master catalog, `product details <./products>`_, and price attributes <./products-misc/price-attributes>`_

.. master catalog <./products-master-catalog>`_
.. Managing master catalog, product details, and price attributes <./products>`_

* :ref:`Managing inventory and product availability in the warehouses <user-guide--inventory>`

.. Managing product prices <./sales/price-lists>`_

* `Managing customers, their subsidiaries and users <./customers>`_

.. Handling customer quotes <./sales/quotes>`_, `customer requests for quote <./sales/requests-for-quote>`_

.. Configuring `payment <./sales/payment>`_ and `shipping <./sales/shipping>`_ options available to the csutomer users during checkout.

* Using marketing tools: :ref:`custom web catalog <user-guide--web-catalog>` and :ref:`landing pages <user-guide--landing-pages>`.

.. and `customer login pages <./marketing-customer-login-pages>`_

* `Controlling tax rates that are included in the customer order <./taxes>`_

.. note:: Depending on your role in OroCommerce and custom system permissions, the available information and actions may vary.

OroCommerce Sandbox
-------------------

You can use the `OroCommerce Online Demo <https://www.oroinc.com/orocommerce/demo>`_ to try out the interactions described in this guide.

Table of Contents
-----------------

.. toctree::
   :includehidden:
   :titlesonly:
   :maxdepth: 1

   products/index

   price_attributes/index

   product_attributes/index

   product_families/index

   master_catalog/index

   inventory/index

   pricing/index

   customers/index

   quotes/index

   rfq/index

   shopping_lists/index

   orders/index  

   shipping/index

   marketing_web_catalog/index

   marketing_landing_pages/index

   marketing_promotions/index

   marketing_coupons/index

   marketing_content_blocks/index

   taxes/index
 
   consents/index

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
            * OroCommerce administrator
              
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
        * Default RFQ workflows (management console + storefront)
        * Customize RFQ submission form
        * Processing RFQs, creating quotes (proposals)
          * Working with line items, etc.
        * Quote shipping
        * Quote payment term
        * Quote discounts
          
    * Order Management
      * Editing an order
      * Default order workflow (management console)
      * Default order workflow (storefront)
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

.. _user-guide-sales-product-prices-debug:

Price Calculation Details
=========================

.. note:: The Price Calculation Details feature is available in OroCommerce as of version 5.1.6.

The pricing engine includes various features such as price schedules and rule-based generated prices. Price lists can be assigned to different entities and then merged by the pricing strategy. The combination of these features can lead to additional complexity, making it difficult to understand how prices for a particular product are created, what the current prices are for a given customer and website, and what the prices will be for a specific date.

The Price Calculation Details feature helps obtain information about:

- Current combined product prices for a specific website/customer
- The current pricing strategy
- How price lists were combined and which prices fit the current combination strategy
- List of price lists included in the resulting combined price list
- Information about activation dates and the current status of a particular price list
- Information about price lists assigned at different levels (customer, customer group, website, and config), included in the Price List Assignment section hidden by default.
- Information about the full combined price list ID (Full CPL) and active combined price list (Active CPL), included in the Information for Developers section
- Information about combined price list activation rules, included in the Information for Developers section if there are scheduled price lists

Price Calculation Details Start Page
------------------------------------

Admin users with enabled Price Calculation Details :ref:`ACL permission <admin-capabilities>` can access the Price Calculation Details section under the Sales menu.

.. image:: /user/img/sales/prices-debug/prices-debug-ACL.png
   :alt: Illustration of the permission that enables Pricing Debug Menu

On the first page of Price Calculation Details, you will find a list of all available products and their combined price information. This page displays both the website and customer prices and allows you to hide certain currencies and tier prices.

.. image:: /user/img/sales/prices-debug/product-price-debug-page.png
   :alt: Illustration of Price Calculation Details Page

If you click on a row representing a product, you can view detailed information regarding the pricing of the product you selected.

Price Calculation Details Product Page
--------------------------------------

The Price Calculation Details Product Page provides comprehensive information about the prices of a selected product. The page consists of two main sections, General and Price Merge Details. You can view additional information by selecting the **Show Price List Assignment** and **Show Information for Developers** checkboxes in the sidebar.

.. image:: /user/img/sales/prices-debug/sidebar.png
   :align: center
   :alt: Sidebar

General Section
^^^^^^^^^^^^^^^

The General section contains a link to the product, information about the current pricing strategy, and the current merged prices stored in the pricing storage.

.. image:: /user/img/sales/prices-debug/general-section.png
   :alt: General section

Price Merge Details Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Price Merge Details section contains information about the price lists used to create the combined price list, the current price list status, and the activation schedule, if any. Each row contains product prices in the corresponding price list. Prices that match the current pricing strategy are highlighted in bold. This section lets you know which prices you have for the product and which are selected by the pricing strategy. if the current combined prices do not match the prices highlighted in the Price Merge Details section it could mean that a price import is in progress and the merging is not yet finished. If the prices do not match, the Recalculate Prices action is displayed, which you can use to schedule the price update.

.. image:: /user/img/sales/prices-debug/price-merge-details-section.png
   :alt: Price Merge Details section with opened schedules tooltip

Price List Assignment Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This section tells you which price lists are assigned to Customer, Customer Group, Website, and Config, and what the fallbacks are. Assignment levels are shown in relation to the configured fallback. For example, if Customer has a fallback to Customer Group and Customer Group has a fallback set to Current Customer Group only, then only Customer and Customer Group levels will be shown.

.. image:: /user/img/sales/prices-debug/customer_price_lists_assignment_info.png
   :alt: Customer Price Lists Assignment Info section

Information for Developers
^^^^^^^^^^^^^^^^^^^^^^^^^^

The Information for Developers section contains information about Active CPL ID. Active CPL is a combined price list that consists of active price lists and is currently active. If the Full CPL differs from Active CPL, the Full CPL ID will also be displayed.

Some assignment levels may have assigned price lists that are not currently active. The complete list of assigned price lists defines Full CPL. Full CPL is used to identify the combined price list activation rules and supports the ability to switch to the required Active CPL.

.. image:: /user/img/sales/prices-debug/developer_info_section_without_schedules.png
   :alt: Developers Info section without schedules

If a Full CPL Price Lists or Combined Price List Activation Rules are available, information about price lists included in the Full CPL Price Lists and information about combined price list activation rules data is also displayed.

.. image:: /user/img/sales/prices-debug/full-chain-CPL-activation-rules.png
   :alt: Developers Info section with schedules, full chain CPL and activation rules

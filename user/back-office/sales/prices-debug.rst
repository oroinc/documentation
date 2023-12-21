.. _user-guide-sales-product-prices-debug:

Product Prices Debug
====================

The pricing engine includes various features such as price schedules and rule-based generated prices. Price lists can be assigned to different entities and then merged by the pricing strategy. The combination of these features can lead to additional complexity, making it difficult to understand how prices for a particular product are created, what the current prices are for a given customer and website, and what the prices will be for a specific date.

The Product Prices Debug feature helps obtain information about:

- Current combined product prices for a specific website/customer
- The current pricing strategy
- How price lists were combined and which prices fit the current combination strategy
- List of price lists included in the resulting combined price list
- Information about activation dates and the current status of a particular price list in the chain
- Aggregated information about price lists assigned at different levels: customer, customer group, website, and config (included in the Customer Price Lists Assignment Info section, which is hidden by default)
- Low-level information about the full chain combined price list ID and active combined price list chain (included in the Developer Info section)
- Low-level information about combined price list activation rules (included in the Developer Info section if there are scheduled price lists in the chain)

Product Prices Debug Start Page
-------------------------------

Admin users with enabled Debug Prices :ref:`ACL permission <admin-capabilities>` can access Product Prices Debug under the Sales menu.

.. image:: /user/img/sales/prices-debug/prices-debug-ACL.png
   :alt: Illustration of the permission that enables Pricing Debug Menu

On the first page of Product Prices Debug, you will find a list of all available products and their combined price information. This page displays both the website and customer prices and allows you to hide certain currencies and tier prices.

.. image:: /user/img/sales/prices-debug/product-price-debug-page.png
   :alt: Illustration of Product Prices Debug Page

If you click on a row representing a product, you can view detailed information regarding the pricing of the product you selected.

Product Prices Debug Product Page
---------------------------------

The Product Prices Debug Product Page provides comprehensive information about the prices of a selected product. The page consists of two main sections, General and Price Merge Details. You can view additional information by checking the checkboxes on the sidebar to enable Customer Price Lists Assignment Info and Developers Info. These checkboxes are labeled **Show Detailed Assignment Info** and **Show Developers Info**.

.. image:: /user/img/sales/prices-debug/sidebar.png
   :align: center
   :alt: Sidebar

General Section
^^^^^^^^^^^^^^^

The General section includes a link to the product, information about the current pricing strategy, and the current merged prices stored in the pricing store.

.. image:: /user/img/sales/prices-debug/general-section.png
   :alt: General section

Price Merge Details Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Price Merge Details section contains information about the price lists used to create the combined price list, the current price list status, and the activation schedule, if any. Each row contains product prices in the corresponding price list. Prices that match the current pricing strategy are highlighted in bold. This section lets you know which prices you have for the product and which are selected by the pricing strategy. If the current merged prices and the prices highlighted in the Price Merge Details section do not match, it means that, for some reason, the current persistent pricing store does not contain the expected prices. Such a situation can occur when a large price import is in progress, and the merging process is not yet complete. If the prices do not match, the Actualize Prices action is displayed, which you can use to schedule the price update.

.. image:: /user/img/sales/prices-debug/price-merge-details-section.png
   :alt: Price Merge Details section with opened schedules tooltip

Customer Price Lists Assignment Info Section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The Customer Price Lists Assignment Info section contains information about the price lists assigned to a certain level. This section tells you which price lists are assigned to Customer, Customer Group, Website, and Config, and what the fallbacks are. Assignment levels are shown in relation to the configured fallback. For example, if Customer has a fallback to Customer Group and Customer Group has a fallback set to Current Customer Group only, then only Customer and Customer Group levels will be shown.

.. image:: /user/img/sales/prices-debug/customer_price_lists_assignment_info.png
   :alt: Customer Price Lists Assignment Info section

For the Merge By Priority Pricing strategy, the table of assigned price lists contains additional columns with important information for this strategy.

Developer Info Section
^^^^^^^^^^^^^^^^^^^^^^

The Developer Info section contains information about Active CPL ID. If the Full Chain CPL differs from Active CPL, the Full Chain CPL ID will also be shown in this section. Active CPL is a combined price list that consists of active price lists and is currently active.
Some assignment levels may have assigned price lists that are not currently active. The complete list of assigned price lists defines Full Chain CPL. Full Chain CPL is used to identify the combined price list activation rules and supports the ability to switch to the required Active CPL.

.. image:: /user/img/sales/prices-debug/developer_info_section_without_schedules.png
   :alt: Developers Info section without schedules

This section also contains helpful information about price lists included in the Active CPL Price Lists Chain. If a Full Chain CPL Price Lists Chain or Combined Price List Activation Rules are available, information about price lists included in the Full Chain CPL Price Lists Chain and information about combined price list activation rules data is also displayed.

.. image:: /user/img/sales/prices-debug/full-chain-CPL-activation-rules.png
   :alt: Developers Info section with schedules, full chain CPL and activation rules

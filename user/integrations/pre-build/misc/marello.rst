.. _integrations-mics-marello:

Integration with Marello
========================

.. hint:: Please |contact our support team| for more information on available integration options, or check out our |extensions store|.

Oro offers integration with Marello, an open-source order management system built on the OroPlatform. The integration allows business owners to utilize their OroCommerce online store as a SalesChannel within Marello (Enterprise). As Marello is built on the OroPlatform, all its features can work within the same user interface.

.. image:: /user/img/integrations/marello_orocommerce_integration_configuration_screen.png
   :alt: Marello integration settings in the OroCommerce back-office

Integration Benefits
--------------------

* **Seamless Omni-Channel Experience:** The integration facilitates a seamless omni-channel customer experience, ensuring consistency and efficiency across various sales channels.
* **Centralized Order Management:** Business owners can manage orders centrally, streamlining the order lifecycle from creation to fulfillment.
* **Return and Refund Management:** The integration supports effective handling of product returns and refund processes.
* **Real-Time Inventory Level Tracking:** Keep track of inventory levels in real time, preventing overselling and optimizing stock management.
* **Fulfillment from Multiple Warehouses:** Efficiently manage fulfillment operations by coordinating from multiple warehouses.
* **In-Store Fulfillment:** Enable customers to choose from options like shipping, in-store pickup, and return to the store, enhancing flexibility and convenience.
* **Procurement:** Generate purchase orders with preferred suppliers, optimizing the procurement process.
* **Comprehensive Business Intelligence:** Gain valuable insights through comprehensive business intelligence tools, aiding in data-driven decision-making.

Setup Options
-------------

The integration between Marello (Enterprise) and OroCommerce (Enterprise) can be configured in either a single-instance setup (where Marello and OroCommerce are installed together) or a multiple-instance setup (where they are installed on separate servers). The integration employs the OroCommerce API for synchronization, allowing flexibility in deployment.

Single Instance Setup
^^^^^^^^^^^^^^^^^^^^^

In a single instance setup, all required components and applications are installed on the same server, sharing the code base and database. Despite this shared installation, the integration operates through API calls on OroCommerce. This means that the URL (admin URL) needed for configuration remains the same as where the application runs. The setup is illustrated in the diagram below.

.. image:: /user/img/integrations/Marello-OroCommerce-Single-Instance-overview.png
   :align: center
   :alt: Diagram of Marello-OroCommerce Single Instance Overview

Multiple Instance Setup
^^^^^^^^^^^^^^^^^^^^^^^

The integration can function seamlessly in a multi-instance setup as it communicates via the API of OroCommerce, whether the applications are installed together or separately. A high-level perspective of the multi-instance setup is depicted in the diagram below, with components drawn in their respective instances.

.. image:: /user/img/integrations/Marello-OroCommerce-Multi-Instance-overview.png
   :alt: Diagram of Marello-OroCommerce Multiple Instance Setup

Synchronized Entities
---------------------

Business owners can synchronize various entities between Marello and OroCommerce, including:

* Orders
* Products
* Product images
* Product prices
* Inventory
* Tax-related entities (TaxRules, TaxCodes, and Tax Jurisdictions).

Components for Integration
--------------------------

MarelloOroCommerce Bridge and Bundle
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This package provides the necessary integration services and code. It includes administrative cleanup, clarification of the Admin Navigation, and clarification of widgets in the Admin Dashboard. However, it does not extend the OroCommerce API or disable order notification emails.

MarelloOroCommerce API Bridge
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

This component offers the required code and configuration to extend the OroCommerce (1.5.x) API endpoints. It facilitates tax-related entity creation, updates the Order and Payment status in OroCommerce, and disables Order notification emails sent through OroCommerce (handled by Marello). This bridge is crucial for proper integration, and its absence may lead to disappointment in the integration's functionality.

.. include:: /include/include-links-user.rst
   :start-after: begin
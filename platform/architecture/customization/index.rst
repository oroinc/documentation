.. _architecture--customization--customize:

Oro Application Customization
=============================

No two businesses are alike. Once a company acquires a new tool, it usually needs to adapt it to the existing use cases, blueprints, and best practices. Luckily, companies may easily adjust Oro application to the existing business process and facilitate data logistics, for example:

* **Enable control over the custom data flow to and from Oro application**
  *Example:* A product catalog for the B2B storefront is populated with the data from the existing ERP system, and the purchases statistics provided by the Oro application fuels the ERP reporting engine.

* **Process custom domain-specific data (via the enhanced structure, like custom attributes and relationships, and advanced workflows)**
  *Example:* A checkout process may involve collaboration with more than one party, e.g. a legal and financial department review, and may require status confirmation from an external system, for example, customer ERP service with any approvals or details on behalf of the customer.

* **Synchronize data with an external system**
  *Examples:*

  * Orders created via Oro application should be synchronized into an external system for shipping processing, and a shipping tracking number should be reported back to Oro application.
  * Import and export via CSV files may be adjusted or enabled for the existing Oro features.
  * Information from external systems may be used for adjusting to the existing pricing policies and strategies.

* **Substitute features of the Oro application with similar operations that are already fulfilled by the third party systems**
  *Example:* A company may replace customer registration in Oro application with the integrated service they already use (using embedded forms or via data synchronization)

* **Enhance or adjust existing features to support custom processes**
  *Examples:*

  * Quotes may be modified to act as temporary orders that sales representatives create on behalf of the customers.
  * Related items functionality may be adapted to display additional information (e.g. cross-sales) in a buyer’s shopping list.

* **Customize the design of Oro application components (e.g. storefront, email notifications, etc.)**
  *Examples:*

  * Restructure page layouts and create new pages
  * Adjust website style to the brand identity (colors, fonts, etc.)
  * Change templates of email notifications (add corporate headers and footers, etc.)

.. include:: /architecture/customization/how_to_customize.rst
   :start-after: begin_architecture_customization_how_to_customize
   :end-before: finish_architecture_customization_how_to_customize

.. finish_architecture_customization_index

.. .. toctree::
   :includehidden:
   :maxdepth: 2

..   how_to_customize
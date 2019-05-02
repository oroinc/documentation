|IcSystem| System
=================

The **System** menu of the management console contains post-install configuration settings of your Oro application. This is the starting point for setting up your application, from application display settings to payment integrations. Before proceeding with application configuration, please review the topics listed below to get a full understanding of general and domain-specific settings, and available configuration levels.

.. image:: /img/system/configuration/system_menu.png
   :alt: System menu

* :ref:`Configuration <mc-system-configuration>` --- Manage system settings and settings specific for CRM, Commerce and marketing features.
* :ref:`User Management <>` --- Configure user, role and access management in the application and determine levels of access to data.
* :ref:`Contact Reasons <>` --- Manage contact reasons used to categorize contact requests submitted through your website.
* :ref:`Contact Groups <>` --- Create and manage contact groups.
* :ref:`Emails <>` --- Create and manage templates, notification rules and maintenance notifications.
* :ref:`Integrations <>` --- Create and manage pre-implemented integrations and integrations with third-party systems.
* :ref:`Channels <>` --- Create and manage multiple web and sales channels to aggregate data from different data sources.
* :ref:`Jobs <>` --- Monitor tasks executed in the background.
* :ref:`Data Audit <>` --- See the full history of changes made to any record of an auditable entity.
* :ref:`Scheduled Tasks <>` --- View recurring tasks executed on schedule.
* :ref:`Entities <>` --- Create and manage entities and entity fields.
* :ref:`Tags Management <>` --- Create tags and taxonomies to organize data in the application.
* :ref:`Menus <>` --- Customize default management console menus.
* :ref:`Frontend Menus <>` --- Configure default storefront menus.
* :ref:`System Calendars <>` --- Create system and organization calendars and add events to them.
* :ref:`Shipping Rules <>` --- Add shipping rules to bind customers to specific shipping prices based on the shipping locations and the products they purchase.
* :ref:`Payment Rules <>` ---  Add payment rules to make payment options visible to buyers in the storefront.
* :ref:`Workflows <mc-system-wf>` --- Use system workflows and create custom workflows.
* :ref:`Processes <>` --- View and activate/deactivate processes in the application.
* :ref:`System Information <>` --- Review system information on oro and third-party packages.
* :ref:`Consent Management <>` --- Create and manage consents to comply with General Data Protection Regulations.
* :ref:`Websites <>` --- Create multiple individually configured websites in the same application instance.
* :ref:`Localization <>` --- Translate and adapt products for a specific country or region.

Oro applications enable you to configure system settings on four configuration levels (or scopes): system, organization, website and user.

* **Global**: To set up and manage settings globally, navigate to :ref:`System > Configuration <>` in the main menu, and locate the options you need to configure in the panel to the left.
* **Organization**: To configure settings per organization, navigate to :ref:`System > User Management > Organizations <>`, and select the one that you wish to toggle the options for. Hover over the ellipsis menu to the right of the necessary organization and click *Configuration* to start editing it. Organization settings can fall back to system (or global) settings. Clearing the Use System check box next to the required option and changing its value means that you are configuring this option specifically for the selected organization.
* **Website**: To configure settings per website, navigate to :ref:`System > Websites <>`, hover over the ellipsis menu to the right of the necessary website, and click *Configuration*. Similarly to the configuration per organization, clear the Use System check box next to the required option, and change the default value to introduce changes at website level.
* **User**: To configure settings per user, navigate to :ref:`System > User Management > Users <>`, hover over the ellipsis menu to the right of the necessary user, and click *Configuration*. When Use Organization check box is enabled, organization settings override the global ones.  Clear the Use Organization check box next to the required option, and change the default value to introduce changes at user level.

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :titlesonly:
   :hidden:

   configuration/index
   user_management/index
   integrations/index
   workflows/index
   websites/index


:oro_documentation_types: OroCRM, OroCommerce

:title: System Configuration Management in the OroCommerce and OroCRM Back-Office

.. meta::
   :description: Extensive manuals on the OroCommerce and OroCRM back-office system configuration

Manage System Settings in the Back-Office
=========================================

The **System** menu of the back-office contains post-install configuration settings of your Oro application. This is the starting point for setting up your application, from application display settings to payment integrations. Before proceeding with application configuration, please review the topics listed below to get a full understanding of general and domain-specific settings, and available configuration levels.

.. image:: /user/img/system/configuration/system_menu.png
   :alt: System menu

* :ref:`Configuration <mc-system-configuration>` --- Manage system settings and settings specific for CRM, Commerce and marketing features.
* :ref:`User Management <user-guide-user-management>` --- Configure user, role and access management in the application and determine levels of access to data.
* :ref:`Storefront OAuth Applications <storefront-oauth-app>` --- Create and manage all available OAuth applications for customer users.
* :ref:`Contact Reasons <admin-guide-contact-reasons>` --- Manage contact reasons used to categorize contact requests submitted through your website.
* :ref:`Contact Groups <contact_groups>` --- Create and manage contact groups.
* :ref:`Emails <admin-guide-email-configuration>` --- Create and manage templates, notification rules and maintenance notifications.
* :ref:`Integrations <user-guide-integrations>` --- Create and manage pre-implemented integrations and integrations with third-party systems.
* :ref:`Channels <user-guide-channels>` --- Create and manage multiple web and sales channels to aggregate data from different data sources.
* :ref:`Jobs <book-job-execution>` --- Monitor tasks executed in the background.
* :ref:`Data Audit <user-guide-data-audit>` --- See the full history of changes made to any record of an auditable entity.
* :ref:`Scheduled Tasks <book-time-based-command-execution>` --- View recurring tasks executed on schedule.
* :ref:`Entities <doc-entities>` --- Create and manage entities and entity fields.
* :ref:`Tags Management <admin-guide-tag-management>` --- Create tags and taxonomies to organize data in the application.
* :ref:`Menus <doc-config-menus>` --- Customize default back-office menus.
* :ref:`Frontend Menus <backend-frontend-menus>` --- Configure default storefront menus.
* :ref:`System Calendars <user-guide-calendars>` --- Create system and organization calendars and add events to them.
* :ref:`Shipping Rules <sys--shipping-rules>` --- Add shipping rules to bind customers to specific shipping prices based on the shipping locations and the products they purchase.
* :ref:`Payment Rules <sys--payment-rules>` ---  Add payment rules to make payment options visible to buyers in the storefront.
* :ref:`Workflows <mc-system-wf>` --- Use system workflows and create custom workflows.
* :ref:`Processes <user-guide-processes>` --- View and activate/deactivate processes in the application.
* :ref:`System Information <system-information>` --- Review system information on oro and third-party packages.
* :ref:`Consent Management <system-consent-management>` --- Create and manage consents to comply with General Data Protection Regulations.
* :ref:`Websites <system-websites>` --- Create multiple individually configured websites in the same application instance.
* :ref:`Localization <sys--config--sysconfig--general-setup--localization>` --- Translate and adapt products for a specific country or region.

.. _configuration--guide--config-levels:
.. _doc-system-configuration:

Oro applications enable you to configure system settings on four configuration levels (or scopes): global (system), organization, website and user.

* **Global**: To set up and manage settings globally, navigate to :ref:`System > Configuration <mc-system-configuration>` in the main menu, and locate the options you need to configure in the panel to the left.
* **Organization**: To configure settings per :term:`organization <Organization>`, navigate to :ref:`System > User Management > Organizations <doc-organization-configuration>`, and select the one that you wish to toggle the options for. Hover over the ellipsis menu to the right of the necessary organization and click *Configuration* to start editing it. Organization settings can fall back to system (or global) settings. Clearing the Use System check box next to the required option and changing its value means that you are configuring this option specifically for the selected organization.
* **Website**: To configure settings per :term:`website <Website>`, navigate to :ref:`System > Websites <doc-website-configuration>`, hover over the ellipsis menu to the right of the necessary website, and click *Configuration*. When Use Organization check box is enabled, organization settings override the global ones. Clear the Use Organization check box next to the required option, and change the default value to introduce changes at website level.
* **User**: To configure settings per :term:`user <User>`, navigate to :ref:`System > User Management > Users <doc-my-user-configuration>`, hover over the ellipsis menu to the right of the necessary user, and click *Configuration*. When Use Organization check box is enabled, organization settings override the global ones. Clear the Use Organization check box next to the required option, and change the default value to introduce changes at user level.
* **Customer Group**: To configure settings per :term:`customer group <Customer Group>`, navigate to **Customers > Customer Groups**, hover over the ellipsis menu to the right of the necessary group and click *Configuration*. When Use Website check box is enabled, website settings override the customer group ones. Clear the Use Website check box next to the required option, and change the default value to introduce changes at customer group level.
* **Customer**: To configure settings per :term:`customer <Customer>`, navigate to **Customers > Customers**, hover over the ellipsis menu to the right of the necessary customer and click *Configuration*. When Use Customer Group check box is enabled, customer group settings override the customer ones. Clear the Use Customer Group check box next to the required option, and change the default value to introduce changes at customer level.


.. toctree::
   :titlesonly:
   :hidden:

   Configuration <configuration/index>
   User Management <user-management/index>
   Storefront OAuth Applications <storefront-oauth-app/index>
   Contact Reasons <contact-reasons/index>
   Contact Groups <contact-groups/index>
   Emails <emails/index>
   Integrations <integrations/index>
   Channels <channels/index>
   Jobs <jobs/index>
   Data Audit <data-audit/index>
   Scheduled Tasks <scheduled-tasks/index>
   Entities <entities/index>
   Tags Management <tags-management/index>
   Menus <menus/index>
   Frontend Menus <frontend-menus/index>
   System Calendars <system-calendars/index>
   Shipping Rules <shipping-rules/index>
   Payment Rules <payment-rules/index>
   Workflows <workflows/index>
   Processes <processes/index>
   System Information <system-information/index>
   Consent Management <consent-management/index>
   Websites <websites/index>
   Localization <localization/index>
   Alerts <alerts/index>


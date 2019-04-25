Configuration Levels
====================

Oro applications enable you to configure system settings on four configuration levels: system, organization, website and user.

* Global: To set up and manage settings globally, navigate to System > Configuration in the main menu, and locate the options you need to configure in the panel to the left.

* Organization: To configure settings per organization, navigate to System > User Management > Organizations, and select the one that you wish to toggle the options for. Hover over the ellipsis menu to the right of the necessary organization and click Configuration to start editing it. Organization settings can fall back to system (or global) settings. Clearing the Use System check box next to the required option and changing its value means that you are configuring this option specifically for the selected organization.

* To configure settings per website, navigate to System > Websites, hover over the ellipsis menu to the right of the necessary website, and click Configuration. Similarly to the configuration per organization, clear the Use System check box next to the required option, and change the default value to introduce changes at website level.

* To configure settings per user, navigate to System > User Management > Users, hover over the ellipsis menu to the right of the necessary user, and click Configuration. When Use Organization check box is enabled, organization settings override the global ones.  Clear the Use Organization check box next to the required option, and change the default value to introduce changes at user level.

By default, all configuration settings are available globally, and whenever you see the organization, website or user icons, this means that the fundamental setting is also available on the organization, website or user level respectively.

.. toctree::
   :maxdepth: 1


   global
   organization
   website
   user



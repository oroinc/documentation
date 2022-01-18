:oro_documentation_types: OroCRM
:oro_show_local_toc: false

.. _admin-configuration-dotmailer-integration-settings:

Configure Global Dotdigital Settings
====================================

To enable data synchronization, make sure you configure Dotdigital integration on the Oro application side (see :ref:`Dotdigital Integration <user-guide-dotmailer-configuration--dotmailer-side>`) and on the Dotdigital side (see :ref:`Dotdigital Configuration <user-guide-dotmailer-configuration--oro-side>`).

To configure Dotdigital synchronization settings:
 
1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > dotdigital Settings**.

   .. image:: /user/img/marketing/marketing/dotdigital/global_dotdigital_settings.png
      :alt: Global dotdigital settings

3. To change the default settings, clear the **Use Default** option, and update the settings as required:

   .. csv-table::
      :header: "**Setting**","**Description**" 
      :widths: 10, 30

      "**Enable Daily Force Synchronization of Mapped Data Fields**","Once a day, trigger the data fields check. All contacts from entity's marketing lists will be automatically checked for updated fields and scheduled for sync with Dotdigital, if needed. The available options are *None*, *For mappings with virtual fields only*, *For all mappings*."
      "**Data Fields Sync Interval**", "This interval is used to update data fields from Dotdigital. By default, the number is set to 1 day."

3. Click **Save Settings**.

**Related Articles**

- :ref:`Dotdigital Integration Overview <user-guide-dotmailer-overview>`
- :ref:`Configure Dotdigital Integration <user-guide-dotmailer-configuration>`
- :ref:`Manage Dotdigital Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Configure Dotdigital Single Sign-on <user-guide-dotmailer-single-sign-on>`
- :ref:`Send Email Campaigns via Dotdigital <user-guide-dotmailer-campaign>`


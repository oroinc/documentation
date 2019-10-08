:oro_documentation_types: OroCRM

.. _admin-configuration-dotmailer-integration-settings:

Dotmailer Settings
==================

To enable data synchronization, make sure you configure dotmailer integration on the Oro application side (see :ref:`dotmailer Integration <user-guide-dotmailer-configuration--dotmailer-side>`) and on the dotmailer side (see :ref:`dotmailer Configuration <user-guide-dotmailer-configuration--oro-side>`).

To configure dotmailer synchronization settings:
 
1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > dotmailer Settings**.

   .. image:: /user/img/system/config_system/dotmailer_settings.png

3. To change the default settings, clear the **Use Default** option, and update the settings as required:

   .. csv-table::
      :header: "**Setting**","**Description**" 
      :widths: 10, 30

      "**Enable Daily Force Synchronization of Mapped Data Fields**","Once a day, trigger the data fields check. All contacts from entity's marketing lists will be automatically checked for updated fields and scheduled for sync with dotmailer, if needed. The available options are *None*, *For mappings with virtual fields only*, *For all mappings*."
      "**Data Fields Sync Interval**", "This interval is used to update data fields from dotmailer. By default, the number is set to 1 day."

3. Click **Save Settings**.

Related Articles
----------------

- :ref:`dotmailer Integration Overview <user-guide-dotmailer-overview>`
- :ref:`Configure dotmailer Integration <user-guide-dotmailer-configuration>`
- :ref:`Manage dotmailer Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Configure dotmailer Single Sign-on <user-guide-dotmailer-single-sign-on>`
- :ref:`Send Email Campaigns via dotmailer <user-guide-dotmailer-campaign>`


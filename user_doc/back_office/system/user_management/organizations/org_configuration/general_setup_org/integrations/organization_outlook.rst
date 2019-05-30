.. _org-outlook-settings:

Outlook Integration Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. hint:: You can read more on this topic in :ref:`MS Outlook Integration <user-guide-synch-outlook>`.

To configure MS Outlook integration settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > Integrations > MS Outlook Settings** in the menu to the left.

   The following options are available:

   .. csv-table::
      :header: "**Setting**","**Description**","**Possible Values**","**Default Value**"
      :widths: 20, 30, 20, 20

      "**Sync Direction**","The data synchronization direction","

      - OroCRM to Outlook
      - Outlook to OroCRM
      - Bidirectional","Bidirectional"
      "**Conflict Resolution**","Conflict resolution strategy to be used if the same data are changed in both Outlook and OroCRM","

      - OroCRM always wins

      - Outlook always wins", "OroCRM always wins"
      "**CRM Sync Interval (In Seconds)**","How often changes on the CRM side are checked","Any numeric value from 1 to 86399","120"
      "**Outlook Sync Interval (In Seconds)**","How often changes on Outlook side are checked","Any numeric value from 1 to 86399","30"

4. To change the values set up globally specifically for the selected organization, clear the **Use System** check box next to the required option, and provide a new value.

5. Click **Save Settings**.

Configure Synchronization Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To configure synchronization settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > Integrations > MS Outlook Settings** in the menu to the left.
4. In the **Synchronization section**, first clear the **Use System** check box next to the required option, and then the check box of the option itself.
5. Click **Save Settings**.

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin
.. _admin-configuration-ms-outlook-integration-settings--oro-side:
.. _configuration--guide--system--configuration--integrations--org--ms-outlook:

MS Outlook Settings
-------------------

.. begin_outlook_integration_oro

Once you downloaded and installed the add-in, you can configure MS Outlook settings on the Oro side. These settings include:
 
 * **MS Outlook add-in settings**
 * **Integration settings**
 * **Synchronization settings**

.. image:: /img/system/config_system/MS_outlook_settings(part1).png
   :alt: The configuration settings of ms outlook in the oro back-office

.. image:: /img/system/config_system/MS_outlook_settings(part2).png
   :alt: The configuration settings of ms outlook in the oro back-office, part2

.. hint:: MS Outlook settings can be configured globally, :ref:`per organization <org-outlook-settings>`, and :ref:`per user <user-outlook-settings>`, with the exception of MS Outlook add-in settings, which can only be managed globally.

Configure MS Outlook Add-in Layout Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When the add-in is installed, a side bar panel appears on the right side of the Outlook window which displays the actions that can be performed in Outlook and synchronized back to Oro (e.g. create a lead). Depending on the synchronization settings set up between the applications, you can create leads, opportunities, and cases from within MS Outlook using the side bar, and then sync them back to Oro. 

 .. image:: /img/system/config_system/SideBarPanelWidget.png
    :alt: A side bar panel displayed in the outlook application that enables creating leads, opportunities, and cases

The layout of this sidebar, as well as the lead, opportunity, and case dialogs, can be changed by amending the default XAML code (or providing a new one) in the MS Outlook Add-in Settings on the Oro side.

.. .. image:: /img/system/config_system/addin_view.png

To change the layouts:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > Integrations > MS Outlook Settings** in the panel to the left.
3. On the MS Outlook settings page, clear the **Use Default** check box for the required option (e.g. Side Bar Panel Layout).
4. Modify the default XAML code to alter the layout.
5. Click **Save Settings**.

   .. image:: /img/system/config_system/add_in_layout.png
      :alt: The configuration settings of ms outlook add-in in the oro back-office

.. note:: For the changes to take effect, remember either to start sync manually, or wait until automatic sync finishes.

Configure Integration Settings 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To configure the set of entities to be synchronized, the synchronization direction, intervals and priority of conflict resolution between Oro and MS Outlook:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > Integrations > MS Outlook Settings** in the panel to the left.
 
   The following settings are available:

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

3. To change the default values, clear the **Use Default** check box next to the required option, and select anew value.
4. Click **Save Settings**.

Configure Synchronization Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can select what data you wish to synchronize between your Oro application and MS Outlook. These can be contacts, tasks, or calendar events. By default, all three are synchronized. To change the default settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > Integrations > MS Outlook Settings** in the panel to the left.
3. In the **Synchronization section**, first clear the **Use Default** check box next to the required option, and then the check box of the option itself. 
4. Click **Save Settings**.



.. finish_outlook_integration_oro


.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. _admin-configuration-ms-outlook-integration-settings--oro-side:

Configure Outlook Integration in Oro
------------------------------------

.. begin_outlook_integration_oro

Once you downloaded and installed the add-in, you can configure MS Outlook settings on the Oro side. These settings include:
 
 * **MS Outlook add-in settings**
 * **Integration settings**
 * **Synchronization settings**

.. image:: /admin_guide/img/outlook/MSOutlookSettingsOroSide.gif


.. note:: MS Outlook settings can be configured globally, per organization, and per user, with the exception of MS Outlook add-in settings, which can only be managed globally. 

   Checkout the `Configuration Levels topic <https://oroinc.com/doc/orocommerce/current/configuration-guide/landing-system-configuration/config-levels#configuration-guide-config-levels>`_, or a video on `Orientation in Oro Application Configuration Settings <https://www.youtube.com/watch?v=BxyzaOXwo0k>`_ in the Oro media library.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/BxyzaOXwo0k" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>


Configure MS Outlook Add-in Layout Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When the add-in is installed, a side bar panel appears on the right side of the Outlook window which displays the actions that can be performed in Outlook and synchronized back to Oro (e.g. create a lead). Depending on the synchronization settings set up between the applications, you can create leads, opportunities, and cases from within MS Outlook using the side bar, and then sync them back to Oro. 

 .. image:: /admin_guide/img/outlook/SideBarPanelWidget.png

The layout of this sidebar, as well as the lead, opportunity, and case dialogs, can be changed by amending the default XAML code (or providing a new one) in the MS Outlook Add-in Settings on the Oro side.

.. .. image:: /admin_guide/img/outlook/addin_view.png

To change the layouts:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > Integrations > MS Outlook Settings** in the panel to the left.
3. On the MS Outlook settings page, clear the **Use Default** check box for the required option (e.g. Side Bar Panel Layout).
4. Modify the default XAML code to alter the layout.
5. Click **Save Settings**.

   .. image:: /admin_guide/img/outlook/add_in_layout.png

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

Configure Integration Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

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

Configure Integration Settings per User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
                                                                     
To configure MS Outlook integration settings per user: 

1. Navigate to **System > User Management > Users** in the main menu.
2. For the necessary user, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration for a specific user. 
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

4. To change the values set up globally or per specific organization for the selected user, clear the **Use Organization** check box next to the required option, and provide a new value.
5. Click **Save Settings**.

Configure Synchronization Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can select what data you wish to synchronize between your Oro application and MS Outlook. These can be contacts, tasks, or calendar events. By default, all three are synchronized. To change the default settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > Integrations > MS Outlook Settings** in the panel to the left.
3. In the **Synchronization section**, first clear the **Use Default** check box next to the required option, and then the check box of the option itself. 
4. Click **Save Settings**.

Configure Synchronization Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To configure synchronization settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu. 
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. Click **System Configuration > Integrations > MS Outlook Settings** in the menu to the left.
4. In the **Synchronization section**, first clear the **Use System** check box next to the required option, and then the check box of the option itself.  
5. Click **Save Settings**.

Configure Synchronization Settings per User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To configure synchronization settings per user:

1. Navigate to **System > User Management > Users** in the main menu.
2. For the necessary user, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration for the selected user.
3. Click **System Configuration > Integrations > MS Outlook Settings** in the menu to the left.
4. In the **Synchronization section**, first clear the **Use Organization** check box next to the required option, and then the check box of the option itself.  
5. Click **Save Settings**.


.. finish_outlook_integration_oro


.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. _admin-configuration-ms-outlook-integration-settings--connect:
.. _doc-ms-outlook-add-in-set-up-outlook-side:

Connect MS Outlook Add-in to Oro Instance
-----------------------------------------

.. begin_connect_outlook

During add-in installation you are required to provide integration settings to ensure correct work between applications:

.. image:: /admin_guide/img/outlook/outlook_addin_settings.png
   :alt: General outlook add-in settings available when configuring the integration between applications

1. **OroCRM URL** --- Provide the URL of your instance:
 
   * If you are running a CRM application, copy the URL from the address bar. Alternatively, copy it from the **Application URL** field by navigating to **System > Configuration > System Configuration > General Setup > Application Settings** (e.g. demo.orocrm.com).

   * If you are running an OroCommerce application, add **/admin** at the end of the URL. Otherwise, connection between the add-in and your Oro instance may fail (e.g. demo.orocommerce.com/admin).

2. **Ignore self-signed certificate** --- Check this box to allow connection to secure servers that use self-signed certificates. We recommend to keep this box checked at all times.

3. **User** --- Provide the username defined on the **My User** page of your Oro instance.

   .. image:: /admin_guide/img/outlook/username.png
      :alt: Demonstrating a path to the username defined on my user page

4. **API Key** --- Paste the API key generated in your Oro instance. 

   .. note:: You can generate the key by opening **My User** page and clicking **Generate Key** next to the **API Key** option. Copy the key once generated.

5. **Disable Sync** --- this check box defines synchronization conditions. 

   * When **Disable Sync** is not selected, synchronization runs automatically within the intervals defined in your Oro instance.

   * When **Disable Sync** is selected, synchronization has to be triggered manually. One way of doing this is by right-clicking on the Outlook add-in icon on the bottom right of your screen and clicking **Sync Now**. 

      .. image:: /admin_guide/img/outlook/sync_now.png
         :alt: The sync now button displayed on the bottom right of your screen when right-clicking the outlook add-in icon

    Alternatively, start sync within your Outlook application by clicking the **ADD-INS** tab, and clicking **Sync Now** in the OroCRM for Outlook settings menu.
   
      .. image:: /admin_guide/img/outlook/sync_now_panel.png
         :alt: The sync now button displayed in the orocrm for outlook settings menu

6. **Sync Type** --- Select whether you wish to sync all or selected records.
7. **Show Alerts** --- This check box controls whether alerts are displayed in the bottom panel next to the add-in icon:

   * If the **Show Alerts** check box is checked, sync-related alerts pop up in the bottom panel. 
   * If the **Show Alerts** check box is not checked, alerts are not displayed.

8. **Sync Birthdays** --- Select the check box if you wish to sync contacts' birthdays.
9. **Check Connection** --- Click **Check Connection** once you filled in all the settings fields. A corresponding message pops up when the connection fails/is successful.

10. **Automatic Updating** --- Define the schedule and conditions for updates.

11. Click **Save** to save these settings. 

    When the add-in is installed, you see its icon displayed on the bottom right corner of your computer screen.
 
    .. image:: /admin_guide/img/outlook/addin_icon.png
       :alt: The outlook add-in icon displayed in the bottom right corner of your computer screen

.. note:: You can access the same settings after installation by clicking **Settings** in the **OroCRM for Outlook** menu under the **ADD-INS** tab in your Outlook application.

   .. image:: /admin_guide/img/outlook/crm_outlook_menu.png
      :alt: The settings button displayed in the orocrm for outlook menu under the add-ins tab

.. finish_connect_outlook

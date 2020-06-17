:oro_documentation_types: OroCRM, OroCommerce

.. _admin-configuration-application:

Configure Global Application Settings
=====================================

You can view details of your application settings and control the Web API feature availability both for the back-office and storefront. By default, the API feature is disabled fo the application.

1. Navigate to **System > Configuration** in the main menu.
2. Select **System Configuration > General Setup > Application Settings** in the menu to the left.
3. The following details are available:

   .. image:: /user/img/system/config_system/application_settings_global.png
      :alt: The application settings available on the global level

   .. note:: To change the default settings, clear the **Use Default** check box first.

   * **Application URL** --- The URL of the application 
   * **Recipient Email Addresses** --- To send notifications to specific people, type their email addresses separated by semicolons (;). Leave this field empty to disable error logs notification.

4. In the **Web API** section, select the required options:

   * **Enable API** --- enables the back-office API feature for your application.
   * **Enable Storefront API** --- enables the storefront API feature for your application.

   .. note:: The back-office API feature can be toggled on the global and :ref:`organization <admin-configuration-application-org>` levels, while the storefront API configuration is available on three levels - globally, per organization, and per :ref:`website <admin-configuration-application-website>`.

4. Click **Save Settings**.
   
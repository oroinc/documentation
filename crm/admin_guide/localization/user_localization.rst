.. _config_guide--localization--user-localization:

Customize Localization Settings per User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

To define the custom localization options for a particular user:

1. Navigate to **System > User management > Users** in the main menu.
2. For the necessary user, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > General Setup > Localization** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   The following page is displayed:

   .. image:: /admin_guide/img/localization/localization_configuration_user.png
      :alt: Localization configuration options per user

   Here, you can configure the following options by clearing the **Use Organization** check box and providing your own data:

4. In the **Location Options** section, provide:

   * **Primary Location** and **Format Address Per Country** --- Define the address formatting to be applied.

     If *Format Address Per Country* is enabled and the country-specific formatting is enabled for the instance, the address will be displayed in compliance with the rules specified for the country.
     For example, if the chosen country is China, the address is displayed as follows:

     * *ZIP code*
     * *Country*
     * *State, City*
     * *Street*
     * *First and Last name*

     whereas, for the US it is:

     * *First and Last name*
     * *Street name*
     * *CITY NAME, STATE CODE, COUNTRY, ZIP code*

     Otherwise, the *Primary Location* formatting is applied.

   * **Timezone** --- Defines the timezone to be applied for all the time settings defined in the instance. If the time-zone is changed, all the time settings (e.g. due dates of :ref:`tasks <doc-activities-tasks>`), time of reminders, etc. change correspondingly. The default value is(UTC -08:00) America/Los Angeles.

5. In the **Map Settings**, select the **Temperature Unit** and **Wind Speed Unit** to display the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

   .. image:: /admin_guide/img/localization/localization_map.png
      :alt: Weather on a map

6. In the **Localization Settings**, provide:

   * **Default Localization** --- The default language of the management console and storefront UI for the current website. The list of available languages depends on the localizations added on the global level.

7. Click **Save Settings**.

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin
:oro_documentation_types: crm, commerce

.. _config_guide--localization--organization-localization:

Localization Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

To define the custom localization options for a particular organization:

1. Navigate to **System > User management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > General Setup > Localization** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/localization/localization_configuration_organization.png
      :alt: Localization configuration options per organization

   Here, you can configure the following options by clearing the **Use System** check box and providing your own data.

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

   * **First Quarter Starts On** --- Defines the quarter start date. The default value is January, 1.
   * **Currency** --- Select the default currency for the current organization.

5. In the **Map Settings**, select the **Temperature Unit** and **Wind Speed Unit** to display the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

   .. image:: /user/img/system/user_management/localization_map.png
      :alt: Weather on a map

6. In the **Localization Settings**, provide:

   * **Default Localization** --- The default language of the back-office and storefront UI for the current organization. The list of available languages depends on the localizations added to the **Enabled Localizations** list on the global level.
   * **Enabled Localizations** --- The list of localizations is generated automatically based on the data preconfigured in the **System > Localization > Localizations** menu.

     All supported localizations added to this list are displayed in the language switcher in the storefront.

     .. image:: /user/img/system/config_system/language_switcher_storefront.png
        :alt: Language switcher in the storefront

     In addition, they determine the languages available for the email notifications. If there is an email template for the supported language, the users who have selected that specific language on the storefront, receive localized notifications.

     .. image:: /user/img/system/localization/language_tabs_email_template.png
        :alt: Language tabs in email templates

7. Click **Save Settings**.

.. finish

.. include:: /include/include-images.rst
   :start-after: begin
:oro_documentation_types: OroCRM, OroCommerce

.. _sys--config--sysconfig--general-setup--localization--global:
.. _localization--localization:

Configure Global Localization Settings
======================================

.. begin_1

In the system configuration, you can define the localization options, such as system locale, primary location, address formatting method, system timezone, calendar year settings, temperature and wind speed units on the map. Furthermore, you can set the default language of the UI elements displayed in the storefront.

.. include:: /user/concept-guides/localization/content-translation.rst
   :start-after: begin_content_translation
   :end-before: finish_content_translation

.. hint:: The system configuration of the localization settings are available on four levels: globally, :ref:`per organization <config_guide--localization--organization-localization>`, :ref:`per website <sys--websites--sysconfig--general-setup--localization>`, and :ref:`per user <config_guide--localization--user-localization>`.

To configure localization settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. In panel on the left, expand **General Setup** and click **Localization**.

   .. note::
       For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   The following page is displayed:

   .. image:: /user/img/system/config_system/localization_configuration_global.png
      :alt: Global localization configuration options

   Configure the required options by clearing the **Use Default** check box and providing your own data.

3. In the **Location Options** section, provide:

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

4. In the **Map Settings**, provide:

   * **Temperature Unit** and **Wind Speed Unit** to display the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

     .. image:: /user/img/system/config_system/localization_map.png
        :alt: Weather on a map

5. In the **Localization Settings**, provide:

   * **Default Localization** --- The default language of the back-office and storefront UI. The list of available languages depends on the localizations added to the **Enabled Localizations** list.
   * **Enabled Localizations** --- The list of localizations is generated automatically based on the data preconfigured in the **System > Localization > Localizations** menu.

     All supported localizations added to this list are displayed in the language switcher in the storefront.

     .. image:: /user/img/system/config_system/language_switcher_storefront.png
        :alt: Language switcher in the storefront

     In addition, they determine the languages available for the email notifications. If there is an email template for the supported language, the users who have selected that specific language in the storefront, receive localized notifications.

     .. image:: /user/img/system/config_system/language_tabs_email_template.png
        :alt: Language tabs in email templates

     .. note::
        Refer to the :ref:`Localizations <localization--localizations>` section for more details.

6. Click **Save Settings**.

.. finish_1

.. include:: /include/include-images.rst
   :start-after: begin
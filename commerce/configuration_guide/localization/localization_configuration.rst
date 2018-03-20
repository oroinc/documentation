.. _sys--config--sysconfig--general-setup--localization--global:
.. _localization--localization:


Configure Localization Settings
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_1

In the system configuration, you can define the localization options, such as system locale, primary location, address formatting method, system timezone, calendar year settings, temperature and wind speed units on the map. Furthermore, you can set the default language of the UI elements displayed in the storefront.

.. include:: /configuration_guide/localization/content_translation.rst
   :start-after: begin_content_translation
   :end-before: finish_content_translation

The system configuration of the localization settings are available on four levels: globally, per organization, per website, and per user. The configuration steps are provided below:

.. contents:: :local:
   :depth: 1

Customize Localization Settings Globally
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Navigate to the localization settings:

   a) Click **System > Configuration** in the main menu.
   #) In the **System Configuration** menu to the left, expand **General Setup** and click **Localization**.

      .. note::
         For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   The following page opens:

   .. image:: /configuration_guide/img/localization/localization_configuration_global.png

2. Here, you can configure the following options by clearing the **Use Default** check box and providing your own data:

   .. csv-table::
     :header: "Option", "Description", "Default"
     :widths: 10, 30, 10

     "**Locale**","Affects formatting of numbers, addresses, names, and dates.","English"
     "**Primary Location** and **Format Address Per Country**","Define the address formatting to be applied.

     If *Format Address Per Country* is enabled and the country-specific formatting is enabled for the instance, the address will be displayed in compliance with the rules specified for the country.
     For example, if the chosen country is China, the address will be displayed as follows:

     *ZIP code*
     *Country*
     *State, City*
     *Street*
     *First and Last name*

     whereas, for the US it will be:

     *First and Last name*
     *Street name*
     *CITY NAME, STATE CODE, COUNTRY, ZIP code*

     Otherwise, the *Primary Location* formatting will be applied.","US"
     "**Timezone**","Defines the timezone to be applied for all the time settings defined in the instance. If the time-zone is changed, all the time settings (e.g. due dates of :ref:`tasks <doc-activities-tasks>`), time of reminders, etc. will be changed correspondingly.","(UTC -08:00) America/Los Angeles "
     "**First Quarter Starts On**","Defines the quarter start date.","January 1"


3. In the **Map Settings**, select the **Temperature Unit** and **Wind Speed Unit** to display the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

   .. image:: /configuration_guide/img/localization/localization_map.png

4. Select one or multiple enabled localizations from the list to support the translation of the storefront UI elements to the target language. The list is generated automatically based on the data preconfigured in the **System > Localization > Localizations** menu. Refer to the :ref:`Localizations <localization--localizations>` section for more details.

5. Select the default localization for the OroCommerce storefront.

6. Click **Save** to save the settings.

Customize Localization Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/localization/organization_localization.rst
   :start-after: begin
   :end-before: finish

Customize Localization Settings per Website
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/localization/website_localization.rst
   :start-after: begin
   :end-before: finish

Customize Localization Settings per User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. include:: /configuration_guide/localization/user_localization.rst
   :start-after: begin
   :end-before: finish


.. finish_1

.. include:: /img/buttons/include_images.rst
   :start-after: begin
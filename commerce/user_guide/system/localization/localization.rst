Localization
------------

.. begin

To define the localization options (system locale, primary location, address formatting method, system timezone, calendar year settings, temperatuire and wind speed units on the map, enabled localizations and the default one):

1. Navigate to the localization settings:

     a) Click **System > Configuration** in the main menu.
     #) In the **System Configuration** menu to the left, expand **General Setup** and click **Localization**.

        The following page opens:

        .. image:: /user_guide/img/system/configuration/general/Localization.png

#. Configure the following options:

   .. csv-table::
     :header: "Option", "Description", "Default"
     :widths: 10, 30, 10

     "**Locale***","Affects formatting of numbers, addresses, names, and dates.","English"
     "**Primary Location*** and **Format Address Per Country***","Define the address formatting to be applied. If *Format
     Address Per Country* is enabled and the country-specific formatting is enabled for the instance, the address will be
     displayed in compliance with the rules specified for the country.
     For example, if the chosen country is Ukraine, the address will be displayed as follows:

     *ZIP code Ukraine City*
     *Street*
     *First and Last name*

     whereas, for the US it will be:

     *First and Last name*
     *Street name*
     *CITY NAME, STATE CODE, US, ZIP code*
     Otherwise, the *Primary Location* formatting will be applied.","US"
     "**First Quarter Starts On***","Defines the quarter start date.","January 1"
     "**Timezone***","Defines the timezone to be applied for all the time settings defined in the instance. If the
     time-zone is changed all the time settings (e.g. due dates of `tasks <./../../getting-started/common-actions/assign-tasks>`), time of
     reminders, etc. will be changed correspondingly.","UTC +02:00"
     "**Currency***","Defines the default currency used in the system. There is no currency conversion in the system, so the setting basically defines the currency label applied to the monetary values defined in the system.","US dollars"

#. In the **Map Options**, select the **Temperature Unit** and **Wind Speed Unit** for display of the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

   .. image:: /user_guide/img/system/configuration/configuration/localization_map.png

#. Select the supported localizations. Use the :guilabel:`Ctrl` and :guilabel:`Shift` keys to choose the languages from the list.

#. Select the default localization for the OroCommerce store frontend and management console. Localization affects formatting of numbers, addresses, names, and dates.

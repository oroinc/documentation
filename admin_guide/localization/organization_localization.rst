.. _config_guide--localization--organization-localization:

Customize Localization Settings per Organization
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

To define the custom localization options for the particular organization:

1. Navigate to **System > User management > Organizations** in the main menu.

2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.

3. Select **System Configuration > General Setup > Localization** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

The following page opens:

.. image:: /admin_guide/img/localization/localization_configuration_organization.png

4. Here, you can configure the following options by clearing the **Use System** check box and providing your own data:

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
      "**Currency**","Defines the default currency that is used to display prices to customer users in the storefront"

5. In the **Map Settings**, select the **Temperature Unit** and **Wind Speed Unit** to display the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

   .. image:: /admin_guide/img/localization/localization_map.png

6. Click **Save** to the save the settings.

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin
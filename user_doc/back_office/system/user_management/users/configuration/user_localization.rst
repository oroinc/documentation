.. _config_guide--localization--user-localization:
.. _doc-my-user-configuration-localization:

Customize Localization Settings per User
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

To define the custom localization options for the particular user:

1. Navigate to **System > User management > Users** in the main menu.
2. For the necessary user, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > General Setup > Localization** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user_doc/img/system/user_management/localization_configuration_user.png
     :alt: Localization options available on the user level

4. Here, you can configure the following options by clearing the **Use Organization** check box and providing your own data:

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

5. In the **Map Settings**, select the **Temperature Unit** and **Wind Speed Unit** to display the weather on the map. The default values are Fahrenheit and miles per hour (MPH).

   .. image:: /user_doc/img/system/config_system/localization_map.png

6. Click **Save SEttings**.

.. finish

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin
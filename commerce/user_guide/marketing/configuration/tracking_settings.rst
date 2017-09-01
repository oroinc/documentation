
.. _admin-configuration-tracking-settings:
.. _admin-configuration-tracking:

.. updated on 06 July 2017

Tracking Settings
~~~~~~~~~~~~~~~~~

.. begin

You can set up the settings that apply to all the :ref:`Tracking records <user-guide-marketing-tracking>` created in the Oro application.

To tune the tracking configuration:

1. In the main menu, navigate to **System > Configuration**.
2. Select **System Configuration > General Setup > Tracking** in the menu to the left.

   .. image:: /user_guide/img/marketing/configuration/tracking.png

   .. csv-table::
      :header: "Option", "Description", "Default"
      :widths: 10, 30, 10

      "**Enable Tracking Statistics Aggregation**","If enabled, website visits information is aggregated for the statistics report. This improves statistics calculation time, but may have impact on the performance.","Enabled"
      "**Enable Dynamic Tracking**","If enabled, tracking data will be processed in the real-time mode. Please note that this may affect performance.","Disabled"
      "**Log Rotation Interval**","Defines how often log files must be processed if **Dynamic Tracking** is disabled.","1 hour"
      "**Piwik Host**","The field must be specified if you want the tracking data to be sent to a Piwik account. The value corresponds to the Piwik analytics URL of your account.","None"
      "**Piwik Token Auth**","The field must be specified if you want the tracking data to be sent to a Piwik account. The value corresponds to the Piwik `token_auth <http://piwik.org/faq/general/faq_114/>`_ field.","None"

   .. note:: To enable the data transfer to a Piwik account, the **identifier** field of the Tracking Website record should be the same as the `Website ID <http://piwik.org/faq/general/faq_19212/>`_ used by Piwik.

3. To enable/disable the feature:

     a) Clear the **Use Default** box next to the option.
     b) Check or clear the checkbox next to the option, or select the new value from the list, or type in the necessary information.

4. Click **Save Settings**.

.. important:: The **Reset** button in the upper right corner of the page will restore the latest saved values.

.. note:: You can navigate to the Tracking Website management page using the Tracking website link at the bottom of the page.

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
:oro_documentation_types: OroCRM, OroCommerce

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

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/system/config_system/tracking.png
   :alt: Tracking configuration

.. csv-table::
  :header: "Option", "Description", "Default"
  :widths: 10, 30, 10

  "**Enable Tracking Statistics Aggregation**","If enabled, website visits information is aggregated for the statistics report. This improves statistics calculation time, but may have impact on the performance.","Enabled"
  "**Enable Dynamic Tracking**","If enabled, tracking data is processed in the real-time mode, and the event is registered as soon as it occurs. Please note that this may affect performance.","Disabled"
  "**Log Rotation Interval**","Defines how often log files must be processed if **Dynamic Tracking** is disabled.","1 hour"
  "**Piwik Host**","The field must be specified if you want the tracking data to be sent to a Matomo (previously known as Piwik) account. The value corresponds to the Matomo analytics URL of your account.","None"
  "**Piwik Token Auth**","The field must be specified if you want the tracking data to be sent to a Matomo (previously known as Piwik) account. The value corresponds to the |Matomo1| field.","None"

.. note:: To enable the data transfer to a Matomo account, the **identifier** field of the Tracking Website record should be the same as the |Website ID| used by Matomo.

3. Clear the **Use Default** check box to customize the required option.

4. Select the checkbox next to the option, choose a new value from the list, or type in the necessary information.

5. Click **Save Settings**.

.. important:: The **Reset** button in the upper right corner of the page restores the latest saved values.

.. note:: You can navigate to the tracking website management page using the tracking website link at the bottom of the page.

.. finish

Related Articles
^^^^^^^^^^^^^^^^

* :ref:`Marketing Features <marketing-system-configuration>`
* :ref:`Tracking Websites <user-guide-marketing-tracking>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
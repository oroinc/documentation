
.. _admin-configuration-tracking-settings:
.. _admin-configuration-tracking:

Tracking Settings
=================



The Tracking section in **System>Configuration>System Configuration>General Setup>Tracking** specifies the settings to be applied to all the :ref:`Tracking records <user-guide-marketing-tracking>` created in the system instance.

|

.. image:: ../img/configuration/tracking.png

|

The following options are available:

.. csv-table::
  :header: "Option", "Description", "Default"
  :widths: 10, 30, 10
  
  "**Enable Dynamic Tracking**","If enabled, tracking data will be processed in the real-time mode. Please note that this may affect performance.","Disabled"
  "**Log Rotation Interval**","Defines how often log files must be processed if **Dynamic Tracking** is disabled.","1 hour"
  "**Piwik Host**","The field must be specified if you want the tracking data to be sent to a Piwik account. The value corresponds to the Piwik analytics URL of your account.","None"
  "**Piwik Token Auth**","The field must be specified if you want the tracking data to be sent to a Piwik account. The value corresponds to the Piwik `token_auth <http://piwik.org/faq/general/faq_114/>`_ field.","None"



In order to enable the data transfer to a Piwik account, the "identifier" field of the Tracking Website record should be the same as the `Website ID <http://piwik.org/faq/general/faq_19212/>`_ used by Piwik.

At the bottom of the form there is a link to the grid of all the Tracking Website records.


.. important:: The :guilabel:`Reset` button in the upper right corner of the page will restore the latest saved values.

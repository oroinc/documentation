.. _configuration--guide--system--configuration--integrations--org:

Integrations Configuration for Organization
===========================================

This section contains an integration options available in the system configuration for the organization.

Here you can enable and setup the integration between your organization's Oro application and the following systems:

.. contents:: :local:
   :depth: 1

.. _configuration--guide--system--configuration--integrations--org--google:

To change the default integration settings for organization:

1. Navigate to **System > User Management > Organization** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > Integrations** in the menu to the left and select the necessary option group from the list that unfolds.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

Google Settings
---------------

Google Hangouts
^^^^^^^^^^^^^^^

+-----------------------+-----------------------------------------------------+
| **Option**            | **Description**                                     |
+=======================+=====================================================+
| **Enable For Emails** | Check the box to enable Google Hangouts for emails. |
+-----------------------+-----------------------------------------------------+
| **Enable For Phones** | Check the box to enable Google Hangouts for phones. |
+-----------------------+-----------------------------------------------------+

By default, **Enable For Emails** and **Enable For Phones** are enabled.

MS Exchange Settings
--------------------

MS Exchange configuration for organization is similar to the global :ref:`MS Exchange configuration <admin-configuration-ms-exchange-integration-settings>`.

.. _configuration--guide--system--configuration--integrations--org--ms-outlook:

MS Outlook Settings
-------------------

In the MS Outlook settings section, you can configure the following integration and synchronization settings:

.. note:: Integration between MS Outlook and your Oro application is available only for the Enterprise Edition of your Oro application. For more information about the synchronization with Outlook, see the :ref:`Synchronization with Outlook <user-guide-synch-outlook>` guide.

.. image:: /user_guide/img/getting_started/my_oro/my_user_config_outlook.png

**Integration settings**

+------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------+
| Field                              | Description                                                                                                                            |
+====================================+========================================================================================================================================+
| Sync Direction                     | Select whether the data will be taken from OroCRM to Outlook, from Outlook to OroCRM or synchronization will occur in both directions. |
+------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------+
| Conflict Resolution                | Select whether OroCRM or Outlook has priority if the same piece of data has been changed in both systems.                              |
+------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------+
| CRM Sync Interval (In Seconds)     | Type how often changes on OroCRM side will be checked.                                                                                 |
+------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------+
| Outlook Sync Interval (In Seconds) | Type how often changes on Outlook side will be checked.                                                                                |
+------------------------------------+----------------------------------------------------------------------------------------------------------------------------------------+

**Synchronization settings**

+-----------------+-----------------------------------------------------------+
| Field           | Description                                               |
+=================+===========================================================+
| Contacts        | Select this check box to synchronize the contacts.        |
+-----------------+-----------------------------------------------------------+
| Tasks           | Select this check box to synchronize the tasks.           |
+-----------------+-----------------------------------------------------------+
| Calendar Events | Select this check box to synchronize the calendar events. |
+-----------------+-----------------------------------------------------------+

.. include:: /img/buttons/include_images.rst
   :start-after: begin
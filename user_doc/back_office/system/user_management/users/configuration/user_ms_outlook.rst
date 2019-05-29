.. _doc-my-user-configuration-integrations:
.. _doc-my-user-configuration-msoutlook:

Configure MS Outlook Settings per User
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. begin_my_outlook

In the MS Outlook settings section, you can configure the following integration and synchronization settings for a user:

.. note:: Integration between MS Outlook and your Oro application is available only for the Enterprise Edition of your Oro application. For more information about the synchronization with Outlook, see the :ref:`Synchronization with Outlook <user-guide-synch-outlook>` guide.

1. Navigate to **System > User Management > Users** in the main menu
2. For the necessary user, hover over the |IcMore| **More Options** menu to the right and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > Integrations > MS Outlook Settings** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user_doc/img/system/user_management/my_user_config_outlook.png
      :alt: Integration and synchronization settings options displayed in the ms outlook menu on the user level

4. In the **Integration settings**, provide the following information:

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

5. In the **Synchronization settings**, provide the following information:

   +-----------------+-----------------------------------------------------------+
   | Field           | Description                                               |
   +=================+===========================================================+
   | Contacts        | Select this check box to synchronize the contacts.        |
   +-----------------+-----------------------------------------------------------+
   | Tasks           | Select this check box to synchronize the tasks.           |
   +-----------------+-----------------------------------------------------------+
   | Calendar Events | Select this check box to synchronize the calendar events. |
   +-----------------+-----------------------------------------------------------+

6. Click **Save Settings**.


.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin
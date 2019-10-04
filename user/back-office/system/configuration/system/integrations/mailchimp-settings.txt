.. _user-guide-mc-settings:

MailChimp Settings
==================

If you have MailChimp integration configured, you can control MailChimp synchronization settings in the system configuration:

1. Navigate to **System > Configuration** in the main menu.
2. In the menu to the left, click **System Configuration > Integrations > MailChimp Settings**.
3. In the **Synchronization Settings** section, clear the **Use Default** check box and select one of the two options in the **Static Segment Synchronization Mode** field:

   * **On data update** --- Synchronization is scheduled both by cron and as soon as data in static segment changes.
   * **Scheduled** --- Synchronization is scheduled only by cron.

4. Click **Save Settings** once you select the required option.

 .. note:: You need to have *Schedule MailChimp Static Segment synchronization* enabled for this configuration to be respected.

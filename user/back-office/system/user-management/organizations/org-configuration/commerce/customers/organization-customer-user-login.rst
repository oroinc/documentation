.. _system--user-mngm--organization--configuration--commerce--customers--customer-user-login:

Configure Customer User Login Settings per Organization
=======================================================

.. note:: Customer User Login settings can be configured :ref:`globally <sys-config--configuration--commerce--customers--customer-user-login>` and per organization.

To change the default customer user login configuration settings for an organization:

1. Navigate to **System > User Management > Organization** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Customer > Customer User Login** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. To customize any of the options:

     a) Clear the **Use System** box next to the option.
     b) Select the new option.

5. In the **Login Attempts** section, configure the following options:

   * **Enable Failed Logins Limit** --- Defines whether a user can be locked out when the max number of login attempts is reached. By default, the option is enabled.
   * **Max Login Attempts** --- The number of attempts within the login failure lockout interval that a user has to authenticate before they are locked out. By default, the number is set to 10.
   * **Login Failure Lockout Interval** --- The time in minutes in which failed login attempts are counted. If one failed login attempt is followed by the second failed attempt within this lockout interval, the failed login count starts. The user will be locked out if they reach the maximum number of failed login attempts. Set zero (0) to count failed login attempts globally. By default, it is set to 60 minutes.
   * **Account Lockout Time** --- The time in minutes that indicates how long the user has before they are locked out of the system if they reach the maximum number of failed login attempts. Set zero (0) to disable automatic unlock. By default, it is set to 60 minutes.

6. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

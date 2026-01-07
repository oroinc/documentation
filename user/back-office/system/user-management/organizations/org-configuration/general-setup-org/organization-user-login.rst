.. _admin-configuration-user-login-form-org:

Configure User Login Settings per Organization
==============================================

To apply user login-related options in your Oro application instance per organization:

1. Navigate to **System > Configuration > User Management > Organizations** in the main menu.
2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.
3. Select **System Configuration > General Setup > User Login** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. In the LDAP Users section, configure the following option:

   * **Disable Local Password Change/Reset for LDAP Users** --- This configuration option controls whether back-office users whose accounts are synchronized from LDAP can manage their passwords locally in the Oro application. When enabled, LDAP users (identified by a non-empty *LDAP Distinguished Names* field in their profile) cannot change their password on the My User page, use the *Forgot your password?* flow, or have their password reset by administrators.

5. Click **Save Settings**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

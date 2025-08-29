.. _admin-configuration-user-settings:

Configure Global User Settings
==============================

To apply user-related options in your Oro application instance:

1. Navigate to **System > Configuration** in the main menu.
2. Click **System Configuration > General Setup > User Settings**.

   .. image:: /user/img/system/config_system/user.png
      :alt: User settings on global level

3. Under **Email Settings**, configure the following:

* **Case-Insensitive Email Addresses** --- If this option is enabled, the letter case is ignored when comparing email addresses. For example, john.doe@example.com and John.Doe@example.com are treated equally. By default, the option is disabled. Be noted that the setting is only applied to back-office users. The identical option for customer users is managed :ref:`here <sys-config--configuration--commerce--customers--customer-users>`.

.. _admin-configuration-user-settings-share:

4. Under **Sharing Records**, activate or deactivate the ability to share entity records:

* **Allow Sharing** --- If this option is enabled, users are allowed to share entities in the Oro application back-office. This option is available in the Enterprise Edition only.
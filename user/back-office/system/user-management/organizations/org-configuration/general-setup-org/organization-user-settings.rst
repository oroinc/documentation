.. _admin-configuration-user-settings-org:

Configure User Settings per Organization
========================================

.. note:: You can configure SCIM synchronization :ref:`globally <admin-configuration-user-settings>` or per organization.

.. note:: The SCIM synchronization is available as of OroCommerce Enterprise version 6.1.7.

The User Settings section enables you to configure the SCIM (System for Cross-domain Identity Management) protocol in the Oro application. This setup allows you to import and synchronize users from external identity systems, such as Microsoft Entra ID, into Oro. Once imported, these users can log in to Oro via :ref:`Microsoft 365 Single Sign-On <user-guide-integrations-microsoft-single-sign-on>`.

To set the user provisioning settings per specific organization:

1. Navigate to **System > Configuration > User Management > Organizations** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > General Setup > User Settings** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/user_management/org_configuration/general/user_org.png
      :alt: User settings on organization level

4. Under **User Provisioning**, set the following options:

* **Enable SCIM** --- Enable or disable the SCIM integration on the global level.
* **Default Access to Organization Business Units** --- Select the organizations and business units that will be automatically assigned to newly synchronized users.
* **Default Roles** --- Select the user roles that new users will receive upon synchronization.
* **Extra fields handling** --- Choose how the system should handle cases when the identity provider send extra fields. The available options are:

    * **Return error** (default) --- If selected, and the identity provider sends extra fields to Oro, the system will return an error.
    * **Ignore extra fields** --- If selected, and the identity provider sends extra fields to Oro, the system will ignore these fields.
* **Empty name values handling** --- Choose how the system should handle cases when the identity provider does not send first or last name values. The available options are:

    * **Leave as is and expect validation errors** --- If selected, and the identity provider sends no first or last name to Oro, the system will return an error without generating any replacement values.
    * **Generate based on user name** (default) --- If selected, the first and last name values will be copied from the username field.
    * **Use random string** --- If selected, the first and last name values will be automatically generated as random strings.

5. Click **Save settings** to apply the changes.

6. Once enabled, you can configure a user provisioning service, following the steps described in the :ref:`Configure Okta Provisioning Service <okta-provisioning-service>` or the :ref:`Configure Microsoft Entra Provisioning Service <microsoft-entra-provisioning-service>`.



.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

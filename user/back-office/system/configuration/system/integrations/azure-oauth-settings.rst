.. _configuration-integrations-azure:

Configure Microsoft 365 OAuth Settings (Azure Active Directory Application)
===========================================================================

.. note:: This article is part of the :ref:`Microsoft 365 OAuth Integration <user-guide-integrations-azure-oauth>` topic.

To integrate a configured Azure Active Directory Application:

1. Navigate to **System > Configuration > Integrations > Microsoft Settings**.

2. Provide the following details under **Microsoft Settings**:

   .. image:: /user/img/system/integrations/microsoft/azure-directory-application-settings.png
      :alt: Azure Active Directory Application Settings

|

   * **Application (Client) ID** - The client id generated on the Azure side when creating an active directory application. It is located on the main application page under **Essentials**. Selecting the *Use Default* checkbox resets the value.

   * **Directory (tenant) ID** - The directory id generated on the Azure side when creating an active directory application. It is located on the main application page under **Essentials**.

   * **Redirect URI** - Copy this value and add it to your Azure Application trusted redirect URIs in order to complete the connection.

   .. image:: /user/img/system/integrations/microsoft/redirect-url-azure-side.png
      :alt: How to connect Redirect URI

   * **Microsoft 365 Integrations** - Click **Enable Emails Sync** to enable the emails synchronization with Office 365.

3. Click **Save Settings**.

.. note:: To enable and configure the emails synchronization for users, please see
   the :ref:`User Email Synchronization Settings <my_email_configuration>`
   and :ref:`System Mailbox Synchronization Settings <admin-configuration-system-mailboxes>`.



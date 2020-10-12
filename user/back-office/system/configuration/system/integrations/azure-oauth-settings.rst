.. _configuration-integrations-azure:

Configure Microsoft Office365 oAuth Settings (Azure Active Directory Application)
=================================================================================

.. note:: This article is part of the :ref:`Microsoft Office365 OAuth Integration <user-guide-integrations-azure-oauth>` topic.

.. hint:: Microsoft Office365 oAuth is available since OroCommerce v4.1.9. To check which application version you are running, see the :ref:`system information <system-information>`.

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

   * **oAuth 2.0 for Office 365 emails sync** - Click *Enable* to connect to the Azure active directory application. Wait for the green success message to confirm authorization.

3. Click **Save Settings**.

.. note:: Once the connection between Azure and Oro has been established, you can connect Office365 account as your personal mailbox or a system mailbox in the Oro application. For instructions, please see the :ref:`User Email Synchronization Settings <my_email_configuration>` and :ref:`System Mailbox Synchronization Settings <admin-configuration-system-mailboxes>` documentation.



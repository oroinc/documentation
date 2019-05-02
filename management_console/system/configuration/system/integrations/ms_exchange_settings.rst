.. _admin-configuration-ms-exchange:
.. _admin-configuration-ms-exchange-integration-settings:

MS Exchange Settings
====================

Oro applications support the integration with Microsoft Exchange server. This means that emails from mailboxes on the MS Exchange server can be automatically uploaded to your Oro application.

.. note:: This feature is only available in the Enterprise edition.

Prerequisites for the Integration
---------------------------------

To set up an integration between your Oro application and MS Exchange Server, make sure that:
 
* Your MS Exchange Server version is 2007 or newer.
* The administrator of the Microsoft Exchange Server account has created at least one user with the permission to impersonate the necessary accounts on the related Exchange Server (super-user).

.. note:: The impersonation procedure may be different depending on the  MS Exchange version you use. More information on this is described in detail in the `Microsoft API and Reference Catalog <https://msdn.microsoft.com/en-us/library>`_ and the `Configure Impersonation <https://docs.microsoft.com/en-us/exchange/client-developer/exchange-web-services/how-to-configure-impersonation>`_ article.

Configure the Integration with MS Exchange Server
-------------------------------------------------

To configure MS Exchange integration settings in your Oro application:

1. Navigate to **System > Configuration > System Configuration > Integrations > MS Exchange**.
   
   .. image:: /user_guide/system/img/configuration/msexchange.png

2. To enable MS Exchange Integration, check **Enabled** and define the following details:

   .. csv-table::
     :header: "**Name**","**Description**"
     :widths: 10, 30
   
     "**Server**","Enter the name of your Microsoft Exchange Server instance"
     "**Version**","Choose the server version from the drop-down menu"
     "**Login and Password**","Enter the credentials of the super-user."
     "**Domain List**","Define the domains, to which you will grant access. At least one domain **must** be defined."

3. Click **Save Settings**.

.. _admin-configuration-ms-exchange-integration-settings:

MS Exchange Settings
====================

To configure MS Exchnage Integration Settings, navigate to **System>Configuration>System Configuration>Integrations>MS Exchange**.

OroCRM Enterprise Edition supports integration with Microsoft Exchange server. This means that emails from mailboxes on the MS Exchange server can be automatically uploaded to OroCRM.

This functionality enables using a single system-wide setting to collect letters of multiple users within organization.

.. image:: ../img/configuration/msexchange.png

To enable MS Exchange Integration, check :guilabel:`Enabled` and define the following details:

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Server**","Enter the name of your Microsoft Exchange Server instance"
  "**Version**","Choose the server version from the drop-down menu"
  "**Login and Password**","Enter the credentials of the super-user."
  "**Domain List**","Define the domains, to which you will grant access. At least one domain **must** be defined."

- Click the :guilabel:`Save Settings` button.



More information of MS Exchange integration setup is described in the relevant :ref:`MS Exchange guide <admin-configuration-ms-exchange>`.
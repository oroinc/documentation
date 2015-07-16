.. _admin-configuration-ms-exchange:

Integration with Microsoft Exchange Server
==========================================

OroCRM Enterprise Edition supports integration with Microsoft Exchange server. This means that 
emails from mailboxes on the MS Exchange server can be automatically uploaded of to OroCRM.

OroCRM will collect any email on the server, as long as one of its from/to fields is an email address assigned to a 
contact and the other one is an email address assigned to a user in the OroCRM.

The user can then :ref:`see these emails <user-guide-activities-emails-view>` in the activities of the contact, the 
activities of the user, and in My Emails.

The following settings have to be defined in order to set up the integration:


On the MS Exchange Side
-----------------------

You need Microsoft Exchange Server version 2007 or newer.

The administrator of the Microsoft Exchange Server account must create at least one user with the permission to impersonate 
necessary accounts on the related Exchange Server.

The impersonation procedure is different subject to a specific MS Exchange version. It is described in detail in the 
relevant documents from the `Microsoft API and reference catalog <https://msdn.microsoft.com/en-us/library>`_
(for example, this is the `document <https://msdn.microsoft.com/en-us/library/office/dn722376(v=exchg.150).aspx>`_ for 
Exchange Server 2013).

On the OroCRM Side
------------------

- Go to *System → Configuration → Integrations →  Email settings*

- Check the *"Enable"* box and define the following details:

.. csv-table::
  :header: "**Name**","**Description**"
  :widths: 10, 30

  "**Server**","Enter the name of your Microsoft Exchange Server instance"
  "Version","choose the server version from the drop-down menu"
  "Login and Password","Enter the credentials of a user that has the permission to impersonate necessary accounts on the 
  related Exchange Server."
  "**Domain List**","Define the domains, to which you will grant access. At least one domain **must** be defined."

- Click the :guilabel:`Save Settings` button.
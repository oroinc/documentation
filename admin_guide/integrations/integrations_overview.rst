.. _user-guide-integrations:

OroCRM Integrations Overview
============================

OroCRM supports two types of integrations: 

- Integrations that are configured at the system level and share the same configuration for all :term:`organizations <Organization>` in an OroCRM instance. These integrations (or any combination of them) can be enabled/disabled and configured in the *"System → Configuration → Integration"*.

  These are:

  - Pre-implemented :ref:`Google single sign-on functionality <user-guide-google-single-sign-on>`: Allows users to log in to OroCRM with their organization Google Apps for Work, Education or Government account, or their personal Google account if their Google account email address and OroCRM primary email address are the same.

  - Pre-implemented :ref:`Integration with Microsoft Exchange server <admin-configuration-ms-exchange>`: Allows OroCRM users to access contents of their mailboxes on the server directly in the OroCRM UI. (Available for enterprise edition only).

  - Pre-implemented :ref:`Integration with Microsoft Outlook <user-guide-synch-outlook>`: Allows automatic bi-directional synchronization of the OroCRM contacts, tasks and calendar events that are available to the users with their Microsoft Outlook applications. (Available for enterprise edition only).

- Integrations that are configured at the :term:`organization <Organization>` or :term:`channel <Channel>` level. These integrations allow for adjustment of third-party system integration parameters (e.g. credentials, account IDs, synchronizations settings, etc.) for different channels and/or organizations.

  These are:

  - Pre-implemented :ref:`Integration with Magento <user-guide-magento-channel-integration>`: Allows for data synchronization with Magento-based eCommerce stores, including customer contact information, online purchase history and abandoned carts information to provide 360° view of the client. Sales and support personnell can complete orders for the Magento store customers within the OroCRM UI.
  
  - Pre-implemented :ref:`Integration with Zendesk <user-guide-zendesk-integration>`: Allows loading data 
    from a Zendesk account and processing it in OroCRM.

  - Pre-implemented :ref:`Integration with MailChimp <user-guide-mc-integration>`: Allows mapping OroCRM 
    Marketing Lists and Abandoned Cart Campaigns to segments of MailChimp Subscriber's Lists. The segments can be kept 
    synchronized and used to create email campaigns in MailChimp. These campaigns and related campaign 
    statistics can be imported back to OroCRM.

  - Pre-implemented :ref:`Integration with dotmailer <user-guide-dotmailer-overview>`: Allows mapping OroCRM
    Marketing Lists to an address book at dotmailer. The address books can be used to create email campaigns in
    dotmailer. These campaigns and related campaign statistics can be imported back to OroCRM.

.. hint::

    Along with pre-implemented integration capabilities, OroCRM can also be integrated with other third-party
    systems.


.. _user-guide-integrations:

OroCRM Integration and Synchronization Capabilities Overview
============================================================

OroCRM supports two types of integrations: 

- Integrations applied to the whole system. There can only be one integration with a third-party system for an OroCRM 
  instance. These integrations can be enabled/disabled and defined in the *"System → Configuration → Integration"*.
  These are:

  - :ref:`Google single sign-on functionality <admin-configuration-google-settings>` which enables user with the same 
    Google account email address and OroCRM primary email address to log-in only once in the session.

  - :ref:`Integration with Microsoft Exchange server <admin-configuration-ms-exchange>` which allows automatic uploading 
    of emails from mailboxes on the server to OroCRM. (Available for enterprise edition only).

  - :ref:`Integration with Microsoft Outlook <user-guide-synch-outlook>`, which allows automatic synchronization of all 
    the contacts, tasks and calendar events available for the user can be synchronized with the specified Outlook account 
    and vice versa.  (Available for enterprise edition only).
  
- Integrations applied at the :term:`organization <Organization>` or :term:`channel <Channel>` level. There can be 
  several integrations with a third-party system used for different channels and/or organizations. These are:
  
  - Pre-implemented :ref:`Integration with Magento <user-guide-magento-channel-integration>` which enables loading  data 
    from and to a Magento-based eCommerce store ("Magento store") and processing it in the OroCRM.
  
  - Pre-implemented :ref:`Integration with Zendesk <user-guide-zendesk-integration>` which enables loading data 
    from your Zendesk account and process it in OroCRM.

  - Pre-implemented :ref:`Integration with MailChimp <user-guide-mc-integration>` which enables mapping OroCRM 
    Marketing Lists and Abandoned Cart Campaigns to segments of MailChimp Subscriber's Lists, keep them 
    synchronized and use these segments to create email campaigns in MailChimp and import the campaigns and campaign 
    statistics back to OroCRM.

  - Pre-implemented :ref:`Integration with Dotmailer <user-guide-dm-integration>` which enables mapping OroCRM 
    Marketing Lists to an address book at Dotmailer, create email campaigns using these address books and import the 
    campaigns and campaign statistics back to OroCRM.

.. hint::

    Along with pre-implemented integration capabilities, OroCRM can be integrated with other third-party
    systems.
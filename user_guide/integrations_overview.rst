.. _user-guide-integrations:

OroCRM Integration and Synchronization Capabilities Overview
============================================================

OroCRM supports two types of integrations: 

- Integrations applied to the whole system. There can only be one integration with a third-party system for an OroCRM 
  instance. These integrations can be enabled/disabled and defined in the *"System → Configuration → Integration"*.
  These are:

  - :ref:`Google single sign-on functionality <admin-configuration-google-settings>`: Allows users that have the same 
    Google account email address and OroCRM primary email address to log-in only once during a session.

  - :ref:`Integration with Microsoft Exchange server <admin-configuration-ms-exchange>`: Allows automatic uploading 
    of emails from mailboxes on the server to OroCRM. (Available for enterprise edition only.)

  - :ref:`Integration with Microsoft Outlook <user-guide-synch-outlook>`: Allows automatic synchronization of all 
    the contacts, tasks and calendar events available for the user with the specified Outlook account 
    and vice versa. (Available for enterprise edition only).
  
- Integrations applied at the :term:`organization <Organization>` or :term:`channel <Channel>` level. There can be 
  several integrations with a third-party system for different channels and/or organizations. These are:
  
  - Pre-implemented :ref:`Integration with Magento <user-guide-magento-channel-integration>`: Allows loading  data 
    from and to a Magento-based eCommerce store ("Magento store") and processing it in the OroCRM.
  
  - Pre-implemented :ref:`Integration with Zendesk <user-guide-zendesk-integration>`: Allows loading data 
    from a Zendesk account and processing it in OroCRM.

  - Pre-implemented :ref:`Integration with MailChimp <user-guide-mc-integration>`: Allows mapping OroCRM 
    Marketing Lists and Abandoned Cart Campaigns to segments of MailChimp Subscriber's Lists. The segments can be kept 
    synchronized and used to create email campaigns in MailChimp. These campaigns and related campaign 
    statistics can be imported back to OroCRM.

  - Pre-implemented :ref:`Integration with DotMailer <user-guide-dm-integration>`: Allows mapping OroCRM 
    Marketing Lists to an address book at Dotmailer. The address books can be used to create email campaigns in 
    DotMailer.  These campaigns and related campaign statistics can be imported back to OroCRM.

.. hint::

    Along with pre-implemented integration capabilities, OroCRM can also be integrated with other third-party
    systems.
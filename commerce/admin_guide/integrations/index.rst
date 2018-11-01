.. _user-guide-integrations:

Integrations
============

OroCommerce supports the following pre-implemented integrations:

- Integrations that are configured on the system level and share the same configuration for all :term:`organizations <Organization>` in an Oro instance. These integrations (or any combination of them) can be enabled/disabled and configured in **System > Configuration > Integration**.

  These are:

  - :ref:`Google Single Sign-on <user-guide-google-single-sign-on>`: Enables you to log into Oro with their organization Google Apps for Work, Education or Government account, or their personal Google account if their Google account email address and Oro primary email address are the same.

  - :ref:`Google Hangouts Voice and Video Calls <user-guide-hangouts>`: Enables you to make Hangouts voice or video calls from within your Oro application.

  - :ref:`Microsoft Exchange Server <admin-configuration-ms-exchange>`: Enables users to access contents of their mailboxes on the server directly in the Oro application UI. (Available for Enterprise edition only).

  - :ref:`LDAP <user-guide-ldap-integration>`: Enables uploading the existing user records into Oro applications and map LDAP user role identifiers to Oro application roles.

- Integrations that are configured at the :term:`organization <Organization>` level. These integrations enable adjustment of third-party system integration parameters (e.g. credentials, account IDs, synchronizations settings, etc.) for different organizations.

  These are:

  - :ref:`Zendesk <user-guide-zendesk-integration>`: Enables loading data from a Zendesk account and processing it in Oro applications.

  - :ref:`MailChimp <user-guide-mc-integration>`: Enables mapping Oro Marketing Lists and Abandoned Cart Campaigns to segments of MailChimp Subscriber's Lists. The segments can be kept synchronized and used to create email campaigns in MailChimp. These campaigns and related campaign statistics can be imported back to Oro applications.

  - :ref:`dotmailer <user-guide-dm-integration>`: Allows mapping Oro Marketing Lists to an address book in dotmailer. The address books can be used to create email campaigns in dotmailer. These campaigns and related campaign statistics can be imported back to Oro applications.

- :ref:`Embedded Forms <admin-embedded-forms>`: Enable users to create code that can be added to a third party website

- :ref:`OroCRM and OroCommerce <user-guide-commerce-integration>`: Provides seamless experience of two applications working as one within a single system.

.. comment: OroCommerce already comes with CRM out of the box.


.. hint:: Along with the pre-implemented integration capabilities, Oro applications can also be integrated with other third-party systems.

.. toctree::
   :maxdepth: 1
   :hidden:

   google/index
   ldap_integration
   mailchimp_configuration
   dotmailer/index
   ms_exchange/index
   embedded_forms
   zendesk_integration
   commerce_integration
   


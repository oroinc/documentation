.. _user-guide-integrations:

Integrations
============

.. insert the integrated system logos + links to the related doc.

Oro application supports two types of integrations:

- Integrations that are configured on the system level and share the same configuration for all :term:`organizations <Organization>` in an Oro instance. These integrations (or any combination of them) can be enabled/disabled and configured in **System > Configuration > Integration**.

  These are:

  - Pre-implemented :ref:`Google single sign-on functionality <user-guide-google-single-sign-on>`: Enables users to log into Oro with their organization Google Apps for Work, Education or Government account, or their personal Google account if their Google account email address and Oro primary email address are the same.

  - Pre-implemented :ref:`Integration with Microsoft Exchange server <admin-configuration-ms-exchange>`: Enables Oro users to access contents of their mailboxes on the server directly in the Oro UI. (Available for enterprise edition only).

  - Pre-implemented :ref:`Integration with Microsoft Outlook <config-guide--integrations--ms-outlook>`: Enables automatic bi-directional synchronization of the Oro contacts, tasks and calendar events that are available to the users with their Microsoft Outlook applications. (Available for enterprise edition only).

- Integrations that are configured at the :term:`organization <Organization>` level. These integrations enable adjustment of third-party system integration parameters (e.g. credentials, account IDs, synchronizations settings, etc.) for different organizations.

  These are:

.. Pre-implemented :ref:`Integration with Magento <user-guide-magento-channel-integration>`: Allows for data synchronization with Magento-based eCommerce stores, including customer contact information, online purchase history and abandoned carts information to provide 360° view of the client. Sales and support personnell can complete orders for the Magento store customers within the Oro UI.

  - Pre-implemented :ref:`Integration with Zendesk <user-guide-zendesk-integration>`: Allows loading data
    from a Zendesk account and processing it in Oro.

  - Pre-implemented :ref:`Integration with MailChimp <user-guide-mc-integration>`: Allows mapping Oro
    Marketing Lists and Abandoned Cart Campaigns to segments of MailChimp Subscriber's Lists. The segments can be kept
    synchronized and used to create email campaigns in MailChimp. These campaigns and related campaign
    statistics can be imported back to Oro.

  - Pre-implemented :ref:`Integration with dotmailer <user-guide-dm-integration>`: Allows mapping Oro
    Marketing Lists to an address book at dotmailer. The address books can be used to create email campaigns in
    dotmailer. These campaigns and related campaign statistics can be imported back to OroC.

.. hint::

    Along with pre-implemented integration capabilities, Oro can also be integrated with other third-party
    systems.

.. doc:`/admin_guide/integrations/ms_exchange_integration_settings`

.. doc:`/admin_guide/integrations/ms_exchange_integration`

.. doc:`/admin_guide/integrations/magento_channel_integration`

.. toctree::
    :maxdepth: 1

    google_integration_settings
    google_single_sign_on
    ldap_integration
    mailchimp_configuration
    dotmailer_integration
    dotmailer_integration_settings
    dotmailer_configuration
    dotmailer_single_sign_on
    ms_exchange_integration_settings
    ms_exchange_integration
    outlook/index
    embedded_forms
    hangouts
    zendesk_integration
    commerce_integration

..    magento_channel_integration

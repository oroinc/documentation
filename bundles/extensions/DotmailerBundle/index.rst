.. _bundle-docs-extensions-dotdigital:

OroDotmailerBundle
==================

|OroDotmailerBundle| provides |integration| with |Dotdigital| marketing automation platform for Oro applications.

The bundle enables users to create and configure the integration and connect Oro marketing lists to Dotdigital address books. It provides UI to set data fields mapping between Dotdigital data and Oro application entities and schedule synchronization or start it manually.

Setting Up Connection
---------------------

For steps on configuring the integration on the dotdigital and Oro sides, please see :ref:`user configuration documentation <user-guide-dotmailer-configuration>`.

Be aware that the Oro application exports data into Dotdigital asynchronously using a message queue processor. This export job has low priority, as it has to wait until Dotdigital WatchDog finishes its checks, and the time it takes is unpredictable. Until Dotdigital returns the export status, the Oro address book is not updated. To avoid any discrepancies in the Dotdigital and OroCRM data, the running export process blocks the launch of any new exports to Dotdigital. As soon as the Oro application gets a response from Dotdigital about the export process completion, marketing list statuses are updated on the Oro side, and further exports are processed.

Connecting a Marketing List to Dotdigital
-----------------------------------------

Once the integration has been created and its status is set to **Active**, the list of address books are automatically imported from Dotdigital to Oro, and Oro marketing lists can be connected to the Dotdigital address books.

For steps on connecting a marketing list to Dotdigital, please see the :ref:`Send Email Campaign via Dotdigital topic <user-guide-dotmailer-campaign>`.

Dotdigital Data Fields and Mappings
-----------------------------------

For details on managing data fields and mappings, please see the :ref:`Manage Dotdigital Data Fields and Mappings <user-guide-dotmailer-data-fields>` topic.

After mapping is configured, tracking of changes done on mapped real fields is performed automatically and processed every 5 minutes.
Changes done on virtual fields used in the mappings are not tracked. The `oro_dotmailer.on_build_mapping_tracked_fields` event can be used to customize the list of fields to track.

Import Synchronization Logic
----------------------------

Import is performed with the *oro:cron:integration:sync* cron command after the integration has been saved and once every four minutes after a connection has been created.

- **Address book**: All Dotdigital address books are imported except "All Contacts" and "Test" (these Books are created for each Dotdigital account by default).
- **Campaign**:  Details of campaigns sent to the contacts on address books connected to Oro marketing lists are imported.

For each Dotdigital campaign imported, a new email campaign and a Marketing Campaign are created in Oro. During the import, the campaign-related details are synchronized during the following imports as follows:

- **Dotdigital contact**: Import all the Dotdigital contacts from all the address books imported to Oro (the contacts are added to the database and used at the backend, they will not be visible in the UI).
- **Unsubscribed contact**: Import all the contacts suppressed/unsubscribed from the address book since the first import. The status of these contacts in the related Oro marketing lists is set to unsubscribed.
- **Contact activity**: All the contact activities performed within a Dotdigital Campaign previously imported to OroCRM are imported to Oro. Activities (send, open, click, etc.) are additionally stored as marketing activities. In case several Dotdigital email campaigns should be a part of a single marketing campaign, several automatically generated marketing campaigns can be merged within the campaigns grid.
- **Campaign summary**: A campaign summary is imported for each campaign previously imported to Oro.

Each contact activity is mapped to Oro Marketing List Item and Email Campaign Statics by the Email value.

Export Logic
------------

Exporting the campaign details from Oro to Dotdigital is performed with the *oro:cron:dotmailer:export* cron command once every four minutes after a connection has been created.

Export is performed in four steps, as follows:

- **Exporting removed contacts**: If a subscriber has been removed/unsubscribed from an Oro marketing list, the contacts are removed from the connected address book.
- **Syncing marketing list item state**: Subscribers of the Oro marketing list are checked against the unsubscribed contacts of the related marketing campaign and unsubscribed from the marketing list if necessary.
- **Preparing contacts for export**: The status of contacts to be exported to Dotdigital is changed.
- **Exporting contacts**: A CSV file with contacts to be exported is sent to Dotdigital

After the export is finished, the command checks the export status on the Dotdigital side. When the export is finished on the Dotdigital side, the command imports Dotdigital contacts to get the origin ID from Dotdigital. Otherwise, the following export command does it.

Dotdigital Single Sign-On
-------------------------

To enter the Dotdigital account straight from the application, use a single sign-on feature. To configure it, please see the :ref:`Configure Dotdigital Single Sign-on in the Back-Office topic <user-guide-dotmailer-single-sign-on>`.


.. include:: /include/include-links-dev.rst
   :start-after: begin

**Read More:**

- :ref:`Configure Dotdigital Integration <user-guide-dotmailer-configuration>`
- :ref:`Configure Dotdigital Synchronization Settings <admin-configuration-dotmailer-integration-settings>`
- :ref:`Manage Dotdigital Data Fields and Mappings <user-guide-dotmailer-data-fields>`
- :ref:`Configure Dotdigital Single Sign-on <user-guide-dotmailer-single-sign-on>`
- :ref:`Send Email Campaigns via Dotdigital <user-guide-dotmailer-campaign>`
:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-dotmailer-campaign:

Send Email Campaign via Dotdigital
==================================

Flow
----

.. image:: /user/img/marketing/marketing/dotdigital/oro_dotdigital_integration.png
   :alt: The process of sending an email campaign via Dotdigital displayed in a flow

Prepare Data for the Campaign in Oro
------------------------------------

Email campaigns are based on data in marketing lists.

To add a campaign, first, create a marketing list. This list will be synchronized with the Dotdigital address book.

1. Navigate to **Marketing > Marketing Lists** and click **Create Marketing List**.
2. Complete the following fields:

   * **Name** --- The name used to refer to the marketing list in the system.
   * **Description** --- Optional field. Can be filled with text to help you and other users understand the purpose of the list in the future.
   * **Entity** --- Data to be synchronized into the marketing list will depend on the selected entity.
   * **Type** --- The type of marketing list update. *Dynamic* means that all changes you make to your marketing list are automatic. *On Demand*  means that updates are performed manually.
   * **Owner** --- Limits the list of users that can manage the marketing list to the users whose :ref:`roles <user-guide-user-management-permissions-roles>` allow managing marketing lists of the owner.

You can add multiple columns to your marketing list, but at least one column must contain contact information. In our
case, it is vital to add an email column along with the first and last name of the contact.

.. image:: /user/img/marketing/marketing/dotdigital/create_ml_oro.jpg
   :alt: Creating a new marketing list

2. Click **Save and Close**.

Sync Oro Marketing List Data with the Dotdigital Address Book
-------------------------------------------------------------

Once you configure the integration and set its status to **Active**, the list of address books will be automatically imported from Dotdigital to the Oro application. At this point, you can connect Oro marketing lists to the existing Dotdigital address books.

As an illustration, let us create a new **Address Book** on the Dotdigital side.

1. In your Dotdigital account, navigate to the top right corner and select **Contacts** from the dropdown. Click **New Address Book** to get redirected to a page with the following fields to fill in:

   * **Name** --- Enter the name for your address to identify it within the system.
   * **Folder** --- By default, *Address Books* is the selected folder.
   * **Description** --- Add description for the address book if necessary.

   .. image:: /user/img/marketing/marketing/dotdigital/dotmailer_create_address_book.png
      :alt: Creating a new address book on the Dotdigital side

2. Click **Save**.

.. hint:: In Oro, you can add new address books straight from the **Connect to dotdigital** dialog box.

Next, upload contacts from the Oro application into our newly created address book in Dotdigital. For the Oro application to see this address book:

1. Go back to OroCRM/OroCommerce.
2.  Navigate to **System > Manage Integrations**.
3. Select your Dotdigital integration.
4. Click **Schedule Sync** in the top right corner.

You can map contacts from the Oro marketing list into your Dotdigital address book the following way:

1. Navigate to **Marketing > Marketing Lists** and select the list you want to use.
2. Click **Connect to dotdigital** in the top right corner.

   .. image:: /user/img/marketing/marketing/dotdigital/connect_dotdigital_button.png
      :alt: Click Connect to Dotdigital in the top right corner

3. A pop-up form will emerge with the following fields to be defined:

   * **Integration** --- Choose your **Integration** from the list of integrations available in your Oro instance.
   * **Address Book** --- Select the address book we have just created from the list of all Dotdigital address books available for connection. Note that the list will not contain the **All Contacts** and **Test** address books that are automatically generated in Dotdigital. Nor will it contain the address books that have already been connected to another marketing list in Oro.
   * **Create New Entities** --- This check box controls whether new entities can be created. If a contact is found in an address book but no email match in the application is found, a new entity will be created in the application based on the mapping setup. A new entity will be created only if **two way sync** mapping is configured for each of the entity's required fields.

   .. image:: /user/img/marketing/marketing/dotdigital/connect_dotdigital_address_book.png
      :alt: Selecting the necessary address book from the dropdown of the popup dialog box

4. As soon as the connection is saved, contacts from the marketing list are automatically exported from Oro to Dotdigital. Since then, data synchronization (import and export) between Oro and Dotdigital are performed automatically every 4 minutes.

   .. note:: One marketing list can only be connected to one Dotdigital address book and vice versa. Therefore, each connected Oro marketing list will be represented as an address book in Dotdigital. Also, note that you can connect only marketing lists with email fields.

5. Once you have connected your marketing list, you will notice a **dotdigital button** appear at the top (instead of **Connect to dotdigital**) with the following actions in the dropdown:

   * **Synchronize** --- Start sync between the marketing list and the address book manually.
   * **Refresh Data Fields** --- Manually mark all updated marketing lists to ensure data fields data is up to date in Dotdigital after the next synchronization.
   * **Connection Settings** --- Change connection or integration for the current marketing list in OroCRM.
   * **Disconnect** --- Disconnect the list from the segment.

   .. image:: /user/img/marketing/marketing/dotdigital/dotdigital_connected_new.png
      :alt: The actions available in the dropdown list under the Dotdigital button

6. At this point, if you go back to Dotdigital, you will be able to see the data from your Oro application (subscribers’ first and last names and contact details) synced into your Dotdigital address book.

Create and Send Campaign on the Dotdigital Side
-----------------------------------------------

We have configured the integration between Oro and Dotdigital and created a mailing list on the Oro side and an address book on the Dotdigital side. It is time to create a new email campaign via Dotdigital:

1. Hover over the **Email campaigns** menu in your Dotdigital account and select **New campaign**.

    .. image:: /user/img/marketing/marketing/dotdigital/dotdigital_select_new_campaign.png
       :alt: Show the New Campaign submenu under the Campaign menu in your Dotdigital account

2. Select a template for your email campaign.

    .. image:: /user/img/marketing/marketing/dotdigital/dotdigital_pick_campaign_template.png
       :alt: Display available templates for your email campaign

3. Give your campaign a name and click **Continue**.
4. On the next page, complete the following fields:

    * **Subject Line**  --- Enter the subject for your email.
    * **Friendly From Name** --- Enter the name of the sender.
    * **Select From Address** ---  The Dotdigital assigns its own email address and domain so that in case of any complaints or issues, they would be separate from your current domain.
    * **Optional Forwarding Address** --- Email responses can be forwarded to your regular email address.
    * **Campaign Tags** --- Enter tags for your email campaign.

5. Personalization is available for two fields: **Subject Line** and **Friendly From Name**.

    It is possible to prefix the recipient’s name with the data stored in the Oro application. You can do this by clicking on the icon above the field (as shown in the screenshot) and selecting the personalization option that suits you best from the dropdown menu.

    .. image:: /user/img/marketing/marketing/dotdigital/dotdigital_create_campaign.png
       :alt: Highlight the icons to be clicked to prefix the recipient’s name with the data stored in the Oro application

6. Click **Save and Continue**. You will be redirected to the **Test and Proof Your Email** page.
7. On the **Test and Proof Your Email** page, it is possible to choose contacts to send a text version of your email to the selected email addresses.
8. Click **Test Send** when you have chosen your contacts. You should have a copy of the email delivered to the specified email address.
9. When you finish, click **Continue** to get redirected to the next page and select contacts for the campaign:

    -  Select the address book we have created before.
    -  Select when you want to send your campaign (**Immediately**, **Scheduled**, **Optimized**).
    -  Specify whether you wish to resend this campaign.
    -  Add event-triggered emails or autoresponders to the email (if necessary).

10. Click **Save and Continue** and confirm your selection by clicking **Continue**.
11. Review your campaign details and click **Send Immediately** at the bottom.
12. Click **Confirm** to confirm sending.

Check Statistics for Your Campaign
----------------------------------

To check the statistics for your campaign on the Dotdigital side, navigate to **Reporting > Campaign Reports** on the top right.

Receive Campaign Statistics on the Oro Side
-------------------------------------------

Once you have sent out your email campaign in Dotdigital, information about your email campaign should have been exported to your Oro application.

As soon as the export is complete, your email campaign should appear in **Marketing > Email Campaigns**. By clicking on your recent campaign, you can see subscriber activity statistics, such as the number of clicks, bounces, opens, etc. Numbers in each column for each contact define the number of times an action has been performed, e.g., 2
opens, 1 click, 1 unsubscribe.

These statistics will help you understand the outcome of your campaign and let you filter contacts for the next one.

For example, if you want to send your next email campaign to those contacts who have opened your previous emails, go to **Marketing > Marketing List** and click **Create New Marketing List**. Fill in the mandatory fields, remembering to include at least one contact column below.

In the **Filters** section:

1. Drag **Field Condition** to set conditions to the list.
2. Select **Contact > Marketing List > Marketing List (Email Campaign)/Email Campaign (Dotdigital Campaign)/Activities > Opens Number**.
3. Set field value to '=1.'
4. When ready, click **Save and Close**.

   .. .. image:: /user/img/marketing/marketing/dotdigital/oro_statistics_general_opens.jpg
         :alt: Apply the mentioned filter conditions

This list will now appear on the marketing list page and contain all contacts who have opened your previous emails.

Similarly, you can apply any conditions of your choice.

**Related Articles**

* :ref:`Configure the Dotdigital Integration <admin-configuration-dotmailer-integration-settings>`
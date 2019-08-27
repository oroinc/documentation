.. _user-guide-mailchimp-campaign:

Send an Email Campaign via MailChimp
====================================

Oro applications support an out-of-the-box integration with MailChimp, enabling you to:

* Map the Marketing Lists as segments in MailChimp and keep them synchronized.
* Use existing segments in MailChimp and import them to the Oro application.
* Schedule importing statistics of the MailChimp campaigns into Oro Application.

.. image:: /user/img/marketing/marketing/mailchimp/mc_diagram.png
   :alt: Sending email campaign via mailchimp

.. note:: To use MailChimp with the Oro application, ensure that all the necessary integration steps are completed. See :ref:`MailChimp Integration <user-guide-mc-integration>` for more information.

Prepare Data for the Campaign in Oro
------------------------------------

Email campaigns are based on data in marketing lists. 

To create a campaign in the Oro application, create a :ref:`Marketing List <user-guide-marketing-lists>` first. This list will create a segment on the MailChimp side:
 
1. Navigate to **Marketing > Marketing Lists > Create Marketing List** in the main menu.
2. Click **Create Marketing List** on the top right. 
3. Complete the following fields:

   * **Name** --- The name used to refer to the marketing list in the system.       
   * **Description** --- Optional field. Can be filled with text to help you and other users understand the purpose of the list in future.   
   * **Entity** --- Data to be synchronized into the marketing list will depend on the selected entity.   
   * **Type** --- The type of marketing list update. *Dynamic* means that all changes you make to your marketing list are automatic. *On Demand*  means that updates are performed manually.
   * **Owner** --- Limits the list of users that can manage the marketing list to the users, whose :ref:`roles <user-guide-user-management-permissions-roles>` allow managing marketing lists of the owner. 

   .. important:: You can add multiple columns to your marketing list in Oro, but only First Name, Last Name, and Email details are synced over to MailChimp.

4. Add email information to the marketing list to send an email campaign via MailChimp.

   .. image:: /user/img/marketing/marketing/mailchimp/o_marketing_list_email.jpg
      :alt: Add email field to the columns

5. Click **Save and Close**.

Sync Oro Marketing List Data with a MailChimp List
--------------------------------------------------

MailChimp Side
^^^^^^^^^^^^^^

To create a list on the MailChimp side:

1. Login to your MailChimp account.
#. Click **Lists** in the menu above.
#. Click **Create List** on the top right, and then **Create List** in the popup.

   .. image:: /user/img/marketing/marketing/mailchimp/mc_create_list.png
      :alt: Create a new marketing list in MailChimp

#. Provide the following information:

   * **List Name** --- The name of the list that will be seen by all your subscribers. 
   * **Default From Email Address** --- Enter the address people can reply to.   
   * **Default From Name** --- The name that will be displayed as the sender of the email, e.g., name of your company.
   * **Campaign URL Settings** --- Choose a verified domain to use in your |campaign URLs|. You must be authorized to use the domain name you choose.
   * **Remind People How They Signed up to Your List** --- Provide meaningful information in the text field, or reuse a reminder from another list, if necessary.
   * **Contact Information for This List** --- Enter/edit your contact address information. 
   * **Notifications** --- Select the notifications to be sent to your provided email.  

     * *Daily summary* --- Summary of subscribe/unsubscribe activity   
     * *One-by-one* --- Subscribe notifications as they happen 
     * *One-by-one* --- Unsubscribe notifications as they happen
   * **Form Settings** --- enable double opt in and/or the GDPR fields.

      * *Enable double opt-in* --- Send contacts an opt-in confirmation email when they subscribe to your list.
      * *Enable GDPR fields* --- Customize forms to include GDPR fields.

#. Click **Save** at the bottom of the page. 

Oro Side
^^^^^^^^

To upload subscribers from OroCRM into the newly created MailChimp list, synchronize the applications: 

1. Open Oro application.
#. Navigate to **System > Manage Integrations** in the main menu.
#. Click on the MailChimp integration to open its page.
#. Click **Schedule Sync**.

To map contents of the Oro application marketing list to use a segment of the **Subscribers List** in MailChimp:

1. Navigate to **Market > Marketing Lists** in the main menu.
#. Click on the required marketing list to open its details page.
#. Click **Connect to MailChimp** in the top right corner.
#. Provide the **MailChimp Segment Name**.
#. Select the **MailChimp Integration**.
#. Select the **MailChimp Subscribers List** that you have created.
#. Click **Connect**.

   .. image:: /user/img/marketing/marketing/mailchimp/o_select_mc_subscribers_list2.png
      :alt: Map contents of an Oro marketing list to use a segment of the subscribers' list in MailChimp

Once you are connected, the MailChimp button is displayed at the top with the following actions in the dropdown:

* **Synchronize** --- Start sync manually
* **Connection Settings** --- Change connection or integration for the current marketing list in the Oro application
* **Disconnect** --- Disconnect the list from the segment

.. image:: /user/img/marketing/marketing/mailchimp/ml_connected_to_mc.png
   :alt: The marketing list is connected to mailchimp

.. note:: Please be aware that if a marketing list contains invalid emails, they can be rejected by MailChimp and excluded from further synchronization.

At this point, if you go back to MailChimp, you will be able to see data from the Oro application (subscribers’ first and last names and contact details)
synced into your MailChimp list. Please keep in mind that other information that you may have specified when creating a list on the Oro side, such as dates of
birth or custom details, *are not synced*.

.. image:: /user/img/marketing/marketing/mailchimp/mc_test_list2.jpg
   :alt: Columns that will be synced

Create a Campaign in MailChimp
------------------------------

Select Campaign Type
^^^^^^^^^^^^^^^^^^^^

Now that you have configured the integration with MailChimp and created a
marketing list, you can create and send an email campaign in MailChimp:

1. Log into your MailChimp account.
#. Click **Campaigns** in the main menu.
#. Click **Create Campaign** on the top right.

   .. image:: /user/img/marketing/marketing/mailchimp/mc_create_campaign.png
      :alt: Create and send campaign on the MailChimp side

#. Click **Create an Email** in the popup.

   .. image:: /user/img/marketing/marketing/mailchimp/new_create_email_camp_mc.png
      :alt: The popup dialog in MailChimp displaying the button to create a new email

#. Select the type of the campaign to send:

   *  Regular
   *  Automated
   *  Plain-text
   *  A/B Test

   .. image:: /user/img/marketing/marketing/mailchimp/campaign_types_mc.png
      :alt: Select the campaign type

   .. warning:: Please note that Oro is unable to receive email campaigns from segments used in automation programs.

#. Enter the campaign name.

Add Campaign Details
--------------------

Once you selected the campaign type, provide the following information for the campaign:

.. image:: /user/img/marketing/marketing/mailchimp/create_campaign_mc_steps.png
   :alt: Steps for the campaign in mailchimp

1. **To** --- Click **Add Recipients** to select the list segment for the email campaign. 

   .. image:: /user/img/marketing/marketing/mailchimp/mc_select_list_segment.png
      :alt: Select the list segment for the email campaign in MailChimp 
   
   * **List** --- Select your marketing list from the dropdown.
   * **Segment** --- Select the marketing list segment that you created previously. 
   
     .. note:: Make sure that you send your email campaign to a **segment** of the list, i.e. a selected number of contacts within the entire list of subscribers. Otherwise, the contacts will **not** get synced back to the Oro application.
 
     **Pre-Built Segments** section of the same page allows you to choose contacts based on subscriber engagement (New Subscribers, Active Subscribers, Inactive Subscribers), or customer behavior (Repeat Customers)  and demographics (available after connection to your store).

   * **Personalize the** *To* **field > Mere Tag** --- Select this check box to personalize the emails in your campaign. This adds relevance to your emails and helps avoid spam filters. You will be asked to include **Merge Tags** to your email. Merge tags are personalization options. They include the names of the subscribers you want to send your emails to. In the provided field, specify merge tags for your recipients, i.e. \*\|FNAME\|\* or \*\|FNAME\|\* \*\|LNAME\|\*\ **.**
     
    .. image::/img/marketing/marketing/mailchimp/static_segment_mc.png
       :alt: Adding campaign details in MailChimp and selecting a static segment

   Click **Save** to proceed to the next step.

2. **From** --- Click **Add From** to provide the sender name and email address.

   .. image:: /user/img/marketing/marketing/mailchimp/add_sender_details_to_campaign.png
      :alt: Adding sender details to the campaign

   Click **Save** to proceed to the next step.

3. **Subject** --- Click **Add Subject** to provide the subject line and preview text for the campaign.

    .. image:: /user/img/marketing/marketing/mailchimp/subject_line_campaign.png
       :alt: Adding a subject line and a preview text for the campaign
   
   Click **Save** to proceed to the next step.

4. **Content** --- Click **Design Email** to add content for your email. You will be redirected to a new page to select a pre-set campaign template or
create your own.

   When you have chosen the template that suits you best, go the next page and design your email following the instructions on the page.

   .. image:: /user/img/marketing/marketing/mailchimp/design_campaign_template.png
      :alt: Select a template among a pre-set number of campaign templates or create your own
   
   To ensure that your address each of your contacts by name, select **Merge Tags** and **First Name** in the options within **Content** text window. This way, if you type in Hi \*\|FNAME\|\*, your subscribers will see their first name instead of their email address in the campaign they receive from you.
  
   Click **Save and Close** and review what you have done before it goes out to your subscribers.

5. In the **Settings and Tracking** you can add the options relevant to your campaign (e.g., track opens, track clicks, etc). If you
wish to promote your email in social media, select **Connect to Twitter** or **Connect to Facebook**.

6. Review campaign details and click **Send** on the top right.
   
   .. image:: /user/img/marketing/marketing/mailchimp/review_campaign_content.png
      :alt: Review campaign details before sending

7. Click **Send Now**

    .. image:: /user/img/marketing/marketing/mailchimp/prepare_for_launch.png
       :alt: Send the email campaign from mailchimp

8. To look at your campaign statistics on the MailChimp side, click **Track Performance in Reports** on the same page. 

   .. image:: /user/img/marketing/marketing/mailchimp/campaign_sent.png
      :alt: A message informing that the email campaign is sent

   To do this manually, navigate to **Campaigns > View Report**. 
   
    .. image:: /user/img/marketing/marketing/mailchimp/view_report_campaign_mc.png
       :alt: View the report for a selected campaign

   Here, you check out subscriber activity for your newly created email campaign.

Receive Campaign Statistics on the Oro Side
-------------------------------------------

Once you have sent out your email campaign in MailChimp, information about your email campaign should have been exported to OroCRM.

As soon as export has been completed, your email campaign should appear in **Marketing > Email Campaigns.** By clicking on your recent campaign,
you will be able to see subscriber activity statistics, such as the number of clicks, bounces, opens, etc. Numbers in each column for each
contact define the number of times an action has been performed, e.g., 2 opened, 1 click, 1 unsubscribe. These statistics will help you understand the outcome of your campaign and let you filter contacts for the next one.

.. image:: /user/img/marketing/marketing/mailchimp/o_email_campaign_info.jpg
   :alt: Receive campaign statistics on the Oro application side

.. note:: Please note that sometimes Mailchimp's summary information may not match the OroCRM summary in the same report. This may happen because one set of statistics comes from Mailchimp directly. The other is generated as we receive specific reporting data back about recipients.

For instance, if you need to exclude customers who did not open your email from the next campaign, go to **Marketing > Marketing List> Create New Marketing List.** Fill in the mandatory fields, remembering to include at least one contact column below.

In the :ref:`Filters <user-guide-getting-started-filters>` section:

1. Drag **Apply Segment** to the field on the right.
2. Choose the list that you used for your previous campaign.
3. Drag **Field Condition** to set the conditions to the list.
4. Select **Contact > Contact Method (Contact) > Contact (Magento Customer) > Marketing List (Email Campaign) > Email Campaign (MailChimp Campaign) > Opens.**
5. Select **Field Value.** In our case, it is 0.

   .. image:: /user/img/marketing/marketing/mailchimp/o_segment_opens_zero.jpg
      :alt: Select field value in filters

   The same way you can apply any conditions of your choice.

6. When you are done, click **Save and Close**.

This list is now displayed on the :ref:`Marketing List Page <user-guide-ui-components-view-pages>` and contains contacts sorted according to your conditions.

**Related Articles**

* :ref:`Configure MailChimp Integration <user-guide-mc-integration>`

.. include:: /include/include_links.rst
   :start-after: begin


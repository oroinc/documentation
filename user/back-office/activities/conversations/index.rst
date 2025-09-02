.. _doc-activities-conversations:

Manage Conversations in the Back-Office
=======================================

Oro provides a conversation tool designed for communication both within the back-office and storefront environments. This tool enables communication between back-office and customer users, creating a cohesive and integrated environment for all stakeholders.

Each conversation consists of a set of messages that can be exchanged by back-office users and :ref:`customer users <storefront-guide--conversations>`.

.. note:: Before you begin using the conversations feature, ensure that it is enabled in the :ref:`system configuration settings <configuration--guide--commerce--configuration--interactions>`.

Start a New Conversation
------------------------

To start a new conversation in the back-office, navigate to **Activities > Conversations** in the menu and click **Create Conversation** on the top right.

.. image:: /user/img/activities/conversation-list.png
   :alt: A list of all conversations available in the system

You can also click **Start Conversation** on the view page of a supported record under the **More Actions** menu on the top right. Supported records are:

* Order
* Request for Quote
* Quote

.. image:: /user/img/activities/activities-conversations.png
   :alt: Start Conversation button in the More Actions menu

Additionally, you can start a conversation from the page of your own conversations under your user name on the top right. For this, click **My Conversations** to be redirected to the page of conversations that you initiated or are involved in.

After you click **Start Conversation**, provide the following information:

* **Owner** --- A user to whom the conversation is assigned. By default, the name of the currently logged in user is pre-selected.
* **Customer User** --- A customer user to whom the conversation is assigned.
* **Name** --- The name of the conversation.
* **Initiated from** --- A source of the conversation can be a related entity, such as a order, an RFQ. This is an optional field and can be left empty.
* **Context** --- An entity related to the conversation, e.g., a customer user. You can add more than one context to the field. When you add context of a record to the activity, it will be displayed in the Activity section of that record's view page. This field is optional and can be left empty.

.. image:: /user/img/activities/activities-conversations-popup.png
   :alt: Conversations pop-up form

When a conversation is created, it is automatically set to status *Active*, as configured in the :ref:`Conversations workflow <system--workflows--conversations-backoffice-workflow>`.

To create a message in a new or existing conversation:

1. Click on the **Activity** tab on the view page of a supported record.
2. Click **Add Message** on the top right of the conversation view page.
3. Provide your message in the text box and define who the message is from. You can choose other users other than yourself to be the sender of the message, if they have view user and customer user permissions.
4. Click **Save**.

.. image:: /user/img/activities/add-new-message.png
   :alt: Adding a new message to a new conversation

You can interact with the conversation via any record added as context as long as the conversation status is not *Closed*.
If a context is removed from the conversation, the conversation disappears from the Activity section of that record's view page.

.. _user-guide--activities--conversations--manage:

Manage Conversations and Messages
---------------------------------

You can view, update, delete the existing conversations, and add context or a new message to them from the following pages in your Oro application:

* From the page of a related record in the **Activities** section.

  .. image:: /user/img/activities/ConversationRelatedRecord.png
     :alt: The actions available for conversations on the page of a related record

  By default, the conversation displays the last 5 messages, but you can navigate through them by using the **<Older** or **Newer>** buttons. Use the Refresh |IcRefresh| button to synchronize it with the latest messages that may have been added.

* From the page of all conversations under **Activities > Conversations** in the main menu, where you can perform the necessary actions for a conversation.

  .. image:: /user/img/activities/ConversationViewPage.png
     :alt: The actions available for conversations on the view conversation page

* From the **Conversations Indicator** at the top of the page. The speech bubble icon will show the number of new conversations with new messages, if there are any. Clicking on the title will redirect you to the view page of a relevant conversation.

  .. image:: /user/img/activities/conversations-indicator.png
     :alt: Conversations indicator, showing one new message, in the navigation bar in the Oro back-office

* From **My Conversations** in the user menu. Clicking on this menu item will redirect you to the page of the conversations you initiated or are involved in. If you are an admin or a user with permission to view conversations of other users, clear the *My Conversation* filter.

  .. image:: /user/img/activities/my-conversations.png
     :alt: My conversations menu and view page

.. _doc-activities-conversations-email-notifications:

Set Up Email Notifications for Conversations
--------------------------------------------

In OroCommerce, you can configure email notifications to alert users about new conversations and new messages within existing conversations.
To set up email notifications, you need to create an email template and notification rules to send the templates when conversation events occur.

.. note:: Email notifications are sent regardless of who starts the conversation or sends a message, a back-office or a storefront user.

To create new email templates:

1. In the back-office, navigate to **System > Emails > Templates**.
2. Click **Create Template**.
3. Fill in the required fields.
4. From the Entity Name list, select *Conversation*.
5. Define the template details for each of the two templates you are creating (separately):

   * For a new conversation: Create a subject and body, using ``entity variables`` or free-form text as needed.
   * For a new message in a conversation: Create a separate template for message events.

  .. image:: /user/img/activities/conversation-email-templates.png
     :alt: Illustration of email templates for a new conversation and a new conversation message

6. Save both templates for use in the next step.

To create two notification rules:

1. In the back-office, go to **System > Emails > Notification Rules**.
2. Click **Create Notification Rule**.
3. Define the rule details for each of the two rules you are creating (separately):

   * In the *Entity Name* field, select the Conversation entity.
   * For the *Event Name* field, select *Entity Create* for the new conversation and *Entity Update* for a new conversation message.
   * In the *Template* field, choose one of the previously created templates. Make sure you select the template you created for a new conversation if you selected *Entity Create* even name and a template for a new conversation message of you selected *Entity Update*.

4. Define the recipients. You can select specific users or email addresses depending on your business requirements.

   .. image:: /user/img/activities/conversation-notification-rule.png
      :alt: Illustration of two new notification rules, one for a new conversation and the other one for a new conversation message

5. Save the new notification rules.

Once templates and notification rules are configured, relevant users should automatically receive email alerts for new conversations and new messages within existing conversations.

.. image:: /user/img/activities/conversations-email-notifications-received.png
   :alt: Example mailbox showing received email notifications for a newly created conversation and a new message in an existing conversation


**Related Topics**

* :ref:`Conversations Workflow <system--workflows--conversations-backoffice-workflow>`
* :ref:`Enable the Conversations Feature <configuration--guide--commerce--configuration--interactions>`
* :ref:`Configure Emails in the Back-Office <admin-guide-email-configuration>`




.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin


.. include:: /include/include-links-user.rst
   :start-after: begin

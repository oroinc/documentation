.. _doc-activities-conversations:

Manage Conversations in the Back-Office
=======================================

.. note:: The conversations feature is available as of OroCommerce version 6.0.4 as a |Conversations extension|, which you can download from the Oro Extensions Store. Next, use the composer to :ref:`install it on your application <cookbook-extensions-composer>`.

Oro provides a conversation tool designed for communication both within the back-office and storefront environments. This tool enables communication between back-office users and customer users, creating a cohesive and integrated environment for all stakeholders.

Each conversation consists of a set of messages that can be sent by back-office users and :ref:`customer users <storefront-guide--conversations>`.

.. note:: Prior to starting your work with conversations, ensure that conversations feature is enabled in the :ref:`system configuration <configuration--guide--commerce--configuration--interactions>`.

Start a New Conversation
------------------------

To start a new conversation in the back-office, navigate to **Activities > Conversations** in the menu and click **Create Conversation** on the top right.

.. image:: /user/img/activities/conversation-list.png
   :alt: A list of all conversations available in the system

Alternatively, you can click **Start Conversation** on the page of a supported record under the **More Actions** menu on the top right. Supported records are:

* Order
* Request for Quote
* Quote

.. image:: /user/img/activities/activities_conversations.png
   :alt: Show the Start Conversation button

Next, provide the following information:

* **Owner** --- A user to whom the conversation is assigned. By default, the name of the currently logged in user is pre-selected.
* **Customer User** --- A customer user to whom the conversation is assigned.
* **Name** --- The name of the conversation.
* **Initiated from** --- A source of the conversation can be a related entity, such as a order, an RFQ. This is an optional field and can be left empty.
* **Context** --- An entity related to the conversation, e.g. a customer user. You can add more than one context to the field. When you add context of a record to the activity, it will be displayed in the Activity section of that record's view page. This is an optional field and can be left empty.

When a conversation is created, it is automatically set to status *Active*, as configured in the :ref:`Conversations workflow <system--workflows--conversations-backoffice-workflow>`.

To create a new message in the conversation:

1. Click **Add Message** on the top right of the conversation view page.
2. Provide your message in the text box and define who the message is from. You can choose other users other than yourself to be the sender of the message, if they have view user and customer user permissions.
3. Click **Save**.

You can interact with the conversation via any record added as context as long as the conversation status is not *Closed*.
If a context is removed from the conversation, the conversation disappears from the Activity section of that record's view page.

.. _user-guide--activities--conversations--manage:

Manage Conversations and Messages
---------------------------------

You can view, update, delete the existing conversations, and add context or a new message to them from the following pages in your Oro application:

* From the page of a related record in the **Activities** section.

  .. image:: /user/img/activities/ConversationRelatedRecord.png
     :alt: The actions available for conversations on the page of a related record

  By default, the conversation displays the last 5 messages, but you can navigate through them by using the **<Older** or **Newer>** buttons. Use the Refresh |IcRefresh| button to synchronized it with the latest messages that may have been added.

* From the page of all conversations under **Activities > Conversations** in the main menu, where you can perform the necessary actions for a conversation.

  .. image:: /user/img/activities/ConversationViewPage.png
     :alt: The actions available for conversations on the view conversation page


**Related Topic**

* :ref:`Conversations Workflow <system--workflows--conversations-backoffice-workflow>`
* :ref:`Enable the Conversations Feature <configuration--guide--commerce--configuration--interactions>`


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin


.. include:: /include/include-links-user.rst
   :start-after: begin

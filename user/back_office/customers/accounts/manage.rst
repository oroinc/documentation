.. _user-guide-accounts-actions:

Manage Accounts
===============

Account View
------------

Accounts aggregate information on all your customers and their activities. Here is an overview of what you can expect to have collected for each of your accounts:

* The date of account creation and its latest update.
* Thd calculated amount of the account's :term:`Lifetime Sales Value`.
* General details of the account, such as its name, tags, description and all the contacts assigned to the account.

  .. image:: /user/img/customers/accounts/account_view_general_new.png
     :alt: General information about account

* Any :ref:`activities <user-guide-activities>` related to the account, such as attachments, calls, calendar events, notes, emails, or tasks (if available).

  .. image:: /user/img/customers/accounts/accounts_view_activities.png
     :alt: The activity section on the account page, displaying assigned tasks, added notes and calendar events, and logged calls

  .. note:: If an activity-related action was performed for a customer or a contact assigned to the account, they are not displayed. Only activities performed directly for the account are available in the Activities section.

* Any details from the custom fields added to the account. If available, they are displayed in the **Additional Information** section.
* Any customer website activities displayed in the *Summary* and *Events* subsections of the **Website** section.

  .. image:: /user/img/customers/accounts/accounts_view_website_activity_1.png
     :alt: Summary activity

  .. image:: /user/img/customers/accounts/accounts_view_website_activity_2.png
     :alt: Event activity

* Information collected on the account and its customers from all its available channels displayed in tabs with channel names.

  .. image:: /user/img/customers/accounts/accounts_view_channels_new.png
     :alt: The sections with channel names

  .. note:: The number and names of these sections depend on the number and names of the channels and customer records assigned to the selected account. The type of channels can vary depending on your configurations and integrations (e.g. Sales, Commerce).

* Records of other entities assigned to channels regarding specific customers displayed in subsections.

  For instance, within the **Sales** Channel section you can view:

  1. The Business Customer(s) related to the selected account.
  2. Once one of the customers is selected, you can see their general details and information on related Leads/Opportunities.

     .. image:: /user/img/customers/accounts/accounts_view_channels_2.png
        :alt: Opportunities for customers displayed in the sales channel on the account page

  Within a **Commerce** Channel, there are seven tabs with Commerce customer-related information: General, Customer Users, Shopping Lists, Requests For Quote, Quotes, Orders, Opportunities.

You can manage information collected within accounts. Below is an overview of what actions you can perform from the view page of any account:

* Share an account by clicking **Share** and providing information in a pop up form.

  .. image:: /user/img/customers/accounts/accounts_view_actions_share.png
     :alt: The sharing settings dialog displayed after clicking the share button on the account page

* Edit account information by clicking |IcEdit| **Edit**.
* Delete an account from the system by clicking |IcDelete| **Delete**.
* Perform a number of actions under **More Actions** menu:

  * :ref:`Add Attachment <user-guide-activities-attachments>`
  * :ref:`Add Note <user-guide-add-note>`
  * :ref:`Send Email <user-guide-using-emails>`
  * :ref:`Add Event <doc-activities-events>`
  * :ref:`Log Call <doc-activities-calls>`
  * :ref:`Add Task <doc-activities-tasks>`
  * :ref:`Add Contact <user-guide-contacts>`
  * :ref:`Create Opportunity <user-guide-system-channel-entities-opportunities>`

  .. image:: /user/img/customers/accounts/MoreActionsMenu.png
     :alt: The more actions menu on the account page

Account Grid
------------

Account grid is the starting point for working your accounts in the application. It lists all accounts available for you and lets you perform a variety of actions, from importing them to your application from external sources, to filtering, tagging and even merging the required items.

The key actions that you can do to selected accounts on the list are located under the |IcMore| more actions menu to the right of the necessary account.

.. image:: /user/img/customers/accounts/accounts_grid.png
   :alt: Account actions from the account list displaying the view, edit and delete icons for the selected account

* View |IcView|
* Delete  |IcDelete|
* Edit |IcEdit|

In addition to editing an account on the edit page, you can quickly amend the necessary information using inline editing for specific columns in the grid, such as account name, owner or tags. To edit within the grid, click |IcPencil|.

.. image:: /user/img/customers/accounts/accounts_grid_inline_editing.gif
   :alt: Inline editing for specific columns on the page of all accounts

Aggregation capabilities of accounts extend even further, with the ability to merge as many accounts as you want should you need to accumulate information from several accounts. Click |IcMerge| and follow instructions on the screen to proceed with the merge.

.. include:: /include/include_images.rst
   :start-after: begin

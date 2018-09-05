.. _user-guide-accounts:

Accounts
========

This section will cover the following topics:

.. contents:: :local:
   :depth: 2

To collect and process information on the customer activity of a person, group of people or business cooperating with
you, you can create an account that will represent them in your Oro application.

An account can aggregate details of all the :term:`customer identities <Customer Identity>` assigned to it, providing
a 360-degree view of the customer.

.. note:: See three short demos on:

          * `creating and editing <https://oroinc.com/orocrm/media-library/22093>`_

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/00Vz_mkbeTE" frameborder="0" allowfullscreen></iframe>

          * `managing <https://oroinc.com/orocrm/media-library/22095>`_

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/5FEyHWr-jQY" frameborder="0" allowfullscreen></iframe>

          * `merging account records <https://oroinc.com/orocrm/media-library/merge-account-records-2>`_

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/x-LwwCQfwGQ" frameborder="0" allowfullscreen></iframe>

          or

          keep reading the step-by-step guidance below.

.. _user-guide-accounts-create:

Create an Account
-----------------

To create a new account:

1. Navigate to **Customers > Accounts** in the main menu.

2. Click **Create Account** in the top right corner.

   The following :ref:`page <user-guide-ui-components-create-pages>` appears:

   .. image:: /user_guide/img/accounts/accounts_create.png
      :alt: Create an account

3. Define the following mandatory fields:

   .. csv-table::
      :header: "Field", "Description"
      :widths: 10, 30

      "**Owner**","Limits the list of users that can manage the account to users,  whose
      :ref:`roles <user-guide-user-management-permissions>` allow managing
      accounts assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.).

      By default, the user creating the account is chosen."
      "**Account Name**","The name used to refer to the account in the system."
      "**Description**","Details or a short description of an account record."

4. In order to add a contact, click the **+Add** in the **Contacts** section.

.. note:: If you need to record and process any other details of accounts, :ref:`custom fields <doc-entity-fields-create>` can be created. Their values will be displayed in the **Additional** section. Please, refer to your administrator for assistance.

5. Once all the necessary information has been defined, Click **Save**.

Manage Account Records
----------------------

Accounts View Page
^^^^^^^^^^^^^^^^^^

The following sections are available for the account :ref:`page <user-guide-ui-components-view-pages>`:

1. The **Page Header** has the date of account creation and its latest update, as well as its :term:`lifetime sales value <Lifetime Sales Value>`.

2. The **General** section is for general details of the account, such as its name, tags, description and all the contacts assigned to the account.

   .. image:: /user_guide/img/accounts/account_view_general_new.png
      :alt: General information about account

3. The **Activity** section includes any :ref:`activities <user-guide-activities>` related to the account, such as attachments, calls, calendar events, notes, emails or tasks (if available).

   .. image:: /user_guide/img/accounts/accounts_view_activities.png
      :alt: The activity section on the account page, displaying assigned tasks, added notes and calendar events, and logged calls

   .. note:: If an activity-related action was performed for a customer or a contact assigned to the account, they will not be displayed. Only the activities performed directly for the account are available in the section.

4.  The **Additional Information** section provides details of any :term:`custom fields <Custom Field>` defined for the account.
5.  The **Website Activity** section lists customer activities displayed in the *Summary* and *Events* subsections.

    .. image:: /user_guide/img/accounts/accounts_view_website_activity_1.png
       :alt: Summary activity

    .. image:: /user_guide/img/accounts/accounts_view_website_activity_2.png
       :alt: Event activity

5.  The **Sections with channel names**. Each section contains details of all the customers that are assigned to this account and belong to the specified channel (e.g. Sales, Magento, OroCommerce).

    .. image:: /user_guide/img/accounts/accounts_view_channels_new.png
       :alt: The sections with channel names
    .. note:: The number and names of such sections depend on the number and names of OroCRM channels and customer records assigned to the account. The type of channels can vary depending on your configurations and integrations (e.g. Sales, Magento, Commerce).

    Records of other entities assigned to this channel with regard to a specific customer are represented as subsections.

    For instance:

    * If an account relates to a Magento customer, its view page will have the **Magento** section displayed. Its subsections will be the following:

      1. The *General Info* subsection has the general information on the Magento customer related to the account (e.g. name, email, customer group, website, etc.)
      2. The *Magento Orders* subsection lists all the :ref:`orders <user-guide-magento-orders-create>` related to the account.
      3. The *Magento Purchases* subsection gives a quick overview of the products that the customer recently purchased. Products disappear from the list if an order is cancelled or deleted on the Magento side.
      4. The *Magento Shopping Carts* subsection shows the details of the :ref:`shopping carts <user-guide-magento-carts-create>` related to the account.
      5. The *Magento Credit Memos* subsection is for :ref:`credit memo <user-guide--sales--magento-credit-memos>` and order details, such as the store from which the order has been placed, order number, the amount refunded, etc.
      6. The *Magento Order Notes* subsection show the comments added to an order on the Magento side as notes in Oro.

     .. image:: /user_guide/img/accounts/account_subsections_new2.png
        :alt: The magento section

    * Within the **Sales** Channel section you will be able to see:

      1. The Business Customer(s) related to the selected account.
      2. Once one of the customers is selected, you can see their general details and information on related Leads/Opportunities.

      .. note:: In new installations of OroCRM (2.0 and higher) the functions of a Sales channel are reduced to enabling Business Customers and controlling their grouping at the Account view. It is, therefore, no longer essential to create a Sales channel to enable leads and opportunities – these are enabled as features.

      .. image:: /user_guide/img/accounts/accounts_view_channels_2.png
         :alt: Opportunities for customers displayed in the sales channel on the account page

    * Within a **Commerce** Channel, there are seven tabs with Commerce customer-related information:

      1. General
      2. Customer Users
      3. Shopping Lists
      4. Requests For Quote
      5. Quotes
      6. Orders
      7. Opportunities.

.. _user-guide-accounts-actions:

Account Actions from the View Page
""""""""""""""""""""""""""""""""""

The following actions can be performed for the accounts from the :ref:`view page <user-guide-ui-components-view-pages>`:

1. Share the account. Clicking **Share** will prompt a sharing settings pop up window to open.

   .. image:: /user_guide/img/accounts/accounts_view_actions_share.png
      :alt: The sharing settings dialog displayed after clicking the share button on the account page


2. Get to the |IcEdit| **Edit** form of the account.

3. Delete the account from the system by clicking |IcDelete| **Delete**

4. Perform a number of actions under **More Actions** menu:

   * :ref:`Add Attachment <user-guide-activities-attachments>`
   * :ref:`Add Note <user-guide-add-note>`
   * :ref:`Send Email <user-guide-using-emails>`
   * :ref:`Add Event <doc-activities-events>`
   * :ref:`Log Call <doc-activities-calls>`
   * :ref:`Add Task <doc-activities-tasks>`
   * :ref:`Add Contact <user-guide-contacts>`
   * :ref:`Create Opportunity <user-guide-system-channel-entities-opportunities>`

   .. image:: /user_guide/img/accounts/MoreActionsMenu.png
      :alt: The more actions menu on the account page

Export
""""""

You can export the account details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import
""""""

You can import the bulk details of updated or processed account information in the .csv format following the steps described in the :ref:`Importing Accounts <import-accounts>` guide.

Account Actions from the Account List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By hovering over the |IcMore| more actions menu to the right of the necessary accountm you can perform the following actions:

.. image:: /user_guide/img/accounts/accounts_grid.png
   :alt: Account actions from the account list displaying the view, edit and delete icons for the selected account

1. View the account by clicking |IcView|

2. Delete the account from the system by clicking |IcDelete|

3. Edit the account by clicking |IcEdit|

4. Do inline editing for specific columns, such as account name, owner or tags, by clicking |IcPencil|

   .. image:: /user_guide/img/accounts/accounts_grid_inline_editing.gif
      :alt: Inline editing for specific columns on the page of all accounts

4. Merge Accounts by clicking |IcMerge|


.. _user-guide-accounts-merge:

Merging Accounts
""""""""""""""""

Once the accounts have been added to the system you can :ref:`merge <user-guide-accounts-merge>` them, to get a full
view of customer activities, regardless of the :term:`channels <Channel>`. This can be useful if, for example, it has
appeared that several accounts have been created for the different representatives of the same client, or that your
business-to-business partner is co-operating with you from a new channel (e.g. started buying from your Magento store).

In order to merge accounts:

1. Go to the list of all accounts.

2. Select the accounts that you want to merge.

3. Click the ellipsis menu at the right end of the table header row, and then click the |IcMerge| **Merge** icon. (See :ref:`Merge Records <doc-grids-actions-records-merge>`).

   As an example, we are merging three accounts: Acuserv, Big Bear Stores, and Body Toning.

   .. image:: /user_guide/img/accounts/accounts_merge_01.png
      :alt: Click the merge icon to see merge records

4. Once you click **Merge**, a table with the merge-settings appears.

   .. image:: /user_guide/img/accounts/accounts_merge_02_part1.png
      :alt: Click merge accounts, part 1


   .. image:: /user_guide/img/accounts/accounts_merge_02_part2.png
      :alt: Click merge accounts, part 2


5. Choose a name of the accounts that are being merged to give to your new account (Master Record).

6. Choose the accounts merging strategy:

   * *Append* - combines selected values and assigns them to the master record.
   * *Replace* - uses the selected value as the new value for the corresponding field.

7. Apply the strategy to the attachments, calendar event activity, call activity, contacts, email activity, note activity, tags, and task activity.

8. Choose the default contact of the accounts being merged to give to the Master Record.

9. Choose the description of the accounts being merged to give to the Master Record.

10. Choose the last contact datetime as well as the last incoming and outgoing contact datetime to give to the Master Record.

11. Choose the owner of the accounts being merged to give to the Master Record.

12. Choose the total number of incoming and outgoing contact attempts and total times the account has been contacted to give to the Master Record.

13. Click **Merge**.

    A Master Record with merged data of several accounts is created. The rest of the account details, including details of the customer identities are merged using the append strategy.

    .. note:: Keep in mind that after you create a new account profile (Master Record), the accounts that were merged are automatically deleted from the list of all accounts.

.. _user-guide-accounts-reports:

Reports with Account Records
----------------------------

OroCRM currently comes with two ready-to-use reports on accounts:

1. Accounts Life Time Value

2. Accounts by Opportunities


Accounts Life Time Value
^^^^^^^^^^^^^^^^^^^^^^^^

This a report, with which you can see the total amount of money received from all the customers assigned to the account.

In order to see the report go to **Reports and Segments > Reports > Accounts > Life Time**.

It shows:

- The account name

- The total lifetime sales value registered in your Oro application.

.. image:: /user_guide/img/accounts/accounts_report_by_lifetime.png
   :alt: The list of lifetime value reports for accounts


Accounts by Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^^

With this report you can see number of won, lost and pending opportunities for all the customers assigned to the account.

In order to see the report go to **Reports and Segments > Reports > Accounts > By Opportunities**.

It shows:

- The account name

- The number of won opportunities for all the customers assigned to the account

- The number of lost opportunities for all the customers assigned to the account

- The number of pending opportunities for all the customers assigned to the account

- The total number of opportunities for all the customers assigned to the account

- The total number of opportunities of a kind, regardless of their account.


.. image:: /user_guide/img/accounts/accounts_report_by_opportunity.png
   :alt: Accounts by opportunities

.. hint::

    New custom reports can be added that can use details of the accounts, as well as of any records related to the
    accounts. For more details on the ways to create and customize the reports, refer to the :ref:`Reports topic <user-guide-reports>`.



.. include:: /img/buttons/include_images.rst
   :start-after: begin

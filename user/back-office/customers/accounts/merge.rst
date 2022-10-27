:oro_documentation_types: OroCRM

.. _user-guide-accounts-merge:

Merge Accounts
==============

Once the accounts have been added to the system, you can :ref:`merge <user-guide-accounts-merge>` them to fully view customer activities, regardless of the channels. This can be useful if, for example, several accounts were created for different representatives of the same client or if your business-to-business partner works with you from a new channel (e.g.,  buying from your other store).

To merge accounts:

1. Navigate to **Customers > Accounts** in the main menu.
2. Select the accounts that you want to merge.
3. Click the ellipsis menu at the right end of the table header row, and then click the |IcMerge| **Merge** icon.

   As an example, we are merging three accounts: Acuserv, Big Bear Stores, and Body Toning.

   .. image:: /user/img/customers/accounts/merge_accounts_26.png
      :alt: Click the merge icon to see merge records

4. Once you click **Merge**, a table with the merge settings appears.

   .. image:: /user/img/customers/accounts/merge_accounts_table_26.png
      :alt: Click merge accounts

5. Choose the name of the accounts being merged to give to your new account (the master record).
6. Choose the accounts merging strategy:

   * *Append* combines selected values and assigns them to the master record.
   * *Replace* uses the selected value as the new value for the corresponding field.

7. Apply the strategy to the attachments, calendar event activity, call activity, contacts, email activity, note activity, tags, and task activity.
8. Choose the default contact of the accounts being merged to give to the master record.
9. Choose the description of the accounts being merged to give to the master record.
10. Choose the last contact datetime, as well as the last incoming and outgoing contact datetime to give to the master record.
11. Choose the owner of the accounts being merged to give to the master record.
12. Choose the total number of incoming and outgoing contact attempts and total times the account has been contacted to give to the master record.
13. Click **Merge**.

    The master record with merged data of several accounts is now created. The rest of the account details, including the details of the customer identities, are merged using the append strategy.

    .. note:: Keep in mind that after you create a new account profile (the master record), the merged accounts are automatically deleted from the list of all accounts.

.. include:: /include/include-images.rst
   :start-after: begin

.. _user-guide-accounts:

Accounts
========

.. contents:: :local:
   :depth: 2


To collect and process information on the customer activity of a person, group of people or business cooperating with
you, you can create an **Account** record that will represent them in OroCRM.

An account can aggregate details of all the :term:`customer identities <Customer Identity>` assigned to it, providing
a 360-degree view of the customer.


.. _user-guide-accounts-create:

Create Account Records
----------------------

- Navigate to **Customers>Accounts**.

- Click :guilabel:`Create Account`.

- The **Create Account** :ref:`form <user-guide-ui-components-create-pages>` will appear:

|

.. image:: /user_guide/img/accounts/accounts_create.png

|

The following fields are mandatory and **must** be defined:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Owner**","Limits the list of users that can manage the account to users,  whose
  :ref:`roles <user-guide-user-management-permissions>` allow managing
  accounts assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.).

  By default, the user creating the account is chosen."
  "**Account Name**","The name used to refer to the account in the system."
  "**Description**","Details or a short description of an account record."


- To add a contact, click the :guilabel:`+Add` in the **Contacts** section.

If you need to record and process any other details of accounts, contact your administrator or see the
:ref:`custom fields <doc-entity-fields-create>` section for more information. Their values will
be displayed in the **Additional** section.

Once all the necessary information has been defined, click the button in the right top corner of the page to save the
account in the system.

.. hint::

    You can also export and import accounts with :guilabel:`Export` and :guilabel:`Import` buttons as described in
    the :ref:`Export and Import Functionality <user-guide-import>` guide.


Manage Account Records
----------------------

Accounts View Page
^^^^^^^^^^^^^^^^^^

The :ref:`view page <user-guide-ui-components-view-pages>` consists of several sections, namely:

- **Page Header**: date of the account creation and its latest update, as well as its
  :term:`lifetime sales value <Lifetime Sales Value>`.

- **General**: general details of the account, such as its name, tags, description and all the contacts assigned to the
  account.

  |

.. image:: /user_guide/img/accounts/accounts_view_general.png

|

- **Activity**: activities such as calls, emails and tasks assigned to the account.

  |

.. image:: /user_guide/img/accounts/accounts_view_activities.png

.. note::

    If an activity-related action was performed for a customer or a contact assigned to the account, they will not be
    displayed. Only the activities performed directly for the account are available in the section.

- **Opportunities**: a list of opportunities related to an account.

|

.. image:: /user_guide/img/accounts/accounts_view_opps.png

|


- **Additional Information**: details of any :term:`custom fields <Custom Field>` defined for the account.
- **Website Activity**: customer activities displayed in Summary and Events tabs.

  |

  .. image:: /user_guide/img/accounts/accounts_view_website_activity_1.png

  |

  |

  .. image:: /user_guide/img/accounts/accounts_view_website_activity_2.png

  |

- **Sections with channel names**: each section contains details of all the customers that are assigned to this
  account and belong to a specified channel.

    .. note:: The number and names of such sections depend on the number and names of OroCRM channels and customer records assigned to the account. The type of channels can vary   depending on your configurations and integrations (e.g. Sales, Magento, Commerce).

    |

    .. image:: /user_guide/img/accounts/accounts_view_channels.png

    |


   Records of other entities assigned to channels with regard to a specific customer are represented as subsections.

   For instance, within the **Sales Channel** tab you will be able to see:

    - The Business Customer(s) related to the selected account.
    - Once one of the customers is selected, you can see their general details and information on related Leads/Opportunities.

    .. note:: In new installations of OroCRM (2.0 and higher) the functions of a Sales channel are reduced to enabling Business Customers and controlling their grouping at the Account view. It is, therefore, no longer essential to create a Sales channel to enable leads and opportunities - these are enabled as features.


    |

    .. image:: /user_guide/img/accounts/accounts_view_channels_2.png

    |

   Within a **Magento Channel**:

    - There are three tabs with Magento customer-related information: General Info, Magento Orders, Magento Shopping Carts.

    |

    .. image:: /user_guide/img/accounts/magento_channel.png

    |

   Within a **Commerce Channel**:

    - The are seven tabs with :ref:`Commerce <user-guide-commerce-integration>` customer-related information: General, Customers Users, Shopping Lists, Requests For Quote, Quotes, Orders and Opportunities.

    |

    .. image:: /user_guide/img/accounts/commerce_channel_2.png

    |


.. _user-guide-accounts-actions:

Account Actions from the View Page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~


The following actions can be performed for the accounts from the :ref:`View page <user-guide-ui-components-view-pages>`:

- Share the account. Clicking :guilabel:`Share` will prompt a sharing settings pop up window to open.

|

  .. image:: /user_guide/img/accounts/accounts_view_actions_share.png

|


- Get to the **Edit** form of the account.

- Delete the account from the system.

- Perform a number of actions under **More Actions** menu:

 - :ref:`Add Attachment <user-guide-activities-attachments>`
 - :ref:`Add Note <user-guide-add-note>`
 - :ref:`Send Email <user-guide-using-emails>`
 - :ref:`Add Event <doc-activities-events>`
 - :ref:`Log Call <doc-activities-calls>`
 - :ref:`Add Task <doc-activities-tasks>`
 - :ref:`Add Contact <user-guide-contacts>`
 - :ref:`Create Opportunity <user-guide-system-channel-entities-opportunities>`.

|

.. image:: /user_guide/img/accounts/accounts_view_actions.png

|


.. note:: Actions available in the system depend on the system settings defined in the **Communication & Collaboration** settings section of the  **Accounts** entity (see step 4 of the :ref:`Create an Entity <doc-entity-actions-create>` action description).

Account Actions from the Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

From the :ref:`grid <user-guide-ui-components-grids>` you can:

|

.. image:: /user_guide/img/accounts/accounts_grid.png

|

- View the account by clicking |IcView|.
- Delete the account from the system by clicking |IcDelete|.

- Edit the account by clicking |IcEdit|.

- Do inline editing for specific columns, such as account name, owner or tags, by clicking |IcEditInline|.

|

.. image:: /user_guide/img/accounts/accounts_grid_inline_editing.gif

|


- View the account by clicking |IcView|.

- Merge Accounts.


.. _user-guide-accounts-merge:

Merging Accounts
~~~~~~~~~~~~~~~~

Once the accounts have been added to the system you can :ref:`merge <user-guide-accounts-merge>` them, to get a full
view of customer activities, regardless of the :term:`channels <Channel>`. This can be useful if, for example, several accounts have been created for different representatives of the same client, or if your business-to-business partner is co-operating with you from a new channel (e.g. started buying from your Magento store).

In order to merge accounts:

1. Go to the list of all accounts.

2. Select the accounts that you want to merge.

3. Click the ellipsis menu at the right end of the table header row, and then click the |IcMerge| **Merge** icon.

   As an example, we are merging three accounts: Acuserv, Big Bear Stores, and Body Toning.

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

- Accounts Life Time Value

- Accounts by Opportunities


Accounts Life Time Value
^^^^^^^^^^^^^^^^^^^^^^^^

This is a simple but useful report, with which you can see the total amount of money received from all the customers
assigned to the account.

In order to see the report go to **Reports and Segments > Reports > Accounts > Life Time**.

It shows:

- the account name

- the total lifetime sales value registered in OroCRM

|

.. image:: /user_guide/img/accounts/accounts_report_by_lifetime.png

|


Accounts by Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^^

With this report you can see number of won, lost and pending opportunities for all the customers assigned to the
account.

In order to see the report go to **Reports and Segments > Reports > Accounts > By Opportunities**.

It shows:

- the account name

- the number of won opportunities for all the customers assigned to the account

- the number of lost opportunities for all the customers assigned to the account

- the number of pending opportunities for all the customers assigned to the account

- total number of opportunities for all the customers assigned to the account

- total number of opportunities of a kind, regardless of their account.

|

.. image:: /user_guide/img/accounts/accounts_report_by_opportunity.png

|

.. hint::

    New custom reports can be added, that can use details of the accounts as well as of any records related to the
    accounts. For more details on the ways to create and customize the reports,  please see the
    :ref:`Reports guide <user-guide-reports>`.





.. |BCrLOwnerClear| image:: /img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: /img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: /img/buttons/BGotoPage.png
   :align: middle

.. |Bplus| image:: /img/buttons/Bplus.png
   :align: middle

.. |IcDelete| image:: /img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: /img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: /img/buttons/IcView.png
   :align: middle

.. |IcEditInline| image:: /img/buttons/IcEditInline.png
   :align: middle

.. |IcMerge| image:: /img/buttons/IcMerge.png
   :align: middle
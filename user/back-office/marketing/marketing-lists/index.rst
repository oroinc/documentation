:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-marketing-lists:

Marketing Lists
===============

With the Oro application, you can automatically generate a :term:`marketing list <Marketing Lists>` of contacts that will be used for marketing purposes (mass call or mailing). For example, you can create a list of personal and contact details of customer users who registered after October 1 and whose shipping address is in California.

With marketing lists, you can run :ref:`email campaigns <user-guide-email-campaigns>` in the Oro application. You can also synchronize Oro application marketing lists with subscribers lists in :ref:`MailChimp <user-guide-mc-integration>` and address books in :ref:`dotmailer <user-guide-dm-integration>`.

Marketing lists may be based on the contacts from the following items:

* Accounts (via primary email of default contact)
* Customer users
* Quotes (via customer user email)
* Orders (via customer user email)
* Shopping lists
* Business Customer
* Lead
* Contact

The way to create and manage contacts in a marketing list is described below.

.. _user-guide-marketing-lists-create:
.. _user-guide-marketing-marketing-list-create-general:
.. _user-guide-marketing-marketing-list-create-columns:
.. _user-guide-marketing-marketing-list-create-filters:
.. _user-guide-marketing-lists-actions:

Create Marketing Lists
----------------------

To create a new marketing list:

#. Navigate to **Marketing > Marketing Lists** in the main menu.

#. Click **Create Marketing List**.

#. In the *General* section, provide the following information:

   .. csv-table::
      :header: "Field", "Description"
      :widths: 10, 30

      "**Name**","A name used to refer to the marketing list in the system."
      "**Entity**","Choose an entity from the dropdown. Only the entities that have contact details (E-mail or phone number) are available. Records of the chosen entity and entities related to it will be used to create the list of contacts."
      "**Type**","Chose the list type from the dropdown:

      - **Dynamic** lists are updated as soon as any changes have taken place in the system.

      - **On demand** lists will be updated only following the user request (click |BRefresh| to refresh the table on the view page of the marketing list record)."
      "**Owner**","Limits the list of users that can manage the marketing list to the users, whose roles allow managing marketing lists of the owner (e.g., the owner, members of the same business unit, system administrator, etc.)."
      "**Description**","Free text to help you and other users understand the purpose or peculiarities of the list in the future."

   .. note:: Custom fields may be added subject to specific business needs.
  
   .. image:: /user/img/marketing/marketing/list_general_details_ex.png
      :alt: A sample of a filled marketing list
  
#. In the *Filters* section, define the Activity and/or Data audit and/or Field Condition and/or Condition Group filters that will be used to select the records for the list.

   More information about the ways to define filters is provided in the :ref:`Filters Management <user-guide--business-intelligence--filters-management>` guide.

   The contacts that match the filter condition will be automatically subscribed to the mailing list. You can later unsubscribe a contact or remove them from the mailing list.

#. In the **Columns** section, define the set of fields that will be shown in the marketing list details on the general page for every target contact.

   .. image:: /user/img/marketing/marketing/list_columns.png
  
   .. note:: Marketing activities require some contact information, so at least one column that contains it must be selected. A list of these fields is provided in the **Designer** section.

   For every column:

   - Choose the fields from the drop-down in the **Column** section.

   - Modify the label if necessary. By default, the field name is used.

   - Define the sorting order if you want the grid to be sorted by the value in this column.

   - Click **Add**.

   You can |IcDelete| delete, |IcEdit| edit, or |IcReorder| change the column position by clicking the corresponding icon.

#. Once you finish configuring the marketing list, click **Save and Close** in the top right corner.

Now, you can use contacts of your marketing lists to run dedicated campaigns.

Manage Marketing Lists
----------------------

Navigate to **Marketing > Marketing Lists** in the main menu to be able to |IcView| view the marketing list details, |IcEdit| edit, or |IcDelete| delete unnecessary marketing lists by clicking the corresponding icon.

.. image:: /user/img/marketing/marketing/list_action_icons.png
   :alt: The actions available for each marketing list from the grid

.. _user-guide-marketing-list-view-page:

View Marketing List Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To view the Marketing List details:

#. Navigate to **Marketing > Marketing Lists** in the main menu.

#. Click on the necessary marketing list to preview its contents.

   .. image:: /user/img/marketing/marketing/list_view_page.png
      :alt: The details page of the selected marketing list

Here, you can preview the details of users that will be contacted via the campaigns that are based on this mailing list. You can also manage the marketing list as described in the sections below.

Details provide you with the following insights:

* A quick preview of the contact data --- the columns added to the marketing list (e.g., when :ref:`creating a marketing list <user-guide-marketing-marketing-list-create-columns>`).

* **TOTAL CONTACTED** --- the number of times a record of this marketing list was contacted within different email campaigns.

* **LAST CONTACTED** --- the date when a record of this marketing list was last contacted within
  different email campaigns.

* **SUBSCRIBED** --- status of the contact's subscription. Initially, all the contacts in the list are subscribed (the column value is "Yes"). When after the email campaigns that were targeting the marketing list, a user has unsubscribed, the value changes to "No", and the user is excluded from the following mailings.

.. note:: When the same record is a part of different marketing lists, its data from other marketing lists will not affect the TOTAL CONTACTED and LAST CONTACTED values in the list you are viewing.

Manage Contact Subscription
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To toggle the contact's subscription to the marketing list:

#. Navigate to **Marketing > Marketing Lists** in the main menu.

#. Click on the marketing list to preview its contents.

#. For the necessary contact, hover over the |IcMore| more actions menu and modify the contact's subscription to the marketing list by clicking |IcUns| or |IcSub|.

When not subscribed, the person will not be contacted in the email campaigns.

.. what happens?

Remove the Person From the Marketing List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To remove the person from the marketing list:

#. Navigate to **Marketing > Marketing Lists** in the main menu.

#. Click on the marketing list to preview its contents.

#. For the necessary contact, hover over the |IcMore| more actions menu and click |IcRemove| to remove the item from the list.

As soon as at least one item has been deleted from the marketing list, it is moved to the **Removed Items** section where you can view |IcView| the contact details or restore |UndoRem| the contact in the marketing list.

.. image:: /user/img/marketing/marketing/ml_removed_items.png
   :alt: View deleted records in the Removed Items section

Share the Marketing List
^^^^^^^^^^^^^^^^^^^^^^^^

To share the marketing list with other Oro application user:

#. Navigate to **Marketing > Marketing Lists** in the main menu.

#. Click on the marketing list to preview its contents.

#. Click **Share** in the top right corner to open the **Sharing Settings**.

#. Type in the user name next to the *Share with* text, or search for the necessary user: click |IcBars|, find the person you need, select the checkbox next to their name, and click **Add**.

You can preview the sharing status and see who you already shared the marketing list with. For this, click **Share** again.

To cancel sharing the marketing list with a particular person, click **Share**, and then click |IcDelete| next to the user name. Use mass actions to cancel sharing for more than one user.

Synchronize a Marketing List with External System
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As soon as Oro application has been integrated with a third party system, to which a marketing list may be mapped, you will see **Connect to** buttons with which you can, for example, map the list to :ref:`subscribers lists in MailChimp <user-guide-mc-integration>` or :ref:`address books in dotmailer <user-guide-dm-integration>`.

.. image:: /user/img/marketing/marketing/map_ml.png
   :alt: The Connect to buttons

.. stop

.. include:: /include/include-images.rst
   :start-after: begin


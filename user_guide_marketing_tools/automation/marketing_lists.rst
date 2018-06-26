.. _user-guide-marketing-lists:

Marketing Lists
===============

.. contents:: :local:
    :depth: 2

With OroCRM you can automatically generate a list of contacts used for marketing purposes (mass call or
mailing) subject to predefined conditions. For example, you can create a list of personal and contact details of leads
added to the system after October 1 with addresses in California. Such lists are called **Marketing Lists**.

Marketing lists can be used to run :ref:`Email Campaigns <user-guide-email-campaigns>` in OroCRM. You can also
synchronize OroCRM Marketing lists with Subscribers Lists in :ref:`MailChimp <user-guide-mc-integration>` and/or
Address Books in :ref:`dotmailer <user-guide-dm-integration>`.

.. note:: See a short demo on `how to create a marketing list <https://oroinc.com/orocrm/media-library/create-marketing-list-2>`_, or follow the step-by-step guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/9cCmx0N-Qf8" frameborder="0" allowfullscreen></iframe>

.. _user-guide-marketing-lists-create:

Create Marketing Lists
----------------------

Go to **Marketing>Marketing Lists** and click the :guilabel:`Create Marketing List` button
in the top right corner of the grid.

The Create Marketing List :ref:`form <user-guide-ui-components-create-pages>` will emerge.

Define the list settings, as described in the sections below:

.. _user-guide-marketing-marketing-list-create-general:

General Details
^^^^^^^^^^^^^^^

The following fields are mandatory and **must** be specified:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  "**Name**","Name used to refer to the marketing list in the system."
  "**Entity**","Choose an entity from the drop-down. Virtually every entity is available as a marketing list target. For instance, marketing lists can be created based on accounts (primary email of a default contact is used), or, if you are using OroCommerce, from customer users, quotes, orders, and shopping lists.
  Records of the chosen entity and entities related to it will be used to create the list of contacts."
  "**Type**","Chose the list type from the drop-down:

  - **Dynamic** lists are updated as soon as any changes have taken place in the system.

  - **On demand** lists will be updated only following the user request
    (:ref:`refresh the grid <doc-grids-actions-refresh>` on the view page of the marketing list record)."
  "**Owner**","Limits the list of users that can manage the marketing list to the users,  whose :ref:`roles <user-guide-user-management-permissions>` allow managing marketing lists of the owner (e.g. the owner,
  members of the same business unit, system administrator, etc.)."

Optional field **Description** can be filled with free text to help you and other users understand the purpose or
peculiarities of the list in the future.

Custom fields may be added subject to specific business needs.

.. image:: ../../img/marketing/list_general_details_ex.png
   :alt: General settings of the marketing list details page.


.. _user-guide-marketing-marketing-list-create-filters:

Filters
^^^^^^^

In the **Filters** section you can define  the Activity and/or Data audit and/or Field Condition and/or Condition Group
filters that will be used to select the records for the list.

More information about the ways to define filters is provided in the
:ref:`Filters Management <user-guide-filters-management>` guide.

.. _user-guide-marketing-marketing-list-create-columns:

Columns
^^^^^^^

.. image:: ../../img/marketing/list_columns.png
   :alt: Add columns to the marketing list to display relevant filtered data

In the **Columns** section, define the set of fields.
The only goal of this set of fields is to visualise records that meet the filter requirements.
Value of the chosen fields will be displayed at the :ref:`View page <user-guide-ui-components-view-pages>` of the
Marketing List.

.. note::

    Marketing activities require some contact information, so at least one column that contains it must be
    selected. A list of these fields is provided in the **Designer** section. (e.g. for contacts these are Primary
    Email and Primary Phone fields).


.. image:: ../../img/marketing/list_columns_01.png
   :alt: The designer section

- Choose the fields from the drop-down in the **Column** section.

- Label is the way the field will be referred to in the grid. The value defined for the field will be added by default,
  but can be changed.

- Define the sorting order if you want the grid to be sorted by the field value.

- Click :guilabel:`Add`.

.. image:: ../../img/marketing/list_columns_ex.png
   :alt: An example of several columns added to the marketing list, including contact information

Use action icons in the last column to edit the grid:

- Delete a column from the list with |IcDelete|

- Edit the column settings with |IcEdit|

- Change the column position, dragging the column by the |IcMove| icon


.. hint::

    Save the list in the system with the button in the top right corner of the page.


.. _user-guide-marketing-lists-actions:

Manage Marketing Lists
----------------------

The following actions are available for a marketing list from the :ref:`grid <doc-grids>`:

.. image:: ../../img/marketing/list_action_icons.png
   :alt: Manage marketing lists

- Delete the list from the system: |IcDelete|

- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the list: |IcEdit|

- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the list:  |IcView|


.. _user-guide-marketing-list-view-page:

Marketing List View Page
^^^^^^^^^^^^^^^^^^^^^^^^

.. image:: ../../img/marketing/list_view_page.png
   :alt: Marketing list view page

The :ref:`View page <user-guide-ui-components-view-pages>` of a marketing list contains:

- Action buttons. To learn more about grid actions, see :ref:`Grid Page <doc-grids-grid-page>`.


- Mapping buttons: As soon as OroCRM has been integrated with a third party system, to which a marketing list may be mapped, you will see :guilabel:`Connect to` buttons, with which you can, for example, map the list to :ref:`Subscribers Lists in MailChimp <user-guide-mc-integration>` or
  :ref:`Address Books in dotmailer <user-guide-dm-integration>`.

  |MapML|

- See general details of the list.

- See the grid of all the records on the Marketing Lists.


Marketing List Grid
^^^^^^^^^^^^^^^^^^^

The grid contains:

- Columns defined in the :ref:`Create form <user-guide-marketing-marketing-list-create-columns>`.

- "TOTAL CONTACTED" column: contains the number of times a record of this marketing list was contacted within
  different :ref:`E-mail campaigns <user-guide-email-campaigns>`.

- "LAST CONTACTED" column: contains the date when a  record of this marketing list was last contacted within
  different :ref:`Email campaigns <user-guide-email-campaigns>`.


.. note::

   Please note that if the same record is a part of different marketing lists, its data from other marketing lists will
   not affect the TOTAL CONTACTED and LAST CONTACTED values.

- "SUBSCRIBED" column: Initially all the users in the list are subscribed (the column value is "Yes"). If following one
  of the :ref:`Email campaigns <user-guide-email-campaigns>` using the marketing list, a user has
  unsubscribed, the value is changed to "No" and the user is excluded from the next mailings.

Action icons in the last column of the grid enable the following actions:

- Get to the view page of the grid item: |IcView|

- Unsubscribe/Subscribe items from/to the list manually: |IcUns| and |IcSub| icons

- Remove the item from the list: |IcRemove|


As soon as at least one item has been deleted from the marketing list, it is moved to the **Removed Items** section of the Marketing list view page.


.. image:: ../../img/marketing/ml_removed_items.png
   :alt: Removed items section of the marketing list page



Action icons within **Removed Items** enable the following actions:

- Get to the view page of the grid item: |IcView|

- Restore the item in the marketing list: |UndoRem|


Now, you can go ahead and use contacts of your marketing lists to run dedicated campaigns among the customers that best
suit your purposes.

.. |IcDelete| image:: /img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: /img/buttons/IcEdit.png
   :align: middle

.. |IcMove| image:: /img/buttons/IcMove.png
   :align: middle

.. |IcView| image:: /img/buttons/IcView.png
   :align: middle

.. |IcSub| image:: /img/buttons/IcSub.png
   :align: middle

.. |IcUns| image:: /img/buttons/IcUns.png
   :align: middle

.. |IcRemove| image:: /img/buttons/IcRemove.png
   :align: middle

.. |UndoRem| image:: /img/buttons/UndoRem.png
   :align: middle

.. |BGotoPage| image:: /img/buttons/BGotoPage.png
   :align: middle

.. |Bdropdown| image:: /img/buttons/Bdropdown.png
   :align: middle

.. |BCrLOwnerClear| image:: /img/buttons/BCrLOwnerClear.png
   :align: middle

.. |MapML| image:: ../../img/marketing/map_ml.png
   :align: middle

.. _doc-grids-records:
.. _doc-grids-actions-records-create:
.. _doc-grids-actions-records-view:
.. _doc-grids-actions-records-edit:

Manage Records
==============

There are a number of standard actions for managing records in Oro applications, but some of them are type-specific. This means that, although editing or deleting records is generally available for most records, additional actions can be applied, too, and the types of these additional records depend on the type of the record itself. For example, converting a lead to an opportunity is not the action you can apply to a shopping cart, as this particular action is lead-specific. In addition, the actions you can perform to selected records also depend on your :ref:`role <user-guide-user-management-permissions-roles>` in the company, and the :ref:`permissions <user-guide-user-management-permissions>` defined for it.

This topic describes the common actions you can perform to most records, such as editing, saving, deleting, and more.

.. contents:: :local:

Update Records
--------------

You can edit records in your application in three ways:

1. By using |IcPencil| :ref:`inline editing <doc-grids-actions-records-edit-inline>` in :ref:`record tables <doc-grids>`.

   .. image:: /user_guide/img/getting_started/records/inline_editing_example.png

2. By clicking  |IcEdit| **Edit** it in the ellipsis (or more options) menu located at the end of the row of the selected record in the :ref:`table <doc-grids>`.

   .. image:: /user_guide/img/getting_started/records/ellipsis_example.png

3. By opening the page of the selected record and clicking **Edit**.

   .. image:: /user_guide/img/getting_started/records/record_edit_button_example.png

.. _doc-grids-actions-records-edit-inline:

Edit Records Using Inline Editing
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Inline editing enables you to edit record field values directly from :ref:`record tables <user-guide-ui-components-view-pages>`. Inline editing is available only for a limited set of fields, and this set differs for different records and is not configurable.

To edit a record using inline-editing:

1. Point to the value  that you want to edit in the record table. If the |IcEditInline| **Edit Inline** icon appears next to it, you can edit this value in the table column.
2. Click the |IcEditInline| **Edit Inline** icon.

   Alternatively, double-click on the value itself.

   .. image:: /user_guide/img/getting_started/records/grids/grids_inlineedit.png

3. Modify the value as required.

   Inline editors can be of different types. The simplest inline editor is a plain text field, where you can type the required value.

   .. image:: /user_guide/img/getting_started/records/grids/grids_inlineeditor.png

   If a field can take just certain values, the inline editor will show you a list values to select from.

   .. image:: /user_guide/img/getting_started/records/grids/grids_inlineeditor2.png

4. Click the |IcActivate| **Save Changes** icon to save a new value, or the |IcBan| **Discard Changes** icon to return to the old value.

.. _doc-grids-actions-records-edit-editpage:
.. _doc-grids-actions-records-delete:
.. _doc-grids-actions-records-delete-single:

Manage Records Using Ellipsis Menu
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Ellipsis menu, or the more options menu, is located on the page of all records, and is available for each item in the table. To see what actions are available for the selected record, click the ellipsis menu at the end of the row of its row. You may be able to view, edit, delete records, or perform other record-specific actions, such as activating or deactivating a process. 

.. image:: /user_guide/img/getting_started/records/grids/grids_editrecord.png

.. image:: /user_guide/img/getting_started/records/grids/grids_deleterecord.png

.. _doc-grids-actions-records-delete-multiple:

Remove Multiple Records
-----------------------

Some records in your Oro application can be removed from the system using bulk delete (e.g. marketing lists, contacts, email campaigns, etc).

To delete several records:

1. In the table, select the check boxes next to the records you want to delete.
2. Click the ellipsis menu at the right end of the table header row, and the click the |IcDelete| **Delete** icon.
3. In the confirmation dialog, click **Yes, Delete**.
4. Once deletion is confirmed, the records are removed.

.. image:: /user_guide/img/getting_started/records/grids/grids_delete_bulk.png

.. _doc-grids-actions-records-merge:

Merge Records
-------------

.. important:: Currently, merging is available for accounts, contacts and campaigns.

To merge records:

1. In the table, select the check boxes in front of the records you want to merge.
2. Click the ellipsis menu at the right end of the table header row, and the click the |IcMerge| **Merge** icon.

.. image:: /user_guide/img/getting_started/records/grids/grids_merge.png

The process of merging is described in detail in the :ref:`Merging Accounts <user-guide-accounts-merge>` topic.

Save Updated Records
--------------------

To save the record you have created or updated, click one of the options in the save menu on the top right:

.. image:: /user_guide/img/getting_started/ui_components/create_page_save_cancel.png

1. **Save** --- Save the changes but remain on the same page. Use this option if you want to make more changes to the record configuration.     
2. **Save and Close** --- Save the changes and close the page. Once saved and closed, you are redirected to the record page.
3. **Save and New** --- Save the changes for the record you are creating/updating, and create/update another one straight away. 
   
.. note:: To discard the changes, click **Cancel** on the top right.

Review Record History
---------------------

You can review the history of a specific record if you have the corresponding permissions. Click on the **Change History** link on the top right of the record page to open the dialog window. If the record has been modified in any way, you will see who, how and when updated it.

.. image:: /user_guide/img/getting_started/data_management/view/view_history.png

.. image:: /user_guide/img/records/change_history.png

Share Records
-------------

Sharing records is convenient when you need assistance from other system users who might have no access to the related record. For example, if there is a task related to an opportunity that should be performed by a person from a marketing team but the marketing associates have no access to the opportunity records, the sales manager can share the record with a specific user (or group of users).

To share a record, click **Share** on the top right of record page, and enter the name of the user to share the record with in the corresponding **Share with** field. You can also click the list icon to select such user(s).


.. image:: /user_guide/img/getting_started/data_management/view/view_share_01.png


.. include:: /img/buttons/include_images.rst
   :start-after: begin
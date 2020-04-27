:oro_documentation_types: OroCRM, OroCommerce

.. _doc-grids-records:

Manage Records
==============

There are a number of standard actions for managing records in Oro applications, but some of them are type-specific. This means that, although editing or deleting records is generally available for most records, additional actions can be applied, too, and the types of these additional records depend on the type of the record itself. For example, converting a lead to an opportunity is not the action you can apply to a shopping cart, as this particular action is lead-specific. In addition, the actions you can perform to selected records also depend on your :ref:`role <user-guide-user-management-permissions-roles>` in the company, and the :ref:`permissions <user-guide-user-management-permissions>` defined for it.

This topic describes the common actions you can perform to most records, such as editing, saving, deleting, and more.


.. _user-guide-ui-components-view-pages:
.. _doc-grids-actions-records-view:

View Records
------------

.. include:: /user/back-office/getting-started/information-management/manage-records/view.rst
   :start-after: start_view
   :end-before: finish_view

.. _doc-grids-actions-records-edit:
.. _doc-grids-actions-records-edit-inline:
.. _doc-grids-actions-records-edit-editpage:

Edit Records
------------

.. include:: /user/back-office/getting-started/information-management/manage-records/edit.rst
   :start-after: start_edit
   :end-before: finish_edit

.. _doc-grids-actions-records-delete:
.. _doc-grids-actions-records-delete-single:
.. _user-guide--getting-started--mass-actions-management-console:
.. _doc-grids-actions-records-delete-multiple:

Delete Records
--------------

.. include:: /user/back-office/getting-started/information-management/manage-records/delete.rst
   :start-after: start_delete
   :end-before: finish_delete

.. _doc-grids-actions-records-merge:

Merge Records
-------------

.. important:: Currently, merging is available for accounts, contacts and campaigns.

To merge records:

1. In the table, select the check boxes in front of the records you want to merge.
2. Click the ellipsis menu at the right end of the table header row, and then click the |IcMerge| **Merge** icon.

.. image:: /user/img/getting_started/records/grids/grids_merge.png
   :alt: Merge the selected contact records

The process of merging is described in detail in the :ref:`Merging Accounts <user-guide-accounts-merge>` topic.

Save Updated Records
--------------------

To save the record you have created or updated, click one of the options in the save menu on the top right:

1. **Save** --- Save the changes but remain on the same page. Use this option if you want to make more changes to the record configuration.
2. **Save and Close** --- Save the changes and close the page. Once saved and closed, you are redirected to the record page.
3. **Save and New** --- Save the changes for the record you are creating/updating, and create/update another one straight away. 
   
.. note:: To discard the changes, click **Cancel** on the top right.

Review Record History
---------------------

You can review the history of a specific record if you have the corresponding permissions. Click on the **Change History** link on the top right of the record page to open the dialog window. If the record has been modified in any way, you will see who, how and when updated it.

.. image:: /user/img/getting_started/records/grids/view_history.png
   :alt: Open the dialog window by clicking on the change history link


.. _doc-grids-records-share:

Share Records
-------------

Sharing records is convenient when you need assistance from other system users who might have no access to the related record. For example, if there is a task related to an opportunity that should be performed by a person from a marketing team but the marketing associates have no access to the opportunity records, the sales manager can share the record with a specific user (or group of users).

To share a record, click **Share** on the top right of record page, and enter the name of the user to share the record with in the corresponding **Share with** field. You can also click the list icon to select such user(s).

.. toctree::
   :hidden:
   :maxdepth: 1

   view
   edit
   delete

.. include:: /include/include-images.rst
   :start-after: begin
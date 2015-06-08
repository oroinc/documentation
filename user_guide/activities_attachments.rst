.. _user-guide-activities-attachments:

Add Attachment
==============

You can add an attachment to a record in OroCRM.

.. note::

    Attachments are available only for the entities, for which they are:ref:`enabled <user-guide-activities-enable>`.
    
.. hint::

    The attachment settings depend on the specific 
    :ref:entity settings`<user-guide-entity-management-create-attachments>`.


Add Attachments
---------------

Once a record has been created, an attachment can be added from its View page.

.. caution::

   The ability to view and write attachments depends on the permissions and role settings defined in the system for the 
   entity.

- Go to the record View page

- Click the *Add Attachment* action

.. image:: ./img/activities/add_attachment.png

- In the form emerged:

  - Choose the file to attached

  - Leave a comment, if necessary

  - Define the attachment owner. Only the owner and users with roles that enable management/viewing of the owner's 
    attachments will be able to manage/view the attachment.

.. image:: ./img/activities/add_attachment_form.png


   
View and Manage Attachments
---------------------------

The attachment is now available from the record View page in the grid in the *Attachments* section:

.. image:: ./img/activities/add_attachment_view.png

From the :ref:`grid <user-guide-ui-components-grids>`, you can

- Delete the attachment: |IcDelete|
- Get to the edit form of the attachment: |IcEdit|

You can also :ref:`add the attachment <user-guide-activities-emails-add-attachment>` to emails related to the record.



.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle
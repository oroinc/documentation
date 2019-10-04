:oro_documentation_types: crm, commerce

.. _user-guide-activities-comments:

Add Comments
============

You Oro application enables you to add comments on details of an activity. For instance, you may want to comment on a task or a logged call that was made, or possibly comment that you can't attend a particular meeting.

.. important::
    By default, the list of activities available for each entity is determined by what is most commonly used by businesses. However, if your company's work process requires it, you can always turn the desirable activity on for almost any entity (except technical ones). If you need particular activities to be enabled for an entity, contact your administrator, or see steps 4 and 5 of the :ref:`Create an Entity <doc-entity-actions-create>` action description.

.. note:: See a short demo on |how to add comments|, or keep reading the guidance below.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/kGSqqKoNL20" frameborder="0" allowfullscreen></iframe>

How to Create and View Comments
-------------------------------

Once a record or an activity have been created, a comment can be added to it from:

- The page of a specific record
- When editing a specific record
- The page of an activity-related record

.. caution::

   The ability to view and write comments depends on the permissions and role settings defined in the system for the Comment entity.

To add a comment: 

1. Click **Add Comment**.
2. Enter the comment into the text-box.
3. Click **Choose File** to upload a file to your comment.
4. Click **Add** to save the comment.

.. image:: /user/img/getting_started/records/AddCommentToTask.png

.. hint::

    You can :ref:`edit <doc-entity-actions-edit>` the **Comment** entity and add new fields if required.

 .. note:: Comments for cases have an additional **Make Public** check box when your Oro application is integrated with Zendesk. This enables you to make a specific comment  public in :ref:`Zendesk <user-guide-zendesk-integration>`.

.. include:: /include/include-links.rst
   :start-after: begin

.. _user-guide-activities-comments:

Add Comment
===========


Interaction between users is an important part of successful work. In order to enable users to leave comments on records
of an :term:`entity <Entity>` or on details of an :ref:`activity <user-guide-activities>`, other than a contact request 
(e.g. leave some additional details of task, comment on an email sent or a call made, etc.) use the "*Add Comment"* 
action.

.. note::

    Comments are available for any activity or entity that has the Comments activity 
    :ref:`enabled <doc-entity-actions-create>` (see step 4).


Create and View Comments
------------------------

Once a record or an activity have been created, a comment can be added to it from:

- :ref:`Record view page <user-guide-ui-components-view-pages>`.
- :ref:`Record edit page <user-guide-ui-components-create-pages>`.
- View page of a record the activity is related to.

.. caution::

   The ability to view and write comments depends on the permissions and role settings defined in the system for the 
   Comment entity.


On these pages, the user should: 

- Click the :guilabel:`Add Comment` button.

- Enter the comment into the the text-box.

- Click the :guilabel:`Choose File` button to add a file to the comments.

- Click the :guilabel:`Add Comment` button to save the comment.

.. hint::

    You can :ref:`edit <doc-entity-actions-edit>` the **Comment** entity and add new fields, if required.

For example, Ellen Rowel was a task "Email change needed", which required her to change the email address of 
Mr. Jeffrey Maynard.

- First, Ellen Rowel opened the **My Tasks** grid.

.. image:: ../img/activities/comments_01.png  

- Then she went to the :ref:`view page <user-guide-ui-components-view-pages>` page of the task and left a comment.

.. image:: ../img/activities/comments_02.png  

- John Doe opened the task details on the View page of Jeffrey Maynard's contact record.

.. image:: ../img/activities/comments_03.png 

- Then he left a comment and attached Maynard's profile to it.
  
.. image:: ../img/activities/comments_04.png 

- Michael Buckley from the Marketing department opened the Tasks grid and opened the task View page. He can see both 
  comments made by Ellen Rowel and John Doe.

  .. image:: ../img/activities/comments_05.png 

   
Case Comments
-------------

Case comments work in a similar manner, except there is an additional **Make Public** check box. You can use it to 
define if the comment must be public on :ref:`Zendesk <user-guide-zendesk-integration>`. 

  .. image:: ../img/activities/comments_case.png 

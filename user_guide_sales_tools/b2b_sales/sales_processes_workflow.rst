
.. _user-guide-sales-processes:

Sales Processes Workflow
========================

As an alternative to direct manipulation of leads and opportunities, it is possible to manage the sales process following the steps of a Sales Process :ref:`Workflow <user-guide-workflow-management-basics>`.

Note, however, that the sales process entity is deprecated. The preferred way is direct manipulation of leads and opportunities as described in the :ref:`Leads <user-guide-system-channel-entities-leads>` and :ref:`Opportunities <user-guide-system-channel-entities-opportunities>` sections of the guide.


According to the workflow, the following actions are available for a manager:

1. Create a Sales Process record from a :term:`lead <Lead>` as soon as a potential :term:`opportuity <Opportunity>` has 
   appeared. 
   
   As the probability of the deal gets clear, the lead may be disqualified (if it is most likely that no deal 
   will be made) or qualified into an opportunity (if the deal probability gets high enough).

      |
  
   If potential success level is high from the very start, it is also possible to skip the step and create a Sales 
   Process record from an opportunity.


2. Develop an opportunity as new information appears (e.g. new agreements are reached or plans are approved), if 
   applicable.

3. Any opportunity (whether it was developed or not) may be closed, either as won or lost, subject to the deal 
   outcomes.

4. Any disqualified lead may be renewed in the following way:

  - Navigate to the Lead.
  - Edit its properties.
  - Change **Status** attribute to **New/Qualified**.
   
5. Any closed opportunity can be reopened, which will result in creation of a new opportunity.

 

.. image:: /img/sales_process/sales_process_wf.png

|

This way, the workflow leads a manager step-by-step through  a sales process life-cycle from its start to the 
completion.

.. hint::

    You can clone and customize the workflow to correspond to your business-processes or create a new workflow using the 
    same entities, as described in the :ref:`Workflows Management guide <user-guide-workflow-management-basics>`.

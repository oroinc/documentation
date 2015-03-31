
.. _user-guide-sales-processes:

Sales Processes Workflow
========================

To provide consistent and unified approach, you can define a specific workflow within which the actions can be
performed for each lead and/opportunity on OroCRM. The *Sales Processes* workflow is pre-implemented in OroCRM
for B2B Channels.

The workflow is aimed at creation of a unified approach towards processing and development of sales processes from their
initiation to completion. According to the workflow, the following actions are available for the manager:

1. Create a :term:`lead <Lead>` as soon as a potential :term:`opportunity <Opportunity>` has appeared. As the 
   probability of the deal gets clear, the lead may be disqualified (if it is most likely that no deal will be 
   made) or qualified into an opportunity (if the deal probability gets high enough).

   If potential success level is high from the very start, it is also possible to skip the step and start creating an 
   opportunity.

2. Develop an opportunity as new information appears (e.g. new agreements are reached or plans are approved), if 
   applicable.

3. Any opportunity (whether it was developed or not) may be closed, either as won or lost, subject to the deal 
   outcomes.

4. Any disqualified lead may be reactivated, which means a new lead will be created. A follow-up note can also be 
   created for every disqualified lead. 

5. Any closed opportunity can be reopened, which will result in creation of a new opportunity.
 

.. image:: ./img/sales_process/sales_process_wf.png

This way, the workflow leads a manager step-by-step through  a sales process life-cycle from its start to the 
completion.

You can clone and customize the workflow to correspond to your business-processes or create a new workflow using the 
same entities, as described in the :ref:`Workflows guide <user-guide-workflow-management-basics>`.
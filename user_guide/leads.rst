.. _user-guide-system-channel-entities-leads:

Channel Entities. Leads.
========================

The Lead records ("leads") represent people or businesses the have initial interest, authority and budget to take part 
in your commercial or social activity but whose intentions are not yet backed up with any arrangements. 

In order to use Lead records you need to have at least one :ref:`Channel <user-guide-channel-guide-create>`, for which
Lead is defined as its entity:

- :ref:`Create <user-guide-leads-create>` new leads

- :ref:`Manage <user-guide-leads-actions>` existing leads, particularly, import and export lead records and assign
  them different activities

- Analyse details of the lead records with OroCRM :ref:`reports <user-guide-leads-reports>`

- Use leads in :ref:`workflows <user-guide-leads-workflows>`


.. _user-guide-leads-create:

Create Leads from the UI
^^^^^^^^^^^^^^^^^^^^^^^^

- Click :guilabel:`Create Lead` button

- The *Create Lead* form will appear:

.. image:: ./img/leads/leads_create.png

The following fields are mandatory and **must** be defined:

.. csv-table:: Mandatory Entity Fields
  :header: "Field", "Description"
  :widths: 10, 30

  "**Owner***","Limits the list of users that can manage the lead to users, whose roles allow managing 
  leads assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.).
  
  By default, the user creating the lead is chosen."
  "**Lead Name***","The name used to refer to the lead in the system."
  "**Channel***","Choose one of active channels, the *Lead* entity is assigned to. 

  Details of the lead will be uploaded from the source of the channel."
  "**First Name*** and **Last Name***","Personal details of the potential customer or contact person." 

**Optional fields** keep additional information and may be left empty.
  
**Custom fields** can be created to meet specific customer needs and will be displayed in the *Additional* section.

To create a custom field, go to *System → Entities → Entity Management → Lead* and click :guilabel:`Create Field`
button.

Once all the necessary fields have been defined, click the button in the right top corner of the page to save the lead
in the system.


.. _user-guide-leads-actions:

Lead Actions 
^^^^^^^^^^^^^

The following actions can be performed for the leads:

From the Grid:

.. image:: ./img/leads/leads_grid.png

- Delete a lead from the system : |IcDelete|
  
- Get to the *"Edit"* form  of the lead : |IcEdit|
  
- Get to the "*View*" page of the lead : |IcView| 

- Export and import lead record details with :guilabel:`Export` and :guilabel:`Import` buttons as described in the 
  :ref:`Export and Import Functionality <user-guide-import>` guide. 

From the View page:

.. image:: ./img/leads/lead_view.png
  
- Get to the *"Edit"* form of the lead

- Delete the lead from the system 

The rest of the actions available depend on the system settings 
defined in the Communication &  Collaboration section of the 
"Lead" entity
      
.. _user-guide-leads-reports:

Reports with Leads
------------------

OroCRM currently comes with a ready-to-use *Leads by Date* report.

*Leads by Date*
^^^^^^^^^^^^^^^

This is a simple but useful report, with which you can see how many leads were created on a specific date for 
all of your channels.

To see the report go to *Reports and Segments → Reports → Leads → Leads By Date*

It shows:

- the date leads were created on 

- the number of the leads created on the date, and 

- total amount of the leads created

.. image:: ./img/leads/leads_report_by_date.png

New custom reports can be added. For more details on the ways to create and 
customize the reports,  please see the Reports guide.

.. _user-guide-leads-workflows:

Using Leads in the Workflows
----------------------------

Workflows define rules and guidelines on possible actions/updates related to the entity records. 

Currently, OroCRM comes with a pre-implemented B2B-oriented workflow described in the 
Sales Processes Workflow guide. 

New customer-specific workflows can also be created, as described in the :ref:`Workflows 
guide <user-guide-workflow-management>`




.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle

.. |Bplus| image:: ./img/buttons/Bplus.png
   :align: middle

.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle


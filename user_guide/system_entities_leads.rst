.. _user-guide-system-channel-entities-leads:

Channel Entities. Leads.
========================

Leads Entity defines common rules and setting applied to Lead records ("leads"). 
Lead records represent people or businesses the have initial interest, authority and budget to take part in your 
commercial or social activity. Intentions thereof may be yet unclear and often not backed up with 
any arrangements. 

As soon as there is at least one :ref:`Channel <user-guide-channel-guide>` assigned a *Lead* entity, you can:

- :ref:`Create <user-guide-leads-create>` new leads

- :ref:`Manage <user-guide-leads-actions>` existing leads, particularly, import and export leads and assign different 
  :ref:`activities <user-guide-leads-activities> to the leads

- Analyse Lead record details with :ref:`reports <user-guide-leads-reports>`

- Use leads in :ref:`workflows <user-guide-sales-processes-workflow>`


.. _user-guide-system-entities-leads-create:

Create Leads from the UI
^^^^^^^^^^^^^^^^^^^^^^^^

- Click :guilabel:`Create Lead` button. 

- *Create Lead* form will appear:

.. image:: ./img/leads/leads_create.png

**Mandatory fields** must be defined:

- **Owner***: limits the list of Users that can manage to its owner and Users, whose roles allow managing leads 
  owned by the owner(e.g. head of the business units, system administrator, etc.).
  
  By default, the User creating the lead is chosen.

  - Click |BCrLOwnerClear| button to clear the field
  
  - Click |Bdropdown| button to choose one of available Users from the list

  - Click |BGotoPage| button to choose from the *Select Owner* page.
  
- **Lead Name***: name used to refer to the lead in the system.

- **Channel***: any of active channels assigned the *Lead* entity. 

  Details of the lead will be uploaded from the source of the Channel.
  
  - Click |Bdropdown| button to choose one of available Channels from the list.
  
- **First Name*** and **Last Name***: personal details of the potential customer or contact person. The fields will be 
  optional since 1.4.5"
       

**Optional fields** keep additional information and may be left empty:

- If a field refers to a number (e.g. Number of employees) an integer value shall be filled (if any).

- **Source** drop-down contains tunable predefined list of possible lead sources, such as Website, Direct Mail, Partner,
  etc.

- **Contact* and *B2B Customer* enable binding the lead created to records of corresponding 
  Entities in the System.
  
  - Click |Bdropdown| button to choose one of available Contacts\Customers from the list

  - Click |BGotoPage| button to choose from the *Select Contact*\*Select B2B Customer* page

  - Click |Bplus| button to create a new Contact\new Customer in the System

  - Click |BCrLOwnerClear| button to clear the field
  
**Custom fields** can be created to meet specific customer needs and will be displayed in the *Additional* section 

(To create a custom field go to *System --> Entities --> Entity Management --> Lead* and click :guilable: `Create Field`
 button).

**Once all the necessary fields have been defined, click the button the right top corner of the page to save the lead in 
the system.**


.. _user-guide-leads-actions:

Lead Actions 
^^^^^^^^^^^^^

The following actions are available for the leads:

- From the :ref:`Grid <user-guide-ui-components-grids>`:

.. image:: ./img/leads/leads_grid.png

  - Delete a lead from the system - |IcDelete|
  
  - Get to the Edit form  of the lead - |IcEdit|
  
  - 

|IcView| : get to the View page of the lead. 

Export and import lead record details as described in the  
:ref:`*Export and Import Functionality* <user-guide-export-import >` guide. 

- From the :ref:`View page <user-guide-ui-components-view-pages>`

.. image:: ./img/lead/lead_view.png
  
:guilabel:`Edit`: get to the Edit form of the lead
  
:guilabel:`Delete` button: delete the channel from the system







Once a lead has been saved, it will appear in the *Leads* grid. A number of options is available for each lead. Hover 
the mouse to *...* column to see them:

- Click |IcDelete| to delete the lead from the system. 

- Click |IcEdit| to edit the channel details. Edit page very similar to the page you used to 
  :ref:`create a lead <user-guide-system-entities-leads-create>`), but details you have already defined will be 
  displayed

- Click |IcView| to get to the lead's view page. For example, our *Public School Bid* lead view page looks as follows:

.. image:: ./img/leads/leads_view_example.png

In the top right corner there are :ref:`action <user-guide-system-entities-actions-with-leads:>` , :guilabel:`Edit` 
and :guilabel:`Delete` buttons.

Another way to edit Lead instances, especially useful for bulk changes or in case of integration with a
third-party applications, is over .csv export and import. It is described in the 
:ref:Import and Export Functionality <user_guide_export_import>` guide.


.. _user-guide-system-entities-actions-with-leads:

Actions with Leads
------------------

All the actions enabled for the Lead entity can be performed using the lead's details. Action buttons are available 
in the top right corner of the view page. If there are over two different actions, the buttons are collected under the
:guilabel:`Lead Actions` drop-down.

**For example**, Jack&Sons managers have called to James Custolini from the Build&Live. To log the call, it is enough
to choose the :guilabel:`Log Call` action button. The log call form filled with the lead's details will appear:

.. image:: ./img/leads/leads_actions_example.png

      
.. _user-guide-system-entities-reports-with-leads:

Reports with Leads
------------------

OroCRM supports a very flexible functionality for creation of drill-down reports for any entities populated into the 
OroCRM described in a separate guide.

OroCRM 1.4 comes with two ready-to-use reports related to Lead instances.


*Leads by Date*
^^^^^^^^^^^^^^^

This is a simple but useful report with which you can see how many Lead instances were created at a specific date for 
all of your Channels.

To see the report go to *Reports and Segments --> Reports --> Leads --> Leads By Date*

It shows:

- the date Lead instances were created 

- the number of Lead instances for the date, and 

- total amount of Lead instances created


*Lead by Geography*
^^^^^^^^^^^^^^^^^^^

This report is placed in the *Manage custom reports* section and can be edited. 
"As is" the report shows:

- name of the US state (in alphabetic order)

- number of Leads in this State

For more details on the ways to customize the reports, please see the Report Guide.


Using Leads in the Workflows
----------------------------
For each Entity in the OroCRM you can specify one or several workflows that will provide for rules and guidelines on 
possible actions/updates related to all the instances of the Entity. This way you can ensure consistency and proper
succession of each step of the process using the instances.

OroCRM 1.4 comes with a ready-to-use B2B-sharpened workflow *Sales Processes*, part whereof Leads are. 
The workflow defines that each instance of a Lead entity may be:

- Used to start a new Sales Process

- Qualified into an Opportunity

- Disqualified (and Reopened later if applicable).

The full workflow is described in a \:ref:separate 
article <user-guide-sales-processes-workflow>`\


Leads Example
---------------

John&Sons Company is providing building materials to different scale businesses. During an industry fair the company account 
managers ran preliminary negotiations with Home2Go company on subontracting in a bid for public school construction. 
However the bid conditions have not yet been approved.

To record the details of the potential opportunity, there was created a Lead instance with the following propeties:

- Owner: Jack Johnson (the user creating the instance)
- Lead name: Public School Bid 
- Channel: Factory (Channel instance of B2B Type created for the John&Sons Factory sales activities as an example in the
 \:ref: Channel Management Guide <user-guide-channels-example`\ If there is no Channel instance that correspond to the 
 Lead inb the system, a new one can be created.
- First Name
- Last Name
- Contact: James Custolini
- Job Title: sales manager
- Phone number: 1676568976
- E-mail:
- B2BCustomer: Home2Go (B2B customer instance  created for the Home2Go company as an example in the
 \:ref: Channel Management Guide <user-guide-channels-example`\ If there is no B2B Customer nor a Customer Identity
 instance that correspond to the Lead inb the system, a new one can be created.)

.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle

.. |Bplus| image:: ./img/buttons/Bplus.png
   :align: middle

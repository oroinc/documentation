.. _user-guide-system-channel-entities-leads:

Leads
=====

In order to save and process the details of commercial activity with  people or businesses that have  authority, budget 
and interest to purchase goods  and/or services from you, for whom the probability of actual sales is not yet high or 
is impossible to define, use the The *"Lead"* records in OroCRM ("leads").
Initial agreement discussions, preliminary price requests or invitations for a bid may be examples of a lead. 

In order to save and process details of different leads in OroCRM, you need to have at least one 
:term:`Channel`, for which the *"Lead"* entity is assigned, as described in the 
:ref:`Channel guide <user-guide-channel-guide-entities>`.


.. _user-guide-leads-create:

Create Lead Records
-------------------

- Go to the *Sales → Leads*

- Click :guilabel:`Create Lead` button

- The *Create Lead* :ref:`form <user-guide-ui-components-create-pages>` will appear:

.. image:: ./img/leads/leads_create.png

The following fields are mandatory and **must** be defined:

.. csv-table:: Mandatory Entity Fields
  :header: "Field", "Description"
  :widths: 10, 30

  "**Owner***","Limits the list of users that can manage the lead to users,  whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing 
  leads assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.).
  
  By default, the user creating the lead is chosen."
  "**Lead Name***","The name used to refer to the lead in the system."
  "**Channel***","Choose one of active :term:`channels <Channel>`, from which OroCRM will get information on this lead."
  "**First Name*** and **Last Name***","Personal details of the potential customer or contact person." 

The rest of the fields are optional. They keep additional details about the lead (such as the website, name of 
related :term:`B2B customer <B2B Customer>`, industry, address details, etc.) 
and may be left empty.

.. note::

    Optional fields are implemented based on general B2B practices and may be used as required by your 
    business aims and processes.

.. hint::

    If you need to record and process any other details of your leads, custom :term:`fields <Field>` can be created, as 
    described in the :ref:`Entity Fields guide <user-guide-field-management-create>`. 
    Custom fields are displayed in the *Additional* section.


Once all the necessary fields have been defined, click the button in the right top corner of the page to save the lead
in the system.


.. _user-guide-leads-actions:

Manage Lead Records 
-------------------

The following actions can be performed for the leads:

From the :ref:`grid <user-guide-ui-components-grids>`:

.. image:: ./img/leads/leads_grid.png

- Delete a lead from the system : |IcDelete|
  
- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the lead : |IcEdit|
  
- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the lead : |IcView| 

- Export and import lead record details with :guilabel:`Export` and :guilabel:`Import` buttons as described in the 
  :ref:`Export and Import Functionality <user-guide-import>` guide. 

From the :ref:`View page <user-guide-ui-components-view-pages>`:

.. image:: ./img/leads/lead_view.png
  
- Get to the *"Edit"* form of the lead

- Delete the lead from the system 

The rest of the actions available depend on the system settings defined in the Communication &  Collaboration section 
of the "Lead" entity
      

.. _user-guide-leads-reports:

Reports with Lead Records
-------------------------

OroCRM currently comes with a ready-to-use *Leads by Date* report.

Leads by Date
^^^^^^^^^^^^^

This is a simple but useful report, where you can see how many leads were created on a specific date for 
all of your channels.

In order to see the report, go to *Reports and Segments → Reports → Leads → Leads By Date*

It shows:

- the date leads were created on 

- the number of the leads created on the date, and 

- total amount of the leads created

.. image:: ./img/leads/leads_report_by_date.png

New custom reports can be added. For more details on the ways to create and 
customize the reports,  please see the :ref:`Reports guide <user-guide-reports>`.


.. _user-guide-leads-workflows:

Using Leads in the Workflows
----------------------------

You can use OroCRM's :term:`workflows <Workflow>` to define rules and guidelines on possible actions/updates of Leads 
in the system. 

Currently, OroCRM comes with a pre-implemented B2B-oriented workflow described in the 
:ref:`B2B Sales Process Workflow guide <user-guide-sales-processes>`. 

New customer-specific workflows can also be created, as described in the 
:ref:`Workflows guide <user-guide-workflow-management-basics>`.




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


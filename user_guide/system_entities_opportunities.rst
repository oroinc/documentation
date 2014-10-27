
.. _user-guide-system-channel-entities-opportunities:

Opportunities Management Guide
==============================


What is an Opportunity Entity
-----------------------------

*Entity* is a grouping of things with common rules and/or data. Rules and/or setting defined for an Entity are applied 
to all of its instances. Flexible and customizable Oro Platform-based :term:`OroCRM` solution can be filled with any 
kind of Entities subject to your specific customer needs.

However, we have used our experience in sales and retails business and provided a number of embedded entities, that you
can use right away or after mere customization.
One of such entities is an :term:`Opportunity`.

Instances of an Opportunity entity are people or businesses that have significant interest, authority and 
budget to purchase a product or service from you, for which a probability of making a deal is rather high.
In other words, if you feel that a potential customer is rather likely to become your actual client, this is an 
Opportunity. (If the probability of the future deal is low or undefined this is rather a 
\:ref:`Lead <user-guide-system-entities-leads>` than an Opportunity


What You Can Do with Opportunity Instances
------------------------------------------

Opportunity is one of \:ref:`System Channel Entities <user-guide-channel-guide-system-channel-entities>` for 
:term:`B2B Channels <B2B Channel>`.

As Opportunity is a pre-implemented entity, OroCRM provides for some ready-to-use capabilities related to its instances.

Once there is at least one :term:`Channel` assigned an *Opportunity* entity (B2B or :term:`custom <Custom Component>`
channel):

- You can manage Opportunity instances from the devoted :ref:`Sales/Opportunities 
  tab <user-guide-system-entities-opportunities-salestab>` in the OroCRM UI

- You can use details of the Opportunity instances to perform 
  :ref:`Actions <user-guide-system-entities-opportunities-actions-opportunities>`, such as an embedded *Send 
  E-mail*, *Add note* and *Add attachment*  

- You can analyse details of the Opportunity instances with ready-to-use and easy-to-customize 
  :ref:`Reports <user-guide-system-entities-opportunities-reports-opportunities>`

- You can refer to the Opportunity instances within a devoted B2B 
  \:ref:`Sales Processes Workflow <user-guide-sales-processes-workflow>`\ and customized 
  \:ref:`Workflows <user-guide-workflow-management>`\ 

  
.. _user-guide-system-entities-opportunities-salestab:
  
Manage Opportunities from Sales/Opportunities Tab
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once there is at least one Channel assigned an *Opportunity* entity (B2B or custom channel), *Opportunity* section will 
appear in the *Sales* menu. 

.. hint:: 
      
      If you cannot see the section, there may be still no Channels with an *Opportunity* Entity assigned to them 
      in the System. Please see the \:ref:`Channel Guide <user-guide-channel-guide>` and add necessary channels.

      If the problem persists, you may not have User-rights to View\Edit the functionality.

      Please address you system administrator.

From here you can:

- :ref:`Create <user-guide-system-entities-opportunities-salestab-create-opportunities>` Opportunity instances
 
- :ref:`Import <user-guide-system-entities-opportunities-salestab-import-opportunities>` Opportunity instances from a 
  .csv file

- :ref:`Export <user-guide-system-entities-opportunities-salestab-export-opportunities>` Opportunity instances  in a .csv file

- :ref:`Edit <user-guide-system-entities-opportunities-salestab-edit-opportunities>` existing Opportunity instances 


.. _user-guide-system-entities-opportunities-salestab-create-opportunities:

Create Opportunities
""""""""""""""""""""

Click :kbd:`Create Opportunity` button to manually input the details of the Opportunity instance.
The form specified for the Channel's Opportunity instances will appear.

.. hint:: 
      
      You can also create a Opportunity from the *System -->Sales Processes* page.
      See \:ref:`Sales Processes <user-guide-sales-process-workflow-start-from-opportunity>`\ for 
      details.

The form contains mandatory system fields, optional system fields and custom fields (if any).


.. _user-guide-system-entities-opportunities-salestab-create-opportunities-mandatory-fields:

Mandatory System Fields for Opportunities
"""""""""""""""""""""""""""""""""""""""""

Regardless the Opportunity entity settings, the following fields are mandatory and **must** be defined.

.. list-table:: **Mandatory Opportunity Fields**
   :widths: 10 30
   :header-rows: 1

   * - Field
     - Description

   * - **Owner***
     - This field limits the list of Users authorized to manage instances of the Opportunity created. Once a User is 
       chosen only this User and Users whose predefined Role provides for management of Opportunity entities that belong
       to this User (e.g. a head of the User's Business Units, System administrator) can do so.

       By default, the User creating the Opportunity is chosen.

            To clear the field click |BCrLOwnerClear| button.

            Click |Bdropdown| button to choose one of available Users from the list.

            Click |BGotoPage| button to choose from the *Select Owner* page.

   * - **Opportunity Name***
     - This is the name that will be used to save and display the Opportunity instance in the System.

       It is recommended to define a meaningful name.

   * - **B2B Customer***
     - The field binds the Opportunity instance created to a specific instance of the Customer entity present in the 
       System. Customer entity instance contains all the details of one customer available in the System (e.g. shipping
       and banking details, data on opportunities and purchases from all Channels, etc.).

       *Field that was optional for Leads, is mandatory for Opportunities. This is related to higher business importance
       of Opportunities. While almost any potentially useful acquaintance may be deemed as a Lead, Opportunities shall
       have high probability of turning into real sales activities, and thus it is important to keep track of the
       related customers information.*

            Click |Bdropdown| button to choose one of available Customers from the list.
       
            Click |BGotoPage| button to choose from the *Select B2B Customer* page.

            Click |Bplus| button to create a Customer in the System.
            
            To clear the field click |BCrLOwnerClear| button.

            
Optional System Fields for Opportunities
""""""""""""""""""""""""""""""""""""""""

Optional System Fields may be left empty. They are added based on Oro's experience as the fields that you may find
handy and convenient to use.
Many of optional system fields are free text fields with transparent names, e.g.*Custom Need*, *Proposed Solution*, etc.

If a field refers to a number (e.g. *Probability (%)*, *Budget Amount ($)*, *Close Revenue ($)*) an integer value shall
be filled (if any).

Optional system field *Close Reason* is a drop-down that contains adjustable predefined list of possible closure reasons
for the Opportunity instance, i.e. Cancelled, Outsold and Won.

Optional system fields *Potential Customer* is an instance of the *Contact* entity that will be bound to the instance of
Opportunity created.
*Potential Customer* entity instance represents one contact person and helps keeping all the contact details and process 
them for further usage (mailings, notification delivery, feedback requests etc.)

- Click |Bdropdown| button to choose one of available Contacts from the list.

- Click |BGotoPage| button to choose from the *Select Potential Customer* page.

- Click |Bplus| button to create a new *Potential Customer* the System.

- To clear the field click |BCrLOwnerClear| button.


Custom Fields for Opportunities
"""""""""""""""""""""""""""""""

All the Custom fields populated into the System and available for the User will be displayed in the *Additional*
section (to create a custom field go to *System --> Entities --> Entity Management --> Create Field*) .

Once you have filled all the mandatory and desired fields, click :kbd:`Save and Close` button and you will get to the page of the
Opportunity created. The Opportunity will also appear in the Opportunities grid.


.. _user-guide-system-entities-opportunities-salestab-import-opportunities:

Import Opportunities
""""""""""""""""""""

If you want to upload multiple Opportunity instances manually or from a third-party enterprise application, it is worth 
considering our *Import* option. OroCRM can process .scv files that correspond to the Data template.

Click |Bdropdown| on the :kbd:`Import` button in the top right corner of the *Sales\Opportunities* page. Choose 
:kbd:`Download Data Template`. Prepare a .csv file that corresponds the template and click *Import* button, choose the 
.csv file for import, carefully read through the submission form and confirm the import.

.. caution:: 
      
      :ref:`Mandatory 
      fields <user-guide-system-entities-opportunities-salestab-create-opportunities-mandatory-fields>` of 
      Opportunity instances **must** be specified

Once import is over the new Opportunity instances will appear in the grid.

.. hint:: 
      
      You can leave "id" field empty, and the system will generate unique ids itself. Be careful, if there are
      already some Opportunity instances in the system and you upload new ones with ids specified. If the two ids 
      match (e.g. one from a third-party application and one already in the system), the system will treat the 
      Opportunity instance creation, as update of an existing Opportunity instance.

      
.. _user-guide-system-entities-opportunities-salestab-export-opportunities:

Export Opportunities
""""""""""""""""""""

A functionality is provided to easily export a .csv file from the Opportunities grid:

In order to export the .csv file:

- Go to *Sales --> Opportunities* and click :kbd:`Export` button. 

- *"Export started. Please wait"* message will appear at the top of the screen.

- As soon as the export has finished the message will change to: *"Export performed successfully, [number] 
  downloads exported. Download result file"*.

- Click the *"Download result file*" at the end of the message and the download will be performed subject to your 
  browser settings.

    
.. _user-guide-system-entities-opportunities-salestab-edit-opportunities:
    
Edit Opportunities
""""""""""""""""""

There are several ways to edit Opportunity instances that are already present in the system:

- Editing opportunities details from the WEB

- Processing .csv files


*Edit Opportunities from the Web*
*********************************

For individual changes, the most convenient way is to go the Opportunities page and edit details of a specific 
Opportunity instance:

- Go to the Sales --> Opportunities and click on the row of a required Opportunity instance in the grid.

- The page of the Opportunity instance will emerge.

.. hint:: 
      
      You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 

As Opportunity makes a significant components of the Sales Process workflow, you cannot delete an Opportunity.

- Click :kbd:`Edit` button to edit the details.

- Re-define the values you need to change in the emerged *Create*-like form
  This is similar to 
  :ref:`creating a Opportunity <user-guide-system-entities-opportunities-salestab-create-opportunities>`

- Once you have done all the necessary changes, click :kbd:`Save and Close` button and you will get back to the Opportunities grid.

- Details of the Opportunity instance will be updated.



*Edit Opportunities Using .csv Export/Import*
**********************************************

Another way to edit Opportunity instances, that is especially useful for bulk changes or in case of integration with a
third-party applications is over .csv export and import. To do so, you need to

- :ref:`Export <user-guide-system-entities-opportunities-salestab-export-opportunities>` .csv file from the 
  Opportunities grid

- Edit the file

- :ref:`Import <user-guide-system-entities-opportunities-salestab-import-opportunities>` the edited file.



.. _user-guide-system-entities-opportunities-actions-opportunities:

Actions with Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^^^

Subject to your business needs and specific customization, Oro Platform provides tools for creation of other Actions 
using Opportunity instances, as well as instances of any other Entity populated into the OroCRM. However, there are 
three actions embedded in the OroCRM 1.4

*Add Note*
""""""""""

To simplify your work with the Opportunities, there is an Add Note action.

- Go to the Sales --> Opportunities and click on the row of a required Opportunity instance in the grid.

- The page of the Opportunity instance will emerge. 

- Click :kbd:`Add Note` button in the top right corner of the page 

- Fill the emerged free text form. The text will appear in the *Additional Information* section of the 
  Opportunity instance.


.. hint:: 
      
      You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 

*Add Attachment*
""""""""""""""""

Another useful action is *Add Attachment*.

- Go to the Sales --> Opportunities and click on the row of a required Opportunity instance in the grid.

- The page of the Opportunity instance will emerge. 

- Click :kbd:`Add Attachment` button in the top right corner of the page.

- In the emerged form:
  
  - Select the file
  
  - Leave a Comment (if needed)
  
  - Define the Owner (defines what Users can view and manage this attachment)
    By default the Attachment Owner is set to the User that has created the Attachment.
  
The attachment will be available from the *Additional Information/Attachments* section of the Opportunity instance.


.. hint:: 
      
      You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 

      
*Send Email*
""""""""""""

In order to send an Email pre-filled with the details of specific Opportunity instance:

- Go to the Sales --> Opportunities and click on the row of a required Opportunity instance in the grid.

- The page of the Opportunity instance will emerge. 

- Click :kbd:`Send Email` button in the top right corner of the page

- E-mail template already filled with the details of the Opportunity instance will appear. 

- You only need to fill the Subject and Body and click *Send*

.. hint:: 
      
      You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 


.. _user-guide-system-entities-opportunities-reports-opportunities:


Reports with Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^^^

OroCRM supports a very flexible functionality for creation of drill-down reports for any entities populated into the 
System. OroCRM 1.4 comes with several ready-to-use reports related to Opportunity instances.


*Opportunities by Status*
"""""""""""""""""""""""""

With this report you can see aggregated information of all the Opportunities with the same status.

To see the report go to *Reports and Segments --> Reports --> Opportunities --> Opportunities by Status*

It shows:

- Opportunity status 

  - In Progress: created and still at the negotiations stage

  - Lost: the Opportunity did not result in any sales activities

  - Won: sales started for the Opportunity

- Number of Opportunity instances that have this status

- Total close revenue of all the Opportunities with a specific status

- Total budget defined for all the Opportunities with a specific status


*Won Opportunities By Date Period*
"""""""""""""""""""""""""""""""""""
With this report you can see the amount and budget of won opportunities for a specific month.

To see the report go to *Reports and Segments --> Reports --> Opportunities --> Won Opportunities By Period*

It shows:

- A month for which the data is displayed

- Number of Opportunities won during the month

- Total close revenue of these Opportunities


*Total Forecast*
""""""""""""""""

This report is placed in the *Manage custom reports* section and can be edited. 
"As is" the report shows total budget amount of all the opportunities with specific probability:

For more details on the ways to customize the reports, please see the Report Guide (TBD)


Using Opportunities in the Workflows
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
For each Entity in the OroCRM you can specify one or several workflows that will provide for rules and guidelines on 
possible actions/updates related to all the instances of the Entity. This way you can ensure consistency and proper
succession of each step of the process using the instances.

OroCRM 1.4 comes with a ready-to-use B2B-sharpened workflow *Sales Processes*, part whereof Opportunities are. 
The workflow defines that each instance of a Opportunity entity may be:

- Used to start a new Sales Process

- Developed (moved to active negotiation stage)

- Closed as Won

- Closed as Lost

The full workflow is described in the \:ref:`Sales Processes Workflow 
article <user-guide-sales-process-workflow>`\

Opportunities Examples 


1
^

You went to a conference and met a manager of a store chain interested in your goods. You have exchanged contact 
details and the manager promised to provide a request for proposal in the nearest time. As a successful deal seems 
rather likely, you have created an Opportunity instance for the company and tied it to the Contact instance that 
contains contact details of the manager. You have also created a new Customer instance for this store chain and assigned
the Opportunity instance to this Customer instance. 

*Now you can easily access and process details of the Opportunity instance and related Contact and Customer instances, 
use them for notes and E-mails, view in the reports, use for the further Sales Process workflow, etc.* 


2
^

You have run an "Send SMS and Get a Discount" advertisement campaign, and created a number of Leads. Initially one of 
the campaign participants addressed you with a request for proposal. You have qualified the Lead and thus turned it into
an opportunity. 

You have also added the request proposal as an attachment. 

*Now you can access and process your potential customer's information, use it for notes and E-mails, view it in the 
reports and use it for the further Sales Process workflow.* 


.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle

.. |Bplus| image:: ./img/buttons/Bplus.png
   :align: middle

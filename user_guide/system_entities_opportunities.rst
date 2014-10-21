System Entities. Opportunities
==============================

.. |Bsc| image:: ./img/buttons/Bsc.png
   :align: middle

.. |BEdit| image:: ./img/buttons/BEdit.png
   :align: middle

.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle

.. |BStartfO| image:: ./img/buttons/BStartfO.png
   :align: middle

.. |Bplus| image:: ./img/buttons/Bplus.png
   :align: middle

.. |BCrO| image:: ./img/buttons/BCrO.png
   :align: middle

.. |BAddNote| image:: ./img/buttons/BAddNote.png
   :align: middle

.. |BSendEm| image:: ./img/buttons/BSendEm.png
   :align: middle
   
.. |BAddAtt| image:: ./img/buttons/BAddAtt.png
   :align: middle


What is an Opportunity Entity
-----------------------------
*Entity* is a grouping of things with common rules and/or data. Rules and/or setting defined for an Entity are applied 
to all of its instances. Flexible and customizable Oro Platform-based OroCRM solution can be filled with any kind of 
Entities subject to your specific customer needs.

However, we have used our experience in sales and retails business and provided a number of embedded entities, that you
can use right away or after mere customization.
One of such entities is an *Opportunity*.

Instances of an Opportunity entity are people or businesses that have significant interest, authority and 
budget to purchase a product or service from you, for which a probability of making a deal is rather high.

Sometimes, at the moment you start dealing with a potential customer, you know they are likely to become your client.
Such potential customer is an Opportunity. (If the probability of the future deal is low or undefined this is rather a
`Lead </user_guide/system_entities_leads.rst#system-entities-leads>`_ than an Opportunity


What You Can Do with Opportunity Instances
------------------------------------------
Opportunity is one of `System Channel Entities </user_guide/channel_guide.rst#system-channel-entities>`_ for B2B 
Channels.

As Opportunity is an embedded Entity, OroCRM provides for some ready-to-use capabilities related to its instances.

Once there is at least one Channel assigned an *Opportunity* entity (B2B or custom channel):

- You can manage Opportunity instances from the devoted `Sales/Opportunities 
  tab </user_guide/system_entities_opportunities.rst#manage-opportunities-from-salesopportunities-tab>`_ in the OroCRM 
  UI

- You can use details of the Opportunity instances to perform 
  `Actions </user_guide/system_entities_opportunities.rst#actions-with-opportunities>`_, such as an embedded *Send 
  E-mail*, *Add note* and *Add attachment*  

- You can analyse details of the Opportunity instances with ready-to-use and easy-to-customize 
  `Reports </user_guide/system_entities_opportunities.rst#reports-with-opportunities>`_

- You can refer to the Opportunity instances within a devoted B2B 
  `Sales Processes Workflow </user_guide/sales_processes_workflow.rst#sales-processes-workflow>`_ and customized 
  `Workflows </user_guide/workflow_management.rst#workflow-management>`_ 

 
Manage Opportunities from Sales/Opportunities Tab
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
Once there is at least one Channel assigned an *Opportunity* entity (B2B or custom channel), *Opportunity* section will 
appear in the *Sales* menu. 

.. hint:: If you cannot see the section, there may be still no Channels with an *Opportunity* Entity assigned to them 
          in the System. Please see the `Channel Guide </user_guide/channel_guide.rst#channel-guide>`_ and add necessary
          channels.

          If the problem persists, you may not have User-rights to View\Edit the functionality.

          Please address you system administrator.

From here you can:

- `Create </user_guide/system_entities_opportunities.rst#create-opportunities>`_ Opportunity instances
 
- `Import </user_guide/system_entities_opportunities.rst#import-opportunities>`_  Opportunity instances  from a .csv 
  file

- `Export </user_guide/system_entities_opportunities.rst#export-opportunities>`_ Opportunity instances  in a .csv file

- `Edit </user_guide/system_entities_opportunities.rst#edit-opportunities>`_ existing Opportunity instances 

Create Opportunities
""""""""""""""""""""

Click |BCrO| button to manually input the details of the Opportunity instance.
The form specified for the Channel's Opportunity instances will appear.

.. hint:: You can also create a Opportunity from the *System -->Sales Processes* page.
          See `Sales Processes </user_guide/sales_process_workflow.rst#start-a-sales-process-from-opportunity>`_ for 
          details.

The form contains mandatory system fields, optional system fields and custom fields (if any).


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

Once you have filled all the mandatory and desired fields, click |Bsc| button and you will get to the page of the
Opportunity created. The Opportunity will also appear in the Opportunities grid.

Import Opportunities
""""""""""""""""""""

If you want to upload multiple Opportunity instances manually or from a third-party enterprise application, it is worth 
considering our *Import* option. OroCRM can process .scv files that correspond to the Data template.

Click |Bdropdown| on the **Import** button in the top right corner of the *Sales\Opportunities* page. Choose *Download 
Data Template*. Prepare a .csv file that corresponds the template and click *Import* button, choose the .csv file for
import, carefully read through the submission form and confirm the import.

.. caution:: `Mandatory 
             fields </user_guide/system_entities_opportunities.rst#mandatory-system-fields-for-opportunities>`_ of 
             Opportunity instances **must** be specified


.. hint:: You can leave "id" field empty, and the system will generate unique ids itself. Be careful, if there are
          already some Opportunity instances in the system and you upload new ones with ids specified. If the two ids 
          match (e.g. one from a third-party application and one already in the system), the system will treat the 
          Opportunity instance creation, as update of an existing Opportunity instance.

Once import is over the new Opportunity instances will appear in the grid.

Export Opportunities
""""""""""""""""""""

A functionality is provided to easily export a .csv file from the Opportunities grid:

In order to export the .csv file:

- Go to *Sales --> Opportunities* and click **Export** button. 

- *"Export started. Please wait"* message will appear at the top of the screen.

- As soon as the export has finished the message will change to: *"Export performed successfully, [number] 
  downloads exported. Download result file"*.

  - Click the *"Download result file*" at the end of the message and the download will be performed subject to your 
    browser settings.

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

.. hint:: You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 

- The page of the Opportunity instance will emerge.

The Opportunity's page will emerge. 

As Opportunity makes a significant components of the Sales Process workflow, you cannot delete an Opportunity.


- Click |BEdit| button to edit the details.

  - *Create* form with previously defined values will appear.

  - Re-define the values you need to change.
    This is similar to `creating a Opportunity </user_guide/system_entities_opportunities.rst#create-opportunities>`_

- Once you have done all the necessary changes, click |Bsc| button and you will get back to the Opportunities grid.

Details of the Opportunity instance will be updated.



*Edit Opportunities Using .csv Export/Import*
**********************************************

Another way to edit Opportunity instances, that is especially useful for bulk changes or in case of integration with a
third-party applications is over .csv export and import. To do so, you need to

-`Export </user_guide/system_entities_opportunities.rst#export-opportunities>`_ .csv file from the Opportunities grid

- Edit the file

- `Import </user_guide/system_entities_opportunities.rst#import-opportunities>`_ the edited file.


Actions with Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^^^
Subject to your business needs and specific customization, Oro Platform provides tools for creation of other Actions 
using Opportunity instances, as well as instances of any other Entity populated into the OroCRM. However, there are 
three actions embedded in the OroCRM 4.1

*Add Note*
""""""""""
To simplify your work with the Opportunities, there is an Add Note action.

- Go to the Sales --> Opportunities and click on the row of a required Opportunity instance in the grid.

.. hint:: You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 

- The page of the Opportunity instance will emerge. 

- Click |BAddNote| button in the top right corner of the page 

- Fill the emerged free text form.

The text that will appear in the *Additional Information* section of the Opportunity instance.

*Add Attachment*
""""""""""""""""
Another useful action is *Add Attachment*.

- Go to the Sales --> Opportunities and click on the row of a required Opportunity instance in the grid.

.. hint:: You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 

- The page of the Opportunity instance will emerge. 

- Click |BAddAtt| button in the top right corner of the page 

- Select the file and leave a Comment (if needed). Be default the Attachment Owner is set to the User that create the 
  Attachment. The Owner field for attachments defines what Users can view and manage this attachment.
  
The attachment will be available from the *Additional Information/Attachments* section of the Opportunity instance.

*Send Email*
""""""""""""
In order to send an Email pre-filled with the details of specific Opportunity instance:

- Go to the Sales --> Opportunities and click on the row of a required Opportunity instance in the grid.

.. hint:: You can use *Filters* functionality to simplify the search for the necessary Opportunity instance. 

- The page of the Opportunity instance will emerge. 

- Click |BSendEm| button in the top right corner of the page

- E-mail template already filled with the details of the Opportunity instance will appear. 

- You only need to fill the Subject and Body and click *Send*

Reports with Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
OroCRM supports a very flexible functionality for creation of drill-down reports for any entities populated into the 
OroCRM.

OroCRM 4.1 comes with several ready-to-use reports related to Opportunity instances.
- 


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

OroCRM 4.1 comes with a ready-to-use B2B-sharpened workflow *Sales Processes*, part whereof Opportunities are. 
The workflow defines that each instance of a Opportunity entity may be:

- Used to start a new Sales Process

- Developed (moved to active negotiation stage)

- Closed as Won

- Closed as Lost

The full workflow is described in a `separate article </user_guide/sales_process_workflow.rst>`_

*Opportunities Example 1*
--------------------------
*You went to a conference and met a manager of a store chain interested in your goods. You have exchanged contact details
and the manager promised to provide a request for proposal in the nearest time. As a successful deal seems rather 
likely, you have created an Opportunity instance for the company and tied it to the Contact instance that contains 
contact details of the manager. You have also created a new Customer instance for this store chain and assigned the 
Opportunity instance to this Customer instance.* 
*Now you can easily access and process details of the Opportunity instance and related Contact and Customer instances, 
use them for notes and E-mails, view in the reports, use for the further Sales Process workflow, etc.* 

*Opportunities Example 2*
--------------------------
*You have run an "Send SMS and Get a Discount" advertisement campaign, and created a number of 
`Leads </user_guide/system_entities_leads.rst#leads-example>`_ . Initially one of the campaign participants addressed 
you with a request for proposal. You have qualified the Lead and thus turned it into an opportunity.* 
*You have also added the request proposal as an attachment.* 
*Now you can access and process your potential customer's information, use it for notes and E-mails, view it in the 
reports and use it for the further Sales Process workflow.* 
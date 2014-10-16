Sales Process Workflow
======================

.. |B01| image:: ./img/buttons/B01.png


.. |Bsc| image:: ./img/buttons/Bsc.png
   :align: middle

.. |BDelete| image:: ./img/buttons/BDelete.png
   :align: middle


.. |BEdit| image:: ./img/buttons/BEdit.png
   :align: middle

.. |BCrL| image:: ./img/buttons/BCrL.png
   :align: middle

.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle

.. |BStartfL| image:: ./img/buttons/BStartfL.png
   :align: middle

.. |Bplus| image:: ./img/buttons/Bplus.png
   :align: middle

.. |BSave| image:: ./img/buttons/BSave.png
   :align: middle

.. |BSubmit| image:: ./img/buttons/BSubmit.png
   :align: middle

.. |BCrO| image:: ./img/buttons/BCrO.png
   :align: middle

.. |BAddNote| image:: ./img/buttons/BAddNote.png
   :align: middle

.. |BSendEm| image:: ./img/buttons/BSendEm.png
   :align: middle

.. |LeadCrMF| image:: .\img\sales_process_workflow\Screenshots\LeadCrMF.png
   :width: 50 %

.. |OppCrMF| image:: .\img\sales_process_workflow\Screenshots\OppCrMF.png
   :width: 50 %

What Sales Processes are About
------------------------------

Sales Processes is a part of OroCRM responsible for automation of Business to Business work-flow handling.
This functionality provides for consistence and continuous monitoring of the sales process from initial arrangements
all the way over negotiations and proposals to successfully realized opportunities. With the functionality and
customizable embedded report sales managers can gain clear understanding of the specific workflows and implement
more customer-oriented sales approach.

As any part of OroCRM, Sales Processes functionality is very flexible and can be tuned to correspond your specific
business need.
In fact, OroCRM may be filled with any business specific Entities and their details and Oro Platform can be used to
set up a Workflow using this Entities. We have implemented such a work-flow that fits general needs of B2B Sales
Process management and may be used without additional tuning, without prejudice to its flexibility and scalability.

.. hint:: OroCRM may be filled with any business specific Entities and their details and Oro Platform can be used to
          set up a Workflow using this Entities.

Steps to Perform
-----------------

As it was said above, the Sales Processes functionality is about Business to Business workflow. What do we need to
create a meaningful workflow?

- Information about Channels of B2B Sales (shops, stores, retail outlets, etc.)

- Information about Leads that appear for these Channels (people\organizations that fit the Channels target-group and
  may make a good Opportunity)

- Information about Opportunities for these Channels (Leads for which there is a high probability of successful sales
  initiation)

Once these three are in the system, OroCRM gives clear and convenient ways to input and process this information, as
well as tools for its monitoring and analysis. In the following sections we shall consider, how to:

I. Populate the System with B2B Channels

II. Populate the System with Leads

III. Populate the System with Opportunities

IV. Develop Sales Processes

I. Populate the System with B2B Channels
----------------------------------------

Channel in OroCRM represents a specific source of sales or customers, this may be a retail outlet, an E-commerce market
place, a partner or a marketing campaign, etc. For each Channel there is a predefined set of entities (groups of
instances with predefined contents and processing rules), and their instances contain Channel-specific details to be
processed in the system (e.g. information about actual and potential customers, details of campaigns etc.)

A special type of Channels is devoted for B2B sales processing.
To create a B2B channel go to *System --> Channels*, click |B01| button in the top right corner, and create a B2B type
channel in the emerged page.

For more details on Channel creation please address our `Channels Guide </user_guide/channel_guide.rst#channel-guide>`_.

.. note:: When creating a B2B Channel Users with appropriate right can use default settings or modify B2B Customer,
          Lead and Opportunity forms, as well as enable\disable attachment storage within Sales Process details.
          This settings will then be applied for this Channel everywhere in OroCRM.

II. Populate the System with Leads
----------------------------------

The straightforward way to populate the System with Leads is from the *System --> Leads* page:

1. Go to the dedicated *Sales --> Leads* page

2. Create or Import Leads

3. Edit created leads, if necessary


1. Go to the Dedicated *Sales --> Leads* section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^
*Sales\Leads* page will appear. From here you can Create of Import Leads.


.. hint:: If you cannot see the section, there may be still no B2B Channels with Leads Entity assigned to them in the
          System. `View the Channels list </user_guide/channel_guide.rst#further-actions>`_ to check it.
          `Fill the System with Channels </user_guide/sales_process_workflow.rst#fill-the-system-with-b2b-channels>`_ ,
          if necessary

          If the problem persists, you may not have User-rights to View\Edit the functionality.
          Please address you system administrator.

2a. Create Leads
^^^^^^^^^^^^^^^^

Click |BCrL| button to manually input the Lead's details.
The form specified for the Channel's Leads will appear.

.. hint:: You can also create a Lead from the *System -->Sales Processes* page.
          See `Sales Processes </user_guide/sales_process_workflow.rst#start-a-sales-process-from-lead>`_ for details.

The form contains mandatory system fields, optional system fields and custom fields (if any).


Mandatory System Fields for Leads
"""""""""""""""""""""""""""""""""

Regardless the Lead entity settings, the following fields are mandatory and **must** be defined.

|LeadCrMF|

Detailed description of each field is provided below:


.. list-table:: **Mandatory Lead Fields**
   :widths: 10 30
   :header-rows: 1

   * - Field
     - Description

   * - **Owner***
     - This field limits the list of Users authorized to manage the Lead created. Once a User is chosen only this User
       and Users whose predefined Role provides for management of Leads that belong to this User (e.g. a head of the
       User's Business Units, System administrator) can do so. Please see Roles Administrator Guide for more details if
       required.

       By default, the User creating the Lead is chosen.

            To clear the field click |BCrLOwnerClear| button.

            Click |Bdropdown| button to choose one of available Users from the list.

            Click |BGotoPage| button to choose from the *Select Owner* page.

   * - **Lead Name***
     - This is the name that will be used to save and display the Lead in the System.

       It is recommended to define a meaningful name.

   * - **Channel***
     - Any of the Channels in the System that is assigned *Lead* Entity.

            Click |Bdropdown| button to choose one of available Channels from the list.

   * - **First Name***
     - Name of the potential customer or contact person.

       It is recommended to define a meaningful name.

   * - **Last Name***
     - Last name of the potential customer or contact person.

       It is recommended to define a meaningful name.

Optional System Fields for Leads
""""""""""""""""""""""""""""""""

Optional System Fields may be left empty. They are added based on Oro's experience as the fields that you may find
handy and convenient to use.
Many of optional system fields are free text fields with transparent names, e.g.*Name Prefix*, *Job Title*,
*Company Name*, *Website*, etc.

If a field refers to a number (e.g. Number of employees) an integer value shall be filled (if any).

Optional system field *Source* is a drop-down that contains adjustable predefined list of possible Lead sources, such
as Website, Direct Mail, Partner, etc.

Optional system fields *Contact* and *B2B Customer* enable binding the Lead created to corresponding Entities in the
System.

*Contact* entity represents one contact person and helps keeping all the contact details and process them for further
usage (mailings, notification delivery, feedback requests etc.)

*B2B Customer* entity contains all the details of one customer available in the System (e.g. shipping and banking
details, data on opportunities and purchases from all Channels, etc.).

- Click |Bdropdown| button to choose one of available Contacts\Customers from the list.

- Click |BGotoPage| button to choose from the *Select Contact*\*Select B2B Customer* page.

- Click |Bplus| button to create a new Contact\new Customer in the System.

- To clear the field click |BCrLOwnerClear| button.

.. note:: If at least one address field (e.g. *Street*) has been field, the rest of the address-related system fields
          (namely *Country*, *City* and *Zip\postal code* **must** be defined)

Custom Fields for Leads
"""""""""""""""""""""""

All the Custom fields populated into the System and available for the User will be displayed in the *Additional*
section (to create a custom field go to *System --> Entities --> Entity Management --> Create Field*).


Once you have filled all the mandatory and desired fields, click |Bsc| button and you will get to the page of the Lead
created. The Lead will also appear in the Leads grid.

2b. Import Leads
^^^^^^^^^^^^^^^^
If you want to upload multiple Leads manually or from a third-party enterprise application, it is worth considering our
*Import* option. OroCRM can process .scv files that correspond to the Data template.

Click |Bdropdown| on the **Import** button in the top right corner of the *Sales\Leads* page. Choose *Download Data
Template*. Prepare a .csv file that corresponds the template and click *Import* button, choose the .csv file for
import, carefully read through the submission form and confirm the import.

.. caution:: `Mandatory fields of Leads </user_guide/sales_process_workflow.rst#mandatory-system-fields-for-leads>`_
             **must** be specified


.. hint:: You can leave "id" field empty, and the system will generate unique ids itself. Be careful, if there are
          already some Leads in the system and you upload new ones with ids specified. If the two ids match (e.g. one
          from a third-party application and one already in the system), the system will treat the Lead creation, as
          update of an existing Lead.

Once import is over the new Leads will appear in the list.


3. Edit Leads
^^^^^^^^^^^^^

There are several ways to edit the Leads that are already present in the system, i.e. editing leads details from the WEB
and processing .csv files.



Edit Leads from the Web
"""""""""""""""""""""""
For individual changes, the most convenient way is *to go the Lead's page and edit the Lead's details*

.. hint:: You can use *Filters* functionality to simplify the search for the necessary Lead. The *Filters* are rather
          see-through and easy to use, but if you feel a lack of assistance, please refer to the Filters Guide (TBD).

Once you have found the target Lead, click on any column thereof.

The Lead's page will emerge.

- Click |BDelete| button to delete this Lead from the System.

- Click |BEdit| button to edit the Lead's details.

*Create* form with previously defined values will appear.

- Re-define the values you need to change.
  This is similar to `creating a Lead </user_guide/sales_process_workflow.rst#create-leads>`_

Once you have done all the necessary changes, click |Bsc| button and you will get back to the Lead's page.
The Lead's details will be updated.

.. hint:: To simplify your work with the Leads, there is an Add Note action. Click |BAddNote| button in the top right
          corner of the Lead's page and enter the text that will appear in the Lead's *Additional Information* section.

Processing .csv Files to Edit Leads
"""""""""""""""""""""""""""""""""""

Another way to edit Leads details, that is especially useful for bulk changes or in case of integration with
third-party applications is over .csv export and import. To do so, you need to

- Export .csv file with the Leads grid:

  In order to export the .csv file, go to *Sales --> Leads* and click **Export** button. "Export started..." message
  will appear at the top of the screen.

  As soon as the export has finished it will change to: *"Export performed successfully, [number] downloads exported.
  Download result file*".

  Click the *"Download result file*" at the end of the message and download will be performed subject to your browser
  settings.

- Edit the file

- `Import </user_guide/sales_process_workflow.rst#import-leads>`_ the edited file.


Actions with Leads
------------------

Of course, we will need the Leads for the further work with Opportunities and Sales Processes described below. However,
even at this stage they can come handy when performing different activities.
So, version 4.1 supports *Send Email* action. Click |BSendEm| button in the top right corner of the Lead's page and
E-mail template already filled with the Lead's details will appear. You only need to fill the Subject and Body and
click *Send*

.. hint:: Oro Platform provides tool for creation of other Actions using Leads that may be developed in the course of
          customization subject to your business needs.


II. Populate the System with Opportunities
-------------------------------------------

The straightforward way to populate the System with Opportunities is from the *System --> Opportunities* page:

1. Go to the dedicated *Sales --> Opportunities* page

2. Create or Import Opportunities

3. Edit created Opportunities, if necessary


1. Go to the Dedicated *Sales --> Opportunities* section
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. hint:: If you cannot see the section, there may be still no B2B Channels with Opportunities Entity assigned to them
          in the System. `View the Channels list </user_guide/channel_guide.rst#further-actions>`_ to check it.
          `Fill the System with Channels </user_guide/sales_process_workflow.rst#fill-the-system-with-b2b-channels>`_ ,
          if necessary

If the problem persists, you may not have User-rights to View\Edit the functionality. Please address you system
administrator.

*Sales\Opportunities* page will appear. From here you can Create of Import Opportunities.

2a. Create Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^
Click |BCrO| button to manually input the Opportunity's details.
The form specified for the Opportunities will appear.

.. note:: You can also make an Opportunity from the *System -->Sales Processes* Page, as described page as described
          `in the Sales Processes </user_guide/sales_process_workflow.rst#start-a-sales-process-from-opportunity>`_

The form contains mandatory system fields, optional system fields and custom fields (if any).

Mandatory System Fields for Opportunities
"""""""""""""""""""""""""""""""""""""""""

Regardless the Opportunity entity settings, the following fields are mandatory and **must** be defined.

|OppCrMF|

Detailed description of each field is provided below:


.. list-table:: **Mandatory Opportunity Fields**
   :widths: 10 30
   :header-rows: 1

   * - Field
     - Description

   * - **Owner***
     - This field limits the list of Users authorized to manage the Opportunity created. Once a User is chosen only
       this User and Users whose predefined Role provides for management of Opportunities that belong to this User
       e.g. a head of the User's Business Units, System administrator) can do so. Please see Roles Administrator Guide
       for more details if required.

       By default, the User creating the Opportunity is chosen.

            To clear the field click |BCrLOwnerClear| button.

            Click |Bdropdown| button to choose one of available Users from the list.

            Click |BGotoPage| button to choose from the *Select Owner* page.

   * - **Opportunity Name***
     - This is the name that will be used to save and display the Opportunity in the System.

       It is recommended to define a meaningful name.

   * - **B2B Customer***
     - The field binds the Opportunity created to a specific Customer in the System. Customer entity contains all the
       details
       of one customer available in the System (e.g. shipping and banking details, data on opportunities and purchases
       from all Channels, etc.).

       Field that was optional for Leads, is mandatory for Opportunities. This is related to higher business importance
       of Opportunities. While almost any potentially useful acquaintance may be deemed as a Lead, Opportunities shall
       have high probability of turning into real sales activities, and thus it is important to keep track of the
       related customers information.


- Click |Bdropdown| button to choose one of available Customers from the list.

- Click |BGotoPage| button to choose from the *Select B2B Customer* page.

- Click |Bplus| button to create a Customer in the System.

- To clear the field click |BCrLOwnerClear| button.

Optional System Fields for Opportunities
""""""""""""""""""""""""""""""""""""""""

Optional System Fields may be left empty. They are added based on Oro's experience as the fields that you may find
handy and convenient to use.
Many of optional system fields are free text fields with transparent names, e.g.*Custom Need*, *Proposed Solution*, etc.

If a field refers to a number (e.g. *Probability (%)*, *Budget Amount ($)*, *Close Revenue ($)*) an integer value shall
be filled (if any).

Optional system field *Close Reason* is a drop-down that contains adjustable predefined list of possible Opportunity
closure reasons, i.e. Cancelled, Outsold and Won.

Optional system fields *Potential Customer* is a *Contact* bound to an Opportunity.
*Potential Customer* entity represents one contact person and helps keeping all the contact details and process them
for further usage (mailings, notification delivery, feedback requests etc.)

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

2b. Import Opportunities
^^^^^^^^^^^^^^^^^^^^^^^^

Opportunities import is very similar to the Leads import </user_guide/sales_process_workflow.rst#import-leads>`.
You do the same actions from the *Sales --> Opportunities* page.

.. caution:: `Mandatory fields </user_guide/sales_process_workflow.rst#mandatory-system-fields-for-opportunities>`_
             **must** be specified

3. Edit Opportunities
^^^^^^^^^^^^^^^^^^^^^

There are several ways to edit the Leads that are already present in the system, i.e. editing leads details from the
WEB and processing .csv files.

Edit Opportunities from the Web
"""""""""""""""""""""""""""""""
For individual changes, the most convenient way is *to go the Opportunity's page and edit its details*

.. hint:: You can use *Filters* functionality to simplify the search for the necessary Opportunity. The *Filters* are
          rather see-through and easy to use, but if you feel a lack of assistance, please refer to the Filters
          Guide (TBD).

Once you have found the target Opportunity, click on any column thereof.

The Opportunity's page will emerge. As Opportunity makes a significant components of the Sales Process workflow, you
cannot delete an Opportunity.

- Click |BEdit| button to edit the Opportunity details.

*Create* form with previously defined values will appear.

- Re-define the values you need to change.
  This is similar to `creation of an Opportunity </user_guide/sales_process_workflow.rst#create-opportunities>`_

Once you have done all the necessary changes, click |Bsc| button and you will get back to the Opportunity's page.
The Opportunity's details will be updated.

.. hint:: To simplify your work with the Opportunities, there are Add Attachment and Add Note actions.
           Click corresponding button in the top right corner of the Opportunity's page and choose a file to add
           or enter the text that will appear in the Lead's *Additional Information* section.


Processing .csv Files to Edit Opportunities
"""""""""""""""""""""""""""""""""""""""""""

Another way to edit Opportunity details, that is especially useful for bulk changes or in case of integration with
third-party applications is over .csv export and import.
It is similar to `editing Leads </user_guide/sales_process_workflow.rst#processing-.csv-files-to-edit-opportunities>`_.
You do the same actions from the *Sales --> Opportunities* page.

Some Actions with Opportunities
--------------------------------

Of course, we will need the Opportunities as an integral and vital component of the Sales Process work-flow described
below. However, you can also perform additional actions with them.

So, version 4.1 supports *Send Email* action. Click |BSendEm| button in the top right corner of the Opportunity's
page and E-mail template already filled with the Opportunity's details will appear. You only need to fill the Subject
and Body and click *Send*.

.. hint:: Oro Platform provides tool for creation of other Actions using Opportunities that may be developed in the
          course of customization subject to your business needs.

.. _user-guide-data-management-basics:

Data Management Basics
======================

With OroCRM, you can record, store, process and analyze various customer-related information. This information may cover 
different areas including personal and contact details, records of the customer activity, possible sales and 
arrangements, and many others. This can be any type of information necessary to monitor, manage and understand specific 
customer-related activities. 

In this article we will overview the ways data is represented and managed in OroCRM. For 
each point that requires further explanation, you will find links to related documentation. 


How the data is organized
-------------------------

The customer relationship management process requires us to collect and process huge amount of information, and OroCRM 
is sharpened to do it in the most efficient and convenient way.

Technically, a collection of information of a similar nature is represented in OroCRM with an **Entity**. Each instance 
of this collection is called a **Record**. Details of each record are its **Properties**.

For example, information about customers of a Web-store is collected as properties of the records of the Web Customer 
entity. This means, that one of the OroCRM entities is “Web Customer” and the system knows that records of this 
entity can have a number of properties, such as the first name, last name, email, phone number, id of the shipping 
address, id of the cart and ids of the orders. Moreover, the system is aware that some of this properties must be 
defined and some are optional. When a new Web customer is added to the system – its record is created and values of 
the properties are save for it. If something has changed (e.g. the phone number), the properties are updated. 

New records can be created and the existing one can be updated both manually and automatically (as a result of 
integration with third-party systems). 
With OroCRM's comprehensive :ref:`access settings <user-guide-user-management-permissions>` you can define what users 
will be able to view, update, delete, and create records of specific entities.

As soon as the property has been updated, all the system users who are allowed to 
see the property, will see its new updated state. This ensures that all the stakeholders can obtain actual and 
up-to-date information at any moment. 


How the Entities Can Be Related
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Some pieces of information are complex enough to have their own entity. For example, for each cart in a Web store, we 
need to know its unique id (number), how many items are in the cart, what their total value is, whether a purchase has 
been made. Therefore, we have an entity “Cart”, records of which have all these properties: number of items, total 
value, status. 

One customer may have several carts. For OroCRM this means that Web Customer records are related to Carts 
records as one to many. To show this, we assign one of the Web Customer properties as a “relation” to carts. This 
field will save identificators of the customer’s carts (such identificator is a field of the cart). By the 
identificator the system can find the cart and bind its properties to the customer. 

Moreover, each cart may have several 
items in it. This means that each Cart record is related to its Item records as one to many. 

*User-wise, this means that you can get easily see the full picture and drill-down into details as much as required for 
any specific task, as well as update the process the provided data.*  

See All the Records of a Kind on Grids
--------------------------------------

Grid is an aggregated view of all the records of the same entity. Each row of the grid is one records, and each column 
is one of the grid properties. 

For example, you can open a grid of all the Contacts. (The Contact records represent actual people you are dealing with 
and their properties are personal information, details of their position in the customer-company, contact details, etc.
The contacts may be related to a customer, an opportunity, or any other record in the system, if reasonable.)

So, we have opened the *"All Contacts"* grid. 

.. image:: ./img/data_management/grid/grid_01.png

We immediately see some major details of our contacts, such as their first and last names, email, phone number, etc.

You can adjust and save grid views, updated and delete grid records, get to the Edit and View pages of any grid record, 
and even export all the data in the grid as a .csv file.

The grid details are described in the :ref:`Grids <user-guide-ui-components-grids>` guide.

View Details of a Specific Record
---------------------------------

To see more details of a specific record, and to work directly with the record (create a task related to a customer, 
appoint a calendar event for a user, turn a cart into an order, share a contact and so on), you need to get to its 
View page.

For example, we have opened the View page of one of our Contacts.

.. image:: ./img/data_management/view/view_01.png

On the View page you can see all the details of the record and location of the address on the map. You can 
click the phone number link to call it via Hangouts or log a call, start writing an email with a click on the address, 
initiate Skype session directly from the View page. If there is a related entity, its identifier will be a link to the 
View page of this entity

Action buttons at the top of each View page reflect the actions that you can do with the record. 

The View Page details are described in the :ref:`View Pages <user-guide-ui-components-view-pages>` guide.

Create New Records and Edit the Existing
----------------------------------------

To change details of and existing record or create a new record, you need to (re)define the record properties on its 
Create/Edit form.

The Create/Edit form details are described in the :ref:`Create/Edit Forms `<user-guide-ui-components-create-pages>` 
guide.

Tag the Records
---------------

In order to give the system users additional information about the record, to systematize the records and mark them for 
future usage (e.g. to select them for reports or create segments), you can tag them with existing or new tags. For 
example, if you tag a customer as "VIP", this will let the other system users know about the customer's importance, you 
can adjust report to show only the data for your VIPs, and make targeted mailings to them. Moreover, you can find a 
record by its tag with the :ref:`search <user-guide-getting-started-search>` functionality.
More information about tags is available in the :ref:`Tags <user-guide-ui-components-view-pages>` guide.
 

Define the Process Within Which Record Details Can Be Changed And Follow It
---------------------------------------------------------------------------

In the process of the work with the customers is ongoing: carts turn into orders, 
what seemed to be a potential opportunity appears not to be worth effort or tuns into a successful deal, and so on. 
These and other processes are reflected in OroCRM with a change of record properties and sometimes creation of new 
relations. (For example - a new lead appeared, and then it turned successful and was bound to some contact, some 
opportunity and some customer).

In many cases success of the business depends a lot on the unity of the procedures followed all through the company.
For example, most companies won't allow their employees to close a cart without contacting the potential customer but
no one wants to annoy the customers with duplicating calls. Customer complaints have to be researched and reacted to.
Potential big contract requires some negotiations and only after that can turn into a successful deal or a lost chance.

In order to regulate this, workflows can be created in OroCRM. Workflow defines what transitions (changes of 
properties) are available to the system users at each step.

You can find more details about workflows in the :ref:`Workflows <user-guide-workflow-management-basics>` guide.

Log Actions in the System
-------------------------

Whether a workflow has been defined for entity records, or users can process it in any order, it is important to know 
what actions have been performed with a record and by whom. Who has turned this cart into an order? Who has closed 
an opportunity? Who has deleted a customer? Who has changed contact details? In order to know the answers, you 
can use OroCRM's data audit functionality - with it you will see what actions have been performed in the system, when 
and by whom.

Detailed description of the functionality is available in the :ref:`Data Audit <user-guide-data-audit>` guide.

Integrate with Third-Party Systems
----------------------------------

OroCRM can be integrated with third-party systems, as a result of integration new records can be uploaded to OroCRM and 
passed to the integrate system from OroCRM.
For example, ldap integration enables loading user records, integration with Magento loads customer records from 
a Magento store to OroCRM and integration with MailChimp will load OroCRM contact details to MailChimp and get results 
of an email campaign back to OroCRM.

Integrations are create by the system administrator. The list of integrations available by default is available in the 
:ref:`Integrations Overview <user-guide-integrations>`.

Import and Export Data
----------------------

Another way to add records to OroCRM is to export it from a .csv file - these can be customer details, information about
your leads and opportunities, contact informations, and other. 

You can also export data from OroCRM into a .csv file. You can export all the records of one entity, as well as all the 
records available on a specific grid. 

Step-by-step instructions for the import and export actions are provided in the 
:ref:`Import and Export Functionality <user-guide-export-import>` guide.


Conclusion
----------

This way, changes of properties for records in OroCRM reflect the processes in customer relationships. Users can add new 
records to OroCRM one by one, from .csv files or with integrations. The way in which the records can be processed can be 
limited with the record types (entities) and workflows, and all the changes can be tracked with the data audit tools.
Details of the record can be easily viewed and updated in OroCRM and as soon as there has been a change, other users 
will see the updated information. Details of the records can be used and analyze by all the relevant stakeholders of 
customer relationships process to make their work more efficient and benefit the company, as described in the 
:ref:`OroCRM Users and Their Benefits <oro-benefits>` guide.
    
Related Documents
----------------- 
  
* :doc:`/user_guide/data_management_grids`  
* :doc:`/user_guide/data_management_view`
* :doc:`/user_guide/data_management_form`
* :doc:`/user_guide/data_management_tags`
* :doc:`/user_guide/data_management_workflows`
* :doc:`/user_guide/data_management_data_audit`
* :doc:`/user_guide/data_management_import_export`
* :doc:`/user_guide/data_management_access_permissions_basic`
 
.. toctree::
    :hidden:

    data_management_grids
    data_management_view
    data_management_form
    data_management_tags
    data_management_workflows
    data_management_data_audit
    data_management_import_export
    data_management_access_permissions_basic

 
.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle
   
.. |IcSettings| image:: ./img/buttons/IcSettings.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle
   
.. |IcBulk| image:: ./img/buttons/IcBulk.png
   :align: middle
   
.. |ScrollPage| image:: ./img/buttons/scroll_page.png
   :align: middle
   
.. |BRefresh| image:: ./img/buttons/BRefresh.png
   :align: middle
   
.. |BReset| image:: ./img/buttons/BReset.png
   :align: middle
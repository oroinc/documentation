.. adjust for OroCommerce

.. _user-guide-data-management-basics:

Information Management
======================

With OroCRM and OroCommerce, you can record, store, process, and analyze various commerce, sales, and marketing data and activities.

.. _user-guide-data-management-basics-entities:

.. contents:: :local:
   :depth: 1

How Data Is Organized
---------------------

Oro applications are designed to collect and process huge amounts of information in the most efficient and convenient way possible.

The system organizes information into Entities (the definition of complex data types), Records (data items of the particular type), and Properties (data fields and attributes). An **Entity** is a definition of a collection of similar information. Each instance of this collection is called a **Record**. Details of each record are its **Properties**.

So, information about the customer users on a website is organized into a set of properties (e.g. First Name, Last Name, etc.). The set of properties with their service details, like data type, storage type, label in the UI, and visibility settings, are defined in the Customer entity.

When a new customer is added to the system, their record is created and values of the properties are saved in the database. If the information has changed (e.g., the phone number), the value in the database is updated.

New records can be created and the existing record can be updated both manually and automatically (as a result of integration with third-party systems).

With the access settings you can define who is able to view, update, delete, and create records of specific entities.

Understand Relationships between Entities
-----------------------------------------

Some pieces of information are complex enough to have their own entity. For example, for each shopping list in the OroCommerce storefront, OroCommerce stores a unique ID (number), details of the items that are in the cart, their total value, and any additional information provided by the buyer.

Therefore, there is a ShoppingList entity that defines the data structure of the shopping list records that store all the necessary shopping list information.

One customer user may have several shopping lists. In OroCommerce, this means that many different shopping list records may be related to a single customer user record.

To link these records, the shopping list entity uses dedicated customerUser parameter of a system relation type to store the identifier of the customerUser who is the owner of the shopping list. Using this identifier, the system can find the customer user and its properties become available through the associated shopping list.

Manage Records' List
--------------------

The summary of all the records whose data structure is governed by the same entity are displayed in a similar way. There is an aggregated view titled All <items>, where each row contains one record, and each column contains one of the properties' values.

For example, you can open a grid of all the Contacts. (The Contact records represent actual people you are dealing with and contains properties such as personal information, details of their position in the customer-company, contact details, etc. The contacts may be related to a customer, an opportunity, or any other record in the system, if applicable.)

So, we have opened the **All Contacts** grid.

.. image:: /user_guide/img/getting_started/data_management/grid/grid_01.png

We immediately see some major details of our contacts, such as their first and last names, email, phone number, etc.

You can adjust and save grid views, updated and delete grid records, get to the Edit and View pages of any grid record,
and even export all the data in the grid as a .csv file.

The grid details are described in the :ref:`Grids <doc-grids>` guide.

View Details of a Specific Record
---------------------------------

To see more details of a specific record, and to work directly with the record (create a task related to a customer, appoint a calendar event for a user, turn a shopping list into an order, share a contact and so on), you need to get to its
details page by clicking on the record's line.

For example, let's take a look at the details of one of the Contacts.

.. image:: /user_guide/img/getting_started/data_management/view/view_01.png

You can see all the details of a record, and the address locations on the map. You can click the phone number link to call it via Hangouts or log a call, start writing an email by clicking on its address, or initiate a Skype session. For any related record of a different type, there is a link that leads to that linked record details.

Action buttons at the top of the page reflect the actions that you can do with the record.

See more information in the :ref:`Record Details View <user-guide-ui-components-view-pages>` guide.

Create New Records and Edit Existing Records
--------------------------------------------

To change the details of an existing record or to create a new record, you need to (re)define the values of the record properties.

Creating and edit the record details is described in the :ref:`Create a New Record and Edit the Record Details <user-guide-ui-components-create-pages>`
guide.

Tag the Records
---------------

In order to give system users additional label-like information about a record, as well as to systematize records and mark them for
future usage (e.g., to select them for reports or create segments), you can assign them existing or new tags. For example, if you tag a customer as *VIP* this helps other system users know about the customer's importance. You can then adjust the report to show only data for your VIPs and make targeted mailings to them. Moreover, you can find a record by its tag with the :ref:`search <user-guide-getting-started-search>` functionality.

Use Workflows to Define Processes
---------------------------------

The process of working with customers is ongoing: shopping lists turn into orders, potential opportunities either fizzle or
turn into successful deals, and so on. OroCRM and OroCommerce reflects these and other processes by changing record properties and
sometimes creating new relationships. For example, when a new lead appears and then turns successful, it gets bound to the
contact, opportunity, and customer that matches the lead details.

In many cases, the success of a business depends on the unity of its procedures and how thoroughly employees in different departments and teams follow
these procedures. Potentially big contracts require specific negotiations before they turn into a successful deal, and multiple parties may be involved in the negotiation and should be informed about every development, and some actions may be triggered by the change in the conditions of the future agreement.

In Oro applications, to handle these complex procedures you can use workflows. Workflow defines what transitions (changes of properties) are available to the system users at each stage.

You can find more details about workflows in the :ref:`Workflows <doc--workflows>` guide.

Integrate with Third-Party Systems
----------------------------------

OroCRM and OroCommerce can easily integrate with third-party systems, letting users transfer the data into another application, and vice versa. For example, the users can upload OroCRM data into a third-party program, edit it, then transfer that data back into OroCRM. Likewise, data can also be transferred into OroCRM from another application, processed, then transferred back.

For example, integrating with ldap lets you load user records to OroCRM, integrating with Magento lets you load customer records from a Magento store into OroCRM, and integrating with MailChimp lets you load OroCRM contact details into MailChimp, as well as get the results of an email campaign within OroCRM.

Integrations are created by the system administrator. A list of integrations available by default is available in the :ref:`Integrations Overview <user-guide-integrations>`.

Import and Export Data
----------------------

Another way to add records to Oro application is to export it from a .csv file. These can consist of customer details, contact information, and other data.

You can also export data into a .csv file. You can export all the records of one entity, as well as all the records available on a specific (potentially filtered) summary view.

Step-by-step instructions for the import and export actions are provided in the :ref:`Import and Export Functionality <user-guide-export-import>` guide.

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1
   :hidden:

   records_grids
   data_management_view
   data_management_form
   data_management_tags

* :ref:`Workflow Management <doc--workflows>`
   




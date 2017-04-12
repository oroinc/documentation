.. _admin-capabilities:

Capabilities List
=================

The capabilities are an important part of the system's access and permission settings, as described in the 
:ref:`Access and Permissions Basics guide <user-guide-user-management-permissions>`. 

Users have access to different functionalities depending on which capabilities they have been assigned. For example, you 
can limit a user's ability to assign tags, share grids, or create new users.

 
This guide describes, in alphabetical order, the set of capabilities that can be included into a user role and their related 
functionalities, and provides examples of several default capability settings for some common roles.



.. _admin-capabilities-acc:

Abandoned Cart Campaign Manipulations
-------------------------------------

If enabled, the user can use the **Abandoned Cart Campaign** functionality. This will allow 
a user to generate automatic emails to customers in a Magento store. For instance, users can send messages to customers 
who have not completed their purchase in order to convince them to complete the checkout and place an order. You can 
find more details about this functionality in the :ref:`Magento Abandoned Cart Campaigns guide <user-guide-acc>`.

This functionality is useful for marketing representatives and any other employees who are working with email campaigns 
directed at customers of Magento-based store.

.. important::

    To use this functionality, you also need to :ref:`set up the Abandoned Cart extension <user-guide-acc>`.

    
.. _admin-capabilities-data-audit:    
    
Data Audit
----------

The user can see the full history of changes made to any record of an auditable entity (see step 6 of the )
:ref:`Create an Entity <doc-entity-actions-create>` instruction), as well as an out-of-the-box report of all such 
actions. 

The report is available from the "*System*" menu and described in more details in the 
:ref:`Data Audit <user-guide-data-audit>` guide.

The link to a specific record's history of changes is available in the top right corner of the record’s
:ref:`view page <user-guide-ui-components-view-pages>`.

|

.. image:: ../../user_guide/img/data_management/view/view_history.png

|

This Data Audit is usually used by system administrators, but may also be used by managers in order to see how details 
of different records were changed, as well as by whom.


.. _admin-capabilities-dotmailer-stats:    

dotmailer Statistic
-------------------

This capability is meaningful if the system has been integrated with dotmailer.

Such integration lets users utilize dotmailer as an email campaign engine, as described in the guide on
:ref:`Integration with dotmailer <user-guide-dm-integration>`. In short, the user can synchronize lists of contacts in
OroCRM and dotmailer, and use them to create email campaigns in dotmailer and import them to OroCRM.

The user will be able to see the dotmailer campaign 
statistics to analyze the efficiency of the campaign. 

These statistics are usually used by marketing managers and representatives responsible for email campaigns.

.. _admin-capabilities-export-entities:    

Export Entities
---------------

The user can export an entity's records into a .CSV file, as 
described in the :ref:`Import and Export Data <user-guide-export>` guide. 

The :guilabel:`Export` button will appear in the top right corner of the page.

|

.. image:: ../img/roles/export.png 

|

Export is a general productivity tool that is usually enabled for most users.


.. _admin-capabilities-general_import:  

General Import/Action Operations
--------------------------------

This capability enables common operations for import and export, such as the ability to load the error log. It is 
recommended that you enable this capability if either *"Export Entities"* or *"Import Entities"* are also 
enabled. 


.. _admin-capabilities-import-entities:    

Import Entities
---------------

The user can import records from a .CSV file to OroCRM, as described 
in the :ref:`Import and Export Data <user-guide-import>` guide. The :guilabel:`Import` button will 
appear in the top right corner of the page.

|

.. image:: ../img/roles/import.png 

|

This is necessary for users who need to import large sets of data into the system. For example, these may include sales 
representatives or employees responsible for lead development.

.. _admin-capabilities-jobs:  

Jobs Management
---------------

Users can see jobs that have been started in the system, as well as view their 
current status and their performance log from the **Job Queue** and **Sheduled tasks** pages. Links to these pages are 
available in the **System** menu.

The **Job Queue** and **Sheduled tasks** pages are usually used by system administrators.



.. _admin-capabilities-mailchimp:  

MailChimp Manipulations
-----------------------

This capability is only meaningful if the system has been integrated with MailChimp. 

Such integration lets users utilize MailChimp as an email campaign engine, as described in the guide on
:ref:`Integration with MailChimp <user-guide-mc-integration>`. This lets users synchronize lists of contacts in OroCRM 
and MailChimp, use them to create email campaigns in MailChimp, import them to OroCRM, and use the MailChimp campaign 
statistics to analyze the efficiency of the campaign.

All of these operations will only be available within OroCRM if the capability has been enabled.

The ability to integrate with MailChimp will especially be useful for marketing associates and other managers 
responsible for email campaigns.


.. _admin-capabilities-config-entities:  

Manage Configurable Entities
----------------------------

Many entities in OroCRM can be configured from the interface, as described in the
:ref:`Entities <doc-entities>` guide. The user can change the attachments settings, 
define whether the entity should be displayed on a grid and/or a record view page, whether it will be 
exported to a .csv file, and define other settings. For some of them, it is also possible to add new fields, as 
described in the :ref:`Entity Fields  <doc-entity-fields>` guide. 

These actions are only available if the **Manage Configurable Entities** capability is enabled.

They are usually performed by the system administrators.


.. _admin-capabilities-org-calendar-events: 

Manage Organization Calendar Events
-----------------------------------

If this capability has been set to *"System,"* users can create, edit, and delete events in organization-wide calendars, 
which are described in more detail in thee :ref:`corresponding section <user-guide-calendars-system>` of the 
**Calendars Overview** guide.

Organization calendar events are usually managed by organization-level managers and HRs.

.. hint::

     Even if this capability is disabled, users can still view organization-wide calendars, add 
     them to their own calendar views, and copy related events to their own calendars.


.. _admin-capabilities-sys-calendar-events: 

Manage System Calendar Events
-----------------------------

Users can create, edit, and delete events in system-wide calendars, which 
are described in more detail in the :ref:`Calendars Overview <user-guide-calendars>` guide.

System calendar events are usually managed by the company managers and HRs.

.. hint::

     Even if this capability is disabled, users can still view organization-wide calendars, add them to their 
     own calendar views, and copy related events to their own calendars.


.. _admin-capabilities-sys-calendars: 

Manage System Calendars
-----------------------


Users can :ref:`create <user-guide-calendars-system>` and :ref:`manage <user-guide-calendars-manage>` system-wide calendars.

System-wide calendars are usually created and managed by system administrators and top managers.


.. _admin-capabilities-passwords:
 
Manage Users' Passwords
-----------------------

The user can change the passwords of other users. Usually, this is only done
by system administrators when :ref:`creating or editing a user record <user-management-users>`. 

.. hint::

    This capability does not influence a user's ability to edit their own password from the **My User** page (see step 5 of the :ref:`Edit Your Profile <doc-my-user-actions-edit>` action description.


.. _admin-capabilities-merge:

Merge Entities
--------------


Users can :ref:`merge <doc-grids-actions-records-merge>`
several records of the same entity.

By default, it is recommended to enable this capability. It is usually used by sales representatives.


.. _admin-capabilities-outlook:

Outlook Integration
-------------------

This capability is meaningful for Enterprise users only. If it is enabled, users can 
 download the latest version of the OroCRM add-in for Outlook (see the **MS Outlook Add-In** field description of the :ref:`General <doc-my-user-view-page-general>` section of the **My User** page.

If :ref:`OroCRM is synchronized with Outlook <user-guide-synch-outlook>`, you can use the add-in to synchronize 
contacts, tasks, and calendar events between OroCRM and your Outlook account. You can also associate emails to accounts, 
contacts, opportunities, and cases, as well as create leads, opportunities, and cases in OroCRM that are based on emails 
from the Outlook sidebar.

This is a general capability that can improve the user experience for all Enterprise users who are using both OroCRM and 
Outlook. 


|

.. image:: ../../user_guide/img/intro/user_outlook.png

|


.. _admin-capabilities-address-dic:

Read Address Dictionaries
-------------------------

A user can access countries, regions, and address types via the API.
It must be enabled in order to support Lead creation via Outlook. This capability should be activated for
system administrators or integrators who are authorized to access OroCRM via the API.


.. _admin-capabilities-search:

Search
------

A user can use the :ref:`search <user-guide-getting-started-search>` 
functionality to quickly find specific records.

This is a general capability that can improve the overall experience of all users.

The setting does not influence the user's ability to :ref:`search by tag <user-guide-getting-started-search-tag>`.


.. _admin-capabilities-campaign-emails:

Send Campaign Emails
--------------------

With OroCRM's :ref:`email campaigns <user-guide-email-campaigns>`, a user can send personalized template-based emails 
to multiple users. This capability does not affect the user's ability to define and edit the campaign settings and create 
templates, but this capability must be enabled in order for a user to launch a campaign (i.e., start
:ref:`sending emails <user-guide-email-campaigns-send>` specified by the campaign.

Those usually authorized to send email campaigns include marketing associates and other employees who engage in direct 
communications with potential customers, existing clients, other system users, etc.

|

.. image:: ../img/roles/email_campaign.png

|


.. _admin-capabilities-share-grid:

Share Grid View
---------------

A user can :ref:`share the grid views <doc-grids-actions-grid-views-share>`
that they have configured.

This is particularly useful for team-leads and heads of departments who want to modify and share grids with their 
subordinates.

|

.. image:: ../img/roles/grid_share.png

|

 
.. _admin-capabilities-system-info:

System Information
------------------

A user can view the system information page. This page contains the list of 
Oro packages and third-party packages that are installed, and is usually only used by system administrators and 
integrators.

.. _admin-capabilities-system-config:

System Configuration
--------------------

A user can access the system configuration page (in the main menu, navigate to **System>Configuration**) to localize the system, change the display and tracking settings, and otherwise change the system configuration.


.. _admin-capabilities-tags:

Tag Assign/Unassign
-------------------

A user can  assign/unassign :ref:`tags <user-guide-tags>` which are 
non-hierarchical keywords or phrases assigned to records. They provide additional information about records and
are visible to all the system users. 

Tags can be successfully utilized by all users.


.. _admin-capabilities-tags-all:

Unassign All Tags From Entities
-------------------------------

This capability is only meaningful if **Tag assign/unassign** is enabled.

If both **Tag assign/unassign** and **Unassign All Tags From Entities** capabilities are enabled, 
users can unassign not only the tags that they have added, but any tags other users have also added to records.

This way, you can restrict users from deleting tags made by other users. This is usually available to 
team leads, department heads, and managers.

.. _admin-capabilities-unshare-grid:

Unshare Grid View
-----------------

Users can unshare grids previously 
:ref:`shared <admin-capabilities-share-grid>` by themselves. This is usually available to all users who work 
with grids.


.. _admin-capabilities-view-sql:

View SQL Query of a Report/Segment
----------------------------------

Users  see the SQL request that is sent to the system for a report/segment.

Usually, this is only granted to system administrators so they can check if a report has been developed correctly.  
The **Show SQL Query** link will appear below the report.

|

.. image:: ../img/roles/sql_show.png

|


This setting will only work if it has been enabled within **System Configuration>Display Settings> 
Report settings**. 

|

.. image:: ../img/roles/sql_setting.png

|


.. _admin-capabilities-workflow:

Workflow Manipulations
----------------------

Users can manage the records,  that are associated with 
:ref:`workflows <user-guide-workflow-management-basics>`. Otherwise, users may be able to see and edit records, but will 
not be able to change the status of the records within the workflow.

This capability must be disabled if you want to restrict users from changing the status of records.


Default Configurations Table
----------------------------

In this table, you will find several default configurations that have been created for different user roles. By default, 
system administrators have access to all capabilities, while other roles are limited by their functions, as shown below.

.. csv-table::
  :header: "", "Admin", "Marketing Representative", "Sales Manager", "Sales Representative"
  :widths: 35, 10, 10, 10, 10

  "**Capability**","\+","\-","\+","\-"
  "**Abandoned Cart Campaign manipulations**","\+","\-","\+","\-"
  "**Data audit**","\+","\-","\+","\-"
  "**dotmailer Statistic**","\+","\-","\+","\-"
  "**Export entities**","\+","\+","\+","\-"
  "**General import/action operations**","\+","\-","\+","\-"
  "**Import entities**","\+","\+", "\+","\-"
  "**Jobs management**","\+","\-","\-","\-"
  "**MailChimp manipulations**","\+","\-","\+","\-"
  "**Manage configurable entities**","\+","\-","\+","\-"
  "**Manage organization calendar events**","\+","\-", "\+","\-"
  "**Manage system calendar events**","\+","\-","\+","\-"
  "**Manage system calendars**","\+","\-","\+","\-"
  "**Manage users' passwords**","\+","\-","\+","\-"
  "**Merge entities**","\+","\-","\+","\-"
  "**Outlook integration**","\+","\+","\+","\+"
  "**Read address dictionaries**","\+","\-","\+","\+"
  "**Search**","\+","\+","\+","\-"
  "**Send campaign emails**","\+","\-","\+","\-"
  "**Share grid view**","\+","\-","\+","\-"
  "**System Information**","\+","\-","\-","\-"
  "**System configuration**","\+","\-","\-","\-"
  "**Tag assign/unassign**","\+","\-","\+","\-"
  "**Unassign all tags from entities**","\+","\-","\+","\-"
  "**Unshare grid view**","\+","\-","\+","\-"
  "**View SQL query of a report/segment**","\+", "\-","\-","\-"
  "**Workflow manipulations**","\+","\+","\+","\+"
.. _user-guide-data-management-basics-entities:
.. _user-guide-data-management-basics:

.. adjust for OroCommerce

Information Management
======================

With Oro applications, you can record, store, process, and analyze various commerce, sales, and marketing data and activities. The way that data is represented in your application may depend on its configuration, but much of it is stored, created and processed similarly. Your principal records are located in the main menu and are aggregated under topic-based sections (e.g. Marketing > Promotions > Coupons). 

To find and view records and data in your application, you can either use the main menu, or :ref:`search <user-guide-getting-started-search>`, :ref:`dashboard <user-guide-dashboards>` and :ref:`sidebar widgets <user-guide-navigation-sidebar-panel>`, as described in detail in the :ref:`Navigation and Search <user-guide-getting-started>` topic.

The process of creating new records in Oro applications follows the same pattern, although the structure of the information you are required to provide when creating a new record depends on its type (i.e. :ref:`entity <admin-guide-entity-interface>`). To illustrate this pattern of creating new records, have a look at the description of :ref:`creating a new account <user-guide-accounts-create>`, or :ref:`a task <doc-activities-tasks-actions-add-detailed>`. 

You can edit, delete most of the records, and you can also perform a number of type-specific actions to selected records either from their pages, or from the pages with the list of all records (displayed in tables). The example of type-specific actions would be the ability to convert a lead to an opportunity from the lead page, or the ability to add an address on the page of a contact.

On the :ref:`page of all records (table views) <doc-grids>`, additional actions are usually available as buttons on the top right (also record-specific) or under the ellipsis, or more actions, menu located at the end of the row of each specific record, as illustrated in the of :ref:`Importing/Exporting Bulk Items <user-guide-export-import>` topic. Within the page of all records, you can usually |IcFilter| :ref:`filter <doc-grids-actions-filters>` and |IcDelete| :ref:`mass delete <doc-grids-actions-records-delete-multiple>` items in the table, |IcSettings| :ref:`manage table columns <doc-grids-actions-change-table>`, |IcPencil| :ref:`edit items inline <doc-grids-actions-records-edit-inline>`, or :ref:`tag <admin-guide-tag-management>` them, so look out for the corresponding icons on the interface. You can find more information on how to work with table views in the :ref:`Record Tables <doc-grids>` topic.

Exchange and transfer of data into the Oro application from various third-party applications (and vice versa) is usually achieved either with the help of :ref:`import/export <user-guide-export-import>` or :ref:`integrations <user-guide-integrations>`. As an illustration, you can have a look at how :ref:`import works for leads <user-guide-system-channel-entities-leads>`, and how an :ref:`integration <user-guide-dotmailer-overview>` between Oro application and dotmailer is configured. 

Actions and transitions available for your records in the application are defined by the workflows. Workflows enable you to handle complex procedures that can be configured specifically for your business needs. You can learn more about the configuration of workflows in the dedicated :ref:`Workflow Management <doc--system--workflow-management>` topic.

**Related Topics**

* :ref:`Manage Records <doc-grids-records>`
* :ref:`Work with Record Tables <doc-grids>`
* :ref:`Manage Workflows <doc--system--workflow-management>`
* :ref:`Work with Tags <admin-guide-tag-management>`



.. include:: /img/buttons/include_images.rst
   :start-after: begin
 
  
.. toctree::
   :hidden:
   :maxdepth: 1
   
   manage_records
   







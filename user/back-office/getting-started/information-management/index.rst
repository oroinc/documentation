.. _user-guide-data-management-basics-entities:
.. _user-guide-data-management-basics:

.. adjust for OroCommerce

Information Management
======================

With Oro applications, you can record, store, process, and analyze various commerce, sales, and marketing data and activities. How data is represented in your application may depend on its configuration, but much of it is stored, created, and processed similarly. Your principal records are in the main menu and aggregated under topic-based sections (e.g., Marketing > Promotions > Coupons).

To find and view records and data in your application, you can either use the main menu, or :ref:`search <user-guide-getting-started-search>`, :ref:`dashboard <user-guide-dashboards>` and :ref:`sidebar widgets <user-guide-navigation-sidebar-panel>`.

Creating new records in the Oro applications follows the same pattern. However, the structure of the information you must provide when creating a new record depends on its type (i.e., :ref:`entity <admin-guide-entity-interface>`). To illustrate this pattern of creating new records, have a look at the description of :ref:`creating a new account <user-guide-accounts-create>`, or :ref:`a task <doc-activities-tasks-actions-add-detailed>`.

You can edit or delete most of the records and perform some type-specific actions to selected records either from their pages or from the pages with the list of all records (displayed in tables). An example of type-specific actions is the ability to convert a lead into an opportunity from the lead page or add an address on a contact's page.

On the :ref:`page of all records (table views, also called grids) <doc-grids>`, additional actions are usually available as buttons on the top right (also record-specific) or under the ellipsis, or more actions, menu located at the end of the row of each specific record. Within the page of all records, you can usually |IcFilter| :ref:`filter <doc-grids-actions-filters>` and |Trash-SVG| :ref:`mass delete <doc-grids-actions-records-delete-multiple>` items in the table, |IcSettings| :ref:`manage table columns <doc-grids-actions-change-table>`, |Pencil-SVG| :ref:`edit items inline <doc-grids-actions-records-edit-inline>`, or :ref:`tag <admin-guide-tag-management>` them, so look out for the corresponding icons on the interface. You can find more information on how to work with table views in the :ref:`Record Tables <doc-grids>` topic.

Exchange and transfer of data into the Oro application from various third-party applications (and vice versa) is usually achieved either with the help of :ref:`import <import-records>`/:ref:`export <export-records>` or :ref:`integrations <user-guide-integrations>`. As an illustration, you can look at how :ref:`import works for leads <user-guide-system-channel-entities-leads>`, and how an :ref:`integration <user-guide-dotmailer-overview>` between Oro application and Dotdigital is configured.

The workflows define actions and transitions available for your records in the application. They enable you to handle complex procedures that can be explicitly configured for your business needs. You can learn more about the configuration of workflows in the dedicated :ref:`Workflow Management <doc--system--workflow-management>` topic.

.. toctree::
   :maxdepth: 1

   create-record
   manage-records/index
   import
   export
   notes
   comments
   attachments


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
 
  


   







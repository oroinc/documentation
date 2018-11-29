.. _user-guide--customers:

Customers
=========

.. begin

.. contents:: :local:


.. include:: /user_guide/overview/customers/customers_overview.rst
   :start-after: begin

.. image:: /user_guide/img/customers/customers/Customers.png
   :alt: The list of all customers available in the system

.. include:: /user_guide/customers/customers/create.rst
   :start-after: begin
   :end-before: stop

.. note:: Keep in mind that customers with at least one successful registered checkout cannot be deleted from the system.

.. image:: /user_guide/img/customers/customers/unable_to_delete_customers.png
   :alt: A note appears when deleting a customer warning that no entities can be deleted

Export
------

You can export the customer details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import
------

You can import the bulk details of updated or processed customer information in the .csv format following the steps described in the :ref:`Importing Customers <import-customers>` guide.

.. finish

**Related Articles**

* :ref:`Customer Organization Structure <user-guide--customers--customers--organize>`

* :ref:`Manage Address Book <user-guide--getting-started--address-book>`


.. toctree::
   :maxdepth: 1
   :hidden: 
  
   create
   organize
   manage_address_book
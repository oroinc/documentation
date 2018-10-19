.. _user-guide-system-channel-entities-business-customer:

Business Customers
==================


For each customer involved in the business-to-business activity you can create a **Business Customer** record.

.. _user-guide-customers-create:

Create Business Customer Records
--------------------------------

In order to create a new business customer in the system:

- Go to the **Customers>Business Customers**.

- Click :guilabel:`Create Business Customer`.

- The **Create Business Customer** :ref:`form <user-guide-ui-components-create-pages>` will appear:

|
  
.. image:: /img/business_customers/business_customers_create.png

|

The following fields are mandatory and **must** be defined:

.. csv-table::
  :header: "Field", "Description"
  :widths: 10, 30

  **Owner***,"Limits the list of users that can manage the customer to users, whose 
  :ref:`roles <user-guide-user-management-permissions>` allow managing 
  business customers assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.).
  
  By default, the user creating the record is chosen."
  "**Name***","The name used to refer to the business customer in the system."
  "**Channel***","Choose one of active :term:`sales channels <Sales Channel>`, from which OroCRM will get information on 
  this customer."
  "**Account***","An :ref:`Account <user-guide-accounts-create>`, to which the customer will be assigned. 
  Details of this business customer will then be a part of this account's details."

The rest of the fields are **optional**. The fields are added to the system based on general B2B practices, aims and 
processes and keep additional details of the customer. The optional fields may be left empty.
  
If you need to collect and process any other details of business customers, 
:ref:`custom fields can be created <doc-entity-fields-create>`. Their values will be displayed in the 
**Additional** section.
  
Once all the necessary fields have been defined, click :guilabel:`Save and Close` in the right top corner of the page to save the 
customer in the system.


.. _user-guide-customers-actions:

Manage Business Customer Records 
--------------------------------

The following actions can be performed with business customer records:

From the :ref:`grid <user-guide-ui-components-grids>`:

|

.. image:: /img/business_customers/customers_grid.png

|

- Delete a customer from the system : |IcDelete|
  
- Edit the customer : |IcEdit|
  
- View the customer : |IcView| 
  
      |
  
From the view page you can:
  
- Get to the Edit form of the customer.

- Delete the customer from the system.
  
- The rest of the available actions  depend on the system settings defined in the 
  **Communication &  Collaboration** section of the **Business Customer** entity configuration. See step 4 of the :ref:`Create an Entity <doc-entity-actions-create>` action description.
  

|

.. image:: /img/business_customers/business_customers_viewpage.png

|



.. hint:: 

    :ref:`Custom Reports <user-guide-reports>` can be added to analyze details of business customers in OroCRM. 

    :ref:`Workflows <user-guide-workflow-management-basics>` can be created to define rules and guidelines on possible 
    actions/updates of business customers in the system




.. |BCrLOwnerClear| image:: /img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: /img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: /img/buttons/BGotoPage.png
   :align: middle

.. |Bplus| image:: /img/buttons/Bplus.png
   :align: middle

.. |IcDelete| image:: /img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: /img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: /img/buttons/IcView.png
   :align: middle


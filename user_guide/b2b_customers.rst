.. _user-guide-system-channel-entities-b2b-customer:

B2B Customers
=============

The B2B Customer records ("B2B customers") represent customers involved in the business-to-business activities. Every 
:term:`B2B channel <B2B Channel>` is assigned a B2B customer entity - this means that details of different B2B customers
can be collected from this channel.

From this article you will learn how to create new B2B customers, manage existing B2B customers, analyse details of the 
customer records with OroCRM reports and use in workflows.


.. _user-guide-customers-create:

Create B2B Customers from the UI
--------------------------------

- Go to the *Customers → B2B Customers*

- Click :guilabel:`Create B2B Customer` button

- The *Create B2B Customer* :ref:`form <user-guide-ui-components-create-pages>` will appear:

.. image:: ./img/b2b_customers/b2b_customers_create.png

The following fields are mandatory and **must** be defined:

.. csv-table:: Mandatory Entity Fields
  :header: "Field", "Description"
  :widths: 10, 30

  "**Owner***","Limits the list of users that can manage the customer to users, whose roles allow managing 
  B2B customers assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.).
  
  By default, the user creating the customer is chosen."
  "**Name***","The name used to refer to the B2B customer in the system."
  "**Channel***","Choose one of active :term:`B2B channels <B2B Channel>`, from which OroCRM will get information on 
  this customer."
  "**Account***","An :term:`account <Account>`, to which the customer is assigned. Details of this B2B customer will 
  then be a part of this account's details. 
  Choose from the drop-down or list, or create a new accounts, as described in the  
  :ref:`Accounts guide <user-guide-accounts-create>`."

The rest of the fields are **optional**. They keep additional details about the customer (such as its term:`tags <Tag>`
and address details) and may be left empty.

.. note::

    Optional fields are implemented based on general B2B practices and may be used as required by your 
    business aims and processes.
  
If you need to record and process any other details of B2B customers, **custom fields** can be created. Their values will 
be displayed in the *Additional* section.

.. hint::

    To create a custom field, go to *System → Entities → Entity Management → Lead* and click :guilabel:`Create Field`
    button.
  
Once all the necessary fields have been defined, click the button in the right top corner of the page to save the 
customer in the system.


.. _user-guide-customers-actions:

B2B Customer Actions 
--------------------

The following actions can be performed for B2B customers:

From the :ref:`grid <user-guide-ui-components-grids>`:

.. image:: ./img/b2b_customers/customers_grid.png

- Delete a customer from the system : |IcDelete|
  
- Get to the :ref:`Edit form <user-guide-ui-components-create-pages>` of the customer : |IcEdit|
  
- Get to the :ref:`View page <user-guide-ui-components-view-pages>` of the customer : |IcView| 

From the :ref:`View page <user-guide-ui-components-view-pages>`:

.. image:: ./img/b2b_customers/customer_view.png
  
- Get to the *"Edit"* form of the customer

- Delete the customer from the system 

The rest of the actions available depend on the system settings defined in the Communication &  Collaboration section 
of the "B2B Customer" entity

.. image:: ./img/b2b_customers/customer_view_actions.png

      
.. _user-guide-customers-reports:

Reports with B2B customers
--------------------------

Custom reports can be added to analyze details of B2B customers in OroCRM. For more details on the ways to create and 
customize the reports,  please see the :ref:`Reports guide <user-guide-reports>`.


.. _user-guide-customers-workflows:

Using B2B customers in the Workflows
------------------------------------

You can use OroCRM's :term:`workflows <Workflow>` to define rules and guidelines on possible actions/updates of 
B2B customers in the system, as described in the :ref:`Workflows guide <user-guide-workflow-management-basics>`.




.. |BCrLOwnerClear| image:: ./img/buttons/BCrLOwnerClear.png
   :align: middle

.. |Bdropdown| image:: ./img/buttons/Bdropdown.png
   :align: middle

.. |BGotoPage| image:: ./img/buttons/BGotoPage.png
   :align: middle

.. |Bplus| image:: ./img/buttons/Bplus.png
   :align: middle

.. |IcDelete| image:: ./img/buttons/IcDelete.png
   :align: middle

.. |IcEdit| image:: ./img/buttons/IcEdit.png
   :align: middle

.. |IcView| image:: ./img/buttons/IcView.png
   :align: middle


.. _user-guide-system-channel-entities-business-customer:

Business Customers
==================

For each customer involved in the business-to-business activity you can create a **Business Customer** record.

.. contents:: :local:

.. _user-guide-customers-create:

Before You Begin
----------------

Enable Business Customers
~~~~~~~~~~~~~~~~~~~~~~~~~

Enable business customers in your Oro application via a sales channel:

1. Navigate to **System > Channels** in the main menu.
2. Click **Create Channel** in the top right corner of the page.
3. Provide the following information:

   * Select the name of the channel to refer to in the system. It is recommended to keep the name meaningful.
   * Set the channel type to **Sales**
   * In the **Entities** section, select **Business Customer** from the list, and click **Add**.
   * Click **Save and Close** to save the channel.

Create a New Business Customer
------------------------------

In order to create a new business customer in the system:

1. Go to the **Customers>Business Customers** in the main menu.

2. Click **Create Business Customer** in the top right corner of the page.

3. The **Create Business Customer** :ref:`form <user-guide-ui-components-create-pages>` will appear:

   .. image:: ../../img/business_customers/business_customers_create.png
      :alt: Create a new business customer

   The following fields are mandatory and **must** be defined:

   .. csv-table::
     :header: "Field", "Description"
     :widths: 10, 30

     "**Owner**","Limits the list of users that can manage the customer to users, whose :ref:`roles <user-guide-user-management-permissions>` allow managing business customers assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.). By default, the user creating the record is chosen."
     "**Name**","The name used to refer to the business customer in the system."
     "**Channel**","Choose one of active :term:`sales channels <Sales Channel>`, from which OroCRM will get information on this customer."
     "**Account**","An :ref:`Account <user-guide-accounts-create>`, to which the customer will be assigned. Details of this business customer will then be a part of this account's details."

   The rest of the fields are **optional**. The fields are added to the system based on general B2B practices, aims and
   processes and keep additional details of the customer. The optional fields may be left empty.

   If you need to collect and process any other details of business customers, :ref:`custom fields can be created <doc-entity-fields-create>`. Their values will be displayed in the **Additional** section.

   Once all the necessary fields have been defined, click **Save and Close** in the right top corner of the page to save the customer in the system.


.. _user-guide-customers-actions:

Manage Business Customer Records
--------------------------------

The following actions can be performed with business customer records:

**From the list of all business customers**:

1. Delete a customer from the system : |IcDelete|

2. Edit the customer : |IcEdit|

3. View the customer : |IcView|

.. image:: ../../img/business_customers/customers_grid.png
   :alt: The actions available for the business customer from the grid, such as view, edit and delete.

**From the view page of a specific business customer**:

1. Get to the Edit form of the customer.

2. Delete the customer from the system.

3. The rest of the available actions  depend on the system settings defined in the  **Communication &  Collaboration** section of the **Business Customer** entity configuration. See step 4 of the :ref:`Create an Entity <doc-entity-actions-create>` action description.

.. image:: ../../img/business_customers/business_customers_viewpage.png
   :alt: The page of a specific business customer


.. hint::

    :ref:`Custom Reports <user-guide-reports>` can be added to analyze details of business customers in OroCRM.

    :ref:`Workflows <doc--system--workflow-management>` can be created to define rules and guidelines on possible actions/updates of business customers in the system.


.. BCrLOwnerClear| image:: /img/buttons/BCrLOwnerClear.png
   :align: middle

.. include:: /img/buttons/include_images.rst
   :start-after: begin

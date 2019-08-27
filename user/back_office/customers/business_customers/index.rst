.. _user-guide-system-channel-entities-business-customer:

Business Customers
==================

Business customers represents a point of contact in your sales and business activities. With the help of Business Customers, you can track activities and records associated with them across different channels.

For each customer involved in the business-to-business activity you can create a **Business Customer** record.

.. _user-guide-customers-create:

Enable Business Customers
-------------------------

Enable business customers in your Oro application via a sales channel:

1. Navigate to **System > Channels** in the main menu.
2. Click **Create Channel**.
3. Once the form opens:

   * Select a meaningful name for the channel.
   * Set the channel type to **Sales**
   * In the **Entities** section, select **Business Customer** from the list, and click **Add**.

4. Click **Save and Close**.

Create a Business Customer
--------------------------

To create a new business customer:

1. Navigate to the **Customers > Business Customers** in the main menu.
2. Click **Create Business Customer**.
3. Provide the following information:

   * **Owner** --- Limits the list of users that can manage the customer to users, whose :ref:`roles <user-guide-user-management-permissions>` allow managing business customers assigned to the owner (e.g. the owner, members of the same business unit, system administrator, etc.). By default, the user creating the record is chosen.
   * **Name** --- The name used to refer to the business customer in the system.
   * **Channel** --- Choose one of active :term:`sales channels <Sales Channel>`, from which OroCRM will get information on this customer.
   * **Account** --- An :ref:`Account <user-guide-accounts-create>` to which the customer will be assigned. Details of this business customer will then be a part of this account's details.

   The rest of the fields are **optional**. The fields are added to the system based on general B2B practices, aims and processes and keep additional details of the customer. The optional fields may be left empty.

   .. If you need to collect and process any other details of business customers, :ref:`custom fields can be created <doc-entity-fields-create>`. Their values will be displayed in the **Additional** section.

4. Click **Save and Close**.

.. _user-guide-customers-actions:

Manage Business Customers
-------------------------

The following actions can be performed with business customer records:

**From the business customers grid**:

1. Delete |IcDelete|
2. Edit |IcEdit|
3. View |IcView|

.. image:: /user/img/customers/business_customers/customers_grid.png
   :alt: The actions available for the business customer from the grid, such as view, edit and delete.

**From the view page of a specific business customer**:

1. Get to the Edit page.
2. Delete the customer from the application.
3. Perform actions from the **More Actions** menu (e.g. send and emil, log a call).

.. The rest of the available actions depend on the system settings defined in the  **Communication &  Collaboration** section of the **Business Customer** entity configuration. See step 4 of the :ref:`Create an Entity <doc-entity-actions-create>` action description.

.. image:: /user/img/customers/business_customers/business_customers_viewpage.png
   :alt: The page of a specific business customer

.. .. hint::    :ref:`Custom Reports <user-guide-reports>` can be added to analyze details of business customers in OroCRM.   :ref:`Workflows <doc--system--workflow-management>` can be created to define rules and guidelines on possible actions/updates of business customers in the system.


.. BCrLOwnerClear| image:: /user/img/buttons/BCrLOwnerClear.png
   :align: middle

.. include:: /include/include_images.rst
   :start-after: begin

.. toctree::
   :maxdepth: 1

   export
   import
.. _user-guide--customers:

Customers
=========

.. begin

.. contents:: :local:

In the Customer section, you can manage the customers who represent a group of buyers related to the same business organization.

Navigate to **Customers > Customers** in the main menu.

.. image:: /user_guide/img/customers/customers/Customers.png
   :alt: The list of all customers available in the system

Hover over the |IcMore| **More Options** menu to the right of the necessary customer to perform the following actions:

* |IcView| **View** customer details. Alternatively, click on the item to open its details page.
* |IcEdit| **Edit** customer details.
* |IcDelete| **Delete** existing customers.

On the customer details page, you get access to the aggregated information about customer users activities and eCommerce operations, such as requests for quotes, quotes, sales orders, and shopping lists.

.. image:: /user_guide/img/customers/customers/customers_details.png
   :alt: The details page of the selected customer

You can also quickly get to the :ref:`customer organization structure <user-guide--customers--customers--organize>`, :ref:`an address book <user-guide--getting-started--address-book>` with a preview on the map, :ref:`customer users <user-guide--customers--customer-users>`, :ref:`price lists <user-guide--customers--customer-groups--pricelist>` enabled for the customer, and overview of :ref:`requests for quote <user-guide--sales--requests-for-quote>`, :ref:`sales orders <user-guide--sales--orders>`, :ref:`quotes <user-guide--sales--quotes>` created by and for customer users, and available :ref:`shopping lists <user-guide--sales--shopping-lists>`. Finally, you can get to a summary of activity from every operation triggered by the customer users.

.. _user-guide--customers--customers--create:

Create a Customer
-----------------

.. note::
    See a short demo on `how to create customers in OroCommerce <https://www.oroinc.com/orocommerce/media-library/create-customer-record>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/iLphaHiU8YY" frameborder="0" allowfullscreen></iframe>

To create a new customer:

#. Navigate to **Customers > Customers** in the main menu.

#. Click **Create Customer**.

   The following page opens:

   .. image:: /user_guide/img/customers/customers/CustomersCreate.png
      :alt: An empty form is displayed when creating a new customer

#. Optionally, select an existing `account <https://oroinc.com/orocrm/doc/current/user-guide-sales-tools/customer-management/common-features-accounts>`_ to help track sales actions and metrics for the customer that is a member of the bigger customer organization. When it remains empty, the new account is created for the new customer automatically.

#. Fill in the customer **Name**.

#. Optionally, add a customer to a customer group if you already have a group with the settings and configuration that fits the new customer.

#. If you are adding a subsidiary of the existing customer, select **Parent Customer**.

#. Assign a sales representative who will be assisting customer users.

#. Select **Tax Code** to label the customer group taxation schema.

#. Add a billing and shipping address as described in :ref:`the address book <user-guide--getting-started--address-book>` section.

#. In the **Additional** section, select a Payment term to be used as a payment option available to the customer users during the checkout.

#. In the **Price Lists** section, add pricelists and prioritize them as described in the :ref:`Price List Management for a Customer Group <user-guide--customers--customer-groups--pricelist>` section.

#. When OroCommerce is deployed with InfinitePay payments support, the customer's VAT Id shall be captured for their creditworthiness verification. VAT Id should be valid, and the billing address should match the one provided for the VAT registration. These are prerequisites to enable payments via :ref:`InfinitePay <user-guide--payment--prerequisites--infinitepay>` for the customer users.

#. Click **Save** in the top right.

.. note:: Keep in mind that customers with at least one successful registered checkout cannot be deleted from the system.

   .. image:: /user_guide/img/customers/customers/unable_to_delete_customers.png
      :alt: A note appears when deleting a customer warning that no entities can be deleted

.. _user-guide--customers--customers--organize:

Customer Organization Structure
-------------------------------

You can create a hierarchy of business units or customer divisions by providing a parent company when editing the company details.

.. image:: /user_guide/img/customers/customers/CustomersCreateParent_cust.png
   :alt: Selecting a company for the parent customer

Navigate to the parent company page by clicking on the company name next to the Parent Customer.

.. image:: /user_guide/img/customers/customers/CustomersViewParent_cust.png
   :alt: Click on the company name next to the parent customer to get to the parent company page

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

   manage_address_book

.. include:: /img/buttons/include_images.rst
   :start-after: begin
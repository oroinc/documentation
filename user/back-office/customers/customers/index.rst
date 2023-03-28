:oro_documentation_types: OroCommerce
:oro_show_local_toc: false

.. _user-guide--customers:

Manage Customers in the Back-Office
===================================

.. hint:: This section is part of the :ref:`Customer Management <concept-guide-customers>` topic that provides a general understanding of accounts, contacts, customers, and customer hierarchy available in Oro applications.

:term:`Customers <Customer>` represent companies who buy products using the storefront. **Customer users** are actual people who act on behalf of companies (i.e. customers) and have a limited set of permissions that depend on their role and function in the customer organization. You can manage customer users and roles in the back-office or delegate this function to the customer who will access user and role management in the storefront.

In the Customer section, you can manage the customers representing a group of buyers related to the same business organization.

Navigate to **Customers > Customers** in the main menu.

Hover over the |IcMore| **More Options** menu to the right of the necessary customer to perform the following actions:

* |IcView| **View** customer details. Alternatively, click on the item to open its details page.
* |IcEdit| **Edit** customer details.
* |IcConfig| **Configure** customer settings.

On the customer details page, you get access to the aggregated information about customer users' activities and eCommerce operations, such as requests for quotes, quotes, sales orders, and shopping lists.

You can also quickly get to the :ref:`customer organization structure <user-guide--customers--customers--organize>`, :ref:`an address book <user-guide--getting-started--address-book>` with a preview on the map, :ref:`customer users <user-guide--customers--customer-users>`, :ref:`price lists <user-guide--customers--customer-groups--pricelist>` enabled for the customer, and overview of :ref:`requests for quote <user-guide--sales--requests-for-quote>`, :ref:`sales orders <user-guide--sales--orders>`, :ref:`quotes <user-guide--sales--quotes>` created by and for customer users, and available :ref:`shopping lists <user-guide--sales--shopping-lists>`. Finally, you can get to a summary of activity from every operation triggered by the customer users.

Quick action buttons enable you to create a new address, subsidiary, customer user, order, quote, and opportunity directly from the customer view page. Click the button to open the required form for data input. The form can be displayed in a new browser tab, a popup dialog window, or replace the current page, :ref:`depending on its system configuration <doc-configuration-display-settings-quick-actions>`.

Alternatively, click **More Actions** at the top right and select the entity to be created from the customer view page.

.. image:: /user/img/customers/customers/quick-buttons-customer.png
   :alt: Displaying the quick action buttons on the customer view page

.. _user-guide--customers--customers--organize:

Customer Organization Structure
-------------------------------

You can create a hierarchy of business units or customer divisions by providing a parent company when editing the company details.

.. image:: /user/img/customers/customers/CustomersCreateParent_cust.png
   :alt: Selecting a company for the parent customer

Navigate to the parent company page by clicking on the company name next to the Parent Customer.

.. image:: /user/img/customers/customers/CustomersViewParent_cust.png
   :alt: Click on the company name next to the parent customer to get to the parent company page

All the subsidiary departments and divisions are displayed in the Subsidiaries section of the customer's parent category. You can reach any child customer's view page from this section by clicking the |IcView| **View** icon.

.. image:: /user/img/customers/customers/subsidiaries.png
   :alt: Subsidiaries section of the customer's parent category

.. toctree::
   :maxdepth: 1

   create
   address-book
   export
   import
   customer-price-lists
   customer-all-products-menus
   customer-frontend-menus
   customer-configuration/index

.. include:: /include/include-images.rst
   :start-after: begin


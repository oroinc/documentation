.. _user-guide--sales--seller-registration-requests:

Manage Seller Registration Requests in the Back-Office
======================================================

.. hint:: This section is part of the :ref:`OroMarketplace Concept Guide <concept-guide-oro-marketplace>` that provides a general understanding of the marketplace features and concepts.

Merchants looking to sell their products online via OroMarketplace can submit an online registration form on the OroMarketplace website. Once the form is submitted, the details of the application are synchronized with the OroMarketplace back-office. A person responsible for processing seller registration requests in the marketplace owner organization can then start processing the request, accept it straight away, or decline it. They can also create a new request via the back-office of the (global) marketplace owner organization, as long as they have obtained the necessary details from the seller.

.. hint::
    Before you work with seller registration requests, make sure they are :ref:`enabled in the settings of the global organization settings <configuration--commerce--marketplace--seller-organization>`.

Create a Seller Registration Request
------------------------------------

To create a new seller registration request:

1. Navigate to **Sales > Seller Registration Requests** in the back-office.
2. Click **Create Seller Registration Request** on the top right.

.. image:: /user/img/sales/seller-registration-requests/create-seller-registration-request.png
   :alt: Create a new seller registration request button

3. In the **General** section, provide the following mandatory information:

   * **Owner** --- The owner of the seller registration request record.
   * **First Name** --- The first name of the seller.
   * **Last Name** --- The last name of the seller
   * **Organization Name** --- The organization name of the seller.
   * **Business Name** --- The business email address of the seller.
   * **Business Phone Number** --- The business phone number of the seller.

.. image:: /user/img/sales/seller-registration-requests/create-seller-registration-request-form.png
   :alt:  Create form for a new seller registration request

4. Click **Save and Close**.

Once the request is saved, the person responsible for handling them can progress it through the steps of the :ref:`Seller Registration Workflow <system--workflows--seller-registration-flow>`.

Manage a Seller Registration Request
------------------------------------

You can perform the following actions for requests from the grid:

* Delete |Trash-SVG|
* Edit |IcEdit|
* View |IcView|

.. image:: /user/img/sales/seller-registration-requests/grid-actions-seller-request.png
   :alt: Grid actions for seller registration requests

Two grid views are available for seller registration requests: **Open Seller Registration Requests** and **All Seller Registration Requests**.

.. image:: /user/img/sales/seller-registration-requests/two-grid-views.png
   :alt: Illustration of the two grid views

You can filter the grid with all requests and then save the filtered page as another grid view.

.. image:: /user/img/sales/seller-registration-requests/new-grid-for-seller-request.png
   :alt: Illustration of how to add a new grid page.

On the view page of a request, you can transition it through the steps of the :ref:`Seller Registration Workflow <system--workflows--seller-registration-flow>`, and perform the following actions:

* Edit
* Delete
* Log Call
* Add Task
* Send Mail
* Add Note
* Add Event

For more information, see :ref:`Information Management <user-guide-data-management-basics-entities>`.


.. image:: /user/img/sales/seller-registration-requests/request-view-page.png
   :alt: Action available for a seller registration request from its view page


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

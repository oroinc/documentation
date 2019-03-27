.. _user-guide--customers--customer-users:

Customer Users
--------------

.. begin

.. contents:: :local:

Customer users act on behalf of the company and may have a limited set of permissions in OroCommerce, depending on their function in the customer organization.

For customer user management, navigate to **Customers > Customer Users** in the main menu.

In Customer Users section, you can:

* View, edit, and create new customer users.
* Select their roles in OroCommerce to define their level of permissions and access to the actions and data in OroCommerce storefront.
* Manage customer user information:

    - Name
    - Birthday
    - Email address
    - Billing and shipping address and phone number (using :ref:`address book <user-guide--getting-started--address-book>`)
    - Customer user role(s)
    - Website to redirect the customer upon login

* View requests for quotes, sales orders, quotes created or submitted by the customer user.
* View communication with the customer that happened using email, notes or scheduled events.
* View additional information attached to customer user.
* Enable and disable the customer.
* Reset the customer user password.

.. note:: You can delegate this function to the customer who will access user and role management in the OroCommerce storefront (see :ref:`Delegating Users and Role Management to the Customer section <user-guide--customers--customer-user-delegate>` for more information).

**Customer Account Confirmation**

Upon registration, a customer user receives an email confirmation request. Once they follow up with the requested action, their account is marked as confirmed.

.. image:: /user_guide/img/customers/customer_users/CustomerUsers.png
   :class: with-border

.. _user-guide--customers--create-customer-user:

.. include:: /user_guide/customers/customer_users/create.rst
   :end-before: stop

.. _user-guide--customers--customer-users--consents:

View Accepted Consents
~~~~~~~~~~~~~~~~~~~~~~

When at least one consent to process personal data has been accepted by a customer user in the storefront, you can view this information in the dedicated **Consents** section on the page of a particular customer user under **Customers > Customer Users**.

 .. image:: /admin_guide/img/workflows/checkout_with_consents/consents_section_customer_user_page.png

You can read more information on consent management in the following related topics:

* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Create Consents <user-guide--consents--create>`
* :ref:`Add a Consent Landing Page to a Web Catalog <user-guide--consents--add>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`

Export
~~~~~~

You can export the customer user details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import
~~~~~~

You can import the bulk details of updated or processed customer user information in the .csv format following the steps described in the :ref:`Importing Customer Users <import-customer-users>` guide.

.. finish

**Related Information**

.. toctree::
   :maxdepth: 1

   create

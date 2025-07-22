.. _frontstore-guide--invoices:

Manage Invoices in the Storefront
=================================

.. note:: The Invoices functionality is partially available as of version 6.1.3 and is still under active development. Some features may not behave as expected. We appreciate your patience as our team continues to enhance and finalize this feature for a full release later in 2025.

The Invoices feature enables customer users to view, download, and pay invoices directly in the OroCommerce storefront. The feature supports one-click payments for individual invoices.

When the invoice functionality is :ref:`enabled in the system configuration <configuration--guide--commerce--configuration--sales-invoices>`, you can view customer's invoices under **My Profile > Invoices** in the storefront.

.. image:: /user/img/storefront/invoices/invoices-menu-storefront.png

From the Invoices grid, you can:

* View all invoices and their details, including the total amount and payment status.
* :ref:`Filter <frontstore-guide--navigation-filters>` products by title, invoice number, date, payment status, etc.
* View a specific invoice by opening its view page.
* Pay directly from the grid.

.. image:: /user/img/storefront/invoices/invoices-grid.png

From the Invoices view page, you can:

* View invoice details
* Open the associated order
* Access guest payment link
* Download the invoice in the .pdf format
* Pay the invoice

.. image:: /user/img/storefront/invoices/invoices-view-page.png

.. hint:: The ability to pay the invoice in the storefront is controlled by the :ref:`Stripe Integration Element <user-guide--payment--payment-providers-stripe--element>` and :ref:`OroPay <user-guide--payment--oropay>` in the back-office.


**Related Articles**

* :ref:`Configure Global Invoice Settings <configuration--guide--commerce--configuration--sales-invoices>`
* :ref:`Invoices in the Back-Office <user-guide--sales--invoices>`
* :ref:`Stripe Integration Element <user-guide--payment--payment-providers-stripe--element>`
* :ref:`OroPay Integration <user-guide--payment--oropay>`
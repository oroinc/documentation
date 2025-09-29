.. _my-account-order-history:
.. _frontstore-guide--orders-view:
.. _frontstore-guide--orders-order-history:


Manage Order History in the Storefront
======================================

The Order History section stores the information on all open and submitted orders of registered users. Here, you can check the details on the order number, the date it was created, the address this order was shipped to, the total amount, the payment method and the payment status, and whether the order :ref:`was created by a seller or not <user-guide--customers--customer-user-impersonate>`.

.. image:: /user/img/storefront/orders/order-history.png

To open the **Order History** menu, open :ref:`user menu <frontstore-guide--navigation-user-menu>` and click **Order History** from the drop-down.

The Order History page contains two sections:

* All open orders
* All past orders

From the all open orders table, you can:

* Click the order in the table to open it.
* Click |ShoppingCart-SVG|  **Check Out** at the end of the row to proceed to the checkout. You will be redirected to the ordering process page (the step where you left off).
* Click |Trash-SVG| **Delete** at the end of the row to delete an open order.

From the all past orders table, you can:

* Click |Eye-SVG| **View** at the end of the row to view an order or click the order to open it. To return to the Order History page, click **Back to Orders List** on the bottom left of the view page.
* Click |ShoppingCart-SVG|  **Re-Order** at the end of the row to submit the same order

Information displayed in the tables depends on the columns selected in the |Columns-SVG| grid settings. Within each of the tables, you have the following :ref:`action buttons <frontstore-guide--navigation-action-buttons>` available:

* Refresh (to update the view table).
* Reset  (to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made).
* Adjust (to define which columns to show in the table).
* Filter the displayed orders (see more in :ref:`Filters <frontstore-guide--navigation-filters>`).

Order View Page
---------------

If the order was created on behalf of the buyer, this will be indicated on the order view page with the following note: *This order was created on your behalf by a member of our staff.*

.. image:: /user/img/storefront/orders/order-impersonated.png
   :alt: An order view page with a note saying "This order was created on your behalf by a member of our staff".

Any documents uploaded for the customer user will also be visible directly on the order page:

.. image:: /user/img/sales/orders/order-customer-documents.png
   :alt: Illustration of the documents uploaded via back-office on the customer side in the storefront

Customers can start a :ref:`conversation <storefront-guide--conversations>` by clicking Ask a question on the order view page.

There is also an option download a PDF version of any placed order directly from the order view page, if the :ref:`Order PDF download feature <configuration--commerce--orders--order-creation--global>` is enabled in the back-office. Each download generates a fresh PDF with an updated timestamp.

.. image:: /user/img/system/config_commerce/order/order-pdf.png
   :alt: Illustration of the Order Download Button in the storefront

.. note:: Order PDF functionality is available as of OroCommerce version 6.1.6.

To print an order, click on the **Print** button on the top right and follow the instructions on your device.

.. note:: More details on how to review ordered items, billing and shipping information, and re-order products from the previous orders are described in the :ref:`Orders <frontstore-guide--orders>` section of the Storefront guide.


.. include:: /include/include-svg.rst
   :start-after: begin





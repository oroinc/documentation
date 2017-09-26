
:orphan:


.. _user-guide--sales--orders--viewlist:

View Order List
===============

.. contents:: :local:


To view the list of existing orders, navigate to **Sales > Orders** in the main menu.

.. image:: /user_guide/img/sales/orders/OrdersGrid.png


To learn what you can find and perform when viewing the order details, see the following section.


List Views
^^^^^^^^^^

At the top right you can see the name of the view. The views are defined by default:

* Open Orders --- Shows only orders with status 'Open'.
* All Orders --- Shows all existing orders regardless of their statuses.

To change the view, click the drop-down next to the view name and select the required view.

.. image:: /user_guide/img/sales/orders/orders_views.png


You can also create and save new views for future use.

Order List
^^^^^^^^^^

The following information about orders is available:

* **Order Number** --- The unique order reference number. It is generated automatically for new orders.
* **PO Number** --- Another order reference number. It is usually defined by the buyer and used by the buyer's side to match invoice and received goods with purchase.
* **DNSLT** (Do not ship later than) --- The date on which the order expires.
* **Currency** --- The currency in which the order is made.
* **Subtotal** --- The amount due for items included in the order. Does not include additional costs, taxes, discounts.
* **Total** --- The final amount due for the order. Includes all the additional costs (like shipping costs), taxes or discounts.
* **Customer** --- The customer that made the order.
* **Customer User** --- The customer user that made an order on behalf of the customer.
* **Internal Status** --- The order status visible only in the management console. See the :ref:`description of internal statuses <doc--orders--statuses--internal>`.
* **Owner** --- The management console user who is responsible for the order.
* **Payment Status** --- Whether the order is already paid in full, the payment for the order is authorized, etc.
* **Payment Method** --- The payment method selected to pay for the order.
* **Shipping Method** --- The shipping method selected for the order delivery.
* **Source Document** --- If the order has been created from an RFQ, quote, or another order, this field contains a link to the corresponding record. If the order has been created from scratch (in the management console) or the quick order form (in the front store), the field shows 'N/A'.
* **Discount** --- The total of all discounts applied to the order.
* **Created At** --- The date and time when the order was created.
* **Updated At** --- The date and time when the order was last updated.
* **Payment Term** --- The terms and conditions for order payment. For more information, see :ref:`Payment Terms Integration <sys--integrations--manage-integrations--payment-term>`.
* **Warehouse** --- The warehouse that the goods are shipped from.


.. hint::

   To manage the columns displayed within the grid, click |IcConfig| on the right of the grid, and select the information you wish to be displayed.

   To handle big volume of data, use page switcher, increase the 'view per page' value, or use |IcFilter| filters to narrow down the list to the information you need.

   .. For how to configure visible fields, a number of items per page, etc., see the :ref:`Grids <doc-grids>` topic.


Manage Orders from the List
^^^^^^^^^^^^^^^^^^^^^^^^^^^

* :ref:`Create an order <user-guide--sales--orders--create>`

You can perform the following actions with every item of the orders list:

* :ref:`View order details <user-guide--sales--orders--view>`

* :ref:`Edit order details <user-guide--sales--orders--edit>`

* :ref:`Delete orders <doc--orders--actions--delete>`

.. image:: /user_guide/img/sales/orders/OrdersGridActions.png


.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin

Manage Orders
=============

.. contents:: :local:
   :depth: 2

.. _user-guide--sales--orders--viewlist:

Manage Orders in the Order Grid
-------------------------------

To view the list of existing orders, navigate to **Sales > Orders** in the main menu.

.. image:: /img/sales/orders/OrdersGrid.png
   :alt: The list of existing orders

The following information about orders is available:

* **Order Number** --- The unique order reference number. It is generated automatically for new orders.
* **PO Number** --- Another order reference number. It is usually defined by the buyer and used by the buyer's side to match invoice and received goods with purchase.
* **DNSLT** (Do not ship later than) --- The date on which the order expires.
* **Currency** --- The currency in which the order is made.
* **Subtotal** --- The amount due for items included in the order. Does not include additional costs, taxes, discounts.
* **Total** --- The final amount due for the order. Includes all the additional costs (like shipping costs), taxes or discounts.
* **Customer** --- The customer that made the order.
* **Customer User** --- The customer user that made an order on behalf of the customer.
* **Internal Status** --- The order status visible only in the back-office. See the :ref:`description of internal statuses <doc--orders--statuses--internal>`.
* **Owner** --- The back-office user who is responsible for the order.
* **Payment Status** --- Whether the order is already paid in full, the payment for the order is authorized, etc.
* **Payment Method** --- The payment method selected to pay for the order.
* **Shipping Method** --- The shipping method selected for the order delivery.
* **Source Document** --- If the order has been created from an RFQ, quote, or another order, this field contains a link to the corresponding record. If the order has been created from scratch (in the back-office) or the quick order form (in the storefront), the field shows 'N/A'.
* **Discount** --- The total of all discounts applied to the order.
* **Created At** --- The date and time when the order was created.
* **Updated At** --- The date and time when the order was last updated.
* **Payment Term** --- The terms and conditions for order payment. For more information, see :ref:`Payment Terms Integration <sys--integrations--manage-integrations--payment-term>`.
* **Warehouse** --- The warehouse that the goods are shipped from.

.. hint::

   To manage the columns displayed within the grid, click |IcConfig| on the right of the grid, and select the information you wish to be displayed.

   To handle the big volume of data, use page switcher, increase the 'view per page' value, or use |IcFilter| filters to narrow down the list to the information you need.

   .. For how to configure visible fields, a number of items per page, etc., see the :ref:`Grids <doc-grids>` topic.

At the top right you can see the name of the view. The views are defined by default:

* Open Orders --- Shows only orders with status 'Open'.
* All Orders --- Shows all existing orders regardless of their statuses.

To change the view, click the drop-down next to the view name and select the required view.

.. image:: /img/sales/orders/orders_views.png
   :alt: Required view options available in the dropdown next to the view name

You can also create and save new views for future use.

.. _user-guide--sales--orders--edit:

Edit Order Details
------------------

To edit an order:

#. Navigate to **Sales > Orders** in the main menu.
#. Choose an order in the list, hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

   Alternatively, click the order to open its details. On the order details page, click the **Edit** button on the top right.

#. Update the required information. See :ref:`Create an Order from Scratch <user-guide--sales--orders--create>` and :ref:`Manage Promotions in Orders <user-guide--sales--orders--promotions>` topics for detailed information on the available options.

#. Click **Save** on the top right of the page.

The order is updated.

.. _doc--orders--actions--delete:

Delete an Order
---------------

.. _doc--orders--actions--delete--fromgrid:

Delete an Order from the Order Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Sales > Orders**.
2. Choose the order that you need to delete, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcDelete| **Delete** icon.
3. In the confirmation dialog, click **Yes, Delete**.

.. _doc--orders--actions--delete--fromviewpage:

Delete an Order from the Order View Page
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Sales > Orders**. The order list opens.
2. Click the order that you need to delete. The order view page opens.
3. Click **Delete** on the top right.
4. In the confirmation dialog, click **Yes, Delete**.

.. _doc--orders--actions--delete--multiple:

Delete Multiple Orders
^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Sales > Orders**. The order list opens.

2. Select the check boxes in front of the orders that you need to delete, click the |IcMore| **More Options** menu at the end of list header, and then click |IcDelete| **Delete**.

   .. tip::
      To select bulk of items quickly, click |IcSortDesc| next to the check box at the beginning of the table header and then select one of the following options:

      * *All* --- Select all orders.
      * *All Visible* --- Select only orders that are visible on the page now.

      To clear the selection, select *None*.

#. In the confirmation dialog, click **Yes, Delete**.

.. include:: /img/buttons/include_images.rst
   :start-after: begin

Manage Orders
=============

.. _user-guide--sales--orders--viewlist:

Manage Orders in the Order Grid
-------------------------------

To view the list of existing orders, navigate to **Sales > Orders** in the main menu.

.. image:: /user/img/sales/orders/OrdersGrid.png
   :alt: The list of existing orders

The following information about orders is available:

* **Order Number** --- The unique order reference number. It is generated automatically for new orders.
* **PO Number** --- Another order reference number. It is usually defined by the buyer and used by the buyer's side to match the invoice and the received goods with the purchase.
* **Ship by** --- The date on which the order expires.
* **Currency** --- The currency in which the order is made.
* **Subtotal** --- The amount due for items included in the order. Does not include additional costs, taxes, or discounts.
* **Total** --- The final amount due for the order. Includes all the additional costs (like shipping costs), taxes or discounts.
* **Customer** --- The customer that made the order.
* **Customer User** --- The customer user who made an order on behalf of the customer.
* **Internal Status** --- The order status is managed only in the back-office. See the :ref:`description of internal statuses <doc--orders--statuses--internal>`.
* **Status** --- An external order status displayed in the title next to the internal status and the order number. This status can be used by an external system and is visible when :ref:`Enable External Status Management <sys--commerce--orders--status-management>` configuration option is enabled in the system configuration, and status options are created for the order status entity field via :ref:`entity management <entities-management>`. When enabled, this external order status will be visible in the Order History grid and on the order view page in the storefront user :ref:`account <my-account-order-history>`. If disabled, Internal Status will be displayed instead. Please be aware that the external order status is managed via the order :ref:`REST API <web-services-api>`.

.. image:: /user/img/sales/orders/external-order-status.png
   :alt: Illustration of external order status on the order view page and on the order status entity field page with sample options.

* **Owner** --- The back-office user responsible for the order.
* **Payment Status** --- Whether the order is already paid in full, the payment for the order is authorized, etc.
* **Payment Method** --- The payment method selected to pay for the order.
* **Shipping Method** --- The shipping method selected for the order delivery.
* **Source Document** --- If the order has been created from an RFQ, quote, or another order, this field contains a link to the corresponding record. If the order has been created from scratch (in the back-office) or the quick order form (in the storefront), the field shows 'N/A'.
* **Discount** --- The total of all discounts applied to the order.
* **Created At** --- The date and time the order was created.
* **Created By** --- The name of the user who created an order on behalf of a customer user, either via the back-office or :ref:`customer user impersonation <user-guide--customers--customer-user-impersonate>` in the storefront.
* **Updated At** --- The date and time when the order was last updated.
* **Payment Term** --- The terms and conditions for order payment. For more information, see :ref:`Payment Terms Integration <sys--integrations--manage-integrations--payment-term>`.
* **Warehouse** --- The warehouse from which the goods are shipped.

.. hint::

   To manage the columns displayed within the grid, click |IcConfig| on the right of the grid and select the information you wish to be displayed.

   To handle the significant volume of data, use the page switcher, increase the 'view per page' value, or use |IcFilter| filters to narrow down the list to the needed information.

   .. For more information on configuring visible fields, the number of items per page, etc., see the :ref:`Grids <doc-grids>` topic.

At the top right, you can see the name of the view. The views are defined by default:

* Open Orders --- Shows only orders with the status 'Open'.
* All Orders --- Shows all existing orders regardless of their statuses.

To change the view, click the drop-down next to the view name and select the required view.

.. image:: /user/img/sales/orders/orders_views.png
   :alt: Required view options available in the dropdown next to the view name

You can also create and save new views for future use.

.. _user-guide--sales--orders--edit:

Edit Order Details
------------------

To edit an order:

#. Navigate to **Sales > Orders** in the main menu.
#. Choose an order in the list, hover over the |IcMore| **More Options** menu to the right of the item, and click |IcEdit| to start editing its details.

   Alternatively, click the order to open its details. On the order details page, click the **Edit** button on the top right.

#. Update the required information. See :ref:`Create an Order from Scratch <user-guide--sales--orders--create>` and :ref:`Manage Promotions in Orders <user-guide--sales--orders--promotions>` topics for detailed information on the available options.

   If the order contains :ref:`product kit(s) <products--products--create-product-kit>`, you can add items that qualify for it to the order.

#. Click **Save** on the top right of the page.

.. _user-guide--sales--orders--reorder:

Re-Order
--------

If the order does not have sub-orders, it can be re-ordered.

To re-order an existing order:

#. Navigate to **Sales > Orders** in the main menu.
#. Choose an order in the list, hover over the |IcMore| **More Options** menu to the right of the item, and click **Re-order** to start a new order from the existing one.

   Alternatively, click the order to open its details. On the order details page, click the **Re-order** button on the top right.

#. Update the required information. See :ref:`Create an Order from Scratch <user-guide--sales--orders--create>` and :ref:`Manage Promotions in Orders <user-guide--sales--orders--promotions>` topics for detailed information on the available options.

#. Click **Save** on the top right of the page.

.. _doc--orders--actions--delete:

Delete an Order
---------------

.. _doc--orders--actions--delete--fromgrid:

Delete an Order from the Order Grid
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

1. In the main menu, navigate to **Sales > Orders**.
2. Select the order you need to delete, click the |IcMore| **More Options** menu at the end of the row, and then click the |Trash-SVG| **Delete** icon.
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

2. Select the checkboxes in front of the orders you need to delete, click the |IcMore| **More Options** menu at the end of the list header, and then click |Trash-SVG| **Delete**.

   .. tip::
      To select a bulk of items quickly, click |IcSortDesc| next to the checkbox at the beginning of the table header and then select one of the following options:

      * *All* --- Select all orders.
      * *All Visible* --- Select only orders that are visible on the page now.

      To clear the selection, select *None*.

3. In the confirmation dialog, click **Yes, Delete**.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

Move an Order Through Its Lifecycle
===================================

From the order view page, you can control the order lifecycle, cancel or close orders, mark orders as shipped, and archive the old ones.

.. _doc--orders--actions--cancel:

Cancel an Order
---------------

.. important:: This operation is available only for orders with status *Open*.

There are many circumstances in which you may need to cancel the order. For example, the order has expired, or your organization cannot fulfill the order for any reason, or the buyer asked you to do so.

To cancel an order:

1. In the main menu, navigate to **Sales > Orders**.
#. Choose the order in the list and click it. The order details page opens.
#. Click the **Cancel** button on the top right of the page.

The order :ref:`internal status <doc--orders--statuses--internal>` becomes *Cancelled*.

.. hint:: The orders can be canceled automatically upon expiration. For this, an administrator must enable the corresponding functionality in the :ref:`order automation configuration settings <configuration--commerce--orders>`.

After the order has been canceled for some time and does not require any further actions, you may wish to :ref:`close <doc--orders--actions--close>` it.

.. _doc--orders--actions--close:

Close an Order
--------------

.. important:: This operation is available only for orders with status *Open*, *Cancelled*, and *Shipped*.

After an order has been successfully delivered, has been canceled for
 some time, etc., and does not require any further actions from any party, you may wish to close it, thus indicating that all your obligations regarding the order are fulfilled.

To close an order:

1. In the main menu, navigate to **Sales > Orders**.
#. Choose the order in the list and click it. The order details page opens.
#. Click the **Close** button on the top right of the page.

The order :ref:`internal status <doc--orders--statuses--internal>` becomes *Closed*.

After you make sure that no further actions with the order will be required (the buyer is not going to send a return request, etc.), you can :ref:`archive <doc--orders--actions--archive>` the closed order. Archived orders are old orders stored for historical purposes only.

.. _doc--orders--actions--mark-shipped:

Mark an Order as Shipped
------------------------

.. important:: This operation is available only for orders with status *Open*.

To indicate that the order has been shipped to the customer:

1. In the main menu, navigate to **Sales > Orders**.
#. Choose the order in the list and click it. The order details page opens.
#. Click the **Mark as Shipped** button on the top right of the page.

The order :ref:`internal status <doc--orders--statuses--internal>` becomes *Shipped*.

After the order is delivered and does not require any further actions, you may wish to :ref:`close <doc--orders--actions--close>` it.

.. _doc--orders--actions--archive:

Archive an Order
----------------

.. important:: This operation is available only for orders with status *Closed*.

After you make sure that no further actions with an order are required (the buyer is not going to send a return request, etc.), you can archive the closed order. Archived orders are old orders stored for historical purposes only.

To archive an order:

1. In the main menu, navigate to **Sales > Orders**.
#. Filter the order list by internal status to show only closed orders.
#. Choose the order you want to archive in the filtered list and click it. The order details page opens.
#. Click the **Archive** button on the top right of the page.

The order :ref:`internal status <doc--orders--statuses--internal>` becomes *Archived*.

**Related Articles**

:ref:`Add a Shipping Tracking Number to the Order <user-guide--shipping-order>`
:ref:`View Order Internal Statuses <doc--orders--statuses--internal>`


.. toctree::
   :hidden:

   view
   statuses
.. _doc--orders--actions--close:

Close an Order
==============

.. important:: This operation is available only for orders with status *Open*, *Cancelled*, and *Shipped*.

After an order has been successfully delivered, has been canceled for
 some time, etc., and does not require any further actions from any party, you may wish to close it, thus indicating that all your obligations regarding the order are fulfilled.

To close an order:

1. In the main menu, navigate to **Sales > Orders**.
#. Choose the order in the list and click it. The order details page opens.
#. Click the **Close** button on the top right of the page.

The order :ref:`internal status <doc--orders--statuses--internal>` becomes *Closed*.

After you make sure that no further actions with the order will be required (the buyer is not going to send a return request, etc.), you can :ref:`archive <doc--orders--actions--archive>` the closed order. Archived orders are old orders stored for historical purposes only.
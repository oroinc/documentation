.. _doc--orders--actions--cancel:

Cancel an Order
===============

.. important:: This operation is available only for orders with status *Open*.

There are many circumstances in which you may need to cancel the order. For example, the order has expired, or your organization cannot fulfill the order for any reason, or the buyer asked you to do so.

To cancel an order:

1. In the main menu, navigate to **Sales > Orders**.
#. Choose the order in the list and click it. The order details page opens.
#. Click the **Cancel** button on the top right of the page.

The order :ref:`internal status <doc--orders--statuses--internal>` becomes *Cancelled*.

.. hint:: The orders can be canceled automatically upon expiration. For this, an administrator must enable the corresponding functionality in the :ref:`order automation configuration settings <configuration--commerce--orders>`.


After the order has been canceled for some time and does not require any further actions, you may wish to :ref:`close <doc--orders--actions--close>` it.


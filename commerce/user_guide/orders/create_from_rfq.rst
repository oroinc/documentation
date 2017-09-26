.. _user-guide--sales--orders--create--from-rfq:

.. begin

Create an Order from an RFQ
^^^^^^^^^^^^^^^^^^^^^^^^^^^

To create an order based on a request for quote (RFQ):

1. Navigate to **Sales > Requests for Quote** in the main menu.
2. Open the selected RFQ from the grid.
3. Click **Create Order** in the top right corner of the RFQ page.


   .. image:: /user_guide/img/sales/orders/CreateOrderFromRFQ.png
      :class: with-border

   The Create Order form will open, prepopulated with the information from the RFQ:

   .. image:: /user_guide/img/sales/orders/orders_create_fromrfq1.png
      :class: with-border

4. Amend or add new details to the order, if necessary, as described in :ref:`the Create an Order from Scratch topic <user-guide--sales--orders--create>`.

   .. warning:: When you modify the order content, order totals and shipping costs may change. Please, review the shipping method selection before saving the order to make sure that the shipping cost is acceptable.

5. Click **Save** when you have finished.
   



.. image:: /user_guide/img/sales/orders/orders_create_fromrfq2.png


The new order is now created.

.. hint:: By default, an order has :ref:`internal status <doc--orders--statuses--internal>` *Open* upon creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.

.. finish
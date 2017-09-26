.. _user-guide--sales--orders--create--from-shopping-lists:

.. begin


Create an Order from a Shopping List 
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Any time a customer creates a new shopping list, it can be accessed in the management console.  This is helpful if a customer needs assistance finding particular items or with creating an order.

.. hint:: See a short demo on `creating orders from the shopping list <https://www.orocommerce.com/media-library/create-order-shopping-list#play=w7NXMifQZnI>`_ or keep reading for step-by-step guidance.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/w7NXMifQZnI" frameborder="0" allowfullscreen></iframe>


To create an order from a shopping list:

1. Navigate to **Sales > Shopping lists** in the main menu.
2. Open the selected shopping list from the grid.
3. Click **Create Order** in the top right corner of the page.
   
   .. image:: /user_guide/img/sales/orders/CreateOrderFormSL.png
      :class: with-border

4. The Create Order form will open, prepopulated with the information from the shopping list:

   Amend or add new details to the order, if necessary, as described in :ref:`the Create an Order from Scratch topic <user-guide--sales--orders--create>`.

   .. image:: /user_guide/img/sales/orders/orders_create_fromshoppinglist1.png

   .. warning:: When you modify the order content, order totals and shipping costs may change. Please, review the shipping method selection before saving the order to make sure that the shipping cost is acceptable.

5. Click **Save** when you are done.
   
   .. image:: /user_guide/img/sales/orders/orders_create_fromshoppinglist2.png


The new order is now created.

.. hint:: By default, an order has :ref:`internal status <doc--orders--statuses--internal>` *Open* upon creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.

.. finish
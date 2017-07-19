:orphan:


.. _user-guide--marketing--promotions--edit--in-order:

Manage Promotions in Orders
---------------------------

.. begin

There are cases when an order needs to be amended by the manager, for instance when some of the ordered items turned out to be out of stock. If promotions applied to such order, the manager may decide to keep discounts, or recalculate them depending on circumstances. For such cases, it is possible to save order with or without discount recalculation following the change in items quantity.

To demonstrate how this works, we will amend the details of the following placed order:

.. csv-table:: Order #8
   :header: "SKU", "Name", "Quantity", "Product Unit", "Price"
   :widths: 15, 30, 10, 15, 20

   "2TK59","500-Lumen Portable Suspended Work Lamp","2","item","$15.99"
   "6UK81","Hardhat with 300 Lumen LED Light","2","item","$47.99"
   "8TF72","Industrial 310 Lumen LED Headlamp","9","item","$36.79"
   "8VS71","White Bookshelf, 35 x 77 in.","10","item","$151.99"


In compliance with the active promotion, customers will have 20% off all orders.

Currently, the subtotal for this order  is **$2,738.92** with a **$547.78** discount.


 .. image:: /user_guide/img/marketing/promotions/NewDicountInOrder.png

Let us suppose that there are only 10 white bookshelves in the warehouse, and you have no means of ordering the missing 5 soon. Having communicated this to the customer, you decided to keep the existing discount to compensate for the issue with the order.

To amend the order without discount recalculation, you:

1. Click **Edit** in the top right corner of the order page.
2. In the **Line Items** section, you change the quantity of bookshelves from 15 to 10.
3. Click **Save without Discounts Recalculation** in the top right corner.

   .. image:: /user_guide/img/marketing/promotions/NewDicountInOrder2.png

5. In the edited order, you see that the discount is still $547.78, although the subtotal has changed from $2,738.92 to $1,978.97.

 .. image:: /user_guide/img/marketing/promotions/NewDicountInOrder4.png

.. note:: Had you saved the order by clicking **Save** or **Save and Close**, the discount would be recalculated and equalled $395.79 according to the terms of the promotion.

          .. image:: /user_guide/img/marketing/promotions/NewDicountInOrder3.png

.. finish

.. include:: /user_guide/include_images.rst
   :start-after: begin
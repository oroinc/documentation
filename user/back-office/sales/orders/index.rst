:oro_documentation_types: OroCommerce

.. _user-guide--sales--orders:

Orders 
======

:term:`Orders <Order>` contain information about buyers' shopping lists submitted for purchase and the collected information about billing and shipping addresses, payment methods, etc.

In **Sales > Orders**, you can view, edit and delete the already submitted orders and create new orders on behalf of the buyers.

While many customers will use the online store to create orders, they can also come from other avenues such as phone calls, emails, contact us requests or from other sales channels. An Oro application makes it easy to create an order for customers in the back-office. When creating or editing an order, you can create new customers or new customer users on the fly, configure shipping options, add discounts, and more.

Create Orders
-------------

You can create a new order in the following ways:

* :ref:`From scratch <user-guide--sales--orders--create>`
* :ref:`Based on shopping lists <user-guide--sales--orders--create--from-shopping-lists>`
* :ref:`Based on requests for quotes <user-guide--sales--orders--create--from-rfq>`

Manage Existing Orders
----------------------

For existing orders, you can:

* :ref:`View them all in the order grid <user-guide--sales--orders--viewlist>`
* :ref:`View information for an individual order <user-guide--sales--orders--view>`
* :ref:`Edit order details <user-guide--sales--orders--edit>`
* :ref:`Delete orders <doc--orders--actions--delete>`

You can also :ref:`attach files to an order <user-guide-activities-attachments>`, :ref:`make notes <user-guide-add-note>`, :ref:`create events <doc-activities-events>`, or :ref:`send emails <user-guide-using-emails>` related to the order.

Use Promotions for Orders
-------------------------

When running sales promotions:

* :ref:`Apply coupon codes to an order <user-guide--marketing--promotions--coupons--edit--on-order-page>`
* :ref:`Add special discounts to an order <user-guide--sales--orders--promotions--add-special-discount>`
* :ref:`Manage order promotions, coupons <user-guide--marketing--promotions--coupons--edit--manage-when-editing-an-order>`, and special discounts when you edit an order.

Move an Order Through Its Lifecycle
-----------------------------------

You can control the order lifecycle and:

* :ref:`Cancel orders <doc--orders--actions--cancel>`
* :ref:`Mark orders as shipped <doc--orders--actions--mark-shipped>` and :ref:`track order shipping <user-guide--shipping-order>`
* :ref:`Close orders that lost relevance <doc--orders--actions--close>`
* :ref:`Archive old orders <doc--orders--actions--archive>`


.. include:: /include/include-images.rst
   :start-after: begin

.. toctree::
   :hidden:
   :maxdepth: 1

   create
   view
   manage
   control
   track-order
   statuses

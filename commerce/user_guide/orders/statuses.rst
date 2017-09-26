:orphan:

.. _doc--orders--statuses--internal:

Order Internal Statuses
=======================

An internal status is a status visible only in the management console.

An order can have the following internal statuses:

    * *Open* --- The order has been submitted and is being processed. You can :ref:`cancel <doc--orders--actions--cancel>`, :ref:`mark as shipped <doc--orders--actions--mark-shipped>`, and :ref:`close <doc--orders--actions--close>` an open order.
    * *Cancelled* --- The order that has been submitted but successively canceled. There are many circumstances in which you may need to cancel the order. For example, the order has expired, or your organization cannot fulfill the order for any reasons, or the buyer asked you to do so. The submitted order may be canceled by an administrator or automatically when its 'do not ship later than' date is passed.

      You can :ref:`close a canceled order <doc--orders--actions--close>`.

      .. hint:: For orders to be automatically canceled upon expiration, an administrator must enable the corresponding functionality in the :ref:`order automation configuration settings <configuration--commerce--orders>`.

    * *Shipped* --- The order is on the way or delivered to the buyer. You can :ref:`close a shipped order <doc--orders--actions--close>`.
    * *Closed* --- The order does not require any further actions: has been successfully delivered, or canceled for some time, etc. You can :ref:`archive a closed order <doc--orders--actions--archive>`.
    * *Archived* -- An old order stored for historical purposes only. No further actions with the order are required (the buyer is not going to send a return request, etc.).

.. hint:: By default, an order has internal status *Open* upon creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.
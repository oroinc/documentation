.. _doc--orders--statuses--internal:

View Order Internal Statuses
============================

An internal status is a status managed only in the back-office.

An order can have the following internal statuses:

    * *Open* --- The order has been submitted and is being processed. You can :ref:`cancel <doc--orders--actions--cancel>` and :ref:`close <doc--orders--actions--close>` an open order.
    * *Canceled* --- The order that has been submitted but successively canceled. There are many circumstances in which you may need to cancel the order. For example, if the order has expired, your organization cannot fulfill the order for any reason, or the buyer asked you to do so. An administrator may cancel the submitted order or automatically when its Do Not Ship Later Than date is passed.

      You can :ref:`close a canceled order <doc--orders--actions--close>`.

      .. hint:: For orders to be automatically canceled upon expiration, an administrator must enable the corresponding functionality in the :ref:`order automation configuration settings <configuration--commerce--orders>`.

    * *Closed* --- The order does not require any further actions: it has been successfully delivered, canceled for some time, etc.

.. hint:: By default, an order has the internal status *Open* on creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.

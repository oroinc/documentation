.. _doc--payment--checkout:


View Payments at Checkout
=========================

After the integration is complete, the customer user may select one of the payment methods that are shown after the connectivity check and payment rules evaluation.

PayPal Payflow Gateway and Express Checkout
-------------------------------------------

.. image:: /user/img/system/integrations/checkout/checkout_payflow_gateway_vs_express.png

.. note:: If the order total is zero, the PayPal Payment method will be hidden and unavailable for selection.

PayPal Payments Pro and Express Checkout
----------------------------------------

.. image:: /user/img/system/integrations/checkout/checkout_payments_pro_vs_express.png

.. note:: If the order total is zero, the PayPal Payment method will be hidden and unavailable for selection.


Authorize.Net
-------------

.. warning:: For security reason, the Authorize.Net payment option appears only when a buyer access your OroCommerce site via the https protocol.

.. image:: /user/img/system/integrations/checkout/checkout_authorizenet.png

Apruve Checkout
---------------

To checkout with Apruve, make sure you have registered the account in the Apruve system (see more details on how to create either *Shopper* or *Merchant* account in the :ref:`Prerequisites for Apruve Services Integration <user-guide--payment--prerequisites--apruve>` topic).

Once a customer selects the Apruve payment method for their order, they are asked to log into their Apruve corporate account to authorize this payment.

.. image:: /user/img/system/integrations/checkout/checkout_apruve_1.png

In the Apruve account, under the *Shopper* role, the customer can view their order details by navigating to **Orders** menu on the left and selecting the corresponding order.

.. image:: /user/img/system/integrations/checkout/checkout_apruve_4.png

Before the customer proceeds with the payment, the sales representatives should invoice them via the back-office by clicking **Send Invoice** and confirm to charge the customer.

.. image:: /user/img/system/integrations/checkout/checkout_apruve_5.png

.. image:: /user/img/system/integrations/checkout/checkout_apruve_6.png

.. image:: /user/img/system/integrations/checkout/checkout_apruve_7.png

Upon receiving the invoice with the link to the Apruve system for further payment, the customer should then log into their Apruve account and pay this invoice by clicking **Pay** on the far right.

 .. image:: /user/img/system/integrations/checkout/checkout_apruve_8.png
    :width: 70%

 .. image:: /user/img/system/integrations/checkout/checkout_apruve_9.png

Once the payment is made, the customer receives the notification email to view the payment details.

.. important::
   A customer is paying the invoice on the terms you set (e.g. net 30, net 60), but Apruve is paying you within 24 hours for any invoice that is generated through the back-office.

.. image:: /user/img/system/integrations/checkout/checkout_apruve_10.png

.. include:: /include/include-links-user.rst
   :start-after: begin

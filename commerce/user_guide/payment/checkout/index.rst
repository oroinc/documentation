.. _doc--payment--checkout:

Checkout: Payment
-----------------

.. contents:: :local:

After the integration is complete, the customer user may select one of the payment methods that are shown after the connectivity check and payment rules evaluation.

PayPal Payflow Gateway with no CVV Required
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. image:: /user_guide/img/payment/checkout/checkout_payments_pro_no_cvv.png
   :width: 400px

PayPal Payments Pro with Require CVV Entry Enabled
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. image:: /user_guide/img/payment/checkout/checkout_payments_pro_cvv.png
   :width: 400px

PayPal Payments Pro Express Checkout
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. Express Checkout is a part of the payment method name (PayPal Payments Pro Express Checkout). Unintentionally, it is forced to duplicate the parent header. Other payment methods do not have to follow this style.

.. image:: /user_guide/img/payment/checkout/checkout_payments_pro_express.png
   :width: 400px

PayPal Payments Express Checkout
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. image:: /user_guide/img/payment/checkout/checkout_paypal_express.png

.. note:: Before you can use PayPal Express in OroCommerce, :ref:`install <cookbook-extensions-composer>` the `Oro PayPal Express Integration <https://packagist.oroinc.com/#oro/paypal-express>`_ package.

Authorize.Net
^^^^^^^^^^^^^

.. warning:: For security reason, the Authorize.Net payment option appears only when a buyer access your OroCommerce site via the https protocol.

.. image:: /user_guide/img/payment/checkout/checkout_authorizenet.png

.. InfinitePay Checkout
.. ~~~~~~~~~~~~~~~~~~~~

.. .. image:: /user_guide/img/payment/checkout/checkout_infinitepay.png

.. email 

.. Legal form: AG, eG. EK, e.V., Freelancer, GbR, GmbH, GmbH iG, GmbH & Co. KG

.. special order # (matches InfinitePay one)

.. paid in full

.. _doc--payment--checkout-wirecard:

.. _doc--payment--checkout-wirecard-card:

Wirecard Credit Card
^^^^^^^^^^^^^^^^^^^^

.. image:: /user_guide/img/payment/checkout/checkout_wirecard_card.png

.. _doc--payment--checkout-wirecard-paypal:

Wirecard PayPal
^^^^^^^^^^^^^^^

.. image:: /user_guide/img/payment/checkout/checkout_wirecard_paypal.png

.. _doc--payment--checkout-wirecard-sepa:

Wirecard SEPA Direct Debit
^^^^^^^^^^^^^^^^^^^^^^^^^^

.. image:: /user_guide/img/payment/checkout/checkout_wirecard_sepa.png

Apruve Checkout
^^^^^^^^^^^^^^^

To checkout with Apruve, make sure you have registered the account in the Apruve system (see more details on how to create either *Shopper* or *Merchant* account in the :ref:`Prerequisites for Apruve Services Integration <user-guide--payment--prerequisites--apruve>` topic).

Once a customer selects the Apruve payment method for their order, they are asked to log into their Apruve corporate account to authorize this payment.

.. image:: /user_guide/img/payment/checkout/checkout_apruve_1.png

.. image:: /user_guide/img/payment/checkout/checkout_apruve_2.png

.. image:: /user_guide/img/payment/checkout/checkout_apruve_3.png

In the Apruve account, under the *Shopper* role, the customer can view their order details by navigating to **Orders** menu on the left and selecting the corresponding order.

.. image:: /user_guide/img/payment/checkout/checkout_apruve_4.png

Before the customer proceeds with the payment, the sales representatives should invoice them via the management console by clicking **Send Invoice** and confirm to charge the customer.

.. image:: /user_guide/img/payment/checkout/checkout_apruve_5.png

.. image:: /user_guide/img/payment/checkout/checkout_apruve_6.png

.. image:: /user_guide/img/payment/checkout/checkout_apruve_7.png

Upon receiving the invoice with the link to the Apruve system for further payment, the customer should then log into their Apruve account and pay this invoice by clicking **Pay** on the far right.

 .. image:: /user_guide/img/payment/checkout/checkout_apruve_8.png
    :width: 70%

 .. image:: /user_guide/img/payment/checkout/checkout_apruve_9.png

Once the payment is made, the customer receives the notification email to view the payment details.

.. important::
   A customer is paying the invoice on the terms you set (e.g. net 30, net 60), but Apruve is paying you within 24 hours for any invoice that is generated through the management console.

.. image:: /user_guide/img/payment/checkout/checkout_apruve_10.png

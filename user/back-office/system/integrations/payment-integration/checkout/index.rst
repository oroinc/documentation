.. _doc--payment--checkout:


View Payments at Checkout
=========================

After the integration is complete, the customer user may select one of the payment methods that are shown after the connectivity check and payment rules evaluation.

PayPal Payflow Gateway with No CVV Required
--------------------------------------------

.. image:: /user/img/system/integrations/checkout/checkout_payments_pro_no_cvv.png
   :width: 400px

.. note:: If the order total is zero, the PayPal Payment method will be hidden and unavailable for selection.

PayPal Payments Pro with Require CVV Entry Enabled
--------------------------------------------------

.. image:: /user/img/system/integrations/checkout/checkout_payments_pro_cvv.png
   :width: 400px

.. note:: If the order total is zero, the PayPal Payment method will be hidden and unavailable for selection.


PayPal Payments Pro Express Checkout
------------------------------------

.. Express Checkout is part of the payment method name (PayPal Payments Pro Express Checkout). Unintentionally, it is forced to duplicate the parent header. Other payment methods do not have to follow this style.

.. image:: /user/img/system/integrations/checkout/checkout_payments_pro_express.png
   :width: 400px

.. note:: If the order total is zero, the PayPal Payment method will be hidden and unavailable for selection.


PayPal Payments Express Checkout
--------------------------------

.. image:: /user/img/system/integrations/checkout/checkout_paypal_express.png

.. note:: Before you can use PayPal Express in OroCommerce, :ref:`install <cookbook-extensions-composer>` the |Oro PayPal Express Integration| package.

.. note:: If the order total is zero, the PayPal Payment method will be hidden and unavailable for selection.


Authorize.Net
-------------

.. warning:: For security reason, the Authorize.Net payment option appears only when a buyer access your OroCommerce site via the https protocol.

.. image:: /user/img/system/integrations/checkout/checkout_authorizenet.png


.. include:: /include/include-links-user.rst
   :start-after: begin

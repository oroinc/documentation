:oro_documentation_types: OroCommerce

.. _user-guide--payment--configuration--payment-method-integration--payment-actions:

Payment Actions
"""""""""""""""

.. begin

Payment action parameters are configured per payment method. Available options are similar for all payment methods and include the following options:

* Authorize
* Authorize and Charge

In **Payment Action**, you select the strategy for the payment processing on the checkout.

.. Validation, authorization and payment capture transactions may be sent after payment information entry and upon the order submission.

**Payment Transactions for Authorize**

.. note:: When the **Authorize** payment action is configured in PayPal integration settings, the buyer is never charged immediately after they submit the order.

After the buyer enters their card details, their payment information is validated.

If **Zero Amount Authorization** is enabled in the PayPal integration settings, the payment may be initially authorized with |zero amount transaction| (account verification).

.. In this case, the response from the payment gateway is securely stored by OroCommerce.

If **Zero Amount Authorization** is disabled in the PayPal integration settings, the card details are stored locally in the buyer's browser until they are used in further transactions for this order or until the buyer leaves the checkout pages (navigate from the page, closed it or cancel the checkout).

.. note::

   OroCommerce server never stores buyer's sensitive payment information (complete card number, expiration date, and cvv code).

   Transaction response from the payment gateway also does not contain sensitive information about buyer's card. It serves as an identifier of the initial authorization that is solely handled by the payment gateway.

After the buyer submits the order on the Order Review step, the total purchase amount may be put on hold (temporarily blocked) on their account to guarantee that they have enough funds to finalize the purchase.

.. note:: If **Zero Amount Authorization** is enabled and **Authorization for Required Amount** is disabled in PayPal integration settings, the total purchase amount will NOT be blocked in the buyer's account.


**Payment Transactions for Authorize and Charge**

.. note:: When the **Authorize and Charge** payment action is configured in PayPal integration settings, the buyer is charged immediately after they submit the order.

After the buyer enters their card details, their payment information is validated.

If **Zero Amount Authorization** is enabled in the PayPal integration settings, the payment may be initially authorized with zero amount transaction.

If **Zero Amount Authorization** is disabled in the PayPal integration settings, the card details are stored locally in the buyer's browser and are used in further transactions for this order.

.. note::

   OroCommerce server never stores buyer's payment information (complete card number, expiration date, and cvv code).

   Transaction response from the payment gateway does not contain any information about buyer's card. It serves as an identifier of the initial authorization that is solely handled by the payment gateway.

After the buyer submits the order on the Order Review step, the total purchase amount is captured from their account. This is executed as another transaction.


.. include:: /include/include-links-user.rst
   :start-after: begin
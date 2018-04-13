.. _user-guide--payment--configuration--payment-method-integration--infinitepay-payment-actions:

Guarantee Actions
"""""""""""""""""

.. begin

Depending on the way InfinitePay integration parameters are configured, the following InfinitePay transaction(s) may happen when the order is submitted using the InfinitePay payment method:

* **Reserve** --- the buyer's identity and credit worthiness is verified by InfinitePay. This acts as basic validation of the future payment and happens for every order where InfinitePay is selected as a payment method.
* **Capture** --- confirms the order submission, automatically transfers the order to Financial Management Solutions where the buyer's InfinitePay guaranteed limit is adjusted by deducting the reserved amount. When the **Auto-Capture** is *enabled*, this transaction happens for every order submitted via InfinitePay.
* **Activate** --- as a result of payment activation step, InfinitePay guarantees or denies the payment based on the payment due date and shipping information. When **Auto-Activation** is *enabled*, this transaction happens for every order submitted via InfinitePay.

  .. note:: When InfinitePay denies the activation, to unblock the debtor limit, the order needs to be cancelled manually via the InfinitePay portal.

.. finish
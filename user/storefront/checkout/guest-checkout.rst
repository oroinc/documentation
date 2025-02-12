:oro_show_local_toc: false

.. _frontstore-guide--orders-checkout--guest:

Navigate through Guest Checkout in the Storefront
=================================================

.. hint:: This section is part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides a general understanding of single-page and multi-page checkout concepts.

In the Oro storefront, :ref:`guest customers <sys--conf--commerce--guest>` can place orders similarly to registered users, if guest access is enabled and configured in the :ref:`back-office <configuration--guide--commerce--configuration--sales>`. They are, however, limited to just one shopping list.

Unauthenticated customers can proceed to the checkout through:

* Guest Quick Order Forms
* Guest Shopping Lists

At the checkout, guest customers can:

* Login if they have forgotten to do this before placing items in the shopping list
* Create an account

.. _frontstore-guide--orders-checkout--sample--guest:

.. begin_sample_checkout

Sample Guest Checkout
---------------------

As an illustration, let us follow the steps of the checkout as an unauthenticated user. The following example has registration options available at the checkout. However, please keep in mind, that your website configuration may be different and registration options may be unavailable.

1. Add selected items to the shopping list.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout1.png

2. Navigate to **Shopping List** on the top right of the page, and click **Checkout**.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout2.png

#. The following options are available on the page that opens:

    .. image:: /user/img/storefront/orders/SampleGuestCheckout5.png

   * Log in
   * Proceed to Guest Checkout
   * Create an Account and Continue

#. Click **Proceed to Guest Checkout**.

   .. note:: You can also register during later during the order review.

#. Fill in the billing and shipping information, as well as select the shipping method and provide payment details.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout8.png

#. At the **Order Review** step, you can save the provided details and create an account.

   As **Save my data and create an account** is enabled, you can provide your credentials for a quick registration:

   * Enter your email address.
   * Enter password.
   * Reenter password for confirmation.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout9.png

#. Click **Submit Order**.

#. To complete registration, open your mailbox and check the registration confirmation email.


**Related Articles**

* :ref:`Guest Functions Concept Guide <sys--conf--commerce--guest>`
* :ref:`Enable Global Guest Access in the Back-Office <configuration--guide--commerce--configuration--guests>`
* :ref:`Configure Guest Quick Order Form in the Back-Office <user-guide--system-configuration--commerce-sales--quick-order-form>`
* :ref:`Configure Guest Quotes in the Back-Office <sys--conf--commerce--guest--enable--guest_quotes>`

.. finish_sample_checkout
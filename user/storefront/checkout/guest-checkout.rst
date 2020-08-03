:oro_show_local_toc: false

.. _frontstore-guide--orders-checkout--guest:

Navigate through Guest Checkout in the Storefront
=================================================


.. hint:: This section is a part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides the general understanding of single-page and multi-page checkout concepts.

In the Oro storefront, :ref:`guest customers <sys--conf--commerce--guest>` can place orders similarly to registered users. They are, however, limited to just one shopping list.

Unauthenticated customers can proceed to the checkout through:

* Guest Quick Order Forms
* Guest Shopping Lists

At the checkout, guest customers can:

* Login if they have forgotten to do this before placing items in the shopping list.
* Create an account.

.. _frontstore-guide--orders-checkout--sample--guest:

.. begin_sample_checkout

Sample Guest Checkout
---------------------

As an illustration, let us follow the steps of the checkout as an unauthenticated user. The following example has registration options available at the checkout. However, please keep in mind, that your website configuration may be different and registration options may be unavailable.


1. Add selected items to the shopping list.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout1.png

2. Navigate to **Shopping List** on the top right of the page, and click **View Details**.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout2.png

3. Click **Create Order** at the bottom of the shopping list page.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout3.png

4. The following options are available on the page that opens:

   * Sign in

     .. image:: /user/img/storefront/orders/SampleGuestCheckout5.png

   * Create and Account

     .. image:: /user/img/storefront/orders/SampleGuestCheckout6.png

   * Forgot Your Password

     .. image:: /user/img/storefront/orders/SampleGuestCheckout7.png

   * Continue as a Guest

     .. image:: /user/img/storefront/orders/SampleGuestCheckout4.png


5. Click **Continue as a Guest**.

   .. note:: You will have another chance to register during order review.

6. Fill in the billing and shipping information, as well as select the shipping method and provide payment details.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout8.png

7. At the **Order Review** step, the following options are enabled by default:

   * Delete this shopping list after submitting the order.
   * Save my data and create an account.

   As **Save my data and create an account** is enabled, you can provide your credentials for a quick registration:

   * Enter your email address.
   * Enter password.
   * Reenter password for confirmation.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout9.png

8. Click **Submit Order**.

9. To complete registration, open your mailbox and check the registration confirmation email.

   .. image:: /user/img/storefront/orders/SampleGuestCheckout10.png



.. finish_sample_checkout
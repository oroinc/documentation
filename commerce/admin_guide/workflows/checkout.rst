.. _system--workflows--checkout-workflow:


Checkout Workflow 
=================

.. contents:: :local:
   :depth: 2

Overview
--------

The Checkout workflow represents a standard checkout procedure in the eCommerce environment. It is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a user can go through when creating an order in the storefront.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.

   On the page of all workflows, you can perform the following actions for the Checkout workflow:

   * View the workflow: |IcView|
   * Deactivate / Activate the workflow: |IcDeactivate| / |IcActivate|

   .. image:: /admin_guide/img/workflows/checkout/CheckoutGridBackoffice.png

2. Click **Checkout** to open the flow.

   On the Checkout workflow page, you can perform the following actions:

   * Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.
   * Activate the workflow - click |IcActivate| **Activate** to activate the workflow.

   .. image:: /admin_guide/img/workflows/checkout/CheckoutViewPageBackoffice.png

Steps and Transitions: Illustration
-----------------------------------

As an illustration, we are going to proceed through the steps of the Checkout workflow in the default OroCommerce storefront.

.. start_checkout_sample_0

Several items have been added to a shopping list in the OroCommerce storefront. To proceed to the checkout, click **Create Order** on the bottom right of the shopping list page.
   
|create_order_img|

.. note:: The **Create Order** button is available if the following conditions are met:

  * At least one :ref:`shipping method <user-guide--shipping>` is available
  * At least one :ref:`payment method <user-guide--payment>` is available
  * There is at least one product with a price in the shopping list
  * Items to be purchased are available in the :ref:`inventory <user-guide--inventory>` in the management console
       
A warning message is shown if for some reason you are unable to start the checkout process.

.. finish_checkout_sample_0

.. |create_order_img| image:: /admin_guide/img/workflows/checkout/CreateOrderButton.png
   :alt: Shopping list with option to create order and proceed to checkout

.. check the conditions

Step 1: Agreements
^^^^^^^^^^^^^^^^^^

At the Agreements step, you are required to accept all mandatory consents to process your personal data, if such consents have not been accepted previously. Keep in mind that if you leave the checkout after accepting a mandatory consent, this consent is considered accepted and can be revoked only through the :ref:`profile management <frontstore-guide--profile-consents--revoke>`.

  .. image:: /admin_guide/img/workflows/checkout_with_consents/storefront_step_agreements.png
     :alt: The first step of the checkout is agreements where you are required to accept any available mandatory consents

  .. image:: /admin_guide/img/workflows/checkout_with_consents/storefront_step_accept_agreement.png
     :alt: Accept a mandatory consent on the agreements step at checkout

Once the consent is accepted, click **Continue** to proceed with the checkout.

Step 2: Billing Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^
   
.. start_checkout_sample_1

The checkout is now open. The next step is to enter billing information for the order by selecting an existing address from the address book, or creating a new one.
 
Checking **Ship to this address** allows you to use the provided billing address as shipping.

Clicking **Continue** redirects you to the next step.

.. note:: You can edit *the already provided* information (until the order is submitted) by clicking |IcEditInline| on the left side of the page.

.. finish_checkout_sample_1

.. image:: /admin_guide/img/workflows/checkout/Checkout_BilInfo.png
   :alt: The billing information step at the checkout (with consents)

Step 3: Shipping Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. start_checkout_sample_2

If the **Ship to this address** box has been checked at the Billing Information step, the provided address is automatically selected at the Shipping Information step.
   
To edit shipping information, clear the **Use billing address** box and provide a different shipping address for the order.

.. finish_checkout_sample_2

.. image:: /admin_guide/img/workflows/checkout/UseBillingAddressBox.png

Step 4: Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^

.. start_checkout_sample_3

Provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.

.. finish_checkout_sample_3

.. image:: /admin_guide/img/workflows/checkout/Shipping_Info.png
   :alt: The shipping method step at the checkout

Step 5: Payment
^^^^^^^^^^^^^^^

.. start_checkout_sample_4

Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.

.. finish_checkout_sample_4

.. image:: /admin_guide/img/workflows/checkout/Payment.png
   :alt: The payment method step at the checkout

Step 6: Order Review
^^^^^^^^^^^^^^^^^^^^

.. start_checkout_sample_5

.. start_checkout_sample_alt5

Once all the necessary information has been provided, you can review the order at the **Order Review** step:

* View Options for the order:

  * Do not ship later than
  * PO Number
  * Notes
  * Delete the shopping list
    
* Check quantity, price, subtotal, shipping and total cost
* Edit the Order
* Edit the already provided information by clicking |IcEditInline| on the left side of the page
  
To submit the order, click **Submit Order** at the bottom of the page.

.. finish_checkout_sample_alt5

Once submitted, the order will be received and dealt with by the sales team.

.. finish_checkout_sample_5

.. |order_submitted_img| image:: /admin_guide/img/workflows/checkout/order_received.png
   :alt: The page of the order in the management console, once the order is submitted

.. include:: /img/buttons/include_images.rst
   :start-after: begin
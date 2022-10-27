:oro_documentation_types: OroCRM, OroCommerce

.. _system--workflows--alternative-checkout-workflow:

Configure Alternative Checkout Workflow in the Back-Office
==========================================================

.. note:: The alternative checkout workflow is available as a |demo extension| and should be installed separately.

The Alternative Checkout workflow represents an **example** of the :ref:`checkout workflow <system--workflows--checkout-workflow>` customization. It is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a user can go through when creating an order in the storefront.

In addition to the standard :ref:`checkout steps <system--workflows--checkout-workflow>`, alternative checkout workflow includes request and order approval steps before creating an order. For this workflow, orders with subtotals exceeding the specified value will have to be reviewed and approved by users with the permission to *approve orders that exceed the allowable amount*. By default, the order approval threshold is set to 5000.

.. note:: Please keep in mind that the default alternative checkout is merely an example of an alternative checkout workflow. Enabling it for your customer users in the OroCommerce storefront requires some customization efforts. To test the alternative checkout workflow on the demo website (or locally with installed demo data), you may be required to create an order and approve it under two different demo users: under Marlene S Bradley to create an order that requires manager approval and Nancy Sallee to approve the order as the manager. You can also test the flow under customer users who belong to a customer with ID 4 (customer_id=4).

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.

   Within the Workflows grid, you can perform the following actions for the alternative checkout workflow:

   * Configure order approval threshold: |IcConfig|
   * View the workflow: |IcView|
   * Deactivate the workflow: |IcDeactivate|

   .. image:: /user/img/system/workflows/alternative_checkout/ACF_grid.png

2. Click **Alternative Checkout** to open the flow.

   On the Alternative Checkout workflow page, you can perform the following actions:

   * Configure order approval threshold: |IcConfig| **Configuration**.

     .. image:: /user/img/system/workflows/alternative_checkout/ACF_configuration.png

   * Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.

     .. image:: /user/img/system/workflows/alternative_checkout/ACF_page.png

Steps and Transitions: Illustration
-----------------------------------

As an illustration, we are going to proceed through the steps of the Alternative Checkout workflow in the default OroCommerce storefront.

.. include:: /user/back-office/system/workflows/system-workflows/checkout.rst
   :start-after: start_checkout_sample_0
   :end-before: finish_checkout_sample_0

.. |create_order_img| image:: /user/img/system/workflows/alternative_checkout/ACF_CreateOrderButton.png
   :alt: Shopping list with option to create order and proceed to checkout

.. check the conditions

Step 1: Agreements
^^^^^^^^^^^^^^^^^^

At the Agreements step, you are required to accept all mandatory consents to process your personal data, if such consents have not been accepted previously. Keep in mind that if you leave the checkout after accepting a mandatory consent, this consent is considered accepted and can be revoked only through the :ref:`profile management <frontstore-guide--profile-consents--revoke>`.

  .. image:: /user/img/system/workflows/alternative_checkout/storefront_step_agreements_bluethooth.png
     :alt: The first step of the checkout is agreements where you are required to accept any available mandatory consents

Once the consent is accepted, click **Continue** to proceed through the checkout.

Step 2: Billing Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user/back-office/system/workflows/system-workflows/checkout.rst
   :start-after: start_checkout_sample_1
   :end-before: finish_checkout_sample_1

.. image:: /user/img/system/workflows/alternative_checkout/ACF_CreateBilling.png
   :alt: The billing information step at the checkout (alternative checkout)

Step 3: Shipping Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user/back-office/system/workflows/system-workflows/checkout.rst
   :start-after: start_checkout_sample_2
   :end-before: finish_checkout_sample_2

.. image:: /user/img/system/workflows/alternative_checkout/ACF_CreateShipping.png

Step 4: Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user/back-office/system/workflows/system-workflows/checkout.rst
   :start-after: start_checkout_sample_3
   :end-before: finish_checkout_sample_3

.. image:: /user/img/system/workflows/alternative_checkout/ACF_ShippingMethod.png
   :alt: The shipping method step at the checkout (alternative checkout)

Step 5: Payment
^^^^^^^^^^^^^^^

.. include:: /user/back-office/system/workflows/system-workflows/checkout.rst
   :start-after: start_checkout_sample_4
   :end-before: finish_checkout_sample_4

.. image:: /user/img/system/workflows/alternative_checkout/ACF_Payment.png
   :alt: The payment method step at the checkout (alternative checkout)

Step 6: Order Review
^^^^^^^^^^^^^^^^^^^^

.. include:: /user/back-office/system/workflows/system-workflows/checkout.rst
   :start-after: start_checkout_sample_alt5
   :end-before: finish_checkout_sample_alt5

.. image:: /user/img/system/workflows/alternative_checkout/ACF_OrderReview.png
   :alt: The page of the order in the back-office, once the order is submitted

Step 7: Request Approval
^^^^^^^^^^^^^^^^^^^^^^^^

Since the order amount exceeds the threshold of $5000, manager approval is required to submit the order.

.. image:: /user/img/system/workflows/alternative_checkout/ACF_RequestApproval.png

Order Approval will remain pending until the manager approves it.

.. image:: /user/img/system/workflows/alternative_checkout/ACF_ApprovalPending.png

.. comment: currently alternative checkout wf works with customer users under customer with ID 4

Step 8: Approve Order
^^^^^^^^^^^^^^^^^^^^^

The manager can approve the order by navigating to Orders, selecting the required order and clicking **Approve Order**.
At this point, the manager can submit the order themselves, or let the employee handle the order:

.. image:: /user/img/system/workflows/alternative_checkout/ACF_ApproveOrder.png

Once submitted, the order will be received and dealt with by the sales team.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
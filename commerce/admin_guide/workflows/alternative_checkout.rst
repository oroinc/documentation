.. _system--workflows--alternative-checkout-workflow:

Alternative Checkout Workflow 
=============================

.. contents:: :local:
   :depth: 2

Overview
--------

The Alternative Checkout workflow represents an **example** of the :ref:`checkout workflow <system--workflows--checkout-workflow>` customization. It is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a user can go through when creating an order in the storefront.

In addition to the standard :ref:`checkout steps <system--workflows--checkout-workflow>`, alternative checkout workflow includes request and order approval steps before creating an order. For this workflow, orders with subtotals exceeding the specified value will have to be reviewed and approved by users with the permission to *approve orders that exceed the allowable amount*. By default, the order approval threshold is set to 5000.

.. note:: Please keep in mind that the default alternative checkout is merely an example of an alternative checkout workflow. Enabling it for your customer users on the OroCommerce Storefront requires some customization efforts.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.

   Within the Workflows grid, you can perform the following actions for the alternative checkout workflow:

   * Configure order approval threshold: |IcConfig|
   * View the workflow: |IcView|
   * Deactivate the workflow: |IcDeactivate|

   .. image:: /admin_guide/img/workflows/alternative_checkout/ACF_grid.png

2. Click **Alternative Checkout** to open the flow.
  
   On the Alternative Checkout workflow page, you can perform the following actions:

   * Configure order approval threshold: |IcConfig| **Configuration**.

     .. image:: /admin_guide/img/workflows/alternative_checkout/ACF_configuration.png

   * Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.

     .. image:: /admin_guide/img/workflows/alternative_checkout/ACF_page.png


.. Steps and Transitions ---------------------

.. The following table illustrates the steps and transitions that the alternative checkout workflow consists of:

.. .. csv-table::
  :header: "Step", "Transitions", "Steps Following the Transition"
  :widths: 20, 20, 20


.. .. image:: /admin_guide/img/workflows/alternative_checkout/ACF_table.png
   :align: center

Steps and Transitions: Illustration
-----------------------------------

As an illustration, we are going to proceed through the steps of the Alternative Checkout workflow in the default OroCommerce storefront.

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_0
   :end-before: finish_checkout_sample_0

.. |create_order_img| image:: /admin_guide/img/workflows/alternative_checkout/ACF_CreateOrderButton.png
   :alt: Shopping list with option to create order and proceed to checkout

.. check the conditions

Step 1: Agreements
^^^^^^^^^^^^^^^^^^

At the Agreements step, you are required to accept all mandatory consents to process your personal data, if such consents have not been accepted previously. Keep in mind that if you leave the checkout after accepting a mandatory consent, this consent is considered accepted and can be revoked only through the :ref:`profile management <frontstore-guide--profile-consents--revoke>`.

  .. image:: /admin_guide/img/workflows/alternative_checkout/storefront_step_agreements_bluethooth.png
     :alt: The first step of the checkout is agreements where you are required to accept any available mandatory consents

  .. image:: /admin_guide/img/workflows/alternative_checkout/storefront_step_accept_agreement_bluethooth.png
     :alt: Accept a mandatory consent on the agreements step at checkout

Once the consent is accepted, click **Continue** to proceed through the checkout.

Step 2: Billing Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_1
   :end-before: finish_checkout_sample_1

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_CreateBilling.png
   :alt: The billing information step at the checkout (alternative checkout)

Step 3: Shipping Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^
   
.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_2
   :end-before: finish_checkout_sample_2

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_CreateShipping.png

Step 4: Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^
    
.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_3
   :end-before: finish_checkout_sample_3

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_ShippingMethod.png
   :alt: The shipping method step at the checkout (alternative checkout)

Step 5: Payment
^^^^^^^^^^^^^^^
   
.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_4
   :end-before: finish_checkout_sample_4

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_Payment.png
   :alt: The payment method step at the checkout (alternative checkout)

Step 6: Order Review
^^^^^^^^^^^^^^^^^^^^

.. include:: /admin_guide/workflows/checkout.rst
   :start-after: start_checkout_sample_alt5
   :end-before: finish_checkout_sample_alt5

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_OrderReview.png
   :alt: The page of the order in the management console, once the order is submitted

Step 7: Request Approval
^^^^^^^^^^^^^^^^^^^^^^^^
   
Since the order amount exceeds the threshold of $5000, manager approval is required to submit the order.

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_RequestApproval.png

Order Approval will remain pending until the manager approves it.

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_ApprovalPending.png

.. comment: currently alternative checkout wf works with customer users under customer with ID 4

Step 8: Approve Order
^^^^^^^^^^^^^^^^^^^^^
   
The manager can approve the order by navigating to Orders, selecting the required order and clicking **Approve Order**.

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_ApproveOrder.png

At this point, the manager can submit the order themselves, or let the employee handle the order:

.. image:: /admin_guide/img/workflows/alternative_checkout/ACF_Approved.png

Once submitted, the order will be received and dealt with by the sales team.

.. include:: /img/buttons/include_images.rst
   :start-after: begin

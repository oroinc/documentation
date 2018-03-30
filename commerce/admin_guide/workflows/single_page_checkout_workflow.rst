.. _system--workflows--single-page-checkout:

Single Page Checkout Workflow
=============================

.. contents:: :local:
   :depth: 1

Overview
--------

In your Oro application, you can control the way the checkout is displayed to customers in the storefront. By default, each checkout step is displayed on a new page. However, by activating the Single Page Checkout workflow in the management console, you can make all steps fit one page. This will make the checkout process easier and quicker for customers, since they will be able to see how far along in the checkout they are, and how many fields are left to complete it.


.. image:: /admin_guide/img/workflows/single_page_checkout/SinglePageCheckout.png

To reach the Single Page Checkout workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **Single Page Checkout** to open the flow.

   .. image:: /admin_guide/img/workflows/single_page_checkout/SPCList.png

Within the list of workflows, you can perform the following actions for the Single Page Checkout workflow:

* View the workflow: |IcView|
* Activate the workflow: |IcActivate|

   .. image:: /admin_guide/img/workflows/single_page_checkout/SPCActions.png

.. note:: If the workflow is active, you will be able to deactivate it from the list page by clicking |IcDeactivate|.

On the the Single Page Checkout workflow page, you can perform the following actions:

* Activate --- Click |IcActivate| **Activate** on the top right of the page to activate the workflow.

  .. image:: /admin_guide/img/workflows/single_page_checkout/SPCActivate.png

* Deactivate (if the workflow is active) -- click |IcDeactivate| **Deactivate** on the top right of the page to deactivate the workflow.

  .. image:: /admin_guide/img/workflows/single_page_checkout/SPCDeactivate.png

For more information on how to manage workflows, see the :ref:`Workflow Management topic <user-guide--system--workflow-management>`.

Steps and Transitions
---------------------

The Single Page Checkout workflow consists of the following steps and transitions:

.. image:: /admin_guide/img/workflows/single_page_checkout/SPCStepsTransitions.png

1. Steps:

   * Start
   * Checkout
   * Order Created

2. Transitions:

   * For **Start**: Start Checkout (System), Start Checkout From Shopping List, Start Checkout from Quick Order Form.
   * For **Checkout**: Save State, Submit Order, Finish Checkout, Payment Error.

Sample Flow
-----------

As an illustration let us go through the sample flow to see the Single Page Checkout workflow in action:

1. A customer adds an item to the shopping list in the storefront, and clicks **Create Order** to proceed to the checkout.

   .. image:: /admin_guide/img/workflows/single_page_checkout/SampleFlow1.png


2. The following sections (steps) are displayed on one page:

   * Billing Information
   * Shipping Information
   * Order Summary

   .. image:: /admin_guide/img/workflows/single_page_checkout/SampleFlow2.png

3. In the Billing Information section, the customer provides his address and selects a payment method.

4. In the Shopping Information section, the customer:

   * Provides shipping and billing addresses.
   * Selects a shipping method.
   * Sets the Do Not Ship Later Than date.

5. In the Order Summary section, the customer:

   * Reviews the order by checking items, SKUs, item quantity, price and the subtotal amount.
   * Checks order options.
   * Selects whether the shopping list should be deleted after submitting the order, or saved.

6. The customer submits the order by clicking **Submit Order** on the top left of the page.
7. The customer receives an email confirmation with order details.

   .. image:: /admin_guide/img/workflows/single_page_checkout/SampleFlow4.png

Related Topics
--------------

* :ref:`Checkout Workflow <system--workflows--checkout-workflow>`
* :ref:`Alternative Checkout Workflow <system--workflows--alternative-checkout-workflow>`
* :ref:`Workflow Management topic <user-guide--system--workflow-management>`
* :ref:`Checkout Process in the Storefront <frontstore-guide--orders-checkout>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin


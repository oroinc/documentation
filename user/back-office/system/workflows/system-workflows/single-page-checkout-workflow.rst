:oro_documentation_types: OroCRM, OroCommerce

.. _system--workflows--single-page-checkout:

Configure Single Page Checkout Workflow in the Back-Office
==========================================================

.. hint:: This section is a part of the :ref:`Checkout Configuration Concept Guide <checkout-management-concept-guide>` topic that provides the general understanding of single-page and multi-page checkout concepts.

Overview
--------

In your Oro application, you can control the way the checkout is displayed to customers in the storefront. By default, each checkout step is displayed on a new page. However, by activating the Single Page Checkout workflow in the back-office, you can make all steps fit one page. This will make the checkout process easier and quicker for customers, since they will be able to see how far along in the checkout they are, and how many fields are left to complete it.

.. image:: /user/img/system/workflows/single_page_checkout/SampleFlow2.png

To reach the Single Page Checkout workflow:

1. Navigate to **System > Workflows** in the main menu.

   Within the list of workflows, you can perform the following actions for the Single Page Checkout workflow:

   * View the workflow: |IcView|
   * Activate the workflow: |IcActivate|

2. Click **Single Page Checkout** to open the flow.

   .. image:: /user/img/system/workflows/single_page_checkout/SPCList.png

   .. note:: If the workflow is active, you can deactivate it from the list page by clicking |IcDeactivate|.

   On the the Single Page Checkout workflow page, you can perform the following actions:

   * Activate --- Click |IcActivate| **Activate** on the top right of the page to activate the workflow.
   * Deactivate (if the workflow is active) -- click |IcDeactivate| **Deactivate** on the top right of the page to deactivate the workflow.

For more information managing workflows, see the :ref:`Workflow Management topic <user-guide--system--workflow-management>`.

Steps and Transitions: Illustration
-----------------------------------

As an illustration let us go through the sample flow to see the Single Page Checkout workflow in action:

1. Add an item to the shopping list in the storefront, and click **Create Order** to proceed to the checkout.

   .. image:: /user/img/system/workflows/single_page_checkout/SampleFlow1.png

2. The following sections (steps) are displayed on one page:

   * Billing Information
   * Shipping Information
   * Order Summary (including *Agreements*)

   .. image:: /user/img/system/workflows/single_page_checkout/SampleFlow2.png

3. In the **Billing Information** section, provide your address and select a payment method.

4. In the **Shopping Information** section:

   * Provide shipping and billing addresses.
   * Select a shipping method.
   * Set the Do Not Ship Later Than date.

5. In the **Order Summary** section:

   * Review the order by checking items, SKUs, item quantity, price and the subtotal amount.
   * Check order options.
   * Select whether the shopping list should be deleted after submitting the order, or saved.
   * Accept all mandatory consents to process your personal data, if such consents have not been accepted previously. Keep in mind that if you leave the checkout after accepting a mandatory consent, this consent is considered accepted and can be revoked only through the :ref:`profile management <frontstore-guide--profile-consents--revoke>`.

6. Submit the order by clicking **Submit Order** on the top left of the page.
7. Receive an email confirmation with order details.


**Related Topics**

* :ref:`Checkout Workflow <system--workflows--checkout-workflow>`
* :ref:`Alternative Checkout Workflow <system--workflows--alternative-checkout-workflow>`
* :ref:`Workflow Management topic <user-guide--system--workflow-management>`
* :ref:`Checkout Process in the Storefront <frontstore-guide--orders-checkout>`

.. include:: /include/include-images.rst
   :start-after: begin


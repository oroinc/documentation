.. _system--workflows--checkout-workflow:


Checkout Workflow 
=================

Overview
--------

The Checkout workflow represents a standard checkout procedure in the eCommerce environment. It is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a user can go through when creating an order in the front store.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **Checkout** to open the flow.
   
  
On the Checkout workflow page, you can perform the following actions:

* Clone the workflow - click |IcClone| **Clone** to clone the workflow.
* Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.
  
.. image:: /user_guide/img/system/workflows/checkout/CheckoutViewPageBackoffice.png

Within the Workflows grid, you can perform the following actions for the Checkout workflow:

* Clone the workflow: |IcClone|
* View the workflow: |IcView|
* Deactivate the workflow: |IcDeactivate|

.. image:: /user_guide/img/system/workflows/checkout/CheckoutGridBackoffice.png

Steps and Transitions
---------------------

The following table illustrates the steps and transitions that the Checkout workflow consists of:

.. image:: /user_guide/img/system/workflows/checkout/CheckoutWfTable.png

As an illustration, let us go through a sample flow to see how the Checkout workflow works:

1. A product has been added to a shopping list. On opening the shopping list, you can create an order either by clicking **Create Order** on the right of the page next to Request Quote or by clicking on the **Create Order** button at the bottom of the page.
   
   .. image:: /user_guide/img/system/workflows/checkout/CreateOrderButton.png

   .. note:: The **Create Order** button will only be available if the following conditions are met:

      * at least one :ref:`shipping method <user-guide--shipping>` is available
      * at least one :ref:`payment method <user-guide--payment>` is available
      * there is at least one product with a price in the shopping list
      * items to be purchased are available in the :ref:`inventory <user-guide--inventory>` in the management console
       
  A warning message will be shown if for some reason you are unable to start the checkout process.

  .. check the conditions

2. **Step 1: Billing Information**
   
   The order is open. The first step is to enter billing information for the order by selecting an existing address from the address book, or creating a new one. 
 
   Checking **Ship to this address** will allow you to use the provided billing address as shipping. 

   Clicking **Continue** will redirect you to the next step.

   .. note::     
     It is possible to amend the order by clicking **Edit Order** in the right corner of the Order Summary section. The Order Summary section will be available for Billing Information, Shipping Information, Shipping Method and Payment pages. Editing the order will remain possible throughout the checkout process until the order is submitted.

   .. image:: /user_guide/img/system/workflows/checkout/Checkout_BilInfo.png


3. **Step 2: Shipping Information**
   
   If the **Ship to this address** box has been checked in the Billing Information step, the provided address will be automatically selected in the Shipping Information step. 
   
   To edit shipping information, clear the **Use billing address** box and provide a different shipping address for the order.

   .. image:: /user_guide/img/system/workflows/checkout/UseBillingAddressBox.png

   .. note:: It is possible to edit *the already provided* information (until the order is submitted) by clicking |IcEditInline| on the left side of the page.

   	  .. image:: /user_guide/img/system/workflows/checkout/EditInfo.png
   	     :align: center	
   			
4. **Step 3: Shipping Method**
    
   At this stage, it is necessary to provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.

   .. image:: /user_guide/img/system/workflows/checkout/Shipping_Info.png

5. **Step 4: Payment**
   
   Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.

   .. image:: /user_guide/img/system/workflows/checkout/Payment.png 

6. **Step 5: Order Review**

   Once all the necessary information has been provided, it is possible to review the order in the Order Review section:

   * View Options for the order:

     * Do not ship later than
     * PO Number
     * Notes
     * Delete the shopping list
    
   * Check quantity, price, subtotal, shipping and total cost
   * Edit the Order
   * Edit the already provided information by clicking |IcEditInline| on the left side of the page
  
   To submit the order, click **Submit Order** at the bottom of the page.

   .. image:: /user_guide/img/system/workflows/checkout/Order_Review.png

7. Once submitted, the order will be received and dealt with by the sales team.
   
   .. image:: /user_guide/img/system/workflows/checkout/order_received.png

.. include:: /user_guide/include_images.rst
   :start-after: begin
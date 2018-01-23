.. _system--workflows--alternative-checkout-workflow:


Alternative Checkout Workflow 
=============================

Overview
--------

The Alternative Checkout workflow represents an **example** of the :ref:`checkout workflow <system--workflows--checkout-workflow>` customization. It is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a user can go through when creating an order in the storefront.

In addition to the standard :ref:`checkout steps <system--workflows--checkout-workflow>`, alternative checkout workflow includes request and order approval steps before creating an order. For this workflow, orders with subtotals exceeding the specified value will have to be reviewed and approved by users with the permission to *approve orders that exceed the allowable amount*. By default, the order approval threshold is set to 5000.

.. note:: Please keep in mind that the default alternative checkout is merely an example of an alternative checkout workflow. Enabling it for your customer users on the OroCommerce Storefront requires some customization efforts.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **Alternative Checkout** to open the flow.
  
On the Alternative Checkout workflow page, you can perform the following actions:

* Configure order approval threshold: |IcConfig| **Configuration**.
* Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.

.. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_page.png

.. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_configuration.png

Within the Workflows grid, you can perform the following actions for the alternative checkout workflow:

* Configure order approval threshold: |IcConfig|
* View the workflow: |IcView|
* Deactivate the workflow: |IcDeactivate|
  
.. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_grid.png

Steps and Transitions
---------------------

The following table illustrates the steps and transitions that the alternative checkout workflow consists of:

.. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_table.png
   :align: center

As an illustration, let us go through a sample flow to see how the alternative checkout workflow works:  

1. A product has been added to a shopping list. On opening the shopping list, you can create an order either by clicking **Create Order** on the right of the page next to Request Quote or by clicking on the **Create Order** button at the bottom of the page.

.. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_CreateOrderButton.png

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
     It is possible to amend the order by clicking **Edit the Order** in the right corner of the Order Summary section. The Order Summary section will be available for Billing Information, Shipping Information, Shipping Method and Payment pages. Editing the order will remain possible throughout the checkout process until the order is submitted.

.. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_CreateBilling.png

3. **Step 2: Shipping Information**
   
   If the **Ship to this address** box has been checked in the Billing Information step, the provided address will be automatically selected in the Shipping Information step. 
   
   To edit shipping information, clear the **Use billing address** box and provide a different shipping address for the order.

   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_CreateShipping.png

   .. note:: It is possible to edit *the already provided* information (until the order is submitted) by clicking |IcEditInline| on the left side of the page.

   	  .. image:: /configuration_guide/img/workflows/checkout/EditInfo.png
   	     :align: center	

4. **Step 3: Shipping Method**
    
   At this stage, it is necessary to provide a :ref:`shipping method <user-guide--shipping>` by selecting one from the list of the available methods.

   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_ShippingMethod.png

5. **Step 4: Payment**
   
   Choose a suitable :ref:`payment method <user-guide--payment>` by selecting it from the list of all available methods.

   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_Payment.png

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

   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_OrderReview.png


7. **Step 6: Request Approval**
   
   Since the order amount exceeds the threshold of $5000, manager approval is required to submit the order.


   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_RequestApproval.png

   Order Approval will remain pending until the manager aproves it.

   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_ApprovalPending.png

8. **Step 7: Approve Order**
   
   The manager can approve the order by navigating to Orders, selecting the required order and clicking **Approve Order**.

   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_ApproveOrder.png


   At this point, the manager can submit the order themselves, or let the employee handle the order: 

   .. image:: /configuration_guide/img/workflows/alternative_checkout/ACF_Approved.png

9. Once submitted, the order will be received and dealt with by the sales team.





.. include:: /user_guide/include_images.rst
   :start-after: begin


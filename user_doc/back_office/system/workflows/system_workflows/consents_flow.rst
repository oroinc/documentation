.. _system--workflows--checkout-with-consents-workflow:

Checkout with Consents Workflow
===============================

Overview
--------

The Checkout with Consents workflow restricts customer users from proceeding through the checkout if mandatory :ref:`consents <user-guide--consents>` to process personal data have not been accepted. It is a :ref:`system workflow <user-guide--system--workflow-management-system-custom>` that defines the sequence of :ref:`steps and transitions <user-guide--system--workflow-management-steps-transitions>` that a customer user goes through when creating an order in the storefront. When Checkout with Consents is activated, the default :ref:`checkout workflow <system--workflows--checkout-workflow>` is disabled.

As opposed to the standard :ref:`checkout workflow <system--workflows--checkout-workflow>`, the checkout with consents adds **Agreements** as the first step of the checkout in the OroCommerce storefront. As it is impossible to process orders without collecting personal data, such as shipping or billing details, accepting mandatory consents is required to complete checkout and ultimately place the order. When mandatory consents have already been accepted previously (e.g. in the buyer's account, for example), you are not asked to accept such agreements for the second time. 

.. note:: Keep in mind that if you accept a mandatory consent at the **Agreements** step and then abandon the checkout, the mandatory consents are considered accepted and can only be :ref:`declined through the buyer's profile account <frontstore-guide--profile-consents--revoke>`.

Activate Checkout with Consents
-------------------------------

By default, the Checkout with Consents workflow is disabled in the OroCommerce application, and can be activated for the storefront through the back-office.

To reach the workflow:

1. Navigate to **System > Workflows** in the main menu.
2. Click **Checkout with Consents** to open the flow.
   
   .. image:: /user_doc/img/system/workflows/checkout_with_consents/checkout_with_consents_workflow_grid.png
      :alt: Checkout with consents workflow in the table of all workflows

On the Checkout with Consents workflow page, you can perform the following actions:

* Deactivate the workflow - click |IcDeactivate| **Deactivate** to deactivate the workflow.
* Activate the workflow - click |IcActivate| **Activate** to activate the workflow.

.. image:: /user_doc/img/system/workflows/checkout_with_consents/checkout_with_consents_page.png
   :alt: The page of the checkout with consents workflow

On the page of all workflows, you can perform the following actions to the Checkout with Consents workflow:

* View the workflow: |IcView|
* Deactivate / Activate the workflow: |IcDeactivate| / |IcActivate|

ю. image:: /user_doc/img/workflows/checkout_with_consents/checkout_with_consents_actions_from_grid.png
   :alt: View, activate or deactivate the checkout with consents workflow from the table of all workflows

.. note:: Keep in mind that when you activate the Checkout with Consents workflow, the default checkout workflow is disabled automatically.

   .. image:: /user_doc/img/system/workflows/checkout_with_consents/activate_checkout_with_consents.png
      :alt: When you activate the checkout with consents workflow, a pop up informs that the default workflow will be disabled

.. _system--workflows--checkout-with-consents-workflow-sample:

Sample Flow
-----------

.. start_checkout_with_consents_sample

As an illustration, we are going to proceed through the steps of the Checkout with Consents workflow to see how it works.


.. include:: /user_doc/back_office/system/workflows/system_workflows/checkout.rst
   :start-after: start_checkout_sample_0
   :end-before: finish_checkout_sample_0

.. |create_order_img| image:: /user_doc/img/system/workflows/checkout/CreateOrderButton.png
   :alt: Shopping list with option to create order and proceed to checkout

Step 1: Agreements
^^^^^^^^^^^^^^^^^^

At the Agreements step, you are required to accept all mandatory consents to process your personal data, if such consents have not been accepted previously. Keep in mind that if you leave the checkout after accepting a mandatory consent, this consent is considered accepted and can be revoked only through the :ref:`profile management <frontstore-guide--profile-consents--revoke>`.

.. image:: /user_doc/img/system/workflows/checkout_with_consents/storefront_step_agreements.png
   :alt: The first step of the checkout is agreements where you are required to accept any available mandatory consents

.. image:: /user_doc/img/system/workflows/checkout_with_consents/storefront_step_accept_agreement.png
   :alt: Accept a mandatory consent on the agreements step at checkout

Once the consent is accepted, click **Continue** to proceed with the checkout.

Step 2: Billing Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_doc/back_office/system/workflows/system_workflows/checkout.rst
   :start-after: start_checkout_sample_1
   :end-before: finish_checkout_sample_1

.. image:: /user_doc/img/system/workflows/checkout_with_consents/billing_information_step_checkout_with_consents.png
   :alt: The billing information step at the checkout (with consents)

Step 3: Shipping Information
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_doc/back_office/system/workflows/system_workflows/checkout.rst
   :start-after: start_checkout_sample_2
   :end-before: finish_checkout_sample_2

Step 4: Shipping Method
^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user_doc/back_office/system/workflows/system_workflows/checkout.rst
   :start-after: start_checkout_sample_3
   :end-before: finish_checkout_sample_3

.. image:: /user_doc/img/system/workflows/checkout_with_consents/shipping_method_checkout_with_consents.png
   :alt: The shipping method step at the checkout (with consents)

Step 5: Payment
^^^^^^^^^^^^^^^

.. include:: /user_doc/back_office/system/workflows/system_workflows/checkout.rst
   :start-after: start_checkout_sample_4
   :end-before: finish_checkout_sample_4

.. image:: /user_doc/img/system/workflows/checkout_with_consents/payment_method_step_checkout_with_consents.png
   :alt: The payment method step at the checkout (with consents)

Step 6: Order Review
^^^^^^^^^^^^^^^^^^^^

.. include:: /user_doc/back_office/system/workflows/system_workflows/checkout.rst
   :start-after: start_checkout_sample_5
   :end-before: finish_checkout_sample_5

.. |order_submitted_img| image:: /user_doc/img/system/workflows/checkout_with_consents/order_submitted.png
   :alt: The page of the order in the back-office, once the order is submitted

.. |order_review_img| image:: /user_doc/img/system/workflows/checkout_with_consents/order_review_step_checkout_with_consents.png
   :alt: The order review step at the checkout (with consents)

.. note:: You can view consents available for your specific buyers in the **Consents** section of their pages in the back-office under **Customers > Customer Users**.

.. image:: /user_doc/img/system/workflows/checkout_with_consents/consents_section_customer_user_page.png

.. finish_checkout_with_consents_sample


.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin
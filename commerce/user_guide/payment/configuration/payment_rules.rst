:orphan:

.. _sys--payment-rules:

.. System > Payment Rules

Payment Rules Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

You can configure one or more payment rules that enable the payment methods for the provided destinations.

Create a Payment Rule
^^^^^^^^^^^^^^^^^^^^^

To create a payment rule:

1. Ensure that the integrations for the payment methods that you plan to use (PayPal Payflow Gateway, PayPal Payments Pro, etc.) are already configured.

2. Navigate to **System > Payment Rules** in the main menu. The list of payment rules opens.

   ..   The following page opens:

   ..   .. image:: /user_guide/img/system/shipping_rules/ShippingRule1.png
      :class: with-border

#. Click **Create Payment Rule**. The corresponding page opens.

#. In the **General Information** section:

   a) Select the **Enabled** check box to activate the payment rule. You may keep it clear while you are drafting and testing the conditions.

   #) Specify the payment rule name and sort order to set the priority compared to other payment rules.

   #) Select the payment currency.

   #) Select **Stop Further Rule Processing** if you would like to prevent applying other payment rules with lower priority.

#. In the **Destinations** section, add one or more destinations to apply this payment rule to.

   a) Click **+ Add**. The following section appears:

      .. image:: /user_guide/img/system/payment_rules/create_payment_rule.png
         :class: with-border

   #) Specify the destination (e.g. select a Country, or select a country and state; for the most granularity you may provide a distinct list of postal codes to apply the payment rule for.

#. In the **Conditions** section, specify the expression that describes the conditions when this payment rule should be applied. For example, *account = 1*.

   .. TODO what keywords we really can use here?

   .. image:: /user_guide/img/system/payment_rules/create_payment_rule_expression.png
      :class: with-border

   For detailed information about the expression language used in the shipping and payment rules, please see the :ref:`Expression Language for Shipping and Payment Rules <payment-shipping-expression-lang>` guide.

#. In the **Payment Method Configurations** section, you may enable one or more payment methods with this payment rule. To add a payment method, select it from the list and click **+ Add**.

   .. Warning::

      Only one unique payment method per integration may be selected in the payment rule.

      **PayPal:**

      To enable several PayPal Payflow Gateway options with different payment settings, create a separate payment rule for every unique option.
      You still can use one copy of PayPal Payflow Gateway and one copy of PayPal Payflow Gateway Express Checkout in the same payment rule, as these are different payment methods.


      **Wirecard:**

      The single Wircard integration enables you to set up the following payment methods:

       - *WireCard - Credit Card*—Via this payment method a buyer can pay for the order using a credit card.
       - *WireCard - PayPal*—When this payment method is used, a buyer is redirected to the PayPal site where they can complete the payment using their PayPal account or credit card.
       - *WireCard - SEPA*—Via this payment method a buyer can pay for the order in EUR using a SEPA (Single Euro Payment Area) payment.

       You can add any combination of these payment methods in a single payment rule. However, if you want to enable **WireCard - SEPA**, then in step 3 you must select *EUR* for **Currency**.


#. Click :guilabel:`Save`.

Enable a Payment Rule
^^^^^^^^^^^^^^^^^^^^^

To enable a payment rule:

1. Navigate to **System > Payment Rules** in the main menu. The list of shipping rules opens.

2. Hover over the |IcMore| **More Options** menu at the end of the row with the necessary payment rule and click the |IcActivate| **Activate** icon.


.. stop

.. include:: /user_guide/include_images.rst
   :start-after: begin

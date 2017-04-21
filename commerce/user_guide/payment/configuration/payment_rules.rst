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

1. Ensure that the integration(s) for the payment method(s) you plan to use (PayPal Payflow Gateway, PayPal Payments Pro, etc.) is already configured.

2. Navigate to the list of payment rules by clicking **System > Payment Rules** in the main menu.

   ..   The following page opens:

   ..   .. image:: /user_guide/img/system/shipping_rules/ShippingRule1.png
      :class: with-border

#. In the **General Information** section:

   a) Tick the **Enabled** box to activate the payment rule. You may keep it unselected while you are drafting and testing the conditions.

   #) Specify the payment rule name and sort order to set the priority compared to other payment rules.

   #) Select the payment currency.

   #) Select the **Stop Further Rule Processing**, if you would like to prevent applying other payment rules with lower priority.

#. In the **Destinations** section, add one or more destinations to apply this payment rule to.

   a) Click **+ Add**. The following box appears:

      .. image:: /user_guide/img/system/payment_rules/create_payment_rule.png
         :class: with-border

   #) Specify the destination (e.g. select a Country, or select a Country and State; for the most granularity you may provide a distinct list of Postal Codes to apply the payment rule for.

#. In the **Conditions** section, specify the expression that describes the conditions when this payment rule should be applied. For example, *account = 1*.

   .. TODO what keywords we really can use here?

   .. image:: /user_guide/img/system/payment_rules/create_payment_rule_expression.png
      :class: with-border

   For detailed information about the expression language used in the shipping and payment rules, please, see the :ref:`Expression Language for Shipping and Payment Rules <payment-shipping-expression-lang>` guide.

#. In the *Payment Method Configurations* section, you may enable one or more payment methods with this payment rule. To add a payment method, select it from the list and click **+ Add**.

   .. Warning::

      Only one unique payment method per integration may be selected in the payment rule.

      To enable several PayPal Payflow Gateway options with different payment settings, create a separate shipping rule for every unique option. You still can use one copy of PayPal Payflow Gateway and one copy of PayPal Payflow Gateway Express Checkout in the same payment rule, as these are different payment methods.

#. Click **Save**.

Enable a Payment Rule
^^^^^^^^^^^^^^^^^^^^^

To enable a payment rule:

1. Navigate to the list of shipping rules by clicking **System > Payment Rules** in the main menu.

2. Hover over the |IcMore| *more actions* menu to the right of the item and click |IcActivate|.

After the payment rule is enabled,

.. stop

.. include:: /user_guide/include_images.rst
   :start-after: begin

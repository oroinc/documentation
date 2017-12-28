.. _sys--payment-rules:

.. System > Payment Rules

Payment Rules Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

You can configure one or more payment rules that enable the payment methods for the provided destinations.

.. note::
    See a short demo on `how to create payment rules <https://www.orocommerce.com/media-library/how-to-create-payment-rules>`_, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/JwuvMGIwDfk" frameborder="0" allowfullscreen></iframe>

Create a Payment Rule
^^^^^^^^^^^^^^^^^^^^^

To create a payment rule:

1. Ensure that the integrations for the payment methods that you plan to use (PayPal Payflow Gateway, PayPal Payments Pro, etc.) are already configured.

2. Navigate to **System > Payment Rules** in the main menu. The list of payment rules opens.

   ..   The following page opens:

   ..   .. image:: /configuration_guide/img/shipping_rules/ShippingRule1.png
      :class: with-border

#. Click **Create Payment Rule**. The corresponding page opens.

#. In the **General Information** section:

   a) Select the **Enabled** check box to activate the payment rule. You may keep it clear while you are drafting and testing the conditions.

   #) Specify the payment rule name and sort order to set the priority compared to other payment rules.

   #) Select the payment currency.

   #) Select **Stop Further Rule Processing** if you would like to prevent applying other payment rules with lower priority.

#. In the **Destinations** section, add one or more destinations to apply this payment rule for. The payment rule applies when the billing address matches the provided destination(s). To add a destination:

   a) Click **+ Add**. The following section appears:

      .. image:: /configuration_guide/img/payment_rules/create_payment_rule.png
         :class: with-border

   #) Specify the destination (e.g. select a Country, or select a country and state; for the most granularity you may provide a distinct list of postal codes to apply the payment rule for.

#. In the **Conditions** section, specify the expression that describes the conditions when this payment rule should be applied. For example, *account = 1*.

   .. TODO what keywords we really can use here?

   .. image:: /configuration_guide/img/payment_rules/create_payment_rule_expression.png
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

#. In the **Websites** section, specify the website(s) that the payment rule should apply to, if you have more than one website. This field is optional and may be left empty. Hold the Ctrl key to choose several websites, if necessary.

   .. note:: Please note that application of payment rules to websites is only available for Enterprise customers.

   .. image:: /configuration_guide/img/payment_rules/websites_payment_rule.png
      :class: with-border

   * When no website is selected, the payment rule is always applied by default.

   * When at least one website is selected, the payment rule will apply to the orders created in the front store of the specified website.

#. Click **Save**.

Manage a Payment Rule
^^^^^^^^^^^^^^^^^^^^^

Enable a Payment Rule
"""""""""""""""""""""

To enable a payment rule:

1. Navigate to **System > Payment Rules** in the main menu. The list of shipping rules opens.

2. Hover over the |IcMore| **More Options** menu at the end of the row with the necessary payment rule.

3. Click the |IcActivate| **Activate** icon.

To enable several shipping rules at the same time:

1. Select the checkboxes on the left of the corresponding rows. The selected payment rules will be highlighted in yellow.

2. Click |IcMore| on the far right of table header.

3. Click |IcActivate| **Enable**.

    .. image:: /configuration_guide/img/payment_rules/mass_action_payment_rule.png
       :class: with-border

Filter a Payment Rule List
""""""""""""""""""""""""""

You can use filters on the payment rules list page to find the required records quicker:

1. To show filters, click |IcFilter| above the table on the far right.

   .. image:: /configuration_guide/img/payment_rules/filter_payment_rule.png
      :class: with-border

   Filters are hidden by default.

2. To apply a filter, click on its button in the bar, and specify your query in the control that appears.

   .. note:: Filter controls might look different depending on the type of data you are going to filter, e.g. textual, numeric, a date or an option set.

   .. image:: /configuration_guide/img/payment_rules/filter_payment_rule_2.png
      :class: with-border

Organize a Payment Rule List
""""""""""""""""""""""""""""

To define which columns to show in the table, click |IcSettings| above the table on the far right:

   .. image:: /configuration_guide/img/payment_rules/grid_settings_payment_rules.png
      :class: with-border

* To choose the columns to be displayed in the table, select the check box next to the required column under **Show**. Clear the check box to make the column disappear from the table.

* To change the order of the columns, click |IcReorder| next to the name of the column you wish to move, hold the mouse button and drag the column to the required position.




.. stop

.. include:: /user_guide/include_images.rst
   :start-after: begin

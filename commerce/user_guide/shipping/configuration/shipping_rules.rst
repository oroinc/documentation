:orphan:

.. _sys--shipping-rules:

Shipping Rules Configuration
~~~~~~~~~~~~~~~~~~~~~~~~~~~~

.. begin

You can configure one or more shipping rules that enable the shipping methods for the provided destinations and set the customized shipping service price by adding a surchange per service option or globally for all options of the service provider.

Shipping Rules Overview
^^^^^^^^^^^^^^^^^^^^^^^

On the checkout, when a customer user provides the shipping address, the OroCommerce evaluates shipping rules one by one following the Shipping Rules Sort Order. The matching shipping rule may enable one or more shipping method(s) in the shipping options on the checkout and set the shipping service fee components that are used in shipping cost calculation.

To decide whether the shipping rule fits the order or not, OroCommerce uses the shipping destination and the shipping rule condition defined with the :ref:`expression <payment-shipping-expression-lang>`. Condition may rely on the customer order context. When a shipping rule destination and condition matches the order details (e.g. customer, ordered products and the environment), the shipping rule enables it's shipping options and shipping fee components.

Stop Further Rule Processing Mode
"""""""""""""""""""""""""""""""""

When the OroCommerce gets to the shipping rule with the enabled **Stop Further Rule Processing** flag, the remaining rules are not taken into account and their shipping methods are not shown as the shipping options on the checkout. This is helpful when you would like to enforce the recommended shipping method for any location or other conditions it is technically applicable (e.g. use local shipping vendor for all addresses they handle or use the specific shipping vendor that has a VIP SLA with the particular customer). It is recommended to put this type of rules to the top (e.g. setting their sort order to 1).

Overlapping Shipping Methods Definition
"""""""""""""""""""""""""""""""""""""""

When the shipping option is enabled by multiple shipping rules, only the first occurrence is shown to the customer user - the one from the shipping rule with the lower Sort Order value which means closer to the top of the list.

For example:

+---------------+------------+--------------------------+-----------+
| Shipping Rule | Sort Order | Shipping Method          | Surcharge |
+===============+============+==========================+===========+
|  A            | 1          | UPS Worldwide Expedited  | +10$      |
+---------------+------------+--------------------------+-----------+
|  B            | 2          | UPS Worldwide Expedited  | +15$      |
+---------------+------------+--------------------------+-----------+

When both shipping rules apply to an order, the customer user gets the **UPS Worldwide Expedited** with **+10$** surcharge.

Non-overlapping Shipping Method Definition
""""""""""""""""""""""""""""""""""""""""""

The shipping methods from the same service provide may be enabled in different shipping rules.

In the enhanced example, shipping rules enable more diverse shipping methods:

+---------------+------------+--------------------------+-----------+
| Shipping Rule | Sort Order | Shipping Method          | Surcharge |
+===============+============+==========================+===========+
|  A            | 1          | UPS Worldwide Expedited  | +10$      |
+---------------+------------+--------------------------+-----------+
|               |            | UPS Worldwide Express    | +5$       |
+---------------+------------+--------------------------+-----------+
|  B            | 2          | UPS Worldwide Expedited  | +15$      |
+---------------+------------+--------------------------+-----------+
|               |            | UPS Next Day Air         | +5$       |
+---------------+------------+--------------------------+-----------+

When both shipping rules apply to an order, the customer user can choose from the following shipping options:

* **UPS Worldwide Expedited** with **+10$** surcharge (enabled by shipping rule A).
* **UPS UPS Worldwide Express** with **+5$** surcharge (enabled by shipping rule A).
* **UPS Next Day Air** with **+5$** surcharge (enabled by shipping rule B).

Create a Shipping Rule
^^^^^^^^^^^^^^^^^^^^^^

To create a shipping rule:

1. Ensure that the integration(s) for the shipping method(s) you plan to use (UPS, Flat Rate, etc) is already configured.

2. Navigate to the list of shipping rules by clicking **System > Shipping Rules** in the main menu.

   The following page opens:

   .. image:: /user_guide/img/system/shipping_rules/ShippingRule1.png
      :class: with-border

#. In the **General Information** section:

   a) Tick the **Enabled** box to activate the shipping rule. You may keep it unselected while you are drafting and testing the conditions.

   #) Specify the shipping rule name and sort order to set the priority compared to other shipping rules.

   #) Select the shipping cost currency.

   #) Select the **Stop Further Rule Processing**, if you would like to prevent applying other shipping rules with lower priority.

#. In the **Destinations** section, add one or more destinations to apply this shipping rule to.

   a) Click **+ Add**. The following box appears:

      .. image:: /user_guide/img/system/shipping_rules/ShippingRule_Destination.png
         :class: with-border

   #) Specify the destination (e.g. select a Country, or select a Country and State; for the most granularity you may provide a distinct list of Postal Codes to apply the shipping rule for.

#. In the **Conditions** section, specify the expression that describes the conditions when this shipping rule should be applied.

   .. image:: /user_guide/img/system/shipping_rules/ShippingRule2.png
      :class: with-border

   For detailed information about the expression language used in the shipping and payment rules, please, see the :ref:`Expression Language for Shipping and Payment Rules <payment-shipping-expression-lang>` guide.

#. In the *Shipping Method Configurations* section, you may enable one or more shipping methods with this shipping rule. To add a shipping method, select it from the list and click **+ Add** and fill in the shipping price customization information tha may vary for different service providers.

   .. warning::

      Only one shipping method per integration may be selected in the shipping rule. For example, to enable several flat rate options with various delivery SLA and insurance, please create a separate shipping rule for every option.

   a) For Flat Rate, provide the following information:

      * **Price** - shipping price based on your agreement with the shipping service provider. Final Shipping price depends on the Type option (Pre Item/Per Order).
      * **Handling fee** - additional cost for order processing by your company.
      * **Type** - the way shipping price is calculated for the order. Supported options:

        - **Per Item** - shipping price is a multiplication of product line item quantities (e.g. 5 cups of coffee, 10 napkins, and 5 cookies give us total of 20 items) and Flat Rate price (e.g. 1$). Finally, we add a handling fee (e.g. 10$) on top of the resulting amount. The shipping cost for this order is 20*1$+10$=30$
        - **Per Order** - shipping price is an addition of the Flat Rate price (e.g. 1$) and a handling fee (e.g. 10$). The shipping cost for this order is 1$+10$=11$

      **Flat Rate service price configuration**

      .. image:: /user_guide/img/system/shipping_rules/flat_rate_in_a_shipping_rule.png
         :width: 400px

   b) For UPS, set **Enabled** for the necessary services and provide a surcharge next to the service to customize the shipping cost. If necessary, fill in the surcharge at the bottom to apply it to any enabled service on top of the per-service-surcharge.

      *Service options and additional surcharge configuration for UPS*

      .. image:: /user_guide/img/system/shipping_rules/UPS_in_shipping_rule1.png
         :width: 582px

      .. image:: /user_guide/img/system/shipping_rules/UPS_in_shipping_rule2.png
         :width: 516px

#. Click **Save**.

Enable a Shipping Rule
^^^^^^^^^^^^^^^^^^^^^^

To enable a shipping rule:

1. Navigate to the list of shipping rules by clicking **System > Shipping Rules** in the main menu.

2. Hover over the |IcMore| *more actions* menu to the right of the item and click |IcActivate|.

.. stop

.. include:: /user_guide/include_images.rst
   :start-after: begin

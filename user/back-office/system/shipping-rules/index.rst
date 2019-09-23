.. _sys--shipping-rules:

Shipping Rules
==============

.. begin

.. important:: This section is a part of the :ref:`Shipping Configuration <admin-guide--shipping>` topic that provides the general understanding of the payment concept in OroCommerce.

You can configure one or more shipping rules that enable the shipping methods for the provided destinations and set the customized shipping service price by adding a surcharge per service option or globally for all options of the service provider.

.. stop

.. note::
    See a short demo on |how to create shipping rules in OroCommerce| or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/46KlATao3MU" frameborder="0" allowfullscreen></iframe>


.. _doc--shipping-rules--overview:

Shipping Rules Overview
-----------------------

.. begin-shipping-rules-overview

On the checkout, when a customer user provides the shipping address, the OroCommerce evaluates shipping rules one by one following the Shipping Rules Sort Order. The matching shipping rule may enable one or more shipping method(s) in the shipping options on the checkout and set the shipping service fee components that are used in shipping cost calculation.

To decide whether the shipping rule fits the order or not, OroCommerce uses the shipping destination and the shipping rule condition defined with the :ref:`expression <payment-shipping-expression-lang>`. The condition may rely on the customer order context. When a shipping rule destination and condition matches the order details (e.g. customer, ordered products and the environment), the shipping rule enables its shipping options and shipping fee components.

.. _doc--shipping-rules--overview--stop-further-processing:

Stop Further Rule Processing Mode
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When the OroCommerce gets to the shipping rule with the enabled **Stop Further Rule Processing** flag, the remaining rules are not taken into account and their shipping methods are not shown as the shipping options on the checkout. This is helpful when you would like to enforce the recommended shipping method for any location or other conditions it is technically applicable (e.g. use local shipping vendor for all addresses they handle or use the specific shipping vendor that has a VIP SLA with the particular customer). It is recommended to put this type of rules to the top (e.g. setting their sort order to 1).


.. _doc--shipping-rules--overview--shipping-methods-overlap:

Overlapping Shipping Methods Definition
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When the shipping option is enabled by multiple shipping rules, only the first occurrence is shown to the customer user—the one from the shipping rule with the lower sort order value which means closer to the top of the list.

For example:

+---------------+------------+--------------------------+-----------+
| Shipping Rule | Sort Order | Shipping Method          | Surcharge |
+===============+============+==========================+===========+
|  A            | 1          | UPS Worldwide Expedited  | +10$      |
+---------------+------------+--------------------------+-----------+
|  B            | 2          | UPS Worldwide Expedited  | +15$      |
+---------------+------------+--------------------------+-----------+

When both shipping rules apply to the order, the customer user gets UPS Worldwide Expedited with +10$ surcharge.


Non-overlapping Shipping Method Definition
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The shipping methods from the same service provider may be enabled in different shipping rules.

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

* UPS Worldwide Expedited with +10$ surcharge (enabled by shipping rule A).
* UPS Worldwide Express with +5$ surcharge (enabled by shipping rule A).
* UPS Next Day Air with +5$ surcharge (enabled by shipping rule B).


.. _doc--shipping-rules--actions--create:

Create a Shipping Rule
----------------------

To create a shipping rule:

1. Ensure that the integrations for the shipping methods that you plan to use (UPS, FedEx, Flat Rate, etc.) are already configured. For more information on shipping method integrations and how to configure them, see :ref:`Shipping Method Integration <sys--integrations--manage-integrations--ups--flat-rate>`.

2. In the main menu, navigate to **System > Shipping Rules**. The list of shipping rules opens.

   .. image:: /user/img/system/shipping_rules/shipping_rule_list.png

#. Click **Create Shipping Rule** on the top right. The shipping rule create page opens.

#. In the **General Information** section, provide the following information:

   - Select the **Enabled** check box to activate the shipping rule. You may keep it unselected while you are drafting and testing the conditions.

   - **Name**—Specify the shipping rule name.

   - **Sort Order**—Specify the sort order to set the priority compared to other shipping rules. It is used to select which shipping method to apply when more than one satisfy the defined conditions. See :ref:`Overlapping Shipping Methods Definition <doc--shipping-rules--overview--shipping-methods-overlap>`.

   - **Currency**—Select the shipping cost currency from the list. Please note that the list of available shipping methods will depend upon which currency is selected here.

   - Select the **Stop Further Rule Processing** check box to prevent applying other shipping rules with lower priority. See :ref:`Stop Further Rule Processing Mode <doc--shipping-rules--overview--stop-further-processing>`.

   .. image:: /user/img/system/shipping_rules/shipping_rule_general.png

#. If required, in the **Destinations** section, add one or more destinations to apply this shipping rule for. The shipping rule applies when the shipping address matches the provided destination(s). To add a destination:

   a) Click **+ Add**. The following section appears:

      .. image:: /user/img/system/shipping_rules/shipping_rule_destination1.png


   b) Provide the destination to apply the shipping rule for. Depending on the granularity that you require, you may provide just a country, a country and a state, or a country and a distinct list of postal codes.

      - **Country**—Select a country from the list.
      - **State**—Select the state from the list. The list of states appears after you have selected a country.
      - Enter the list of postal codes.

      .. image:: /user/img/system/shipping_rules/shipping_rule_destination2.png

      .. TODO: Use <delimiter> to separate values?

#. If required, in the **Conditions** section, specify the expression that describes the conditions when this shipping rule should be applied.

   .. image:: /user/img/system/shipping_rules/shipping_rule_condition.png

   For detailed information about the expression language used in the shipping and payment rules, please see the :ref:`Expression Language for Shipping and Payment Rules <payment-shipping-expression-lang>` guide.

#. In the **Shipping Method Configurations** section, add the shipping methods that should be available at the checkout when this shipping rule applies.

   a) Add shipping methods:

      - To add a single shipping method, select it from the list and click **+ Add**.

      - To add all available shipping methods, click **Add All**.

      .. image:: /user/img/system/shipping_rules/shipping_rule_method_add1.png

      .. warning::

         Only one shipping method per integration may be selected in the shipping rule. For example, to enable several flat rate options with various delivery SLA and insurance, please create a separate shipping rule for every option.

         A shipping method appears in the list only if it is configured to support the selected currency.

      To delete a shipping method, click the |IcDelete| **Delete** icon at the end of the corresponding row.

   b) Configure all selected shipping methods. Configuration options vary depending on a shipping method. For details on options available for different methods, see :ref:`Configure a Shipping Method in a Shipping Rule <doc--shipping-rules--shipping-methods--detailed>`. The configuration summary appears next to the shipping method name, in the **Options** column.

      .. image:: /user/img/system/shipping_rules/shipping_rule_method_summary.png

      If a shipping method appears collapsed, click the |IcPlusSquareO| **Expand** icon in front of its name to see the configuration options.

      .. image:: /user/img/system/shipping_rules/shipping_rule_method.png

#. In the **Websites** section, specify the website(s) that the shipping rule should apply to, if you have more than one website. This field is optional and may be left empty. Hold the Ctrl key to choose several websites, if necessary.

      .. note:: Please note that application of shipping rules to websites is only available for Enterprise customers.

      .. image:: /user/img/system/shipping_rules/SHRuleView1.png

   * When no website is selected, the shipping rule is always applied by default.

   * When at least one website is selected, the shipping rule will apply to the orders created in the storefront of the specified website.

#. Click **Save**.

.. _doc--shipping-rules--shipping-methods--detailed:

Configure a Shipping Method in a Shipping Rule
----------------------------------------------

After you have added a shipping method to the shipping rule, you are prompted to provide the information that configures the shipping fee components and the method to calculate it.

Flat Rate
^^^^^^^^^

For the flat rate shipping method, provide the following information:

 * **Price**—A shipping price based on your agreement with the shipping service provider. The final shipping price depends on the **Type** option (*Pre Item*/*Per Order*).
 * **Handling fee**—An additional cost for order processing charged by your company.
 * **Type**—The way a shipping price is calculated for the order. Supported options:

   - **Per Item**—A shipping price for an order is calculated by multiplying product line item quantities (e.g., 5 cups of coffee, 10 napkins, and 5 cookies give us total of 20 items) and flat rate price (e.g. 1$). Finally, we add a handling fee (e.g. 10$) on top of the resulting amount. The shipping cost for this order is 20*1$+10$=30$
   - **Per Order**—A shipping price for an order is calculated as a sum of the specified price and handling fee. For example, if you have specified *$1* for **Price** and *$10* for **Handling fee**, then the shipping price for each order is $1+$10=$11

For example:

.. image:: /user/img/system/shipping_rules/shipping_rule_method_flat.png

UPS
^^^

For the UPS shipping method, provide the following information:

* In the **Surcharge** field on top, enter a value that you want to be added to the standard UPS rates and the option surcharge (like the handling fee per order).

* In the **Additional Options** section, provide the following information for each option that you want to use:

  - **Surcharge**—To customize the shipping cost, enter a value to charge on top of the UPS standard rates (like the extra cost for this shipping method). It is applied together with the global shipping method surcharge.
  - Select the **Active** check box in the **Status** column to enable the option.

For example:

.. image:: /user/img/system/shipping_rules/shipping_rule_method_ups.png


FedEx
^^^^^

For the FedEx shipping method, provide the following information:

* In the **Surcharge** field on top, enter a value that you want to be added to the standard FedEx rates and the option surcharge (like the handling fee per order).

* In the **Additional Options** section, provide the following information for each option that you want to use:

  - **Surcharge** — To customize the shipping cost, enter a value to charge on top of the FedEx standard rates (like the extra cost for this shipping method). It is applied together with the global shipping method surcharge.
  - Select the **Active** check box in the **Status** column to enable the option.

For example:

.. image:: /user/img/system/shipping_rules/fedex_shipping_rule.png

DPD
^^^

In the **Additional Options** section, provide the following information for each option that you want to use:

- **Handle Fee**—An additional cost for order processing (packing and mailing, etc) charged by your company. It is applied as a surcharge to the flat fee specified in the used DPD integration.
- Select the **Active** check box in the **Status** column to enable the option.

.. image:: /user/img/system/shipping_rules/shipping_rule_method_dpd.png

.. _doc--shipping-rules--actions--enable:

Manage a Shipping Rule
----------------------

Enable a Shipping Rule
^^^^^^^^^^^^^^^^^^^^^^

To enable a shipping rule:

1. In the main menu, navigate to **System > Shipping Rules**.

2. Choose the required shipping rule in the list, click the |IcMore| **More Options** menu at the end of the corresponding row.

3. Click the |IcActivate| **Activate** icon.

   .. image:: /user/img/system/shipping_rules/shipping_rule_enable.png

To enable several shipping rules at the same time:

1. Select the checkboxes on the left of the corresponding rows. The selected shipping rules will be highlighted in yellow.

2. Click |IcMore| on the far right of table header.

3. Click |IcActivate| **Enable**.

  .. image:: /user/img/system/shipping_rules/SRuleMassAction.png

Filter a Shipping Rule List
^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can use filters on the shipping rules list page to find the required records quicker:

1. To show filters, click |IcFilter| above the table on the far right.

   .. image:: /user/img/system/shipping_rules/SRulesFilters.png

   Filters are hidden by default.

2. To apply a filter, click on its button in the bar, and specify your query in the control that appears.

   .. note:: Filter controls might look different depending on the type of data you are going to filter, e.g. textual, numeric, a date or an option set.

   .. image:: /user/img/system/shipping_rules/SRFilterButton.png

Organize a Shipping Rule List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To define which columns to show in the table, click |IcSettings| above the table on the far right:

   .. image:: /user/img/system/shipping_rules/SRuleGridSettings.png

* To choose the columns to be displayed in the table, select the check box next to the required column under **Show**. Clear the check box to make the column disappear from the table.

* To change the order of the columns, click |IcReorder| next to the name of the column you wish to move, hold the mouse button and drag the column to the required position.


**Related Topics**

* :ref:`Shipping Configuration Concept Guide <admin-guide--shipping>`
* :ref:`System Shipping Configuration <configuration--guide--commerce--configuration--shipping>`
* :ref:`Shipping Method Integration <user-guide--shipping--configuration--common-details>`

.. include:: /include/include-images.rst
   :start-after: begin


.. toctree::
   :maxdepth: 2
   :hidden:

   expression-lang


.. include:: /include/include-links.rst
   :start-after: begin
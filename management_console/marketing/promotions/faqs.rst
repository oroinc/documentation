.. _user-guide--marketing--promotions--issues:

Review the FAQs
---------------

.. begin

This quick reference guide illustrates the most common issues that you may face when working with promotions and coupons and provides quick solutions and advice.

1. **I have set up a promotion to be triggered by Coupons and Conditions. I have not generated any coupons but I have added an expression to trigger the promotion based on specific criteria**.

   The promotion hasn’t been triggered because either of the following conditions must be met for the **Coupons and Conditions** option:

   * You’ve generated coupons and added conditions
   * You’ve generated coupons

   If you need to trigger the promotion solely by conditions, use the **Conditions Only** option.

2. **I need to create a promotion but I don’t see this option in the main menu**.

   Make sure that promotions are enabled for your OroCommerce instance. If you have the corresponding permissions, navigate to **System > Configuration > Commerce > Promotions** and select the *Enable Promotions* check box. Otherwise, please contact your administrator. 

3. **I have created a new promotion for all products but a different promotion seems to be applied instead**.

   Make sure the sort order for the new promotion is lower than the promotion that is currently applied (the lower the sort order the higher the priority). Also, make sure that **Further Rule Processing** has not been selected for the promotion with a lower priority, as this would prevent a new promotion from being applied.

4. **When I am trying to filter out products for the promotion, some of the products that I need to be eligible for the promotion are not displayed**.

   When adding items eligible for the discount, make sure that they have not been accidentally excluded (i.e., added to the **Excluded** tab). Excluded products are not displayed on the list. Also, keep in mind that if the unit of quantity selected for the promotion does not match the product unit, the promotion will not be applied to them.

5. **I have generated a bunch of coupons for a promotion and I am trying to apply them to the order through the management console but I keep getting an error message. It says that the discount has already been applied**.

   You cannot apply two coupon codes to one order if they belong to the same promotion. Use the **Add Special Discount** option to add an additional discount, if necessary. Alternatively, create another promotion and generate new coupons for it.

.. stop

**Related Topics**

* :ref:`Create a Promotion <user-guide--marketing--promotions--create>`
* :ref:`Expression Syntax for Promotions <user-guide--promotion--expression>`
* :ref:`Manage Discounts in Order <user-guide--sales--orders--promotions>`
* :ref:`Create and Manage Coupons <user-guide--marketing--promotions--coupons>`
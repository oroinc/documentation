.. _sys-config--commerce--sales--promotions:

Promotions
==========

.. begin

You can enable or disable :ref:`promotions <user-guide--marketing--promotions>` and :ref:`coupons <user-guide--marketing--promotions--coupons>`, as well as control their strategy across your application in the system configuration.


To reach promotion configuration:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Promotion** in the menu to the left.

   .. image:: /user_doc/img/system/config_commerce/sales/PromotionSysConfig.png

   .. note:: By default, promotions are enabled and the **Combine All Discounts** strategy is set.

3. To customize the default settings:

  a) Clear the **Use Default** check box next to the **Enable Promotion** option. This will enable you to clear the option check box and disable promotions in your Oro application.
  b) Clear the **Use Default** check box next to the **Discount Strategy** and select one of the following options -- *Combine All Discounts* or *Best Value Discounts Only*.

     * When *Combine All Discounts* is selected, all discount options applicable to products are used in combination.

     * When *Best Value Discounts Only* is selected, only the promotion that gives the best value is applied to products.

4. Click **Save**.

**Related Topics**

* :ref:`Promotions in OroCommerce <user-guide--marketing--promotions>`
* :ref:`Promotions and Coupons in Use <user-guide--marketing--promotions--coupons--sample>`
* :ref:`Coupons <user-guide--marketing--promotions--coupons>`

.. finish

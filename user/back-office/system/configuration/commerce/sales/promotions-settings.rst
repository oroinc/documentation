:oro_documentation_types: OroCommerce

.. _sys-config--commerce--sales--promotions:

Configure Global Promotions Settings
====================================

.. begin

You can enable or disable :ref:`promotions <user-guide--marketing--promotions>` and :ref:`coupons <user-guide--marketing--promotions--coupons>`, as well as control their strategy across your application in the system configuration. You can also control whether to enable or disable entering coupon codes that are different only by letter case (e.g., *SpringSale*, *SPRINGSALE*, *springsale*) during the checkout.


To reach promotion configuration:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Sales > Promotion** in the menu to the left.

   .. image:: /user/img/system/config_commerce/sales/PromotionSysConfig.png
      :alt: Global promotions configuration

   .. note:: By default, promotions are enabled and the **Combine All Discounts** strategy is set.

3. To customize the default settings, clear the **Use Default** check box next to the option.

4. Enable or disable the following options as required:

    **Enable Promotions** --- the option determines whether to activate or deactivate the promotions feature and promotions-related functionality in your Oro application.

    .. hint:: The **Case-Insensitive Coupon Codes** feature is available since OroCommerce v4.1.3. To check which application version you are running, see the :ref:`system information <system-information>`.

    **Case-Insensitive Coupon Codes** --- option determines whether to consider or ignore the letter case of the applied coupon codes. By default, the option is disabled, meaning that the system carefully checks the entered coupon code against the letter case, so *SpringSale*, *SPRINGSALE*, and *springsale*, are considered to be the three different codes. When the option is enabled, the mentioned codes will be considered equal.

    **Discount Strategy** --- the option determines which strategy to use when calculating the promotion discount for a product:

         * When *Combine All Discounts* is selected, all discount options applicable to products are used in combination.

         * When *Best Value Discounts Only* is selected, only the promotion that gives the best value is applied to products.

5. Click **Save**.

**Related Topics**

* :ref:`Promotions in OroCommerce <user-guide--marketing--promotions>`
* :ref:`Promotions and Coupons in Use <user-guide--marketing--promotions--coupons--sample>`
* :ref:`Coupons <user-guide--marketing--promotions--coupons>`

.. finish

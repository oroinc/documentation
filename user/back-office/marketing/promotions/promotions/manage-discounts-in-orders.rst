:oro_documentation_types: OroCommerce

.. _user-guide--sales--orders--promotions:

Manage Discounts in Orders
--------------------------

You can view discounts applied to a specific order under the dedicated **Promotions and Discounts** section on the order page. This section is divided into **All Promotions** and **All Special Discounts**.

Within **All Promotions**, you can view promotions and coupon codes.

Within **All Special Discounts**, you can view special discounts added manually.

.. image:: /user/img/marketing/promotions/PromotionsInOrdersNew.png
   :alt: View the information specified in the Promotions and Discounts section

.. _user-guide--sales--orders--promotions--apply-multiple-discounts:

Apply Multiple Discounts to an Order
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

When items in the order qualify for multiple discounts, several promotions or coupon codes can be added to it.

.. note:: Keep in mind that the application of promotions to orders may be subject to the sort number (priority) assigned to the promotions and whether any of them have **Stop Further Rule Processing** enabled.

          You cannot use two coupon codes for one order if they are part of the same promotion.

Promotion can be applied to the existing order in two ways:

* **By creating a new promotion** --- If there are no available promotions applicable to the items from the order, you need to :ref:`create a new promotion <user-guide--marketing--promotions--create>` with the necessary products added to it. Once you open the order edit page, the created promotion will be added to the order automatically and will be displayed in the **Promotions and Discounts** section under **All Promotions**.

* **By applying an existing promotion** --- If the promotion applicable to the order items was created after the order had been placed, it will be added automatically once you open the order edit page. This promotion will be displayed in the **Promotions and Discounts** section under **All Promotions**.

The following illustration is an example of multiple discounts applied to one order:

.. image:: /user/img/marketing/promotions/MultiplePromotionsAppliedtoOrder.png
   :alt: An example of multiple discounts applied to one order

.. _user-guide--sales--orders--promotions--add-special-discount:

Add Special Discounts to an Order
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add one-time personalized discounts for selected customers:

1. On the order page, click **Add Special Discount** on the top.

   Alternatively:

   Click **Add Special Discount**  under **Promotions and Discounts > All Special Discounts**.

   .. image:: /user/img/marketing/promotions/AddSpecialDiscount4.png
      :alt: Highlight the Add Special Discount button under the Promotions and Discounts section

2. In the form that opens, provide the following information:

   * **Discount** --- Provide the desired discount amount (in currency or percents). This field is mandatory.
   * **Description** --- Provide the reason for the special discount. This field is optional.

   .. image:: /user/img/marketing/promotions/AddSpecialDiscount2.png
      :alt: Providing the discount and description in the form

3. Click **Apply**.

  .. image:: /user/img/marketing/promotions/AddSpecialDiscount3.png
     :alt: View the discount saved in the All Special Discounts section under Promotions and Discounts

This way, you can apply one or more special discounts to selected orders.

Manage Discounts When Editing the Order
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can manage promotions, coupons and special discounts for the required order by opening its edit page and navigating to the **Promotions and Discounts** section.

Under **All Promotions**, you can |IcView| view details of the selected promotion or coupon code, |IcDeactivate| deactivate, or |IcDelete| delete them from the system.

Under **All Special Discounts**, you can |IcEdit| edit, or |IcDelete| remove the discount.

.. image:: /user/img/marketing/promotions/ManagePromotionsIcons.png
   :alt: View the actions that you can do to promotions and discounts

.. finish_promotions_in_order

.. include:: /include/include-images.rst
   :start-after: begin



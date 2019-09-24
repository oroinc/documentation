:oro_documentation_types: commerce

.. _user-guide--pricing--create-pricelist:

Create a Price List
===================

.. note::
    See a short demo on |how to configure price lists for customers and customer groups in OroCommerce|, or keep reading the step-by-step guidance below.

    .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/KYR1M6gykio" frameborder="0" allowfullscreen></iframe>

To create a new price list:

1. Navigate to **Sales > Price Lists** using the main menu.

   .. image:: /user/img/sales/pricelist/PriceLists.png
      :class: with-border

2. Click **Create Price List**. The following page opens:

   .. image:: /user/img/sales/pricelist/PriceListsCreate.png
      :class: with-border

3. In the **General** section, provide the following information:

   a) **Name** --- Type in the price list name.

   b) **Currencies** --- Select one or more currencies that you would like to enable for the prices in the price list.

   .. note:: The price in every currency should be provided explicitly. There is no automatic conversion.

   c) **Active** --- Set the option to enable the price list. Keep the price list inactive while drafting the prices. Deactivate the price list to disable temporarily the prices it contains.

   d) **Schedule** --- Add a timetable for price list activation and deactivation.

      Click *Choose a date* to open a calendar and pick the date.

      .. image:: /user/img/sales/pricelist/PriceListsCreate_general_schedule.png
         :width: 40%
         :class: with-border

      Click *time* and select the activation or deactivation time from the list. Alternatively, type it in and press **Enter**.

      .. image:: /user/img/sales/pricelist/PriceListsCreate_general_schedule_time.png
         :width: 50%
         :class: with-border

      To add another time slot, click **+ Add** below the time table. Add as many slots as you need.

4. In the **Product Assignment** section, enter criteria to filter the products and add them to the price list. See :ref:`Automated Rule-Based Price Management <user-guide--pricing--price-list-auto>` for more information.

   .. note:: Optionally, in addition to rule-based product assignment, you can add a product price to the price list manually in one of the following ways:

      * While editing  product (in the **Product Prices** section).

        .. image:: /user/img/sales/pricelist/prices_for_product.png
           :class: with-border

        .. TODO elaborate

      * When viewing the price list details, by clicking **+ Add Product Price**.

        .. image:: /user/img/sales/pricelist/prices_for_price_list.png
           :class: with-border

        .. TODO elaborate

      You can override the existing rule-based price. A manual entry has higher priority.

5. In the **Price Calculation Rules** section, specify rules for price calculation based on the price attributes (e.g. msrp) and other product details. You may use conditions to apply the rule to the subset or the filtered products. See :ref:`Automated Rule-Based Price Management <user-guide--pricing--price-list-auto>` for more information.

.. TODO elaborate... deeply. Can we have multiple rule + condition pair per price list?

6. Click **Save**.

.. include:: /include/include-links.rst
   :start-after: begin
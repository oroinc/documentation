:oro_documentation_types: OroCommerce

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
      :alt: The list of all price lists available in the system

2. Click **Create Price List**. The following page opens:

   .. image:: /user/img/sales/pricelist/PriceListsCreate.png
      :class: with-border
      :alt: The create price list page

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
         :alt: Scheduling a date to activate the price list

      Click *time* and select the activation or deactivation time from the list. Alternatively, type it in and press **Enter**.

      .. image:: /user/img/sales/pricelist/PriceListsCreate_general_schedule_time.png
         :width: 50%
         :class: with-border
         :alt: Scheduling time to activate the price list

      To add another time slot, click **+ Add** below the time table. Add as many slots as you need.

4. In the **Product Assignment** section, enter criteria to filter the products and add them to the price list. See :ref:`Automated Rule-Based Price Management <user-guide--pricing--price-list-auto>` for more information.

   .. note:: Optionally, in addition to rule-based product assignment, you can add a product price to the price list manually in one of the following ways:

      * While editing  product (in the **Product Prices** section).

        .. image:: /user/img/sales/pricelist/prices_for_product.png
           :class: with-border
           :alt: Adding the prices for the medical tag product to the Default PL manually when editing the product details

      * When viewing the price list details, by clicking **+ Add Product Price**.

        .. image:: /user/img/sales/pricelist/prices_for_price_list.png
           :class: with-border
           :alt: Adding product price in the popup dialog that opens when clicking the Add Product Price button

      You can override the existing rule-based price. A manual entry has higher priority.

5. In the **Price Calculation Rules** section, specify rules for price calculation based on the price attributes (e.g. msrp) and other product details. You may use conditions to apply the rule to the subset or the filtered products. See :ref:`Automated Rule-Based Price Management <user-guide--pricing--price-list-auto>` for more information.

6. Click **Save**.

.. include:: /include/include-links-user.rst
   :start-after: begin
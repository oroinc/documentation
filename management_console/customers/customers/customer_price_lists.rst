.. _customers--customers--edit--price-lists:

Configure Price List per Customer
---------------------------------

.. begin

To change the price list settings for the customer:

1. Navigate to **Customers > Customer** in the main menu.

2. Click the |IcMore| **More Options** menu to the right of the necessary customer and then click the |IcEdit| **Edit** icon to start editing customer details.

3. In the **Price Lists** section, do the following to configure price lists that are used for price calculation when the customer users access the particular website (for example, *Default*):

   .. tip:: Switch between the websites using tabs.

   .. image:: /img/customers/customers/customer_price_lists.png
      :class: with-border

   a) Select one of the following values for the **Fallback** option:

      * *Customer Group* --- OroCommerce uses :ref:`Price Lists from the customer group configuration <customers--customer-groups--edit--price-lists>` to calculate the prices shown in the storefront.

      * *Current customer only* --- For price calculation, OroCommerce uses the configurations (per website) in the current customer group.

   b) To add a price list, click **+ Add Price List** and select the price list in the newly added line. After you start typing the price list name, the list of suggestions appears. Press **Enter** or click the suggested value to add the price list.

   .. image:: /img/customers/customers/pricing_pricelist_add.png

   .. note:: The price list is appended to the bottom of the list and, initially, has a lower priority than the existing price lists. Adjust the price list priority if necessary and specify whether the merge is allowed (the later is shown only for the **Merge by priority** price selection strategy).

   c) To control the way prices are merged into the combined price list, select or clear the **Merge Allowed** option for the price lists.

      When merge is allowed, the prices for the tiers and units that are missing in the higher priority price list may be covered by the prices from the lower priority price lists that support the price merge.

      .. TODO copy description of the behavior from dev doc

   d) To delete a price list from the default price lists, click the |IcDeactivate| **Deactivate** icon at the end of the corresponding row.

   e) To change the price list priority, click and hold the |IcReorder| **Sort** icon, and drag the price list up or down the list.

4. Click **Save**.

.. finish


**Related Articles**

* :ref:`Pricing Configuration <pricing-configuration>`
* :ref:`Price List Configuration per Website <sys--website--edit--price-lists>`
* :ref:`Price List Configuration per Customer Group <customers--customer-groups--edit--price-lists>`


.. include:: /img/buttons/include_images.rst
   :start-after: begin

:oro_documentation_types: OroCommerce

.. _customers--customer-groups--edit--price-lists:

Configure Price List per Customer Group
---------------------------------------

.. begin

To change the price list settings for the customer group:

1. Navigate to **Customers > Customer Group** in the main menu.

2. Click the |IcMore| **More Options** menu to the right of the necessary customer group and then click the |IcEdit| **Edit** icon to start editing the group details.

3. In the **Price Lists** section, do the following to configure price lists that are used for price calculation when the customer users who belong to this customer group access the particular website (for example, *Default*):

   .. tip:: Switch between the websites using tabs.

   .. image:: /user/img/customers/customer_groups/customer_group_price_lists.png
      :alt: The price list section of the All Customers customer group

   a) Select one of the following values for the **Fallback** option:

      * *Website* --- OroCommerce uses :ref:`Website Price Lists from the selected website configuration <sys--website--edit--price-lists>` to calculate the prices shown in the storefront.

      * *Current customer group only* --- For price calculation, OroCommerce uses the configurations (per website) in the current customer group.

   b) To add a price list, click **+ Add Price List** and select the price list in the newly added line. After you start typing the price list name, the list of suggestions appears. Press **Enter** or click the suggested value to add the price list.

   .. image:: /user/img/customers/customer_groups/pricing_pricelist_add.png
      :alt: Adding a new price list to the pricelist section

   .. note:: The price list is appended to the bottom of the list and, initially, has a lower priority than the existing price lists. Adjust the price list priority if necessary and specify whether the merge is allowed (the latter is shown only for the **Merge by priority** price selection strategy).

   c) To control the way prices are merged into the combined price list, select or clear the **Merge Allowed** option for the price lists.

   When the merge is allowed, the prices for the tiers and units missing in the higher priority price list may be covered by the prices from the lower priority price lists that support the price merge.

   d) To delete a price list from the default price lists, click the |IcDeactivate| **Deactivate** icon at the end of the corresponding row.

   e) To change the price list priority, click and hold the |IcReorder| **Sort** icon, and drag the price list up or down the list.

4. Click **Save**.

.. finish

**Related Articles**

* :ref:`Pricing Configuration <pricing-configuration>`

* :ref:`Price List Configuration per Website <sys--website--edit--price-lists>`

* :ref:`Price List Configuration per Customer <customers--customers--edit--price-lists>`



.. include:: /include/include-images.rst
   :start-after: begin

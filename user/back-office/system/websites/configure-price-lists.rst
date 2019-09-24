:oro_documentation_types: commerce

.. _sys--website--edit--price-lists:

Configure Price Lists per Website
---------------------------------

.. begin

To change the default price list settings for the website:

1. Navigate to **System > Websites** in the main menu.

2. Click the |IcMore| **More Options** menu to the right of the necessary website and click the |IcEdit| **Edit** icon to start editing the website details.

3. In the **Price Lists** section:

   .. image:: /user/img/system/websites/website_price_lists.png
      :class: with-border

   a) Select one of the following values for the **Fallback** option for the users who are visiting this website:

      * *Config* --- OroCommerce uses :ref:`Default Price Lists from the system configuration <sys--config--commerce--catalog--pricing>` to calculate the prices shown in the storefront.

      * *Current website only* --- For price calculation, OroCommerce uses the configuration from the website settings.

   b) To add a price list, click **+ Add Price List** and select the price list in the newly added line. After you start typing the price list name, the list of suggestions appears. Press **Enter** or click the suggested value to add the price list.

      .. image:: /user/img/system/websites/pricing_pricelist_add.png

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

* :ref:`Price List Configuration per Customer Group <customers--customer-groups--edit--price-lists>`

* :ref:`Price List Configuration per Customer <customers--customers--edit--price-lists>`



.. include:: /include/include-images.rst
   :start-after: begin

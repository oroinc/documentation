.. _user-guide--marketing--web-catalog--content-variant-product-collection:

.. start

Add a Product Collection (Web Catalog Content)
""""""""""""""""""""""""""""""""""""""""""""""

Product Collection is a filter-based segment that helps you display a custom and dynamic set of products in the web catalog similarly to the category contents.

1. To add a product collection node to the menu in the OroCommerce storefront:

   Select the **Add Product Collection** in the Content Variants list.

   The following section shows:

   .. image:: /user_guide/img/marketing/web_catalogs/ProductCollection.png
      :class: with-border

2. To name a segment of the product collection:

   Enter the segment name for the product collection in the provided field.

   .. image:: /user_guide/img/marketing/web_catalogs/SegmentName.png
      :class: with-border

3. To add a product to the collection via filter:

   In the All Added tab, click |IcFilter| **Advanced Filter** to set up a :ref:`filter <user-guide-getting-started-filters>` that will limit the products list and include only the necessary products.

   .. image:: /user_guide/img/marketing/web_catalogs/AdvancedFilter.png
      :class: with-border

   .. note:: |IcFilter| **Advanced Filter** is hidden by default.


   Click **Preview Results** to check whether the products found via the filter match your criteria, or to exclude unnecessary items from the list.

   .. image:: /user_guide/img/marketing/web_catalogs/PreviewResultsExclude.png

   .. note:: To manage the columns displayed Within the products grid, click |IcSettings|.

4. To add a product to the collection manually:

   Click **Add** next to |IcFilter| **Advanced Filter** to add the selected products manually. This can be used in cases when you have few products to be added and there is no need to set up a complicated filter, or when you need to add specific products that may be out of the filter's scope.

   .. image:: /user_guide/img/marketing/web_catalogs/AddProductsManually.png
      :class: with-border

  Manually added items will appear both in the **Manually Added** and **All Added** tabs.

5. To exclude items from the collection:

   To ensure that specific items are excluded from the list of the product collection and will not be included automatically or manually, click **Add** in the **Excluded** tab:

   .. image:: /user_guide/img/marketing/web_catalogs/AddToExluded.png
      :class: with-border

   Tick the Selected box to the left of the necessary products, and click **Add**.

   .. note:: You may use filter on the top of the dialog to limit the scope of the products and make it fit into the visible area.

   .. image:: /user_guide/img/marketing/web_catalogs/ExcludeItemsFromProductCollection.png
      :class: with-border

6. To reset products:

   To clear all filters and reset the product collection to the default state, click **Reset Products** next to the tabs.

   .. image:: /user_guide/img/marketing/web_catalogs/ResetProducts.png
      :class: with-border

7. This step applies only to the content nodes with more than one content variant.

   When your collection is not selected as a default variant for the content node, there is a *Restrictions* section beneath the product collection preview. In this section, you can define the condition when the product collection overrides the default content variant. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

8. Click **Save** when you are done filling in the web catalog content node or keep adding the content variants.

.. stop

.. include:: /img/buttons/include_images.rst
   :start-after: begin
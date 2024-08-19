.. _user-guide--marketing--web-catalog--content-variant:

Configure Content Variants for the Content Node
===============================================

This section provides an overview of the content node types and guidance on their setup.

.. note:: The first content variant added to the node is marked as the default variant. Specify the restrictions next to the content variant details when adding more content variants. These restrictions will limit the use of this content variant only to specific cases.

.. image:: /user/img/marketing/web_catalogs/ContentVariantSection.png
   :alt: Specify the restrictions for the default content node

.. _user-guide--marketing--web-catalog--content-variant-system-page:

Add a System Page
-----------------

The system page is one of the standard pre-designed pages of the OroCommerce storefront (e.g., Homepage, Requests for Quotes, Open Orders).

To add a system page to the menu in the OroCommerce storefront:

#. Select the **Add System Page** in the Content Variants list.

   .. image:: /user/img/marketing/web_catalogs/WebCatalogCreateContentVariantsSystemPage.png
      :alt: Add system page and specify restrictions

#. Select the system page from the list.

#. This step applies only to the content nodes with more than one content variant.

   When your system page is not selected as a default variant for the content node,  you can define the condition when the system page overrides the default content variant. See the :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

#. Click **Save** when you have filled in the web catalog content node or keep adding the content variants.

.. _user-guide--marketing--web-catalog--content-variant-product-page:

Add a Product Page
------------------

The product page node is a direct link to the product details in the OroCommerce storefront.

To add a product page node to the menu in the OroCommerce storefront:

#. Select the **Add Product Page** in the Content Variants list.

   .. image:: /user/img/marketing/web_catalogs/WebCatalogCreateContentVariantsProductPage.png
      :alt: Add product page and spec there is a *Restrictions* section beneath the selected system page.ify the restrictions

#. Select the product from the list. To use search, start typing the product name or SKU in the box. To use filtering, click on the **bars**, and select the filtering conditions in the *Manage filters* section.

#. This step applies only to the content nodes with more than one content variant.

   When your product page is not selected as a default variant for the content node, you can define the condition when the product details override the default content variant in the *Restrictions* section beneath the selected product. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

#. Click **Save** when you have filled in the web catalog content node or continue to add the content variants.

.. _user-guide--marketing--web-catalog:

Add All Products Page to Web Catalog
------------------------------------

.. begin_all_products

Once the All Products page has been enabled in the system configuration :ref:`globally <sys--conf--commerce--catalog--special-pages--global>` or :ref:`per website <sys--conf--commerce--catalog--special-pages--website>`, you can add it as part of your web catalog.

.. note:: We recommend enabling the All Products page exclusively for *small catalogs* with no more than a few hundred products, otherwise browser performance might be affected.

1. Navigate to **Marketing > Web Catalogs** in the main menu.
2. For the necessary web catalog, hover over the |IcMore| more actions menu to the right and click |IcEditContentTree| to start editing the catalog content tree.

  .. image:: /user/img/marketing/web_catalogs/AllProductsEditContentTree.png
     :alt: Click the content tree icon in the more options menu of the Default Web Catalog

3. In the **Content Nodes** menu on the left, click on the node to select the one you want to add the All Products page to.
4. Click **Create Content Node** on the top right of the page.
5. Complete the required fields to :ref:`configure the web catalog node <user-guide--marketing--web-catalog--content-node>`.
6. In the **Content Variants** section, make sure to add the All Products as the system page. To do this:

   1) Click **Add System Page**.

   2) From a **System Page Route** list, select the *Oro Catalog Frontend Product Allproducts (All Products page)*.

   .. image:: /user/img/marketing/web_catalogs/AllProductsContentVariants.png
      :alt: Selecting the All products page for the System Page Route for the Default Web Catalog

   .. note:: See :ref:`Content Variants <user-guide--marketing--web-catalog--content-variant>` topic for more information on using content variants. See :ref:`System Page <user-guide--marketing--web-catalog--content-variant-system-page>` topic for more information on this content variant type.

7. Once all the details have been provided, click **Save** on the top right of the page.

.. finish_all_products

.. _user-guide--marketing--web-catalog--content-variant-category:

Add a Category
--------------

A category node is a direct link to the product category with the list of products in the OroCommerce storefront.

To add a category node to the menu in the OroCommerce storefront:

1. Select **Add Category** in the Content Variants list.

   .. image:: /user/img/marketing/web_catalogs/WebCatalogCreateContentVariantsCategory.png
      :alt: Select a category from the content tree

2. Click |Bdropdown| next to **Sub-Categories** to select the required option from the list.

   The available options are:

   * **Include, show as filter** - Used to include all the products assigned to the subcategories of the selected category and the products already assigned directly. The subcategories of the first level with at least one product will be displayed as a category filter in the OroCommerce storefront.

     .. image:: /user/img/marketing/web_catalogs/subcategory_filter_1.png
        :alt: Illustration of the Include, show as filter option

   * **Do not include** - Used to include the products assigned only to the selected category. If the category has a subcategory, its product items will not be displayed.

3. Select the category from the product catalog tree. To use search, start typing the category name in the box. Use **>** and **v** to expand/collapse the tree node.

   .. image:: /user/img/marketing/web_catalogs/subcategory_filter_3.png
      :alt: Start typing the category name in the search bar

4. This step applies only to the content nodes with more than one content variant.

   When your category is not selected as a default variant for the content node, you can define the condition when the selected category overrides the default content variant in the *Restrictions* section beneath the categories tree. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

5. Click **Save** when you have filled in the web catalog content node or keep adding the content variants.

.. _user-guide--marketing--web-catalog--content-variant-landing page:

Add a Landing Page
------------------

Landing Page node is a link to the :ref:`custom content page <user-guide--landing-pages>` created in the **Marketing > Landing Pages** section.

To add a landing page node to the menu in the OroCommerce storefront:

#. Select the **Add Landing Page** in the Content Variants list.

   .. image:: /user/img/marketing/web_catalogs/WebCatalogCreateContentVariantsLandingPage.png
      :alt: Add a landing page and specify the restrictions

#. Select the existing landing page from the list. To use search, start typing the keywords in the box to search for the necessary page. To use filtering, click on the **bars**, and select the filtering conditions in the *Manage filters* section. Alternatively, you can create a new landing page:

   #) To create a new landing page, click **+** to the right from the Landing page list.

   #) Fill in the landing page details and contents as described :ref:`here <user-guide--landing-pages-create>`.

   Enable the **Do Not Render Title** option if you do not want the title of the landing page to be displayed in the storefront.

#. This step applies only to the content nodes with more than one content variant.

   When your landing page is not selected as a default variant for the content node, you can define the condition when the landing page overrides the default content variant in the *Restrictions* section beneath the selected landing page. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

#. Click **Save** when you are done filling in the web catalog content node or keep adding the content variants.

.. _user-guide--marketing--web-catalog--content-variant-product-collection:

Add a Product Collection
------------------------

Product Collection is a filter-based segment that helps you display a custom and dynamic set of products in the web catalog similarly to the category contents.

.. note:: You can control the frequency of the product collections indexation. By default, product collections are indexed every hour. See the :ref:`Product Collections Configuration <configuration--guide--commerce--configuration--product-collections>` guide for the details on how to change the default indexation frequency.

1. To add a product collection node to the menu in the OroCommerce storefront:

   Select the **Add Product Collection** in the Content Variants list.

   .. image:: /user/img/marketing/web_catalogs/ProductCollection.png
      :alt: Add a product collection and specify the restrictions

2. To name a segment of the product collection:

   Enter the segment name for the product collection in the provided field.

   .. image:: /user/img/marketing/web_catalogs/SegmentName.png
      :alt: Enter the segment name for the product collection in the provided field

3. To add a product to the collection via filter:

   In the All Added tab, click |IcFilter| **Advanced Filter** to set up a :ref:`filter <user-guide-getting-started-filters>` that will limit the products list and include only the necessary products.

   .. image:: /user/img/marketing/web_catalogs/AdvancedFilter.png
      :alt: Set up a filter to limit the products list

   .. note:: |IcFilter| **Advanced Filter** is hidden by default.

   Click **Preview Results** to check whether the products found via the filter match your criteria or to exclude unnecessary items from the list.

   .. image:: /user/img/marketing/web_catalogs/PreviewResultsExclude.png
      :alt: Click Preview Results

   .. note:: To manage the columns displayed Within the products grid, click |IcSettings|.

4. To add a product to the collection manually:

   Click **Add** next to |IcFilter| **Advanced Filter** to add the selected products manually. This can be used when you have a few products to be added, and there is no need to set up a complicated filter, or when you need to add specific products that may be out of the filter's scope.

   .. image:: /user/img/marketing/web_catalogs/AddProductsManually.png
      :alt: Click Add and select the products manually

  Manually added items will appear both in the **Manually Added** and **All Added** tabs.

5. To exclude items from the collection:

   To ensure that specific items are excluded from the list of the product collection and will not be included automatically or manually, click **Add** in the **Excluded** tab:

   .. image:: /user/img/marketing/web_catalogs/AddToExluded.png
      :alt: Click Add in the Excluded tab

   Tick the Selected box to the left of the necessary products, and click **Add**.

   .. note:: You can use the filter on the top of the dialog to limit the scope of the products and make them fit into the visible area.

   .. image:: /user/img/marketing/web_catalogs/ExcludeItemsFromProductCollection.png
      :alt: Select the necessary products manually

6. To reset products:

   To clear all filters and reset the product collection to the default state, click **Reset Products** next to the tabs.

   .. image:: /user/img/marketing/web_catalogs/ResetProducts.png
      :alt: Click Reset Products next to the tabs

7. To define a sort order for products:

   Each product selected in the All Added grid can have a sort order associated with it that will define the default order in which the product will appear in the storefront. 0 is the highest priority, and you can input any positive decimal number. Empty values will be sorted last. You can also click on the **Manage Sort Order** button to be able to manage the sort order of products in the product collection in a separate pop-up window. Products with grey background have sorting number assigned. Product with white background have no sorting order. You can drag and drop the horizontal background separator up and down to apply or clear the sorting order. All changes made to the sorting order in this dialog window will be applied immediately.

   .. image:: /user/img/marketing/web_catalogs/manage-sort-order.png
      :alt: Clicking the Manage Sort Order button opens a new pop-up window to bulk sort the products added to the product collection.

8. This step applies only to the content nodes with more than one content variant.

   When your collection is not selected as a default variant for the content node, you can define the condition when the product collection overrides the default content variant in the *Restrictions* section beneath the product collection preview. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

9. Click **Save** when you have filled in the web catalog content node or keep adding the content variants.

.. _user-guide--marketing--web-catalog--default-content-variant:

Set a Default Content Variant
-----------------------------

The first content variant added to the node is marked as the default variant.

When adding more content variants, they have a dedicated restrictions section next to the content variant details. These restrictions will limit the use of this content variant only to specific cases; the default option is used in any other case.

Select the radio on the top left of its type to set up a newly added content variant as default.

.. image:: /user/img/marketing/web_catalogs/change_default_variant.png
   :alt: Select the content variant to make it the default one

.. include:: /include/include-images.rst
   :start-after: begin


.. _user-guide--web-catalog-edit-content-tree:

Edit a Web Catalog Content Tree
===============================

.. contents:: :local:
   :depth: 4

To edit a web catalog content tree:

#. Navigate to **Marketing > Web Catalogs** in the main menu.

#. Click on the web catalog to open its details.

#. Click |IcEditContentTree| **Edit Content Tree** on the top right of the page.

   .. image:: /user_doc/img/marketing/web_catalogs/EditContentTree.png
      :alt: Clicking Edit Content Tree on the top right of the page

#. In the page that opens, fill in the details of the **homepage node** of the web catalog as described in the :ref:`Set Up the Homepage, First Level Menu, and Sub Menus <user-guide--marketing--web-catalog--root-node>` section.

   The content selected in the content variants of the **homepage node** is shown when the buyer navigates to the OroCommerce storefront. The **homepage node** also acts as a parent node for the web catalog menu and sub menu items. It is recommended to use Oro Frontend Root system page as a root node of your web catalog.

#. Under the **homepage node**, create main menu content nodes (e.g. first level of the main menu in the storefront) as described in the :ref:`Set Up the Homepage, First Level Menu, and Sub Menus <user-guide--marketing--web-catalog--root-node>` section. It is recommended to create a dedicated landing page for main menu nodes of your web catalog.

   .. image:: /user_doc/img/marketing/web_catalogs/WebCatalogCreate2.png
      :alt: Edit content tree

Once the main menu nodes are saved, create **sub-menu content nodes**. These will be shown as the second level of the main menu in the OroCommerce storefront:

#) Ensure that the appropriate main menu node is selected in the content nodes structure to the left.

#) Click **Create Content Node** on the top right of the page.

   .. image:: /user_doc/img/marketing/web_catalogs/CreateNestedNode.png
      :alt: Two steps to create a content node

   The following page opens:

   .. image:: /user_doc/img/marketing/web_catalogs/SubMenuNodeCreate.png
      :alt: A sample of a new sub menu node to be filled in

#) Set up the sub-menu node as described in the :ref:`Set Up the Homepage, First Level Menu, and Sub Menus <user-guide--marketing--web-catalog--root-node>` section.

#) Click **Save** on the top right of the page.

This way, you can set up as many sub-menu nodes as you need.

.. note:: You can drag the existing content nodes to a different position within the content tree on the left of the page, as illustrated below:

.. image:: /user_doc/img/marketing/web_catalogs/DragDropNode.png
   :alt: Dragging the existing content nodes between sub-menu nodes



Set Up the Homepage, First Level Menu, and Sub Menus
----------------------------------------------------

.. include:: /user_doc/back_office/marketing/web_catalogs/edit_content_tree/first_level_menu.rst
   :start-after: begin
   :end-before: finish



.. _user-guide--marketing--web-catalog--content-variant:

Configure Content Variants for the Content Node
-----------------------------------------------

This section provides an overview of the content node types and a brief guidance on their setup.

.. note:: The first content variant that is added to the node is marked as the default variant. When you add more content variants, please, specify the restrictions next to the content variant details. These restrictions will limit the use of this content variant only to specific cases.

.. image:: /user_doc/img/marketing/web_catalogs/ContentVariantsDropDown.png
   :alt: Specify the restrictions for the default content node


.. _user-guide--marketing--web-catalog--content-variant-system-page:

Add a System Page
^^^^^^^^^^^^^^^^^

System page is one of the standard pre-designed pages of OroCommerce storefront (e.g. Requests for Quotes, Open Orders).

To add a system page to the menu in the OroCommerce storefront:

#. Select the **Add System Page** in the Content Variants list.

   The following section shows:

   .. image:: /user_doc/img/marketing/web_catalogs/WebCatalogCreateContentVariantsSystemPage.png
      :alt: Add system page and specify restrictions

#. Select the system page from the list.

#. This step applies only to the content nodes with more than one content variant.

   When your system page is not selected as a default variant for the content node, there is a *Restrictions* section beneath the selected system page. In this section, you can define the condition when the system page overrides the default content variant. See the :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

#. Click **Save** when you are done filling in the web catalog content node or keep adding the content variants.


.. _user-guide--marketing--web-catalog--content-variant-product-page:

Add a Product Page
^^^^^^^^^^^^^^^^^^

Product page node is a direct link to the product details in OroCommerce storefront.

To add a product page node to the menu in the OroCommerce storefront:

#. Select the **Add Product Page** in the Content Variants list.

   The following section shows:

   .. image:: /user_doc/img/marketing/web_catalogs/WebCatalogCreateContentVariantsProductPage.png
      :alt: Add product page and specify the restrictions

#. Select the product from the list. To use search, start typing the product name or SKU in the box. To use filtering, click on the **bars**, and select the filtering conditions in the *Manage filters* section.

#. This step applies only to the content nodes with more than one content variant.

   When your product page is not selected as a default variant for the content node, there is a *Restrictions* section beneath the selected product. In this section, you can define the condition when the product details override the default content variant. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

#. Click **Save** when you are done filling in the web catalog content node or keep adding the content variants.


.. _user-guide--marketing--web-catalog--content-variant-category:

Add a Category
^^^^^^^^^^^^^^

Category node is a direct link to the product category with the list of products in the OroCommerce storefront.

To add a category node to the menu in the OroCommerce storefront:

1. Select **Add Category** in the Content Variants list.

   The following section shows:

   .. image:: /user_doc/img/marketing/web_catalogs/WebCatalogCreateContentVariantsCategory.png
      :alt: Select a category from the content tree

2. Click |Bdropdown| next to **Sub-Categories** to select the required option from the list.

   The available options are:

   * **Include, show as filter** - Used to include all the products assigned to the subcategories of the selected category in addition to the products that are already assigned directly. The subcategories of the first level with at least one product will be displayed as a category filter in the OroCommerce storefront.

     .. image:: /user_doc/img/marketing/web_catalogs/subcategory_filter_1.png
        :alt: Illustration of the Include, show as filter option

   * **Do not include** - Used to include the products assigned only to the selected category. In case the category has a subcategory, its product items will not be displayed.

     .. image:: /user_doc/img/marketing/web_catalogs/subcategory_filter_2.png
        :alt: Illustration of the Do not include option

3. Select the category from the product catalog tree. To use search, start typing the category name in the box. Use **>** and **v** to expand/collapse the tree node.

   .. image:: /user_doc/img/marketing/web_catalogs/subcategory_filter_3.png
      :alt: Start typing the category name in the search bar

4. This step applies only to the content nodes with more than one content variant.

   When your category is not selected as a default variant for the content node, there is a *Restrictions* section beneath the tree of categories. In this section, you can define the condition when the selected category overrides the default content variant. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

5. Click **Save** when you are done filling in the web catalog content node or keep adding the content variants.


.. _user-guide--marketing--web-catalog--content-variant-landing page:

Add a Landing Page
^^^^^^^^^^^^^^^^^^

Landing Page node is a link to the :ref:`custom content page <user-guide--landing-pages>` created in the **Marketing > Landing Pages** section.

To add a landing page node to the menu in the OroCommerce storefront:

#. Select the **Add Landing Page** in the Content Variants list.

   The following section shows:

   .. image:: /user_doc/img/marketing/web_catalogs/WebCatalogCreateContentVariantsLandingPage.png
      :alt: Add a landing page and specify the restrictions

#. Select the existing landing page from the list. To use search, start typing the keywords in the box to search for the necessary page. To use filtering, click on the **bars**, and select the filtering conditions in the *Manage filters* section. Alternatively, you can create a new landing page:

   #) Click **+** to the right from the Landing page list.

      The Create Landing Page pops up.

   #) Fill in the landing page details and contents as described :ref:`here <user-guide--landing-pages-create>`.

#. This step applies only to the content nodes with more than one content variant.

   When your landing page is not selected as a default variant for the content node, there is a *Restrictions* section beneath the selected landing page. In this section, you can define the condition when the landing page overrides the default content variant. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

#. Click **Save** when you are done filling in the web catalog content node or keep adding the content variants.


.. _user-guide--marketing--web-catalog--content-variant-product-collection:

Add a Product Collection
^^^^^^^^^^^^^^^^^^^^^^^^

Product Collection is a filter-based segment that helps you display a custom and dynamic set of products in the web catalog similarly to the category contents.

.. note:: You can control the frequency of the product collections indexation. By default, product collections are indexed every hour. See the :ref:`Product Collections Configuration <configuration--guide--commerce--configuration--product-collections>` guide for the details on how to change the default indexation frequency.

1. To add a product collection node to the menu in the OroCommerce storefront:

   Select the **Add Product Collection** in the Content Variants list.

   The following section shows:

   .. image:: /user_doc/img/marketing/web_catalogs/ProductCollection.png
      :alt: Add a product collection and specify the restrictions

2. To name a segment of the product collection:

   Enter the segment name for the product collection in the provided field.

   .. image:: /user_doc/img/marketing/web_catalogs/SegmentName.png
      :alt: Enter the segment name for the product collection in the provided field

3. To add a product to the collection via filter:

   In the All Added tab, click |IcFilter| **Advanced Filter** to set up a :ref:`filter <user-guide-getting-started-filters>` that will limit the products list and include only the necessary products.

   .. image:: /user_doc/img/marketing/web_catalogs/AdvancedFilter.png
      :alt: Set up a filter to limit the products list

   .. note:: |IcFilter| **Advanced Filter** is hidden by default.


   Click **Preview Results** to check whether the products found via the filter match your criteria, or to exclude unnecessary items from the list.

   .. image:: /user_doc/img/marketing/web_catalogs/PreviewResultsExclude.png
      :alt: Click Preview Results

   .. note:: To manage the columns displayed Within the products grid, click |IcSettings|.

4. To add a product to the collection manually:

   Click **Add** next to |IcFilter| **Advanced Filter** to add the selected products manually. This can be used in cases when you have few products to be added and there is no need to set up a complicated filter, or when you need to add specific products that may be out of the filter's scope.

   .. image:: /user_doc/img/marketing/web_catalogs/AddProductsManually.png
      :alt: Click Add and select the products manually

  Manually added items will appear both in the **Manually Added** and **All Added** tabs.

5. To exclude items from the collection:

   To ensure that specific items are excluded from the list of the product collection and will not be included automatically or manually, click **Add** in the **Excluded** tab:

   .. image:: /user_doc/img/marketing/web_catalogs/AddToExluded.png
      :alt: Click Add in the Excluded tab

   Tick the Selected box to the left of the necessary products, and click **Add**.

   .. note:: You may use filter on the top of the dialog to limit the scope of the products and make it fit into the visible area.

   .. image:: /user_doc/img/marketing/web_catalogs/ExcludeItemsFromProductCollection.png
      :alt: Select the necessary products manually

6. To reset products:

   To clear all filters and reset the product collection to the default state, click **Reset Products** next to the tabs.

   .. image:: /user_doc/img/marketing/web_catalogs/ResetProducts.png
      :alt: Click Reset Products next to the tabs

7. This step applies only to the content nodes with more than one content variant.

   When your collection is not selected as a default variant for the content node, there is a *Restrictions* section beneath the product collection preview. In this section, you can define the condition when the product collection overrides the default content variant. See :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--content--visibility>` section for more information.

8. Click **Save** when you are done filling in the web catalog content node or keep adding the content variants.


.. _user-guide--marketing--web-catalog--default-content-variant:

Set a Default Content Variant
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

The first content variant that is added to the node is marked as the default variant.

When you add more content variants, they have a dedicated restrictions section next to the content variant details. These restrictions will limit the use of this content variant only to specific cases; the default option is used in any other case.

To set up a newly added content variant as default, select the radio on the top left of its type.

.. image:: /user_doc/img/marketing/web_catalogs/change_default_variant.png
   :alt: Select the content variant to make it the default one




Configure Content Visibility
----------------------------

.. include:: /user_doc/back_office/marketing/web_catalogs/edit_content_tree/visibility.rst
   :start-after: begin
   :end-before: finish

.. note:: Once you are done creating a web catalog, update your web-catalog configuration to enable it for the necessary level (either :ref:`globally <user-guide--marketing--web-catalog--enable-globally>` or :ref:`per website <user-guide--marketing--web-catalog--enable-globally>`), and, if necessary, tune the individual :ref:`catalog nodes visibility <user-guide--marketing--web-catalog--customize>` to hide/show the node or particular content variant for specific localization, on a particular website, or for certain customer.


**Related Articles**

* :ref:`Web Catalogs <user-guide--web-catalog>`

* :ref:`Create a Web Catalog <user-guide--web-catalog-create>`

* :ref:`Enable a Web Catalog  Globally <user-guide--marketing--web-catalog--enable-globally>`

* :ref:`Enable a Web Catalog per Website <user-guide--marketing--web-catalog--enable-per-website>`

* :ref:`Customize Web Catalog Contents for Localization, Customer or Customer Group <user-guide--marketing--web-catalog--customize>`

* :ref:`Build a Custom Web Catalog From Scratch (Example) <user-guide--marketing--web-catalog--sample>`

.. stop

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin


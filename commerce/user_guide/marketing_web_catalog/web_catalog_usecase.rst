.. _user-guide--marketing--web-catalog--use-case:

.. begin

.. _user-guide--marketing--web-catalog--enable-globally:

.. begin_enable_catalog_globally

Enable a Web Catalog Globally
-----------------------------

To enable a web catalog globally:

1. Navigate to **System > Configuration > Websites > Routing**.
2. In the Web Catalog section, select the required web catalog that should be displayed on the storefront.
   
.. note:: When a Web Catalog is selected, it populates the main menu and sub-menus on the OroCommerce Storefront. If there is no Web Catalog in OroCommerce, the Master Catalog structure is mimicked.
   
 .. image:: /user_guide/img/marketing/web_catalogs/use_case/SysConfigWebCatalog.png
   :class: with-border

.. end_enable_catalog_globally

.. _user-guide--marketing--web-catalog--enable-per-website:

.. begin_enable_catalog_per_website

Enable a Web Catalog for a Website
----------------------------------

To enable a web catalog for a specific website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| more actions menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **System Configuration > Websites > Routing** in the menu to the left.

.. image:: /user_guide/img/marketing/web_catalogs/use_case/SysConfigWebCatalogPerWebsite.png
   :class: with-border

.. end_enable_catalog_per_website

.. _user-guide--marketing--web-catalog--customize:

.. begin_web_catalog_customize

Customize Web Catalog Contents for Localization, Customer or Customer Group
---------------------------------------------------------------------------

To customize your web catalog contents visibility:

1. Navigate to **Marketing > Web Catalog** in the main menu.
2. For the necessary web catalog, hover over the |IcMore| more actions menu to the right and click |IcEditContentTree| to start editing the catalog content tree.
   
.. image:: /user_guide/img/marketing/web_catalogs/use_case/EditContentTreeIcon.png
   :class: with-border

3. In the *Restriction section*, define the visibility of the web catalog.

   By default, the web catalog is displayed for any localization, on any website, and for any customer.

   To make OroCommerce apply a web catalog to the storefront only for the particular combination of these facts, create a restriction by selecting all or some of the following: target localization, website, and customer or customer group.

.. image:: /user_guide/img/marketing/web_catalogs/use_case/CatalogRestrictions.png
   :class: with-border

.. note:: Only one field must be chosen for customers at a time, either a customer group and a customer.

.. warning:: Never leave the restrictions for non-default variant empty. This may cause unexpected priority collision between the default and non-default variant.

.. end_web_catalog_customize

.. _user-guide--marketing--web-catalog--sample:

.. begin_web_catalog_sample

Build a Custom Web Catalog From Scratch (Sample)
------------------------------------------------

For illustration purposes, a sample web catalog set up is provided below.

**Create First Level Menu**

A website that distributes beauty and skincare products to shops worldwide is to have the following sections in its main menu:

1. Health and Pharmacy
2. Beauty and Skincare
3. Fragrance
4. Baby and Child
5. Toiletries

These sections will serve as the first level of the storefront main menu. In the management console, they will be called the root nodes.

To set up root content nodes in the management console, we:

1. Navigate to **Marketing > Web Catalogs**.
2. Click **Create Web Catalog**
3. Name the catalog *Web Catalog 2017* and save it.
4. Click **Edit Content Tree**.
5. Name the first node *Web Catalog 2017*. Root nodes will be linked to it.
6. Fill in the SEO section.
7. Set the necessary restrictions.
8. Add a landing page in the content variants section that would be linked to the menu.
9. From this node, create the first level menu by clicking **Create Content Node**.
10. Name it *Health and Pharmacy*.
11. Fill in the SEO section.
12. Set the necessary restrictions (or inherit parent restrictions).
13. Add a landing page linked to Health and Pharmacy.
14. Click **Save**.
 
This way, we create all the required first level menus.  

.. note:: Make sure that you create first level nodes from Web Catalog 2017 in the nodes section on the left of the page.


.. image:: /user_guide/img/marketing/web_catalogs/use_case/Create1RootNode.png
   :class: with-border

**Create Sub-level Menu**

Once all first level nodes have been created, we can create the sub-menu nodes (second level menus) that would populate root nodes.

Each of the main menu sections will have the following second level menus:

1. Health and Pharmacy: Vitamins and Supplements, Lifestyle and Wellbeing, Women's Health, Men's Health, Baby and Child Health.
2. Beauty and Skincare: Makeup, Nails, Facial Skincare, Body Skincare, Hair, Fashion Accessories.
3. Fragrance: Perfume, Aftershave.
4. Baby and Child: Pregnancy and Maternity, Feeding, Bathing and Changing.
5. Toiletries: Hair, Dental, Washing and Bathing.
   
To set up content nodes in the management console:

1. Select the root node you are creating the sub-node for. In our case, it is *Health and Pharmacy*.
2. Click **Create Content Node**.
3. Name the second level menu *Vitamins and Supplements*. This will be linked to the root node.
4. Fill in the SEO section.
5. Set the necessary restrictions (or inherit parent restrictions).
6. Add a product collection to *Vitamins and Supplements*.
   

.. image:: /user_guide/img/marketing/web_catalogs/use_case/Create1SubMenuNode.png

This way, we create all the required second level menus.  

.. image:: /user_guide/img/marketing/web_catalogs/use_case/Catalog.png

Each of such levels can be populated with more levels, or nodes, if necessary, and each node can have a page (:ref:`system <user-guide--marketing--web-catalog--content-variant-system-page>`, :ref:`landing <user-guide--marketing--web-catalog--content-variant-landing page>`, :ref:`product <user-guide--marketing--web-catalog--content-variant-product-page>`), a :ref:`product collection <user-guide--marketing--web-catalog--content-variant-product-collection>`, or a :ref:`category <user-guide--marketing--web-catalog--content-variant-category>` mapped into it.

.. note:: You can drag the existing content nodes to a different position within the content tree on the left of the page, as illustrated below:

.. image:: /user_guide/img/marketing/web_catalogs/DragDropNode.png
   :class: with-border

Once the catalog is enabled (:ref:`globally <user-guide--marketing--web-catalog--enable-globally>` or :ref:`per website <user-guide--marketing--web-catalog--enable-per-website>`), you will be able to see it in the storefront.

.. image:: /user_guide/img/marketing/web_catalogs/use_case/NodesFrontStore.gif

.. end_web_catalog_sample

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin
   

:oro_documentation_types: OroCommerce

.. _user-guide--marketing--web-catalog--sample:

Build a Custom Web Catalog From Scratch (Example)
=================================================

For illustration purposes, a sample web catalog setup is provided below.

Create First Level Menu
-----------------------

A website that distributes beauty and skincare products to shops worldwide is to have the following sections in its main menu:

1. Health and Pharmacy
2. Beauty and Skincare
3. Fragrance
4. Baby and Child
5. Toiletries

These sections will serve as the first level of the storefront's main menu. In the back-office, they will be called the root nodes.

To set up root content nodes in the back-office, we:

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

This way, we create all the required first-level menus.

.. note:: Make sure you create first-level nodes from Web Catalog 2017 in the nodes section on the left of the page.

.. image:: /user/img/marketing/web_catalogs/use_case/Create1RootNode.png
   :alt: The details of the Web Catalog 2017
   :class: with-border

Create Sub-level Menu
---------------------

Once all first-level nodes have been created, we can create the sub-menu nodes (second-level menus) that would populate root nodes.

Each of the main menu sections will have the following second-level menus:

1. Health and Pharmacy: Vitamins and Supplements, Lifestyle and Wellbeing, Women's Health, Men's Health, Baby and Child Health.
2. Beauty and Skincare: Makeup, Nails, Facial Skincare, Body Skincare, Hair, Fashion Accessories.
3. Fragrance: Perfume, Aftershave.
4. Baby and Child: Pregnancy and Maternity, Feeding, Bathing, and Changing.
5. Toiletries: Hair, Dental, Washing, and Bathing.

To set up content nodes in the back-office:

1. Select the root node you are creating the sub-node for. In our case, it is *Health and Pharmacy*.
2. Click **Create Content Node**.
3. Name the second level menu *Vitamins and Supplements*. This will be linked to the root node.
4. Fill in the SEO section.
5. Set the necessary restrictions (or inherit parent restrictions).
6. Add a product collection to *Vitamins and Supplements*.


.. image:: /user/img/marketing/web_catalogs/use_case/Create1SubMenuNode.png
   :alt: View the Web Catalog 2017 content tree with the first and second-level menus

This way, we create all the required second-level menus.


Each of such levels can be populated with more levels, or nodes, if necessary, and each node can have a page (:ref:`system <user-guide--marketing--web-catalog--content-variant-system-page>`, :ref:`landing <user-guide--marketing--web-catalog--content-variant-landing page>`, :ref:`product <user-guide--marketing--web-catalog--content-variant-product-page>`), a :ref:`product collection <user-guide--marketing--web-catalog--content-variant-product-collection>`, or a :ref:`category <user-guide--marketing--web-catalog--content-variant-category>` mapped into it.

.. note:: You can drag the existing content nodes to a different position within the content tree on the left of the page, as illustrated below:

.. image:: /user/img/marketing/web_catalogs/DragDropNode.png
   :alt: Dragging the existing content nodes to a different position within the content tree
   :class: with-border

Once the catalog is enabled (:ref:`globally <user-guide--marketing--web-catalog--enable-globally>` or :ref:`per website <user-guide--marketing--web-catalog--enable-per-website>`), you will be able to see it in the storefront.

.. image:: /user/img/marketing/web_catalogs/use_case/NodesFrontStore.gif
   :alt: Illustrating all content nodes created under the Web Catalog 2017 in the storefront

**Related Articles**

* :ref:`Web Catalogs <user-guide--web-catalog>`

* :ref:`Create a Web Catalog <user-guide--web-catalog-create>`

* :ref:`Edit a Web Catalog Content Tree <user-guide--web-catalog-edit-content-tree>`

* :ref:`Enable a Web Catalog  Globally <user-guide--marketing--web-catalog--enable-globally>` and :ref:`per Website <user-guide--marketing--web-catalog--enable-per-website>`.

* :ref:`Customize Web Catalog Contents for Localization, Customer or Customer Group <user-guide--marketing--web-catalog--customize>`

* :ref:`Use Web Catalog Nodes as Root Nodes (Example) <user-guide--web-catalog-navigation-tool>`

.. finish

.. include:: /include/include-images.rst
   :start-after: begin



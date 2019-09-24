:oro_documentation_types: commerce

.. _user-guide--web-catalog-edit-content-tree:

Edit a Web Catalog Content Tree
===============================

To edit a web catalog content tree:

#. Navigate to **Marketing > Web Catalogs** in the main menu.
#. Click on the web catalog to open its details.
#. Click |IcEditContentTree| **Edit Content Tree** on the top right of the page.

   .. image:: /user/img/marketing/web_catalogs/EditContentTree.png
      :alt: Clicking Edit Content Tree on the top right of the page

#. In the page that opens, fill in the details of the **homepage node** of the web catalog as described in the :ref:`Set Up the Homepage, First Level Menu, and Sub Menus <user-guide--marketing--web-catalog--root-node>` section.

   The content selected in the content variants of the **homepage node** is shown when the buyer navigates to the OroCommerce storefront. The **homepage node** also acts as a parent node for the web catalog menu and sub menu items. It is recommended to use Oro Frontend Root system page as a root node of your web catalog.

#. Under the **homepage node**, create main menu content nodes (e.g. first level of the main menu in the storefront) as described in the :ref:`Set Up the Homepage, First Level Menu, and Sub Menus <user-guide--marketing--web-catalog--root-node>` section. It is recommended to create a dedicated landing page for main menu nodes of your web catalog.

   .. image:: /user/img/marketing/web_catalogs/WebCatalogCreate2.png
      :alt: Edit content tree

Once the main menu nodes are saved, create **sub-menu content nodes**. These will be shown as the second level of the main menu in the OroCommerce storefront:

#) Ensure that the appropriate main menu node is selected in the content nodes structure to the left.
#) Click **Create Content Node** on the top right of the page.

   .. image:: /user/img/marketing/web_catalogs/CreateNestedNode.png
      :alt: Two steps to create a content node

   .. image:: /user/img/marketing/web_catalogs/SubMenuNodeCreate.png
      :alt: A sample of a new sub menu node to be filled in

#) Set up the sub-menu node as described in the :ref:`Set Up the Homepage, First Level Menu, and Sub Menus <user-guide--marketing--web-catalog--root-node>` section.

#) Click **Save** on the top right of the page.

This way, you can set up as many sub-menu nodes as you need.

.. note:: You can drag the existing content nodes to a different position within the content tree on the left of the page, as illustrated below:

.. image:: /user/img/marketing/web_catalogs/DragDropNode.png
   :alt: Dragging the existing content nodes between sub-menu nodes

Learn how to set up menus and configure content variants for the content node in the sections below:

* :ref:`Set Up the Homepage, First Level Menu, and Sub Menus <user-guide--marketing--web-catalog--root-node>`
* :ref:`Configure Content Variants for the Content Node <user-guide--marketing--web-catalog--content-variant>`
* :ref:`Configure Content Visibility <user-guide--marketing--web-catalog--node--visibility>`

.. note:: Once you are done creating a web catalog, update your web-catalog configuration to enable it for the necessary level (either :ref:`globally <user-guide--marketing--web-catalog--enable-globally>` or :ref:`per website <user-guide--marketing--web-catalog--enable-globally>`), and, if necessary, tune the individual :ref:`catalog nodes visibility <user-guide--marketing--web-catalog--customize>` to hide/show the node or particular content variant for specific localization, on a particular website, or for certain customer.

**Related Articles**

* :ref:`Web Catalogs <user-guide--web-catalog>`
* :ref:`Create a Web Catalog <user-guide--web-catalog-create>`
* :ref:`Enable a Web Catalog  Globally <user-guide--marketing--web-catalog--enable-globally>`
* :ref:`Enable a Web Catalog per Website <user-guide--marketing--web-catalog--enable-per-website>`
* :ref:`Customize Web Catalog Contents for Localization, Customer or Customer Group <user-guide--marketing--web-catalog--customize>`
* :ref:`Build a Custom Web Catalog From Scratch (Example) <user-guide--marketing--web-catalog--sample>`

.. stop

.. toctree::
   :hidden:

   content-variants
   first-level-menu
   visibility

.. include:: /include/include-images.rst
   :start-after: begin


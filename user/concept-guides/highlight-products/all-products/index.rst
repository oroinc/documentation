.. _sys--conf--commerce--catalog--special-pages:

:oro_documentation_types: commerce

Configure All Products Page
===========================

In your Oro back-office, you can enable and configure All Products page for the OroCommerce storefront. When configured, such page should display all available products from the :ref:`master catalog <user-guide--web-catalog>` grouped by categories.

To configure All Products page:

1. Enable **All Products Page** in system configuration on the required level --- :ref:`globally <user-guide--marketing--web-catalog--node--visibility>` or :ref:`per website <sys--conf--commerce--catalog--special-pages--website>`).
2. Add it to the storefront as part of either your :ref:`web catalog <user-guide--web-catalog>` (**Marketing > Web Catalog**) or a :ref:`frontend menu <doc--menu-config-levels>` (**System > Frontend Menus**) on the required level:

   * :ref:`Globally <sys--conf--frontend-menus--all-products--global>` (**System > Frontend Menus**)
   * :ref:`Per organization <sys--users--organization--menus--all-products--organization>` (**System > User Management > Organizations**)
   * :ref:`Per website <sys--users--organization--menus--all-products--website>` (**System > Websites**)
   * :ref:`Per customer group <user-guide--customers--customer-groups--all-products>` (**Customers > Customer Group**)
   * :ref:`Per customer <user-guide--customers--customers--all-products>` (**Customers > Customers**)

   More information on customization on each of these levels can be found in the relevant :ref:`Frontend Menus guide <user-guide--system--menu--menu-frontend>`.

.. note:: Please note that it is recommended to enable All Products page exclusively for *small catalogs* with no more than a few hundred products, otherwise browser performance might be affected.

.. _user-guide--all-products--sample:

An Example of Adding All Products Page
--------------------------------------

.. begin_all_products

As an illustration, let us add a sample All Products page to the storefront of the Europe website as a standalone page in the Quick Access menu.

.. image:: /user/img/products/all_products_page/SampleAllProducts1.png

For this, first enable All Products page in the system:

1. Navigate to **System > Websites**.
2. For *Europe*, hover over the |IcMore| more actions menu, and click |IcConfig|.

   .. image:: /user/img/products/all_products_page/SampleAllProducts2.png

3. Select **Commerce > Catalog > Special Pages** in the panel to the left.
4. In the **All Products** section, select the **Enable All Products Page** check box.

   .. image:: /user/img/products/all_products_page/SampleAllProducts3.png

5. Click **Save Settings**.

Next, add the page to the quick access menu:

1. Navigate to **System > Websites**.
2. Click once on the *Europe* website to open its page.
3. On the website page, click |IcConfig| **Edit Frontend Menu** to start editing the configuration.

   .. image:: /user/img/products/all_products_page/SampleAllProducts4.png

4. Click once on the commerce_quick_access menu.

   .. image:: /user/img/products/all_products_page/SampleAllProducts5.png

5. Click **Create Menu Item** on the top right.

   .. image:: /user/img/products/all_products_page/SampleAllProducts6.png

6. Fill in the required fields:

   * **Title**: All Products
   * **URL**: /catalog/allproducts
   * Select an icon from the list

   .. image:: /user/img/products/all_products_page/SampleAllProducts8.png

7. Click **Save** on the top right to save the changes.

The All Products page should now be available as part of the Quick Access menu in the storefront of the Europe website.

.. note:: Please note, that the products unassigned to a category will be listed first, followed by those which belong to a category.

.. image:: /user/img/products/all_products_page/SampleAllProducts7.png

Similarly, you can add All Products page to the menus of your choice.

.. finish_all_products

**Related Topics**

* :ref:`Web Catalogs <user-guide--web-catalog>`
* :ref:`Build a Custom Web Catalog <user-guide--marketing--web-catalog--sample>`

.. include:: /include/include-images.rst
   :start-after: begin


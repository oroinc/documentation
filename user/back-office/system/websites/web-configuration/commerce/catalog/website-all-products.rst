:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--catalog--special-pages--website:

All Products Page per Website
-----------------------------

.. important:: This section is a part of the :ref:`Product Management <concept-guides--product-management>` topic that provides the general understanding of the product concept in OroCommerce.

In your Oro back-office, you can enable and configure the All Products page for the OroCommerce storefront. When configured, such page should display all available products from the master catalog grouped by categories.

Flow
----

To configure the All Products page:

1. Enable **All Products Page** in system configuration on the required level --- :ref:`globally <sys--conf--commerce--catalog--special-pages--global>` or per website (see below).
2. Add it to the storefront as part of either your :ref:`web catalog <user-guide--marketing--web-catalog>` (**Marketing > Web Catalog**) or frontend menu (**System > Frontend Menus**) on the required level:

   * :ref:`Globally <sys--conf--frontend-menus--all-products--global>` (**System > Frontend Menus**)
   * :ref:`Per organization <sys--users--organization--menus--all-products--organization>` (**System > User Management > Organizations**)
   * :ref:`Per website <sys--users--organization--menus--all-products--website>` (**System > Websites**)
   * :ref:`Per customer group <user-guide--customers--customer-groups--all-products>` (**Customers > Customer Group**)
   * :ref:`Per customer <user-guide--customers--customers--all-products>` (**Customers > Customers**)

3. Check the :ref:`example of adding the All Products page <user-guide--all-products--sample>` for your reference.

.. note:: Please note that it is recommended to enable the All Products page exclusively for *small catalogs* with no more than a few hundred products, otherwise browser performance might be affected.

Enable All Products Page per Website
------------------------------------

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Special Pages** in the panel to the left.

   .. image:: /user/img/system/websites/web_configuration/AllProductsWebsite.png

4. Clear the **Use Organization** check box to change the organization-wide setting.
5. In the **All Products** section, select the **Enable All Products Page** check box.
6. Click **Save Settings** on the top right of the page.

.. _user-guide--all-products--sample:

An Example of Adding All Products Page
--------------------------------------

As an illustration, let us add a sample All Products page to the storefront of the Europe website as a standalone page in the Quick Access menu.

.. image:: /user/img/products/all_products_page/SampleAllProducts1.png

For this, first enable the All Products page in the system:

1. Navigate to **System > Websites**.
2. For *Europe*, hover over the |IcMore| more actions menu, and click |IcConfig|.
3. Select **Commerce > Catalog > Special Pages** in the panel to the left.
4. In the **All Products** section, select the **Enable All Products Page** check box.

   .. image:: /user/img/products/all_products_page/SampleAllProducts3.png

5. Click **Save Settings**.

Next, add the page to the quick access menu:

1. Navigate to **System > Websites**.
2. Click once on the *Europe* website to open its page.
3. On the website page, click |IcConfig| **Edit Frontend Menu** to start editing the configuration.
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

Similarly, you can add the All Products page to the menus of your choice.


.. include:: /include/include-images.rst
   :start-after: begin

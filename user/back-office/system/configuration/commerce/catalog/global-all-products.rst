:oro_documentation_types: OroCommerce

.. _sys--conf--commerce--catalog--special-pages:
.. _sys--conf--commerce--catalog--special-pages--global:

Configure Global Special Pages (All Products) Settings
======================================================

.. hint:: This section is a part of the :ref:`Product Management <concept-guides--product-management>` topic that provides the general understanding of the product concept in OroCommerce.

In your Oro back-office, you can enable and configure the All Products page for the OroCommerce storefront. When configured, such page should display all available products from the master catalog grouped by categories.

   .. image:: /user/img/system/config_commerce/catalog/all_products_page.png
      :alt: The All Products page on the OroCommerce storefront

Flow
----

To configure the All Products page:

1. Enable **All Products Page** in system configuration on the required level --- globally (see below) or :ref:`per website <sys--conf--commerce--catalog--special-pages--website>`.
2. Add it to the storefront as part of either your :ref:`web catalog <user-guide--marketing--web-catalog>` (**Marketing > Web Catalog**) or frontend menu (**System > Frontend Menus**) on the required level:

   * :ref:`Globally <sys--conf--frontend-menus--all-products--global>` (**System > Frontend Menus**)
   * :ref:`Per organization <sys--users--organization--menus--all-products--organization>` (**System > User Management > Organizations**)
   * :ref:`Per website <sys--users--organization--menus--all-products--website>` (**System > Websites**)
   * :ref:`Per customer group <user-guide--customers--customer-groups--all-products>` (**Customers > Customer Group**)
   * :ref:`Per customer <user-guide--customers--customers--all-products>` (**Customers > Customers**)

3. Check the :ref:`example of adding the All Products page <user-guide--all-products--sample>` for your reference.

.. note:: Please note that it is recommended to enable the All Products page exclusively for *small catalogs* with no more than a few hundred products, otherwise browser performance might be affected.

Enable All Products Page Globally
---------------------------------

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Catalog > Special Pages** in the panel to the left.

   .. image:: /user/img/system/config_commerce/catalog/AllProductsSystem.png
      :alt: All Products global configuration settings

3. In the **All Products** section, select the **Enable All Products Page** check box.
4. Click **Save Settings** on the top right of the page.

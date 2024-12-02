.. _sys--conf--commerce--catalog--special-pages--website:

Configure All Products Page per Website
=======================================

.. hint:: This section is part of the :ref:`Product Management <concept-guides--product-management>` topic that provides a general understanding of the product concept in OroCommerce.

In your Oro back-office, you can enable and configure the All Products page for the OroCommerce storefront. When configured, such page should display all available products from the master catalog grouped by categories.

Flow
----

To configure the All Products page:

1. Enable **All Products Page** in system configuration on the required level --- :ref:`globally <sys--conf--commerce--catalog--special-pages--global>` or per website (see below).
2. Add it to the storefront as part of either your :ref:`web catalog <user-guide--marketing--web-catalog>` (**Marketing > Web Catalog**) or storefront menu (**System > Storefront Menus**) on the required level:

   * :ref:`Globally <sys--conf--frontend-menus--all-products--global>` (**System > Storefront Menus**)
   * :ref:`Per organization <sys--users--organization--menus--all-products--organization>` (**System > User Management > Organizations**)
   * :ref:`Per website <sys--users--organization--menus--all-products--website>` (**System > Websites**)
   * :ref:`Per customer group <user-guide--customers--customer-groups--all-products>` (**Customers > Customer Group**)
   * :ref:`Per customer <user-guide--customers--customers--all-products>` (**Customers > Customers**)

.. note:: Please note that it is recommended to enable the All Products page exclusively for *small catalogs* with no more than a few hundred products, otherwise browser performance might be affected.

Enable All Products Page per Website
------------------------------------

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Catalog > Special Pages** in the panel to the left.

   .. image:: /user/img/system/websites/web_configuration/AllProductsWebsite.png

4. Clear the **Use Organization** checkbox to change the organization-wide setting.
5. In the **All Products** section, select the **Enable All Products Page** checkbox.
6. Click **Save Settings** on the top right of the page.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

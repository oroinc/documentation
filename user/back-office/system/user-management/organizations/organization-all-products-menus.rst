:oro_documentation_types: OroCRM, OroCommerce

.. _sys--users--organization--menus--all-products--organization:

Add All Products Page to Frontend Menus per Organization
--------------------------------------------------------

.. important:: Multi-organization management is only available in the Enterprise edition.

Once the All Products page has been enabled in the system configuration :ref:`globally <sys--conf--commerce--catalog--special-pages--global>` or :ref:`per website <sys--conf--commerce--catalog--special-pages--website>`, you can add it to a frontend menu of a particular organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. Click on the necessary organization to open its page.
3. Click the |IcConfig| **Edit Frontend Menu** icon to start editing the configuration.

   .. image:: /user/img/products/all_products_page/AllProductsOrganizationEditMenu.png

4. Click once on the menu to which you will add the All Products page.
5. Click **Create Menu Item** on the top right of the page.
#. In the **Title** field, type in the label for the menu item.
#. In the **URI** field, specify */catalog/allproducts*.
#. Complete the other fields as required.

   .. image:: /user/img/products/all_products_page/AllProductsOrganization.png

#. Click **Save** on the top right of the page.

The All Products page should now become available as part of the selected menu on the organization level.

.. finish_all_products

.. include:: /include/include-images.rst
   :start-after: begin


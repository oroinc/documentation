:oro_documentation_types: OroCommerce

.. _user-guide--pricing--price-list-manual:

Add a Product Price Manually
============================

You can add a product price in the specific currency to the price list manually in one of the following ways:

* While editing a product, in the **Product Prices** section of the product details.

* Click **+ Add Product Price** when viewing the price list details.

.. note:: The ability to add product prices from the price list and product pages depends on the *Create* role permission for the Product Price entity. If it is set to *None* for a particular role, adding prices will not be permitted for a user with this role. Please see the :ref:`Understand Roles and Permissions <user-guide-user-management-permissions-roles>` topic for more details.

        .. image:: /user/img/sales/pricelist/product_price_acl.png
           :alt: Permissions and access levels for the Product Price entity under the User Management Roles main menu

Add a Product Price in the Price Grid
-------------------------------------

To add a product price in the price list:

1. Navigate to **Sales > Price Lists** in the main menu.

2. Click on the price list to which you would like to add the price.

3. Click **+ Add Product Price**.
   The **Add Product Price** dialog appears.

   .. image:: /user/img/sales/pricelist/prices_for_price_list.png
      :alt: Add product prices in the opened popup dialog

#. Select the product to add the price for.

#. Specify the quantity to identify the tier of quantity that the price should apply to.

   To illustrate how price tiers work, let us consider the following example:

   When the product prices in USD are provided for one item, ten items, and fifty items, and a buyer orders 20 items, they will see the price provided for ten items.

#. Select the unit of quantity for the price.

#. Type in the price value and select the necessary currency from the list next to it.

#. Click **Save**.

.. finish_one

.. _user-guide--pricing--price-list-manual--product-details:

Add a Product Price on the Product Page
---------------------------------------

To add a product price in the product details:

1. Navigate to **Products > Products** in the main menu.

2. Find the product you would like to add the price for, click the |IcMore| **More Options** menu at the end of the corresponding row, and then click the |IcEdit| **Edit** icon.

3. In the **Product Prices** section, click **+ Add**.

   .. image:: /user/img/sales/pricelist/prices_for_product.png
      :alt: Adding the prices for the medical tag product to the Default PL manually when editing the product details

   The new line appends to the end of the list.

#. Select the price list to add the price into.

#. Specify the quantity to identify the tier of quantity the price should apply to.

   To illustrate how price tiers work, let us consider the following example:

   When the product prices in USD are provided for one item, ten items, and fifty items, and a buyer orders 20 items, they will see the price provided for ten items.

#. Select the unit of quantity from the list.

#. Type in the price value and select the necessary currency from the list next to it.

#. Click **Save**.

.. include:: /include/include-images.rst
   :start-after: begin
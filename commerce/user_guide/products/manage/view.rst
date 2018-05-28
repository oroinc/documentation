.. _doc--products--actions--view:

View Product Details
====================

.. start

Open Product Details
--------------------

1. In the main menu, navigate to **Products > Products**. The product list opens.
2. Choose the product that you need to modify, and click the corresponding row.

   Alternatively, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcView| **View** icon.

   The page with product details opens. To learn what you can find and perform when viewing the product details, see the following section.

.. include:: products_viewpage.rst
   :start-after: begin_product_details_view
   :end-before: finish_product_details_view

.. stop

.. _doc--products--actions--view-list:

View the Product List
---------------------

.. contents:: :local:

Open the Product List
^^^^^^^^^^^^^^^^^^^^^

In the main menu, navigate to **Products > Products**. The product list opens.

.. image:: /user_guide/img/products/products/Products.png
   :class: with-border
   :alt: All Products


Product List
^^^^^^^^^^^^

The following information about products is available in the product list.

.. csv-table::
   :header: "Field", "Description"
   :widths: 30, 60

   "SKU","The stock keeping unit that helps identify the product and track it for inventory."
   "NAME","The name of the product how it appears on the user interface."
   "INVENTORY STATUS","Whether the product is in stock, out of stock, or discontinued."
   "STATUS","Whether the product is enabled or disabled"
   "CREATED AT","The date and time when the product was created."
   "UPDATED AT","The date and time when the product was last updated."
   "PRICE (<Currency>) *Multiple columns*","The product pricing information per unit of quantity. There is an individual column for each currency that you have defined the price in.  "
   "Price Attributes *Multiple columns*","The additional price information that may be useful for determining the product pricing strategy (e.g, MSRP, MAP). There is an individual column for each price attribute and each currency."
   "TAX CODE","The code that helps identify what taxes to apply to the product."

Control Information Displayed in the Product List
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To control the product information displayed in the list, click |IcSettings| **Settings** on the top right of the list, and in the dialog that appears, select which column to display.

.. image:: /user_guide/img/products/products/ProductsGridSettings.png
   :class: with-border

To filter product information by value, click |IcFilter| **Filter** on the top right of the list, and in the filter section that appears, select the required values.


    .. image:: /user_guide/img/products/products/ProductsFilterValues.png
	   :class: with-border


To display pricing information related only to the particular price list, in the left panel, select the price list form the **Price List** list, or click |IcBars| next to it to select price list using the dialog.

   .. image:: /user_guide/img/products/products/ProductsSelectPriceList.png
      :class: with-border


To display/hide pricing information related to the particular currency, in the left panel, select/clear the check box next to the name of the corresponding currency.


To display/hide tier prices, in the left panel, select/clear the **Show Tier Prices** check box.


   .. image:: /user_guide/img/products/products/ProductsFilterPrices.png
   	  :class: with-border


To display products that belong to the particular category, in the left panel, navigate to the required category and click it. Use search to quickly locate the category.

To display/hide product from the sub-categories, in the left panel, select/clear the **Include Sub-Categories** check box.


    .. image:: /user_guide/img/products/products/ProductsCategories.png
       :class: with-border


Manage Products from the List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

You can perform the following actions for a specific product from the product list page:

* :ref:`Create a product <doc--products--actions--create>`

* :ref:`View a product <doc--products--actions--view>`

* :ref:`Edit a product <doc--products--actions--edit--fromgrid>`

* :ref:`Duplicate a product <doc--products--actions--duplicate--fromgrid>`

* :ref:`Delete a product <doc--products--actions--delete--fromgrid>` or :ref:`delete multiple products <doc--products--actions--delete--multiple>`

* :ref:`Export products <export-products>`

* :ref:`Import products <import-products>`

.. image:: /user_guide/img/products/products/ProductGridActions.png
   :class: with-border

.. include:: /img/buttons/include_images.rst
   :start-after: begin








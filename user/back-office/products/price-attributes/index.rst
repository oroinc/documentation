:oro_documentation_types: commerce

.. _user-guide--products--price-attributes:

Price Attributes
================

A :term:`Price Attribute` is a custom parameter, like manufacturer's suggested retail price (MSRP) or minimum advertised price (MAP), that may be needed as input information for your retail price listed on the website. Price attributes help you extend the product options with any custom value related to the price formation.

Before reading on, consider watching a short demo from our media library on |how to set up price attributes in OroCommerce|.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/SO36BC3SaXQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

You can use the price attribute as a base value for manually or automatically generated price list.

Create a Price Attribute
------------------------

To create a new price attribute:

#. Navigate to **Products > Price Attributes** in the main menu.

#. Click **Create Price Attribute**. The following page opens:

#. Type in the price attribute name (that is used as a UI label) and the field name that is used in the code and in the database to refer to the price attribute container.

#. Select the currencies that are supported for this price attribute:

   * Click the currency to select only one of them.

   * Hold the ``Ctrl`` key and click another currency to add it to the selection.

   * Hold the ``Shift`` key and click another currency to select a range of currencies.

#. Click **Save**.

Now you can set the price attribute value for every product in the **Product Prices** section:

.. image:: /user/img/products/price_attributes/PriceAttributesInProduct.png
   :alt: Display the location of the product price attributes

Manage Price Attributes
-----------------------

View Price Attribute Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To view all price attributes, navigate to **Products > Price Attributes** in the main menu.

.. image:: /user/img/products/price_attributes/PriceAttributes.png
   :alt: The page of all price attributes

Here, you can create a new price attribute, filter the list of existing ones by a price attribute name or a field name, view price attribute details by clicking on the item. Also, you can  |IcView| view, |IcEdit| edit, or |IcDelete| delete a price attribute by hovering over the |IcMore| **More Options** menu to the right of the item.

To remove multiple price attributes, select check boxes in front of the price attributes that you want to delete. At the right end of the list header, click the |IcMore| **More Options** menu and click |IcDelete| **Delete** to remove all selected price attributes.

Find the necessary price attribute in the list and click it.

The following information is available immediately:

   * **Price Attribute** -- The name or label of the price attribute.

   * **Field Name** -- The name of the field in the code/database that represents the price attribute.

   * **Currencies** -- The currencies this price attribute is supported for.


.. _doc--price-attributes--actions--edit:

Edit a Price Attribute
^^^^^^^^^^^^^^^^^^^^^^

To edit a price attribute:

#. Navigate to **Products > Price Attributes** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| **Edit** to start editing its details.

#. Amend the price attribute name (that is used as a UI label) and/or the field name that is used in the code and in the database to refer to the price attribute container.

#. Modify the selection of the currencies that are supported for this price attribute:

   * Click the currency to select only one of them.

   * Hold the ``Ctrl`` key and click another currency to add it to the selection.

   * Hold the ``Shift`` key and click another currency to select a range of currencies.

#. Click **Save**.

Next, in the product details, adjust the price attribute values and provide values for newly added currencies.


Set a Price Attribute Value in the Product Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set a price attribute (e.g., Minimal Advertised Price) for a product:

#. Navigate to **Products > Products** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| **Edit** to start editing its details.

   The following page opens:

   .. image:: /user/img/products/price_attributes/PriceAttributesInProduct.png
      :alt: Price attributes in the Product Prices section of the selected product

#. Provide the value per unit and currency.

#. Click **Save**.

Now you can use the price attribute as a variable parameter in price list generation.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links.rst
   :start-after: begin
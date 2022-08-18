:oro_documentation_types: OroCommerce

.. _user-guide--products--price-attributes:

Manage Price Attributes in the Back-Office
==========================================

A :term:`Price Attribute` is a custom parameter, like the manufacturer's suggested retail price (MSRP), minimum advertised price (MAP), or shipping cost that may be needed as input information for your retail price listed on the website. Price attributes help you extend the product options with any custom value related to the price formation.

Before reading on, consider watching a short demo from our media library on |how to set up price attributes in OroCommerce|.

.. raw:: HTML

   <iframe width="560" height="315" src="https://www.youtube.com/embed/SO36BC3SaXQ" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

You can use the price attribute as a base value for manually or automatically generated price list.

Create a Price Attribute
------------------------

To create a new price attribute:

#. Navigate to **Products > Price Attributes** in the main menu.

#. Click **Create Price Attribute**. The following page opens:

#. Type in the price attribute name (used as a UI label) and the field name used in the code and database to refer to the price attribute container.

#. Select the currencies that are supported for this price attribute:

   * Click the currency to select only one of them.

   * Hold the ``Ctrl`` key and click another currency to add it to the selection.

   * Hold the ``Shift`` key and click another currency to select a range of currencies.

#. Click **Save**.

Now you can set the price attribute value for every product in the **Product Prices** section:

.. image:: /user/img/products/price_attributes/PriceAttributesInProduct.png
   :alt: Display the location of the product price attributes

.. _user-guide--products--price-attributes-manage:

Manage Price Attributes
-----------------------

View Price Attribute Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To view all price attributes, navigate to **Products > Price Attributes** in the main menu.

.. image:: /user/img/products/price_attributes/PriceAttributes.png
   :alt: The page of all price attributes

Here, you can create a new price attribute, filter the list of existing ones by a price attribute name or a field name, and view price attribute details by clicking on the item. Also, you can  |IcView| view, |IcEdit| edit, or |IcDelete| delete a price attribute by hovering over the |IcMore| **More Options** menu to the right of the item.

To remove multiple price attributes, select checkboxes in front of the price attributes that you want to delete. At the right end of the list header, click the |IcMore| **More Options** menu and click |IcDelete| **Delete** to remove all selected price attributes.

Find the necessary price attribute in the list and click on it.

The following information is available immediately:

* **Price Attribute** -- The name or label of the price attribute.

* **Field Name** -- The name of the field in the code/database that represents the price attribute.

* **Currencies** -- The currencies in which this price attribute is supported.

* **Enabled in Product Export** -- If enabled, this price attribute is used in the :ref:`storefront product listing export <frontstore-guide--navigation-product-data-export>`.

.. image:: /user/img/products/price_attributes/price-attribute-edit.png
   :alt: Price attribute edit page

.. _doc--price-attributes--actions--edit:

Edit a Price Attribute
^^^^^^^^^^^^^^^^^^^^^^

To edit a price attribute:

#. Navigate to **Products > Price Attributes** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| **Edit** to start editing its details.

#. Amend the price attribute name (used as a UI label) and/or the field name used in the code and database to refer to the price attribute container.

#. Modify the selection of the currencies that are supported for this price attribute:

   * Click the currency to select only one of them.

   * Hold the ``Ctrl`` key and click another currency to add it to the selection.

   * Hold the ``Shift`` key and click another currency to select a range of currencies.

#. Click **Save**.

Next, adjust the price attribute values and provide values for newly added currencies in the product details.

Set a Price Attribute Value in the Product Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To set a price attribute (e.g., Minimal Advertised Price) for a product:

#. Navigate to **Products > Products** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| **Edit** to start editing its details.

   Price attributes such as MSRP and MAP are available under the **Product Prices** section of the product view/edit page:

   .. image:: /user/img/products/price_attributes/PriceAttributesInProduct.png
      :alt: Price attributes in the Product Prices section of the selected product

   :ref:`Shipping cost price attribute <products--shipping-options-price-attribute>` information is available under the **Shipping Options** section of the product view/edit page:

   .. image:: /user/img/products/price_attributes/shipping-cost-price-attribute.png
      :alt: Illustration of shipping cost information on the product view page

   Shipping cost can work in conjunction with a shipping method, such as :ref:`Fixed Shipping Cost <doc-integration-fixed-shipping-cost>`. For example, if the shipping cost for a product is set to $2.70 and the surcharge configured for the Fixed Shipping Cost shipping method is $3, then the shipping charge at checkout will equate to $5.70.

   .. image:: /user/img/products/price_attributes/shipping-cost-price-attribute-with-integration.png
      :scale: 42%
      :alt: Illustration of how shipping cost set for the price attribute works in combination with the surcharge defined in the fixed product shipping cost integration

   .. hint:: Fixed Product Shipping Cost is available starting from OroCommerce v5.0.2. To check which application version you are running, see the :ref:`system information <system-information>`.

#. Provide the value per unit and currency.

#. Click **Save**.

Now you can use the price attribute as a variable parameter in price list generation.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
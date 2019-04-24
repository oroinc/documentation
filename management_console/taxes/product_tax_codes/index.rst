.. _taxes--product-tax-code:

Product Tax Codes
=================

.. begin

Product Tax Code is a label that is assigned to a product or product group and indicates the tax obligations and exemptions customers have when they purchase this product. These tax obligations are taken into account when a customer (user) submits an order.

The sections below provide guidance on managing product tax codes, using them to label products and bind products to dedicated tax rules.

.. contents:: :local:
   :depth: 1

Create a Product Tax Code
-------------------------

.. include:: /management_console/taxes/product_tax_codes/create.rst
   :start-after: begin
   :end-before: stop

Manage Product Tax Codes
------------------------

To manage product tax codes, navigate to **Taxes > Product Tax Codes** in the main menu.

.. note:: To handle a big volume of data, use the page switcher, increase *View Per Page* or use filters to narrow down the list to just the codes you need.

In the product tax codes list, you will find the information about the code (unique identifier), detailed description, and the dates when the product tax code was created and updated.

Hover over the |IcMore| **More Options** menu to the right of the item and click |IcView| to open its details page, |IcEdit| to edit, or |IcDelete| to remove the product tax code.

View Product Tax Code Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /management_console/taxes/product_tax_codes/view.rst
   :start-after: begin
   :end-before: stop

Edit Product Tax Code Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To edit the product tax code value and description:

#. Navigate to **Taxes > Product Tax Codes** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

#. Update the **Code** and **Description** with new information about the product tax code.

#. Click **Save and Close**.

Link a Tax Code to a Product
----------------------------

.. include:: /management_console/taxes/product_tax_codes/link_a_tax_code_to_a_product.rst
   :start-after: begin
   :end-before: stop

Link a Product Tax Code to the Tax Rule
---------------------------------------

You can edit the association of the product tax code with the tax when :ref:`editing the tax rule details <tax-rules-edit>` (see the respective topic for more information).

**Related Articles**

* :ref:`Taxes <user-guide--taxes>`

* :ref:`Tax Jurisdictions <taxes--tax-jurisdiction>`

* :ref:`Tax Rates <user-guide--taxes--tax-rates>`

* :ref:`Tax Rules <tax-rules>`

* :ref:`Customer Tax Codes <user-guide--taxes--customer_tax_codes>`

.. finish

.. toctree::
   :hidden:

   create
   view
   link_a_tax_code_to_a_product

.. include:: /img/buttons/include_images.rst
   :start-after: begin
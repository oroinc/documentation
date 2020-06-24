:oro_documentation_types: OroCommerce

.. _taxes--product-tax-code:

Manage Product Tax Codes in the Back-Office
===========================================

.. begin

.. hint:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

:term:`Product Tax Code` is a label that is assigned to a product or product group and indicates the tax obligations and exemptions customers have when they purchase this product. These tax obligations are taken into account when a customer (user) submits an order.

The sections below provide guidance on managing product tax codes, using them to label products and bind products to dedicated tax rules.

Create a Product Tax Code
-------------------------

.. include:: /user/back-office/taxes/product-tax-codes/create.rst
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

.. include:: /user/back-office/taxes/product-tax-codes/view.rst
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

.. include:: /user/back-office/taxes/product-tax-codes/link-a-tax-code-to-a-product.rst
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
   link-a-tax-code-to-a-product

.. include:: /include/include-images.rst
   :start-after: begin
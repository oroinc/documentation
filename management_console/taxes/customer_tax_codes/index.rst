.. _user-guide--taxes--customer_tax_codes:

Customer Tax Codes
==================

.. begin

Customer Tax Code is a label that is assigned to a customer and indicates the tax obligations and exemptions a customer has. The customer tax obligations are taken into account when a customer (user) submits an order.

The sections below provide guidance on managing customer tax codes, using them to label customers and bind customers to a dedicated tax rules.

.. contents:: :local:
   :depth: 1

Create a Customer Tax Code
--------------------------

.. include:: /management_console/taxes/customer_tax_codes/create.rst
  :start-after: begin
  :end-before: stop

Manage Customer Tax Codes
-------------------------

To view all customer tax codes, navigate to **Taxes > Customer Tax Codes** in the main menu.

.. image:: /img/taxes/customer_tax_codes.png
   :alt: The general page of all customer tax codes

.. note:: To handle a big volume of data, use the page switcher, increase *View Per Page* or use filters to narrow down the list to just the codes you need.

In the customer tax codes list, you will find the information about the code (unique identifier), detailed description, and the dates when the customer tax code was created and updated.

You can perform the following actions with every item in the customer tax codes list:

 * `View customer tax code details <view>`_: Click on the item to open its details page.

   Alternatively: Hover over the |IcMore| **More Options** menu to the right of the item and click |IcView| to open its details page.

 * `Edit customer tax code details <edit>`_: Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

 * Delete a Customer Tax Code: Hover over the |IcMore| **More Options** menu to the right of the item and click |IcDelete| to remove the customer tax code.


View Customer Tax Code Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /management_console/taxes/customer_tax_codes/view.rst
   :start-after: begin
   :end-before: stop

Edit Customer Tax Code Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To edit the customer tax code value and description:

#. Navigate to **Taxes > Customer Tax Codes** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

#. Update the **Code** and **Description** with new information about the customer tax code.

#. Click **Save and Close**.

Link a Tax Code to a Customer or a Customer Group
-------------------------------------------------

.. include:: /management_console/taxes/customer_tax_codes/link_a_tax_code_to_a_customer.rst
   :start-after: begin
   :end-before: stop

Link a Customer Tax Code to the Tax Rule
----------------------------------------

You can edit the association of the customer tax code with the tax when :ref:`editing the tax rule details <tax-rules-edit>` (see the respective topic for more information).

**Related Articles**

* :ref:`Taxes <user-guide--taxes>`

* :ref:`Product Tax Codes <taxes--product-tax-code>`

* :ref:`Tax Jurisdictions <taxes--tax-jurisdiction>`

* :ref:`Tax Rates <user-guide--taxes--tax-rates>`

* :ref:`Tax Rules <tax-rules>`

.. finish

.. toctree::
   :hidden:

   create
   view
   link_a_tax_code_to_a_customer

.. include:: /img/buttons/include_images.rst
   :start-after: begin
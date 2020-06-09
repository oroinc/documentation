:oro_documentation_types: OroCommerce

.. _user-guide--taxes--customer_tax_codes:

Manage Customer Tax Codes in the Back-Office
============================================

.. begin

.. important:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

Customer Tax Code is a label that is assigned to a customer and indicates the tax obligations and exemptions a customer has. The customer tax obligations are taken into account when a customer (user) submits an order.

The sections below provide guidance on managing customer tax codes, using them to label customers and bind customers to a dedicated tax rules.

Create a Customer Tax Code
--------------------------

.. include:: /user/back-office/taxes/customer-tax-codes/create.rst
  :start-after: begin
  :end-before: stop

Manage Customer Tax Codes
-------------------------

To view all customer tax codes, navigate to **Taxes > Customer Tax Codes** in the main menu.

.. image:: /user/img/taxes/customer_tax_codes.png
   :alt: The general page of all customer tax codes

.. note:: To handle a big volume of data, use the page switcher, increase *View Per Page* or use filters to narrow down the list to just the codes you need.

In the customer tax codes list, you will find the information about the code (unique identifier), detailed description, and the dates when the customer tax code was created and updated.

Hover over the |IcMore| **More Options** menu to the right of the item and click |IcView| to open its details page, |IcEdit| to edit, or  |IcDelete| to remove the customer tax code.


View Customer Tax Code Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

.. include:: /user/back-office/taxes/customer-tax-codes/view.rst
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

.. include:: /user/back-office/taxes/customer-tax-codes/link-a-tax-code-to-a-customer.rst
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
   link-a-tax-code-to-a-customer

.. include:: /include/include-images.rst
   :start-after: begin
:oro_documentation_types: OroCommerce

.. _tax-rules:

Manage Tax Rules in the Back-Office
===================================

.. begin

.. hint:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

Tax rules help OroCommerce find the correct tax rate that should be used for the products listed in the purchase order by matching the product tax code that indicates:

* Tax status of the product
* Customer tax code that indicates the tax status of the buying company
* Tax jurisdiction where the tax is due

The sections below provide guidance on how to create and manage tax rules.

Create a Tax Rule
-----------------

.. include:: /user/back-office/taxes/tax-rules/create.rst
   :start-after: begin
   :end-before: stop

Manage Tax Rules
----------------

.. include:: /user/back-office/taxes/tax-rules/viewlist.rst
   :start-after: begin
   :end-before: stop

View Tax Rule Details
^^^^^^^^^^^^^^^^^^^^^

To view tax rule details:

#. Navigate to **Taxes > Tax Rules** in the main menu.

#. Find the line with the necessary tax rule and click on it to open its details page.

   .. image:: /user/img/taxes/tax_rules_view.png
      :alt: View the tax rule details

You can |IcEdit| **Edit** or |IcDelete| **Delete** the tax rule by clicking the required button on the top right.

.. _tax-rules-edit:

Edit a Tax Rule
^^^^^^^^^^^^^^^

To edit the tax rule:

#. Navigate to **Taxes > Tax Rules** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

#. Update the links between the tax rule and the tax rule components (a tax rate, a tax jurisdiction, a customer tax code, and a product tax code) to modify the tax rule.

#. Click **Save and Close**.

Export Tax Rules
----------------

.. include:: /user/back-office/taxes/tax-rules/export-tax-rules.rst
   :start-after: start

Import Tax Rules
----------------

.. include:: /user/back-office/taxes/tax-rules/import-tax-rules.rst
   :start-after: start

**Related Articles**

* :ref:`Taxes <user-guide--taxes>`

* :ref:`Customer Tax Codes <user-guide--taxes--customer_tax_codes>`

* :ref:`Product Tax Codes <taxes--product-tax-code>`

* :ref:`Tax Jurisdictions <taxes--tax-jurisdiction>`

* :ref:`Tax Rates <user-guide--taxes--tax-rates>`

.. finish

.. toctree::
   :hidden:

   create
   viewlist
   export-tax-rules
   import-tax-rules

.. include:: /include/include-images.rst
   :start-after: begin
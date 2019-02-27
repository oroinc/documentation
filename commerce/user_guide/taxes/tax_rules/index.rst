.. _tax-rules:

Tax Rules
=========

.. begin

Tax rules help OroCommerce find the correct tax rate that should be used for the products listed in the purchase order by matching the product tax code that indicates:

* Tax status of the product
* Customer tax code that indicates the tax status of the buying company
* Tax jurisdiction where the tax is due

The sections below provide guidance on how to create and manage tax rules.

.. contents:: :local:
   :depth: 1

Create a Tax Rule
-----------------

.. include:: /user_guide/taxes/tax_rules/create.rst
   :start-after: begin
   :end-before: stop

Manage Tax Rules
----------------

.. include:: /user_guide/taxes/tax_rules/viewlist.rst
   :start-after: begin
   :end-before: stop

View Tax Rule Details
^^^^^^^^^^^^^^^^^^^^^

To view tax rule details:

#. Navigate to **Taxes > Tax Rules** in the main menu.

#. Find the line with the necessary tax rule and click on it.

   The following information is available immediately:

    * Customer Tax Code

    * Product Tax Code

    * Tax Jurisdiction

    * Tax (rate)

    * Description

   .. image:: /user_guide/img/taxes/tax_rules/tax_rules_view.png
      :alt: View the tax rule details

You can perform the following actions with a tax rule:

 * Edit tax rule details by clicking |IcEdit| **Edit** to the top right of the page.

 * Delete a tax rule by clicking |IcDelete| **Delete** to the top right of the page.

.. _tax-rules-edit:

Edit a Tax Rule
^^^^^^^^^^^^^^^

To edit the tax rule:

#. Navigate to **Taxes > Tax Rules** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

   The following page is displayed:

.. image:: /user_guide/img/taxes/tax_rules/tax_rules_edit.png
   :alt: Edit the tax rules details

#. Update the links between the tax rule and the tax rule components (a tax rate, a tax jurisdiction, a customer tax code, and a product tax code) to modify the tax rule.

#. Click **Save and Close**.

Export Tax Rules
----------------

You can export the tax rule details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import Tax Rules
----------------

.. include:: /getting_started/import_export/import_tax_rules.rst
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

.. include:: /img/buttons/include_images.rst
   :start-after: begin
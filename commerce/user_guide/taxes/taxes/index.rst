.. _user-guide--taxes--tax-rates:

Taxes (Tax Rates)
=================

.. begin

Tax or tax rate is a particular percentage of tax with unique identifier and description that helps you associate the tax rate with other tax components using :ref:`tax rules <tax-rules>`.

.. contents:: :local:
   :depth: 1

Create a Tax Rate
-----------------

.. include:: /user_guide/taxes/taxes/create.rst
   :start-after: begin
   :end-before: stop

Manage Tax Rates
----------------

.. include:: /user_guide/taxes/taxes/viewlist.rst
   :start-after: begin
   :end-before: stop

View Tax Rate Details
^^^^^^^^^^^^^^^^^^^^^

To view tax rate details:

#. Navigate to **Taxes > Taxes** in the main menu.

#. Find the line with the necessary tax rate and click on it.

   The following information is available immediately:

   * Code

   * Description

   * Rate in percentage

   .. image:: /user_guide/img/taxes/taxes/tax_rates_details.png
      :class: with-border

You can perform the following actions with a tax rate:

 * Edit Tax Rate details by clicking |IcEdit| **Edit** to the top right of the page.

 * Delete a Tax Rate by clicking |IcDelete| **Delete** to the top right of the page.

Edit a Tax Rate
^^^^^^^^^^^^^^^

To edit the tax rate code, description, and rate:

#. Navigate to **Taxes > Taxes** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

   The following page is displayed:

   .. image:: /user_guide/img/taxes/taxes/tax_rates_edit.png
      :alt: Edit the tax rate details

#. Update the **Code**, **Description**, and **Rate (%)** with new information about the tax rate.

#. Click **Save and Close**.

Link a Tax Rate to the Tax Rule
-------------------------------

You can edit the association of the tax rate with other tax components when :ref:`editing the tax rule details <tax-rules-edit>` (see the respective topic for more information).

Export Tax Rates
----------------

You can export the tax rate details in the .csv format following the :ref:`Exporting Bulk Items <export-bulk-items>` guide.

Import Tax Rates
----------------

.. include:: /getting_started/import_export/import_taxes.rst
   :start-after: start

**Related Articles**

* :ref:`Taxes <user-guide--taxes>`

* :ref:`Tax Rules <tax-rules>`

* :ref:`Tax Jurisdictions <taxes--tax-jurisdiction>`

* :ref:`Customer Tax Codes <user-guide--taxes--customer_tax_codes>`

* :ref:`Product Tax Codes <taxes--product-tax-code>`

.. finish

.. toctree::
   :hidden:

   create
   viewlist

.. include:: /img/buttons/include_images.rst
   :start-after: begin

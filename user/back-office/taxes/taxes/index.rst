:oro_documentation_types: OroCommerce

.. _user-guide--taxes--tax-rates:

Manage Taxes (Tax Rates) in the Back-Office
===========================================

.. begin

.. hint:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

Tax or tax rate is a particular percentage of tax with unique identifier and description that helps you associate the tax rate with other tax components using :ref:`tax rules <tax-rules>`.

Create a Tax Rate
-----------------

.. include:: /user/back-office/taxes/taxes/create.rst
   :start-after: begin
   :end-before: stop

Manage Tax Rates
----------------

.. include:: /user/back-office/taxes/taxes/viewlist.rst
   :start-after: begin
   :end-before: stop

View Tax Rate Details
^^^^^^^^^^^^^^^^^^^^^

To view tax rate details:

#. Navigate to **Taxes > Taxes** in the main menu.

#. Find the line with the necessary tax rate and click on it to open its details page.

You can |IcEdit| **Edit** or |IcDelete| **Delete** the tax rate by clicking the required button on the top right.

Edit a Tax Rate
^^^^^^^^^^^^^^^

To edit the tax rate code, description, and rate:

#. Navigate to **Taxes > Taxes** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

#. Update the **Code**, **Description**, and **Rate (%)** with new information about the tax rate.

#. Click **Save and Close**.

Link a Tax Rate to the Tax Rule
-------------------------------

You can edit the association of the tax rate with other tax components when :ref:`editing the tax rule details <tax-rules-edit>` (see the respective topic for more information).

Export Tax Rates
----------------

.. include:: /user/back-office/taxes/taxes/export-tax-rates.rst
   :start-after: start

Import Tax Rates
----------------

.. include:: /user/back-office/taxes/taxes/import-tax-rates.rst
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
   export-tax-rates
   import-tax-rates

.. include:: /include/include-images.rst
   :start-after: begin

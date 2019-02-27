.. _taxes--tax-jurisdiction:

Tax Jurisdictions
=================

.. begin

Tax Jurisdiction is a geographical address of the area that is governed by the same tax laws and regulations, and that requires a dedicated set of tax calculation rules in OroCommerce: the tax rates for taxable/tax-exempt types of customers and products.

The sections below provide guidance on managing tax jurisdictions and assigning dedicated tax rules for these tax jurisdictions.

.. contents:: :local:
   :depth: 1

Create a Tax Jurisdiction
-------------------------

.. include:: /user_guide/taxes/tax_jurisdictions/create.rst
   :start-after: begin
   :end-before: stop

Manage Tax Jurisdictions
------------------------

.. include:: /user_guide/taxes/tax_jurisdictions/viewlist.rst
   :start-after: begin
   :end-before: stop

View Tax Jurisdiction Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To view tax jurisdiction details:

#. Navigate to **Taxes > Tax Jurisdictions** in the main menu.

#. Find the line with the necessary tax jurisdiction and click on it.

   The following information is available immediately:

   * Code

   * Description

   * State

   * Country

   * Zip Codes

   .. image:: /user_guide/img/taxes/tax_jurisdictions/tax_jurisdiction_details.png
      :alt: View the tax jurisdiction details

You can perform the following actions with a tax jurisdiction:

 * Edit a Tax Jurisdiction details by clicking |IcEdit| **Edit** to the top right of the page.

 * Delete a Tax Jurisdiction by clicking |IcDelete| **Delete** to the top right of the page.


Edit a Tax Jurisdiction
^^^^^^^^^^^^^^^^^^^^^^^

To edit the Tax Jurisdiction details:

#. Navigate to **Taxes > Tax Jurisdictions** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

   The following page is displayed:

.. image:: /user_guide/img/taxes/tax_jurisdictions/tax_jurisdiction_fill.png
   :alt: Edit the selected tax jurisdiction

#. Update the **Code**, **Description**, and the covered addresses including zip codes.

#. Click **Save and Close**.

Link a Tax Jurisdiction to the Tax Rule
---------------------------------------

You can edit the association of the tax jurisdiction with other tax components when :ref:`editing the tax rule details <tax-rules-edit>` (see the respective topic for more information).

**Related Articles**

* :ref:`Taxes <user-guide--taxes>`

* :ref:`Tax Rates <user-guide--taxes--tax-rates>`

* :ref:`Tax Rules <tax-rules>`

* :ref:`Customer Tax Codes <user-guide--taxes--customer_tax_codes>`

* :ref:`Product Tax Codes <taxes--product-tax-code>`


.. finish

.. toctree::
   :hidden:

   create
   viewlist

.. include:: /img/buttons/include_images.rst
   :start-after: begin
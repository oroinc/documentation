:oro_documentation_types: OroCommerce

.. _taxes--tax-jurisdiction:

Manage Tax Jurisdictions in the Back-Office
===========================================

.. begin

.. important:: This section is a part of the :ref:`Tax Management <concept-guide--taxes>` concept guide that provides the general understanding of the tax configuration and management in OroCommerce.

:term:`Tax Jurisdiction` is a geographical address of the area that is governed by the same tax laws and regulations, and that requires a dedicated set of tax calculation rules in OroCommerce: the tax rates for taxable/tax-exempt types of customers and products.

The sections below provide guidance on managing tax jurisdictions and assigning dedicated tax rules for these tax jurisdictions.

Create a Tax Jurisdiction
-------------------------

.. include:: /user/back-office/taxes/tax-jurisdictions/create.rst
   :start-after: begin
   :end-before: stop

Manage Tax Jurisdictions
------------------------

.. include:: /user/back-office/taxes/tax-jurisdictions/viewlist.rst
   :start-after: begin
   :end-before: stop

View Tax Jurisdiction Details
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To view tax jurisdiction details:

#. Navigate to **Taxes > Tax Jurisdictions** in the main menu.

#. Find the line with the necessary tax jurisdiction and click on it to open its details page.

   .. image:: /user/img/taxes/tax_jurisdiction_details.png
      :alt: View the tax jurisdiction details

You can |IcEdit| edit or |IcDelete|  delete the tax jurisdiction by clicking the required button on the top right.

Edit a Tax Jurisdiction
^^^^^^^^^^^^^^^^^^^^^^^

To edit the Tax Jurisdiction details:

#. Navigate to **Taxes > Tax Jurisdictions** in the main menu.

#. Hover over the |IcMore| **More Options** menu to the right of the item and click |IcEdit| to start editing its details.

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

.. include:: /include/include-images.rst
   :start-after: begin
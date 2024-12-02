:oro_show_local_toc: false

.. _frontstore-guide--rfq:

Manage Requests for Quote in the Storefront
===========================================

To negotiate with the sales person (e.g. on a better price, more convenient quantities and additional services), you can request a quote. Both registered and guest users can create :term:`RFQs <Request for Quote>` in the Oro storefront.

Registered users can view all existing Requests for Quote or create new ones in their storefront account by clicking Requests for Quote in the user menu in the top navigation bar.

.. image:: /user/img/storefront/rfq/RFQ.png

RFQ Grid
--------

The RFQ grid shows the following data:

1. RFQ#
2. Status
3. PO Number
4. Ship by
5. Create At
6. Owner
7. Step
8. More Actions (View)

Within the table you have the following :ref:`action buttons <frontstore-guide--navigation-action-buttons>` available:

1. Refresh |Refresh-SVG| the view table.
2. Reset |Reset-SVG| the view table to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.
3. Manage |Columns-SVG| table settings to define which columns to show in the table.
4. Manage :ref:`filters <frontstore-guide--navigation-filters>` |Settings-SVG|.

RFQ View Page
-------------

To view a specific RFQ, click **View** on it in the grid.

.. image:: /user/img/storefront/rfq/ViewRFQ.png

The Customer User View Page has the number of the selected RFQ in the page header (e.g. #2), as well as the following information:

* First Name
* Last Name
* Email Address
* Phone Number
* Company
* Role
* PO Number
* Do Not Ship Later Than
* Owner
* Notes
* Line Items (item name, requested quantity, target price).

You can print the selected RFQ by clicking **Print RFQ**  on the top right of the view page, or ask a question, as part of the :ref:`conversations feature <storefront-guide--conversations>`.

.. image:: /user/img/storefront/rfq/PrintRFQ.png

If an RFQ was previously cancelled, you can resubmit the RFQ by clicking |Resubmit-SVG| **Resubmit** on the top right of the view page.

.. image:: /user/img/storefront/rfq/RFQResubmitNew.png

.. toctree::
   :maxdepth: 1
   :hidden:

   Create an RFQ <registered>
   Create a Guest RFQ <guests>

.. include:: /include/include-svg.rst
   :start-after: begin

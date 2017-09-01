.. _frontstore-guide--rfq:

Request for Quote
=================

To negotiate with the sales person (e.g. on a better price, more convenient quantities and additional services), you can request a quote.

The following guide will focus on the Request for Quote (RFQ) section of the OroCommerce front store.

.. contents:: :local:
   :depth: 2

To locate RFQ:

1. Navigate to **Account** in the :ref:`user menu <frontstore-guide--navigation-user-menu>`.
2. Click **Request for Quote** in the menu on the left.
   
.. image:: /frontstore_guide/img/rfq/RFQ.png

On the All Requests for Quote page, you can view the existing RFQs, or create new ones.

The RFQ table shows the following data:

1. RFQ#
2. Status
3. PO Number
4. DNSLT (Do not ship later than)
5. Create At
6. Owner
7. Step
8. More Actions (View)

Within the table you have the following :ref:`action buttons <frontstore-guide--navigation-action-buttons>` available:

1. Refresh the view table: click |IcRefresh| to update the view table.
2. Reset the view table: click |IcReset| to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.
3. Table settings: click |IcSettings| to define which columns to show in the table.
4. :ref:`Filters <frontstore-guide--navigation-filters>` |IcFilter|.

Create RFQ 
^^^^^^^^^^

There are a few ways to create a RFQ.

On the All Requests for Quote Page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

1. Navigate to **Account** in the :ref:`user menu <frontstore-guide--navigation-user-menu>`.
2. Click **Request for Quote** in the menu on the left.
3. Click **+New Quote** on the right of the page.
   
   .. image:: /frontstore_guide/img/rfq/CreateRFQ1.png

From the Shopping List
~~~~~~~~~~~~~~~~~~~~~~

1. In the top right corner, click on the |IcShoppingLists| N Shipping Lists button to open a drop-down list with all available shopping lists.

   .. image:: /frontstore_guide/img/shopping_lists/ShoppingLists.png

2. Click on the necessary shopping list.

   .. image:: /frontstore_guide/img/shopping_lists/ShoppingListsDropdown.png

3. Click **Request Quote** on the rop right of the page, or by selecting this option from the drop-down list of the **Create Order** button at the bottom of the page.

   .. image:: /frontstore_guide/img/rfq/CreateRFQ2.png

Whichever way you select, a form will emerge prompting you to provide information.

.. image:: /frontstore_guide/img/rfq/NewRFQForm.png

In the Request a Quote section, enter:

* First Name
* Last Name
* Email Address
* Phone Number
* Company
* Role
* Notes (The message for the RFQ)
* PO Number
* Do Not Ship Later Than date
* Assigned to
  
In the Products section:

* Select a product from the dropdown, or click |IcCompactDetails| to see a complete list of products.
* Enter the number of items/sets.
* Click **Add Another Line** to provide additional quantities and price.
* Give the target price.
* Add a note to the item by clicking **Add a Note to This Item** (You can delete or update such note by clicking on the corresponding buttons).
* Click **Add Another Product** if a RFQ for more than one product is required.
* Click **Submit Request** to sent the RFQ.

.. image:: /frontstore_guide/img/rfq/RFQProducts.png

.. note:: If you are creating a RFQ for the products in the shopping list, the Products section will be pre-defined. There will be options to edit, delete the products, or add another product to the list.

    .. image:: /frontstore_guide/img/rfq/RFQFromShoppingList.png


RFQ View Page 
^^^^^^^^^^^^^

To view a specific RFQ, click **View** on it in the view table.

.. image:: /frontstore_guide/img/rfq/ViewRFQ.png

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

.. image:: /frontstore_guide/img/rfq/RFQViewPage.png

You can resubmit the RFQ by clicking |IcRedo| **Resubmit** on the top right of the view page.

.. image:: /frontstore_guide/img/rfq/RFQResubmit.png

.. include:: /frontstore_guide/related_topics.rst
   :start-after: begin

.. include:: /user_guide/include_images.rst
   :start-after: begin

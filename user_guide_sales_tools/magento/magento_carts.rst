:orphan:

.. _user-guide-magento-carts-create:

Magento Carts
-------------

.. begin

Create a Magento Shopping Cart
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

As a rule, carts are synced into OroCRM from the Magento side, although it is possible to create them in your Oro application. To do that, follow the next steps:

1. Navigate to **Customers > Magento Customers** in the main menu.
2. Click on the necessary customer to open their view page.
3. Click **Create Order** in the top navigation menu on the customer page.
4. At this point, if you leave the order placement procedure, a cart will be created in OroCRM.

Convert a Shopping Cart into an Order
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To convert a shopping cart into an :ref:`order <user-guide-magento-orders-create>`, perform the following steps:

1. Navigate to **Sales > Magento Shopping Carts**.
2. Click on the necessary cart to open its :ref:`view page <user-guide-ui-components-view-pages>`. Make sure that the status of such cart is **Open**.
3. Click the **Place an Order**.

   .. image:: /img/magento_entities/PlaceOrderFromCart.png
      :alt: The place an order button on the magento shopping cart page

3. Enter the admin panel of your Magento shop and submit the order.

   .. image:: /img/magento_entities/PlaceOrderFromCartAdminPanel.png
      :alt: The admin panel of a magento shop in OroCRM

.. caution::

    Be careful not to confuse the cart status and step of the related workflow. For example, a cart in the
    *Contacted* step can still have the *Open* status (items in the carts have not yet been bought).


View Carts
^^^^^^^^^^

**From the Grid**

To view all Magento carts, navigate to **Sales > Magento Carts** in the main menu.

.. image:: /img/magento_entities/AllMagentoCartsGrid.png
   :alt: The list of all magento carts

The following information is displayed for carts:

1. Channel
2. Website
3. Cart ID
4. First Name
5. Last Name
6. Email
7. Qty
8. Grand Total
9. Create At
10. Update At
11. Billing Country
12. Billing State
13. Status
14. Step
15. Tags

You can perform the following actions from the grid:

1. **Filter**: Click |IcFilter| to show filters per column. You can limit displayed items to those that match filtering criteria provided.
2. **Refresh**: Click |IcRedo| to reload the information about the items. If another user recently updated the item details, these changes are reflected upon the refresh.
3. **Reset**: Click |IcRefresh| to roll back the view per page, filters and columns configuration to the default values.
4. **Manage columns**: Open grid settings by clicking |IcSettings| to see the list of columns that organize the item details. To reorder the columns, click and hold the column name, then drag it to the new location. Toggle on and off the column show option using the *Show* check box.

.. note:: To handle big volume of data, use page switcher, increase View Per Page or use filters to narrow down the list to the information you need.

You can view details of each cart by:

1. Clicking on the selected cart from the grid.
2. Hovering over the |IcMore| more actions menu to the right of the cart and clicking |IcView|.

**From the Cart View Page**

To view details of a specific cart:

1. Navigate to **Sales > Magento Orders** in the main menu.
2. Find the line with the necessary order in the grid and click on it.

The following page opens:

.. image:: /img/magento_entities/MagentoCartViewPageNew.png
   :alt: Details of a specific cart displayed on the cart page

Within the page, the following sections are available:

1. **General Information** section is for cart and customer details.
2. **Cart Items** section lists active and deleted items from the cart.
3. **Activity** section includes any :ref:`activities <user-guide-activities>` related to the cart related to the order, such as attachments, calls, calendar events, notes, emails or tasks (if available).
4. **Marketing Activity** section has any marketing activity records related to the Magento cart (if available).

From the cart view page, you can perform the following actions:


1. Sync Data to synchronize cart details. This will upload the latest information for the cart from Magento and back (as defined by the synchronization settings).
2. Send an :ref:`Email <user-guide-using-emails>`.
3. Log a :ref:`Call <doc-activities-calls>`.

.. image:: /img/magento_entities/MagentoCartItemsTopMenu.png
   :alt: The actions you can perform on the cart view page, such as sync data, send email and log call.


.. important::

    Information for all the carts is updated once in a predefined period (default value is 5 minutes).
    However, it is strongly recommended to update a specific Cart record before you perform any actions with it.


.. finish


.. include:: /img/buttons/include_images.rst
   :start-after: begin

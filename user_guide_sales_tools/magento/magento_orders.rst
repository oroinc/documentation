:orphan:

.. _user-guide-magento-orders-create:

Magento Orders
--------------

This section will cover the following key topics:

.. contents:: :local:

.. begin


Create an Order
^^^^^^^^^^^^^^^

There are two ways of creating an order in OroCRM:

1. From the view page of :ref:`a Magento customer <user-guide-magento-entities-customers>`.
2. By converting a cart into an order.

Create an Order from a Magento Customer Page
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To create an order from the view page of the selected Magento customer:

1. Navigate to **Customers > Magento Customers** in the main menu.
2. Click on the necessary customer to open their view page.
3. Click **Create Order** in the top navigation menu on the customer page.

   .. image:: /img/magento_entities/CreateOrderButtonNew.png
      :alt: Click create order in the navigation menu


4. Enter the admin panel of your Magento shop.

   .. image:: /img/magento_entities/LoginToAdminMagento.png
      :alt: Log in to admin panel form

5. Fill in the details in the order form and click **Submit Order** in the top right corner of the form.

   .. image:: /img/magento_entities/CreatOrderInAdminPanel.png
      :alt: Enter details and click submit order

Please, keep in mind that:

- If you do not complete order placement procedure, a shopping cart will be created.
- If you submit the order from the admin panel, an order will be created in OroCRM.

Convert a Shopping Cart into an Order
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To convert a shopping cart into an order, perform the following steps:

1. Navigate to **Sales > Magento Shopping Carts**.
2. Click on the necessary cart to open its :ref:`view page <user-guide-ui-components-view-pages>`. Make sure that the status of such cart is **Open**.
3. Click the **Place an Order**.

   .. image:: /img/magento_entities/PlaceOrderFromCart.png
      :alt: Click place as order

3. Enter the admin panel of your Magento shop and submit the order.

   .. image:: /img/magento_entities/PlaceOrderFromCartAdminPanel.png
      :alt: Magento shop

.. caution::

    Be careful not to confuse the cart status and step of the related workflow. For example, a cart in the
    *Contacted* step can still have the *Open* status (items in the carts have not yet been bought).

View Magento Orders
^^^^^^^^^^^^^^^^^^^

**From the Grid**

To view all orders, navigate to **Sales > Magento Orders** in the main menu.

.. image:: /img/magento_entities/MagentoOrdersGrid.png
   :alt: Magento orders

The following information about orders is available:

1. Channel
2. Website
3. Order #
4. First Name
5. Last name
6. Email
7. Create at
8. Updated At
9. Total Paid
10. Grand Total
11. Sub Total
12. Billing Country
13. Billing State
14. Status
15. Step
16. Tags

To manage the columns displayed within the grid, click |IcSettings| on the right of the grid, and select the information you wish to be displayed.

.. note:: To handle big volume of data, use page switcher, increase View Per Page or use filters to narrow down the list to the information you need.

You can view details of each order by:

1. Clicking on the selected order from the grid.
2. Hovering over the |IcMore| more actions menu to the right of the order and clicking |IcView|.

**From Magento Order View Page**

To view details of a specific order:

1. Navigate to **Sales > Magento Orders** in the main menu.
2. Find the line with the necessary order in the grid and click on it.

The following page opens:

.. image:: /img/magento_entities/OrderPending.png
   :alt: 

Within the page, the following sections are available:

1. **General Information** section is for order details, such as who created the order, which website it applies to, the customer's shipping/billing addresses, telephone, etc.
2. **Order Items** section has the list of products added to the order, and their details.
3. **Credit Memos** section has records of any :ref:`credit memos <user-guide--sales--magento-credit-memos>` related to the order.
4. **Order Notes** section contains comments added to an order on the Magento side. The visibility of comments under Order Notes for Magento Orders is controlled by the configuration setup when creating a Magento integration.

   .. note:: Be aware that comments added to an order on the Magento side are synced only when OroBridge extension v. 1.2.19 (or higher) is installed on the Magento side. Otherwise, the *Import Order Comments as Order Notes* field is disabled in Oro when :ref:`creating or editing a Magento Integration <user-guide-magento-channel-integration>`, and no comments are imported. Please refer to your administrator if you are experiencing any problems.

5. **Activity** section includes any :ref:`activities <user-guide-activities>` related to the order related to the order, such as attachments, calls, calendar events, notes, emails or tasks (if available).

From the order view page, you can perform the following actions:

1. Sync Data to synchronize order details. This will upload the latest information for the order from Magento and back (as defined by the synchronization settings).
2. Under **More Actions** menu, you can log a call, add an attachment, a note, a task, an event, or send an email.
3. **Record Feedback** on the order.

   .. image:: /img/magento_entities/MagentoOrderTopMenu.png


.. important::

    Information for all the orders is updated once in a predefined period (default value is 5 minutes).
    However, it is strongly recommended to update a specific Cart record before you perform any actions with it.

.. finish

.. include:: /img/buttons/include_images.rst
   :start-after: begin

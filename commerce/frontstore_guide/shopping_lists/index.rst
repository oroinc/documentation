.. _frontstore-guide--shopping-lists:

Shopping Lists 
==============

The following guide will describe how shopping lists can be used in OroCommerce front store.

.. contents:: :local:
   :depth: 2

In OroCommerce, shopping lists are much more than merely a list of items in a cart. For one, in OroCommerce registered customers can create and manage not just one, but multiple shopping lists. This is useful when customers have to work on many projects that need different products for various needs. Unregistered customers, in turn, can purchase goods without the need of going through the registration process, which simplifies their shopping experience and saves time.

.. _frontstore-guide--shopping-lists-create:

In the front store, shopping lists are located in the top right corner and can be easily spotted.

.. image:: /frontstore_guide/img/shopping_lists/ShoppingLists.png

The shopping lists button displays the number of shopping lists that have been created.

Clicking on the |IcChevronDown| icon next to the button will open a drop-down with all available shopping lists, the number of items in each of them, and a button to create a new shopping list.

.. image:: /frontstore_guide/img/shopping_lists/ShoppingListsDropdown.png

Shopping Lists for Registered Users
-----------------------------------

Create a Shopping List
^^^^^^^^^^^^^^^^^^^^^^

Shopping lists can be created using several flows.

**Flow 1**

1. Click |IcChevronDown| next to **Shopping Lists** on the top right of the page.
2. Click **Create New List** on the bottom of the drop-down window.
3. Give the list a name and click **Create**.
   
.. image:: /frontstore_guide/img/shopping_lists/ShoppingListName.png

**Flow 2**

1. Click on the drop-down icon |IcChevronDown| located in the **Add to** button next to each product.
2. Select **Create New Shopping List**.
3. Give the list a name and click **Create**.

.. image:: /frontstore_guide/img/shopping_lists/CreateShoppingListItem.png

**Flow 3**

1. Click **Quick Order Form** on the top right of the page.
2. Enter product details in the provided fields.
3. Click **Add to** on the bottom of the Quick Order page. 
4. Select **Create New Shopping List**.
5. Give the list a name and click **Create**.  

**Flow 4**

1. In the Quick Order Form, enter product SKU(s) and quantity.
2. Click **Verify Order**.
3. In the Verify Order window, Click **Add to** on the top.
4. Select **Create New Shopping List**.
5. Give the list a name and click **Create**.  
 
.. image:: /frontstore_guide/img/shopping_lists/CreateShoppingListQuickOrder.png

**Flow 5**

1. Open :ref:`Matrix Ordering Form <frontstore-guide--orders-matrix>`.
   
.. image:: /frontstore_guide/img/orders/HatProductPage.png

2. Enter the number of items for each category. 
   
.. image:: /frontstore_guide/img/orders/MatrixForm.png

4. Click on the drop-down icon |IcChevronDown| located in the **Add to** button next to each product.
5. Select **Create New Shopping List**.

.. image:: /frontstore_guide/img/orders/MatrixFormShoppngList.png

7. Give the list a name and click **Create**.
   
**Flow 6**

Duplicate the already existing shopping list to make multiple similar orders:

1. Open a shopping list.
2. Click **Duplicate List** on the left under the list of items.
3. A copy of the shopping list will be created.

.. image:: /user_guide/img/sales/shopping_lists/DuplicateListFrontEndScreenShot.png

.. _frontstore-guide--shopping-lists-view:

View Shopping List 
^^^^^^^^^^^^^^^^^^

The shopping list view page contains the following information and options:

1. Customer name (drop-down)
2. Item name
3. Availability
4. Quantity
5. Price
6. Subtotal
7. Total
8. A list of all shopping lists available
   
Here you can add a note to the current shopping list, as well as each of the items within this list, by enabling the **Add a Note to This Shopping List** checkbox.


.. image:: /frontstore_guide/img/shopping_lists/AddNoteShoppingList.png

.. _frontstore-guide--shopping-lists-manage:

Manage Shopping List 
^^^^^^^^^^^^^^^^^^^^

To edit the shopping list name from within its view page:

1. Clicking |IcEditInline| next to the shopping list name.

.. image:: /frontstore_guide/img/shopping_lists/SHEditName.png

2. Enter a new name and click **Save**.

.. image:: /frontstore_guide/img/shopping_lists/SHEditName2.png

To delete the shopping list:

1. Click |IcDelete| Delete.
2. Confirm deletion by clicking **Yes, Delete** in the confirmation window.
   
.. image:: /frontstore_guide/img/shopping_lists/SHDelete.png

To create an order from the shopping list:

1. Click **Create Order** on the bottom of the view page.
2. Click **Create Order** on the top right of the view page.
   
.. image:: /frontstore_guide/img/shopping_lists/SHCreateOrder.png

To create a request for quote from the shopping list:

1. Click **Request Quote** on the top right of the view page.
2. Click |ICChevronDown| next to the **Create Order** button on the bottom of the view page.
3. Click **Request Quote**.

.. _frontstore-guide--shopping-lists-guest:

Shopping Lists for Guest Users
------------------------------

In Oro application, unregistered customers can create and manage a shopping list in the front store without the need to register. By default, they can have one shopping list per website and browsing session with the possiblity of storing such list for up to 30 days in a single browser.

.. note:: If you seem unable to create a guest shopping list, please refer to your administrator.

Create and Manage a Shopping List
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

By default, only one shopping list is available for unregistered users:

1.  To add items to the list, click **Add to Shopping List** next to the product.
2.  To add more items to the existing list, or change the quantity of the items that are already in the list, click **Update Shopping List** next to the product.

    Alternatively, navigate to the shopping list itself by clicking **Shopping List** in the top right corner of the store page, and click *View Details*.

    In the *Quantity* field, change the quantity of the product.

3.  To remove items from the list, click |ICChevronDown| next to **Update Shopping List** and click *Remove from Shopping List*.

     Alternatively, navigate to the shopping list itself by clicking **Shopping List** in the top right corner of the store page, and click *View Details*.

     Next to the product, click |IcDelete| to remove it.


.. include:: /frontstore_guide/related_topics.rst
   :start-after: begin



.. include:: /user_guide/include_images.rst
   :start-after: begin

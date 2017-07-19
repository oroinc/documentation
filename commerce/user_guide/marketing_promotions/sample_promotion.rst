:orphan:


Sample Promotion Set Up
-----------------------

.. begin

As an example, we will set up a simple promotion for some new arrivals. For this, we will create a custom new arrivals segment and reconfigure the :ref:`New Arrivals <user-guide--new-arrivals>` to use this segment. The promotion will last one day and give 20% off all orders. When the promotion ends, we will roll back to the standard New Arrivals segment.

To set up a sample promotion, we go through the following steps:

.. contents:: :local:

Set up a Segment with Products to Promote
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To set up such promotion in the management console, we first need to make sure that a :ref:`product segment <user-guide-filters-segments>` is created that would :ref:`include the items intended for sale <user-guide--new-arrivals>`.


**To set up such segment:**

1. Navigate to **Reports&Segments** in the main menu and click **Manage Segments**.
2. Click **Create Segment** in the top right corner.
3. Create a *Sale* :ref:`segment <user-guide-filters-segments>`, populate it with the products for sale and save it.

   As an example, we added four products to the segment.

   .. image:: /user_guide/img/marketing/promotions/CreatSaleSegment.png

Ensure Easy Access to the Promoted Products
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**To add product for sale to the new arrivals block:**

1. Proceed to system configuration in the main menu (**System > Configuration**) and click **Commerce > Product > Promotions** in the panel on the left.
2. In the :ref:`New Arrivals <user-guide--new-arrivals>` section, select the *Sale* segment from the *Product Segment* list.
3. Set *Maximum Items* to 4.
4. Save the settings.

   .. image:: /user_guide/img/marketing/promotions/NewArivalsSaleSegment.png

Create a Promotion
~~~~~~~~~~~~~~~~~~

**To create a promotion:**

1. Navigate to **Marketing > Promotions > Promotions** in the main menu.
2. Click **Create a Promotion**.
3. In the **Discount Options** section, set the discount option to *order*, the discount Type to *percent*, the discount Value to *20%*.
4. In the **Schedules** section, set the *Active Date* to July, 13, 2017, 12 AM, and *Deactivate at* to July, 13, 2017, 11:59PM.

   .. image:: /user_guide/img/marketing/promotions/CreateSamplePromotion1.png


5. In the **Matching Items** section, click *Advanced Filter*, drag *Apply Segment* to the field on the right, choose the *Sale* segment and click **Preview Results** to load the list of products for sale.

    .. image:: /user_guide/img/marketing/promotions/CreateSamplePromotion2.png

6. Enable and save the promotion.

View a Discount When Placing an Order in the Front Store
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**To view how the discount from the promotion applies in the front store:**

1. Create a shopping list with the 4 items for sale from the New Arrivals Block.

    .. image:: /user_guide/img/marketing/promotions/NewArrivalsOnSale.png

2. Once we open the shopping list, we can see the 20% discount of $1124.75 for the order of 4 items for the subtotal of $5623.74.

   .. image:: /user_guide/img/marketing/promotions/SampeShoppingListOrderDiscount.png

3. Create the order by clicking **Create Order**.

Review Discount in the Front Store After You Place an Order
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**To view applied discount for the submitted order in the front store**:

1. Click **Click Here to View** in the pop up window that appears after you place the order.

   .. image:: /user_guide/img/marketing/promotions/ThankYouForPurchase.png

   Alternatively:

   Navigate to **Orders** and in *Past Orders*, click on the required order.

2. The discount is seen in the order summary.

   .. image:: /user_guide/img/marketing/promotions/ViewDicountInOrdersFront.png

Review Promotion Results in the Management Console
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

**To view applied discount in the management console**:

1. Navigate to **Sales > Orders** and open the placed order.
2. In the **Promotions** section, you can view the details of the promotion applied to the order.

   .. image:: /user_guide/img/marketing/promotions/OrderInBackOffice.png

.. finish
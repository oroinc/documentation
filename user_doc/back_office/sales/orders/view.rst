.. _user-guide--sales--orders--view:

View Order Details
==================

.. begin_view

To view details of an order:

#. Navigate to **Sales > Orders** in the main menu.
#. Find the line with the necessary order and click it.

Alternatively, click the |IcMore| **More Options** menu at the end of the row, and then click |IcView| **View**.

.. image:: /user_doc/img/sales/orders/products_review_top.png
   :alt: An order details page

On the top left of the page, you can see the order name.

In the next row, you can find when the order has been created and last updated, as well as whether the customer user who created an order has been already contacted.

To manage an order, use actions buttons on the top right of the page. The following buttons are
available by default but depend on the order status:

- **Shipping Tracking** --- Click to add :ref:`shipping tracking <user-guide--shipping-order>`.
- **Cancel** --- Click to :ref:`cancel an order <doc--orders--actions--cancel>`. Available only for open orders.
- **Close** --- Click to :ref:`close an order <doc--orders--actions--close>`. Available only for open, canceled, and  shipped orders.
- **Mark as Shipped** --- Click to :ref:`mark an order as shipped <doc--orders--actions--mark-shipped>`. Available only for open orders.
- **Archive** --- Click to :ref:`archive an old order <doc--orders--actions--archive>`. Available only for closed orders.
- **Add Special Discount** --- Click to :ref:`add special discounts <user-guide--sales--orders--promotions--add-special-discount>`.
- **Add Coupon Code** --- Click to :ref:`provide a coupon code <user-guide--marketing--promotions--coupons--edit--on-order-page>`.
- **Edit** --- Click to :ref:`edit an order <user-guide--sales--orders--edit>`.
- **Delete** --- Click to :ref:`delete an order <doc--orders--actions--delete>`.
- **More Actions** drop-down:

  - **Add Attachment** --- Click to :ref:`attach a file to the order <user-guide-activities-attachments>`.
  - **Add Note** --- Click to :ref:`make a note regarding this order <user-guide-add-note>`.
  - **Add Event** --- Click to :ref:`add an event <doc-activities-events>`.
  - **Send Email** --- Click to :ref:`send an email related to the order <user-guide-using-emails>`.

In the next row, you can check which user is responsible for the order (owns it). Click the owner name to open the profile of the corresponding user. Enclosed in parentheses, there is the name of the organization that the owner belongs to.

Click the **Change History** link to see who, how, and when modified the product.

**General**

This section is for order details, such as who created the order, who the customer and customer user are, and which website this order applies to.

.. image:: /user_doc/img/sales/orders/order_details_general.png
   :alt: The General section of the order details page

.. csv-table::
   :header: "Field", "Description"
   :widths: 30, 60

   "**Order Number**","The unique order reference number. It is generated automatically for new orders."
   "**PO Number**","Another order reference number. It is usually defined by the buyer and used by the buyer's side to match invoice and received goods with purchase."
   "**Currency**","The currency in which the order is made."
   "**Subtotal**","The amount due for items in the order. Does not include additional costs, taxes, discounts."
   "**Customer**","The customer that made the order."
   "**Customer User**","The customer user that made an order on behalf of the customer."
   "**Internal Status**","The order status visible only in the back-office. See the :ref:`description of internal statuses <doc--orders--statuses--internal>`."
   "**Do Not Ship Later Than**","The date on which the order expires."
   "**Source Document**","If the order has been created from an RFQ, quote, or another order, this field contains a link to the corresponding record. If the order has been created from scratch (in the back-office) or the quick order form (in the storefront), the field shows 'N/A'."
   "**Payment Method**","The payment method selected to pay for the order."
   "**Payment Status**","Whether the order is already paid in full, the payment for the order is authorized, etc."
   "**Website**","The storefront website that the order was made from."
   "**Billing Address**","The address where the buyer receives the payment statements. Some payment providers use a billing address to authorize payments and demand it to match the payment account holder's current address."
   "**Shipping Address**","The address to deliver the ordered goods to."
   "**Customer Notes**","Any additional information or wishes provided by the buyer regarding the order."
   "**Payment Term**","The terms and conditions for order payment. For more information, see :ref:`Payment Terms Integration <sys--integrations--manage-integrations--payment-term>`."
   "**Warehouse**","The warehouse that the goods are shipped from."

**Line Items**

This section has the list of products added to the order, and their details.

.. image:: /user_doc/img/sales/orders/order_details_lineitems.png
   :alt: The Line Items section of the order details page

The product information visible by default is the following:

.. csv-table::
   :header: "Field", "Description"
   :widths: 30, 60

   "**SKU**","The stock keeping unit that helps identify the product and track it in inventory."
   "**PRODUCT**","The name of the product how it appears on the user interface."
   "**QUANTITY**", "The ordered quantity of product units."
   "**PRODUCT UNIT CODE**", "Whether the product variant is enabled and can be used."
   "**PRICE**", "Agreed price for the individual product unit."
   "**SHIP BY**", "The date before which this product must be shipped."

.. For how to configure visible fields, a number of items per page, etc., see the :ref:`Grids <doc-grids>` topic.

**Shipping Information**

This section displays details of shipping tracking and cost.

.. image:: /user_doc/img/sales/orders/order_details_shipping.png
   :alt: The Shipping Information section of the order details page

**Promotions and Discounts**

This section provides the information about promotions and discounts applied to the order. The section is divided into **All Promotions** and **All Special Discounts**.

Within **All Promotions**, you can view:

* Promotions added automatically if the order qualifies
* Coupon codes added manually

Within **All Special Discounts**, you can view:

* Special discounts added manually

.. image:: /user_doc/img/sales/orders/order_details_promotions.png
   :alt: The Promotions and Discounts section of the order details page

For more information, see :ref:`Promotions and Discounts <user-guide--marketing--promotions>`.

**Totals**

This section shows order cost including any discounts (in all currencies, configured for the purpose).

.. image:: /user_doc/img/sales/orders/order_details_totals.png
   :alt: The Totals section of the order details page


**Payment History**

This section provides the information about payment transactions concerning the order.

.. image:: /user_doc/img/sales/orders/order_details_paymenthistory.png
   :alt: The Payment History section of the order details page

.. csv-table::
   :header: "Field", "Description"
   :widths: 30, 60

   "**ID**","The unique identifier of the payment transaction."
   "**PAYMENT METHOD**","The payment method that has been used to pay for the order."
   "**TYPE**", "The type of the transaction. For example:

    * *Authorize*
    * *Charge*
    * *Validate*
    * *Capture*
    * *Purchase*

   "
   "**AMOUNT**", "The transaction amount and currency."
   "**ACTIVE**", "Whether the transaction is being processed."
   "**SUCCESSFUL**", "Whether the transaction has been successfully processed."
   "**Created At**", "The date and time when the transaction has been started."
   "**Updated At**", "The date and time when the transaction information was last updated."

.. For how to configure visible fields, a number of items per page, etc., see the :ref:`Grids <doc-grids>` topic.

.. hint::
   This section is visible only to the users with the corresponding permission.

   If you do not see this section, contact your administrator.

   If you are an administrator, in the user role, find the Order entity and check the access level configured for the View Payment action.

**Activity**

This section displays any notes, calendar events, or emails related to the order.

You can filter activities by type and by date (e.g. an exact date, or a date range that covers the activity date) and browse them from the newest to the oldest and vice verse.

You can see who started the activity, its type, name and description, when it was created, and a number of comments made on it.

Click the activity to see detailed information about it.

.. image:: /user_doc/img/sales/orders/products_review_activity_manage2.png
   :alt: The details of the selected activity

To edit the activity, click the |IcMore| **More Options** menu at the end of the row and click |IcEdit| **Update**. In the dialog that appears, make required changed and then click **Save**.

To delete the activity, click the |IcMore| **More Options** menu at the end of the row and click |IcDelete| **Delete**. In the confirmation dialog, click **Yes, Delete**.

You can add and delete an activity context.

To add a context to the activity, click the |IcMore| **More Options** menu at the end of the row, and the click |IcContext| **Add Context**. In the **Add Context Entity** dialog, choose the desired context and click it to select.

.. image:: /user_doc/img/sales/orders/activity_note_moreoptions.png
   :alt: Available options displayed after clicking the More Options menu

For an email activity, you can reply/reply all/forward the corresponding email. To do this, click the corresponding icon in the |IcMore| **More Options** menu at the end of the activity row. Alternatively, click activity to expand it, and select the required action from the list on the right.

.. image:: /user_doc/img/sales/orders/activity_email_moreoptions.png
   :alt: Available email activity options displayed after clicking the More Options menu

To delete a context from the activity, click the activity to expand it, and under the activity name, click the **x** icon next to the context that you want to remove.

You can add a comment under a particular activity. To do this, click the activity to expand it, and click **Add Comment**. In the **Add Comment** dialog, type your message. Use the built-in text editor to format your comment. You can also attach a file to your comment. For this, click the **Upload** link in the dialog and locate the required file. When the comment is ready, click **Add**.

To edit or delete a comment, click the |IcMore| **More Options** menu next to it and click the |IcEdit| **Edit** or |IcDelete| **Delete** icon correspondingly.

For more information about activities, see the :ref:`Activities <user-guide-productivity-tools>` guide.

**Marketing Activity**

This section shows any activity of this kind associated with the order.

**Additional Information**

This section includes any attachments, if available.

.. image:: /user_doc/img/sales/orders/order_details_additional.png
   :alt: The Additional Information section of the order details page

For information on attachments and how to manage them, see the :ref:`Attachments <user-guide-activities-attachments>` guide.

.. finish_view

.. include:: /user_doc/img/buttons/include_images.rst
   :start-after: begin

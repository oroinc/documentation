Create an Order
===============

.. _user-guide--sales--orders--create:

Create an Order from Scratch
----------------------------

.. hint:: See a short demo on |how to create a new order from scratch| or keep reading for step-by-step guidance.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/ztwuz7NX1Y4" frameborder="0" allowfullscreen></iframe>

To create a new order from the back-office:

1. Navigate to **Sales > Orders** in the main menu.
2. Click **Create Order** at the top right of the page.
3. In the **General** section, fill in the following fields:

   a) **Owner**: The owner is prepopulated with the user creating the order, but this value can be changed to another user of the system by clicking |IcBars| and selecting a user from the list.

   b) **Customer**: Use the drop-down to select a customer. Click |IcBars| to load the list of customers to choose from.  If this is a new customer, click the plus button to open a new customer dialog.

   c) **Customer User**: Select a customer user, if necessary. This list will be populated with customer users associated with the customer. If this is a new customer user, click **+** to open a new customer dialog.

   d) **Website**: Select the website from which the order will be created.

   .. image:: /user/img/sales/orders/orders_create_general.png
      :alt: The general section of the order details page

4. In the **Line Items** section, provide the following information:

   a) **Product**: Add products to the order by clicking **+Add Product**. Use the drop-down to select a product. Alternatively, begin typing in the name of the product to narrow down your search. To see a list of all the products, click |IcBars|.
   b) **Quantity**: Enter product quantity.
   c) **Warehouse**: Choose a warehouse from the drop-down, or click |IcBars| to see a list of all warehouses.
   d) **Price**: Enter the price for the product, or click |IcBars| to select the price from the list.
   e) **Ship by**: If required, choose a date by which the order must be shipped at the customer’s request.
   f) **Add Notes**: Click the *add notes* link if you would like to add a note about the item.
   g) **Taxes**: View taxes calculated for the product(s) (if configured).

   .. note:: To add additional products to the order, click **+Add Product**. To remove a product, click |IcDeactivate|.

   .. image:: /user/img/sales/orders/orders_create_lineitems.png
      :alt: The Line Items section of the order details page

5. In the **Billing Address** section, fill in the billing address details when you are done adding products. Use the drop-down list to select an existing billing address, or select **Enter Other Address** to add a new one.

6. In the **Shipping Address** section, fill in the shipping address details. Use the drop-down list to select an existing shipping address, or select **Enter Other Address** to add a new one.

7. In the **Shipping** section, provide information for the following:

   a) **Shipping Status**: Select whether the order is not shipped, partially or fully shipped.
   b) **Shipping Options**:  Click **Calculate Shipping** to display any shipping options (if available), then use the radio button to select a shipping option among the preliminary configured shipping rules.
   c) **Overridden Shipping Cost Amount**: If required, override the shipping cost by adding your own value.

   .. image:: /user/img/sales/orders/orders_create_shippinginfo2.png
      :alt: The shipping options are displayed after clicking the Calculate Shipping button.

8. In the **Additional** section, enter additional details, if required (e.g., the PO number, the Do Not Ship Later Than date, the payment term, and the warehouse to ship the items from), and add notes for the customer.

9. In the **Totals** section, review the final amount.

10. In the **Customer Documents** section, add files related to the customer's order. These files will be visible to the customer user in their storefront account:

   * To add a new file, click *Choose File*.
   * To remove a file, click on the bin icon.
   * To add another file, click *Add File*.
   * To adjust the order of files displayed to customers in the storefront, modify the number in the sort order input box. For example, files with a sort order of 1 will appear first on the list.

   .. image:: /user/img/sales/orders/order-customer-documents.png
      :alt: Illustration of the documents uploaded via back-office on the customer side in the storefront

11. To save the order, click **Save** on the top right of the page.

.. hint::

   By default, an order has :ref:`internal status <doc--orders--statuses--internal>` *Open* upon creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.

.. _user-guide--sales--orders--create--from-shopping-lists:

Create an Order from a Shopping List
------------------------------------

Any time a customer creates a new shopping list, it can be accessed in the back-office. This is helpful if a customer needs assistance finding particular items or creating an order.

.. hint:: See a short demo on |creating orders from the shopping list| or keep reading for step-by-step guidance.

   .. raw:: html

      <iframe width="560" height="315" src="https://www.youtube.com/embed/w7NXMifQZnI" frameborder="0" allowfullscreen></iframe>

To create an order from a shopping list:

1. Navigate to **Sales > Shopping lists** in the main menu.
2. Open the selected shopping list from the grid.
3. Click **Create Order** in the top right corner of the page.

   .. image:: /user/img/sales/orders/CreateOrderFormSL.png
      :alt: Click the Create Order button on the top right
      :class: with-border

4. The Create Order form opens, prepopulated with the information from the shopping list:

   Amend or add new details to the order, as described in :ref:`the Create an Order from Scratch <user-guide--sales--orders--create>` topic.

   .. image:: /user/img/sales/orders/orders_create_fromshoppinglist1.png
      :alt: The Create Order form is prepopulated with the information from the shopping list

   .. warning:: When you modify the order content, order totals and shipping costs may change. Please, review the shipping method selection before saving the order to make sure that the shipping cost is acceptable.

5. Click **Save**.

   .. image:: /user/img/sales/orders/orders_create_fromshoppinglist2.png
      :alt: The new order just created

.. hint:: By default, an order has :ref:`internal status <doc--orders--statuses--internal>` *Open* upon creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.

.. _user-guide--sales--orders--create--from-rfq:

Create an Order from an RFQ
---------------------------

To create an order based on a request for a quote (RFQ):

1. Navigate to **Sales > Requests for Quote** in the main menu.
2. Open the selected RFQ from the grid.
3. Click **Create Order** in the top right corner of the RFQ page.

   .. image:: /user/img/sales/orders/CreateOrderFromRFQ.png
      :alt: Click Create Order on the top right
      :class: with-border

The Create Order form opens prefilled with the information from the RFQ:

4. Amend or add new details to the order, as described in :ref:`the Create an Order from Scratch topic <user-guide--sales--orders--create>`.

   .. warning:: When you modify the order content, order totals and shipping costs may change. Please, review the shipping method selection before saving the order to ensure that the shipping cost is acceptable.

5. Click **Save** when you have finished.

.. image:: /user/img/sales/orders/orders_create_fromrfq2.png
   :alt: The new order that is just created

.. hint:: By default, an order has :ref:`internal status <doc--orders--statuses--internal>` *Open* upon creation. If another status is required for new orders, an administrator must adjust the :ref:`order creation configuration settings <configuration--commerce--orders>`.

.. _user-guide--sales--orders--create--from-ai-smart-order:

Create an Order via AI Smart Order Automation
---------------------------------------------

.. hint:: This section is part of the :ref:`AI and Automation Concept Guide <concept-guide--ai>` topic that provides an overview of OroCommerce's AI-powered tools AI Smart Agent and AI Smart Order.

AI Smart Order functionality helps automate the process of creating orders in OroCommerce from purchase orders emailed as attachments. Instead of entering order data manually, you can use OroCommerce's AI Smart Order widget or automation to read purchase orders in different formats (JPG, PNG and PDF) and templates and convert them into draft orders in the back-office.

.. hint:: To learn more about AI Smart Order Widgets, see :ref:`OroCommerce AI Content Generation Widget <getting-started-wysiwyg-editor-field-ai>`.

Before using AI Smart Order Automation, make sure that:

1. AI Smart Order microservice is setup by the Oro Team. Please |contact our support team| to request the configuration of this functionality.
2. AI Smart Order is enabled and :ref:`in the system configuration <admin-configuration-orders-ai-smart-order-settings>` for your instance by the admin of your organization.
3. A system mailbox is set up by your administrator in the :ref:`Email Configuration settings <admin-configuration-system-mailboxes>` with and option to *Convert to Draft Order* selected for Email Processing.

.. image:: /user/img/concept-guides/ai/convert-to-draft-order.png

When the Smart Order functionality is configured and a mailbox is set up, any incoming emails sent by buyers to the designated inbox with purchase order attachments are automatically processed. The system scans the attachments and, upon successful conversion, sends a confirmation email to the same address. This email includes a link to the newly created draft order. To view your inbox, navigate to **Your Name > My Emails** in the top right corner of the back-office.

.. image:: /user/img/concept-guides/ai/so-automation-steps.png

The link to the created draft order is also available as a context added to original email with the attached purchase order. Clicking on the linked order redirects you to the draft order page.

.. image:: /user/img/concept-guides/ai/attachment-email-with-draft-order-link.png

All draft orders are also available under **Sales > Orders** with status *Pending*.

.. image:: /user/img/concept-guides/ai/draft-order-grid.png

You can approve the draft order if you are happy with the captured information, or you can edit it to provide the missing details.

.. image:: /user/img/concept-guides/ai/edit-draft-order.png

You have the option to:

* Hide or show the original purchase order attachment file
* Zoom the original purchase order file in/out
* Hide or show the valid fields that have no missing information and require no amending

Approved orders move from status Pending to Open and you can still edit them as you would a normal order.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
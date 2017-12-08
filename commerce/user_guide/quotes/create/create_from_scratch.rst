:orphan:

.. _quote--create-from-scratch:

Create a Quote From Scratch
~~~~~~~~~~~~~~~~~~~~~~~~~~~

To create a new quote from scratch:

1. Navigate to **Sales > Quotes** in the main menu.

   .. image:: /user_guide/img/sales/quotes/Quotes.png
      :class: with-border

2. Click **Create Quote**.

   .. image:: /user_guide/img/sales/quotes/create_quote_general.png

4. In the **General** section:

   a) Select a **Customer** and **Customer User** to create a quote for.

   b) Enter the quote expiration information in the **Valid Until** date and time boxes.

   c) Optionally, enter a **PO Number** for the customer reference.

   #) If necessary, set the **Do Not Ship Later Than** date, to limit the order validity based on the information from the customer.

   #) Select an order fulfilment officer in the **Assigned To** box.

   #) Select the assigned customer user that will receive the order delivery in the **Assigned Customer** box.

   #) Select a **Website** to make this quote visible only on the specified website.

5. In the **Line Items** section:

   .. image:: /user_guide/img/sales/quotes/create_quote_line_items.png

   a) Add products as quote line items.

      Use Select Product and Free-form entry link to switch between the following product entry modes:

      **Select a Product**: Select the product using search (v) or from the product list (=).

      .. image for Select Product mode

      **Free-Form Entry**: Type in the SKU and/or Product Name.

      .. image for Select Product mode

      .. image Sample offer.

   b) Fill in the offer:

      1. Provide quantity and select a product unit measurement.

      3. Check **or more** to allow the customer to increase the quantity in the order.

      4. Type in the unit price and select a currency.

      To offer alternative quantity and prices, use **+ Add Offer**.

      .. image Add Offer

      Add notes to the quote line, if necessary: click **Add notes** in the Seller Notes section.

      .. image Notes

      .. note:: To delete any quote line, click **Delete** on the right of the line item information group.

      .. image Delete?

   Add more products, if necessary, by clicking **+ Add Products** below the existing product lines.

   .. image Add Product

6. In the **Shipping Address** section, enter the shipping address, organization name and name of the person the future order should be shipped to.

   .. image:: /user_guide/img/sales/quotes/create_quote_address.png

7. In the **Shipping Information** section, configure the recommended shipping options for the customer:

   .. image:: /user_guide/img/sales/quotes/CreateQioteShipping.png

   .. TODO For BB-7506, update the image above, and use the commented lines below:

   .. a) In the **Shipping Methods** list, tick the boxes next to the shipping methods that you would like the customer use for this order delivery.

   a) In the **Shipping Method** list, select the recommended (default) shipping method that will be pre-selected when the customer gets to the shipping configuration on the checkout.

   .. .. note:: When none of the methods are selected, the customer can use any of the listed methods.

   .. .. note:: Once you change the existing settings, the previous configuration will be saved for your information in the previously Selected Shipping Method log above the list of the shipping methods.

   .. b) If necessary, select the preferred shipping method from the **Default Shipping Method** list. The customer will be able to change the option to any other available shipping method.

   c) Optionally, enter the **Overridden Shipping Cost Amount, USD** - a custom shipping cost that will be used instead of the one dynamically generated based on the shipping method selection.

   d) To enforce using only the default Shipping method selected earlier, enable the **Shipping Method Locked** flag. When the shipping method is locked, the buyer does not see any other payment options but the default one.

   e) Tick the **Allow Unlisted Shipping Methods** box to allow using the shipping method that is already selected as a default one, even if it is disabled by the shipping rule configuration.

8. Optionally, select a **Payment Term** as an available payment method.

   .. note:: Be aware that although opportunity relation can be displayed on the quote page, it is not possible to manage it. When there is no opportunity relation available for a quote, inactive **Opportunity** field is displayed. More information on the relationship between opportunities and quotes is available in the relevant `OroCommerce Opportunity Flow topic <https://oroinc.com/doc/orocrm/current/user-guide-sales-tools/b2b-sales/opportunities#orocommerce-opportunity-flow>`_ in the OroCRM documentation .

9. Click **Save**.
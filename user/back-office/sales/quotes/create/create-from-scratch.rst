:oro_documentation_types: OroCommerce

.. _quote--create-from-scratch:

Create a Quote From Scratch
===========================

.. hint:: This section is part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides a general understanding of the RFQ and quote concepts in OroCommerce.

To create a new quote from scratch:

1. Navigate to **Sales > Quotes** in the main menu.

   .. image:: /user/img/sales/quotes/Quotes.png
      :class: with-border
      :alt: The list of all quotes available in the system

2. Click **Create Quote**.

   .. image:: /user/img/sales/quotes/create_quote_general.png
      :alt: The create quote page details

4. In the **General** section:

   a) Select a **Customer** and **Customer User** to create a quote for.

   b) Enter the quote expiration information in the **Valid Until** date and time boxes.

   c) Optionally, enter a **PO Number** for the customer reference.

   #) If necessary, set the **Do Not Ship Later Than** date to limit the order validity based on the information from the customer.

   #) Select an order fulfillment officer in the **Assigned To** box.

   #) Select the assigned customer user that will receive the order delivery in the **Assigned Customer** box.

   #) Select a **Website** to make this quote visible only on the specified website.

5. In the **Line Items** section:

   .. image:: /user/img/sales/quotes/create_quote_line_items.png
      :alt: The details of the Line Items section

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

      To offer alternative quantities and prices, use **+ Add Offer**.

      .. image Add Offer

      If necessary, add notes to the quote line: click **Add notes** in the Seller Notes section.

      .. image Notes

      .. note:: To delete any quote line, click **Delete** on the right of the line item information group.

      .. image Delete?

   Add more products, if necessary, by clicking **+ Add Products** below the existing product lines.

   .. image Add Product

6. In the **Shipping Address** section, enter the shipping address, organization name, and name of the person to which the future order should be shipped.

   .. note:: Keep in mind that the shipping address you enter when creating a quote will be the only option available for the customer at the checkout.

7. In the **Shipping Information** section, configure the recommended shipping options for the customer:

   .. image:: /user/img/sales/quotes/CreateQioteShipping.png
      :alt: Shipping options under the Shipping Information section of the quote

   a) In the **Shipping Method** list, select the recommended (default) shipping method that will be pre-selected when the customer gets to the shipping configuration on the checkout.

   .. .. note:: When none of the methods are selected, the customer can use any listed methods.

   .. .. note:: Once you change the existing settings, the previous configuration will be saved for your information in the previously Selected Shipping Method log above the list of the shipping methods.

   .. b) If necessary, select the preferred shipping method from the **Default Shipping Method** list. The customer can change the option to any other available shipping method.

   b) Optionally, enter the **Overridden Shipping Cost Amount, USD** - a custom shipping cost that will be used instead of the one that is dynamically generated based on the selected shipping method.

   c) To enforce using only the default Shipping method selected earlier, enable the **Shipping Method Locked** flag. When the shipping method is locked, the buyer does not see any other payment options but the default one.

   d) Tick the **Allow Unlisted Shipping Methods** box to allow using the shipping method already selected as a default one, even if the shipping rule configuration disables it.

8. Optionally, select a **Payment Term** as an available payment method.

   .. note:: Be aware that although opportunity relation can be displayed on the quote page, it is not possible to manage it. When no opportunity relation is available for a quote, the inactive **Opportunity** field is displayed. More information on the relationship between opportunities and quotes is available in the :ref:`OroCommerce Opportunity Flow <mc-sales-opportunities-quote>` topic.

9. Click **Save**.
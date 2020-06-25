:oro_documentation_types: OroCommerce

.. _quote--create-from-rfq:

Create a Quote on the Customer Request
======================================

.. begin_create_from_rqf

.. hint:: This section is a part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides the general understanding of the RFQ and quote concepts in OroCommerce.

To create a new quote from the customer request for quote (RFQ):

1. Navigate to **Sales > Requests for Quote** in the main menu.

2. Open the necessary RFQ by clicking on the respective line.

3. Click **Create Quote**.

   .. image New Quote > General

4. In the **General** section:

   a) Review the information provided by the customer.

   b) Enter the quote expiration information in the **Valid Until** date and time boxes.

   c) Select an order fulfilment officer in the **Assigned To** box.

   d) Select the assigned customer user that will receive the order delivery in the **Assigned Customer** box.

   .. image New Quote > Line Items (filled)

5. In the **Line Items** section:

   a) Review the requested price and quantity and make an offer.

      .. image Sample offer.

      To offer alternative quantity and prices, use **+ Add Offer**.

      .. image Add Offer

      Add notes to the quote line, if necessary: click **Add notes** in the Seller Notes section.

      .. image Notes

      .. note:: To delete any quote line, click **Delete** on the right of the line item information group.

      .. image Delete?

   b) Add more products, if necessary, by clicking **+ Add Products** below the existing product lines.

     .. image Add Product

6. In the **Shipping Address** section, provide the details about shipping destination address, if possible.

   .. image Shipping address

   Depending on the system configuration, the customer may be offered a limited set of the shipping options (only those that are available for the provided address).

   .. image Shipping Options.

7. In the **Shipping Information**, configure the default shipping option pre-selected for the the customer on the checkout:

   .. TODO For BB-7506, update the image above, and use the commented lines below:

   .. a) In the **Shipping Methods** list, tick the boxes next to the shipping methods that you would like the customer use for this order delivery.

   a) In the **Shipping Methods** list, select the recommended (default) shipping method that will be pre-selected when the customer gets to the shipping configuration on the checkout.

   .. .. note:: When none of the methods are selected, the customer can use any of the listed methods.

   .. .. note:: Once you change the existing settings, the previous configuration will be saved for your information in the previously Selected Shipping Method log above the list of the shipping methods.

   .. b) If necessary, select the preferred shipping method from the **Default Shipping Method** list. The customer will be able to change the option to any other available shipping method.

   c) Optionally, enter the **Overridden Shipping Cost Amount, USD** - a custom shipping cost that will be used instead of the one dynamically generated based on the shipping method selection.

   d) To enforce using only the default Shipping method selected earlier, enable the **Shipping Method Locked** flag. When the shippig method is locked, the buyer does not see any other payment options but the default one.

   e) Tick the **Allow Unlisted Shipping Methods** box to allow using the shipping method that is already selected as a default one, even if it is disabled by the shipping rule configuration.

8. Optionally, select a **Payment Term** as an available payment method.

9. Click **Save**.

Once the quote is created, you can send it to the customer who can further negotiate or convert it to order and proceed to the checkout.
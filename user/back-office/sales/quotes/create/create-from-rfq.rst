.. _quote--create-from-rfq:

Create a Quote on Customer Request
==================================

.. begin_create_from_rqf

.. hint:: This section is part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides a general understanding of the RFQ and quote concepts in OroCommerce.

To create a new quote from the customer request for quote (RFQ):

1. Navigate to **Sales > Requests for Quote** in the main menu.

2. Open the necessary RFQ by clicking on the respective line.

3. Click **Create Quote**.

   .. image New Quote > General

4. In the **General** section:

   a) Review the information provided by the customer.

   b) Enter the quote expiration information in the **Valid Until** date and time boxes.

   c) Select an order fulfillment officer in the **Assigned To** box.

   d) Select the assigned customer user to receive the order delivery in the **Assigned Customer** box.

   .. image New Quote > Line Items (filled)

5. In the **Line Items** section:

   a) Review the requested price and quantity and make an offer.

      .. image Sample offer.

      To offer alternative quantities and prices, use **+ Add Offer**.

      .. image Add Offer

      If necessary, add notes to the quote line: click **Add notes** in the Seller Notes section.

      .. image Notes

      .. note:: To delete any quote line, click **Delete** on the right of the line item information group.

      .. image Delete?

   b) Add more products, if necessary, by clicking **+ Add Products** below the existing product lines.

     .. image Add Product

6. In the **Shipping Address** section, provide the details about the shipping destination address, if possible.

   .. image Shipping address

   Depending on the system configuration, the customer may be offered limited shipping options (only those available for the provided address).

   .. image Shipping Options.

7. In the **Shipping Information**, configure the default shipping option pre-selected for the customer on the checkout:

   .. a) In the **Shipping Methods** list, tick the boxes next to the shipping methods you would like the customer to use for this order delivery.

   a) In the **Shipping Methods** list, select the recommended (default) shipping method that will be pre-selected when the customer gets to the shipping configuration on the checkout.

   .. .. note:: When none of the methods are selected, the customer can use any listed methods.

   .. .. note:: Once you change the existing settings, the previous configuration will be saved for your information in the previously Selected Shipping Method log above the list of the shipping methods.

   .. b) If necessary, select the preferred shipping method from the **Default Shipping Method** list. The customer can change the option to any other available shipping method.

   b) Optionally, enter the **Overridden Shipping Cost Amount, USD** - a custom shipping cost that will be used instead of the one that is dynamically generated based on the selected shipping method.

   c) To enforce using only the default Shipping method selected earlier, enable the **Shipping Method Locked** flag. When the shipping method is locked, the buyer does not see any other payment options but the default one.

   d) Tick the **Allow Unlisted Shipping Methods** box to allow using the shipping method already selected as a default one, even if the shipping rule configuration disables it.

8. In the **Customer Documents** section, add files related to the customer's quote. These files will be visible to the customer user in their storefront account:

   * To add a new file, click *Choose File*.
   * To remove a file, click on the bin icon.
   * To add another file, click *Add File*.
   * To adjust the order of files displayed to customers in the storefront, modify the number in the sort order input box. For example, files with a sort order of 1 will appear first on the list.

   .. image:: /user/img/sales/quotes/quotes-customer-documents.png
      :alt: Illustration of the documents uploaded via back-office on the customer side in the storefront

9. Optionally, select a **Payment Term** as an available payment method.

10. Click **Save and Close**.

After creating the quote, you can send it to the customer from the view page by clicking the appropriate button. This allows you to negotiate the quote further or convert it into an order.er.
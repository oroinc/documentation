:oro_documentation_types: OroCommerce

.. _user-guide--sales--guest-quotes:

Send a Guest Quote
==================

.. hint:: This section is a part of the :ref:`RFQ and Quote Management <concept-guide-rfq-quotes>` topic that provides the general understanding of the RFQ and quote concepts in OroCommerce.

Non-authenticated customer users can request a quote for the products they are interested in. When the sales representative processes the request and creates a quote in the back-office, buyers can access the quote via a unique direct link through the email.

Once a guest customer user submits an RFQ in the storefront, this RFQ appears in the back-office.

To create a guest quote from the received RFQ:
 
1. Navigate to **Sales > Requests for Quotes** in the main menu.
2. Click once on the required RFQ to open its page.
3. Click **Create Quote** on the top right.

   .. image:: /user/img/sales/quotes/create_quote_from_rfq_guest.png
      :alt: Create a new quote from an RFQ

4. Amend quote details as necessary, and click **Save and Close** once done.
5. The new quote is linked to the original request, which is displayed in the Quote Information section.

   .. image:: /user/img/sales/quotes/quote_linked_to_rfq.png
      :alt: Request field in the quote information section

6. Click **Send to Customer** on the top right.
  
   In the displayed form, the template to be applied is by default set to *quote_email_link_guest* and the link to the guest quote is provided in the text body.

   .. image:: /user/img/sales/quotes/guest_quote_email.png
      :alt: Guest quote email 

7. Click **Send** to email the quote to the buyer.
8. Once the email is sent, the link is displayed in the Quote Information section in the Unique Guest Link field.

   .. image:: /user/img/sales/quotes/quote_information_guest_link.png
      :alt: Unique guest link displayed in the quote information section

   .. note:: The link is added to the Quote Information section only when the quote's internal status is transitioned to **Sent to Customer**.

9. To view the quote, click on the link.

   .. image:: /user/img/sales/quotes/guest_quote.png
      :alt: Guest quote in the storefront

   .. note:: If the quote expires, you will no longer be able to submit the quote via the link.

            .. image:: /user/img/sales/quotes/quote_expired.png
               :alt: Quote link expired 

10. When the customer submits the quote and completes the checkout process, you will receive their order details in the back-office.

.. note:: The existing quote workflows, their steps and transitions in the back-office work the same way for guest quotes.

**Related Topics**

* :ref:`Guest Quote Configuration <sys--conf--commerce--guest--enable--guest_quotes>`
* :ref:`Guest Quote in the Storefront <frontstore-guide--guest-quotes>`
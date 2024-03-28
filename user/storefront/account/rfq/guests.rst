.. _frontstore-guide--rfq--guests:
.. _frontstore-guide--guest-rfq:

Create a Guest RFQ in the Storefront
====================================

.. begin

In the Oro application, guest customers can create a request for a quote for the items they are interested in purchasing without the need to register, if :ref:`this option was configured in the back-office <sys--conf--commerce--guest--enable--guest_quotes>`.

Guest RFQs can be created from the shopping list and a quick order form.

.. note:: Guest users can receive quotes via a direct ink to the provided email. Learn how in the :ref:`Send a Guest Quote <user-guide--sales--guest-quotes>` topic.

From the Shopping List
----------------------

To create a guest RFQ from the shopping list:

1. Add the selected item(s) to the shopping list by clicking **Add to Shopping List**.

   .. image:: /user/img/storefront/rfq/GuestItemAddedtoSL.png

2. In the top right corner, hover over the shopping list widget and click **Open List** to view your item(s).

   .. image:: /user/img/storefront/rfq/GuestSLButton.png

3. Click |IcChevronDown| next to the **Create Order** button to reveal the **RequestQuote** button.

   .. image:: /user/img/storefront/rfq/GuestCreateRFQButtons.png

4. Provide information on the RFQ form.

   In the Request a Quote section, enter:

   * First Name
   * Last Name
   * Email Address
   * Phone Number
   * Company
   * Role
   * Notes
   * PO Number
   * Do Not Ship later Than (date)

   In the Products section, you can:

   * Edit the item by clicking |IcPencil| at the end of the product item row.
   * Delete the item by clicking |IcDelete| at the end of the product row.
   * Add another product by clicking **+Add Another Product**

   In the Data Protection section, you may be required to accept mandatory consents to process your personal information. If the consent is not accepted, you cannot submit the RFQ.

.. image:: /user/img/storefront/rfq/rfq_data_protection.png

5. Click **Submit Request** to submit your RFQ. You should receive a confirmation email with your request details.

From the Quick Order Form
-------------------------

To create an RFQ from the quick order form:

1. Click on the **Quick Order** widget in the top navigation bar.

   .. image:: /user/img/storefront/orders/GuestQuickOrderButton.png

2. Provide order details (item, quantity #, and unit) in the given fields.

   .. image:: /user/img/storefront/rfq/GuestQuickOrderDetails.png

3. Click **Get Quote** below the form.
4. Provide information on the RFQ in the emerged form.

   In the Request a Quote section, enter:

   * First Name
   * Last Name
   * Email Address
   * Phone Number
   * Company
   * Role
   * Notes
   * PO Number
   * Do Not Ship later Than (date)

   In the Products section, you can:

   * Edit the item by clicking |IcPencil| at the end of the product item row.
   * Delete the item by clicking |IcDelete| at the end of the product row.
   * Add another product by clicking **+Add Another Product**

   In the Data Protection section, you may be required to accept mandatory consents to process your personal information. If the consent is not accepted, you cannot submit the RFQ.
    
5. Click **Submit Request** to submit your RFQ. You should receive a confirmation email with your request details.


.. finish

**Related Articles**

* :ref:`Guest Quote in the Storefront <frontstore-guide--guest-quotes>`
* :ref:`Guest Quote in the Back-Office <user-guide--sales--guest-quotes>`

.. include:: /include/include-images.rst
   :start-after: begin

.. _configuration--commerce--orders--order-creation--website:

Configure Order Creation Settings per Website
=============================================

To configure the order creation options per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. In the **Order Creation** section, clear the **Use Organization** checkbox next to the required option, if it is selected, to toggle the following options:

   * **New Internal Order Status** --- Select the :ref:`status <doc--orders--statuses--internal>` to be assigned to all newly created orders. This status is displayed in the back-office.
   * **Enable Order PDF Download Storefront** --- When enabled, customers can download a PDF version of the order from the storefront order pages. The PDF is generated using the most up-to-date order data at the time of download.

   .. image:: /user/img/system/config_commerce/order/order-pdf.png
      :alt: Illustration of the Order Download Button in the storefront

   * **Generate PDF When Order is Created** --- When this option is enabled, a PDF is generated after an order is placed and attached to the order confirmation email sent to the customer. To include the PDF in the email, navigate to **System > Emails > Templates** in the back-office menu, open the edit page of the Order Confirmation Email template, and select Order Default PDF Template in the :ref:`Attachments field <email-templates-attachments>`.

   .. image:: /user/img/system/config_commerce/order/order-pdf-template-attachment.png
      :alt: Screenshot of the back-office Email Templates edit page showing the Order Confirmation template. The Attachments field is highlighted, with the Order Default PDF Template selected to include the PDF in confirmation emails.

   .. note:: Order PDF functionality is available as of OroCommerce version 6.1.6.

#. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
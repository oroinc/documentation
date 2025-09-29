.. _configuration--commerce--orders--order-creation--global:
.. _configuration--commerce--orders-create:


Configure Global Order Creation Settings
========================================

You can automatically assign a status to new :term:`orders <Order>` once they are created.

.. hint:: This can be done globally, :ref:`per organization <configuration--commerce--orders--order-creation--organization>` and :ref:`per website <configuration--commerce--orders--order-creation--website>`.

To assign an order status globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Orders > Order Creation** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. In the **Order Creation** section, clear the **Use Default** checkbox next to the required option, if it is selected, to toggle the following options:

   * **New Internal Order Status** --- Select the :ref:`status <doc--orders--statuses--internal>` to be assigned to all newly created orders. This status is displayed in the back-office.
   * **Enable Order PDF Download Storefront** --- When enabled, customers can download a PDF version of the order from the storefront order pages. The PDF is generated using the most up-to-date order data at the time of download.

   .. image:: /user/img/system/config_commerce/order/order-pdf.png
      :alt: Illustration of the Order Download Button in the storefront

   * **Generate PDF When Order is Created** --- When this option is enabled, a PDF is generated after an order is placed. To include the PDF in the email, navigate to **System > Emails > Templates** in the back-office menu, open the edit page of the Order Confirmation Email template, and select Order Default PDF Template in the :ref:`Attachments field <email-templates-attachments>`.

   .. image:: /user/img/system/config_commerce/order/order-pdf-template-attachment.png
      :alt: Screenshot of the back-office Email Templates edit page showing the Order Confirmation template. The Attachments field is highlighted, with the Order Default PDF Template selected to include the PDF in confirmation emails.

#. Click **Save Settings**.

**Related Topic**

* :ref:`Orders <user-guide--sales--orders>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
.. _user-guide--system-configuration--commerce-sales-invoices-per-website:

Configure Invoice Settings per Website
======================================

You can configure invoice-related sales :ref:`globally <configuration--guide--commerce--configuration--sales-invoices>`, :ref:`per organization <user-guide--system-configuration--commerce-sales-invoices-org>`, website, :ref:`customer group <user-guide--customer-group---invoice--settings>` and :ref:`customer <user-guide--customers--invoice--settings>`.

To configure invoices per website:

1. Navigate to **System > Websites** in the main menu.
2. For the necessary website, hover over the |IcMore| **More Options** menu to the right of the necessary website and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Sales > Invoices** in the menu on the left.

.. note::
   For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

.. image:: /user/img/sales/invoices/invoice_website.png

4. In the **General** section, toggle the following options:

   * **Show Invoices in the Storefront** --- enable this option to display invoices in the storefront.

5. In the **Payments** section, toggle the following options:

   * **Enable Invoice Payments** --- Enables or disables the invoice payment functionality system-wide. When enabled, a Pay button is displayed in the storefront, and a Payments section is added to the invoice view page in the back-office.
   * **Payment Method** --- Specifies the payment method used for invoice payments in the storefront. Currently, only the :ref:`Stripe Integration Element <user-guide--payment--payment-providers-stripe--element>` and :ref:`OroPay <user-guide--payment--oropay>` are supported. Ensure that a Stripe integration or OroPay is configured under *System > Manage Integrations* before selecting it here.

6. Click **Save Settings**.


* :ref:`Invoices in the Storefront <frontstore-guide--invoices>`
* :ref:`Invoices in the Back-Office <user-guide--sales--invoices>`
* :ref:`Stripe Integration Element <user-guide--payment--payment-providers-stripe--element>`
* :ref:`OroPay Integration <user-guide--payment--oropay>`



.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

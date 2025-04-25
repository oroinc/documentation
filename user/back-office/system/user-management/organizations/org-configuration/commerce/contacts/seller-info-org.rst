.. _org--commerce--configuration--contacts--seller-info:

Configure Seller Info Settings per Organization
===============================================

.. note:: Seller information can be configured :ref:`globally <sys--conf--commerce--contacts--seller-info>`, per organization, and :ref:`per website <system--website--configuration--commerce--contacts--seller-info>`.

To configure the seller information settings per organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu to the right of the necessary organization and click |IcConfig| to start editing the configuration.
3. Select **Commerce > Contacts > Seller Info** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/contacts/seller-info-org.png
      :alt: Seller information settings configured on the organization level

4. Clear the **Use System** checkbox to adjust the settings for your organization.
5. In the **General Info** section, enter the following information about your business:

* **Company Name** – Enter your official business name.

* **Business Address** – Enter your full business address.

* **Phone Number** – Enter a contact phone number.

* **Contact Email** – Enter your official email address. It must be a valid email format (e.g., ``info@example.com``).

* **Website** – Enter your website's address. It must be a valid URL starting with http or https.

* **Tax ID** – Enter your business tax identification number.

6. Click **Save settings**.

Once configured, you can use this information in:

* :ref:`Email templates <user-guide-email-template>` - Add the corresponding variables (e.g., {{ system.sellerCompanyName }} ) to the email template content box to personalize your emails.

   .. image:: /user/img/system/config_commerce/contacts/seller-info-email-templates.png
      :alt: Sample of an email template with seller info variables

* Invoices

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin
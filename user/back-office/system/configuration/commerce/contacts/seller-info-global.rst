.. _sys--conf--commerce--contacts--seller-info:

Configure Global Seller Info Settings
=====================================

.. note:: The Seller Info settings are available as of OroCommerce version 6.1.1.

Some business information, such as your company name, contact details, and tax ID, may need to appear in customer-facing materials such as emails and invoices. You can now manage these details directly from the system configuration.

.. note:: Seller information can be configured globally, :ref:`per organization <org--commerce--configuration--contacts--seller-info>`, and :ref:`per website <system--website--configuration--commerce--contacts--seller-info>`.

To configure the seller information settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Contacts > Seller Info** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/contacts/seller-info-global.png
      :alt: Global seller information settings

3. Clear the **Use Default** checkbox to adjust the system settings.
4. In the **General Info** section, enter the following information about your business:

* **Company Name** – Enter your official business name.

* **Business Address** – Enter your full business address.

* **Phone Number** – Enter a contact phone number.

* **Contact Email** – Enter your official email address. It must be a valid email format (e.g., ``info@example.com``).

* **Website** – Enter your website's address. It must be a valid URL starting with http or https.

* **Tax ID** – Enter your business tax identification number.

5. Click **Save settings**.

Once configured, you can use this information in:

* :ref:`Email templates <user-guide-email-template>` - Add the corresponding variables (e.g., {{ system.sellerCompanyName }} ) to the email template content box to personalize your emails.

   .. image:: /user/img/system/config_commerce/contacts/seller-info-email-templates.png
      :alt: Sample of an email template with seller info variables

* Invoices
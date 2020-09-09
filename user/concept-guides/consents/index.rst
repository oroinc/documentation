.. _user-guide--consents:

:oro_documentation_types: OroCommerce

Consent Management Concept Guide
================================

Customers want to feel that their data is safe when they shop online, so the governments have been stepping in to provide more regulation to ensure customer data privacy. As a result, regulations like the General Data Protection Regulation (GDPR) in the European Union and California Consumer Privacy Act (CCPA) in California, US have been put in place.

Regulations in the US
---------------------

The United States has no all-encompassing data protection law, instead it has a number of sector-specific data protection regulations. For example, |CAN-SPAM| regulates commercial email, |COPPA| covers websites and apps aimed at children, and the |Federal Trade Commission| provides best practice guidance.

In the state of California since 2004, website admins and businesses have been creating Privacy Policies to comply with the California Online Privacy Protection Act (|CalOPPA|). California's privacy law - the California Consumer Privacy Act (|CCPA|) - was passed in June 2018 and took effect on Jan 1, 2020.

**CalOPPA** applies to commercial websites that collect personal information about California residents and requires websites to display a Privacy Policy section with basic information about the website's privacy practices, such as:

* What type of personal information is collected (e.g., name, email address, shipping address, payment details, etc.)
* What third-parties might receive the information (e.g., a payment processor, a mail carrier, etc.)
* A disclosure of whether your website honors "Do Not Track" (DNT) signals

Unlike CalOPPA, **CCPA** does not only apply to California businesses but to any business that impacts people in California. It requires businesses to help customers access the following rights:

* The right to know about the personal information a business collects about them and how it is used and shared
* The right to delete personal information collected from them (with some exceptions)
* The right to opt-out of the sale of their personal information
* The right to non-discrimination for exercising their CCPA rights

.. important:: To learn more on data protection in the USA, please see a |guide to privacy laws|.

Regulations in the EU
---------------------

The General Data Protection Regulation (GDPR) is a law on protection of personal data that affects companies based in the European Union and organizations that have operations and customers on its territory, regardless of the company's location. In addition to putting new obligations on the companies collecting personal data, the GDPR gives individuals more power to access the information that is held about them. This includes giving consumers the right to get their personal data erased in circumstances where it is no longer necessary for the purpose it was collected, if the consent to process data is withdrawn, or if it has been processed unlawfully.

Not complying with the GDPR can result in disciplinary actions from relevant supervisory authorities. 

.. important:: Learn more on data protection regulations in the official |GDPR| portal and the |EU Commission web page|, or see the |ICO's Guide to the GDPR| before you proceed.

Compliance with Other Regulations
---------------------------------

Consent management does not only apply to data protection regulations, and you can unable consents or agreements to ensure compliance with any laws, regulation, or rules that may be emposed by your state or country.

Here are a couple of examples of when you might need to collect a consent or agreement from your customer at the checkout, or inform them about important details of the sale they are about to complete.

Under the federal law, any plumbing materials connected to the public water system that provides water for human consumption must be lead-free. Therefore, if your business sells plumbing supplies that contain lead, you must warn your buyer that such pipes, fittings, and fixtures must be used exclusively for services where water is not anticipated to be used for human consumption. You can set up a consent form to appear at the checkout to collect an informed consent and make sure that your buyers understand all the ramifications.

Another example where consents at checkout need to be put in place concerns export restrictions. Export of specific products or shipping from the US to some countries may be restricted. Under U.S. law, commerce enterprises have an obligation to "know their customer", including the ultimate buyer if their customers re-export the products. So, for instance, if you selling a product to a buyer who you know intends to re-export the product to a country to which direct exports from the US are prohibited, you will be violating the law. An example of such product may be a processor with advanced encryption algorithm, or a different piece of technology embedded in the product controls that you cannot sell outside of the US.

Whatever state or country you run your business, OroCommerce's consent management system, discussed below, can help you build a robust compliance system tailored to your business and legal needs.

Data Protection Compliance in OroCommerce
-----------------------------------------

To help online businesses comply with data protection regulations, OroCommerce provides a flexible mechanism for collecting and managing customer consents.
 
In this respect, OroCommerce webstore customers have the right to:

* Know what personal data is processed and stored in the application and how, and request this information at any moment.
* Request to modify their personal data if it is incorrect, outdated, or otherwise inaccurate.
* Reuse their personal data and export it to other systems or organizations. 
* Revoke the consent to process their personal data and opt out of any email, telephone or other types of communication.

Getting Started with Consent Management 
---------------------------------------

In the OroCommerce back-office, consents are managed by security policy officers (or other company-specific roles with the corresponding consent management permissions) who enable, configure and manage them in the application. Consents can also be localized and display the information in the required language.

You can create two types of consents in OroCommerce, mandatory and optional. 

**Mandatory consents** restrict buyers in the storefront from proceeding to the checkout or creating RFQs, unless they accept these consents. An example of a mandatory consent is a buyer's agreement to comply with the company's terms and conditions, or their explicit permission to let the application process personal data for business intelligence purposes.

**Optional consents** do not restrict buyers from working with the application and are usually used to retrieve permissions to send them email newsletters, inform about upcoming sales or seasonal discounts, etc.

Once the consent is accepted by at least one buyer in the OroCommerce storefront, it becomes uneditable and unremovable from the system, and can be used as evidence should any legal requirements arise to provide it. Moreover, in this case, administrators cannot modify the content of the consent description in any way, and can only view the available consents.

You can view all consents accepted by your customer users in the **Consents** section of their pages under **Customers > Customer Users**.

By default, consents are disabled in OroCommerce. 

To enable and configure consents in OroCommerce, take the following steps:

* Enable consents in the :ref:`system configuration <configuration--guide--commerce--configuration--consents>`.
* Create a :ref:`landing page <user-guide--consents--add>` with the text of the consent, and add it as a content variant of a content tree node.
* Create a :ref:`new consent <user-guide--consents--create>` under **System > Consent Management**, define its properties, and link it to the content tree node.
* Add the consent to the list of enabled user consents in the :ref:`system configuration <configuration--guide--commerce--configuration--consents>` to display consents in the storefront.

Consents can be configured on :ref:`two levels <configuration--guide--config-levels>`, :ref:`global <doc-system-configuration>` and :ref:`website <doc-website-configuration>`. However, you can add consents to the storefront on the website level only when consents are enabled globally.

Learn more on the configuration and localization of consents in OroCommerce in the following topics:

* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Create Consents <user-guide--consents--create>`
* :ref:`Add a Consent Landing Page to a Web Catalog <user-guide--consents--add>`
* :ref:`Localize Consents <user-guide--consents--localizing-consents>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`
* :ref:`Cookie Consent Banner <frontstore-guide--cookie-banner>`
* :ref:`Add a Cookie Banner to the Website <bundle-docs-commerce-consent-bundle-cookie-banner>`

**Related Topics**

* :ref:`Data Protection in the OroCommerce Storefront <frontstore-guide--profile-consents>`
* :ref:`Declined Consents as Contact Requests <user-guide-activities-requests>`
* :ref:`Build Reports with Accepted Consents <user-guide-reports-accepted-consents>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin


.. toctree::
   :hidden:

   add-consent
   localize-consents
   accepted-consents-report

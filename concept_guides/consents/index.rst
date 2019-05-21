.. _user-guide--consents:

Data Protection and Consent Management
======================================

.. contents:: :local:

GDPR Principles
---------------

The General Data Protection Regulation (GDPR) is a law on protection of personal data that affects companies based in the European Union and organizations that have operations and customers on its territory, regardless of the company's location. In addition to putting new obligations on the companies collecting personal data, the GDPR gives individuals more power to access the information that is held about them. This includes giving consumers the right to get their personal data erased in circumstances where it is no longer necessary for the purpose it was collected, if the consent to process data is withdrawn, or if it has been processed unlawfully.

Not complying with the GDPR can result in disciplinary actions from relevant supervisory authorities. 

.. important:: Learn more on data protection regulations in the official `GDPR portal <https://www.eugdpr.org/>`__ and the `EU Commission web page <https://ec.europa.eu/info/law/law-topic/data-protection_en>`__, or see the `ICO's Guide to the GDPR <https://ico.org.uk/for-organisations/guide-to-the-general-data-protection-regulation-gdpr>`__ before you proceed.

GDPR Compliance in OroCommerce
------------------------------

Complying with the new data protection regulations, OroCommerce provides a flexible mechanism for collecting and managing customer consents.
 
In this respect, OroCommerce customers have the right to:

* Know what personal data is processed and stored in the application and how, and request this information at any moment.
* Request to modify their personal data if it is incorrect, outdated, or otherwise inaccurate.
* Reuse their personal data and export it to other systems or organizations. 
* Revoke the consent to process their personal data and opt out of any email, telephone or other types of communication.

Getting Started with Consent Management 
---------------------------------------

In the OroCommerce management console, consents are managed by security policy officers (or other company-specific roles with the corresponding consent management permissions) who enable, configure and manage them in the application. Consents can also be localized and display the information in the required language.

You can create two types of consents in OroCommerce, mandatory and optional. 

**Mandatory consents** restrict buyers in the storefront from proceeding to the checkout or creating RFQs, unless they accept these consents. An example of a mandatory consent is a buyer's agreement to comply with the company's terms and conditions, or their explicit permission to let the application process personal data for business intelligence purposes.

**Optional consents** do not restrict buyers from working with the application and are usually used to retrieve permissions to send them email newsletters, inform about upcoming sales or seasonal discounts, etc.

Once the consent is accepted by at least one buyer in the OroCommerce storefront, it becomes uneditable and unremovable from the system, and can be used as evidence should any legal requirements arise to provide it. Moreover, in this case, administrators cannot modify the content of the consent description in any way, and can only view the available consents.

You can view all consents accepted by your customer users in the **Consents** section of their pages under **Customers > Customer Users**.

By default, consents are disabled in OroCommerce. 

To enable and configure consents in OroCommerce, take the following steps:

* Install the `Customer Consent Management <https://marketplace.orocommerce.com/package/customer-consent-management-in-orocommerce>`_ extension.
* Enable consents in the :ref:`system configuration <configuration--guide--commerce--configuration--consents>`.
* Create a :ref:`landing page <user-guide--consents--add>` with the text of the consent, and add it as a content variant of a content tree node.
* Create a :ref:`new consent <user-guide--consents--create>` under **System > Consent Management**, define its properties, and link it to the content tree node.
* Add the consent to the list of enabled user consents in the :ref:`system configuration <configuration--guide--commerce--configuration--consents>` to display consents in the storefront.
* (Recommended) Enable the :ref:`Checkout with Consents <system--workflows--checkout-with-consents-workflow>` workflow to restrict access to the storefront without consents.

Consents can be configured on :ref:`two levels <configuration--guide--config-levels>`, :ref:`global <doc-system-configuration>` and :ref:`website <doc-website-configuration>`. However, you can add consents to the storefront on the website level only when consents are enabled globally.

Learn more on the configuration and localization of consents in OroCommerce in the following topics:

* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Create Consents <user-guide--consents--create>`
* :ref:`Add a Consent Landing Page to a Web Catalog <user-guide--consents--add>`
* :ref:`Localize Consents <user-guide--consents--localizing-consents>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`
* :ref:`Explore the Checkout with Consents Workflow <system--workflows--checkout-with-consents-workflow>`
* :ref:`Add a Cookie Banner to the Website <user-guide--consents--cookie-banner>`

**Related Topics**

* :ref:`Data Protection in the OroCommerce Storefront <frontstore-guide--profile-consents>`
* :ref:`Declined Consents as Contact Requests <user-guide-activities-requests>`
* :ref:`Build Reports with Accepted Consents <user-guide-reports-accepted-consents>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin

.. toctree::
   :hidden:

   create_consent
   add_consent
   localize_consents
   accepted_consents_report
   cookie_banner
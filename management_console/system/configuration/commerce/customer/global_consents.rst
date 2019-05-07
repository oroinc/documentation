.. _configuration--guide--commerce--configuration--consents:

Consents
========

.. contents:: :local:
   :depth: 1

If your company processes, stores and transmits personal data belonging to EU residents, you may be required to :ref:`comply with the General Data Protection Regulations (GDPR) <user-guide--consents>`. OroCommerce can assist you in observing these regulations by providing consent management mechanisms that enable you to create and manage new consents, and help your buyers view, manage and revoke consents applicable to them. 

.. important:: You can find more information on data protection regulations in the official `GDPR portal <https://www.eugdpr.org/>`__ and the `EU Commission web page <https://ec.europa.eu/info/law/law-topic/data-protection_en>`__, or see the `ICO's Guide to the GDPR <https://ico.org.uk/for-organisations/guide-to-the-general-data-protection-regulation-gdpr>`__ before you proceed.

.. note:: Before you can use consents in OroCommerce, :ref:`install <admin-package-manager>` the `Customer Consent Management <https://marketplace.orocommerce.com/package/customer-consent-management-in-orocommerce>`_ extension.

Consents are disabled by default, but you can enable them globally in the system configuration. If you have more than one website, you can add corresponding consents to specific :ref:`websites <admin--guide--commerce--configuration--customers--consents--enable--website>`, once consents are enabled and created globally.

.. _admin--guide--commerce--configuration--customers--consents--enable--globally:

Enable Consents for the Management Console
------------------------------------------

Consents in OroCommerce can be enabled on the global configuration level only.

To enable consents:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customers > Consents** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   The following page opens:

   .. image:: /img/system/config_commerce/customer/enable_consents_globally.png
      :class: with-border
      :alt: Enable consents checkbox on global level

3. Clear the **Use Default** check box.
4. Select the **Enable User Consents** check box.
5. Click **Save Settings**.

Enabling consents adds the **Consent Management** menu under **System**.

.. image:: /img/system/config_commerce/customer/consent_management_menu.png
   :class: with-border
   :alt: Consent management menu

Enable Consents for the Storefront
----------------------------------

Once the consents are enabled, you can add all or selected consents to the list of **Enabled Consents** to display them in the storefront:

.. note:: If there are no consents in the application yet, create them under **System > Consent Management**, as described in the :ref:`Create Consents <user-guide--consents--create>` topic.

To add consents to the list of enabled consents:

1. Clear the **Use Default** check box under the **+Add Consent** button.
#. Click **+Add Consent** and select the consent from the list.

   Alternatively, click on the hamburger menu and select the consent from its list.

#. If more than one consent is added to the **Enabled Consents** list, you can drag and drop them to set the order in which these consents will be displayed in the storefront.

   .. note:: The number of consents that can be added to the list equals the number of consents created in the application.

#. To delete a consent from the list of enabled consents, click **x** next to it.
#. Click **Save Settings** on the top right.

   .. image:: /img/system/config_commerce/customer/enable_consents_for_storefront.png
      :class: with-border
      :alt: Enable consents for storefront


**Related Topics**

* :ref:`Data Protection and Consent Management <user-guide--consents>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`

.. toctree::
   :hidden:

   consents_global
   consents_website

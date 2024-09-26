.. _configuration--guide--commerce--configuration--interactions:

Configure Global Interactions Settings
======================================

The Interactions settings allow you to interact with your customer users, enabling conversations between back-office users and customer users, provide the option to display the *Contact Us* form in the storefront, and manage user consents, ensuring a smooth and compliant user experience.

Interactions can be configured globally, :ref:`per organization <sys--conf--commerce--customer--interactions-organization>`, and :ref:`per website <system--website--configuration--commerce--customers--interactions>`.

To configure the interactions settings globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customer > Interactions** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

   .. image:: /user/img/system/config_commerce/customer/interactions-settings.png
      :alt: Global interactions config settings


Enable the Conversations Feature
--------------------------------

Conversations enable communication between back-office users and customer users.

1. Clear the **Use Default** checkbox to adjust the system settings.
2. Toggle the **Enable Conversations** checkbox to activate or deactivate the feature.
3. Click **Save Settings**.

Enabling conversations adds the :ref:`Conversations <doc-activities-conversations>` menu under **Activities**.

.. image:: /user/img/system/config_commerce/customer/conversations_activity.png
   :alt: New Conversations menu that appears under Activities once being enabled


.. _sys--conf--commerce--customer--contact-request-global:

Configure Global Contact Requests Settings
------------------------------------------

To enable or disable the display of the **Contact Us** form in the storefront globally:

1. Clear the **Use Default** checkbox to adjust the system settings.
2. In **Contact Requests**, toggle the **Allow Contact Requests** checkbox to enable or disable the **Contact Us** form in the storefront.
3. If the form is disabled, you can still use the :ref:`Contact Us widget <user-guide--landing-pages-create>` in your web catalog pages.
4. Click **Save Settings**.

.. _configuration--guide--commerce--configuration--consents:
.. _admin--guide--commerce--configuration--customers--consents--enable--globally:

Enable The Consents Feature
---------------------------

.. hint:: Read more on this topic in :ref:`Data Protection and Consent Management <user-guide--consents>`.

If your company processes, stores and transmits personal data belonging to EU residents, you may be required to :ref:`comply with the General Data Protection Regulations (GDPR) <user-guide--consents>`. OroCommerce can assist you in observing these regulations by providing consent management mechanisms that enable you to create and manage new consents, and help your buyers view, manage and revoke consents applicable to them.

.. important:: You can find more information on data protection regulations in the official |GDPR| portal and the |EU Commission web page|, or see the |ICO's Guide to the GDPR| before you proceed.

Consents are disabled by default, but you can enable them globally in the system configuration. If you have more than one website, you can add corresponding consents to specific :ref:`websites <admin--guide--commerce--configuration--customers--consents--enable--website>`, once consents are enabled and created globally.

To enable consents:

1. Under **Consents**, toggle the **Enable User Consents Feature** checkbox to activate or deactivate the feature.

Enabling consents adds the **Consent Management** menu under **System**.

.. image:: /user/img/system/config_commerce/customer/consent_management_menu.png
   :alt: Consent management menu

2. Under the **Contact Reason** field, specify the :ref:`a contact reason <admin-guide-contact-reasons>` for a notification generated when a customer declines consent in the storefront. When a consent is declined, the system automatically creates a notification in the back-office, and this field allows you to categorize that notification by selecting the appropriate reason from a predefined list.

3. Under the **Enabled User Consents** field, add consents to the list of enabled consents to display them in the storefront. If there are no consents in the application yet, create them under **System > Consent Management**, as described in the :ref:`Create Consents <user-guide--consents--create>` topic.

   * Clear the **Use Default** checkbox.
   * Click **Add Consent** and select the required consent(s) from the list. Alternatively, click on the hamburger menu and select the consent(s) from its list.
   * If more than one consent is added to the **Enabled User Consents** list, you can drag and drop them to set the order in which these consents will be displayed in the storefront.
   * To delete a consent from the list of enabled consents, click **x** next to it.

.. image:: /user/img/system/config_commerce/customer/enable_consents_for_storefront.png
   :alt: Enable consents for storefront

.. note:: The number of consents that can be added to the list equals the number of consents created in the application. In addition, one consent cannot be added twice.

4. Click **Save Settings** on the top right.




**Related Topics**

* :ref:`Data Protection and Consent Management <user-guide--consents>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`


.. include:: /include/include-links-user.rst
   :start-after: begin

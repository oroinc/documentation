.. _admin--guide--commerce--configuration--customers--consents--enable--globally:

Enable Consents Globally
------------------------

.. begin_enable_consents

.. contents:: :local:
   :depth: 3

Enable Consents for the Management Console
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Consents in OroCommerce can be enabled on the global configuration level only.

To enable consents:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Customers > Consents** in the menu to the left.

   .. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. Next to the **Enable User Consents** field, clear the **Use Default** check box.
4. Select the **Enable User Consents** check box.

   .. image:: /admin_guide/img/configuration/customer/consents/enable_consents_globally.png
      :class: with-border
      :alt: Enable consents checkbox on global level

5. Click **Save Settings**.

   Enabling consents adds the **Consent Management** menu under **System**.

   .. image:: /admin_guide/img/configuration/customer/consents/consent_management_menu.png
      :class: with-border
      :alt: Consent management menu

6. Next to the **Contact Reason** field, clear the **Use Default** check box.
7. If the consent is declined in the storefront, a notification is created in the management console as :ref:`a contact reason <admin-guide-contact-reasons>`. Select the contact reason from the list for a declined consent notification.

   .. image:: /admin_guide/img/configuration/customer/consents/contact_reason_config.png
      :class: with-border
      :alt: Contact reason configuration option

Enable Consents for the Storefront
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

Once the consents are enabled, you can add all or selected consents to the list of **Enabled User Consents** to display them in the storefront:

.. note:: If there are no consents in the application yet, create them under **System > Consent Management**, as described in the :ref:`Create Consents <user-guide--consents--create>` topic.

To add consents to the list of enabled consents:

1. Next to the **Enabled User Consents** field, clear the **Use Default** check box.
#. Click **Add Consent** and select the required consent(s) from the list.

   Alternatively, click on the hamburger menu and select the consent(s) from its list.

#. If more than one consent is added to the **Enabled User Consents** list, you can drag and drop them to set the order in which these consents will be displayed in the storefront.

   .. note:: The number of consents that can be added to the list equals the number of consents created in the application. In addition, once consent cannot be added twice.

#. To delete a consent from the list of enabled consents, click **x** next to it.
#. Click **Save Settings** on the top right.

   .. image:: /admin_guide/img/configuration/customer/consents/enable_consents_for_storefront.png
      :class: with-border
      :alt: Enable consents for storefront

.. finish_enable_consents

**Related Topics**

* :ref:`Data Protection and Consent Management <user-guide--consents>`
* :ref:`Data Protection in the OroCommerce Storefront <frontstore-guide--profile-consents>`
* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Enable Consents per Website <admin--guide--commerce--configuration--customers--consents--enable--website>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin
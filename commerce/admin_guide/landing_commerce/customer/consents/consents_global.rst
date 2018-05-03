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

   The following page opens:

   .. image:: /admin_guide/img/configuration/customer/consents/enable_consents_globally.png
      :class: with-border
      :alt: Enable consents checkbox on global level

3. Clear the **Use Default** check box.
4. Select the **Enable User Consents** check box.
5. Click **Save Settings**.

Enabling consents adds the **Consent Management** menu under **System**.

.. image:: /admin_guide/img/configuration/customer/consents/consent_management_menu.png
   :class: with-border
   :alt: Consent management menu

Enable Consents for the Storefront
^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^

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
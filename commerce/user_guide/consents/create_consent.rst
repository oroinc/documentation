.. _user-guide--consents--create:

Create Consents
---------------

.. note:: Before you can use consents in OroCommerce, :ref:`install <admin-package-manager>` the `Customer Consent Management <https://marketplace.orocommerce.com/package/customer-consent-management-in-orocommerce>`_ extension.

To create a consent in OroCommerce:

1. Navigate to **System > Consent Management** in the main menu.
2. Click **Create Consent** on the top right.

   The following page opens:

   .. image:: /admin_guide/img/configuration/customer/consents/create_new_consent.png
      :class: with-border
      :alt: Create a new consent

3. Provide the following information:

   * **Owner** --- The owner is pre-populated with the user creating the consent but this value can be changed to another user of the system by clicking |IcBars| and selecting a user from the list. 
   * **Name** --- The name of the consent displayed in the management console and storefront. Use the folder icon next to the option to provide a localized name for the consent.
   * **Type** --- Define whether the user can proceed without giving their consent. The mandatory consents must be accepted by customer users in the storefront to be able to register, proceed to the checkout and create an RFQ. 
   * **Declined Consent Notification** --- When the check box is enabled, a notification is created in the management console as a :ref:`contact request <user-guide-activities-requests>` if a consent is declined by a customer user in the storefront.
   * **Web Catalog** --- Select the web catalog where you intend to use this consent.
   * **Content Node** --- Content nodes are added to web catalogs as landing pages, and linked as content variants to the catalog nodes. The selected web сatalog node can be configured to display different landing pages (content variants) in different languages. To link the consent to the required node, click on the required node in the tree to select it.

     .. note:: It is recommended have the required web catalog and the node created prior to creating a new consent. Read more on catalogs in the :ref:`Web Catalogs <user-guide--web-catalog>` topic. 

     .. image:: /admin_guide/img/configuration/customer/consents/link_consent_to_node.png
        :class: with-border
        :alt: Link the consent to a web catalog node

4. Click **Save and Close**.

.. important:: Keep in mind that for the consents to be displayed in the storefront, you need to :ref:`add them to the list of enabled consents <admin--guide--commerce--configuration--customers--consents--enable--globally>` in the system configuration.

.. important:: Be aware that if a consent is accepted by at least one person in the OroCommerce storefront, it becomes uneditable and unremovable. The associated landing page becomes uneditable and unremovable as well.

.. important:: You can view all consents accepted by your customer users in the **Consents** section of their pages under **Customers > Customer Users**.

        .. image:: /admin_guide/img/workflows/checkout_with_consents/consents_section_customer_user_page.png

**Related Topics**

* :ref:`Data Protection in the OroCommerce Storefront <frontstore-guide--profile-consents>`
* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Declined Consents as Contact Requests <user-guide-activities-requests>`
* :ref:`Add a Consent Landing Page to a Web Catalog <user-guide--consents--add>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`
* :ref:`Build Reports with Accepted Consents <user-guide-reports-accepted-consents>`
* :ref:`Add a Cookie Banner to the Website <user-guide--consents--cookie-banner>`

.. include:: /img/buttons/include_images.rst
   :start-after: begin
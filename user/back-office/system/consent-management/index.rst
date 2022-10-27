:oro_documentation_types: OroCommerce
:oro_show_local_toc: false

.. _system-consent-management:

Configure Consent Management in the Back-Office
===============================================

.. hint:: Read more on this topic in the :ref:`Consent Management Concept Guide <user-guide--consents>`.

.. _user-guide--consents--create:

Create Consents
---------------

.. begin_create_consents

To create a :term:`consent <Consent>` in OroCommerce:

1. Navigate to **System > Consent Management** in the main menu.
2. Click **Create Consent** on the top right.

   .. image:: /user/img/system/consents/create_new_consent.png
      :class: with-border
      :alt: Create a new consent

3. Provide the following information:

   * **Owner** --- The owner is pre-populated with the user creating the consent but this value can be changed to another user of the system by clicking |IcBars| and selecting a user from the list.
   * **Name** --- The name of the consent displayed in the back-office and storefront. Use the folder icon next to the option to provide a localized name for the consent.
   * **Type** --- Define whether the user can proceed without giving their consent. The mandatory consents must be accepted by customer users in the storefront to be able to register, proceed to the checkout and create an RFQ.
   * **Declined Consent Notification** --- When the checkbox is enabled, a notification is created in the back-office as a :ref:`contact request <user-guide-activities-requests>` if a consent is declined by a customer user in the storefront.
   * **Web Catalog** --- Select the web catalog where you intend to use this consent.
   * **Content Node** --- Content nodes are added to web catalogs as landing pages, and linked as content variants to the catalog nodes. The selected web сatalog node can be configured to display different landing pages (content variants) in different languages. To link the consent to the required node, click on the required node in the tree to select it.

     .. note:: It is recommended to have the required web catalog and the node created prior to creating a new consent. Read more on catalogs in the :ref:`Web Catalogs <user-guide--web-catalog>` topic.

     .. image:: /user/img/system/consents/link_consent_to_node.png
        :class: with-border
        :alt: Link the consent to a web catalog node

4. Click **Save and Close**.

.. important:: Keep in mind that for the consents to be displayed in the storefront, you need to :ref:`add them to the list of enabled consents <admin--guide--commerce--configuration--customers--consents--enable--globally>` in the system configuration.

.. important:: Be aware that if a consent is accepted by at least one person in the OroCommerce storefront, it becomes uneditable and unremovable. The associated landing page becomes uneditable and unremovable as well.

.. important:: You can view all consents accepted by your customer users in the **Consents** section of their pages under **Customers > Customer Users**.

        .. image:: /user/img/system/consents/consents_section_customer_user_page.png
           :alt: Consents section under a customer user record

**Related Topics**

* :ref:`Data Protection in the OroCommerce Storefront <frontstore-guide--profile-consents>`
* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Declined Consents as Contact Requests <user-guide-activities-requests>`
* :ref:`Add a Consent Landing Page to a Web Catalog <user-guide--consents--add>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`
* :ref:`Build Reports with Accepted Consents <user-guide-reports-accepted-consents>`
* :ref:`Add a Cookie Banner to the Website <bundle-docs-commerce-cookie-consent-bundle>`
* :ref:`Cookie Consent Banner <frontstore-guide--cookie-banner>`

.. include:: /include/include-images.rst
   :start-after: begin


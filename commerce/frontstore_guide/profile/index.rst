.. _frontstore-guide--profile:

My Profile 
==========

The following information covers the **My Profile** section of the **Account** menu.

.. _frontstore-guide--profile-overview:

.. begin

.. contents:: :local:
   :depth: 2

To locate your profile:

1. Click **Account** in the :ref:`user menu <frontstore-guide--navigation-user-menu>` on the top left of the page.
2. Under **Account**, click **My Profile**.

My Profile has two sections:

* Account Info
* Default Addresses

   .. image:: /frontstore_guide/img/profile/MyProfilePage.png

.. _frontstore-guide--profile-account:

Account Info
^^^^^^^^^^^^

In the **Account Info** section you can view the following details:

* Name
* Email
* Role
* Company
* Status
* Data protection (consents)

To edit the profile, click |IcPencil| next to **Account Info**.

.. note:: Please note that the ability to edit your account information depends on the permissions that correspond to your role. These are defined by the administrator.

In editing mode, you can amend the following details:

* Customer
* Email Address
* Name Prefix
* First Name
* Middle Name
* Last Name
* Name Suffix
* Birthday
* Password
* Data protection (accept or revoke mandatory or optional consents to process personal data)


.. image:: /frontstore_guide/img/profile/MyProfilePageEdit.png

.. _frontstore-guide--profile-default-addresses:

Default Addresses
^^^^^^^^^^^^^^^^^

The **Default Addresses** section shows the addresses used by the signed in user. Here, the primary address is displayed
 by default.

You can perform the following actions for each of the addresses listed here:

* Edit |IcPencil|
* Delete |IcDelete|

To :ref:`manage default addresses in the address book <frontstore-guide--company-address>`, click **Manage Addresses** on the bottom of the section.

.. hint:: You can also open the address book by clicking **Address Book** in the menu on the left.

.. image:: /frontstore_guide/img/profile/MyProfileManageAddresses.png

.. image:: /frontstore_guide/img/profile/MyProfileAddressBooks.png

.. _frontstore-guide--profile-consents:

Data Protection
^^^^^^^^^^^^^^^

To comply with the :ref:`General Data Protection Regulations in the EU (GDPR) <user-guide--consents>`, you need to be able to provide your explicit consent to the application to process your personal data. All available consents are located in your profile under **Account Info**.

Consents can be mandatory and optional:

* **Mandatory consents** restrict you from proceeding to the checkout or creating RFQs, unless you accept them. Mandatory consents are marked with a red asterisk.
* **Optional consents** do not restrict you from working with the application and are usually used to retrieve permissions to send email newsletters, inform about upcoming sales or seasonal discounts, etc.

The following key rules apply to consents in OroCommerce:

* **All consents are obtained through explicit actions**

  The check boxes next to consents are never pre-selected and you can opt in only by explicitly clicking **Accept** under the consent. 

  .. image:: /frontstore_guide/img/profile/explicit_accept_consent.png

* **Consents are informed**

  You can be aware of how exactly your data is going to be processed and shared, and what marketing communications you can expect once you provide your consent. Therefore, you can view all your accepted and pending consents (and their detailed description) in your profile under **Account > My Profile > Account Info** in the storefront. 

  .. image:: /frontstore_guide/img/profile/data_protection_my_profile.png

* **Consents can be revoked**

  If you are no longer happy with a consent, you can revoke it through your profile in the storefront when editing your **Account Info**.

  .. image:: /frontstore_guide/img/profile/revoke_consent.png

.. _frontstore-guide--profile-consents--accept:

Accept a Consent
~~~~~~~~~~~~~~~~

You can be asked to accept consents when:

* :ref:`Registering (creating and account in the OroCommerce store) <frontstore-guide--getting-started-overview-create-account>`
* :ref:`When editing <frontstore-guide--profile-account>` your profile under **Account Info > Data Protection**
* :ref:`When requesting a quote <frontstore-guide--rfq>`

.. comment: :ref:`At the first step of the checkout <>`

To accept a :ref:`consent <frontstore-guide--profile-consents>` from the page of your profile:

1. Click **Account** in the :ref:`user menu <frontstore-guide--navigation-user-menu>` on the top left of the page.
2. Under **Account**, click **My Profile**.

   .. image:: /frontstore_guide/img/profile/accept_consent.png

3. Click |IcEdit| **Edit** next to the **Account Info** section.
   
   .. note:: You can view the description of the available consents in the **Account Info** by clicking on the consent links. The |ConsentDeclined| icon indicates that the consent has not been accepted, while the |IcActivate| indicated that it has been read, understood and accepted.

4. In the **Data Protection** section, select the check box next to the consent that you want to accept. At this point you are prompted to read the text of the consent. 

   .. image:: /frontstore_guide/img/profile/accept_consent_explicitly.png

5. Click **Accept** to agree to the terms of the consent. 

   .. image:: /frontstore_guide/img/profile/accept_consent_form_my_profile.png

6. Click **Save** on the bottom left.

.. _frontstore-guide--profile-consents--revoke:

Revoke a Consent
~~~~~~~~~~~~~~~~

To decline the :ref:`consent <frontstore-guide--profile-consents>` that you have previously accepted:

1. Click **Account** in the :ref:`user menu <frontstore-guide--navigation-user-menu>` on the top left of the page.
2. Under **Account**, click **My Profile**.

   .. image:: /frontstore_guide/img/profile/data_protection_section_my_profile_consent_accepted.png

3. Click |IcEdit| **Edit** next to the **Account Info** section.
   
   .. note:: You can view the description of the available consents in the **Account Info** section by clicking on the consent links. The |ConsentDeclined| icon indicates that the consent has not been accepted, while the |IcActivate| indicated that it has been read, understood and accepted.
  
4. In the **Data Protection** section, clear the check box next to the consent that you want to revoke. 
5. Click **Save** on the bottom left of the page.
6. Confirm that you wish to decline the consent by clicking **Yes, Save**. You will be automatically redirected to the page of your profile.

.. comment: Double check the button. Should be changed into No, Cancel and Yes, Decline


.. include:: /frontstore_guide/related_topics.rst
   :start-after: begin

.. include:: /img/buttons/include_images.rst
   :start-after: begin


.. finish



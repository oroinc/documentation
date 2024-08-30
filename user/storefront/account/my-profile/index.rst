.. _frontstore-guide--profile:

Manage My Profile in the Storefront
===================================

.. _frontstore-guide--profile-overview:

.. begin

Once you are logged in to the OroCommerce storefront, you can access your profile by clicking on your name in the top navigation bar, and selecting **My Profile** from the dropdown.

My Profile has two sections, Account Info and Default Addresses.

.. image:: /user/img/storefront/profile/MyProfilePage.png

.. _frontstore-guide--profile-account:

Account Info
^^^^^^^^^^^^

In the **Account Info** section you can view the following details:

* Name
* Email
* Role
* Company
* Status
* Password Status
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

.. image:: /user/img/storefront/profile/MyProfilePageEdit.png

.. _frontstore-guide--profile-default-addresses:

Default Addresses
^^^^^^^^^^^^^^^^^

The **Default Addresses** section shows the addresses used by the signed in user. Here, the primary address is displayed by default.

You can perform the following actions for each of the addresses listed here:

* Edit |IcPencil|
* Delete |IcDelete|

To :ref:`manage default addresses in the address book <frontstore-guide--company-address>`, click **Go to Personal Addresses**.

.. hint:: You can also open the address book by clicking **Address Book** in the menu on the left.

.. image:: /user/img/storefront/profile/MyProfileManageAddresses.png

.. _frontstore-guide--profile-consents:

Data Protection
^^^^^^^^^^^^^^^

.. hint:: Read more on this topic in :ref:`Data Protection and Consent Management <user-guide--consents>`.

To comply with the :ref:`data protection regulations (such as CPPA, GDPR, etc.) <user-guide--consents>`, explicit consent for the application to process your personal data may be required. All applicable consents are located under **My Profile** in the **Account Info** section.

Consents can be mandatory and optional:

* **Mandatory consents** restrict you from proceeding to the checkout or creating RFQs, unless you accept them. Mandatory consents are marked with a red asterisk.
* **Optional consents** do not restrict you from working with the application and are usually used to retrieve permissions to send them email newsletters, inform about upcoming sales or seasonal discounts, etc.

The following key rules apply to consents in OroCommerce:

* **All consents are obtained through explicit actions**

  The checkboxes next to consents are never pre-selected and you can opt in only by explicitly clicking **Accept** under the consent.

  .. image:: /user/img/storefront/profile/explicit_accept_consent.png

* **Consents are informed**

  You can be aware of how exactly your data is going to be processed and shared, and what marketing communications you can expect once you provide your consent. Therefore, you can view all your accepted and pending consents (and their detailed description) in your profile under **My Profile > Account Info** in the storefront.

  .. image:: /user/img/storefront/profile/accepted-consent-profile.png

* **Consents can be revoked**

  If you are no longer happy with a consent, you can revoke it through your profile in the storefront when editing your **Account Info**.

  .. image:: /user/img/storefront/profile/revoke_consent.png

.. _frontstore-guide--profile-consents--accept:

Accept a Consent
~~~~~~~~~~~~~~~~

You can be asked to accept consents when:

* :ref:`Registering (creating and account in the OroCommerce store) <frontstore-guide--getting-started-overview-create-account>`
* :ref:`When editing <frontstore-guide--profile-account>` your profile under **Account Info > Data Protection**
* :ref:`When requesting a quote <frontstore-guide--rfq>`
* At checkout

You can accept a :ref:`consent <frontstore-guide--profile-consents>` from the page of your profile, by clicking |IcEdit| **Edit** next to the **Account Info** section.

.. note:: You can view the description of the available consents in the **Account Info** by clicking on the consent links. The |ConsentDeclined| icon indicates that the consent has not been accepted, while the |IcActivate| indicated that it has been read, understood and accepted.

In the **Data Protection** section, select the checkbox next to the consent that you want to accept. At this point you are prompted to read the text of the consent. Click **Accept** to agree to the terms of the consent and Click **Save** on the bottom left.

.. image:: /user/img/storefront/profile/revoke_consent.png

.. image:: /user/img/storefront/profile/explicit_accept_consent.png

.. _frontstore-guide--profile-consents--revoke:

Revoke a Consent
~~~~~~~~~~~~~~~~

You can decline the :ref:`consent <frontstore-guide--profile-consents>` that you have previously accepted, by clicking |IcEdit| **Edit** next to the **Account Info** section.

.. note:: You can view the description of the available consents in the **Account Info** section by clicking on the consent links. The |ConsentDeclined| icon indicates that the consent has not been accepted, while the |IcActivate| indicated that it has been read, understood and accepted.

In the **Data Protection** section, clear the checkbox next to the consent that you want to revoke and click **Save** on the bottom left of the page.

.. include:: /include/include-images.rst
   :start-after: begin


.. finish

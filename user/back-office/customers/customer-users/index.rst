:oro_documentation_types: OroCommerce

.. _user-guide--customers--customer-users:
.. _user-guide--customers--create-customer-user:

Manage Customer Users in the Back-Office
========================================

.. hint:: This section is a part of the :ref:`Customer Management <concept-guide-customers>` topic that provides the general understanding of accounts, contacts, customers and customer hierarchy available in Oro applications.

:term:`Customer users <Customer User>` act on behalf of the company (i.e. customers in Oro context)  and may have a limited set of permissions in OroCommerce, depending on their function in the customer organization.

For customer user management, navigate to **Customers > Customer Users** in the main menu.

In Customer Users section, you can:

* View, edit, and create new customer users.
* Select their roles in OroCommerce to define their level of permissions and access to the actions and data in OroCommerce storefront.
* Manage customer user information (name, birthday, billing and shipping address, and phone number, etc).
* View requests for quotes, quotes, sales orders, and shopping lists created by the customer user.
* View communication with the customer that happened using email, notes or scheduled events.
* View additional information attached to customer user.
* Enable and disable the customer.
* Reset the customer user password.
* Add OAuth applications

.. note:: You can delegate this function to the customer who will access user and role management in the OroCommerce storefront (see the :ref:`Delegating Users and Role Management to the Customer <user-guide--customers--customer-user-delegate>` section for more information).

**Customer Account Confirmation**

Upon registration, a customer user receives an email confirmation request. Once they follow up with the requested action, their account is marked as confirmed.

.. image::/img/customers/customer_users/CustomerUsers.png
   :alt: The list of confirmed accounts

Hover over the |IcMore| **More Options** menu to the right of the necessary customer user to perform the following actions:

* |IcView| **View** customer user details. Alternatively, click on the item to open its details page.
* |IcEdit| **Edit** customer user details.
* |IcDelete| **Delete** existing customer users.


Create a Customer User
----------------------

To create a new customer user:

#. Navigate to **Customers > Customer Users** in the main menu.

#. Click **Create Customer User**.

   .. image:: /user/img/customers/customer_users/CustomerUsersCreate.png
      :alt: The customer user creation form

#. Select the **Enabled** check box to enable the user to log into the system and to do their work within it upon creation.

#. Fill in the customer **Name** and other personal information.

#. Select a customer this user represents.

#. If you are adding a subsidiary of the existing customer, select a parent customer.

#. Assign a sales representative who will be assisting this customer user. By default, the customer sales representative applies to the customer user.

#. Select the **Generate Password** and **Send Welcome Email** check boxes.

#. Select the website the customer user will be redirected to upon the login. See :ref:`Managing Websites <user-guide--system-websites>` for more information.

#. Select a **Preferred Localization** for the customer user. This field is displayed if more than one :ref:`localization <sys--config--sysconfig--general-setup--localization>` is enabled for any of the websites of the current organization. If you change the website for the customer user, you will need to select a new preferred localization.

#. Add billing and shipping address as described in the :ref:`Address Book <user-guide--getting-started--address-book>` section.

#. In the **Roles** section, select the roles that should apply to the customer user. When several roles are selected, granted permissions are accumulated from all the assigned roles. See :ref:`Managing Customer User Roles <user-guide--customers--customer-user-roles>` for more information.

   .. important:: At least one role must be assigned if the **Enabled** check box is selected. Disabled customer users can be saved without roles, but you will need to assign roles to them later before enabling.

#. Click **Save** on the top right.

.. add oauth for 3.1

.. _user-guide--customers--customer-users--consents:

View Accepted Consents
----------------------

When at least one consent to process personal data has been accepted by a customer user in the storefront, you can view this information in the dedicated **Consents** section on the page of a particular customer user under **Customers > Customer Users**.

 .. image:: /user/img/customers/customer_users/consents_section_customer_user_page.png
    :alt: View the Consents section of a customer user

You can read more information on consent management in the following related topics:

* :ref:`Configure Consents <configuration--guide--commerce--configuration--consents>`
* :ref:`Create Consents <user-guide--consents--create>`
* :ref:`Add a Consent Landing Page to a Web Catalog <user-guide--consents--add>`
* :ref:`View and Accept Consents in the Storefront <frontstore-guide--profile-consents>`
* :ref:`Revoke Consents <user-guide-activities-requests>`

.. _user-guide--customers--customer-user-delegate:

Delegate Account Management to a Customer User
----------------------------------------------

You may want to delegate some of the customer user management capabilities to the customer users with administrator role by enabling *Account Management* permissions and capabilities. See the :ref:`Customer User Roles <user-guide--customers--customer-user-roles>` section for more information about permissions and capability management.

.. image:: /user/img/customers/customer_user_roles/CustomerUserRolesManageAccounts_cust.png
   :alt: The list of account management capabilities

.. _user-guide--customers--customer-users--oauth:

Add OAuth Applications
----------------------

.. include:: /user/back-office/getting-started/user-menu/oauth.rst
   :start-after: begin_1
   :end-before: finish_1

Oro Side: Add an Application
^^^^^^^^^^^^^^^^^^^^^^^^^^^^

To add a new OAuth application for a customer user in the back-office:

1. Navigate to **Customers > Customer Users** in the main menu.
2. Click once on the name of your selected customer user to open their details page.
3. In the **OAuth Applications** section, click **Add Application** and provide the following details in the pop-up dialog:

   * **Organization** --- If you are adding an application within the organization with *global* access, you can select which other available organization to add the application to.
   * **Application Name** --- Provide a meaningful name for the application you are adding.
   * **Active** --- Select the **Active** check box to activate the new application.

4. Click **Create**.

A corresponding notification is sent to the primary email address of the user, the owner of oauth application. You can change the default recipient, localization, or an email content if needed by updating the :ref:`OAuth email templates <user-guide-using-emails-create-template>` and the related :ref:`notification rule <user-guide-using-emails-notifications>` set out-of-the-box in the system configuration.

.. include:: /user/back-office/getting-started/user-menu/oauth.rst
   :start-after: begin_2
   :end-before: finish_2

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin

.. toctree::

   export
   import

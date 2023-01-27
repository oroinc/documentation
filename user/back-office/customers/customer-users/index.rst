:oro_documentation_types: OroCommerce

.. _user-guide--customers--customer-users:
.. _user-guide--customers--create-customer-user:

Manage Customer Users in the Back-Office
========================================

.. hint:: This section is part of the :ref:`Customer Management <concept-guide-customers>` topic that provides a general understanding of accounts, contacts, customers, and customer hierarchy available in Oro applications.

:term:`Customer users <Customer User>` act on behalf of the company (i.e. customers in Oro context) and may have a limited set of permissions in OroCommerce, depending on their function in the customer organization.

For customer user management, navigate to **Customers > Customer Users** in the main menu.

In Customer Users section, you can:

* View, edit, and create new customer users.
* Select their roles in OroCommerce to define their level of permissions and access to the actions and data in OroCommerce storefront.
* Manage customer user information (name, birthday, billing and shipping address, and phone number, etc).
* View requests for quotes, quotes, sales orders, and shopping lists created by the customer user.
* View communication with the customer that happened using email, notes or scheduled events.
* View additional information attached to customer user.
* Enable and disable the customer user.
* Reset the customer user password.
* Unlock the customer user that was locked out when the max number of login attempts is reached.
* Add OAuth applications

.. note:: You can delegate this function to the customer who will access user and role management in the OroCommerce storefront (see the :ref:`Delegating Users and Role Management to the Customer <user-guide--customers--customer-user-delegate>` section for more information).

.. hint:: The Quick Action Buttons feature is available starting from OroCommerce v5.0.8. To check which application version you are running, see the :ref:`system information <system-information>`.

Quick action buttons enable you to create a new address, order, and quote directly from the customer user view page. Click the button to open the required form for data input. The form can be displayed in a new browser tab, a popup dialog window, or replace the current page, :ref:`depending on its system configuration <doc-configuration-display-settings-quick-actions>`.

Alternatively, click **More Actions** at the top right and select the entity to be created from the customer user view page.

.. image:: /user/img/customers/customer_users/quick-buttons-customer-user.png
   :alt: Displaying the quick action buttons on the customer user view page

**Customer Account Confirmation**

Upon registration, a customer user receives an email confirmation request. Once they follow up with the requested action, their account is marked as confirmed.

.. image:: /user/img/customers/customer_users/CustomerUsers.png
   :alt: The list of confirmed accounts

Hover over the |IcMore| **More Options** menu to the right of the necessary customer user to perform the following actions:

* |IcBan| **Disable** a customer user.
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

#. Select the **Enabled** checkbox to enable the user to log into the system and to do their work within it upon creation.

#. Fill in the customer **Name** and other personal information.

#. Select a customer this user represents.

#. If you are adding a subsidiary of the existing customer, select a parent customer.

#. Assign a sales representative who will be assisting this customer user. By default, the customer sales representative applies to the customer user.

#. Select the **Generate Password** and **Send Welcome Email** checkboxes.

#. Select the website of customer user registration. While the customer user may have access to other websites within the same organization, the email notifications concerning their user account will point to this website. See :ref:`Managing Websites <user-guide--system-websites>` for more information.

#. Select a **Preferred Localization** for the customer user. This field is displayed if more than one :ref:`localization <sys--config--sysconfig--general-setup--localization>` is enabled for any of the websites of the current organization. If you change the website for the customer user, you will need to select a new preferred localization.

#. Add billing and shipping address as described in the :ref:`Address Book <user-guide--getting-started--address-book>` section.

#. In the **Roles** section, select the roles that should apply to the customer user. When several roles are selected, granted permissions are accumulated from all the assigned roles. See :ref:`Managing Customer User Roles <user-guide--customers--customer-user-roles>` for more information.

   .. important:: At least one role must be assigned if the **Enabled** checkbox is selected. Disabled customer users can be saved without roles, but you will need to assign roles to them later before enabling them.

#. Click **Save** on the top right.

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

Impersonate a Customer User
---------------------------

.. hint:: This feature is available in the Enterprise edition.

For troubleshooting purposes, user impersonation allows back-office users with the **Login as Customer User** :ref:`role capability <admin-capabilities>` to access and operate the OroCommerce storefront as if they were logged in as a specific customer user. Such back-office user is redirected to the website assigned to the customer user they are impersonating (i.e., the website where the customer user registered).

.. hint:: Before proceeding, make sure this feature is enabled in the system configuration :ref:`globally <system-configuration-user-impersonation>` or :ref:`per organization <organization-user-impersonation>`.

You can perform impersonation from the customer user grid, or from the view page of the selected customer.

To impersonate a customer user from the customer user grid, hover over the |IcMore| **More Options** menu to the right of the selected customer user and click |IcImpersonation|.

.. image:: /user/img/customers/customer_user_roles/impersonate-customer-user-grid-icon.png
   :alt: Impersonating a customer user from the customer user grid

To impersonate a customer user from the customer user view page, click |IcImpersonation| **Log in as a User** on the top right.

.. image:: /user/img/system/user_management/user-impersonation-button.png
   :alt: Impersonating a customer user from the customer user view page

The storefront session in impersonation mode opens in a new browser tab.

.. image:: /user/img/customers/customer_user_roles/impersonation-mode.png
   :alt: Impersonation mode in the storefront

To exit impersonation mode, click **Log out** in the blue banner.

.. _user-guide--customers--customer-user-reset-password:

Reset User Passwords
--------------------

An administrator can request the customer user to change their password by clicking the |IcPassReset| **Reset Password** button on the customer user's profile page:

.. image:: /user/img/customers/customer_users/customer-user-reset-password-button.png

A customer user will receive an email with the link to update their password.

.. image:: /user/img/customers/customer_users/customer_user_reset_password.png

When resetting their password, users can only log into the application once their password is changed, in which case their password status changes to **Reset** in the back-office. The status switches to **Active** as soon as the customer user changes the password.

.. image:: /user/img/customers/customer_users/customer_user_password_reset.png

Alternatively, you can reset the password for a specific customer user from the grid of all customer users. For this, hover over the ellipsis menu at the end of the row of the selected customer user, and click **Reset Password**.

.. image:: /user/img/customers/customer_users/customer_user_reset_password_from_grid.png

The same functionality is available for the storefront administrators.

You can change the contents of the password change email by updating the **customer_user_force_reset_password** :ref:`email template <user-guide-using-emails-create-template>` of the Customer User entity.

The link in the email will have a refresh token to enable password change for a customer user. By default, this token and the reset password link in the email are valid for 24 hours from the moment the reset request is thrown.

An administrator can change this ttl in the :ref:`configuration of the Customer bundle <yaml-bundles-configuration-reset-password>`.

.. _user-guide--customers--customer-users--oauth:

Add OAuth Applications
----------------------

.. include:: /user/back-office/system/user-management/oauth-app.rst
   :start-after: begin_oauth1
   :end-before: finish_oauth1

Add an Application
^^^^^^^^^^^^^^^^^^

To add a new OAuth application for a customer user in the back-office:

1. Navigate to **Customers > Customer Users** in the main menu.
2. Click once on the name of your selected customer user to open their details page.
3. In the **OAuth Applications** section, click **Add Application** and provide the following details in the pop-up dialog:

   * **Organization** --- If you are adding an application within the organization with *global* access, you can select which other available organization to add the application to.
   * **Application Name** --- Provide a meaningful name for the application you are adding.
   * **Active** --- Select the **Active** checkbox to activate the new application.

4. Click **Create**.

A corresponding notification is sent to the primary email address of the user, the owner of oauth application. You can change the default recipient, localization, or an email content if needed by updating the :ref:`OAuth email templates <user-guide-using-emails-create-template>` and the related :ref:`notification rule <user-guide-using-emails-notifications>` set out-of-the-box in the system configuration.

Once the application is created, you are provided with a Client ID and a Client Secret. Click on the |IcCopy| icon to copy the credentials to the clipboard.

.. image:: /user/img/getting_started/user_menu/oauth/oauth_credentials.png
   :alt: OAuth credentials

.. important:: For security reasons, the Client Secret is displayed only once -- immediately after you have created a new application. You cannot view the Client Secret anywhere in the application once you close this dialog, so make sure you save it somewhere safe so you can access it later.

You can add as many applications as you need for any of your existing organizations. All added applications are displayed in the grid, and you can filter them by name, organization, and status.

.. hint:: Use the |IcMore| **More Options** menu to edit, deactivate or delete an application.

          .. image:: /user/img/getting_started/user_menu/oauth/manage_oauth_application.png
             :alt: Manage auth applications

Use the generated Client ID and Client Secret to retrieve an access token to connect to your Oro application.

.. note:: For the aggregated information on all OAuth applications created by customer users in the back-office, refer to the general :ref:`Customer User OAuth Applications <customer-user-oauth-app>` topic.

**Related Articles**

* :ref:`Password Change Policy <user-guide--customers--customer-user-password-change-policy>`
* :ref:`Password History Policy <configuration--guide--commerce--configuration--customer-user-password-change-policy>`


.. include:: /include/include-images.rst
   :start-after: begin


.. include:: /include/include-links-user.rst
   :start-after: begin

.. toctree::

   export
   import

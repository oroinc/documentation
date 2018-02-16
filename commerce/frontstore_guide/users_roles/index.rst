.. _frontstore-guide--users-roles:

My Organization Users and Roles 
===============================

This section of the guide will provide information on how you can manage your organization users and roles, so they have the necessary level of access to the OroCommerce storefront capabilities.

.. contents:: :local:
   :depth: 2

The storefront user, role and permissions provide users with access to data and the ability to perform tasks based on their business responsibilities and the company guidelines.  The ability to do this is crucial for both the buyer and the seller, as it helps support the various operations of their businesses. OroCommerce comes out of the box with the capabilities to allow buyers and sellers to specify the exact roles and permissions each user requires in order to do their job as efficiently as possible, eliminate mistakes and save money.

Users
^^^^^

To locate users:

1. Navigate to **Account** in the :ref:`user menu <frontstore-guide--navigation-user-menu>`.
2. Click **Users** in the menu on the left.


.. image:: /frontstore_guide/img/users_roles/Users.png

On the All Users page, you can view and edit the existing users, or create new ones.

.. note:: Please note that the ability to edit your account information depends on the permissions that correspond to your role. These are defined by the administrator.

The Users table shows the following data:

* First Name
* Last Name
* Email Address
* Enabled
* Confirmed
* More Actions (View, Edit, Enable/Disable, Delete).

.. image:: /frontstore_guide/img/users_roles/UsersActions.png

Within the table you have the following :ref:`action buttons <frontstore-guide--navigation-action-buttons>` available:

1. Refresh the view table: click |IcRefresh| to update the view table.
2. Reset the view table: click |IcReset| to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.
3. Table settings: click |IcSettings| to define which columns to show in the table.
4. :ref:`Filters <frontstore-guide--navigation-filters>`.


Customer User View Page
~~~~~~~~~~~~~~~~~~~~~~~

The Customer User View Page has the name of the selected user in the page header.

.. image:: /frontstore_guide/img/users_roles/CustomerUser.png

The page has two sections:

* :ref:`Account Info <frontstore-guide--profile-account>`
* :ref:`Default Addresses <frontstore-guide--profile-default-addresses>`

Create a New User
~~~~~~~~~~~~~~~~~

To create a new user, click **+Create User** on the top right of the page, next to the view table name.

A form will emerge with the following data to provide:

* Customer
* Enabled check box
* Email Address
* Name Prefix
* First Name
* Middle Name
* Last Name
* Name Suffix
* Send Welcome Email check box
* Birthday
* Password
* Confirm Password
* Generate Password check box
* Roles: administrator/buyer check boxes


Roles
^^^^^

Roles are predefined sets of permissions. In the Roles section, you can view, edit and create new roles to define the level of permissions and access to the actions and data in OroCommerce storefront for the users of a specific role.

To locate roles:

1. Navigate to **Account** in the :ref:`user menu <frontstore-guide--navigation-user-menu>`.
2. Click **Roles** in the menu on the left.

.. image:: /frontstore_guide/img/users_roles/Roles.png

On the All Roles page, you will be able to see the list of roles available in the system. By default, the following roles are predefined and available for every customer:

* Administrator
* Buyer

The roles table shows the following data:

* Role
* Type (Predefined, Customizable)
* More Actions (View, Edit, Delete)

Within the table you have the following :ref:`actions buttons <frontstore-guide--navigation-action-buttons>` available:

1. Refresh the view table: click |IcRefresh| to update the view table.
2. Reset the view table: click |IcReset| to clear view table customization and return to default settings. Reset applies to all filters, records per page and sorting changes that you have made.
3. Table settings: click |IcSettings| to define which columns to show in the table.
4. :ref:`Filters <frontstore-guide--navigation-filters>` |IcFilter|.

Role View Page
~~~~~~~~~~~~~~

To open a specific role: click on the selected role in the view table.

To edit a specific role from its view page: click |IcPencil| **Edit Role** on the right of the page.

.. image:: /frontstore_guide/img/users_roles/BuyerEditRole.png

To delete a specific customizable role from its view page: click |IcDelete| **Delete**


.. note:: If the role is predefined, it cannot be deleted. Neither can it be deleted if it is assigned to a user/users. Reassign the assigned users to a different role to be able to delete it.


.. image:: /frontstore_guide/img/users_roles/CustomizableRoleDelete.png

Create a New User Role
~~~~~~~~~~~~~~~~~~~~~~

To create a new user role, click **+Create Customer User Role** on the top right of the page, next to the table name.

A form will emerge with the following data to provide:

* Customer
* Role Title
* Access- and permissions-related settings

.. image:: /frontstore_guide/img/users_roles/CreateRoleNew.png

The following permissions are available:

.. csv-table::
  :header: "Permission", "Level"
  :widths: 10, 20

  "
  - View
  - Create
  - Edit
  - Delete
  - Assign","

  - None
  - User (Own)
  - Department Level (Same Level)
  - Corporate (All Levels)."

With the Customer User Role you can manage the following access- and permissions-related settings and capabilities:

.. image:: /frontstore_guide/img/users_roles/AccessPermissions.png

.. csv-table::
  :header: "Field", "Entities", "Capabilities (Check boxes)"
  :widths: 10, 20, 50

  "**All**","Address, Customer User, Customer User Address, Customer User Roles, Grid (Table) View","Account Management:

  - Audit history for Customer User
  - [Quote] Enter the shipping address manually
  - [Quote] Use any shipping address from the customer address book.
  - [Quote] Use any shipping address from the customer user's address book
  - [Quote] Use the default shipping address from the customer user's address book

  Checkout:

  - Approve orders that exceed the allowable amount
  - Enter the billing address manually
  - Enter the shipping address manually
  - Use any billing address from the customer address book
  - Use any billing address from the customer user's address book
  - Use any shipping address from the customer address book
  - Use any shipping address from the customer user's address book
  - Use the default billing address from the customer user's address book
  - Use the default shipping address from the customer user's address book.

  Application:

  - Share Data View."
  "**Account Management**","Address, Customer User, Customer User Address, Customer User Role, Grid View","
  - Audit history for Customer User
  - [Quote] Enter the shipping address manually
  - [Quote] Use any shipping address from the customer address book.
  - [Quote] Use any shipping address from the customer user's address book
  - [Quote] Use the default shipping address from the customer user's address book"
  "**Shopping**","Shopping List","---"
  "**Quotes**","Quote, Request For Quote","---"
  "**Checkout**","Checkout","
  - Approve orders that exceed the allowable amount
  - Enter the billing address manually
  - Enter the shipping address manually
  - Use any billing address from the customer address book
  - Use any billing address from the customer user's address book
  - Use any shipping address from the customer address book
  - Use any shipping address from the customer user's address book
  - Use the default billing address from the customer user's address book
  - Use the default shipping address from the customer user's address book"
  "**Orders**","Invoice, Order","---"
  "**System capabilities**","---","Share Data View"

.. note:: Predefined roles cannot be edited directly. All the original data is copied so that you can save it as a new user role for your organization. All users will be moved from the original role to this new role after you click **Save**.

To apply a role to a specific user:

1. Scroll down to the bottom of the Edit Role page.
2. Enable the checkbox next to the selected user.
3. Click **Save**.

.. image:: /frontstore_guide/img/users_roles/RolesAllUsers.png

.. include:: /frontstore_guide/related_topics.rst
   :start-after: begin
 
.. include:: /user_guide/include_images.rst
   :start-after: begin



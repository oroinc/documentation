.. _bundle-docs-commerce-customer-portal-customer-bundle:

OroCustomerBundle
=================

OroCustomerBundle enables B2B-customer-related features in Oro applications and provides UI to manage B2B customers, customers groups, customer users and customer user roles in the management console and the storefront UI.

The bundle also allows management console administrators to configure B2B-customer-related settings in the system configuration UI for the entire system, individual organizations, and websites.

Bundle Responsibilities
-----------------------

Backend:

* Customer, Customer User, Customer User Addresses, Customer User Visitor CRUD
* Possibility to assign Roles to Customer Users
* Activate and deactivate Customer Users
* Send welcome email
* Password edit and automatic password generation for a new Customer User

Frontend:

* Registration
* Customer User, Customer User address CRUD
* Authorization of a user in the storefront
* Assign Customer User Roles by an Admin Customer User

Bundle Usage
------------

* `Configure Frontend Permissions (ACL) <https://github.com/oroinc/customer-portal/tree/master/src/Oro/Bundle/CustomerBundle#acl>`__

* `Configure Anonymous Customer User <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md>`__

  * `AnonymousCustomerUserToken <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#the-anonymouscustomerusertoken>`__
  * `CustomerVisitor entity <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#the-customervisitor-entity>`__
  * `Listener <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#the-listener>`__
  * `Authentication Provider <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#the-authentication-provider>`__
  * `AnonymousCustomerUserFactory <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#the-anonymouscustomeruserfactory>`__
  * `Firewall Configuration <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#firewall-configuration>`__
  * `Guest Customer User <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#guest-customer-user>`__
  * `Ownership <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#ownership>`__

* `Configure Guest Access and Permissions <https://github.com/oroinc/customer-portal/blob/master/src/Oro/Bundle/CustomerBundle/Resources/doc/anon-customer-user.md#configuring-features-and-permissions>`__










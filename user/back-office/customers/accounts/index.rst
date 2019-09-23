.. _user-guide-common-features-accounts:
.. _user-guide-accounts:

Accounts
========

Accounts originated in OroCRM as a tool to collect and process information on the customer activity of a person, group of people or business cooperating with
you. An account can aggregate details of all the customer identities, providing a 360-degree view of the customer. Customer data and business transactions are displayed on the account page, and their activities are added to the account's activity list.

Accounts display basic data for all customers and some additional data, such as orders, quotes, or opportunities related a particular customer. From the page of a selected account, you can view the calculated lifetime sales values metric based on orders placed by the customer linked to this account. Oro applications even let you merge several accounts, if, for instance, a company data audit has discovered several accounts created to represent the same business.

.. image:: /user/img/customers/accounts/account_commerce_customer.png
   :alt: A sample of a commerce channel under the account menu

When a customer is created or edited in the back-office, an account can be specified directly. When a new customer is self-registering at storefront, a new account of the same name is created automatically.

.. image:: /user/img/customers/accounts/account.png
   :alt: An example of an account for Commerce customer

In case of installation of OroCRM over an existing OroCommerce instance, new accounts are automatically created for all existing customers.

.. You can specify the strategy for account creation in **System Configuration > Integrations > CRM and Commerce**:
..  Create a single account for the entire customer hierarchy, or
.. Create a separate account for every customer regardless of their parent-child relations with other customers.
.. These options can be changed any time with customers re-related to accounts accordingly.

.. .. image:: /user/img/customers/accounts/config_commerce_integration.png    :alt: System configuration settings for CRM and Commerce

.. note:: See three short tutorials on working with accounts:

          * |creating and editing|

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/00Vz_mkbeTE" frameborder="0" allowfullscreen></iframe>

          * |managing|

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/5FEyHWr-jQY" frameborder="0" allowfullscreen></iframe>

          * |merging account records|

             .. raw:: html

                <iframe width="560" height="315" src="https://www.youtube.com/embed/x-LwwCQfwGQ" frameborder="0" allowfullscreen></iframe>

.. toctree::

   create
   manage
   merge
   import
   export
   reports

.. include:: /include/include-links.rst
   :start-after: begin

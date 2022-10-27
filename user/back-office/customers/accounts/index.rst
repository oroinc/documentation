:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-common-features-accounts:
.. _user-guide-accounts:

Manage Accounts in the Back-Office
==================================

.. hint:: This section is part of the :ref:`Customer Management <concept-guide-customers>` topic that provides a general understanding of accounts, contacts, customers, and customer hierarchy available in Oro applications.

:term:`Accounts <Account>` originated in OroCRM as a tool to collect and process the information on the customer activity of a person, group of people, or business cooperating with you. An account can aggregate details of all the customer identities, providing a 360-degree view of the customer. Customer data and business transactions are displayed on the account page, and their activities are added to the account's activity list.

Accounts display basic data for all customers and some additional data, such as orders, quotes, or opportunities related to a particular customer. From the page of a selected account, you can view the calculated lifetime sales values metric based on orders placed by the customer linked to this account. Oro applications even let you merge several accounts if, for instance, a company data audit has discovered several accounts created to represent the same business.

.. image:: /user/img/customers/accounts/account_commerce_customer.png
   :alt: A sample of a commerce channel under the account menu

An account can be specified directly when a customer is created or edited in the back-office. When a new customer is self-registering in the storefront, a new account with the same name is created automatically.

.. image:: /user/img/customers/accounts/account.png
   :alt: An example of an account for Commerce customer

In case of installation of OroCRM over an existing OroCommerce instance, new accounts are automatically created for all existing customers.

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

.. include:: /include/include-links-user.rst
   :start-after: begin
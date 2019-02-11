.. _user-guide-commerce-integration:

CRM and Commerce Integration
============================

.. contents:: :local:
    :depth: 3

Overview
--------

The integration between `OroCRM <https://www.oroinc.com/orocrm>`_ and `OroCommerce <https://oroinc.com/b2b-ecommerce/>`_ provides seamless experience of two applications working as one.

OroCommerce comes with OroCRM integration enabled out of the box. If you are using OroCRM, you can install OroCommerce on top of it and enable the integration.


Look and Feel
-------------

Oro application shares the baseline and combines the capabilities of multiple applications and packages that does not change the overall look and feel of the system. As the result of OroCommerce integration with OroCRM, the application menu is combined, displaying options from both OroCommerce and OroCRM.

.. image:: /admin_guide/img/commerce_integration/commerce_integration_ui.png
   :alt: The combined application menu when both OroCommerce and OroCRM are installed

What OroCRM Users Get After Integration
---------------------------------------

For the OroCRM users, the following aspects are changed and improved after the integration:

.. contents:: :local:
    :depth: 1

.. _user-guide-commerce-integration-accounts:

Accounts
--------

OroCommerce customers are treated the same way as OroCRM Business customers. Their data and business transactions are displayed on the Account page, and their activities are added to the Account's activity list.

:term:`Lifetime Sales Value` metric will be calculated for OroCommerce customer based on orders placed.

The following illustrates an example of an Account for Commerce customer.

.. image:: /admin_guide/img/commerce_integration/account.png
   :alt: An example of an Account for Commerce customer

A Commerce Channel section is available at the Account view. It displays basic data for OroCommerce customers and some additional data, such as orders, quotes, or opportunities that can be related to an OroCommerce customer:

.. image:: /admin_guide/img/commerce_integration/account_commerce_customer.png
   :alt: A sample of a commerce channel under the account menu

When a customer is created or edited in the management console, the Account can be specified directly.

When a new customer is self-registering in the storefront, a new Account of the same name will be created automatically.

In case of installation of OroCRM over an existing OroCommerce instance, new Accounts are automatically created for all existing customers.

You can specify the strategy for Account creation in **System Configuration > Integrations > CRM and Commerce**. There are two options:

- to create a single account for the entire customer hierarchy, or
- create a separate account for every customer regardless of their parent-child relations with other customers. 
  
These options can be changed any time with customers re-related to accounts accordingly.

.. image:: /admin_guide/img/commerce_integration/config_commerce_integration.png
   :alt: System configuration settings for CRM and Commerce

Opportunities 
-------------

You can create opportunities for your OroCommerce customers.

.. image:: /admin_guide/img/commerce_integration/create_opp.png
   :alt: The create opportunity button under the more actions menu

An OroCommerce customer can be added to the Account field when creating a new opportunity:

.. image:: /admin_guide/img/commerce_integration/opp.png
   :alt: Adding a customer to the Account field when creating a new opportunity

Track and Forecast OroCommerce Sales
------------------------------------

Opportunities can be related to OroCommerce customers. This allows sales representatives to track their ongoing deals and forecast future revenues for all sales that will be conducted via the OroCommerce website by relating the opportunity to the respective OroCommerce customer record.


.. _user-guide-commerce-integration-accounts--compare:

Compare Accounts and Contacts to Customers and Customer Users
-------------------------------------------------------------


In the applications where an integration between Commerce and CRM is configured, the Customer menu contains references to entities from both applications:

.. image:: /user_guide/img/accounts/customers_menu.png
   :alt: The entities under the customer menu that were combined

*Account* and *Contact* come from CRM, while *Customers* and *Customer Users* come from Commerce.

An :ref:`account <user-guide-accounts>` and a :ref:`customer <user-guide-common-features-customers>` represent a company or a division. A :ref:`contact <user-guide-contacts>` and a customer user represent a real person who acts on behalf of the company.

This has been implemented to track this hierarchy independently if CRM or Commerce are installed separately. When both are integrated, additional options to source and retrieve the data become available. You can use the modules separately; for example, if employees work with OroCRM, they can refer to accounts and contacts while those working with OroCommerce can work with Customers and Customer Users. In both cases, they have the ability to track information about companies and people.

Even though the information in Account, Contact, and Customer may seem similar, there is a significant difference that shows the advantage of using CRM and Commerce together.

An account aggregates data from all channels (CRM, Commerce, or others) and all sources (e.g., Contacts, Business Customers, Commerce Customers) providing a 360-degree view of all the information about the company. All interactions with a particular customer are displayed on a single page where you can also track sales though opportunities.

A contact is a CRM concept that is used to associate a person with a specific account. It contains a contact's personal information, their position in the company, address information, and other related data.

The main difference between a contact and a customer user is that a contact represents a person who may not use the Commerce segment (for example, the CEO of a company who does not buy anything personally).

Another important concept is a Customer. Out-of-the-box, OroCommerce supports three types of customers:

 * *OroCommerce Customers* (from Commerce package) are used to represent OroCommerce-specific data, such as Commerce Customers, Commerce Customer Users, Shopping Lists, RFQs, Quotes, Orders, and Opportunities.

 * *Business Customers* (from CRM package) are used to represent Business Customers who are not Commerce Customers and also CRM-specific data, such as B2B Customers, Contacts, Leads, Opportunities.

 * *Magento Customers* (from CRM package) are used to represent customers related to a Magento store.

Additionally, you can associate :term:`Lifetime Sales Value` with a customer and track financial statistics related to a specific customer or account.

Below is an illustration of the account hierarchy where CRM-related concepts are marked grey, and Commerce-related concepts are marked white.

.. image:: /user_guide/img/accounts/account_customer_schema.png
   :width: 50%
   :alt: An illustration of the Account hierarchy

For more details on the purpose of using each entity separately, check the :ref:`Understanding Accounts, Channels, and Customers <doc-customer-management-overview>` topic.


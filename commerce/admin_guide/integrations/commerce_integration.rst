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

Oro application share the baseline and combining capabilities of multiple applications and packages does not change the overall look and feel of the system. As the result of OroCommerce integration with OroCRM, the application menu is combined, displaying options from both OroCommerce and OroCRM.

.. image:: /user_guide/system/img/commerce_integration/commerce_integration_ui.png

What OroCRM Users Get After Integration
---------------------------------------

For the OroCRM users, the following aspects are changed and improved after the integration:

.. contents:: :local:
    :depth: 1

.. _user-guide-commerce-integration-accounts:

Accounts
--------

OroCommerce customers are treated the same way as OroCRM Business customers. Their data and business transactions are displayed on the Account page, and their activities are added to the Account's activity list.

Lifetime sales values metric will be calculated for OroCommerce customer based on orders placed.

The following illustrates an example of an Account for Commerce customer.

.. image:: /user_guide/system/img/commerce_integration/account.png

A Commerce Channel section is available at the Account view. It displays basic data for OroCommerce customers and some additional data, such as orders, quotes, or opportunities that can be related to an OroCommerce customer:

.. image:: /user_guide/system/img/commerce_integration/account_commerce_customer.png

When a customer is created or edited at backend, the Account can be specified directly.

When a new customer is self-registering at frontend, a new Account of the same name will be created automatically.

In case of installation of OroCRM over an existing OroCommerce instance, new Accounts are automatically created for all existing customers.

You can specify the strategy for Account creation in **System Configuration > Integrations > CRM and Commerce**. There are two options:

- to create a single account for the entire customer hierarchy, or
- create a separate account for every customer regardless of their parent-child relations with other customers. 
  
These options can be changed any time with customers re-related to accounts accordingly.

.. image:: /user_guide/system/img/commerce_integration/config_commerce_integration.png

Opportunities 
-------------

You can create opportunities for your OroCommerce customers.

.. image:: /user_guide/system/img/commerce_integration/create_opp.png

An OroCommerce customer can be added to the Account field when creating a new opportunity:

.. image:: /user_guide/system/img/commerce_integration/opp.png

Track and Forecast OroCommerce Sales
------------------------------------

Opportunities can be related to OroCommerce customers. This allows sales representatives to track their ongoing deals and forecast future revenues for all sales that will be conducted via the OroCommerce website by relating the opportunity to the respective OroCommerce customer record.

.. What OroCommerce Users Get After Integration
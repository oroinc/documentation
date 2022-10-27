:oro_documentation_types: OroCRM, OroCommerce

.. _user-guide-commerce-integration:
.. _user-guide-commerce-integration-accounts:

Configure Global CRM and Commerce Settings
==========================================

The integration between OroCRM and OroCommerce provides seamless experience of two applications working as one.

OroCommerce comes with OroCRM integration enabled out of the box. If you are using OroCRM, you can install OroCommerce on top of it and enable the integration.

OroCommerce customers are treated the same way as OroCRM Business customers. Their data and business transactions are displayed on the Account page, and their activities are added to the account's activity list. Lifetime sales values metric is calculated for OroCommerce customers based on placed orders.

When a customer is created or edited at backend, the account can be specified directly. When a new customer is self-registering in the storefront, a new account of the same name will be created automatically.

In case of installation of OroCRM over an existing OroCommerce instance, new accounts are automatically created for all existing customers.

You can specify the strategy for account creation in **System Configuration > Integrations > CRM and Commerce**. There are two options:

- to create a single account for the entire customer hierarchy, or
- create a separate account for every customer regardless of their parent-child relations with other customers. 
  
These options can be changed any time with customers re-related to accounts accordingly.

.. image:: /user/img/system/config_system/config_commerce_integration.png
   :alt: System configuration settings for CRM and Commerce

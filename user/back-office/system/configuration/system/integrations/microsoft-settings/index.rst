:oro_documentation_types: OroCRM, OroCommerce, Extension

.. _configuration-integrations-microsoft:

Configure Global Microsoft Settings
===================================

The Enterprise Edition of Oro applications support the integration with Microsoft features through the |Oro-Microsoft 365 Integration| extension. With its help, you can configure Microsoft 365 single sign-on, calendar, and task synchronization.

The Community Edition has Microsoft OAuth2 with Microsoft for email sync via configured Azure Active Directory Application  available out-of-the-box. The |Oro-Microsoft 365 Integration| extension is not available for the Community Edition.

.. note:: These settings can be configured globally, :ref:`per organization <organization-configuration-microsoft>`, and :ref:`user <user-configuration-microsoft-settings>`.

To configure global Microsoft integration-related settings in the back-office:

1. Navigate to **System > Configuration** in the main menu.
2. In the panel to the left, click **System Configuration > Integrations > Microsoft Settings**.

.. image:: /user/img/system/config_system/microsoft-settings-global.png
   :alt: Global Microsoft settings

Click the relevant topic below to start configuring the required setting:

* :ref:`Microsoft 365 OAuth (Azure Active Directory Application) <user-guide-integrations-azure-oauth>`
* :ref:`Microsoft 365 Single Sign-On <user-guide-integrations-microsoft-single-sign-on>`
* :ref:`Microsoft 365 Integrations <user-guide-integrations-microsoft>`

.. toctree::
   :hidden:

   Microsoft 365 OAuth (Azure Active Directory Application) <microsoft-oauth-azure>
   Microsoft 365 Single Sign-On <microsoft-single-sign-on>
   Microsoft 365 Integrations <microsoft-365-integrations>

.. include:: /include/include-links-user.rst
   :start-after: begin








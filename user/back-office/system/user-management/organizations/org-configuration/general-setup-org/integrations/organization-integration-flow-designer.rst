.. _organization-integration-flow-designer-settings:

Configure Integration Flow Designer Settings per Organization
=============================================================

.. note:: This feature is available in the OroCommerce Enterprise Edition.

Integration Flow Designer embeds Activepieces, a third-party automation platform, in the OroCommerce back-office. By default, an organization uses the :ref:`global Integration Flow Designer settings <admin-configuration-integration-flow-designer-settings>`. You can override the global values for a particular organization.

Configure the Settings
----------------------

To configure Integration Flow Designer for an organization:

1. Navigate to **System > User Management > Organizations** in the main menu.
2. For the necessary organization, hover over the |IcMore| **More Options** menu at the end of the row and click |IcConfig| to start editing the configuration.
3. In the menu to the left, click **System Configuration > Integrations > Integration Flow Designer**.
4. In the **Integration Flow Designer Settings** section, clear the **Use System** checkbox next to the setting that you want to change.
5. Configure the setting.
6. Click **Save settings**.

.. image:: /user/img/system/user_management/org_configuration/integration-flow-designer/integration-flow-designer-org.png
   :alt: Integration Flow Designer settings in the organization configuration

To restore the global value, select the **Use System** checkbox again.

Settings
--------

The following settings are available:

* **Enable Integration Flow Designer** --- Select the checkbox to enable the feature for the organization.
* **Activepieces User ID (System Flows)** --- Contains the ID of the Activepieces user that owns the :ref:`system flows <user-guide--integrations--activepieces--system-flows>` of the organization. For more information, see `System Flows in Different Organizations`_.
* **Enable Connection Autocreation For Users** --- Select the checkbox to let the application create the connection from Activepieces to OroCommerce for each user of the organization automatically. For more information, see `Connection Autocreation for Users`_.

Connection Autocreation for Users
---------------------------------

Users create their own :ref:`user flows <user-guide-my-integrations>` in **My Integrations**. To work with OroCommerce data, each user needs an Activepieces user and a connection from Activepieces to OroCommerce.

The application creates an Activepieces user for each user of the organization automatically the first time they open **My Integrations**. This does not depend on the **Enable Connection Autocreation For Users** setting.

When the setting is enabled for the organization, the application also creates the connection from Activepieces to OroCommerce at that time. The application does the following:

1. Creates an :ref:`OAuth application <oauth-applications>` in OroCommerce on behalf of the user.
2. Uses the credentials of the OAuth application to create a connection from Activepieces to OroCommerce.

As a result, the flows of the user run on behalf of this user and with the permissions of this user. A flow cannot access any data that the user is not permitted to access.

To review the OAuth applications that the application creates, navigate to **System > User Management > OAuth Applications** in the main menu.

System Flows in Different Organizations
---------------------------------------

Activepieces does not have organizations. The application separates system flows by the Activepieces user that owns them.

If different organizations use different Activepieces users for system flows, the users of each organization see only the system flows of their own Activepieces user.

**Related Articles**

* :ref:`Integration with Activepieces <user-guide--integrations--activepieces>`
* :ref:`Integration Flows Concept Guide <concept-guide--integration-flows>`
* :ref:`My Integrations <user-guide-my-integrations>`
* :ref:`Configure Global Integration Flow Designer Settings <admin-configuration-integration-flow-designer-settings>`
* :ref:`Configure OAuth Applications for Users <oauth-applications>`
* :ref:`Webhooks <back-office--integrations--webhooks>`
* :ref:`Configure Organization System Settings <doc-organization-configuration>`

.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

.. include:: /include/include-links-user.rst
   :start-after: begin
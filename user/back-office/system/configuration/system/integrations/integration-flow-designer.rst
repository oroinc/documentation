.. _admin-configuration-integration-flow-designer-settings:

Configure Global Integration Flow Designer Settings
===================================================

.. note:: This feature is available in the OroCommerce Enterprise Edition.

Integration Flow Designer embeds Activepieces, a third-party automation platform, in the OroCommerce back-office. Integration Flow Designer is disabled by default. Enable it in the system configuration to build and manage :ref:`integration flows <user-guide--integrations--activepieces>`.

You can configure the settings globally, as described in this topic, and :ref:`per organization <organization-integration-flow-designer-settings>`.

Enable Integration Flow Designer
--------------------------------

To enable Integration Flow Designer globally:

1. Navigate to **System > Configuration** in the main menu.
2. In the menu to the left, click **System Configuration > Integrations > Integration Flow Designer**.
3. In the **Integration Flow Designer Settings** section, clear the **Use Default** checkbox next to **Enable Integration Flow Designer**.
4. Select the **Enable Integration Flow Designer** checkbox.
5. Click **Save settings**.

.. image:: /user/img/system/integrations/activepieces/integration-flow-designer-global.png
   :alt: Integration Flow Designer settings in the global system configuration

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

Settings
--------

The following settings are available:

* **Enable Integration Flow Designer** --- Select the checkbox to enable the feature.
* **Activepieces User ID (System Flows)** --- Contains the ID of the Activepieces user that owns the :ref:`system flows <user-guide--integrations--activepieces--system-flows>`. The application fills in this value automatically when the setup command runs. The setup command creates the user and a connection from this user to OroCommerce. Do not change the value manually.
* **Enable Connection Autocreation For Users** --- Select the checkbox to let the application create the connection from Activepieces to OroCommerce for each user automatically. For more information, see `Connection Autocreation for Users`_.

Connection Autocreation for Users
---------------------------------

Users create their own :ref:`user flows <user-guide-my-integrations>` in **My Integrations**. To work with OroCommerce data, each user needs an Activepieces user and a connection from Activepieces to OroCommerce.

The application creates an Activepieces user for each user automatically the first time they open **My Integrations**. This does not depend on the **Enable Connection Autocreation For Users** setting.

When the setting is enabled, the application also creates the connection from Activepieces to OroCommerce at that time. The application does the following:

1. Creates an :ref:`OAuth application <oauth-applications>` in OroCommerce on behalf of the user.
2. Uses the credentials of the OAuth application to create a connection from Activepieces to OroCommerce.

As a result, the flows of the user run on behalf of this user and with the permissions of this user. A flow cannot access any data that the user is not permitted to access.

To review the OAuth applications that the application creates, navigate to **System > User Management > OAuth Applications** in the main menu.

**Related Articles**

* :ref:`Integration with Activepieces <user-guide--integrations--activepieces>`
* :ref:`Integration Flows Concept Guide <concept-guide--integration-flows>`
* :ref:`My Integrations <user-guide-my-integrations>`
* :ref:`Configure Integration Flow Designer Settings per Organization <organization-integration-flow-designer-settings>`
* :ref:`Configure OAuth Applications for Users <oauth-applications>`
* :ref:`Webhooks <back-office--integrations--webhooks>`
* :ref:`Edit a Role <user-guide-user-management-permissions-roles--edit>`

.. include:: /include/include-links-user.rst
   :start-after: begin
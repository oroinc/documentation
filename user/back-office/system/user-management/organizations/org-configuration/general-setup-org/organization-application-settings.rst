:oro_documentation_types: OroCRM, OroCommerce

.. _admin-configuration-application-org:

Application Settings per Organization
-------------------------------------

In this section, you can configure the Web API feature both for the back-office and storefront. By default, the API feature is disabled.

To change the default settings per organization:

1. Navigate to **System > User Management > Organization** in the main menu.

2. For the necessary organization, click the |IcMore| **More Options** menu at the end of the row, and then click the |IcConfig| **Configure** icon to start editing the configuration.

3. Select **System Configuration > General Setup > Application Settings** in the menu to the left.

   .. note::
      For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

4. Clear the **Use System** check box to change the system-wide setting.

5. In the **Web API** section, select the required options:

   * **Enable API** --- enables the back-office API feature for your application.
   * **Enable Storefront API** --- enables the storefront API feature for your application.

   .. note:: The back-office API feature can be toggled on the :ref:`global <admin-configuration-application>` and organization levels, while the storefront API configuration is available on three levels - globally, per organization, and per :ref:`website <admin-configuration-application-website>`.

6. Click **Save Settings**.

.. include:: /include/include-images.rst
   :start-after: begin
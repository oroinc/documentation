.. _admin-configuration-orders-ai-smart-order-settings:

Configure Global AI Smart Order Settings
========================================

.. hint:: Please |contact our support team| to learn more about OroCommerce AI features, discuss how they can meet your business needs, and get started with implementation.

.. note:: This feature is available as of OroCommerce version 6.0.7.

AI Smart Order is available for OroCommerce Enterprise and is aimed at simplifying the process of handling purchase orders. With the AI Smart Order dashboard widget, you can have emailed PDFs and other document types converted directly into draft orders in your OroCommerce application.

.. image:: /user/img/concept-guides/ai/ai-smart-order-config-global.png
   :alt: AI Smart Order configuration settings and dashboard widget

To enable this feature globally:

1. Navigate to **System > Configuration** in the main menu.
2. Select **Commerce > Orders > AI Smart Order** in the menu to the left.

.. note:: For faster navigation between the configuration menu sections, use :ref:`Quick Search <user-guide--system-configuration--quick-search>`.

3. To manage any of the available options, clear the **Use Default** next to them first.
4. In the **AI Smart Order** section, select the checkbox next to *Enable AI Smart Order* to enable the feature.
5. Select the **Enable Async Processing** checkbox to process purchase orders asynchronously via the message queue, improving performance and accuracy for large or complex orders.
6. Information for the **Smart Order API Key** and **Smart Order URL** fields is provided by the Oro Team upon request during the setup of the Smart Order microservice.
7. If you have a |Customer Part Number| extension installed, select the **Use CPN in Smart Order** check box to allow customer part numbers to be used and managed for line items during :ref:`smart order draft creation <user-guide-dashboards-widgets>`. Please make sure that the **Customer Part Number** :ref:`feature is enabled <sys--commerce--product--customer-settings>` under **System > Commerce > Product > Customer Settings**.

8. Click **Save Settings**.

.. hint:: You can also enable Smart Order :ref:`per organization <organization-ai-smart-order-settings>`.

.. include:: /include/include-links-user.rst
   :start-after: begin

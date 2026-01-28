.. _admin-configuration-orders-ai-smart-order-settings:

Configure Global AI Smart Order Settings
========================================

.. note:: Please |contact our support team| to learn more about OroCommerce AI features, discuss how they can meet your business needs, and get started with implementation.

.. hint:: This section is part of the :ref:`AI and Automation Concept Guide <concept-guide--ai>` topic that provides an overview of OroCommerce's AI-powered tools AI Smart Agent and AI Smart Order.

AI Smart Order is available for OroCommerce Enterprise and is aimed at simplifying the process of handling purchase orders. With AI Smart Order feature that includes a :ref:`dashboard widget <user-guide-dashboards-widgets>` and :ref:`an email automation <user-guide--sales--orders--create--from-ai-smart-order>`, you can have emailed PDFs and other document types converted directly into draft orders in your OroCommerce application.

.. image:: /user/img/system/config_commerce/order/ai-smart-order-config-global.png
   :alt: AI Smart Order configuration settings and dashboard widget

To enable this feature globally:

1. Navigate to **System > Configuration** in the main menu.
2. In the menu to the left, click **System Configuration > Integrations > AI Smart Order**.

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
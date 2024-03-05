:title: Integrations Implementation and Configuration in Oro Applications

.. meta::
   :description: Practical manuals on integrating data from external systems to the Oro applications for the backend developers

.. _dev-integrations:

Integrations
============

Application integration is a layer that allows you to migrate your data or enable communication between two systems.

The topics below provide in-depth information about integrations' concepts and components to help you start creating your integrations.

Choose the model of transferring data to build your integration flow:

.. toctree::
   :maxdepth: 1

   integration-config/index
   import-export/index
   api-based
   initial-data-load
   notification-alerts

Comparison of Integration Approaches
------------------------------------

The selection of the integration approach relies on the particular needs of the integrated systems, along with factors including capacity of data, real-time needs, and available technical knowledge.

.. _dev-integrations--integrationbundle-based:

OroIntegrationBundle-Based
^^^^^^^^^^^^^^^^^^^^^^^^^^

This approach provides a means to achieve seamless integration with third-party systems. This is the only way to integrate payment and shipping methods.

Native application extensions provide a seamless user experience, as they are integrated directly into the existing application. Integration can be fully configured and controlled within the Oro application's user interface. In many cases, you can achieve real-time interactions and data synchronization. This integration can also handle system events internally and immediately initiate data synchronization upon occurrence.

Extending a native application allows you to leverage existing features and functionalities and helps you benefit from the security features and user access control.

.. hint:: **Things to Consider**: Developing native extensions can be time-consuming and may require specialized knowledge. Regular updates and maintenance are necessary to keep the extension aligned with the application's updates.

Import/Export-Based
^^^^^^^^^^^^^^^^^^^

The Import/Export-based approach allows you to integrate third-party systems based on the file-exchange pattern. It makes integrating systems with different technologies and data formats easier. You only need to know a little about each system: the export format, import format, and data transformation logic. Import-export integration is typically easy to set up and maintain, which makes it accessible to non-Oro developers. You can also schedule imports and exports to automate data transfer.

.. hint::  **Things to Consider:**

           * Import/Export processes may introduce latency, especially when dealing with large datasets or frequent updates.
           * Data loss or duplication can occur if the import/export process is not managed carefully.
           * Complex data mapping and transformation may require additional tools or custom development.
           * Not all entities have import-export functionality, therefore, custom development will be necessary for those entities.
           * Scheduled imports should be implemented manually using custom scripts or through the tools available in the operating system.
           * It is impossible to establish real-time data exchange using Import-Export.

API-Based
^^^^^^^^^

API-based integrations are comparable to import/export based ones regarding data exchange, making it more straightforward to integrate systems with varying technologies and data formats. Extensive knowledge of each system is not required as long as you are familiar with the API standard and data structure.

When using an API, developers can choose a middleware approach. This simplifies the integration of different systems, protocols, and technologies by offering a smooth interface for application communication. This helps facilitate inter-application communication and enables the coordination and exchange of data. Middleware can also distribute workloads and horizontally scale applications to handle increased data amounts.

APIs typically follow industry-standard formats, making data exchange between systems consistent and reliable, and they support authentication and authorization mechanisms, ensuring secure data transfer. As your systems grow, API-based integrations are often scalable, accommodating increased data volume and system complexity.

.. hint:: **Things to Consider:**

          * Relying on APIs assumes that the systems you want to integrate with provide suitable APIs. Not all systems have well-documented or open APIs.
          * Integrating multiple APIs can become complex, especially if each API follows different standards and data formats.
          * Some APIs, especially those provided by third-party services, may come with usage costs, potentially increasing the overall cost of integration.
          * API-based integrations may create a level of dependence on external services or third-party providers, which can be a concern if they experience downtime or service disruptions.
          * It is impossible to establish real-time data exchange using API-based integration and middleware due to the lack of a data change notification mechanism.
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

The right integration approach depends on the needs of the integrated systems and on factors such as data capacity, real-time needs, and available technical knowledge.

.. _dev-integrations--integrationbundle-based:

OroIntegrationBundle-Based
^^^^^^^^^^^^^^^^^^^^^^^^^^

This approach integrates seamlessly with third-party systems. It is the only way to integrate payment and shipping methods.

Because native extensions are built directly into the existing application, they provide a seamless user experience. You configure and control the integration entirely within the Oro application's user interface.

In many cases, you can achieve real-time interactions and data synchronization. The integration can also handle system events internally and start data synchronization as soon as they occur.

Extending a native application lets you reuse existing features and functionality and benefit from the built-in security features and user access control.

.. hint:: **Things to Consider**: Developing native extensions can be time-consuming and may require specialized knowledge. Regular updates and maintenance are necessary to keep the extension aligned with the application's updates.

Import/Export-Based
^^^^^^^^^^^^^^^^^^^

The Import/Export-based approach integrates third-party systems using the file-exchange pattern. This makes it easier to integrate systems with different technologies and data formats.

You only need to know a little about each system: the export format, import format, and data transformation logic. As a result, developers who are not familiar with OroCommerce can configure and maintain import-export integrations.

You can also schedule imports and exports to automate data transfer.

.. hint::  **Things to Consider:**

           * Import/Export processes may introduce latency, especially when dealing with large datasets or frequent updates.
           * Data loss or duplication can occur if the import/export process is not managed carefully.
           * Complex data mapping and transformation may require additional tools or custom development.
           * Not all entities have import-export functionality, therefore, custom development will be necessary for those entities.
           * Scheduled imports should be implemented manually using custom scripts or through the tools available in the operating system.
           * It is impossible to establish real-time data exchange using Import-Export.

API-Based
^^^^^^^^^

For data exchange, API-based integrations are comparable to import/export ones and make it more straightforward to integrate systems with varying technologies and data formats. You do not need extensive knowledge of each system, only familiarity with the API standard and data structure.

With an API, developers can choose a middleware approach. Middleware simplifies the integration of different systems, protocols, and technologies by offering a smooth interface for application communication. It coordinates and exchanges data between applications, and it can distribute workloads and scale applications horizontally to handle larger data amounts.

APIs typically follow industry-standard formats, which makes data exchange between systems consistent and reliable. They also support authentication and authorization mechanisms for secure data transfer. API-based integrations are often scalable, so they accommodate increased data volume and system complexity as your systems grow.

.. hint:: **Things to Consider:**

          * Relying on APIs assumes that the systems you want to integrate with provide suitable APIs. Not all systems have well-documented or open APIs.
          * Integrating multiple APIs can become complex, especially if each API follows different standards and data formats.
          * Some APIs, especially those provided by third-party services, may come with usage costs, potentially increasing the overall cost of integration.
          * API-based integrations may create a level of dependence on external services or third-party providers, which can be a concern if they experience downtime or service disruptions.
          * It is impossible to establish real-time data exchange using API-based integration and middleware due to the lack of a data change notification mechanism.
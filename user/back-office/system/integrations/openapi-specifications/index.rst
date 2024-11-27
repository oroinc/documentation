.. _admin-openapi-specifications:

OpenAPI Specifications Management
=================================

.. note:: This feature is available as of OroCommerce version 6.0.2.

This section describes how to create and manage OpenAPI specifications for different types of REST APIs provided by Oro applications.

Create an OpenAPI Specification
-------------------------------

In order to create a new OpenAPI specification:

1. Navigate to **System > Integrations > OpenAPI Specifications** in the main menu.
2. Click **Request Specification**.
3. Provide the following details:

   * **Name** --- The name of the OpenAPI specification.
   * **Public Slug** --- The URL slug for downloading the OpenAPI specification without authorization. When the slug is not specified the unauthorized access is not permitted.
   * **Requested By** --- A user who requested the OpenAPI specification.
   * **Format** --- The format in which the OpenAPI specification should be created, e.g. JSON or YAML.
   * **API Type (View)** --- The API type for which the OpenAPI specification should be created, e.g. "Back-Office API" or "Storefront API".
   * **Entities** --- The list of entities for which the OpenAPI specification should be created. When no entity is specified, the specification is created for all entities.
   * **Server URLs** --- The list of server URLs that should be added to the OpenAPI specification.

      .. image:: /user/img/system/integrations/openapi/create.png
         :alt: A sample of an OpenAPI specification request

4. Click **Save and Close**.

Once saved, a request to create the specification is sent and the specification is displayed on the page of all OpenAPI specifications under **System > Integrations > OpenAPI Specifications**.

.. image:: /user/img/system/integrations/openapi/grid.png
   :alt: A list of all OpenAPI specifications

You can download |IcDownload|, renew |Reset-SVG|, view |IcView|, edit |IcEdit|, clone |IcClone|, and delete |Trash-SVG| specifications using the corresponding action icons.

Once you have finished the configuration of a specification and want to make it read-only, click Publish |IcPublish|. Also, when the public slug is provided, a published specification will be available for unauthorized users to download.


.. include:: /include/include-images.rst
   :start-after: begin

.. include:: /include/include-svg.rst
   :start-after: begin

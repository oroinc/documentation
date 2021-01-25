.. _web-services-api--client-requirements:

Web API Client Requirements
===========================

The only requirement for the client that will send JSON:API requests to the server is that it **must** specify
the ``application/vnd.api+json`` media type in **Accept** and/or **Content-Type** headers.

The GET, OPTIONS and HEAD requests should have the **Accept** header.

The POST, PATCH and DELETE requests must have the **Content-Type** header and should have the **Accept** header.

The JSON:API media type for the **Content-Type** header must not contain any media type parameters.

The JSON:API media type for the **Accept** header must not contain any media type parameters,
except |RFC 7231: quality values|.

**Example of a Valid GET request**

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Accept: application/vnd.api+json

**Example of Valid POST requests**

.. code-block:: http
    :linenos:

    POST /api/users HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

.. code-block:: http
    :linenos:

    POST /api/users HTTP/1.1
    Content-Type: application/vnd.api+json

At the same time, it **must** ignore any media type parameters received in the **Content-Type** header of the response.

**Example of a Response**

*Request*

.. code-block:: http
    :linenos:

    POST /api/users HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

*Response*

.. code-block:: http
    :linenos:

    HTTP/1.1 201 Created
    Content-Type: application/vnd.api+json

    {"data": [
      {
        "type": "accounts",
        "id": "1",
        "attributes": {
          "name": "Life Plan Counseling",
        },
        "relationships": {
        }
      }
    ]}


Requests with the non JSON:API media type value will be perceived as a plain API request,
so the response data will have a plain format rather than JSON:API.

**Example of Non JSON:API Media Type**

*Request*

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Accept: application/json

*Response*

.. code-block:: json
    :linenos:

    [
      {
        "id": 1,
        "name": "Life Plan Counseling",
        "contacts": [
          1
        ]
      },
    ]


For more information about the API client requirements, see |JSON:API: Client Responsibilities|.


.. include:: /include/include-links-dev.rst
   :start-after: begin

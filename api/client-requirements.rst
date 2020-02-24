.. _web-services-api--client-requirements:

Web API Client Requirements
===========================

The only requirement for the client that will send API requests to the server is that it **must** have the **Content-Type** header that looks as follows: ``Content-Type: application/vnd.api+json``.

**Content-Type** must not contain any media type parameters.

**Example of a Valid Content-Type**

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Content-Type: application/vnd.api+json


At the same time, it **must** ignore any media type parameters received in the **Content-Type** header of the response.

**Example of Ignoring Media Type in Response**

*Request*

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Host: localhost.com
    Content-Type: application/vnd.api+json

*Response*

.. code-block:: json
    :linenos:

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


Requests with the invalid **Content-Type** value in the header will be perceived as a plain request, so the response data
will have a plain format rather than JSON:API.

**Example of Invalid Content-Type**

*Request*

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Host: localhost.com
    Content-Type: application/json

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


For more information about the API client requirements, see |JSON Specifications|.


.. include:: /include/include-links-dev.rst
   :start-after: begin

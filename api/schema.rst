.. _web-services-api--schema:

Schema
======

All API access is over HTTP or HTTPS (depending on a server configuration) and is accessed from the ``http(s)://<hostname_of_your_oro_application>/api/<resource_name>``
All data is sent and received as JSON.

A typical request can be performed via curl or JSON sandbox.

**Curl Example**

.. code-block:: http
    :linenos:

    GET /api/users/1 HTTP/1.1

    curl -X "GET" -H "Accept: application/vnd.api+json"
         -H "Authorization: Bearer ..."
    http://localhost.com/api/users/1


Please note that to simplify the representation of request examples in the document, a short format will be used, e.g.:

.. code-block:: http
    :linenos:

    GET /api/users/1 HTTP/1.1
    Accept: application/vnd.api+json


*Typical response header*

.. code-block:: http
    :linenos:

    HTTP/1.1 200 OK
    Content-Type: application/vnd.api+json
    Date: Mon, 19 Sep 2016 17:52:34 GMT
    Connection: keep-alive
    Status: 200 OK
    Content-Length: 5279
    Cache-Control: max-age=0, no-store


*Typical response body*

.. code-block:: json
    :linenos:

    { "data": {
        "type": "users",
        "id": "1",
        "attributes": {
            "title": null,
            "email": "admin@local.com",
            "firstName": "John",
            "enabled": true,
            "lastLogin": "2016-09-19T11:01:31Z",
        },
        "relationships": {
            "owner": { "data": { "type": "businessunits", "id": "1"} },
            "businessUnits": { "data": [ { "type": "businessunits", "id": "1" } ] },
        }
    }}

Blank fields are included as *null* instead of being omitted.

Attributes or sub resources that are restricted are included as *null* as well.

All timestamps are returned in ISO 8601 format: *YYYY-MM-DDTHH:MM:SSZ*.


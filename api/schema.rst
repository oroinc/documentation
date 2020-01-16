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

    curl -X "GET" -H "Content-Type: application/vnd.api+json"
         -H "Authorization: WSSE profile='UsernameToken'"
         -H "X-WSSE: UsernameToken Username='admin',
             PasswordDigest='D5AjIiPf7edQX2EX8hLwtB3XhQY=',
             Created='2016-09-19T20:00:00+03:00',
             Nonce='N2hlMDc3TGcrVU53bGprNlQ0YXliLy9PSEFNPQ=='"
    http://localhost.com/api/users/1


Please note that to simplify the representation of request examples in the document, a short format will be used, e.g.:

.. code-block:: http
    :linenos:

    GET /api/users/1 HTTP/1.1
    Host: localhost.com
    Content-Type: application/vnd.api+json
    Authorization: WSSE profile='UsernameToken'
    X-WSSE: UsernameToken Username='...', PasswordDigest='...', Created='...', Nonce='...'


*Typical response header*

.. code-block:: http
    :linenos:

    HTTP/1.1 200 OK
    Server: Apache/2.4.18 (Unix) PHP/5.5.38
    Date: Mon, 19 Sep 2016 17:52:34 GMT
    Content-Type: application/vnd.api+json
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


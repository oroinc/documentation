Web Services API
================

Overview
========

An application programming interface (**API**) is a software interface which is designed for use by other software. Whereas a normal software
program is used by a (human) computer-user, an API is a software program which is used by another software program.

The Representational State Transfer (**REST**) style is an abstraction of the architectural elements within a distributed hypermedia system.
REST ignores the details of component implementation and protocol syntax in order to focus on the roles of components, the constraints upon their
interaction with other components, and their interpretation of significant data elements. It encompasses the fundamental constraints
upon components, connectors, and data that define the basis of the Web architecture, and thus the essence of its behavior as a network-based
application.

**JSON API** is a specification for how a client should request that resources be fetched or modified, and how a server should respond to
those requests. It is designed to minimize both the number of requests and the amount of data transmitted between clients and servers. This
efficiency is achieved without compromising readability, flexibility, or discoverability.

So, here and below under the ``API`` terminology we will mean the ``REST JSON API`` that provides programmatic access to read and write
data. The request data is expected to be in JSON format. Responses are available in JSON as well.

Quick Start
===========

To start use the Api, user should to do some steps.

-  Be sure that appplication installed correctly;
-  Generate API Token for user. To do this, go to view page of your user
   (http://localhost.com/user/profile/view) and click on
   ``Generate Key`` button.

After that, it will be possible to execute the API requests with sandbox, Curl command, any other REST client or use API with own application.

API sandbox
-----------

API sandbox page allow to perform API requests directly from the Oro application instance.

How to use the sandbox.
~~~~~~~~~~~~~~~~~~~~~~~

The sandbox page available by http://localhost.com/api/doc/ url.

By default, this page represent the list of plain API resources. The plain means the old API implementation that is based on
`FOSRestBundle <http://symfony.com/doc/current/bundles/FOSRestBundle/index.html>`__.

To switch to JSON API sandbox go to the http://localhost.com/api/doc/rest\_json\_api page, or click on ``JSON.API`` link at the top of page.

By default, the collapsed list of available resources will be listed.

Each resource block contains a set of available actions for that resource grouped by request link.

By clicking on certain action, the documentation and ``Sandbox`` tabs will be shown.

The sandbox tab contains form for this action which can be used to perform API queries.

Retrieving a single record for particular resource with JSON API.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform the GET action for any entity(resource), find this API resource at
http://localhost.com/api/doc/rest\_json\_api page and open the actions block.

After that, click on ``GET`` action for the ``/api/your_resource/{id}`` route.

By clicking on ``Sanbox`` link, the request form will be opened.
As you want to get one record, you should specify the record id at the ``id`` field.

After that, click on ``Try!`` button to send the request to server.

After the response, you should see the ``Request URL``, ``Response Headers``, ``Response Body`` and ``Curl Command Line`` blocks.

The ``Request URL`` block will contain request URL that was sent to server.

The ``Response Headers`` block will contain the status code of servers response. In case if request was sucsessful, it should contain **200 OK** string.
To see tht list of headers that server sent during the responce, click on ``Expand`` link of this link.

If request was successful, at the ``Response Body`` block you should see the output data of the request. At the given case, it will be the entity
data in JSON format. More info about this format you can find `here <http://jsonapi.org/format/>`__.

The ``Curl Command Line`` block will contain example of the CLI command to perform request with `Curl <https://curl.haxx.se/>`__.
This command may help  to emulate the real request to the API.

.. hint::

    During the Curl request, please make sure your ``X-WSSE`` headers is up to date for every request.

Performing update for particular resource with JSON API.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To test update process for particular resource, find this API resource at http://localhost.com/api/doc/rest\_json\_api page and open the
actions block for this resource.

After that, click on ``PATCH`` action for the ``/api/your_resource/{id}`` route. And after that to the sanbox link.

At ``id`` field ofo sandbox you should specify the entity id you want to edit.

The ``Content`` text area contain a set of instructions describing how a resource currently residing on the server should be modified to produce
a new version.

For example, if you want to change the ``firstName`` field to 'John' value for User entity with id 1, the request content will looks like:

.. code-block:: json

    {
      "data": {
        "type": "users",
        "id": "1",
        "attributes": {
          "firstName": "John",
        }
      }
    }

After pushing the ``Try!`` button, if you have ``EDIT`` permission to the record, you will see the updated data at ``Response Body`` block.

Authentication
==============

A RESTful API should be stateless. This means that request authentication should not depend on cookies or sessions. Instead, each
request should come with some sort authentication credentials.

For authentication purposes the **WSSE** mechanism is used - a family of open security specifications for web services, specifically SOAP web
services. The basic premise of WSSE is that a request header is checked for encrypted credentials, verified using a timestamp and nonce, and
authenticated for the requested user using a password digest.

It’s based on the `EscapeWSSEAuthenticationBundle <https://github.com/escapestudios/EscapeWSSEAuthenticationBundle>`__
that covers most cases from the WSSE `specification <http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0.pdf>`__.

Here's an example of request header with WSSE authentication, please pay attention on ``Authentication`` and ``X-WSSE`` parameters:

::

    GET /api/users HTTP/1.1
    Host: localhost.com
    Connection: keep-alive
    User-Agent: Mozilla/5.0 ...
    Connection: keep-alive
    Accept: */*

    Content-Type: application/vnd.api+json
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="admin", PasswordDigest="Cae37DaU9JT1pwoaG5i7bXbDBo0=", Created="2016-09-20T10:00:00+03:00", Nonce="elRZL0lVOTl2T3lXeVBmUHRCL2ZrUnJoWUNZPQ=="

For more details about how to generate ``API Key``, ``header``, etc. please, take a look into `"The Oro Cookbook" - How to use WSSE
authentication <https://www.orocrm.com/documentation/index/current/cookbook/how-to-use-wsse-authentication>`__

Design API Recommendations
==========================

todo... ??

HTTP Verbs
==========

The HTTP verbs comprise a major portion of “uniform interface” and provide the action counterpart to the noun-based resource. The primary
or most-commonly-used HTTP verbs (or methods, as they are properly called) are POST, GET, PUT, PATCH, and DELETE. These correspond to
create, read, update, and delete (or CRUD) operations, respectively. There are a number of other verbs, too, but are utilized less
frequently.

Below is a table summarizing return values of the primary HTTP methods in combination with the resource URIs:

+-------------+------------------+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------------+
| HTTP Verb   | CRUD             | Entire Collection (e.g. /users)                                                              | Specific Item (e.g. /users/{id})                                             |
+=============+==================+==============================================================================================+==============================================================================+
| GET         | Read             | 200 (OK), list of entities. Use pagination, sorting and filtering to navigate big lists.     | 200 (OK), single entity. 404 (Not Found), if ID not found or invalid.        |
+-------------+------------------+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------------+
| POST        | Create           | 201 (Created), Response contains response similar to **GET** /user/{id} containing new ID.   | **not applicable**                                                           |
+-------------+------------------+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------------+
| PATCH       | Update           | **not applicable**                                                                           | 200 (OK) or 204 (No Content). 404 (Not Found), if ID not found or invalid.   |
+-------------+------------------+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------------+
| DELETE      | Delete           | 200 (OK) or 403 (Forbidden) or 400(Bad Request) if no filter is specified,                   | 200 (OK). 404 (Not Found), if ID not found or invalid.                       |
+-------------+------------------+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------------+
| PUT         | Update/Replace   | **not implemented**                                                                          | **not implemented**                                                          |
+-------------+------------------+----------------------------------------------------------------------------------------------+------------------------------------------------------------------------------+

GET / GET\_LIST
---------------

The HTTP GET method is used to **read** (or retrieve) a representation of a resource. In the “success” (or non-error) path, GET returns a
representation in JSON and an HTTP response code of 200 (OK). In an error case, it most often returns a 404 (NOT FOUND) or 400 (BAD
REQUEST). According to the design of the HTTP specification, GET requests are used only to read data and not change it. So, they are
considered safe. That is, they can be called without risk of data modification or corruption—calling it once has the same effect as
calling it 10 times, or none at all.

POST (CREATE)
-------------

The POST verb is most-often utilized to **create** new resources. In particular, it's used to create subordinate resources. That is,
subordinate to some other (e.g. parent) resource. In other words, when creating a new resource, POST to the parent and the service takes care
of associating the new resource with the parent, assigning an ID (new resource URI), etc.

On successful creation, return HTTP status 201.

POST is not safe. Making two identical POST requests will most-likely result in two resources containing the same information.

PATCH (UPDATE)
--------------

PATCH is used for **modify** capabilities. The PATCH request only needs to contain the changes to the resource, not the complete resource.

In other words, the body should contain a set of instructions describing how a resource currently residing on the server should be modified to
produce a new version.

PATCH is not safe. Collisions from multiple PATCH requests may be dangerous because some patch formats need to operate from a known
base-point or else they will corrupt the resource. Clients using this kind of patch application should use a conditional request such that the
request will fail if the resource has been updated since the client last
accessed the resource.

DELETE / DELETE\_LIST
---------------------

DELETE is pretty easy to understand. It is used to **delete** a resource identified by a filters or *Id*.

On successful deletion, return HTTP status 204 (No Content) with no response body.

If you DELETE a resource, it's removed. Repeatedly calling DELETE on that resource will often return a 404 (NOT FOUND) since it was already
removed and therefore is no longer findable.

HTTP Headers
============

As already mentioned above, to successfully perform API request it is important to provide correct ``Content-Type`` and ``Authentication``,
e.g.

::

    Content-Type: application/vnd.api+json
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="...",PasswordDigest="...", Created="...", Nonce="..."

Also, by providing additional requests header parameters it is possible to retrieve additional information like total number of records per
certain resource while ``GET_LIST`` request or total number of affected records while ``DELETE_LIST`` request. For such purposes the
``X-Include``\ request header can be used.

The following table describes all existing keys for X-Include header.

+----------------+-----------------+---------------------------+-------------------------------------------+
| Request Type   | X-Include key   | Response Header           | Description                               |
+================+=================+===========================+===========================================+
| GET\_LIST      | totalCount      | X-Include-Total-Count     | Returns the total number of entities.     |
+----------------+-----------------+---------------------------+-------------------------------------------+
| DELETE\_LIST   | totalCount      | X-Include-Total-Count     | Returns the total number of entities.     |
+----------------+-----------------+---------------------------+-------------------------------------------+
| DELETE\_LIST   | deletedCount    | X-Include-Deleted-Count   | Returns the number of deleted entities.   |
+----------------+-----------------+---------------------------+-------------------------------------------+

Header examples:

**Request total count of resource records**:

::

    GET /api/users HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ...
    ...
    X-Include: totalCount

**Response**:

::

    HTTP/1.1 200 OK
    Date: Fri, 23 Sep 2016 12:27:05 GMT
    Server: Apache/2.4.18 (Unix) PHP/5.5.38

    X-Include-Total-Count: 49

    Content-Length: 585
    Keep-Alive: timeout=5, max=100
    Connection: Keep-Alive
    Content-Type: application/vnd.api+json

**Request total number of deleted records of the resource**:

::

    DELETE /api/users HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ...
    ...
    X-Include: deletedCount

Request body contains e.g. filter that specify conditions for deletion
operation (will be described below):

.. code-block:: json

    {"filter":{"id":"21,22"}}

**Response**:

::

    HTTP/1.1 204 No Content
    Date: Fri, 23 Sep 2016 12:38:47 GMT
    Server: Apache/2.4.18 (Unix) PHP/5.5.38

    X-Include-Deleted-Count: 2

    Content-Length: 0
    Keep-Alive: timeout=5, max=100
    Connection: Keep-Alive
    Content-Type: text/html

Response status codes and errors
================================

In case of success request the response Status Code could be:

-  ``200 OK`` - Response to a successful GET, PATCH or DELETE.
-  ``201 Created`` - Response to a POST that results in a creation. Will
   be combined with a JSON in body that contains newly created entity
   (similar to regular GET request).
-  ``204 No Content`` - Response to a successful request that won't be
   returning a body (like a DELETE request)

For example:

-  **request**

   ::

       GET /api/users/1 HTTP/1.1

-  **response**

   ::

       Request URL: http://localhost.com/api/users/1
       Request Method: GET
       Status Code: 200 OK
       Remote Address: 127.0.0.1:80

In case of error the Status Code in response will indicate the type of
an error that occurred, the most frequent of them:

-  ``400 Bad Request`` - The request is malformed, such as if the body
   of the request contains misformatted JSON.
-  ``401 Unauthorized`` - When no or invalid authentication details are
   provided. Also can be useful to trigger an auth popup if the API is
   used from a browser.
-  ``403 Forbidden`` - When authentication succeeded but authenticated
   user doesn't have access to the resource.
-  ``404 Not Found`` - When a non-existent resource is requested.
-  ``500 Internal Server Error`` - The server encountered an unexpected
   condition which prevented it from fulfilling the request.

For example:

-  **request**

   ::

       GET /api/users/999 HTTP/1.1

-  **response**

   ::

       Request URL: http://localhost.com/api/users/1
       Request Method: GET
       Status Code: 404 Not Found
       Remote Address: 127.0.0.1:80

Just like an HTML error page shows a useful error message to a visitor,
an API will provide a useful error message in a known consumable format.
The representation of an error looks the same as the representation of
any resource, just with its own set of fields.

.. code-block:: json

    {
      "errors": [
        {
          "status": "404",
          "title": "not found http exception",
          "detail": "An entity with the requested identifier does not exist."
        }
      ]
    }

Schema
======

All API access is over HTTP(S), it depends on server configuration. And accessed from the **http(s)://localhost.com/api/[resource\_name]** All
data is sent and received as JSON.

**Typical request** can be performed via ``curl`` or via UI (sandbox):

::

    curl -X "GET" -H "Content-Type: application/vnd.api+json"
         -H "Authorization: WSSE profile='UsernameToken'"
         -H "X-WSSE: UsernameToken Username='admin',
             PasswordDigest='D5AjIiPf7edQX2EX8hLwtB3XhQY=',
             Created='2016-09-19T20:00:00+03:00',
             Nonce='N2hlMDc3TGcrVU53bGprNlQ0YXliLy9PSEFNPQ=='"
    http://localhost.com/api/users/1

Please note, to simplify request examples representation in document, the short format will be used, e.g.:

::

    GET /api/users/1 HTTP/1.1
    Host: localhost.com
    Content-Type: application/vnd.api+json
    Authorization: WSSE profile='UsernameToken'
    X-WSSE: UsernameToken Username='...', PasswordDigest='...', Created='...', Nonce='...'

**Typical response header**:

::

    HTTP/1.1 200 OK
    Server: Apache/2.4.18 (Unix) PHP/5.5.38
    Date: Mon, 19 Sep 2016 17:52:34 GMT
    Content-Type: application/vnd.api+json
    Connection: keep-alive
    Status: 200 OK
    Content-Length: 5279
    Cache-Control: max-age=0, no-store

**Typical response body**:

.. code-block:: json

    { "data": {
        "type": "users",
        "id": "1",
        "attributes": {
            "title": null,
            ...
            "email": "admin@local.com",
            "firstName": "John",
            "enabled": true,
            "lastLogin": "2016-09-19T11:01:31Z",
            ...
        },
        "relationships": {
            ...
            "owner": { "data": { "type": "businessunits", "id": "1"} },
            "businessUnits": { "data": [ { "type": "businessunits", "id": "1" } ] },
            ...
        }
    }}

Blank fields are included as ``null`` instead of being omitted.

Attributes or subresources that is restricted are included as ``null`` as well.

All timestamps are returned in ISO 8601 format: ``YYYY-MM-DDTHH:MM:SSZ``

Most common resource(s) fields
------------------------------

+------------------------+------------+-----------------------------------------------------------------------------------+
| name                   | type       | description                                                                       |
+========================+============+===================================================================================+
| id                     | integer    | The identifier of an resource                                                     |
+------------------------+------------+-----------------------------------------------------------------------------------+
| createdAt              | datetime   | The date and time of resource record creation.                                    |
+------------------------+------------+-----------------------------------------------------------------------------------+
| updatedAt              | datetime   | The date and time of the last update of the resource record.                      |
+------------------------+------------+-----------------------------------------------------------------------------------+
| ---                    | ---        | ---                                                                               |
+------------------------+------------+-----------------------------------------------------------------------------------+
| owner                  | ---        | ---                                                                               |
+------------------------+------------+-----------------------------------------------------------------------------------+
| organization           | ---        | ---                                                                               |
+------------------------+------------+-----------------------------------------------------------------------------------+
| ---                    | ---        | ---                                                                               |
+------------------------+------------+-----------------------------------------------------------------------------------+
| lastContactedDate      | datetime   | The data and time of the last contact activity for the resource record            |
+------------------------+------------+-----------------------------------------------------------------------------------+
| lastContactedDateIn    | datetime   | The data and time of the last incoming contact activity for the resource record   |
+------------------------+------------+-----------------------------------------------------------------------------------+
| lastContactedDateOut   | datetime   | The data and time of the last outgoing contact activity for the resource record   |
+------------------------+------------+-----------------------------------------------------------------------------------+
| timesContacted         | integer    | Total number of contact activities per resource record                            |
+------------------------+------------+-----------------------------------------------------------------------------------+
| timesContactedIn       | integer    | Total number of incoming contact activities per resource record                   |
+------------------------+------------+-----------------------------------------------------------------------------------+
| timesContactedOut      | integer    | Total number of outgoing contact activities per resource record                   |
+------------------------+------------+-----------------------------------------------------------------------------------+

FILTERS
=======

When searching for a list of API resource, some fields can be used for filtering. Those filters are listed in the API reference, under the
filters section of every resource. To filter, perform a GET request and put your filters as parameters of the ``Query String``.

For instance, the following request will list all ``users`` resource for the organization ``1``.

::

    GET /api/users?filter[organization]=1 HTTP/1.1

Just like a field, a filter declares a data type and only takes specific values in input.

In case of ``string`` value will be passed as value for ``integer`` type filter, the error will occur, e.g.:

::

    GET /api/users?filter[id]=aaa HTTP/1.1

    { "errors": [{
      "status": "500",
      "title": "unexpected value exception",
      "detail": "Expected integer value. Given \"aaa\"."
    }] }

In case of unknown, mistyped or unsupported filter, e.g.:

::

    GET /api/users?filter[unknown]=aaa HTTP/1.1

    { "errors": [{
      "status": "400",
      "title": "filter constraint",
      "detail": "Filter \"filter[unknown]\" is not supported.",
      "source": {
        "parameter": "filter[unknown]"
      }
    }] }

Pagination
----------

By default the page size is limited to 10 records and the page number is 1. But it is possible to easily ask server to change the page size or
page number to get the certain number of results which will fit your needs. The pagination parameters should be passed as
``Query String Parameters``.

+------------------+-----------+-----------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Parameter name   | Type      | Default value   | Description                                                                                                                                                            |
+==================+===========+=================+========================================================================================================================================================================+
| page[size]       | integer   | 10              | Set a positive integer number. If a pagination should be disabled set it as ``-1``, in this case ``page[number]`` will not be taken into account and can be omitted.   |
+------------------+-----------+-----------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| page[number]     | integer   | 1               | The number of the page.                                                                                                                                                |
+------------------+-----------+-----------------+------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

::

    GET /api/users?page[number]=2&page[size]=20 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

Data filtering
--------------

Depending on the type of the ``filter`` certain operators will be allowed. For example, for ``integer`` filter types it is allowed to use
six types - **==**, **!=**, **<**, **<=**, **>**, **>=**, for ``string`` filter type - only **==**, **!=**. The more details about certain
resource and its available filters can be retrieved from ``API sandbox`` page in ``Documentation`` section for certain action.

-  name — the name of the filter.
-  operator — defines the type of filter match to use.
-  value — states the values to be included in or excluded from the
   results.

+------------+---------------+--------------------+-----------+
| Operator   | Description   | URL Encoded Form   | Example   |
+============+===============+====================+===========+
| **==**     |               |                    |           |
+------------+---------------+--------------------+-----------+
| **!=**     |               |                    |           |
+------------+---------------+--------------------+-----------+
| **<**      |               |                    |           |
+------------+---------------+--------------------+-----------+
| **<=**     |               |                    |           |
+------------+---------------+--------------------+-----------+
| **>**      |               |                    |           |
+------------+---------------+--------------------+-----------+
| **>=**     |               |                    |           |
+------------+---------------+--------------------+-----------+

Fields filter
-------------

All objects are composed of fields. They all have an identifier id (unique in the given class of objects) plus some other fields defined in
the Data API Reference. Some fields are publicly readable, some other are not and need the user to have extended permissions to be granted.

To request more specific fields, use the ``fields`` filter parameter with the list of fields you need in the response. We are urging you to
always use fields to only request the fields you will use in your application.

For instance, to select the id and the title fields of a certain resource, perform a GET request to /api/?fields=id,title.

Include filter
--------------

todo...

Sort filters
------------

When the response to your call is a list of objects, you can also sort the list by using the sort filter with any of the available values
listed in the API reference.




Data API Client Requirements
============================

The only requirement for client that will send API requests to server is it **must** contain valid ``Content-Type`` in header without any media
type parameters.

::

    Content-Type: application/vnd.api+json

In the same time it **must** ignore any media type received in the ``Content-Type`` header of response.

Here's an example:

::

    GET /api/users HTTP/1.1
    Host: localhost.com
    Content-Type: application/vnd.api+json
    ...

    {"data": [
      {
        "type": "accounts",
        "id": "1",
        "attributes": {
          "name": "Life Plan Counselling",
          ...
        },
        "relationships": {
          ...
        }
      }
    ]}

Requests with not valid ``Content-Type`` value in header will be perceived as ``plain`` request, so the response data will have different
(plain) format.

Here's an example:

::

    GET /api/users HTTP/1.1
    Host: localhost.com
    Content-Type: application/json
    ...

    [
      {
        "id": 1,
        "name": "Life Plan Counselling",
        ...
        "contacts": [
          1
        ]
      },
      ...
    ]


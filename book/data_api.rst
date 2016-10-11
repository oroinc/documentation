Web Services API
================

Overview
========

An application programming interface (**API**) is a software interface which is designed to be used by other software.
Whilst an ordinary software program is used by a (human) computer user, an API is a software program used by
another software program.

The Representational State Transfer (**REST**) architectural style is an abstraction of the architectural elements
within a distributed hypermedia system. REST ignores the details of component implementation and protocol syntax in
order to focus on the roles of the components, the constraints on their interaction with other components, and their
interpretation of significant data elements. It encompasses the fundamental constraints on components, connectors,
and data that define the basis of the Web architecture, and thus the essence of its behavior as a network-based
application.

**JSON API** is a `specification <http://jsonapi.org/format/>`__  for how a client should request those resources to
be fetched or modified, and how a server should respond to them. It is designed to minimize both the number of requests
and the amount of data transmitted between the clients and the servers. This efficiency is achieved without compromising
on readability, flexibility or discoverability.

Therefore, here and below the term ``API`` will refer to the ``REST JSON API`` that gives programmatic access
to read and write data. Request and response body should use JSON format.

Quick Start
===========

To start using the API, a user should take a few preliminary steps:

-  Ensure that the application is installed correctly;
-  Generate API Token for the user. To do that, navigate to the ``Profile page`` of your user. ``My User`` link is available in the
   dropdown menu in the top right corner or via a direct link (e.g. http://localhost.com/user/profile/view). In case you
   want to generate ``API Key`` for any other user in the system, open ``Users grid`` (System->User Management->Users),
   find the user who needs an API key and open its view page by clicking on the grid row or ``View`` from the ellipsis menu.
   Finally, simply click on the ``Generate Key`` button. You'll see the generated key near the button looking like:    ``f5c7cd6bf05654e6ce8e5c4c17fbe6535c6161d2``.

.. hint::

    Please note, the ``API key`` will be generated in the scope of the current ``Organization`` and will allow to access data
    in the scope of that particular organization only. For more information about ``Organization`` purposes, see `Company Structure and
    Organization </user-guide/intro-company-structure-org-selector>`__.
    Also, to understand the permissions and security model, refer to `Security </book/security>`__.

Afterwards, it will be possible to execute API requests with sandbox, Curl command, any other REST client or use
API with your own application.

API sandbox
-----------

API sandbox page allows to perform API requests directly from the Oro application instance.

How to use the sandbox.
~~~~~~~~~~~~~~~~~~~~~~~

The sandbox page is available here: http://localhost.com/api/doc/

By default, this page represents a list of plain API resources. Plain API resources are old API implementations
based on `FOSRestBundle <http://symfony.com/doc/current/bundles/FOSRestBundle/index.html>`__.

To switch to JSON API sandbox, go to the http://localhost.com/api/doc/rest\_json\_api page, or click on ``JSON.API``
link at the top of the page.

By default, a collapsible list of available resources will be listed.

Each resource block contains a set of available actions for that resource grouped by request link.

By clicking on certain action, documentation and ``Sandbox`` tabs will be displayed.

The sandbox tab contains a form for this action and can be used to perform API queries.

Retrieving a single record for a particular resource with JSON API.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To perform the GET action for any entity(resource), find this API resource on
http://localhost.com/api/doc/rest\_json\_api page and open the actions block.

Next, click on ``GET`` for the ``/api/your_resource/{id}`` route.

Clicking the ``Sanbox`` link will prompt a request form to open.
If you want to get one record, you should specify the record id in the ``id`` field.

Click on ``Try!`` button to send the request to theserver.

After the response, you should see the ``Request URL``, ``Response Headers``, ``Response Body``
and ``Curl Command Line`` blocks.

The ``Request URL`` block will contain the request URL sent to server.

The ``Response Headers`` block will contain the status code of the server's response. In case of successful request,
it should contain **200 OK** string.
To see the list of headers which the server sent during the response, click ``Expand`` .

If request was successful, you should see the output data of the request in the ``Response Body`` block. In the given
case, entity data will be in JSON format. More information about this format can
be found `here <http://jsonapi.org/format/>`__.

The ``Curl Command Line`` block will contain an example of the CLI command to perform the request
with `Curl <https://curl.haxx.se/>`__.
This command may help to emulate the real request to the API.

.. hint::

    During Curl request, please make sure your ``X-WSSE`` header is up to date for every request.

Performing an update for a particular resource with JSON API.
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

To test the update process for a particular resource, go to this API resource at http://localhost.com/api/doc/rest\_json\_api
page and open its actions block.

Afterwards, click ``PATCH`` for the ``/api/your_resource/{id}`` route. And after that to the sanbox link.

In ``id`` field of sandbox you should specify the entity id you want to edit.

The ``Content`` text area contains a set of instructions describing how a resource currently residing on the server
should be modified to produce a new version.

For example, if you want to change the ``firstName`` field to 'John' value for a User entity with id 1, the request
content will look the following way:

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

Provided you have ``EDIT`` permission to the record, you will see the updated data in the
``Response Body`` block after pushing the ``Try!`` button.

Authentication
==============

A RESTful API should be stateless. This means that request authentication should not depend on cookies or sessions.
Instead, each request should come with some authentication credentials.

For authentication purposes, **WSSE** mechanism is used - a family of open security specifications for web services,
specifically SOAP web services. The basic premise of WSSE is that a request header is checked for encrypted credentials,
verified using a timestamp and nonce, and authenticated for the requested user using a password digest.

It’s based on the `EscapeWSSEAuthenticationBundle <https://github.com/escapestudios/EscapeWSSEAuthenticationBundle>`__
that covers most cases from the
WSSE `specification <http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-soap-message-security-1.0.pdf>`__.

Here's an example of a request header with WSSE authentication, please pay attention to ``Authentication`` and ``X-WSSE``
parameters:

.. code-block:: http

    GET /api/users HTTP/1.1
    Host: localhost.com
    Connection: keep-alive
    User-Agent: Mozilla/5.0 ...
    Connection: keep-alive
    Accept: */*

    Content-Type: application/vnd.api+json
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="admin",
            PasswordDigest="Cae37DaU9JT1pwoaG5i7bXbDBo0=",
            Created="2016-09-20T10:00:00+03:00",
            Nonce="elRZL0lVOTl2T3lXeVBmUHRCL2ZrUnJoWUNZPQ=="

For more details about generating ``API Key``, ``header``, etc. please, take a look in
`"The Oro Cookbook" - How to use WSSE authentication </cookbook/how-to-use-wsse-authentication>`__

HTTP Verbs
==========

The HTTP verbs comprise a major portion of “uniform interface” and provide the action counterpart to the noun-based
resource. The primary or most-commonly-used HTTP verbs (or methods, as they are properly called) are POST, GET, PUT,
PATCH, and DELETE. These correspond to create, read, update, and delete (or CRUD) operations, respectively. There are a
number of other verbs, too, but they are utilized less frequently.

Below is a table summarizing return values of the primary HTTP methods in combination with the resource URIs:

+-------------+----------------+------------------------+----------------------------------------+---------------------------------------------+
| HTTP Verb   | CRUD operation | API action             | Entire Collection (e.g. /users)        |         Specific Item (e.g. /users/{id})    |
+=============+================+========================+========================================+=============================================+
| GET         | Read           | 'get', 'get_list',     | 200 (OK), list of entities.            | 200 (OK), single entity.                    |
|             |                | 'get_subresource',     | Use pagination, sorting and filtering  | 404 (Not Found), if ID not found or invalid.|
|             |                | 'get_relationship'     | to navigate big lists.                 |                                             |
+-------------+----------------+------------------------+----------------------------------------+---------------------------------------------+
| POST        | Create         | 'create'               | 201 (Created), Response contains       | **not applicable**                          |
|             |                |                        | response similar to **GET** /user/{id} |                                             |
|             |                |                        | containing new ID.                     |                                             |
+-------------+----------------+------------------------+----------------------------------------+---------------------------------------------+
| PATCH       | Update         | 'update',              | **not applicable**                     | 200 (OK) or 204 (No Content).               |
|             |                | 'update_relationship', |                                        | 404 (Not Found), if ID not found or invalid.|
|             |                | 'add_relationship'     |                                        |                                             |
+-------------+----------------+------------------------+----------------------------------------+---------------------------------------------+
| DELETE      | Delete         | 'delete',              | 200(OK) or 403(Forbidden) or           | 200 (OK). 404 (Not Found),                  |
|             |                | 'delete_list',         | 400(Bad Request) if no filter          | if ID not found or invalid.                 |
|             |                | 'delete_relationship'  | is specified                           |                                             |
+-------------+----------------+------------------------+----------------------------------------+---------------------------------------------+
| PUT         | Update/Replace | **not implemented**    | **not implemented**                    | **not implemented**                         |
+-------------+----------------+------------------------+----------------------------------------+---------------------------------------------+


Also the HTTP methods may be classified by **idempotent** and **safe** property.
**Safe** methods are HTTP methods that do not modify resources. For instance, using GET or HEAD on a resource URL,
should NEVER change the resource.
An **idempotent** HTTP method is a HTTP method that can be called many times without different outcomes. It would not
matter if the method is called only once, or ten times over. The result should be the same.
For more details, please refer to `RFC 7231: Common Method Properties <https://tools.ietf.org/html/rfc7231#section-4.2>`__.

Below is a table summarizing HTTP methods by its **idempotency** and **safety**:

+-------------+------------+------+
| HTTP Method | Idempotent | Safe |
+=============+============+======+
| OPTIONS     | yes        | yes  |
+-------------+------------+------+
| GET         | yes        | yes  |
+-------------+------------+------+
| HEAD        | yes        | yes  |
+-------------+------------+------+
| PUT         | yes        | no   |
+-------------+------------+------+
| POST        | no         | no   |
+-------------+------------+------+
| DELETE      | yes        | no   |
+-------------+------------+------+
| PATCH       | no         | no   |
+-------------+------------+------+


GET
---

The HTTP GET method is used to **read** (or retrieve) a representation of a resource. In the “success” (or non-error)
path, GET returns a representation in JSON and an HTTP response code of 200 (OK). In an error case, it most often
returns a 404 (NOT FOUND) or 400 (BAD REQUEST).

.. hint::
    According to the design of the HTTP specification, GET requests are used only to read data and not change it.
    So, they are considered safe. That is, they can be called without risk of data modification or corruption —
    calling it once has the same effect as calling it 10 times.

POST
----

The POST verb is most-often utilized to **create** new resources. In particular, it's used to create subordinate
resources. That is, subordinate to some other (e.g. parent) resource. In other words, when creating a new resource,
POST to the parent and the service takes care of associating the new resource with the parent, assigning an
ID (new resource URI), etc.

On successful creation, return HTTP status 201.

.. hint::

    POST is not safe operation. Making two identical POST requests will most-likely result in two resources containing
    the same information but with different identifiers.

PATCH
-----

PATCH is used for **modify** capabilities. The PATCH request only needs to contain the changes to the resource,
not the complete resource.

In other words, the body should contain a set of instructions describing how a resource currently residing on the
server should be modified to produce a new version.

.. hint::

    PATCH is not safe operation. Collisions from multiple PATCH requests may be dangerous because some patch formats
    need to operate from a known base-point or else they will corrupt the resource. Clients using this kind of patch
    application should use a conditional request (e.g. GET resource, ensure it was not modified and apply PATCH) such
    that the request will fail if the resource has been updated since the client last accessed the resource.

DELETE
------

DELETE is quite easy to understand. It is used to **delete** a resource identified by filters or *Id*.

On successful deletion,  HTTP status 204 (No Content) returns with no response body.

.. hint::

    If you DELETE a resource, it's removed. Repeatedly calling DELETE on that resource will often return a 404 (NOT FOUND)
    since it was already removed and therefore is no longer findable.

HTTP Headers
============

As already mentioned above, to successfully perform API request, it is important to provide correct ``Content-Type``
and ``Authentication``, e.g.

.. code-block:: http

    Content-Type: application/vnd.api+json
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="...",PasswordDigest="...", Created="...", Nonce="..."

Also, by providing additional requests header parameters, it is possible to retrieve additional information, such as the total
number of records per certain resource with ``GET_LIST`` request or total number of affected records with
``DELETE_LIST`` request. The ``X-Include``\ request header can be used for such purposes.

The following table describes all existing keys for X-Include header.

+----------------+-----------------+---------------------------+-------------------------------------------------------+
| Request Type   | X-Include key   | Response Header           | Description                                           |
+================+=================+===========================+=======================================================+
| GET\_LIST      | totalCount      | X-Include-Total-Count     | Returns the total number of entities.                 |
+----------------+-----------------+---------------------------+-------------------------------------------------------+
| DELETE\_LIST   | totalCount      | X-Include-Total-Count     | Returns the total number of entities.                 |
+----------------+-----------------+---------------------------+-------------------------------------------------------+
| DELETE\_LIST   | deletedCount    | X-Include-Deleted-Count   | Returns the number of deleted entities.               |
+----------------+-----------------+---------------------------+-------------------------------------------------------+

Header examples:

**Request total count of resource records**:

.. code-block:: http

    GET /api/users HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ...
    ...
    X-Include: totalCount

**Response**:

.. code-block:: http

    HTTP/1.1 200 OK
    Date: Fri, 23 Sep 2016 12:27:05 GMT
    Server: Apache/2.4.18 (Unix) PHP/5.5.38

    X-Include-Total-Count: 49

    Content-Length: 585
    Keep-Alive: timeout=5, max=100
    Connection: Keep-Alive
    Content-Type: application/vnd.api+json

**Request total number of deleted records of the resource**:

.. code-block:: http

    DELETE /api/users HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ....
    ....
    X-Include: deletedCount

**Request query string contains e.g. filter that specifies conditions for deletion operation (will be described below)**:

.. code-block:: http

    DELETE /api/users?filter[id]=21,22 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ....

**Response**:

.. code-block:: http

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

In case of success request, the response Status Code could be the following:

-  ``200 OK`` - Response to a successful GET, PATCH or DELETE.
-  ``201 Created`` - Response to a POST that results in a creation. Will
   be combined with a JSON in body that contains newly created entity (similar to regular GET request).
-  ``204 No Content`` - Response to a successful request that won't be returning a body (like a DELETE request)

For example:

-  **request**

   .. code-block:: http

       GET /api/users/1 HTTP/1.1

-  **response**

   .. code-block:: http

       Request URL: http://localhost.com/api/users/1
       Request Method: GET
       Status Code: 200 OK
       Remote Address: 127.0.0.1:80

In case of an error, the Status Code  will in response indicate the type of
the error occurred, the most frequent of them are the following:

-  ``400 Bad Request`` - The request is malformed, such as if the body of the request contains misformatted JSON.
-  ``401 Unauthorized`` - When no or invalid authentication details are provided. Also can be useful to trigger an
   auth popup if the API is used from a browser.
-  ``403 Forbidden`` - When authentication succeeded but authenticated user doesn't have access to the resource.
-  ``404 Not Found`` - When a non-existent resource is requested.
-  ``500 Internal Server Error`` - The server encountered an unexpected
   condition which prevented it from fulfilling the request.

For example:

-  **request**

   .. code-block:: http

       GET /api/users/999 HTTP/1.1

-  **response**

   .. code-block:: http

       Request URL: http://localhost.com/api/users/1
       Request Method: GET
       Status Code: 404 Not Found
       Remote Address: 127.0.0.1:80

Similar to an HTML error page showing a useful error message to a visitor, an API displayes a useful error message in
a known consumable format. Representation of an error looks the same as the representation of any resource, only
with its own set of fields.

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

All API access is over HTTP(S), it depends on server configuration and is accessed from the **http(s)://localhost.com/api/[resource\_name]** All data is sent and received as JSON.

**Typical request** can be performed via ``curl`` or via UI (sandbox):

.. code-block:: http

    curl -X "GET" -H "Content-Type: application/vnd.api+json"
         -H "Authorization: WSSE profile='UsernameToken'"
         -H "X-WSSE: UsernameToken Username='admin',
             PasswordDigest='D5AjIiPf7edQX2EX8hLwtB3XhQY=',
             Created='2016-09-19T20:00:00+03:00',
             Nonce='N2hlMDc3TGcrVU53bGprNlQ0YXliLy9PSEFNPQ=='"
    http://localhost.com/api/users/1

Please note that to simplify representation of request examples in the document, a short format will be used, e.g.:

.. code-block:: http

    GET /api/users/1 HTTP/1.1
    Host: localhost.com
    Content-Type: application/vnd.api+json
    Authorization: WSSE profile='UsernameToken'
    X-WSSE: UsernameToken Username='...', PasswordDigest='...', Created='...', Nonce='...'

**Typical response header**:

.. code-block:: http

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
            ....
            "owner": { "data": { "type": "businessunits", "id": "1"} },
            "businessUnits": { "data": [ { "type": "businessunits", "id": "1" } ] },
            ...
        }
    }}

Blank fields are included as ``null`` instead of being omitted.

Attributes or subresources that are restricted are included as ``null`` as well.

All timestamps are returned in ISO 8601 format: ``YYYY-MM-DDTHH:MM:SSZ``


Most common resource(s) fields
------------------------------

+--------------+----------------+-------------------------------------------------------------------------------------------+
| Name         | Type           | Description                                                                               |
+==============+================+===========================================================================================+
| id           | 'integer'      | The unique identifier of an resource. In most cases it's integer, but in                  |
|              |                | depending on resource data model it can be string or contain multiple columns             |
+--------------+----------------+-------------------------------------------------------------------------------------------+
| createdAt    | 'datetime'     | The date and time of resource record creation.                                            |
+--------------+----------------+-------------------------------------------------------------------------------------------+
| updatedAt    | 'datetime'     | The date and time of the last update of the resource record.                              |
+--------------+----------------+-------------------------------------------------------------------------------------------+
| owner        | 'user' or      | An Owner record represents the ownership capabilities of the record. In other words,      |
|              | 'businessUnit' | in dependant on owner type the different permissions may be applied then accessing        |
|              | or             | the data. For more details see                                                            |
|              | 'organization' | `Access and Permissions Management </user-guide/user-management-roles>`__.                |
+--------------+----------------+-------------------------------------------------------------------------------------------+
| organization | organization   | An Organization record represents a real enterprise, business, firm, company or another   |
|              |                | organization, to which the users belong. For more details about ``organization`` field    |
|              |                | purposes see                                                                              |
|              |                | `Company Structure and Organization </user-guide/intro-company-structure-org-selector>`__ |
+--------------+----------------+-------------------------------------------------------------------------------------------+


Typical contacting activities fields
------------------------------------

The term "contacting activity" describes regular activity, but such activity can represent some sort of
communication process and can have a direction (incoming or outgoing).
For example: "Call" and "Email", each of them can act from client or manager. Therefore, if a client calls or sends an email to his
manager, it will be incoming activity. In case a manager calls the client or sends an email, it will be outgoing activity.
This data may help to build forecast reports based on contacting activities.

The table below describes fields that will be available for resources that support such contacting activities
as "Call", "Email", etc.

+------------------------+------------+--------------------------------------------------------------------------------+
| Name                   | Type       | Description                                                                    |
+========================+============+================================================================================+
| lastContactedDate      | datetime   | The data and time of the last contact activity for the resource record         |
+------------------------+------------+--------------------------------------------------------------------------------+
| lastContactedDateIn    | datetime   | The data and time of the last incoming contact activity for the resource record|
+------------------------+------------+--------------------------------------------------------------------------------+
| lastContactedDateOut   | datetime   | The data and time of the last outgoing contact activity for the resource record|
+------------------------+------------+--------------------------------------------------------------------------------+
| timesContacted         | integer    | Total number of contact activities for the resource record                     |
+------------------------+------------+--------------------------------------------------------------------------------+
| timesContactedIn       | integer    | Total number of incoming contact activities for the resource record            |
+------------------------+------------+--------------------------------------------------------------------------------+
| timesContactedOut      | integer    | Total number of outgoing contact activities for the resource record            |
+------------------------+------------+--------------------------------------------------------------------------------+


FILTERS
=======

When searching for a list of an API resource, some fields can be used for filtering. Those filters are listed in the API
reference, under the filters section of every resource. To filter, perform a GET request and put your filters as
parameters of the ``Query String``.

For instance, the following request will list all ``users`` resource for organization ``1``.

.. code-block:: http

    GET /api/users?filter[organization]=1 HTTP/1.1

Similar to a field, a filter declares a data type and only takes specific values in input.

In case ``string`` value passes as value for ``integer`` type filter, an error will occur, e.g.:

.. code-block:: http

    GET /api/users?filter[id]=aaa HTTP/1.1

    { "errors": [{
      "status": "500",
      "title": "unexpected value exception",
      "detail": "Expected integer value. Given \"aaa\"."
    }] }

In case of unknown, mistyped or unsupported filter, e.g.:

.. code-block:: http

    GET /api/users?filter[unknown]=aaa HTTP/1.1

    { "errors": [{
      "status": "400",
      "title": "filter constraint",
      "detail": "Filter \"filter[unknown]\" is not supported.",
      "source": {
        "parameter": "filter[unknown]"
      }
    }] }


The API allows to use several types of filters. Filter types are briefly described in the table below.

+-------------+------------------------------+-------------------------------------------------------------------------+
| Filter Type | Usage Example                | Description                                                             |
+=============+==============================+=========================================================================+
| fields      | fields[owner]=id,name        | Used for limiting the response data only to specified fields.           |
|             |                              | Depends on ``include`` filter in case if filter is applied to relation. |
+-------------+------------------------------+-------------------------------------------------------------------------+
| filter      | 'filter[id]=1'               | Used for filtering the response data by specific values of specific     |
|             | or                           | field. Can accept additional operators like ``/<``, ``/>``, etc.        |
|             | 'filter[id]=5,7'             | Also filter may accept several values, in such case they will be        |
|             | or                           | perceived as ``OR``, e.g. id == 5 OR id == 7 (2nd example). And in case |
|             | 'filter[id]>8&filter[name]=a'| of several filters in request, all of them will be perceived as ``AND``,|
|             |                              | e.g. id > 8 AND name == 'a' (3rd example).                              |
+-------------+------------------------------+-------------------------------------------------------------------------+
| include     | include=[owner,organization] | Used for inclusion into response the related resources data.            |
+-------------+------------------------------+-------------------------------------------------------------------------+
| page        | page[size]=10&page[number]=1 | Used for pagination purposes.                                           |
+-------------+------------------------------+-------------------------------------------------------------------------+
| sort        | 'sort=id'                    | Used for data sorting. By default ``ASC`` sorting. To perform ``DESC``  |
|             | or                           |                                                                         |
|             | 'sort=id,-name'              | sorting specify ``/-`` before field name as shown in example.           |
+-------------+------------------------------+-------------------------------------------------------------------------+


``Fields`` filters
------------------

All objects are composed of fields. They all have an identifier id (unique in the given class of objects), plus some
other fields defined in the Data API Reference. Some fields are publicly readable, some other are not and need the user
to have extended permissions to be granted.

To request more specific fields, use the ``fields`` filter parameter with the list of fields you need in the response.
We are urging you always to  use fields to  request only the fields you will use in your application.

For instance, to select the ``username`` and the ``email`` fields of the ``users`` resource, perform a GET request:

.. code-block:: http

    GET api/users?fields[users]=username,email HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

.. code-block:: json

    {
      "data": [
        {
          "type": "users",
          "id": "1",
          "attributes": {
            "username": "admin",
            "email": "admin@local.com"
          }
        },
        {
          "type": "users",
          "id": "2",
          "attributes": {
            "username": "sale",
            "email": "sale@example.com"
          }
        }
      ]
    }


Data filters (``filter``)
-------------------------

Depending on the type of the ``filter``, certain operators will be allowed. For example, for ``integer`` filter types it
is allowed to use six types - **=**, **!=**, **<**, **<=**, **>**, **>=**, for ``string`` filter type - only **=**,
**!=**. More details about certain resource and its available filters can be retrieved from ``API sandbox`` page in
``Documentation`` section for a certain action.

+----------+-----------------------+-------------+---------------------------------------------------------------------+
| Operator | Description           | URL Encoded | Request Example                                                     |
+==========+=======================+=============+=====================================================================+
| **=**    | Equality              | %3D         | GET /api/users?filter[id]=1 HTTP/1.1                                |
+----------+-----------------------+-------------+---------------------------------------------------------------------+
| **!=**   | Inequality            | %21%3D      | GET /api/users?filter[id]!=2 HTTP/1.1                               |
+----------+-----------------------+-------------+---------------------------------------------------------------------+
| **<**    | Less than             | %3C         | GET /api/users?filter[id]<3 HTTP/1.1                                |
+----------+-----------------------+-------------+---------------------------------------------------------------------+
| **<=**   | Less than or equal    | %3C%3D      | GET /api/users?filter[id]<=4 HTTP/1.1                               |
+----------+-----------------------+-------------+---------------------------------------------------------------------+
| **>**    | Greater than          | %3E         | GET /api/users?filter[id]>5 HTTP/1.1                                |
+----------+-----------------------+-------------+---------------------------------------------------------------------+
| **>=**   | Greater than or equal | %3E%3D      | GET /api/users?filter[id]>=6 HTTP/1.1                               |
+----------+-----------------------+-------------+---------------------------------------------------------------------+


Request example:

.. code-block:: http

    GET /api/users?filter[id]>5$page[number]=1&page[size]=2&fields[users]=username,email HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

Response data example:

.. code-block:: json

    {
      "data": [
        {
          "type": "users",
          "id": "6",
          "attributes": {
            "username": "jimmy.henderson_c4261",
            "email": "jimmy.henderson_c428e@example.com"
          }
        },
        {
          "type": "users",
          "id": "7",
          "attributes": {
            "username": "gene.cardenas_c760d",
            "email": "gene.cardenas_c7620@yahoo.com"
          }
        }
      ]
    }


``Include`` filter
------------------

As mentioned above, the ``include`` filter allows to extend the response data with the information of related resource.
It is usually used to reduce the number of requests to the server or, in other words, to retrieve all necessary data
in a single request.
All included resources will be represented in ``included`` section of the response.

.. hint::

    Please note, in case of using ``fields`` filter for the main resource (``users`` in our case), it must contain
    the field(s) used in the ``include`` filter.

**Request example (inclusion of ``roles`` relation with ``fields`` filter)**:

.. code-block:: http

    GET api/users?fields[users]=username,email,roles&include=roles&page[number]=1&page[size]=1 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

**Response data example**:

.. code-block:: json

    {
      "data": [
        {
          "type": "users",
          "id": "1",
          "attributes": {
            "username": "admin",
            "email": "admin@local.com"
          },
          "relationships": {
            "roles": {
              "data": [
                {
                  "type": "userroles",
                  "id": "3"
                }
              ]
            }
          }
        }
      ],
      "included": [
        {
          "type": "userroles",
          "id": "3",
          "attributes": {
            "extend_description": null,
            "role": "ROLE_ADMINISTRATOR",
            "label": "Administrator"
          },
          "relationships": {
            "organization": {
              "data": null
            }
          }
        }
      ]
    }

Also, it is possible to limit fields that will be returned from the relation. For such purposes, the ``fields`` filter
should be used.

.. code-block:: http

    GET api/users?fields[userroles]=label&fields[users]=username,email,roles&include=roles&page[number]=1&page[size]=1 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

.. code-block:: json

    {
      "data": [
        {
          "type": "users",
          "id": "1",
          "attributes": {
            "username": "admin",
            "email": "admin@local.com"
          },
          "relationships": {
            "roles": {
              "data": [
                {
                  "type": "userroles",
                  "id": "3"
                }
              ]
            }
          }
        }
      ],
      "included": [
        {
          "type": "userroles",
          "id": "3",
          "attributes": {
            "label": "Administrator"
          }
        }
      ]
    }


``Page`` filters (pagination)
-----------------------------

By default, the page size is limited to 10 records and the page number is 1. However, it is possible to ask the server to
change the page size or page number to get the certain number of results which will fit your needs. Pagination
parameters should be passed as ``Query String Parameters``.

+------------------+-----------+-----------------+--------------------------------------------------------------------+
| Parameter name   | Type      | Default value   | Description                                                        |
+==================+===========+=================+====================================================================+
| page[size]       | integer   | 10              | Set a positive integer number. If a pagination should be disabled  |
|                  |           |                 | set it as ``-1``, in this case ``page[number]`` will not be taken  |
|                  |           |                 | into account and can be omitted.                                   |
+------------------+-----------+-----------------+--------------------------------------------------------------------+
| page[number]     | integer   | 1               | The number of the page.                                            |
+------------------+-----------+-----------------+--------------------------------------------------------------------+


For instance, to get 2nd page of ``users`` resource with 20 records per page, perform the following request:

.. code-block:: http

    GET /api/users?page[number]=2&page[size]=20 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...


``Sort`` filters
----------------

When the response to your call is a list of objects, you can also sort the list by using the sort filter with any of
available values listed in the API reference.

Request example (sorting by ``username`` in descending order):

.. code-block:: http

    GET /api/users?filter[id]>5$page[number]=1&page[size]=2&fields[users]=username,email&sort=-username HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    ...

Response data example:

.. code-block:: json

    {
      "data": [
        {
          "type": "users",
          "id": "24",
          "attributes": {
            "username": "william.morrison_247fe",
            "email": "william.morrison_2482c@msn.com"
          }
        },
        {
          "type": "users",
          "id": "31",
          "attributes": {
            "username": "victor.nixon_54050",
            "email": "victor.nixon_5406f@gmail.com"
          }
        }
      ]
    }


Data API Client Requirements
============================

The only requirement for the client that will send API requests to the server is that it **must** contain valid ``Content-Type``
in header without any media type parameters.

.. code-block:: http

    Content-Type: application/vnd.api+json

At the same time, it **must** ignore any media type received in the ``Content-Type`` header in response.

Here's an example:

.. code-block:: http

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

Requests with invalid ``Content-Type`` value in header will be perceived as ``plain`` request, so the response data
will have different (plain) format.

Here's an example:

.. code-block:: http

    GET /api/users HTTP/1.1
    Host: localhost.com
    Content-Type: application/json
    ....

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


.. _web-services-api--http-header-specifics:

HTTP Header Specifics
=====================

As mentioned in the :ref:`Authentication <web-services-api--authentication>` section, to perform
an API request successfully, it is important to provide the correct **Content-Type** and **Authentication** parameters, e.g.,:

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Content-Type: application/vnd.api+json
    Authorization: WSSE profile="UsernameToken"
    X-WSSE: UsernameToken Username="...",PasswordDigest="...", Created="...", Nonce="..."

Also, by providing additional requests header parameters, it is possible to retrieve additional information, such as the total number of records per certain resource for the GET and DELETE methods or a total number of affected records
for the DELETE method. The **X-Include** request header can be used for such purposes.

The following table describes all existing keys for the X-Include header.


+-------------+-----------------+---------------------------+------------------------------------------------------+
| HTTP Method | X-Include key   | Response Header           | Description                                          |
+=============+=================+===========================+======================================================+
| any         | noHateoas       |                           | Removes all HATEOAS related links from the response. |
+-------------+-----------------+---------------------------+------------------------------------------------------+
| GET         | totalCount      | X-Include-Total-Count     | Returns the total number of entities.                |
+-------------+-----------------+---------------------------+------------------------------------------------------+
| DELETE      | totalCount      | X-Include-Total-Count     | Returns the total number of entities.                |
+-------------+-----------------+---------------------------+------------------------------------------------------+
| DELETE      | deletedCount    | X-Include-Deleted-Count   | Returns the number of deleted entities.              |
+-------------+-----------------+---------------------------+------------------------------------------------------+

**Header Examples**

*Example 1. Total Number of Existing Records*

Retrieve the total count of resource records.

**Request header**

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ...
    ...
    X-Include: totalCount

**Response**

.. code-block:: http
    :linenos:

    HTTP/1.1 200 OK
    Date: Fri, 23 Sep 2016 12:27:05 GMT
    Server: Apache/2.4.18 (Unix) PHP/5.5.38

    X-Include-Total-Count: 49

    Content-Length: 585
    Keep-Alive: timeout=5, max=100
    Connection: Keep-Alive
    Content-Type: application/vnd.api+json

*Example 2. Total Number of Deleted Records*

Retrieve the total number of deleted records of the resource

**Request header**

.. code-block:: http
    :linenos:

    DELETE /api/users HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ....
    ....
    X-Include: deletedCount

*Example 3. Conditions for the Delete Operation*

Request query string contains a filter that specifies conditions for deletion operation. Filters are described in more detail in the :ref:`Filters <web-services-api--filters>` section.

**Request header**

.. code-block:: http
    :linenos:

    DELETE /api/users?filter[id]=21,22 HTTP/1.1

    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    Authorization: ....

**Response**

.. code-block:: http
    :linenos:

    HTTP/1.1 204 No Content
    Date: Fri, 23 Sep 2016 12:38:47 GMT
    Server: Apache/2.4.18 (Unix) PHP/5.5.38

    X-Include-Deleted-Count: 2

    Content-Length: 0
    Keep-Alive: timeout=5, max=100
    Connection: Keep-Alive
    Content-Type: text/html


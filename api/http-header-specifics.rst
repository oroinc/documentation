.. _web-services-api--http-header-specifics:

HTTP Header Specifics
=====================

As mentioned in the :ref:`Client Requirements <web-services-api--client-requirements>`
and :ref:`Authentication <web-services-api--authentication>` sections, to perform
an JSON:API request successfully, it is important to provide the correct **Accept**, **Content-Type**
and **Authentication** parameters, e.g.,:

.. code-block:: http
    :linenos:

    GET /api/users HTTP/1.1
    Accept: application/vnd.api+json
    Authorization: Bearer <access token>

Also, by providing additional requests header parameters, it is possible to retrieve additional information, such as
the total number of records per certain resource for the GET and DELETE methods or a total number of affected records
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
    Accept: application/vnd.api+json
    X-Include: totalCount

**Response**

.. code-block:: http
    :linenos:

    HTTP/1.1 200 OK
    X-Include-Total-Count: 49
    Content-Type: application/vnd.api+json
    Date: Fri, 23 Sep 2016 12:27:05 GMT
    Content-Length: 585
    Keep-Alive: timeout=5, max=100
    Connection: Keep-Alive

*Example 2. Total Number of Deleted Records*

Retrieve the total number of deleted records of the resource

**Request header**

.. code-block:: http
    :linenos:

    DELETE /api/users HTTP/1.1
    Accept: application/vnd.api+json
    X-Include: deletedCount

*Example 3. Conditions for the Delete Operation*

Request query string contains a filter that specifies conditions for deletion operation. Filters are described in more detail in the :ref:`Filters <web-services-api--filters>` section.

**Request header**

.. code-block:: http
    :linenos:

    DELETE /api/users?filter[id]=21,22 HTTP/1.1
    Accept: application/vnd.api+json

**Response**

.. code-block:: http
    :linenos:

    HTTP/1.1 204 No Content
    X-Include-Deleted-Count: 2
    Date: Fri, 23 Sep 2016 12:38:47 GMT
    Content-Length: 0
    Keep-Alive: timeout=5, max=100
    Connection: Keep-Alive


The following request headers are available for the storefront API.

+-------------+-------------------+---------------------------------------------------------------------------------+
| HTTP Method | Request Header    | Description                                                                     |
+=============+===================+=================================================================================+
| any         | X-Localization-ID | By default, all locale sensitive data are received and returned in the locale   |
|             |                   | selected for the current website. This header can be used to specify another    |
|             |                   | locale. The list of available localization IDs can be received via the          |
|             |                   | ``/api/localizations`` resource.                                                |
+-------------+-------------------+---------------------------------------------------------------------------------+
| any         | X-Currency        | By default, all currency-related data are received and returned in the currency |
|             |                   | selected for the current website. This header can be used to specify another    |
|             |                   | currency. The list of available currency codes can be received via the          |
|             |                   | ``/api/currencies`` resource.                                                   |
|             |                   |                                                                                 |
|             |                   | **Note:** This header is available for OroCommerce Enterprise Edition only.     |
+-------------+-------------------+---------------------------------------------------------------------------------+

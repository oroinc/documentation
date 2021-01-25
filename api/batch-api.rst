.. _web-services-api--batch-api:

Batch API
=========

The Batch API provides a way to create or update a list of entities of the same type via one API request.

The request is processed asynchronously. The server may process records in any order regardless of the order
in which they are specified in the request.

Input Data Format
-----------------

The input data for each record are the same as for API resources to create or update a single account record:

.. code-block:: none

    {
       "data": [
          {
              "type":"entityType",
              "attributes": {...},
              "relationships": {...}
          },
          {
              "type":"entityType",
              "attributes": {...},
              "relationships": {...}
           }
       ]
    }

To mark records that should be updated, use the ``update`` meta property:

.. code-block:: none

    {
       "data": [
          {
              "meta": {update: true},
              "type":"entityType",
              "id": 1,
              "attributes": {...},
              "relationships": {...}
          },
          {
              "meta": {update: true},
              "type":"entityType",
              "id": 2,
              "attributes": {...},
              "relationships": {...}
           }
       ]
    }

See :ref:`Creating and Updating Related Resources with Primary API Resource <web-services-api--create-update-related-resources>`
for more details about this meta property.

Included Items
--------------

Related entities can be created or updated when processing primary entities.

The list of related entities should be specified in the ``included`` section
that must be placed at the root level, the same as the ``data`` section:

.. code-block:: none

    {
       "data": [
          {
              "type":"entityType",
              "attributes": {...},
              "relationships": {
                  "relation": {
                      "data": {
                          "type":"entityType1",
                          "id": "included_entity_1"
                      }
                  },
                  ...
              }
          },
          ...
       ],
       "included": [
           {
              "type":"entityType1",
              "id": "included_entity_1",
              "attributes": {...},
              "relationships": {...}
          },
          ...
       ]
    }

The included records can be updated when processing the request. To mark included records that should be updated,
use the ``update`` meta property:

.. code-block:: none

    {
       "data": [
          {
              "type":"entityType",
              "attributes": {...},
              "relationships": {
                  "relation": {
                      "data": {
                          "type":"entityType1",
                          "id": "12"
                      }
                  },
                  ...
              }
          },
          ...
       ],
       "included": [
           {
              "meta": {update: true},
              "type":"entityType1",
              "id": "12",
              "attributes": {...},
              "relationships": {...}
          },
          ...
       ]
    }

Batch API Example
-----------------

The next example shows how to insert a list of accounts.

**Request**

.. code-block:: http
    :linenos:

    PATCH /api/accounts HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

**Request Body**

.. code-block:: json
    :linenos:

    {
       "data": [
          {
              "type":"accounts",
              "attributes":{
                 "name":"Gartner management group"
              }
          },
          {
              "type":"accounts",
              "attributes":{
                 "name":"Cloth World"
              }
           }
       ]
    }

**Response**

.. code-block:: json
    :linenos:

    {
      "data": {
        "type": "asyncoperations",
        "id": "1",
        "links": {
          "self": "http://your_domain.com/admin/api/asyncoperations/1"
        },
        "attributes": {
          "status": "new",
          "progress": null,
          "createdAt": "2020-03-11T17:41:17Z",
          "updatedAt": "2020-03-11T17:41:17Z",
          "elapsedTime": 0,
          "entityType": "accounts",
          "summary": null
        },
        "relationships": {
          "owner": {
            "data": {
              "type": "users",
              "id": "1"
            }
          },
          "organization": {
            "data": {
              "type": "organizations",
              "id": "1"
            }
          }
        }
      }
    }

The response of request is the corresponding asynchronous operation created for the request.

The response object has the following data:

- **status** - The status of the asynchronous operation. Possible values: ``new``, ``running``, ``failed``, ``success``, ``cancelled``.
- **progress** - The progress, in percentage, for the asynchronous operation.
- **elapsedTime** - The number of seconds the asynchronous operation has been running for.
- **entityType** - The type of an entity for which the asynchronous operation was created.
- **createdAt** - The date and time when the asynchronous operation was created.
- **updatedAt** - The date and time when the asynchronous operation was last updated.
- **owner** - A user who created the asynchronous operation.
- **organization** - An organization the asynchronous operation belongs to.
- **summary** - The summary statistics of the asynchronous operation. This field will have data only when an asynchronous operation is finished successfully.

The ``summary`` can have the following properties:

- **aggregateTime** - The accumulated time, in milliseconds, taken by the system to accomplish the asynchronous operation.
- **readCount** - The number of items that have been successfully read.
- **writeCount** - The number of items that have been successfully written.
- **errorCount** - The number of errors occurred when processing the asynchronous operation.
- **createCount** - The number of items that have been successfully created.
- **updateCount** - The number of items that have been successfully updated.

To see updated status of job, use the following request:

**Request**

.. code-block:: http
    :linenos:

    GET /api/asyncoperations/1 HTTP/1.1
    Accept: application/vnd.api+json

**Response**

.. code-block:: none

    {
      "data": {
        "type": "asyncoperations",
        "id": "1",
        "attributes": {
          "status": "success",
          "progress": 1,
          "elapsedTime": 3,
          "entityType": "accounts",
          "summary": {
            "aggregateTime": 2737,
            "readCount": 2,
            "writeCount": 2,
            "errorCount": 0,
            "createCount": 2,
            "updateCount": 0,
          ...
          }
        },
        ...
      }
    }

This example shows the status of the operation that was successfully completed. Here 2 entities were read and inserted.

If some entities were not processed, the summary's ``errorCount`` field will contain the number of errors occurred
when processing the asynchronous operation:

.. code-block:: none

    {
      "data": {
        "type": "asyncoperations",
        "id": "1",
        "attributes": {
          "status": "success",
          "progress": 1,
          "elapsedTime": 3,
          "entityType": "accounts",
          "summary": {
            "aggregateTime": 2218,
            "readCount": 2,
            "writeCount": 1,
            "errorCount": 1,
            "createCount": 1,
            "updateCount": 0
          ...
          }
        },
        ...
      }
    }

To sse the list of errors, use the ``asyncoperations/{id}/errors`` subresource:

.. code-block:: http
    :linenos:

    GET /api/asyncoperations/1/errors HTTP/1.1
    Accept: application/vnd.api+json

**Response**

.. code-block:: json
    :linenos:

    {
      "data": [
        {
          "type": "asyncoperationerrors",
          "id": "3-1-1",
          "attributes": {
            "status": 400,
            "title": "not blank constraint",
            "detail": "This value should not be blank.",
            "source": {
              "pointer": "/data/0/attributes/name"
            }
          }
        }
      ]
    }

The returned asynchronous operation errors have the following data:

- **status** - The HTTP status code applicable to the problem.
- **title** - A short, human-readable summary that describes the problem type.
- **detail** - A human-readable explanation specific to this occurrence of the problem.
- **source** - An object containing references to the source of the error.

The ``source`` object can have the following properties:

- **pointer** - A |JSON Pointer| to the value in the request document that caused the error, e.g., "/data/0" for a primary data object, or "/data/0/attributes/title" for a specific attribute.
- **propertyPath** - A path to the value in the request document that caused the error. This property is returned if the pointer property cannot be computed.


.. include:: /include/include-links-dev.rst
   :start-after: begin

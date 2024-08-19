.. _web-services-api--sync-batch-api:

Synchronous Batch API
=====================

The Synchronous Batch API provides a way to create or update a list of entities of the same type via one API request.
Unlike the :ref:`asynchronous Batch API <web-services-api--batch-api>`, the synchronous Batch API request is processed
synchronously and in a linear and atomic manner. This means that the server processes records in the order in which they are specified in the request, and all records are either successfully processed or fail.

.. note::
   The maximum number of entities that can be processed synchronously is limited to 100 for primary and 50 for included entities. These are default limits, and an administrator can change them if required.

.. note::
   If the request takes too long to process and exceeds the configured processing timeout, it will be processed as an :ref:`Asynchronous Batch API <web-services-api--batch-api>` request. The default timeout is 25 seconds.

The API resources and input data format for synchronous Batch API requests are the same as for asynchronous
Batch API requests, but for the synchronous request you need to specify **X-Mode** request header with **sync** value.
The response contains all entities from the request in the same order as in the request.

.. note::
    The primary entity identifiers specified in the request are returned in the **dataId** meta attribute in the response. The included entity identifiers are returned in the **includeId** meta attribute. This allows matching entities in the request and the response.

Example
-------

**Request**

.. code-block:: http

    PATCH /api/accounts HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json
    X-Mode: sync

**Request Body**

.. code-block:: json

    {
       "data": [
          {
              "type": "accounts",
              "id": "account_1",
              "attributes":{
                 "name": "Account 1"
              },
              "relationships": {
                  "contacts": {
                      "data": [
                          {"type": "contacts", "id": "contact_1"}
                      ]
                  }
              }
          },
          {
              "type": "accounts",
              "id": "account_2",
              "attributes":{
                 "name": "Account 2"
              },
              "relationships": {
                  "contacts": {
                      "data": [
                          {"type": "contacts", "id": "contact_2"}
                      ]
                  }
              }
           }
       ],
       "included": [
          {
              "type": "contacts",
              "id": "contact_1",
              "attributes": {
                  "primaryEmail": "contact1@example.com"
              }
          },
          {
              "type": "contacts",
              "id": "contact_2",
              "attributes": {
                  "primaryEmail": "contact2@example.com"
              }
          }
       ]
    }

**Response**

.. code-block:: json

    {
       "data": [
          {
              "type": "accounts",
              "id": "101",
              "meta": {
                "dataId": "account_1"
              },
              "attributes":{
                 "name": "Account 1"
              },
              "relationships": {
                  "contacts": {
                      "data": [
                          {"type": "contacts", "id": "1001"}
                      ]
                  }
              }
          },
          {
              "type": "accounts",
              "id": "102",
              "meta": {
                "dataId": "account_2"
              },
              "attributes":{
                 "name": "Account 2"
              },
              "relationships": {
                  "contacts": {
                      "data": [
                          {"type": "contacts", "id": "1002"}
                      ]
                  }
              }
           }
       ],
       "included": [
          {
              "type": "contacts",
              "id": "1001",
              "meta": {
                "includeId": "contact_1"
              },
              "attributes": {
                  "primaryEmail": "contact1@example.com"
              }
          },
          {
              "type": "contacts",
              "id": "1002",
              "meta": {
                "includeId": "contact_2"
              },
              "attributes": {
                  "primaryEmail": "contact2@example.com"
              }
          }
       ]
    }


.. include:: /include/include-links-dev.rst
   :start-after: begin

.. _web-services-api--upsert-operation:

Creating Resource or Updating Existing Resource via Single API Request
======================================================================

Some API resources can be created, if a particular resource does not exists, or updated, if it already exists,
via a single API request. It is called an "upsert" operation and it works the following way:

1. If a resource is not found by a upsert criteria, then a new resource is created according to the request body
   and a 201 (Created) status code is returned.
2. If a resource is found, then the resource is updated according to the request body
   and a 200 (Ok) status code is returned.
3. If several resources are found, then the resource is not created or updated,
   and a 409 (Conflict) status code is returned.

The upsert criteria is specified in the |JSON:API: Meta Section| section using an "upsert" option. To match a resource
by the resource identifier the "upsert" option should have ``true`` or ``["id"]`` value. To match a resource by other
field(s), this (these) field(s) should be specified in the "upsert" option value, e.g. ``["field1", "field2"]``.

The upsert operation can be supported by POST and/or PATCH |JSON:API| requests. With the POST request,
you can match a resource by the resource identifier or by some other field(s). With the PATCH request,
you can match a resource by the resource identifier only.

The documentation of POST and PATCH requests in the :ref:`API Sandbox <web-services-api--sandbox>` contains
information whether a resource supports the upsert operation. For example.:

.. image:: /img/backend/api/upsert_operation_note.png
   :alt: An example of the upsert operation note

An example of a POST upsert requests when a resource should be matched by the resource identifier:

**Request**

.. code-block:: http

    POST /api/weightunits HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

**Request Body**

.. code-block:: json

    {"data": {
        "type": "weightunits",
        "id": "kg",
        "meta": {
          "upsert": true
        },
        "attributes": {
          "conversionRates": {
            "lbs": 2.2
          }
        }
      }
    }

An example of a PATCH upsert requests when a resource should be matched by the resource identifier:

**Request**

.. code-block:: http

    PATCH /api/weightunits/kg HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

**Request Body**

.. code-block:: json

    {"data": {
        "type": "weightunits",
        "id": "kg",
        "meta": {
          "upsert": true
        },
        "attributes": {
          "conversionRates": {
            "lbs": 2.2
          }
        }
      }
    }

An example of a POST upsert request when a resource should be matched by some field:

**Request**

.. code-block:: http

    POST /api/taxjurisdictions HTTP/1.1
    Content-Type: application/vnd.api+json
    Accept: application/vnd.api+json

**Request Body**

.. code-block:: json

    {"data": {
        "type": "taxjurisdictions",
        "meta": {
          "upsert": ["code"]
        },
        "attributes": {
          "code": "SOME_TAX_JURISDICTION",
          "description": "Some tax jurisdiction description",
          "regionText": null,
          "zipCodes": [
            {"from": "90011", "to":  null},
            {"from": "90201", "to":  "90280"}
          ]
        },
        "relationships": {
          "country": {
            "data": {
              "type": "countries",
              "id": "US"
            }
          },
          "region": {
            "data": {
              "type": "regions",
              "id": "US-CA"
            }
          }
        }
      }
    }

.. include:: /include/include-links-dev.rst
   :start-after: begin
